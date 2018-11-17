import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from "@angular/router";
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Router } from '@angular/router';
import "rxjs/Rx";

import { HomeAffService } from './home-aff.service';

@Component({
  selector: 'app-home-aff',
  templateUrl: './home-aff.component.html',
  styleUrls: ['./home-aff.component.scss'],
  providers: [HomeAffService]
})
export class HomeAffComponent implements OnInit {

  constructor(
    private http: Http,
    private router: Router,
    private route: ActivatedRoute,
    private HomeAffService: HomeAffService
  ) { }

  dataDashboard = null;
  dataBooked = null;
  dataCommission = null;

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
      backgroundColor: 'rgba(108,99,97,0.5)',
    }
  ];

  // Line chart
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

  // 1. active menu
  public activeMenu(){
    // set storage
    sessionStorage.setItem('menu',JSON.stringify(0));
    sessionStorage.setItem('sub-menu',JSON.stringify(0));
    console.log('Active menu OK!');
  }

  // 2. get data dashboard
  public getDataDashboard(): void{
    this.HomeAffService.getDashboardData()
                      .subscribe(
                        resultArray => [
                          this.dataDashboard = resultArray
                        ],
                        error => console.log("Error :: " + error)
                      )
  }

  // 3. get data booked statistics
  public getDataBooked(): void{
    this.HomeAffService.getBookedData()
                      .subscribe(
                        resultArray => [
                          this.dataBooked = resultArray,
                          sessionStorage.setItem('booking-data',JSON.stringify(resultArray))
                        ],
                        error => console.log("Error :: " + error)
                      )

    // set default booked data
    let _data = {data: [0,0,0,0,0,0,0,0,0,0,0,0], label: '', total: ''};
    let arrData = <any>[];
    for(let i=0; i<3; i++){
      arrData.push(_data);
    }
    this.barChartData = arrData;
    this.barChartLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    this.barChartType = 'bar';
    this.barChartLegend = true;

    setTimeout(()=>{
      let _getData = JSON.parse(sessionStorage.getItem('booking-data'));
      this.barChartData = _getData.bookedStatistics;
    },200);
  }

  // 4. get data commission
  public getDataCommission(): void{
    // let url = 'http://localhost:9000/api/Dashboard/Affiliate';
    // let url = 'http://api.tourinchiangmai.com/api/Dashboard/Affiliate';
    let url = './../../../../assets/json/affiliate/dashboard/dashboard-commission.json';

    // set post data
    let _getUserData = JSON.parse(sessionStorage.getItem('users'));
    let postData = {
      token : _getUserData.data.token,
      type : _getUserData.data.userType
    };

    let options = new RequestOptions();
    this.http.post(url, postData, options)
                    .map(res => res.json())
                    .subscribe(
                      resultArray => [
                        this.dataCommission = resultArray,
                        sessionStorage.setItem('commission-data',JSON.stringify(resultArray)),
                      ],
                      error => console.log("Error :: " + error)
                    );
    // this.HomeAffService.getCommissionData()
    //                   .subscribe(
    //                     resultArray => [
    //                       this.dataCommission = resultArray,
    //                       sessionStorage.setItem('commission-data',JSON.stringify(resultArray)),
    //                     ],
    //                     error => console.log("Error :: " + error)
    //                   )
    // loop
    // set default commission data
    // set default booked data
    let _data = {data: [0,0,0,0,0,0,0,0,0,0,0,0], label: '', total: ''};
    let arrData = <any>[];
    for(let i=0; i<4; i++){
      arrData.push(_data);
    }
    this.lineChartData = arrData;
    // this.lineChartData = [{data: [0,0,0,0,0,0,0,0,0,0,0,0], label: '', total: ''},{data: [0,0,0,0,0,0,0,0,0,0,0,0], label: '', total: ''},{data: [0,0,0,0,0,0,0,0,0,0,0,0], label: '', total: ''},{data: [0,0,0,0,0,0,0,0,0,0,0,0], label: '', total: ''}];
    this.lineChartLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    this.lineChartType = 'line';
    this.lineChartLegend = true;

    setTimeout(()=>{
      let _getData = JSON.parse(sessionStorage.getItem('commission-data'));
      this.lineChartData = _getData.commission;
    },200);
  }

  ngOnInit() {
    sessionStorage.removeItem('chart-data'),

    // active menu
    this.activeMenu();

    // get data
    this.getDataDashboard();
    this.getDataBooked();
    this.getDataCommission();

    // }
  }

}