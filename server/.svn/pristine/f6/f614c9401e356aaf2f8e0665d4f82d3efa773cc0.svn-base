<?php
namespace App\Facades\EasyBook\Invoice;

use Carbon\Carbon;
use App\Commons\InvoiceStatus as invoiceStatus;
use App\invoice as invoice;
use App\invoice_airport as airportInvoice;
use App\invoice_convention as conventionInvoice;
use App\invoice_tour_program as tourProgramInvoice;

use App\Repositories\EasyBook\Tour\TourTimeRepositoy as TourTimeRepo;
use App\Repositories\EasyBook\Invoice\InvoiceRepository as InvoiceRepo;
// use App\Repositories\EasyBook\Transaction\TransactionTourProgramRepository as TourRepo;
use App\Repositories\EasyBook\Transaction\TransactionTransferRepository as TransferRepo;
use App\Repositories\EasyBook\Transaction\TransactionRepository as TransactionRepo;
use App\Repositories\EasyBook\Passenger\PassengerRepository as PassengerRepo;


class InvoiceClass{
    public function __construct(InvoiceRepo $InvoiceRepo, TourTimeRepo $TourTimeRepo,TransferRepo $TransferRepo, TransactionRepo $TransactionRepo, PassengerRepo $PassengerRepo){        
        $this->InvoiceRepo = $InvoiceRepo;
        $this->TourTimeRepo= $TourTimeRepo;
        $this->TransferRepo = $TransferRepo;
        $this->TransactionRepo = $TransactionRepo;
        $this->PassengerRepo = $PassengerRepo;

        $this->Invoices = new invoice();
        $this->activityId = 0;
    }

    /****************** Insert Invoice ******************/
    public function InsertInvoice($activityId,$transctionId){
        // $data->invoiceId= \HelperFacade::ReserveIdentify($this->activityId);
        // $data->statusId = 0;//0: Pending, 1: Approved
        $invoice = new invoice();
		$invoice->activityId = $activityId;
		$invoice->transactionId = $transctionId;

		// $invoice->invoiceNumber= \HelperFacade::ReserveIdentify($this->activityId);
		$invoice->paymentId= 0;//update correct paymentId when your paid your payment
		$invoice->statusId=0;//0:Pending, 1: Approved

        $invoice->isActive = true;
        $invoice->createdBy= "System";
        $invoice->createdDate = Carbon::now('Asia/Bangkok');
        
        return $this->InvoiceRepo->InsertInvoice($invoice);
    }

    public function InsertAirportInvoice($activityId,$invoiceId,$airportId,$invoiceNumber){
        $invoice = new invoice();
		$invoice->invoiceId = $invoiceId;
		$invoice->airportId = $airportId;

        // set invoice number format
        $this->invoice = new invoice();
        $this->SetFormatInvoice($invoiceNumber);
        $SetFormatInvoice = $this->invoice;
        $invoice->invoiceNumber = $SetFormatInvoice;

        $invoice->template = '';

        $invoice->isActive= true;
        $invoice->createdBy= "System";
        $invoice->createdDate = Carbon::now('Asia/Bangkok');

        $this->InvoiceRepo->InsertAirportInvoice($invoice);
    }

    public function InsertConventionInvoice($activityId,$invoiceId,$conventionId,$invoiceNumber){
        $invoice = new invoice();
		$invoice->invoiceId = $invoiceId;
		$invoice->conventionId = $conventionId;

        // set invoice number format
        $this->invoice = new invoice();
        $this->SetFormatInvoice($invoiceNumber);
        $SetFormatInvoice = $this->invoice;
        $invoice->invoiceNumber = $SetFormatInvoice;

		// $invoice->invoiceNumber = \HelperFacade::ReserveIdentify($activityId);
        $invoice->template = '';

        $invoice->isActive= true;
        $invoice->createdBy= "System";
        $invoice->createdDate = Carbon::now('Asia/Bangkok');

        $this->InvoiceRepo->InsertConventionInvoice($invoice);
    }

    public function InsertTourInvoice($activityId,$invoiceId,$tourProgramId,$invoiceNumber){
        $invoice = new invoice();
		$invoice->invoiceId = $invoiceId;
		$invoice->tourProgramId = $tourProgramId;
		
        // set invoice number format;
        $this->invoice = new invoice();
        $this->SetFormatInvoice($invoiceNumber);
        $SetFormatInvoice = $this->invoice;
        $invoice->invoiceNumber = $SetFormatInvoice;

        $invoice->template = '';

        $invoice->isActive= true;
        $invoice->createdBy= "System";
        $invoice->createdDate = Carbon::now('Asia/Bangkok');

        $this->InvoiceRepo->InsertTourProgramInvoice($invoice);
    }

