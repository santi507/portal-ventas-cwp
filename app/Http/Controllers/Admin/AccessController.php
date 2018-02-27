<?php
namespace App\Http\Controllers\Admin;

use App\Entities\Security\Role;
use App\Entities\Security\PermissionGroup;
use App\Entities\Security\Permission;
use App\Services\LdapAuth As Auth;
use App\Http\Requests\Admin\AccessRequest;
use App\Http\Controllers\Controller;
use Request;
use Validator;
use Redirect;

class AccessController extends Controller {
	private $auth;

	public function __construct(Auth $auth)
	{
		$this->auth = $auth;
	}

	public function index()
	{
		$roles = Role::all();
		return view('admin.access.roles.index')->with('roles', $roles);
	}

	public function roles_edit($id)
	{
		$role        = Role::find($id);
		$permissions = Permission::all();
		return view('admin.access.roles.edit')->with(compact('role', 'permissions'));
	}

	public function roles_update(AccessRequest $request, $role_id)
	{
		$name        = request('name', null);
		$description = request('description', null);


		$role              = Role::find($role_id);
		$role->name        = $name;
		$role->description = $description;
		$role->save();
		$role->permissions()->sync(request('permissions', []));

		return redirect()->route('admin.access')->with('success', 'El rol ha actualizado exitosamente');
	}

	public function roles_add()
	{
		$permissions = Permission::all();
		return view('admin.access.roles.add')->with('permissions', $permissions);
	}

	public function roles_add_do(AccessRequest $request)
	{
		$name        = request('name', null);
		$description = request('description', null);

		$role              = new Role();
		$role->name        = $name;
		$role->description = $description;
		$role->save();

		$role->permissions()->sync(request('permissions', []));

		return redirect()->route('admin.access')->with('success', 'El rol "'.$name.'" ha sido creado exitosamente');
	}

	public function roles_destroy($id)
	{
		try {
			app('db')->beginTransaction();
			$role = Role::findOrFail($id);
			$role->permissions()->sync(request('permissions', []));
			$role->delete();
			app('db')->commit();
			return redirect()->route('admin.access')->with('success', 'El rol ha sido eliminado exitosamente');
		} catch(Exception $ex) {
			app('db')->rollBack();
			return redirect()->route('admin.access')->with('error', 'Ha ocurrido un error inesperado. Favor contactar al administrador.');
		}
	}

	public function indexPermissions()
	{
		$permissions = Permission::all();
		return view('admin.access.permissions.index')->with(compact('permissions'));
	}

	public function viewPermission($permission_id)
	{
		$permission = Permission::find($permission_id);
		$superadmin = $this->getSuperAdmins();

		return view('admin.access.permissions.show')->with(compact('permission', 'superadmin'));
	}

	public function getSuperAdmins()
	{
		$roles = Permission::where('name', 'superadmin')->first()->roles()->get();
		return $roles;
	}
}
