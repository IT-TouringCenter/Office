import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-confirm-aff-member',
  templateUrl: './confirm-aff-member.component.html',
  styleUrls: ['./confirm-aff-member.component.scss']
})
export class ConfirmAffMemberComponent implements OnInit {

  constructor(
    private router: Router
  ) { }

  // 1. active menu
  public activeMenu(){
    // set storage
    sessionStorage.setItem('menu',JSON.stringify(999));
    sessionStorage.setItem('sub-menu',JSON.stringify(999));
  }

  // 2. window back
  public windowBack(){
    this.router.navigate(['user/member/request/affiliate/step3']);
    // return;
  }

  // 3. window next
  public windowNext(){
    // this.router.navigate(['user/member/request/affiliate/']);
    // return;
  }

  ngOnInit() {
    this.activeMenu();  
  }

}
