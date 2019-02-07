import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-profile-aff-member',
  templateUrl: './profile-aff-member.component.html',
  styleUrls: ['./profile-aff-member.component.scss']
})
export class ProfileAffMemberComponent implements OnInit {

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
    this.router.navigate(['user/member/request/affiliate/howto']);
  }

  // 3. window next
  public windowNext(){
    this.router.navigate(['user/member/request/affiliate/step2']);
  }

  ngOnInit() {
    this.activeMenu();
  }

}
