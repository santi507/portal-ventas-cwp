<?php namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;
use GuzzleHttp\Client;
use Exception;

class AvailabilityController extends Controller
{
	public function index()
	{
		return response()->json([
			'success' => 'true',
		]);
	}

	public function check($type)
	{
		if ($type == 'service') {
			$success = $this->checkService(request('name'));
		} else if ($type == 'db') {
			$success = $this->checkDatabase(request('name'));
		}

		return response()->json([
			'success' => $success,
		]);
	}

	public function checkService($name) {
		$success = null;
		$endpoint = config('services.' . $name . '.baseuri');

		try {
			$client = new Client();
			$request = $client->request('GET', $endpoint);
			$success = true;
		} catch (RequestException $ex) {
			if ($call = $ex->getResponse()) {
				$code = $call = $ex->getResponse()->getStatusCode();

				if ($code >= 500 && $code <= 599) {
					$success = false;
				} else {
					$success = true;
				}
			} else {
				$success = false;
			}
		}

		return $success;
	}

	public function checkDatabase($name) {
		$success = null;

		try {
			app('db')->connection($name)->getPdo();
			$success = true;
		} catch (Exception $ex) {
			$success = false;
		}

		return $success;
	}
}