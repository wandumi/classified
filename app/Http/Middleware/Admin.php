<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user() && Auth::user()->is_admin == 1) {
            return $next($request);
        }

        return response([
            'message' => 'You dont\'t have permission to perform this action',
        ], 403);
    }
}
