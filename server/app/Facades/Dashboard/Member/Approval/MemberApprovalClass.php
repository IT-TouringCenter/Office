<?php
namespace App\Facades\Dashboard\Member\Approval;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Dashboard\Member\Approval\MemberApprovalRepository as MemberApprovalRepo;

// import model
use App\account as Account;

class MemberApprovalClass{

	public function __construct(MemberApprovalRepo $MemberApprovalRepo){
        $this->MemberApprovalRepo = $MemberApprovalRepo;
        $this->memberType = 2;
        $this->dateNow = Carbon::now('Asia/Bangkok');
    }

    /* ---------- Logic ------------
        1. 

        account type = 2 member
    ----------------------------- */

    // 1. 
    public function MemberApproval($request){
        // set data
        $token = array_get($request,'token');
        $approval = new Account;

        // check account empty
        $checkAccount = $this->MemberApprovalRepo->GetAccountByToken($token,$this->memberType);
        if($checkAccount){
            $accountId = $checkAccount[0]->id;
        }else{
            $approval->status = false;
            $approval->message = 'Error';
            $approval->data = [];
        }

        // get account request
        $request = $this->MemberApprovalRepo->GetRequest($accountId);
        $requestArr = [];

        if($request){
            foreach($request as $value){
                $req = new Account;
                $req->id = $value->id;
                $req->typeId = $value->type_id;
                $req->statusTd = $value->status_id;
                $req->requestTypeTH = $value->type_th;
                $req->requestTypeEnEN = $value->type_en;
                $req->requestStatusTH = $value->status_th;
                $req->requestStatusEN = $value->status_en;
                $req->requestDate = \DateFormatFacade::SetShortDate($value->created_at);

                array_push($requestArr,$req);
            }

            $approval->status = true;
            $approval->message = 'OK';
            $approval->data = $requestArr;
        }else{
            $approval->status = false;
            $approval->message = 'Error';
            $approval->data = [];
        }

        return $approval;
    }
}