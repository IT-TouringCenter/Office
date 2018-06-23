import { Component, Input } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { Http } from '@angular/http';
// import 'rxjs/add/operator/map';
import { MatFormFieldModule } from '@angular/material/form-field';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})

export class AppComponent {
  constructor(){}

  private switchUser = 'all';

  switchPage(){
    this.switchUser = '1';
  }

  ngOnInit() {
    this.switchPage();
  }
}