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
        5. Check email format
  */

  // 1. Set variable
  registerData = {
    username: '',
    email: '',
    password: '',
    fullname: '',
    birth: null,
    isAgree: false,
    isEmailRepeat: false,
    isRegister: false,
    countField: 0
  };

  myform: FormGroup;

  constructor(
    private http: Http,
    private router: Router
  ) {}

  // 2. Check email repeat
  CheckEmailRepeat(){
    let options = new RequestOptions();
    let data = {
      email: this.registerData.email
    }
    let url = 'http://localhost:9000/api/Account/Register/CheckEmailRepeat';
    // let url = 'http://api.tourinchiangmai.com/api/Account/Register/CheckEmailRepeat';

    // Call to API
    this.http.post(url, data, options)
                  .map(res => res.json())
                  .subscribe(
                    data => [
                      // this.registerData.isRegister = data.isRegister,
                      // this.registerData.isEmailRepeat = data.isRegister
                    ],
                    err => {console.log(err)}
                  );
    this.ValidationField();
  }

  // 3. Validation field and enable submit button
  ValidationField(){
    let countField = 0;
    if(this.registerData.email.length>1){
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

    console.log('count field : '+countField);

    if(countField==5){
      this.registerData.isRegister = true;
      console.log('Status : '+this.registerData.isRegister);
    }else{
      this.registerData.isRegister = false;
    }
  }

  // 4. Submit button
  Submit(){
    if(this.registerData.isRegister==false){
      console.log('Please fill data for register.');
      return;
    }else{
      let options = new RequestOptions();
      let data = {
        "email": this.registerData.email,
        "password": this.registerData.password,
        "fullname": this.registerData.fullname,
        "birth": this.registerData.birth
      }
      let url = 'http://localhost:9000/api/Account/Register/AccountRegister';
      // let url = 'http://api.tourinchiangmai.com/api/Account/Register/AccountRegister';

      // Call to API
      this.http.post(url, data, options)
                    .map(res => res.json())
                    .subscribe(
                      // data => console.log(data),
                      data => {this.router.navigate(['user/'+data.token+'/register-confirm'])},
                      err => {console.log(err)}
                    );
      console.log(JSON.stringify(data));
    } 
  }

  // 5. Check email format
  CheckEmailFormat(){

  }


  ngOnInit() {
    // this.ValidationField();
    // this.CheckEmailRepeat();
  }

}