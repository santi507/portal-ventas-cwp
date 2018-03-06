<?php

/**
 * Login
 */
Route::get('login', [
	'as'   => 'login',
	'uses' => 'AuthController@login' 
]);

Route::post('login', [
	'as'   => 'login',
	'uses' => 'AuthController@do_static_login'
	// 'uses' => 'AuthController@do_hybrid_login'
]);

Route::group(['middleware' => ['auth.ldap', 'acl', 'session_timeout']], function() {
	Route::get('logout', [
		'as'   => 'logout',
		'uses' => 'AuthController@logout'
	]);

	Route::get('/',  [
		'as' => 'index',
		'uses' => 'DashboardController@index'
	]);

	/**
	 * Módulo de roles y permisos
	 */
	Route::group([
		'prefix' => 'access',
		'permission' => 'manage_access'
	], function() {
		Route::group(['prefix' => 'roles'], function() {
			Route::get('/', ['as' => 'access', 'uses' => 'AccessController@index']);
			Route::get('add', ['as' => 'access.create', 'uses' => 'AccessController@roles_add']);
			Route::post('add', ['as' => 'access.store', 'uses' => 'AccessController@roles_add_do']);
			Route::get('{role_id}/edit', ['as' => 'access.edit', 'uses' => 'AccessController@roles_edit']);
			Route::put('{role_id}/edit', ['as' => 'access.update', 'uses' => 'AccessController@roles_update']);
			Route::delete('{role_id}', ['as' => 'access.destroy', 'uses' => 'AccessController@roles_destroy']);
		});

		Route::group(['prefix' => 'permissions'], function() {
			Route::get('{permission_id}', ['as' => 'access.permission.show', 'uses' => 'AccessController@viewPermission']);
			Route::get('/', ['as' => 'access.permission', 'uses' => 'AccessController@indexPermissions']);
		});
	});

	/**
	 * Módulo de auditoría
	 */
	Route::group([
		'prefix' => 'audit',
		'permission' => 'audit'
	], function() {
		Route::get('/', ['as' => 'audit', 'uses' => 'AuditController@index']);
	});

	/**
	 * CRUD de Settings
	 */
	Route::group(['permission' => 'manage_settings'], function() {
		Route::resource('settings', 'SettingController', [
			'names' => [
				'index'  => 'settings',
				'create' => 'settings.create',
				'store'  => 'settings.store',
				'show'   => 'settings.show',
				'edit'   => 'settings.edit',
				'update' => 'settings.update',
				'destroy' => 'settings.destroy'
			]
		]);
	});

	/**
	 * =============================================
	 * [Support] Módulo de soporte
	 * =============================================
	 */
	Route::group([
		'permission' => 'support',
		'prefix' => 'support',
		'namespace' => 'Support'
	], function() {

		/**
		 * =====================================
		 * Dashboard de soporte
		 * =====================================
		 */
		Route::get('/', ['as' => 'support', 'uses' => 'DashboardController@index']);

		/**
		 * =====================================
		 * Disponibilidad
		 * =====================================
		 */
		Route::group([
				'prefix' => 'availability',
				'permissions' => 'support'
			], function() {
			Route::get('/', [
				'as'   => 'support.availability',
				'uses' => 'AvailabilityController@index'
			]);
		});
	});

	/*VENDEDORES*/
	Route::group(['prefix' => 'vendedores'], function() {
	    
	    /*VENDEDORES DE TIENDA*/
	    Route::group(['prefix' => 'tienda'], function() {
	        
	        Route::get('/', [
	        	'as' => 'sellers.shop',
	        	'uses' => 'SellersController@getShopSellers'
	        ]);

	        Route::get('crear', [
	        	'as' => 'sellers.shop.create',
	        	'uses' => 'SellersController@addShopSellers'
	        ]);

	        Route::post('store', [
	        	'as' => 'sellers.shop.store',
	        	'uses' => 'SellersController@storeShopSellers'
	        ]);

	        Route::get('{id}/editar', [
	        	'as' => 'sellers.shop.edit',
	        	'uses' => 'SellersController@editShopSellers'
	        ]);

	        Route::post('{id}/update', [
	        	'as' => 'sellers.shop.update',
	        	'uses' => 'SellersController@updateShopSellers'
	        ]);

	        Route::delete('{id}/delete', [
	        	'as' => 'sellers.shop.delete',
	        	'uses' => 'SellersController@deleteShopSellers'
	        ]);

	    });

	});

	/*PRODUCTOS*/
	Route::group(['prefix' => 'productos'], function() {
	    
	    Route::get('/', [
	    	'as' => 'products',
	    	'uses' => 'ProductController@getProducts'
	    ]);

	    Route::get('/crear', [
	    	'as' => 'products.add',
	    	'uses' => 'ProductController@createProducts'
	    ]);

	    Route::post('/store', [
	    	'as' => 'products.store',
	    	'uses' => 'ProductController@storeProducts'
	    ]);

	    Route::get('{id}/editar', [
	    	'as' => 'products.edit',
	    	'uses' => 'ProductController@editProducts'
	    ]);

	    Route::post('{id}/update', [
	    	'as' => 'products.update',
	    	'uses' => 'ProductController@updateProducts'
	    ]);
	});

	Route::get('subcategory/{id}', [
	    'as' => 'subcategories',
	    'uses' => 'ProductController@getSubcategories'
	]);
});
