<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAffiliateTourStatisticsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('affiliate_tour_statistics', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('account_id');
			$table->integer('transaction_tour_id');
			$table->string('tour_code',10);
			$table->string('tour_title',100);
			$table->string('tour_privacy',50);
			$table->string('tour_travel_time',100);
			$table->double('tour_price',10,2);
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
		Schema::drop('affiliate_tour_statistics');
	}

}
