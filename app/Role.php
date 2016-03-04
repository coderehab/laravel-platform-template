<?php namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{

    protected $fillable = [
		'name','display_name','description', 'created_at', 'updated_at',
	];

	/**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

}
