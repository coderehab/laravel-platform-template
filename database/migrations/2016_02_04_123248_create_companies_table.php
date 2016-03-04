<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
	/**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::create('companies', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');

			//basic stuff
			$table->integer('active');
			$table->string('name');
			$table->text('description');
			$table->string('image_logo');
			$table->string('image_banner');
			$table->string('website');
			$table->string('email_account');
			$table->string('email_orders');
			$table->string('phone');
			$table->string('address');
			$table->string('postal');
			$table->string('city');
			$table->text('terms_of_delivery');
			$table->text('extra_information');
			$table->text('openinghours');

			//pickup/delivery/reservation stuff
			$table->integer('pickup_available');
			$table->integer('delivery_available');
			$table->text('delivery_postal_areas');
			$table->float('delivery_price');
			$table->float('delivery_min_price');
			$table->float('delivery_free_price');

			//payment stuff
			$table->integer('payment_cash_available');
			$table->integer('payment_account_available');
			$table->integer('payment_ideal_available');
			$table->text('payment_ideal_banks');
			$table->text('payment_ideal_key_live');
			$table->text('payment_ideal_key_test');

			$table->integer('created_by');
			$table->timestamps();
		});
	}

	/**
     * Reverse the migrations.
     *
     * @return void
     */
	public function down()
	{
		Schema::drop('companies');
	}
}
