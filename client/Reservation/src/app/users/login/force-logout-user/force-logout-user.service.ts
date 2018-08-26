import { Injectable } from '@angular/core';
import { Http, Response } from "@angular/http";
import { ActivatedRoute, Params } from "@angular/router";
import { Observable } from "rxjs/Observable";
import "rxjs/Rx";
import "cors";

// Interface
import { ForceLogoutUserInterface } from "./force-logout-user-interface";

@Injectable()
export class ForceLogoutUserService {

  private accountToken;
  private _getAccountData;

  constructor(private http: Http, private route: ActivatedRoute) {
    // this.transactionId = this.route.snapshot.paramMap.get(('transactionId'));
    let _params = this.route.snapshot.paramMap.get(('userId'));
    this.accountToken = _params;
  }

  // get booking form edit
  getAccountData(): Observable<ForceLogoutUserInterface.RootObject>{
    this._getAccountData = "http://localhost:9000/api/Account/GetAccountForceLogout/"+this.accountToken;
    // this._getAccountData = "http://api.tourinchiangmai.com/api/Account/GetAccountForceLogout/"+this.accountToken;
    return this.http
      .get(this._getAccountData)
      .map((response: Response) => {
        return <ForceLogoutUserInterface.RootObject>response.json();
      })
      .catch(this.handleError);
  }

  private handleError(error: Response){
    return Observable.throw(error.statusText);
  }

}
