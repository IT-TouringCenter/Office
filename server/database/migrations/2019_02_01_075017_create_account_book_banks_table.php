<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountBookBanksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('account_book_banks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('account_id');
			$table->string('account_name')->nullable();
			$table->string('account_no')->nullable();
			$table->string('bank')->nullable();
			$table->string('branch')->nullable();
			$table->string('copy_book')->nullable();
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
		Schema::drop('account_book_banks');
	}

}
