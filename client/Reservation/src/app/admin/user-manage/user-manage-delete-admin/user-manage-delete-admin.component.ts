import { Component, OnInit } from '@angular/core';
import { Http, RequestOptions } from '@angular/http';
import { Router, ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-user-manage-delete-admin',
  templateUrl: './user-manage-delete-admin.component.html',
  styleUrls: ['./user-manage-delete-admin.component.scss']
})
export class UserManageDeleteAdminComponent implements OnInit {

  private token = <any>"";

  private deleteUser = {
    accountName: <any>"",
    userToken: <any>""
  };

  constructor(
    private http: Http,
    private router: Router,
    private route: ActivatedRoute
  ) {
    let _params = this.route.snapshot.paramMap.get(('userId'));
    this.token = _params;
  }

  // 
  getUserData(){
    let url = "http://localhost:9000/api/Dashboard/Admin/UserManagement/Delete";
    // let url = "http://api.tourinchiangmai.com/api/Dashboard/Admin/UserManagement/Delete";

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
                        console.log(data)
                      ],
                      err => {console.log(err)}
                    );
    /*==================  Success  ===================*/
  }

  ngOnInit() {
    this.getUserData();
  }

}
