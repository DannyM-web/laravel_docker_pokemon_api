<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()) {

            if (!Auth::user()->hasRoles('admin')) {

                if (!$request->user()->hasStatus('accepted')) {

                    return redirect()->route('queue');
                }
            }
        }
        return $next($request);
    }
}
