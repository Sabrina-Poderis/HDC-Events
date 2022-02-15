<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotUser
{

	public function handle($request, Closure $next, $guard = 'user')
	{
	    if (!Auth::guard($guard)->check()) {
	        return redirect('/');
	    }

	    return $next($request);
	}
}