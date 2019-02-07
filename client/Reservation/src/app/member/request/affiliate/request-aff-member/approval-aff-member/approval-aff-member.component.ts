import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-approval-aff-member',
  templateUrl: './approval-aff-member.component.html',
  styleUrls: ['./approval-aff-member.component.scss']
})
export class ApprovalAffMemberComponent implements OnInit {

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
