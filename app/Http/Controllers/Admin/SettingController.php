<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use App\Entities\Setting;

class SettingController extends Controller {

	public function index()
	{
		$search = request()->get('search');

		if (!$search) {
			$params = Setting::orderBy('option_name', 'ASC')->paginate(20);
		} else {
			$params = Setting::where('option_name', 'LIKE', '%'.$search.'%')
				->orWhere('option_value', 'LIKE', '%'.$search.'%')
				->orderBy('option_name', 'ASC')->paginate(20);
		}

		return view('admin.settings.index')->with('params', $params);
	}

	public function create()
	{
		return view('admin.settings.create');
	}

	public function store(SettingRequest $request)
	{
		app('db')->beginTransaction();

		$param = new Setting();
		$param->option_name = request('option_name');
		$param->option_value = request('option_value');
		$param->save();

		app('audit')->log('Setting', 'New', $param->option_name, [
			'new' => $param->toArray()
		]);

		app('db')->commit();

		return redirect(route('admin.settings').'?search='.$param->option_name)->with('success', 'Parámetro "'.$param->option_name.'" registrado exitosamente.');
	}

	public function edit($id)
	{
		$configuration = Setting::where('option_name', $id)->first();
		return view('admin.settings.edit')->with('configuration', $configuration);
	}

	public function update($id, SettingRequest $request)
	{
		app('db')->beginTransaction();
		$configuration        = Setting::where('option_name', $id)->first();
		$old_configuration    = clone $configuration;
		$configuration->option_value = request('option_value');

		if ($configuration->isDirty()) {
			$configuration->save();

			app('audit')->log('Configuration', 'Update', $configuration->option_name, [
				'old' => $old_configuration->toArray(),
				'new' => $configuration->toArray()
			]);

			app('db')->commit();
			return redirect(route('admin.settings').'?search='.$configuration->option_name)->with('success', 'El parámetro de configuración "'.$configuration->option_name.'" ha sido actualizado exitosamente.');
		} else {
			app('db')->rollback();
			return redirect()->route('admin.settings.edit', $id)->with('warning', 'No se realizó ningún cambio.');
		}
	}

	public function destroy($id)
	{
        $param = Setting::where('option_name', $id)->first();

		app('db')->beginTransaction();
        $old_param = clone $param;
		$param->delete();

		app('audit')->log('Configuration', 'Delete', $param->option_name, [
			'old' => $old_param->toArray()
		]);

		app('db')->commit();

        return redirect()->route('admin.settings')->with('success', 'El parámetro "'.$old_param->option_name.' ha sido eliminado exitosamente.');
	}
}
