<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Commons\ResponseCode;
use App\Commons\ResponseStatus;
use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\configuration_tour_price as configuration_tour_price;
// use App\tour_program as tour_program;
// use App\tour_category as tour_category;
// use App\tour_type as tour_type;
// use Carbon\Carbon;

class MainController extends MyBaseController {

    public function GetFooter(){
      try {

        $result = \FooterFacade::GetFooter();
        if($result==null){
          return $this->Response(ResponseStatus::NoContent,ResponseCode::NoContent,null);
        }
        return $this->Response(ResponseStatus::OK,ResponseCode::OK,$result);

      } catch (Exception $e) {
        return $this->Response(ResponseStatus::ServerError,ResponseCode::ServerError,'MainController.GetFooter error: '.$e);
      }
       
    }
}
