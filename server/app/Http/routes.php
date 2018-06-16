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

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);