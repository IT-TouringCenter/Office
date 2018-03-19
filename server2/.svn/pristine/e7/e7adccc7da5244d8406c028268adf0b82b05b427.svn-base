<?php

use Carbon\Carbon;
use App\transaction_tour_program_detail as TourProgram;
use App\Repositories\EasyBook\Transaction\TransactionTourProgramRepository as Repos;

class TSTourProgramDetailTest extends TestCase{
   
   public function getTransactionId(){
       return 3;
   }
    public function additionalTourProgramProvider(){
        $transactionId = 1;
        $activityId= 1;
        $parentId=0;
        $passengerId=1;
        $hotelId=1;
        $hotelName='Akyra Manor';
        $room_number=99;

        $tours = [];

        $tourProgram = new TourProgram();
        $tourProgram->transactionId=$transactionId;
       // $tourProgram->tourCategoryId = 1;//1: Half Day, 2: Full Day        
        $tourProgram->tour_traveling_time_id = 3;
        $tourProgram->configTourId=22;
        $tourProgram->tourProgramId=4;        
        $tourProgram->code="TC-04";
        $tourProgram->title="Handicraft Village";
        $tourProgram->price=750;
        $tourProgram->extraCharge=0;
        $tourProgram->discount=37.50;
        $tourProgram->travalDate="2017-07-21";

        $tourProgram->parentId=$parentId;
      //  $tourProgram->passengerId=$passengerId;
        $tourProgram->hotelId=$hotelId;
        $tourProgram->hotelName=$hotelName;
        $tourProgram->roomNumber=$room_number;
        $tourProgram->activityId =$activityId;

        $tourProgram->isActive = 1;
        $tourProgram->createdBy="System";
        $tourProgram->createdAt = Carbon::now('Asia/Bangkok');

        return $tourProgram;
    }
    
    public function testInitialData(){
        $result= $this->additionalTourProgramProvider();
        $data= array_add($result,'transactionId',8);
		$data= array_add($data,'passengerId',9);
        //print_r($data->toArray());
        
        $this->assertTrue(true);
    }

    public function testRepositorySave(){
        // $result= $this->additionalTourProgramProvider();

        // $tourProgram = new TourProgram();
        // $repos = new Repos($tourProgram);
        // $rowEffect = $repos->save($result);
        // print_r($rowEffect);
        // $this->assertGreaterThan(0,$rowEffect);
    }

    public function getPassengerByTransactionId(){
        $transactionId = $this->getTransactionId();            
        $repos = new Repos(new TourProgram());
    }

    public function testGetHoteLByTransactionId(){
        $transactionId = $this->getTransactionId();
    }

    public function testGetGroupToursByTransactionId(){
        $transactionId = $this->getTransactionId();

        $repos = new Repos(new TourProgram());
        $result = $repos->GetGroupToursByTransactionId($transactionId);

        // echo json_encode($result);        

        $tours =[];
        foreach ($result as $value) {
            $tours[]=[
                'code'=>$value->code,
                'title'=>$value->title,
                'medical'=>$value->medical,
                'unit'=>$value->unit,
                'amount'=>$value->amount
            ];
        }

        //echo json_encode($tours);

        // $this->assertGreaterThanOrEqual(1,count($result));
    }

     public function testcase1SameTourSameDate(){
                
        // $tours = $this->case1SameTourSameDate();                
        // $uniqeTour = $this->getUniqueTour($tours);
        // // echo json_encode($uniqeTour);
        $this->assertTrue(true);
    }

    public function testcase2SameTourDiffDate(){
        // $tours = $this->case2SameTourDiffDate();                
        // $uniqeTour = $this->getUniqueTour($tours);
        // // echo json_encode($uniqeTour);
        $this->assertTrue(true);
    }

     public function testcase3SameTourDiffDate(){
        $tours = $this->case3DiffTourDiffDate();                
        //$uniqeTour = $this->getUniqueTour($tours);
        //echo json_encode(array_unique($tours));
    }

