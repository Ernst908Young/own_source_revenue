<h2>Redirecting ! Please wait...</h2>
<form id='form2' method="post" action="<?php echo Yii::app()->createAbsoluteUrl('account/signin');?>">
	 <input type="hidden" id="csrfToken" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>"/>
	<p><input type="hidden" value="<?=$message?>" name="SSO_MESSAGE" /></p>
	<p><input type="hidden" value="<?=$CALLBACK_URL?>" name="CALL_BACK_URL" /></p>
	<p><input type="hidden" value="<?=$CALLBACK_FAILURE_URL?>" name="CALLBACK_FAILURE_URL" /></p>
	<p><input type="hidden" value="<?=$CALLBACK_SUCCESS_URL?>" name="CALLBACK_SUCCESS_URL" /></p>
	<p><input type="hidden" value="<?=$status_code?>" name="SSO_STATUS_CODE" /></p>
	<p><input type="submit" value="Invalid Credentials :: Please try again !" /></p>
</form>
<script type="text/javascript">
	 document.getElementById('form2').submit();
</script>