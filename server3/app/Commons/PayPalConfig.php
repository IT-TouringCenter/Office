<?php
namespace App\Commons;

class PayPalConfig{
    const PayPalId="dev-payment@touringcnx.com";//"tnz.info@gmail.com";
    const CompleteUrl="http://dev-api.tour-in-chiangmai.com/api/v1/easybook/confirmpayment";//specific api url
    const TimeoutUrl="";//specific api timeout url
    const CancelUrl="";//specific api url
    const NotifyUrl="http://dev-api.tour-in-chiangmai.com/api/v1/easybook/test/paypalNotify";//specific api url       
}

?>