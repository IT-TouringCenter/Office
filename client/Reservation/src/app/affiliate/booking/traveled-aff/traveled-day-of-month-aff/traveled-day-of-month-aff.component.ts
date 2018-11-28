import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from "@angular/router";
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Router } from '@angular/router';
import "rxjs/Rx";

import { TraveledDayOfMonthAffService } from './traveled-day-of-month-aff.service';

@Component({
  selector: 'app-traveled-day-of-month-aff',
  templateUrl: './traveled-day-of-month-aff.component.html',
  styleUrls: ['./traveled-day-of-month-aff.component.scss'],
  providers: [TraveledDayOfMonthAffService]
})
export class TraveledDayOfMonthAffComponent implements OnInit {

  constructor(
    private http: Http,
    private router: Router,
    private route: ActivatedRoute,
    private TraveledDayOfMonthAffService: TraveledDayOfMonthAffService
  ) { }

  public amount;

  // default valiable
  public travelData = {
    token: <any>"",
    type: <any>"",
    month: <any>"",
    year: <any>""
  };

  public arrMonth = ['January','February','March','April','May','June','July','August','September','October','November','December'];
  // public arrYear = <any>['2018','2019','2020'];
  public arrYear = <any>[];

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
    { backgroundColor: '#6d0808'}
  ];

  // 
  public setDefaultYear(){
    // set year
    let getYear = new Date();
    let yearStart = 2017;
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
    sessionStorage.setItem('menu',JSON.stringify(2));
    sessionStorage.setItem('sub-menu',JSON.stringify(202));
  }

  // 3. get data binding
  public getTraveledDayOfMonthData(){
    let url = 'http://localhost:9000/api/Dashboard/Affiliate/Traveled/DaysOfMonth';
    // let url = 'http://api.tourinchiangmai.com/api/Dashboard/Affiliate/Traveled/DaysOfMonth';
    let options = new RequestOptions();

    // set time
    let getDate = new Date();
    this.travelData.month = this.arrMonth[getDate.getMonth()];
    let getYear = getDate.getFullYear();

    for(let i=0;i<this.arrYear.length;i++){
      if(getYear == this.arrYear[i]){
        this.travelData.year = this.arrYear[i];
      }
    }

    // get token from session
    let getToken = JSON.parse(sessionStorage.getItem('users'));
    if(getToken==null || getToken==undefined || getToken==''){
      this.travelData.token = 0;
      this.travelData.type = 0;
    }else{
      this.travelData.token = getToken.data.token;
      this.travelData.type = getToken.data.userType;
    }

    /*==================  Success  ===================*/
    console.log(this.travelData);
    this.http.post(url, this.travelData, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        console.log(data),
                        sessionStorage.setItem('traveled-day-chart',JSON.stringify(data))
                      ],
                      err => {console.log(err)}
                    );
    // set default traveled tour data
    let _data = {data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0], label: ''};
    let arrData = <any>[];
    for(let i=0; i<1; i++){
      arrData.push(_data);
    }
    this.barChartData = arrData;
    this.barChartLabels = ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31'];
    this.barChartType = 'bar';
    this.barChartLegend = true;

    setTimeout(()=>{
      let _getData = JSON.parse(sessionStorage.getItem('traveled-day-chart'));
      this.barChartData = _getData.booked;
      this.amount = _getData.amount;
    },200);
  }

  // 4. search data
  public searchData(){
    let url = 'http://localhost:9000/api/Dashboard/Affiliate/Traveled/DaysOfMonth';
    // let url = 'http://api.tourinchiangmai.com/api/Dashboard/Affiliate/Traveled/DaysOfMonth';
    let options = new RequestOptions();

    // get token from session
    let getToken = JSON.parse(sessionStorage.getItem('users'));
    if(getToken==null || getToken==undefined || getToken==''){
      this.travelData.token = 0;
      this.travelData.type = 0;
    }else{
      this.travelData.token = getToken.data.token;
      this.travelData.type = getToken.data.userType;
    }

    /*==================  Success  ===================*/
    console.log(this.travelData);
    this.http.post(url, this.travelData, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        console.log(data),
                        sessionStorage.setItem('traveled-day-chart',JSON.stringify(data))
                      ],
                      err => {console.log(err)}
                    );
    setTimeout(()=>{
      let _getData = JSON.parse(sessionStorage.getItem('traveled-day-chart'));
      this.barChartData = _getData.booked;
      this.amount = _getData.amount;
    }, 1500);
  }

  ngOnInit() {
    this.setDefaultYear();
    // get data
    this.activeMenu();
    this.getTraveledDayOfMonthData();
  }

}