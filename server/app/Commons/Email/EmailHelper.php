<?php
    namespace App\Commons\Email;

    use App\configuration_email as EmailConfig;

    class EmailHelper{

        static $EmailConfigModel;

        public function __construct(EmailConfig $EmailConfig){
            self:: $EmailConfigModel = $EmailConfig;
        }

        public static function GetPendingTemplate(){
            $subject = env('MAIL_PENDING_SUBJECT');
            if($subject == null){
                 $subject ="Confirm Pending Reservation";
            }
            return [
                    "template"=>"easybook.emails.pendingPayment",
                    "subject"=>$subject
                ];
        }
        
        public static function GetPaidTemplate(){
            $subject = env('MAIL_PAID_SUBJECT');
            if($subject == null){
                 $subject ="Approved your Reservation";
            }
            
            return [
                    "template"=>"easybook.emails.paidPayment",
                    "subject"=>$subject
                ];
        }

        public static function GetToContaction($activityId){
            $EmailConfigRepo = new EmailConfig();
            $contacts=$EmailConfigRepo
			->where('is_active','=',1)
			->where('activity_id','=',$activityId)
			->where('is_to','=',1)
			->get();
					
		    return self::ConcateContaction($contacts);
        }

        public static function GetCCContaction($activityId){
             $EmailConfigRepo = new EmailConfig();
		    $contacts= $EmailConfigRepo
			->where('is_active','=',1)
			->where('activity_id','=',$activityId)
			->where('is_cc','=',1)
			->get();

		    return self::ConcateContaction($contacts);			
	    }

        public static function GetBCCContaction($activityId){
           $EmailConfigRepo = new EmailConfig();
		    $contacts= $EmailConfigRepo
                ->where('is_active','=',1)
                ->where('activity_id','=',$activityId)
                ->where('is_bcc','=',1)
                ->get();
            
            return self::ConcateContaction($contacts);
        }

        static function ConcateContaction($contacts){
            $tmpEmail ='';
            $seq = 0;
            foreach ($contacts as $mail) {
                $tmpEmail.=$mail->emails->email;

                if($seq < count($contacts)-1){
                    $tmpEmail.=",";
                }
                $seq .=1;
            }

            return $tmpEmail;
        }
    }
?>