<?php

namespace App\Filament\Widgets;

use App\Models\Menu;
use App\Models\Order;
use Filament\Widgets\ChartWidget;

class StockChart extends ChartWidget
{
    protected static ?int $sort = 3;

    public ?string $heading = 'Distribusi Menu per Kategori';

    public int|string|array $columnSpan = 1;

    protected function getData(): array
    {
        $makananUtama = Menu::where('category', 'Makanan Utama')->where('is_available', true)->count();
        $cemilan      = Menu::where('category', 'Cemilan')->where('is_available', true)->count();
        $minuman      = Menu::where('category', 'Minuman')->where('is_available', true)->count();
        $inactive     = Menu::where('is_available', false)->count();

        return [
            'datasets' => [
                [
                    'label'           => 'Menu',
                    'data'            => [$makananUtama, $cemilan, $minuman, $inactive],
                    'backgroundColor' => [
                        'rgba(255, 56, 92, 0.8)',
                        'rgba(251, 146, 60, 0.8)',
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(156, 163, 175, 0.8)',
                    ],
                    'borderColor'     => ['#ff385c', '#fb923c', '#3b82f6', '#9ca3af'],
                    'borderWidth'     => 2,
                    'hoverOffset'     => 8,
                ],
            ],
            'labels' => ['Makanan Utama', 'Cemilan', 'Minuman', 'Nonaktif'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'position' => 'bottom',
                    'labels'   => ['padding' => 16],
                ],
            ],
            'cutout' => '65%',
        ];
    }
}
