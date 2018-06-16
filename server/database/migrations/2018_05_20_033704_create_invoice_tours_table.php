<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceToursTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoice_tours', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('transaction_id');
			$table->integer('transaction_tour_id');
			$table->integer('invoice_referent_id')->nullable();
			$table->string('booking_number',20);
			$table->string('booking_number_ref',20)->nullable();
			$table->string('invoice_number',20);
			$table->string('issued_by',50)->default('Reservation team');
			$table->tinyInteger('is_revised')->default(0);
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
		Schema::drop('invoice_tours');
	}

}
