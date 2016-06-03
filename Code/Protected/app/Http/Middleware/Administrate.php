<?php namespace Podobri\Http\Middleware;

use Closure;
use Auth;

class Administrate
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
       if ( Auth::user()->is_admin != 1 ) {
           abort(404);
        } 
        
       return $next($request);
    }
}
