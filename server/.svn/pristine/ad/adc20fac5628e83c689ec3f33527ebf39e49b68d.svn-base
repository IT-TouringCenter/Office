<?php
namespace App\Facades\EasyBook\Tour;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Repositories\EasyBook\Tour\TourInvoiceRepository as tour_invoice_repo;

use App\tour_invoice as tour_invoice;

class TourInvoiceClass{
	
	public function __construct(tour_invoice_repo $tour_invoice_repo){
		$this->tour_invoice_repo = $tour_invoice_repo;
	}

	public function GetLastTourInvoice(){
		$result = $this->tour_invoice_repo->GetLastTourInvoiceId();
		return $result;
	}

	public function SetTourInvoice($invoice){
		$result = $this->tour_invoice_repo->SetTourInvoiceForGetId($invoice);
		return $result;
	}

}