<?php
namespace App\Facades\Dashboard\Admin\Request;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Dashboard\Admin\Request\AdminUserRequestRepository as AdminUserRequestRepo;

// import model
use App\account as Account;

class AdminUserRequestClass{

	public function __construct(AdminUserRequestRepo $AdminUserRequestRepo){
        $this->AdminUserRequestRepo = $AdminUserRequestRepo;
    }

    // 
    public function UserRequest($data){
        // set data
        $token = array_get($data,'token');
        $request = new Account;

        // check account
        $checkAccount = $this->AdminUserRequestRepo->GetAccountByToken($token);
        if(empty($checkAccount)){
            $request->status = false;
            $request->message = 'Error';
            $request->data = [];

            return $request;
        }

        // get request
        $requestArr = [];
        $getRequest = $this->AdminUserRequestRepo->GetUserRequest();
        if(empty($getRequest)){
            $request->status = false;
            $request->message = 'Error!';
            $request->data = [];

            return $request;
        }

        foreach($getRequest as $value){
            $req = new Account;
            $req->id = $value->account_id;
            $req->requestId = $value->id;
            $req->typeId = $value->type_id;
            $req->statusId = $value->status_id;
            $req->token = $value->token;
            $req->username = $value->username;
            $req->fullname = $value->fullname;
            $req->requestTypeTH = $value->type_th;
            $req->requestTypeEN = $value->type_en;
            $req->requestStatusTH = $value->status_th;
            $req->requestStatusEN = $value->status_en;
            $req->requestDate = \DateFormatFacade::SetShortDate($value->created_at);

            array_push($requestArr, $req);
        }

        $request->status = true;
        $request->message = 'OK';
        $request->data = $requestArr;
        
        return $request;
    }

}