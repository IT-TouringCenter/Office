import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-howto-aff-member',
  templateUrl: './howto-aff-member.component.html',
  styleUrls: ['./howto-aff-member.component.scss']
})
export class HowtoAffMemberComponent implements OnInit {

  constructor(
    private router: Router
  ) { }

  // 1. active menu
  public activeMenu(){
    // set storage
    sessionStorage.setItem('menu',JSON.stringify(999));
    sessionStorage.setItem('sub-menu',JSON.stringify(999));
  }

  // 2. join now
  joinNow(){
    this.router.navigate(['user/member/request/affiliate/step1']);
  }

  ngOnInit() {
    this.activeMenu();
  }

}
