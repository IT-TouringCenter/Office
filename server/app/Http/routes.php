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

	// Tours
	Route::get('api/Tours/GetTourData', 'Tours\TourController@GetTour');
/*----------- Reservation System (Start) -----------------------*/
	// Rerservation Ctrl (Get data)
	Route::get('api/Reservations/GetAccountCodeData', 'Reservations\ReservationController@GetAccountCodeData');
	Route::get('api/Reservations/GetDataBooking', 'Reservations\ReservationController@GetDataBooking');
	Route::get('api/Reservations/GetBookingStatisticData', 'Reservations\ReservationController@GetBookingStatisticData'); // acc rsvn
	Route::get('api/Reservations/GetBookingFormData/{transactionId}', 'Reservations\ReservationController@GetBookingFormData');
	Route::get('api/Reservations/GetBookingFormEdit/{transactionId}', 'Reservations\ReservationController@GetBookingFormEdit');
	Route::get('api/Reservations/GetInvoiceData/{transactionId}', 'Reservations\ReservationController@GetInvoiceData');
	
	Route::post('api/reservations/GetBookedByAccountId', 'Reservations\ReservationController@GetBookedByAccountId'); // affiliate

	//- Transaction Ctrl (Save booking)
	Route::post('api/Reservations/ReservationSaveBookingData', 'Reservations\TransactionController@ReservationSaveBookingData');
	Route::post('api/Reservations/EditReservation', 'Reservations\TransactionController@EditReservation');
	Route::post('api/Reservations/UpdateTourTraveled', 'Reservations\TransactionController@UpdateTourTraveled');
	Route::post('api/Reservations/AutoUpdateTraveled', 'Reservations\TransactionController@AutoUpdateTourTraveled');
	Route::post('api/Reservations/GetTourTraveling', 'Reservations\TransactionController@GetTourTraveling');
	Route::post('api/Reservations/GetUpdateTraveled', 'Reservations\TransactionController@GetUpdateTraveled');
	Route::post('api/Reservations/UpdateTraveled', 'Reservations\TransactionController@UpdateTraveled');
/*----------- Reservation System (End) -------------------------*/

/*----------- Affiliate booking (Start) : website call to API ----------*/
	Route::post('api/Bookings/SaveBookingOnline', 'Bookings\BookingController@SaveBookingOnline');
	Route::post('api/Bookings/UpdateBookingPayment', 'Bookings\BookingController@UpdateBookingPayment');
/*----------- Affiliate booking (End) ----------------------------------*/

/*----------- Payment (Start) ----------------------------------*/
	// Payment affiliate commission (update)
	Route::post('api/Payments/PaymentAffiliateCommissionPending', 'Payments\PaymentController@PaymentAffiliateCommissionPending');
	Route::post('api/Payments/PaymentAffiliateCommissionPaid', 'Payments\PaymentController@PaymentAffiliateCommissionPaid');
/*----------- Payment (End) ------------------------------------*/

/*----------- Tour (Start) -------------------------------------*/
	Route::post('api/Tours/UpdateTourTraveled', 'Tours\TourController@UpdateTourTraveled');
	Route::post('api/Tours/UpdateTourTraveledPerBook', 'Tours\TourController@UpdateTourTraveledPerBook');
/*----------- Tour (End) ---------------------------------------*/

