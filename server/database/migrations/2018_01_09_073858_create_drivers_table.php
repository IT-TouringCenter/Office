<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriversTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('drivers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('fullname_th',50);
			$table->string('fullname_en',50)->nullable();
			$table->string('nickname',50)->nullable();
			$table->string('tel',20);
			$table->string('line',50)->nullable();
			$table->string('license_no',50);
			$table->text('note')->nullable();
			$table->tinyInteger('seat');
			$table->tinyInteger('is_provincial')->default(1);
			$table->tinyInteger('is_wing41')->default(0);
			$table->tinyInteger('is_staff')->default(1);
			$table->tinyInteger('is_priority');
			$table->tinyInteger('is_sticker')->default(0);
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
		Schema::drop('drivers');
	}

}
