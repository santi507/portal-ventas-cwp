<?php

Route::group(['prefix' => 'v1'], function() {
	Route::get('/', ['as' => 'index', 'uses' => 'DefaultServiceController@index']);

	Route::group(['prefix' => 'availability'], function() {
		Route::get('/', ['as' => 'availability.index', 'uses' => 'AvailabilityController@index']);
		Route::post('check/{type}', ['as' => 'availability.check', 'uses' => 'AvailabilityController@check']);
	});
});