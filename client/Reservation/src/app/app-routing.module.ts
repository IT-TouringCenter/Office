import { NgModule } from '@angular/core';
// import { AgmCoreModule } from '@agm/core';
import { Routes, RouterModule, ActivatedRoute } from '@angular/router';

// component
import { HomeComponent } from './home/home.component';
// Reservations
import { HomeRsvnComponent } from './reservations/home-rsvn/home-rsvn.component';
import { BookedRsvnComponent } from './reservations/bookings/booked-rsvn/booked-rsvn.component';
import { BookformRsvnComponent } from './reservations/bookings/bookform-rsvn/bookform-rsvn.component';
import { BookformAddRsvnComponent } from './reservations/bookings/bookform-add-rsvn/bookform-add-rsvn.component';
import { BookformEditRsvnComponent } from './reservations/bookings/bookform-edit-rsvn/bookform-edit-rsvn.component';
import { InvoiceRsvnComponent } from './reservations/invoices/invoice-rsvn/invoice-rsvn.component';
import { TemplateRsvnComponent } from './reservations/templates/template-rsvn/template-rsvn.component';
import { AppComponent } from './app.component';
import { TemplateTcWebsiteComponent } from './websites/templates/template-tc-website/template-tc-website.component';
// Users
import { HomeUserComponent } from './users/home-user/home-user.component';
import { ChangePasswordUserComponent } from './users/change-password-user/change-password-user.component';
import { ResetPasswordUserComponent } from './users/reset-password-user/reset-password-user.component';
import { ForgotPasswordUserComponent } from './users/forgot-password-user/forgot-password-user.component';
import { LoginUserComponent } from './users/login/login-user/login-user.component';
import { LogoutUserComponent } from './users/login/logout-user/logout-user.component';
import { ForceLogoutUserComponent } from './users/login/force-logout-user/force-logout-user.component';
import { RegisterUserComponent } from './users/register/register-user/register-user.component';
import { RegisterConfirmUserComponent } from './users/register/register-confirm-user/register-confirm-user.component';
import { ProfileUserComponent } from './users/profiles/profile-user/profile-user.component';
import { ProfileEditUserComponent } from './users/profiles/profile-edit-user/profile-edit-user.component';
// Affiliate
import { HomeAffComponent } from './affiliate/home/home-aff/home-aff.component';
import { BookedAffComponent } from './affiliate/booking/booked-aff/booked-aff.component';
import { BookedDayOfMonthAffComponent } from './affiliate/booking/booked-aff/booked-day-of-month-aff/booked-day-of-month-aff.component';
import { BookedMonthlyAffComponent } from './affiliate/booking/booked-aff/booked-monthly-aff/booked-monthly-aff.component';
import { BookedTableAffComponent } from './affiliate/booking/booked-aff/booked-table-aff/booked-table-aff.component';
import { TourAffComponent } from './affiliate/booking/tour-aff/tour-aff.component';
import { TourDayOfMonthAffComponent } from './affiliate/booking/tour-aff/tour-day-of-month-aff/tour-day-of-month-aff.component';
import { TourMonthlyAffComponent } from './affiliate/booking/tour-aff/tour-monthly-aff/tour-monthly-aff.component';
import { TraveledAffComponent } from './affiliate/booking/traveled-aff/traveled-aff.component';
import { TraveledDayOfMonthAffComponent } from './affiliate/booking/traveled-aff/traveled-day-of-month-aff/traveled-day-of-month-aff.component';
import { TraveledMonthlyAffComponent } from './affiliate/booking/traveled-aff/traveled-monthly-aff/traveled-monthly-aff.component';
import { TraveledTourAffComponent } from './affiliate/booking/traveled-aff/traveled-tour-aff/traveled-tour-aff.component';
import { CommissionAffComponent } from './affiliate/commission/commission-aff/commission-aff.component';
import { CommissionDayOfMonthAffComponent } from './affiliate/commission/commission-day-of-month-aff/commission-day-of-month-aff.component';
import { CommissionMonthlyAffComponent } from './affiliate/commission/commission-monthly-aff/commission-monthly-aff.component';
import { CommissionTourAffComponent } from './affiliate/commission/commission-tour-aff/commission-tour-aff.component';
// Admin
import { HomeAdminComponent } from './admin/home/home-admin/home-admin.component';
import { ManageUserAdminComponent } from './admin/manage-user/manage-user-admin/manage-user-admin.component';
import { ManageUserAddAdminComponent } from './admin/manage-user/manage-user-add-admin/manage-user-add-admin.component';
import { ManageUserEditAdminComponent } from './admin/manage-user/manage-user-edit-admin/manage-user-edit-admin.component';
import { ManageUserDeleteAdminComponent } from './admin/manage-user/manage-user-delete-admin/manage-user-delete-admin.component';
import { ManageUserActiveAdminComponent } from './admin/manage-user/manage-user-active-admin/manage-user-active-admin.component';

