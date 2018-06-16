<?php 
namespace App\Repositories\Payments;

use Carbon\Carbon;

use App\payment_affiliate_commission as PaymentAffiliateCommission;

class PaymentAffiliateCommissionRepository{    

	public function __construct(PaymentAffiliateCommission $PaymentAffiliateCommission){
        $this->PaymentAffiliateCommission = $PaymentAffiliateCommission;
	}

    // Get affiliate commission
    public function GetPaymentAffiliateCommission($accountId){
        $result = \DB::table('payment_affiliate_commissions')
                        ->where('account_id',$accountId)
                        ->where('payment_status_id',1)
                        ->where('is_active',1)
                        ->get();
        return $result;
    }

    // Check minimum affiliate commission
    public function CheckMinimumAffiliateCommission($accountId,$minimumCommission){
        $result = \DB::table('payment_affiliate_commissions')
                        ->where('account_id',$accountId)
                        ->where('commission_amount','>=',$minimumCommission)
                        ->where('is_active',1)
                        ->get();
        return $result;
    }

    // Update payment status = 1 (Pending)
    public function PaymentAffiliateCommissionPending($accountId){
        date_default_timezone_set("Asia/Bangkok");

        $dataUpdate = ['payment_status_id'=>1];
        $result = \DB::table('payment_affiliate_commissions')
                        ->where('account_id',$accountId)
                        ->where('is_active',1)
                        ->update($dataUpdate);
        return $result;
    }

    // Insert payment affiliate commission history (Paid)
    public function SavePaymentAffiliateCommissionHistoryPaid($accountId,$dataSave,$issuedBy){
        date_default_timezone_set("Asia/Bangkok");
        $date = date('Y-m-d H:i:s');
        $data = [
            "account_id"=>$accountId,
            "payment_status_id"=>2,
            "pax"=>$dataSave[0]->pax,
            "adult_pax"=>$dataSave[0]->adult_pax,
            "child_pax"=>$dataSave[0]->child_pax,
            "infant_pax"=>$dataSave[0]->infant_pax,
            "commission_adult"=>$dataSave[0]->commission_adult,
            "commission_child"=>$dataSave[0]->commission_child,
            "commission_total"=>$dataSave[0]->commission_total,
            "commission_bonus"=>$dataSave[0]->commission_bonus,
            "commission_amount"=>$dataSave[0]->commission_amount,
            "payment_date"=>$date,
            "issued_by"=>$issuedBy
        ];

        $result = \DB::table('payment_affiliate_commission_histories')
                        ->insertGetId($data);
        return $result;
    }

    // Reset payment affiliate commission
    public function ResetAffiliateCommission($accountId){
        $data = [
			"payment_status_id"=>0,
			"pax"=>0,
			"adult_pax"=>0,
			"child_pax"=>0,
			"infant_pax"=>0,
			"adult_price"=>0,
			"child_price"=>0,
			"commission_adult"=>0,
			"commission_child"=>0,
			"commission_total"=>0,
			"commission_bonus"=>0,
            "commission_amount"=>0,
            "created_at"=>'000-00-00 00:00:00'
		];
		$result = \DB::table('payment_affiliate_commissions')
                        ->where('account_id',$accountId)
                        ->where('payment_status_id',1)
						->where('is_active',1)
						->update($data);
		return $result;
    }

    // Update is_payment (affiliate commission details)
    public function UpdatePaymentAffiliateCommissionDetail($accountId){
        $data = ["is_payment"=>1];
        $result = \DB::table('affiliate_commission_details')
                        ->where('account_id',$accountId)
                        ->where('is_travel',1)
                        ->where('is_refund',0)
                        ->where('is_active',1)
                        ->update($data);
        return $result;
    }
}