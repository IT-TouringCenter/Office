<?php
namespace App\Repositories\EasyBook\Transaction;

use App\transaction_transfer_convention as TranConv;
use App\transaction_transfer_convention_date as TranConvDate;

class TransactionConventionRepository{
    public function __construct(TranConv $TranConv, TranConvDate $TranConvDate){
        $this->model = $TranConv;
        $this->TranConvDate = $TranConvDate;
    }

    //----------------- Invoice Convention Transfer --------------------//
    public function GetInvoieByTransactionId($transactionId){
        return \DB::table("invoice_conventions as invc")
                ->select(\DB::raw("LPAD(inv.transaction_id,4,'0') as 'transaction_id','CMECC TRANSFER' as 'transfer',invc.invoice_number as 'billlNumber',invc.created_at as 'issueDate',count(invc.id) as unit, ttc.price, count(invc.id) * ttc.price as 'amount'"))       
                ->join('invoices as inv','inv.id','=','invc.invoice_id')
                ->join('transaction_transfer_conventions as ttc','ttc.id','=','invc.transaction_convention_id')
                ->join("payment_transactions as pt", "pt.transaction_id","=","inv.transaction_id")
                ->where('inv.transaction_id',$transactionId)
                ->where('pt.payment_transaction_status_id','=','2')
                ->get();
    }

    public function GetPassengerByTransactionId($transactionId){
        return \DB::table("transaction_transfer_conventions as ttc")
                ->select(\DB::raw("case when p.parent_id=0 then 'true' else 'false' end as 'isPrimary',p.firstname,p.lastname,p.email,n.nationality,tt.hotel_other as 'hotel'"))
                ->join('passengers as p','p.id','=','ttc.passenger_id')
                ->join('transaction_transfers as tt','tt.passenger_id','=','p.id')
                ->join('nationalities as n','n.id','=','p.nationality_id')
                ->join('payment_transactions as pt', 'pt.transaction_id','=','ttc.transaction_id')
                ->where('ttc.transaction_id',$transactionId)
                ->where('ttc.is_active',1)
                ->where('pt.payment_transaction_status_id','=','2')
                ->get();
    }

    // Get data Ticket Convention
    public function GetTransactionConventionByPassengerId($transactionId, $passengerId){
        return \DB::table("transaction_transfers as tt")
                ->select(\DB::raw("ttc.id, p.firstname, p.lastname, tt.hotel_other as hotel, ttc.ticket_number as ticketNumber"))
                ->join('transaction_transfer_conventions as ttc', 'ttc.transaction_id','=','tt.transaction_id')
                ->join('passengers as p', 'p.id','=','ttc.passenger_id')
                ->join('payment_transactions as pt', 'pt.transaction_id','=','ttc.transaction_id')
                ->where('ttc.transaction_id',$transactionId)
                ->where('ttc.passenger_id',$passengerId)
                ->where('pt.payment_transaction_status_id','=','2')
                ->where('ttc.is_active',1)
                ->get();
    }

    // Get Convention Date
    public function GetTransactionConventionDate($transactionId){
        return \DB::table("transaction_transfer_convention_dates as ttcd")
                ->select(\DB::raw("ttcd.date"))
                ->where('ttcd.transaction_transfer_convention_id',$transactionId)
                ->orderBy('ttcd.date')
                ->get();
    }
}
?>