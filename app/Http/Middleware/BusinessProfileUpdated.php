<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BusinessProfileUpdated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (isset(Auth::user()->business->category_id) && isset(Auth::user()->business->business_name) && isset(Auth::user()->business->business_logo)) {
                return $next($request);
            } else {
                return new JsonResponse([
                    'response' => [
                        'message' => 'Request Failed',
                        'details' => 'Please go to settings and update your business information',
                    ],
                ], 400);
            }
        } else {
            return new JsonResponse([
                'response' => [
                    'message' => 'Request Failed',
                    'details' => 'User is not authenticated',
                ],
            ], 400);
        }
    }
}
