<?php namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class AccessRequest extends Request {

	public function authorize()
	{
		return true;
	}

	public function rules()
	{
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'permissions' => 'required'
        ];

        return $rules;
	}

	public function messages()
	{
        return [
            'permissions.required' => 'Debe seleccionar al menos un permiso.'
        ];
	}

}
