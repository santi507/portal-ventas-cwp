<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Entities\Security\Audit;

class AuditController extends Controller {

    public function index()
    {
        $order_id = request()->get('order_id');
        $user = request()->get('user');
        $role = request()->get('role');
        $module = request()->get('module');

        $logs = [];

        $logs = Audit::prepare();

        if ($user) {
            $logs = $logs->user($user);
        }

        if ($role) {
            $logs = $logs->role($role);
        }
        if ($module) {
            $logs = $logs->module($module);
        }

        if ($order_id) {
            $logs = $logs->order($order_id);
        }

        $total = count($logs->get());

        $logs = $logs->orderBy('created_at', 'DESC')->paginate(20);

        //Users
        $users = Audit::distinct()->select('user')->lists('user', 'user')->toArray();

        //Roles
        $roles = Audit::distinct()->select('role')->lists('role', 'role')->toArray();

        //Actividades
        $modules = Audit::distinct()->select('module')->lists('module', 'module')->toArray();

        return view('admin.audit.index')->with(compact('total', 'logs', 'users', 'roles', 'modules'));
    }
}
