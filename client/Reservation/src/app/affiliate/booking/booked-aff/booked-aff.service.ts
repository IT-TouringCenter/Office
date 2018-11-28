import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import 'rxjs/add/operator/map';

@Injectable()
export class BookedAffService {

  constructor(
    private _http: HttpClient
  ) { }

  // all book data
  getAllBook(){
    // let url = 'http://localhost:9000/api/Dashboard/Affiliate/Booked/Summary';
    // let url = 'http://api.tourinchiangmai.com/api/Dashboard/Affiliate/Booked/Summary';
    let url = './../../../../assets/json/affiliate/booked/booked-summary-all.json';
    return this._http.get(url).map(result => result);
  }

  // this month book data
  getMonthBook(){
    // let url = 'http://localhost:9000/api/Dashboard/Affiliate/Booked/Summary/Month';
    // let url = 'http://api.tourinchiangmai.com/api/Dashboard/Affiliate/Booked/Summary/Month';
    let url = './../../../../assets/json/affiliate/booked/booked-summary-month.json';
    return this._http.get(url).map(result => result);
  }

  // this year book data
  getYearBook(){
    // let url = 'http://localhost:9000/api/Dashboard/Affiliate/Booked/Summary/Year';
    // let url = 'http://api.tourinchiangmai.com/api/Dashboard/Affiliate/Booked/Summary/Year';
    let url = './../../../../assets/json/affiliate/booked/booked-summary-year.json';
    return this._http.get(url).map(result => result);
  }
}
