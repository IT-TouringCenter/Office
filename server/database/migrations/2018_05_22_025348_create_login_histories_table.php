<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoginHistoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('login_histories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('account_id');
			// $table->integer('account_type_id');
			$table->dateTime('login_datetime');
			$table->dateTime('logout_datetime')->nullable();
			$table->string('token');
			$table->string('otp')->nullable();
			// $table->dateTime('otp_expire');
			$table->string('logout_code',20);
			$table->dateTime('logout_code_expired');
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
		Schema::drop('login_histories');
	}

}
