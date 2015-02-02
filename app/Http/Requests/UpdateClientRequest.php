<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateClientRequest extends Request {

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
			'type' => 'required',
			'name' => 'required|min:3|unique:clients,name,'.$this->segment(3),
			'stub' => 'required|min:3|alpha_dash|unique:clients,stub,'.$this->segment(3)
		];
	}

}
