  <form action="<?= Yii::app()->createAbsoluteUrl('infowizard/payment/SubmitApplicationForPayment') ?>" name="checkPayment" method="post">
                                            <input type="hidden" class="csrftoken" name="YII_CSRF_TOKEN_SUBMIT" value="<?= Yii::app()->getRequest()->getCsrfToken() ?>" />
                                            <input type="hidden" name="submission_id" value="<?php echo $submission_id;?>" />
                                            <input type="hidden" name="user_id" value="<?php echo @$_SESSION['RESPONSE']['user_id'];?>" />


<script  type="text/javascript">
	//submit the form to the worldline 
	document.checkPayment.submit(); 
</script>