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
import { RegisterUserComponent } from './users/register/register-user/register-user.component';
import { RegisterConfirmUserComponent } from './users/register/register-confirm-user/register-confirm-user.component';
import { ProfileUserComponent } from './users/profiles/profile-user/profile-user.component';
import { ProfileEditUserComponent } from './users/profiles/profile-edit-user/profile-edit-user.component';

const routes: Routes = [
  {
    path: '',
    component: TemplateTcWebsiteComponent
  },
  // Reservations
  {
    path: 'user/:userId/reservations',
    component: HomeRsvnComponent
  },
  {
    path: 'user/:userId/reservations/booked',
    component: BookedRsvnComponent
  },
  {
    path: 'user/:userId/reservations/book-form-add',
    component: BookformAddRsvnComponent
  },
  {
    path: 'user/:userId/reservations/book-form-edit/:transactionId',
    component: BookformEditRsvnComponent
  },
  {
    path: 'user/:userId/reservations/book-form/:transactionId',
    component: BookformRsvnComponent
  },
  {
    path: 'user/:userId/reservations/invoice/:transactionId',
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
    path: 'user/:userId/logout',
    component: LogoutUserComponent
  },
  {
    path: 'user/register',
    component: RegisterUserComponent
  },
  {
    path: 'user/:userId/register-confirm',
    component: RegisterConfirmUserComponent
  },
  {
    path: 'user/:userId/profile',
    component: ProfileUserComponent
  },
  {
    path: 'user/:userId/profile-edit',
    component: ProfileEditUserComponent
  },
  {
    path: 'user/:userId/change-password',
    component: ChangePasswordUserComponent
  },
  {
    path: 'user/:userId/reset-password',
    component: ResetPasswordUserComponent
  },
  {
    path: 'user/forgot-password',
    component: ForgotPasswordUserComponent
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
