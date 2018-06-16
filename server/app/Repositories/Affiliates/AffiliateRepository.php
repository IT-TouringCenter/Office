<?php 
namespace App\Repositories\Affiliates;

use Carbon\Carbon;

use App\account as Account;

class AffiliateRepository{    

	public function __construct(Account $Account){
        $this->Account = $Account;
	}
    

}