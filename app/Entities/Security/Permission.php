<?php
namespace App\Entities\Security;
use App\Entities\BaseModel;

class Permission extends BaseModel
{
	protected $table = 'Permissions';
	protected $primaryKey = 'IDPermissions';

	public function roles() {
		return $this->belongsToMany(
			'App\Entities\Security\Role',
			'Permissions_Roles',
			'FK_IDPermissions',
			'FK_IDRoles'
		);
	}
}