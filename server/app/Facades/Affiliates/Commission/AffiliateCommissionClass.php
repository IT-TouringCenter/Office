<?php
namespace App\Facades\Affiliates\Commission;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Repositories\Affiliates\AffiliateRepository as AffiliateRepo;

use App\account as Account;

class AffiliateCommissionClass{

	public function __construct(AffiliateRepo $AffiliateRepo){
		$this->AffiliateRepo = $AffiliateRepo;
	}

    // Set affiliate commission
    public function SetAffiliateCommission($transactionTourId,$updateBy){
        // get transaction tour
        $getTransactionTour = $this->AffiliateRepo->GetTransactionTourById($transactionTourId);

        // set data
        $this->accountId = $getTransactionTour[0]->account_id;

        // cal commission 10%
        $this->commission = [];
        $updateCommission = $this->CalculateCommission($getTransactionTour,$transactionTourId);
        if($updateCommission=='ture'){
            return 'null';
        }

        // save commission detail
        $commissionDetail = $this->SaveCommissionDetail($getTransactionTour,$transactionTourId,$updateBy);

        // save commission
        $commissionSave = $this->SaveCommission($commissionDetail);

        if($commissionSave){
            return "success";
        }else{
            return "failed";
        }
    }

    // 
    public function CalculateCommission($data,$transactionTourId){
        $pax = $data[0]->pax;
        $adultPax = $data[0]->adult_pax;
        $childPax = $data[0]->child_pax;
        $adultPrice = $data[0]->adult_price;
        $childPrice = $data[0]->child_price;

        $this->commissionAdult = ($adultPax*$adultPrice)*0.10;
        $this->commissionChild = ($childPax*$childPrice)*0.10;

        $this->commission = [
            "commission_adult"=>$this->commissionAdult,
            "commission_child"=>$this->commissionChild
        ];

        // update transaction detail
        $resultUpdate = $this->AffiliateRepo->UpdateAffiliateCommissionByTour($transactionTourId,$this->commission);
        if($resultUpdate){
            return 'true';
        }else{
            return 'false';
        }
    }

    // save commission detail in affiliate_commission_detail
    public function SaveCommissionDetail($data,$transactionTourId,$updateBy){
        // set data
        $data[0]->commission_adult = $this->commissionAdult;
        $data[0]->commission_child = $this->commissionChild;
        $commissionTotal = $this->commissionAdult + $this->commissionChild;
        $commissionBonus = 0;
        $commissionAmount = $commissionTotal + $commissionBonus;

        $dataSave = [
            'account_id'=>$data[0]->account_id,
            'transaction_tour_id'=>$transactionTourId,
            'booked_date'=>$data[0]->book_date,
            'travel_date'=>$data[0]->travel_date,
            'pax'=>$data[0]->pax,
            'adult_pax'=>$data[0]->adult_pax,
            'child_pax'=>$data[0]->child_pax,
            'infant_pax'=>$data[0]->infant_pax,
            'adult_price'=>$data[0]->adult_price,
            'child_price'=>$data[0]->child_price,
            'commission_adult'=>$data[0]->commission_adult,
            'commission_child'=>$data[0]->commission_child,
            'commission_total'=>$commissionTotal,
            'commission_bonus'=>$commissionBonus,
            'commission_amount'=>$commissionAmount,
            'is_travel'=>1,
            'created_by'=>$updateBy
        ];
        // return $dataSave;
        // save commission tour detail
        $saveCommissionDetail = $this->AffiliateRepo->SaveAffiliateCommissionDetail($dataSave);
        return $dataSave;
    }

    //
    public function SaveCommission($data){
        // get affiliate commission
        $getCommission = $this->AffiliateRepo->GetAffiliateCommission($this->accountId);

        // set data
        $pax = array_get($data,'pax') + $getCommission[0]->pax;
        $adultPax = array_get($data,'adult_pax') + $getCommission[0]->adult_pax;
        $childPax = array_get($data,'child_pax') + $getCommission[0]->child_pax;
        $infantPax = array_get($data,'infant_pax') + $getCommission[0]->infant_pax;
        $adultPrice = array_get($data,'adult_price') + $getCommission[0]->adult_price;
        $childPrice = array_get($data,'child_price') + $getCommission[0]->child_price;
        $commissionAdult = array_get($data,'commission_adult') + $getCommission[0]->commission_adult;
        $commissionChild = array_get($data,'commission_child') + $getCommission[0]->commission_child;
        $commissionTotal = array_get($data,'commission_total') + $getCommission[0]->commission_total;
        $commissionBonus = array_get($data,'commission_bonus') + $getCommission[0]->commission_bonus;
        $commissionAmount = array_get($data,'commission_amount') + $getCommission[0]->commission_amount;

        // update commission
        $dataUpdate = [
            'pax'=>$pax,
            'adult_pax'=>$adultPax,
            'child_pax'=>$childPax,
            'infant_pax'=>$infantPax,
            'adult_price'=>$adultPrice,
            'child_price'=>$childPrice,
            'commission_adult'=>$commissionAdult,
            'commission_child'=>$commissionChild,
            'commission_total'=>$commissionTotal,
            'commission_bonus'=>$commissionBonus,
            'commission_amount'=>$commissionAmount
        ];

        // return $dataUpdate;

        $updateCommission = $this->AffiliateRepo->UpdateAffiliateCommission($this->accountId,$dataUpdate);
        return $updateCommission;
    }

}