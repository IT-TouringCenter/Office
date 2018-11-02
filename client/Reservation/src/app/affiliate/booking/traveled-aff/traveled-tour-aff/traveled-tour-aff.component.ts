import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from "@angular/router";
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Router } from '@angular/router';
import "rxjs/Rx";

import { TraveledTourAffService } from './traveled-tour-aff.service';

@Component({
  selector: 'app-traveled-tour-aff',
  templateUrl: './traveled-tour-aff.component.html',
  styleUrls: ['./traveled-tour-aff.component.scss'],
  providers: [TraveledTourAffService]
})
export class TraveledTourAffComponent implements OnInit {

  constructor(
    private http: Http,
    private router: Router,
    private route: ActivatedRoute,
    private TraveledTourAffService: TraveledTourAffService
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
  public barChartColors:Array<any> = [];

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

  // 3. get data binding
  public getTraveledTourData(){
    this.TraveledTourAffService.getTraveledTour()
                    .subscribe(
                      resultArray => [
                        // sessionStorage.removeItem('chart-data'),
                        sessionStorage.setItem('traveled-tour-chart',JSON.stringify(resultArray))
                      ],
                      error => console.log("Error :: " + error)
                    )

    // set default traveled tour data
    let _data = {data: [0,0], label: '', total: ''};
    let arrData = <any>[];
    for(let i=0; i<1; i++){
      arrData.push(_data);
    }
    this.barChartData = arrData;
    this.barChartLabels = ['2017','2018'];
    this.barChartType = 'pie';
    this.barChartLegend = true;

    setTimeout(()=>{
      let _getData = JSON.parse(sessionStorage.getItem('traveled-tour-chart'));
      this.barChartData = _getData.booked;
      this.amount = _getData.amount;
    },200);
  }

  ngOnInit() {
    // get data
    this.activeMenu();
    this.getTraveledTourData();
  }

}