import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import 'rxjs/add/operator/map';

@Injectable()
export class TourAffService {

  constructor(
    private _http: HttpClient
  ) { }

  // all book data
  getTour(){
    // let url = 'http://localhost:9000/api/';
    // let url = 'http://api.tourinchiangmai.com/api/';
    let url = './../../../../assets/json/affiliate/tour/tour-summary.json';
    return this._http.get(url).map(result => result);
  }
}