import { Component, OnInit } from '@angular/core';
import { Http, RequestOptions } from '@angular/http';
import { Router, ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-affiliate-all-commission-rate-manager',
  templateUrl: './affiliate-all-commission-rate-manager.component.html',
  styleUrls: ['./affiliate-all-commission-rate-manager.component.scss']
})
export class AffiliateAllCommissionRateManagerComponent implements OnInit {

  // variable
  getUser = <any>"";
  affiliateType = [
    {type: "Affiliate"},
    {type: "Affiliate intern"}
  ];

  userType = <any>"";
  tourData = <any>"";
  commissionRateData = <any>"";
  comRate = <any>[];
  length = 0;

  constructor(
    private http: Http,
    private router: Router,
    private route: ActivatedRoute
  ) {
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
    let url = 'user/manager/affiliate-management';
    this.router.navigate([url]);
  }

  // 4. get data from api
  public getTourData(){
    let token = <any>'';

    // get user
    this.getUser = JSON.parse(localStorage.getItem('users'));
    if(this.getUser){
      let token = this.getUser.data.token;
    }else{
      this.router.navigate(['user/logout']);
    }

    // post for check request affiliate : API
    // let url = 'http://localhost:9000/api/Tours/GetTourData';
    let url = 'http://api.tourinchiangmai.com/api/Tours/GetTourData';

    return this.http.get(url)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        this.bindingData(data)
                      ],
                      err => [
                        console.log(err)
                      ]
                    );
  }

  // 5. binding data
  public bindingData(data){
    this.tourData = data;
    this.length = this.tourData.length;

    for(let i=0; i<this.length; i++){
      this.comRate[i] = 0;
    }
  }

  // 6. update commission rate
  public updateCommissionRate(){
    // set data
    let comRateArr = [];

    for(let i=0; i<this.length; i++){
      let comRate = {
        tour: this.tourData[i].id,
        rate: this.comRate[i]
      };
      comRateArr.push(comRate);
    }

    let setData = {
      token: this.getUser.data.token,
      userType: this.userType,
      commissionRate: comRateArr
    };
    
    // post update to api
    // let url = 'http://localhost:9000/api/Dashboard/Manager/AffiliateManagement/CommissionRate/UpdateAll';
    let url = 'http://api.tourinchiangmai.com/api/Dashboard/Manager/AffiliateManagement/CommissionRate/UpdateAll';

    let options = new RequestOptions();

    return this.http.post(url, setData, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        alert('Update complete!'),
                        this.router.navigate(['user/manager/affiliate-management']),
                      ],
                      err => [
                        console.log(err)
                      ]
                    );
  }

  ngOnInit() {
    this.activeMenu();
    this.getTourData();
  }

}