<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAffiliateCommissionTourRatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('affiliate_commission_tour_rates', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('account_id');
			$table->integer('tour_id');
			$table->tinyInteger('min_pax');
			$table->tinyInteger('max_pax');
			$table->double('price_rate');
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
		Schema::drop('affiliate_commission_tour_rates');
	}

}
