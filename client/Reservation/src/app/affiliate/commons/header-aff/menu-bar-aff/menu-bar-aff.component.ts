import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-menu-bar-aff',
  templateUrl: './menu-bar-aff.component.html',
  styleUrls: ['./menu-bar-aff.component.scss']
})
export class MenuBarAffComponent implements OnInit {

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
