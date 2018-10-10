import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-commission-tour-aff',
  templateUrl: './commission-tour-aff.component.html',
  styleUrls: ['./commission-tour-aff.component.scss']
})
export class CommissionTourAffComponent implements OnInit {

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
    sessionStorage.setItem('sub-menu',JSON.stringify(404));
  }

  ngOnInit() {
    // binding bar data
    this.barChartData = [
      {data: [65505,57020,47580,50080,52100,47310,62500,65000,42750,47170,53200,64200,54450,60300,52400,43500], label: this.monthNow+' '+this.year}
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