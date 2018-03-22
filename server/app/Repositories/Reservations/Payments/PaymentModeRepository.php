<?php 
namespace App\Repositories\Reservations\Payments;

class PaymentModeRepository{    

	public function __construct(){
		
	}

	// Get payment mode by mode
	public function GetPaymentModeByMode($paymentMode){
                $result = \DB::table('payment_modes')
                                ->where('mode',$paymentMode)
                                ->where('is_active',1)
                                ->get();
                return $result;
	}

}