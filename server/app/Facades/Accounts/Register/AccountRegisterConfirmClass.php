<?php
namespace App\Facades\Accounts\Register;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\account as Account;

use App\Repositories\Accounts\Register\AccountRegisterConfirmRepository as AccountRegisterConfirmRepo;

class AccountRegisterConfirmClass{

	public function __construct(AccountRegisterConfirmRepo $AccountRegisterConfirmRepo){
		$this->AccountRegisterConfirmRepo = $AccountRegisterConfirmRepo;
	}

    /*  Confirm register logic
            1. Confirm register
            2. Active register
            3. Send email confirm
            4. Get account data from token
            5. Set confirm code to account table
    */

    // 1. Confirm register
    public function AccountRegisterConfirm($data){
        $dateNow = Carbon::now('Asia/Bangkok');
        $this->confirmRes = new Account;

        // Check email & confirm expired
        $checkConfirmExpired = $this->AccountRegisterConfirmRepo->CheckConfirmExpired($data,$dateNow);

        if($checkConfirmExpired!=false){
            foreach($checkConfirmExpired as $value){
                $accountId = $value->id;  
            }
            $activeRegister = $this->ActiveRegister($accountId,$dateNow);
        }else{
            $this->confirmRes->status = 'Failed';
            $this->confirmRes->message = 'This confirm code is not valid or expired.';
            $this->confirmRes->notify = 'Error 1';
        }
        return $this->confirmRes;
    }

    // 2. Active register
    public function ActiveRegister($accountId,$dateNow){
        // account
        $activeAccount = $this->AccountRegisterConfirmRepo->ActiveAccount($accountId,$dateNow);
        // account profile
        if($activeAccount==true){
            $activeAccountProfile = $this->AccountRegisterConfirmRepo->ActiveAccountProfile($accountId);
            if($activeAccountProfile==true){
                // Send email confirm
                $mail = $this->SendMailConfirmRegister($accountId);
                if($mail){
                    $this->confirmRes->status = 'Success';
                    $this->confirmRes->message = 'Register confirm complete.';
                    $this->confirmRes->notify = 'OK';
                }else{
                    $this->confirmRes->status = 'Failed';
                    $this->confirmRes->message = 'This confirm code is not valid or expired.';
                    $this->confirmRes->notify = 'Error 4';
                }
            }else{
                $this->confirmRes->status = 'Failed';
                $this->confirmRes->message = 'This confirm code is not valid or expired.';
                $this->confirmRes->notify = 'Error 3';
            }
        }else{
            $this->confirmRes->status = 'Failed';
            $this->confirmRes->message = 'This confirm code is not valid or expired.';
            $this->confirmRes->notify = 'Error 2';
        }
    }

    // 3. Send email confirm
    public function SendMailConfirmRegister($accountId){
        // Get account data
        $accountData = $this->AccountRegisterConfirmRepo->GetAccountData($accountId);

        $data = new Account;
        foreach($accountData as $value){
            $data->accountId = $value->id;
            $data->accountType = $value->account_type_id;
            $data->username = $value->username;
            $data->password = $value->password;
            $data->fullname = $value->fullname;
            $data->token = $value->token;
            $data->email = $value->email;
            $data->tel = $value->tel;
            $data->activeCode = $value->active_code;
            $data->activeExpired = $value->active_expired;
        }

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
                                <h1 style='margin: 0; text-align: right;'>".array_get($data,'fullname')."</h1>
                            </td>
                        </tr>
                    </table>
                </div>
        
                <!-- Content -->
                <div class='block-layer' style='padding: 15px 0px 10px 0px;'>
                    <div class='table block-content' style='border: #ccc solid 1px; padding: 0px 10% 0 10%; background: #f7f7f7; width: 60% !important; width: 80%; margin: auto;'>
                        <p class='row-space' style='padding: 10px 0 10px 0;'>
                            <h2 class='text-center' style='margin: 0; text-align: center;'>Confirm Register</h2>
                        </p>
                        <p class='text-center text-head-2 row-space' style='text-align: center; padding: 0 0 10px 0; font-size: 18px;'><b>Account</b> : ".array_get($data,'username')."</p>
                        <hr>
                        <p class='row-space' style='padding: 10px 0 10px 0; line-height: 2;'>คุณได้ยืนยันการสมัครสมาชิกเรียบร้อยแล้ว สามารถลงชื่อเข้าใช้งานได้แล้วในขณะนี้ โดยผ่านทางหน้าเว็บไซต์หรือคลิกที่ปุ่ม Login ด้านล่างนี้</p>
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
        </html>
        ";

        // Set email data
        $to = array_get($data,'email');
        $subject = "Register mail";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Reply-To: noreply@example.com". "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: reservations@touringcnx.com" . "\r\n";
        // $headers .= "BCC: it@touringcnx.com";

        $mail = mail($to,$subject,$body,$headers);
        return $mail;
    }

    // 4. Get account data from token
    public function GetAccountRegisterConfirm($token){
        // $token = array_get($data,'token');
        $accountData = new Account;
        
        $result = $this->AccountRegisterConfirmRepo->GetAccountFromToken($token);
        // return $result;
        if($result){
            foreach($result as $value){
                $accountData->status = true;
                $accountData->id = $value->id;
                $accountData->email = $value->email;
            }
        }else{
            $accountData->status = false;
            $accountData->id = '';
            $accountData->email = '';
        }
        return $accountData;
    }

    // 5. Set confirm code to account table
    public function AccountRegisterConfirmCodeAgain($token){
        $data = new Account;
        // Get account id by token
        $account = \AccountFacade::GetAccountByTokenNonActive($token);
        $accountId = $account->accountId;

        // Set date
        $date = Carbon::now('Asia/Bangkok');
        $tomorrow = \DateFormatFacade::SetTomorrow($date);
        // Set active code
        $activeCode = \GenerateCodeFacade::CreateActiveCode();

        $accountData = [
            "active_code"=>$activeCode,
            "active_expired"=>$tomorrow
        ];

        $result = $this->AccountRegisterConfirmRepo->UpdateConfirmCodeByAccountId($accountId, $accountData);
        
        // return & send mail
        if($result){
            $sendMail = $this->SendMailConfirmRegister($accountId);
            $data->status = true;
            $data->message = 'Send new confirm code complete.';
            $data->notify = 'OK';
        }else{
            $data->status = false;
            $data->message = 'Send new confirm code not found.';
            $data->notify = 'Error!';
        }
        return $data;
    }
}