<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transactions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('account_id')->nullable();
			$table->integer('transaction_status_id');
			$table->integer('customer_code_id')->nullable();
			$table->string('payment_mode',100)->nullable();
			$table->string('payment_collect',100)->nullable();
			$table->string('book_by_name',100)->nullable();
			$table->string('book_by_position',100)->nullable();
			$table->string('book_by_hotel')->nullable();
			$table->string('book_by_tel',100)->nullable();
			$table->string('note_by',100)->default('Reservation TC');
			$table->string('book_date',50);
			$table->string('book_time',50);
			$table->double('commission')->default(0);
			$table->double('discount',10,2)->default(0);
			$table->double('service_charge',10,2)->default(0);
			$table->double('amount',10,2);
			$table->string('currency')->nullable();
			$table->double('currency_rate')->default(1);
			$table->text('insurance_note')->nullable();
			$table->string('issued_by',100)->default('Offline'); // online | offline
			$table->tinyInteger('is_insurance')->default(0);
			$table->tinyInteger('is_service_charge')->default(0);
			$table->tinyInteger('is_advance')->default(0);
			$table->tinyInteger('is_commission')->default(0);
			$table->tinyInteger('is_refund')->default(0);
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
		Schema::drop('transactions');
	}

}
