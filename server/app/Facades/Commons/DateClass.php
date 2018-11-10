<?php
namespace App\Facades\Commons;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

class DateClass{

	public function __construct(){

	}

    // Month in year
    public function MonthInYear(){
        $month = ["January","February","March","April","May","June","July","August","September","October","November","December"];
        return $month;
    }

    // Month (min) in year
    public function MinMonthInYear(){
        $month = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
        return $month;
    }

    // Get month by index
    public function GetMonthByIndex($index){
        $month = ["January","February","March","April","May","June","July","August","September","October","November","December"];
        return $month[$index];
    }
}