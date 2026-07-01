<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Dashboard Admin — data real dari SQLite.
     */
    public function index(): \Illuminate\View\View
    {
        // ── Statistik produk per brand ────────────────────────────────────
        $brandStats = Product::select('brand', DB::raw('count(*) as total_products'), DB::raw('sum(stock) as total_stock'), DB::raw('avg(price) as avg_price'), DB::raw('min(price) as min_price'), DB::raw('max(price) as max_price'))
            ->groupBy('brand')
            ->orderBy('brand')
            ->get();

        // ── Statistik per kategori ────────────────────────────────────────
        $categoryStats = Product::select('category', DB::raw('count(*) as total'), DB::raw('sum(stock) as stock'), DB::raw('avg(price) as avg_price'))
            ->groupBy('category')
            ->orderBy('category')
            ->get();

        // ── Produk stok rendah (< 25) ─────────────────────────────────────
        $lowStock = Product::where('stock', '<', 25)
            ->orderBy('stock', 'asc')
            ->get();

        // ── Semua produk untuk tabel ──────────────────────────────────────
        $allProducts = Product::orderBy('category')->orderBy('brand')->orderBy('name')->get();

        // ── Total stats ───────────────────────────────────────────────────
        $totalProducts = Product::count();
        $totalStock    = Product::sum('stock');
        $avgPrice      = Product::avg('price');
        $totalValue    = Product::selectRaw('sum(price * stock) as total')->value('total');

        return view('admin.dashboard', [
            'brandStats'    => $brandStats,
            'categoryStats' => $categoryStats,
            'lowStock'      => $lowStock,
            'allProducts'   => $allProducts,
            'totalProducts' => $totalProducts,
            'totalStock'    => $totalStock,
            'avgPrice'      => $avgPrice,
            'totalValue'    => $totalValue,
        ]);
    }
}
