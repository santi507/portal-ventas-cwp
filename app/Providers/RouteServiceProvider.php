<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
	/**
	 * This namespace is applied to the controller routes in your routes file.
	 *
	 * In addition, it is set as the URL generator's root namespace.
	 *
	 * @var string
	 */
	protected $apiNamespace   = 'App\Http\Controllers\API';
	protected $adminNamespace = 'App\Http\Controllers\Admin';
	protected $guestNamespace = 'App\Http\Controllers\Guest';

	/**
	 * Define your route model bindings, pattern filters, etc.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function boot(Router $router)
	{
		//

		parent::boot($router);
	}

	/**
	 * Define the routes for the application.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function map(Router $router)
	{
		//API
		$router->group([
			'prefix'    => 'api',
			'as'        => 'api.',
			'namespace' => $this->apiNamespace
		], function ($router) {
			require app_path('Http/routes.api.php');
		});

		//ADMIN
		$router->group([
			'namespace' => $this->adminNamespace,
			'prefix'    => 'admin',
			'as'        => 'admin.'
		], function ($router) {
			require app_path('Http/routes.admin.php');
		});

		//GUEST
		$router->group([
			'namespace' => $this->guestNamespace
		], function ($router) {
			require app_path('Http/routes.php');
		});
	}
}
