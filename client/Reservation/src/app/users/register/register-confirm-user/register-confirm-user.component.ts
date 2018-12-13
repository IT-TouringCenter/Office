import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from "@angular/router";
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Router } from '@angular/router';
import "rxjs/Rx";

// Services
import { RegisterConfirmUserService } from "./register-confirm-user.service";

// Interfaces
import { RegisterConfirmUserInterface } from "./register-confirm-user-interface";

@Component({
  selector: 'app-register-confirm-user',
  templateUrl: './register-confirm-user.component.html',
  styleUrls: ['./register-confirm-user.component.scss'],
  providers: [ RegisterConfirmUserService ]
})
export class RegisterConfirmUserComponent implements OnInit {

  data = {
    user: '',
    code: '',
    isCode: '',
    message: ''
  };
  accountToken;

  _getAccountData: RegisterConfirmUserInterface.RootObject;

  constructor(
    private registerConfirmUserService: RegisterConfirmUserService,
    private http: Http,
    private router: Router,
    private route: ActivatedRoute
  ) {
    let _params = this.route.snapshot.paramMap.get(('userId'));
    this.accountToken = _params;
  }

  /*
    1. JSON account code data
    2. Set data binding
    3. Confirm register (Save)
    4. Check active user & return to login
  */

  // 1. JSON account code data
  getAccountData(): void {
    this.registerConfirmUserService.getAccountData()
      .subscribe(
        resultArray => [
          this._getAccountData = resultArray,
          this.setDataBinding()
        ],
        // error => console.log("Error :: " + error)
      )
  }

  // 2. Set data binding
  setDataBinding(){
    if(this._getAccountData.status==true){
      this.data.user = this._getAccountData.email;
    }else{
      alert('This username has already been verified.');
      this.router.navigate(['user/login']);
    }
  }

  // 3. Confirm register (Save)
  confirmRegister(){
    // let url = 'http://localhost:9000/api/Account/Register/AccountRegisterConfirm';
    let url = 'http://api.tourinchiangmai.com/api/Account/Register/AccountRegisterConfirm';

    let options = new RequestOptions();
    let dataSave = {
        "email": this.data.user,
        "registerCode": this.data.code
    };

    /*==================  Success  ===================*/
    // return this.http.post(url, dataSave, options)
    return this.http.post(url, dataSave, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        this.checkActiveUser(data)
                      ],
                      err => {console.log(err)}
                    );
    /*==================  Success  ===================*/
  }

  // 4. Check active user & return to login
  checkActiveUser(data){
    if(data.status=='Success'){
      alert(data.message);
      this.router.navigate(['user/login']);
    }else{
      alert(data.message);
    }
  }

  // 5. Send confirm code again
  sendConfirmCodeAgain(){
    // let url = 'http://localhost:9000/api/Account/Register/AccountRegisterConfirmCodeAgain';
    let url = 'http://api.tourinchiangmai.com/api/Account/Register/AccountRegisterConfirmCodeAgain';

    let options = new RequestOptions();
    let dataSave = {
        "token": this.accountToken
    };

    /*==================  Success  ===================*/
    // return this.http.post(url, dataSave, options)
    return this.http.post(url, dataSave, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        alert(data.message)
                      ],
                      err => {console.log(err)}
                    );
    /*==================  Success  ===================*/
  }

  ngOnInit() {
    this.getAccountData();
  }

}
