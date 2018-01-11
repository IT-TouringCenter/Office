<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobExperienceVansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('job_experience_vans', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('job_application_van_id');
			$table->string('company',150)->nullable();
			$table->string('department',100)->nullable();
			$table->string('period_start',50)->nullable();
			$table->string('period_end',50)->nullable();
			$table->text('cause')->nullable();
			$table->tinyInteger('is_present')->default(0);
			$table->string('created_by',50)->default('System');
			$table->dateTime('created_at');
			// $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('job_experience_vans');
	}

}
