<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigurationTourPricesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('configuration_tour_prices', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('tour_id');
			$table->integer('tour_category_id');
			$table->integer('tour_pax_id');
			$table->integer('tour_privacy_id');
			$table->integer('tour_type_id');
			$table->integer('tour_travel_time_type_id');
			$table->integer('transportation_id');
			$table->integer('payment_mode_id');
			$table->double('net_price_adult',10,2);
			$table->double('net_price_child',10,2);
			$table->double('sell_price_adult',10,2);
			$table->double('sell_price_child',10,2);
			$table->double('adult_price',10,2);
			$table->double('child_price',10,2);
			$table->double('commission_adult',10,2);
			$table->double('commission_child',10,2);
			$table->double('single_riding',10,2);
			$table->date('period_start');
			$table->date('period_end');
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
		Schema::drop('configuration_tour_prices');
	}

}
