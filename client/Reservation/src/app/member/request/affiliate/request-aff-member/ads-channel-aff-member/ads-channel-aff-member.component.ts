import { Component, OnInit } from '@angular/core';
import { Http, RequestOptions} from '@angular/http';
import { Router } from '@angular/router';
import { FormControl, Validators } from '@angular/forms';
import { Observable } from 'rxjs/Rx';

@Component({
  selector: 'app-ads-channel-aff-member',
  templateUrl: './ads-channel-aff-member.component.html',
  styleUrls: ['./ads-channel-aff-member.component.scss']
})
export class AdsChannelAffMemberComponent implements OnInit {

  // variable
  public channelData = {
    url1: <any>'',
    url2: <any>'',
    url3: <any>''
  };

  requestAffiliate = <any>'';

  // validation
  validation = new FormControl('',[Validators.required]);
  validAds = {
    url: true
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
    this.router.navigate(['user/member/request/affiliate/step2']);
  }

  // 3. window next
  public windowNext(){
    let setData = this.setDataToStorage(this.channelData);

    if(setData==true){
      this.router.navigate(['user/member/request/affiliate/step4']);
    }
  }

  // Logic
  // 4. binding data
  public bindingData(){
    // get storage
    let getSession = JSON.parse(sessionStorage.getItem('set-channel'));
    if(getSession){
      this.channelData.url1 = getSession.url1;
    }
  }


  // 5. set data to sessionStorage
  public setDataToStorage(data){
    sessionStorage.setItem('set-channel',JSON.stringify(data));
    let getData = sessionStorage.getItem('set-channel');

    if(getData){
      return true;
    }else{
      return false;
    }
  }

  // 6. check request affiliate
  // 6.1 
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

  // 6.2 
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
      case 'url'            : if(this.validation.hasError('required')){
                              this.validAds.url = true;
                              return 'กรอกข้อมูลช่องทางการโฆษณา';
                            }else{
                              this.validAds.url = false;
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
    if(this.channelData.url1.length > 5){
      this.nextButton = false; // disabled == false
    }else{
      this.nextButton = true; // disabled == true;
    }

  }

  ngOnInit() {
    this.checkMemberRequestAffiliate();
    this.activeMenu();
    this.bindingData();

    // check every time
    Observable.interval(1000*1).subscribe(x => { // 1sec
      // this.initValidation();
      this.checkNextButton();
    });
  }

}
