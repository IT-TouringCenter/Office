<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Application Debug Mode
	|--------------------------------------------------------------------------
	|
	| When your application is in debug mode, detailed error messages with
	| stack traces will be shown on every error that occurs within your
	| application. If disabled, a simple generic error page is shown.
	|
	*/

	'debug' => env('APP_DEBUG'),

	/*
	|--------------------------------------------------------------------------
	| Application URL
	|--------------------------------------------------------------------------
	|
	| This URL is used by the console to properly generate URLs when using
	| the Artisan command line tool. You should set this to the root of
	| your application so that it is used when running Artisan tasks.
	|
	*/

	'url' => 'http://localhost',

	/*
	|--------------------------------------------------------------------------
	| Application Timezone
	|--------------------------------------------------------------------------
	|
	| Here you may specify the default timezone for your application, which
	| will be used by the PHP date and date-time functions. We have gone
	| ahead and set this to a sensible default for you out of the box.
	|
	*/

	'timezone' => 'UTC',

	/*
	|--------------------------------------------------------------------------
	| Application Locale Configuration
	|--------------------------------------------------------------------------
	|
	| The application locale determines the default locale that will be used
	| by the translation service provider. You are free to set this value
	| to any of the locales which will be supported by the application.
	|
	*/

	'locale' => 'en',

	/*
	|--------------------------------------------------------------------------
	| Application Fallback Locale
	|--------------------------------------------------------------------------
	|
	| The fallback locale determines the locale to use when the current one
	| is not available. You may change the value to correspond to any of
	| the language folders that are provided through your application.
	|
	*/

	'fallback_locale' => 'en',

	/*
	|--------------------------------------------------------------------------
	| Encryption Key
	|--------------------------------------------------------------------------
	|
	| This key is used by the Illuminate encrypter service and should be set
	| to a random, 32 character string, otherwise these encrypted strings
	| will not be safe. Please do this before deploying an application!
	|
	*/

	'key' => env('APP_KEY', 'SomeRandomString'),

	'cipher' => MCRYPT_RIJNDAEL_128,

	/*
	|--------------------------------------------------------------------------
	| Logging Configuration
	|--------------------------------------------------------------------------
	|
	| Here you may configure the log settings for your application. Out of
	| the box, Laravel uses the Monolog PHP logging library. This gives
	| you a variety of powerful log handlers / formatters to utilize.
	|
	| Available Settings: "single", "daily", "syslog", "errorlog"
	|
	*/

	'log' => 'daily',

	/*
	|--------------------------------------------------------------------------
	| Autoloaded Service Providers
	|--------------------------------------------------------------------------
	|
	| The service providers listed here will be automatically loaded on the
	| request to your application. Feel free to add your own services to
	| this array to grant expanded functionality to your applications.
	|
	*/

	'providers' => [

		/*
		 * Laravel Framework Service Providers...
		 */
		'Illuminate\Foundation\Providers\ArtisanServiceProvider',
		'Illuminate\Auth\AuthServiceProvider',
		'Illuminate\Bus\BusServiceProvider',
		'Illuminate\Cache\CacheServiceProvider',
		'Illuminate\Foundation\Providers\ConsoleSupportServiceProvider',
		'Illuminate\Routing\ControllerServiceProvider',
		'Illuminate\Cookie\CookieServiceProvider',
		'Illuminate\Database\DatabaseServiceProvider',
		'Illuminate\Encryption\EncryptionServiceProvider',
		'Illuminate\Filesystem\FilesystemServiceProvider',
		'Illuminate\Foundation\Providers\FoundationServiceProvider',
		'Illuminate\Hashing\HashServiceProvider',
		'Illuminate\Mail\MailServiceProvider',
		'Illuminate\Pagination\PaginationServiceProvider',
		'Illuminate\Pipeline\PipelineServiceProvider',
		'Illuminate\Queue\QueueServiceProvider',
		'Illuminate\Redis\RedisServiceProvider',
		'Illuminate\Auth\Passwords\PasswordResetServiceProvider',
		'Illuminate\Session\SessionServiceProvider',
		'Illuminate\Translation\TranslationServiceProvider',
		'Illuminate\Validation\ValidationServiceProvider',
		'Illuminate\View\ViewServiceProvider',

		/*
		 * Application Service Providers...
		 */
		'App\Providers\AppServiceProvider',
		'App\Providers\BusServiceProvider',
		'App\Providers\ConfigServiceProvider',
		'App\Providers\EventServiceProvider',
		'App\Providers\RouteServiceProvider',

	],

	/*
	|--------------------------------------------------------------------------
	| Class Aliases
	|--------------------------------------------------------------------------
	|
	| This array of class aliases will be registered when this application
	| is started. However, feel free to register as many as you wish as
	| the aliases are "lazy" loaded so they don't hinder performance.
	|
	*/

	'aliases' => [

		'App'       => 'Illuminate\Support\Facades\App',
		'Artisan'   => 'Illuminate\Support\Facades\Artisan',
		'Auth'      => 'Illuminate\Support\Facades\Auth',
		'Blade'     => 'Illuminate\Support\Facades\Blade',
		'Bus'       => 'Illuminate\Support\Facades\Bus',
		'Cache'     => 'Illuminate\Support\Facades\Cache',
		'Config'    => 'Illuminate\Support\Facades\Config',
		'Cookie'    => 'Illuminate\Support\Facades\Cookie',
		'Crypt'     => 'Illuminate\Support\Facades\Crypt',
		'DB'        => 'Illuminate\Support\Facades\DB',
		'Eloquent'  => 'Illuminate\Database\Eloquent\Model',
		'Event'     => 'Illuminate\Support\Facades\Event',
		'File'      => 'Illuminate\Support\Facades\File',
		'Hash'      => 'Illuminate\Support\Facades\Hash',
		'Input'     => 'Illuminate\Support\Facades\Input',
		'Inspiring' => 'Illuminate\Foundation\Inspiring',
		'Lang'      => 'Illuminate\Support\Facades\Lang',
		'Log'       => 'Illuminate\Support\Facades\Log',
		'Mail'      => 'Illuminate\Support\Facades\Mail',
		'Password'  => 'Illuminate\Support\Facades\Password',
		'Queue'     => 'Illuminate\Support\Facades\Queue',
		'Redirect'  => 'Illuminate\Support\Facades\Redirect',
		'Redis'     => 'Illuminate\Support\Facades\Redis',
		'Request'   => 'Illuminate\Support\Facades\Request',
		'Response'  => 'Illuminate\Support\Facades\Response',
		'Route'     => 'Illuminate\Support\Facades\Route',
		'Schema'    => 'Illuminate\Support\Facades\Schema',
		'Session'   => 'Illuminate\Support\Facades\Session',
		'Storage'   => 'Illuminate\Support\Facades\Storage',
		'URL'       => 'Illuminate\Support\Facades\URL',
		'Validator' => 'Illuminate\Support\Facades\Validator',
		'View'      => 'Illuminate\Support\Facades\View',

		// Reservation System
		//-- Save booking
		'ReservationTransactionFacade' => 'App\Facades\Reservations\Transactions\TransactionFacade',
		//-- Update booking
		'EditReservationFacade' => 'App\Facades\Reservations\Transactions\EditReservationFacade',

		// Commons
		'DateFacade' => 'App\Facades\Commons\DateFacade',
		'DateFormatFacade' => 'App\Facades\Commons\DateFormatFacade',
		'GenerateCodeFacade' => 'App\Facades\Commons\GenerateCodeFacade',

		'ReservationBookingFacade' => 'App\Facades\Reservations\BookingForms\BookingFormFacade',
		'ReservationBookingStatisticsFacade' => 'App\Facades\Reservations\BookingStatistics\BookingStatisticsFacade',
		'InvoiceBookingFacade' => 'App\Facades\Reservations\Invoices\InvoiceTourFacade',
		'BookingFormEditFacade' => 'App\Facades\Reservations\BookingFormEdit\BookingFormEditFacade',
		'ReservationUpdateTourTraveledFacade' => 'App\Facades\Reservations\Traveleds\UpdateTourTraveledFacade',
		'ReservationAutoUpdateTourTraveledFacade' => 'App\Facades\Reservations\Traveleds\AutoUpdateTourTraveledFacade',

		// Online booking
		//-- Save booking
		'SaveBookingFacade' => 'App\Facades\Bookings\SaveBookingFacade',
		'UpdateBookingPaymentFacade' => 'App\Facades\Bookings\UpdateBookingPaymentFacade',

		// Account
		'AccountFacade' => 'App\Facades\Accounts\AccountFacade',
		'AccountRegisterFacade' => 'App\Facades\Accounts\Register\AccountRegisterFacade',
		'AccountRegisterConfirmFacade' => 'App\Facades\Accounts\Register\AccountRegisterConfirmFacade',
		'AccountForgotPasswordFacade' => 'App\Facades\Accounts\Request\AccountForgotPasswordFacade',
		'AccountResetPasswordFacade' => 'App\Facades\Accounts\Setting\AccountResetPasswordFacade',
		'AccountLoginFacade' => 'App\Facades\Accounts\AccountLoginFacade',
		'AccountLogoutFacade' => 'App\Facades\Accounts\AccountLogoutFacade',
		'AccountForceLogoutFacade' => 'App\Facades\Accounts\AccountForceLogoutFacade',
		'AccountLoginReturnTypeFacade' => 'App\Facades\Accounts\AccountLoginReturnTypeFacade',
		'AccountTypeFacade' => 'App\Facades\Accounts\AccountTypeFacade',

		// Affiliate
		'AffiliateFacade' => 'App\Facades\Affiliates\AffiliateFacade',
		'AffiliateCommissionFacade' => 'App\Facades\Affiliates\Commission\AffiliateCommissionFacade',

		// Tour
		'TourFacade' => 'App\Facades\Tours\TourFacade',
		'TourCommissionFacade' => 'App\Facades\Tours\TourCommissionFacade',
		'TourTraveledFacade' => 'App\Facades\Tours\TourTraveledFacade',

		// Payment
		'PaymentAffiliateCommissionFacade' => 'App\Facades\Payments\PaymentAffiliateCommissionFacade',

		// Dashboard (Affiliate)
		'DashboardAffiliateFacade' => 'App\Facades\Dashboard\Affiliate\Home\DashboardAffiliateFacade',
		'DashboardAffiliateBookedFacade' => 'App\Facades\Dashboard\Affiliate\Home\DashboardAffiliateBookedFacade',
		'DashboardAffiliateCommissionFacade' => 'App\Facades\Dashboard\Affiliate\Home\DashboardAffiliateCommissionFacade',

		'DashboardAffiliateBookedSummaryFacade' => 'App\Facades\Dashboard\Affiliate\Booked\DashboardAffiliateBookedSummaryFacade',
		'DashboardAffiliateBookedSummaryMonthFacade' => 'App\Facades\Dashboard\Affiliate\Booked\DashboardAffiliateBookedSummaryMonthFacade',
		'DashboardAffiliateBookedSummaryYearFacade' => 'App\Facades\Dashboard\Affiliate\Booked\DashboardAffiliateBookedSummaryYearFacade',
		'DashboardAffiliateBookedDaysOfMonthFacade' => 'App\Facades\Dashboard\Affiliate\Booked\DashboardAffiliateBookedDaysOfMonthFacade',
		'DashboardAffiliateBookedMonthlyFacade' => 'App\Facades\Dashboard\Affiliate\Booked\DashboardAffiliateBookedMonthlyFacade',

		'DashboardAffiliateTraveledFacade' => 'App\Facades\Dashboard\Affiliate\Traveled\DashboardAffiliateTraveledFacade',
		'DashboardAffiliateTraveledDaysOfMonthFacade' => 'App\Facades\Dashboard\Affiliate\Traveled\DashboardAffiliateTraveledDaysOfMonthFacade',
		'DashboardAffiliateTraveledMonthlyFacade' => 'App\Facades\Dashboard\Affiliate\Traveled\DashboardAffiliateTraveledMonthlyFacade',
		'DashboardAffiliateTraveledTourFacade' => 'App\Facades\Dashboard\Affiliate\Traveled\DashboardAffiliateTraveledTourFacade',

		'DashboardAffiliateTourFacade' => 'App\Facades\Dashboard\Affiliate\Tours\DashboardAffiliateTourFacade',
		'DashboardAffiliateTourDaysOfMonthFacade' => 'App\Facades\Dashboard\Affiliate\Tours\DashboardAffiliateTourDaysOfMonthFacade',
		'DashboardAffiliateTourMonthlyFacade' => 'App\Facades\Dashboard\Affiliate\Tours\DashboardAffiliateTourMonthlyFacade',

		'DashboardAffiliateCommissionSummaryFacade' => 'App\Facades\Dashboard\Affiliate\Commission\DashboardAffiliateCommissionFacade',
		'DashboardAffiliateCommissionDaysOfMonthFacade' => 'App\Facades\Dashboard\Affiliate\Commission\DashboardAffiliateCommissionDaysOfMonthFacade',
		'DashboardAffiliateCommissionMonthlyFacade' => 'App\Facades\Dashboard\Affiliate\Commission\DashboardAffiliateCommissionMonthlyFacade',
		'DashboardAffiliateCommissionTourFacade' => 'App\Facades\Dashboard\Affiliate\Commission\DashboardAffiliateCommissionTourFacade',

		// Dashboard (Admin)
		'AdminUserManagementFacade' => 'App\Facades\Dashboard\Admin\Users\AdminUserManagementFacade',
		'AdminUserManagementAddFacade' => 'App\Facades\Dashboard\Admin\Users\Add\AdminUserManagementAddFacade',
		'AdminUserManagementEditFacade' => 'App\Facades\Dashboard\Admin\Users\Edit\AdminUserManagementEditFacade',
		'AdminUserManagementEditSaveFacade' => 'App\Facades\Dashboard\Admin\Users\Edit\AdminUserManagementEditSaveFacade',
		'AdminUserManagementDeleteFacade' => 'App\Facades\Dashboard\Admin\Users\Delete\AdminUserManagementDeleteFacade',
		'AdminUserManagementDeleteSaveFacade' => 'App\Facades\Dashboard\Admin\Users\Delete\AdminUserManagementDeleteSaveFacade',
		'AdminUserManagementActiveFacade' => 'App\Facades\Dashboard\Admin\Users\Active\AdminUserManagementActiveFacade',
		'AdminUserManagementActiveSaveFacade' => 'App\Facades\Dashboard\Admin\Users\Active\AdminUserManagementActiveSaveFacade',

		// Dashboard (Member)
		'MemberAccountProfile' => 'App\Facades\Dashboard\Member\Account\MemberAccountProfileFacade',

		// Banks
		'BankFacade' => 'App\Facades\Bank\BankFacade',

	],
];