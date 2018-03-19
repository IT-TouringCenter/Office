import { Component, OnInit } from '@angular/core';
import { FormsModule, FormControl, Validators } from '@angular/forms';
// Services
import { BookedstatisticsService } from './bookedstatistics.service';
// Interfaces
import { BookedStatisticsInterface } from './../../interfaces/booked-statistics';

@Component({
  selector: 'app-bookedstatistics',
  templateUrl: './bookedstatistics.component.html',
  styleUrls: ['./bookedstatistics.component.scss'],
  providers: [BookedstatisticsService]
})
export class BookedstatisticsComponent implements OnInit {

  _getBookingStatistics: BookedStatisticsInterface;

  constructor(
    private BookedstatisticsService: BookedstatisticsService
  ) { }

  // JSON booked stat from API
  getInvoiceFromData(): void{
    this.BookedstatisticsService.getBookingStatisticsData()
      .subscribe(
        resultArray => console.log(this._getBookingStatistics = resultArray),
        error => console.log("Error :: " + error)
      )
  }

  ngOnInit() {
    this.getInvoiceFromData();
  }
  
}