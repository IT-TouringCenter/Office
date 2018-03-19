<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTourDriverFeeRatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tour_driver_fee_rates', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('tour_id');
			$table->integer('tour_pax_id');
			$table->double('cost',10,2);
			$table->tinyInteger('is_famtrip')->default(0);
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
		Schema::drop('tour_driver_fee_rates');
	}

}
