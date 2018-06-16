<?php
namespace App\Facades\Affiliates;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Repositories\Affiliates\AffiliateRepository as AffiliateRepo;

use App\account as Account;

class AffiliateClass{

	public function __construct(AffiliateRepo $AffiliateRepo){
		$this->AffiliateRepo = $AffiliateRepo;
	}

    // Get affiliate commission
    public function GetAffiliateCommission(){
        
    }


}