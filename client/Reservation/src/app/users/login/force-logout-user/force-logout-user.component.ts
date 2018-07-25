import { Component, OnInit } from '@angular/core';
import { ValidatorFn, Validator, AbstractControl, FormControl, NG_VALIDATORS } from '@angular/forms';

@Component({
  selector: 'app-force-logout-user',
  templateUrl: './force-logout-user.component.html',
  styleUrls: ['./force-logout-user.component.scss']
})
export class ForceLogoutUserComponent implements OnInit {

  constructor() { }

  test(){
    // sessionStorage.getItem('');
    sessionStorage.setItem('TC','111111');
  }

  ngOnInit() {
    this.test();
  }

}
