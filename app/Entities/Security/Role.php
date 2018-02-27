<?php
namespace App\Entities\Security;
use App\Entities\BaseModel;

class Role extends BaseModel
{
	protected $table = 'Roles';
	protected $primaryKey = 'IDRoles';
	public $timestamps = false;

	public function permissions() {
		return $this->belongsToMany(
			'App\Entities\Security\Permission',
			'Permissions_Roles',
			'FK_IDRoles',
			'FK_IDPermissions'
		);
	}
}