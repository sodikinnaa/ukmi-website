<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Set PHP ini untuk support upload file besar (200MB) - HARUS di set sebelum autoload
if (function_exists('ini_set')) {
    @ini_set('upload_max_filesize', '200M');
    @ini_set('post_max_size', '200M');
    @ini_set('max_execution_time', '300');
    @ini_set('max_input_time', '300');
}

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
