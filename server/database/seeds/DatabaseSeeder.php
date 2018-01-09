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

		//- Authenticate
		$this->call('AccountGenerateCodeTypeSeeder');
		$this->call('AccountRequestTypeSeeder');
		$this->call('AccountTypeSeeder');
		//- Reservation
		$this->call('ConfigurationTourProgramSeeder');
		$this->call('DiscountTypeSeeder');
		$this->call('HolidaySeeder');
		$this->call('HolidayTypeSeeder');
		$this->call('MyaccountLeftMenuSeeder');
		$this->call('NotifyStatusCronjobSeeder');
		$this->call('TransactionStatusSeeder');
		$this->call('PaxSeeder');		
		//- Tour Program
		$this->call('TourCategorySeeder');
		$this->call('TourProgramSeeder');
		$this->call('TourTravelingTimeSeeder');
		$this->call('TourTypePriceSeeder');
		$this->call('TourTypeSeeder');
		$this->call('TransportationSeeder');
		//- Hotel
		$this->call('HotelSeeder');
		//- Country
		$this->call('CountrySeeder');
		$this->call('NationalitySeeder');
		//- Transaction
		$this->call('PaymentTransactionStatusSeeder');
		$this->call('PaymentTransactionChannelSeeder');
		//- Job
		$this->call('JobVacancySeeder');
		$this->call('JobResponsibilitySeeder');
		$this->call('JobQualificationSeeder');
		$this->call('JobDepartmentSeeder');
		$this->call('JobTypeSeeder');
		//- Event
		$this->call('ActivitySeeder');
		$this->call('ConfigurationTransferSeeder');
		$this->call('ConfigurationTransportationSeeder');
		$this->call('ConfigurationTourProgramDiscountSeeder');
		// $this->call('ConfigurationTransferDiscountSeeder'); // Configuration transfer discount
		$this->call('ConfigurationHotelSeeder');
		//- Transfer
		$this->call('TransferSeeder');
		$this->call('TransferModeSeeder');
		$this->call('TransferReserveTypeSeeder');
		$this->call('TransactionSourceSeeder');
		//- Email
		$this->call('EmailUserSeeder');
		$this->call('EmailTypeSeeder');
		$this->call('EmailContactTypeSeeder');
		$this->call('EmailStatusSeeder');
		$this->call('ConfigurationEmailSeeder');
		//-2017-03-16
		$this->call('AirportOriginSeeder');
		$this->call('AirlineInformationSeeder');
		//2017-03-31
		$this->call('CreateProcedureSeeder');
		//2017-04-06
		$this->call('InvoiceCategorySeeder');
	}
}
