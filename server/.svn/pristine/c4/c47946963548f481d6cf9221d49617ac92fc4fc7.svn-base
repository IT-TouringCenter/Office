<?php
use App\Commons\Email\EmailHelper as EmailHelper;
 use App\configuration_email as EmailConfig;

class EmailTest extends TestCase{
    public function testGetToContactByActivity(){        
        $activityId = 1;

        $emailConfig = new EmailConfig();
        $emailHelper = new EmailHelper($emailConfig);
        $result = EmailHelper::GetCCContaction($activityId);

        // print_r($result);
        $this->assertContains('sitti',$result);
        // print_r($result);
    } 

    public function testGetCCContactByActivity(){
        $activityId = 1;
         
        $emailConfig = new EmailConfig();
        $emailHelper = new EmailHelper($emailConfig);
        $result = EmailHelper::GetCCContaction($activityId);
        
        $result = EmailHelper::GetCCContaction($activityId);
        print_r($result);
        $this->assertContains('patjanawat',$result);        
    }
}
?>