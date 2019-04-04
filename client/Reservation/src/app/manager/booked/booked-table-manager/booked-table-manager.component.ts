import { Component, OnInit } from '@angular/core';
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';
import "rxjs/Rx";

@Component({
  selector: 'app-booked-table-manager',
  templateUrl: './booked-table-manager.component.html',
  styleUrls: ['./booked-table-manager.component.scss']
})
export class BookedTableManagerComponent implements OnInit {

  // variable
  public highlightId :number;
  public getBooked = <any>[];

  // page
  public routeLink = "['/user/affiliate/booked/table']";

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
  getBookedFormData(): void{
    // let url = "http://localhost:9000/api/reservations/GetBookedByAccountId";
    let url = "http://api.tourinchiangmai.com/api/reservations/GetBookedByAccountId";

    // set data to save
    let _getUserData = JSON.parse(localStorage.getItem('users'));
    if(_getUserData==null || _getUserData==undefined || _getUserData==''){
      alert('Session expired!');
      this.router.navigate(['user/logout']);
    }

    // set data
    let dataSave = {
      token : _getUserData.data.token,
      type : _getUserData.data.userType
    };

    // save
    let options = new RequestOptions();
    this.http.post(url, dataSave, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        this.getBooked = data,
                        sessionStorage.setItem('booked-table',JSON.stringify(data)),
                        this.setInvoiceFromData()
                      ],
                      err => {console.log(err)}
                    );
  }

  // 
  public setInvoiceFromData(){
    this.getBooked = JSON.parse(sessionStorage.getItem('booked-table'));
    this.lengthDataFromGet(this.getBooked);
    this.PagePagination();
  }

  // Length data
  lengthDataFromGet(getBooked){
    let count = 0;
    for(var tour in getBooked){
      count++;
    }
    this.totalItem = count;

  }

  //------------------ Start Page ------------------------
  PagePagination(){
    // reset
    this.iPage = [];
    
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
    if(params.has('transactionId')){
      this.highlightId = +params.get('transactionId');
    }
  }

  changePage(page:number){
    this.activePage = page;
    let link = '/user/affiliate/booked/table';
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
    this.getBookedFormData();
  }

}