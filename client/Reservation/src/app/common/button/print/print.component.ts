import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-btn-print',
  templateUrl: './print.component.html',
  styleUrls: ['./print.component.scss']
})
export class PrintComponent implements OnInit {

  constructor() { }

  windowPrint(){
    window.print();
  }

  @Input() public paperColorPrint;

  ngOnInit() {
  }

}
