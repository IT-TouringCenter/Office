import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-home-manager',
  templateUrl: './home-manager.component.html',
  styleUrls: ['./home-manager.component.scss']
})
export class HomeManagerComponent implements OnInit {

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
    this.activeMenu();
  }

}
