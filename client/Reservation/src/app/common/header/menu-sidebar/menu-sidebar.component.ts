import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-menu-sidebar',
  templateUrl: './menu-sidebar.component.html',
  styleUrls: ['./menu-sidebar.component.scss']
})
export class MenuSidebarComponent implements OnInit {

  constructor() { }

  sidebarActive(){
    let getActive = JSON.parse(sessionStorage.getItem('sidebar-active'));
    // $('.sidebar-active').addClass('active');
  }

  ngOnInit() {
    this.sidebarActive();
  }

}
