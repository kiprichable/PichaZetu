<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Laravel\Cashier\Billable;
use Stripe\Stripe;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;

class User extends Authenticatable
{
	use HasRoleAndPermission;
	use Notifiable;
	use SoftDeletes;
	use Billable;
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
	
	/**
	 * The attributes that are not mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = ['id'];
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'first_name',
		'last_name',
		'email',
		'password',
		'activated',
		'token',
		'signup_ip_address',
		'signup_confirmation_ip_address',
		'signup_sm_ip_address',
		'admin_ip_address',
		'updated_ip_address',
		'deleted_ip_address',
	];
	
	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
		'activated',
		'token',
	];
	
	protected $dates = [
		'deleted_at',
	];
	
	/**
	 * Build Social Relationships.
	 *
	 * @var array
	 */
	public function social ()
	{
		return $this->hasMany ('App\Models\Social');
	}
	
	/**
	 * User Profile Relationships.
	 *
	 * @var array
	 */
	public function profile ()
	{
		return $this->hasOne ('App\Models\Profile');
	}
	
	// User Profile Setup - SHould move these to a trait or interface...
	
	public function profiles ()
	{
		return $this->belongsToMany ('App\Models\Profile')->withTimestamps ();
	}
	
	//
	public function blogs ($name)
	{
		return Blog::where ('user_id', User::where ('name', $name)->first ()[ 'id' ])
			->orderBy ('created_at', 'Desc')
			->limit (2)
			->get ();
	}
	
	//
	public function feedback ($name)
	{
		return ContactUS::where ('user_id', User::where ('name', $name)->first ()[ 'id' ])
			->get ();
	}
	
	public function hasProfile ($name)
	{
		foreach($this->profiles as $profile) {
			if ( $profile->name == $name ) {
				return true;
			}
		}
		
		return false;
	}
	
	public function assignProfile ($profile)
	{
		return $this->profiles ()->attach ($profile);
	}
	
	public function removeProfile ($profile)
	{
		return $this->profiles ()->detach ($profile);
	}
	
	public static function getStripePlans ()
	{
		// Set the API Key
		Stripe::setApiKey (User::getStripeKey ());
		
		try {
			// Fetch all the Plans and cache it
			return Cache::remember ('stripe.plans', 60 * 24, function() {
				return \Stripe\Plan::all ()->data;
			});
		} catch(\Exception $e) {
			return false;
		}
	}
	
	public function randomPassword($len = 10)
	{
		$word = array_merge(range('a', 'z'), range('A', 'Z'));
		shuffle($word);
		
		return substr(implode($word), 0, $len);
		
	}
}
