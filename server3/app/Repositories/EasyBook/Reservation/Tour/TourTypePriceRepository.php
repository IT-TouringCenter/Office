<?php 
namespace App\Repositories\EasyBook\Reservation\Tour;

use App\Repositories\Src\Contracts\IRepository;
use App\Repositories\Src\Eloquent\Repository;

class TourTypePriceRepository extends Repository{
    function model(){return 'App\tour_type_price';}

    public function GetTourTypePriceById($tour_type_price_id){
    	return $this->model
    				->where('id', $tour_type_price_id)
    				->where('is_active',1)
    				->get();
    }
}