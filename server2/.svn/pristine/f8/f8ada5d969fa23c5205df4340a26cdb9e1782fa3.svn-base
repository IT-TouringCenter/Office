<?php 
namespace App\Repositories\EasyBook\Reservation\Tour;

use App\Repositories\Src\Contracts\IRepository;
use App\Repositories\Src\Eloquent\Repository;

class TourProgramRepository extends Repository{
    function model(){return 'App\tour_program';}

    public function GetTourProgramById($tour_program_id){
    	return $this->model
    				->where('id', $tour_program_id)
    				->where('is_active',1)
    				->get();
    }
}