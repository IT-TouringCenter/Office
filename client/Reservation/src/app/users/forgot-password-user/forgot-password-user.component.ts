import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from "@angular/router";
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Router } from '@angular/router';
import "rxjs/Rx";

@Component({
  selector: 'app-forgot-password-user',
  templateUrl: './forgot-password-user.component.html',
  styleUrls: ['./forgot-password-user.component.scss'],
  providers: []
})
export class ForgotPasswordUserComponent implements OnInit {

  data = {
    email: ''
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
    1. Submit
    2. Check account empty
  */

  // 1. Submit
  submit(){
    let url = 'http://localhost:9000/api/Account/Request/AccountForgotPassword';
    // let url = 'http://api.tourinchiangmai.com/api/Account/Request/AccountForgotPassword';

    let options = new RequestOptions();
    let dataSave = {
        "email": this.data.email,
    };

    return this.http.post(url, dataSave, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        this.checkAccountEmpty(data)
                      ],
                      err => {console.log(err)}
                    );
  }

  // 2. Check account empty
  checkAccountEmpty(accountData){
    if(accountData.status==true){
      alert(accountData.message);
      this.router.navigate(['user/reset-password/'+accountData.data.token]);
    }else{
      alert(accountData.message);
    }
  }

  ngOnInit() {
  }

}
