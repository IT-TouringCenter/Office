<?php
namespace App\Facades\Accounts\Setting;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Repositories\Accounts\Setting\AccountResetPasswordRepository as AccountResetPasswordRepo;

use App\account as Account;

class AccountResetPasswordClass{

	public function __construct(AccountResetPasswordRepo $AccountResetPasswordRepo){
		$this->AccountResetPasswordRepo = $AccountResetPasswordRepo;
	}

    /*  Reset password logic
            1. Check account
            2. Check request
            3. Reset password
            4. Send email
    */

    public function AccountResetPassword($data){
        // Set variable
        $dateTimeNow = Carbon::now('Asia/Bangkok');
        $email = array_get($data,'email');
        $password = \GenerateCodeFacade::Encode(array_get($data,'password'));
        $resetCode = array_get($data,'resetCode');

        $requestTypeId = 3; // Fix 3 = reset password
        $checkAccount = false;
        $checkRequest = false;
        $changePassword = false;

        $account = new Account;
        $accountRes = new Account;

        // 1. Check account
        $accountData = $this->CheckAccount($email);
        if($accountData->status==true){
            $checkAccount = true;
        }else{
            $accountRes->status = false;
            $accountRes->message = 'This account is not in the system.';
            $accountRes->notify = 'Error';
            return $accountRes; // End
        }
        $accountId = array_get($accountData,'id');

        // 2. Check request
        if($checkAccount==true){
            $requestData = $this->CheckRequest($accountId, $requestTypeId, $resetCode, $dateTimeNow);
            if($requestData){
                $checkRequest = true;
            }else{
                // 2.1 Non active request
                $nonActive = $this->AccountResetPasswordRepo->NonActiveRequest($accountId, $requestTypeId, $resetCode);

                $accountRes->status = false;
                $accountRes->message = 'Can\'t find the password change request or reset code expired.';
                $accountRes->notify = 'Error';
                return $accountRes; // End
            }
        }

        // 3. Reset password
        if($checkRequest==true){
            $resetPassword = $this->ResetPassword($accountId, $password);
            if($resetPassword){
                $changePassword = true;
                
                // 3.1 Cancel request
                $cancelRequest = $this->AccountResetPasswordRepo->CancelRequest($accountId, $requestTypeId);

                // 3.2 Force logout
                $forceLogout = $this->AccountResetPasswordRepo->ForceLogout($accountId, $dateTimeNow);
            }else{
                $accountRes->status = false;
                $accountRes->message = 'Unable to change password, please use a different password.';
                $accountRes->notify = 'Error';
                return $accountRes; // End
            }
        }

        // 4. Send email
        if($changePassword==true){
            $mail = $this->SendMailResetPassword($accountData,array_get($data,'password'));
            if($mail){
                $accountRes->status = true;
                $accountRes->message = 'Reset password successful.';
                $accountRes->notify = 'OK';
            }else{
                $accountRes->status = false;
                $accountRes->message = 'Unable to change password.';
                $accountRes->notify = 'Error!';
            }
        }
        return $accountRes;
    }

    // 1. Check account
    public function CheckAccount($email){
        $result = $this->AccountResetPasswordRepo->GetAccount($email);
        $account = new Account;

        if($result){
            foreach($result as $value){
                $account->status = true;
                $account->id = $value->id;
                $account->username = $value->username;
                $account->fullname = $value->fullname;
                $account->token = $value->token;
                $account->email = $value->email;
            }
        }else{
            $account->status = false;
        }
        return $account;
    }

    // 2. Check request
    public function CheckRequest($accountId, $requestType, $requestCode, $dateTimeNow){
        $result = $this->AccountResetPasswordRepo->GetAccountRequest($accountId, $requestType, $requestCode, $dateTimeNow);
        return $result;
    }

    // 3. Reset password
    public function ResetPassword($accountId, $password){
        $result = $this->AccountResetPasswordRepo->ResetPassword($accountId, $password);
        return $result;
    }

    // 4. Send email
    public function SendMailResetPassword($accountData, $password){
        // Set data
        $accountId = array_get($accountData,'id');
        $username = array_get($accountData,'username');
        $fullname = array_get($accountData,'fullname');
        $email = array_get($accountData,'email');

        $passwordHidden = \GenerateCodeFacade::HiddenPassword($password);

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
                <div class='block-layer' style='padding: 15px 0px 10px 0px;'>
                    <div class='table block-content' style='border: #ccc solid 1px; padding: 0px 10% 0 10%; background: #f7f7f7; width: 60% !important; width: 80%; margin: auto;'>
                        <p class='row-space' style='padding: 10px 0 10px 0;'>
                            <h2 class='text-center' style='margin: 0; text-align: center;'>Reset Password</h2>
                        </p>
                        <p class='text-center text-head-2 row-space' style='text-align: center; padding: 0 0 10px 0; font-size: 18px;'><b>Account</b> : ".$username."</p>
                        <hr>
                        <p class='row-space' style='padding: 10px 0 10px 0; line-height: 2;'>การเปลี่ยนรหัสผ่านใหม่ของคุณสำเร็จเรียบร้อยแล้ว</p>
                        <p class='row-space' style='padding: 0 0 10px 0;'>รหัสผ่านใหม่ของคุณคือ : ".$passwordHidden."</p>
                        <p class='row-space text-center' style='text-align: center; padding: 10px 0 10px 0;'>
                            <a href='http://tour-in-chiangmai.com' style='min-width: 100px; cursor: pointer; color: white; text-decoration: none;'>
                                <span style='padding: 8px 20px; font-size: 15px; background: #2762bb; border: solid 1px #3c66ff; border-radius: 2px;'>Login</span>
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
        // $headers .= "BCC: it@touringcnx.com";

        $mail = mail($to,$subject,$body,$headers);

        if($mail){
            return true;
        }else{
            return false;
        }
    }

}