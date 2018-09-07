<?php
namespace App\Facades\Accounts;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Repositories\Accounts\AccountLoginRepository as AccountLoginRepo;

use App\account as Account;

class AccountLoginClass{

	public function __construct(AccountLoginRepo $AccountLoginRepo){
		$this->AccountLoginRepo = $AccountLoginRepo;
	}

    /*  Login logic
            1. Check account in account table
            2. Check account active
            3. Check status login in login_history table
            4. Insert login data into login_history table
            5. Send email notify login history
            6. Return
            7. Force logout (send mail logout)
            
            8. Account session login
            9. Check login expired (Auto logout)
    */

    public function AccountLogin($data){
        $activeLoginRes = false;
        $saveLoginRes = false;
        $mail = false;
        $forceLogout = false;

        $login = new Account;

        // 1. Check email in account table
        $checkAccount = $this->CheckAccount($data);

        // 2. Check account active
        if($checkAccount){
            $checkAccountActive = $this->CheckAccountActive($data);
            
            // Check & return account non active
            if($checkAccountActive){
                // set data for return to client
                $resData = new Account;
                $resData->id = $checkAccountActive[0]->id;
                $resData->token = $checkAccountActive[0]->token;
                $resData->username = $checkAccountActive[0]->username;
                $resData->name = $checkAccountActive[0]->fullname;
                $resData->userType = $checkAccountActive[0]->account_type_id;
            }else{
                $resData = new Account;
                $resData->token = $checkAccount[0]->token;

                $login->status = false;
                $login->message = 'This account is not active.';
                $login->notify = 'Non active';
                $login->data = $resData;
                return $login;
            }            
        }else{
            $login->status = false;
            $login->message = 'Username or password is invalid.';
            $login->notify = 'Not found';
            return $login;
        }

        // 3. Check status login in login_history table
        if($checkAccountActive){
            $accountId = $checkAccount[0]->id;
            $activeLoginRes = $this->CheckLoginStatus($accountId);
        }else{
            $login->status = false;
            $login->message = 'Username or password is invalid.';
            $login->notify = 'Non active';
            $login->data = $resData;
            return $login; // End
        }

        // 4. Insert login data into login_history table
        if($activeLoginRes==false){
            $saveLogin = $this->SaveLoginHistory($checkAccount);
            if($saveLogin){
                $saveLoginRes = true;
            }else{
                $saveLoginRes = false;
                $login->status = false;
                $login->message = 'Username or password is invalid.';
                $login->notify = 'Login not found';
                $login->data = $resData;
                return $login; // End
            }
        }else{
            $saveLoginRes = false;

            // 7. Force logout (send mail logout)
            $forceLogout = $this->ForceLogout($accountId);

            if($forceLogout){
                $login->status = false;
                $login->message = 'This account is active, Please check email and get code to sign out.';
                $login->notify = 'Sign out not found or session expired.';
                $login->data = $resData;
            }else{
                $login->status = false;
                $login->message = 'This account is active, Please check email to sign out.';
                $login->notify = 'Sign out not found';
                $login->data = $resData;
            }
            return $login; // End
        }

        // 5. Send email notify login history
        if($saveLoginRes==true){
            $mail = $this->SendMailLoginHistory($accountId,$saveLogin);
                        
            // 6. Return
            $login->status = true;
            $login->message = 'Signed in successfully.';
            $login->notify = 'OK';
            $login->data = $resData;
        }else{
            $login->status = false;
            $login->message = 'Signed in failed, Please sign out or contact our team.';
            $login->notify = 'Error';
            $login->data = $resData;
            return $login;
        }

        return $login; // End
    }

    // 1. Check account in account table
    public function CheckAccount($data){
        $username = array_get($data,'username');
        $password = \GenerateCodeFacade::Encode(array_get($data,'password'));

        $result = $this->AccountLoginRepo->CheckAccount($username,$password);
        return $result;
    }

    // 2. Check account active
    public function CheckAccountActive($data){
        $username = array_get($data,'username');
        $password = \GenerateCodeFacade::Encode(array_get($data,'password'));

        $result = $this->AccountLoginRepo->CheckAccountActive($username,$password);
        return $result;
    }

    // 3. Check status login in login_history table
    public function CheckLoginStatus($accountId){
        $result = $this->AccountLoginRepo->CheckLoginStatus($accountId);
        return $result;
    }

    // 4. Insert login data into login_history table
    public function SaveLoginHistory($accountData){
        // set data
        $dateTimeNow = Carbon::now('Asia/Bangkok');
        $logoutCode = \GenerateCodeFacade::Code5Chars();
        $logoutCodeExpired = \DateFormatFacade::SetDatePlus30Minute($dateTimeNow);
        $logoutExpired = \DateFormatFacade::SetDatePlus1Hour($dateTimeNow);

        $data = [
            'account_id'=>$accountData[0]->id,
            'login_dateTime'=>$dateTimeNow,
            'token'=>$accountData[0]->token,
            'logout_code'=>$logoutCode,
            'logout_code_expired'=>$logoutCodeExpired,
            'logout_expired'=>$logoutExpired
        ];

        $result = $this->AccountLoginRepo->SaveLoginHistory($data);
        return $result;
    }

