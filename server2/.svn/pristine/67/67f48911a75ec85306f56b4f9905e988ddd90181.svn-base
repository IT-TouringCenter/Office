<?php
namespace App\Repositories\EasyBook\Transaction;

use App\transaction as TransactionModel;
use Carbon\Carbon;

class TransactionRepository{

    public function __construct(TransactionModel $TransactionModel){
        $this->TransactionModel = $TransactionModel;
    }

    public function Save($activity_id, $account_id, $amount){
    	$transaction = [
            'account_id'=>$account_id,
            'activity_id'=>$activity_id,
    		'amount'=>$amount,
    		'created_by'=>'System',
    		'created_at'=>Carbon::now('Asia/Bangkok')
    	];
    	return $this->TransactionModel->insertGetId($transaction); // Insert transaction table & Get Last Id
    }
	
	public function GetDataByTransactionId($id){		
		return $this->TransactionModel	
			->where('is_active','=',1)
			->where('id','=',$id)			
			->first();		
	}

    //*-------------- Get Transaction -----------------*//
    public function GetPassengerTransactionTransfer($transactionId){
        $result = \DB::table('transaction_transfers as ttt')
                    ->select('ttt.passenger_id')
                    ->join('payment_transactions as pt', 'pt.transaction_id','=','ttt.transaction_id')
                    ->where('ttt.transaction_id','=',$transactionId)
                    ->where('pt.payment_transaction_status_id','=','2')
                    ->get();
        return $result;
    }

    public function GetPassengerTransactionConvention($transactionId){
        $result = \DB::table('transaction_transfer_conventions as ttc')
                    ->select('ttc.passenger_id','p.firstname','p.lastname')
                    ->join('passengers as p', 'p.id','=','ttc.passenger_id')
                    ->join('payment_transactions as pt', 'pt.transaction_id','=','ttc.transaction_id')
                    ->where('ttc.transaction_id','=',$transactionId)
                    ->where('pt.payment_transaction_status_id','=','2')
                    ->groupBy('p.id')
                    ->get();
        return $result;
    }

    public function GetPassengerTransactionAirport($transactionId){
        $result = \DB::table('transaction_transfer_airports as tta')
                    ->select('tta.passenger_id','p.firstname','p.lastname')
                    ->join('passengers as p', 'p.id','=','tta.passenger_id')
                    ->join('payment_transactions as pt', 'pt.transaction_id','=','tta.transaction_id')
                    ->where('tta.transaction_id','=',$transactionId)
                    ->where('pt.payment_transaction_status_id','=','2')
                    ->groupBy('p.id')
                    ->get();
        return $result;
    }

    public function GetPassengerTourProgram($transactionId){
        $result = \DB::table('transaction_tour_program_details as ttd')
                    ->select('ttd.passenger_id','p.firstname','p.lastname')
                    ->join('passengers as p', 'p.id','=','ttd.passenger_id')
                    ->join('payment_transactions as pt', 'pt.transaction_id','=','ttd.transaction_id')
                    ->where('ttd.transaction_id','=',$transactionId)
                    ->where('pt.payment_transaction_status_id','=','2')
                    ->get();
        return $result;
    }

    //*------------ Get Transaction Transfer ----------*//
    public function CheckTransctionIdPay($transactionId){
        $result = \DB::table('transaction_transfers as tt')
                    ->select('tt.id')
                    ->join('payment_transactions as pt','pt.transaction_id','=','tt.transaction_id')
                    ->where('tt.transaction_id',$transactionId)
                    ->where('pt.payment_transaction_status_id',2)
                    ->get();
        if($result==null){
            return null;
        }
        return \HelperFacade::Encode(Intval($transactionId));
    }

    public function GetTransactionTransfer($transactionId){
        $result = \DB::table('transaction_transfers as tt')
                    ->select('tt.id')
                    ->where('tt.transaction_id',$transactionId)
                    ->get();
        if($result==null){
            return null;
        }
        $this->transport = new TransactionModel;
        $this->GetTransactionTransferConvention($transactionId);
        $this->GetTransactionTransferAirport($transactionId);
        return $this->transport;
    }

    public function GetTransactionTransferConvention($transactionId){
        $result = \DB::table('transaction_transfer_conventions as ttc')
                    ->select('ttc.id')
                    ->join('payment_transactions as pt', 'pt.transaction_id','=','ttc.transaction_id')
                    ->where('ttc.transaction_id',$transactionId)
                    ->where('pt.payment_transaction_status_id',2)
                    ->get();
        $this->transport->isConvention = count($result)<1?false:true;
    }

