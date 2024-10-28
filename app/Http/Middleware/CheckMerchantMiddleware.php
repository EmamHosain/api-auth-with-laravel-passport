<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckMerchantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $scope): Response
    {
        $merchant = Auth::guard('api-merchant')->user();
        if ($merchant && $merchant->tokenCan($scope)) {
            return $next($request);
        }
        return response()->json([
            'error' => 'You do not access this page.'
        ], 401);
    }
}
