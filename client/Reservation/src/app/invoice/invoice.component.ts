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

  public paymentCollectColor = '';
  public invoiceNote = '';

  constructor(
    private invoiceService: InvoiceService
  ) { }

  // JSON invoice from API
  getInvoiceFromData(): void{
    this.invoiceService.getInvoiceData()
      .subscribe(
        resultArray => [
          this._getInvoice = resultArray,
          this.paymentCollectColor = this._getInvoice.paperColor, 
          this.invoiceNote = this._getInvoice.tours.code
        ],
        error => console.log("Error :: " + error)
      )
  }

  ngOnInit() {
    this.getInvoiceFromData();
  }
  
}