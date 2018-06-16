<?php
namespace App\Facades\Payments;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Repositories\Payments\PaymentAffiliateCommissionRepository as PaymentAffiliateCommissionRepo;

use App\payment_affiliate_commission as PaymentAffiliateCommission;

class PaymentAffiliateCommissionClass{

	public function __construct(PaymentAffiliateCommissionRepo $PaymentAffiliateCommissionRepo){
		$this->PaymentAffiliateCommissionRepo = $PaymentAffiliateCommissionRepo;
	}

	/* ------------------------------------
	 	Logic
			1. 	Update payment status pending (after affiliate checked booking)
			2. 	Insert & Reset payment affiliate commissions
				2.1 Insert (Payment affiliate commission history)
				2.2 Reset (Payment affiliate commission)
	------------------------------------ */

	// 1. Update payment status pending (after affiliate checked booking)
	// Update status "Pending"
	public function PaymentAffiliateCommissionPending($data){
		$accountId = array_get($data,'accountId');
		$accountType = array_get($data,'accountTypeId');
		$issuedBy = array_get($data,'issuedBy');
		$minimumCommission = 2000;

		if($accountType==3){
			// 1.1 Check minimum commission for payment
			$checkMinimumCommission = $this->PaymentAffiliateCommissionRepo->CheckMinimumAffiliateCommission($accountId,$minimumCommission);
			if($checkMinimumCommission){
				$updatePaymentPending = $this->UpdatePaymentAffiliateCommissionPending($accountId);
				return $updatePaymentPending;
			}else{
				return "false 1.1";
			}
		}else{
			return "false 1.0";
		}
	}

	// 1.2 Update payment status 'pending'
	public function UpdatePaymentAffiliateCommissionPending($accountId){
		$result = $this->PaymentAffiliateCommissionRepo->PaymentAffiliateCommissionPending($accountId);
		if($result){
			return "true 1.2";
		}else{
			return "false 1.2";
		}
	}

	// 2. Insert & Reset payment affiliate commissions
	public function PaymentAffiliateCommissionPaid($data){
		$accountId = array_get($data,'accountId');
		$accountType = array_get($data,'accountTypeId');
		$issuedBy = array_get($data,'issuedBy');

		if($accountType==3){
			// Get payment affiliate commission
			$getPaymentAffiliateCommission = $this->PaymentAffiliateCommissionRepo->GetPaymentAffiliateCommission($accountId);
			if($getPaymentAffiliateCommission){
				// 2.1 Insert (Payment affiliate commission history)
				$savePaymentHistory = $this->SavePaymentAffiliateCommissionHistory($accountId,$getPaymentAffiliateCommission,$issuedBy);
				return $savePaymentHistory;
			}else{
				return "false 2.0";
			}
		}else{
			return "false 2";
		}
	}

	// 2.1 Insert (Payment affiliate commission history)
	public function SavePaymentAffiliateCommissionHistory($accountId,$dataSave,$issuedBy){
		$result = $this->PaymentAffiliateCommissionRepo->SavePaymentAffiliateCommissionHistoryPaid($accountId,$dataSave,$issuedBy);
		if($result){
			$reset = $this->ResetPaymentAffiliateCommission($accountId);
			return $result;
		}else{
			return "false 2.1";
		}
	}

	// 2.2 Reset (Payment affiliate commission)
	public function ResetPaymentAffiliateCommission($accountId){
		$result = $this->PaymentAffiliateCommissionRepo->ResetAffiliateCommission($accountId);
		if($result){
			$updatePayment = $this->UpdatePaymentAffiliateCommissionDetail($accountId);
			return $updatePayment;
		}else{
			return "false 2.2";
		}
	}

	// 2.3 Update is_payment = 1 (Affiliate commission details)
	public function UpdatePaymentAffiliateCommissionDetail($accountId){
		$result = $this->PaymentAffiliateCommissionRepo->UpdatePaymentAffiliateCommissionDetail($accountId);
		if($result){
			return "true 2.3";
		}else{
			return "false 2.3";
		}
	}
}