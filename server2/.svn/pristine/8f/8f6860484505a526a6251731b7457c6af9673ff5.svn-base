<?php
//TransactionTourFacade
namespace App\Facades\EasyBook\Transaction;

use Carbon\Carbon;
use App\transaction_tour_program_detail as Daytrip;
use App\Repositories\EasyBook\Transaction\TransactionTourProgramRepository as TSTourRepo;

class TransactionTourProgramDetail{
    public function __construct(TSTourRepo $TSTourRepo){
        $this->TSTourRepo = $TSTourRepo;
    }

    public function Save($data){
        $this->MapDataToModel($data);
        return $this->TSTourRepo->Save($this->program);
    }

    public function MapDataToModel($data){
        $this->program = new Daytrip();
        $this->program->transactionId=array_get($data,'transactionId');
        $this->program->tourCategoryId = array_get($data,'tourCategoryId');
        $this->program->tourTravelingTimeId = array_get($data,'tourTravelingTimeId');
        $this->program->configTourId=array_get($data,'configTourId');
        $this->program->tourProgramId=array_get($data,'tourProgramId');
        $this->program->code=array_get($data,'code');
        $this->program->title=array_get($data,'title');        
        $this->program->extraCharge=array_get($data,'extraCharge');
        $this->program->price=array_get($data,'price');
        $this->program->discount=array_get($data,'discount');        
        $this->program->travalDate=array_get($data,'travelDate');

        //$this->program->amount = floatval(array_get($data,'price')) - floatval(array_get($data,'discount'));

        $this->program->parentId=0;
        $this->program->passengerId=array_get($data,'passengerId');
        $this->program->hotelId=array_get($data,'hotelId');
        $this->program->hotelName=array_get($data,'hotelOther');
        $this->program->roomNumber=array_get($data,'hotelRoom');
        $this->program->activityId =array_get($data,'activityId');

        $this->program->isActive = 1;
        $this->program->createdBy="System";
        $this->program->createdAt = Carbon::now('Asia/Bangkok');
    }
}
?>