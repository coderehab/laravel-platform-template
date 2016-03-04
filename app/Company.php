<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

	protected $fillable = [
		'user_id',
		'name',
		'description',
		'image_logo',
		'image_banner',
		'website',
		'email_account',
		'email_orders',
		'phone',
		'address',
		'postal',
		'city',
		'terms_of_delivery',
		'extra_information',
		'pickup_available',
		'delivery_available',
		'delivery_price',
		'delivery_postal_areas',
		'payment_cash_available',
		'payment_account_available',
		'payment_ideal_available',
		'payment_ideal_banks',
		'created_by',
		'openinghours'
	];

	public function products(){
		return $this->hasMany('App\Product');
	}

	public function user(){
		return $this->hasOne('App\User');
	}

	public function categories(){
		return $this->hasMany('App\Taxonomy', 'parent_id', 'id')->where('type', 'product_category');
	}

	public function variations(){
		return $this->hasMany('App\Variation');
	}

	public function offers(){
		return $this->hasMany('App\Offer');
	}

	public function orders(){
		return $this->hasMany('App\Order');
	}

	public function settings(){
		return $this->hasOne('App\Settings');
	}
}
