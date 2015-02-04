<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Client;
use App\Group;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	public function client()
	{
		return $this->belongsTo('App\Client', 'client_id');
	}

	public function issue_history()
	{
		return $this->hasMany('App\IssueHistory');
	}

    public function groups()
	{
		return $this->belongsToMany('App\Group');
	}

	public function groupIds()
	{
		return $this->belongsToMany('App\Group')->select(array('id'));
	}

	public function belongsToGroup($group)
	{
		return in_array($group, array_fetch($this->groups->toArray(), 'id'));
	}

	public function attachToGroup($id)
	{
		$this->groups()->attach($id);
	}

	public function detachFromGroup($id)
	{
		$this->groups()->detach($id);
	}
}
