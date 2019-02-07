import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-bank-aff-member',
  templateUrl: './bank-aff-member.component.html',
  styleUrls: ['./bank-aff-member.component.scss']
})
export class BankAffMemberComponent implements OnInit {

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
    this.router.navigate(['user/member/request/affiliate/step1']);
  }

  // 3. window next
  public windowNext(){
    this.router.navigate(['user/member/request/affiliate/step3']);
  }

  ngOnInit() {
    this.activeMenu();
  }

}
