import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import 'rxjs/add/operator/map';

@Injectable()
export class TraveledMonthlyAffService {

  constructor(
    private _http: HttpClient
  ) { }

  // traveled monthly data
  getTraveledMonthly(){
    // let url = 'http://localhost:9000/api/';
    // let url = 'http://api.tourinchiangmai.com/api/';
    let url = "./../../../../assets/json/affiliate/traveled/traveled-monthly.json";
    return this._http.get(url).map(result => result);
  }
}