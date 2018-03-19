<?php

use App\tour_traveling_time as Model;
use App\Repositories\EasyBook\Tour\TourTimeRepositoy as Repo;

class TourTimeTest extends TestCase{
    private function GetTimeIdProvider(){
        return 3;
    }

    public function testGetTimeTourByTimeId(){        
        $repo = new Repo(new Model());

        $timeId = $this->GetTimeIdProvider();//Get id provider
        $time = $repo->GetTimeTourByTimeId($timeId);//Get data from db
        echo json_encode($time);
    }

    public function testGetTourTimeByTimeId(){
        $timeId = 3;

        $repo = new Repo(new Model());
        $time = $repo->GetTimeTourByTimeId($timeId);
        if($time ==null){
            return '';
        }

        // $expect = 'AM';
        $expect = 'PM';
        $actaul= $time->medical;
         
        $this->assertEquals($expect,$actaul);
    }
}
?>