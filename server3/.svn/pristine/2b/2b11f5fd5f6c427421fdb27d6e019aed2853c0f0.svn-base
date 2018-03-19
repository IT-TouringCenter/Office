<?php
namespace App\Facades\EasyBook\Transaction;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Repositories\EasyBook\Transaction\TransactionTourProgramRepository as transaction_tour_program_repo;

use App\configuration_tour_program as configuration_tour_program;
use App\transaction_tour_program as transaction_tour_program;
use App\tour_program as tour_program;
use App\passenger as passenger;

class TransactionTourProgramClass{
	
	public function __construct(transaction_tour_program_repo $transaction_tour_program_repo){
		$this->transaction_tour_program_repo = $transaction_tour_program_repo;
	}

	// save tour program step 1
	public function SetTransactionTourProgram($passenger_id, $transaction_id, $reservation, $summary, $discount_code_id){
		$this->transaction_tour_program = new transaction_tour_program;
		$this->CheckGroupTourProgram($passenger_id, $transaction_id, $reservation, $summary, $discount_code_id);
		// $this->SetPassengerFormDB($passenger_id, $reservation);
		return $this->transaction_tour_program;
	}

	// save tour program Group by tour_program_id step 2
	public function CheckGroupTourProgram($passenger_id, $transaction_id, $reservation, $summary, $discount_code_id){
		$this->tour_program = new tour_program;

		$booking_tour_arr = [];
		$reservation_arr = [];

		foreach($reservation as $value){
			$booking_tour = array_get($value, 'tours');
			$booking_traveller = array_get($value, 'passenger');
			$config_tour_program_id = array_get($booking_tour, 'configTourProgramId');

			foreach($booking_tour as $val){
				$this->booking_tour = new configuration_tour_program;
				$this->booking_tour->transaction_id = $transaction_id;
				$this->booking_tour->config_tour_program_id = array_get($val, "configTourProgramId");
				$this->booking_tour->tour_program_id = array_get($val, "tourProgramId");
				$this->booking_tour->tour_traveling_time_id = array_get($val, "tourTravelingTimeId");
				$this->booking_tour->tour_traveling_date = array_get($val, "tourTravelingDate");
				// $this->booking_tour->tour_traveller = $booking_traveller;
				// $this->SetPassengerFormDB($passenger_id, $reservation);
				array_push($reservation_arr, $this->booking_tour);
			}
		}

		// Set unique tour program
		$booking_tour_unique_arr = [];
		$booking_tour_unique = array_unique($reservation_arr);
		// $booking_tour_unique = $reservation_arr;
		foreach ($booking_tour_unique as $vals) {
			$this->unique_tour = new transaction_tour_program;
			$this->RunInvoiceNumber($vals, $transaction_id, $reservation, $summary);

			// Set data to check passenger
			$ConfigTourProgramId = $this->unique_tour->config_tour_program_id;
			$TourTravelingTimeId = $this->unique_tour->tour_traveling_time_id;
			$TourTravelingDate = $this->unique_tour->tour_traveling_date;

			$this->SetPassengerFormDB($passenger_id, $reservation, $ConfigTourProgramId, $TourTravelingDate, $TourTravelingTimeId);

			// $this->unique_tour->ConfigTourProgramId = $this->unique_tour->config_tour_program_id;
			array_push($booking_tour_unique_arr, $this->unique_tour);
		}
		$this->tour_program = $booking_tour_unique_arr;

		// $this->CheckPassengerJoinTourToGether();
		$this->transaction_tour_program->reservations = $this->tour_program;
	}

