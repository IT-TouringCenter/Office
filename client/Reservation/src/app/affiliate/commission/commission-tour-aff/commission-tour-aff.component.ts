import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from "@angular/router";
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Router } from '@angular/router';
import "rxjs/Rx";

import { CommissionTourAffService } from './commission-tour-aff.service';

@Component({
  selector: 'app-commission-tour-aff',
  templateUrl: './commission-tour-aff.component.html',
  styleUrls: ['./commission-tour-aff.component.scss'],
  providers: [CommissionTourAffService]
})
export class CommissionTourAffComponent implements OnInit {

  constructor(
    private http: Http,
    private router: Router,
    private route: ActivatedRoute,
    private CommissionTourAffService: CommissionTourAffService
  ) { }

  public arrMonth = ['January','February','March','April','May','June','July','August','September','October','November','December'];
  public arrYear = ['2018','2019','2020'];

  public tours = [];
  public amount = [];

  // default valiable
  public commissionData = {
    token: <any>"",
    type: <any>""
  };

  // Bar chart (all)
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

  // 1. print
  public print():void {
    window.print();
  }

  // 2. active menu
  public activeMenu(){
    // set storage
    sessionStorage.setItem('menu',JSON.stringify(4));
    sessionStorage.setItem('sub-menu',JSON.stringify(404));
  }

  // 3. get data binding
  public getCommissionTourData() {
    let url = 'http://localhost:9000/api/Dashboard/Affiliate/Commission/Tour';
    // let url = 'http://api.tourinchiangmai.com/api/Dashboard/Affiliate/Commission/Tour';
    let options = new RequestOptions();

    // set time
    let getDate = new Date();
    let getYear = getDate.getFullYear();

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
                        sessionStorage.setItem('commission-tour-chart',JSON.stringify(data))
                      ],
                      err => {console.log(err)}
                    );
    setTimeout(()=>{
      let _getData = JSON.parse(sessionStorage.getItem('commission-tour-chart'));
      this.barChartData = _getData.booked;
      this.amount = _getData.amount;
    }, 500);
  }

  ngOnInit() {
    // binding bar data
    this.barChartData = [
      {data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0], label: ''}
    ];

    this.barChartLabels = ['TC-01','TC-02','TC-03','TC-04','TC-05A','TC-05E','TC-06','TC-07','TC-08','TC-09','TC-10','TC-11','TC-12','TC-S01','TC-S02M','TC-S02A'];
    this.barChartType = 'bar';
    this.barChartLegend = true;

    this.activeMenu();
    this.getCommissionTourData();
  }

}