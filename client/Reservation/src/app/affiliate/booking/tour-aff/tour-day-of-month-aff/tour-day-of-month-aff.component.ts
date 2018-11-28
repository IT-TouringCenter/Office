import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from "@angular/router";
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Router } from '@angular/router';
import "rxjs/Rx";

import { TourDayOfMonthAffService } from './tour-day-of-month-aff.service';

@Component({
  selector: 'app-tour-day-of-month-aff',
  templateUrl: './tour-day-of-month-aff.component.html',
  styleUrls: ['./tour-day-of-month-aff.component.scss'],
  providers: [TourDayOfMonthAffService]
})
export class TourDayOfMonthAffComponent implements OnInit {

  constructor(
    private http: Http,
    private router: Router,
    private route: ActivatedRoute,
    private TourDayOfMonthAffService: TourDayOfMonthAffService
  ) { }

  public tours = [];
  public amount = [];

  // default valiable
  public bookedData = {
    token: <any>"",
    type: <any>"",
    tourId: <any>"",
    month: <any>"",
    year: <any>""
  };

  public arrMonth = ['January','February','March','April','May','June','July','August','September','October','November','December'];
  public arrYear = ['2018','2019','2020'];

  // Bar chart (day)
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

  // 1. print
  public print():void {
    window.print();
  }

  // 2. active menu
  public activeMenu(){
    // set storage
    sessionStorage.setItem('menu',JSON.stringify(3));
    sessionStorage.setItem('sub-menu',JSON.stringify(302));
  }

  // 3. get data binding
  public getTourDaysOfMonthData() {
    this.TourDayOfMonthAffService.getTourDayOfMonth()
                    .subscribe(
                      data => [
                        // sessionStorage.removeItem('chart-data'),
                        sessionStorage.setItem('tour-day-chart',JSON.stringify(data))
                      ],
                      err => {console.log(err)}
                    );
    setTimeout(()=>{
      let _getData = JSON.parse(sessionStorage.getItem('tour-day-chart'));
      this.barChartData = _getData.booked;
      this.tours = _getData.tours;
      this.amount = _getData.amount;
    }, 200);
  }

  // 4. search data
  public searchData(){
    let url = 'http://localhost:9000/api/Dashboard/Affiliate/Booked/DaysOfMonth';
    // let url = 'http://api.tourinchiangmai.com/api/Dashboard/Affiliate/Booked/DaysOfMonth';
    let options = new RequestOptions();

    // get token from session
    let getToken = JSON.parse(sessionStorage.getItem('users'));
    if(getToken==null || getToken==undefined || getToken==''){
      this.bookedData.token = 0;
      this.bookedData.type = 0;
    }else{
      this.bookedData.token = getToken.data.token;
      this.bookedData.type = getToken.data.userType;
    }

    /*==================  Success  ===================*/
    console.log(this.bookedData);
    this.http.post(url, this.bookedData, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        console.log(data),
                        sessionStorage.setItem('tour-day-chart',JSON.stringify(data))
                      ],
                      err => {console.log(err)}
                    );
    setTimeout(()=>{
      let _getData = JSON.parse(sessionStorage.getItem('tour-day-chart'));
      this.barChartData = _getData.booked;
      this.amount = _getData.amount;
    }, 1500);
  }

  ngOnInit() {
    // binding bar data (day)
    this.barChartData = [
      {data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0], label: '', total: 0},
      {data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0], label: '', total: 0}
    ];
    this.barChartLabels = ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31'];
    this.barChartType = 'line';
    this.barChartLegend = true;

    this.activeMenu();
    this.getTourDaysOfMonthData();
  }

}