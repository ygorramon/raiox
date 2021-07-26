<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class AuthClient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
              if (Auth::guard($guard)->check() == false) {
          switch ($guard) {
            case 'clients':
              return redirect('/login');
              break;
            
          }
        }

        return $next($request);
    }
}
