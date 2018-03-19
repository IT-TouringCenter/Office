<?php 
namespace App\Repositories\EasyBook\Reservation;

use Carbon\Carbon;
use App\configuration_activity_price as PriceModel;

class ActivityPriceRepository{
    
    public function __construct(PriceModel $priceModel){
        $this->model = $priceModel;
    }
    
    public function TestAccess(){
      return "You can access.";
    }

    public function GetPrice($activityId,$modeId,$reserveTypeId,$confTransportationId){
        $now= Carbon::now('Asia/Bangkok');
        return $this->model
            ->where('configuration_transportation_id','=',$confTransportationId)            
            ->where('transfer_mode_id','=',$modeId)
            ->where('transfer_reserve_type_id','=',$reserveTypeId)
            ->where('activity_id','=',$activityId)
            ->where('is_active',1)
            ->where('validity_start','<=',$now)
            ->where('validity_end','>=',$now)            
            ->get(['id','price']);
    }
}
?>