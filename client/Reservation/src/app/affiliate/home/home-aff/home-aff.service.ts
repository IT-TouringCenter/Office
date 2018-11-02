import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import 'rxjs/add/operator/map';

@Injectable()
export class HomeAffService {

  constructor(
    private _http: HttpClient
  ) { }

  // dashboard data
  getDashboardData(){
    // let url = 'http://localhost:9000/api/Account/Request/AccountForgotPassword';
    // let url = 'http://api.tourinchiangmai.com/api/Account/Request/AccountForgotPassword';
    let url = "./../../../../assets/json/affiliate/dashboard/dashboard.json";
    return this._http.get(url).map(result => result);
  }

  // booked data
  getBookedData(){
    // let url = 'http://localhost:9000/api/Dashboard/Affiliate';
    // let url = 'http://api.tourinchiangmai.com/api/Dashboard/Affiliate';
    let url = './../../../../assets/json/affiliate/dashboard/dashboard-booked.json';
    return this._http.get(url).map(result => result);
  }

  // commission data
  getCommissionData(){
    // let url = 'http://localhost:9000/api/Account/Request/AccountForgotPassword';
    // let url = 'http://api.tourinchiangmai.com/api/Account/Request/AccountForgotPassword';
    let url = './../../../../assets/json/affiliate/dashboard/dashboard-commission.json';
    return this._http.get(url).map(result => result);
  }
}
