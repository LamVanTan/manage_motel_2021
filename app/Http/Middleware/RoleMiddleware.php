<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class RoleMiddleware
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
        if(!Auth::check()){  
            return redirect()->route('motel.auth.login');
        } else{
          $permission = Auth::user()->permission;
          if($permission !=1){
              return redirect()->route('motel.index.index');
          }
        }  
        return $next($request);
    }
}
