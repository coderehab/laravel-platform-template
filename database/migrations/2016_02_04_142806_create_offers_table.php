<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
	/**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::create('offers', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('company_id');
			$table->integer('product_id');
			$table->integer('active');
			$table->string('name');
			$table->text('description');
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
		Schema::drop('offers');
	}
}
