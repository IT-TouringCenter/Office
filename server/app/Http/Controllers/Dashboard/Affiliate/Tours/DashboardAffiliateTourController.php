<?php
namespace App\Http\Controllers\Dashboard\Affiliate\Tours;

use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Support\Facades\Redirect;
use App\account as Account;

class DashboardAffiliateTourController extends Controller {

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

    // Tour summary
    public function AffiliateDashboardTour(Request $request){
        $req  = $request->input();
        try{
			$results = \DashboardAffiliateTourFacade::AffiliateDashboardTour($req);
			if($results==null){
				abort(400);
			}
			return $results;
			// return $this->Response(ResponseStatus::OK,ResponseCode::OK,$results);
		}catch(Exception $e){
			abort(500);
		}
    }

    // Tour days of month
    public function AffiliateDashboardTourDaysOfMonth(Request $request){
        $req  = $request->input();
        try{
			$results = \DashboardAffiliateTourDaysOfMonthFacade::AffiliateDashboardTourDaysOfMonth($req);
			if($results==null){
				abort(400);
			}
			return $results;
			// return $this->Response(ResponseStatus::OK,ResponseCode::OK,$results);
		}catch(Exception $e){
			abort(500);
		}
	}

    // Tour monthly
    public function AffiliateDashboardTourMonthly(Request $request){
        $req  = $request->input();
        try{
			$results = \DashboardAffiliateTourMonthlyFacade::AffiliateDashboardTourMonthly($req);
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