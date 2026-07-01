<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$admin = \App\Models\User::where('role', 'admin')->first();

echo "Testing queue connection override:\n";
try {
    // Override queue connection to sync
    config(['queue.default' => 'sync']);
    
    \Filament\Notifications\Notification::make()
        ->title('🚲 Sync Order Placed!')
        ->body("This order bypassed the database queue.")
        ->success()
        ->sendToDatabase($admin);
    echo "Sent successfully!\n";
} catch (\Throwable $e) {
    echo "FAILED: " . $e->getMessage() . "\n";
}

$rows = \DB::table('notifications')->get();
echo "Total rows in notifications table: " . $rows->count() . "\n";
foreach ($rows as $row) {
    echo "Data: " . $row->data . "\n";
}
