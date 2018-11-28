import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import 'rxjs/add/operator/map';

@Injectable()
export class TraveledTourAffService {

  constructor(
    private _http: HttpClient
  ) { }

  // traveled tour data
  getTraveledTour(){
    // let url = 'http://localhost:9000/api/';
    // let url = 'http://api.tourinchiangmai.com/api/';
    let url = "./../../../../assets/json/affiliate/traveled/traveled-tour.json";
    return this._http.get(url).map(result => result);
  }

  getTour(){
    let url = 'http://localhost:9000/api/Tours/GetTourData';
    // let url = 'http://api.tourinchiangmai.com/api/Tours/GetTourData';
    return this._http.get(url).map(result => result);
  }

}
