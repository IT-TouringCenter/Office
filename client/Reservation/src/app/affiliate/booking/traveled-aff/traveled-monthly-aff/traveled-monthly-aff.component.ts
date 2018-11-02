import { Component, OnInit } from '@angular/core';

import { TraveledMonthlyAffService } from './traveled-monthly-aff.service';

@Component({
  selector: 'app-traveled-monthly-aff',
  templateUrl: './traveled-monthly-aff.component.html',
  styleUrls: ['./traveled-monthly-aff.component.scss'],
  providers: [TraveledMonthlyAffService]
})
export class TraveledMonthlyAffComponent implements OnInit {

  constructor(
    private TraveledMonthlyAffService: TraveledMonthlyAffService
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
    sessionStorage.setItem('sub-menu',JSON.stringify(203));
  }

  // 3. get data binding
  public getTraveledMonthlyData(){
    this.TraveledMonthlyAffService.getTraveledMonthly()
                    .subscribe(
                      resultArray => [
                        // sessionStorage.removeItem('chart-data'),
                        sessionStorage.setItem('traveled-monthly-chart',JSON.stringify(resultArray))
                      ],
                      error => console.log("Error :: " + error)
                    )

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

    setTimeout(()=>{
      let _getData = JSON.parse(sessionStorage.getItem('traveled-monthly-chart'));
      this.barChartData = _getData.booked;
      this.amount = _getData.amount;
    },200);
  }

  ngOnInit() {
    // get data
    this.activeMenu();
    this.getTraveledMonthlyData();
  }

}