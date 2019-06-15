import { Component, OnInit } from '@angular/core';
import { Http, RequestOptions } from '@angular/http';
import { Router } from '@angular/router';
import { FormControl, Validators } from '@angular/forms';
import { Observable } from 'rxjs/Rx';

@Component({
  selector: 'app-bank-aff-member',
  templateUrl: './bank-aff-member.component.html',
  styleUrls: ['./bank-aff-member.component.scss']
})
export class BankAffMemberComponent implements OnInit {

  // variable
  public getBank = <any>'';
  public bankData = {
    accountName: <any>'',
    accountNo: <any>'',
    bank: <any>'',
    bankOther: <any>'',
    branch: <any>'',
    copyBook: <any>''
  };

  requestAffiliate = <any>'';

  // validation
  validation = new FormControl('',[Validators.required]);
  validBank = {
    bank: true,
    bankOther: true,
    accountName: true,
    accountNo: true
  };
  nextButton = true;

  constructor(
    private http: Http,
    private router: Router
  ) { }

  // 1. active menu
  public activeMenu(){
    // set storage
    sessionStorage.setItem('menu',JSON.stringify(2));
    sessionStorage.setItem('sub-menu',JSON.stringify(2));
  }

  // 2. window back
  public windowBack(){
    this.router.navigate(['user/member/request/affiliate/step1']);
  }

  // 3. window next
  public windowNext(){
    let setData = this.setDataToStorage(this.bankData);

    if(setData==true){
      this.router.navigate(['user/member/request/affiliate/step3']);
    }
  }

  // Logic
  // 4. get bank data (api)
  public getBankData(){
    // let url = 'http://localhost:9000/api/Bank/GetBankData';
    let url = 'http://api.tourinchiangmai.com/api/Bank/GetBankData';

    return this.http.get(url)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        // console.log(data),
                        sessionStorage.setItem('bank-data',JSON.stringify(data)),
                        this.bindingBankData(data)
                      ],
                      err => [
                        console.log(err)
                      ]
                    );
  }

  // 5. binding bank data to form
  public bindingBankData(data){
    this.getBank = data;

    // check storage
    let checkStorage = JSON.parse(sessionStorage.getItem('set-bank'));

    if(checkStorage){
      // this.bankData.bank = checkStorage.bank;
      this.bankData.bankOther = checkStorage.bankOther;
      this.bankData.accountName = checkStorage.accountName;
      this.bankData.accountNo = checkStorage.accountNo;
    }

    for(let i=0; i<this.getBank.length; i++){
      if(this.getBank[i].id==checkStorage.bank.id){
        this.bankData.bank = this.getBank[i];
      }
    }
    
  }

  // 6. set data to sessionStorage
  public setDataToStorage(data){
    sessionStorage.setItem('set-bank',JSON.stringify(data));
    let getData = sessionStorage.getItem('set-bank');

    if(getData){
      return true;
    }else{
      return false;
    }
  }

  // 7. check request affiliate
  // 7.1 
  checkMemberRequestAffiliate(){
    let token = <any>'';

    // get user
    let getUser = JSON.parse(localStorage.getItem('users'));
    if(getUser){
      let token = getUser.data.token;
    }else{
      this.router.navigate(['user/logout']);
    }

    // set data
    let setData = {
      "token": getUser.data.token
    };

    // post for check request affiliate : API
    // let url = 'http://localhost:9000/api/Dashboard/Member/CheckRequestJoinAffiliate';
    let url = 'http://api.tourinchiangmai.com/api/Dashboard/Member/CheckRequestJoinAffiliate';

    let options = new RequestOptions();

    return this.http.post(url, setData, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        sessionStorage.setItem('request-aff',JSON.stringify(data)),
                        this.checkRequestAffiliate(data)
                      ],
                      err => [
                        console.log(err)
                      ]
                    );
  }

  // 7.2 
  checkRequestAffiliate(data){
    let getRequestAff = data;

    if(getRequestAff.message=='Complete'){
      alert('คุณได้ส่งคำขอเรียบร้อยแล้ว โปรดรอการอนุมัติ...');
      this.router.navigate(['user/member/approval']);
    }else{
      this.requestAffiliate = false;
    }
    
  }

  // validation
  validationField(param){
    switch(param){
      case 'bank'         : if(this.validation.hasError('required')){
                              this.validBank.bank = true;
                              return 'เลือกธนาคาร';
                            }else{
                              this.validBank.bank = false;
                              return '';
                            };
      case 'bankOther'         : if(this.validation.hasError('required')){
                              this.validBank.bankOther = true;
                              return 'กรอกชื่อธนาคาร';
                            }else{
                              this.validBank.bankOther = false;
                              return '';
                            };
      case 'accountName'  : if(this.validation.hasError('required')){
                              this.validBank.accountName = true;
                              return 'กรอกชื่อบัญชี';
                            }else{
                              this.validBank.accountName = false;
                              return '';
                            };
      case 'accountNo'    : if(this.validation.hasError('required')){
                              this.validBank.accountNo = true;
                              return 'กรอกหมายเลขบัญชี';
                            }else{
                              this.validBank.accountNo = false;
                              return '';
                            };
    }
  }

  // initValidation(){
  //   let field = ['fullname','birth','tel','email','nationality','address','IdNumber'];
  //   let length = field.length;
  //   for(let i=0; i<length; i++){
  //     this.validationField(field[i]);
  //     this.validation.hasError('required');
  //   }
  // }

  checkNextButton(){
    if(this.bankData.bank.bankEN!=undefined && this.bankData.accountName.length > 4 && this.bankData.accountNo.length > 9){
      if(this.bankData.bank.bankEN=='Other'){
        if(this.bankData.bankOther.length > 2){
          this.nextButton=false; // diabled == false
        }else{
          this.nextButton=true; // diabled == true
        }
      }else{
        this.nextButton=false; // diabled == false
      }
    }else{
      this.nextButton=true; // diabled == true
    }

  }

  ngOnInit() {
    this.checkMemberRequestAffiliate();
    this.activeMenu();
    this.getBankData();

    // check every time
    Observable.interval(1000*1).subscribe(x => { // 1sec
      // this.initValidation();
      this.checkNextButton();
    });
  }

  //Check Number Only
  CheckNum($event: KeyboardEvent) {
    console.log($event)
    let value = (<HTMLInputElement>event.target).value;
  
      (<HTMLInputElement>event.target).value = value.replace(/\D/g, '');
    
  }


}
