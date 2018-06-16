import { Injectable } from '@angular/core';
import { Http, Response } from "@angular/http";
import { ActivatedRoute, Params } from "@angular/router";
import { Observable } from "rxjs/Observable";
import "rxjs/Rx";
import "cors";
// interface
import { currencyInterface } from "./currency-interface";

@Injectable()
export class CurrencyService {

  private transactionId;
  private _getCurrencyData;

  constructor(private http: Http, private route: ActivatedRoute) {
    let _params = this.route.snapshot.paramMap.get(('transactionId'));
    this.transactionId = _params;
  }

  // get data booking
  getInvoiceData(): Observable<currencyInterface.RootObject>{
    // Get parameter from URL
    // this._getCurrencyData = "http://www.apilayer.net/api/live?access_key=c2caaa4832861f06206d52c3fd3e9360&format=1";
    this._getCurrencyData = "./../../../assets/json/currency/currency.json";

    return this.http
      .get(this._getCurrencyData)
      .map((response: Response) => {
        return <currencyInterface.RootObject>response.json();
      })
      .catch(this.handleError);
  }

  private handleError(error: Response){
    return Observable.throw(error.statusText);
  }
}
