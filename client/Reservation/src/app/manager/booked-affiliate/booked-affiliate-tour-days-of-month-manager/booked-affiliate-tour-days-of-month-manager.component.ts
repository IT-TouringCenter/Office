import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from "@angular/router";
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Router } from '@angular/router';
import "rxjs/Rx";

@Component({
  selector: 'app-booked-affiliate-tour-days-of-month-manager',
  templateUrl: './booked-affiliate-tour-days-of-month-manager.component.html',
  styleUrls: ['./booked-affiliate-tour-days-of-month-manager.component.scss']
})
export class BookedAffiliateTourDaysOfMonthManagerComponent implements OnInit {

  constructor(
    private http: Http,
    private router: Router,
    private route: ActivatedRoute
  ) { }

  public affiliateAccount;
  public selectedAffiliate = <any>"";
  public affiliateLength = <any>"";

  public tours = <any>[];
  public arrMonth = <any>['January','February','March','April','May','June','July','August','September','October','November','December'];
  public arrYear = <any>[];
  public amount = [];

  // default valiable
  public tourData = {
    token: <any>"",
    type: <any>"",
    tourId: <any>"1",
    month: <any>"",
    year: <any>""
  };

  // Bar chart (day)
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

  // 
  public setDefaultYear(){
    // set year
    let getYear = new Date();
    let yearStart = 2018;
    let yearNow = getYear.getFullYear();
    let yearDif = yearNow - yearStart;
    for(let i=0;i<=yearDif;i++){
      let newYear = yearStart+i;
      this.arrYear.push(newYear.toString());
    }

    // set days in month
    let monthNow = getYear.getMonth();
    let daysInMonth = new Date(yearNow, monthNow+1, 0).getDate();

    this.setDefaultChart(daysInMonth);
  }

  // 
  public setDefaultChart(daysInMonth){
    // set days in month
    let daysArr = <any>[];
    for(let i=0;i<daysInMonth;i++){
      daysArr.push(0);
    }

    // set default binding bar data
    this.barChartData = [
      {data: daysArr, label: '', total: 0},
      {data: daysArr, label: '', total: 0}
    ];

    let daysDataArr = <any>[];
    for(let j=0;j<daysInMonth;j++){
      let number = j+1;
      daysDataArr.push(number.toString());
    }

    // this.barChartLabels = <any>['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31'];
    this.barChartLabels = daysDataArr;
    this.barChartType = 'line';
    this.barChartLegend = true;
  }

  // get tour
  public getTour(){
    // let url = 'http://localhost:9000/api/Tours/GetTourData';
    let url = 'http://api.tourinchiangmai.com/api/Tours/GetTourData';
    this.http.get(url)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        this.tours = data
                      ],
                      err => {console.log(err)}
                    );
  }

  // 1. print
  public print():void {
    window.print();
  }

  // 2. active menu
  public activeMenu(){
    // set storage
    sessionStorage.setItem('menu',JSON.stringify(2));
    sessionStorage.setItem('sub-menu',JSON.stringify(206));
  }

  // 4. search data
  public searchData(){
    // let url = 'http://localhost:9000/api/Dashboard/Affiliate/Tour/DaysOfMonth';
    let url = 'http://api.tourinchiangmai.com/api/Dashboard/Affiliate/Tour/DaysOfMonth';

    // get user
    let _getUserData = JSON.parse(localStorage.getItem('users'));
    if(_getUserData==null || _getUserData==undefined || _getUserData==''){
      alert('Session expired!');
      this.router.navigate(['user/logout']);
    }

    // set data
    for(let i=0; i<this.affiliateLength; i++){
      if(this.affiliateAccount[i].token==this.selectedAffiliate){
        this.tourData.token = this.affiliateAccount[i].token;
        this.tourData.type = this.affiliateAccount[i].type;
      }
    }

    // save
    let options = new RequestOptions();
    this.http.post(url, this.tourData, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        sessionStorage.setItem('tour-day-chart',JSON.stringify(data)),
                        this.setDataSearch()
                      ],
                      err => {console.log(err)}
                    );
  }

  // 4.1 set data search
  public setDataSearch(){
    let _getData = JSON.parse(sessionStorage.getItem('tour-day-chart'));

    // set default data
    let daysInMonth = _getData.days.length;
    this.setDefaultChart(daysInMonth);
    
    this.barChartData = _getData.booked;
    this.barChartLabels = _getData.days;
    this.amount = _getData.amount;
  }

  // get affiliate account
  public getAffiliateAccount(){
    // let url = 'http://localhost:9000/api/Dashboard/Manager/GetAffiliateAccount';
    let url = 'http://api.tourinchiangmai.com/api/Dashboard/Manager/GetAffiliateAccount';

    let _getUserData = JSON.parse(localStorage.getItem('users'));

    let postData = {
      token : _getUserData.data.token,
      type : _getUserData.data.userType
    };
    let options = new RequestOptions();
    this.http.post(url, postData, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        this.affiliateAccount = data.data,
                        this.affiliateLength = this.affiliateAccount.length
                      ],
                      err => console.log("Error :: " + err)
                    );
  }

  ngOnInit() {
    this.getAffiliateAccount();
    this.getTour();
    this.setDefaultYear();
    this.activeMenu();
  }

}