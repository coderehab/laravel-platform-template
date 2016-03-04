<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

	protected $fillable = [
		'company_id',
		'user_id',
		'products',
		'productCount',
		'subtotal',
		'total',
		'adress',
		'postal',
		'city',
		'phone',
		'email',
		'is_delivery',
		'deliveryTime',
		'deliveryCosts',
		'paymentMethod',
		'is_paid',
		'is_printed',
		'status',
		'orderJson',
	];

	public function settings(){
		return $this->belongsTo('App\User');
	}

	public function company(){
		return $this->belongsTo('App\Company');
	}

	public function getCreatedAtAttribute($value)
	{
		return $this->asDateTime($this->attributes['created_at'])->timezone('Europe/Amsterdam');
	}
}
