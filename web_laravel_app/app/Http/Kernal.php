<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // ... other configurations

    protected $routeMiddleware = [
        // Other middleware...
        'auth.cookie' => \App\Http\Middleware\AuthenticateWithCookie::class,
    ];
}
