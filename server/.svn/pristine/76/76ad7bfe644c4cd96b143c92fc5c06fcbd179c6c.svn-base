<?php 
namespace App\Repositories\EasyBook\Report;

use App\Repositories\Src\Contracts\IRepository;
use App\Repositories\Src\Eloquent\Repository;

use App\transaction as transaction;

class ReportRepository{
    public function __construct(transaction $transaction){
        $this->transaction = $transaction;
    }

    public function GetInvoiceSummary(){
        return \DB::table("transactions as t")
                ->select("t.id","invp.booking_number","invp.invoice_number","p.firstname","p.lastname","p.email","n.nationality","tt.hotel_other")
                ->join("payment_transactions as pt",'pt.transaction_id','=','t.id')
                ->join('transaction_transfers as tt','tt.transaction_id','=','t.id')
                ->join("invoices as inv",'inv.transaction_id','=','t.id')
                ->join("invoice_passengers as invp",'invp.invoice_id','=','inv.id')
                ->join("passengers as p","p.id","=","invp.passenger_id")
                ->join('nationalities as n','n.id','=','p.nationality_id')
                ->where("p.firstname",'not like','%test%')
                ->where("p.lastname",'not like','%test%')
                ->where('pt.payment_transaction_status_id','=','2')
                ->orderBy("invp.invoice_number")
                ->groupBy("p.id")
                ->get();
    }

    public function GetReportCMECC(){
    	return \DB::table("transactions as t")
    			->select('tt.hotel_other','invp.booking_number','invp.invoice_number','p.firstname','p.lastname','p.email','p.nationality_other','ttc.ticket_number','ttc.price','issued_by')
    			->join('transaction_transfer_conventions as ttc','ttc.transaction_id','=','t.id')
    			->join('payment_transactions as pt','pt.transaction_id','=','t.id')
    			->join('invoices as inv','inv.transaction_id','=','t.id')
    			->join('transaction_transfers as tt','tt.transaction_id','=','t.id')
    			->join('passengers as p','p.id','=','ttc.passenger_id')
    			->join('invoice_passengers as invp','invp.passenger_id','=','p.id')
    			->where('p.firstname','not like','%test%')
    			->where('p.lastname','not like','%test%')
    			->where('pt.payment_transaction_status_id','=','2')
    			->orderBy('tt.hotel_id')
    			->orderBy('invp.id')
    			->groupBy('p.id')
    			->get();
    }

    public function GetReportAirport(){
    	return \DB::table("transactions as t")
    			->select('ao.origin','tta.flight_number','tta.flight_date','invp.booking_number','invp.invoice_number','p.firstname','p.lastname','p.email','p.nationality_other','tt.hotel_other','tta.ticket_number','tta.price')
    			->join('transaction_transfer_airports as tta','tta.transaction_id','=','t.id')
    			->join('payment_transactions as pt','pt.transaction_id','=','t.id')
    			->join('transaction_transfers as tt','tt.transaction_id','=','t.id')
    			->join('invoices as inv','inv.transaction_id','=','t.id')
    			->join('invoice_passengers as invp','invp.invoice_id','=','inv.id')
    			->join('airport_origins as ao','ao.id','=','tta.flight_origin_id')
    			->join('passengers as p','p.id','=','tta.passenger_id')
				->where('p.firstname','not like','%test%')
    			->where('p.lastname','not like','%test%')
    			->where('pt.payment_transaction_status_id','=','2')
    			->orderBy('tta.flight_origin_id')
    			->orderBy('tta.flight_date')
    			->groupBy('tta.id')
    			->get();
    }

    public function GetReportTour(){
    	return \DB::table("transactions as t")
    			->select('ttp.tour_traveling_date','invp.booking_number','invp.invoice_number','ttp.tour_program_code','ttp.tour_program_title','ttt.traveling_time','p.firstname','p.lastname','p.email','p.nationality_other','ttp.hotel_name','ttp.price','ttp.discount')
    			->join('transaction_tour_program_details as ttp','ttp.transaction_id','=','t.id')
    			->join('payment_transactions as pt','pt.transaction_id','=','t.id')
    			->join('transaction_transfers as tt','tt.transaction_id','=','t.id')
    			->join('invoices as inv','inv.transaction_id','=','t.id')
    			->join('invoice_passengers as invp','invp.invoice_id','=','inv.id')
    			->join('passengers as p','p.id','=','ttp.passenger_id')
    			->join('tour_traveling_times as ttt','ttt.id','=','ttp.tour_traveling_time_id')
				->where('p.firstname','not like','%test%')
    			->where('p.lastname','not like','%test%')
    			->where('pt.payment_transaction_status_id','=','2')
    			->orderBy('ttp.tour_traveling_date')
    			->orderBy('ttp.tour_program_id')
    			->orderBy('ttp.tour_traveling_time_id')
    			->orderBy('invp.invoice_number')
    			->groupBy('ttp.id')
    			->get();
    }
}