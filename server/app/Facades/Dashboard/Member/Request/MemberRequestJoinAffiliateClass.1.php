<?php
namespace App\Facades\Dashboard\Member\Request;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Dashboard\Member\Request\MemberRequestJoinAffiliateRepository as MemberRequestJoinAffiliateRepo;

// import model
use App\account as Account;

class MemberRequestJoinAffiliateClass{

	public function __construct(MemberRequestJoinAffiliateRepo $MemberRequestJoinAffiliateRepo){
        $this->MemberRequestJoinAffiliateRepo = $MemberRequestJoinAffiliateRepo;
        $this->memberType = 2;
        $this->requestType = 2;
        $this->dateNow = Carbon::now('Asia/Bangkok');
    }

    /* ---------- Logic ------------
        1. request join affiliate
        2. check account empty
        3. update account profile
        4. update account bank
        5. update account advertise
        6. insert request

        account type = 2 member
    ----------------------------- */

    // 1. request join affiliate
    public function RequestJoinAffiliate($request){
        // 
        $result = new Account;
        $returnData = new Account;

        // check data post empty
        if(empty(array_get($request,'token')) || empty(array_get($request,'personalInfo')) || empty(array_get($request,'bankInfo')) || empty(array_get($request,'adsInfo'))){
            return 'Empty!';
        }

        // set data
        $token = array_get($request,'token');
        $profileInfo = array_get($request,'personalInfo');
        $bankInfo = array_get($request,'bankInfo');
        $adsInfo = array_get($request,'adsInfo');

        // check account & get account ID
        $accountId = $this->CheckAccount($token);
        if($accountId==null){
            $returnData->status = false;
            $returnData->message = 'Error!';
            $returnData->data = [];
            return $returnData;
        }else{
            $result->account = $accountId;
        }

        // update profile
        // check profile independent
        $checkRecordProfile = $this->MemberRequestJoinAffiliateRepo->CheckRecordProfile($accountId);
        if(empty($checkRecordProfile)){
            // insert new profile record
            $insertProfile = [
                "account_id"=>$accountId,
                "fullname"=>""
            ];
            $this->MemberRequestJoinAffiliateRepo->InsertProfileRecord($insertProfile);
        }

        $checkProfile = $this->MemberRequestJoinAffiliateRepo->CheckAccountProfile($accountId, $profileInfo);
        if(empty($checkProfile)){
            // update
            $userProfile = $this->UpdateUserProfile($accountId, $profileInfo);
            if(empty($userProfile)){
                $returnData->status = false;
                $returnData->message = 'ตรวจสอบข้อมูลส่วนตัวให้ถูกต้อง';
                $returnData->data = [];
                return $returnData;
            }else{
                $result->profile = $userProfile;
            }
        }

        // update bank
        // check bank independent
        $checkBank = $this->MemberRequestJoinAffiliateRepo->CheckAccountBank($accountId, $bankInfo);
        if(empty($checkBank)){
            // update
            $userBank = $this->UpdateUserBankData($accountId, $bankInfo);
            if($userBank==null){
                $returnData->status = false;
                $returnData->message = 'ตรวจสอบข้อมูลบัญชีธนาคารให้ถูกต้อง';
                $returnData->data = [];
                return $returnData;
            }else{
                $result->bank = $userBank;
            }
        }

        // update advertise
        // check advertise independent
        $checkUrl = $this->MemberRequestJoinAffiliateRepo->CheckAccountUrl($accountId, $adsInfo);
        if(empty($checkUrl)){
            // update
            $userAds = $this->UpdateUserAdvertise($accountId, $adsInfo);
            if($userAds==null){
                $returnData->status = false;
                $returnData->message = 'ตรวจสอบช่องทางการโฆษณาให้ถูกต้อง';
                $returnData->data = [];
                return $returnData;
            }else{
                $result->ads = $userAds;
            }
        }

        // insert request
        $requestAff = $this->InsertRequest($accountId);
        if($requestAff==null){
            $returnData->status = false;
            $returnData->message = 'ไม่สามารถส่งคำขอได้';
            $returnData->data = [];
            return $returnData;
        }else{
            $result->request = $requestAff;
        }

        // return data
        $returnData->status = true;
        $returnData->message = 'ส่งคำร้องขอสำเร็จ โปรดรอการตรวจสอบและอนุมัติภายใน 7 วัน';
        $returnData->data = [];

        return $returnData;
    }

