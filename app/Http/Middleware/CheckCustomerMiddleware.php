<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckCustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $scope): Response
    {
        $customer = Auth::guard('api-customer')->user();
        if ($customer && $customer->tokenCan($scope)) {
            return $next($request);
        }
        return response()->json([
            'error' => 'You do not access this page.'
        ], 401);
    }
}
