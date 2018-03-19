<?php 
namespace App\Repositories\EasyBook\Passenger;

use App\passenger as passenger;
use Carbon\Carbon;

class PassengerRepository{
    public function __construct(passenger $passenger){
        $this->PassengerModel = $passenger;
    }

    // Icas version 2.0
    public function SaveV2($data){
        $passenger_arr = [
            'country_id'=>array_get($data,'countryId')==null?0:array_get($data,'countryId'),
            'nationality_id'=>array_get($data,'nationalityId')==null?0:array_get($data,'nationalityId'),
            'firstname'=>array_get($data,'firstname'),
            'lastname'=>array_get($data,'lastname'),
            'weight'=>array_get($data,'weight'),
            'height'=>array_get($data,'height'),
            'age'=>array_get($data,'age'),
            'email'=>array_get($data,'email'),
            'phone'=>array_get($data,'phoneNumber'),
            'passport_number'=>array_get($data,'passportNumber'),
            'nationality_other'=>array_get($data,'nationalityOther'),
            'is_primary'=>array_get($data,'isPrimary')=="true"?1:0,
            'is_virgin'=>array_get($data,'isVirgin')=="true"?1:0,
            'is_free_charge'=>array_get($data,'isFreeCharge')==false?0:1,
            'created_by'=>'System',
            'created_at'=>Carbon::now('Asia/Bangkok'),
            'parent_id'=>array_get($data,'parentId')
        ];
        return $this->PassengerModel->insertGetId($passenger_arr);
        // $data_return = [
        //     "id"=>$result,
        //     "hotelId"=>array_get($data,'hotelId'),
        //     "hotelOther"=>array_get($data,'hotelOther'),
        //     "hotelRoom"=>array_get($data,'hotelRoom'),
        //     "isPrimary"=>array_get($data,'isPrimary')
        // ];
        // return $data_return;
    }

    // version 1.0
    public function Save($data){        
        $person =[
            'firstname'=>$data->firstname,
            'lastname'=>$data->lastname,
            'email'=>$data->email,
            'country_id'=>$data->country_id,
            'nationality'=>$data->nationality,
            'is_primary'=>$data->is_primary=="true"?1:0,
            'created_by'=>'System',
            'created_at'=>Carbon::now('Asia/Bangkok')
        ];

        $id = $this->PassengerModel->insertGetId($person);        
        return ["id"=>$id,"isPrimary"=>$data->is_primary];
    }

    public function Saves($datas){

        \DB::table("passengers")->insert($datas);
        // return passenger::insert($arr_data);
    }

    // Get by ID
    public function GetPassengerById($passengerId){
        return $this->PassengerModel
                    ->where('id','=',$passengerId)
                    ->get();
    }

    //*-------------- Get passenger information -------------*//
    public function GetPassengerInformation($transactionId, $passengerId){
        $result = \DB::table('passengers as p')
                    ->select('p.firstname','p.lastname','p.email','p.is_primary','n.nationality')
                    ->join('nationalities as n','n.id','=','p.nationality_id')
                    ->where('p.id',$passengerId)
                    ->first();

        $hotelByTransfer = \DB::table('transaction_transfers as tt')
                            ->select('tt.hotel_other')
                            ->join('payment_transactions as pt','pt.transaction_id','=','tt.transaction_id')
                            ->where('tt.transaction_id',$transactionId)
                            ->where('tt.passenger_id',$passengerId)
                            ->where('pt.payment_transaction_status_id',2)
                            ->first();

        if($hotelByTransfer){
            $result->hotel = $hotelByTransfer->hotel_other;
        }else{
            $hotelByTour = \DB::table('transaction_tour_program_details as ppt')
                            ->select('ppt.hotel_name')
                            ->join('payment_transactions as pt','pt.transaction_id','=','tt.transaction_id')
                            ->where('ppt.transaction_id',$transactionId)
                            ->where('ppt.passenger_id',$passengerId)
                            ->where('pt.payment_transaction_status_id',2)
                            ->first();
            if($hotelByTour){
                $result->hotel = $hotelByTour->hotel_name;
            }
            return null;
        }

        if($result){
            if($result->is_primary==1){
                $result->is_primary=true;
            }else{
                $result->is_primary=false;
            }

            return $result;
        }
        return null;
    }

    //*-------- Get passenger for send mail to primary contact ----------------*//
    public function GetPassengerByPrimary($transaction_id){
        $result_arr = [];
        $resultConv = \DB::table('passengers as p')
                        ->select('p.firstname','p.lastname','p.email')
                        ->join('transaction_transfer_conventions as ttc','ttc.passenger_id','=','p.id')
                        ->where('ttc.transaction_id',$transaction_id)
                        ->where('p.parent_id',0)
                        ->first();
        $resultAir = \DB::table('passengers as p')
                        ->select('p.firstname','p.lastname','p.email')
                        ->join('transaction_transfer_airports as tta','tta.passenger_id','=','p.id')
                        ->where('tta.transaction_id',$transaction_id)
                        ->where('p.parent_id',0)
                        ->first();
        $resultTour = \DB::table('passengers as p')
                        ->select('p.firstname','p.lastname','p.email')
                        ->join('transaction_tour_program_details as ttd','ttd.passenger_id','=','p.id')
                        ->where('ttd.transaction_id',$transaction_id)
                        ->where('p.parent_id',0)
                        ->first();

        if($resultConv){
            array_push($result_arr, $resultConv);
        }
        if($resultAir){
            array_push($result_arr, $resultAir);
        }
        if($resultTour){
            array_push($result_arr, $resultTour);
        }

        $result_arr = \HelperFacade::CheckUnique($result_arr);
        $countResult = count($result_arr);
        // return $result_arr[0];
        if($countResult>0){
            return $result_arr[0];
        }else{
            return null;
        }

    }
}
?>