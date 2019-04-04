import { BrowserModule } from '@angular/platform-browser';
import { AppRoutingModule } from './app-routing.module';
import { NgModule } from '@angular/core';
import { HttpModule } from '@angular/http';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
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

// Angular charts
import { ChartsModule } from 'ng2-charts';

// Affiliate
import { TemplateComponent } from './template/template/template.component';
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
import { HomeAdminComponent } from './admin/home/home-admin/home-admin.component';
import { HeaderAdminComponent } from './admin/commons/header-admin/header-admin.component';
import { MenuBarAdminComponent } from './admin/commons/header-admin/menu-bar-admin/menu-bar-admin.component';
import { MenuSidebarAdminComponent } from './admin/commons/header-admin/menu-sidebar-admin/menu-sidebar-admin.component';
import { PermissionAdminComponent } from './admin/permission/permission-admin/permission-admin.component';
import { UserManageActiveAdminComponent } from './admin/user-manage/user-manage-active-admin/user-manage-active-admin.component';
import { UserManageAddAdminComponent } from './admin/user-manage/user-manage-add-admin/user-manage-add-admin.component';
import { UserManageAdminComponent } from './admin/user-manage/user-manage-admin/user-manage-admin.component';
import { UserManageDeleteAdminComponent } from './admin/user-manage/user-manage-delete-admin/user-manage-delete-admin.component';
import { UserManageEditAdminComponent } from './admin/user-manage/user-manage-edit-admin/user-manage-edit-admin.component';
import { MenuBarMemberComponent } from './member/commons/menu-bar-member/menu-bar-member.component';
import { HomeMemberComponent } from './member/home/home-member/home-member.component';
import { RequestAffMemberComponent } from './member/request/affiliate/request-aff-member/request-aff-member.component';
import { HowtoAffMemberComponent } from './member/request/affiliate/request-aff-member/howto-aff-member/howto-aff-member.component';
import { ConfirmAffMemberComponent } from './member/request/affiliate/request-aff-member/confirm-aff-member/confirm-aff-member.component';
import { BankAffMemberComponent } from './member/request/affiliate/request-aff-member/bank-aff-member/bank-aff-member.component';
import { ProfileAffMemberComponent } from './member/request/affiliate/request-aff-member/profile-aff-member/profile-aff-member.component';
import { ApprovalAffMemberComponent } from './member/request/affiliate/request-aff-member/approval-aff-member/approval-aff-member.component';
import { PermissionMemberComponent } from './member/permission/permission-member/permission-member.component';
import { RequestMemberComponent } from './member/request/request-member/request-member.component';
import { AdsChannelAffMemberComponent } from './member/request/affiliate/request-aff-member/ads-channel-aff-member/ads-channel-aff-member.component';
import { CheckRequestAffiliateMemberComponent } from './member/request/affiliate/check-request-affiliate-member/check-request-affiliate-member.component';
import { UserRequestAdminComponent } from './admin/user-request/user-request-admin/user-request-admin.component';
import { MenuManagerComponent } from './manager/commons/header-manager/menu-manager/menu-manager.component';
import { HomeManagerComponent } from './manager/home/home-manager/home-manager.component';
import { PermissionManagerComponent } from './manager/permission/permission-manager/permission-manager.component';
import { BookedTableManagerComponent } from './manager/booked/booked-table-manager/booked-table-manager.component';
import { BookedSummaryManagerComponent } from './manager/booked/booked-summary-manager/booked-summary-manager.component';
import { BookedDaysOfMonthManagerComponent } from './manager/booked/booked-days-of-month-manager/booked-days-of-month-manager.component';
import { BookedMonthlyManagerComponent } from './manager/booked/booked-monthly-manager/booked-monthly-manager.component';
import { BookedAffiliateTableComponent } from './manager/booked-affiliate/booked-affiliate-table/booked-affiliate-table.component';
import { BookedAffiliateSummaryManagerComponent } from './manager/booked-affiliate/booked-affiliate-summary-manager/booked-affiliate-summary-manager.component';
import { BookedAffiliateDaysOfMonthManageComponent } from './manager/booked-affiliate/booked-affiliate-days-of-month-manage/booked-affiliate-days-of-month-manage.component';
import { BookedAffiliateMonthlyManagerComponent } from './manager/booked-affiliate/booked-affiliate-monthly-manager/booked-affiliate-monthly-manager.component';
import { GetlinkBookingAffComponent } from './affiliate/booking/getlink-booking-aff/getlink-booking-aff.component';
import { AffiliateManagementManagerComponent } from './manager/affiliate-management/affiliate-management-manager/affiliate-management-manager.component';
import { AffiliateCommissionRateManagerComponent } from './manager/affiliate-management/affiliate-commission-rate-manager/affiliate-commission-rate-manager.component';
import { AffiliateProfileManagerComponent } from './manager/affiliate-management/affiliate-profile-manager/affiliate-profile-manager.component';
import { RsvnTourTravelingComponent } from './reservations/traveling/rsvn-tour-traveling/rsvn-tour-traveling.component';
import { BookedAffiliateTourDaysOfMonthManagerComponent } from './manager/booked-affiliate/booked-affiliate-tour-days-of-month-manager/booked-affiliate-tour-days-of-month-manager.component';
import { BookedAffiliateTourMonthlyManagerComponent } from './manager/booked-affiliate/booked-affiliate-tour-monthly-manager/booked-affiliate-tour-monthly-manager.component';
import { BookedAffiliateCommissionDaysOfMonthManagerComponent } from './manager/booked-affiliate/booked-affiliate-commission-days-of-month-manager/booked-affiliate-commission-days-of-month-manager.component';
import { BookedAffiliateCommissionMonthlyManagerComponent } from './manager/booked-affiliate/booked-affiliate-commission-monthly-manager/booked-affiliate-commission-monthly-manager.component';
import { BookedAffiliateTourSummaryManagerComponent } from './manager/booked-affiliate/booked-affiliate-tour-summary-manager/booked-affiliate-tour-summary-manager.component';
import { BookedAffiliateCommissionSummaryManagerComponent } from './manager/booked-affiliate/booked-affiliate-commission-summary-manager/booked-affiliate-commission-summary-manager.component';
import { TraveledSummaryManagerComponent } from './manager/traveled/traveled-summary-manager/traveled-summary-manager.component';
import { TraveledDaysOfMonthManagerComponent } from './manager/traveled/traveled-days-of-month-manager/traveled-days-of-month-manager.component';
import { TraveledMonthlyManagerComponent } from './manager/traveled/traveled-monthly-manager/traveled-monthly-manager.component';
import { UserRequestManagerComponent } from './manager/user-request-manager/user-request-manager.component';

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
    HomeAdminComponent,
    HeaderAdminComponent,
    MenuBarAdminComponent,
    MenuSidebarAdminComponent,
    PermissionAdminComponent,
    TemplateComponent,
    UserManageActiveAdminComponent,
    UserManageAddAdminComponent,
    UserManageAdminComponent,
    UserManageDeleteAdminComponent,
    UserManageEditAdminComponent,
    MenuBarMemberComponent,
    HomeMemberComponent,
    RequestAffMemberComponent,
    HowtoAffMemberComponent,
    ConfirmAffMemberComponent,
    BankAffMemberComponent,
    ProfileAffMemberComponent,
    ApprovalAffMemberComponent,
    PermissionMemberComponent,
    RequestMemberComponent,
    AdsChannelAffMemberComponent,
    CheckRequestAffiliateMemberComponent,
    UserRequestAdminComponent,
    MenuManagerComponent,
    HomeManagerComponent,
    PermissionManagerComponent,
    BookedTableManagerComponent,
    BookedSummaryManagerComponent,
    BookedDaysOfMonthManagerComponent,
    BookedMonthlyManagerComponent,
    BookedAffiliateTableComponent,
    BookedAffiliateSummaryManagerComponent,
    BookedAffiliateDaysOfMonthManageComponent,
    BookedAffiliateMonthlyManagerComponent,
    GetlinkBookingAffComponent,
    AffiliateManagementManagerComponent,
    AffiliateCommissionRateManagerComponent,
    AffiliateProfileManagerComponent,
    RsvnTourTravelingComponent,
    BookedAffiliateTourDaysOfMonthManagerComponent,
    BookedAffiliateTourMonthlyManagerComponent,
    BookedAffiliateCommissionDaysOfMonthManagerComponent,
    BookedAffiliateCommissionMonthlyManagerComponent,
    BookedAffiliateTourSummaryManagerComponent,
    BookedAffiliateCommissionSummaryManagerComponent,
    TraveledSummaryManagerComponent,
    TraveledDaysOfMonthManagerComponent,
    TraveledMonthlyManagerComponent,
    UserRequestManagerComponent,
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