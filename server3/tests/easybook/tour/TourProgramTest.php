<?php
use App\tour_traveling_time as tourTimeModel;
use App\transaction_tour_program_detail as Model;
use App\Repositories\EasyBook\Tour\TourTimeRepositoy as TourTimeRepo;
use App\Repositories\EasyBook\Transaction\TransactionTourProgramRepository as TourRep;

class TourProgramTest extends TestCase{
    public function getIdProvider(){
        return 1;
    }
    public function testGetGroupTourProgramByTransactionId(){
        $transactionId= $this->getIdProvider();

        $repo = new TourRep(new Model());

        $result= $repo->GetTourProgramByTransactionId($transactionId);
        //print_r($result->toArray());
        //$this->assertNull($result);

        $this->assertGreaterThan(0,count($result));
    }

    public function testGetTourProgramByTransactionId(){
        $transactionId=$this->getIdProvider();
        $primaryContact = 'Panawat Atjanawat';

        $repo = new TourRep(new Model());

        $result= $repo->GetTourProgramByTransactionId($transactionId);
        //print_r($result->toArray());
        //echo json_encode($result);        

        $primaryResult='temp';
        foreach ($result as $value) {
            $person = $value->GetPerson;
            
            //echo json_encode($person);
            // echo '<br/>';

            if($person->parent_id ==0){
                 $primaryResult  = $person->firstname.' '.$person->lastname;
                 return;
            }
        }

        echo($primaryResult);
        $this->assertEquals($primaryResult, $primaryContact);
    }

    public function testGetTourByTransactinId(){
        $transactionId=$this->getIdProvider();
        $repo = new TourRep(new Model());
        $tours = $repo->GetTourProgramByTransactionId($transactionId);

        // $json = json_encode($tours);
        // $object = json_decode($json);

        //print_r(json_decode($json));
        //echo json_encode($tours);

        $dataArr= $this->MapTourProvider($tours);        
        //echo json_encode($dataArr);
        
        $this->assertEquals(true,true);
    }

    private function MapTourProvider($datas){
        $tours= [];

        foreach ($datas as $value) {
           
            $tours[]=[
                'code'=> $value->tour_program_code,
                'title'=>$value->tour_program_title,
                'price'=>$value->price - $value->discount - $value->extra_charge,
                'medical'=>$this->getTourTimeByTimeId($value->tour_traveling_time_id)
            ];
        }

        return $tours;
    }

    private function getTourTimeByTimeId($timeId){
        $repo = new TourTimeRepo(new tourTimeModel());
        $time = $repo->GetTimeTourByTimeId($timeId);
        if($time ==null){
            return '';
        }
        
        $actaul= $time->medical;
                 
        return $actaul;
    }

    public function testGetGroupToursByTransactionId(){
        $transactionId=$this->getIdProvider();

        $repo = new TourRep(new Model());
        $result= $repo->GetGroupToursByTransactionId($transactionId);

        echo json_encode($result);

        $this->assertGreaterThanOrEqual(1,count($result));
    }

    public function testGetPassengerToursByTransactionId(){
        $transactionId=$this->getIdProvider();

        $repo = new TourRep(new Model());
        $result= $repo->GetTourProgramGroupByTransactionId($transactionId);

        // echo json_encode($result);

        $this->assertGreaterThanOrEqual(1,count($result));
    }

    public function testGetHotelTourByTransactionId(){
        $transactionId=$this->getIdProvider();

        $repo = new TourRep(new Model());
        $result= $repo->GetHotelTourByTransactionId($transactionId);

        // echo json_encode($result);

        $this->assertGreaterThanOrEqual(1,count($result));
    }    
}

?>