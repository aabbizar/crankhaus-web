<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

$user = \App\Models\User::where('email', 'admin@pbsahaja.com')->first();
if (!$user) {
    echo "Admin user not found!\n";
    exit(1);
}

// Log in programmatically
auth()->login($user);
echo "Logged in as: " . auth()->user()->email . "\n";
echo "Is Admin? " . (auth()->user()->isAdmin() ? 'Yes' : 'No') . "\n";

// Access /admin
$request = Illuminate\Http\Request::create('/admin', 'GET');
$response = $kernel->handle($request);

echo "Access /admin response status: " . $response->getStatusCode() . "\n";
echo "Redirect Target: " . $response->headers->get('Location') . "\n";
