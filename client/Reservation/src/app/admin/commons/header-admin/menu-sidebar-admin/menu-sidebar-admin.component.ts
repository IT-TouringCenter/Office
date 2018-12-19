import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-menu-sidebar-admin',
  templateUrl: './menu-sidebar-admin.component.html',
  styleUrls: ['./menu-sidebar-admin.component.scss']
})
export class MenuSidebarAdminComponent implements OnInit {

  id = 0;
  subId = 0;
  bookedId = 0;

  constructor() { }

  // Menu
  addClass(id: number) {
  // addClass(id) {
    // set storage
    let setMenu = sessionStorage.setItem('menu',JSON.stringify(id));
    let setSubMenu = sessionStorage.setItem('sub-menu',JSON.stringify(101));
    this.activeMenu();
    this.activeSubMenu();
  }

  activeMenu(){
    // get storage
    let active = JSON.parse(sessionStorage.getItem('menu'));
    this.id = active;
  }

  // Sub menu
  addSubClass(subId: number){
    // set storage
    let setSubmenu = sessionStorage.setItem('sub-menu',JSON.stringify(subId));
    // let toStr = subId.toString();
    // let subStrId = toStr.substr(0, 1);
    // let active = subStrId;

    // this.addClass(subStrId);
    this.activeSubMenu();
  }

  activeSubMenu(){
    // get storage
    let subActive = JSON.parse(sessionStorage.getItem('sub-menu'));
    // this.id = subActive.substr(0,1);
    this.subId = subActive;
  }

  ngOnInit() {
    this.activeMenu();
    this.activeSubMenu();
  }

}