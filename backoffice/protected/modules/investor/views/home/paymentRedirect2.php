<form action="<?php echo Yii::app()->createAbsoluteUrl('/frontuser/home/paymentPay')?>" method="post" name="paymentRedirect">
	<h4 align="center">Redirecting To Payment Please Wait..</h4>
	<input type="hidden" size="200" name="iuid" id="merchantRequest" value="<?php echo $iuid; ?>"  />
	<input type="hidden" name="submission_id" value="<?php echo $submisstion_id; ?>"/>
	<input type="hidden" name="application_id" value="<?php echo $application_id; ?>"/>
	<input type="hidden" name="amount" value="<?php echo $amount; ?>"/>
</form>
<script  type="text/javascript">
	//submit the form to the worldline
	document.paymentRedirect.submit();
</script>