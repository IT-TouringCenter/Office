import { Injectable } from '@angular/core';
// -------------
import { Http, Response } from "@angular/http";
import { Observable } from "rxjs/Observable";
import "rxjs/Rx";

// Interfaces
import { SaveBookingInterface } from "./../interfaces/save-booking-interface";

@Injectable()
export class DataService {

  // private _saveBooking = "http://localhost:9000/api/ReservationSaveBookingData";
  private _saveBooking = "http://api.tourinchiangmai.com/api/ReservationSaveBookingData";

  constructor(private http: Http) { }

  // get data booking
  saveDataBooking(_dataSave){
    // return this._saveBooking;
    // return this.http
    //   .get(this._saveBooking)
    //   .map((response: Response) => {
    //     return <SaveBooking.BookingInfo>response.json();
    //   })
    //   .catch(this.handleError);
    // return this.http.post(url: _saveBooking, body: any, option?: )
  }

  private handleError(error: Response){
    return Observable.throw(error.statusText);
  }
}
