<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{

	protected $table = 'variations';
	protected $fillable = ['name','company_id', 'description', 'type', 'min_selections', 'max_selections', 'required', 'linked_products'];

	public function products(){
		return $this->belongsToMany('App/Product');
	}

	public function offer(){
		return $this->hasOne('App/Offer');
	}

	public function company(){
		return $this->belongsTo('App/Company');
	}

}
