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

class AccountForceLogoutController extends Controller {

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

    // Force logout
    public function AccountForceLogout(Request $request){
        // return 'Account force logout controller';
        $accountData  = $request->input();
        try{
            $results = \AccountForceLogoutFacade::AccountForceLogout($accountData);
            if($results==null){
                abort(400);
            }
            return $results;
        }catch(Exception $e){
            abort(500);
        }
    } //

}