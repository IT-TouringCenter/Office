<?php 
namespace App\Repositories\EasyBook\Reservation\Discount;

use App\Repositories\Src\Contracts\IRepository;
use App\Repositories\Src\Eloquent\Repository;

class DiscountTypeRepository extends Repository{
    function model(){return "App\discount_type";}

    public function GetTourProgramDiscountType($discount_type_id){
    	return $this->model
    				->where('id', $discount_type_id)
    				->where('is_active',1)
    				->get();
    }
}