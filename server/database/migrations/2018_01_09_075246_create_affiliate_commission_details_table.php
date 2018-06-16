<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAffiliateCommissionDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('affiliate_commission_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('account_id');
			$table->integer('transaction_tour_id');
			$table->date('booked_date');
			$table->date('travel_date');
			$table->integer('pax')->default(1);
			$table->integer('adult_pax')->default(1);
			$table->integer('child_pax')->default(0);
			$table->integer('infant_pax')->default(0);
			$table->double('adult_price',10,2);
			$table->double('child_price',10,2)->default(0);
			$table->double('commission_adult',10,2);
			$table->double('commission_child',10,2)->default(0);
			$table->double('commission_total',10,2);
			$table->double('commission_bonus',10,2)->default(0);
			$table->double('commission_amount',10,2);
			$table->text('note')->nullable();
			$table->dateTime('payment_date')->nullable();
			$table->tinyInteger('is_refund')->default(0);
			$table->tinyInteger('is_payment')->default(0);
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
		Schema::drop('affiliate_commission_details');
	}

}