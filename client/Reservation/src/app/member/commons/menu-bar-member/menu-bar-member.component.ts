import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-menu-bar-member',
  templateUrl: './menu-bar-member.component.html',
  styleUrls: ['./menu-bar-member.component.scss']
})
export class MenuBarMemberComponent implements OnInit {
  user = "";
  id = 0;
  subId = 0;
  bookedId = 0;

  iconMenu = 0;
  request = true;

  constructor(
    private router: Router,
  ) { }

  // Get user
  getUser(){
    let getUser = JSON.parse(localStorage.getItem('users'));
    if(getUser==null || getUser==undefined || getUser==''){
      this.user = "";
    }else{
      this.user = getUser.data.name;
    }
  }

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

  // none active menu
  nonActiveMenu(){
    sessionStorage.setItem('menu',JSON.stringify(0));
  }

  toggleSidebar(){
    let sidebar = document.getElementById("sidebar");
    let sidebarMenu = document.getElementById("nav-accordion");

    if (sidebar.style.display === "none") {
      sidebar.style.display = "block";
      sidebar.style.width = "220px";
      sidebar.style.height = "100%";
      sidebar.style.position = "fixed";
      sidebarMenu.style.display = "block";

      this.iconMenu = 1;
    } else {
      sidebar.style.display = "none";
      sidebarMenu.style.display = "none";

      this.iconMenu = 0;
    }
  }

  //
  logout(){
    let logout = confirm("Are you sure!!");
    if(logout!=true){
      return;
    }else{
      this.router.navigate(['user/logout']);
    }
  }

  ngOnInit() {
    this.getUser();
    this.activeMenu();
    this.activeSubMenu();
  }

}
