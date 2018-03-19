<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionToursTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transaction_tours', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('transaction_id');
			$table->integer('guest_id');
			$table->string('tour_code',50);
			$table->string('tour_title',100);
			$table->string('tour_privacy');
			$table->string('tour_travel_time');
			$table->string('tour_travel_date',100);
			$table->double('price',10,2);
			$table->double('single_riding',10,2);
			$table->double('discount',10,2);
			$table->double('amount',10,2);
			$table->string('hotel');
			$table->string('hotel_room',20)->nullable();
			$table->tinyInteger('is_adult')->default(1);
			$table->tinyInteger('is_infant')->default(0);
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
		Schema::drop('transaction_tours');
	}

}
