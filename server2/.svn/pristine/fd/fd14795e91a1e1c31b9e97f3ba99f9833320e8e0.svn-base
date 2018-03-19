<?php 
namespace App\Http\Controllers\EasyBook\Report;

use App\Http\Requests;
use App\Commons\ResponseCode;
use App\Commons\ResponseStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MyBaseController;

use Illuminate\Http\Request;
use App\transaction as transaction;

class ReportController extends MyBaseController {

	public function GetInvoiceSummary(){
		$results = \ReportFacade::GetInvoiceSummary();
		return $results;
	}

	public function GetReportCMECC(){
		$results = \ReportFacade::GetReportCMECC();
		return $results;
	}

	public function GetReportAirport(){
		$results = \ReportFacade::GetReportAirport();
		return $results;
	}

	public function GetReportTour(){
		$results = \ReportFacade::GetReportTour();
		return $results;
	}

}