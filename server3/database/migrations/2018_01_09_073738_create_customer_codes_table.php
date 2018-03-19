<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerCodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer_codes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('customer_year_ref_id');
			$table->integer('customer_month_ref_id');
			$table->integer('customer_sale_ref_id');
			$table->integer('customer_location_ref_id');
			$table->integer('customer_type_ref_id');
			$table->integer('customer_seller_ref_id');
			$table->integer('customer_payment_ref_id');
			$table->integer('customer_collect_ref_id');
			$table->string('code',10);
			$table->string('customer_name',100);
			$table->string('room',20)->nullable();
			$table->string('contact_person',50)->nullable();
			$table->string('contact_number',50)->nullable();
			$table->string('email',100)->nullable();
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
		Schema::drop('customer_codes');
	}

}
