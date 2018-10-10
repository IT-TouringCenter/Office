import { Component, OnInit } from '@angular/core';
import { AsyncPipe } from '@angular/common';
import { HttpHeaders } from '@angular/common/http';
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { FormsModule, FormControl, Validators, NgModel, ReactiveFormsModule } from '@angular/forms';
import { Router } from '@angular/router';

import { Observable } from "rxjs/Observable";
import { startWith } from "rxjs/operators/startWith";
import { map } from "rxjs/operators/map";
import "rxjs/Rx";

// Services
import { BookformAddRsvnService } from './bookform-add-rsvn.service';
// import { DataService } from './../../services/data.service';
// import { CurrencyService } from './../../common/currency/currency.service';
// Interfaces
import { BookformAddRsvnInterface } from './bookform-add-rsvn-interface';
import { AccountCodeInterface } from './../../interfaces/account-code-interface';
import { SaveBookingInterface } from './../../interfaces/save-booking-interface';
// import { currencyInterface } from './../../common/currency/currency-interface';
@Component({
  selector: 'app-bookform-add-rsvn',
  templateUrl: './bookform-add-rsvn.component.html',
  styleUrls: ['./bookform-add-rsvn.component.scss'],
  providers: [
    BookformAddRsvnService,
    // CurrencyService,
    // DataService
  ]
})

export class BookformAddRsvnComponent implements OnInit {

  myControl: FormControl = new FormControl();

  userId = '1084873764';

  // Set model
  minDate = new Date(2017, 12, 1);
  maxDate = new Date(2018, 9, 31);
  tourInfo = {
    tourData:{
      id:'',
      code:'',
      title:''
    },
    tourTime:'',
    tourPrivacy:'',
    tourTravelDate:'',
    rateTwoPax:0,
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
    accountNameOther:'',
    otaCode:''
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
    adultSellPrice:0,
    childSellPrice:0,
    adultPrice:0,
    childPrice:0,
    totalAdultPrice:0,
    totalChildPrice:0,
    singleRidingPax:0,
    singleRiding:0,
    serviceCharge:0,
    deposit:0,
    discount:0,
    discountPrice:0,
    totalPrice:0,
    amount:0,
  };
  isSpecialRequestOperator = 0;
  specialRequestOperator = '';
  specialChargePrice = 0;
  specialRequest = '';
  specialRequestPrice = 0;
  isSingleRiding = false;
  singleRidingPax = 0;
  rateTwoPax = false;
  dataSave = {};

