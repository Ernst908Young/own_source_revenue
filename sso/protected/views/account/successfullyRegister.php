<style>
/*-----thanks---------*/
.max-width-600{
	max-width:500px;	
}
.d-i-block{
	display: inline-block;
}
.thanks-msg .register-right-hd::after{
	left: 0;
	right:0;
	margin: 0 auto;
}
.thanks-msg-h6{
	font-size:20px;
	font-weight:bold;
	margin-bottom:15px;
}
.m-b-20{
	margin-bottom:20px;
}
.inner-header{
	display:none;
}
</style>
<div class="container">
	<!--<section class="margin-bottom">
		<div class="row">
			Thank you! <?php echo $name ;?>, You are successfully registered on SWCS Uttrakhand,
		</div>
		<div class="row"><p class="h"><a id="otpverify" class='button' title="Register" href="<?php echo FRONT_BASEURL;?>">Go back to Home</a></p>
		</div>
	</section>-->
	<?php $baseURL="/sso/themes/investuk";?>
	<div class="row">
		<div class="col-xs-12 text-center thanks-msg m-b-20" style="margin:156px 0;">
			<div class="max-width-600 d-i-block ">
				<p><img src="<?php echo $baseURL;?>/images/green_big_check.png" alt="" title="" /></p>
				<h2 class="register-right-hd">Thanks for Signing up!</h2>
				<h6 class="thanks-msg-h6">We just sent you a confirmation email.</h6>
				<!--<p class="register-left-gry-txt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam id vehicula justo. Donec ultricies vehicula felis sed commodo.</p>-->
				<a class="btn btn-primary" href="<?php echo  Yii::app()->createUrl('/account/signin'); ?>">Login</a>
			</div>
		</div>
	</div>
</div>
                	   