    /****************** Get Invoices ******************/
    public function GetInvoiceByTransactionId($transactionId){        
        $this->GetTourInvoiceByTransactionId($transactionId);                               
        $this->GetConventionInvoiceByTransactionId($transactionId);
        $this->GetAirportInvoiceByTransactionId($transactionId);

        return $this->Invoices;
    }

    /****************** Tour Invoice ******************/
    public function GetTourInvoiceByTransactionId($transactionId){
        $this->GetTourByTransactionId($transactionId);
        $this->GetPassengersTourByTransactionId($transactionId);
        $this->GetHotelTourByTransactionId($transactionId);
    }
           
    public function GetTourByTransactionId($transactionId){
        $resp =$this->TourRepo->GetGroupToursByTransactionId($transactionId);
        if($resp==null){
            $this->activityId = 0;
            $this->Invoices->tours =[];
            return;            
        }

        $this->activityId= $resp[0]->activity_id;

        $tours =[];
        foreach ($resp as $value) {
            $tours[]=[
                'code'=>$value->code,
                'title'=>$value->title,
                'medical'=>$value->medical,
                'unit'=>$value->unit,
                'amount'=>$value->amount
            ];
        }        
        
        $identify = \HelperFacade::ReserveIdentify($this->activityId);

        $this->Invoices->tours =[
            'id'=>$identify,
            'programs'=>$tours
        ];
        
        return $this->Invoices->tours;
    }

    public function GetPassengersTourByTransactionId($transactionId){
        $passengers= $this->TourRepo->GetContactByTransactionId($transactionId);
        array_add($this->Invoices->tours,'passengers',$passengers);
    }
    
    public function GetHotelTourByTransactionId($transactionId){        
        $hotel= $this->TourRepo->GetHotelTourByTransactionId($transactionId);
        array_add($this->Invoices->tours,'hotel',$hotel);        
    }
    /************************************/
     
    public function GetConventionInvoiceByTransactionId($transactionId){        
        $results = $this->TransferRepo->GetConventionInvoiceByTransactionId($transactionId);
        if($results==null || $results->unit==0){
            $this->Invoices->convention = [];
            return;
        }

        $passengers = $this->TransferRepo->GetPassengersConventionInvoiceByTransactionId($transactionId);

        $invoice=[
            'description'=>'Transfer to / from Convention Centre',
            'unit'=>$results->unit,
            'price'=>$results->price,
            'amount'=>$results->amount
         ];

         $this->Invoices->convention = [
             'id'=>\HelperFacade::ReserveIdentify($this->activityId),
             'invoice'=>$invoice,
             'passenger'=>$passengers
         ];

         return $this->Invoices->convention;
    }
    
    public function GetAirportInvoiceByTransactionId($transactionId){
         $results = $this->TransferRepo->GetAirportInvoiceByTransactionId($transactionId);
         if($results==null || $results->unit==0){
            $this->Invoices->airport = [];
            return;
        }

         $passengers = $this->TransferRepo->GetPassengersAirportInvoiceByTransactionId($transactionId);

         $invoice=[
            'description'=>'Transfer to / from Convention Centre',
            'unit'=>$results->unit,
            'price'=>$results->price,
            'amount'=>$results->amount
         ];

         $this->Invoices->airport = [
             'id'=>\HelperFacade::ReserveIdentify($this->activityId),
             'invoice'=>$invoice,
             'passenger'=>$passengers
         ];

         return $this->Invoices->airport;
         
    }

    ///*------------ Invoice Format ICAS-2017-050001 ------------*///
    public function SetFormatInvoice($invoiceNumber){
        $YearInvoice = substr($invoiceNumber, 0, 4);
        $MonthInvoice = substr($invoiceNumber, 4, 2);
        $RunInvoice = substr($invoiceNumber, 6, 4);

        $SetInvoice = "ICAS-".$YearInvoice."-".$MonthInvoice.$RunInvoice;
        return $this->invoice = $SetInvoice;
    }

