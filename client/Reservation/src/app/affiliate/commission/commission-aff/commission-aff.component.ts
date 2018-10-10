import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-commission-aff',
  templateUrl: './commission-aff.component.html',
  styleUrls: ['./commission-aff.component.scss']
})
export class CommissionAffComponent implements OnInit {

  constructor() { }

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
  public barChartColors:Array<any> = [];

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
    sessionStorage.setItem('sub-menu',JSON.stringify(401));
  }

  ngOnInit() {
    // binding bar data
    this.barChartData = [
      {data: [3800, 4500, 5600, 5800, 3000, 4600, 5700, 1900, 3090, 4900, 5700, 6300, 3750, 6125, 4150, 5400], label: 'Commission'},
      // {data: [3800, 4500, 5600, 5800, 3000, 4600, 5700, 0, 4990, 4900, 5700, 6300, 3750, 6125, 4150, 0], label: 'Received'},
      // {data: [5, 8, 15, 0, 1, 3, 5, 0, 0, 0, 0, 0], label: 'Cancel'}
    ];
    let sum = 0;
    for(let i=0;i<this.barChartData[0].data.length;i++){
      sum += this.barChartData[0].data[i];
    }
    this.summary = sum;
    this.barChartLabels = ['TC-01','TC-02','TC-03','TC-04','TC-05A','TC-05E','TC-06','TC-07','TC-08','TC-09','TC-10','TC-11','TC-12','TC-S01','TC-S02M','TC-S02A'];
    this.barChartType = 'bar';
    this.barChartLegend = true;
    this.activeMenu();
  }
}