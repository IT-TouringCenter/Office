import { Component, OnInit } from '@angular/core';
import { Http, RequestOptions } from '@angular/http';
import { Router, ActivatedRoute } from '@angular/router';
import { stringify } from '@angular/compiler/src/util';

@Component({
  selector: 'app-user-manage-delete-admin',
  templateUrl: './user-manage-delete-admin.component.html',
  styleUrls: ['./user-manage-delete-admin.component.scss']
})
export class UserManageDeleteAdminComponent implements OnInit {

  private token = <any>"";

  private deleteUserData = {
    accountToken: <any>"",
    accountName: <any>"",
    userToken: <any>""
  };

  private username;

  constructor(
    private http: Http,
    private router: Router,
    private route: ActivatedRoute
  ) {
    let _params = this.route.snapshot.paramMap.get(('userId'));
    this.token = _params;
  }

  // 
  getAccountStorage(){
    // get account data
    let getAccount = JSON.parse(sessionStorage.getItem('users'));

    this.deleteUserData.accountToken = getAccount.data.token;
    this.deleteUserData.accountName = getAccount.data.name;
    this.deleteUserData.userToken = this.token;

  }

  // 
  getUserData(){
    let url = "http://localhost:9000/api/Dashboard/Admin/UserManagement/Delete";
    // let url = "http://api.tourinchiangmai.com/api/Dashboard/Admin/UserManagement/Delete";

    let options = new RequestOptions();
    /*==================  Success  ===================*/
    this.http.post(url, this.deleteUserData, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        console.log(data.data[0].username),
                        this.username = data.data[0].username
                      ],
                      err => {console.log(err)}
                    );
    /*==================  Success  ===================*/
  }

  // 
  deleteUser(){
    if(confirm('Are you sure you want to delete the user?')){
      let url = "http://localhost:9000/api/Dashboard/Admin/UserManagement/Delete/Save";
      // let url = "http://api.tourinchiangmai.com/api/Dashboard/Admin/UserManagement/Delete/Save";

      let options = new RequestOptions();
      /*==================  Success  ===================*/
      return this.http.post(url, this.deleteUserData, options)
                      .map(res => res.json())
                      .subscribe(
                        data => [
                          this.router.navigate(['user/admin/user-manage'])
                        ],
                        err => {console.log(err)}
                      );
      /*==================  Success  ===================*/
    }else{
      return;
    }
    
  }

  ngOnInit() {
    this.getAccountStorage();
    this.getUserData();
  }

}
