<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
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
        if (!$request->user()) {
            return redirect('/');
        }
        if (! $request-> user()->hasRoles('admin')) {
            return redirect('/');
        }

        return $next($request);
    }
}