    public function testCase4Tours(){
        $tours = $this->getBook1();        
        
        //get unique passenger
        $pids = [];
        foreach ($tours as $key => $value) {
            $pids[]=array_get($value,'passengerId');
        }
        
        $data = $pids;//[23,23,24,24];
        $puid = $this->uniquePassengers($data);        
               
        //only map unique tour.
        $reservations = [];
        for($i=0;$i<count($tours);$i++){  
                $reservations[]=[                                                                                   
                        "tourCategoryId"=> array_get($tours[$i],'tourCategoryId'),
                        "tourTravelingTimeId"=> array_get($tours[$i],'tourTravelingTimeId'),
                        "configTourId"=> array_get($tours[$i],'configTourId'),
                        "tourProgramId"=> array_get($tours[$i],'tourProgramId'),
                        "code"=> array_get($tours[$i],'code'),
                        "title"=> array_get($tours[$i],'title'),
                        "price"=> array_get($tours[$i],'price'),
                        "extraCharge"=> array_get($tours[$i],'extraCharge'),
                        "discount"=> array_get($tours[$i],'discount'),
                        "travelDate"=> array_get($tours[$i],'travelDate'),
                        "transactionId"=> array_get($tours[$i],'transactionId'),                                
                        "activityId"=> array_get($tours[$i],'activityId'),
                        "hotelId"=> array_get($tours[$i],'hotelId'),
                        "hotelOther"=> array_get($tours[$i],'hotelOther'),
                        "hotelRoom"=> array_get($tours[$i],'hotelRoom')                            
                ];

        }//end foreach

        $this->RemapTourToPassenger($reservations,$puid);
    }

    private function RemapTourToPassenger($reservations,$puid){
        $newTour= [];
        // foreach ($reservations as $key => $value) {
        //     $tourProgram1 = new TourProgram();    
        //     $tourProgram1->tourCategoryId= array_get($value,'tourCategoryId');
        //     $tourProgram1->tourTravelingTimeId= array_get($value,'tourTravelingTimeId');
        //     $tourProgram1->configTourId= array_get($value,'configTourId');
        //     $tourProgram1->tourProgramId= array_get($value,'tourProgramId');
        //     $tourProgram1->code= array_get($value,'code');
        //     $tourProgram1->title= array_get($value,'title');
        //     $tourProgram1->price= array_get($value,'price');
        //     $tourProgram1->extraCharge= array_get($value,'extraCharge');
        //     $tourProgram1->discount= array_get($value,'discount');
        //     $tourProgram1->travelDate= array_get($value,'travelDate');
        //     $tourProgram1->transactionId= array_get($value,'transactionId');                              
        //     $tourProgram1->activityId= array_get($value,'activityId');
        //     $tourProgram1->hotelId= array_get($value,'hotelId');
        //     $tourProgram1->hotelOther= array_get($value,'hotelOther');
        //     $tourProgram1->hotelRoom= array_get($value,'hotelRoom');             
        //     $newTour[]= $tourProgram1;
        // }

        // echo json_encode(array_unique($newTour,SORT_REGULAR));
        $tours=array_unique($reservations,SORT_REGULAR);
        // echo json_encode($tour);
        

        $mapTours = [];
        foreach ($tours as $key => $datrip) {

            $programs = [];
            
            foreach ($puid as $id) {
                //$daytrip=array_add($datrip,'passengerId',$id);
                $tourProgram1 = new TourProgram();
                $tourProgram1->tourCategoryId= array_get($datrip,'tourCategoryId');
                $tourProgram1->tourTravelingTimeId= array_get($datrip,'tourTravelingTimeId');
                $tourProgram1->configTourId= array_get($datrip,'configTourId');
                $tourProgram1->tourProgramId= array_get($datrip,'tourProgramId');
                $tourProgram1->code= array_get($datrip,'code');
                $tourProgram1->title= array_get($datrip,'title');
                $tourProgram1->price= array_get($datrip,'price');
                $tourProgram1->extraCharge= array_get($datrip,'extraCharge');
                $tourProgram1->discount= array_get($datrip,'discount');
                $tourProgram1->travelDate= array_get($datrip,'travelDate');
                $tourProgram1->transactionId= array_get($datrip,'transactionId');                              
                $tourProgram1->activityId= array_get($datrip,'activityId');
                $tourProgram1->hotelId= array_get($datrip,'hotelId');
                $tourProgram1->hotelOther= array_get($datrip,'hotelOther');
                $tourProgram1->hotelRoom= array_get($datrip,'hotelRoom');  
                $tourProgram1->passengerId= $id;
                $programs[]=$tourProgram1;
            }

            $mapTours[]=$programs;
        }  

        echo json_encode($mapTours);
    }

