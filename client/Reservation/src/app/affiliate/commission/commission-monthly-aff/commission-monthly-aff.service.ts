import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import 'rxjs/add/operator/map';

@Injectable()
export class CommissionMonthlyAffService {

  constructor(
    private _http: HttpClient
  ) { }

  // commission monthly
  getCommissionMonthly(){
    // let url = 'http://localhost:9000/api/';
    // let url = 'http://api.tourinchiangmai.com/api/';
    let url = './../../../../assets/json/affiliate/commission/commission-monthly.json';
    return this._http.get(url).map(result => result);
  }

}