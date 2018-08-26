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

class AccountController extends Controller {

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
	}// end Response function

    /*
        1. Get account login by token
        2. Get account by token
    */

    // 1. Get account login by token
    public function GetAccountLoginByToken(Request $request){
    // public function GetAccountLoginByToken($token){
        $accountData = $request->input();
        $token = array_get($accountData,'token');
        // return $token;
        try{
            $results = \AccountFacade::GetAccountLoginByToken($token);
            if($results==null){
                abort(400);
            }
            return $results;
        }catch(Exception $e){
            abort(500);
        }
    }

    // 2. Get account by token
    public function GetAccountByToken(Request $request){
        $accountData = $request->input();
        $token = array_get($accountData,'token');
        try{
            $results = \AccountFacade::GetAccountByToken($token);
            if($results==null){
                abort(400);
            }
            return $results;
        }catch(Exception $e){
            abort(500);
        }
    }
}