<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class LoginSystemMiddleware
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
            return redirect()->route('system.auth.login');
        } else{
          $permission = Auth::user()->permission;
          if($permission != 2){
              return redirect()->route('system.auth.login');
          }
        }  
        return $next($request);
    }
}
