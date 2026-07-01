<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

echo "--- Testing /admin/login ---\n";
$request = Illuminate\Http\Request::create('/admin/login', 'GET');
$response = $kernel->handle($request);
echo "Status: " . $response->getStatusCode() . "\n";
echo "Location: " . $response->headers->get('Location') . "\n\n";

echo "--- Testing /login ---\n";
$request = Illuminate\Http\Request::create('/login', 'GET');
$response = $kernel->handle($request);
echo "Status: " . $response->getStatusCode() . "\n";
echo "Location: " . $response->headers->get('Location') . "\n\n";

echo "--- Testing /admin ---\n";
$request = Illuminate\Http\Request::create('/admin', 'GET');
$response = $kernel->handle($request);
echo "Status: " . $response->getStatusCode() . "\n";
echo "Location: " . $response->headers->get('Location') . "\n\n";
