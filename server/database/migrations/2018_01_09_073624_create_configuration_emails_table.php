<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigurationEmailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('configuration_emails', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('email_id');
			$table->integer('email_type_id');
			$table->integer('email_contact_type_id');
			$table->tinyInteger('is_to')->default(0);
			$table->tinyInteger('is_cc')->default(0);
			$table->tinyInteger('is_bcc')->default(0);
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
		Schema::drop('configuration_emails');
	}

}
