<?php namespace App\Entities;

use App\Entities\BaseModel;

class Setting extends BaseModel {

	protected $table = 'Settings';
	protected $primaryKey = 'option_name';
	public $timestamps = false;
	public $incrementing = false;

	public static function get($option_name)
	{
		$option = self::find($option_name);

		if ($option) {
			return $option->option_value;
		} else {
			return '';
		}
	}

	public static function set($option_name, $option_value)
	{
		$option = self::find($option_name);
		$option->option_value = $option_value;
		$option->save();

		return true;
	}
}