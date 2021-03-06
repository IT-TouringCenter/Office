import { Component, OnInit } from '@angular/core';
import { Http, RequestOptions } from '@angular/http';
import { Router } from '@angular/router';
import { Observable } from "rxjs/Rx";

@Component({
  selector: 'app-permission-manager',
  templateUrl: './permission-manager.component.html',
  styleUrls: ['./permission-manager.component.scss']
})
export class PermissionManagerComponent implements OnInit {

  userAccount = <any>[];
  userType = <any>"";

  constructor(
    private http: Http,
    private router: Router
  ) { }

  // get user storage
  getUserStorage(){
    let getUser = JSON.parse(localStorage.getItem('users'));

    if(getUser==null || getUser==undefined || getUser==''){
      this.router.navigate(['user/login']);
      return;
    }

    let checkUserLogin = this.checkUserLogin(getUser);
    return checkUserLogin;
  }

  // check user login
  checkUserLogin(getUser){
    let token = getUser.data.token;
    let tokenLogin = getUser.data.tokenLogin;
    let type = getUser.data.userType;

    // let url = 'http://localhost:9000/api/Account/AccountSessionLoginReturnType';
    let url = 'http://api.tourinchiangmai.com/api/Account/AccountSessionLoginReturnType';

    let checkLogin = {
      token: token,
      tokenLogin: tokenLogin,
      type: type
    }

    let options = new RequestOptions();
    return this.http.post(url, checkLogin, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        // sessionStorage.setItem('login',JSON.stringify(data)),
                        this.setUserLogin(data)
                      ],
                      err => [
                        console.log(err)
                      ]
                    );
  }

  // set user login
  setUserLogin(userData){
    if(userData==null || userData==undefined || userData==""){
      this.router.navigate(['user/logout']);
    }else if(userData.status==false){
      this.router.navigate(['user/logout']);
    }

    this.userAccount = userData;
    this.userType = userData.data[0].type;

    // condition init permission
    this.checkPermission(this.userType);
  
  }

  // check user type (permission)
  checkPermission(userType){
    if(userType!=="Manager"){
      this.router.navigate(['user/logout']);
    }
  }

  ngOnInit() {
    this.getUserStorage();
    // run every time
    Observable.interval(1000*30).subscribe(x => {
      this.getUserStorage();
    });
  }
}
