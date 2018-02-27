<?php namespace App\Http\Middleware;

use Closure;

class LdapAuth {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if ( ! session()->has('admin-auth') ) {
			return redirect()->route('admin.login');
		}

		return $next($request);
	}

}