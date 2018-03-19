<?php
namespace App\Repositories\EasyBook\Invoice;

use Carbon\Carbon;
use App\invoice as Invoice;
use App\invoice_convention as ConventionInvoice;
use App\invoice_airport as AirportInvoice;
use App\invoice_tour_program as TourInvoice;
use App\invoice_passenger as PassengerInvoice;

class InvoiceRepository{
    public function __construct(Invoice $Invoice,ConventionInvoice $ConventionInvoice,AirportInvoice $AirportInvoice,TourInvoice $TourInvoice, PassengerInvoice $PassengerInvoice){
        $this->Invoice = $Invoice;
        $this->ConventionInvoice = $ConventionInvoice;
        $this->AirportInvoice = $AirportInvoice;
        $this->TourInvoice = $TourInvoice;
        $this->PassengerInvoice = $PassengerInvoice;
    }

    public function InsertInvoice($invoice){
        $request = [
            'transaction_id'=>$invoice->transactionId,
            'payment_id'=>$invoice->paymentId,                        
            'activity_id'=>$invoice->activityId,
            'status_id'=>$invoice->statusId,
            'is_active'=>$invoice->isActive,
            'created_by'=>$invoice->createdBy,
            'created_at'=>$invoice->createdDate
        ];

        return $this->Invoice->insertGetId($request);
    }

    public function InsertConventionInvoice($invoice){
        $request = [
            'invoice_id'=>$invoice->invoiceId,
            'transaction_convention_id'=>$invoice->conventionId,   
            'invoice_number'=>$invoice->invoiceNumber,                     
            'template'=>$invoice->template,
            'is_active'=>$invoice->isActive,
            'created_by'=>$invoice->createdBy,
            'created_at'=>$invoice->createdDate
        ];

        return $this->ConventionInvoice->insertGetId($request);
    }

    public function InsertAirportInvoice($invoice){
        $request = [
            'invoice_id'=>$invoice->invoiceId,
            'transaction_airport_id'=>$invoice->airportId,   
            'invoice_number'=>$invoice->invoiceNumber,
            'template'=>$invoice->template,
            'is_active'=>$invoice->isActive,
            'created_by'=>$invoice->createdBy,
            'created_at'=>$invoice->createdDate
        ];

        return $this->AirportInvoice->insertGetId($request);
    }

    public function InsertTourProgramInvoice($invoice){
        $request = [
            'invoice_id'=>$invoice->invoiceId,
            'transaction_tour_program_id'=>$invoice->tourProgramId,
            'invoice_number'=>$invoice->invoiceNumber,
            'template'=>$invoice->template,
            'is_active'=>$invoice->isActive,
            'created_by'=>$invoice->createdBy,
            'created_at'=>$invoice->createdDate
        ];

        return $this->TourInvoice->insertGetId($request);
    }

    public function InsertInvoicePerPax($invoice){
        foreach($invoice as $val){
            $request = [
                'invoice_id'=>$val->invoiceId,
                'passenger_id'=>$val->passengerId,
                'booking_number'=>$val->bookingNumber,
                'invoice_number'=>$val->invoiceNumber,
                'issued_by'=>$val->issuedBy,
                'is_active'=>$val->isActive,
                'created_by'=>$val->createdBy,
                'created_at'=>$val->createdDate->date
            ];
            $result = $this->PassengerInvoice->insertGetId($request);
        }
        return $result;
    }

    //*------------ Get Tour Invoice ----------------*//
    public function GetTourInvoice($transactionId, $transactionTourId){
        $result = \DB::table('transaction_tour_program_details as ttp')
                    ->select('ttp.transaction_id as transactionId','itp.invoice_number as billNumber','tp.code','tp.title','ttp.tour_traveling_date as travelDate','ttt.id as travelTimeId','ttt.traveling_time as travelTime','ttt.pickup_time as pickupTime','tt.type as tourType','ttp.price','pt.payment_date as issueDate')
                    ->join('tour_programs as tp','tp.id','=','ttp.tour_program_id')
                    ->join('tour_traveling_times as ttt','ttt.id','=','ttp.tour_traveling_time_id')
                    ->join('invoice_tour_programs as itp','itp.transaction_tour_program_id','=','ttp.id')
                    ->join('payment_transactions as pt','pt.transaction_id','=','ttp.transaction_id')
                    ->join('configuration_tour_programs as ctp','ctp.id','=','ttp.configuration_tour_program_id')
                    ->join('tour_type_prices as tt','tt.id','=','ctp.tour_type_price_id')
                    ->where('ttp.transaction_id', $transactionId)
                    ->where('pt.payment_transaction_status_id','=','2')
                    ->where('ttp.id',$transactionTourId)
                    ->first();
        return $result;
    }

