<div style="text-align:center">
	<h4>Thank you for booking and paying</h4>
</div>
<div style="text-align:center; margin-top:25px;">
	<h4 style="background:#e1e9ff; margin:5px 60px; padding: 25px;">
		<span style="color:#3e3e3e;"> Please check and download document the booking information</span>
		<a href="http://localhost:3000/transaction/{{$transactionId}}" target="_blank">Click here.</a>
	</h4>
</div>
<script>
	window.location="http://localhost:3000/transaction/{{$transactionId}}";
</script>