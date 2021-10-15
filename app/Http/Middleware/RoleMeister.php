<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class RoleMeister
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,string $roles)
    {
        if(Auth::check()){
            if(Auth::user()->role != $roles || Auth::user()->role != 'admin'){
                abort(404);
            }
            return $next($request);
        }else{
            return redirect('/login');
        }
    }
}
