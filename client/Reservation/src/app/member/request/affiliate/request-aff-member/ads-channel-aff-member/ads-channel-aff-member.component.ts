import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-ads-channel-aff-member',
  templateUrl: './ads-channel-aff-member.component.html',
  styleUrls: ['./ads-channel-aff-member.component.scss']
})
export class AdsChannelAffMemberComponent implements OnInit {

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
    this.router.navigate(['user/member/request/affiliate/step2']);
  }

  // 3. window next
  public windowNext(){
    this.router.navigate(['user/member/request/affiliate/step4']);
  }

  ngOnInit() {
    this.activeMenu();
  }

}
