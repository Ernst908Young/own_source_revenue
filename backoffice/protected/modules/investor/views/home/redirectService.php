<form action="<?=$params['reverted_call_back_url']?>" method="post" name="paymentRedirect">
	<h4 align="center">Redirecting. Please Wait..</h4>
	<input type="hidden" size="200" name="iuid" id="merchantRequest" value="<?php echo $params['iuid']; ?>"  />
	<input type="hidden" name="application_status" value="<?php echo $params['application_status']; ?>"/>
	<input type="hidden" name="application_id" value="<?php echo $params['application_id']; ?>"/>
	<input type="hidden" name="sp_tag" value="<?php echo $params['sp_tag']; ?>"/>
	<input type="hidden" name="service_id" value="<?php echo $params['service_id']; ?>"/>
</form>
<script  type="text/javascript">
	document.paymentRedirect.submit();
</script>