	// save tour program step 3
	public function RunInvoiceNumber($tour_data, $transaction_id, $reservation, $summary){ // ICAS-2016-30004
		$get_last_invoice = \TourInvoiceIcasFacade::GetLastTourInvoice();

		$date_now = Carbon::now('Asia/Bangkok');

		$year_now = $date_now->year;
		$month_now = $date_now->month;
		$length_month = strlen($month_now);

		// get_last_invoice check empty
		if(!empty($get_last_invoice[0])){
			$get_invoice = $get_last_invoice;
		}else{
			$get_invoice = 'ICAS-'.$year_now.'-'.$month_now.'0001';
		}

		$last_invoice = array_get($get_invoice[0], 'invoice');

		if($length_month=='1'){
			$sub_month = substr($last_invoice, 10,1);
		}else if($length_month=='2'){
			$sub_month = substr($last_invoice, 10,2);
		}

		if($month_now==$sub_month){
			$sub_invoice = substr($last_invoice,11,4);
			$sub_invoice_int = intval($sub_invoice);

			$count_invoice = $sub_invoice_int+1;
			$length_inv_int = strlen($count_invoice);
			if($length_inv_int=='1'){
				$run_invoice = '000'.$count_invoice;
			}else if($length_inv_int=='2'){
				$run_invoice = '00'.$count_invoice;
			}else if($length_inv_int=='3'){
				$run_invoice = '0'.$count_invoice;
			}else if($length_inv_int=='4'){
				$run_invoice = $count_invoice;
			}else{
				$run_invoice = $count_invoice.'S';
			}
		}else{
			$run_invoice = '0001';
		}

		$invoice_number = 'ICAS-'.$year_now.'-'.$month_now.$run_invoice;
		$invoice_id = \TourInvoiceIcasFacade::SetTourInvoice($invoice_number);

		// set data before return
		$config_tour_program_id = array_get($tour_data, 'config_tour_program_id');
		$tour_program_id = array_get($tour_data, 'tour_program_id');
		$tour_traveling_time_id = array_get($tour_data, 'tour_traveling_time_id');
		$tour_traveling_date = array_get($tour_data, 'tour_traveling_date');
		$tour_traveller = array_get($tour_data, 'tour_traveller');

		$this->unique_tour->config_tour_program_id = $config_tour_program_id;
		$this->unique_tour->tour_program_id = $tour_program_id;
		$this->unique_tour->tour_traveling_time_id = $tour_traveling_time_id;
		$this->unique_tour->transaction_id = $transaction_id;
		$this->unique_tour->invoice_number_id = $invoice_id;
		$this->unique_tour->tour_traveling_date = $tour_traveling_date;

		// $this->unique_tour->tour_traveller = $tour_traveller;
		// $this->CheckPassengerJoinTourToGether($config_tour_program_id, $tour_traveling_time_id, $tour_traveling_date, $reservation, $summary);

		// $result = $this->transaction_tour_program_repo->SaveTransactionTourProgram($data_booking);
	}

	// save tour program step 4
	public function SetPassengerFormDB($passenger_id, $reservation , $config_tour_program_id, $tour_traveling_date, $tour_traveling_time_id){
		$passenger_arr = [];
		$count = 0;
		foreach($reservation as $value){
			$passenger = array_get($value, 'passenger');

			$this->save_passenger = new passenger;
			$this->save_passenger->passenger_client_id = array_get($value,'id');
			$save_and_get_passenger = $passenger_id;

			foreach($save_and_get_passenger as $val){
				$this->save_passenger->passenger_id = array_get($save_and_get_passenger[$count],'id');
			}
			$count++;
			array_push($passenger_arr, $this->save_passenger);
		
			// $this->save_passenger->reservation = $reservation;
			// Check traveller tour program
		}
		$this->CheckPassengerJoinTourToGether($passenger_arr, $reservation, $config_tour_program_id, $tour_traveling_date, $tour_traveling_time_id);
		// $result = \PassengerIcasFacade::CheckPassengerToTravelingTour($passenger_arr, $reservation);
		// $this->unique_tour->passengers = $passenger_arr;
	}

	// save tour program step 4
	public function CheckPassengerJoinTourToGether($passenger_arr, $reservation, $config_tour_program_id, $tour_traveling_date, $tour_traveling_time_id){
		$result = \PassengerIcasFacade::CheckPassengerToTravelTour($passenger_arr, $reservation, $config_tour_program_id, $tour_traveling_date, $tour_traveling_time_id);
		$this->unique_tour->passengers = $result;
		
		// $this->passenger = new passenger;
		// $passenger_join_tour_arr = [];

		// $reservation_count = count($reservation);

		// for($i=0; $i<$reservation_count; $i++){
			// $this->unique_tour->reservations = array_get($reservation[$i],'id');
			// $this->unique_tour->reservations = $passenger_join_tour_arr;
			// foreach($passenger_arr as $value){
				// $this->unique_tour->passnegers = $value;
			// }
		// }

			// $slice_passenger = array_slice($passenger_arr[0],0);
			$this->unique_tour->passengers = $result;

		// foreach($reservation as $reserv){
		// 	array_push($passenger_join_tour_arr, $reserv);
		// }

		// foreach($reservation as $value){
		// 	$passengers = array_get($value, 'passenger');
		// 	array_push($passenger_join_tour_arr, $passengers);
		// }

		// array_push($passenger_join_tour_arr, $passenger);
		// $this->unique_tour->reservations = array_get($reservation[0], 'passenger');
		// $this->unique_tour->reservations = $reservation;
	}
}