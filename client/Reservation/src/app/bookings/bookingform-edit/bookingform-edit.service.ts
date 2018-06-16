import { Injectable } from '@angular/core';
import { Http, Response } from "@angular/http";
import { ActivatedRoute, Params } from "@angular/router";
import { Observable } from "rxjs/Observable";
import "rxjs/Rx";
import "cors";

// interface
import { BookingFormInterface } from "./../bookingform/bookingform-interface";
import { AccountCodeInterface } from "./../../interfaces/account-code-interface";
import { BookingFormEditInterface } from "./bookingform-edit-interface";

@Injectable()
export class BookingformEditService {

  private transactionId;
  private _getBookingFromEdit;
  private _getBookingData;
  private _getAccountCode;

  constructor(private http: Http, private route: ActivatedRoute) {
    // this.transactionId = this.route.snapshot.paramMap.get(('transactionId'));
    let _params = this.route.snapshot.paramMap.get(('transactionId'));
    this.transactionId = _params;
  }

  // get data booking
  getBookingData(): Observable<BookingFormInterface.RootObject>{
    this._getBookingData = "./../../../assets/json/reservations/bookingData.json";
    // this._getBookingData = "http://localhost:9000/api/GetDataBooking";
    // this._getBookingData = "http://api.tourinchiangmai.com/api/GetDataBooking";
    return this.http
      .get(this._getBookingData)
      .map((response: Response) => {
        return <BookingFormInterface.RootObject>response.json();
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

  // get booking form edit
  getBookingFormEdit(): Observable<BookingFormEditInterface.RootObject>{
    this._getBookingFromEdit = "http://localhost:9000/api/Reservations/GetBookingFormEdit/"+this.transactionId;
    // this._getBookingFromEdit = "http://api.tourinchiangmai.com/api/Reservations/GetBookingFormEdit/"+this.transactionId;
    return this.http
      .get(this._getBookingFromEdit)
      .map((response: Response) => {
        return <BookingFormEditInterface.RootObject>response.json();
      })
      .catch(this.handleError);
  }

  private handleError(error: Response){
    return Observable.throw(error.statusText);
  }
}