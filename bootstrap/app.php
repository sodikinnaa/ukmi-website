<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
            'permission' => \App\Http\Middleware\PermissionMiddleware::class,
        ]);
        
        // Replace ValidatePostSize dengan custom middleware untuk support upload 200MB
        $middleware->replace(
            \Illuminate\Http\Middleware\ValidatePostSize::class,
            \App\Http\Middleware\CustomValidatePostSize::class
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
