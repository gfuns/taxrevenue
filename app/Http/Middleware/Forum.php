<?php

namespace App\Http\Middleware;

use App\Models\ForumCategories;
use App\Models\ForumPosts;
use App\Models\ForumTopics;
use App\Models\PostComments;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
            $postsThisMonth = ForumPosts::whereRaw('YEAR(created_at) = YEAR(CURDATE())')
                ->whereRaw('MONTH(created_at) = MONTH(CURDATE())')
                ->count();
            $conversations = PostComments::where("comment_type", "main")->count();
            $totalReplies = PostComments::where("comment_type", "reply")->count();
            $totalTopics = ForumTopics::count();

            $authStatus = false;
            if (Auth::user()) {
                $authStatus = true;
            }

            $view->with([
                'forumCategories' => $forumCategories,
                "topTopics" => $topTopics,
                "otherTopics" => $otherTopics,
                "authStatus" => $authStatus,
                "postsThisMonth" => $postsThisMonth,
                "conversations" => $conversations,
                "totalTopics" => $totalTopics,
                "totalReplies" => $totalReplies,
            ]);
        });

        return $next($request);
    }
}
