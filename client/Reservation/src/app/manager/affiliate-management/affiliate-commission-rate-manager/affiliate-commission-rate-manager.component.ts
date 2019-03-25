import { Component, OnInit } from '@angular/core';
import { Http, RequestOptions } from '@angular/http';
import { Router, ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-affiliate-commission-rate-manager',
  templateUrl: './affiliate-commission-rate-manager.component.html',
  styleUrls: ['./affiliate-commission-rate-manager.component.scss']
})
export class AffiliateCommissionRateManagerComponent implements OnInit {

  // variable
  getUser = <any>"";

  userToken = <any>"";
  commissionRateData = <any>"";
  comRate = <any>[];
  length = 0;

  constructor(
    private http: Http,
    private router: Router,
    private route: ActivatedRoute
  ) {
    let _params = this.route.snapshot.paramMap.get(('userId'));
    this.userToken = _params;
  }

  // 1. print
  public print():void {
    window.print();
  }

  // 2. active menu
  public activeMenu(){
    // set storage
    sessionStorage.setItem('menu',JSON.stringify(3));
    sessionStorage.setItem('sub-menu',JSON.stringify(301));
  }

  // 3. window back
  public windowBack(){
    let url = 'user/manager/affiliate-management/profile/'+this.userToken;
    this.router.navigate([url]);
    // return;
  }

  // 4. get data from api
  public getCommissionRate(){
    let token = <any>'';

    // get user
    this.getUser = JSON.parse(localStorage.getItem('users'));
    if(this.getUser){
      let token = this.getUser.data.token;
    }else{
      this.router.navigate(['user/logout']);
    }

    // set data
    let setData = {
      "token": this.getUser.data.token,
      "userToken": this.userToken
    };

    // post for check request affiliate : API
    // let url = 'http://localhost:9000/api/Dashboard/Manager/AffiliateManagement/CommissionRate';
    let url = 'http://api.tourinchiangmai.com/api/Dashboard/Manager/AffiliateManagement/CommissionRate';

    let options = new RequestOptions();

    return this.http.post(url, setData, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        this.bindingData(data.data)
                      ],
                      err => [
                        console.log(err)
                      ]
                    );
  }

  // 5. binding data
  public bindingData(data){
    this.commissionRateData = data;
    this.length = this.commissionRateData.commissionRate.length;

    for(let i=0; i<this.length; i++){
      this.comRate[i] = this.commissionRateData.commissionRate[i].commissionRate;
    }
  }

  // . update commission rate
  public updateCommissionRate(){
    // set data
    let comRateArr = [];

    for(let i=0; i<this.length; i++){
      let comRate = {
        tour: this.commissionRateData.commissionRate[i].tourId,
        rate: this.comRate[i]
      };
      comRateArr.push(comRate);
    }

    let setData = {
      token: this.getUser.data.token,
      userToken: this.userToken,
      commissionRate: comRateArr
    };
    
    // post update to api
    // let url = 'http://localhost:9000/api/Dashboard/Manager/AffiliateManagement/CommissionRate/Update';
    let url = 'http://api.tourinchiangmai.com/api/Dashboard/Manager/AffiliateManagement/CommissionRate/Update';

    let options = new RequestOptions();

    return this.http.post(url, setData, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        alert('Update complete!'),
                        this.router.navigate(['user/manager/affiliate-management/profile/'+this.userToken]),
                        // this.getCommissionRate() // reload data
                      ],
                      err => [
                        console.log(err)
                      ]
                    );
  }

  ngOnInit() {
    this.activeMenu();
    this.getCommissionRate();
  }

}