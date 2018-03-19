import { Component, OnInit } from '@angular/core';
import { FormsModule, FormControl, Validators } from '@angular/forms';
// Services
import { BookingprintService } from './bookingprint.service';
// Interfaces
import { BookingPrintInterface } from './../../interfaces/booking-print-interface';
// import { BookingdataInterface } from '../bookingform/bookingdata-interface';

@Component({
  selector: 'app-bookingprint',
  templateUrl: './bookingprint.component.html',
  styleUrls: ['./bookingprint.component.scss'],
  providers: [BookingprintService]
})
export class BookingprintComponent implements OnInit {

  _getBookingForm: BookingPrintInterface.RootObject;

  constructor(
    private bookingFormService: BookingprintService
  ) { }

  // JSON booking form
  getBookingFormData(): void{
    this.bookingFormService.getBookingFormData()
      .subscribe(
        resultArray => console.log(this._getBookingForm = resultArray),
        error => console.log("Error :: " + error)
      )
  }

  ngOnInit() {
    this.getBookingFormData();
  }

}
