<?php

use App\Http\Middleware\CheckCustomerMiddleware;
use App\Http\Middleware\CheckMerchantMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {


            Route::middleware(['api'])
                ->prefix('api/merchant')
                ->group(base_path('routes/merchant.php'));

                
            Route::middleware(['api'])
                ->prefix('api/customer')
                ->group(base_path('routes/customer.php'));
        }
    )

    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'customer' => CheckCustomerMiddleware::class,
            'merchant' => CheckMerchantMiddleware::class,
        ]);
    })

    ->withExceptions(function (Exceptions $exceptions) {
    })->create();
