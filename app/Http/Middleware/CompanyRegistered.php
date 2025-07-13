<?php
namespace App\Http\Middleware;

use App\Models\Company;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompanyRegistered
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $company = Company::where("user_id", Auth::user()->id)->where("status", "approved")->first();
            if (isset($company) && ! empty($company)) {
                return $next($request);
            } else {
                toast('This process is only allowed for approved contractors.', 'error');
                return redirect()->route("business.dashboard");
            }
        } else {
            return response()->view("auth.login");
        }
    }
}
