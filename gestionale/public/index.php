<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__ . '/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__ . '/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
(require_once __DIR__ . '/../bootstrap/app.php')
    ->handleRequest(Request::capture());

// <?php

// use Illuminate\Foundation\Application;
// use Illuminate\Http\Request;

// define('LARAVEL_START', microtime(true));

// // Determine if the application is in maintenance mode...
// if (file_exists($maintenance = __DIR__ . '/../storage/framework/maintenance.php')) {
//     require $maintenance;
// } elseif (file_exists($maintenance = __DIR__ . '/../../gest/storage/framework/maintenance.php')) {
//     require $maintenance;
// }

// // Register the Composer autoloader...
// if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
//     require __DIR__ . '/../vendor/autoload.php';
// } else {
//     require __DIR__ . '/../../gest/vendor/autoload.php';
// }

// // Bootstrap Laravel and handle the request...
// if (file_exists(__DIR__ . '/../bootstrap/app.php')) {
//     $app = require_once __DIR__ . '/../bootstrap/app.php';
// } else {
//     $app = require_once __DIR__ . '/../../gest/bootstrap/app.php';
// }

// $app->handleRequest(Request::capture());