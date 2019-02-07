<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

	/**
	* Run the database seeds.
	*
	* @return void

	* Reference: https://sheepy85.wordpress.com/2014/09/19/database-seed-migration-in-laravel-5-0/		
	* 1: php artisan optimize
	* 2: php artisan migrate:refresh
	* 3: php artisan db:seed
	* -------------------
	* php artisan migrate:refresh --seed
	*/
	
	public function run(){
		Model::unguard();

		//- Account
		$this->call(AccountTypeSeeder::class);
		$this->call(AccountRequestTypeSeeder::class);

		//- Configuration
		$this->call(ConfigurationEmailSeeder::class);
		$this->call(ConfigurationTourHolidaySeeder::class);
		$this->call(ConfigurationTourPriceSeeder::class);

		//- Customer (account)
		$this->call(CustomerCodeSeeder::class);
		$this->call(CustomerCollectionRefSeeder::class);
		$this->call(CustomerLocationRefSeeder::class);
		$this->call(CustomerMonthRefSeeder::class);
		$this->call(CustomerPaymentRefSeeder::class);
		$this->call(CustomerSaleRefSeeder::class);
		$this->call(CustomerSellerRefSeeder::class);
		$this->call(CustomerTypeRefSeeder::class);
		$this->call(CustomerYearRefSeeder::class);

		//- Driver
		$this->call(DriverSeeder::class);

		//- Email
		$this->call(EmailContactTypeSeeder::class);
		$this->call(EmailSeeder::class);
		$this->call(EmailTypeSeeder::class);

		//- Guide
		$this->call(GuideSeeder::class);

		//- Holiday
		$this->call(HolidaySeeder::class);
		$this->call(HolidayTypeSeeder::class);

		//- Hotel
		$this->call(HotelSeeder::class);

		//- Job
		$this->call(JobStatusSeeder::class);

		//- Nationality
		$this->call(NationalitySeeder::class);

		//- Payment
		$this->call(PaymentChannelSeeder::class);
		$this->call(PaymentModeSeeder::class);
		$this->call(PaymentStatusSeeder::class);

		//- Tour
		$this->call(TourCategorySeeder::class);
		$this->call(TourDriverFeeRateSeeder::class);
		$this->call(TourGuideFeeRateSeeder::class);
		$this->call(TourPaxSeeder::class);
		$this->call(TourPrivacySeeder::class);
		$this->call(TourSeeder::class);
		$this->call(TourTravelTimeSeeder::class);
		$this->call(TourTravelTimeTypeSeeder::class);
		$this->call(TourTypeSeeder::class);

		//- Transaction
		$this->call(TransactionStatusSeeder::class);

		//- Transfer || Transportation
		$this->call(TransferModeSeeder::class);
		$this->call(TransferTypeSeeder::class);
		$this->call(TransportationSeeder::class);

		//- Work status
		$this->call(WorkStatusSeeder::class);

		//- Affiliate
		$this->call(TourCommissionPriceRateSeeder::class);

		//- Bank
		$this->call(BankSeeder::class);
	}
}
