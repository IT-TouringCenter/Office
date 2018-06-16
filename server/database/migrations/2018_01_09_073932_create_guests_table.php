<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('guests', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('fullname',150);
			$table->integer('weight')->nullable();
			$table->integer('height')->nullable();
			$table->integer('age')->nullable();
			$table->string('email')->nullable();
			$table->string('phone')->nullable();
			$table->text('address')->nullable();
			$table->string('city')->nullable();
			$table->string('province')->nullable();
			$table->string('postcode')->nullble();
			$table->string('passport_number')->nullable();
			$table->string('hotel')->nullable();
			$table->string('hotel_room')->nullable();
			$table->string('nationality')->nullable();
			$table->string('country')->nullable();
			$table->tinyInteger('is_primary')->default(0);
			$table->tinyInteger('is_adult')->default(1);
			$table->tinyInteger('is_infant')->default(0);
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
		Schema::drop('guests');
	}

}
