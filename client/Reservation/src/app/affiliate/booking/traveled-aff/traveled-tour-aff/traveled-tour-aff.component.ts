import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from "@angular/router";
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Router } from '@angular/router';
import "rxjs/Rx";

import { TraveledTourAffService } from './traveled-tour-aff.service';

@Component({
  selector: 'app-traveled-tour-aff',
  templateUrl: './traveled-tour-aff.component.html',
  styleUrls: ['./traveled-tour-aff.component.scss'],
  providers: [TraveledTourAffService]
})
export class TraveledTourAffComponent implements OnInit {

  constructor(
    private http: Http,
    private router: Router,
    private route: ActivatedRoute,
    private TraveledTourAffService: TraveledTourAffService
  ) { }

  public tours = [];
  public amount;

  // default valiable
  public tourData = {
    token: <any>"",
    type: <any>"",
    tourId: <any>"1"
  };

  public arrMonth = ['January','February','March','April','May','June','July','August','September','October','November','December'];
  // public arrYear = <any>['2018','2019','2020'];
  public arrYear = <any>[];

  // Bar chart (all)
  public barChartOptions:any = {
    scaleShowVerticalLines: false,
    responsive: true
  };
  public barChartData:any[];
  public barChartLabels:any[];
  public barChartType:string;
  public barChartLegend:boolean;
  public barChartColors:Array<any> = [];

  // 
  public setDefaultYear(){
    // set year
    let getYear = new Date();
    let yearStart = 2018;
    let yearNow = getYear.getFullYear();
    let yearDif = yearNow - yearStart;
    for(let i=0;i<=yearDif;i++){
      let newYear = yearStart+i;
      this.arrYear.push(newYear.toString());
    }
    this.barChartLabels = this.arrYear;
  }

  // get tour
  public getTour(){
    let url = 'http://localhost:9000/api/Tours/GetTourData';
    // let url = 'http://api.tourinchiangmai.com/api/Tours/GetTourData';
    this.http.get(url)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        console.log(data),
                        this.tours = data,
                        // sessionStorage.setItem('traveled-tour-chart',JSON.stringify(data))
                      ],
                      err => {console.log(err)}
                    );
    console.log(this.tourData.tourId);
  }

  // 1. print
  public print():void {
    window.print();
  }

  // 2. active menu
  public activeMenu(){
    // set storage
    sessionStorage.setItem('menu',JSON.stringify(2));
    sessionStorage.setItem('sub-menu',JSON.stringify(204));
  }

  // 3. get data binding
  public getTraveledTourData(){
    let url = 'http://localhost:9000/api/Dashboard/Affiliate/Traveled/Tour';
    // let url = 'http://api.tourinchiangmai.com/api/Dashboard/Affiliate/Traveled/Tour';
    let options = new RequestOptions();

    // get token from session
    let getToken = JSON.parse(sessionStorage.getItem('users'));
    if(getToken==null || getToken==undefined || getToken==''){
      this.tourData.token = 0;
      this.tourData.type = 0;
    }else{
      this.tourData.token = getToken.data.token;
      this.tourData.type = getToken.data.userType;
    }

    /*==================  Success  ===================*/
    console.log(this.tourData);
    this.http.post(url, this.tourData, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        console.log(data),
                        sessionStorage.setItem('traveled-tour-chart',JSON.stringify(data))
                      ],
                      err => {console.log(err)}
                    );

    // set default traveled tour data
    let _arrData = [];
    let _count = this.arrYear.length;
    for(let x=0; x<_count; x++){
      _arrData.push(0);
    }

    let _data = {data: _arrData, label: '', total: ''};
    let arrData = <any>[];
    for(let i=0; i<1; i++){
      arrData.push(_data);
    }
    this.barChartData = arrData;
    this.barChartLabels = this.arrYear;
    this.barChartType = 'pie';
    this.barChartLegend = true;

    setTimeout(()=>{
      let _getData = JSON.parse(sessionStorage.getItem('traveled-tour-chart'));
      this.barChartData = _getData.booked;
      this.amount = _getData.amount;
    },500);
  }

  // 3. get data binding
  public searchData(){
    let url = 'http://localhost:9000/api/Dashboard/Affiliate/Traveled/Tour';
    // let url = 'http://api.tourinchiangmai.com/api/Dashboard/Affiliate/Traveled/Tour';
    let options = new RequestOptions();

    // get token from session
    let getToken = JSON.parse(sessionStorage.getItem('users'));
    if(getToken==null || getToken==undefined || getToken==''){
      this.tourData.token = 0;
      this.tourData.type = 0;
    }else{
      this.tourData.token = getToken.data.token;
      this.tourData.type = getToken.data.userType;
    }

    /*==================  Success  ===================*/
    console.log(this.tourData);
    this.http.post(url, this.tourData, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        // console.log(data),
                        sessionStorage.setItem('traveled-tour-chart',JSON.stringify(data))
                      ],
                      err => {console.log(err)}
                    );

    setTimeout(()=>{
      let _getData = JSON.parse(sessionStorage.getItem('traveled-tour-chart'));
      this.barChartData = _getData.booked;
      this.amount = _getData.amount;
    },500);
  }

  ngOnInit() {
    this.setDefaultYear();
    this.getTour();
    // get data
    this.activeMenu();
    this.getTraveledTourData();
  }

}