import { NgModule } from '@angular/core';
// import { AgmCoreModule } from '@agm/core';
import { Routes, RouterModule, ActivatedRoute } from '@angular/router';

// component
import { HomeComponent } from './home/home.component';
import { BookingformComponent } from './bookings/bookingform/bookingform.component';
import { BookingprintComponent } from './bookings/bookingprint/bookingprint.component';
import { InvoiceComponent } from './invoice/invoice.component';
import { BookedstatisticsComponent } from './bookings/bookedstatistics/bookedstatistics.component';
import { BookingformEditComponent } from './bookings/bookingform-edit/bookingform-edit.component';
// Reservations
import { BookedRsvnComponent } from './reservations/bookings/booked-rsvn/booked-rsvn.component';
import { BookformRsvnComponent } from './reservations/bookings/bookform-rsvn/bookform-rsvn.component';
import { BookformAddRsvnComponent } from './reservations/bookings/bookform-add-rsvn/bookform-add-rsvn.component';
import { BookformEditRsvnComponent } from './reservations/bookings/bookform-edit-rsvn/bookform-edit-rsvn.component';
import { InvoiceRsvnComponent } from './reservations/invoices/invoice-rsvn/invoice-rsvn.component';
import { TemplateRsvnComponent } from './reservations/templates/template-rsvn/template-rsvn.component';

const routes: Routes = [
  {
    path: '',
    component: HomeComponent
  },
  {
    path: 'reservation',
    component: BookingformComponent
  },
  {
    path: 'bookingform/:transactionId',
    component: BookingprintComponent
  },
  {
    path: 'bookingform/edit/:transactionId',
    component: BookingformEditComponent
  },
  {
    path: 'invoice/:transactionId',
    component: InvoiceComponent
  },
  {
    path: 'reservationsummary',
    component: BookedstatisticsComponent
  },
  // Reservations
  {
    path: 'reservations',
    component: TemplateRsvnComponent
  },
  {
    path: 'reservations/booked',
    component: BookedRsvnComponent
  },
  {
    path: 'reservations/book-form-add',
    component: BookformAddRsvnComponent
  },
  {
    path: 'reservations/book-form-edit/:transactionId',
    component: BookformEditRsvnComponent
  },
  {
    path: 'reservations/book-form/:transactionId',
    component: BookformRsvnComponent
  },
  {
    path: 'reservations/invoice/:transactionId',
    component: InvoiceRsvnComponent
  }
];

@NgModule({
  imports: [
    RouterModule.forRoot(routes, {useHash: true})
    // AgmCoreModule.forRoot({
    //   // apiKey: 'AIzaSyBWy_RhYudyI9DW3_Mp3zjgCXHmtfWbssQ'
    // })
  ],
  exports: [
    RouterModule
  ],
  declarations: []
})
export class AppRoutingModule { }