<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToursTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tours', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('code',10);
			$table->string('title',100);
			$table->text('short_description')->nullable();
			$table->text('long_description')->nullable();
			$table->string('note')->nullable();
			$table->string('warning')->nullable();
			$table->date('period_start');
			$table->date('period_end');
			$table->tinyInteger('is_recommend');
			$table->tinyInteger('is_special');
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
		Schema::drop('tours');
	}

}
