<?php 
namespace App\Repositories\EasyBook\Reservation\Tour;

use App\Repositories\Src\Contracts\IRepository;
use App\Repositories\Src\Eloquent\Repository;

class TourTravelingTimeRepository extends Repository{
    function model(){return 'App\tour_traveling_time';}

    public function GetTourTravelingTimeByTourProgramId($tour_program_id){
    	return $this->model
    				->where('tour_program_id', $tour_program_id)
    				->where('is_active',1)
    				->get();
    }
}