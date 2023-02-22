<!DOCTYPE html>
<html lang="en-US">
	<head>
		<title>Please wait...</title>
		<style type="text/css">
			body, html{
				background-color:#dedede;
			}
		</style>
	</head>
	<body>
		<h1>Please wait...</h1>
		<div>
		<form id='formid' method="post" action="<?=$CALL_BACK_URL ?>" >
			<input name="full_name" type="hidden" value="<?=@$_SESSION['RESPONSE']['first_name']." ".@$_SESSION['RESPONSE']['last_name']?>" >
			<input name="email" type="hidden" value="<?=@$_SESSION['RESPONSE']['email'] ;?>" >
			<input name="mobile" type="hidden" value="<?=@$_SESSION['RESPONSE']['mobile_number'] ;?>" >
			<p><input type="hidden" value="<?=$message?>" name="SSO_MESSAGE" /></p>
			<p><input type="hidden" value="<?=$status_code?>" name="SSO_STATUS_CODE" /></p>
			<p><input type="hidden" value="<?=$token?>" name="SSO_TOKEN" /></p>
			<p><input type="hidden" value="<?=$href?>" name="SSO_HREF" /></p>
			<p><input type="hidden" value='<?=@$CAFFields?>' name="CAFFields" /></p>
			<p><input type="hidden" value="<?=@$CAFFieldStatus?>" name="CAFFieldStatus" /></p>
			<p><input type="hidden" value="<?=@$service_name?>" name="service_name" /></p>
			<p><input type="hidden" value="<?=@$service_id?>" name="service_id" /></p>
			<p><input type="hidden" value="<?=@$department_name?>" name="department_name" /></p>
			<p><input type="hidden" value="<?=@$caf_application_id?>" name="caf_application_id" /></p>

			<input type="submit" value="Click me if you are stuck on this page" >
		</form>
		</div>
		<script type="text/javascript">
			document.getElementById('formid').submit();
		</script>
	</body>
</html>