<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTourCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tour_categories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('category',100);
			$table->tinyInteger('is_active')->default(1);
			$table->string('created_by',50)->default('System');
			$table->string('updated_by',50)->nullable();
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
		Schema::drop('tour_categories');
	}

}
