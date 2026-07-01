<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class RevenueChart extends ChartWidget
{
    protected static ?int $sort = 2;

    public ?string $heading = 'Tren Pendapatan Kafe (7 Hari Terakhir)';

    public int|string|array $columnSpan = 1;

    protected function getData(): array
    {
        $days = collect(range(6, 0))->map(function ($i) {
            $day     = Carbon::now()->subDays($i);
            $revenue = Order::whereDate('created_at', $day)
                ->where('status', 'completed')
                ->sum('total_price');
            $orders  = Order::whereDate('created_at', $day)->count();

            return [
                'label'   => $day->format('D d/M'),
                'revenue' => $revenue,
                'orders'  => $orders,
            ];
        });

        return [
            'datasets' => [
                [
                    'label'           => 'Pendapatan (Rp)',
                    'data'            => $days->pluck('revenue')->toArray(),
                    'backgroundColor' => 'rgba(255, 56, 92, 0.12)',
                    'borderColor'     => '#ff385c',
                    'fill'            => 'start',
                    'tension'         => 0.45,
                    'pointBackgroundColor' => '#ff385c',
                    'pointRadius'     => 4,
                ],
            ],
            'labels' => $days->pluck('label')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => ['display' => false],
            ],
            'scales' => [
                'y' => [
                    'ticks' => [
                        'callback' => 'function(value) { return "Rp " + value.toLocaleString("id-ID"); }',
                    ],
                ],
            ],
        ];
    }
}
