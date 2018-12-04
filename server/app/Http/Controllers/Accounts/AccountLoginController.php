<?php
namespace App\Http\Controllers\Accounts;

use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Support\Facades\Redirect;

class AccountLoginController extends Controller {

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
        1. Login
        2. Session login
    */

    // 1. Login
    public function AccountLogin(Request $request){
        $accountData  = $request->input();
        try{
            $results = \AccountLoginFacade::AccountLogin($accountData);
            if($results==null){
                abort(400);
            }
            return $results;
        }catch(Exception $e){
            abort(500);
        }
    }

    // 2. Session login
    public function AccountSessionLogin(Request $request){
        $accountData = $request->input();
        try{
            $results = \AccountLoginFacade::AccountSessionLogin($accountData);
            if($results==null){
                abort(400);
            }
            return $results;
        }catch(Exception $e){
            abort(500);
        }
    }

    // 3. Check account expired
    public function CheckAccountLoginExpired(Request $request){
        $accountData = $request->input();
        try{
            $results = \AccountLoginFacade::CheckAccountLoginExpired();
            if($results==null){
                abort(400);
            }
            return $results;
        }catch(Exception $e){
            abort(500);
        }
    }

    // 4. Check account login & return type
    public function AccountSessionLoginReturnType(Request $request){
        $accountData = $request->input();
        $token = array_get($accountData,'token');
        $accountType = array_get($accountData,'type');
        try{
            $results = \AccountLoginReturnTypeFacade::GetAccountByTokenReturnType($token,$accountType);
            if($results==null){
                abort(400);
            }
            return $results;
        }catch(Exception $e){
            abort(500);
        }
    }

}