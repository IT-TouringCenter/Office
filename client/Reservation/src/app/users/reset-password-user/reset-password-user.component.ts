import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from "@angular/router";
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Router } from '@angular/router';
import "rxjs/Rx";

@Component({
  selector: 'app-reset-password-user',
  templateUrl: './reset-password-user.component.html',
  styleUrls: ['./reset-password-user.component.scss'],
  providers: []
})
export class ResetPasswordUserComponent implements OnInit {

  data = {
    username: '',
    password: '',
    confirmPassword: '',
    resetCode: '',
    isMismatch: true
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
    1. Get account data by token
    2. Set account data binding
    3. Check password mismatch
    4. Reset password
    5. Send reset code again
  */

  // 1. Get account data by token
  getAccountData(){
    // Call API
    let url = 'http://localhost:9000/api/Account/GetAccountByToken';
    // let url = 'http://api.tourinchiangmai.com/api/Account/GetAccountByToken';

    let options = new RequestOptions();
    let accountData = {
      token: this.accountToken,
    };

    return this.http.post(url, accountData, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        // console.log(data),
                        this.setDataBinding(data)
                      ],
                      err => [
                        console.log(err)
                      ]
                    );
  }

  // 2. Set account data binding
  setDataBinding(accountData){
    if(accountData.status==true){
      this.data.username = accountData.username;
    }else{
      alert('Can\'t get account data.');
      this.data.username = '';
    }
    
  }

  // 3. Check pass mismatch
  checkPasswordMismatch(){
    if(this.data.password==this.data.confirmPassword){
      // console.log(this.data.password+' = '+this.data.confirmPassword);
      return false;
    }else{
      // console.log(this.data.password+' != '+this.data.confirmPassword);
      return true;
    }
  }

  // 4. Reset password
  resetPassword(){
    
    let mismatch = this.checkPasswordMismatch();
    if(mismatch==false){
      this.data.isMismatch = false;
      // console.log(this.data.isMismatch);
    }else{
      this.data.isMismatch = true;
      // console.log(this.data.isMismatch);
      return;
    }

    // Call API
    if(this.data.isMismatch==false){
      let url = 'http://localhost:9000/api/Account/Setting/AccountResetPassword';
      // let url = 'http://api.tourinchiangmai.com/api/Account/Setting/AccountResetPassword';

      let options = new RequestOptions();
      let accountData = {
        email: this.data.username,
        password: this.data.password,
        resetCode: this.data.resetCode
      };

      return this.http.post(url, accountData, options)
                      .map(res => res.json())
                      .subscribe(
                        data => [
                          // console.log(data),
                          this.router.navigate(['user/login'])
                        ],
                        err => [
                          console.log(err)
                        ]
                      );
    }
  }

  // 5. Send reset code again
  sendResetCodeAgain(){
    let url = 'http://localhost:9000/api/Account/Request/AccountForgotPassword';
    // let url = 'http://api.tourinchiangmai.com/api/Account/Request/AccountForgotPassword';

    let options = new RequestOptions();
    let dataSave = {
        "email": this.data.username,
    };

    return this.http.post(url, dataSave, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        alert('Send new reset code complete.')
                        // this.checkAccountEmpty(data)
                      ],
                      err => {console.log(err)}
                    );
  }

  ngOnInit() {
    this.getAccountData();
  }

}
