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
import { TravelingAffComponent } from './affiliate/booking/traveling-aff/traveling-aff.component';
import { CommissionAffComponent } from './affiliate/commission/commission-aff/commission-aff.component';

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
    path: 'user/affiliate/traveling',
    component: TravelingAffComponent
  },
  {
    path: 'user/affiliate/commission',
    component: CommissionAffComponent
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
