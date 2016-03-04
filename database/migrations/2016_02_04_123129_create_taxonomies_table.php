<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxonomiesTable extends Migration
{
	/**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::create('taxonomies', function (Blueprint $table) {
			$table->increments('id');
			$table->string("parent_id");
			$table->string("type");
			$table->string("name");
			$table->string("description");

			$table->integer('ordernum');

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
		Schema::drop('taxonomies');
	}
}
