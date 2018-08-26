<?php
namespace App\Http\Controllers\Accounts\Register;

use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Support\Facades\Redirect;

class AccountRegisterConfirmController extends Controller {

    protected function Response($status,$message,$e){
		switch ($status) {
			case ResponseStatus::OK:return ['status'=>$status,'message'=>$message,'data'=>$e];
			case ResponseStatus::NoContent:return ['status'=>$status,'message'=>$message,'data'=>$e];
			case ResponseStatus::ServerError:
				Log::error($e);
				return ['status'=>$status,'message'=>$message,'data'=>null];
			default:
			break;
		}		
	}//end Response function

    /*
        1. Register confirm
        2. Get account register confirm
        3. Check confirm code
        4. Set confirm code to account table
    */

    // 1. Register confirm
    public function AccountRegisterConfirm(Request $request){
        $accountData  = $request->input();
        try{
            $results = \AccountRegisterConfirmFacade::AccountRegisterConfirm($accountData);
            if($results==null){
                abort(400);
            }
            return $results;
        }catch(Exception $e){
            abort(500);
        }
    }

    // 2. Get account register confirm
    public function GetAccountRegisterConfirm($token){
        try{
            $results = \AccountRegisterConfirmFacade::GetAccountRegisterConfirm($token);
            if($results==null){
                abort(400);
            }
            return $results;
        }catch(Exception $e){
            abort(500);
        }
    }

    // 3. Check confirm code
    // public function CheckConfirmCode(Request $request){
    //     $accountData  = $request->input();
    //     try{
    //         $results = \AccountRegisterConfirmFacade::CheckConfirmCode($accountData);
    //         if($results==null){
    //             abort(400);
    //         }
    //         return $results;
    //     }catch(Exception $e){
    //         abort(500);
    //     }
    // }

    // 4. Set confirm code to account table
    public function AccountRegisterConfirmCodeAgain(Request $request){
        $accountData = $request->input();
        $token = array_get($accountData,'token');

        try{
            $results = \AccountRegisterConfirmFacade::AccountRegisterConfirmCodeAgain($token);
            if($results==null){
                abort(400);
            }
            return $results;
        }catch(Exception $e){
            abort(500);
        }
    }
}