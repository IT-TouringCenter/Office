import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-menu-bar-admin',
  templateUrl: './menu-bar-admin.component.html',
  styleUrls: ['./menu-bar-admin.component.scss']
})
export class MenuBarAdminComponent implements OnInit {

  constructor() { }

  // none active menu
  nonActiveMenu(){
    sessionStorage.setItem('menu',JSON.stringify(0));
  }

  toggleSidebar(){
    
  }

  ngOnInit() {
    
  }

}
