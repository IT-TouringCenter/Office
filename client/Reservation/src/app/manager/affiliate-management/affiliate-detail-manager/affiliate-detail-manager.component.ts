import { Component, OnInit } from '@angular/core';
import { Http, RequestOptions } from '@angular/http';
import { Router, ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-affiliate-detail-manager',
  templateUrl: './affiliate-detail-manager.component.html',
  styleUrls: ['./affiliate-detail-manager.component.scss']
})
export class AffiliateDetailManagerComponent implements OnInit {

  // variable
  userToken = <any>"";
  affiliateData = <any>"";

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

  public getAffiliateDetail(){
    // get token
    let getUser = JSON.parse(localStorage.getItem('users'));
    let token = getUser.data.token;

    // set data
    let setData = {
      token: token,
      userToken: this.userToken
    };
    console.log(setData);

    // post to API
    let url = 'http://localhost:9000/api/Dashboard/Manager/AffiliateManagement/Detail';
    // let url = 'http://api.tourinchiangmai.com/api/Dashboard/Manager/AffiliateManagement/Detail';

    let options = new RequestOptions();

    return this.http.post(url, setData, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        this.affiliateData = data.data,
                        console.log(this.affiliateData)
                      ],
                      err => [
                        console.log(err)
                      ]
                    );
  }

  ngOnInit() {
    this.activeMenu();
    this.getAffiliateDetail();
  }

}
