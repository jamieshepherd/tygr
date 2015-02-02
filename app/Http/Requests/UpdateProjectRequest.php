<?php namespace App\Http\Requests;

use App\Client;
use App\Http\Requests\Request;

class UpdateProjectRequest extends Request {

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
		$client = Client::where('stub', '=', $this->segment(2))->first();

		return [
			'name'				     => 'required|min:3',
			//'stub' 					 => 'required|alpha_dash|min:3|unique:projects,stub,NULL,id,client_id,'.$client->id,
			'current_version' 		 => 'required',
			'status' 				 => 'required|min:3',
			'authoring_tool' 		 => '',
			'lms_deployment' 		 => '',
			'lms_specification' 	 => '',
			'project_manager' 		 => '',
			'lead_developer' 		 => '',
			'lead_designer' 		 => '',
			'instructional_designer' => '',
		];
	}

}
