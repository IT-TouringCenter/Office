<?php
namespace App\Http\Controllers\Dashboard\Affiliate\Home;

use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Support\Facades\Redirect;
use App\account as Account;

class DashboardAffiliateController extends Controller {

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

    // Logout
    public function AffiliateDashboard(Request $request){

        $dataArr = [];

        $bookedRes = new Account;
        $bookedRes->data = [38,45,56,78,30,46,57,49,39,0,0,0];
        $bookedRes->label = "Booked";
        $bookedRes->total = "418";
        array_push($dataArr,$bookedRes);

        $travelRes = new Account;
        $travelRes->data = [28,38,40,19,46,27,40,38,2,0,0,0];
        $travelRes->label = "Traveled";
        $travelRes->total = "278";
        array_push($dataArr,$travelRes);

        $cancelRes = new Account;
        $cancelRes->data = [5,8,15,0,1,3,5,0,0,0,0,0];
        $cancelRes->label = "Cancel";
        $cancelRes->total = "37";
        array_push($dataArr,$cancelRes);

        return $dataArr;
        // return 'Account logout controller';
        // $accountData  = $request->input();
        // try{
        //     $results = \AccountLogoutFacade::AccountLogout($accountData);
        //     if($results==null){
        //         abort(400);
        //     }
        //     return $results;
        // }catch(Exception $e){
        //     abort(500);
        // }
    } //

}