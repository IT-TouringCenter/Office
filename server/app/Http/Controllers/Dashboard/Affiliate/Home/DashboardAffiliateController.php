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

    // Dashboard
    public function AffiliateDashboard(Request $request){
        $req  = $request->input();
        try{
			$results = \DashboardAffiliateFacade::AffiliateDashboard($req);
			if($results==null){
				abort(400);
			}
			return $results;
			// return $this->Response(ResponseStatus::OK,ResponseCode::OK,$results);
		}catch(Exception $e){
			abort(500);
		}
    }

    // Dashboard booked
    public function AffiliateDashboardBooked(Request $request){
        $req  = $request->input();
        try{
			$results = \DashboardAffiliateBookedFacade::AffiliateDashboardBooked($req);
			if($results==null){
				abort(400);
			}
			return $results;
			// return $this->Response(ResponseStatus::OK,ResponseCode::OK,$results);
		}catch(Exception $e){
			abort(500);
		}
    }

    // Dashboard commission
    public function AffiliateDashboardCommission(Request $request){
        $req  = $request->input();
        try{
			$results = \DashboardAffiliateCommissionFacade::AffiliateDashboardCommission($req);
			if($results==null){
				abort(400);
			}
			return $results;
			// return $this->Response(ResponseStatus::OK,ResponseCode::OK,$results);
		}catch(Exception $e){
			abort(500);
		}
    }
}