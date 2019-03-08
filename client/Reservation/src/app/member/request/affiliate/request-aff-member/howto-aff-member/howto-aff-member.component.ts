import { Component, OnInit } from '@angular/core';
import { Http, RequestOptions } from '@angular/http';
import { Router } from '@angular/router';

@Component({
  selector: 'app-howto-aff-member',
  templateUrl: './howto-aff-member.component.html',
  styleUrls: ['./howto-aff-member.component.scss']
})
export class HowtoAffMemberComponent implements OnInit {

  requestAffiliate = <any>'';

  constructor(
    private http: Http,
    private router: Router
  ) { }

  // 1. active menu
  public activeMenu(){
    // set storage
    sessionStorage.setItem('menu',JSON.stringify(2));
    sessionStorage.setItem('sub-menu',JSON.stringify(2));
  }

  // 2. join now
  joinNow(){
    this.router.navigate(['user/member/request/affiliate/step1']);
  }

  // 3. check request affiliate
  // 3.1 
  checkMemberRequestAffiliate(){
    let token = <any>'';

    // get user
    let getUser = JSON.parse(localStorage.getItem('users'));
    if(getUser){
      let token = getUser.data.token;
    }else{
      this.router.navigate(['user/logout']);
    }

    // set data
    let setData = {
      "token": getUser.data.token
    };

    // post for check request affiliate : API
    // let url = 'http://localhost:9000/api/Dashboard/Member/CheckRequestJoinAffiliate';
    let url = 'http://api.tourinchiangmai.com/api/Dashboard/Member/CheckRequestJoinAffiliate';

    let options = new RequestOptions();

    return this.http.post(url, setData, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        sessionStorage.setItem('request-aff',JSON.stringify(data)),
                        this.checkRequestAffiliate(data)
                      ],
                      err => [
                        console.log(err)
                      ]
                    );
  }

  // 3.2 
  checkRequestAffiliate(data){
    // get session
    // let getRequestAff = JSON.parse(sessionStorage.getItem('request-aff'));
    // console.log(JSON.stringify(data));
    let getRequestAff = data;

    if(getRequestAff.message=='Complete'){
      this.requestAffiliate = true;
    }else{
      this.requestAffiliate = false;
    }
    
  }

  ngOnInit() {
    this.activeMenu();
    this.checkMemberRequestAffiliate();
  }

}
