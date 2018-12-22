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
        // Check username repeat
        $username = array_get($data,'username');
        $checkAccount = $this->AdminUserManagementAddRepo->CheckAccountRepeat($username);

        if(!empty($checkAccount)){
            $return = new Account;
            $return->status = false;
            $return->message = 'Account is empty';

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

        $return = new Account;
        if($insertAccountProfile){
            $return->status = true;
            $return->message = 'OK';
        }else{
            $return->status = false;
            $return->message = 'Failed!! can\'t save account profile.';
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

}