import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-commission-monthly-aff',
  templateUrl: './commission-monthly-aff.component.html',
  styleUrls: ['./commission-monthly-aff.component.scss']
})
export class CommissionMonthlyAffComponent implements OnInit {

  constructor() { }

  public date = new Date();
  public month = this.date.getMonth();
  public year = this.date.getFullYear();
  public arrMonth = ['January','February','March','April','May','June','July','August','September','October','November','December'];
  public arrYear = ['2018','2019','2020'];
  public monthNow = this.arrMonth[this.month];
  public shortMonthNow = this.monthNow.substr(0,3);
  public summary;

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
    // { backgroundColor: '#0f4675'}
  ];

  // events
  public chartClicked(e:any):void {
    console.log(e);
  }

  public chartHovered(e:any):void {
    console.log(e);
  }

  public print():void {
    window.print();
  }

  // active menu
  public activeMenu(){
    // set storage
    sessionStorage.setItem('menu',JSON.stringify(4));
    sessionStorage.setItem('sub-menu',JSON.stringify(403));
  }

  ngOnInit() {
    // binding bar data
    this.barChartData = [
      {data: [15365,21200,19700,15800,14105,17340,19250,16550,14205,21700,19800,22605], label: this.year}
    ];
    let sum = 0;
    for(let i=0;i<this.barChartData[0].data.length;i++){
      sum += this.barChartData[0].data[i];
    }
    this.summary = sum;
    this.barChartLabels = this.arrMonth;
    this.barChartType = 'line';
    this.barChartLegend = true;

    this.activeMenu();
  }

}