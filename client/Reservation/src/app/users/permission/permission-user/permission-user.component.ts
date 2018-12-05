import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from "@angular/router";
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Router } from '@angular/router';
import "rxjs/Rx";

@Component({
  selector: 'app-permission-user',
  templateUrl: './permission-user.component.html',
  styleUrls: ['./permission-user.component.scss']
})
export class PermissionUserComponent implements OnInit {

  userAccount = <any>[];
  userType = <any>"";

  constructor(
    private http: Http,
    private router: Router,
    private route: ActivatedRoute
  ) { }

  // get user storage
  getUserStorage(){
    let getUser = JSON.parse(sessionStorage.getItem('users'));

    if(getUser==null || getUser==undefined || getUser==''){
      console.log('none');
      this.router.navigate(['user/login']);
      return;
    }

    let checkUserLogin = this.checkUserLogin(getUser);
    return checkUserLogin;
  }

  // check user login
  checkUserLogin(getUser){
    let token = getUser.data.token;
    let type = getUser.data.userType;

    let url = 'http://localhost:9000/api/Account/AccountSessionLoginReturnType';
    // let url = 'http://api.tourinchiangmai.com/api/Account/AccountSessionLoginReturnType';

    let checkLogin = {
      token: token,
      type: type
    }

    let options = new RequestOptions();
    this.http.post(url, checkLogin, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        sessionStorage.setItem('login',JSON.stringify(data)),
                      ],
                      err => [
                        console.log(err)
                      ]
                    );
    setTimeout(()=>{
      let _getData = JSON.parse(sessionStorage.getItem('login'));

      if(_getData==null || _getData==undefined || _getData==""){
        return;
      }
      this.userAccount = _getData;
      this.userType = _getData.data[0].type;

      this.checkPermission(this.userType);
    }, 500);
  }

  // check user type (permission)
  checkPermission(userType){
    switch(userType){
      case "User" : this.router.navigate(['user']); break;
      case "Member" : this.router.navigate(['user']); break;
      case "Affiliate" : this.router.navigate(['user/affiliate']); break;
      case "admin" : this.router.navigate(['user']); break;
      case "Manager" : this.router.navigate(['user']); break;
      case "Senior reservation" : this.router.navigate(['user/reservations']); break;
      case "Reservation" : this.router.navigate(['user/login/reservations']); break;
      case "Sale" : this.router.navigate(['user/login']); break;
      case "Online marketing" : this.router.navigate(['user/login']); break;
      case "Accounting" : this.router.navigate(['user/login']); break;
      case "Programmer" : this.router.navigate(['user/login']); break;
    }
  }

  ngOnInit() {
    this.getUserStorage();
  }

}