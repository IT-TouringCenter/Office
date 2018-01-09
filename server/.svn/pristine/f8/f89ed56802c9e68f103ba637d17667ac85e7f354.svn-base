<?php
namespace App\Repositories\EasyBook\Transaction;

use App\transaction_tour_program_detail as TransTourDetail;
use Carbon\Carbon;

class TransactionTourProgramRepository{

    public function __construct(TransTourDetail $TransTourDetail){
        $this->TransTourDetailModel = $TransTourDetail;
    }

    public function Save($data){
        $trans = [
            "parent_id"=>$data->parentId,
            "transaction_id"=>$data->transactionId,
            "tour_program_id"=>$data->tourProgramId,
            "configuration_tour_program_id"=>$data->configTourId,
            "tour_category_id"=>$data->tourCategoryId,
            "passenger_id"=>$data->passengerId,
            "tour_traveling_time_id"=>$data->tourTravelingTimeId,
            "activity_id"=>$data->activityId,
            "hotel_id"=>$data->hotelId,
            "hotel_name"=>$data->hotelName,
            "room_number"=>$data->roomNumber,
            "tour_program_code"=>$data->code,
            "tour_program_title"=>$data->title,
            "tour_traveling_date"=>$data->travalDate,
            "price"=>$data->price,
            "discount"=>array_get($data,'discount'),
            "extra_charge"=>$data->extraCharge,
            "is_active"=>$data->isActive,
            "created_by"=>$data->createdBy,
            "created_at"=>$data->createdAt
        ];

        return $this->TransTourDetailModel->insertGetId($trans);
    }

    public function GetTourProgramGroupByTransactionId($transactionId){
         return $this->TransTourDetailModel
            ->where('transaction_id',$transactionId)
            ->where('is_active',true)
            ->groupby('transaction_id')
            ->first(['id','parent_Id','transaction_id','activity_id',
                    'tour_program_id','configuration_tour_program_id',                    
                    'tour_category_id','passenger_id',
                    'tour_program_code','tour_program_title',
                    'tour_traveling_date',
                    'price','discount','extra_charge',
                    'tour_traveling_time_id',
                    'hotel_id','hotel_name','room_number']);

    }

    public function GetTourProgramByTransactionId($transactionId){
        return $this->TransTourDetailModel
            ->where('transaction_id',$transactionId)
            ->where('is_active',true)          
            ->get(['transaction_id','activity_id',
                    'tour_program_id','configuration_tour_program_id',                    
                    'tour_category_id','passenger_id',
                    'tour_program_code','tour_program_title',
                    'tour_traveling_date',
                    'price','discount','extra_charge',
                    'tour_traveling_time_id',
                    'hotel_id','hotel_name','room_number']);
    }

    public function GetPassengersByTransactionId($transactionId){
        return $this->GetPrimaryContactPersonByTransactionId($transactionId);
    }

    public function GetGroupToursByTransactionId($transactionId){
        return \DB::table('transaction_tour_program_details as ttpd')
                    ->select(\DB::raw('transaction_id,tour_program_code as code,tt.medical,tp.title, count(ttpd.tour_program_id) as unit, sum(price-discount-extra_charge) as amount,activity_id'))
                    ->join('tour_programs as tp','tp.id','=','ttpd.tour_program_id')
                    ->join('tour_traveling_times as tt','tt.tour_program_id', '=','tp.id')
                    ->where('ttpd.transaction_id','=',$transactionId)
                    ->where('tp.is_active','=',1)
                    ->where('ttpd.is_active','=',1)
                    ->groupby('ttpd.tour_program_id')
                    ->get(['code','title','medical','unit','amount','activityId']);
    }

    public function GetContactByTransactionId($transactionId){
		return \DB::table('transaction_tour_program_details as ttpd')
                    ->select(\DB::raw('p.id,p.firstname,p.lastname,tour_program_id,tour_program_title as title,tour_program_code as code,p.parent_id as parentId,n.nationality,email,phone'))
                    ->join('passengers as p','p.id','=','ttpd.passenger_id')
                    ->join('nationalities as n','n.id','=','p.nationality_id')
                    ->where('ttpd.transaction_id','=',$transactionId)
                    ->groupby('p.id')
                    ->get();
	}

    public function GetHotelTourByTransactionId($transactionId){
        return \DB::table('transaction_tour_program_details as ttpd')
                ->select(\DB::raw('ttpd.hotel_id as hotelId,ttpd.hotel_name as hotelName'))
                ->join('passengers as p','p.id','=','ttpd.passenger_id')
                ->where('ttpd.transaction_id','=',$transactionId)
                ->groupby('ttpd.hotel_id')
                ->first(['hotelId','hotelName']);
    }
}