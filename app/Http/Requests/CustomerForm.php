<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CustomerForm extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
        $id = $this->customers;

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
					'code'     => 'required|unique:Customers',
					'name'     => 'required',
					'email'    => 'required|email|unique:Customers',
					'celphone' => 'required|unique:Customers'
                ];
            }
            case 'PUT': //Al actualizar
            case 'PATCH': // Al actualizar
            {
                return [
					'code'     => 'required|unique:Customers,code,'.$id.',IDCustomers',
					'name'     => 'required',
					'email'    => 'required|email|unique:Customers,email,'.$id.',IDCustomers',
					'celphone' => 'required|unique:Customers,celphone,'.$id.',IDCustomers'
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
			'code.required'     => 'El campo "Código" es requerido',
			'code.unique'       => 'Ya existe un cliente con el mismo código.',
			'name.required'     => 'El campo "Nombre" es requerido',
			'email.required'    => 'El campo "Email" es requerido',
			'email.email'       => 'Debe introducir un email válido',
			'email.unique'      => 'Ya existe un cliente con el mismo email',
			'celphone.required' => 'El campo "Celphone" es requerido',
			'celphone.unique'   => 'Ya existe un cliente con el mismo celular.'
		];
	}

}
