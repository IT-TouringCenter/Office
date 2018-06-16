<?php
namespace App\Facades\Commons;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

class DateFormatClass{

	public function __construct(){

	}

    // 01 Jan 18
    public function SetShortDate($date){
        $result = date('d M y',strtotime($date));
        return $result;
    }

    // 01 January 2018
    public function SetFullDate($date){
        $result = date('d F Y');
        return $result;
    }

    // 01 January 2018
    public function SetFormatFullDate($date){
        $result = date('d F Y',strtotime($date));
        return $result;
    }

    // 01:30 pm or 01:30 am
    public function SetTimeMeridiem($time){
        $result = date('g:i a',strtotime($time));
        return $result;
    }

    // 2018-01-01
    public function ReverseDate($date){
        $result = date('Y-m-d',strtotime($date));
        return $result;
    }

}