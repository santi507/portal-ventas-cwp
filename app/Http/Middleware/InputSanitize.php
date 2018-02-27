<?php namespace App\Http\Middleware;

use Closure;
use Request;

class InputSanitize {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$this->trimInput();

		return $next($request);
	}

	public function trimInput()
	{
		Request::merge(
			self::array_map_recursive(
				"trim",
				array_except(
					Request::all(),
					["password"]
				)
			)
		);
	}

	public function array_map_recursive($callback, $array)
	{
	    foreach ($array as $key => $value) {
	        if (is_array($array[$key])) {
	            $array[$key] = self::array_map_recursive($callback, $array[$key]);
	        } else {
	            $array[$key] = call_user_func($callback, $array[$key]);
	        }
	    }

	    return $array;
	}

}