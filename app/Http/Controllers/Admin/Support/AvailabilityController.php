<?php namespace App\Http\Controllers\Admin\Support;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AvailabilityController extends Controller {

	public function index()
	{
		/**
		 * Webservices
		 */
		$config_services = config('services');
		$services = [];

		foreach ($config_services as $name => $data) {
			if (isset($data['baseuri'])) {
				$services[] = [
					'name' => $name,
					'endpoint' => $data['baseuri'],
				];
			}
		}

		/**
		 * Bases de datos
		 */
		$config_db = config('database.connections');
		$dbs = [];

		foreach ($config_db as $name => $data) {
			if (isset($data['host'])) {
				$dbs[] = [
					'name'     => $name,
					'driver'   => $data['driver'],
					'host'     => $data['host'],
					'database' => $data['database'],
					'username' => $data['username'],
				];
			}
		}

		return view('admin.support.availability.index')
			->with('services', $services)
			->with('dbs', $dbs)
		;
	}
}
