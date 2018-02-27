<?php

Route::get('/', [
	'as' => 'index',
	'uses' => 'DefaultController@index'
]);