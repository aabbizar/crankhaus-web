<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

try {
    // Mock Livewire component
    $livewire = new App\Filament\Resources\CashFlowResource\Pages\ListCashFlows();
    $table = Filament\Tables\Table::make($livewire);
    $configuredTable = App\Filament\Resources\CashFlowResource::table($table);
    echo "Table successfully loaded!\n";
} catch (\Throwable $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}
