<?php
namespace App\Facades\Commons;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Repositories\Commons\GenerateTokenRepository as GenerateTokenRepo;

class GenerateCodeClass{

	public function __construct(GenerateTokenRepo $GenerateTokenRepo){
        $this->GenerateTokenRepo = $GenerateTokenRepo;
	}

    /*
        1. Encode
        2. Decode
        3. Generate token
        3.1 Check token repeat
        4. Active code
        5. OTP
        6. Code 5 char
        7. Hidden password
    */

    // 1. Encode
    public function Encode($data){
        $result = base64_encode($data);
        return $result;
    }

    // 2. Decode
    public function Decode($data){
        $result = base64_decode($data);
        return $result;
    }

    // 3. Generate token
    public function GenerateToken(){
        $chars = "111222333444555666777888999000";
        $code = substr(str_shuffle($chars),0,9);
        $token = '1'.$code;

        // Check empty
        $tokenKey = $this->CheckTokenRepeat($token);
        return $tokenKey;
    }

    // 3.1 Check token repeat
    public function CheckTokenRepeat($token){
        $result = $this->GenerateTokenRepo->CheckTokenRepeat($token);
        if($result==true){
            $this->GenerateToken();
        }else{
            $this->GenerateTokenRepo->SaveToken($token);
            return $token;
        }
    }

    // 4. Active code
    public function CreateActiveCode(){
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $code = substr(str_shuffle($chars),0,10);
        return $code;
    }

    // 5. OTP
    public function CreateOTP(){
        $chars = "1234567890";
        $code = substr(str_shuffle($chars),0,5);
        return $code;
    }
    
    // 6. Code 5 char
    public function Code5Chars(){
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $code = substr(str_shuffle($chars),0,5);
        return $code;
    }

    // 7. Hidden password
    public function HiddenPassword($password){
        $text1 = substr($password,0,2);
        $text2 = 'xxxxx';
        $text3 = substr($password,-2,2);

        $hiddenPass = $text1.$text2.$text3;
        return $hiddenPass;
    }

}