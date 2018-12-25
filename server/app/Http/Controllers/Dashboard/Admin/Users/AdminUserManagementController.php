<?php
namespace App\Http\Controllers\Dashboard\Admin\Users;

use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Support\Facades\Redirect;
use App\account as Account;

class AdminUserManagementController extends Controller {

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

	//-------------------- Table- ------------------------------------------//
	// User management : table
    public function AdminUserManagement(Request $request){
		$req  = $request->input();
        try{
			$results = \AdminUserManagementFacade::AdminUserManagement($req);
			if($results==null){
				abort(400);
			}
			return $results;
			// return $this->Response(ResponseStatus::OK,ResponseCode::OK,$results);
		}catch(Exception $e){
			abort(500);
		}

	}

	//-------------------- Add ---------------------------------------------//
	// User management : add
    public function AdminUserManagementAdd(Request $request){
		$req  = $request->input();
        try{
			$results = \AdminUserManagementAddFacade::AdminUserManagementAdd($req);
			if($results==null){
				abort(400);
			}
			return $results;
			// return $this->Response(ResponseStatus::OK,ResponseCode::OK,$results);
		}catch(Exception $e){
			abort(500);
		}

	}

	//-------------------- Edit --------------------------------------------//
	// User management : edit
    public function AdminUserManagementEdit(Request $request){
		$req  = $request->input();
        try{
			$results = \AdminUserManagementEditFacade::AdminUserManagementEdit($req);
			if($results==null){
				abort(400);
			}
			return $results;
			// return $this->Response(ResponseStatus::OK,ResponseCode::OK,$results);
		}catch(Exception $e){
			abort(500);
		}

	}

	// User management : edit (save)
	public function AdminUserManagementEditSave(Request $request){
		$req  = $request->input();
        try{
			$results = \AdminUserManagementEditSaveFacade::AdminUserManagementEditSave($req);
			if($results==null){
				abort(400);
			}
			return $results;
			// return $this->Response(ResponseStatus::OK,ResponseCode::OK,$results);
		}catch(Exception $e){
			abort(500);
		}
	}

	//-------------------- Delete ------------------------------------------//
	// User management : delete
	public function AdminUserManagementDelete(Request $request){
		$req  = $request->input();
        try{
			$results = \AdminUserManagementDeleteFacade::AdminUserManagementDelete($req);
			if($results==null){
				abort(400);
			}
			return $results;
			// return $this->Response(ResponseStatus::OK,ResponseCode::OK,$results);
		}catch(Exception $e){
			abort(500);
		}
	}

	// User management : delete (save)
	public function AdminUserManagementDeleteSave(Request $request){
		$req  = $request->input();
        try{
			$results = \AdminUserManagementDeleteSaveFacade::AdminUserManagementDeleteSave($req);
			if($results==null){
				abort(400);
			}
			return $results;
			// return $this->Response(ResponseStatus::OK,ResponseCode::OK,$results);
		}catch(Exception $e){
			abort(500);
		}
	}

	//-------------------- Active ------------------------------------------//
	// User management : active
	public function AdminUserManagementActive(Request $request){
		$req  = $request->input();
        try{
			$results = \AdminUserManagementActiveFacade::AdminUserManagementActive($req);
			if($results==null){
				abort(400);
			}
			return $results;
			// return $this->Response(ResponseStatus::OK,ResponseCode::OK,$results);
		}catch(Exception $e){
			abort(500);
		}
	}

	// User management : active (save)
	public function AdminUserManagementActiveSave(Request $request){
		$req  = $request->input();
        try{
			$results = \AdminUserManagementActiveSaveFacade::AdminUserManagementActiveSave($req);
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