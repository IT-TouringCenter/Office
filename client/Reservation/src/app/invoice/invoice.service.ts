import { Injectable } from '@angular/core';
import { Http, Response } from "@angular/http";
// import { HttpClient, HttpParams } from "@angular/common/http";
import { ActivatedRoute, Params } from "@angular/router";
import { Observable } from "rxjs/Observable";
import "rxjs/Rx";
import "cors";
// interface
import { InvoiceInterface } from "./../interfaces/invoice-interface";

// service

@Injectable()
export class InvoiceService {

  private transactionId;
  private _getInvoiceData;

  constructor(private http: Http, private route: ActivatedRoute) {
    let _params = this.route.snapshot.paramMap.get(('transactionId'));
    this.transactionId = _params;
    // this.route.params.subscribe(res => + res.transactionId);
  }
  
  // get data booking
  getInvoiceData(): Observable<InvoiceInterface.RootObject>{
    // Get parameter from URL
    this._getInvoiceData = "http://localhost:9000/api/GetInvoiceData/"+this.transactionId;
    // this._getInvoiceData = "http://api.tourinchiangmai.com/api/GetInvoiceData/"+this.transactionId;

    return this.http
      .get(this._getInvoiceData)
      .map((response: Response) => {
        return <InvoiceInterface.RootObject>response.json();
      })
      .catch(this.handleError);
  }

  private handleError(error: Response){
    return Observable.throw(error.statusText);
  }
}
