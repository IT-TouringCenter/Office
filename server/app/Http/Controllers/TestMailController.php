<?php
namespace App\Http\Controllers;

use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

class TestMailController extends MyBaseController {

	// Update tour travel
	public function TestMail(){
		$body =  "<html>
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
                                <h1 style='margin: 0; text-align: right;'>Username</h1>
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
                        <p class='text-center text-head-2 row-space' style='text-align: center; padding: 10px 0 10px 0; font-size: 18px;'><b>Account</b> : username@mail.com</p>
                        <hr>
                        <p class='row-space' style='padding: 10px 0 10px 0;'>รอการยืนยันการสมัครสมาชิก กรุณานำโค้ด .... เพื่อใช้ในการยืนยันการสมัครบนหน้าเว็บหรือคลิกที่ปุ่ม Confirm ด้านล่าง เพื่อยืนยันการสมัครและเริ่มต้นใช้งานทันที</p>
                        <p class='text-center color-red row-space' style='text-align: center; padding: 10px 0 10px 0; color: red;'>** โค้ดนี้จะมีอายุการใช้งานได้ถึง dd/mm/yyyy H:i:s **</p>
                        <p class='row-space text-center' style='text-align: center; padding: 10px 0 10px 0;'>
                            <a href='#' class='btn' style='min-width: 100px; cursor: pointer; color: white; text-decoration: none;'>
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
        
        $to = "ittouringcnx@gmail.com";
        $subject = "Register mail";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Reply-To: noreply@example.com". "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: reservations@touringcnx.com" . "\r\n";
        $headers .= "BCC: it@touringcnx.com, yuranannong@gmail.com";
        $mail = mail($to,$subject,$body,$headers);

        if($mail){
            return "Sent mail success!";
        }else{
            return "Sent mail failed";
        }

    }

}
