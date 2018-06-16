<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAffiliateCommissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('affiliate_commissions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('account_id');
			$table->integer('pax')->default(0);
			$table->integer('adult_pax')->default(0);
			$table->integer('child_pax')->default(0);
			$table->integer('infant_pax')->default(0);
			$table->double('adult_price',10,2)->default(0);
			$table->double('child_price',10,2)->default(0);
			$table->double('commission_adult',10,2)->default(0);
			$table->double('commission_child',10,2)->default(0);
			$table->double('commission_total',10,2)->default(0);
			$table->double('commission_bonus',10,2)->default(0);
			$table->double('commission_amount',10,2)->default(0);
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
		Schema::drop('affiliate_commissions');
	}

}
