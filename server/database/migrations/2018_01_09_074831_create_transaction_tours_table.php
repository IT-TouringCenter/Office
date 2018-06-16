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
			$table->integer('tour_id');
			$table->string('tour_code',50);
			$table->string('tour_title',100);
			$table->string('tour_privacy');
			$table->string('tour_travel_time');
			$table->string('tour_travel_date',100);
			$table->tinyInteger('rate_two_pax')->default();
			$table->integer('pax');
			$table->integer('adult_pax');
			$table->integer('child_pax');
			$table->integer('infant_pax');
			$table->integer('single_riding_pax')->default(0);
			$table->double('single_riding',10,2);
			$table->double('deposit_price',10,2)->default(0);
			$table->double('discount',10,2)->default(0);
			$table->string('discount_rate',20)->default('0%');
			$table->double('adult_price',10,2);
			$table->double('child_price',10,2)->default(0);
			$table->double('total_adult_price',10,2);
			$table->double('total_child_price',10,2)->default(0);
			$table->double('total_price',10,2);
			$table->double('amount',10,2);
			$table->double('commission_adult',10,2)->default(0);
			$table->double('commission_child',10,2)->default(0);
			$table->string('hotel');
			$table->string('hotel_room',20)->nullable();
			$table->string('ota_code',20)->nullable();
			$table->double('special_charge_price')->default(0);
			$table->text('special_request')->nullable();
			$table->double('special_request_price')->default(0);
			$table->tinyInteger('is_special_request_operator')->default(1);
			$table->tinyInteger('is_special_tour')->default(0);
			$table->tinyInteger('is_travel')->default(0);
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
