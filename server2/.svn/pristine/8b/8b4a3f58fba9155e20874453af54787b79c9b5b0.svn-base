<?php
    namespace App\Commons\Payment;

    class PaymentHelp{
        public function GetExpireDate(){
            $periods = env("PAYMENT_PERIOD_EXPIRE");
            if($periods == "" || $periods==null){
                $day=0;
                $month=1;
                $year=0;
            } else{
                $paymentPeriods= explode(":",$periods);
                $day = $paymentPeriods[0];
                $month = $paymentPeriods[1];
                $year = $paymentPeriods[2];
            }

            return ['day'=>$day,'month'=>$month,'year'=>$year];
        }        
    }
?>