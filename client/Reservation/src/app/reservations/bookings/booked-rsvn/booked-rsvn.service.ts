import { Injectable } from '@angular/core';

import { Http, Response } from "@angular/http";
import { Observable } from "rxjs/Observable";
import "rxjs/Rx";

// Interface
import { BookedRsvnInterface } from "./booked-rsvn-interface";

@Injectable()
export class BookedRsvnService {

  constructor(private http: Http) { }

  private _getBooked;

  // get data booking
  getBookedData(): Observable<BookedRsvnInterface>{
    this._getBooked = "http://localhost:9000/api/Reservations/GetBookingStatisticData";
    // this._getBookedStatistics = "http://api.tourinchiangmai.com/api/Reservations/GetBookingStatisticData";

    return this.http
      .get(this._getBooked)
      .map((response: Response) => {
        return <BookedRsvnInterface>response.json();
      })
      .catch(this.handleError);
  }

  private handleError(error: Response){
    return Observable.throw(error.statusText);
  }
}