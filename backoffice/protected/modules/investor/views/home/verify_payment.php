  <form action="<?= Yii::app()->createAbsoluteUrl('frontuser/home/SubmitApplicationForPayment') ?>" name="checkPayment" method="post">
                                            <input type="hidden" class="csrftoken" name="YII_CSRF_TOKEN_SUBMIT" value="<?= Yii::app()->getRequest()->getCsrfToken() ?>" />
                                            <input type="hidden" name="submission_id" value="<?php echo "309";?>" />
                                            <input type="hidden" name="user_id" value="<?php echo "11";?>" />


<script  type="text/javascript">
	//submit the form to the worldline 
	document.checkPayment.submit(); 
</script>