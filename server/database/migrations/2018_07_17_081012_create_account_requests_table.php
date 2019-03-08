<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountRequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('account_requests', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('account_id');
			$table->integer('account_request_type_id');
			$table->integer('account_request_status_id')->default(1);
			$table->string('request_code',20)->nullable();
			$table->dateTime('request_code_expired')->nullable();
			$table->tinyInteger('is_cancel')->default(0);
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
		Schema::drop('account_requests');
	}

}
