import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from "@angular/router";
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Router } from '@angular/router';
import "rxjs/Rx";

import { BookedAffService } from './booked-aff.service';

@Component({
  selector: 'app-booked-aff',
  templateUrl: './booked-aff.component.html',
  styleUrls: ['./booked-aff.component.scss'],
  providers: [BookedAffService]
})
export class BookedAffComponent implements OnInit {

  constructor(
    private http: Http,
    private router: Router,
    private route: ActivatedRoute,
    private BookedAffService: BookedAffService
  ) { }

  public amount;

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
    sessionStorage.setItem('sub-menu',JSON.stringify(102));
  }

  // 3. switch button
  // 3.1 get all booked data
  public allBooked():void {
    // let url = 'http://localhost:9000/api/Dashboard/Affiliate/Booked/Summary';
    let url = 'http://api.tourinchiangmai.com/api/Dashboard/Affiliate/Booked/Summary';
    // let url = './../../../../assets/json/affiliate/booked/booked-summary-all.json';

    let _getUserData = JSON.parse(sessionStorage.getItem('users'));
    let postData = {
      token : _getUserData.data.token,
      type : _getUserData.data.userType
    };
    let options = new RequestOptions();
    this.http.post(url, postData, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        sessionStorage.setItem('booked-sum-all',JSON.stringify(data)),
                      ],
                      err => console.log("Error :: " + err)
                    );
    setTimeout(()=>{
      let _getData = JSON.parse(sessionStorage.getItem('booked-sum-all'));
      this.barChartData = _getData.booked;
      this.amount = _getData.amount;
    }, 500);
  }

  // 3.2 get this month booked data
  public monthBooked():void {
    // let url = 'http://localhost:9000/api/Dashboard/Affiliate/Booked/Summary/Month';
    let url = 'http://api.tourinchiangmai.com/api/Dashboard/Affiliate/Booked/Summary/Month';
    // let url = './../../../../assets/json/affiliate/booked/booked-summary-month.json';

    let _getUserData = JSON.parse(sessionStorage.getItem('users'));
    let postData = {
      token : _getUserData.data.token,
      type : _getUserData.data.userType
    };
    let options = new RequestOptions();
    this.http.post(url, postData, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        sessionStorage.setItem('booked-sum-month',JSON.stringify(data)),
                      ],
                      err => console.log("Error :: " + err)
                    );
    setTimeout(()=>{
      let _getData = JSON.parse(sessionStorage.getItem('booked-sum-month'));
      this.barChartData = _getData.booked;
      this.amount = _getData.amount;
    }, 500);
  }

  // 3.3 get this year booked data
  public yearBooked():void {
    // let url = 'http://localhost:9000/api/Dashboard/Affiliate/Booked/Summary/Year';
    let url = 'http://api.tourinchiangmai.com/api/Dashboard/Affiliate/Booked/Summary/Year';
    // let url = './../../../../assets/json/affiliate/booked/booked-summary-year.json';

    let _getUserData = JSON.parse(sessionStorage.getItem('users'));
    let postData = {
      token : _getUserData.data.token,
      type : _getUserData.data.userType
    };
    let options = new RequestOptions();
    this.http.post(url, postData, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        sessionStorage.setItem('booked-sum-year',JSON.stringify(data)),
                      ],
                      err => console.log("Error :: " + err)
                    );
    setTimeout(()=>{
      let _getData = JSON.parse(sessionStorage.getItem('booked-sum-year'));
      this.barChartData = _getData.booked;
      this.amount = _getData.amount;
    }, 500);
  }

  ngOnInit() {
    // set default binding bar data
    this.barChartData = [
      {data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0], label: 'Summary'}
    ];
    this.amount = 0;
    this.barChartLabels = ['TC-01','TC-02','TC-03','TC-04','TC-05A','TC-05E','TC-06','TC-07','TC-08','TC-09','TC-10','TC-11','TC-12','TC-S01','TC-S02M','TC-S02A'];
    this.barChartType = 'bar';
    this.barChartLegend = true;

    this.activeMenu();
    this.allBooked();
  }

}