    ///*--------- Payment via paypal success (insert invoice number) -------*///
    // per program
    public function insertInvoiceNumber($request){
        $activityId = 1;
        $transactionId = \HelperFacade::Decode($request->cm);
        $transaction = $this->TransactionRepo->GetTransactionByPaid($transactionId);
        $invoiceId = $this->InvoiceRepo->GetInvoiceId($transactionId);

        $invoice_arr = [];
        //*--- Convention ---*//
        $convention = $transaction->conventionTransfer;
        if($convention[0] != null){

            $this->convInvoiceNumber = \HelperFacade::ReserveIdentify($activityId);
            foreach($convention as $valConv){
                $this->invoiceConv = new invoice;
                $this->invoiceConv->program = "Convention";
                $this->invoiceConv->activityId = $activityId;
                $this->invoiceConv->invoiceId = $invoiceId[0]->id;
                $this->invoiceConv->transactionId = $valConv->id;
                $this->invoiceConv->invoiceNumber = $this->convInvoiceNumber;
                array_push($invoice_arr, $this->invoiceConv);
            }
            foreach($invoice_arr as $insertValConv){
                if($insertValConv->program == "Convention"){
                    \InvoiceFacade::InsertConventionInvoice(
                        $insertValConv->activityId,
                        $insertValConv->invoiceId,
                        $insertValConv->transactionId,
                        $insertValConv->invoiceNumber
                    );
                }
            }
        }

        //*--- Airport ---*//
        $airport = $transaction->airportTransfer;
        if($convention[0] != null){
            $this->airportInvoiceNumber =\HelperFacade::ReserveIdentify($activityId);
            foreach($airport as $valAir){
                $this->invoiceAir = new invoice;
                $this->invoiceAir->program = "Airport";
                $this->invoiceAir->activityId = $activityId;
                $this->invoiceAir->invoiceId = $invoiceId[0]->id;
                $this->invoiceAir->transactionId = $valAir->id;
                $this->invoiceAir->invoiceNumber = $this->airportInvoiceNumber;
                array_push($invoice_arr, $this->invoiceAir);
            }
            // return $this->airportInvoiceNumber;
            foreach($invoice_arr as $insertValAir){
                if($insertValAir->program == "Airport"){
                    \InvoiceFacade::InsertAirportInvoice(
                        $insertValAir->activityId,
                        $insertValAir->invoiceId,
                        $insertValAir->transactionId,
                        $insertValAir->invoiceNumber
                    );
                }
            }
        } 

        //*--- Tour ---*//
        $tour = $transaction->tourProgram;
        if($tour[0] != null){
            $tour_arr = [];
            $checkTransaction = $this->TransactionRepo->GetTransctionCheckUnique($transactionId);
            $uniqueTransaction = \HelperFacade::CheckUnique($checkTransaction);

            foreach($uniqueTransaction as $val){
                $this->tourInvoiceNumber = \HelperFacade::ReserveIdentify($activityId);
                $sumTour = [];
                $getTransactionTourId = $this->TransactionRepo->GetTransactionTourId($val);
                $invTour = new invoice;
                $invTour->transactionTour = $getTransactionTourId;

                foreach($getTransactionTourId as $valTransTour){
                    $this->invoiceTour = new invoice;
                    $this->invoiceTour->program = "Tour";
                    $this->invoiceTour->activityId = $activityId;
                    $this->invoiceTour->invoiceId = $invoiceId[0]->id;
                    $this->invoiceTour->transactionId = $valTransTour->transactionTourId;
                    $this->invoiceTour->invoiceNumber = $this->tourInvoiceNumber;
                    array_push($invoice_arr, $this->invoiceTour);
                }
            }
            foreach($invoice_arr as $insertValTour){
                if($insertValTour->program == "Tour"){
                    \InvoiceFacade::InsertTourInvoice(
                        $insertValTour->activityId,
                        $insertValTour->invoiceId,
                        $insertValTour->transactionId,
                        $insertValTour->invoiceNumber
                    );
                }
            }
        }
        return $invoice_arr;
    }

