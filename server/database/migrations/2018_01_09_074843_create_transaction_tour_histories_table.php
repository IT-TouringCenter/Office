<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionTourHistoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transaction_tour_histories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('transaction_tour_id');
			$table->integer('tour_id');
			// $table->integer('guest_id');
			$table->string('tour_code',50);
			$table->string('tour_title',100);
			$table->string('tour_privacy');
			$table->string('tour_travel_time');
			$table->string('tour_travel_date',100);
			// $table->double('price',10,2);
			$table->tinyInteger('pax');
			$table->tinyInteger('adult_pax');
			$table->tinyInteger('child_pax');
			$table->tinyInteger('infant_pax');
			$table->double('single_riding',10,2);
			$table->double('discount',10,2)->default(0);
			$table->double('adult_price',10,2);
			$table->double('child_price',10,2)->default(0);
			$table->double('total_adult_price',10,2);
			$table->double('total_child_price',10,2)->default(0);
			$table->double('amount',10,2);
			$table->string('hotel');
			$table->string('hotel_room',20)->nullable();
			$table->text('special_request')->nullable();
			$table->double('special_request_price')->default(0);
			// $table->tinyInteger('is_adult')->default(1);
			// $table->tinyInteger('is_infant')->default(0);
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
		Schema::drop('transaction_tour_histories');
	}

}
