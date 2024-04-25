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
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddlware::class,
            'parents' =>  \App\Http\Middleware\Parents::class,
            'student' =>  \App\Http\Middleware\Student::class,
            'teacher' => \App\Http\Middleware\Teacher::class


        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();