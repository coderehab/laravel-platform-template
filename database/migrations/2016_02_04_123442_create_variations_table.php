<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVariationsTable extends Migration
{
	/**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::create('variations', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('company_id');

			$table->integer('ordernum');
			$table->string('type');
			$table->string('name');
			$table->text('description');
			$table->text('linked_products');

			$table->integer('min_selections')->default(0);
			$table->integer('max_selections')->default(-1);
			$table->integer('required')->default(0);

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
		Schema::drop('variations');
	}
}