const routes: Routes = [
  {
    path: '',
    component: TemplateTcWebsiteComponent
  },

  // Reservations
  {
    path: 'user/reservations',
    component: HomeRsvnComponent
  },
  {
    path: 'user/reservations/booked',
    component: BookedRsvnComponent
  },
  {
    path: 'user/reservations/book-form-add',
    component: BookformAddRsvnComponent
  },
  {
    path: 'user/reservations/book-form-edit/:transactionId',
    component: BookformEditRsvnComponent
  },
  {
    path: 'user/reservations/book-form/:transactionId',
    component: BookformRsvnComponent
  },
  {
    path: 'user/reservations/invoice/:transactionId',
    component: InvoiceRsvnComponent
  },

  // Login
  {
    path: 'user',
    component: HomeUserComponent
  },
  {
    path: 'user/login',
    component: LoginUserComponent
  },
  {
    path: 'user/logout',
    component: LogoutUserComponent
  },
  {
    path: 'user/force-logout/:userId',
    component: ForceLogoutUserComponent
  },
  {
    path: 'user/register',
    component: RegisterUserComponent
  },
  {
    path: 'user/register-confirm/:userId',
    component: RegisterConfirmUserComponent
  },
  {
    path: 'user/profile/:userId',
    component: ProfileUserComponent
  },
  {
    path: 'user/profile-edit/:userId',
    component: ProfileEditUserComponent
  },
  {
    path: 'user/change-password/:userId',
    component: ChangePasswordUserComponent
  },
  {
    path: 'user/reset-password/:userId',
    component: ResetPasswordUserComponent
  },
  {
    path: 'user/forgot-password',
    component: ForgotPasswordUserComponent
  },

  // Affiliate
  {
    path: 'user/affiliate',
    component: HomeAffComponent
  },
  {
    path: 'user/affiliate/booked',
    component: BookedAffComponent
  },
  {
    path: 'user/affiliate/booked/days-of-month',
    component: BookedDayOfMonthAffComponent
  },
  {
    path: 'user/affiliate/booked/monthly',
    component: BookedMonthlyAffComponent
  },
  {
    path: 'user/affiliate/booked/table',
    component: BookedTableAffComponent
  },
  {
    path: 'user/affiliate/booked/tours',
    component: TourAffComponent
  },
  {
    path: 'user/affiliate/booked/tours/days-of-month',
    component: TourDayOfMonthAffComponent
  },
  {
    path: 'user/affiliate/booked/tours/monthly',
    component: TourMonthlyAffComponent
  },
  {
    path: 'user/affiliate/booked/traveled',
    component: TraveledAffComponent
  },
  {
    path: 'user/affiliate/booked/traveled/days-of-month',
    component: TraveledDayOfMonthAffComponent
  },
  {
    path: 'user/affiliate/booked/traveled/monthly',
    component: TraveledMonthlyAffComponent
  },
  {
    path: 'user/affiliate/booked/traveled/tour',
    component: TraveledTourAffComponent
  },
  {
    path: 'user/affiliate/commission',
    component: CommissionAffComponent
  },
  {
    path: 'user/affiliate/commission/days-of-month',
    component: CommissionDayOfMonthAffComponent
  },
  {
    path: 'user/affiliate/commission/monthly',
    component: CommissionMonthlyAffComponent
  },
  {
    path: 'user/affiliate/commission/tour',
    component: CommissionTourAffComponent
  },

  // Admin
  {
    path: 'user/admin',
    component: HomeAdminComponent
  },
  {
    path: 'user/admin/manage-user',
    component: ManageUserAdminComponent
  },
  {
    path: 'user/admin/manage-user/add',
    component: ManageUserAddAdminComponent
  },
  {
    path: 'user/admin/manage-user/edit/:userId',
    component: ManageUserEditAdminComponent
  },
  {
    path: 'user/admin/manage-user/delete/:userId',
    component: ManageUserDeleteAdminComponent
  },
  {
    path: 'user/admin/manage-user/active/:userId',
    component: ManageUserActiveAdminComponent
  }

];

@NgModule({
  imports: [
    RouterModule.forRoot(routes, {useHash: true})
  ],
  exports: [
    RouterModule
  ],
  declarations: []
})
export class AppRoutingModule { }