import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import 'rxjs/add/operator/map';

@Injectable()
export class CommissionTourAffService {

  constructor(
    private _http: HttpClient
  ) { }

  // commission tour data
  getCommissionTour(){
    // let url = 'http://localhost:9000/api/';
    // let url = 'http://api.tourinchiangmai.com/api/';
    let url = './../../../../assets/json/affiliate/commission/commission-tour.json';
    return this._http.get(url).map(result => result);
  }
}
