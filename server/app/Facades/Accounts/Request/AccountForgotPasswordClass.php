<?php
namespace App\Facades\Accounts\Request;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Repositories\Accounts\Request\AccountForgotPasswordRepository as AccountForgotPasswordRepo;

use App\account as Account;

class AccountForgotPasswordClass{

	public function __construct(AccountForgotPasswordRepo $AccountForgotPasswordRepo){
		$this->AccountForgotPasswordRepo = $AccountForgotPasswordRepo;
    }
    
    /*  Forgot password logic
            1. Check account
            2. Save request history
            3. Send email forgot password
    */

    public function AccountForgotPassword($data){
        $email = array_get($data,'email');
        $request = false;
        $mail = false;
        $account = new Account;

        // 1. Check account
        $getAccount = $this->CheckAccount($email);

        // 2. Save request history
        if(array_get($getAccount,'status')==true){
            $requestId = $this->SaveRequest($getAccount);
            // return $requestId; // request id
        }

        // 3. Send mail forgot password
        if($requestId!=false){
            $mail = $this->SendMailForgotPasswordHistory($getAccount,$requestId);

            $account->status = true;
            $account->message = "Send reset password code to your email successful.";
            $account->notify = "OK";
        }else{
            $account->status = false;
            $account->message = "Can't send reset password code.";
            $account->notify = "Error";
        }

        return $account;
    }

    // 1. Check account
    public function CheckAccount($email){
        $accountData = $this->AccountForgotPasswordRepo->GetAccountData($email);

        $account = new Account;
        if($accountData){
            foreach($accountData as $value){
                $account->status = true;
                $account->accountId = $value->id;
                $account->accountType = $value->account_type_id;
                $account->username = $value->username;
                $account->password = $value->password;
                $account->fullname = $value->fullname;
                $account->token = $value->token;
                $account->email = $value->email;
                $account->tel = $value->tel;
                $account->activeCode = $value->active_code;
                $account->activeExpired = $value->active_expired;
            }
        }else{
            $account->status = false;
        }
        return $account;
    }

    // 2. Save request history
    public function SaveRequest($accountData){
        $accountId = array_get($accountData,'accountId');
        $dateNow = Carbon::now('Asia/Bangkok');

        $requestCode = \GenerateCodeFacade::Code5Chars();
        $requestCodeExpired = \DateFormatFacade::SetDatePlus15Minute($dateNow);
        $requestType = 3; // fix 3 = forgot password

        // Set data
        $setData = [
            'account_id'=>$accountId,
            'account_request_type_id'=>$requestType,
            'request_code'=>$requestCode,
            'request_code_expired'=>$requestCodeExpired
        ];

        // Non active request
        $nonActive = $this->AccountForgotPasswordRepo->NonActiveRequest($accountId, $requestType);

        // Save request
        $saveRequest = $this->AccountForgotPasswordRepo->SaveAccountRequest($setData);
        if($saveRequest){
            return $saveRequest; // return id
        }else{
            return false;
        }
        
    }

    // 3. Send email forgot password
    public function SendMailForgotPasswordHistory($accountData, $requestId){
        // Get request data
        $requestData = $this->AccountForgotPasswordRepo->GetRequestData($requestId);

        $request = new Account;
        foreach($requestData as $value){
            $request->accountId = $value->account_id;
            $request->accountRequestTypeId = $value->account_request_type_id;
            $request->requestCode = $value->request_code;
            $request->requestCodeExpired = $value->request_code_expired;
        }

        $userId = \GenerateCodeFacade::Encode(array_get($accountData,'accountId')+231327);
        $token = array_get($accountData,'token');
        $requestCode = array_get($request,'requestCode');
        $requestCodeExpired = \DateFormatFacade::SetFullDateTime(array_get($request,'requestCodeExpired'));

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
                                <h1 style='margin: 0; text-align: right;'>".array_get($accountData,'fullname')."</h1>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- Content -->
                <div class='block-layer' style='padding: 15px 0px 10px 0px;'>
                    <div class='table block-content' style='border: #ccc solid 1px; padding: 0px 10% 0 10%; background: #f7f7f7; width: 60% !important; width: 80%; margin: auto;'>
                        <p class='row-space' style='padding: 10px 0 10px 0;'>
                            <h2 class='text-center' style='margin: 0; text-align: center;'>Forgot Password</h2>
                        </p>
                        <p class='text-center text-head-2 row-space' style='text-align: center; padding: 0px 0 10px 0; font-size: 18px;'><b>Account</b> : ".array_get($accountData,'username')."</p>
                        <hr>
                        <p class='row-space' style='padding: 10px 0 10px 0; line-height: 2;'>กรุณานำโค้ด <u>".$requestCode."</u> เพื่อใช้ในการอ้างอิงการตั้งรหัสผ่านใหม่ ผ่านทางหน้าเว็บไซต์หรือลิงค์ด้านล่างนี้</p>
                        <p class='text-center row-space' style='text-align: center; padding: 0 0 10px 0; color: red;'>** เพื่อความปลอดภัยของข้อมูลบัญชี โค้ดนี้จะมีอายุการใช้งานได้ถึง ".$requestCodeExpired." **</p>
                        <p class='row-space text-center' style='text-align: center; padding: 10px 0 10px 0;'>
                            <a href='http://tour-in-chiangmai.com?user=".$userId."&id=".$token."' style='min-width: 100px; cursor: pointer; color: white; text-decoration: none;'>
                                <span style='padding: 8px 20px; font-size: 15px; background: #e08b33; border: solid 1px #bf7c17; border-radius: 2px;'>Reset Password</span>
                            </a>
                        </p>
                    </div>
                </div>

                <!-- Footer -->
                <div class='block-layer' style='padding: 15px 0px 10px 0px;'>
                    <p class='text-center' style='text-align: center;'>คุณได้รับอีเมลนี้เพื่อแจ้งให้ทราบเกี่ยวกับการเปลี่ยนแปลงสำคัญในบัญชีและบริการต่างๆ ของคุณ</p>
                    <p class='text-center' style='text-align: center;'>Touring Center 14 1<sup>st</sup> Floor Soi5, Rachadamnoen Rd., Sriphum, Muang, Chiang Mai 50200</p>
                    <p class='text-center' style='text-align: center;'>Tel. : +66 (0)53 289 644-5 &nbsp; Fax : +66 (0)53 289 659 &nbsp; Mobile : +66 (0)88 258 5817 &nbsp; Email : touringcenter@hotmail.com</p>
                </div>
            </body>
        </html>";

        // Set email data
        $to = array_get($accountData,'email');
        $subject = "Register mail";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Reply-To: noreply@example.com". "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: reservations@touringcnx.com" . "\r\n";
        $headers .= "BCC: it@touringcnx.com";

        $mail = mail($to,$subject,$body,$headers);
        
        if($mail){
            return true;
        }else{
            return false;
        }
    }
}