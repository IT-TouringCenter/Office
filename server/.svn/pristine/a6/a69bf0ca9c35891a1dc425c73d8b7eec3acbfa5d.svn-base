<?php

use App\Facades\EasyBook\Ticket as Ticket;
use App\Repositories\EasyBook\Transaction\TransactionTransferRepository as reps;

class TicketTest extends TestCase{
    public function GetTransactionId(){
        return 3;
    }
    public function GetAiprtDateByTransactionId(){
        $transactionId = $this->GetTransactionId();

        $result = \TicketFacade::GetAirportDataByTransactionId($transactionId);
        print_r($result);
        $this->assertGreaterThanOrEqual(1,$result);
    }

    public function testGetAirportTicketByTransactionId(){
        $transactionId = $this->GetTransactionId();

        $tickets = \TicketFacade::GetAirportTicketByTransactionId($transactionId);
        print_r($tickets);
        $this->assertGreaterThanOrEqual(1,$tickets);
    }

    public function testGetConventionTicketByTransId(){
        $transactionId = $this->GetTransactionId();

        $tickets = \TicketFacade::GetConventionTicketByTransactionId($transactionId);
        print_r($tickets);
        $this->assertNotNull($tickets);
        $this->assertGreaterThanOrEqual(1,$tickets);
    }

    public function testGetHotelByTransactionId(){
        $transactionId = $this->GetTransactionId();
        $hotel=\TicketFacade::GetHotelByTransactionIdPassengerId($transactionId,4);
        echo 'testGetHotelByTransactionId';
        print_r($hotel);
    }
}
?>