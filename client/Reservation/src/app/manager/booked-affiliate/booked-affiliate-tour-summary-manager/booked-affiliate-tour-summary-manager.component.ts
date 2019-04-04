import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from "@angular/router";
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Router } from '@angular/router';
import "rxjs/Rx";


@Component({
  selector: 'app-booked-affiliate-tour-summary-manager',
  templateUrl: './booked-affiliate-tour-summary-manager.component.html',
  styleUrls: ['./booked-affiliate-tour-summary-manager.component.scss']
})
export class BookedAffiliateTourSummaryManagerComponent implements OnInit {

  constructor(
    private http: Http,
    private router: Router,
    private route: ActivatedRoute
  ) { }

  public affiliateAccount;
  public selectedAffiliate = <any>"";
  public affiliateLength = <any>"";

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
    sessionStorage.setItem('menu',JSON.stringify(2));
    sessionStorage.setItem('sub-menu',JSON.stringify(205));
  }

  // 3. get data binding
  public getTourData() {
    // let url = 'http://localhost:9000/api/Dashboard/Affiliate/Tour';
    let url = 'http://api.tourinchiangmai.com/api/Dashboard/Affiliate/Tour';
    // let url = './../../../../assets/json/affiliate/tour/tour-summary.json';

    // get user
    let _getUserData = JSON.parse(localStorage.getItem('users'));
    if(_getUserData==null || _getUserData==undefined || _getUserData==''){
      alert('Session expired!');
      this.router.navigate(['user/logout']);
    }

    // set data
    let postData = {
      token : <any>"",
      type : <any>""
    };

    for(let i=0; i<this.affiliateLength; i++){
      if(this.affiliateAccount[i].token==this.selectedAffiliate){
        postData.token = this.affiliateAccount[i].token;
        postData.type = this.affiliateAccount[i].type;
      }
    }

    // save
    let options = new RequestOptions();
    this.http.post(url, postData, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        sessionStorage.setItem('tour-chart',JSON.stringify(data)),
                        this.setDataBinding()
                      ],
                      err => console.log("Error :: " + err)
                    );
  }

  // 3.1 set data binding
  public setDataBinding(){
    let _getData = JSON.parse(sessionStorage.getItem('tour-chart'));
    this.barChartData = _getData.booked;
    this.tours = _getData.tours;
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
    // set default binding bar chart
    this.barChartData = [
      {data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0], label: 'Summary'}
    ];
    this.barChartLabels = ['TC-01','TC-02','TC-03','TC-04','TC-05A','TC-05E','TC-06','TC-07','TC-08','TC-09','TC-10','TC-11','TC-12','TC-S01','TC-S02M','TC-S02A'];
    this.barChartType = 'bar';
    this.barChartLegend = true;

    this.activeMenu();
    this.getTourData();
    this.getAffiliateAccount();
  }

}