    // per pax
    public function InsertInvoiceNumberPerPax($request){
        $activityId = 1;
        $transactionId = \HelperFacade::Decode($request->cm);

        $insertInvoice = \InvoiceFacade::InsertInvoice($activityId,$transactionId);
        $bookingId = \HelperFacade::GenerateTransactionNumber($insertInvoice);
        $invoiceId = $this->InvoiceRepo->GetInvoiceId($transactionId);

        $passengerTransfer = $this->TransactionRepo->GetPassengerTransactionTransfer($transactionId);
        $passengerTour = $this->TransactionRepo->GetPassengerTourProgram($transactionId);

        $passengerArr = [];

        if($passengerTransfer!=null){
            foreach($passengerTransfer as $valTransfer){
                $invoice = new invoice;
                $invoice->invoiceId = $invoiceId[0]->id;
                $invoice->passengerId = $valTransfer->passenger_id;
                $invoice->bookingNumber = "ICAS ".$bookingId;
                $invoice->issuedBy = "Online";
                $invoice->isActive = 1;
                $invoice->createdBy = 'System';
                $invoice->createdDate = Carbon::now('Asia/Bangkok');

                array_push($passengerArr, $invoice);
            }
        }

        if($passengerTour!=null){
            foreach($passengerTour as $valTour){
                $invoice = new invoice;
                $invoice->invoiceId = $invoiceId[0]->id;
                $invoice->passengerId = $valTour->passenger_id;
                $invoice->bookingNumber = "ICAS ".$bookingId;
                $invoice->issuedBy = "Online";
                $invoice->isActive = 1;
                $invoice->createdBy = 'System';
                $invoice->createdDate = Carbon::now('Asia/Bangkok');

                array_push($passengerArr, $invoice);
            }
        }

        //**--------- Set invoice number ---------**//
        $passengerUnique = \HelperFacade::CheckUnique($passengerArr);

        $count = 1;
        foreach($passengerUnique as $val){
            $passengerIdStr = str_pad($count,2,0,STR_PAD_LEFT);
            $invoiceNumber = $bookingId.'-'.$passengerIdStr;
            $passengerUnique[$count-1]->invoiceNumber = $invoiceNumber;
            $count++;
        }

        $insertInvoice = $this->InvoiceRepo->InsertInvoicePerPax($passengerUnique);
        return $insertInvoice;
    }

    public function GetUniquePassenger($transactionId){
        $passengerTransfer = $this->TransactionRepo->GetPassengerTransactionConvention($transactionId);
        return $passengerTransfer;
    }

    //*---------------- Get Invoice per person ------------*///
    public function GetInvoice($transactionId, $passengerId){
        $this->invoice = new invoice;

        $invoice = $this->InvoiceRepo->GetInvoiceNumber($transactionId, $passengerId);
        $party = $this->InvoiceRepo->GetTransactionParty($transactionId);
        // return $invoice;
        $this->invoice->bookingId = $invoice[0]->booking_number;
        $this->invoice->invoiceId = $invoice[0]->invoice_number;
        $this->invoice->bookDate = date('d F Y',strtotime($invoice[0]->created_at));
        $this->invoice->issuedDate = date('d F Y',strtotime($invoice[0]->payment_date));
        $this->invoice->issuedBy = $invoice[0]->issued_by;
        $this->invoice->party = count($party);
        $this->GetPassengerDetail($transactionId, $passengerId);

        $this->GetInvoiceConvention($transactionId, $passengerId);
        $this->GetInvoiceAirport($transactionId, $passengerId);
        $this->GetInvoiceTour($transactionId, $passengerId);

        //**  Summary price & check is empty  **//
        $totalPrice = 0;
        $totalDiscount = 0;

        // check empty convention
        if($this->invoice->convention==null){
            $this->invoice->isConvention = false;
        }else{
            $this->invoice->isConvention = true;
            $totalPrice += $this->invoice->convention->price;
            // get convention date
        }

        // check empty airport
        if($this->invoice->airport==null){
            $this->invoice->isAirport = false;
        }else{
            $this->invoice->isAirport = true;
            // sum airport
            foreach($this->invoice->airport as $valAir){
                $totalPrice += $valAir->price;
            }
        }

        // check empty tour
        if($this->invoice->tour==null){
            $this->invoice->isTour = false;
        }else{
            $this->invoice->isTour = true;
            //sum tour
            foreach($this->invoice->tour as $valTour){
                $totalPrice += $valTour->price;
                $totalDiscount += $valTour->discount;
            }
        }

        $this->invoice->totalPrice = $totalPrice;
        $this->invoice->totalDiscount = $totalDiscount;
        $this->invoice->amount = $totalPrice-$totalDiscount;

        if($this->invoice->isConvention==false && $this->invoice->isAirport==false && $this->invoice->isTour==false){
            return null;
        }else{
            return $this->invoice;
        }
    }

    public function GetPassengerDetail($transactionId, $passengerId){
        $result = $this->PassengerRepo->GetPassengerInformation($transactionId, $passengerId);

        $passenger = new invoice;
        $passenger->fullname = $result->firstname.' '.$result->lastname;
        $passenger->nationality = $result->nationality;
        $passenger->email = $result->email;
        $passenger->hotel = $result->hotel;
        $passenger->isPrimary = $result->is_primary;

        $this->invoice->passenger = $passenger;
    }

