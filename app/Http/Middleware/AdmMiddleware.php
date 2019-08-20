<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class AdmMiddleware
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
        $output = $request->session()->get('usuario');
        $usuario = DB::table('usuarios')->where('login',$output['login'])->first();
        if($usuario->acesso_id === 1){
        return $next($request);
        }
        return redirect('/home');
    }
}
