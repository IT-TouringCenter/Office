<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionTransferHistoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transaction_transfer_histories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('transaction_transfer_id');
			// $table->integer('transaction_status_id');
			$table->integer('transfer_mode_id');
			$table->integer('transfer_type_id');
			$table->integer('transportation_id');
			$table->integer('guest_id');
			$table->dateTime('transfer_datetime');
			$table->string('hotel');
			$table->string('hotel_room',20)->nullable();
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
		Schema::drop('transaction_transfer_histories');
	}

}
