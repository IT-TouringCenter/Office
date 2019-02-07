import { NgModule } from '@angular/core';
// import { AgmCoreModule } from '@agm/core';
import { Routes, RouterModule, ActivatedRoute } from '@angular/router';

// component
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
// Reservations
import { HomeRsvnComponent } from './reservations/home-rsvn/home-rsvn.component';
import { BookedRsvnComponent } from './reservations/bookings/booked-rsvn/booked-rsvn.component';
import { BookformRsvnComponent } from './reservations/bookings/bookform-rsvn/bookform-rsvn.component';
import { BookformAddRsvnComponent } from './reservations/bookings/bookform-add-rsvn/bookform-add-rsvn.component';
import { BookformEditRsvnComponent } from './reservations/bookings/bookform-edit-rsvn/bookform-edit-rsvn.component';
import { InvoiceRsvnComponent } from './reservations/invoices/invoice-rsvn/invoice-rsvn.component';
import { TemplateTcWebsiteComponent } from './websites/templates/template-tc-website/template-tc-website.component';
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
import { UserManageAdminComponent } from './admin/user-manage/user-manage-admin/user-manage-admin.component';
import { UserManageAddAdminComponent } from './admin/user-manage/user-manage-add-admin/user-manage-add-admin.component';
import { UserManageDeleteAdminComponent } from './admin/user-manage/user-manage-delete-admin/user-manage-delete-admin.component';
import { UserManageEditAdminComponent } from './admin/user-manage/user-manage-edit-admin/user-manage-edit-admin.component';
import { UserManageActiveAdminComponent } from './admin/user-manage/user-manage-active-admin/user-manage-active-admin.component';
import { UserRequestComponent } from './admin/user-request/user-request.component';
// Member
import { HomeMemberComponent } from './member/home/home-member/home-member.component';
import { RequestMemberComponent } from './member/request/request-member/request-member.component';
import { RequestAffMemberComponent } from './member/request/affiliate/request-aff-member/request-aff-member.component';
import { HowtoAffMemberComponent } from './member/request/affiliate/request-aff-member/howto-aff-member/howto-aff-member.component';
import { ProfileAffMemberComponent } from './member/request/affiliate/request-aff-member/profile-aff-member/profile-aff-member.component'
import { BankAffMemberComponent } from './member/request/affiliate/request-aff-member/bank-aff-member/bank-aff-member.component';
import { AdsChannelAffMemberComponent } from './member/request/affiliate/request-aff-member/ads-channel-aff-member/ads-channel-aff-member.component';
import { ConfirmAffMemberComponent } from './member/request/affiliate/request-aff-member/confirm-aff-member/confirm-aff-member.component';
import { ApprovalAffMemberComponent } from './member/request/affiliate/request-aff-member/approval-aff-member/approval-aff-member.component';

const routes: Routes = [
  {
    path: '',
    component: TemplateTcWebsiteComponent
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
    path: 'user/admin/user-manage',
    component: UserManageAdminComponent
  },
  {
    path: 'user/admin/user-manage/add',
    component: UserManageAddAdminComponent
  },
  {
    path: 'user/admin/user-manage/edit/:userId',
    component: UserManageEditAdminComponent
  },
  {
    path: 'user/admin/user-manage/delete/:userId',
    component: UserManageDeleteAdminComponent
  },
  {
    path: 'user/admin/user-manage/active',
    component: UserManageActiveAdminComponent
  },
  {
    path: 'user/admin/user-request',
    component: UserRequestComponent
  },
  // Member
  {
    path: 'user/member',
    component: HomeMemberComponent
  },
  {
    path: 'user/member/request',
    component: RequestMemberComponent
  },
  {
    path: 'user/member/request/affiliate',
    component: RequestAffMemberComponent
  },
  {
    path: 'user/member/request/affiliate/howto',
    component: HowtoAffMemberComponent
  },
  {
    path: 'user/member/request/affiliate/step1',
    component: ProfileAffMemberComponent
  },
  {
    path: 'user/member/request/affiliate/step2',
    component: BankAffMemberComponent
  },
  {
    path: 'user/member/request/affiliate/step3',
    component: AdsChannelAffMemberComponent
  },
  {
    path: 'user/member/request/affiliate/step4',
    component: ConfirmAffMemberComponent
  },
  {
    path: 'user/member/request/affiliate/approval',
    component: ApprovalAffMemberComponent
  },
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