    public function GetInvoiceConvention($transactionId, $passengerId){
        $result = $this->InvoiceRepo->GetInvoiceConvention($transactionId, $passengerId);

        if($result==null){
            $this->invoice->convention = null;
            return;
        }

        $conventionDate = $this->InvoiceRepo->GetConventionDate($result->id);
        
        $this->invoice->convention = $result;
        
        if(count($conventionDate)<4 && count($conventionDate)>0){
            $setDate_arr = [];
            $fixDate = new invoice;
            $count = 0;
            foreach($conventionDate as $value){
                $count++;
                
                if($count>1){
                    $fixDate->date .= ', '.date('d', strtotime($value->date));
                }else{
                    $fixDate->date .= date('d', strtotime($value->date));
                }
                
                if($count==count($conventionDate)){
                    $fixDate->date .= ' '.'July 2017';
                }

                array_push($setDate_arr, $fixDate);
            }
            $this->invoice->convention->daypass = "CMECC Transfer (".count($conventionDate)." Day Pass)";
            $this->invoice->convention->date = $setDate_arr[0]->date;
            $this->invoice->convention->fullPackage = false;
        }else{
            $this->invoice->convention->daypass = "CMECC Transfer (4 Day Pass)";
            $this->invoice->convention->date = "20-23 July 2017";
            $this->invoice->convention->fullPackage = true;
        }

        $this->invoice->convention->pricePerDay = "THB 700 per day x ".count($conventionDate)." days";
    }

    public function GetInvoiceAirport($transactionId, $passengerId){
        $result = $this->InvoiceRepo->GetInvoiceAirport($transactionId, $passengerId);
        $airportArr = [];

        $count = count($result);
        if($count==2){
            foreach($result as $value){
                $invoice = new invoice;
                $invoice->transfer = $value->origin;

                $flightDate = date('d F Y H:i:s', strtotime($value->flight_date));

                $invoice->flightNumber = $value->flight_number.' ('.$flightDate.' hrs.)';
                $invoice->price = $value->price;
                array_push($airportArr,$invoice);
            }
            $this->invoice->airport = $airportArr;
        }else if($count==1){
            if($result[0]->origin=='Arrival'){
                // Set departure for array index == 0
                $invoiceArrival1 = new invoice;
                $invoiceArrival1->transfer = "Departure";
                $invoiceArrival1->flightNumber = '-';
                $invoiceArrival1->price = 0;
                array_push($airportArr, $invoiceArrival1);

                // Set arrival for array index == 1
                $invoiceArrival2 = new invoice;
                $invoiceArrival2->transfer = $result[0]->origin;
                $flightDateArrival = date('d F Y H:i:s', strtotime($result[0]->flight_date));

                $invoiceArrival2->flightNumber = $result[0]->flight_number.' ('.$flightDateArrival.' hrs.)';
                $invoiceArrival2->price = $result[0]->price;
                array_push($airportArr,$invoiceArrival2);

            }else if($result[0]->origin=='Departure'){
                // Set departure for array index == 0
                $invoiceDeparture1 = new invoice;
                $invoiceDeparture1->transfer = $result[0]->origin;
                $flightDateDeparture = date('d F Y H:i:s', strtotime($result[0]->flight_date));

                $invoiceDeparture1->flightNumber = $result[0]->flight_number.' ('.$flightDateDeparture.' hrs.)';
                $invoiceDeparture1->price = $result[0]->price;
                array_push($airportArr,$invoiceDeparture1);

                // Set arrival for array index == 1
                $invoiceDeparture2 = new invoice;
                $invoiceDeparture2->transfer = "Arrival";
                $invoiceDeparture2->flightNumber = '-';
                $invoiceDeparture2->price = 0;
                array_push($airportArr, $invoiceDeparture2);
            }
            $this->invoice->airport = $airportArr;
        }else{
            $this->invoice->airport = null;
        }

        // $this->invoice->airport = $airportArr;
    }

    public function GetInvoiceTour($transactionId, $passengerId){
        $result = $this->InvoiceRepo->GetInvoiceTour($transactionId, $passengerId);
        $tourArr = [];

        if(count($result)<1){
            $this->invoice->tour = null;
        }else{
            foreach($result as $value){
                $tourInvoice = new invoice;
                $tourInvoice->program = $value->tour_program_code.' : '.$value->tour_program_title;
                $tourInvoice->pickup = $value->pickup_time;
                $tourInvoice->category = $value->category;
                $tourInvoice->travelingTime = $value->traveling_time;
                $tourInvoice->travelingDate = date('d F Y',strtotime($value->tour_traveling_date));
                $tourInvoice->price = intVal($value->price);
                $tourInvoice->discount = intVal($value->discount);
                $tourInvoice->amount = intVal($value->price)-intVal($value->discount);

                array_push($tourArr, $tourInvoice);
            }
            $this->invoice->tour = $tourArr;
        }

    }
}
?>