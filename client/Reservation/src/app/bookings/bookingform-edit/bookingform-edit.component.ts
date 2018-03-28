import { Component, OnInit } from '@angular/core';
import { HttpHeaders } from '@angular/common/http';
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { FormsModule, FormControl, Validators, NgModel, ReactiveFormsModule } from '@angular/forms';
import { Router } from '@angular/router';

import { Observable } from "rxjs/Observable";
import "rxjs/Rx";

// Component
import { ProgressBarComponent } from './../../progress/progress-bar/progress-bar.component';
// Services
import { BookingformEditService } from './bookingform-edit.service';
import { DataService } from './../../services/data.service';
// Interfaces
import { BookingdataInterface } from './../../interfaces/bookingdata-interface';
import { AccountCodeInterface } from './../../interfaces/account-code-interface';
import { SaveBookingInterface } from './../../interfaces/save-booking-interface';

@Component({
  selector: 'app-bookingform-edit',
  templateUrl: './bookingform-edit.component.html',
  styleUrls: ['./bookingform-edit.component.scss'],
  providers: [
    BookingformEditService,
    DataService
  ]
})
export class BookingformEditComponent implements OnInit {

  // Set model
  tourInfo = {
    tourData:{
      id:'',
      code:'',
      title:''
    },
    tourTime:'',
    tourPrivacy:'',
    tourTravelDate:'',
    tourPax:0,
    adultPax:0,
    childPax:0,
    infantPax:0
  };
  hotel = {
    hotelName:'',
    hotelRoom:'',
    hotelOther:''
  };
  service = {
    isServiceCharge:false,
    servicePrice:''
  };
  bookByAcc = '';
  guestName = [];
  guestAges = [];
  guestData = [];
  paymentInfo = {
    tourPrice:'',
    paymentCollect:''
  };
  bookBy = {
    name:'',
    position:'',
    positionOther:'',
    tel:'',
    accountName:'',
    accountNameOther:''
  };
  insurance = {
    isInsurance:false,
    insuranceReason:''
  };
  commission = {
    isCommission:false,
    commission:0
  };
  noteBy = {
    name:'',
    other:''
  };
  summary = {
    adultPrice:0,
    childPrice:0,
    totalAdultPrice:0,
    totalChildPrice:0,
    singleRiding:0,
    serviceCharge:0,
    discount:0,
    discountPrice:0,
    totalPrice:0,
    amount:0
  };
  specialRequest = '';
  specialRequestPrice = 0;
  isSingleRiding = false;
  dataSave = {};

  // Set data bliding
  travelTimeArr = [];
  tourPrivacyArr = [];
  guestArr = [];
  agesArr = [
    {ages:"Adult", value:1},
    {ages:"Child", value:2},
    {ages:"infant", value:3}
  ];
  tourTypePriceArr = [
    {type:"Selling price"},
    {type:"Local agent"},
    {type:"Local agent tax 3%"},
    {type:"BKK"},
    {type:"BKK tax 3%"},
    {type:"Discount 15%"},
    {type:"Discount 20%"},
    {type:"Discount 25%"},
    {type:"Discount 30%"},
    {type:"Other"}
  ];
  tourPriceArr = [];
  tourPaxArr = [1,2,3,4,5,6,7,8,9];
  tourPaymentCollectArr = [
    {collect:"Guest"},
    {collect:"Front"},
    {collect:"Concierge"},
    {collect:"Voucher"},
    {collect:"Voucher 3%"},
    {collect:"No Voucher"}
  ];
  bookByPositionArr = [
    {position:"Guest"},
    {position:"Front"},
    {position:"Concierge"},
    {position:"Other"}
  ];
  fullMonth = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
  noteByArr = [
    {name:'Jha'},
    {name:'Nan'},
    {name:'Khwanz'},
    {name:'Lat'},
    {name:'Mike'},
    {name:'Nim'},
    {name:'Other'}
  ];
  booleanArr = [
    {type:"Yes", value:true},
    {type:"No", value:false}
  ];

// Variable other
  _hotelName = '';
  _bookByAcc = '';
  _bookByAccCode = '';
  _bookByPosition = '';
  _noteBy = '';

// Set index
  indexTour: number;
  indexTourPrivacy: number;
  indexTourTypePrice: number;
  indexTourPax: number;
  indexTourPrice: number;

  tourControl = new FormControl('',[Validators.required]);

  // Account code interface
  _getAccountCodeArr: AccountCodeInterface.RootObject;

  // Booking data interface
  _getBookingDataArr: BookingdataInterface.RootObject;

  // Save booking interface
  _saveBookingInterface: SaveBookingInterface.RootObject;

  // _getTourInfo: BookingdataInterface.Privacy;
  _getTourTime: BookingdataInterface.Time;
  _getTourPrivacy: BookingdataInterface.Privacy;
  _getTourTypePrice: BookingdataInterface.TourPrice;
  _getTourPrice: BookingdataInterface.Price;
  _getTourPax: BookingdataInterface.Pax;

  // Active sidenav
  public activeSideNav = 'addbooking';

    constructor(
      private bookingformEditService: BookingformEditService,
      private dataService: DataService,
      private http: Http,
      private router: Router
    ) { }

