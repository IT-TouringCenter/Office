<?php
namespace App\Facades\Tours;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Repositories\Tours\TourRepository as TourRepo;

use App\tour as Tour;

class TourClass{

	public function __construct(TourRepo $TourRepo){
		$this->TourRepo = $TourRepo;
	}

    // Get transaction tour
    public function GetTour(){
        $result = $this->TourRepo->GetTour();
        return $result;
    }

}