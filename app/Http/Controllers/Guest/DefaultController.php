<?php namespace App\Http\Controllers\Guest;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DefaultController extends Controller {

	public function index()
	{
		return view('guest.default.index');
	}
}
