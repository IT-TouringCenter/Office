import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-booked-table-aff',
  templateUrl: './booked-table-aff.component.html',
  styleUrls: ['./booked-table-aff.component.scss']
})
export class BookedTableAffComponent implements OnInit {

  constructor() { }

  // 1. print
  public print():void {
    window.print();
  }

  // 2. active menu
  public activeMenu(){
    // set storage
    sessionStorage.setItem('menu',JSON.stringify(1));
    sessionStorage.setItem('sub-menu',JSON.stringify(101));
  }

  ngOnInit() {
    this.activeMenu();
  }

}