<?php
namespace App\Facades\Dashboard\Admin\Users\Profile;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Dashboard\Admin\Users\Profile\AdminUserProfileRepository as AdminUserProfileRepo;

// import model
use App\account as Account;

class AdminUserProfileClass{

	public function __construct(AdminUserProfileRepo $AdminUserProfileRepo){
        $this->AdminUserProfileRepo = $AdminUserProfileRepo;
        $this->AccountTypeId = 4;
    }

    // 
    public function UserProfile($data){
        // set data
        $token = array_get($data,'token');
        $returnData = new Account;
        $profileData = new Account;
        $bankData = new Account;

        // check account
        $checkAccount = $this->AdminUserProfileRepo->GetAccountByToken($token);
        if(empty($checkAccount)){
            $returnData->status = false;
            $returnData->message = 'Error';
            $returnData->data = [];

            return $returnData;
        }
        $accountId = $checkAccount[0]->id;

        // check request
        $checkRequest = $this->AdminUserProfileRepo->CheckAccountRequest($accountId);
        if(empty($checkRequest)){
            $returnData->status = false;
            $returnData->message = 'Error!';
            $returnData->data = [];
            
            return $returnData;
        }

        // get profile data & url
        $getProfileData = $this->AdminUserProfileRepo->GetProfileData($accountId);
        if(empty($getProfileData)){
            $returnData->status = false;
            $returnData->message = 'Error!!';
            $returnData->data = [];

            return $returnData;
        }else{
            $profileData->fullname = $getProfileData[0]->fullname;
            // $profileData->birth = $getProfileData[0]->birth;
            $profileData->birth = \DateFormatFacade::SetFullDate($getProfileData[0]->birth);
            $profileData->tel = $getProfileData[0]->tel;
            $profileData->email = $getProfileData[0]->email;
            $profileData->nationality = $getProfileData[0]->nationality;
            $profileData->address = $getProfileData[0]->address;
            $profileData->idNumber = $getProfileData[0]->id_number;
            $profileData->profilePicture = $getProfileData[0]->picture;
            $profileData->copyIdCard = $getProfileData[0]->copy_id_card;
            $profileData->url1 = $getProfileData[0]->url1; // advertise
            $profileData->url2 = $getProfileData[0]->url2;
            $profileData->url3 = $getProfileData[0]->url3;
        }

        // get bank data
        $getBookBank = $this->AdminUserProfileRepo->GetBookBankData($accountId);
        if(empty($getBookBank)){
            $returnData->status = false;
            $returnData->message = 'Error#!';
            $returnData->data = [];

            return $returnData;
        }else{
            $bankData->accountName = $getBookBank[0]->account_name;
            $bankData->accountNo = $getBookBank[0]->account_no;
            // $bankData->bankTH = $getBookBank[0]->bank_th;
            // $bankData->bankEN = $getBookBank[0]->bank_en;
            // $bankData->bankOther = $getBookBank[0]->bank_other;
            $bankData->branch = $getBookBank[0]->branch;
            $bankData->copyBook = $getBookBank[0]->copy_book;
        }
        $getBank = $this->AdminUserProfileRepo->GetBankById($getBookBank[0]->id);
        if(empty($getBank)){
            $returnData->status = false;
            $returnData->message = 'Error#!!';
            $returnData->data = [];

            return $returnData;
        }else{
            if($getBank[0]->bank_en=='Other'){
                $bankData->bankTH = '';
                $bankData->bankEN = '';
                $bankData->bankOther = $getBookBank[0]->bank;
            }else{
                $bankData->bankTH = $getBank[0]->bank_th;
                $bankData->bankEN = $getBank[0]->bank_en;
                $bankData->bankOther = '';
            }
        }

        // set data format
        $setData = new Account;
        $setData->users = $data;
        $setData->profile = $profileData;
        $setData->bank = $bankData;
        $setData->url1 = $getProfileData[0]->url1;
        $setData->url2 = $getProfileData[0]->url2;
        $setData->url3 = $getProfileData[0]->url3;

        // return
        $returnData->status = true;
        $returnData->message = 'OK';
        $returnData->data = $setData;

        return $returnData;
    }

}