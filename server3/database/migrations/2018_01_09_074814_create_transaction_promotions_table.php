<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionPromotionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transaction_promotions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('transaction_id');
			$table->integer('guest_id');
			$table->integer('promotion_id');
			$table->string('promotion_title',100);
			$table->tinyInteger('adult');
			$table->tinyInteger('child');
			$table->double('adult_price',10,2);
			$table->double('child_price',10,2);
			$table->double('discount',10,2);
			$table->date('start_period');
			$table->date('end_period');
			$table->dateTime('transfer_in_datetime');
			$table->dateTime('transfer_out_datetime');
			$table->string('hotel');
			$table->string('hotel_room')->nullable();
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
		Schema::drop('transaction_promotions');
	}

}
