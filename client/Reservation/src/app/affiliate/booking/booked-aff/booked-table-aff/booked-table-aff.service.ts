import { Injectable } from '@angular/core';

import { Http, Response } from "@angular/http";
import { Observable } from "rxjs/Observable";
import "rxjs/Rx";

// Interface
import { BookedTableAffInterface } from "./booked-table-aff-interface";

@Injectable()
export class BookedTableAffService {

  constructor(private http: Http) { }

  private _getBooked;

  // get data booking
  getBookedData(): Observable<BookedTableAffInterface>{
    this._getBooked = "http://localhost:9000/api/reservations/GetBookedByAccountId";
    // this._getBooked = "http://api.tourinchiangmai.com/api/reservations/GetBookedByAccountId";

    return this.http
      .get(this._getBooked)
      .map((response: Response) => {
        return <BookedTableAffInterface>response.json();
      })
      .catch(this.handleError);
  }

  private handleError(error: Response){
    return Observable.throw(error.statusText);
  }
}