import { Component, OnInit } from '@angular/core';
import { Http, RequestOptions } from '@angular/http';
import { Router, ActivatedRoute } from '@angular/router';
import { Observable } from 'rxjs/observable';

@Component({
  selector: 'app-traveling-table-manager',
  templateUrl: './traveling-table-manager.component.html',
  styleUrls: ['./traveling-table-manager.component.scss']
})
export class TravelingTableManagerComponent implements OnInit {

  public highlightId :number;
  public getTraveling = <any>[];
  public travelingData = <any>"";

  // page
  public routeLink = "['/user/manager/traveling']";

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
    sessionStorage.setItem('sub-menu',JSON.stringify(105));
  }

  // JSON booked stat from API
  getUserData(): void{
    // let url = "http://localhost:9000/api/Reservations/GetTourTraveling";
    let url = "http://api.tourinchiangmai.com/api/Reservations/GetTourTraveling";

    // set data to save
    // let _getUserData = JSON.parse(sessionStorage.getItem('users'));
    let _getUserData = JSON.parse(localStorage.getItem('users'));
    let dataSave = {
      token : _getUserData.data.token,
      type : _getUserData.data.userType
    };

    let options = new RequestOptions();
    /*==================  Success  ===================*/
    this.http.post(url, dataSave, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        console.log(data.data),
                        this.lengthDataFromGet(data.data),
                        this.PagePagination()
                      ],
                      err => {console.log(err)}
                    );
    /*==================  Success  ===================*/
    setTimeout(()=>{
      // this.lengthDataFromGet(this.getUser);
      // this.PagePagination();
    }, 500);
  }

  // Length data
  lengthDataFromGet(getUser){
    this.getTraveling = getUser;
    console.log(this.getTraveling);

    let count = 0;
    for(var tour in getUser){
      count++;
    }
    this.totalItem = count;

  }

  openDialog(data){
    this.travelingData = data;
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

    // let params = this.route.snapshot.paramMap;
    // if(params.has('userId')){
    //   this.highlightId = +params.get('userId');
    // }
  }

  changePage(page:number){
    this.activePage = page;
    let link = '/user/manager/traveling';
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
    this.getUserData();
  }

}