    // 5. Send email notify login history
    public function SendMailLoginHistory($accountId,$loginId){
        // Get account data
        $accountData = $this->AccountLoginRepo->GetAccountData($accountId);
        // Get login data
        $loginData = $this->AccountLoginRepo->GetLoginData($loginId);

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

        $login = new Account;
        foreach($loginData as $val){
            $login->loginDateTime = $val->login_datetime;
            $login->token = $val->token;
            $login->logoutCode = $val->logout_code;
            $login->logoutCodeExpired = $val->logout_code_expired;
        }

        $userId = \GenerateCodeFacade::Encode(array_get($data,'id')+231327);
        $activeExpired = \DateFormatFacade::SetFullDate(array_get($data,'activeExpired'));
        $logoutCodeExpired = \DateFormatFacade::SetFullDateTime(array_get($login,'logoutCodeExpired'));

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
                            <h2 class='text-center' style='margin: 0; text-align: center;'>Login Notify</h2>
                        </p>
                        <p class='text-center text-head-2 row-space' style='text-align: center; padding: 0 0 10px 0; font-size: 18px;'><b>Account</b> : ".array_get($data,'username')."</p>
                        <hr>
                        <p class='row-space' style='padding: 10px 0 10px 0; line-height: 2;'>ขณะนี้บัญชี ".array_get($data,'username')." มีการลงชื่อเข้าใช้งานระบบในเวลา ".array_get($login,'loginDateTime')." โปรดตรวจสอบให้แน่ชัดว่าคุณลงชื่อเข้าใช้งานจริง หากไม่ใช่ให้ทำการลงชื่อออกโดยการใช้โค้ด <u>".array_get($login,'logoutCode')."</u> นี้ในการอ้างอิงเพื่อยุติการใช้งานโดยทันที</p>
                        <p class='text-center color-red row-space' style='text-align: center; padding: 10px 0 10px 0; color: red;'>** โค้ดนี้จะมีอายุการใช้งานได้ถึง ".$logoutCodeExpired." **</p>
                        <p class='row-space text-center' style='text-align: center; padding: 10px 0 10px 0;'>
                            <a href='http://tour-in-chiangmai.com' style='min-width: 100px; cursor: pointer; color: white; text-decoration: none;'>
                                <span style='padding: 8px 20px; font-size: 15px; background: #bb2727; border: solid 1px #980000; border-radius: 2px;'>Force Logout</span>
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
        $to = array_get($data,'email');
        $subject = "Register mail";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Reply-To: noreply@example.com". "\r\n";
        $headers .= "Content-type:text/html; charset=UTF-8" . "\r\n";
        $headers .= "From: reservations@touringcnx.com" . "\r\n";
        // $headers .= "BCC: it@touringcnx.com";

        $mail = mail($to,$subject,$body,$headers);
        
        if($mail){
            return true;
        }else{
            return false;
        }
    }

    // 6. Return (non function)

    // 7. Force logout (send mail logout)
    public function ForceLogout($accountId){
        // 6.1 get login last id
        $loginLastId = $this->AccountLoginRepo->GetLoginLastId($accountId);

        // 6.2 update code logout & exp
        $dateTimeNow = Carbon::now('Asia/Bangkok');
        $logoutCode = \GenerateCodeFacade::Code5Chars();
        $logoutCodeExpired = \DateFormatFacade::SetDatePlus30Minute($dateTimeNow);

        $data = [
            'account_id'=>$accountId,
            'logout_code'=>$logoutCode,
            'logout_code_expired'=>$logoutCodeExpired
        ];

        $updateLogin = $this->AccountLoginRepo->UpdateLoginHistory($data,$loginLastId,$dateTimeNow);

        // 6.3 send email
        if($updateLogin){
            $mail = $this->SendMailLoginHistory($accountId,$loginLastId);
            return true;
        }else{
            return false;
        }
    }

    // 8. Account session login
    public function AccountSessionLogin($req){
        $token = array_get($req,'token');
        // $checkAccount = $this->AccountLoginRepo->GetAccountByToken($token);
        $checkAccount = $this->AccountLoginRepo->GetAccountLoginByToken($token);

        $account = new Account;
        if($checkAccount){
            $account->status = true;
            $account->message = "This account actually exists.";
            $account->notice = "OK";
        }else{
            $account->status = false;
            $account->message = "This code is not in the system.";
            $account->notice = "Failed";
        }
        return $account;
    }

    // 9. Check login expired (Auto logout)
    public function CheckAccountLoginExpired(){
        $dateTimeNow = Carbon::now('Asia/Bangkok');
        $autoLogout = $this->AccountLoginRepo->AutoLogout($dateTimeNow);
        $account = new Account;

        if($autoLogout){
            $account->status = true;
            $account->message = 'Logout success.';
        }else{
            $account->status = false;
            $account->message = 'Logout failed.';
        }
        return $account;
    }
}