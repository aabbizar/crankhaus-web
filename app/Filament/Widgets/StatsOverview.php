<?php

namespace App\Filament\Widgets;

use App\Models\Menu;
use App\Models\Order;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $todayRevenue = Order::whereDate('created_at', today())
            ->where('status', 'completed')
            ->sum('total_price');

        $todayOrders = Order::whereDate('created_at', today())->count();

        $yesterdayOrders = Order::whereDate('created_at', Carbon::yesterday())->count();
        $orderDelta = $yesterdayOrders > 0
            ? round((($todayOrders - $yesterdayOrders) / $yesterdayOrders) * 100)
            : 0;

        $activeMenus = Menu::where('is_available', true)->count();

        $activeQueue = Order::whereDate('created_at', today())
            ->whereIn('status', ['pending', 'processing'])
            ->count();

        // Cash flow stats
        $totalInflow = \App\Models\CashFlow::where('type', 'income')->sum('amount');
        $totalOutflow = \App\Models\CashFlow::where('type', 'expense')->sum('amount');
        $netBalance = $totalInflow - $totalOutflow;

        // Trend data for charts (7-day)
        $revenueTrend = collect(range(6, 0))->map(function ($i) {
            return Order::whereDate('created_at', Carbon::now()->subDays($i))
                ->where('status', 'completed')
                ->sum('total_price');
        })->toArray();

        $orderTrend = collect(range(6, 0))->map(function ($i) {
            return Order::whereDate('created_at', Carbon::now()->subDays($i))->count();
        })->toArray();

        return [
            Stat::make('Pendapatan Hari Ini', 'Rp ' . number_format($todayRevenue, 0, ',', '.'))
                ->description('Dari pesanan yang selesai')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success')
                ->chart($revenueTrend),

            Stat::make('Total Order Hari Ini', $todayOrders)
                ->description(($orderDelta >= 0 ? '+' : '') . $orderDelta . '% vs kemarin')
                ->descriptionIcon($orderDelta >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($orderDelta >= 0 ? 'success' : 'danger')
                ->chart($orderTrend),

            Stat::make('Antrian Aktif', $activeQueue)
                ->description('Pending + Processing sekarang')
                ->descriptionIcon('heroicon-m-queue-list')
                ->color($activeQueue > 5 ? 'warning' : 'info'),

            Stat::make('Total Pemasukan (Inflow)', 'Rp ' . number_format($totalInflow, 0, ',', '.'))
                ->description('Total kas masuk dicatat')
                ->descriptionIcon('heroicon-m-arrow-down-tray')
                ->color('success'),

            Stat::make('Total Pengeluaran (Outflow)', 'Rp ' . number_format($totalOutflow, 0, ',', '.'))
                ->description('Total kas keluar dicatat')
                ->descriptionIcon('heroicon-m-arrow-up-tray')
                ->color('danger'),

            Stat::make('Saldo Bersih', 'Rp ' . number_format($netBalance, 0, ',', '.'))
                ->description('Pemasukan minus pengeluaran')
                ->descriptionIcon('heroicon-m-scale')
                ->color($netBalance >= 0 ? 'success' : 'danger'),
        ];
    }
}

