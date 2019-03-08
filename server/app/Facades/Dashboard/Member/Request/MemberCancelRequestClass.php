<?php
namespace App\Facades\Dashboard\Member\Request;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Dashboard\Member\Request\MemberCancelRequestRepository as MemberCancelRequestRepo;

// import model
use App\account as Account;

class MemberCancelRequestClass{

	public function __construct(MemberCancelRequestRepo $MemberCancelRequestRepo){
        $this->MemberCancelRequestRepo = $MemberCancelRequestRepo;
        $this->memberType = 2;
        $this->dateNow = Carbon::now('Asia/Bangkok');
    }

    /* ---------- Logic ------------
        1. 

        account type = 2 member
    ----------------------------- */

    // 1. 
    public function CancelRequest($request){
        // set data
        $token = array_get($request,'token');
        $requestId = array_get($request,'requestId');
        $request = new Account;

        // check account empty
        $checkAccount = $this->MemberCancelRequestRepo->GetAccountByToken($token, $this->memberType);
        if(empty($checkAccount)){
            $request->status = false;
            $request->message = 'Error';
            $request->data = [];
            return $request;
        }
        $accountId = $checkAccount[0]->id;

        // cancel request
        $cancelRequest = $this->MemberCancelRequestRepo->CancelRequest($accountId, $requestId);
        if(empty($cancelRequest)){
            $request->status = false;
            $request->message = 'Error!';
            $request->data = [];
        }else{
            $request->status = true;
            $request->message = 'Complete';
            $request->data = [];
        }

        return $request;
    }
}