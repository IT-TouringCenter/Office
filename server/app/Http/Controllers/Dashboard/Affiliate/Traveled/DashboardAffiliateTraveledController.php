<?php
namespace App\Http\Controllers\Dashboard\Affiliate\Traveled;

use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Support\Facades\Redirect;
use App\account as Account;

class DashboardAffiliateTraveledController extends Controller {

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

    // Traveled
    public function AffiliateDashboardTraveled(Request $request){
        $req  = $request->input();
        try{
			$results = \DashboardAffiliateTraveledFacade::AffiliateDashboardTraveled($req);
			if($results==null){
				abort(400);
			}
			return $results;
			// return $this->Response(ResponseStatus::OK,ResponseCode::OK,$results);
		}catch(Exception $e){
			abort(500);
		}
	}
	
	// Traveled days of month
    public function AffiliateDashboardTraveledDaysOfMonth(Request $request){
        $req  = $request->input();
        try{
			$results = \DashboardAffiliateTraveledDaysOfMonthFacade::AffiliateDashboardTraveledDaysOfMonth($req);
			if($results==null){
				abort(400);
			}
			return $results;
			// return $this->Response(ResponseStatus::OK,ResponseCode::OK,$results);
		}catch(Exception $e){
			abort(500);
		}
	}
	
	// Traveled monthly
    public function AffiliateDashboardTraveledMonthly(Request $request){
        $req  = $request->input();
        try{
			$results = \DashboardAffiliateTraveledMonthlyFacade::AffiliateDashboardTraveledMonthly($req);
			if($results==null){
				abort(400);
			}
			return $results;
			// return $this->Response(ResponseStatus::OK,ResponseCode::OK,$results);
		}catch(Exception $e){
			abort(500);
		}
	}
	
	// Traveled tour
    public function AffiliateDashboardTraveledTour(Request $request){
        $req  = $request->input();
        try{
			$results = \DashboardAffiliateTraveledTourFacade::AffiliateDashboardTraveledTour($req);
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