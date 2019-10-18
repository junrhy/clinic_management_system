<?php

namespace App\Http\Middleware;

use Closure;

class IsDefault
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
        if(auth()->user()->isDefault()) {
            return $next($request);
        }
        
        if (auth()->user()->type == 'admin') {
            return redirect('admin');
        } elseif (auth()->user()->type == 'patient') {
            return redirect('patient_view');
        }
    }
}
