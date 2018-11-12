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

  public tours = [];
  public amount = [];

  public arrMonth = ['January','February','March','April','May','June','July','August','September','October','November','December'];
  public arrYear = ['2018','2019','2020'];

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
    this.TourMonthlyAffService.getTourMonthly()
                    .subscribe(
                      data => [
                        // sessionStorage.removeItem('chart-data'),
                        sessionStorage.setItem('tour-monthly-chart',JSON.stringify(data))
                      ],
                      err => {console.log(err)}
                    );
    setTimeout(()=>{
      let _getData = JSON.parse(sessionStorage.getItem('tour-monthly-chart'));
      this.barChartData = _getData.booked;
      this.tours = _getData.tours;
      this.amount = _getData.amount;
    }, 200);
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

    this.activeMenu();
    this.getTourMonthlyData();
  }

}