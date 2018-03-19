<?php
use App\invoice as invoice;
use App\Repositories\EasyBook\Invoice\InvoiceRepository as InvoiceRepos;

class InvoiceTest extends TestCase{

    public function getTransactinId(){
        return 1;
    }

    public function reserveIndentifyInvoiceProvider(){
        $activity = 1;
        return DB::select('select nst_fn_getIdentifies_reserveIdentifies ('.$activity.') as id');        
    }
    
    public function getInvoiceDataProvider(){
        $data = new invoice();
        $reserveKey= $this->reserveIndentifyInvoiceProvider();
        print_r($reserveKey[0]->{'id'});

        $myId= $reserveKey[0]->{'id'};
        
        $data->identify=$myId;
        $data->activityId=1;
        $data->transactionId=1;
        $data->paymentId=1;
        $data->passengerId=1;
        $data->statusId=0;//0:Pending,1:Approved

        return $data;
    }

    public function testGetIdentify(){
        // $activity = 1;
        // $identify = $this->getInvoiceDataProvider();
        // print_r($identify);

        //$myKey= $this->getMyIdentify($identify);
        // print_r($myKey);

       // $this->assertGreaterThan(1,$myKey);
    }


    public function testInsertInvoice(){
        // $model = new invoice();
        // $invoiceRepos = new InvoiceRepos($model);
        // $data = $this->getInvoiceDataProvider();

        // // print_r($data->toArray());

        // $return = $invoiceRepos->InsertInvoice($data);
        // // print($return);
        // $this->assertGreaterThan(1,$return);
    }

    public function testGetTourByTransactionId(){
        $tranId= $this->getTransactinId();
        $results = \InvoiceFacade::GetTourByTransactionId($tranId);

        //echo json_encode($results);
        // $this->assertGreaterThan(0,count($results));
    }

    public function testGetPassengerToursByTransactionId(){
        $tranId= $this->getTransactinId();
        // $results = \InvoiceFacade::GetPassengerToursByTransactionId($tranId);

        //echo json_encode($results);
        // $this->assertGreaterThan(0,count($results));
    }

    public function testGetHotelTourByTransactionId(){
        $tranId= $this->getTransactinId();
        // $results = \InvoiceFacade::GetHotelTourByTransactionId($tranId);

        //echo json_encode($results);
        // $this->assertGreaterThan(0,count($results));
    }

    public function testGetConventionTransferByTransactionId(){
        $tranId= $this->getTransactinId();
        // $results = \InvoiceFacade::GetConventionTransferByTransactionId($tranId);

        // echo json_encode($results);
        // $this->assertGreaterThan(0,count($results));
    }

    public function testGetInvoiceByTransactionId(){
        $tranId= $this->getTransactinId();
        $results = \InvoiceFacade::GetInvoiceByTransactionId($tranId);

        // echo json_encode($results);
        $this->assertGreaterThan(0,count($results));
    }

    public function testInsertTourInvoice(){
        $invoice = new invoice();
        $invoice->activityId = 1;
        $invoice->identify=2017040001;
        $invoice->transactionId=1;
        $invoice->paymentId=1;
        $invoice->passengerId=1;
        $invoice->invoiceCategoryId = 3;//tour invoice
        $invoice->template="easybook.invoice.tour.invoice";
        $invoice->statusId=2;//PaymentStatus: Approved

        $model = new invoice();
        $invoiceRepos = new InvoiceRepos($model);
        $return = $invoiceRepos->InsertInvoice($invoice);

        echo json_encode($return);

        $this->assertGreaterThan(0,count($return));
    }

    // public function testInsertConventionInvoice(){

    // }
}
?>