/*----------- Login (Start) ------------------------------------*/
	Route::post('api/Account/GetAccountByToken', 'Accounts\AccountController@GetAccountByToken');

	Route::post('api/Account/Register/CheckEmailRepeat', 'Accounts\Register\AccountRegisterController@CheckEmailRepeat');
	Route::post('api/Account/Register/AccountRegister', 'Accounts\Register\AccountRegisterController@AccountRegister');

	Route::get('api/Account/Register/GetAccountRegisterConfirm/{accountToken}', 'Accounts\Register\AccountRegisterConfirmController@GetAccountRegisterConfirm');
	Route::post('api/Account/Register/CheckConfirmCode', 'Accounts\Register\AccountRegisterConfirmController@CheckConfirmCode');
	Route::post('api/Account/Register/AccountRegisterConfirm', 'Accounts\Register\AccountRegisterConfirmController@AccountRegisterConfirm');
	Route::post('api/Account/Register/AccountRegisterConfirmCodeAgain', 'Accounts\Register\AccountRegisterConfirmController@AccountRegisterConfirmCodeAgain');

	Route::post('api/Account/Request/AccountForgotPassword', 'Accounts\Request\AccountForgotPasswordController@AccountForgotPassword');
	Route::post('api/Account/Setting/AccountResetPassword', 'Accounts\Setting\AccountResetPasswordController@AccountResetPassword');

	Route::post('api/Account/AccountLogin', 'Accounts\AccountLoginController@AccountLogin');
	Route::post('api/Account/AccountLogout', 'Accounts\AccountLogoutController@AccountLogout');

	Route::get('api/Account/GetAccountForceLogout/{accountToken}', 'Accounts\AccountController@GetAccountLoginByToken');
	Route::post('api/Account/GetAccountLoginData', 'Accounts\AccountController@GetAccountLoginByToken');
	Route::post('api/Account/AccountForceLogout', 'Accounts\AccountForceLogoutController@AccountForceLogout');
	
	Route::post('api/Account/AccountSessionLogin', 'Accounts\AccountLoginController@AccountSessionLogin');
	Route::post('api/Account/AccountSessionLoginReturnType', 'Accounts\AccountLoginController@AccountSessionLoginReturnType');
	Route::post('api/Account/CheckAccountLoginExpired', 'Accounts\AccountLoginController@CheckAccountLoginExpired');

	Route::get('api/Account/GetAccountType', 'Accounts\AccountController@GetAccountType');
/*----------- Login (End) --------------------------------------*/

/*----------- Bank (Start) -------------------------------------*/
	Route::get('api/Bank/GetBankData', 'Bank\BankController@GetBankData');
/*----------- Bank (End) ---------------------------------------*/

