<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

Use PHPOpenSourceSaver\JWTAuth\Http\Middleware\Authenticate;

use Illuminate\Support\Facades\Route;


if (!function_exists('mapRoutes')) {
    function mapRoutes()
    {
       
        app('log')->info("Loading routes...");

        $routes = [
            'auth'    => '/../routes/auth/auth.php',
            'tasks'   => '/../routes/tasks/tasks.php',
            'default' => '/../routes/default.php',
        ];

        foreach ($routes as $prefix => $routeFile) {
            $fullPath = __DIR__ . $routeFile;

            if (!file_exists($fullPath)) {
                app('log')->error("Route file missing: " . $fullPath);
                continue; 
            }

            Route::prefix($prefix === 'default' ? '' : $prefix)->group(function () use ($fullPath) {
                app('log')->info("Loading route file: " . $fullPath);
                require $fullPath;
            });
        }
    }
}




return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            require __DIR__.'/../routes/graphql.php';
            Route::middleware('api')
                ->group(function () {
                    mapRoutes();
                    app('log')->info('Routes loaded successfully');
                });
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        // app('log')->info('Middleware loading...');
        $middleware->alias([
            'jwt.auth' => Authenticate::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        app('log')->info('Exception handling initialized');

    })->create();
