<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Session\Store;

class SessionTimeout {
	protected $session;

	public function __construct(Store $session){
		$this->session = $session;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$timeout = app('config')->get('session.lifetime')*60;

		if ( ! $this->session->has('lastActivityTime') ) {
			$this->session->put('lastActivityTime', time());
		} else if(time() - $this->session->get('lastActivityTime') > $timeout) {
			$this->session->forget('lastActivityTime');
			$this->session->flush();
			return redirect()->route('admin.login')->with(['warning' => 'Usted ha sido desconectado por inactividad. Por favor, vuelva a iniciar sesión.']);
		}

		$this->session->put('lastActivityTime', time());
		return $next($request);
	}

}