/*----------- Dashboard (Start) --------------------------------*/
	// Affiliate
	Route::post('api/Dashboard/Affiliate', 'Dashboard\Affiliate\Home\DashboardAffiliateController@AffiliateDashboard');
	Route::post('api/Dashboard/Affiliate/Booked', 'Dashboard\Affiliate\Home\DashboardAffiliateController@AffiliateDashboardBooked');
	Route::post('api/Dashboard/Affiliate/Commission', 'Dashboard\Affiliate\Home\DashboardAffiliateController@AffiliateDashboardCommission');

	Route::post('api/Dashboard/Affiliate/Booked/Summary', 'Dashboard\Affiliate\Booked\DashboardAffiliateBookedController@AffiliateDashboardBookedSummary');
	Route::post('api/Dashboard/Affiliate/Booked/Summary/Month', 'Dashboard\Affiliate\Booked\DashboardAffiliateBookedController@AffiliateDashboardBookedSummaryMonth');
	Route::post('api/Dashboard/Affiliate/Booked/Summary/Year', 'Dashboard\Affiliate\Booked\DashboardAffiliateBookedController@AffiliateDashboardBookedSummaryYear');
	Route::post('api/Dashboard/Affiliate/Booked/DaysOfMonth', 'Dashboard\Affiliate\Booked\DashboardAffiliateBookedController@AffiliateDashboardBookedDaysOfMonth');
	Route::post('api/Dashboard/Affiliate/Booked/Monthly', 'Dashboard\Affiliate\Booked\DashboardAffiliateBookedController@AffiliateDashboardBookedMonthly');

	Route::post('api/Dashboard/Affiliate/Traveled', 'Dashboard\Affiliate\Traveled\DashboardAffiliateTraveledController@AffiliateDashboardTraveled');
	Route::post('api/Dashboard/Affiliate/Traveled/DaysOfMonth', 'Dashboard\Affiliate\Traveled\DashboardAffiliateTraveledController@AffiliateDashboardTraveledDaysOfMonth');
	Route::post('api/Dashboard/Affiliate/Traveled/Monthly', 'Dashboard\Affiliate\Traveled\DashboardAffiliateTraveledController@AffiliateDashboardTraveledMonthly');
	Route::post('api/Dashboard/Affiliate/Traveled/Tour', 'Dashboard\Affiliate\Traveled\DashboardAffiliateTraveledController@AffiliateDashboardTraveledTour');

	Route::post('api/Dashboard/Affiliate/Tour', 'Dashboard\Affiliate\Tours\DashboardAffiliateTourController@AffiliateDashboardTour');
	Route::post('api/Dashboard/Affiliate/Tour/DaysOfMonth', 'Dashboard\Affiliate\Tours\DashboardAffiliateTourController@AffiliateDashboardTourDaysOfMonth');
	Route::post('api/Dashboard/Affiliate/Tour/Monthly', 'Dashboard\Affiliate\Tours\DashboardAffiliateTourController@AffiliateDashboardTourMonthly');

	Route::post('api/Dashboard/Affiliate/Commission/Summary', 'Dashboard\Affiliate\Commission\DashboardAffiliateCommissionController@DashboardAffiliateCommission');
	Route::post('api/Dashboard/Affiliate/Commission/DaysOfMonth', 'Dashboard\Affiliate\Commission\DashboardAffiliateCommissionController@DashboardAffiliateCommissionDaysOfMonth');
	Route::post('api/Dashboard/Affiliate/Commission/Monthly', 'Dashboard\Affiliate\Commission\DashboardAffiliateCommissionController@DashboardAffiliateCommissionMonthly');
	Route::post('api/Dashboard/Affiliate/Commission/Tour', 'Dashboard\Affiliate\Commission\DashboardAffiliateCommissionController@DashboardAffiliateCommissionTour');

	// Admin
	Route::post('api/Dashboard/Admin/UserManagement', 'Dashboard\Admin\Users\AdminUserManagementController@AdminUserManagement');
	Route::post('api/Dashboard/Admin/UserManagement/Add', 'Dashboard\Admin\Users\AdminUserManagementController@AdminUserManagementAdd');

	Route::post('api/Dashboard/Admin/UserManagement/Edit', 'Dashboard\Admin\Users\AdminUserManagementController@AdminUserManagementEdit');
	Route::post('api/Dashboard/Admin/UserManagement/Edit/Save', 'Dashboard\Admin\Users\AdminUserManagementController@AdminUserManagementEditSave');

	Route::post('api/Dashboard/Admin/UserManagement/Delete', 'Dashboard\Admin\Users\AdminUserManagementController@AdminUserManagementDelete');
	Route::post('api/Dashboard/Admin/UserManagement/Delete/Save', 'Dashboard\Admin\Users\AdminUserManagementController@AdminUserManagementDeleteSave');

	Route::post('api/Dashboard/Admin/UserManagement/Active', 'Dashboard\Admin\Users\AdminUserManagementController@AdminUserManagementActive');
	Route::post('api/Dashboard/Admin/UserManagement/Active/Save', 'Dashboard\Admin\Users\AdminUserManagementController@AdminUserManagementActiveSave');

	Route::post('api/Dashboard/Admin/UserManagement/ResetPassword', 'Dashboard\Admin\Users\AdminUserManagementController@AdminUserManagementResetPassword');
	Route::post('api/Dashboard/Admin/UserRequest', 'Dashboard\Admin\Request\AdminUserRequestController@UserRequest');
	Route::post('api/Dashboard/Admin/UserRequest/Update', 'Dashboard\Admin\Request\AdminUserRequestController@UserRequestUpdate');	
	Route::post('api/Dashboard/Admin/GetUserProfile', 'Dashboard\Admin\Users\AdminUserProfileController@UserProfile');

	// Member
	Route::post('api/Dashboard/Member/GetAccountProfile', 'Dashboard\Member\Account\MemberAccountProfileController@GetAccountProfile');
	Route::post('api/Dashboard/Member/RequestJoinAffiliate', 'Dashboard\Member\Request\MemberRequestController@RequestJoinAffiliate');
	Route::post('api/Dashboard/Member/CheckRequestJoinAffiliate', 'Dashboard\Member\Request\MemberRequestController@CheckRequestJoinAffiliate');
	Route::post('api/Dashboard/Member/CancelRequest', 'Dashboard\Member\Request\MemberRequestController@CancelRequest');
	Route::post('api/Dashboard/Member/Approval', 'Dashboard\Member\Approval\MemberApprovalController@MemberApproval');

	// Manager
	Route::post('api/Dashboard/Manager/GetAffiliateAccount', 'Dashboard\Manager\Affiliate\ManagerAffiliateController@GetAffiliateAccount');

	Route::post('api/Dashboard/Manager/AffiliateManagement', 'Dashboard\Manager\Affiliate\ManagerAffiliateManagementController@AffiliateManagement');
	Route::post('api/Dashboard/Manager/AffiliateManagement/Detail', 'Dashboard\Manager\Affiliate\ManagerAffiliateManagementController@AffiliateManagementDetail');
	Route::post('api/Dashboard/Manager/AffiliateManagement/CommissionRate', 'Dashboard\Manager\Affiliate\ManagerAffiliateManagementController@AffiliateManagementCommissionRate');
	Route::post('api/Dashboard/Manager/AffiliateManagement/CommissionRate/Update', 'Dashboard\Manager\Affiliate\ManagerAffiliateManagementController@AffiliateUpdateCommissionRate');
	Route::post('api/Dashboard/Manager/AffiliateManagement/CommissionRate/UpdateAll', 'Dashboard\Manager\Affiliate\ManagerAffiliateManagementController@AffiliateUpdateAllCommissionRate');

	Route::post('api/Dashboard/Manager/Booked', 'Dashboard\Manager\Booked\ManagerBookedController@BookedSummary');
	Route::post('api/Dashboard/Manager/Booked/Table', 'Dashboard\Manager\Booked\ManagerBookedController@BookedTable');
	Route::post('api/Dashboard/Manager/Booked/DaysOfMonth', 'Dashboard\Manager\Booked\ManagerBookedController@BookedDaysOfMonth');
	Route::post('api/Dashboard/Manager/Booked/Monthly', 'Dashboard\Manager\Booked\ManagerBookedController@BookedMonthly');
	Route::post('api/Dashboard/Manager/Booked/Tour', 'Dashboard\Manager\Booked\ManagerBookedController@BookedTour');

	Route::post('api/Dashboard/Manager/AffiliateBooked', 'Dashboard\Manager\Booked\ManagerAffiliateBookedController@AffiliateBookedSummary');
	Route::post('api/Dashboard/Manager/AffiliateBooked/Table', 'Dashboard\Manager\Booked\ManagerAffiliateBookedController@AffiliateBookedTable');
	Route::post('api/Dashboard/Manager/AffiliateBooked/DaysOfMonth', 'Dashboard\Manager\Booked\ManagerAffiliateBookedController@AffiliateBookedDaysOfMonth');
	Route::post('api/Dashboard/Manager/AffiliateBooked/Monthly', 'Dashboard\Manager\Booked\ManagerAffiliateBookedController@AffiliateBookedMonthly');
	Route::post('api/Dashboard/Manager/AffiliateBooked/Tour', 'Dashboard\Manager\Booked\ManagerAffiliateBookedController@AffiliateBookedTour');

	// Request
	Route::post('api/Account/AccountRequestStatus', 'Accounts\Request\AccountRequestStatusController@AccountRequestStatus');

	/*----------- Dashboard (End) --------------------------------*/

// Test Email
	Route::get('api/TestMail', 'TestMailController@TestMail');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);