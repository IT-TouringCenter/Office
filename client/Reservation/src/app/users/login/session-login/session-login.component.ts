import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from "@angular/router";
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Router } from '@angular/router';
import "rxjs/Rx";

@Component({
  selector: 'app-session-login',
  templateUrl: './session-login.component.html',
  styleUrls: ['./session-login.component.scss']
})
export class SessionLoginComponent implements OnInit {

  constructor(
    private http: Http,
    private router: Router,
    private route: ActivatedRoute
  ) { }

  /*
    1. Check session storage
    2. Check login (API)
    3. Logout
    4. Clear session
  */

  // 1. Check session storage
  checkStorage(){
    // let getSession = sessionStorage.getItem('users');
    let sessionData = JSON.parse(sessionStorage.getItem('users'));
    if(sessionData){
      let checkLogin = this.checkLogin(sessionData);
    }else{
      // this.logout(sessionData);
      this.router.navigate(['user/login']);
    }
    return;
  }

  // 2. Check login (API)
  checkLogin(sessionData){
    let url = 'http://localhost:9000/api/Account/AccountSessionLogin';
    // let url = 'http://api.tourinchiangmai.com/api/Account/AccountSessionLogin';

      let options = new RequestOptions();
      let checkLogin = {
        // username: param.data.username,
        token: sessionData.data.token
      };
      return this.http.post(url, checkLogin, options)
                      .map(res => res.json())
                      .subscribe(
                        data => [
                          // console.log(data),
                          this.checkLoginStatus(data, sessionData)
                        ],
                        err => [
                          console.log(err)
                        ]
                      );
  }

  // 3. Check login status
  checkLoginStatus(data, sessionData){
    if(data.status==false){
      this.logout(sessionData);
    }else{
      this.router.navigate(['user']);
    }
    return data;
  }

  // 3. Logout
  logout(data){
    // Call API
    let url = 'http://localhost:9000/api/Account/AccountLogout';
    // let url = 'http://api.tourinchiangmai.com/api/Account/AccountLogout';

      let options = new RequestOptions();
      let dataLogout = {
        username: data.data.username,
        token: data.data.token
      };

      return this.http.post(url, dataLogout, options)
                      .map(res => res.json())
                      .subscribe(
                        data => [
                          this.clearSession(data)
                        ],
                        err => [
                          console.log(err)
                        ]
                      );
  }

  // 4. Clear session
  clearSession(data){
    sessionStorage.removeItem('users');
    this.router.navigate(['user/login']);
  }

  ngOnInit() {
    this.checkStorage();
  }

}
