import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-search',
  templateUrl: './search.component.html',
  styleUrls: ['./search.component.css']
})
export class SearchComponent implements OnInit {

  searchBy: string  = 'all';
  message: string = 'this pass message to child compnent.';

    constructor() {

    }

    ngOnInit() {
    }

    receiveMessage($event) {
      this.message = $event;
    }

    onSearchBy($event) {
      this.searchBy = $event;
      console.log(this.searchBy);
    }
}
