import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from "@angular/router";
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Router } from '@angular/router';
import "rxjs/Rx";

@Component({
  selector: 'app-force-logout-user',
  templateUrl: './force-logout-user.component.html',
  styleUrls: ['./force-logout-user.component.scss'],
  providers: []
})
export class ForceLogoutUserComponent implements OnInit {

  data = {
    username: '',
    logoutCode: ''
  };
  accountToken;

  constructor(
    private http: Http,
    private router: Router,
    private route: ActivatedRoute
  ) {
    let _params = this.route.snapshot.paramMap.get(('userId'));
    this.accountToken = _params;
  }

  /*
    1. Get account data
    2. Set data binding
  */

  // 1. Get account data
  getAccountData(){
    let url = 'http://localhost:9000/api/Account/GetAccountLoginData';
    // let url = 'http://api.tourinchiangmai.com/api/Account/GetAccountLoginData';

      let options = new RequestOptions();
      let dataSave = {
          "token": this.accountToken,
      };

      return this.http.post(url, dataSave, options)
                      .map(res => res.json())
                      .subscribe(
                        data => [
                          // console.log(data),
                          this.setDataBinding(data)
                        ],
                        err => {console.log(err)}
                      );
  }

  // 2. Set data binding
  setDataBinding(data){
    if(data.status==true){
      this.data.username = data.username;
    }else{
      this.router.navigate(['user/login']);
    }
  }

  // 3. Submit
  submit(){
    // Call API
    let url = 'http://localhost:9000/api/Account/AccountForceLogout';
    // let url = 'http://api.tourinchiangmai.com/api/Account/AccountForceLogout';

    let options = new RequestOptions();
    let dataLogout = {
      username: this.data.username,
      logoutCode: this.data.logoutCode
    };

    return this.http.post(url, dataLogout, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        this.checkLogout(data)
                      ],
                      err => [
                        console.log(err)
                      ]
                    );
  }

  // 4. Check logout
  checkLogout(data){
    // console.log(data);
    if(data.status==true){
      alert('Logout complete.');
      this.clearSession();
    }else{
      alert('Logout failed!');
      return;
    }
  }

  // 5. Clear session
  clearSession(){
    sessionStorage.removeItem('users');
    this.router.navigate(['user/login']);
  }

  ngOnInit() {
    this.getAccountData();
  }

}
