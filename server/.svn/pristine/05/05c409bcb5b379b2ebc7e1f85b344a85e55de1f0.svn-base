<?php
namespace App\Repositories\EasyBook\Tour;

use App\tour_traveling_time as TourTime;

class TourTimeRepositoy{
    public function __construct(TourTime $TourTime){
        $this->TourTimeModel = $TourTime;
    }

    public function GetTimeTourByTimeId($timeId){
        return $this->TourTimeModel
                    ->where('is_active',1)
                    ->where('id',$timeId)
                    ->first(['id','tour_program_id','traveling_time','medical']);
    }
}
?>