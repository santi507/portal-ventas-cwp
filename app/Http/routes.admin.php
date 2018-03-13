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

	    /*VENDEDORES DE CALL CENTER*/
	    Route::group(['prefix' => 'callcenter'], function() {
	        
	        Route::get('/', [
	        	'as' => 'sellers.callcenter',
	        	'uses' => 'SellersController@getCallCenterSellers'
	        ]);

	        Route::get('crear', [
	        	'as' => 'sellers.callcenter.create',
	        	'uses' => 'SellersController@addCallCenterSellers'
	        ]);

	        Route::post('store', [
	        	'as' => 'sellers.callcenter.store',
	        	'uses' => 'SellersController@storeCallCenterSellers'
	        ]);

	        Route::get('{id}/editar', [
	        	'as' => 'sellers.callcenter.edit',
	        	'uses' => 'SellersController@editCallCenterSellers'
	        ]);

	        Route::post('{id}/update', [
	        	'as' => 'sellers.callcenter.update',
	        	'uses' => 'SellersController@updateCallCenterSellers'
	        ]);

	        Route::delete('{id}/delete', [
	        	'as' => 'sellers.callcenter.delete',
	        	'uses' => 'SellersController@deleteCallCenterSellers'
	        ]);

	    });

	    /*VENDEDORES DE D2D*/
	    Route::group(['prefix' => 'd2d'], function() {
	        
	        Route::get('/', [
	        	'as' => 'sellers.d2d',
	        	'uses' => 'SellersController@getD2DSellers'
	        ]);

	        Route::get('crear', [
	        	'as' => 'sellers.d2d.create',
	        	'uses' => 'SellersController@addD2DSellers'
	        ]);

	        Route::post('store', [
	        	'as' => 'sellers.d2d.store',
	        	'uses' => 'SellersController@storeD2DSellers'
	        ]);

	        Route::get('{id}/editar', [
	        	'as' => 'sellers.d2d.edit',
	        	'uses' => 'SellersController@editD2DSellers'
	        ]);

	        Route::post('{id}/update', [
	        	'as' => 'sellers.d2d.update',
	        	'uses' => 'SellersController@updateD2DSellers'
	        ]);

	    });

	    /*VENDEDORES DE D2D-CH*/
	    Route::group(['prefix' => 'd2d-ch'], function() {
	        
	        Route::get('/', [
	        	'as' => 'sellers.d2dch',
	        	'uses' => 'SellersController@getD2DCHSellers'
	        ]);

	        Route::get('crear', [
	        	'as' => 'sellers.d2dch.create',
	        	'uses' => 'SellersController@addD2DCHSellers'
	        ]);

	        Route::post('store', [
	        	'as' => 'sellers.d2dch.store',
	        	'uses' => 'SellersController@storeD2DCHSellers'
	        ]);

	        Route::get('{id}/editar', [
	        	'as' => 'sellers.d2dch.edit',
	        	'uses' => 'SellersController@editD2DCHSellers'
	        ]);

	        Route::post('{id}/update', [
	        	'as' => 'sellers.d2dch.update',
	        	'uses' => 'SellersController@updateD2DCHSellers'
	        ]);

	    });

	    /*VENDEDORES DE SOHO*/
	    Route::group(['prefix' => 'soho'], function() {
	        
	        Route::get('/', [
	        	'as' => 'sellers.soho',
	        	'uses' => 'SellersController@getSohoSellers'
	        ]);

	        Route::get('crear', [
	        	'as' => 'sellers.soho.create',
	        	'uses' => 'SellersController@addSohoSellers'
	        ]);

	        Route::post('store', [
	        	'as' => 'sellers.soho.store',
	        	'uses' => 'SellersController@storeSohoSellers'
	        ]);

	        Route::get('{id}/editar', [
	        	'as' => 'sellers.soho.edit',
	        	'uses' => 'SellersController@editSohoSellers'
	        ]);

	        Route::post('{id}/update', [
	        	'as' => 'sellers.soho.update',
	        	'uses' => 'SellersController@updateSohoSellers'
	        ]);

	    });

	    /*VENDEDORES DE PROMOTORES*/
	    Route::group(['prefix' => 'promotores'], function() {
	        
	        Route::get('/', [
	        	'as' => 'sellers.promoter',
	        	'uses' => 'SellersController@getPromoterSellers'
	        ]);

	        Route::get('crear', [
	        	'as' => 'sellers.promoter.create',
	        	'uses' => 'SellersController@addPromoterSellers'
	        ]);

	        Route::post('store', [
	        	'as' => 'sellers.promoter.store',
	        	'uses' => 'SellersController@storePromoterSellers'
	        ]);

	        Route::get('{id}/editar', [
	        	'as' => 'sellers.promoter.edit',
	        	'uses' => 'SellersController@editPromoterSellers'
	        ]);

	        Route::post('{id}/update', [
	        	'as' => 'sellers.promoter.update',
	        	'uses' => 'SellersController@updatePromoterSellers'
	        ]);

	    });

	});

	/*ADMIN PRODUCTOS*/
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

	/*ADMIN TIENDAS*/
	Route::group(['prefix' => 'tiendas'], function() {
	    
	    Route::get('/', [
	    	'as' => 'shops',
	    	'uses' => 'ShopController@getShops'
		]);

		Route::get('/crear', [
	    	'as' => 'shops.create',
	    	'uses' => 'ShopController@createShops'
	    ]);

		Route::get('{id}/edit', [
	    	'as' => 'shops.edit',
	    	'uses' => 'ShopController@editShops'
		]);
	
	});

	/* METAS */
	Route::group(['prefix' => 'metas'], function() {
	    
	    Route::group(['prefix' => 'tienda'], function() {

	    	Route::get('/', [
		    	'as' => 'goal.shops',
		    	'uses' => 'GoalController@shop'
			]);
	        /* FORMATO */
	        Route::group(['prefix' => 'vendedores'], function() {
	            
	            Route::get('formato', [
	            	'as' => 'goal.shops.sellers.format',
	            	'uses' => 'GoalController@getFormatShopSeller'
	            ]);

	            Route::post('cargar', [
	                'as' => 'goal.shops.sellers.load',
	            	'uses' => 'GoalController@loadShopSeller'
	            ]);
	        });

	    });
	});

	/*REPORTES*/
	Route::group(['prefix' => 'reportes'], function() {
	    
	   	Route::group(['prefix' => 'tienda'], function() {
	   	    
	   	    Route::get('/', [
	   	    	'as' => 'reports.shop',
	   	    	'uses' => 'ReportController@indexShop'
	   	    ]);

	   	    Route::group(['prefix' => 'fijo'], function() {
	   	        Route::get('vendedor/{nt}', [
	   	        	'as' => 'reports.shop.fixed.seller',
	   	        	'uses' => 'ReportController@fixedShopSeller'
	   	        ]);
	   	        Route::post('vendedor/{nt}', [
	   	        	'as' => 'reports.shop.movil.seller',
	   	        	'uses' => 'ReportController@fixedShopSeller'
	   	        ]);
	   	    });

	   	    Route::group(['prefix' => 'movil'], function() {
	   	        Route::get('vendedor/{nt}', [
	   	        	'as' => 'reports.shop.movil.seller',
	   	        	'uses' => 'ReportController@movilShopSeller'
	   	        ]);

	   	    });

	   	});
	
	});
});
