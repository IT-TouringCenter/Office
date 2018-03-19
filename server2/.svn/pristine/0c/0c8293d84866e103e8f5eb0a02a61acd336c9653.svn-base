<?php 
namespace App\Repositories\EasyBook\Reservation\Tour;

use App\Repositories\Src\Contracts\IRepository;
use App\Repositories\Src\Eloquent\Repository;

class TourCategoryRepository extends Repository{
    function model(){return 'App\tour_category';}

    public function GetTourCategoryById($tour_category_id){
    	return $this->model
    				->where('id', $tour_category_id)
    				->where('is_active',1)
    				->get();
    }
}