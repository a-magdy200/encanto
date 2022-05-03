<?php

namespace App\Http\Middleware;

use App\Models\GymManager;
use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BannedUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Application|Factory|View
     */
    public function handle(Request $request, Closure $next): View|Factory|Application
    {
        $userId = auth()->user()->id;
        $gymManager = GymManager::find(['user_id', $userId]);
        if ($gymManager) {
            if ($gymManager->is_banned) {
                return view('gymmanagers.banned');
            } else {
                return $next($request);
            }
        }
        return $next($request);
    }
}
