<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
	/**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::create('products', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('company_id');
			$table->integer('taxonomy_id');
			$table->integer('menu_id');

			$table->integer('active');
			$table->string('picture');
			$table->string('name');
			$table->text('description');
			$table->float('price');
			$table->float('price_discount');

			$table->integer('menu_order');

			$table->integer('order_count');
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
		Schema::drop('products');
	}
}
