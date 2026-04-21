<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Questo file andrà caricato in public_html/rist/index.php

// Determine if the application is in maintenance mode...
// Path aggiornata da public_html/rist a root/rist
if (file_exists($maintenance = __DIR__ . '/../../rist/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
// Path aggiornata da public_html/rist a root/rist
require __DIR__ . '/../../rist/vendor/autoload.php';

// Bootstrap Laravel and handle the request...
// Path aggiornata da public_html/rist a root/rist
/** @var Application $app */
$app = require_once __DIR__ . '/../../rist/bootstrap/app.php';

// ISTRUZIONE FONDAMENTALE PER NETSONS
// Spiega a Laravel che la nuova "public path" corrisponde a QUESTA directory (public_html/rist)
$app->usePublicPath(__DIR__);

$app->handleRequest(Request::capture());
