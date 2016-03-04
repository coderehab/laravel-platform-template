<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{

	use EntrustUserTrait;
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [
		'firstname','middlename','lastname', 'email', 'password',
	];

	/**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
	protected $hidden = [
		'password', 'remember_token',
	];

	public function companies(){
		return $this->hasMany('App\Company');
	}

	public function orders(){
		return $this->hasMany('App\Order');
	}

	public function settings(){
		return $this->hasOne('App\Settings');
	}

//    public function roles(){
//        return $this->hasManyThrough('App\Role', 'App/RoleUser', 'user_id', 'role_id');
//    }

}
