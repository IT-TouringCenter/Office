import { Injectable } from '@angular/core';
import { Http, Response } from "@angular/http";
import { ActivatedRoute, Params } from "@angular/router";
import { Observable } from "rxjs/Observable";
import "rxjs/Rx";
import "cors";
// interface
import { BookingPrintInterface } from "./../../interfaces/booking-print-interface";

@Injectable()
export class BookingprintService {

  private transactionId;
  private _getBookingData;

  constructor(private http: Http, private route: ActivatedRoute) {
    // Get parameter from URL
    let _params = this.route.snapshot.paramMap.get(('transactionId'));
    this.transactionId = _params;
    // this.route.params.subscribe(res => +res.transactionId);
  }

  // get data booking
  getBookingFormData(): Observable<BookingPrintInterface.RootObject>{
    this._getBookingData = "http://localhost:9000/api/GetBookingFormData/"+this.transactionId;
    // this._getBookingData = "http://api.tourinchiangmai.com/api/GetBookingFormData/"+this.transactionId;

    return this.http
      .get(this._getBookingData)
      .map((response: Response) => {
        return <BookingPrintInterface.RootObject>response.json();
      })
      .catch(this.handleError);
  }

  private handleError(error: Response){
    return Observable.throw(error.statusText);
  }
}
