<?php namespace App\Repositories;

use Carbon\Carbon;

class RepositoryBase{
    protected function GetDefaultPropertys(){
        return [
            'is_active'=>true,
			'created_by'=>'System',
            'created_at'=>Carbon::now('Asia/Bangkok')
        ];
    }
}
?>