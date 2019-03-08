<?php 
namespace App\Repositories\Dashboard\Admin\Users\Profile;

class AdminUserProfileRepository{

	public function __construct(){

    }

    //--------------- Accounts ----------------------
    // Get account by token
    public function GetAccountByToken($token){
        $result = \DB::table('accounts')       
                    ->where('token',$token)
                    ->where('is_delete',0)
                    ->where('is_active',1)
                    ->get();
        return $result;
    }

    // Check account request
    public function CheckAccountRequest($accountId){
        $result = \DB::table('account_requests')
                    ->where('account_id',$accountId)
                    ->where('is_active',1)
                    ->get();
        return $result;
    }

    // Get profile data
    public function GetProfileData($accountId){
        $result = \DB::table('accounts as a')
                    ->select('a.id','a.username','a.fullname','a.email','a.tel','ap.birth','ap.id_number','ap.address','ap.nationality','ap.picture','ap.copy_id_card','ap.url')
                    ->join('account_profiles as ap','ap.account_id','=','a.id')
                    ->where('a.id',$accountId)
                    ->where('a.is_active',1)
                    ->where('ap.is_active',1)
                    ->get();
        return $result;
    }

    // Get bank data
    public function GetBookBankData($accountId){
        $result = \DB::table('account_book_banks as abb')
                    // ->select('abb.account_name','abb.account_no','abb.branch','abb.copy_book','a.bank_th','a.bank_en','abb.bank_id')
                    // ->join('banks as b','b.id','=','abb.bank_id')
                    ->where('account_id',$accountId)
                    ->where('is_active',1)
                    ->get();
        return $result;
    }

    // Get bank by id
    public function GetBankById($bankId){
        $result = \DB::table('banks')
                    ->where('id',$bankId)
                    ->where('is_active',1)
                    ->get();
        return $result;
    }
}