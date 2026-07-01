<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\UserProfileController;

/*
 |─────────────────────────────────────────────────────────────────────────
 | CRANKHAUS — Web Routes
 |─────────────────────────────────────────────────────────────────────────
 | The main catalog is handled by the Livewire MenuCatalog component
 | embedded directly in welcome.blade.php. No controller needed for catalog.
 */

// ── Home ─────────────────────────────────────────────────────────────────
Route::get('/', function () {
    $events = \App\Models\Event::upcoming()->limit(3)->get();
    return view('welcome', compact('events'));
})->name('home');

// ── Menu Catalog ─────────────────────────────────────────────────────────
Route::get('/menu', function () {
    return view('menu');
})->name('menu');

// ── Reserve a Table ───────────────────────────────────────────────────────
Route::get('/reserve', function () {
    return view('reserve');
})->name('reserve');

// ── Cycling Events ────────────────────────────────────────────────────────
Route::get('/events', function () {
    $events = \App\Models\Event::upcoming()->get();
    return view('events', compact('events'));
})->name('events');

// ── FAQ ───────────────────────────────────────────────────────────────────
Route::get('/faq', function () {
    return view('faq');
})->name('faq');

// ── Dashboard (redirect) ──────────────────────────────────────────────────
Route::get('/dashboard', function () {
    return redirect('/');
})->name('dashboard');

// ── Logout ────────────────────────────────────────────────────────────────
Route::post('/logout', function (Request $request) {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// ── Force Logout ──────────────────────────────────────────────────────────
Route::get('/force-logout', function () {
    Auth::guard('web')->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
});

// ── User Profile ──────────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/profile',          [UserProfileController::class, 'show'])   ->name('profile');
    Route::get('/profile/edit',     [UserProfileController::class, 'edit'])   ->name('profile.edit');
    Route::post('/profile/update',  [UserProfileController::class, 'update']) ->name('profile.update');
    Route::post('/profile/password',[UserProfileController::class, 'password'])->name('profile.password');

    // API order status update for admin modal popup
    Route::post('/api/orders/{id}/status', function (Request $request, $id) {
        $order = \App\Models\Order::findOrFail($id);
        $status = $request->input('status');

        if ($status === 'processing') {
            $order->update(['status' => 'processing']);
            return response()->json(['success' => true, 'message' => 'Order sent to kitchen!']);
        } elseif ($status === 'pending') {
            $order->update(['status' => 'pending']);
            return response()->json(['success' => true, 'message' => 'Order queued.']);
        } elseif ($status === 'rejected') {
            $order->delete();
            return response()->json(['success' => true, 'message' => 'Order rejected and removed.']);
        }

        return response()->json(['success' => false, 'message' => 'Invalid status.'], 400);
    });

    // API endpoint for polling new orders (used by admin panel real-time toast)
    Route::get('/api/orders/latest-pending', function (Request $request) {
        $since = $request->query('since');
        $date = $since ? \Carbon\Carbon::createFromTimestamp($since) : now()->subSeconds(30);
        
        $orders = \App\Models\Order::where('status', 'pending')
            ->where('created_at', '>', $date->toDateTimeString())
            ->with(['items.menu'])
            ->get()
            ->map(function ($order) {
                $itemsList = $order->items->map(function ($item) {
                    return [
                        'name' => $item->menu ? $item->menu->name : 'Unknown Item',
                        'quantity' => $item->quantity,
                    ];
                });

                return [
                    'orderId' => $order->id,
                    'customerName' => $order->customer_name,
                    'tableNumber' => $order->table_number,
                    'queueNumber' => $order->queue_number,
                    'items' => $itemsList,
                    'totalPrice' => $order->total_price,
                ];
            });

        return response()->json([
            'orders' => $orders,
            'server_time' => now()->timestamp
        ]);
    });

    // API endpoint for polling new reservations (used by admin panel real-time toast)
    Route::get('/api/reservations/latest-pending', function (Request $request) {
        $since = $request->query('since');
        $date = $since ? \Carbon\Carbon::createFromTimestamp($since) : now()->subSeconds(30);
        
        $reservations = \App\Models\Reservation::where('status', 'pending')
            ->where('created_at', '>', $date->toDateTimeString())
            ->get()
            ->map(function ($res) {
                return [
                    'reservationId' => $res->id,
                    'name' => $res->name,
                    'partySize' => $res->party_size,
                    'date' => $res->date ? $res->date->format('Y-m-d') : '',
                    'time' => $res->time,
                ];
            });

        return response()->json([
            'reservations' => $reservations,
            'server_time' => now()->timestamp
        ]);
    });
});

require __DIR__ . '/auth.php';

