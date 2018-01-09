<?php
namespace App\Repositories\EasyBook\Transaction;

use App\transaction_transfer_airport as TranAirport;

class TransactionAirportRepository{
    public function __construct(TranAirport $TranAirport){
        $this->AirportModel = $TranAirport;
    }

    //----------------- Invoice Airport Transfer --------------------//
    public function GetInvoiceByTransactionId($transactionId){
        return \DB::table("invoice_airports as iair")
                ->select(\DB::raw("LPAD(inv.transaction_id,4,'0') as 'transaction_id' ,iair.invoice_number as 'billNumber','AIRPORT TRANSFER' as 'transfer',iair.created_at as 'issueDate'"))
                ->join("invoices as inv","inv.id","=","iair.invoice_id")                
                ->join("payment_transactions as pt", "pt.transaction_id","=","inv.transaction_id")
                ->where("inv.transaction_id",$transactionId)
                ->where('pt.payment_transaction_status_id','=','2')
                ->groupBy("inv.transaction_id")
                ->get();
                    
    }    

    public function GetArrivalAmountByTransactionId($transactionId){
        return \DB::table('transaction_transfer_airports')
                ->select(\DB::raw("DISTINCT count(passenger_id) as unit,price as 'price' ,price as 'amount','oneway' as 'origin'"))
                ->where('transaction_id','=',$transactionId)
                ->groupBy('passenger_id')
                ->having('unit','=', 1)
                ->get();
    }

    public function GetDepartureAmountByTransactionId($transactionId){
        return \DB::table('transaction_transfer_airports')                        
                    ->select(\DB::raw("DISTINCT count(passenger_id) as unit, price * 2 as 'price', sum(price * 2) as 'amount', 'roundtrip' as 'origin'"))
                    ->where('transaction_id','=',$transactionId)
                    ->groupBy('passenger_id')
                    ->having('unit','=', 2)
                    ->get();
    }

    //------------------ invoice check unit -----------------//
    public function GetPassengerId($transactionId){
        $result = \DB::table('transaction_transfer_airports as tta')
                    ->select('tta.passenger_id as passengerId')
                    ->join('payment_transactions as pt', 'pt.transaction_id','=','tta.transaction_id')
                    ->where('tta.transaction_id',$transactionId)
                    ->where('pt.payment_transaction_status_id','=','2')
                    ->groupBy('passenger_id')
                    ->get();
        return $result;
    }

    public function GetPassengerBook($transactionId, $passengerId){
        // Set default value
        $services = new TranAirport;
        $services->unit = 0;
        $services->price = 0;
        $services->amount = 0;

        $result = \DB::table('transaction_transfer_airports as tta')
                    ->select('tta.passenger_id','tta.price')
                    ->join('payment_transactions as pt', 'pt.transaction_id','=','tta.transaction_id')
                    ->where('tta.transaction_id',$transactionId)
                    ->where('pt.payment_transaction_status_id','=','2')
                    ->where('tta.passenger_id',$passengerId)
                    ->get();
        foreach($result as $value){
            if(count($result)==1){
                $services->unit = 1;
                $services->price = $value->price;
                $services->amount = $value->price;
                $services->origin = "One Way";
            }else if(count($result)==2){
                $services->unit = 1;
                $services->price = $value->price * 2;
                $services->amount = $value->price * 2;
                $services->origin = "Round Trip";
            }
        }
        return $services;
    }

    public function GetAmountsByTransactionId($transactionId){
        return "GetAmountsByTransactionId";

        // $oneway = \DB::table('transaction_transfer_airports')
        //         ->select(\DB::raw("
        //             DISTINCT count(passenger_id) as 'unit',
        //             price * 1 as 'price', 
        //             price * count(passenger_id) as 'amount',
        //             'One Way' as 'origin'
        //         "))     
        //         ->groupBy('passenger_id')
        //         ->having('unit','=', 1);

        // $roundTrips = \DB::table('transaction_transfer_airports')                        
        //         ->select(\DB::raw("
        //             DISTINCT count(passenger_id) as 'unit', 
        //             price * 2 as 'price', 
        //             price * count(passenger_id) as 'amount', 
        //             'Round Trip' as 'origin'
        //         "))
        //         ->groupBy('passenger_id')
        //         ->having('unit','=', 2);
        // return $oneway
        //         ->union($roundTrips)
        //         ->where('transaction_id','=',$transactionId)
        //         ->get();
    }

    public function GetPassengersByTransactionId($transactionId){
        $flights= \DB::table('transaction_transfer_airports as tair')
                ->select(\DB::raw("tair.transaction_id as transactionId,tair.passenger_id as passengerId,p.firstname,p.lastname,n.nationality,tt.hotel_other as hotel,p.email"))
                ->join('passengers as p','p.id','=','tair.passenger_id')
                ->join('nationalities as n','n.id','=','p.nationality_id')
                ->join('transaction_transfers as tt','tt.transaction_id','=','tair.transaction_id')
                ->join('payment_transactions as pt','pt.transaction_id','=','tair.transaction_id')
                ->where('tair.transaction_id','=',$transactionId)
                ->where('pt.payment_transaction_status_id','=','2')
                ->groupBy('tair.passenger_id')
                ->get();
        return $this->filterFlightOriginer($flights);
    }

    public function filterFlightOriginer($flights){
        foreach ($flights as $value) {
            $value->transactionId = str_pad($value->transactionId,4,"0",STR_PAD_LEFT);

            $origins = \DB::table('transaction_transfer_airports')
            ->select(\DB::raw("flight_origin_id,flight_number,flight_date"))    
            ->where('transaction_id',$value->transactionId)
            ->where('passenger_id',$value->passengerId)
            ->orderBy('flight_origin_id','ASC')
            ->get();

            if(count($origins)==2){
                $value->arrival = $origins[0]->flight_number.' ('.date('d F Y h:i:s', strtotime($origins[0]->flight_date)).' Hrs.)';
                $value->departure = $origins[1]->flight_number.' ('.date('d F Y h:i:s', strtotime($origins[1]->flight_date)).' Hrs.)';
                $value->origin="Round Trip";
            } else {
                if($origins[0]->flight_origin_id == 1){
                    $value->arrival = $origins[0]->flight_number.' ('.date('d F Y h:i:s', strtotime($origins[0]->flight_date)).' Hrs.)';
                    $value->departure = '-';
                } else {
                    $value->arrival = '-';
                    $value->departure = $origins[0]->flight_number.' ('.date('d F Y h:i:s', strtotime($origins[0]->flight_date)).' Hrs.)';
                }
                $value->origin="One Way";
            }
        }
        return $flights;
    }

    // Get data Ticket Airport
    public function GetTransactionAirportByPassengerId($transactionId, $passengerId){
        return \DB::table("transaction_transfers as tt")
                ->select(\DB::raw("p.firstname, p.lastname, tt.hotel_other as hotel, tta.ticket_number as ticketNumber, tta.flight_origin_id, tta.flight_origin_id, tta.flight_number, tta.flight_date, tta.flight_origin_id"))
                ->join('transaction_transfer_airports as tta', 'tta.transaction_id','=','tt.transaction_id')
                ->join('passengers as p', 'p.id','=','tta.passenger_id')
                ->join('payment_transactions as pt', 'pt.transaction_id','=','tta.transaction_id')
                ->where('tta.transaction_id',$transactionId)
                ->where('tta.passenger_id',$passengerId)
                ->where('tta.is_active',1)
                ->where('pt.payment_transaction_status_id','=','2')
                ->groupBy('tta.id')
                ->orderBy('tta.flight_origin_id')
                ->get();
    }
}
?>