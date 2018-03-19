<?php
error_reporting(0);
session_start();
include "dbconfig.php";
include "changeDate.php";

$order = $_GET['order'];
$upack_id = base64_decode($_GET['upack_id']);

$dt_userpackage = mysql_query("SELECT * FROM dt_userpackage WHERE upack_id = '$upack_id'");
$userpackage = mysql_fetch_array($dt_userpackage);

$passenger = mysql_query("SELECT * FROM passenger WHERE dt_userpackage_id = '$upack_id'");
$numpasssenger = mysql_num_rows($passenger);

$inv_id = $_GET['inv_id'];
if(empty($_GET['inv_id'])){
    $inv_id = $userpackage['inv_id'];
    $_SESSION['confirm'][$order] = "disable";
}

if($userpackage['price_ride']){
    $extrachange = $userpackage['price_ride'];
}else{
    $extrachange = 0;
}

$amount = $userpackage['price_adult'] + $userpackage['price_child'] +$userpackage['price_ride'];

$total_price = number_format($userpackage['price_adult']+$userpackage['price_child']+$extrachange);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="icon" href="image/iconte.ico" type="image/x-icon"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice <?=$inv_id?> | Touring Center</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css2/cont.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="./jquery.datetimepicker.css"/>
    <?php include 'css.php'; ?>
</head>
<style>
    .table-responsive::-webkit-scrollbar {
        display: none;
    }

    .hasfjh{
        height: 62px;
        width: 225px;
        position: absolute;
        top: 0px;
        left: 15px;
        display: flex;
        line-height: 62px;
        justify-content: center;
        background: #eb1c23;
    }

    .asoif{
        background:black;
        text-align:right;
        padding:20px;
        font-size:20px;
        color:#fff;
    }

    .createdate{
        margin-top:15px;
        margin-bottom:10px;
    }
   @media print{    

        body{
            font-size: 16px;
        }

        .no-print, .no-print *
        {
            display: none !important;
        }
        .show-print, .show-print *
        {
            display: block !important;
        }

        .asoif{
            background:black;
            text-align:right;
            padding:15px 0px;
            font-size:18px;
            color:#fff;
        }

        .hasfjh{
            height: 62px;
            width: 225px;
            position: absolute;
            top: 0px;
            left: 15px;
            display: flex;
            line-height: 62px;
            justify-content: flex-start;
            background: #ff0000;
        }

        .container{
            top: 0 !important;
            position: absolute !important;
        }

        .createdate{
            margin-top:15px;
            margin-bottom:10px;
        }
        h5{font-weight: 100;}
        hr{margin:5px 0;}
    }
</style>
<body>
<!-- <div class="container" style="margin-bottom:20px;">
    <img src="images/6color.jpg" style="width:100%;">
</div> -->
<div class="container" style="margin-top:25px;">    
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-6" style="margin-bottom:20px;">
            <img src="/image/login_logo.png">
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 createdate" align="right">
            <h5>Created date : <?=thai_date4(strtotime($userpackage['book_date']))?></h5>
            <h5>Status : <span style='color:red;'><b>Pending</b></span></h5>
        </div>
    </div>

    <?php
        if(empty($userpackage['child'])){
            $userpackage['child'] = '0';
            //$userpackage['realprice_child'] = '0';
            $userpackage['price_child'] = '0';
        }
    ?>

    <!--  Customer Information  -->
    <div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered" style="font-size:16px;">
                <tr><th style="background:#eb1c23;color:white;width:210px;"><i class="fa fa-book" aria-hidden="true"></i> Booking</th><th style="background:black;color:white;text-align:right;" colspan="2"><?=$inv_id?></th></tr>
                <tr>
                    <th>Program</th>
                    <td colspan="2"><?=$userpackage['package']?> <span style="color:red">(<?=$userpackage['trip_type']?>)</span></td>
                </tr>
                <tr>
                    <th>Traveling date</th>
                    <td><?=$userpackage['time']?></td>
                    <td><?=thai_date4(strtotime($userpackage['day']))?></td>
                </tr>
                <tr>
                    <th>No. of Traveller</th>
                    <td width="50%" style="border-right:1px solid #ccc;"><?=$userpackage['adult']?> Adult x <?=number_format($userpackage['realprice_adult'])?> = <?=number_format($userpackage['price_adult'])?>฿</td>
                    <?php if($userpackage['free_travel']==0 || $userpackage['free_travel']=='0'){?>
                        <td><?=$userpackage['child']?> Child x <?=number_format($userpackage['realprice_child'])?> = <?=number_format($userpackage['price_child'])?>฿</td>
                    <?php }else{ ?>
                        <td><?=$userpackage['child']?> Child x <?=number_format($userpackage['realprice_child'])?> = <?=number_format($userpackage['price_child'])?>฿ <br><span style="color:blue;">(Free travel : <?=$userpackage['free_travel']?> Person)</span></td>
                    <?php } ?>
                </tr>
                <tr>
                    <th>Total</th>
                    <td><b style="font-size:18px;color:red;"><?=$total_price;?>฿</b> (extra charge: <?=number_format($extrachange)?>฿)</td>
                    <td><b>Status : <span style="color:red">Pending</span></b></td>
                </tr>
            </table>
        </div>
    </div>
    </div> <!-- row -->

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered" style="font-size:16px;">
                <tr><th style="background:#eb1c23;color:white;"><i class="fa fa-user" aria-hidden="true"></i></i> Customers</th><th style="background:black;color:white;text-align:right;" colspan="5">Details</th></tr>
