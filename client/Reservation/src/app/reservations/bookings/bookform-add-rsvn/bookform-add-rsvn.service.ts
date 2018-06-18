import { Injectable } from '@angular/core';
// -------------
import { Http, Response } from "@angular/http";
import { Observable } from "rxjs/Observable";
import "rxjs/Rx";

// interface
import { BookformAddRsvnInterface } from "./bookform-add-rsvn-interface";
import { AccountCodeInterface } from "./../../interfaces/account-code-interface";

// import {} from "./../../../assets/json/accounts/accountCode.json";

@Injectable()
export class BookformAddRsvnService {

  private _getBookingData;
  private _getAccountCode;

  constructor(private http: Http) { }

  // get data booking
  getBookingData(): Observable<BookformAddRsvnInterface.RootObject>{
    this._getBookingData = "./../../../../assets/json/reservations/bookingData.json";
    // this._getBookingData = "http://localhost:9000/api/Reservations/GetDataBooking";
    // this._getBookingData = "http://api.tourinchiangmai.com/api/Reservations/GetDataBooking";
    return this.http
      .get(this._getBookingData)
      .map((response: Response) => {
        return <BookformAddRsvnInterface.RootObject>response.json();
      })
      .catch(this.handleError);
  }

  // get account code
  getAccountCode(): Observable<AccountCodeInterface.RootObject>{
    this._getAccountCode = "./../../../assets/json/accounts/accountCode.json";
    // this._getAccountCode = "http://localhost:9000/api/Reservations/GetAccountCodeData";
    // this._getAccountCode = "http://api.tourinchiangmai.com/api/Reservations/GetAccountCodeData";
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
