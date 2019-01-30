import { Component, OnInit } from '@angular/core';
import { Http, RequestOptions } from '@angular/http';
import { Router, ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-user-manage-edit-admin',
  templateUrl: './user-manage-edit-admin.component.html',
  styleUrls: ['./user-manage-edit-admin.component.scss']
})
export class UserManageEditAdminComponent implements OnInit {

  private token = <any>"";

  private editUser = {
    accountName: <any>"",
    userToken: <any>"",
    username: <any>"",
    fullname: <any>"",
    userType: <any>"",
    email: <any>""
  };

  private userType;

  constructor(
    private http: Http,
    private router: Router,
    private route: ActivatedRoute
  ) {
    let _params = this.route.snapshot.paramMap.get(('userId'));
    this.token = _params;
  }

  // 1. get account type
  getAccountType(){
    // let url = "http://localhost:9000/api/Account/GetAccountType";
    let url = "http://api.tourinchiangmai.com/api/Account/GetAccountType";

    /*==================  Success  ===================*/
    this.http.get(url)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        // console.log(data),
                        this.userType = data
                      ],
                      err => {console.log(err)}
                    );
    /*==================  Success  ===================*/
  }

  // 2. get user data
  getUserData(){
    // let url = "http://localhost:9000/api/Dashboard/Admin/UserManagement/Edit";
    let url = "http://api.tourinchiangmai.com/api/Dashboard/Admin/UserManagement/Edit";

    let _token = {
      token: this.token
    };

    console.log(_token);
    // return;

    let options = new RequestOptions();
    /*==================  Success  ===================*/
    this.http.post(url, _token, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        console.log(data),
                        this.setDefaultData(data)
                      ],
                      err => {console.log(err)}
                    );
    /*==================  Success  ===================*/
  }

  // . set default user data
  setDefaultData(data){
    console.log('setDefaultData');
    this.editUser.username = data.username;
    this.editUser.userType = data.userType;
    this.editUser.fullname = data.fullname;
    this.editUser.email = data.email;
  }

  // 2. register
  editRegister(){
    // set account
    // let getAccount = JSON.parse(sessionStorage.getItem('users'));
    let getAccount = JSON.parse(localStorage.getItem('users'));
    this.editUser.accountName = getAccount.data.name;
    this.editUser.userToken = this.token;

    // let url = "http://localhost:9000/api/Dashboard/Admin/UserManagement/Edit/Save";
    let url = "http://api.tourinchiangmai.com/api/Dashboard/Admin/UserManagement/Edit/Save";

    let options = new RequestOptions();
    /*==================  Success  ===================*/
    this.http.post(url, this.editUser, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        this.checkRegister(data)
                      ],
                      err => {console.log(err)}
                    );
    /*==================  Success  ===================*/
    setTimeout(()=>{
      
    }, 500);
  }

  // 3. alert register
  checkRegister(data){
    if(data.status==true){
      alert(data.message);
      this.router.navigate(['user/admin/user-manage']);
    }else{
      alert(data.message);
      return;
    }
    
  }

  // close window
  close(){
    if(confirm("Are you sure? for close windows.")){
      window.close();
    }else{

    }
  }

  ngOnInit() {
    this.getAccountType();
    this.getUserData();
  }

}