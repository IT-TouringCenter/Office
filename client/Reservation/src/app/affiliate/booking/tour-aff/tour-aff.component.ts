import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-tour-aff',
  templateUrl: './tour-aff.component.html',
  styleUrls: ['./tour-aff.component.scss']
})
export class TourAffComponent implements OnInit {

  constructor() { }

  public tours = [
    {'code': 'TC-01', 'title': 'Doi Suthep Temple & Hmong Hill Tribe Village'},
    {'code': 'TC-02', 'title': 'City Temple & Museum'},
    {'code': 'TC-03', 'title': 'Elephant at Work & Riding @ Mae Sa Elephant Camp'},
    {'code': 'TC-04', 'title': 'Handicraft Village'},
    {'code': 'TC-05A', 'title': 'Chiang Mai Night Safari (Afternoon Trip; Day Safari)'},
    {'code': 'TC-05E', 'title': 'Chiang Mai Night Safari (Evening Trip)'},
    {'code': 'TC-06', 'title': 'Khan Toke Dinner with Cultural Performances'},
    {'code': 'TC-07', 'title': 'Elephant Safari @ Mae Taman Elephant Camp'},
    {'code': 'TC-08', 'title': 'Chiang Rai Day Trip'},
    {'code': 'TC-09', 'title': 'Inthanon National Park'},
    {'code': 'TC-10', 'title': 'Elephant Trek to Long Neck and Tiger Kingdom'},
    {'code': 'TC-11', 'title': 'Elephant Conservation Center @ Lampang'},
    {'code': 'TC-12', 'title': 'Trekking Doi Suthep Area'},
    {'code': 'TC-S01', 'title': 'Kew Mae Pan Natural Trail'},
    {'code': 'TC-S02M', 'title': 'Breath of Nature (Morning)'},
    {'code': 'TC-S02A', 'title': 'Breath of Nature (Afternoon)'}
  ];

  public date = new Date();
  public month = this.date.getMonth();
  public year = this.date.getFullYear();
  public arrMonth = ['January','February','March','April','May','June','July','August','September','October','November','December'];
  public arrYear = ['2018','2019','2020'];
  public monthNow = this.arrMonth[this.month];
  public shortMonthNow = this.monthNow.substr(0,3);
  public summary;

  // Bar chart (all)
  public barChartOptions:any = {
    scaleShowVerticalLines: false,
    responsive: true
  };
  public barChartData:any[];
  public barChartLabels:string[];
  public barChartType:string;
  public barChartLegend:boolean;
  public barChartColors:Array<any> = [
    { backgroundColor: 'rgba(77,83,96,0.8)',
      borderColor: 'rgba(77,83,96,1)',
      pointBackgroundColor: 'rgba(77,83,96,1)',
      pointBorderColor: '#fff',
      pointHoverBackgroundColor: '#fff',
      pointHoverBorderColor: 'rgba(77,83,96,1)' }
  ];

  // Pie chart (all)
  public pieChartOptions:any = {
    scaleShowVerticalLines: false,
    responsive: true
  };
  public pieChartData:any[];
  public pieChartLabels:string[];
  public pieChartType:string;
  public pieChartLegend:boolean;
  public pieChartColors:Array<any> = [];

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
    sessionStorage.setItem('menu',JSON.stringify(3));
    sessionStorage.setItem('sub-menu',JSON.stringify(301));
  }

  ngOnInit() {
    // pie chart
    this.pieChartData = [
      {data: [550,432], label: 'Tour statistics'}
    ];
    this.pieChartLabels = ['2017','2018'];
    this.pieChartType = 'pie';
    this.pieChartLegend = true;

    // bar chart
    this.barChartData = [
      {data: [55,22,25,58,21,31,25,65,42,17,32,20,54,63,24,35], label: 'Summary'}
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