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
		<?php //print_r($_SESSION); die();//echo $CALL_BACK_URL; ?>
		<form id='formid' method="post" action="<?php echo Yii::app()->params['applicant_dashboard'] ?>" >
			<input name="full_name" type="hidden" value="<?php if(isset($Profiles)) echo $Profiles['full_name'] ;?>" >
			<input name="email" type="hidden" value="<?php if(isset($Users)) echo $Users['email'] ;?>">
			<input name="mobile" type="hidden" value="<?php if(isset($Profiles)) echo $Profiles['mobile_number'] ;?>" >
			<input name="code" type="hidden" value="<?php if(isset($code)) echo @$code ;?>" >
			<input name="logintype" type="hidden" value="<?php if(isset($logintype)) echo @$logintype ;?>" >
			
			<p><input type="hidden" value="<?=$message?>" name="SSO_MESSAGE" /></p>
			<p><input type="hidden" value="<?=$status_code?>" name="SSO_STATUS_CODE" /></p>
			<p><input type="hidden" value="<?=$token?>" name="SSO_TOKEN" /></p>
			<p><input type="hidden" value="<?=$href?>" name="SSO_HREF" /></p>
			<p><input type="hidden" value="<?=$dept_id?>" name="SSO_DEPT_ID"/></p>
			<input type="submit" value="Click me if you are stuck on this page" >
			 <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>"/>
		</form>
		</div>
		<script type="text/javascript">
			document.getElementById('formid').submit();
		</script>
	</body>
</html>