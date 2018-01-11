<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailNotifyTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('email_notify_transactions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('transaction_id');
			$table->string('fullname',100);
			$table->string('to',500);
			$table->string('cc',500)->nullable();
			$table->string('bcc',500)->nullable();
			$table->string('subject',100);
			$table->string('template_path',150);
			$table->tinyInteger('is_send')->default(0);
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
		Schema::drop('email_notify_transactions');
	}

}
