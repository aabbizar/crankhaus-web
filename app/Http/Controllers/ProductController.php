<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        return view('welcome');
    }

    public function findById(int $id)
    {
        $product = Product::findOrFail($id);
        return response()->json(['slug' => $product->slug]);
    }

    public function show(string $slug): View
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        $stringingOptions = collect();

        if ($product->category === 'Rackets') {
            $stringingOptions = \App\Models\StringingOption::orderBy('nama_senar')->get();

            if ($stringingOptions->isEmpty()) {
                $stringingOptions = collect([
                    (object) ['id' => 1, 'nama_senar' => 'Yonex BG65 Titanium',    'warna_senar' => 'Putih',  'harga_tambahan' => 45000, 'keterangan' => 'Cocok untuk pemula hingga intermediate. Daya tahan tinggi.'],
                    (object) ['id' => 2, 'nama_senar' => 'Yonex Aerosonic',         'warna_senar' => 'Putih',  'harga_tambahan' => 65000, 'keterangan' => 'Senar tertipis Yonex. Repulsion tinggi untuk smash keras.'],
                    (object) ['id' => 3, 'nama_senar' => 'Li-Ning No.1 Speed',      'warna_senar' => 'Kuning', 'harga_tambahan' => 55000, 'keterangan' => 'Teknologi multifilament untuk akurasi kontrol drop shot.'],
                    (object) ['id' => 4, 'nama_senar' => 'Victor VS-850 Master',    'warna_senar' => 'Merah',  'harga_tambahan' => 50000, 'keterangan' => 'Keseimbangan power dan kontrol untuk all-round player.'],
                    (object) ['id' => 5, 'nama_senar' => 'Ashaway Rally 21 Fire',   'warna_senar' => 'Orange', 'harga_tambahan' => 60000, 'keterangan' => 'Gauge 0.65mm. Ideal untuk ganda dan all-round play.'],
                    (object) ['id' => 6, 'nama_senar' => 'Felet Nano Multifilament', 'warna_senar' => 'Biru',  'harga_tambahan' => 48000, 'keterangan' => 'Senar nano fiber dengan shock-absorbing terbaik di kelasnya.'],
                ]);
            }
        }

        $relatedProducts = Product::where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        $breadcrumbs = [
            ['label' => 'Katalog',          'url' => route('home')],
            ['label' => $product->category, 'url' => route('home', ['category' => $product->category])],
            ['label' => $product->name,     'url' => null],
        ];

        return view('products.show', [
            'product'          => $product,
            'stringingOptions' => $stringingOptions,
            'relatedProducts'  => $relatedProducts,
            'breadcrumbs'      => $breadcrumbs,
        ]);
    }

    public function buy(Request $request, Product $product)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Silakan login terlebih dahulu.'], 401);
        }

        if ($product->stock < 1) {
            return response()->json(['error' => 'Stok produk habis.'], 422);
        }

        $validated = $request->validate([
            'shipping_name'    => 'required|string|max:255',
            'shipping_phone'   => 'required|string|max:20',
            'shipping_address' => 'required|string|max:1000',
            'notes'            => 'nullable|string|max:500',
        ]);

        $orderId = 'PBS-' . strtoupper(substr(md5(uniqid()), 0, 8)) . '-' . $product->id . '-' . time();

        $order = auth()->user()->orders()->create([
            'midtrans_order_id' => $orderId,
            'payment_status'    => 'pending',
            'snap_token'        => 'dummy-token-' . $orderId,
            'shipping_name'     => $validated['shipping_name'],
            'shipping_phone'    => $validated['shipping_phone'],
            'shipping_address'  => $validated['shipping_address'],
            'notes'             => $validated['notes'] ?? null,
        ]);

        $order->items()->create([
            'product_id' => $product->id,
            'quantity'   => 1,
        ]);

        // Mengurangi stok produk saat dipesan
        $product->decrement('stock');

        // Broadcast Notifikasi ke Admin
        $admins = User::admins()->get();
        Notification::make()
            ->title('Pesanan Baru Masuk')
            ->icon('heroicon-o-shopping-bag')
            ->body('Pesanan ' . $orderId . ' sebesar Rp' . number_format($product->price, 0, ',', '.') . ' dari ' . $validated['shipping_name'])
            ->actions([
                Action::make('view')
                    ->label('Lihat Pesanan')
                    ->url(route('filament.admin.resources.orders.view', $order))
                    ->button(),
            ])
            ->sendToDatabase($admins);

        return response()->json([
            'snap_token' => 'dummy-' . $orderId,
            'order_id'   => $order->id,
            'is_dummy'   => true,
            'product'    => $product->name,
            'amount'     => $product->price,
        ]);
    }
}