    public function GetTransactionTransferAirport($transactionId){
        $result = \DB::table('transaction_transfer_airports as tta')
                    ->select('tta.flight_origin_id as flightOriginId')
                    ->join('payment_transactions as pt', 'pt.transaction_id','=','tta.transaction_id')
                    ->where('tta.transaction_id',$transactionId)
                    ->where('pt.payment_transaction_status_id',2)
                    ->groupBy('tta.flight_origin_id')
                    ->get();
        $this->transport->isAirport = count($result)<1?false:true;
        // foreach($result as $value){
        //     if($value==1){
        //         $value->flightOriginId = "One Way"
        //     }
        // }
        // $this->transport->isAirport = $result;
    }

    //*-------------- Get Transaction Tour -----------*//
    // for check unique tour
    public function GetTransctionCheckUnique($transactionId){
        $result = \DB::table('transaction_tour_program_details as ttp')
                    ->select('ttp.transaction_id','ttp.tour_program_id','ttp.tour_traveling_time_id','ttp.configuration_tour_program_id','ttp.tour_traveling_date')
                    ->join('payment_transactions as pt','pt.transaction_id','=','ttp.transaction_id')
                    ->where('ttp.transaction_id','=',$transactionId)
                    ->where('pt.payment_transaction_status_id','=','2')
                    ->get();
        return $result;
    }

    public function GetTransactionTour($transactionId, $data){
        $result = \DB::table('transaction_tour_program_details as ttp')
                    ->select('ttp.id as transactionTourId','tp.code as tourCode','tp.title as tourTitle','ttt.traveling_time as tourTime','ttp.tour_traveling_date as tourDate','tc.category as tourCategory')
                    ->join('tour_programs as tp','tp.id','=','ttp.tour_program_id')
                    ->join('tour_traveling_times as ttt','ttt.id','=','ttp.tour_traveling_time_id')
                    ->join('tour_categories as tc','tc.id','=','ttp.tour_category_id')
                    ->join('payment_transactions as pt','pt.transaction_id','=','ttp.transaction_id')
                    ->where('ttp.transaction_id','=',$transactionId)
                    ->where('ttp.tour_program_id','=',$data->tour_program_id)
                    ->where('ttp.tour_traveling_time_id','=',$data->tour_traveling_time_id)
                    ->where('ttp.tour_traveling_date','=',$data->tour_traveling_date)
                    // ->where('ttp.tour_category_id','=',$data->tour_category_id)
                    ->where('ttp.configuration_tour_program_id','=',$data->configuration_tour_program_id)
                    ->where('pt.payment_transaction_status_id','=','2')
                    ->first();
        return $result;
    }

    public function GetTransactionTourId($data){
        $result = \DB::table('transaction_tour_program_details as ttp')
                    ->select('ttp.id as transactionTourId','ttp.passenger_id')
                    ->where('ttp.transaction_id',$data->transaction_id)
                    ->where('ttp.tour_program_id',$data->tour_program_id)
                    ->where('ttp.tour_traveling_time_id',$data->tour_traveling_time_id)
                    ->where('ttp.configuration_tour_program_id',$data->configuration_tour_program_id)
                    ->where('ttp.tour_traveling_date',$data->tour_traveling_date)
                    ->get();
        return $result;
    }

    ///*------------ Payment Success -----------*///
    public function GetTransactionByPaid($transactionId){
        $result = \DB::table('transactions as t')
                    ->select('t.id')
                    ->join('payment_transactions as pt','pt.transaction_id','=','t.id')
                    ->where('t.id','=',$transactionId)
                    ->where('pt.payment_transaction_status_id','=','2')
                    ->get();
        if($result){
            $this->transaction = new TransactionModel;
            $this->GetTransferConvention($transactionId);
            $this->GetTransferAirport($transactionId);
            $this->GetTourProgram($transactionId);
            return $this->transaction;
        }
        return null;
    }

    public function GetTransferConvention($transactionId){
        $result = \DB::table('transaction_transfer_conventions as ttc')
                    ->select('ttc.id')
                    ->where('ttc.transaction_id','=',$transactionId)
                    ->get();
        $this->transaction->conventionTransfer = $result;
    }

    public function GetTransferAirport($transactionId){
        $result = \DB::table('transaction_transfer_airports as tta')
                    ->select('tta.id')
                    ->where('tta.transaction_id','=',$transactionId)
                    ->get();
        $this->transaction->airportTransfer = $result;
    }

    public function GetTourProgram($transactionId){
        $result = \DB::table('transaction_tour_program_details as ttp')
                    ->select('ttp.id')
                    ->where('ttp.transaction_id','=',$transactionId)
                    ->get();
        $this->transaction->tourProgram = $result;
    }
}