import { Component, OnInit } from '@angular/core';
import { FormsModule, FormControl, Validators } from '@angular/forms';
// Services
import { InvoiceService } from './invoice.service';
// Interfaces
import { InvoiceInterface } from './../interfaces/invoice-interface';

@Component({
  selector: 'app-invoice',
  templateUrl: './invoice.component.html',
  styleUrls: ['./invoice.component.scss'],
  providers: [InvoiceService]
})
export class InvoiceComponent implements OnInit {

  _getInvoice: InvoiceInterface.RootObject;

  constructor(
    private invoiceService: InvoiceService
  ) { }

  // JSON invoice from API
  getInvoiceFromData(): void{
    this.invoiceService.getInvoiceData()
      .subscribe(
        resultArray => console.log(this._getInvoice = resultArray),
        error => console.log("Error :: " + error)
      )
  }

  ngOnInit() {
    this.getInvoiceFromData();
  }
  
}