    // JSON booking data
    getBookingData(): void {
      this.bookingformEditService.getBookingData()
        .subscribe(
          resultArray => this._getBookingDataArr = resultArray,
          error => console.log("Error :: " + error)
        )
    }

    // JSON account code data
    getAccountCode(): void {
      this.bookingformEditService.getAccountCode()
        .subscribe(
          resultArray => this._getAccountCodeArr = resultArray,
          error => console.log("Error :: " + error)
        )
    }

    /*======== Data to Save ========*/
    // Step 1 : Set tour data
    setTourData(){
      let tourArr = [];
      let tourId = this.tourInfo.tourData.id;
      let dataBook = this._getBookingDataArr;
      let count = 0;

      tourArr.push(this._getBookingDataArr);

      for(var tour in tourArr[0]){
        if(dataBook[count].id==tourId){
          // Set tour travel time
          this.travelTimeArr = dataBook[count].times;
          // Set tour privacy
          this.tourPrivacyArr = dataBook[count].privacies;
          // Set index tour
          this.indexTour = count;
        }
        count++;
      }
    }

    // Step 2 : Set guest data
    setGuestData(pax){
      this.guestArr = [];
      for(let i=0; i<pax; i++){
        this.guestArr.push(i+1);
      }
      // Set tour pax
      this.tourInfo.tourPax = pax;
    }

    // Set Price
    setPrice(){
      // Set privacy by [tour id]
      let count1 = 0;
      for(var data in this._getBookingDataArr){
        if(this._getBookingDataArr[count1].id==this.tourInfo.tourData.id){
          this._getTourPrivacy = this._getBookingDataArr[count1].privacies;
        }
        count1++;
      }

      // Set pax by [tour id & privacy]
      let count2 = 0;
      for(var data in this._getTourPrivacy){
        if(this._getTourPrivacy[count2].privacy==this.tourInfo.tourPrivacy){
          this._getTourPax = this._getTourPrivacy[count2].paxs;
        }
        count2++;
      }

      // Set tour type price by [tour paxs]
      let count3 = 0;
      for(var data in this._getTourPax){
        if(this._getTourPax[count3].min<=this.tourInfo.tourPax && this.tourInfo.tourPax<=this._getTourPax[count3].max){
          this._getTourTypePrice = this._getTourPax[count3].tourPrices;  
        }
        count3++;
      }

      // Set tour price by [tour type price]
      let count4 = 0;
      for(var data in this._getTourTypePrice){
        if(this._getTourTypePrice[count4].type==this.paymentInfo.tourPrice){
          this._getTourPrice = this._getTourTypePrice[count4].prices;
        }
        count4++;
      }

      // Set tour price summary
      // set pax
      let adultNo = this.tourInfo.adultPax?this.tourInfo.adultPax:0;
      let childNo = this.tourInfo.childPax?this.tourInfo.childPax:0;
      let infantNo = this.tourInfo.infantPax;
      let totalPax = adultNo + childNo;

      // set price
      this.summary.adultPrice = this._getTourPrice[0].adultPrice?this._getTourPrice[0].adultPrice:0;
      this.summary.childPrice = this._getTourPrice[0].childPrice?this._getTourPrice[0].childPrice:0;

      // set commission
      let getCommittionAdult = this._getTourPrice[0].commissionAdult?this._getTourPrice[0].commissionAdult:0;
      let getCommittionChild = this._getTourPrice[0].commissionChild?this._getTourPrice[0].commissionChild:0;
      let commissionAdult = getCommittionAdult * adultNo;
      let commissionChild = getCommittionChild * childNo;

      // set total price
      this.summary.totalAdultPrice = this.summary.adultPrice * adultNo;
      this.summary.totalChildPrice = this.summary.childPrice * childNo;
      let totalTourPrice = this.summary.totalAdultPrice + this.summary.totalChildPrice;

      // set discount
      let discountPercent = this.summary.discount?this.summary.discount:0;
      this.summary.discount = this.summary.discount;
      this.summary.discountPrice = totalTourPrice * (discountPercent / 100);

      // set single riding
      if(totalPax%2!=0){
        this.summary.singleRiding = this._getTourPrice[0].singleRiding;
      }else if(this.isSingleRiding==true){
        this.summary.singleRiding = this._getTourPrice[0].singleRiding;
      }else{
        this.summary.singleRiding = 0;
      }

      this.summary.totalPrice = totalTourPrice + this.summary.singleRiding - this.summary.discountPrice + this.specialRequestPrice;      

      // set service charge 3%
      if(this.service.isServiceCharge==true){
        this.summary.serviceCharge = this.summary.totalPrice * 0.03;
      }else{
        this.summary.serviceCharge = 0;
      }

      this.summary.amount = this.summary.totalPrice + this.summary.serviceCharge;

      // set commission
      if(this.commission.isCommission==true){
        this.commission.commission = commissionAdult + commissionChild;
      }else{
        this.commission.commission = 0;
      }

    }// End Function Set Price

