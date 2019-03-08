<?php
namespace App\Repositories\Dashboard\Member\Request;

use Carbon\Carbon;

class MemberRequestJoinAffiliateRepository{

	public function __construct(){

	}

    // 1. Get account by token
    public function GetAccountByToken($token){
        $result = \DB::table('accounts')
                        ->where('token',$token)
                        ->where('is_active',1)
                        ->get();
        return $result;
    }

    // 2. Update account : accounts table
    public function UpdateAccount($accountId, $accountData){
        $result = \DB::table('accounts')
                        ->where('id',$accountId)
                        ->where('is_active',1)
                        ->update($accountData);
        return $result;
    }

    // 3. Update account profile : account_profiles table
    public function UpdateAccountProfile($accountId, $profileData){
        $result = \DB::table('account_profiles')
                        ->where('account_id',$accountId)
                        ->where('is_active',1)
                        ->update($profileData);
        return $result;
    }
    
    // 4.0 Get account bank : account_book_banks table
    public function GetAccountBank($accountId){
        $result = \DB::table('account_book_banks')
                        ->where('account_id',$accountId)
                        ->where('is_active',1)
                        ->get();
        return $result;
    }

    // 4.1 Insert account bank : account_book_banks table
    public function InsertAccountBank($insertBankData){
        $result = \DB::table('account_book_banks')->insertGetId($insertBankData);
        return $result;
    }

    // 4.2. Update account bank : account_book_banks table
    public function UpdateAccountBank($accountId, $bankData){
        $result = \DB::table('account_book_banks')
                        ->where('account_id',$accountId)
                        ->where('is_active',1)
                        ->update($bankData);
        return $result;
    }

    // 5. Update account advertise : account_profiles table
    public function UpdateAccountAds($accountId, $adsData){
        $result = \DB::table('account_profiles')
                        ->where('account_id',$accountId)
                        ->where('is_active',1)
                        ->update($adsData);
        return $result;
    }

    // 6. Non active request affiliate : account_requests
    public function NonActiveRequestAffiliate($accountId, $requestTypeId){
        $update = ['is_active'=>0];
        $result = \DB::table('account_requests')
                        ->where('account_id',$accountId)
                        ->where('account_request_type_id',$requestTypeId)
                        ->where('is_active',1)
                        ->update($update);
        return $result;
    }

    // 7. Insert request : account_requests table
    public function InsertRequest($requestData){
        $result = \DB::table('account_requests')->insertGetId($requestData);
        return $result;
    }

    // 8. Check account profile
    public function CheckAccountProfile($accountId, $profileData){
        $result = \DB::table('account_profiles as ap')
                        ->join('accounts as a','a.id','=','ap.account_id')
                        ->where('ap.account_id',$accountId)
                        ->where('ap.fullname',array_get($profileData,'fullname'))
                        ->where('ap.birth',array_get($profileData,'birth'))
                        ->where('a.tel',array_get($profileData,'tel'))
                        ->where('a.email',array_get($profileData,'email'))
                        ->where('ap.nationality',array_get($profileData,'nationality'))
                        ->where('ap.address',array_get($profileData,'address'))
                        ->where('ap.id_number',array_get($profileData,'idNumber'))
                        ->where('ap.picture',array_get($profileData,'profilePicture'))
                        ->where('ap.copy_id_card',array_get($profileData,'copyIdCard'))
                        ->where('a.is_active',1)
                        ->where('ap.is_active',1)
                        ->get();
        return $result;
    }
    
    // 9. Check account bank
    public function CheckAccountBank($accountId, $bankData){
        $bank = array_get($bankData,'bank');
        $bankName = array_get($bank,'bankEN')=='Other'?array_get($bankData,'bankOther'):array_get($bank,'bankTH');

        $result = \DB::table('account_book_banks')
                        ->where('account_id',$accountId)
                        ->where('bank_id',array_get($bank,'id'))
                        ->where('account_name',array_get($bankData,'accountName'))
                        ->where('account_no',array_get($bankData,'accountNo'))
                        ->where('bank',$bankName)
                        ->where('branch',array_get($bankData,'branch'))
                        ->where('copy_book',array_get($bankData,'copyBook'))
                        ->where('is_active',1)
                        ->get();
        return $result;
    }

    // 10. Check account url
    public function CheckAccountUrl($accountId, $adsData){
        $result = \DB::table('account_profiles')
                        ->where('account_id',$accountId)
                        ->where('url',array_get($adsData,'url'))
                        ->where('is_active',1)
                        ->get();
        return $result;
    }

}