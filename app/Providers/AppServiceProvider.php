<?php

namespace App\Providers;

use App\Order;
use stdClass;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
     * Bootstrap any application services.
     *
     * @return void
     */
	public function boot()
	{
		Order::created(function ($order) {

			$curl = curl_init();
			$data = $order;

			curl_setopt($curl, CURLOPT_URL, "http://localhost:3000");
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

			curl_exec($curl);
		});
	}

	/**
     * Register any application services.
     *
     * @return void
     */
	public function register()
	{
		//
	}
}
