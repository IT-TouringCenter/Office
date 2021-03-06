import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from "@angular/router";
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Router } from '@angular/router';
import "rxjs/Rx";

@Component({
  selector: 'app-traveled-monthly-manager',
  templateUrl: './traveled-monthly-manager.component.html',
  styleUrls: ['./traveled-monthly-manager.component.scss']
})
export class TraveledMonthlyManagerComponent implements OnInit {


  constructor(
    private http: Http,
    private router: Router,
    private route: ActivatedRoute
  ) { }

  public amount;

  // default valiable
  public travelData = {
    token: <any>"",
    type: <any>"",
    year: <any>""
  };

  public arrMonth = ['January','February','March','April','May','June','July','August','September','October','November','December'];
  // public arrYear = ['2018','2019','2020'];
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
  }

  // 1. print
  public print():void {
    window.print();
  }

  // 2. active menu
  public activeMenu(){
    // set storage
    sessionStorage.setItem('menu',JSON.stringify(1));
    sessionStorage.setItem('sub-menu',JSON.stringify(108));
  }

  // 3. get data binding
  public getTraveledMonthlyData(){
    // let url = 'http://localhost:9000/api/Dashboard/Affiliate/Traveled/Monthly';
    let url = 'http://api.tourinchiangmai.com/api/Dashboard/Affiliate/Traveled/Monthly';

    // set time
    let getDate = new Date();
    let getYear = getDate.getFullYear();

    for(let i=0;i<this.arrYear.length;i++){
      if(getYear == this.arrYear[i]){
        this.travelData.year = this.arrYear[i];
      }
    }

    // get token from session
    let getToken = JSON.parse(localStorage.getItem('users'));
    if(getToken==null || getToken==undefined || getToken==''){
      alert('Session expired!');
      this.router.navigate(['user/logout']);
      this.travelData.token = 0;
      this.travelData.type = 0;
    }else{
      this.travelData.token = getToken.data.token;
      this.travelData.type = getToken.data.userType;
    }

    let options = new RequestOptions();
    this.http.post(url, this.travelData, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        console.log(data),
                        sessionStorage.setItem('traveled-monthly-chart',JSON.stringify(data)),
                        this.setDataBinding()
                      ],
                      err => {console.log(err)}
                    );
   
    // set default traveled tour data
    let _data = {data: [0,0,0,0,0,0,0,0,0,0,0,0], label: '', total: ''};
    let arrData = <any>[];
    for(let i=0; i<1; i++){
      arrData.push(_data);
    }
    this.barChartData = arrData;
    this.barChartLabels = this.arrMonth;
    this.barChartType = 'bar';
    this.barChartLegend = true;
  }

  // 3.1 set data binding
  public setDataBinding(){
    let _getData = JSON.parse(sessionStorage.getItem('traveled-monthly-chart'));
    this.barChartData = _getData.booked;
    this.amount = _getData.amount;
  }

  // 4. search data
  public searchData(){
    // let url = 'http://localhost:9000/api/Dashboard/Affiliate/Traveled/Monthly';
    let url = 'http://api.tourinchiangmai.com/api/Dashboard/Affiliate/Traveled/Monthly';

    // get token from session
    let getToken = JSON.parse(localStorage.getItem('users'));
    if(getToken==null || getToken==undefined || getToken==''){
      this.travelData.token = 0;
      this.travelData.type = 0;
    }else{
      this.travelData.token = getToken.data.token;
      this.travelData.type = getToken.data.userType;
    }

    let options = new RequestOptions();
    this.http.post(url, this.travelData, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        console.log(data),
                        sessionStorage.setItem('traveled-monthly-chart',JSON.stringify(data)),
                        this.setDataSearch()
                      ],
                      err => {console.log(err)}
                    );
  }

  // 4.1 set data search
  public setDataSearch(){
    let _getData = JSON.parse(sessionStorage.getItem('traveled-monthly-chart'));
    this.barChartData = _getData.booked;
    this.amount = _getData.amount;
  }

  ngOnInit() {
    this.setDefaultYear();
    // get data
    this.activeMenu();
    this.getTraveledMonthlyData();
  }

}