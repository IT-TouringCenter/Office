import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from "@angular/router";
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Router } from '@angular/router';
import "rxjs/Rx";

@Component({
  selector: 'app-booked-affiliate-tour-manager',
  templateUrl: './booked-affiliate-tour-manager.component.html',
  styleUrls: ['./booked-affiliate-tour-manager.component.scss']
})
export class BookedAffiliateTourManagerComponent implements OnInit {

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
    sessionStorage.setItem('sub-menu',JSON.stringify(205));
  }

  ngOnInit() {
    this.activeMenu();
  }

}