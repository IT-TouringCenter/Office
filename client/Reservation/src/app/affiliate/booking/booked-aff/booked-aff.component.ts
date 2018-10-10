import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-booked-aff',
  templateUrl: './booked-aff.component.html',
  styleUrls: ['./booked-aff.component.scss']
})
export class BookedAffComponent implements OnInit {

  constructor() { }

  public date = new Date();
  public month = this.date.getMonth();
  public year = this.date.getFullYear();
  public arrMonth = ['January','February','March','April','May','June','July','August','September','October','November','December'];
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
    { backgroundColor: '#0f4675'}
  ];

  // events
  public chartClicked(e:any):void {
    console.log(e);
  }

  public chartHovered(e:any):void {
    console.log(e);
  }

  // switch button
  public allBook():void {
    this.barChartData = [
      {data: [385,295,358,125,239,217,113,298,457,589,69,87,301,167,178,282], label: 'Summary'}
    ];
    let sum = 0;
    for(let i=0;i<this.barChartData[0].data.length;i++){
      sum += this.barChartData[0].data[i];
    }
    this.summary = sum;
  }

  public yearLyBook():void {
    this.barChartData = [
      {data: [288,255,276,108,145,156,79,233,367,458,51,71,217,112,108,177], label: this.year}
    ];
    let sum = 0;
    for(let i=0;i<this.barChartData[0].data.length;i++){
      sum += this.barChartData[0].data[i];
    }
    this.summary = sum;
  }

  public monthLyBook():void {
    this.barChartData = [
      {data: [56,77,58,37,85,95,44,47,33,75,66,53,58,87,86,71], label: this.arrMonth[this.month]+' '+this.year}
    ];
    let sum = 0;
    for(let i=0;i<this.barChartData[0].data.length;i++){
      sum += this.barChartData[0].data[i];
    }
    this.summary = sum;
  }

  // switch type
  // public typeBar(){
  //   this.barChartType = this.barChartType === 'bar' ? 'line' : 'bar';
  // }

  // public typePie(){
  //   this.barChartType = this.barChartType === 'line' ? 'bar' : 'line';
  // }

  // active menu
  public activeMenu(){
    // set storage
    sessionStorage.setItem('menu',JSON.stringify(1));
    sessionStorage.setItem('sub-menu',JSON.stringify(101));
  }

  public print():void {
    window.print();
  }

  ngOnInit() {
    // binding bar data
    this.barChartData = [
      {data: [385,295,358,125,239,217,113,298,457,589,69,87,301,167,178,282], label: 'Summary'}
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