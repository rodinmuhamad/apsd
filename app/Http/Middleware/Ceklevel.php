<?php

namespace App\Http\Middleware;

use Closure;

class Ceklevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($r, Closure $next, ...$levels)
    {
        if (in_array($r->user()->level,$levels)) {
            return $next($r);
        }
        return redirect('/login');
    }
}
