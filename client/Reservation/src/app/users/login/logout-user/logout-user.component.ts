import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from "@angular/router";
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Router } from '@angular/router';
import "rxjs/Rx";

@Component({
  selector: 'app-logout-user',
  templateUrl: './logout-user.component.html',
  styleUrls: ['./logout-user.component.scss']
})
export class LogoutUserComponent implements OnInit {

  constructor(
    private http: Http,
    private router: Router,
    private route: ActivatedRoute
  ) { }

  /*
    1. Logout
    2. Clear session
  */

  // 1. Logout
  logout(){
    // Get session
    let sessionData = sessionStorage.getItem('users');
    let data = JSON.parse(sessionData);

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

  // 2. Clear session
  clearSession(data){
    sessionStorage.removeItem('users');
    this.router.navigate(['user/login']);
  }

  ngOnInit() {
    this.logout();
  }

}
