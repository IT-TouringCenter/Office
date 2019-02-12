<?php
namespace App\Facades\Dashboard\Member\Account;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Dashboard\Member\Account\MemberAccountProfileRepository as MemberAccountProfileRepo;

// import model
use App\account as Account;

class MemberAccountProfileClass{

	public function __construct(MemberAccountProfileRepo $MemberAccountProfileRepo){
        $this->MemberAccountProfileRepo = $MemberAccountProfileRepo;
    }

    // 1. Get account profile
    public function GetAccountProfile($request){
        $token = array_get($request,'token');
        $this->accountProfile = new Account;

        // Check account empty
        $checkAccount = $this->MemberAccountProfileRepo->GetAccountByToken($token);

        // Set account profile
        if($checkAccount){
            $accountId = $checkAccount[0]->id;
            $this->SetAccountProfile($accountId);
        }else{
            $this->accountProfile->status = 'false';
            $this->accountProfile->message = 'Failed';
            $this->accountProfile->data = [];
        }

        return $this->accountProfile;
    }

    // 2. Set account profile
    public function SetAccountProfile($accountId){
        $profileArr = [];

        // Get account profile
        $getAccountProfile = $this->MemberAccountProfileRepo->GetAccountProfileByAccountId($accountId);

        if($getAccountProfile){
            $profile = new Account;

            foreach($getAccountProfile as $value){
                $profile->fullname = $value->fullname;
                $profile->birth = $value->birth;
                $profile->email = $value->email;
                $profile->tel = $value->tel;
                $profile->idNumber = $value->id_number;
                $profile->address = $value->address;
                $profile->nationality = $value->nationality;
                $profile->picture = $value->picture;
                $profile->copyIdCard = $value->copy_id_card;

                array_push($profileArr,$profile);
            }

            $this->accountProfile->status = 'true';
            $this->accountProfile->message = 'OK';
            $this->accountProfile->data = $profileArr;
        }else{
            $this->accountProfile->status = 'false';
            $this->accountProfile->message = 'Failed!';
            $this->accountProfile->data = [];
        }
    }

}