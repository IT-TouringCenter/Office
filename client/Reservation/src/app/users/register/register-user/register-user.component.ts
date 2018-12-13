import { Component, OnInit } from '@angular/core';
import { AsyncPipe } from '@angular/common';
import { HttpHeaders } from '@angular/common/http';
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { FormsModule, FormControl, Validators, NgModel, ReactiveFormsModule, FormGroup } from '@angular/forms';
import { Router } from '@angular/router';

import { Observable } from "rxjs/Observable";
import { startWith } from "rxjs/operators/startWith";
import { map } from "rxjs/operators/map";
import "rxjs/Rx";

@Component({
  selector: 'app-register-user',
  templateUrl: './register-user.component.html',
  styleUrls: ['./register-user.component.scss']
})
export class RegisterUserComponent implements OnInit {

  /*  Register Logic
        1. Set variable
        2. Check email repeat
        3. Validation field and enable submit button
        4. Submit button
        5. Email format
  */

  // 1. Set variable
  registerData = {
    username: '',
    email: '',
    password: '',
    fullname: '',
    birth: null,
    isAgree: false,
    isEmail: false,
    isEmailRepeat: true,
    isEmailFormat: false,
    isRegister: false,
    countField: 0
  };

  constructor(
    private http: Http,
    private router: Router
  ) {}

  // 2. Check email repeat
  CheckEmailRepeat(){  
    this.registerData.isEmailFormat = this.CheckEmailFormat(this.registerData.email);

    let options = new RequestOptions();
    let data = {
      email: this.registerData.email
    };
    // let url = 'http://localhost:9000/api/Account/Register/CheckEmailRepeat';
    let url = 'http://api.tourinchiangmai.com/api/Account/Register/CheckEmailRepeat';

    // Call to API
    this.http.post(url, data, options)
                  .map(res => res.json())
                  .subscribe(
                    data => [
                      this.registerData.isEmailRepeat = data.isRepeat
                    ],
                    err => {console.log(err)}
                  );
    if(this.registerData.isEmailRepeat==false && this.registerData.isEmailFormat==true){
      this.registerData.isEmail = true;
    }else{
      this.registerData.isEmail = false;
    }
    this.ValidationField();
    // console.log('Email no repeat : '+this.registerData.isEmail);
    return this.registerData.isEmail;
  }

  // 3. Validation field and enable submit button
  ValidationField(){
    let countField = 0;
    if(this.registerData.isEmail==true){
      countField++;
    }
    if(this.registerData.password.length>1){
      countField++;
    }
    if(this.registerData.fullname.length>1){
      countField++;
    }
    if(this.registerData.birth!=null){
      countField++;
    }
    if(this.registerData.isAgree==true){
      countField++;
    }

    // Open submit btn
    if(countField==5){
      this.registerData.isRegister = true;
    }else{
      this.registerData.isRegister = false;
    }
    // console.log('status : '+this.registerData.isRegister);
  }

  // 4. Submit button
  Submit(){
    let checkEmail = this.CheckEmailRepeat();
    if(this.registerData.isRegister==false){
      // console.log('Please fill data for register.');
      return;
    }else{
      let options = new RequestOptions();
      let data = {
        "email": this.registerData.email,
        "password": this.registerData.password,
        "fullname": this.registerData.fullname,
        "birth": this.registerData.birth
      };
      // let url = 'http://localhost:9000/api/Account/Register/AccountRegister';
      let url = 'http://api.tourinchiangmai.com/api/Account/Register/AccountRegister';

      // Call to API
      this.http.post(url, data, options)
                    .map(res => res.json())
                    .subscribe(
                      // data => console.log(data),
                      data => {this.router.navigate(['user/register-confirm/'+data.token])},
                      err => {console.log(err)}
                    );
      // console.log(JSON.stringify(data));
    } 
  }

  // 5. Email format
  CheckEmailFormat(email){
      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(String(email).toLowerCase());
  }

  ngOnInit() {
    this.ValidationField();
  }

}