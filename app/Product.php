<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $fillable = ['name', 'description', 'price', 'price_discount', 'active', 'taxonomy_id', 'company_id'];

	public function variations(){
		return $this->belongsToMany('App\Variation');
	}

	public function allergens(){
		return $this->belongsToMany('App\Allergen');
	}

	public function offers(){
		return $this->belongsToMany('App\Offer');
	}

	public function category(){
		return $this->belongsTo('App\Taxonomy', 'taxonomy_id', 'id');
	}

	public function getCategoryNameAttribute(){
		return isset($this->category->name) ? $this->category->name : "";
	}

	public function getNameHtmlAttribute(){
		$name = $this->attributes['name'];
		$active = $this->attributes['active'];

		if (!$active) return $name . "<strong class='color-4'> - Inactief</strong>";

		if(count($this->offers) > 0){
			$name .= "<strong class='color-2'> - Acties: ";
			$first = true;
			foreach ($this->offers as $offer) {
				$name .= $first ? "" . $offer->name : ", " . $offer->name;
				$first = false;
			}
			$name .= "</strong>";
		}

		return $name;
	}

	public function getPriceHtmlAttribute(){
		$price = number_format($this->attributes['price'], 2);
		$price_discount = number_format($this->attributes['price_discount'], 2);

		if ($price_discount > 0)
			return "<strike class='gray-3' style='margin-right:5px'>€$price</strike> €" . $price_discount;

		return "€" . $price;
	}

}
