import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-traveled-monthly-aff',
  templateUrl: './traveled-monthly-aff.component.html',
  styleUrls: ['./traveled-monthly-aff.component.scss']
})
export class TraveledMonthlyAffComponent implements OnInit {

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
    { backgroundColor: '#6d0808'}
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
    sessionStorage.setItem('menu',JSON.stringify(2));
    sessionStorage.setItem('sub-menu',JSON.stringify(203));
  }

  ngOnInit() {
    // binding bar data
    this.barChartData = [
      {data: [235,212,197,158,141,134,125,165,142,217,198,226], label: this.year}
    ];
    let sum = 0;
    for(let i=0;i<this.barChartData[0].data.length;i++){
      sum += this.barChartData[0].data[i];
    }
    this.summary = sum;
    this.barChartLabels = this.arrMonth;
    this.barChartType = 'bar';
    this.barChartLegend = true;

    this.activeMenu();
  }

}
