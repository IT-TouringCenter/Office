import { NgModule } from '@angular/core';
import { Routes, RouterModule, ActivatedRoute } from '@angular/router';
import { HomeComponent } from './home/home.component';
import { BookingformComponent } from './bookings/bookingform/bookingform.component';
import { BookingprintComponent } from './bookings/bookingprint/bookingprint.component';
import { InvoiceComponent } from './invoice/invoice.component';
import { BookedstatisticsComponent } from './bookings/bookedstatistics/bookedstatistics.component';

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
    path: 'invoice/:transactionId',
    component: InvoiceComponent
  },
  {
    path: 'booked-statistics',
    component: BookedstatisticsComponent
  }
];

@NgModule({
  imports: [
    RouterModule.forRoot(routes)
  ],
  exports: [
    RouterModule
  ],
  declarations: []
})
export class AppRoutingModule { }