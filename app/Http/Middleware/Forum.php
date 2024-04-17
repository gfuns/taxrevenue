<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ForumCategories;
use App\Models\ForumTopics;
class Forum
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        view()->composer('*', function ($view) {
            $forumCategories = ForumCategories::all();
            $topTopics = ForumTopics::orderBy("id", "asc")->limit(4)->get();
            $otherTopics = ForumTopics::orderBy("id", "asc")->skip(4)->take(50)->get();

            $view->with(['forumCategories' => $forumCategories, "topTopics" => $topTopics, "otherTopics" => $otherTopics]);
        });

        return $next($request);
    }
}
