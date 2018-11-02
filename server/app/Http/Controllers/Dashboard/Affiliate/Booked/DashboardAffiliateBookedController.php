<?php
namespace App\Http\Controllers\Dashboard\Affiliate\Booked;

use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Support\Facades\Redirect;
use App\account as Account;

class DashboardAffiliateBookedController extends Controller {

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
    public function AffiliateDashboardBookedDaysOfMonth(Request $request){
        return $request;
        $dataArr = [];

        $bookedRes = new Account;
        $bookedRes->data = [38,45,56,78,30,46,57,49,39,50,37,50];
        $bookedRes->label = "Booked";
        $bookedRes->total = "418";
        array_push($dataArr,$bookedRes);

        $travelRes = new Account;
        $travelRes->data = [28,38,40,19,46,27,40,38,22,25,37,19];
        $travelRes->label = "Traveled";
        $travelRes->total = "278";
        array_push($dataArr,$travelRes);

        $cancelRes = new Account;
        $cancelRes->data = [5,8,15,0,1,3,5,1,1,0,3,2];
        $cancelRes->label = "Cancel";
        $cancelRes->total = "37";
        array_push($dataArr,$cancelRes);

        return $dataArr;
    }
}