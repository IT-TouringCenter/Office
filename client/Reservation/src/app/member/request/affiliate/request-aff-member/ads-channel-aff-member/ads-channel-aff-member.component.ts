import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-ads-channel-aff-member',
  templateUrl: './ads-channel-aff-member.component.html',
  styleUrls: ['./ads-channel-aff-member.component.scss']
})
export class AdsChannelAffMemberComponent implements OnInit {

  // variable
  public channelData = {
    url: <any>''
  };

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
    let setData = this.setDataToStorage(this.channelData);

    if(setData==true){
      this.router.navigate(['user/member/request/affiliate/step4']);
    }
  }

  // Logic
  // 4. binding data
  public bindingData(){
    // get storage
    let getSession = JSON.parse(sessionStorage.getItem('set-channel'));
    if(getSession){
      this.channelData.url = getSession.url;
    }
  }


  // . set data to sessionStorage
  public setDataToStorage(data){
    sessionStorage.setItem('set-channel',JSON.stringify(data));
    let getData = sessionStorage.getItem('set-channel');

    if(getData){
      return true;
    }else{
      return false;
    }
  }

  ngOnInit() {
    this.activeMenu();
    this.bindingData();
  }

}