    public function GetPassengerByTourProgram($transactionId, $data){
        $result = \DB::table('transaction_tour_program_details as ttp')
                    ->select('p.firstname','p.lastname','p.email','p.nationality_other as nationality','ttp.hotel_name as hotel','ttp.price','ttp.discount','ttp.extra_charge as extraCharge')
                    ->join('passengers as p','p.id','=','ttp.passenger_id')
                    ->where('ttp.transaction_id', $transactionId)
                    ->where('ttp.tour_traveling_time_id', $data->travelTimeId)
                    ->where('ttp.tour_traveling_date', $data->travelDate)
                    ->get();
        return $result;
    }

    public function GetInvoiceId($transactionId){
        $result = \DB::table('invoices as i')
                    ->select('i.id')
                    ->where('i.transaction_id',$transactionId)
                    ->get();
        return $result;
    }

    //*-------------- Get Invoice Per Person ----------------*///
    public function GetInvoiceNumber($transactionId, $passengerId){
        $result = \DB::table('invoice_passengers as ip')
                    ->select('ip.booking_number', 'ip.invoice_number','pt.payment_date','t.created_at','ip.issued_by')
                    ->join('invoices as i','i.id','=','ip.invoice_id')
                    ->join('payment_transactions as pt','pt.transaction_id','=','i.transaction_id')
                    ->join('transactions as t','pt.transaction_id','=','t.id')
                    ->where('i.transaction_id',$transactionId)
                    ->where('t.id',$transactionId)
                    ->where('ip.passenger_id',$passengerId)
                    ->where('pt.payment_transaction_status_id',2)
                    ->where('ip.is_active',1)
                    ->groupBy('ip.passenger_id')
                    ->get();
        return $result;
    }
    // check party
    public function GetTransactionParty($transactionId){
        $result = \DB::table('invoice_passengers as ip')
                    ->select('ip.booking_number', 'ip.invoice_number')
                    ->join('invoices as i','i.id','=','ip.invoice_id')
                    ->join('payment_transactions as pt','pt.transaction_id','=','i.transaction_id')
                    ->where('i.transaction_id',$transactionId)
                    ->where('pt.payment_transaction_status_id',2)
                    ->where('ip.is_active',1)
                    ->groupBy('ip.passenger_id')
                    ->get();
        return $result;
    }


    public function GetInvoiceConvention($transactionId, $passengerId){
        $result = \DB::table('transaction_transfer_conventions as ttc')
                    ->select('ttc.id','ttc.price')
                    ->join('payment_transactions as pt','pt.transaction_id','=','ttc.transaction_id')
                    ->where('pt.payment_transaction_status_id',2)
                    ->where('ttc.transaction_id',$transactionId)
                    ->where('ttc.passenger_id',$passengerId)
                    ->where('ttc.is_active',1)
                    ->get();
        if($result){
            return $result[0];
        }
        return null;
    }

    // get convention date
    public function GetConventionDate($conventionId){
        $result = \DB::table('transaction_transfer_convention_dates as ttcd')
                    ->select('ttcd.date')
                    ->where('ttcd.transaction_transfer_convention_id',$conventionId)
                    ->orderBy('ttcd.date')
                    ->get();
        return $result;
    }

    public function GetInvoiceAirport($transactionId, $passengerId){
        $result = \DB::table('transaction_transfer_airports as tta')
                    ->select('tta.price','ori.origin','tta.flight_number','tta.flight_date')
                    ->join('payment_transactions as pt','pt.transaction_id','=','tta.transaction_id')
                    ->join('airport_origins as ori','ori.id','=','tta.flight_origin_id')
                    ->where('pt.payment_transaction_status_id',2)
                    ->where('tta.transaction_id',$transactionId)
                    ->where('tta.passenger_id',$passengerId)
                    ->where('tta.is_active',1)
                    ->orderBy('ori.id')
                    ->get();
        if($result){
            return $result;
        }
        return null;
    }

    public function GetInvoiceTour($transactionId, $passengerId){
        $result = \DB::table('transaction_tour_program_details as ttp')
                    ->select('ttp.tour_program_code','ttp.tour_program_title','tc.category','ttt.traveling_time','ttp.tour_traveling_date','ttt.pickup_time','ttp.price','ttp.discount')
                    ->join('tour_categories as tc','tc.id','=','ttp.tour_category_id')
                    ->join('tour_traveling_times as ttt','ttt.id','=','ttp.tour_traveling_time_id')
                    ->join('payment_transactions as pt','pt.transaction_id','=','ttp.transaction_id')
                    ->where('pt.payment_transaction_status_id',2)
                    ->where('ttp.transaction_id',$transactionId)
                    ->where('ttp.passenger_id',$passengerId)
                    ->get();
        if($result){
            return $result;
        }
        return null;
    }
}
?>