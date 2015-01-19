<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class IssueHistory extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'issue_history';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	public function issue()
	{
		return $this->belongsTo('App\Issue', 'issue_id');
	}

	public function author()
	{
		return $this->belongsTo('App\User', 'author_id');
	}

}