<?php
$count = 1;
while (list($id,$dt_userpackage_id,$hotel_id,$name,$weights,$heights,$ages,$age,$email,$phone,$address,$city,$province,$country,$postcode,$nationality,$book_date,$is_primary,$hotel_other) = mysql_fetch_row($passenger)) {
    $weight = number_format($weights);
    $height = number_format($heights);

    if($is_primary == 1){
        $email_customer = $email; 
        $name_customer = $name;
        if($hotel_id == 0){
            $hotel_name = $hotel_other;
        }else{
            $gethotel = mysql_query("SELECT hotel FROM hotel WHERE hotel_id = $hotel_id");
            $ht = mysql_fetch_array($gethotel);
            $hotel_name = $ht['hotel'];
        }
?> 
                <tr style="background:#f7f7f7;">
                    <td style="width:210px"><b>Name</b></td>
                    <td width="30%" colspan="2"><?=$name?> <span style="color:blue;">(Primary)</span></td>
                    <td>Weight : <?=$weight?> kg</td>
                    <td>Height : <?=$height?> cm</td>
                    <td>Nationality : <?=$nationality?></td>
                </tr>
                <tr style="background:#f7f7f7;">
                    <th>Phone | E-mail</th>
                    <td colspan="2"><?=$phone?></td>
                    <td colspan="3"><?=$email?></td>
                </tr>
                <tr style="background:#f7f7f7;">
                    <th>Address</th>
                    <?php 
                        if(empty($address)){$address = '-';}
                        if(empty($city)){$city = '-';}
                        if(empty($province)){$province = '-';}
                        if($address == '-' && $city == '-' && $province == '-'){
                            $fulladdress = '- , ';
                        }else{
                            $fulladdress = $address.', '.$city.', '.$province.', ';
                        }
                    ?>
                    <td colspan="5"><?=$fulladdress?> <?=$country?> <?=$postcode?></td>
                </tr>
                <tr style="background:#f7f7f7;">
                    <th>Hotel</th>
                    <td colspan="5"><?=$hotel_name?></td>
                </tr>

<?php }else if($is_primary == 0 && $ages == 'Adult') { ?>
                <tr style="font-size:14px;">
                    <?php if($count == 2){ ?>
                        <th rowspan="<?=$numpasssenger;?>" style="width:210px;">Passenger</th>
                        <td width="30%" colspan="2"><?=$name?> (Adult)</td>
                        <td>Weight : <?=$weight?> kg</td>
                        <td>Height : <?=$height?> cm</td>
                        <td>Nationality : <?=$nationality?></td>
                    <?php }else{ ?>
                        <td width="30%" colspan="2"><?=$name?> (Adult)</td>
                        <td>Weight : <?=$weight?> kg</td>
                        <td>Height : <?=$height?> cm</td>
                        <td>Nationality : <?=$nationality?></td>
                    <?php } ?>
                </tr>

<?php }else if($is_primary == 0 && $ages == 'Child'){ ?>
                <tr style="font-size:14px;">
                    <!-- <td style="width:210px;"><i class="fa fa-child" aria-hidden="true"></i></td> -->
                    <td width="30%"><?=$name?> (Child)</td>
                    <?php if($age==0 || $age=='0'){ ?>
                        <td>Age : -</td>
                    <?php }else{ ?>
                        <td>Age : <?=$age?> years</td>
                    <?php } ?>
                    <td>Weight : <?=$weight?> kg</td>
                    <td>Height : <?=$height?> cm</td>
                    <td>Nationality : <?=$nationality?></td>
                </tr>
<?php } 
$count++;
}?>
            </table>
        </div>
    </div>
    </div>

 <!--  Paypal , FDF  -->
    <div id="tour_box" align="right" style="padding-right:10px;" class="no-print">
            <center>
                <!-- <a href="#" onclick="document.invpdf.submit();"><button class="btn btn-danger"><i class="fa fa-download fa-2x"></i><font size='4'> Download </font></button><!-- <img src="images/PDF_button.png"/></a> -->
                <button class="btn btn-danger" onclick="window.print();"><i class="fa fa-download fa-2x"></i><font size='4'> Download </font></button>
                <button class="btn btn-warning btn-paypal"><i class="fa fa-arrow-circle-right fa-2x"></i><font size='4'> Continue </font></button>
                <p style="margin-top: 10px;padding:5px 15px;border:solid red 1px;color:red;"> Noted : After your payment via Paypal, the system will redirect to our website.</p>
            </center>       
    </div>
    <div class='clearfix'></div>
    <hr width="100%">

    <p align="center">
        14 1<sup>st</sup> Floor, Ratchadamnoen Rd., Soi 5, Sriphum, Muang, Chiang Mai 50200 Thailand<br/>
        Mobile : +66(0)88 258 5817 Tel : +66(0)53 289 644 Fax : +66(0)53 289 646<br/>
        E-mail : reservations@touringcnx.com, touringcenter@hotmail.com
    </p>


