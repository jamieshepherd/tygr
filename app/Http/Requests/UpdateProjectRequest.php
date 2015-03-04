<?php namespace App\Http\Requests;

use App\Project;
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
		$project = Project::where('stub', '=', $this->segment(3))->first();

		return [
			'name'				     => 'required|min:3',

            'stub'		             =>	'required|unique:projects,stub,'.$project->id,

			'current_version' 		 => 'required',
			'status' 				 => 'required|min:3',
			'authoring_tool' 		 => '',
			'lms_deployment' 		 => 'required',
			'lms_specification' 	 => '',
			'project_manager' 		 => '',
			'lead_developer' 		 => '',
			'lead_designer' 		 => '',
			'instructional_designer' => '',
		];
	}

}
