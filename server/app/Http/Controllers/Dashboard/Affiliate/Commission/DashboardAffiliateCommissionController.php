<?php
namespace App\Http\Controllers\Dashboard\Affiliate\Commission;

use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Support\Facades\Redirect;
use App\account as Account;

class DashboardAffiliateCommissionController extends Controller {

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

    // Commission
    public function DashboardAffiliateCommission(Request $request){
        $req  = $request->input();
        try{
			$results = \DashboardAffiliateCommissionSummaryFacade::AffiliateDashboardCommission($req);
			if($results==null){
				abort(400);
			}
			return $results;
			// return $this->Response(ResponseStatus::OK,ResponseCode::OK,$results);
		}catch(Exception $e){
			abort(500);
		}
    }
    
    // Commission days of month
    public function DashboardAffiliateCommissionDaysOfMonth(Request $request){
        $req  = $request->input();
        try{
			$results = \DashboardAffiliateCommissionDaysOfMonthFacade::AffiliateDashboardCommissionDaysOfMonth($req);
			if($results==null){
				abort(400);
			}
			return $results;
			// return $this->Response(ResponseStatus::OK,ResponseCode::OK,$results);
		}catch(Exception $e){
			abort(500);
		}
    }
    
    // Commission monthly
    public function DashboardAffiliateCommissionMonthly(Request $request){
        $req  = $request->input();
        try{
			$results = \DashboardAffiliateCommissionMonthlyFacade::AffiliateDashboardCommissionMonthly($req);
			if($results==null){
				abort(400);
			}
			return $results;
			// return $this->Response(ResponseStatus::OK,ResponseCode::OK,$results);
		}catch(Exception $e){
			abort(500);
		}
    }
    
    // Commission tour
    public function DashboardAffiliateCommissionTour(Request $request){
        $req  = $request->input();
        try{
			$results = \DashboardAffiliateCommissionTourFacade::AffiliateDashboardCommissionTour($req);
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