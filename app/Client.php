<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'clients';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'stub', 'type'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	public function users()
	{
		return $this->hasMany('App\User');
	}

	public function projects()
	{
		return $this->hasMany('App\Project');
	}

}
