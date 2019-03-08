<?php
namespace App\Facades\Dashboard\Admin\Users\Add;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Dashboard\Admin\Users\Add\AdminUserManagementAddRepository as AdminUserManagementAddRepo;

// import model
use App\account as Account;

class AdminUserManagementAddClass{

	public function __construct(AdminUserManagementAddRepo $AdminUserManagementAddRepo){
        $this->AdminUserManagementAddRepo = $AdminUserManagementAddRepo;
        $this->dateNow = Carbon::now('Asia/Bangkok');
    }

    /*
        1. check account repeat
        2. generate token
        3. generate active code
        4. encode password
        5. save account
        6. save account profile
    */

    public function AdminUserManagementAdd($data){
        $return = new Account;

        // Check username repeat
        $username = array_get($data,'username');
        $checkAccount = $this->AdminUserManagementAddRepo->CheckAccountRepeat($username);

        if(!empty($checkAccount)){
            $return->status = false;
            $return->message = 'This account repeat.';

            return $return;
        }

        // Generate token
        $token = \GenerateCodeFacade::GenerateToken();

        // Generate active code
        $activeCode = \GenerateCodeFacade::CreateActiveCode();

        // Encode password
        $password = \GenerateCodeFacade::Encode(array_get($data,'password'));

        // Set date
        $date = Carbon::now('Asia/Bangkok');
        $tomorrow = \DateFormatFacade::SetTomorrow($date);

        // Save account [register]
        $registerBy = array_get($data,'accountName');
        $dataSave = [
            "account_type_id"=>array_get($data,'accountType'),
            "username"=>$username,
            "password"=>$password,
            "fullname"=>array_get($data,'fullname'),
            "token"=>$token,
            "email"=>array_get($data,'email'),
            "active_code"=>$activeCode,
            "active_expired"=>$tomorrow,
            "is_active"=>1,
            "created_by"=>$registerBy
        ];
        $saveAccount = $this->AdminUserManagementAddRepo->InsertAccount($dataSave);

        // Save account profile [register]
        if($saveAccount){
            $accountId = $saveAccount;
            $insertAccountProfile = $this->InsertAccountProfile($accountId, $dataSave);
        }else{
            return "Failed!! can't save account.";
        }

        if(empty($insertAccountProfile)){
            $return->status = false;
            $return->message = 'Failed!! can\'t save account profile.';
            return $return;
        }

        // Check account type
        $checkAccountType = $this->CreateRecordAffiliate($accountId, array_get($dataSave,'account_type_id'));
        // return $checkAccountType;
        if($checkAccountType=="Affiliate"){
            $return->status = true;
            $return->message = "Affiliate OK";
        }else if($checkAccountType=="Affiliate commission error"){
            $return->status = false;
            $return->message = "Add affiliate commission error";
        }else if($checkAccountType=="Affiliate error"){
            $return->status = false;
            $return->message = "Add affiliate error";
        }else{
            $return->status = true;
            $return->message = "OK";
        }

        return $return;
    }

    // Save account profile
    public function InsertAccountProfile($accountId, $data){
        $setData = [
            "account_id"=>$accountId,
            "fullname"=>array_get($data,'fullname'),
            // "birth"=>array_get($data,'birth'),
            "is_active"=>1
        ];

        $result = $this->AdminUserManagementAddRepo->InsertAccountProfile($setData);
        return $result;
    }

    // Create record into affiliates table
    public function CreateRecordAffiliate($accountId, $accountTypeId){
        $comRate = 0;
        $checkAccountType = $this->AdminUserManagementAddRepo->CheckAccountType($accountId, $accountTypeId);

        if(empty($checkAccountType)){
            return false;    
        }
        $accountType = $checkAccountType[0]->type;
        if($accountType=="Affiliate"){
            $comRate = 10;
        }else if("Affiliate intern"){
            $comRate = 5;
        }else{
            return false;
        }

        // create affiliate_commissions
        $affiliateCommission = [
            "account_id"=>$accountId,
            "created_at"=>$this->dateNow
        ];
        $insertAffiliateCommission = $this->AdminUserManagementAddRepo->InsertAffiliateCommission($affiliateCommission);
        if(empty($insertAffiliateCommission)){
            return "Affiliate commission error";
        }

        // create affiliate_commission_tour_rates
        // get tour id
        $insertCount = 0;
        $getTour = $this->AdminUserManagementAddRepo->GetTour();
        foreach($getTour as $value){
            $affiliateCommissionTourRate = [
                "account_id"=>$accountId,
                "tour_id"=>$value->id,
                "min_pax"=>1,
                "max_pax"=>20,
                "price_rate"=>$comRate,
                "created_at"=>$this->dateNow
            ];
            $insertAffiliateCommissionTourRate = $this->AdminUserManagementAddRepo->InsertAffiliateCommissionTourRate($affiliateCommissionTourRate);
            $insertCount++;
        }

        if($insertCount > 0){
            return "Affiliate";
        }else{
            return "Affiliate error";
        }
    }

}