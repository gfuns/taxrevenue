<?php

namespace App\Http\Middleware;

use App\Models\GeneralSettings;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateWebKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->header('XGW-KEY') == null) {
            return response()->json([
                "response" => [
                    'status_code' => (int) 412,
                    'status' => "Failed",
                    'message' => 'Please Provide Application Key',
                ],
            ], 412);
        } elseif ($request->header('XGW-KEY') != GeneralSettings::appWeb()->setting_value) {
            return response()->json([
                "response" => [
                    'status_code' => (int) 412,
                    'status' => "Failed",
                    'message' => 'Invalid Application Key',
                ],
            ], 412);
        } else {
            if (Auth::check()) {
                if (Auth::user()->status == "suspended") {
                    return response()->json([
                        "response" => [
                            'status_code' => (int) 403,
                            'status' => "Failed",
                            'message' => 'This account has been suspended',
                        ],
                    ], 403);
                } elseif (Auth::user()->status == "banned") {
                    return response()->json([
                        "response" => [
                            'status_code' => (int) 403,
                            'status' => "Failed",
                            'message' => 'This account has been banned',

                        ],
                    ], 403);
                } elseif (Auth::user()->status == "deleted") {
                    return response()->json([
                        "response" => [
                            'status_code' => (int) 404,
                            'status' => "Failed",
                            'message' => 'We could not find a user with these credentials on our records',
                        ],
                    ], 404);
                }
            }

            return $next($request);
        }
    }

    // ->header('Access-Control-Allow-Origin', '*')
}
