import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-traveled-day-of-month-aff',
  templateUrl: './traveled-day-of-month-aff.component.html',
  styleUrls: ['./traveled-day-of-month-aff.component.scss']
})
export class TraveledDayOfMonthAffComponent implements OnInit {

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
    sessionStorage.setItem('sub-menu',JSON.stringify(202));
  }

  ngOnInit() {
    // binding bar data
    this.barChartData = [
      {data: [55,22,25,58,21,31,25,65,42,17,32,20,54,63,24,35,35,37,25,26,24,28,54,36,45,41,24,23,34,46], label: this.monthNow+' '+this.year}
    ];
    let sum = 0;
    for(let i=0;i<this.barChartData[0].data.length;i++){
      sum += this.barChartData[0].data[i];
    }
    this.summary = sum;
    this.barChartLabels = ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30'];
    this.barChartType = 'bar';
    this.barChartLegend = true;

    this.activeMenu();
  }

}