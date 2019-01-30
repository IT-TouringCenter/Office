import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from "@angular/router";
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Router } from '@angular/router';
import "rxjs/Rx";

@Component({
  selector: 'app-login-user',
  templateUrl: './login-user.component.html',
  styleUrls: ['./login-user.component.scss']
})
export class LoginUserComponent implements OnInit {

  data = {
    username: '',
    password: ''
  };

  constructor(
    private http: Http,
    private router: Router,
    private route: ActivatedRoute
  ) { }

  /*
    1. Login
    2. Set login
  */

  // 1. Login
  login(){
    // let url = 'http://localhost:9000/api/Account/AccountLogin';
    let url = 'http://api.tourinchiangmai.com/api/Account/AccountLogin';

      let options = new RequestOptions();
      let dataSave = {
          "username": this.data.username,
          "password": this.data.password
      };

      /*==================  Success  ===================*/
      // return this.http.post(url, dataSave, options)
      return this.http.post(url, dataSave, options)
                      .map(res => res.json())
                      .subscribe(
                        data => [
                          // console.log(data),
                          this.setLogin(data)
                        ],
                        err => {console.log(err)}
                      );
      /*==================  Success  ===================*/
  }

  // 2. Set login
  setLogin(data){
    // console.log(data);
    if(data.status==true){
      alert(data.message);
      // sessionStorage.setItem('users',JSON.stringify(data));
      localStorage.setItem('users',JSON.stringify(data));
      this.router.navigate(['user']);
    }else if(data.status==false && data.notify=='Sign out not found'){
      alert(data.message);
      this.router.navigate(['user/force-logout/'+data.data.token]);
    }else if(data.status==false && data.notify=='Non active'){
      alert(data.message);
      this.router.navigate(['user/register-confirm/'+data.data.token]);
    }else{
      alert(data.message);
    }
  }

  // key press enter
  keyPressEnter(){
    // username
    var input1 = document.getElementById("form-input1");
    input1.addEventListener("keyup", function(event) {
      event.preventDefault();
      if (event.keyCode === 13) {
        document.getElementById("login-btn").click();
      }
    });

    // password
    var input2 = document.getElementById("form-input2");
    input2.addEventListener("keyup", function(event) {
      event.preventDefault();
      if (event.keyCode === 13) {
        document.getElementById("login-btn").click();
      }
    });
  }

  ngOnInit() {
    this.keyPressEnter();
  }

}
