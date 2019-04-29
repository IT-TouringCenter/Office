<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobApplicationVansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('job_application_vans', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('job_status_id');
			$table->string('fullname',50);
			$table->string('nickname',50)->nullable();
			$table->string('gender',50);
			$table->string('birth',50)->nullable();
			$table->integer('age')->nullable();
			$table->integer('height')->nullable();
			$table->integer('weight')->nullable();
			$table->string('phone',50);
			$table->string('address_no',50)->nullable();
			$table->string('address_village',50)->nullable();
			$table->string('address_allery',50)->nullable();
			$table->string('address_road',50)->nullable();
			$table->string('address_subdistrict',50)->nullable();
			$table->string('address_district',50)->nullable();
			$table->string('address_province',50)->nullable();
			$table->string('address_postcode',50)->nullable();
			$table->string('address_country',100)->nullable();
			$table->string('race',50);
			$table->string('nationality',100);
			$table->string('religion',50)->nullable();
			$table->string('id_no',20);
			$table->string('id_no_expire',50);
			$table->string('license_no',50);
			$table->tinyInteger('seat');
			$table->string('blood_type',5)->nullable();
			$table->text('disease')->nullable();
			$table->string('profile_image',100)->nullable();
			$table->string('license_image',100);
			$table->string('military_status',50);
			$table->string('driver_license_no',50);
			$table->string('driver_license_no_expire',50);
			$table->string('speak_english',50)->nullable();
			$table->string('wing41',50)->nullable();
			$table->tinyInteger('is_camera')->default(0);
			$table->tinyInteger('is_wifi')->default(0);
			$table->tinyInteger('is_gps')->default(0);
			$table->tinyInteger('is_audio')->default(0);
			$table->tinyInteger('is_active')->default(1);
			$table->string('created_by',50)->default('System');
			$table->dateTime('created_at')->nullable();
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
		Schema::drop('job_application_vans');
	}

}
