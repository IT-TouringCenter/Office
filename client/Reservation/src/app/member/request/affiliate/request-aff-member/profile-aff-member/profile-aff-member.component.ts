import { Component, OnInit } from '@angular/core';
import { Http, RequestOptions } from '@angular/http';
import { HttpClient } from '@angular/common/http';
import { Router } from '@angular/router';
import { FormControl, Validators } from '@angular/forms';
import { Observable } from 'rxjs/Rx';

@Component({
  selector: 'app-profile-aff-member',
  templateUrl: './profile-aff-member.component.html',
  styleUrls: ['./profile-aff-member.component.scss'],
  providers: [
    // FormControl
  ]
})

export class ProfileAffMemberComponent implements OnInit {
  // variable
  public profile = {
    fullname: <any>'',
    birth: <any>'',
    tel: <any>'',
    email: <any>'',
    nationality: <any>'',
    address: <any>'',
    idNumber: <any>'',
    profilePicture: <any>'',
    copyIdCard: <any>''
  };

  requestAffiliate = <any>'';

  profileUpload: File = null;
  idCardUpload: File = null;

  // validation
  validation = new FormControl('',[Validators.required]);
  validProfile = {
    fullname: true,
    birth: true,
    tel: true,
    email: true,
    nationality: true,
    address: true,
    idNumber: true,
    profilePicture: '',
    copyIdCard: ''
  };
  nextButton = true;

  constructor(
    private http: Http,
    private https: HttpClient,
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
    this.router.navigate(['user/member/request/affiliate']);
  }

  // 3. window next
  public windowNext(){
    let setData = this.setDataToStorage(this.profile);

    if(setData==true){
      this.router.navigate(['user/member/request/affiliate/step2']);
    }
  }

  // Logic
  // 4. get data profile (api)
  public GetAccountProfile(){
    // check storage
    let checkStorage = JSON.parse(sessionStorage.getItem('set-profile'));
    if(checkStorage){
      this.bindingData(checkStorage);
      return;
    }

    // get user
    let user = JSON.parse(localStorage.getItem('users'));
    let token = '';

    if(user){
      token = user.data.token;
    }else{
      this.router.navigate(['user/logout']);
    }

    // let url = 'http://localhost:9000/api/Dashboard/Member/GetAccountProfile';
    let url = 'http://api.tourinchiangmai.com/api/Dashboard/Member/GetAccountProfile';

    let users = {
      token: token
    }

    let options = new RequestOptions();
    return this.http.post(url, users, options)
                    .map(res => res.json())
                    .subscribe(
                      data => [
                        // console.log(data),
                        sessionStorage.setItem('req-profile',JSON.stringify(data.data[0])),
                        this.bindingData(data.data[0])
                      ],
                      err => [
                        console.log(err)
                      ]
                    );
  }

  // 5. binding data
  public bindingData(data){
    // set data to form
    this.profile.fullname = data.fullname;
    this.profile.birth = data.birth;
    this.profile.tel = data.tel;
    this.profile.email = data.email;
    this.profile.nationality = data.nationality;
    this.profile.address = data.address;
    this.profile.idNumber = data.idNumber;
    // this.profile.profilePicture = data.picture;
    // this.profile.copyIdCard = data.copyIdCard;
  }

  // 6. set profile data to storage
  public setDataToStorage(data){
    sessionStorage.setItem('set-profile',JSON.stringify(data));    
    let getData = sessionStorage.getItem('set-profile');

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
      alert('Session expired, please login again.');
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
      case 'fullname'     : if(this.validation.hasError('required')){
                              this.validProfile.fullname = true;
                              return 'กรอกชื่อ-นามสกุล (5-50 ตัวอักษร)';
                            }else{
                              this.validProfile.fullname = false;
                              return '';
                            };
      case 'birth'        : if(this.validation.hasError('required')){
                              this.validProfile.birth = true;
                              return 'เลือกวัน/เดือน/ปีเกิด (m/dd/yyyy)';
                            }else{
                              this.validProfile.birth = false;
                              return '';
                            };
      case 'tel'          : if(this.validation.hasError('required')){
                              this.validProfile.tel = true;
                              return 'กรอกเบอร์โทรศัพท์';
                            }else{
                              this.validProfile.tel = false;
                              return '';
                            };
      case 'email'        : if(this.validation.hasError('required')){
                              this.validProfile.email = true;
                              return 'กรอกอีเมล';
                            }else{
                              this.validProfile.email = false;
                              return '';
                            };
      case 'nationality'  : if(this.validation.hasError('required')){
                              this.validProfile.nationality = true;
                              return 'กรอกสัญชาติ';
                            }else{
                              this.validProfile.nationality = false;
                              return '';
                            };
      case 'address'      : if(this.validation.hasError('required')){
                              this.validProfile.address = true;
                              return 'กรอกข้อมูลที่อยู่';
                            }else{
                              this.validProfile.address = false;
                              return '';
                            };
      case 'IdNumber'     : if(this.validation.hasError('required')){
                              this.validProfile.idNumber = true;
                              return 'กรอกหมายเลขประจำตัวประชาชน 13 หลัก';
                            }else{
                              this.validProfile.idNumber = false;
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
    // console.log('Fullname : '+this.profile.fullname+' ('+this.profile.fullname.length+')');
    // console.log('Birth : '+this.profile.birth+' ('+this.profile.birth.length+')');
    // console.log('Tel : '+this.profile.tel+' ('+this.profile.tel.length+')');
    // console.log('Email : '+this.profile.email+' ('+this.profile.email.length+')');
    // console.log('Nationality : '+this.profile.nationality+' ('+this.profile.nationality.length+')');
    // console.log('Address : '+this.profile.address+' ('+this.profile.address.length+')');
    // console.log('Id number : '+this.profile.idNumber+' ('+this.profile.idNumber.length+')');
    // console.log('---------------------------------------------');
    if(this.profile.fullname!==null 
      && this.profile.birth!==null 
      && this.profile.tel!==null 
      && this.profile.email!==null 
      && this.profile.nationality!==null 
      && this.profile.address!==null 
      && this.profile.idNumber!==null
      ){
      this.nextButton=false; // diabled == false
      // console.log('++++++');
    }else{
      this.nextButton=true; // diabled == true
      // console.log('******');
    }
    // if(this.profile.fullname.length > 4 
    //   && this.profile.birth.length > 7 
    //   && this.profile.tel.length > 4 
    //   && this.profile.email.length > 4 
    //   && this.profile.nationality.length > 1 
    //   && this.profile.address.length > 9 
    //   && this.profile.idNumber.length > 5){

    //   this.nextButton=false; // diabled == false
    // }else{
    //   this.nextButton=true; // diabled == true
    // }
    // console.log(this.nextButton);
  }

  ngOnInit() {
    this.checkMemberRequestAffiliate();
    this.activeMenu();
    this.GetAccountProfile();

    // check every time
    Observable.interval(1000*1).subscribe(x => { // 1 sec
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
