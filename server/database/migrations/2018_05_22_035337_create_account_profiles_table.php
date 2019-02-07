<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('account_profiles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('account_id');
			$table->string('fullname');
			$table->date('birth')->nullable();
			$table->string('id_number')->nullable();
			$table->text('address')->nullable();
			$table->string('city')->nullable();
			$table->string('province')->nullable();
			$table->string('country')->nullable();
			$table->string('postcode')->nullable();
			$table->string('nationality')->nullable();
			$table->string('picture')->nullable();
			$table->text('url')->nullable();
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
		Schema::drop('account_profiles');
	}

}
