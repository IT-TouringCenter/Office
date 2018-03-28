import { Injectable } from '@angular/core';
// -------------
import { Http, Response } from "@angular/http";
import { Observable } from "rxjs/Observable";
import "rxjs/Rx";

// interface
import { BookingFormInterface } from "./../bookingform/bookingform-interface";
import { AccountCodeInterface } from "./../../interfaces/account-code-interface";

@Injectable()
export class BookingformEditService {

  private _getBookingData = "http://localhost:9000/api/GetDataBooking";
  private _getAccountCode = "http://localhost:9000/api/GetAccountCodeData";
  // private _getBookingData = "http://api.tourinchiangmai.com/api/GetDataBooking";
  // private _getAccountCode = "http://api.tourinchiangmai.com/api/GetAccountCodeData";
  // private _getBookingData = "../../../assets/json/reservations/bookingData.json";
  // private _getAccountCode = "../../../assets/json/accounts/accountCode.json";

  constructor(private http: Http) { }

  // get data booking
  getBookingData(): Observable<BookingFormInterface.RootObject>{
    return this.http
      .get(this._getBookingData)
      .map((response: Response) => {
        return <BookingFormInterface.RootObject>response.json();
      })
      .catch(this.handleError);
  }

  // get account code
  getAccountCode(): Observable<AccountCodeInterface.RootObject>{
    return this.http
      .get(this._getAccountCode)
      .map((response: Response) => {
        return <AccountCodeInterface.RootObject>response.json();
      })
      .catch(this.handleError);
  }

  private handleError(error: Response){
    return Observable.throw(error.statusText);
  }
}
