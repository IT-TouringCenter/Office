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
			$table->string('tour_title',100);
			$table->string('tour_type',50);
			$table->double('commission',10,2);
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
		Schema::drop('affiliate_commission_details');
	}

}
