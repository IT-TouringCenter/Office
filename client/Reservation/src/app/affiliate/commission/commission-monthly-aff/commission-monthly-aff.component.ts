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

  public arrMonth = ['January','February','March','April','May','June','July','August','September','October','November','December'];
  public arrYear = ['2018','2019','2020'];

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
    sessionStorage.setItem('sub-menu',JSON.stringify(403));
  }

  // 3. get data binding
  public getCommissionMonthlyData() {
    this.CommissionMonthlyAffService.getCommissionMonthly()
                    .subscribe(
                      data => [
                        // sessionStorage.removeItem('chart-data'),
                        sessionStorage.setItem('commission-monthly-chart',JSON.stringify(data))
                      ],
                      err => {console.log(err)}
                    );
    setTimeout(()=>{
      let _getData = JSON.parse(sessionStorage.getItem('commission-monthly-chart'));
      this.barChartData = _getData.booked;
      this.amount = _getData.amount;
    }, 200);
  }

  ngOnInit() {
    // binding bar data
    this.barChartData = [
      {data: [0,0,0,0,0,0,0,0,0,0,0,0], label: ''}
    ];
    this.barChartLabels = this.arrMonth;
    this.barChartType = 'line';
    this.barChartLegend = true;

    this.activeMenu();
    this.getCommissionMonthlyData();
  }

}