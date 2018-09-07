import { Component, OnInit } from '@angular/core';
import { FormsModule, FormControl, Validators } from '@angular/forms';
// Services
import { BookformRsvnService } from './bookform-rsvn.service';
// Interfaces
// import { BookingPrintInterface } from './../../interfaces/booking-print-interface';
import { BookformRsvnInterface } from './bookform-rsvn-interface';
// import { BookingdataInterface } from '../bookingform/bookingdata-interface';

@Component({
  selector: 'app-bookform-rsvn',
  templateUrl: './bookform-rsvn.component.html',
  styleUrls: ['./bookform-rsvn.component.scss'],
  providers: [BookformRsvnService]
})
export class BookformRsvnComponent implements OnInit {

  userId = '1084873764';

  _getBookingForm: BookformRsvnInterface.RootObject;
  public paymentCollectColor = '';

  constructor(
    private bookformRsvnService: BookformRsvnService
  ) { }

  // JSON booking form
  getBookingFormData(): void{
    this.bookformRsvnService.getBookingFormData()
      .subscribe(
        resultArray => console.log(this._getBookingForm = resultArray),
        error => console.log("Error :: " + error)
      )
  }

  ngOnInit() {
    this.getBookingFormData();
  }

}