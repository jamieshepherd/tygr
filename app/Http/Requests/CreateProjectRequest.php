<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateProjectRequest extends Request {

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
            'name'				     => 'required|min:3',
            'stub' 					 => 'required|unique:projects|alpha_dash|min:3',
            'current_version' 		 => 'required|numeric',
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