    private function MapTourToPassenger($puid,$tours){
        $reservation = [];
        // foreach ($puid as $key => $id) {
            
        //     $tour = [];
        //     foreach ($tours as $key => $tour) {
        //         $daytrip= array_add($tour,'passengerId',$id);                
        //         $tour[]=$daytrip;
        //     }

        //     $reservation[] = $tour;
        // }
        foreach ($tours as $key => $tour) {
            
            $tour = [];
            foreach ($puid as $key => $id) {
                $daytrip= array_add($tour,'passengerId',$id);                
                $tour[]=$daytrip;
            }

            $reservation[] = $tour;
        }


    }

    private function getUniqueTour($tours){
        $uniqeTour = [];
        
        for ($i=0; $i < count($tours); $i++) {
            
            $next  = $i + 1;
            if($next > count($tours)-1){
                $next = 0;
                return $uniqeTour;
            }
            
            $curTourId = array_get($tours[$i],'tourProgramId');
            $nextTourId = array_get($tours[$next],'tourProgramId');

            $curDate = $this->convertStringToDate(array_get($tours[$i],'travelDate'));
            $nextDate = $this->convertStringToDate(array_get($tours[$next],'travelDate'));
            $dateDiff = $this->compareDate($curDate,$nextDate);

            if($curTourId == $nextTourId && ($dateDiff == 0)){
                $uniqeTour[] = $tours[$i];                         
            } else {
                $uniqeTour[] = $tours[$i];       
                $uniqeTour[] = $tours[$next];

                $next = $next + 1;
            }
        }//end for

        return $uniqeTour;
    }

    private function uniquePassengers($value){
        $arr = [];
        for ($i=0; $i < count($value) ; $i++) {
            
            $curValue = $value[$i];
            if($i==0){
                $arr[]=$curValue;
            }
            
            for($j=0;$j<count($value);$j++){
                if($curValue == $value[$j]){    
                    if(in_array($value[$j],$arr)==false){
                        $arr[]=$value[$j];
                    }
                } else {
                    if(in_array($value[$j],$arr)==false){
                        $arr[]=$value[$j];
                    }
                }

            }
        }

        return $arr;
    }

    private function convertStringToDate($strDate){
        return date_create($strDate);
    }

    private function compareDate($date1, $date2){
        $diff= date_diff($date1,$date2);
        return $diff->format("%a");
    }

    private function case1SameTourSameDate(){
        $tours = [];

        $tourProgram1 = new TourProgram();
        $tourProgram1->tourProgramId = 16;
        $tourProgram1->travelDate = "2017-07-21 00:00";
        $tourProgram1->tourTravelingTimeId = 3;
        array_push($tours,$tourProgram1);

        $tourProgram2 = new TourProgram();
        $tourProgram2->tourProgramId = 16;
        $tourProgram2->travelDate = "2017-07-21 00:00";
        $tourProgram2->tourTravelingTimeId = 3;
        array_push($tours,$tourProgram2);

        return $tours;
    }

    private function case2SameTourDiffDate(){
        $tours = [];

        $tourProgram1 = new TourProgram();
        $tourProgram1->tourProgramId = 16;
        $tourProgram1->travelDate = "2017-07-21";
        $tourProgram1->tourTravelingTimeId = 3;
        array_push($tours,$tourProgram1);

        $tourProgram2 = new TourProgram();
        $tourProgram2->tourProgramId = 16;
        $tourProgram2->travelDate = "2017-07-22";
        $tourProgram2->tourTravelingTimeId = 3;
        array_push($tours,$tourProgram2);

        return $tours;
    }

