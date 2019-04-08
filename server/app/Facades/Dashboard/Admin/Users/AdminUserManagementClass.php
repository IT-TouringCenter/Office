<?php
namespace App\Facades\Dashboard\Admin\Users;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Dashboard\Admin\Users\AdminUserManagementRepository as AdminUserManagementRepo;

// import model
use App\account as Account;

class AdminUserManagementClass{

	public function __construct(AdminUserManagementRepo $AdminUserManagementRepo){
        $this->AdminUserManagementRepo = $AdminUserManagementRepo;
    }

    // 
    public function AdminUserManagement($data){
        $token = array_get($data,'token');
        $type = array_get($data,'type');

        // get account
        $account = $this->AdminUserManagementRepo->GetAccountByTokenAndType($token,$type);
        if($account){
            $accountId = $account[0]->id;
        }else{
            return "null";
        }

        $userArr = [];
        // get account data
        $getAccountData = $this->AdminUserManagementRepo->GetAccountData();

        foreach($getAccountData as $value){
            $user = new Account;
            $user->userId = $value->id;
            $user->token = $value->token;
            $user->type = $value->type;
            $user->username = $value->username;
            $user->fullname = $value->fullname;
            $user->email = $value->email;
            $user->registerDate = \DateFormatFacade::SetFullDate($value->regisDate);
            $user->active = $value->isActive;

            if($value->isActive==1){
                $active = 'Active';
            }else{
                $active = 'Non active';
            }
            $user->status = $active;

            array_push($userArr,$user);
        }

        return $userArr;
    }

    // 

}