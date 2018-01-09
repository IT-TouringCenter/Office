<?php 
namespace App\Repositories\EasyBook\Reservation\Tour;

use App\Repositories\Src\Contracts\IRepository;
use App\Repositories\Src\Eloquent\Repository;

class PaxRepository extends Repository{
    function model(){return "App\pax";}

    public function GetPaxById($pax_id){
    	return $this->model
    				->where('id',$pax_id)
    				->where('is_active',1)
    				->get();
    }
}