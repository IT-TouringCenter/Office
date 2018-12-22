import { Component, OnInit } from '@angular/core';
import { FormsModule, FormControl, Validators } from '@angular/forms';
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';
import { HttpClient, HttpErrorResponse, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs/observable';

@Component({
  selector: 'app-user-manage-add-admin',
  templateUrl: './user-manage-add-admin.component.html',
  styleUrls: ['./user-manage-add-admin.component.scss']
})
export class UserManageAddAdminComponent implements OnInit {

  private addUser = {
    account: <any>"",
    accountName: <any>"",
    accountType: <any>"",
    username: <any>"",
    password: <any>"",
    fullname: <any>"",
    email: <any>""
  };

  private accountType;

  constructor(
    private http: Http,
    private router: Router,
    private route: ActivatedRoute
  ) { }

  // 1. print
  public print():void {
    window.print();
  }

  // 2. get account type
  getAccountType(){
    let url = "http://localhost:9000/api/Account/GetAccountType";
    // let url = "http://api.tourinchiangmai.com/api/Account/GetAccountType";

    /*==================  Success  ===================*/
    this.http.get(url)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        console.log(data),
                        this.accountType = data
                      ],
                      err => {console.log(err)}
                    );
    /*==================  Success  ===================*/
  }

  // 3. register
  register(){
    // set account
    let getAccount = JSON.parse(sessionStorage.getItem('users'));
    this.addUser.account = getAccount.data.username;
    this.addUser.accountName = getAccount.data.name;
    this.addUser.email = this.addUser.username;
    
    let url = "http://localhost:9000/api/Dashboard/Admin/UserManagement/Add";
    // let url = "http://api.tourinchiangmai.com/api/Dashboard/Admin/UserManagement/Add";

    let options = new RequestOptions();
    /*==================  Success  ===================*/
    this.http.post(url, this.addUser, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        this.checkRegister(data),
                        // this.router.navigate(['/#/user/admin/user-manage'])
                      ],
                      err => {console.log(err)}
                    );
    /*==================  Success  ===================*/
    setTimeout(()=>{
      
    }, 500);
  }

  // 4. alert register
  checkRegister(data){
    if(data.status==true){
      alert(data.message);
      this.router.navigate(['user/admin/user-manage']);
    }else{
      alert(data.message);
      return;
    }
    
  }

  ngOnInit() {
    this.getAccountType();
  }

}
