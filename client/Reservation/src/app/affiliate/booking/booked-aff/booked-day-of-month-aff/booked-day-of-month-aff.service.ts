import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import 'rxjs/add/operator/map';

@Injectable()
export class BookedDayOfMonthAffService {

  constructor(
    private http: Http,
    private _http: HttpClient
  ) { }

  // book day of month data
  getBookedDayOfMonth(){
    // let url = 'http://localhost:9000/api/';
    // let url = 'http://api.tourinchiangmai.com/api/';
    let url = './../../../../assets/json/affiliate/booked/booked-days-of-month.json';
    return this._http.get(url).map(result => result);
  }

  // search book day of month
  postBookedDayOfMonth(data){
    let options = new RequestOptions();
    let url = 'http://localhost:9000/api/Dashboard/Affiliate/Booked/DaysOfMonth';
    // let url = 'http://api.tourinchiangmai.com/api/Dashboard/Affiliate/Booked/DaysOfMonth';
    return this._http.post(url, data).map(result => result);
  }
}
