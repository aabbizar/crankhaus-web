<?php

namespace App\Livewire;

use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Events\NewOrderPlaced;
use App\Models\User;
use Filament\Notifications\Notification;
use Livewire\Component;

class MenuCatalog extends Component
{
    public string $activeCategory = 'all';
    public array $validCategories = ['Makanan Utama', 'Cemilan', 'Minuman'];

    /** Cart: [ menu_id => ['id' => int, 'name' => string, 'price' => int, 'image' => string, 'quantity' => int] ] */
    public array $cart = [];

    // Modal state
    public bool $showModal = false;
    public ?int $selectedMenuId = null;

    // Checkout state
    public bool $showCheckout = false;
    public string $customerName = '';
    public string $tableNumber = '';

    // Order success state
    public bool $orderPlaced = false;
    public int $queueNumber = 0;

    protected $rules = [
        'customerName' => 'required|string|min:2|max:100',
        'tableNumber'  => 'required|string|min:1|max:10',
    ];

    protected $messages = [
        'customerName.required' => 'Customer name is required.',
        'customerName.min'      => 'Customer name must be at least 2 characters.',
        'tableNumber.required'  => 'Table number or Location is required.',
    ];

    public function setCategory(string $category): void
    {
        $this->activeCategory = $category;
        $this->dispatch('category-changed');
    }

    public function openModal(int $menuId): void
    {
        $this->selectedMenuId = $menuId;
        $this->showModal = true;
        $this->dispatch('modal-opened', menuId: $menuId);
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->selectedMenuId = null;
    }

    public function addSelectedToCartAndClose(): void
    {
        if ($this->selectedMenuId) {
            $this->addToCart($this->selectedMenuId);
        }
        $this->closeModal();
    }

    public function addToCart(int $menuId): void
    {
        $menu = Menu::find($menuId);
        if (!$menu || !$menu->is_available) {
            return;
        }

        $key = (string) $menuId;
        if (isset($this->cart[$key])) {
            $this->cart[$key]['quantity']++;
        } else {
            $this->cart[$key] = [
                'id'       => $menu->id,
                'name'     => $menu->name,
                'price'    => $menu->price,
                'image'    => $menu->image_url,
                'quantity' => 1,
            ];
        }

        $this->dispatch('cart-updated', count: $this->getCartCount(), addedName: $menu->name);
    }

    public function removeFromCart(int $menuId): void
    {
        $key = (string) $menuId;
        if (isset($this->cart[$key])) {
            unset($this->cart[$key]);
        }
        $this->dispatch('cart-updated', count: $this->getCartCount());
    }

    public function incrementQty(int $menuId): void
    {
        $key = (string) $menuId;
        if (isset($this->cart[$key])) {
            $this->cart[$key]['quantity']++;
        }
    }

    public function decrementQty(int $menuId): void
    {
        $key = (string) $menuId;
        if (isset($this->cart[$key])) {
            if ($this->cart[$key]['quantity'] <= 1) {
                $this->removeFromCart($menuId);
            } else {
                $this->cart[$key]['quantity']--;
            }
        }
    }

    public function getCartTotal(): int
    {
        return collect($this->cart)->sum(fn($item) => $item['price'] * $item['quantity']);
    }

    public function getCartCount(): int
    {
        return collect($this->cart)->sum('quantity');
    }

    public function emptyCart(): void
    {
        $this->cart = [];
        $this->dispatch('cart-updated', count: 0);
    }

    public function openCheckout(): void
    {
        if (empty($this->cart)) {
            return;
        }
        $this->showCheckout = true;
    }

    public function closeCheckout(): void
    {
        $this->showCheckout = false;
    }

    public function submitOrder(): void
    {
        $this->validate();

        if (empty($this->cart)) {
            return;
        }

        $queueNum = Order::nextQueueNumber();

        $order = Order::create([
            'customer_name'  => $this->customerName,
            'table_number'   => $this->tableNumber,
            'total_price'    => $this->getCartTotal(),
            'payment_method' => 'Pay at Cashier',
            'status'         => 'pending',
            'queue_number'   => $queueNum,
            'user_id'        => auth()->id(),
        ]);

        foreach ($this->cart as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'menu_id'    => $item['id'],
                'quantity'   => $item['quantity'],
                'unit_price' => $item['price'],
            ]);
        }

        // Send Filament database notification to all admins synchronously (bypass queue)
        try {
            $admins = User::where('role', 'admin')->get();
            $oldQueue = config('queue.default');
            config(['queue.default' => 'sync']);
            
            foreach ($admins as $admin) {
                Notification::make()
                    ->title('🚲 New Order Placed!')
                    ->body("Table {$order->table_number} — {$order->customer_name} | Queue #{$queueNum} | Rp " . number_format($order->total_price, 0, ',', '.'))
                    ->success()
                    ->sendToDatabase($admin);
            }
            
            config(['queue.default' => $oldQueue]);
        } catch (\Throwable $e) {
            // Graceful degradation
        }

        // Broadcast event
        try {
            event(new NewOrderPlaced($order));
        } catch (\Throwable $e) {
            // Broadcasting not configured — graceful degradation
        }

        $this->queueNumber    = $queueNum;
        $this->orderPlaced    = true;
        $this->showCheckout   = false;
        $this->cart           = [];
        $this->customerName   = '';
        $this->tableNumber    = '';

        $this->dispatch('order-confirmed', queueNumber: $queueNum);
    }

    public function resetOrder(): void
    {
        $this->orderPlaced = false;
        $this->queueNumber = 0;
    }

    public function render()
    {
        $query = Menu::query()->where('is_available', true);

        if ($this->activeCategory !== 'all' && in_array($this->activeCategory, $this->validCategories, true)) {
            $query->where('category', $this->activeCategory);
        }

        $menus = $query->orderBy('category')->orderBy('name')->get();

        $selectedMenu = $this->selectedMenuId
            ? Menu::find($this->selectedMenuId)
            : null;

        $categoryCounts = Menu::where('is_available', true)
            ->get()
            ->groupBy('category')
            ->map->count();

        return view('livewire.menu-catalog', [
            'menus'          => $menus,
            'selectedMenu'   => $selectedMenu,
            'categoryCounts' => $categoryCounts,
            'cartTotal'      => $this->getCartTotal(),
            'cartCount'      => $this->getCartCount(),
        ]);
    }
}
