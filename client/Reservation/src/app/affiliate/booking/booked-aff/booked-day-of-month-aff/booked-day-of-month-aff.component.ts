import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from "@angular/router";
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Router } from '@angular/router';
import "rxjs/Rx";

import { BookedDayOfMonthAffService } from './booked-day-of-month-aff.service';

@Component({
  selector: 'app-booked-day-of-month-aff',
  templateUrl: './booked-day-of-month-aff.component.html',
  styleUrls: ['./booked-day-of-month-aff.component.scss'],
  providers: [BookedDayOfMonthAffService]
})
export class BookedDayOfMonthAffComponent implements OnInit {

  constructor(
    private http: Http,
    private router: Router,
    private route: ActivatedRoute,
    private BookedDayOfMonthAffService: BookedDayOfMonthAffService
  ) { }

  public arrMonth = ['January','February','March','April','May','June','July','August','September','October','November','December'];
  public arrYear = ['2018','2019','2020'];
  public amount;

  // default valiable
  public bookedData = {
    token: "",
    month: "",
    year: ""
  };

  // Bar chart
  public barChartOptions:any = {
    scaleShowVerticalLines: false,
    responsive: true
  };

  public barChartData:any[];
  public barChartLabels:string[];
  public barChartType:string;
  public barChartLegend:boolean;
  public barChartColors:Array<any> = [
    { backgroundColor: '#0f4675'}
  ];

  // 1. print
  public print():void {
    window.print();
  }

  // 2. active menu
  public activeMenu(){
    // set storage
    sessionStorage.setItem('menu',JSON.stringify(1));
    sessionStorage.setItem('sub-menu',JSON.stringify(103));
  }

  // 3. get data binding
  public getBookedDayOfMonthData():void {
    this.BookedDayOfMonthAffService.getBookedDayOfMonth()
                    .subscribe(
                      data => [
                        // sessionStorage.removeItem('chart-data'),
                        sessionStorage.setItem('booked-day-chart',JSON.stringify(data))
                      ],
                      err => {console.log(err)}
                    );
    setTimeout(()=>{
      let _getData = JSON.parse(sessionStorage.getItem('booked-day-chart'));
      this.barChartData = _getData.booked;
      this.amount = _getData.amount;
    }, 200);
  }

  // 4. search data
  public searchData(){
    let url = 'http://localhost:9000/api/Dashboard/Affiliate/Booked/DaysOfMonth';
    // let url = 'http://api.tourinchiangmai.com/api/Dashboard/Affiliate/Booked/DaysOfMonth';
    let options = new RequestOptions();

    /*==================  Success  ===================*/
    this.bookedData.token = '1355102035';
    console.log(this.bookedData);
    this.http.post(url, this.bookedData, options)
                    .map(res => res.json())
                    .subscribe(
                      data => {console.log(data)},
                      err => {console.log(err)}
                    );
    // this.BookedDayOfMonthAffService.postBookedDayOfMonth(this.bookedData)
    //                 .subscribe(
    //                   data => {console.log(data)},
    //                   err => {console.log(err)}
    //                 );
    // console.log(this.bookedData);
  }

  ngOnInit() {
    // set default binding bar data
    this.barChartData = [
      {data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0], label: ''}
    ];
    this.barChartLabels = ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31'];
    this.barChartType = 'bar';
    this.barChartLegend = true;

    this.activeMenu();
    this.getBookedDayOfMonthData();
  }

}