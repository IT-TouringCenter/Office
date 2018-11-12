<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

/*----------- Reservation System (Start) -----------------------*/
// Rerservation Ctrl (Get data)
	// Account code (agent, hotel)
	Route::get('api/Reservations/GetAccountCodeData', 'Reservations\ReservationController@GetAccountCodeData');
	// Reservation Form
	Route::get('api/Reservations/GetDataBooking', 'Reservations\ReservationController@GetDataBooking');
	// Booking Statistics
	Route::get('api/Reservations/GetBookingStatisticData', 'Reservations\ReservationController@GetBookingStatisticData');
	// Booking Form (print)
	Route::get('api/Reservations/GetBookingFormData/{transactionId}', 'Reservations\ReservationController@GetBookingFormData');
	// Booking Form (edit)
	Route::get('api/Reservations/GetBookingFormEdit/{transactionId}', 'Reservations\ReservationController@GetBookingFormEdit');
	// Invoice (print)
	Route::get('api/Reservations/GetInvoiceData/{transactionId}', 'Reservations\ReservationController@GetInvoiceData');
	// Booked by account id
	Route::post('api/reservations/GetBookedByAccountId', 'Reservations\ReservationController@GetBookedByAccountId');

// Transaction Ctrl (Save booking)
	// Save booking (offline insert & edit)
	Route::post('api/Reservations/ReservationSaveBookingData', 'Reservations\TransactionController@ReservationSaveBookingData');
	// Edit, Update booking
	Route::post('api/Reservations/EditReservation', 'Reservations\TransactionController@EditReservation');
/*----------- Reservation System (End) -------------------------*/

/*----------- Affiliate (Start) --------------------------------*/
	// Save booking
	Route::post('api/Bookings/SaveBookingOnline', 'Bookings\BookingController@SaveBookingOnline');
	// Update booking payment
	Route::post('api/Bookings/UpdateBookingPayment', 'Bookings\BookingController@UpdateBookingPayment');
/*----------- Affiliate (End) ----------------------------------*/

/*----------- Payment (Start) ----------------------------------*/
	// Payment affiliate commission (update)
	Route::post('api/Payments/PaymentAffiliateCommissionPending', 'Payments\PaymentController@PaymentAffiliateCommissionPending');
	Route::post('api/Payments/PaymentAffiliateCommissionPaid', 'Payments\PaymentController@PaymentAffiliateCommissionPaid');
/*----------- Payment (End) ------------------------------------*/

/*----------- Tour (Start) -------------------------------------*/
	// Update tour traveled
	Route::post('api/Tours/UpdateTourTraveled', 'Tours\TourController@UpdateTourTraveled');
	Route::post('api/Tours/UpdateTourTraveledPerBook', 'Tours\TourController@UpdateTourTraveledPerBook');
/*----------- Tour (End) ---------------------------------------*/

/*----------- Account (Start) ----------------------------------*/
	Route::post('api/Account/GetAccountByToken', 'Accounts\Accountcontroller@GetAccountByToken');
	// Register
	Route::post('api/Account/Register/CheckEmailRepeat', 'Accounts\Register\AccountRegisterController@CheckEmailRepeat');
	Route::post('api/Account/Register/AccountRegister', 'Accounts\Register\AccountRegisterController@AccountRegister');
	// confirm register
	// Route::post('api/Account/Register/GetAccountRegisterConfirm', 'Accounts\Register\AccountRegisterConfirmController@GetAccountRegisterConfirm');
	Route::get('api/Account/Register/GetAccountRegisterConfirm/{accountToken}', 'Accounts\Register\AccountRegisterConfirmController@GetAccountRegisterConfirm');
	Route::post('api/Account/Register/CheckConfirmCode', 'Accounts\Register\AccountRegisterConfirmController@CheckConfirmCode');
	Route::post('api/Account/Register/AccountRegisterConfirm', 'Accounts\Register\AccountRegisterConfirmController@AccountRegisterConfirm');
	Route::post('api/Account/Register/AccountRegisterConfirmCodeAgain', 'Accounts\Register\AccountRegisterConfirmController@AccountRegisterConfirmCodeAgain');
	// forgot password
	Route::post('api/Account/Request/AccountForgotPassword', 'Accounts\Request\AccountForgotPasswordController@AccountForgotPassword');

	Route::post('api/Account/Setting/AccountResetPassword', 'Accounts\Setting\AccountResetPasswordController@AccountResetPassword');
	// login
	Route::post('api/Account/AccountLogin', 'Accounts\AccountLoginController@AccountLogin');
	// logout
	Route::post('api/Account/AccountLogout', 'Accounts\AccountLogoutController@AccountLogout');
	Route::get('api/Account/GetAccountForceLogout/{accountToken}', 'Accounts\AccountController@GetAccountLoginByToken');
	Route::post('api/Account/GetAccountLoginData', 'Accounts\AccountController@GetAccountLoginByToken');
	Route::post('api/Account/AccountForceLogout', 'Accounts\AccountForceLogoutController@AccountForceLogout');
	// session login
	Route::post('api/Account/AccountSessionLogin', 'Accounts\AccountLoginController@AccountSessionLogin');
	Route::post('api/Account/CheckAccountLoginExpired', 'Accounts\AccountLoginController@CheckAccountLoginExpired');
