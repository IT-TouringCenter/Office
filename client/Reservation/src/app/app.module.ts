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
import { ForceLogoutUserComponent } from './users/login/force-logout-user/force-logout-user.component';
import { SessionLoginComponent } from './users/login/session-login/session-login.component';
import { CheckLogoutUserComponent } from './users/logout/check-logout-user/check-logout-user.component';

// Angular charts
import { ChartsModule } from 'ng2-charts';

// Affiliate
import { HomeAffComponent } from './affiliate/home/home-aff/home-aff.component';
import { BookedAffComponent } from './affiliate/booking/booked-aff/booked-aff.component';
import { CommissionAffComponent } from './affiliate/commission/commission-aff/commission-aff.component';
import { HeaderAffComponent } from './affiliate/commons/header-aff/header-aff.component';
import { MenuBarAffComponent } from './affiliate/commons/header-aff/menu-bar-aff/menu-bar-aff.component';
import { MenuSidebarAffComponent } from './affiliate/commons/header-aff/menu-sidebar-aff/menu-sidebar-aff.component';
import { BookedMonthlyAffComponent } from './affiliate/booking/booked-aff/booked-monthly-aff/booked-monthly-aff.component';
import { BookedDayOfMonthAffComponent } from './affiliate/booking/booked-aff/booked-day-of-month-aff/booked-day-of-month-aff.component';
import { TourAffComponent } from './affiliate/booking/tour-aff/tour-aff.component';
import { TourDayOfMonthAffComponent } from './affiliate/booking/tour-aff/tour-day-of-month-aff/tour-day-of-month-aff.component';
import { TourMonthlyAffComponent } from './affiliate/booking/tour-aff/tour-monthly-aff/tour-monthly-aff.component';
import { CommissionDayOfMonthAffComponent } from './affiliate/commission/commission-day-of-month-aff/commission-day-of-month-aff.component';
import { CommissionMonthlyAffComponent } from './affiliate/commission/commission-monthly-aff/commission-monthly-aff.component';
import { CommissionTourAffComponent } from './affiliate/commission/commission-tour-aff/commission-tour-aff.component';
import { TraveledAffComponent } from './affiliate/booking/traveled-aff/traveled-aff.component';
import { TraveledDayOfMonthAffComponent } from './affiliate/booking/traveled-aff/traveled-day-of-month-aff/traveled-day-of-month-aff.component';
import { TraveledMonthlyAffComponent } from './affiliate/booking/traveled-aff/traveled-monthly-aff/traveled-monthly-aff.component';
import { TraveledTourAffComponent } from './affiliate/booking/traveled-aff/traveled-tour-aff/traveled-tour-aff.component';
import { BookedTableAffComponent } from './affiliate/booking/booked-aff/booked-table-aff/booked-table-aff.component';
import { PermissionUserComponent } from './users/permission/permission-user/permission-user.component';
import { PermissionUserRsvnComponent } from './reservations/permission/permission-user-rsvn/permission-user-rsvn.component';
import { PermissionUserAffComponent } from './affiliate/permission/permission-user-aff/permission-user-aff.component';
import { ManageUserActiveAdminComponent } from './admin/manage-user/manage-user-active-admin/manage-user-active-admin.component';
import { ManageUserAddAdminComponent } from './admin/manage-user/manage-user-add-admin/manage-user-add-admin.component';
import { ManageUserDeleteAdminComponent } from './admin/manage-user/manage-user-delete-admin/manage-user-delete-admin.component';
import { ManageUserEditAdminComponent } from './admin/manage-user/manage-user-edit-admin/manage-user-edit-admin.component';
import { HomeAdminComponent } from './admin/home/home-admin/home-admin.component';
import { HeaderAdminComponent } from './admin/commons/header-admin/header-admin.component';
import { MenuBarAdminComponent } from './admin/commons/header-admin/menu-bar-admin/menu-bar-admin.component';
import { MenuSidebarAdminComponent } from './admin/commons/header-admin/menu-sidebar-admin/menu-sidebar-admin.component';
import { PermissionAdminComponent } from './admin/permission/permission-admin/permission-admin.component';

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
    ForceLogoutUserComponent,
    SessionLoginComponent,
    HomeAffComponent,
    BookedAffComponent,
    CommissionAffComponent,
    HeaderAffComponent,
    MenuBarAffComponent,
    MenuSidebarAffComponent,
    CheckLogoutUserComponent,
    BookedMonthlyAffComponent,
    BookedDayOfMonthAffComponent,
    TourAffComponent,
    TourDayOfMonthAffComponent,
    TourMonthlyAffComponent,
    CommissionDayOfMonthAffComponent,
    CommissionMonthlyAffComponent,
    CommissionTourAffComponent,
    TraveledAffComponent,
    TraveledDayOfMonthAffComponent,
    TraveledMonthlyAffComponent,
    TraveledTourAffComponent,
    BookedTableAffComponent,
    PermissionUserComponent,
    PermissionUserAffComponent,
    PermissionUserRsvnComponent,
    ManageUserActiveAdminComponent,
    ManageUserAddAdminComponent,
    ManageUserDeleteAdminComponent,
    ManageUserEditAdminComponent,
    HomeAdminComponent,
    HeaderAdminComponent,
    MenuBarAdminComponent,
    MenuSidebarAdminComponent,
    PermissionAdminComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpModule,
    HttpClientModule,
    BrowserAnimationsModule,
    NoopAnimationsModule,
    MaterialModule,
    FormsModule,
    ReactiveFormsModule,
    ChartsModule
  ],
  providers: [

  ],
  bootstrap: [AppComponent]
})
export class AppModule { }