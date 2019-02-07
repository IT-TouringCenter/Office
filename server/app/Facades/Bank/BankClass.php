<?php
namespace App\Facades\Bank;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Repositories\Bank\BankRepository as BankRepo;

use App\bank as Bank;

class BankClass{

	public function __construct(BankRepo $BankRepo){
		$this->BankRepo = $BankRepo;
	}

	/* ------------------------------------
	 	Logic 
	------------------------------------ */

    // Get bank data
    public function GetBankData(){
        $getBank = $this->BankRepo->GetBank();

        // set data return
        $bankArr = [];
        
        foreach($getBank as $value){
            $bank = new Bank;
            $bank->bankTH = $value->bank_th;
            $bank->bankEN = $value->bank_en;
            $bank->tel = $value->tel;
            $bank->website = $value->website;

            array_push($bankArr,$bank);
        }

        return $bankArr;
    }


}