import { Injectable } from '@angular/core';
// -------------
import { Http, Response } from "@angular/http";
import { Observable } from "rxjs/Observable";
import "rxjs/Rx";

// interface
import { BookedStatisticsInterface } from "./../../interfaces/booked-statistics";

@Injectable()
export class BookedstatisticsService {

  constructor(private http: Http) { }

  private _getBookedStatistics;

  // get data booking
  getBookingStatisticsData(): Observable<BookedStatisticsInterface>{
    // this._getBookedStatistics = "http://localhost:9000/api/GetBookingStatisticData";
    this._getBookedStatistics = "http://api.tourinchiangmai.com/api/GetBookingStatisticData";

    return this.http
      .get(this._getBookedStatistics)
      .map((response: Response) => {
        return <BookedStatisticsInterface>response.json();
      })
      .catch(this.handleError);
  }

  private handleError(error: Response){
    return Observable.throw(error.statusText);
  }
}
