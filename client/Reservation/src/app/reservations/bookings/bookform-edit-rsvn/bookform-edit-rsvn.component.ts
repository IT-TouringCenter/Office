import { Component, OnInit } from '@angular/core';
import { HttpHeaders } from '@angular/common/http';
import { ActivatedRoute, Params } from "@angular/router";
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { FormsModule, FormControl, Validators, NgModel, ReactiveFormsModule, FormBuilder } from '@angular/forms';
import { Router } from '@angular/router';

import { Observable } from "rxjs/Observable";
import "rxjs/Rx";

// Services
import { BookformEditRsvnService } from './bookform-edit-rsvn.service';
import { DataService } from './../../../services/data.service';

// Interfaces
import { BookformAddRsvnInterface } from './../bookform-add-rsvn/bookform-add-rsvn-interface';
import { AccountCodeInterface } from './../../interfaces/account-code-interface';
import { SaveBookingInterface } from './../../interfaces/save-booking-interface';
import { BookformEditRsvnInterface } from './bookform-edit-rsvn-interface';

@Component({
  selector: 'app-bookform-edit-rsvn',
  templateUrl: './bookform-edit-rsvn.component.html',
  styleUrls: ['./bookform-edit-rsvn.component.scss'],
  providers: [
    BookformEditRsvnService,
    // BookingFormService,
    DataService
  ]
})
export class BookformEditRsvnComponent implements OnInit {
  // Edit by API
  // getBookingEditByApi;

  // Edit form
  selectedTour;
  selectedTourTravelTime;
  selectedTourPrivacy;
  selectedHotel;
  selectedTourPrice;
  selectedPaymentCollect;
  setInvoiceReference = {
    id:0,
    number:''
  };

  // Set model
  minDate = new Date(2017, 12, 1);
  maxDate = new Date(2018, 9, 31);

  accountInfo = {
    id: <any>'',
    token: <any>''
  };
  tourInfo = {
    tourData:{
      id:'',
      code:'',
      title:''
    },
    tourTime:'',
    tourPrivacy:'',
    tourTravelDateSelect: new Date(), // edit only
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
    amount:0
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

  // interface
  _getAccountCodeArr: AccountCodeInterface.RootObject;
  _getBookingDataArr: BookformAddRsvnInterface.RootObject;
  _getBookingEditArr: BookformEditRsvnInterface.RootObject;
  _saveBookingInterface: SaveBookingInterface.RootObject;

  // interface (book data)
  _getTourTime: BookformAddRsvnInterface.Time;
  _getTourPrivacy: BookformAddRsvnInterface.Privacy;
  _getTourTypePrice: BookformAddRsvnInterface.TourPrice;
  _getTourPrice: BookformAddRsvnInterface.Price;
  _getTourPax: BookformAddRsvnInterface.Pax;

  // interface (book edit)
  _getBookingInfo: BookformEditRsvnInterface.BookingInfo;
  _getHotelInfo: BookformEditRsvnInterface.HotelInfo;
  _getGuestInfo: BookformEditRsvnInterface.GuestInfo;
  _getPaymentInfo: BookformEditRsvnInterface.PaymentInfo;
  _getBookBy: BookformEditRsvnInterface.BookBy;
  _getInsurance: BookformEditRsvnInterface.Insurance;
  _getCommission: BookformEditRsvnInterface.Commission;
  _getNoteBy: BookformEditRsvnInterface.NoteBy;
  _getSummary: BookformEditRsvnInterface.Summary;
  _getInvoiceRef: BookformEditRsvnInterface.InvoiceRef;

  // Active sidenav
  public activeSideNav = 'addbooking';

    private routeTransactionId;

    constructor(
      private bookformEditRsvnService: BookformEditRsvnService,
      // private bookingDataService: BookingFormService,
      private dataService: DataService,
      private http: Http,
      private router: Router,
      private route: ActivatedRoute
    ) { 
      let _params = this.route.snapshot.paramMap.get(('transactionId'));
      this.routeTransactionId = _params;
     }

    // JSON booking data
    getBookingData(): void {
      this.bookformEditRsvnService.getBookingData()
        .subscribe(
          resultArray => [
            this._getBookingDataArr = resultArray
          ],
          error => console.log("Error :: " + error)
        )
      // this.editDataBinding();
    }

    // JSON account code data
    getAccountCode(): void {
      this.bookformEditRsvnService.getAccountCode()
        .subscribe(
          resultArray => [
            this._getAccountCodeArr = resultArray
          ],
          error => console.log("Error :: " + error)
        )
    }

    // JSON booking edit
    getBookingEdit(): void {
      this.bookformEditRsvnService.getBookingFormEdit()
        .subscribe(
          resultArray => [
            this._getBookingEditArr= resultArray,
            this.editTourProgram(),
            this.editHotel(),
            this.editGuestPax(),
            this.editTourPrice(),
            this.editPaymentCollect(),
            this.editDiscount(),
            this.editServiceCharge(),
            this.editSingleRiding(),
            this.editSpecialRequest(),
            this.editBookedBy(),
            this.editBookedByPosition(),
            this.editAccountName(),
            this.editInsurance(),
            this.editCommission(),
            this.editNoteBy(),
            this.setInvoiceRef(),
            this.setRateTwoPax(),
            this.setSingleRidingPax(),
            this.setOtaCode(),
            this.setDepositPrice(),
            this.setSpecialRequestOperator()
          ],
          error => console.log("Error :: " + error)
        )
    }

    /*======== Data to Save ========*/
    /* -------------------------------
      1. Set tour data
      2. Set guest data
      3. Set Price
      4. Set data format
      5. Save to API
    ------------------------------- */
    setAccountInfo(){
      let getAccount = sessionStorage.getItem('users');
      console.log('-------------');
      console.log(getAccount);
      console.log('-------------');
      if(getAccount==null || getAccount==undefined || getAccount==''){
        this.accountInfo.id = 0;
        this.accountInfo.token = '';
      }else{
        let account = JSON.parse(getAccount);
        this.accountInfo.id = account.data.id;
        this.accountInfo.token = account.data.token;
      }
    }

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

      // Binding guest data
      this.editGuestInfo();
    }

