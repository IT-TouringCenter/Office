import { Component, OnInit } from '@angular/core';
import { Http, RequestOptions } from '@angular/http';
import { Router, ActivatedRoute } from '@angular/router';

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

  private accountType = <any>"";

  constructor(
    private http: Http,
    private router: Router
  ) { }

  // 1. print
  public print():void {
    window.print();
  }

  // 2. active menu
  public activeMenu(){
    // set storage
    sessionStorage.setItem('menu',JSON.stringify(1));
    sessionStorage.setItem('sub-menu',JSON.stringify(102));
  }

  // 3. get account type
  getAccountType(){
    // let url = "http://localhost:9000/api/Account/GetAccountType";
    let url = "http://api.tourinchiangmai.com/api/Account/GetAccountType";

    this.http.get(url)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        this.addUser.accountType = 0,
                        this.accountType = data
                      ],
                      err => {console.log(err)}
                    );
  }

  // 4. register
  register(){
    // set account
    // let getAccount = JSON.parse(sessionStorage.getItem('users'));
    let getAccount = JSON.parse(localStorage.getItem('users'));
    this.addUser.account = getAccount.data.username;
    this.addUser.accountName = getAccount.data.name;
    this.addUser.email = this.addUser.username;

    console.log(JSON.stringify(this.addUser));
    
    // let url = "http://localhost:9000/api/Dashboard/Admin/UserManagement/Add";
    let url = "http://api.tourinchiangmai.com/api/Dashboard/Admin/UserManagement/Add";

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

  // 5. alert register
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
