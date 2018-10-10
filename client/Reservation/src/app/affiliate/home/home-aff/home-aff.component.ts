import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from "@angular/router";
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Router } from '@angular/router';
import "rxjs/Rx";

@Component({
  selector: 'app-home-aff',
  templateUrl: './home-aff.component.html',
  styleUrls: ['./home-aff.component.scss'],
  providers: []
})
export class HomeAffComponent implements OnInit {

  constructor(
    private http: Http,
    private router: Router,
    private route: ActivatedRoute
  ) { }

  dataDashboard = {};
  dataBooked = {};
  dataCommission = {};

  // 1. get data dashboard
  getDataDashboard(){
    // let url = 'http://localhost:9000/api/Account/Request/AccountForgotPassword';
    // let url = 'http://api.tourinchiangmai.com/api/Account/Request/AccountForgotPassword';
    let url = './../../../../assets/json/affiliate/dashboard/dashboard.json';

    return this.http.get(url)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        console.log(data),
                        this.dataDashboard = data
                      ],
                      err => {console.log(err)}
                    );
  }

  // 2. get data booked statistics
  getDataBooked(){
    // let url = 'http://localhost:9000/api/Account/Request/AccountForgotPassword';
    // let url = 'http://api.tourinchiangmai.com/api/Account/Request/AccountForgotPassword';
    let url = './../../../../assets/json/affiliate/dashboard/dashboard-booked.json';

    return this.http.get(url)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        console.log(data),
                        this.dataBooked = data
                      ],
                      err => {console.log(err)}
                    );
  }

  // 3. get data commission
  getDataCommission(){
    // let url = 'http://localhost:9000/api/Account/Request/AccountForgotPassword';
    // let url = 'http://api.tourinchiangmai.com/api/Account/Request/AccountForgotPassword';
    let url = './../../../../assets/json/affiliate/dashboard/dashboard-commission.json';

    return this.http.get(url)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        console.log(data),
                        this.dataCommission = data
                      ],
                      err => {console.log(err)}
                    );
  }

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
    { // grey
      backgroundColor: 'rgba(148,159,177,1)',
    },
    { // dark grey
      backgroundColor: 'rgba(77,83,96,1)',
    },
    { // grey
      backgroundColor: 'rgba(148,159,177,1)',
    }
  ];

  // line Chart
  public lineChartData:Array<any>;
  public lineChartLabels:Array<any>;
  public lineChartType:string;
  public lineChartLegend:boolean;
  public lineChartColors:Array<any> = [
    { // dark grey
      backgroundColor: 'rgba(77,83,96,0.2)',
      borderColor: 'rgba(77,83,96,1)',
      pointBackgroundColor: 'rgba(77,83,96,1)',
      pointBorderColor: '#fff',
      pointHoverBackgroundColor: '#fff',
      pointHoverBorderColor: 'rgba(77,83,96,1)'
    },
    { // dark grey
      backgroundColor: 'rgba(77,83,96,0.4)',
      borderColor: 'rgba(77,83,96,0.4)',
      pointBackgroundColor: 'rgba(77,83,96,1)',
      pointBorderColor: '#fff',
      pointHoverBackgroundColor: '#fff',
      pointHoverBorderColor: 'rgba(77,83,96,0.4)'
    },
    { // grey
      backgroundColor: 'rgba(148,159,177,0.2)',
      borderColor: 'rgba(148,159,177,1)',
      pointBackgroundColor: 'rgba(148,159,177,1)',
      pointBorderColor: '#fff',
      pointHoverBackgroundColor: '#fff',
      pointHoverBorderColor: 'rgba(148,159,177,0.8)'
    },
    { // grey
      backgroundColor: 'rgba(148,159,177,0.5)',
      borderColor: 'rgba(148,159,177,0.5)',
      pointBackgroundColor: 'rgba(148,159,177,1)',
      pointBorderColor: '#fff',
      pointHoverBackgroundColor: '#fff',
      pointHoverBorderColor: 'rgba(148,159,177,0.5)'
    },
  ];

  // events
  // public chartClicked(e:any):void {
  //   console.log(e);
  // }

  // public chartHovered(e:any):void {
  //   console.log(e);
  // }

  // public randomize():void {
  //   let data = [100, 85, 64, 48, 78, 69, 52, 124, 25, 85, 86, 98]
  //   let clone = JSON.parse(JSON.stringify(this.barChartData));
  //   clone[0].data = data;
  //   this.barChartData = clone;
  // }

  // active menu
  public activeMenu(){
    // set storage
    sessionStorage.setItem('menu',JSON.stringify(0));
    sessionStorage.setItem('sub-menu',JSON.stringify(0));
  }

  ngOnInit() {
    // get data
    this.getDataDashboard();
    this.getDataBooked();
    this.getDataCommission();

    // binding bar data
    this.barChartData = [
      {data: [38, 45, 56, 58, 30, 46, 57, 49, 39, 0, 0, 0], label: 'Booked'},
      {data: [28, 38, 40, 19, 46, 27, 40, 38, 2, 0, 0, 0], label: 'Traveling'},
      {data: [5, 8, 15, 0, 1, 3, 5, 0, 0, 0, 0, 0], label: 'Cancel'}
    ];
    this.barChartLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    this.barChartType = 'bar';
    this.barChartLegend = true;

    // binding line data
    this.lineChartData = [
      {data: [3350, 4790, 3550, 2550, 3540, 3580, 5400, 3500, 1650, 8430, 4390, 1770], label: '2015'},
      {data: [6500, 5900, 8000, 8010, 5600, 5500, 4000, 5000, 6500, 4300, 4900, 7700], label: '2016'},
      {data: [2800, 4800, 4000, 1900, 8600, 2700, 9000, 8700, 5800, 6800, 4200, 3800], label: '2017'},
      {data: [10000, 8500, 11500, 7870, 9800, 6855, 5800, 6500, 0, 0, 0, 0], label: '2018'}
    ];
    this.lineChartLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    this.lineChartType = 'line';
    this.lineChartLegend = true;

    this.activeMenu();
  }

}