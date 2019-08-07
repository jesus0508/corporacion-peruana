<?php

namespace CorporacionPeru\Http\Middleware;

use Closure;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $user=Auth::user();
        if($user->isAdmin()){
            return $next($request);
        }
        return redirect('home');
    }
}
