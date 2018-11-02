import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from "@angular/router";
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Router } from '@angular/router';
import "rxjs/Rx";

import { TourAffService } from './tour-aff.service';

@Component({
  selector: 'app-tour-aff',
  templateUrl: './tour-aff.component.html',
  styleUrls: ['./tour-aff.component.scss'],
  providers: [TourAffService]
})
export class TourAffComponent implements OnInit {

  constructor(
    private http: Http,
    private router: Router,
    private route: ActivatedRoute,
    private TourAffService: TourAffService
  ) { }

  public tours = [];
  public amount;
  public arrMonth = ['January','February','March','April','May','June','July','August','September','October','November','December'];
  public arrYear = ['2018','2019','2020'];

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
    { backgroundColor: 'rgba(77,83,96,0.8)',
      borderColor: 'rgba(77,83,96,1)',
      pointBackgroundColor: 'rgba(77,83,96,1)',
      pointBorderColor: '#fff',
      pointHoverBackgroundColor: '#fff',
      pointHoverBorderColor: 'rgba(77,83,96,1)' }
  ];

  // Pie chart (all)
  public pieChartOptions:any = {
    scaleShowVerticalLines: false,
    responsive: true
  };
  public pieChartData:any[];
  public pieChartLabels:string[];
  public pieChartType:string;
  public pieChartLegend:boolean;
  public pieChartColors:Array<any> = [];

  // 1. print
  public print():void {
    window.print();
  }

  // 2. active menu
  public activeMenu(){
    // set storage
    sessionStorage.setItem('menu',JSON.stringify(3));
    sessionStorage.setItem('sub-menu',JSON.stringify(301));
  }

  // 3. get data binding
  public getTourData() {
    this.TourAffService.getTour()
                    .subscribe(
                      data => [
                        // sessionStorage.removeItem('chart-data'),
                        sessionStorage.setItem('tour-chart',JSON.stringify(data))
                      ],
                      err => {console.log(err)}
                    );
    setTimeout(()=>{
      let _getData = JSON.parse(sessionStorage.getItem('tour-chart'));
      this.barChartData = _getData.booked;
      this.tours = _getData.tours;
      this.amount = _getData.amount;
    }, 200);
  }

  ngOnInit() {
    // set default binding bar chart
    this.barChartData = [
      {data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0], label: 'Summary'}
    ];
    this.barChartLabels = ['TC-01','TC-02','TC-03','TC-04','TC-05A','TC-05E','TC-06','TC-07','TC-08','TC-09','TC-10','TC-11','TC-12','TC-S01','TC-S02M','TC-S02A'];
    this.barChartType = 'bar';
    this.barChartLegend = true;

    this.activeMenu();
    this.getTourData();
  }

}