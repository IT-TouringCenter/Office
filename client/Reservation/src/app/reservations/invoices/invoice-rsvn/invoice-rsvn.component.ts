import { Component, OnInit } from '@angular/core';
import { FormsModule, FormControl, Validators } from '@angular/forms';
// Services
import { InvoiceRsvnService } from './invoice-rsvn.service';
// Interfaces
import { InvoiceRsvnInterface } from './invoice-rsvn-interface';

@Component({
  selector: 'app-invoice-rsvn',
  templateUrl: './invoice-rsvn.component.html',
  styleUrls: ['./invoice-rsvn.component.scss'],
  providers: [InvoiceRsvnService]
})
export class InvoiceRsvnComponent implements OnInit {

  _getInvoice: InvoiceRsvnInterface.RootObject;

  public paymentCollectColor = '';
  public invoiceNote = '';

  constructor(
    private invoiceRsvnService: InvoiceRsvnService
  ) { }

  // JSON invoice from API
  getInvoiceFromData(): void{
    this.invoiceRsvnService.getInvoiceData()
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