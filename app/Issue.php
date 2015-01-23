<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'issues';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['author_id', 'assigned_to_id', 'project_id', 'version', 'reference', 'type', 'description', 'status', 'priority'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	public function project()
	{
		return $this->belongsTo('App\Project', 'project_id');
	}

	public function author()
	{
		return $this->belongsTo('App\User', 'author_id');
	}

	public function assigned_to()
	{
		return $this->belongsTo('App\Group', 'assigned_to_id');
	}

	public function assigned()
	{
		return $this->assigned_to->name;
	}

	public function issue_history()
	{
		return $this->hasMany('App\IssueHistory')->orderBy('id', 'desc');
	}
}