    // Step 3 : Set Price
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
      console.log('check discount : '+checkDiscount.includes("Discount"));
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
      console.log((this.realPriceAdult + this.realPriceChild)+' x '+ (discountPercent/100)+' = '+this.summary.discountPrice);

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
      // console.log('Operator : '+this.specialRequestOperator);
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

    }// End Function Set Price

    // Step 4 : Set data format
    dataToSave(params){
      // Set user
      this.setAccountInfo();

      // Set Date format
      let _date = new Date(this.tourInfo.tourTravelDateSelect); // edit only
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
          "accountInfo": this.accountInfo,
          "transId":this.routeTransactionId,
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
            "id":this.setInvoiceReference.id,
            "number":this.setInvoiceReference.number
          },
          "isRevised":1,
          "isSpecialTour":0,
          "issuedBy": "Office"
        };
        console.log(JSON.stringify(this.dataSave));

        // Save data booking to API
        this.saveDataBooking(this.dataSave,params);
    } // End Function Set Data To Save

    // Step 5 : Save to API
    saveDataBooking(dataSave,params) {
      let url = '';
      if(params==2){
        // url = 'http://localhost:9000/api/Reservations/ReservationSaveBookingData';
        url = 'http://api.tourinchiangmai.com/api/Reservations/ReservationSaveBookingData';
      }else if(params==1){
        // url = 'http://localhost:9000/api/Reservations/EditReservation';
        url = 'http://api.tourinchiangmai.com/api/Reservations/EditReservation';
      }

      let options = new RequestOptions();
      let link = '/user/reservations/booked';

      /*==================  Success  ===================*/
      return this.http.post(url, dataSave, options)
                      .map(res => res.json())
                      .subscribe(
                        data => {this.router.navigate([link])}, // success go to page 'booked-statistics'
                        err => {console.log(err)}
                      );
      /*==================  Success  ===================*/
    }

    private handleError(error: Response){
      return Observable.throw(error.statusText);
    }

  /*============ Edit Form (start) ==============*/
  /*=============== 1 - 24 Step =================*/

    // 1. Set & binding [ Tour program ]
    editTourProgram(){
      if(this._getBookingDataArr==null || this._getBookingDataArr==undefined){
        this.getBookingEdit();
      }else{
        let count = 0;
        for(var data in this._getBookingDataArr){
          if(this._getBookingDataArr[count].code==this._getBookingEditArr.bookingInfo.tourCode){
            this.selectedTour = this._getBookingDataArr[count];
          }
          count++;
        }
        this.tourInfo.tourData = this.selectedTour;
        this.setTourData();
        this.editTourTravelingTime();
        this.editTourPrivacy();
        this.editTourDate();
      } 
    }

    // 2. Set & binding [ Tour traveling time (Morning, Afternoon, Evening, Fullday) ]
    editTourTravelingTime(){  
      this.tourInfo.tourTime = this._getBookingEditArr.bookingInfo.travelTime;
    }

    // 3. Set & binding [ Tour privacy (Join, Private) ]
    editTourPrivacy(){
      this.tourInfo.tourPrivacy = this._getBookingEditArr.bookingInfo.tourPrivacy;
    }

    // 4. Set & binding [ Tour date ]
    editTourDate(){
      let genDate = new Date(this._getBookingEditArr.bookingInfo.travelDate);
      this.tourInfo.tourTravelDateSelect = genDate; // edit only
    }

    // 5. Set & binding [ Hotel & Room ]
    editHotel(){
      let count = 0;
      for(var data in this._getAccountCodeArr){
        if(this._getAccountCodeArr[count].hotel==this._getBookingEditArr.hotelInfo.name){
          this.selectedHotel = this._getAccountCodeArr[count].hotel;
        }
        count++;
      }
      // Hotel & Hotel Other
      if(this.selectedHotel=='' || this.selectedHotel==undefined || this.selectedHotel==null || this.selectedHotel=='Other'){
        this.hotel.hotelName = 'Other';
        this.hotel.hotelOther = this._getBookingEditArr.hotelInfo.name;
      }else{
        this.hotel.hotelName = this.selectedHotel;
      }
      // Room
      this.hotel.hotelRoom = this._getBookingEditArr.hotelInfo.room;
    }

    // 6. Set & binding [ Guest Pax ]
    editGuestPax(){
      this.tourInfo.tourPax = this._getBookingEditArr.bookingInfo.pax;
      this.setGuestData(this.tourInfo.tourPax); // add guest field by pax
    }

    // 7. Set & binding [ Guest info per person]
    editGuestInfo(){
      let count = 0;
      for(var data in this._getBookingEditArr.guestInfo){
        this.guestName[count] = this._getBookingEditArr.guestInfo[count].name;
        this.guestAges[count] = this._getBookingEditArr.guestInfo[count].isAges;
        count++;
      }
    }

    // 8. Set & binding [ Tour price ]
    editTourPrice(){
      let count = 0;
      for(var data in this.tourTypePriceArr){
        if(this.tourTypePriceArr[count].type == this._getBookingEditArr.paymentInfo.tourPrice){
          this.selectedTourPrice = this.tourTypePriceArr[count].type;
        }
        count++;
      }
      this.paymentInfo.tourPrice = this.selectedTourPrice;
    }

    // 9. Set & binding [ Payment collect ]
    editPaymentCollect(){
      let count = 0;
      for(var data in this.tourPaymentCollectArr){
        if(this.tourPaymentCollectArr[count].collect == this._getBookingEditArr.paymentInfo.paymentCollect){
          this.selectedPaymentCollect = this.tourPaymentCollectArr[count].collect;
        }
        count++;
      }
      this.paymentInfo.paymentCollect = this.selectedPaymentCollect;
    }

    // 10. Set & binding [ Discount ]
    editDiscount(){
      let discountLength = this._getBookingEditArr.summary.discount.length;
      let discountRate;
      if(discountLength==3){
        discountRate = this._getBookingEditArr.summary.discount.substr(-3,2);
      }else if(discountLength==2){
        discountRate = this._getBookingEditArr.summary.discount.substr(-2,1);
      }else{
        discountRate = 0;
      }
      this.summary.discount = discountRate;
    }

    // 11. Set & binding [ Service charge 3% ]
    editServiceCharge(){
      this.service.isServiceCharge = this._getBookingEditArr.bookingInfo.isServiceCharge;
    }

    // 12. Set & binding [ Single riding ]
    editSingleRiding(){
      let singleRide = this._getBookingEditArr.summary.singleRiding;
      if(singleRide==0){
        this.isSingleRiding = false;
      }else if(singleRide>0){
        this.isSingleRiding = true;
      }
    }

    // 13. Set & binding [ Special request & charge price]
    editSpecialRequest(){
      this.specialRequest = this._getBookingEditArr.specialRequest;
      this.specialRequestPrice = this._getBookingEditArr.specialRequestPrice;
    }

    // 14. Set & binding [ Booked by & tel ]
    editBookedBy(){
      this.bookBy.name = this._getBookingEditArr.bookBy.name;
      this.bookBy.tel = this._getBookingEditArr.bookBy.tel;
    }

    // 15. Set & binding [ Booked by position & other ]
    editBookedByPosition(){
      let position = this._getBookingEditArr.bookBy.position;
      let byPosition;
      let count = 0;
      this.bookBy.position = 'Other';
      this.bookBy.positionOther = position;
      for(var data in this.bookByPositionArr){
        if(position==this.bookByPositionArr[count].position){
          this.bookBy.position = position;
        }
        count++;
      }
    }

    // 16. Set & binding [ Account name & other ]
    editAccountName(){
      let accountCode = this._getBookingEditArr.bookBy.code;
      if(accountCode!=0){
        this.bookBy.accountName = this._getBookingEditArr.bookBy.hotel;
      }else if(accountCode==0){
        this.bookBy.accountName = 'Other';
        this.bookBy.accountNameOther = this._getBookingEditArr.bookBy.hotel;
      }
    }

    // 17. Set & binding [ Insurance & note ]
    editInsurance(){
      this.insurance.isInsurance = this._getBookingEditArr.insurance.isInsurance;
      this.insurance.insuranceReason = this._getBookingEditArr.insurance.insuranceReason;
    }

    // 18. Set & binding [ Commission ]
    editCommission(){
      this.commission.isCommission = this._getBookingEditArr.commission.isCommission;
    }

    // 19. Set & binding [ Note by ]
    editNoteBy(){
      let noteBy = this._getBookingEditArr.noteBy.name;
      let count = 0;
      this.noteBy.name = 'Other';
      this.noteBy.other = noteBy;
      for(var data in this.noteByArr){
        if(noteBy==this.noteByArr[count].name){
          this.noteBy.name = this.noteByArr[count].name;
        }
        count++;
      }
    }

    // 20. Set invocie reference [ inv ref. ]
    setInvoiceRef(){
      let invoiceRefId = this._getBookingEditArr.invoiceRef.id;
      let invoiceRefNum = this._getBookingEditArr.invoiceRef.number;
      if(invoiceRefId==null || invoiceRefId==undefined){
        this.setInvoiceReference.id = 0;
        this.setInvoiceReference.number = '';
      }else{
        this.setInvoiceReference.id = invoiceRefId;
        this.setInvoiceReference.number = invoiceRefNum;
      }
    }

    // 21. Set rate 2 pax for booking 1 pax
    setRateTwoPax(){
      let rate2Pax = this._getBookingEditArr.bookingInfo.rateTwoPax;
      if(rate2Pax==0){
        this.rateTwoPax = false;
      }else{
        this.rateTwoPax = true;
      }
    }

    // 22. Set single riding charge by pax
    setSingleRidingPax(){
      this.singleRidingPax  = this._getBookingEditArr.summary.singleRidingPax;
    }

    // 23. Set Get Your Guide Code
    setOtaCode(){
      this.bookBy.otaCode = this._getBookingEditArr.bookBy.otaCode;
    }

    // 24. Set Deposit price
    setDepositPrice(){
      this.summary.deposit = this._getBookingEditArr.summary.depositPrice;
    }

    // 25. Set Special request [Operator]
    setSpecialRequestOperator(){
      this.specialRequestOperator = this._getBookingEditArr.isSpecialRequestOperator;
      // console.log('Model : '+this.specialRequestOperator);
      // console.log('Get : '+this._getBookingEditArr.isSpecialRequestOperator);
    }

  /*============== Edit Form (end) ==============*/

  ngOnInit() {
    this.getBookingEdit();
    this.getBookingData();
    this.getAccountCode();
  }
}