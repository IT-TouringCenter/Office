<?php 
namespace App\Repositories\EasyBook\Reservation\Transportation;

use App\Repositories\Src\Contracts\IRepository;
use App\Repositories\Src\Eloquent\Repository;

class TransportationRepository extends Repository{
    function model(){return 'App\transportation';}

    public function GetTransportationById($transport_id){
    	return $this->model
    				->where('id',$transport_id)
    				->where('is_active',1)
    				->get();
    }
}