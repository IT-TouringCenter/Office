import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-request-member',
  templateUrl: './request-member.component.html',
  styleUrls: ['./request-member.component.scss']
})
export class RequestMemberComponent implements OnInit {

  constructor() { }

  // 1. active menu
  public activeMenu(){
    // set storage
    sessionStorage.setItem('menu',JSON.stringify(999));
    sessionStorage.setItem('sub-menu',JSON.stringify(999));
  }

  ngOnInit() {
    this.activeMenu();
  }

}
