<?php 
namespace App\Repositories\EasyBook\Reservation\Transfer;

use App\Repositories\Src\Contracts\IRepository;
use App\Repositories\Src\Eloquent\Repository;

class TransferModeRepository extends Repository{
    function model(){return 'App\transfer_mode';}

    public function GetTransferModeById($transfer_mode_id){
    	return $this->model
    				->where('id',$transfer_mode_id)
    				->where('is_active',1)
    				->get();
    }
}