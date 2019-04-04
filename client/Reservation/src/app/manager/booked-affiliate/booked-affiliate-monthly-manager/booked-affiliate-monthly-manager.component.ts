import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from "@angular/router";
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Router } from '@angular/router';
import "rxjs/Rx";

@Component({
  selector: 'app-booked-affiliate-monthly-manager',
  templateUrl: './booked-affiliate-monthly-manager.component.html',
  styleUrls: ['./booked-affiliate-monthly-manager.component.scss']
})
export class BookedAffiliateMonthlyManagerComponent implements OnInit {

  constructor(
    private http: Http,
    private router: Router,
    private route: ActivatedRoute
  ) { }

  public affiliateAccount;
  public selectedAffiliate = <any>"";
  public affiliateLength = <any>"";

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
    sessionStorage.setItem('menu',JSON.stringify(2));
    sessionStorage.setItem('sub-menu',JSON.stringify(204));
  }

  // 4. search data
  public searchData(){
    // let url = 'http://localhost:9000/api/Dashboard/Affiliate/Booked/Monthly';
    let url = 'http://api.tourinchiangmai.com/api/Dashboard/Affiliate/Booked/Monthly';

    // get user
    let _getUserData = JSON.parse(localStorage.getItem('users'));
    if(_getUserData==null || _getUserData==undefined || _getUserData==''){
      alert('Session expired!');
      this.router.navigate(['user/logout']);
    }

    // set data
    for(let i=0; i<this.affiliateLength; i++){
      if(this.affiliateAccount[i].token==this.selectedAffiliate){
        this.bookedData.token = this.affiliateAccount[i].token;
        this.bookedData.type = this.affiliateAccount[i].type;
      }
    }

    let options = new RequestOptions();
    this.http.post(url, this.bookedData, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        console.log(data),
                        sessionStorage.setItem('aff-monthly-chart',JSON.stringify(data)),
                        this.setDataSearch()
                      ],
                      err => {console.log(err)}
                    );
  }

  // 4.1 set data search
  public setDataSearch(){
    let _getData = JSON.parse(sessionStorage.getItem('aff-monthly-chart'));
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
    this.getAffiliateAccount();
    this.setDefaultYear();
    // set default binding bar data
    this.barChartData = [
      {data: [0,0,0,0,0,0,0,0,0,0,0,0], label: ''}
    ];
    this.barChartLabels = this.arrMonth;
    this.barChartType = 'bar';
    this.barChartLegend = true;

    this.activeMenu();
  }

}