import { Injectable } from '@angular/core';
import { Http, Response } from "@angular/http";
import { ActivatedRoute, Params } from "@angular/router";
import { Observable } from "rxjs/Observable";
import "rxjs/Rx";
import "cors";

// Interface
import { RegisterConfirmUserInterface } from "./register-confirm-user-interface";

@Injectable()
export class RegisterConfirmUserService {

  private accountToken;
  private _getAccountData;

  constructor(private http: Http, private route: ActivatedRoute) {
    // this.transactionId = this.route.snapshot.paramMap.get(('transactionId'));
    let _params = this.route.snapshot.paramMap.get(('userId'));
    this.accountToken = _params;
  }

  // get booking form edit
  getAccountData(): Observable<RegisterConfirmUserInterface.RootObject>{
    this._getAccountData = "http://localhost:9000/api/Account/Register/GetAccountRegisterConfirm/"+this.accountToken;
    // this._getAccountData = "http://api.tourinchiangmai.com/api/Account/Register/GetAccountRegisterConfirm/"+this.accountToken;
    return this.http
      .get(this._getAccountData)
      .map((response: Response) => {
        return <RegisterConfirmUserInterface.RootObject>response.json();
      })
      .catch(this.handleError);
  }

  private handleError(error: Response){
    return Observable.throw(error.statusText);
  }
}
