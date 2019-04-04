import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from "@angular/router";
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Router } from '@angular/router';
import "rxjs/Rx";

@Component({
  selector: 'app-booked-affiliate-commission-summary-manager',
  templateUrl: './booked-affiliate-commission-summary-manager.component.html',
  styleUrls: ['./booked-affiliate-commission-summary-manager.component.scss']
})
export class BookedAffiliateCommissionSummaryManagerComponent implements OnInit {

  constructor(
    private http: Http,
    private router: Router,
    private route: ActivatedRoute
  ) { }

  public affiliateAccount;
  public selectedAffiliate = <any>"";
  public affiliateLength = <any>"";

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
  public barChartColors:Array<any> = [];

  // 1. print
  public print():void {
    window.print();
  }

  // 2. active menu
  public activeMenu(){
    // set storage
    sessionStorage.setItem('menu',JSON.stringify(2));
    sessionStorage.setItem('sub-menu',JSON.stringify(208));
  }

  // 3. get data binding
  public getCommissionData() {
    // let url = 'http://localhost:9000/api/Dashboard/Affiliate/Commission/Summary';
    let url = 'http://api.tourinchiangmai.com/api/Dashboard/Affiliate/Commission/Summary';
    // let url = './../../../../assets/json/affiliate/commission/commission.json';

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
                        sessionStorage.setItem('commission-chart',JSON.stringify(data)),
                        this.setDataBinding()
                      ],
                      err => console.log("Error :: " + err)
                    );
  }

  // 3.1 set data binding
  public setDataBinding(){
    let _getData = JSON.parse(sessionStorage.getItem('commission-chart'));
    this.barChartData = _getData.booked;
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
    // binding bar data
    this.barChartData = [
      {data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0], label: ''}
    ];

    this.barChartLabels = ['TC-01','TC-02','TC-03','TC-04','TC-05A','TC-05E','TC-06','TC-07','TC-08','TC-09','TC-10','TC-11','TC-12','TC-S01','TC-S02M','TC-S02A'];
    this.barChartType = 'bar';
    this.barChartLegend = true;

    this.activeMenu();
    this.getAffiliateAccount();
  }
}