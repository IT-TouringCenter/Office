<?php 
namespace App\Repositories\EasyBook;

use App\Repositories\Src\Contracts\IRepository;
use App\Repositories\Src\Eloquent\Repository;

class ActivityRepository extends Repository{
    function model(){return "App\activity";}

    public function GetActivityById($activity_id){
    	return $this->model
    				->where('id',$activity_id)
    				->where('is_active',1)
    				->get();
    }
}