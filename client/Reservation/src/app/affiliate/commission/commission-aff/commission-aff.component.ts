import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from "@angular/router";
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Router } from '@angular/router';
import "rxjs/Rx";

import { CommissionAffService } from './commission-aff.service';

@Component({
  selector: 'app-commission-aff',
  templateUrl: './commission-aff.component.html',
  styleUrls: ['./commission-aff.component.scss'],
  providers: [CommissionAffService]
})
export class CommissionAffComponent implements OnInit {

  constructor(
    private http: Http,
    private router: Router,
    private route: ActivatedRoute,
    private CommissionAffService: CommissionAffService
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
  public barChartColors:Array<any> = [];

  // 1. print
  public print():void {
    window.print();
  }

  // 2. active menu
  public activeMenu(){
    // set storage
    sessionStorage.setItem('menu',JSON.stringify(4));
    sessionStorage.setItem('sub-menu',JSON.stringify(401));
  }

  // 3. get data binding
  public getCommissionData() {
    let url = 'http://localhost:9000/api/Dashboard/Affiliate/Commission/Summary';
    // let url = 'http://api.tourinchiangmai.com/api/Dashboard/Affiliate/Commission/Summary';
    // let url = './../../../../assets/json/affiliate/commission/commission.json';

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
                        sessionStorage.setItem('commission-chart',JSON.stringify(data)),
                      ],
                      err => console.log("Error :: " + err)
                    );

    setTimeout(()=>{
      let _getData = JSON.parse(sessionStorage.getItem('commission-chart'));
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
    this.getCommissionData();
  }
}