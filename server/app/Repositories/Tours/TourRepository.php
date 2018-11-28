<?php
namespace App\Repositories\Tours;

use Carbon\Carbon;

class TourRepository{

	public function __construct(){
	}

	// Get tour
	public function GetTour(){
        $result = \DB::table('tours')
                        ->select('id','code','title')
					    ->where('is_active',1)
						->get();
		return $result;
	}

}