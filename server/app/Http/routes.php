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

/*=========== Reservation System (Start) =======================*/
// Booking form
Route::get('api/GetDataBooking', 'Reservations\ReservationController@GetDataBooking'); // before booking
Route::get('api/GetAccountCodeData', 'Reservations\ReservationController@GetAccountCodeData'); // account code hotel

Route::get('api/GetBookingStatisticData', 'Reservations\ReservationController@GetBookingStatisticData'); // booking statistics

Route::get('api/GetBookingFormData/{transactionId}', 'Reservations\ReservationController@GetBookingFormData'); // booking form
Route::get('api/GetInvoiceData/{transactionId}', 'Reservations\ReservationController@GetInvoiceData'); // confirmation & invoice

// Transaction Ctrl
Route::post('/api/ReservationSaveBookingData', 'Reservations\TransactionController@ReservationSaveBookingData');
/*=========== Reservation System (End) =========================*/

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);