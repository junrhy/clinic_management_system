<?php

namespace App\Http\Middleware;

use Closure;

class IsPatient
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
        if(auth()->user()->isPatient()) {
            return $next($request);
        }
        
        if (auth()->user()->type == 'admin') {
            return redirect('admin');
        } elseif (auth()->user()->type == 'default') {
            return redirect('home');
        }
    }
}
