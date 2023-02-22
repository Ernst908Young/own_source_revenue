<h2>Redirecting ! Please wait...</h2>

<form id='form2' method="post" action="<?=$CALLBACK_FAILURE_URL?>">
	<p><input type="hidden" value="<?=$message?>" name="SSO_MESSAGE" /></p>
	<p><input type="hidden" value="<?=$status_code?>" name="SSO_STATUS_CODE" /></p>

	<p><input type="submit" value="Invalid Credentials :: Please try again !" /></p>
</form>

<script type="text/javascript">
	document.getElementById('form2').submit();
</script>