<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'projects';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'stub', 'client_id', 'project_manager_id', 'lead_developer_id', 'lead_designer_id', 'current_version'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	public function client()
	{
		return $this->belongsTo('App\Client', 'client_id');
	}

	public function issues()
	{
		return $this->hasMany('App\Issue', 'project_id')->orderBy('status_id');
	}

}
