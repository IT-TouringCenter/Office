import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-invoice-note',
  templateUrl: './invoice-note.component.html',
  styleUrls: ['./invoice-note.component.scss']
})
export class InvoiceNoteComponent implements OnInit {

  @Input() public invoiceNotice;

  noted = {
    dress: '',
    bring: ''
  };

  constructor() { }

  setInvoiceNotice(){
    if(this.invoiceNotice=='TC-01'){
      this.noted.dress = '** Clothing : Shoulders and Kness need to be covered for entry to temples. **';
      this.noted.bring = '*** What to bring along : Camara , Sunglass , Coat ***';
    }else if(this.invoiceNotice=='TC-02'){
      this.noted.dress = '** Clothing : Shoulders and Kness need to be covered for entry to temples. **';
      this.noted.bring = '*** What to bring along : Camara , Sunglass ***';
    }else if(this.invoiceNotice=='TC-03'){
      this.noted.dress = '** Dress with long pants and covered shoulders. **';
      this.noted.bring = '*** What to bring along : Camara , Sunglass ***';
    }else if(this.invoiceNotice=='TC-04'){
      this.noted.dress = '** Dress with long pants and covered shoulders. **';
      this.noted.bring = '*** What to bring along : Camara , Sunglass ***';
    }else if(this.invoiceNotice=='TC-05A'){
      this.noted.dress = '** Dress with long pants and covered shoulders. **';
      this.noted.bring = '*** What to bring along : Camara , Sunglass ***';
    }else if(this.invoiceNotice=='TC-05E'){
      this.noted.dress = '** Dress with long pants and covered shoulders. **';
      this.noted.bring = '*** What to bring along : Camara ***';
    }else if(this.invoiceNotice=='TC-06'){
      this.noted.dress = '** What to bring along : Camara **';
      this.noted.bring = '***  ***';
    }else if(this.invoiceNotice=='TC-07'){
      this.noted.dress = '** Dress with long pants and covered shoulders. **';
      this.noted.bring = '*** What to bring along : Camara , Sunglass ***';
    }else if(this.invoiceNotice=='TC-08'){
      this.noted.dress = '** Clothing : Shoulders and Kness need to be covered for entry to temples. **';
      this.noted.bring = '*** What to bring along : Passport , Camara , Sunglass , Coat ***';
    }else if(this.invoiceNotice=='TC-09'){
      this.noted.dress = '** Clothing : Shoulders and Kness need to be covered for entry to temples. **';
      this.noted.bring = '*** What to bring along : Camara , Sunglass , Coat ***';
    }else if(this.invoiceNotice=='TC-10'){
      this.noted.dress = '** Dress with long pants and covered shoulders. **';
      this.noted.bring = '*** What to bring along : Camara , Sunglass ***';
    }else if(this.invoiceNotice=='TC-11'){
      this.noted.dress = '** Dress with long pants and covered shoulders. **';
      this.noted.bring = '*** What to bring along : Camara , Sunglass ***';
    }else if(this.invoiceNotice=='TC-12'){
      this.noted.dress = '** Dress with long pants and covered shoulders and Trekking shoes **';
      this.noted.bring = '*** What to bring along : Camara , Sunglass ***';
    }else if(this.invoiceNotice=='TC-S01'){
      this.noted.dress = '** Dress with long pants and covered shoulders and Trekking shoes **';
      this.noted.bring = '*** What to bring along : Camara , Sunglass ***';
    }else if(this.invoiceNotice=='TC-S02M'){
      this.noted.dress = '** Clothing : Shoulders and Kness need to be covered for entry to temples. **';
      this.noted.bring = '*** What to bring along : Camara , Sunglass , Coat ***';
    }else if(this.invoiceNotice=='TC-S02A'){
      this.noted.dress = '** Clothing : Shoulders and Kness need to be covered for entry to temples. **';
      this.noted.bring = '*** What to bring along : Camara , Sunglass , Coat ***';
    }
  }

  ngOnInit() {
    this.setInvoiceNotice();
  }

}
