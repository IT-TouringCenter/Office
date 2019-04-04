<?php
namespace App\Facades\Dashboard\Admin\Request;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Dashboard\Admin\Request\AdminUserRequestUpdateRepository as AdminUserRequestUpdateRepo;

// import model
use App\account as Account;

class AdminUserRequestUpdateClass{

	public function __construct(AdminUserRequestUpdateRepo $AdminUserRequestUpdateRepo){
        $this->AdminUserRequestUpdateRepo = $AdminUserRequestUpdateRepo;
    }

    // 
    public function UserRequestUpdate($data){
        // set data
        $token = array_get($data,'token');
        $statusId = array_get($data,'status');
        $requestId = array_get($data,'request');
        $requestTypeId = array_get($data,'requestType');
        $request = new Account;

        // check account
        $checkAccount = $this->AdminUserRequestUpdateRepo->GetAccountByToken($token);
        if(empty($checkAccount)){
            $request->status = false;
            $request->message = 'Error';
            $request->data = [];

            return $request;
        }
        $accountId = $checkAccount[0]->id;

        // update status
        $updateStatus = $this->AdminUserRequestUpdateRepo->UpdateUserRequestStatus($accountId,$statusId);
        if(empty($updateStatus)){
            $request->status = false;
            $request->message = 'Error!';
            $request->data = [];

            return $request;
        }

        // check status update
        if($statusId==1){ // waiting
            $request->status = false;
            $request->message = 'waiting';
            $request->data = [];

            return $request;
        }else if($statusId==3){ // not approve
            $request->status = false;
            $request->message = 'not approve';
            $request->data = [];

            return $request;
        }

        // update account type : accounts table
        $accountTypeId = $checkAccount[0]->account_type_id;
        
        $checkAccountType = $this->CheckAccountTypeByRequest($requestTypeId, $accountTypeId);
        $accountTypeId = $checkAccountType; // new set type

        $updateAccountType = $this->AdminUserRequestUpdateRepo->UpdateAccountType($accountId, $accountTypeId);
        if(empty($updateAccountType)){
            $request->status = false;
            $request->message = 'Error#!';
            $request->data = [];

            return $request;
        }

        // non active request
        $nonActiveRequest = $this->AdminUserRequestUpdateRepo->NonActiveAccountRequest($requestId);
        if(empty($nonActiveRequest)){
            $request->status = false;
            $request->message = 'Error~#!!';
            $request->data = [];
            
            return $request;
        }

        // Affiliate logic
        $addCommissionRate = \AdminUserManagementAddFacade::CreateRecordAffiliate($accountId, $accountTypeId);
        if($addCommissionRate=='Affiliate'){
            $request->status = true;
            $request->message = 'OK';
            $request->data = [];
        }else{
            $request->status = false;
            $request->message = 'Create commission rate error!';
            $request->data = [];
        }

        // email approval request
        $emailApprov = $this->EmailApprovalRequest($checkAccount);
        $request->data = $emailApprov;

        return $request;
    }

    // check account type
    public function CheckAccountTypeByRequest($accountRequestType, $accountTypeId){
        $accountType = '';
        switch($accountRequestType){
            case '1' : $accountType = 2; break;
            case '2' : $accountType = 3; break;
            case '3' : $accountType = $accountTypeId; break;
            case '4' : $accountType = 3; break;
        }

        return $accountType;
    }

    // email approval request
    public function EmailApprovalRequest($accountData){
        // set data
        $accountId = $accountData[0]->id;
        $fullname = $accountData[0]->fullname;
        $username = $accountData[0]->username;
        $email = $accountData[0]->email;
        
        // get request data
        $getRequestData = $this->AdminUserRequestUpdateRepo->GetRequestFirstRecord($accountId);

        // set email text
        // check approv
        if($getRequestData[0]->status_en=='Approved'){
        // if(array_get($getRequestData,'status_en')=='Approved'){
            $approvStatus = 'ได้รับการอนุมัติ';
        }else{
            $approvStatus = 'ไม่ได้รับการอนุมัติ';
        }
        
        $requestType = $getRequestData[0]->type_en;
        // $requestType = array_get($getRequestData,'type_en');

        $approvText = "คุณ".$approvStatus."การส่งคำขอสมัคร ".$requestType." เรียบร้อยแล้ว";

        // Template
        $body = "
        <html>
            <head></head>
            <body style='min-width: 800px;'>
                <!-- Header -->
                <div class='block-layer' style='padding: 15px 0px 10px 0px;'>
                    <table class='table' style='width: 80%; margin: auto;'>
                        <tr>
                            <td class='text-left' style='text-align: left;'>
                                <img src='http://tour-in-chiangmai.com/images/logo/tc-logo-black-mini.png' alt='Touring Center' class='tc-logo' style='height: 50px; width: auto;'>
                            </td>
                            <td class='text-right' style='text-align: right;'>
                                <h1 style='margin: 0; text-align: right;'>".$fullname."</h1>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- Content -->
                <div class='block-layer'>
                    <div class='table block-content' style='border: #ccc solid 1px; padding: 0px 10% 0 10%; background: #f7f7f7; width: 60% !important; width: 80%; margin: auto;'>
                        <p class='row-space' style='padding: 10px 0 10px 0;'>
                            <h2 class='text-center' style='margin: 0; text-align: center;'>Notify request</h2>
                        </p>
                        <p class='text-center text-head-2 row-space' style='text-align: center; padding: 10px 0 10px 0; font-size: 18px;'><b>Account</b> : ".$username."</p>
                        <hr>
                        <p class='row-space' style='padding: 10px 0 20px 0;'>".$approvText."</p>

                        <p class='row-space text-center' style='text-align: center; padding: 10px 0 10px 0;'>
                            <a href='http://dev.tourinchiangmai.com/#/user/login' class='btn' style='min-width: 100px; cursor: pointer; color: white; text-decoration: none;'>
                                <span style='padding: 8px 20px; font-size: 15px; background: #2762bb; border: solid 1px #3c66ff; border-radius: 2px;'>Login</span>
                            </a>
                        </p>
                    </div>
                </div>

                <!-- Footer -->
                <div class='block-layer'>
                    <p class='text-center' style='text-align: center;'>คุณได้รับอีเมลนี้เพื่อแจ้งให้ทราบเกี่ยวกับการเปลี่ยนแปลงสำคัญในบัญชีและบริการต่างๆ ของคุณ</p>
                    <p class='text-center' style='text-align: center;'>Touring Center 14 1<sup>st</sup> floor Soi5, Rachadamnoen Rd., Sriphum, Muang, Chiang Mai 50200</p>
                    <p class='text-center' style='text-align: center;'>Tel. : +66 (0)53 289 644-5 &nbsp; Fax : +66 (0)53 289 659 &nbsp; Mobile : +66 (0)88 258 5817 &nbsp; Email : touringcenter@hotmail.com</p>
                </div>
            </body>
        </html>";

        // Set email data
        $to = 'yuranannong@gmail.com';
        $subject = "Request : Touring Center";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Reply-To: noreply@example.com". "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: touringcenter@noreply.com" . "\r\n";
        // $headers .= "BCC: it@touringcnx.com";

        $mail = mail($to,$subject,$body,$headers);
        if($mail){
            return $getRequestData[0]->id;
        }else{
            return false;
        }
        // return $mail;
    }

}