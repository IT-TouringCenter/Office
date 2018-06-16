<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTourCommissionPriceRatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tour_commission_price_rates', function(Blueprint $table)
		{
			$table->increments('id');
			// $table->string('tour_type');
			$table->integer('min_pax');
			$table->integer('max_pax');
			$table->double('price_rate',10,2);
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
		Schema::drop('tour_commission_price_rates');
	}

}
