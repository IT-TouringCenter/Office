import { BrowserModule } from '@angular/platform-browser';
import { AppRoutingModule } from './app-routing.module';
import { NgModule } from '@angular/core';
import { HttpModule } from '@angular/http';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { RouterModule, Routes } from '@angular/router';
// import { CallServices } from './services/call-api.service';
import { HttpClientModule } from '@angular/common/http';

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
import { PrintComponent } from './common/button/print/print.component';
import { InvoiceIncludeExcludeComponent } from './invoice/invoice-include-exclude/invoice-include-exclude.component';
import { InvoiceNoteComponent } from './invoice/invoice-note/invoice-note.component';
import { InvoiceImportantNoteComponent } from './invoice/invoice-important-note/invoice-important-note.component';
import { MenuSidebarComponent } from './common/header/menu-sidebar/menu-sidebar.component';
import { MenuBarComponent } from './common/header/menu-bar/menu-bar.component';
import { BookingformEditComponent } from './bookings/bookingform-edit/bookingform-edit.component';
import { AuthenticationComponent } from './authentication/authentication/authentication.component';
import { LoginComponent } from './authentication/login/login.component';
import { LogoutComponent } from './authentication/logout/logout.component';
import { SignupComponent } from './authentication/signup/signup.component';
import { TemplateComponent } from './common/template/template.component';
import { MatSelectSearchComponent } from './material/mat-select-search/mat-select-search.component';
// Reservations
import { BookedRsvnComponent } from './reservations/bookings/booked-rsvn/booked-rsvn.component';
import { BookformRsvnComponent } from './reservations/bookings/bookform-rsvn/bookform-rsvn.component';
import { BookformEditRsvnComponent } from './reservations/bookings/bookform-edit-rsvn/bookform-edit-rsvn.component';
import { BookprintRsvnComponent } from './reservations/bookings/bookprint-rsvn/bookprint-rsvn.component';
import { ButtonRsvnComponent } from './reservations/commons/button-rsvn/button-rsvn.component';
import { HeaderRsvnComponent } from './reservations/commons/header-rsvn/header-rsvn.component';
import { TemplateRsvnComponent } from './reservations/templates/template-rsvn/template-rsvn.component';
import { InvoiceRsvnComponent } from './reservations/invoices/invoice-rsvn/invoice-rsvn.component';
import { ButtonPrintRsvnComponent } from './reservations/commons/button-rsvn/button-print-rsvn/button-print-rsvn.component';
import { MenuBarRsvnComponent } from './reservations/commons/header-rsvn/menu-bar-rsvn/menu-bar-rsvn.component';
import { MenuSidebarRsvnComponent } from './reservations/commons/header-rsvn/menu-sidebar-rsvn/menu-sidebar-rsvn.component';

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
    PrintComponent,
    InvoiceIncludeExcludeComponent,
    InvoiceNoteComponent,
    InvoiceImportantNoteComponent,
    MenuSidebarComponent,
    MenuBarComponent,
    BookingformEditComponent,
    AuthenticationComponent,
    LoginComponent,
    LogoutComponent,
    SignupComponent,
    TemplateComponent,
    MatSelectSearchComponent,
    // Reservations
    BookedRsvnComponent,
    BookformRsvnComponent,
    BookformEditRsvnComponent,
    BookprintRsvnComponent,
    ButtonRsvnComponent,
    HeaderRsvnComponent,
    TemplateRsvnComponent,
    InvoiceRsvnComponent,
    ButtonPrintRsvnComponent,
    MenuBarRsvnComponent,
    MenuSidebarRsvnComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpModule,
    BrowserAnimationsModule,
    NoopAnimationsModule,
    MaterialModule,
    FormsModule,
    ReactiveFormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }