import { Component, OnInit } from '@angular/core';
import { FormsModule, FormControl, Validators } from '@angular/forms';
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';
import { HttpClient, HttpErrorResponse, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs/observable';
// Services
import { BookedTableAffService } from './booked-table-aff.service';
// Interfaces
import { BookedTableAffInterface } from './booked-table-aff-interface';

@Component({
  selector: 'app-booked-table-aff',
  templateUrl: './booked-table-aff.component.html',
  styleUrls: ['./booked-table-aff.component.scss'],
  providers: [BookedTableAffService]
})
export class BookedTableAffComponent implements OnInit {

  userId = '1084873764';
  public activeSideNav = 'bookedstatistics';

  // interface
  _getBooked: BookedTableAffInterface;

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
  public perPage: number = 20;
  public totalPage: number;
  public maxShowPage: number;
  public useShowPage: number = 5;
  public pointStart: number = 0;
  public pointEnd: number;

  constructor(
    private BookedTableAffService: BookedTableAffService,
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
  getInvoiceFromData(): void{
    this.BookedTableAffService.getBookedData()
      .subscribe(
        resultArray => [
          this._getBooked = resultArray,
          this.lengthDataFromGet(),
          this.PagePagination()
        ],
        error => console.log("Error :: " + error)
      )

    let url = "http://localhost:9000/api/reservations/GetBookedByAccountId";
    // let url = "http://api.tourinchiangmai.com/api/reservations/GetBookedByAccountId";
    let dataSave = {
      "token" : "1652812936"
    }

    let options = new RequestOptions();
    /*==================  Success  ===================*/
    this.http.post(url, dataSave, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        // console.log(data),
                        this.getBooked = data,
                        sessionStorage.setItem('booked-table',JSON.stringify(data))
                      ],
                      // data => {this.router.navigate([link])},
                      err => {console.log(err)}
                    );
    /*==================  Success  ===================*/
    setTimeout(()=>{
      this.getBooked = JSON.parse(sessionStorage.getItem('booked-table'));
      console.log('=============');
      console.log(this.getBooked);
      console.log('=============');
    }, 500);
  }

  // Length data
  lengthDataFromGet(){
    let getDataArr = [];
    this._getBooked;
    let count = 0;
    for(var tour in this._getBooked){
      count++;
    }
    this.totalItem = count;
    // console.log("Length : "+count);
  }

  //------------------ Start Page ------------------------
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
    if(params.has('transactionId')){
      this.highlightId = +params.get('transactionId');
    }
  }

  //------------------ End Page ------------------------


  ngOnInit() {
    this.activeMenu();
    this.getInvoiceFromData();
  }

}