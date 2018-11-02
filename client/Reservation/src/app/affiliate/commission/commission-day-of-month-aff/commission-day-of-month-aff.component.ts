import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from "@angular/router";
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Router } from '@angular/router';
import "rxjs/Rx";

import { CommissionDayOfMonthAffService } from './commission-day-of-month-aff.service';

@Component({
  selector: 'app-commission-day-of-month-aff',
  templateUrl: './commission-day-of-month-aff.component.html',
  styleUrls: ['./commission-day-of-month-aff.component.scss'],
  providers: [CommissionDayOfMonthAffService]
})
export class CommissionDayOfMonthAffComponent implements OnInit {

  constructor(
    private http: Http,
    private router: Router,
    private route: ActivatedRoute,
    private CommissionDayOfMonthAffService: CommissionDayOfMonthAffService
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
    sessionStorage.setItem('sub-menu',JSON.stringify(402));
  }

  // 3. get data binding
  public getCommissionDayOfMonthData() {
    this.CommissionDayOfMonthAffService.getCommissionDayOfMonth()
                    .subscribe(
                      data => [
                        // sessionStorage.removeItem('chart-data'),
                        sessionStorage.setItem('commission-day-chart',JSON.stringify(data))
                      ],
                      err => {console.log(err)}
                    );
    setTimeout(()=>{
      let _getData = JSON.parse(sessionStorage.getItem('commission-day-chart'));
      this.barChartData = _getData.booked;
      this.amount = _getData.amount;
    }, 200);
  }

  ngOnInit() {
    // binding bar data
    this.barChartData = [
      {data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0], label: ''}
    ];
    this.barChartLabels = ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31'];
    this.barChartType = 'line';
    this.barChartLegend = true;

    this.activeMenu();
    this.getCommissionDayOfMonthData();
  }

}