<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateIssueRequest extends Request {

	protected $dontFlash = ['attachment'];

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
			'summary'     => 'required',
			'reference'   => 'required',
			'description' => 'required|min:5',
			'attachment'  => 'max:20480',
		];
	}

}
