<?php include('/var/www/html/themes/investuk/header.php');
$baseURL = Yii::app()->theme->baseUrl;
?>
<div class="body_section">
	<div class="container">
		<div class="mid-section">
			<div id="content">
				<div class="row m-t-50 py-5">
					<div class="col-xs-12 col-md-8 table-cell">
						<div class="register-left">
							<div class="register-left-hd">							
							<h4 class="text-center">CORPORATE AFFAIRS AND INTELLECTUAL PROPERTY OFFICE</h4>
							</div>
							<div><img src="<?php echo BASE_URL ?>/themes/investuk/images/login-img.png"></div>
						
						</div>
					</div>
					
					<div class="col-xs-12 col-md-4 table-cell">
						<div class="register-right" style="padding-top:74px !important;">
							<!-- <div class="register-right"> -->
							<h2 class="register-right-hd">Department Login</h2>
							<form class="sky-form" action="<?php echo Yii::app()->createUrl('/site/login');?>" method="post">
								<div class="col-lg-12 no-padding alert-box">
								<?php
								   foreach(Yii::app()->user->getFlashes() as $key => $message) {
									   echo '<font color="red"></font><div class="alert-message error"><font color="red"></font><p><font color="red">' . $message . "</font></p></div>\n";
								   }
								?>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group pos-rel">
											<span class="input-icons email-tbox"></span>
											<input type="text" class="register-tbox form-control p-l-40" name="LoginForm[username]" required placeholder="User ID" value="<?php echo ($logincode=='')?'':$logincode ; ?>" autofocus> 
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group pos-rel">
											<span class="input-icons pass-tbox"></span>
											 <input type="password" class="register-tbox form-control p-l-40" name="LoginForm[password]" required placeholder="Password"> 
										</div>
									</div>
								</div>
								<div class="clearfix"></div>
							    <div class="row">
									<div class="col-xs-12">
										<div class="form-group m-b-10 ml-2">
										  <button type="submit" class="btn btn-secondary mx-1" name="login-submit" id="login-submit">Login</button>
										</div>
									</div>
							    </div>
								
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	
<?php include('/var/www/html/themes/investuk/footer.php');?>