<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Session;
use Symfony\Component\HttpFoundation\Response;

class WebAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (Auth::user()->status == "active") {
                return $next($request);
            } else {
                Auth::logout();
                Session::flash("deletionProcessMessage", "Your Account Is Undergoing Deletion Process");
                return response()->view("auth.login");
            }
        } else {
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 401,
                    'status' => "Failed",
                    'message' => 'User is not authenticated',
                ],
            ], 401);
        }
    }
}