  realPriceAdult = 0;
  realPriceChild = 0;
  currency = '';
  currencyRate = 31.5;

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
  tourPaxArr = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20];
  tourPaymentCollectArr = [
    {collect:"Guest"},
    {collect:"Front"},
    {collect:"Concierge"},
    {collect:"Voucher"},
    {collect:"Voucher 3%"},
    {collect:"No Voucher"},
    {collect:"Other"}
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
  operatorArr = [
    {operator:"+", value:"+"},
    {operator:"-", value:"-"}
  ];
  activeSingleRiding = false;

// Variable other
  _hotelName = '';
  _bookByAcc = '';
  _bookByAccCode = '';
  _bookByPosition = '';
  _noteBy = '';

// Set index
  indexTour: number;

  tourControl = new FormControl('',[Validators.required]);

  // Account code interface
  _getAccountCodeArr: AccountCodeInterface.RootObject;

  // Booking data interface
  _getBookingDataArr: BookformAddRsvnInterface.RootObject;

  // Save booking interface
  _saveBookingInterface: SaveBookingInterface.RootObject;

  // Currency interface
  // _getCurrencyInterface : currencyInterface.RootObject;

  // _getTourInfo: BookformAddRsvnInterface.Privacy;
  _getTourTime: BookformAddRsvnInterface.Time;
  _getTourPrivacy: BookformAddRsvnInterface.Privacy;
  _getTourTypePrice: BookformAddRsvnInterface.TourPrice;
  _getTourPrice: BookformAddRsvnInterface.Price;
  _getTourPax: BookformAddRsvnInterface.Pax;

  filteredOptions: Observable<string[]>;

  // Active sidenav
  public activeSideNav = 'addbooking';

    constructor(
      private BookformAddRsvnService: BookformAddRsvnService,
      // private dataService: DataService,
      // private currencyService: CurrencyService,
      private http: Http,
      private router: Router
    ) { }

    // JSON booking data
    getBookingData(): void {
      this.BookformAddRsvnService.getBookingData()
        .subscribe(
          resultArray => this._getBookingDataArr = resultArray,
          error => console.log("Error :: " + error)
        )
    }

    // JSON account code data
    getAccountCode(): void {
      this.BookformAddRsvnService.getAccountCode()
        .subscribe(
          resultArray => this._getAccountCodeArr = resultArray,
          error => console.log("Error :: " + error)
        )
    }

    // JSON currency
    // getCurrency(): void{
    //   this.currencyService.getInvoiceData()
    //     .subscribe(
    //       resultArray => this._getCurrencyInterface = resultArray,
    //       error => console.log("Error :: " + error)
    //     )
    // }

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

      if(tourId=='3' || tourId=='8' || tourId=='11' || tourId=='12'){
        this.activeSingleRiding = true;
      }else{
        this.activeSingleRiding = false;
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
      // No select ages & fill guest data
      if(this.tourInfo.adultPax==undefined || this.tourInfo.adultPax==null || this.tourInfo.adultPax==0){
        if(this.tourInfo.tourPax>=1){
          this.tourInfo.adultPax = this.tourInfo.tourPax;
        }
      }else{
        this.tourInfo.adultPax = this.tourInfo.adultPax;
      }
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
      let adultNo = this.tourInfo.adultPax;
      let childNo = this.tourInfo.childPax;
      let infantNo = this.tourInfo.infantPax;
      let totalPax = adultNo + childNo;

      // set price
      if(this.rateTwoPax==true){
        this.tourInfo.rateTwoPax = 1;
        this.specialChargePrice = this._getTourPrice[0].adultPrice;
      }else{
        this.tourInfo.rateTwoPax = 0;
        this.specialChargePrice = 0;
      }

      if(this.tourInfo.tourPax>1){
        this.tourInfo.rateTwoPax = 0;
      }

      this.summary.adultSellPrice = this._getTourPrice[0].adultSellPrice;
      this.summary.childSellPrice = this._getTourPrice[0].childSellPrice;
      this.summary.adultPrice = this._getTourPrice[0].adultPrice;
      this.summary.childPrice = this._getTourPrice[0].childPrice;

      // set deposit price
      if(this.summary.deposit==null || this.summary.deposit==undefined){
        this.summary.deposit = 0;
      }

      // set commission
      let getCommittionAdult = this._getTourPrice[0].commissionAdult>0?this._getTourPrice[0].commissionAdult:0;
      let getCommittionChild = this._getTourPrice[0].commissionChild>0?this._getTourPrice[0].commissionChild:0;
      let commissionAdult = getCommittionAdult * adultNo;
      let commissionChild = getCommittionChild * childNo;

      // set total price
      this.summary.totalAdultPrice = this.summary.adultPrice * adultNo;
      this.summary.totalChildPrice = this.summary.childPrice * childNo;
      let totalTourPrice = this.summary.totalAdultPrice + this.summary.totalChildPrice;

      // set discount
      if(this.summary.discount==null || this.summary.discount==undefined){
        this.summary.discount=0;
      }
      let checkDiscount = this.paymentInfo.tourPrice;
      let subDiscount = 0;
      // console.log('check discount : '+checkDiscount.includes("Discount"));
      if(checkDiscount.includes("Discount")==true){
        subDiscount = parseInt(this.paymentInfo.tourPrice.substring(11,9));
        // set total price
        this.summary.totalAdultPrice = this.summary.adultSellPrice * adultNo;
        this.summary.totalChildPrice = this.summary.childSellPrice * childNo;
        totalTourPrice = this.summary.totalAdultPrice + this.summary.totalChildPrice;
        this.realPriceAdult = this.summary.adultSellPrice;
        this.realPriceChild = this.summary.childSellPrice;
      }else{
        subDiscount = 0;
        // set total price
        this.summary.totalAdultPrice = this.summary.adultPrice * adultNo;
        this.summary.totalChildPrice = this.summary.childPrice * childNo;
        totalTourPrice = this.summary.totalAdultPrice + this.summary.totalChildPrice;
        this.realPriceAdult = this.summary.adultPrice;
        this.realPriceChild = this.summary.childPrice;
      }

      let discountPercent = subDiscount;
      this.summary.discount = subDiscount;
      this.summary.discountPrice = totalTourPrice * (discountPercent/100);
      // console.log((this.realPriceAdult + this.realPriceChild)+' x '+ (discountPercent/100)+' = '+this.summary.discountPrice);

      // set single riding
      if(this.singleRidingPax==0){
        this.summary.singleRidingPax=1;
      }else{
        this.summary.singleRidingPax=this.singleRidingPax;
      }

      if(totalPax%2!=0){ // normal case % 2
        this.summary.singleRiding = parseInt(this._getTourPrice[0].singleRiding);
        if(this.isSingleRiding==true){
          if(this.summary.singleRidingPax!=null || this.summary.singleRidingPax!=undefined){
            this.summary.singleRiding = parseInt(this._getTourPrice[0].singleRiding) * this.summary.singleRidingPax;
          }else{
            this.summary.singleRiding = parseInt(this._getTourPrice[0].singleRiding);
          }
        }else{
          this.summary.singleRidingPax = 1;
          this.summary.singleRiding = parseInt(this._getTourPrice[0].singleRiding);
        }
      }else{
        this.summary.singleRiding = 0;
        if(this.isSingleRiding==true){
          if(this.summary.singleRidingPax!=null || this.summary.singleRidingPax!=undefined){
            this.summary.singleRiding = parseInt(this._getTourPrice[0].singleRiding) * this.summary.singleRidingPax;
          }else{
            this.summary.singleRiding = parseInt(this._getTourPrice[0].singleRiding);
          }
        }else{
          this.summary.singleRidingPax = 0;
          this.summary.singleRiding = 0;
        }
      }

      // set special request price
      if(this.specialRequestPrice==null || this.specialRequestPrice==undefined){
        this.specialRequestPrice = 0;
      }

      // set total price
      // set special request operator
      // '+'==1 | '-'==2 | none==0
      if(this.specialRequestOperator=='+'){
        this.isSpecialRequestOperator=1;
        this.summary.totalPrice = totalTourPrice + this.summary.singleRiding - this.summary.discountPrice + this.specialRequestPrice + this.specialChargePrice - this.summary.deposit;
      }else if(this.specialRequestOperator=='-'){
        this.isSpecialRequestOperator=2;
        this.summary.totalPrice = totalTourPrice + this.summary.singleRiding - this.summary.discountPrice - this.specialRequestPrice + this.specialChargePrice - this.summary.deposit;
      }else{
        this.isSpecialRequestOperator=0;
        this.summary.totalPrice = totalTourPrice + this.summary.singleRiding - this.summary.discountPrice + this.specialRequestPrice + this.specialChargePrice - this.summary.deposit;
      }

      // this.summary.totalPrice = totalTourPrice + this.summary.singleRiding - this.summary.discountPrice + this.specialRequestPrice + this.specialChargePrice - this.summary.deposit;

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

      // converse currency
      if(this.currency=='USDTHB'){
        this.realPriceAdult = this.realPriceAdult / this.currencyRate;
        this.realPriceChild = this.realPriceChild / this.currencyRate;
        this.summary.totalAdultPrice = this.summary.totalAdultPrice / this.currencyRate;
        this.summary.totalChildPrice = this.summary.totalChildPrice / this.currencyRate;
        this.summary.singleRiding = this.summary.singleRiding / this.currencyRate;
        this.summary.serviceCharge = this.summary.serviceCharge / this.currencyRate;
        this.summary.deposit = this.summary.deposit / this.currencyRate;
        this.summary.discountPrice = this.summary.discountPrice / this.currencyRate;
        this.summary.totalPrice = this.summary.totalPrice / this.currencyRate;
        this.summary.amount = this.summary.amount / this.currencyRate;
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

      // Set GYG Code
      if(this.bookBy.otaCode==null || this.bookBy.otaCode==undefined){
        this.bookBy.otaCode='';
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
        let guestName = '';
        let guestAges = 0;

        if(_guestName[i]=='' || _guestName[i]==undefined || _guestName[i]==null){
          guestName = '';
        }else{
          guestName = _guestName[i];
        }

        if(_guestAges[i]=='' || _guestAges[i]==undefined || _guestAges[i]==null){
          guestAges = 1;
        }else{
          guestAges = _guestAges[i];
        }

        let _guestData = {
          name:guestName,
          isAges:guestAges
        };

        this.guestData.push(_guestData);

        if(_guestAges[i]==1){
          countAdult++;
          this.tourInfo.adultPax = countAdult;
        }else if(_guestAges[i]==2){
          countChild++;
          this.tourInfo.childPax = countChild;
        }else if(_guestAges[i]==3){
          countInfant++;
          this.tourInfo.infantPax = countInfant;
        }else{
          countAdult++;
          this.tourInfo.adultPax = countAdult;
        }
      } // end for

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
            "rateTwoPax": this.tourInfo.rateTwoPax,
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
            "tel": this.bookBy.tel,
            "otaCode":this.bookBy.otaCode
          },
          "insurance": {
            "isInsurance": this.insurance.isInsurance,
            "insuranceReason": this.insurance.isInsurance==false?'':this.insurance.insuranceReason
          },
          "commission":{
            "isCommission": this.commission.isCommission,
            "amount": this.commission.commission
          },
          "noteBy": {
            "name": this._noteBy
          },
          "summary": {
            "adultPrice": this.realPriceAdult,
            "childPrice": this.realPriceChild,
            "totalAdultPrice": this.summary.totalAdultPrice,
            "totalChildPrice": this.summary.totalChildPrice,
            "singleRidingPax": this.summary.singleRidingPax,
            "singleRiding": this.summary.singleRiding,
            "serviceCharge": this.summary.serviceCharge,
            "deposit": this.summary.deposit,
            "discount": this.summary.discount + '%',
            "discountPrice": this.summary.discountPrice,
            "totalPrice": this.summary.totalPrice,
            "amount": this.summary.amount
          },
          "specialChargePrice": this.specialChargePrice,
          "specialRequestOperator": this.isSpecialRequestOperator,
          "specialRequest": this.specialRequest,
          "specialRequestPrice": this.specialRequestPrice,
          "invoiceRef":{
            "id":"",
            "number":""
          },
          "isRevised":0,
          "isSpecialTour":0,
          "currency": this.currency,
          "currency_rate": this.currencyRate,
          "issuedBy": "Office"
        };
        // console.log(JSON.stringify(this.dataSave));

        // Save data booking to API
        this.saveDataBooking(this.dataSave);
    } // End Function Set Data To Save

    // Save to data service
    saveDataBooking(dataSave) {

      let url = 'http://localhost:9000/api/Reservations/ReservationSaveBookingData';
      // let url = 'http://api.tourinchiangmai.com/api/Reservations/ReservationSaveBookingData';

      let options = new RequestOptions();
      let link = '/user/reservations/booked';
      /*==================  Success  ===================*/
      return this.http.post(url, dataSave, options)
                      .map(res => res.json())
                      .subscribe(
                        // data => {console.log('*-*'+data)},
                        data => {this.router.navigate([link])},
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
    // this.getCurrency();
  }

}