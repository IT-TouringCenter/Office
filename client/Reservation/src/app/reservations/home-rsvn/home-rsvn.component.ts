import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-home-rsvn',
  templateUrl: './home-rsvn.component.html',
  styleUrls: ['./home-rsvn.component.scss']
})
export class HomeRsvnComponent implements OnInit {

  constructor() { }

  // 1. print
  public print():void {
    window.print();
  }

  // 2. active menu
  public activeMenu(){
    // set storage
    sessionStorage.setItem('menu',JSON.stringify(0));
    sessionStorage.setItem('sub-menu',JSON.stringify(0));
  }

  ngOnInit() {
    // active menu
    this.activeMenu();
  }

}