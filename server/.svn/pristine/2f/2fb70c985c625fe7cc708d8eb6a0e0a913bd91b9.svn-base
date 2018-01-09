
<div style="position: relative;top: 10%; float:center; ">
    <div style="font-size: 24px;text-align: center;">
        <h2>
            <p> Your payment is in the process, </p>
            <p> please wait for a few seconds. </p>
        </h2>
        <img src="/images/hourglass.gif">
    </div>
</div>
<div class="process-container">
    <form action="{{$paypalCgi}}" method="post" target="_self" name="frmPaypal">
        <div>
            <input type="hidden" name="cmd" value="_ext-enter" />
            <input type="hidden" name="redirect_cmd" value="_xclick" />
            <input type="hidden" name="business" value="{{$paypalId}}" />
            <input type="hidden" name="email" value="{{$email}}" />
            <input type="hidden" name="custom" value="{{$transactionId}}" />
            <input type="hidden" name="amount" value="{{$amount}}" />
            <input type="hidden" name="item_name" value="{{$itemName}}" />
            <input type="hidden" name="currency_code" value="THB" />
            <input type="hidden" name="return" value="{{$completeUrl}}" />
            <input type="hidden" name="callback_timeout" value="{{$timeoutUrl}}" />
            <input type="hidden" name="cancel_return" value="{{$cancelUrl}}" />
            <input type="hidden" name="rm" value="1" />
            <input type="hidden" name="lc" value="GB" />
            <input type="hidden" name="notify_url" value="{{$notifyUrl}}" />
            <input type="hidden" name="verify_sign" value="Code_from_verisign" />
            <input type="hidden" name="payment_status" value="Completed" />
        </div>
        <div style="display:none;">
            <div>PAYPAL_CGI: <input type="text" value="{{$paypalCgi}}">
            <p>
                cmd:<input type="input" name="cmd" value="_ext-enter" />
            </p>        
            <p>
                redirect_cmd:<input type="input" name="redirect_cmd" value="_xclick" />
            </p>                    
            <p>
                paypal id<input type="input" name="business" value="{{$paypalId}}" />
            </p>
            <p>
                email:<input type="input" name="email" value="{{$email}}" />
            </p>
            <p>
                custom<input type="input" name="custom" value="{{$transactionId}}" />
            </p>
            <p>
                amount: <input type="input" name="amount" value="{{$amount}}" />
            </p>
            <p>
                item name: <input type="input" name="item_name" value="{{$itemName}}" />
            </p>
            <p>
                currency: <input type="input" name="currency_code" value="THB" />
            </p>
            <p>
                completed url:<input type="input" name="return" value="{{$completeUrl}}" />
            </p>
            <p>
                timeout url:<input type="input" name="callback_timeout" value="{{$timeoutUrl}}" />
            </p>
            <p>
                cancel return: <input type="input" name="cancel_return" value="{{$cancelUrl}}" />
            </p>
            <p>
                method <input type="input" name="rm" value="1" />
            </p>
            <p>
                <input type="input" name="lc" value="GB" />
            </p>
            <p>
                notify url<input type="input" name="notify_url" value="{{$notifyUrl}}" />
            </p>
            <p>
                verify sign: <input type="input" name="verify_sign" value="Code_from_verisign" />
            </p>
            <p>
                payment status: <input type="input" name="payment_status" value="Completed" />
            </p>   
        </div>     
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.frmPaypal.submit();
    }, false);
</script>