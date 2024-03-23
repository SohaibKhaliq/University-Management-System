<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Load the Composer autoloader
require __DIR__.'/../vendor/autoload.php';

// Load environment variables
Dotenv\Dotenv::createImmutable(__DIR__.'/..')->load();

// Create an application instance
$app = require_once __DIR__.'/../bootstrap/app.php';

// Bind the request to the Laravel application
$request = Request::capture();
$app->instance('request', $request);

// Bind the application instance to the kernel
$kernel = $app->make(Kernel::class);
$response = $kernel->handle($request);

// Send the response back to the browser
$response->send();

// Terminate the kernel
$kernel->terminate($request, $response);
