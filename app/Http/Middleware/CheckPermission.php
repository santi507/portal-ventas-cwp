<?php namespace App\Http\Middleware;

use Closure;

class CheckPermission {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$data = $request->route()->getAction();

		if (isset($data['permission'])) {
			$auth = app('App\Services\LdapAuth');

			if (!$auth->can($data['permission'])) {
				echo 'No tiene permisos suficientes para realizar esta acción.';
				exit;
			}
		}

		return $next($request);
	}

}