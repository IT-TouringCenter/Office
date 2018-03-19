<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuideSchedulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('guide_schedules', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('work_status_id');
			$table->integer('guide_id');
			$table->date('date');
			$table->tinyInteger('is_halfday')->default(1);
			$table->tinyInteger('is_fullday')->default(1);
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
		Schema::drop('guide_schedules');
	}

}