/*----------- Account (End) ------------------------------------*/

/*----------- Dashboard (Start) --------------------------------*/
	// Dashboard
	Route::post('api/Dashboard/Affiliate', 'Dashboard\Affiliate\Home\DashboardAffiliateController@AffiliateDashboard');
	Route::post('api/Dashboard/Affiliate/Booked', 'Dashboard\Affiliate\Home\DashboardAffiliateController@AffiliateDashboardBooked');
	Route::post('api/Dashboard/Affiliate/Commission', 'Dashboard\Affiliate\Home\DashboardAffiliateController@AffiliateDashboardCommission');
	// Booked
	Route::post('api/Dashboard/Affiliate/Booked/Summary', 'Dashboard\Affiliate\Booked\DashboardAffiliateBookedController@AffiliateDashboardBookedSummary');
	Route::post('api/Dashboard/Affiliate/Booked/Summary/Month', 'Dashboard\Affiliate\Booked\DashboardAffiliateBookedController@AffiliateDashboardBookedSummaryMonth');
	Route::post('api/Dashboard/Affiliate/Booked/Summary/Year', 'Dashboard\Affiliate\Booked\DashboardAffiliateBookedController@AffiliateDashboardBookedSummaryYear');
	Route::post('api/Dashboard/Affiliate/Booked/DaysOfMonth', 'Dashboard\Affiliate\Booked\DashboardAffiliateBookedController@AffiliateDashboardBookedDaysOfMonth');
	Route::post('api/Dashboard/Affiliate/Booked/Monthly', 'Dashboard\Affiliate\Booked\DashboardAffiliateBookedController@AffiliateDashboardBookedMonthly');
	// Traveled
	Route::post('api/Dashboard/Affiliate/Traveled', 'Dashboard\Affiliate\Traveled\DashboardAffiliateTraveledController@AffiliateDashboardTraveled');
	Route::post('api/Dashboard/Affiliate/Traveled/DaysOfMonth', 'Dashboard\Affiliate\Traveled\DashboardAffiliateTraveledController@AffiliateDashboardTraveledDaysOfMonth');
	Route::post('api/Dashboard/Affiliate/Traveled/Monthly', 'Dashboard\Affiliate\Traveled\DashboardAffiliateTraveledController@AffiliateDashboardTraveledMonthly');
	Route::post('api/Dashboard/Affiliate/Traveled/Tour', 'Dashboard\Affiliate\Traveled\DashboardAffiliateTraveledController@AffiliateDashboardTraveledTour');
	// Tour
	Route::post('api/Dashboard/Affiliate/Tour', 'Dashboard\Affiliate\Tours\DashboardAffiliateTourController@AffiliateDashboardTour');
	Route::post('api/Dashboard/Affiliate/Tour/DaysOfMonth', 'Dashboard\Affiliate\Tours\DashboardAffiliateTourController@AffiliateDashboardTourDaysOfMonth');
	Route::post('api/Dashboard/Affiliate/Tour/Monthly', 'Dashboard\Affiliate\Tours\DashboardAffiliateTourController@AffiliateDashboardTourMonthly');
	// Commission
	Route::post('api/Dashboard/Affiliate/Commission/Summary', 'Dashboard\Affiliate\Commission\DashboardAffiliateCommissionController@DashboardAffiliateCommission');
	Route::post('api/Dashboard/Affiliate/Commission/DaysOfMonth', 'Dashboard\Affiliate\Commission\DashboardAffiliateCommissionController@DashboardAffiliateCommissionDaysOfMonth');
	Route::post('api/Dashboard/Affiliate/Commission/Monthly', 'Dashboard\Affiliate\Commission\DashboardAffiliateCommissionController@DashboardAffiliateCommissionMonthly');
	Route::post('api/Dashboard/Affiliate/Commission/Tour', 'Dashboard\Affiliate\Commission\DashboardAffiliateCommissionController@DashboardAffiliateCommissionTour');
/*----------- Dashboard (End) ----------------------------------*/

// Test Email
	Route::get('api/TestMail', 'TestMailController@TestMail');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);