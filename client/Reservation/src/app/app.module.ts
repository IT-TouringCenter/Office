import { AppRoutingModule } from './app-routing.module';
import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { HttpModule } from '@angular/http';
import { FormsModule } from '@angular/forms';
// import { CallServices } from './services/call-api.service';
// import { HttpClientModule } from '@angular/common/http';

import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { NoopAnimationsModule } from '@angular/platform-browser/animations';
import { MaterialModule } from './material.module';

// Template
import { AppComponent } from './app.component';
import { DashboardsComponent } from './dashboards/dashboards.component';
import { HomeComponent } from './home/home.component';
import { InvoiceComponent } from './invoice/invoice.component';
import { BookingformComponent } from './bookings/bookingform/bookingform.component';
import { BookingprintComponent } from './bookings/bookingprint/bookingprint.component';
import { ReportsComponent } from './reports/reports.component';
import { BookedstatisticsComponent } from './bookings/bookedstatistics/bookedstatistics.component';
import { ProgressBarComponent } from './progress/progress-bar/progress-bar.component';

// Services
// import { TourserviceService } from './services/tours/tourservice.service';


@NgModule({
  declarations: [
    AppComponent,
    DashboardsComponent,
    HomeComponent,
    InvoiceComponent,
    BookingformComponent,
    BookingprintComponent,
    ReportsComponent,
    BookedstatisticsComponent,
    ProgressBarComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpModule,
    BrowserAnimationsModule,
    NoopAnimationsModule,
    MaterialModule,
    FormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }