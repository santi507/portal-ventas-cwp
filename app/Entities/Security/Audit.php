<?php
namespace App\Entities\Security;
use App\Entities\BaseModel;
use App\Entities\Warehouse\Order;

class Audit extends BaseModel
{
	protected $table = 'Audit';
	protected $primaryKey = 'IDAudit';
	public $timestamps = false;

	public static function log(
		$module,
		$action,
		$item_id=null,
		$context=null
	) {
		$audit = new Audit;
		$auth = app('App\Services\LdapAuth');

		$user = $auth->getCurrentUser();

		$audit->domain = isset($user['domain']) ? $user['domain'] : 'CWP';
		$audit->user = strtoupper($user['username']);
		$audit->role = $user['group'];
		$audit->ip = request()->getClientIp();
		$audit->module = $module;
		$audit->action = $action;
		if ($item_id) $audit->item_id = $item_id;
		if ($context) $audit->context = json_encode($context);

		$audit->save();
	}

	public function getCreatedAtAttribute($date)
	{	
		if (app('db')->connection()->getDriverName() == 'sqlsrv') {
			return \Carbon\Carbon::createFromFormat('M j Y h:i:s:uA', $date)->format('Y-m-d H:i:s');		
		} else {
			return $date;
		}
	}

	public function getPrettyContext() {
		$output = '';

		if ($this->context) {
			$context = json_decode($this->context);
			$output.= '<div><a href="javascript:void(0)" class="show-info">+ Mostrar detalle</a></div>';
			$output.= '<div class="info"><pre>'.print_r($context, true).'</pre></div>';
		}

		return $output;
	}

	public function scopePrepare($query) {
		return $query;
	}

	public function scopeUser($query, $user) {
		return $query->where('user', $user);
	}

	public function scopeRole($query, $role) {
		return $query->where('role', $role);
	}

	public function scopeModule($query, $module) {
		return $query->where('module', $module);
	}

	public function scopeOrder($query, $order_id) {
		$order = Order::where('id', $order_id)->first();

		if ($order) {
			return $query->where('item_id', $order->IDOrders);
		} else {
			return $query;
		}
	}
}