    dataToSave(){
      // Set Date format
      let _date = new Date(this.tourInfo.tourTravelDate);
      let _month = _date.getMonth();
      this.tourInfo.tourTravelDate = _date.getDate()+' '+this.fullMonth[_month]+' '+_date.getFullYear();

      // Set Hotel Other
      if(this.hotel.hotelName=='Other'){
        this._hotelName = this.hotel.hotelOther;
      }else{
        this._hotelName = this.hotel.hotelName;
      }

      // Set Book by
      // console.log('=='+JSON.stringify(this._getAccountCodeArr));
      let countAcc = 0;
      for(var acc in this._getAccountCodeArr){
        if(this._getAccountCodeArr[countAcc].hotel==this.bookBy.accountName){
          this.bookByAcc = this._getAccountCodeArr[countAcc].code;
        }
        countAcc++;
      }
      if(this.bookBy.accountName=='Other'){
        this._bookByAcc = this.bookBy.accountNameOther;
        this._bookByAccCode = '';
      }else{
        this._bookByAcc = this.bookBy.accountName;
        this._bookByAccCode = this.bookByAcc;
      }

      // Set Book by position
      if(this.bookBy.position=='Other'){
        this._bookByPosition = this.bookBy.positionOther;
      }else{
        this._bookByPosition = this.bookBy.position;
      }

      // Set note by
      if(this.noteBy.name=='Other'){
        this._noteBy = this.noteBy.other;
      }else{
        this._noteBy = this.noteBy.name;
      }

      // Set guest data
      let _pax = this.tourInfo.tourPax;
      let _guestName = this.guestName;
      let _guestAges = this.guestAges;
      let countAdult = 0;
      let countChild = 0;
      let countInfant = 0;

      this.guestData = [];
      for(var i=0; i<_pax; i++){
        let _guestData = {
          name:_guestName[i],
          isAges:_guestAges[i]
        };
        this.guestData.push(_guestData);

        if(_guestAges[i]==1){
          countAdult++;
          this.tourInfo.adultPax = countAdult;
        }else if(_guestAges[i]==2){
          countChild++;
          this.tourInfo.childPax = countChild;
        }else{
          countInfant++;
          this.tourInfo.infantPax = countInfant;
        }
      }

      // Set price
      this.setPrice();

      this.dataSave = 
        {
          "bookingInfo": {
            "tourId": this.tourInfo.tourData.id,
            "tourCode": this.tourInfo.tourData.code,
            "tourName": this.tourInfo.tourData.title,
            "tourPrivacy": this.tourInfo.tourPrivacy,
            "travelTime": this.tourInfo.tourTime,
            "travelDate": this.tourInfo.tourTravelDate,
            "pax": this.tourInfo.tourPax,
            "adultPax": countAdult,
            "childPax": countChild,
            "infantPax": countInfant,
            "isServiceCharge": this.service.isServiceCharge
          },
          "hotelInfo": {
            "name": this._hotelName,
            "room": this.hotel.hotelRoom
          },
          "guestInfo": this.guestData,
          "paymentInfo": {
            "tourPrice": this.paymentInfo.tourPrice,
            "paymentCollect": this.paymentInfo.paymentCollect
          },
          "bookBy": {
            "name": this.bookBy.name,
            "position": this._bookByPosition,
            "code": this._bookByAccCode,
            "hotel": this._bookByAcc,
            "tel": this.bookBy.tel
          },
          "insurance": {
            "isInsurance": this.insurance.isInsurance,
            "insuranceReason": this.insurance.insuranceReason
          },
          "commission":{
            "isCommission": this.commission.isCommission,
            "amount": this.commission.commission
          },
          "noteBy": {
            "name": this._noteBy
          },
          "summary": {
            "adultPrice": this.summary.adultPrice,
            "childPrice": this.summary.childPrice,
            "totalAdultPrice": this.summary.totalAdultPrice,
            "totalChildPrice": this.summary.totalChildPrice,
            "singleRiding": this.summary.singleRiding,
            "serviceCharge": this.summary.serviceCharge,
            "discount": this.summary.discount + '%',
            "discountPrice": this.summary.discountPrice,
            "totalPrice": this.summary.totalPrice,
            "amount": this.summary.amount
          },
          "specialRequest": this.specialRequest,
          "specialRequestPrice": this.specialRequestPrice
        };
        console.log(JSON.stringify(this.dataSave));

        // Save data booking to API
        this.saveDataBooking(this.dataSave);
    } // End Function Set Data To Save

    // Save to data service
    saveDataBooking(dataSave) {

      let url = 'http://localhost:9000/api/ReservationSaveBookingData';
      // let url = 'http://api.tourinchiangmai.com/api/ReservationSaveBookingData';

      let options = new RequestOptions();

      /*==================  Success  ===================*/
      return this.http.post(url, dataSave, options)
                      .map(res => res.json())
                      .subscribe(
                        // data => {console.log('*-*'+data)},
                        data => {this.router.navigate(['booked-statistics'])},
                        err => {console.log(err)}
                      );
      /*==================  Success  ===================*/
    }

    private handleError(error: Response){
      return Observable.throw(error.statusText);
    }

  ngOnInit() {
    this.getBookingData();
    this.getAccountCode();
  }

}
