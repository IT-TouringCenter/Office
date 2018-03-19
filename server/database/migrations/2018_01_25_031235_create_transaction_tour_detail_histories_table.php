<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionTourDetailHistoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transaction_tour_detail_histories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('transaction_tour_detail_id');
			$table->integer('guest_id');
			$table->string('fullname');
			// $table->double('price',10,2);
			$table->string('ages')->default('Adult');
			$table->tinyInteger('is_active')->default(1);
			$table->string('created_by')->default('System');
			$table->string('updated_by')->nullable();
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
		Schema::drop('transaction_tour_detail_histories');
	}

}
