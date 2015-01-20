<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'groups';

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

	public function users()
	{
		return $this->hasMany('App\Users', 'group_id');
	}
}