</div>
<!-- <div class="container" style="margin-bottom:20px;">
    <img src="images/6color.jpg" style="width:100%;">
</div> -->
<?php include 'js-invoice.php'; ?>

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank" name='paypal'>
    <input type="hidden" name="cmd" value="_ext-enter">
    <input type="hidden" name="redirect_cmd" value="_xclick">
    <input type="hidden" name="business" value="info@touringcnx.com"/>
    <!-- <input type="hidden" name="business" value="tnz.info@gmail.com"/> -->
    <!-- <input type="hidden" name="business" value="testpayment@mail.com"/> -->
    <input type="hidden" name="invoice" value="<?= $inv_id ?>"/>
    <input type="hidden" name="custom" value="<?=$_GET['upack_id']?>"/>
    <input type="hidden" name="email" value="<?= $email_customer ?>"/>
    <input type="hidden" name="upload" value="1">
    <INPUT TYPE="hidden" name="charset" value="utf-8">
    <input type="hidden" name="item_name" value="Booking Invoice <?= $inv_id ?> <?=$name_customer?>"/>
    <input type="hidden" name="return" value="http://tour-in-chiangmai.com/success.php"/>
    <input type="hidden" name="cancel_return" value="http://tour-in-chiangmai.com/invoice.php?upack_id=<?=$_GET['upack_id']?>"/>
    <input type="hidden" name="currency_code" value="THB"/>
    <input type="hidden" name="rm" value="2"/>
    <input type="hidden" name="amount" value="<?= $amount ?>"/>
    <input type="hidden" id="" name="payer_status" value="verified">
    <input type="hidden" name="lc" value="GB">
    <input type="hidden" id="" name="verify_sign" value="Code_from_verisign">
    <input type="hidden" id="" name="payment_status" value="Completed">
</form>
<script>
    $(document).ready(function () {
        $('.btn-paypal').on('click', function () {
            var upack_id = 'upack_id=<?=$_GET['upack_id']?>';
            var _upackID = '<?=$_GET['upack_id']?>';
            $.ajax({
                type: "POST",
                url: "check_payment.php",
                data: upack_id,
                dataType: "json",
                success: function(data){
                    $.alert({
                        icon: 'fa fa-exclamation-triangle',
                        cancelButton: false,
                        autoClose: 'confirm|16000',
                        animation: 'RotateX',
                        animationClose: 'top',
                        icon: 'fa fa-sign-in',
                        closeIcon: true,
                        title: 'Payment Notify',
                        content: data['contents'],
                        confirmButtonClass: 'btn-danger',
                        confirm: function () {
                            if(data['status'] == 1){
                                document.paypal.submit();
                            }else{
                                document.location.href='paid_invoice.php?upack_id='+_upackID;
                            }
                        }
                    });
                },
                error: function(){
                    $.alert('Failed');
                }
            });
        });
    });
</script>

<script type="text/javascript">
    window.onbeforeunload = function(e) {
        return 'The Process still not complete, if you which to close click yes.';
    };
</script>
</body>
</html>