<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTourGalleriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tour_galleries', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('tour_id');
			$table->integer('tour_travel_time_id')->nullable();
			$table->string('travel_date',100)->nullable();
			$table->string('image_name');
			$table->string('image_path');
			$table->string('credit',100)->nullable();
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
		Schema::drop('tour_galleries');
	}

}
