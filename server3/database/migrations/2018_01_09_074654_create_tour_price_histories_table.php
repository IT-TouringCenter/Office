<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTourPriceHistoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tour_price_histories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('configuration_tour_id');
			$table->double('net_price_adult',10,2);
			$table->double('net_price_child',10,2);
			$table->double('sell_price_adult',10,2);
			$table->double('sell_price_child',10,2);
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
		Schema::drop('tour_price_histories');
	}

}