    private function case3DiffTourDiffDate(){
        $tours = [];

        $tourProgram1 = new TourProgram();
        $tourProgram1->tourProgramId = 16;
        $tourProgram1->travelDate = "2017-07-21";
        $tourProgram1->tourTravelingTimeId = 3;
        array_push($tours,$tourProgram1);

        $tourProgram2 = new TourProgram();
        $tourProgram2->tourProgramId = 16;
        $tourProgram2->travelDate = "2017-07-21";
        $tourProgram2->tourTravelingTimeId = 3;
        array_push($tours,$tourProgram2);

        $tourProgram3 = new TourProgram();
        $tourProgram3->tourProgramId = 16;
        $tourProgram3->travelDate = "2017-07-22";
        $tourProgram3->tourTravelingTimeId = 3;
        array_push($tours,$tourProgram3);

        $tourProgram4 = new TourProgram();
        $tourProgram4->tourProgramId = 16;
        $tourProgram4->travelDate = "2017-07-22";
        $tourProgram4->tourTravelingTimeId = 3;
        array_push($tours,$tourProgram4);

        $tourProgram5 = new TourProgram();
        $tourProgram5->tourProgramId = 15;
        $tourProgram5->travelDate = "2017-07-21";
        $tourProgram5->tourTravelingTimeId = 3;
        array_push($tours,$tourProgram5);


        return $tours;
    }    

    private function getBook1(){
       return [
            [                
                "seq"=> 9,
                "tourCategoryId"=> 1,
                "tourTravelingTimeId"=> 3,
                "configTourId"=> 99,
                "tourProgramId"=> 15,
                "code"=> "TC-S02M",
                "title"=> "Breath of Nature (Morning)",
                "price"=> 1400,
                "extraCharge"=> 0,
                "discount"=> "70",
                "travelDate"=> "2017-07-20",
                "transactionId"=> 5,
                "passengerId"=> 9,
                "activityId"=> "1",
                "hotelId"=> "136",
                "hotelOther"=> "The Imperial Mae Ping Hotel",
                "hotelRoom"=> "99"
            ],
            [ 
                "seq"=> 10,
                "tourCategoryId"=> 1,
                "tourTravelingTimeId"=> 3,
                "configTourId"=> 106,
                "tourProgramId"=> 16,
                "code"=> "TC-S02A",
                "title"=> "Breath of Nature (Afternoon)",
                "price"=> 1600,
                "extraCharge"=> 0,
                "discount"=> "80",
                "travelDate"=> "2017-07-21",
                "transactionId"=> 5,
                "passengerId"=> 9,
                "activityId"=> "1",
                "hotelId"=> "136",
                "hotelOther"=> "The Imperial Mae Ping Hotel",
                "hotelRoom"=> "99"                
            ],
            [
                
                "seq"=> 9,
                "tourCategoryId"=> 1,
                "tourTravelingTimeId"=> 3,
                "configTourId"=> 99,
                "tourProgramId"=> 15,
                "code"=> "TC-S02M",
                "title"=> "Breath of Nature (Morning)",
                "price"=> 1400,
                "extraCharge"=> 0,
                "discount"=> "70",
                "travelDate"=> "2017-07-20",
                "transactionId"=> 5,
                "passengerId"=> 10,
                "activityId"=> "1",
                "hotelId"=> "136",
                "hotelOther"=> "The Imperial Mae Ping Hotel",
                "hotelRoom"=> "99"
            ],
            [
                "seq"=> 10,
                "tourCategoryId"=> 1,
                "tourTravelingTimeId"=> 3,
                "configTourId"=> 106,
                "tourProgramId"=> 16,
                "code"=> "TC-S02A",
                "title"=> "Breath of Nature (Afternoon)",
                "price"=> 1600,
                "extraCharge"=> 0,
                "discount"=> "80",
                "travelDate"=> "2017-07-21",
                "transactionId"=> 5,
                "passengerId"=> 10,
                "activityId"=> "1",
                "hotelId"=> "136",
                "hotelOther"=> "The Imperial Mae Ping Hotel",
                "hotelRoom"=> "99"
            ]
        ];
    }    
}
?>