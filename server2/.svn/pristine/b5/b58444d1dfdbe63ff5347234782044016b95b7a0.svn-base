<?php 
namespace App\Repositories\EasyBook\Tour;

use Carbon\Carbon;
use App\tour_invoice as tour_invoice;

class TourInvoiceRepository{
    
    public function __construct(tour_invoice $tour_invoice){
        $this->tour_invoice = $tour_invoice;
    }
    
    public function GetLastTourInvoiceId(){
        return $this->tour_invoice
                    ->orderBy('id', 'desc')
                    ->where('is_active',1)
                    ->where('invoice','LIKE','%ICAS%')
                    ->get(['id','invoice']);
    }

    public function SetTourInvoiceForGetId($invoice){
        $set_invoice = [
            "invoice"=>$invoice,
            "created_at"=>Carbon::now('Asia/Bangkok')
        ];

        $result = $this->tour_invoice->insertGetId($set_invoice);
        return $result;
    }
}
?>