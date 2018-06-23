import { BrowserModule } from '@angular/platform-browser';
import { AppRoutingModule } from './app-routing.module';
import { NgModule } from '@angular/core';
import { HttpModule } from '@angular/http';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { RouterModule, Routes } from '@angular/router';
import { HttpClientModule } from '@angular/common/http';

import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { NoopAnimationsModule } from '@angular/platform-browser/animations';
import { MaterialModule } from './material.module';

// Template
import { AppComponent } from './app.component';
import { HomeComponent } from './home/home.component';
import { MatSelectSearchComponent } from './material/mat-select-search/mat-select-search.component';
// Reservations
import { HomeRsvnComponent } from './reservations/home-rsvn/home-rsvn.component';
import { BookedRsvnComponent } from './reservations/bookings/booked-rsvn/booked-rsvn.component';
import { BookformRsvnComponent } from './reservations/bookings/bookform-rsvn/bookform-rsvn.component';
import { BookformAddRsvnComponent } from './reservations/bookings/bookform-add-rsvn/bookform-add-rsvn.component';
import { BookformEditRsvnComponent } from './reservations/bookings/bookform-edit-rsvn/bookform-edit-rsvn.component';
import { ButtonRsvnComponent } from './reservations/commons/button-rsvn/button-rsvn.component';
import { HeaderRsvnComponent } from './reservations/commons/header-rsvn/header-rsvn.component';
import { TemplateRsvnComponent } from './reservations/templates/template-rsvn/template-rsvn.component';
import { ButtonPrintRsvnComponent } from './reservations/commons/button-rsvn/button-print-rsvn/button-print-rsvn.component';
import { MenuBarRsvnComponent } from './reservations/commons/header-rsvn/menu-bar-rsvn/menu-bar-rsvn.component';
import { MenuSidebarRsvnComponent } from './reservations/commons/header-rsvn/menu-sidebar-rsvn/menu-sidebar-rsvn.component';
import { InvoiceRsvnComponent } from './reservations/invoices/invoice-rsvn/invoice-rsvn.component';
import { InvoiceImportantNoteRsvnComponent } from './reservations/invoices/invoice-important-note-rsvn/invoice-important-note-rsvn.component';
import { InvoiceIncludeExcludeRsvnComponent } from './reservations/invoices/invoice-include-exclude-rsvn/invoice-include-exclude-rsvn.component';
import { InvoiceNoteRsvnComponent } from './reservations/invoices/invoice-note-rsvn/invoice-note-rsvn.component';
import { TemplateTcWebsiteComponent } from './websites/templates/template-tc-website/template-tc-website.component';
import { HomeUserComponent } from './users/home-user/home-user.component';
import { ChangePasswordUserComponent } from './users/change-password-user/change-password-user.component';
import { ResetPasswordUserComponent } from './users/reset-password-user/reset-password-user.component';
import { ForgotPasswordUserComponent } from './users/forgot-password-user/forgot-password-user.component';
import { LoginUserComponent } from './users/login/login-user/login-user.component';
import { LogoutUserComponent } from './users/login/logout-user/logout-user.component';
import { RegisterUserComponent } from './users/register/register-user/register-user.component';
import { RegisterConfirmUserComponent } from './users/register/register-confirm-user/register-confirm-user.component';
import { ProfileUserComponent } from './users/profiles/profile-user/profile-user.component';
import { ProfileEditUserComponent } from './users/profiles/profile-edit-user/profile-edit-user.component';

@NgModule({
  declarations: [
    AppComponent,
    HomeComponent,
    MatSelectSearchComponent,
    HomeRsvnComponent,
    BookedRsvnComponent,
    BookformRsvnComponent,
    BookformAddRsvnComponent,
    BookformEditRsvnComponent,
    ButtonRsvnComponent,
    HeaderRsvnComponent,
    TemplateRsvnComponent,
    ButtonPrintRsvnComponent,
    MenuBarRsvnComponent,
    MenuSidebarRsvnComponent,
    InvoiceRsvnComponent,
    InvoiceImportantNoteRsvnComponent,
    InvoiceIncludeExcludeRsvnComponent,
    InvoiceNoteRsvnComponent,
    TemplateTcWebsiteComponent,
    HomeUserComponent,
    ChangePasswordUserComponent,
    ResetPasswordUserComponent,
    ForgotPasswordUserComponent,
    LoginUserComponent,
    LogoutUserComponent,
    RegisterUserComponent,
    RegisterConfirmUserComponent,
    ProfileUserComponent,
    ProfileEditUserComponent,
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