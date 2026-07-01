<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductCatalog extends Component
{
    public string $activeCategory = 'all';
    public string $search = '';
    public array $validCategories = ['Rackets', 'Shoes', 'Apparel', 'Accessories'];

    protected $queryString = ['activeCategory', 'search'];

    public function setCategory(string $category): void
    {
        $this->activeCategory = $category;
        $this->search = '';
    }

    public function render()
    {
        $query = Product::query()->orderBy('category')->orderBy('name');

        if ($this->activeCategory !== 'all' && in_array($this->activeCategory, $this->validCategories, true)) {
            $query->where('category', $this->activeCategory);
        }

        if ($this->search !== '') {
            $query->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                  ->orWhere('brand', 'like', "%{$this->search}%")
                  ->orWhere('description', 'like', "%{$this->search}%");
            });
        }

        $products = $query->get();
        $allProducts = Product::orderBy('category')->orderBy('name')->get();
        $byCategory = $allProducts->groupBy('category');
        $categoryCounts = $allProducts->groupBy('category')->map->count();

        $this->dispatch('catalog-loaded');

        return view('livewire.product-catalog', [
            'products'       => $products,
            'byCategory'     => $byCategory,
            'categoryCounts' => $categoryCounts,
            'totalProducts'  => $allProducts->count(),
        ]);
    }
}
