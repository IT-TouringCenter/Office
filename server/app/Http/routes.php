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
	Route::post('api/Dashboard/Affiliate/', 'Dashboard\Affiliate\AffiliateController@Affiliate');
/*----------- Dashboard (End) ----------------------------------*/

// Test Email
	Route::get('api/TestMail', 'TestMailController@TestMail');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);