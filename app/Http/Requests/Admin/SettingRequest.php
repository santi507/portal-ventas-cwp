<?php namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class SettingRequest extends Request {

	public function authorize()
	{
		return true;
	}

	public function rules()
	{
        $id = $this->setting;

        switch($this->method())
        {
            case 'GET': //Al ver
            case 'DELETE': //Al eliminar
            {
                return [];
            }
            case 'POST': //Al crear
            {
                return [
                    'option_name'  => 'required|unique:Settings',
                    'option_value' => 'required'
                ];
            }
            case 'PUT': //Al actualizar
            case 'PATCH': // Al actualizar
            {
                return [
                    'option_value' => 'required'
                ];
            }
            default:break;
        }

		return [

		];
	}

	public function messages()
	{
		return [
            'option_name.required'  => 'Debe introducir un nombre de parámetro.',
            'option_name.unique'    => 'Este nombre de parámetro ya ha sido registrado previamente.',
            'option_value.required' => 'Debe introducir un valor para el parámetro.'
		];
	}

}
