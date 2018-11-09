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

	// Booked summary
    public function AffiliateDashboardBookedSummary(Request $request){
		$req  = $request->input();
        try{
			$results = \DashboardAffiliateBookedSummaryFacade::AffiliateDashboardBookedSummary($req);
			if($results==null){
				abort(400);
			}
			return $results;
			// return $this->Response(ResponseStatus::OK,ResponseCode::OK,$results);
		}catch(Exception $e){
			abort(500);
		}

	}

	// Booked summary (month)
	public function AffiliateDashboardBookedSummaryMonth(Request $request){
		$req  = $request->input();
        try{
			$results = \DashboardAffiliateBookedSummaryMonthFacade::AffiliateDashboardBookedSummaryMonth($req);
			if($results==null){
				abort(400);
			}
			return $results;
			// return $this->Response(ResponseStatus::OK,ResponseCode::OK,$results);
		}catch(Exception $e){
			abort(500);
		}
	}

	// Booked summary (year)
	public function AffiliateDashboardBookedSummaryYear(Request $request){
		$req  = $request->input();
        try{
			$results = \DashboardAffiliateBookedSummaryYearFacade::AffiliateDashboardBookedSummaryYear($req);
			if($results==null){
				abort(400);
			}
			return $results;
			// return $this->Response(ResponseStatus::OK,ResponseCode::OK,$results);
		}catch(Exception $e){
			abort(500);
		}
	}

    // Booked days of month
    public function AffiliateDashboardBookedDaysOfMonth(Request $request){
        $req  = $request->input();
        try{
			$results = \DashboardAffiliateBookedDaysOfMonthFacade::AffiliateDashboardBookedDaysOfMonth($req);
			if($results==null){
				abort(400);
			}
			return $results;
			// return $this->Response(ResponseStatus::OK,ResponseCode::OK,$results);
		}catch(Exception $e){
			abort(500);
		}

	}

	// Booked monthly
    public function AffiliateDashboardBookedMonthly(Request $request){
        $req  = $request->input();
        try{
			$results = \DashboardAffiliateBookedMonthlyFacade::AffiliateDashboardBookedMonthly($req);
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