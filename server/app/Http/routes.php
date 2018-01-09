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
//- Default Laravel
Route::get('/', 'WelcomeController@index');
// Route::post('/api/v1/easybook/ActionPost','WelcomeController@ActionPost');
// Route::get('/api/v1/easybook/test/paypalNotify','WelcomeController@PayPalNotiry');

//- Main Controller
// Route::get('api/v1/GetFooter', 'MainController@GetFooter');
//- Reservation Controller
// Route::get('api/v1/GetDaytripById/{daytrip_id}', 'ReservationController@GetDayTripById');
// Route::get('api/v1/GetOrderNumber/{order_number}', 'ReservationController@GetOrderNumber');
// Route::post('api/v1/SetDataBooking', 'ReservationController@SetDataBooking');
//- Order Summary Controller
// Route::get('api/v1/GetOrderSummary/{order_id}', 'OrderSummaryController@GetOrderSummary');
//- Country Controller
// Route::get('api/v1/GetCountry', 'CountryController@GetCountry');
//- Hotel Controller
// Route::get('api/v1/GetHotel', 'HotelController@GetHotel');
// Route::get('api/v1/GetPartnerHotel', 'HotelController@GetPartnerHotel');

//- Job vacancy
// Route::get('api/v1/GetJobVacancy', 'JobVacancyController@GetJobVacancy');
// Route::get('api/v1/GetJobInformationByDepartment/{vacancy_id}','JobVacancyController@GetJobInformationByDepartment');

//- Authenticate Controller
// Route::post('api/v1/Login' , 'AuthenticateController@Login');

//- Easy book (ICAS)
// Route::get('api/v1/GetHotelIcas' , 'HotelController@GetIcasHotel');
// Route::get('api/v1/GetReserveIcas' , 'ReservationController@GetReserveIcas');

// Route::get('api/v1/{activity_id}/GetTransferIcas', 'EasyBook\Reservation\ReservationController@GetTransferIcas');
// Route::get('api/v1/{activity_id}/GetActivityIcas', 'EasyBook\Reservation\ReservationController@GetActivityIcas');

/*========TransactionController=========*/
// Route::post('api/v1/{activity_id}/SaveBookingReservationIcas', 'EasyBook\Transaction\TransactionController@SaveBookingReservationIcas');
// Route::post('api/v1/transaction/{activity_id}/save' , 'EasyBook\Transaction\TransactionController@Save'); // Transaction ICAS
// Route::get('api/v1/{activity_id}/TestAccess', 'EasyBook\Transaction\TransactionController@TestAccess');
// Route::get('api/v1/transaction/{activity_id}/transaction' , 'EasyBook\Transaction\TransactionController@GetTransactionLastId');
// Route::get('api/v1/easybook/tickets/verify','EasyBook\Transaction\TransactionController@VerifyTickets');

// Route::get('api/v1/{activity_id}/transaction/getdatatransaction/{transactionId}', 'EasyBook\Transaction\TransactionController@GetDataTransactionPaid');
// Route::get('api/v1/{activity_id}/transaction/getInvoice/{transactionId}/{passengerId}', 'EasyBook\Invoice\InvoiceController@GetInvoice');

/*========TicketController=========*/
// Route::get('api/v1/{activityId}/tickets/gettickets/{transactionId}/{passengerId}','EasyBook\Ticket\TicketController@GetTicketsByTransactionId');
// Route::get('api/v1/{activityId}/tickets/getconvticket/{transactionId}','EasyBook\Ticket\TicketController@GetConventionTicketsByTransactionId');
// Route::get('api/v1/{activityId}/tickets/getairpticket/{transactionId}','EasyBook\Ticket\TicketController@GetAirportTicketsByTransactionId');

/*============= Invoice ============*/
// Route::get('api/v1/{activityId}/invoice/gettourinvoice/{transactionId}/{transactionTourId}','EasyBook\Invoice\InvoiceController@GetTourInvoice');
// Route::get('api/v1/{activityId}/invoice/getairportinvoice/{transactionId}','EasyBook\Invoice\InvoiceController@GetAirportInvoice');
// Route::get('api/v1/{activityId}/invoice/getconventioninvoice/{transactionId}','EasyBook\Invoice\InvoiceController@GetCMECCInvoice');
// Route::get('api/v1/ReserveICAS' , 'IcasController@GetTransfer');

//- SessionController

//- Easy Payment Controller
// Route::get('api/v1/easybook/payment/test','EasyBook\Payment\PaymentController@Test');

// Route::post('api/v1/easybook/payment/cancelledpayment', 'EasyBook\Payment\PaymentController@CancelledPayment');
// Route::get('api/v1/easybook/payment/pendingemailpayer','EasyBook\Payment\PaymentController@PendingEmailPayer');
// Route::get('api/v1/easybook/payment/confirm', 'EasyBook\Payment\PaymentController@ConfirmPayment');

// expire payment
// Route::get('api/v1/{activityId}/payment/expire','EasyBook\Payment\PaymentController@ExpirePayment');
//verify expire payment 
// Route::get('api/v1/easybook/payments/verify', 'EasyBook\Payment\PaymentController@VerifyPayments');
// Route::post('api/v1/pay','EasyBook\Payment\PaymentController@store');

// new routes test payment expired
// Route::get('api/v1/{activityId}/payment/expired', 'EasyBook\Payment\PaymentController@ExpiredPayment');

//- Easy Email Controller
//Route::get('api/v1/easybook/testemail','EasyBook\Email\EmailController@TestEMail');
// Route::get('api/v1/easybook/test/getpendingemail','EasyBook\Email\EmailController@GetPendingEmail');
//Route::get('api/v1/easybook/email/pendingnotifytest','EasyBook\Email\EmailController@PendingNotifyTest');
//Route::get('api/v1/easybook/email/paidnotifytemplate','EasyBook\Email\EmailController@GetPaidNotifyTemplate');

// Route::get('api/v1/easybook/email/pendingnotify','EasyBook\Email\EmailController@PendingNofify');

//- Welcome Controller
// Route::get('/verifyticket','WelcomeController@VerifyTicket');
// Route::get('api/v1/{activityId}/easybook/getnationality', 'EasyBook\NationalityController@GetNationality');
// Route::get('api/v1/{activityId}/easybook/getnationality','EasyBook\NationalityController@GetNationality');

// Route::get('api/v1/sendEmailPendingICAS', 'EasyBook\Email\EmailController@SendEmailPendingICAS');

//- Generate transaction id ... for check only
// Route::get('api/generateTransactionId/{transactionId}', 'EasyBook\Transaction\TransactionController@GenerateTransactionID');

//- Report ICAS
// Route::get('api/v1/reportInvoice', 'EasyBook\Report\ReportController@GetInvoiceSummary');
// Route::get('api/v1/reportCMECC', 'EasyBook\Report\ReportController@GetReportCMECC');
// Route::get('api/v1/reportAirport', 'EasyBook\Report\ReportController@GetReportAirport');
// Route::get('api/v1/reportTour', 'EasyBook\Report\ReportController@GetReportTour');

//- Other Controller
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
