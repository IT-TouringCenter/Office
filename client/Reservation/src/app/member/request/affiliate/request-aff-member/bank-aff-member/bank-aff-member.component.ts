import { Component, OnInit } from '@angular/core';
import { Http, RequestOptions } from '@angular/http';
import { Router } from '@angular/router';

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

  constructor(
    private http: Http,
    private router: Router
  ) { }

  // 1. active menu
  public activeMenu(){
    // set storage
    sessionStorage.setItem('menu',JSON.stringify(999));
    sessionStorage.setItem('sub-menu',JSON.stringify(999));
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
    let url = 'http://localhost:9000/api/Bank/GetBankData';
    // let url = 'http://api.tourinchiangmai.com/api/Bank/GetBankData';

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

  // . set data to sessionStorage
  public setDataToStorage(data){
    sessionStorage.setItem('set-bank',JSON.stringify(data));
    let getData = sessionStorage.getItem('set-bank');

    if(getData){
      return true;
    }else{
      return false;
    }
  }

  ngOnInit() {
    this.activeMenu();
    this.getBankData();
  }

}
