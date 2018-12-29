import { Component, OnInit, Inject } from '@angular/core';
import { Http, RequestOptions } from '@angular/http';
import { Router, ActivatedRoute } from '@angular/router';

export interface DialogData{
  animal: string;
  name: string;
}

@Component({
  selector: 'app-user-manage-active-admin',
  templateUrl: './user-manage-active-admin.component.html',
  styleUrls: ['./user-manage-active-admin.component.scss']
})
export class UserManageActiveAdminComponent implements OnInit {

  public highlightId :number;
  public getUser = <any>[];
  public activeData = [
    {
      status: "Active",
      active: 1
    },
    {
      status: "Non active",
      active: 0
    }
  ];
  public userActive = {
    accountToken: <any>"",
    accountName: <any>"",
    userToken: <any>"",
    active: <any>""
  };
  public userActiveNow;
  public routeLink = "['/user/admin/user-manage']";
  
  // dialog
  public dialogData = {
    // userToken: <any>"",
    // active: <any>"",
    // data: []
  };
  public dialogActive = <any>"";

  // page
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
    sessionStorage.setItem('menu',JSON.stringify(1));
    sessionStorage.setItem('sub-menu',JSON.stringify(101));
  }

  // JSON booked stat from API
  getUserData(): void{
    let url = "http://localhost:9000/api/Dashboard/Admin/UserManagement/Active";
    // let url = "http://api.tourinchiangmai.com/api/Dashboard/Admin/UserManagement/Active";

    // set data to save
    let _getUserData = JSON.parse(sessionStorage.getItem('users'));
    let dataSave = {
      token : _getUserData.data.token
    };

    let options = new RequestOptions();
    /*==================  Success  ===================*/
    this.http.post(url, dataSave, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        // this.getUser = data,
                        this.pushActiveData(data),
                        // console.log(this.getUser)
                      ],
                      err => {console.log(err)}
                    );
    /*==================  Success  ===================*/
    setTimeout(()=>{
      this.lengthDataFromGet(this.getUser);
      this.PagePagination();
    }, 500);
  }

  // Set default data
  pushActiveData(data){
    this.getUser = data;
    let length = this.getUser.data.length;

    for(let i=0; i<length; i++){
      // this.getUser.data[i].push(this.activeData);
      this.getUser.data[i].activeData = this.activeData;
    }
    // console.log(this.getUser);
  }

  // Save active
  saveActive(){
    // set data for save
    let getAccount = JSON.parse(sessionStorage.getItem('users'));
    this.userActive.accountToken = getAccount.data.token;
    this.userActive.accountName = getAccount.data.name;

    let url = "http://localhost:9000/api/Dashboard/Admin/UserManagement/Active/Save";
    // let url = "http://api.tourinchiangmai.com/api/Dashboard/Admin/UserManagement/Active/Save";

    let options = new RequestOptions();
    /*==================  Success  ===================*/
    this.http.post(url, this.userActive, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        console.log(data),
                        alert("Complete."),
                        window.location.reload()
                      ],
                      err => [
                        alert("Please change the value."),
                        console.log(err)
                      ]
                    );
    /*==================  Success  ===================*/
  }

  //------------------ Dialog ----------------------------
  openDialog(token){
    // set dialog data
    let length = this.getUser.data.length;
    for(let i=0; i<length; i++){
      if(this.getUser.data[i].token==token){
        this.userActive.userToken = token;
        this.dialogData = this.getUser.data[i];
        this.dialogActive = this.getUser.data[i].status;
      }
    }
    // console.log('-----------------');
    console.log(this.getUser);

  }

  // 
  save(){
    // set data for save
    let getAccount = JSON.parse(sessionStorage.getItem('users'));
    this.userActive.accountToken = getAccount.data.token;
    this.userActive.accountName = getAccount.data.name;

    console.log('----------------------');
    console.log(this.userActive);
    console.log('----------------------');
    // this.userActive
  }

  //------------------ Start Page ------------------------
  lengthDataFromGet(getUser){
    let count = 0;
    for(var tour in getUser){
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
    let link = '/user/admin/user-manage';
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

  ngOnInit() {
    this.activeMenu();
    this.getUserData();
  }

}