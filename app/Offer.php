<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{

	protected $fillable = ['name', 'description', 'company_id'];

	public function company(){
		return $this->belongsTo('App\Company');
	}

	public function products(){
		return $this->belongsToMany('App\Product');
	}
}
