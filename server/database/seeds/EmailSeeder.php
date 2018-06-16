<?php

use App\email as email;
use Illuminate\Database\Seeder;

class EmailSeeder extends Seeder{
	public function run(){
		email::truncate();
		email::create(["email"=>"account@touringcnx.com"]);
		email::create(["email"=>"accounts@northernsmiletravel.com"]);
		email::create(["email"=>"contact@touringcnx.com"]);
		email::create(["email"=>"graphic@northernsmiletravel.com"]);
		email::create(["email"=>"graphic@touringcnx.com"]);
		email::create(["email"=>"hr@northernsmiletravel.com"]);
		email::create(["email"=>"icas10-transport@northernsmiletravel.com"]);
		email::create(["email"=>"info@northernsmiletravel.com"]);
		email::create(["email"=>"info@tour-in-chiangmai.com"]);
		email::create(["email"=>"info@touringcnx.com"]);
		email::create(["email"=>"it@northernsmiletravel.com"]);
		email::create(["email"=>"it@touringcnx.com"]);
		email::create(["email"=>"nim@northernsmiletravel.com"]);
		email::create(["email"=>"northern@northernsmiletravel.com"]);
		email::create(["email"=>"nui@northernsmiletravel.com"]);
		email::create(["email"=>"online@northernsmiletravel.com"]);
		email::create(["email"=>"online@touringcnx.com"]);
		email::create(["email"=>"recruit@northernsmiletravel.com"]);
		email::create(["email"=>"recruit@touringcnx.com"]);
		email::create(["email"=>"operations@northernsmiletravel.com"]);
		email::create(["email"=>"reservations@northernsmiletravel.com"]);
		email::create(["email"=>"reservations@touringcnx.com"]);
		email::create(["email"=>"rsvn02@northernsmiletravel.com"]);
		email::create(["email"=>"sales@northernsmiletravel.com"]);
		email::create(["email"=>"sales@touringcnx.com"]);
		email::create(["email"=>"sales2@touringcnx.com"]);
		email::create(["email"=>"sales3@touringcnx.com"]);
		email::create(["email"=>"sales4@touringcnx.com"]);
		email::create(["email"=>"sittipong@northernsmiletravel.com"]);
		email::create(["email"=>"sittipong@onedayexcursion.com"]);
		email::create(["email"=>"test@northernsmiletravel.com"]);
		email::create(["email"=>"tour@touringcnx.com"]);
		email::create(["email"=>"touringcenter@hotmail.com"]);
		email::create(["email"=>"transport@northernsmiletravel.com"]);
		email::create(["email"=>"webdeveloper@northernsmiletravel.com"]);
		email::create(["email"=>"webdeveloper@touringcnx.com"]);
		email::create(["email"=>"webmaster@northernsmiletravel.com"]);
		email::create(["email"=>"webmaster@tour-in-chiangmai.com"]);
		email::create(["email"=>"webmaster@touringcnx.com"]);
	}
}
?>