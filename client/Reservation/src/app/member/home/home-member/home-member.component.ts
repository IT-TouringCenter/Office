import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-home-member',
  templateUrl: './home-member.component.html',
  styleUrls: ['./home-member.component.scss']
})
export class HomeMemberComponent implements OnInit {

  constructor() { }

  // 1. active menu
  public activeMenu(){
    // set storage
    sessionStorage.setItem('menu',JSON.stringify(0));
    sessionStorage.setItem('sub-menu',JSON.stringify(0));
  }
  
  ngOnInit() {
    this.activeMenu();
  }

}
