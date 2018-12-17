import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from "@angular/router";
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Router } from '@angular/router';
import "rxjs/Rx";

import { CommissionMonthlyAffService } from './commission-monthly-aff.service';

@Component({
  selector: 'app-commission-monthly-aff',
  templateUrl: './commission-monthly-aff.component.html',
  styleUrls: ['./commission-monthly-aff.component.scss'],
  providers: [CommissionMonthlyAffService]
})
export class CommissionMonthlyAffComponent implements OnInit {

  constructor(
    private http: Http,
    private router: Router,
    private route: ActivatedRoute,
    private CommissionMonthlyAffService: CommissionMonthlyAffService
  ) { }

  public arrMonth = <any>['January','February','March','April','May','June','July','August','September','October','November','December'];
  // public arrYear = <any>['2018','2019','2020'];
  public arrYear = <any>[];

  public amount;

  // default valiable
  public commissionData = {
    token: <any>"",
    type: <any>"",
    year: <any>""
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
    // { backgroundColor: '#0f4675'}
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

  // 1. print
  public print():void {
    window.print();
  }

  // 2. active menu
  public activeMenu(){
    // set storage
    sessionStorage.setItem('menu',JSON.stringify(4));
    sessionStorage.setItem('sub-menu',JSON.stringify(403));
  }

  // 3. get data binding
  public getCommissionMonthlyData() {
    // let url = 'http://localhost:9000/api/Dashboard/Affiliate/Commission/Monthly';
    let url = 'http://api.tourinchiangmai.com/api/Dashboard/Affiliate/Commission/Monthly';
    let options = new RequestOptions();

    // set time
    let getDate = new Date();
    let getYear = getDate.getFullYear();

    for(let i=0;i<this.arrYear.length;i++){
      if(getYear == this.arrYear[i]){
        this.commissionData.year = this.arrYear[i];
      }
    }

    // get token from session
    let getToken = JSON.parse(sessionStorage.getItem('users'));
    if(getToken==null || getToken==undefined || getToken==''){
      this.commissionData.token = 0;
      this.commissionData.type = 0;
    }else{
      this.commissionData.token = getToken.data.token;
      this.commissionData.type = getToken.data.userType;
    }

    /*==================  Success  ===================*/
    console.log(this.commissionData);
    this.http.post(url, this.commissionData, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        sessionStorage.setItem('commission-monthly-chart',JSON.stringify(data))
                      ],
                      err => {console.log(err)}
                    );
    setTimeout(()=>{
      let _getData = JSON.parse(sessionStorage.getItem('commission-monthly-chart'));
      this.barChartData = _getData.booked;
      this.amount = _getData.amount;
    }, 500);
  }

  // 4. search data
  public searchData(){
    // let url = 'http://localhost:9000/api/Dashboard/Affiliate/Commission/Monthly';
    let url = 'http://api.tourinchiangmai.com/api/Dashboard/Affiliate/Commission/Monthly';
    let options = new RequestOptions();

    // get token from session
    let getToken = JSON.parse(sessionStorage.getItem('users'));
    if(getToken==null || getToken==undefined || getToken==''){
      this.commissionData.token = 0;
      this.commissionData.type = 0;
    }else{
      this.commissionData.token = getToken.data.token;
      this.commissionData.type = getToken.data.userType;
    }

    /*==================  Success  ===================*/
    console.log(this.commissionData);
    this.http.post(url, this.commissionData, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        sessionStorage.setItem('commission-monthly-chart',JSON.stringify(data))
                      ],
                      err => {console.log(err)}
                    );
    setTimeout(()=>{
      let _getData = JSON.parse(sessionStorage.getItem('commission-monthly-chart'));
      this.barChartData = _getData.booked;
      this.amount = _getData.amount;
    }, 500);
  }

  ngOnInit() {
    // binding bar data
    this.barChartData = [
      {data: [0,0,0,0,0,0,0,0,0,0,0,0], label: ''}
    ];
    this.barChartLabels = this.arrMonth;
    this.barChartType = 'line';
    this.barChartLegend = true;

    this.setDefaultYear();
    this.activeMenu();
    this.getCommissionMonthlyData();
  }

}