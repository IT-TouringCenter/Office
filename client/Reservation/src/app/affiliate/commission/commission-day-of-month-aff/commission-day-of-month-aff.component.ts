import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-commission-day-of-month-aff',
  templateUrl: './commission-day-of-month-aff.component.html',
  styleUrls: ['./commission-day-of-month-aff.component.scss']
})
export class CommissionDayOfMonthAffComponent implements OnInit {

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
    sessionStorage.setItem('sub-menu',JSON.stringify(402));
  }

  ngOnInit() {
    // binding bar data
    this.barChartData = [
      {data: [1505,2020,2050,1550,2100,3100,2560,2650,4120,2170,3200,2050,3545,2630,3240,2355,2235,3375,4250,2165,2400,2800,2540,3600,4510,4100,2400,2300,3400,4650], label: this.monthNow+' '+this.year}
    ];
    let sum = 0;
    for(let i=0;i<this.barChartData[0].data.length;i++){
      sum += this.barChartData[0].data[i];
    }
    this.summary = sum;
    this.barChartLabels = ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30'];
    this.barChartType = 'line';
    this.barChartLegend = true;

    this.activeMenu();
  }

}