    // 2. check account empty
    public function CheckAccount($token){
        $accountId = null;
        $checkAccount = $this->MemberRequestJoinAffiliateRepo->GetAccountByToken($token, $this->memberType);
        
        // 
        if($checkAccount){
            $accountId = $checkAccount[0]->id;
        }else{
            $accountId = null;
        }

        return $accountId;
    }

    // 3. update account profile
    public function UpdateUserProfile($accountId, $profileInfo){
        // set data
        $accountData = [
            'fullname' => array_get($profileInfo,'fullname'),
            'email' => array_get($profileInfo,'email'),
            'tel' => array_get($profileInfo,'tel'),
            'updated_by' => 'System'
        ];
        $profileData = [
            'fullname' => array_get($profileInfo,'fullname'),
            'birth' => array_get($profileInfo,'birth'),
            'id_number' => array_get($profileInfo,'idNumber'),
            'address' => array_get($profileInfo,'address'),
            'nationality' => array_get($profileInfo,'nationality'),
            'picture' => array_get($profileInfo,'profilePicture'),
            'copy_id_card' => array_get($profileInfo,'copyIdCard'),
            'updated_by' => 'System'
        ];

        // update account
        $account = $this->MemberRequestJoinAffiliateRepo->UpdateAccount($accountId, $accountData);

        // update account profile
        $accountProfile = $this->MemberRequestJoinAffiliateRepo->UpdateAccountProfile($accountId, $profileData);
        if(empty($account) || empty($accountProfile)){
            return null;
        }

        return $account;
    }

    // 4. update account bank
    public function UpdateUserBankData($accountId, $bankInfo){
        // set data
        $bank = array_get($bankInfo,'bank');

        // get account bank (check empty records)
        $getAccountBank = $this->MemberRequestJoinAffiliateRepo->GetAccountBank($accountId);
        if(empty($getAccountBank)){
            // set data insert
            $insertBankData = [
                'account_id' => $accountId,
                'bank_id' => array_get($bank,'id'),
                'account_name' => array_get($bankInfo,'accountName'),
                'account_no' => array_get($bankInfo,'accountNo'),
                'bank' => array_get($bank,'bankEN')=='Other'?array_get($bankInfo,'bankOther'):array_get($bank,'bankTH'),
                'branch' => array_get($bankInfo,'branch'),
                'copy_book' => array_get($bankInfo,'copyBook'),
                'created_at' => $this->dateNow
            ];            
            // insert
            $insertBank = $this->MemberRequestJoinAffiliateRepo->InsertAccountBank($insertBankData);
        }else{
            // set data update
            $bankData = [
                'account_id' => $accountId,
                'bank_id' => array_get($bank,'id'),
                'account_name' => array_get($bankInfo,'accountName'),
                'account_no' => array_get($bankInfo,'accountNo'),
                'bank' => array_get($bank,'bankEN')=='Other'?array_get($bankInfo,'bankOther'):array_get($bank,'bankTH'),
                'branch' => array_get($bankInfo,'branch'),
                'copy_book' => array_get($bankInfo,'copyBook'),
                'updated_by' => 'System'
            ];
            // update account bank
            $accountBank = $this->MemberRequestJoinAffiliateRepo->UpdateAccountBank($accountId, $bankData);
        }
        
        if(empty($accountBank)){
            return null;
        }

        return $accountBank;
    }

    // 5. update account advertise
    public function UpdateUserAdvertise($accountId, $adsInfo){
        // set data
        $advertise = array_get($adsInfo,'url');

        $adsData = [
            'url' => $advertise,
            'updated_by' => 'System'
        ];

        // update account ads
        $accountAds = $this->MemberRequestJoinAffiliateRepo->UpdateAccountAds($accountId, $adsData);
        if(empty($accountAds)){
            return null;
        }

        return $accountAds;
    }

    // 6. insert request
    public function InsertRequest($accountId){
        // set data
        $requestData = [
            'account_id' => $accountId,
            'account_request_type_id' => $this->requestType,
            'created_by' => 'System',
            'created_at' => $this->dateNow
        ];

        // update non active request
        $nonActive = $this->MemberRequestJoinAffiliateRepo->NonActiveRequestAffiliate($accountId, $this->requestType);

        // insert account request
        $accountRequest = $this->MemberRequestJoinAffiliateRepo->InsertRequest($requestData);
        if(empty($accountRequest)){
            return null;
        }

        return $accountRequest;
    }

}