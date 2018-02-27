<?php namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class DefaultServiceController extends Controller
{
	public function index()
	{
		return response()->json(['success' => 'true']);
	}
}