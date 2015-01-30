<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'attachments';

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

}
