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
        $result = date('d F Y',strtotime($date));
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

    // 2018-01-01 +1 days
    public function SetTomorrow($date){
        $date1 = str_replace('-', '/', $date);
        $tomorrow = date('Y-m-d',strtotime($date1. "+1 days"));
        return $tomorrow;
    }

    /*
        Set time
            +1 minutes
            +1 hour
            +1 days
            +1 months
            +1 years
    */

    // Format 2018-01-01 12:00:00
    // +1 hour
    public function SetDatePlus1Hour($dateTime){
        $dateTime1 = str_replace('-', '/', $dateTime);
        $plus1Hour = date('Y-m-d H:i:s',strtotime($dateTime1. "+1 hour"));
        return $plus1Hour;
    }

    // +30 minute
    public function SetDatePlus30Minute($dateTime){
        $dateTime1 = str_replace('-', '/', $dateTime);
        $plus30Min = date('Y-m-d H:i:s',strtotime($dateTime1. "+30 minutes"));
        return $plus30Min;
    }

    // +15 minute
    public function SetDatePlus15Minute($dateTime){
        $dateTime1 = str_replace('-', '/', $dateTime);
        $plus15Min = date('Y-m-d H:i:s',strtotime($dateTime1. "+15 minutes"));
        return $plus15Min;
    }

    // Format 01:30 pm 01 January 2018
    public function SetFullDateTime($dateTime){
        $result = date('g:i a d F Y',strtotime($dateTime));
        return $result;
    }

    // Format 01 January 2018
    // public function SetFullDateFormat($date){
    //     $result = date('d F Y',strtotime($date));
    //     return $result;
    // }

}