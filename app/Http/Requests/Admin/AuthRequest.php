<?php namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use Illuminate\Validation\Validator;
use Illuminate\Support\MessageBag;

class AuthRequest extends Request {

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
		return [
			'domains'   => 'required',
			'username' => 'required',
			'password' => 'required'
		];
	}
}
