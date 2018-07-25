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

class AccountRegisterController extends Controller {

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

    // Register
    public function AccountRegister(Request $request){
        $accountData  = $request->input();
        try{
            $results = \AccountRegisterFacade::AccountRegister($accountData);
            if($results==null){
                abort(400);
            }
            return $results;
        }catch(Exception $e){
            abort(500);
        }
    } //

    // Check email repeat
    public function CheckEmailRepeat(Request $request){
        $data = $request->input();
        $email = array_get($data,'email');
        try{
            $results = \AccountRegisterFacade::CheckEmailRepeat($email);
            if($results==null){
                abort(400);
            }
            return $results;
        }catch(Exception $e){
            abort(500);
        }
    }

}