import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from "@angular/router";
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Router } from '@angular/router';
import "rxjs/Rx";

import { TraveledAffService } from './traveled-aff.service';

@Component({
  selector: 'app-traveled-aff',
  templateUrl: './traveled-aff.component.html',
  styleUrls: ['./traveled-aff.component.scss'],
  providers: [TraveledAffService]
})
export class TraveledAffComponent implements OnInit {

  constructor(
    private http: Http,
    private router: Router,
    private route: ActivatedRoute,
    private TraveledAffService: TraveledAffService
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
    { backgroundColor: '#6d0808'}
  ];

  // 1. print
  public print():void {
    window.print();
  }

  // 2. active menu
  public activeMenu(){
    // set storage
    sessionStorage.setItem('menu',JSON.stringify(2));
    sessionStorage.setItem('sub-menu',JSON.stringify(201));
  }

  // 3. get data binding
  public getTraveledData() {
    // let url = 'http://localhost:9000/api/Dashboard/Affiliate/Traveled';
    let url = 'http://api.tourinchiangmai.com/api/Dashboard/Affiliate/Traveled';
    // let url = './../../../../assets/json/affiliate/traveled/traveled-summary.json';

    // let _getUserData = JSON.parse(sessionStorage.getItem('users'));
    let _getUserData = JSON.parse(localStorage.getItem('users'));
    if(_getUserData==null || _getUserData==undefined || _getUserData==''){
      alert('Session expired!');
      this.router.navigate(['user/logout']);
    }

    let postData = {
      token : _getUserData.data.token,
      type : _getUserData.data.userType
    };
    let options = new RequestOptions();
    this.http.post(url, postData, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        sessionStorage.setItem('traveled-chart',JSON.stringify(data)),
                        this.setTraveledData()
                      ],
                      err => console.log("Error :: " + err)
                    );
    // setTimeout(()=>{
    //   let _getData = JSON.parse(sessionStorage.getItem('traveled-chart'));
    //   this.barChartData = _getData.booked;
    //   this.tours = _getData.tours;
    //   this.amount = _getData.amount;
    // }, 500);
  }

  // 3.1 set data binding
  public setTraveledData(){
    let _getData = JSON.parse(sessionStorage.getItem('traveled-chart'));
    this.barChartData = _getData.booked;
    this.tours = _getData.tours;
    this.amount = _getData.amount;
  }

  ngOnInit() {
    // set default binding bar data
    this.barChartData = [
      {data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0], label: 'Summary'}
    ];
    this.barChartLabels = ['TC-01','TC-02','TC-03','TC-04','TC-05A','TC-05E','TC-06','TC-07','TC-08','TC-09','TC-10','TC-11','TC-12','TC-S01','TC-S02M','TC-S02A'];
    this.barChartType = 'bar';
    this.barChartLegend = true;
    
    this.activeMenu();
    this.getTraveledData();
  }

}