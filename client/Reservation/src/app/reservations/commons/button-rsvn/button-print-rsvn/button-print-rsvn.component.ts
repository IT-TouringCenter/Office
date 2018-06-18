import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-button-print-rsvn',
  templateUrl: './button-print-rsvn.component.html',
  styleUrls: ['./button-print-rsvn.component.scss']
})
export class ButtonPrintRsvnComponent implements OnInit {

  constructor() { }

  windowPrint(){
    window.print();
  }

  @Input() public paperColorPrint;

  ngOnInit() {
  }

}
