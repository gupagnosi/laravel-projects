<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\DB;

use Closure;

class RestricaoMiddleware
{
    
    public function handle($request, Closure $next)
    {
        if ($request->session()->exists('usuario')) {            
           return $next($request);
        }
        return redirect('/login');
        
    }
}
