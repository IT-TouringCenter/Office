<?php
namespace App\Facades\Accounts\Register;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\account as Account;

use App\Repositories\Accounts\Register\AccountRegisterRepository as AccountRegisterRepo;

class AccountRegisterClass{

	public function __construct(AccountRegisterRepo $AccountRegisterRepo){
		$this->AccountRegisterRepo = $AccountRegisterRepo;
	}

    /*  Register logic
            1. Check email repeat
            2. Save accounts table
            3. Save account profile table
    */

    public function AccountRegister($data){

        // Check email repeat
        $email = array_get($data,'email');
        $checkEmailRepeat = $this->CheckEmailRepeat($email);

        $register = new Account;

        if(array_get($checkEmailRepeat,'isRegister')==true){
            $accountId = $this->InsertAccount($data);
            if($accountId){
                $accountProfileId = $this->InsertAccountProfile($accountId, $data);
                if($accountProfileId){
                    // Send email
                    $mail = $this->SendMailRegister($accountId);
                    if($mail){
                        $register->status = 'true';
                        $register->message = 'Registered Successfully, please confirm register from your email.';
                        $register->notify = 'OK';
                    }else{
                        $register->status = 'false';
                        $register->message = 'Registered Failed, please contact our office.';
                        $register->notify = 'Error 4';
                    }
                }else{
                    $register->status = 'false';
                    $register->message = 'Registered Failed, please contact our office.';
                    $register->notify = 'Error 3';
                }
            }else{
                $register->status = 'false';
                $register->message = 'Registered Failed, please contact our office.';
                $register->notify = 'Error 2';
            }
        }else{
            $register->status = 'false';
            $register->message = 'Registered Failed, please contact our office.';
            $register->notify = 'Error 1';
        }
        return $register;
    }

    // Save account table
    public function InsertAccount($data){
        // date
        $date = Carbon::now('Asia/Bangkok');
        $tomorrow = \DateFormatFacade::SetTomorrow($date);
        // gen code
        $password = \GenerateCodeFacade::Encode(array_get($data,'password'));
        $token = \GenerateCodeFacade::GenerateToken();
        $activeCode = \GenerateCodeFacade::CreateActiveCode();

        $setData = [
            "account_type_id"=>1,
            "username"=>array_get($data,'email'),
            "password"=>$password,
            "fullname"=>array_get($data,'fullname'),
            "token"=>$token,
            "email"=>array_get($data,'email'),
            "tel"=>'',
            "active_code"=>$activeCode,
            "active_expired"=>$tomorrow,
            "is_active"=>0
        ];

        $result = $this->AccountRegisterRepo->InsertAccount($setData);
        return $result;
    }

    // Save account profile
    public function InsertAccountProfile($accountId, $data){
        $setData = [
            "account_id"=>$accountId,
            "fullname"=>array_get($data,'fullname'),
            "birth"=>array_get($data,'birth'),
            "is_active"=>0
        ];

        $result = $this->AccountRegisterRepo->InsertAccountProfile($setData);
        return $result;
    }

    // Check email repeat
    public function CheckEmailRepeat($email){
        $result = $this->AccountRegisterRepo->CheckEmailRepeat($email);

        $message = new Account;

        if($result=='false'){
            $message->message = 'This email does not work';
            $message->isRegister = false;
        }else{
            $message->message = 'This email is valid';
            $message->isRegister = true;
        }
        return $message;
    }

    // Send email for confirm register
    public function SendMailRegister($accountId){
        // Get account data
        $accountData = $this->AccountRegisterRepo->GetAccountData($accountId);

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

        $activeExpired = \DateFormatFacade::SetFullDate(array_get($data,'activeExpired'));
        $userId = \GenerateCodeFacade::Encode(array_get($data,'id')+231327);

        // Template
        $body =  "
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
                <div class='block-layer'>
                    <div class='table block-content' style='border: #ccc solid 1px; padding: 0px 10% 0 10%; background: #f7f7f7; width: 60% !important; width: 80%; margin: auto;'>
                        <p class='row-space' style='padding: 10px 0 10px 0;'>
                            <h2 class='text-center' style='margin: 0; text-align: center;'>Register</h2>
                        </p>
                        <p class='text-center text-head-2 row-space' style='text-align: center; padding: 10px 0 10px 0; font-size: 18px;'><b>Account</b> : ".array_get($data,'username')."</p>
                        <hr>
                        <p class='row-space' style='padding: 10px 0 10px 0;'>รอการยืนยันการสมัครสมาชิก กรุณานำโค้ด <u>".array_get($data,'activeCode')."</u> เพื่อใช้ในการยืนยันการสมัครบนหน้าเว็บหรือคลิกที่ปุ่ม Confirm ด้านล่าง เพื่อยืนยันการสมัครและเริ่มต้นใช้งานทันที</p>
                        <p class='text-center color-red row-space' style='text-align: center; padding: 10px 0 10px 0; color: red;'>** โค้ดนี้จะมีอายุการใช้งานได้ถึง ".$activeExpired." **</p>
                        <p class='row-space text-center' style='text-align: center; padding: 10px 0 10px 0;'>
                            <a href='http://tour-in-chiangmai.com?user=".$userId."&id=".array_get($data,'token')."' class='btn' style='min-width: 100px; cursor: pointer; color: white; text-decoration: none;'>
                                <span style='padding: 8px 20px; font-size: 15px; background: #2762bb; border: solid 1px #3c66ff; border-radius: 2px;'>Confirm</span>
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
        $to = array_get($data,'email');
        $subject = "Register mail";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Reply-To: noreply@example.com". "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: reservations@touringcnx.com" . "\r\n";
        $headers .= "BCC: it@touringcnx.com";

        $mail = mail($to,$subject,$body,$headers);
        return $mail;

        // if($mail){
        //     return "true";
        // }else{
        //     return "false";
        // }
    }
}