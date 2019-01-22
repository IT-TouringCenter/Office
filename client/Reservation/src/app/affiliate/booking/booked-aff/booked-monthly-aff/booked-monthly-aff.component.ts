import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from "@angular/router";
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Router } from '@angular/router';
import "rxjs/Rx";

import { BookedMonthlyAffService } from './booked-monthly-aff.service';

@Component({
  selector: 'app-booked-monthly-aff',
  templateUrl: './booked-monthly-aff.component.html',
  styleUrls: ['./booked-monthly-aff.component.scss'],
  providers: [BookedMonthlyAffService]
})
export class BookedMonthlyAffComponent implements OnInit {

  constructor(
    private http: Http,
    private router: Router,
    private route: ActivatedRoute,
    private BookedMonthlyAffService: BookedMonthlyAffService
  ) { }

  public arrMonth = ['January','February','March','April','May','June','July','August','September','October','November','December'];
  // public arrYear = ['2018','2019','2020'];
  public arrYear = <any>[];
  public amount;

  // default valiable
  public bookedData = {
    token: <any>"",
    type: <any>"",
    year: <any>""
  };

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
    { backgroundColor: '#0f4675'}
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
  }

  // 1. print
  public print():void {
    window.print();
  }

  // 2. active menu
  public activeMenu(){
    // set storage
    sessionStorage.setItem('menu',JSON.stringify(1));
    sessionStorage.setItem('sub-menu',JSON.stringify(104));
  }

  // 3. get data binding
  public getBookedMonthlyData():void {
    // let url = 'http://localhost:9000/api/Dashboard/Affiliate/Booked/Monthly';
    let url = 'http://api.tourinchiangmai.com/api/Dashboard/Affiliate/Booked/Monthly';
    let options = new RequestOptions();

    // set time
    let getDate = new Date();
    let getYear = getDate.getFullYear();

    for(let i=0;i<this.arrYear.length;i++){
      if(getYear == this.arrYear[i]){
        this.bookedData.year = this.arrYear[i];
      }
    }

    // get token from session
    let getToken = JSON.parse(sessionStorage.getItem('users'));
    if(getToken==null || getToken==undefined || getToken==''){
      alert('Session expired!');
      this.router.navigate(['user/logout']);
      this.bookedData.token = 0;
      this.bookedData.type = 0;
    }else{
      this.bookedData.token = getToken.data.token;
      this.bookedData.type = getToken.data.userType;
    }

    /*==================  Success  ===================*/
    console.log(this.bookedData);
    this.http.post(url, this.bookedData, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        console.log(data),
                        sessionStorage.setItem('booked-monthly-chart',JSON.stringify(data)),
                        this.setDataBinding()
                      ],
                      err => {console.log(err)}
                    );
    // setTimeout(()=>{
    //   let _getData = JSON.parse(sessionStorage.getItem('booked-monthly-chart'));
    //   this.barChartData = _getData.booked;
    //   this.amount = _getData.amount;
    // }, 500);
  }

  // 3.1 set data binding
  public setDataBinding(){
    let _getData = JSON.parse(sessionStorage.getItem('booked-monthly-chart'));
    this.barChartData = _getData.booked;
    this.amount = _getData.amount;
  }

  // 4. search data
  public searchData(){
    // let url = 'http://localhost:9000/api/Dashboard/Affiliate/Booked/Monthly';
    let url = 'http://api.tourinchiangmai.com/api/Dashboard/Affiliate/Booked/Monthly';
    let options = new RequestOptions();

    // get token from session
    let getToken = JSON.parse(sessionStorage.getItem('users'));
    if(getToken==null || getToken==undefined || getToken==''){
      this.bookedData.token = 0;
      this.bookedData.type = 0;
    }else{
      this.bookedData.token = getToken.data.token;
      this.bookedData.type = getToken.data.userType;
    }

    /*==================  Success  ===================*/
    console.log(this.bookedData);
    this.http.post(url, this.bookedData, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        console.log(data),
                        sessionStorage.setItem('booked-monthly-chart',JSON.stringify(data)),
                        this.setDataSearch()
                      ],
                      err => {console.log(err)}
                    );
    // setTimeout(()=>{
    //   let _getData = JSON.parse(sessionStorage.getItem('booked-monthly-chart'));
    //   this.barChartData = _getData.booked;
    //   this.amount = _getData.amount;
    // }, 500);
  }

  // 4.1 set data search
  public setDataSearch(){
    let _getData = JSON.parse(sessionStorage.getItem('booked-monthly-chart'));
    this.barChartData = _getData.booked;
    this.amount = _getData.amount;
  }

  ngOnInit() {
    this.setDefaultYear();
    // set default binding bar data
    this.barChartData = [
      {data: [0,0,0,0,0,0,0,0,0,0,0,0], label: ''}
    ];
    this.barChartLabels = this.arrMonth;
    this.barChartType = 'bar';
    this.barChartLegend = true;

    this.activeMenu();
    this.getBookedMonthlyData();
  }

}