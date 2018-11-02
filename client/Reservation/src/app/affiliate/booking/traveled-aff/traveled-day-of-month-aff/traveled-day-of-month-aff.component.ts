import { Component, OnInit } from '@angular/core';

import { TraveledDayOfMonthAffService } from './traveled-day-of-month-aff.service';

@Component({
  selector: 'app-traveled-day-of-month-aff',
  templateUrl: './traveled-day-of-month-aff.component.html',
  styleUrls: ['./traveled-day-of-month-aff.component.scss'],
  providers: [TraveledDayOfMonthAffService]
})
export class TraveledDayOfMonthAffComponent implements OnInit {

  constructor(
    private TraveledDayOfMonthAffService: TraveledDayOfMonthAffService
  ) { }

  public amount;

  public arrMonth = ['January','February','March','April','May','June','July','August','September','October','November','December'];
  public arrYear = ['2018','2019','2020'];

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
    this.TraveledDayOfMonthAffService.getTraveledDayOfMonth()
                    .subscribe(
                      resultArray => [
                        // sessionStorage.removeItem('chart-data'),
                        sessionStorage.setItem('traveled-day-chart',JSON.stringify(resultArray))
                      ],
                      error => console.log("Error :: " + error)
                    )

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

  ngOnInit() {
    // get data
    this.activeMenu();
    this.getTraveledDayOfMonthData();
  }

}