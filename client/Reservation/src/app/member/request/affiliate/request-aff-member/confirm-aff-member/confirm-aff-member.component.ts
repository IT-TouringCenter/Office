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

  constructor(
    private http: Http,
    private router: Router
  ) { }

  agrees(){
    console.log(this.agree);
  }

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

    console.log(this.memberData);
  }

  // 4. send data for save to API
  public submitJoinAffiliate(){
    // set data
    let setData = {
      user: {
        token: this.getUserSession.data.token
      },
      personalInfo: this.getProfileSession,
      bankInfo: this.getBankSession,
      adsInfo: this.getChannelSession
    };
    // console.log(JSON.stringify(setData));

    // post to API
    let url = 'http://localhost:9000/';
    // let url = 'http://api.tourinchiangmai.com/';

    let options = new RequestOptions();

    return this.http.post(url, setData, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        console.log(data)
                      ],
                      err => [
                        console.log(err)
                      ]
                    );
  }

  ngOnInit() {
    this.activeMenu();
    this.bindingDataToForm();
  }

}
