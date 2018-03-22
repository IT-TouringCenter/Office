import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';

@Component({
  selector: 'app-search-header',
  templateUrl: './search-header.component.html',
  styleUrls: ['./search-header.component.css']
})
export class SearchHeaderComponent implements OnInit {

  @Input() message: string;

  messageOut: string = 'Child message';
  @Output() messageEvent = new EventEmitter<string>();

  // search by
  searchBy: string;
  @Output() searchEvent = new EventEmitter<string>();

  constructor() { }

  ngOnInit() {}

  sendMessage() {
    this.messageEvent.emit(this.messageOut);
  }

  onSearch(value) {
    //this.searchBy = value;
    this.searchEvent.emit(value);
    console.log("Search by: " + value);
  }
}
