@if($status==true)
    <div style="text-align: center;
        position: fixed;
        top: 5%;
        left: 35%;">
        <p style="font-size: 20px;font-style: italic;">Just a moment...</p>
        <img src="/images/hourglass.gif"   
    </div>
    <div class="process-container">
        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_self" name="frmPaypal">
                <input type="hidden" name="cmd" value="_ext-enter" />
                <input type="hidden" name="redirect_cmd" value="_xclick" />
                <input type="hidden" name="business" value="{{$paypal_id}}" />
                <input type="hidden" name="email" value="{{$email}}" />
                <input type="hidden" name="custom" value="{{$transaction_id}}" />
                <input type="hidden" name="amount" value="{{$amount}}" />
                <input type="hidden" name="item_name" value="{{$item_name}}" />
                <input type="hidden" name="currency_code" value="THB" />
                <input type="hidden" name="return" value="{{$complete_url}}" />
                <input type="hidden" name="callback_timeout" value="{{$timeout_url}}" />
                <input type="hidden" name="cancel_return" value="{{$cancel_url}}" />
                <input type="hidden" name="rm" value="2" />
                <input type="hidden" name="lc" value="GB" />
                <input type="hidden" name="notify_url" value="{{$notify_url}}" />
                <input type="hidden" name="verify_sign" value="Code_from_verisign" />
                <input type="hidden" name="payment_status" value="Completed" />       
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {                
            //setTimeout(function(){document.frmPaypal.submit();  },2000);              
        }, false);
    </script>
@else
    <div style="
    position: fixed;
    top: 5%;
    left: 35%;
    background: #eee;
    padding: 15px;
    border-radius: 5px;
    color: red;">
        <h2>You transaction is not aviable.</h2>
        <div style="text-align:center">
            <a href="http://google.co.th">Home </a>
        </div>
    </div>
@endif
