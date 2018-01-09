<?php
namespace App\Facades\EasyBook\Report;

use Carbon\Carbon;
use App\transaction as transaction;
use App\Repositories\EasyBook\Report\ReportRepository as ReportRepository;

class ReportClass{
	
	public function __construct(ReportRepository $ReportRepository){
		$this->ReportRepository = $ReportRepository;		
	}

	public function GetInvoiceSummary(){
		$result = $this->ReportRepository->GetInvoiceSummary();

		$table = '<table style="border:1px solid; font-size:11px;">';
		$table .= '
			<tr>
				<th style="border-bottom:1px solid; border-right:1px solid;">No</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Booking number</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Invoice number</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Firstname</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Lastname</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Email</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Nationality</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Hotel</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Issued by</th>
				<th style="border-bottom:1px solid;">Link</th>
			</tr>';
		
		$count = 1;
		foreach($result as $v){
			$genTransactionId = \HelperFacade::Encode($v->id);
			$table .= '
				<tr>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$count.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->booking_number.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->invoice_number.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->firstname.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->lastname.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->email.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->nationality.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->hotel_other.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">Online</td>
					<td style="border-bottom:1px solid;"><a href="http://icas10.tour-in-chiangmai.com/transaction/'.$genTransactionId.'" target="_blank">Link</a></td>
				</tr>';
			$count++;
		}

		$table .= '</table>';

		return $table;
	}

	public function GetReportCMECC(){
		$result = $this->ReportRepository->GetReportCMECC();
		// return $result;
		$table = '<table style="border:1px solid; font-size:11px;">';
		$table .= '
			<tr>
				<th style="border-bottom:1px solid; border-right:1px solid;">No</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Hotel</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Booking number</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Invoice number</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Firstname</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Lastname</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Email</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Nationality</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Ticket</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Price</th>
				<th style="border-bottom:1px solid;">Issued by</th>
			</tr>';
		
		$count = 1;
		foreach($result as $v){
			$table .= '
				<tr>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$count.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->hotel_other.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->booking_number.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->invoice_number.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->firstname.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->lastname.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->email.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->nationality_other.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->ticket_number.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->price.'</td>
					<td style="border-bottom:1px solid;">'.$v->issued_by.'</td>
				</tr>';
			$count++;
		}

		$table .= '</table>';

		return $table;
	}

	public function GetReportAirport(){
		$result = $this->ReportRepository->GetReportAirport();
		// return $result;
		$table = '<table style="border:1px solid; font-size: 11px;">';
		$table .= '
			<tr>
				<th style="border-bottom:1px solid; border-right:1px solid;">No</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Transfer</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Flight number</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Flight date</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Booking number</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Invoice number</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Firstname</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Lastname</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Email</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Nationality</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Hotel</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Ticket number</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Price</th>
				<th style="border-bottom:1px solid;">Issued by</th>
			</tr>';
		
		$count = 1;
		foreach($result as $v){
			$table .= '
				<tr>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$count.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->origin.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->flight_number.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->flight_date.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->booking_number.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->invoice_number.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->firstname.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->lastname.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->email.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->nationality_other.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->hotel_other.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->ticket_number.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->price.'</td>
					<td style="border-bottom:1px solid;">Online</td>
				</tr>';
			$count++;
		}

		$table .= '</table>';

		return $table;
	}

	public function GetReportTour(){
		$result = $this->ReportRepository->GetReportTour();
		// return $result;
		$table = '<table style="border:1px solid; font-size: 11px;">';
		$table .= '
			<tr>
				<th style="border-bottom:1px solid; border-right:1px solid;">No</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Date</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Booking number</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Invoice number</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Code</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Tour</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Time</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Firstname</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Lastname</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Email</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Nationality</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Hotel</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Price</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Discount</th>
				<th style="border-bottom:1px solid; border-right:1px solid;">Amount</th>
				<th style="border-bottom:1px solid;">Issued by</th>
			</tr>';
		
		$count = 1;
		foreach($result as $v){
			$price = $v->price;
			$discount = $v->discount;
			$amount = $price-$discount;

			$table .= '
				<tr>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$count.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->tour_traveling_date.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->booking_number.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->invoice_number.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->tour_program_code.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->tour_program_title.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->traveling_time.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->firstname.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->lastname.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->email.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->nationality_other.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->hotel_name.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->price.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$v->discount.'</td>
					<td style="border-bottom:1px solid; border-right:1px solid;">'.$amount.'</td>
					<td style="border-bottom:1px solid;">Online</td>
				</tr>';
			$count++;
		}

		$table .= '</table>';

		return $table;
	}
}