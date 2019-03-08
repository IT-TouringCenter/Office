import { Component, OnInit } from '@angular/core';
import { Http, RequestOptions } from '@angular/http';
import { Router, ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-user-request-admin',
  templateUrl: './user-request-admin.component.html',
  styleUrls: ['./user-request-admin.component.scss']
})
export class UserRequestAdminComponent implements OnInit {

  public highlightId :number;
  public getRequest = <any>[];

  // page
  public routeLink = "['/user/admin/user-manage']";

  public iPage: number[] = [];
  public iPageStart: number = 1;
  public prevPage: number;
  public nextPage: number;
  public activePage: number;
  public totalItem: number;
  public perPage: number = 25;
  public totalPage: number;
  public maxShowPage: number;
  public useShowPage: number = 5;
  public pointStart: number = 0;
  public pointEnd: number;

  //
  profileData = <any>'';
  bankData = <any>'';
  statusData = <any>'';
  userRequestStatus = <any>'';
  
  constructor(
    private http: Http,
    private router: Router,
    private route: ActivatedRoute
  ) { }

  // 1. print
  public print():void {
    window.print();
  }

  // 2. active menu
  public activeMenu(){
    // set storage
    sessionStorage.setItem('menu',JSON.stringify(2));
    sessionStorage.setItem('sub-menu',JSON.stringify(201));
  }

  // 
  // JSON booked stat from API
  getRequestData(): void{
    // let url = "http://localhost:9000/api/Dashboard/Admin/UserRequest";
    let url = "http://api.tourinchiangmai.com/api/Dashboard/Admin/UserRequest";

    // set data to save
    let _getUserData = JSON.parse(localStorage.getItem('users'));
    let dataSave = {
      token : _getUserData.data.token
    };

    let options = new RequestOptions();
    this.http.post(url, dataSave, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        this.getRequest = data,
                        // console.log(this.getRequest),
                        this.lengthDataFromGet(data),
                        this.PagePagination()
                      ],
                      err => {console.log(err)}
                    );
  }

  // Dialog
  // profile
  openDialogProfile(token){
    // let url = "http://localhost:9000/api/Dashboard/Admin/GetUserProfile";
    let url = "http://api.tourinchiangmai.com/api/Dashboard/Admin/GetUserProfile";

    let dataSave = {
      token : token
    };

    let options = new RequestOptions();
    this.http.post(url, dataSave, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        // this.profileData = data.data,
                        this.setProfileData(data.data),
                        // console.log(JSON.stringify(this.profileData))
                      ],
                      err => {console.log(err)}
                    );
  }

  // set profile data
  setProfileData(data){
    this.profileData = data.profile;
    this.bankData = data.bank;

    if(this.bankData.bankOther==''){
      this.bankData.bank = this.bankData.bankEN;
    }else{
      this.bankData.bank = this.bankData.bankOther;
    }
  }

  // status
  openDialogStatus(accountData){
    // let url = "http://localhost:9000/api/Account/AccountRequestStatus";
    let url = "http://api.tourinchiangmai.com/api/Account/AccountRequestStatus";

    let dataSave = {
      token : accountData.token
    };

    let options = new RequestOptions();
    this.http.post(url, dataSave, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        this.setStatusData(data.data, accountData)
                      ],
                      err => {console.log(err)}
                    );
  }

  setStatusData(data, accountData){
    this.statusData = data; // api
    this.profileData = accountData; // table

    for(var i in this.statusData){
      if(this.statusData[i].id==this.profileData.statusId){
        this.userRequestStatus = this.statusData[i].id;
        // console.log('true : '+i+') '+this.statusData[i].id+' = '+this.profileData.statusId);
      }else{
        // console.log('false : '+i+') '+this.statusData[i].id+' = '+this.profileData.statusId);
      }
    }
  }

  // Save status
  changeStatus(){
    let status = this.userRequestStatus;
    let data = this.profileData;

    // let url = "http://localhost:9000/api/Dashboard/Admin/UserRequest/Update";
    let url = "http://api.tourinchiangmai.com/api/Dashboard/Admin/UserRequest/Update";

    let dataSave = {
      token : data.token,
      status: status,
      request: data.requestId,
      requestType: data.typeId
    };

    let options = new RequestOptions();
    this.http.post(url, dataSave, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        console.log(data),
                        this.getRequestData()
                      ],
                      err => {console.log(err)}
                    );
  }


  //------------------ Start Page ------------------------
  // Length data
  lengthDataFromGet(getRequest){
    this.getRequest = getRequest;

    let count = 0;
    for(var request in getRequest.data){
      count++;
    }
    this.totalItem = count;
  }

  PagePagination(){
    this.activePage = 1;
    this.nextPage = 2;
    this.pointEnd = this.perPage*this.activePage;

    this.totalPage = Math.ceil(this.totalItem/this.perPage);
    if(this.totalPage>this.useShowPage){
      this.useShowPage = 5;
    }else{
      this.useShowPage = this.totalPage;
    }

    for(let i=this.iPageStart; i<=this.useShowPage; i++){
      this.iPage.push(i);
    }

    this.route
        .queryParams
        .subscribe((data: {page: any}) => {
          if(data!=null && data.page!=null){
            this.activePage = +data.page;
            this.prevPage = this.activePage-1;
            this.nextPage = this.activePage+1;
            this.pointStart = (this.activePage-1)*this.perPage;
            this.pointEnd = this.perPage*this.activePage;
            this.pagination();
          }
        });

    let params = this.route.snapshot.paramMap;
    if(params.has('userId')){
      this.highlightId = +params.get('userId');
    }
  }

  changePage(page:number){
    this.activePage = page;
    let link = '/user/admin/use-request';
    this.router.navigate([link], {queryParams:{page:page}});
    // this.router.navigate([link], {queryParams:{page:page}});
  }

  pagination(){
    if(this.activePage > this.useShowPage){
      if(this.activePage+2 <= this.totalPage){
        this.iPageStart = this.activePage-2;
        this.maxShowPage = this.activePage+2;
      }else{
        if(this.activePage <= this.totalPage){
          this.iPageStart = (this.totalPage+1)-this.useShowPage;
          this.maxShowPage = (this.iPageStart-1)+this.useShowPage;
        }
      }
      this.iPage = [];
      for(let i=this.iPageStart; i<=this.maxShowPage; i++){
        this.iPage.push(i);
      }
    }else{
      this.iPageStart = 1;
      this.iPage = [];
      for(let i=this.iPageStart; i<=this.useShowPage; i++){
        this.iPage.push(i);
      }
    }
  }
  //------------------ End Page ------------------------

  ngOnInit() {
    this.activeMenu();
    this.getRequestData();
  }

}
