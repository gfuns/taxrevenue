<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserSubscribed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->activePlan() != null) {
            return $next($request);
        } else {
            toast("You do not have an active subscription. Please subscribe to an Arete Plan.", 'error');
            return redirect()->route("business.dashboard");
        }
    }
}
