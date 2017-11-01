<?php

namespace App\Http\Middleware;

use Closure;

class CheckRoles
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
        // Obtenemos todos los args pasados a handle
        $roles = func_get_args();
        // Eliminamos los 2 primeros argumentos ($request y $next)
        $roles = array_slice($roles, 2);
        
        if(auth()->user()->hasRoles($roles)){
            return $next($request);
        }
        return redirect('/');
    }
}
