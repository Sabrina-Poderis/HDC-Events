<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotUser
{

	public function handle($request, Closure $next, $guard = 'user')
	{
	    if (!Auth::guard($guard)->check()) {
	        return redirect('/')->with('error',"Não foi possível efetuar o login");
	    }

	    return $next($request);
	}
}