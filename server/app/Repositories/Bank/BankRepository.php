<?php 
namespace App\Repositories\Bank;

use Carbon\Carbon;

class BankRepository{

	public function __construct(){

	}

	// Save transaction
    public function GetBank(){
        $result = \DB::table('banks')
                        ->where('is_active',1)
                        ->get();
        return $result;
    }
}