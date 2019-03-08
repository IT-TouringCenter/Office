import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from "@angular/router";
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Router } from '@angular/router';
import "rxjs/Rx";

@Component({
  selector: 'app-booked-affiliate-days-of-month-manage',
  templateUrl: './booked-affiliate-days-of-month-manage.component.html',
  styleUrls: ['./booked-affiliate-days-of-month-manage.component.scss']
})
export class BookedAffiliateDaysOfMonthManageComponent implements OnInit {

  constructor(
    private http: Http,
    private router: Router,
    private route: ActivatedRoute
  ) { }
  
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

  ngOnInit() {
    this.activeMenu();
  }

}