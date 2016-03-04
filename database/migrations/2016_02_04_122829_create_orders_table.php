<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
	/**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::create('orders', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('company_id');
			$table->integer('user_id');

			$table->text('products');
			$table->float('productCount');
			$table->text('notes');

			$table->float('subtotal');
			$table->float('total');

			$table->string('username');
			$table->string('address');
			$table->string('postal');
			$table->string('city');
			$table->string('phone');
			$table->string('email');

			$table->float('is_delivery');
			$table->float('deliveryTime');
			$table->float('deliveryCosts');

			$table->string('paymentMethod');
			$table->integer('is_paid');
			$table->integer('is_printed');
			$table->string('status');

			$table->text('receipt');
			$table->text('orderJson');
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
		Schema::drop('orders');
	}
}
