<?php
namespace App\Facades\EasyBook\Invoice;

use Carbon\Carbon;
use App\invoice as invoice;
use App\invoice_tour_program as tourProgramInvoice;

use App\Repositories\EasyBook\Invoice\InvoiceRepository as InvoiceRepo;

class InvoiceTourClass{
    public function __construct(InvoiceRepo $InvoiceRepo){        
    	$this->InvoiceRepo = $InvoiceRepo;
    }

    public function GetInvoiceTourProgram($transactionId, $transactionTourId){
    	$result = $this->InvoiceRepo->GetTourInvoice($transactionId, $transactionTourId);
    	if($result==null){
    		return [];
    	}

    	$this->passenger = new invoice;
    	$this->GetPassengerByTourProgram($transactionId, $result);

    	$passenger = $this->passenger;
    	$unit = count($this->passenger);

    	$discount = 0;
    	$amount = 0;
    	foreach($this->passenger as $value){
    		$discount += intval($value->discount);
    		$amount += (intval($value->price)-intval($value->discount));
    	}

    	$result->transactionId = \HelperFacade::GenerateTransactionNumber($result->transactionId);
        $result->travelDate = date('d F Y', strtotime($result->travelDate));
    	// $result->issueDate = date('d F Y H:i:s', strtotime($result->issueDate)).' Hrs.';
        // $result->issueDate = 
        $result->noParty = $unit;
    	$result->unit = $unit;
    	$result->price = intval($result->price);
    	$result->discount = $discount;
    	$result->amount = $amount;
    	$result->passengers = $passenger;
    	return $result;
    }

    public function GetPassengerByTourProgram($transactionId, $data){
    	$result = $this->InvoiceRepo->GetPassengerByTourProgram($transactionId, $data);
    	$this->passenger = $result;
    }
}