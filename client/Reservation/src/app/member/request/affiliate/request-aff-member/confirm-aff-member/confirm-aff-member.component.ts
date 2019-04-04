import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Http, RequestOptions } from '@angular/http';

@Component({
  selector: 'app-confirm-aff-member',
  templateUrl: './confirm-aff-member.component.html',
  styleUrls: ['./confirm-aff-member.component.scss']
})
export class ConfirmAffMemberComponent implements OnInit {

  // variable
  public memberData = {
    users: {
      token: <any>""
    },
    personalInfo: <any>"",
    bankInfo: <any>"",
    adsInfo: <any>""
  };
  public agree = <any>false;

  getUserSession = <any>'';
  getProfileSession = <any>'';
  getBankSession = <any>'';
  getChannelSession = <any>'';

  requestAffiliate = <any>'';

  constructor(
    private http: Http,
    private router: Router
  ) { }

  // 1. active menu
  public activeMenu(){
    // set storage
    sessionStorage.setItem('menu',JSON.stringify(2));
    sessionStorage.setItem('sub-menu',JSON.stringify(2));
  }

  // 2. window back
  public windowBack(){
    this.router.navigate(['user/member/request/affiliate/step3']);
    // return;
  }

  // Logic
  // 3. binding data to form
  public bindingDataToForm(){
    // get storage
    this.getUserSession = JSON.parse(localStorage.getItem('users'));
    this.getProfileSession = JSON.parse(sessionStorage.getItem('set-profile'));
    this.getBankSession = JSON.parse(sessionStorage.getItem('set-bank'));
    this.getChannelSession = JSON.parse(sessionStorage.getItem('set-channel'));

    // binding
    this.memberData.users = this.getUserSession.data.token;
    this.memberData.personalInfo = this.getProfileSession;
    this.memberData.bankInfo = this.getBankSession;
    this.memberData.adsInfo = this.getChannelSession;
  }

  // 4. send data for save to API
  public submitJoinAffiliate(){
    // set data
    let setData = {
      token: this.getUserSession.data.token,
      personalInfo: this.getProfileSession,
      bankInfo: this.getBankSession,
      adsInfo: this.getChannelSession
    };

    // post to API
    // let url = 'http://localhost:9000/api/Dashboard/Member/RequestJoinAffiliate';
    let url = 'http://api.tourinchiangmai.com/api/Dashboard/Member/RequestJoinAffiliate';

    let options = new RequestOptions();
    return this.http.post(url, setData, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        alert(JSON.stringify(data.message)),
                        this.redirect(data)
                      ],
                      err => [
                        console.log(err)
                      ]
                    );
  }

  // 5. redirect
  public redirect(data){
    if(data.status==true){
      sessionStorage.removeItem('set-profile');
      sessionStorage.removeItem('set-bank');
      sessionStorage.removeItem('set-channel');

      this.router.navigate(['user/member/approval']);
    }else{
      alert('โปรดตรวจสอบข้อมูลให้ถูกต้องหรือติดต่อเจ้าหน้าที่ 02-xxx-xxxx');
    }

  }

  // 6. check request affiliate
  // 6.1 
  checkMemberRequestAffiliate(){
    let token = <any>'';

    // get user
    let getUser = JSON.parse(localStorage.getItem('users'));
    if(getUser){
      let token = getUser.data.token;
    }else{
      this.router.navigate(['user/logout']);
    }

    // set data
    let setData = {
      "token": getUser.data.token
    };

    // post for check request affiliate : API
    // let url = 'http://localhost:9000/api/Dashboard/Member/CheckRequestJoinAffiliate';
    let url = 'http://api.tourinchiangmai.com/api/Dashboard/Member/CheckRequestJoinAffiliate';

    let options = new RequestOptions();

    return this.http.post(url, setData, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        sessionStorage.setItem('request-aff',JSON.stringify(data)),
                        this.checkRequestAffiliate(data)
                      ],
                      err => [
                        console.log(err)
                      ]
                    );
  }

  // 6.2 
  checkRequestAffiliate(data){
    let getRequestAff = data;

    if(getRequestAff.message=='Complete'){
      alert('คุณได้ส่งคำขอเรียบร้อยแล้ว โปรดรอการอนุมัติ...');
      this.router.navigate(['user/member/approval']);
    }else{
      this.requestAffiliate = false;
    }
    
  }

  ngOnInit() {
    this.checkMemberRequestAffiliate();
    this.activeMenu();
    this.bindingDataToForm();
  }

}
