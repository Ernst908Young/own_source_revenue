<h2>Redirecting ! Please wait...</h2>

<form id='formid' method="post" action="<?=$callback_url?>">
	<p><input type="hidden" value="<?=$message?>" name="SSO_MESSAGE" /></p>
	<p><input type="hidden" value="<?=$status_code?>" name="SSO_STATUS_CODE" /></p>
	<p><input type="hidden" value="<?=$token?>" name="SSO_TOKEN" /></p>
	<p><input type="hidden" value="<?=$href?>" name="SSO_HREF" /></p>
	<p><input type="submit" value="Click here if you are stuck on this page." /></p>
	
</form>

<script type="text/javascript">
document.getElementById('formid').submit();
</script>