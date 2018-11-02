import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import 'rxjs/add/operator/map';

@Injectable()
export class CommissionDayOfMonthAffService {

  constructor(
    private _http: HttpClient
  ) { }

  // commission day of month data
  getCommissionDayOfMonth(){
    // let url = 'http://localhost:9000/api/';
    // let url = 'http://api.tourinchiangmai.com/api/';
    let url = './../../../../assets/json/affiliate/commission/commission-days-of-month.json';
    return this._http.get(url).map(result => result);
  }

}