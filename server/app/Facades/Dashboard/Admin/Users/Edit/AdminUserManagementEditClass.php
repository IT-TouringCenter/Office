<?php
namespace App\Facades\Dashboard\Admin\Users\Edit;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Dashboard\Admin\Users\Edit\AdminUserManagementEditRepository as AdminUserManagementEditRepo;

// import model
use App\account as Account;

class AdminUserManagementEditClass{

	public function __construct(AdminUserManagementEditRepo $AdminUserManagementEditRepo){
        $this->AdminUserManagementEditRepo = $AdminUserManagementEditRepo;
    }

    /*
        1. 
    */

    public function AdminUserManagementEdit($data){
        $token = array_get($data,'token');

        // get account by token
        $account = $this->AdminUserManagementEditRepo->GetUserByToken($token);
        
        $user = new Account;
        if($account){
            $user->username = $account[0]->username;
            $user->userType = $account[0]->accountTypeId;
            $user->type = $account[0]->type;
            $user->fullname = $account[0]->fullname;
            $user->email = $account[0]->email;
        }else{
            $user->username = "";
            $user->userType = "";
            $user->type = "";
            $user->fullname = "";
            $user->email = "";
        }

        return $user;
    }
}