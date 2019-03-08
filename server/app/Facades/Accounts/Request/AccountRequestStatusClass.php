<?php
namespace App\Facades\Accounts\Request;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Repositories\Accounts\Request\AccountRequestStatusRepository as AccountRequestStatusRepo;

use App\account as Account;

class AccountRequestStatusClass{

	public function __construct(AccountRequestStatusRepo $AccountRequestStatusRepo){
		$this->AccountRequestStatusRepo = $AccountRequestStatusRepo;
    }
    
    /*  

    */

    public function AccountRequestStatus($data){
        // set data
        $token = array_get($data,'token');
        $request = new Account;
        $requestArr = [];

        // check account
        $checkAccount = $this->AccountRequestStatusRepo->GetAccountByToken($token);
        if(empty($checkAccount)){
            $request->status = false;
            $request->message = 'Error';
            $request->data = [];

            return $request;
        }

        // get request status
        $getRequestStatus = $this->AccountRequestStatusRepo->GetAccountRequestStatus($token);
        if(empty($getRequestStatus)){
            $request->status = false;
            $request->message = 'Error!';
            $request->data = [];

            return $request;
        }

        // set data return
        foreach($getRequestStatus as $value){
            $req = new Account;
            $req->id = $value->id;
            $req->statusTH = $value->status_th;
            $req->statusEN = $value->status_en;
            array_push($requestArr, $req);
        }

        $request->status = true;
        $request->message = 'OK';
        $request->data = $requestArr;

        return $request;
    }

}