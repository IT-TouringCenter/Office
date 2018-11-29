import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from "@angular/router";
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Router } from '@angular/router';
import "rxjs/Rx";

import { TourMonthlyAffService } from './tour-monthly-aff.service';

@Component({
  selector: 'app-tour-monthly-aff',
  templateUrl: './tour-monthly-aff.component.html',
  styleUrls: ['./tour-monthly-aff.component.scss'],
  providers: [TourMonthlyAffService]
})
export class TourMonthlyAffComponent implements OnInit {

  constructor(
    private http: Http,
    private router: Router,
    private route: ActivatedRoute,
    private TourMonthlyAffService: TourMonthlyAffService
  ) { }

  public tours = <any>[];
  public amount = [];

  // default valiable
  public tourData = {
    token: <any>"",
    type: <any>"",
    tourId: <any>"1",
    year: <any>""
  };

  public arrMonth = <any>['January','February','March','April','May','June','July','August','September','October','November','December'];
  // public arrYear = ['2018','2019','2020'];
  public arrYear = <any>[];

  // Bar chart (month)
  public barChartOptions:any = {
    scaleShowVerticalLines: false,
    responsive: true
  };
  public barChartData:any[];
  public barChartLabels:string[];
  public barChartType:string;
  public barChartLegend:boolean;
  public barChartColors:Array<any> = [
    {
      backgroundColor: 'rgba(77,83,96,0.2)',
      borderColor: 'rgba(77,83,96,1)',
      pointBackgroundColor: 'rgba(77,83,96,1)',
      pointBorderColor: '#fff',
      pointHoverBackgroundColor: '#fff',
      pointHoverBorderColor: 'rgba(77,83,96,1)'
    },
    {
      backgroundColor: 'rgba(77,83,96,0.2)',
      borderColor: 'rgba(77,83,96,0.5)',
      pointBackgroundColor: 'rgba(77,83,96,0.5)',
      pointBorderColor: '#fff',
      pointHoverBackgroundColor: '#fff',
      pointHoverBorderColor: 'rgba(77,83,96,0.5)'
    }
  ];

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
    console.log(this.arrYear);
  }

  // get tour
  public getTour(){
    let url = 'http://localhost:9000/api/Tours/GetTourData';
    // let url = 'http://api.tourinchiangmai.com/api/Tours/GetTourData';
    this.http.get(url)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        this.tours = data
                      ],
                      err => {console.log(err)}
                    );
  }

  // 1. print
  public print():void {
    window.print();
  }

  // 2. active menu
  public activeMenu(){
    // set storage
    sessionStorage.setItem('menu',JSON.stringify(3));
    sessionStorage.setItem('sub-menu',JSON.stringify(303));
  }

  // 3. get data binding
  public getTourMonthlyData() {
    let url = 'http://localhost:9000/api/Dashboard/Affiliate/Tour/Monthly';
    // let url = 'http://api.tourinchiangmai.com/api/Dashboard/Affiliate/Tour/Monthly';
    let options = new RequestOptions();

    // set time
    let getDate = new Date();
    let getYear = getDate.getFullYear();

    for(let i=0;i<this.arrYear.length;i++){
      if(getYear == this.arrYear[i]){
        this.tourData.year = this.arrYear[i];
      }
    }

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
                        sessionStorage.setItem('tour-monthly-chart',JSON.stringify(data))
                      ],
                      err => {console.log(err)}
                    );
    setTimeout(()=>{
      let _getData = JSON.parse(sessionStorage.getItem('tour-monthly-chart'));
      this.barChartData = _getData.booked;
      this.amount = _getData.amount;
    }, 500);
  }

  // 4. search data
  public searchData(){
    let url = 'http://localhost:9000/api/Dashboard/Affiliate/Tour/Monthly';
    // let url = 'http://api.tourinchiangmai.com/api/Dashboard/Affiliate/Tour/Monthly';
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
                        sessionStorage.setItem('tour-monthly-chart',JSON.stringify(data))
                      ],
                      err => {console.log(err)}
                    );
    setTimeout(()=>{
      let _getData = JSON.parse(sessionStorage.getItem('tour-monthly-chart'));
      this.barChartData = _getData.booked;
      this.amount = _getData.amount;
    }, 500);
  }

  ngOnInit() {
    // binding bar data (month)
    this.barChartData = [
      {data: [0,0,0,0,0,0,0,0,0,0,0,0], label: '', total: 0},
      {data: [0,0,0,0,0,0,0,0,0,0,0,0], label: '', total: 0}
    ];
    this.barChartLabels = this.arrMonth;
    this.barChartType = 'line';
    this.barChartLegend = true;

    this.getTour();
    this.setDefaultYear();
    this.activeMenu();
    this.getTourMonthlyData();
  }

}