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
	protected $fillable = ['name','stub','client'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	public function client()
	{
		return $this->belongsTo('App\Client', 'client');
	}

    public function project_manager()
    {
        return $this->belongsTo('App\Users', 'project_manager');
    }

    public function lead_developer()
    {
        return $this->belongsTo('App\Users', 'lead_developer');
    }

    public function lead_designer()
    {
        return $this->belongsTo('App\Users', 'lead_designer');
    }

	public function issues()
	{
		return $this->hasMany('App\Issue', 'project');
	}

}
