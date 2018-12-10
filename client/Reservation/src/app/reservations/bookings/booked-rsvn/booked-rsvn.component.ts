import { Component, OnInit } from '@angular/core';
import { FormsModule, FormControl, Validators } from '@angular/forms';
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';
import { HttpClient, HttpErrorResponse, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs/observable';
// Services
import { BookedRsvnService } from './booked-rsvn.service';
// Interfaces
import { BookedRsvnInterface } from './booked-rsvn-interface';

@Component({
  selector: 'app-booked-rsvn',
  templateUrl: './booked-rsvn.component.html',
  styleUrls: ['./booked-rsvn.component.scss'],
  providers: [BookedRsvnService]
})
export class BookedRsvnComponent implements OnInit {

  userId = '1084873764';
  public activeSideNav = 'bookedstatistics';

  // interface
  _getBookingStatistics: BookedRsvnInterface;

  public highlightId :number;

  // page
  // public routeLink = "['/user/'+this.userId+'/reservations/booked']";

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
    private BookedRsvnService: BookedRsvnService,
    private http: Http,
    private router: Router,
    private route: ActivatedRoute
  ) { }

  //------------------ Start Page ------------------------
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

  changePage(page:number){
    this.activePage = page;
    let link = '/user/reservations/booked';
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

  // JSON booked stat from API
  getInvoiceFromData(): void{
    this.BookedRsvnService.getBookedData()
      .subscribe(
        resultArray => [
          this._getBookingStatistics = resultArray,
          this.lengthDataFromGet(),
          this.PagePagination()
        ],
        error => console.log("Error :: " + error)
      )
  }

  // Length data
  lengthDataFromGet(){
    let count = 0;
    for(var tour in this._getBookingStatistics){
      count++;
    }
    this.totalItem = count;
  }

  ngOnInit() {
    this.getInvoiceFromData();
  }
}