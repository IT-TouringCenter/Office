<?php
namespace App\Facades\Dashboard\Member\Request;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Dashboard\Member\Request\MemberCheckRequestJoinAffiliateRepository as MemberCheckRequestJoinAffiliateRepo;

// import model
use App\account as Account;

class MemberCheckRequestJoinAffiliateClass{

	public function __construct(MemberCheckRequestJoinAffiliateRepo $MemberCheckRequestJoinAffiliateRepo){
        $this->MemberCheckRequestJoinAffiliateRepo = $MemberCheckRequestJoinAffiliateRepo;
        $this->memberType = 2;
        $this->requestType = 2;
        $this->dateNow = Carbon::now('Asia/Bangkok');
    }

    /* ---------- Logic ------------
        1. 

        account type = 2 member
    ----------------------------- */

    // 1. 
    public function CheckRequestJoinAffiliate($request){
        // set data
        $token = array_get($request,'token');
        $request = new Account;

        // check account empty
        $checkAccount = $this->MemberCheckRequestJoinAffiliateRepo->GetAccountByToken($token, $this->memberType);
        if(empty($checkAccount)){
            $request->status = false;
            $request->message = 'Error';
            $request->data = [];
            return $request;
        }
        $accountId = $checkAccount[0]->id;

        // check request join affiliate
        $checkRequest = $this->MemberCheckRequestJoinAffiliateRepo->CheckRequestAffiliate($accountId, $this->requestType);
        if(empty($checkRequest)){
            $request->status = false;
            $request->message = 'Error';
            $request->data = [];
            return $request;
        }

        // set data return
        $request->status = true;
        $request->message = 'Complete';
        $request->data = [];

        return $request;
    }
}