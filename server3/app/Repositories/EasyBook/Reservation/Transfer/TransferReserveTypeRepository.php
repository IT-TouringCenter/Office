<?php 
namespace App\Repositories\EasyBook\Reservation\Transfer;

use App\Repositories\Src\Contracts\IRepository;
use App\Repositories\Src\Eloquent\Repository;

class TransferReserveTypeRepository extends Repository{
    function model(){return 'App\transfer_reserve_type';}

    public function GetTransferReserveTypeById($transfer_reserve_type_id){
    	return $this->model
    				->where('id',$transfer_reserve_type_id)
    				->where('is_active',1)
    				->get();
    }
}