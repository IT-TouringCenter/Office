<?php
namespace App\Facades\EasyBook;

// use App\Repositories\EasyBook\BaseClass;
use App\Repositories\EasyBook\ActivityRepository as activity_repository;

class ActivityClass{
    public function __construct(activity_repository $activity_repository){
        $this->activity_repository = $activity_repository;
    }

    public function GetActivityEvent($activity_id){
    	$get_activity = $this->activity_repository->GetActivityById($activity_id);
    	return $get_activity;
    }

}