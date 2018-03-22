import { Component, Directive, OnInit } from '@angular/core';
// import { Parallax, ParallaxConfig } from 'ng2-parallax/src/ts/parallax.directive'

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})
export class HeaderComponent implements OnInit {

  isShow: boolean;

  constructor() {
    this.isShow = false;
    console.log('Is show:' + this.isShow);
  }

  ngOnInit() {
  }

  showSearch(event) {
    this.isShow = !this.isShow;
    console.log('Is show:' + this.isShow);
  }
}
