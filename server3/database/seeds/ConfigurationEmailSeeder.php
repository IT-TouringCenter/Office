<?php

use App\configuration_email as configuration_email;
use Illuminate\Database\Seeder;

class ConfigurationEmailSeeder extends Seeder{
	public function run(){
		configuration_email::truncate();
		configuration_email::create(["email_id"=>"12","email_type_id"=>"1","email_contact_type_id"=>"1","is_to"=>"0","is_cc"=>"1","is_bcc"=>"0"]);
		configuration_email::create(["email_id"=>"20","email_type_id"=>"1","email_contact_type_id"=>"1","is_to"=>"0","is_cc"=>"1","is_bcc"=>"0"]);
		configuration_email::create(["email_id"=>"8","email_type_id"=>"1","email_contact_type_id"=>"1","is_to"=>"0","is_cc"=>"0","is_bcc"=>"1"]);
		configuration_email::create(["email_id"=>"6","email_type_id"=>"2","email_contact_type_id"=>"1","is_to"=>"0","is_cc"=>"1","is_bcc"=>"0"]);
		configuration_email::create(["email_id"=>"12","email_type_id"=>"2","email_contact_type_id"=>"1","is_to"=>"0","is_cc"=>"1","is_bcc"=>"0"]);
		configuration_email::create(["email_id"=>"19","email_type_id"=>"2","email_contact_type_id"=>"1","is_to"=>"0","is_cc"=>"1","is_bcc"=>"0"]);
		configuration_email::create(["email_id"=>"6","email_type_id"=>"3","email_contact_type_id"=>"1","is_to"=>"1","is_cc"=>"0","is_bcc"=>"0"]);
		configuration_email::create(["email_id"=>"8","email_type_id"=>"3","email_contact_type_id"=>"1","is_to"=>"0","is_cc"=>"0","is_bcc"=>"1"]);
		configuration_email::create(["email_id"=>"8","email_type_id"=>"4","email_contact_type_id"=>"1","is_to"=>"1","is_cc"=>"0","is_bcc"=>"0"]);
		configuration_email::create(["email_id"=>"6","email_type_id"=>"5","email_contact_type_id"=>"1","is_to"=>"1","is_cc"=>"0","is_bcc"=>"0"]);
		configuration_email::create(["email_id"=>"8","email_type_id"=>"5","email_contact_type_id"=>"1","is_to"=>"0","is_cc"=>"0","is_bcc"=>"1"]);
		configuration_email::create(["email_id"=>"6","email_type_id"=>"6","email_contact_type_id"=>"1","is_to"=>"1","is_cc"=>"0","is_bcc"=>"0"]);
	}
}
?>