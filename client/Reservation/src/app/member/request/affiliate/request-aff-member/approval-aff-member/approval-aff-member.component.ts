import { Component, OnInit } from '@angular/core';
import { Http, RequestOptions } from '@angular/http';
import { Router, ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-approval-aff-member',
  templateUrl: './approval-aff-member.component.html',
  styleUrls: ['./approval-aff-member.component.scss']
})
export class ApprovalAffMemberComponent implements OnInit {

  public getUser = <any>[];
  public approval = <any>[];

  // page
  public highlightId :number;
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

  constructor(
    private http: Http,
    private router: Router,
    private route: ActivatedRoute
  ) { }

  // 1. active menu
  public activeMenu(){
    // set storage
    sessionStorage.setItem('menu',JSON.stringify(1));
    sessionStorage.setItem('sub-menu',JSON.stringify(1));
  }

  // 2. Get request
  public getRequestData(){
    // let url = "http://localhost:9000/api/Dashboard/Member/Approval";
    let url = "http://api.tourinchiangmai.com/api/Dashboard/Member/Approval";

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
                        this.approval = data,
                        this.lengthDataFromGet(data),
                        this.PagePagination()
                      ],
                      err => {console.log(err)}
                    );
  }

  // 3. cancel request
  public cancelRequest(req){
    let request = req;

    if(confirm('คุณต้องการยกเลิกคำขอ '+request.requestTypeTH+' หรือไม่?')){
      // let url = "http://localhost:9000/api/Dashboard/Member/CancelRequest";
      let url = "http://api.tourinchiangmai.com/api/Dashboard/Member/CancelRequest";

      // set data to save
      let _getUserData = JSON.parse(localStorage.getItem('users'));
      let dataSave = {
        token : _getUserData.data.token,
        requestId : request.id
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
    }else{
      return;
    }
  }

  //------------------ Start Page ------------------------
  lengthDataFromGet(getUser){
    this.getUser = getUser;

    let count = 0;
    for(var tour in getUser.data){
      count++;
    }
    this.totalItem = count;
    // console.log(this.totalItem);
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
    this.getRequestData();
  }

}
