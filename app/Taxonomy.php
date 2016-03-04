<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taxonomy extends Model
{

	protected $fillable = ['name', 'parent_id', 'description', 'type'];

	public function products(){
		return $this->hasMany('App/Product');
	}

}
