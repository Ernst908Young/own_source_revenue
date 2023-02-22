<?php //$baseURL="/sso/themes/utrakhand"; // sso-curr/themes/investuk/views/layouts ?>
<style type="text/css">
.inner-header{
	display:none;
}
</style>
<?php $baseURL="/sso/themes/investuk";?>
	<div class="row m-t-50 py-5">		
		<div class="col-xs-12 col-md-6 table-cell">
			<div class="register-left">
			<div class="register-left-hd">
				<h4 class="text-center">Welcome to</h4>
				<h4 class="text-center">CORPORATE AFFAIRS AND INTELLECTUAL PROPERTY OFFICE</h4>
                                <?php //echo "<!--<pre>"; print_r($data); echo "</pre>-->"; ?>
				</div>
				<p class="register-left-gry-txt text-center"><span></span></p>
				<ul class="register-left-stats">
				<li>
					<div class="stats-icon"><img src="<?php echo $baseURL; ?>/images/investor_icon.png" alt="" title="" /></div>
					<div class="stats-icon-txt ml-3">
						<h6>Registered Applicant</h6>
						<h5><?php echo ReportUtility::getCountofRegisteredUsers(); ?></h5>
					</div>
					<div class="clearfix"></div>
				</li>
				<li>
					<div class="stats-icon"><img src="<?php echo $baseURL; ?>/images/file_icon.png" alt="" title="" /></div>
					<div class="stats-icon-txt ml-3">
						<h6>Total Services</h6>
						<h5><?php echo ReportUtility::getTotalGrantIssues(); ?></h5>
					</div>
					<div class="clearfix"></div>
				</li>
				<li>
					<div class="stats-icon"><img src="<?php echo $baseURL; ?>/images/rupees_icon.png" alt="" title="" /></div>
					<div class="stats-icon-txt ml-3">
						<h6>Applications Recieved</h6>
						<h5><?php  echo ReportUtility::getProjectTotalStateInvestment(); ?></h5>
					</div>
					<div class="clearfix"></div>
				</li>
				<li>
					<div class="stats-icon"><img src="<?php echo $baseURL; ?>/images/card_icon.png" alt="" title="" /></div>
					<div class="stats-icon-txt ml-3">
						<h6>Applications Approved</h6>
						<h5><?php echo $totalEmp = ReportUtility::getProjectTotalStateEMPMale() + ReportUtility::getProjectTotalStateEMPFemale();?></h5>
					</div>
					<div class="clearfix"></div>
				</li>
				<div class="clearfix"></div>
			</ul>
			</div>
		</div>
		<?php
		if (!empty($error)) {
			echo "<font color='red'>$error</font>";
		} else {
		extract($_POST); 
		?> 
		<div class="col-xs-12 col-md-6 table-cell">
			<div class="register-right">
				<?php
				foreach (Yii::app()->user->getFlashes() as $key => $message) {
					echo '<font color="red"><center><div class="alert-message error"><p>' . $message . "</center></font></p></div>\n";
				}
				?> 
				<h2 class="register-right-hd">Create an account</h2>
				<p id="registration-error" style="color:red;"></p>
				<form id="register-form" name="register-form" action="" method="post" role="form" data-toggle="validator" class="sky-form">
				<input type="hidden" name="CALL_BACK_URL" value="<?php echo $CALL_BACK_URL; ?>" />
				<input type="hidden" name="callback_failure_url" value="<?php echo $callback_failure_url; ?>" />
				<input type="hidden" name="callback_success_url" value="<?php echo $callback_success_url; ?>" />
				<div class="row">
					<div class="col-sm-12">
					  <div class="form-group pos-rel">
						<span class="input-icons email-tbox"></span>
						<input type="email" class="register-tbox form-control p-l-40  email_check" id="email" name="email"aria-describedby="" placeholder="E-mail Address"  required="required" maxlength="150" onblur="checkValidation()" autocomplete="off">
						</div>
					</div>
				</div>
				  <!--div class="row">
					<div class="col-xs-12 col-sm-6">
					  <div class="form-group pos-rel">
						<span class="input-icons pass-tbox"></span>							  
						<input type="password" class="register-tbox form-control p-l-40" name="password1" id="password1" aria-describedby="" placeholder="Password" required="required" onblur="checkValidation()" autocomplete="off">
					  </div>
					</div>
					<div class="col-xs-12 col-sm-6">
					  <div class="form-group pos-rel">	
						<span class="input-icons pass-tbox"></span>						  
						<input type="password" class="register-tbox form-control p-l-40" name="password2" id="password2" aria-describedby="" placeholder="Confirm Password" required="required" onblur="checkValidation()" autocomplete="off">
					  </div>
					</div>
				  </div-->
				  <h6 class="add-hd">Additional Information</h6>
				  <div class="row">
					<div class="col-xs-12 col-sm-6">
					  <div class="form-group">					  
						<input type="text" class="register-tbox form-control" required="required" id="fname" name="First_Name" maxlength="20" aria-describedby="" placeholder="First Name" onblur="checkValidation()" autocomplete="off">
					  </div>
					</div>
					<div class="col-xs-12 col-sm-6">
					  <div class="form-group">					  
						<input type="text" class="register-tbox form-control" required="required"  id="lname" name="Last_Name" maxlength="20"  aria-describedby="" placeholder="Last Name" onblur="checkValidation()" autocomplete="off">
					  </div>
					</div>
				  </div>
				  <!--div class="row"> 
					<div class="col-xs-12 col-sm-6">
					  <div class="form-group">					  
						<input type="text" class="register-tbox form-control" id="pan" name="PAN" maxlength="10"aria-describedby="" placeholder="PAN Card No" onblur="checkValidation()" autocomplete="off">
					  </div>
					</div>
					<div class="col-xs-12 col-sm-6">
					  <div class="form-group">					  
						<input type="text" class="register-tbox form-control" id="uid" name="Adhaar" maxlength="12"  aria-describedby="" placeholder="Adhaar No" onkeypress="return isNumberKey(event)" onblur="checkValidation()" autocomplete="off">
					  </div>
					</div>
				  </div-->
				  <div class="row">
					<div class="col-sm-12">
					  <div class="form-group">
						<input type="text" class="register-tbox form-control" id="address" name="address" maxlength="150" aria-describedby="" placeholder="Address" required="required" onblur="checkValidation()" autocomplete="off">
					  </div>
					</div>
				</div>
				<!--div class="row">
					<div class="col-xs-12 col-sm-6">
					  <div class="form-group">
						<?php 
						$active='Y';
						/* $sql = "SELECT lr.lr_id,lr.lr_name FROM bo_landregion lr INNER JOIN bo_country bc ON lr.lr_id = bc.lr_id WHERE lr.is_lr_active=:active"; */
						
						$sql = "SELECT lr.lr_id,lr.lr_name FROM bo_landregion lr WHERE lr.lr_type='country' and  lr.is_lr_active=:active";
						$connection = Yii::app()->db;
						$command = $connection->createCommand($sql);
						$command->bindParam(":active", $active, PDO::PARAM_STR);
						$countries = $command->queryAll();
						//echo "<--<pre>".print_r($countries);echo "</pre>-->";
						if (isset($countries)) {
							 echo "<select id='country' name='country' class='register-sbox form-control' required='required' onblur='checkValidation()'>";
							 echo "<option value='0' selected disabled>Country</option>";
							 foreach ($countries as $country)
								 echo "<option value='$country[lr_id]'>$country[lr_name]</option>";
							 echo "</select>";
							 echo "<i></i>";
						} else {
							 echo"<input type='text' name='country' id='country' class='register-tbox form-control' placeholder='Pleas Enter your country'";
						}
						?>						
					  </div>
					</div>
					<div class="col-xs-12 col-sm-6">
					  <div class="form-group">					  
						<select required="required" id="state" name="state" class="register-sbox form-control" onblur="checkValidation()">
							<option value="0" selected disabled>State</option>
						</select>
					  </div>
					</div>
				  </div-->
				  <!--div class="row">
					<div class="col-xs-12 col-sm-6">
					  <div class="form-group">					  
						<input type="text" class="register-tbox form-control" required="required" id="city"  name="City" maxlength="20" aria-describedby="" placeholder="City" onblur="checkValidation()" autocomplete="off">
					  </div>
					</div>
					<div class="col-xs-12 col-sm-6">
					  <div class="form-group">					  
						<input type="text" class="register-tbox form-control" required="required" id="distt" name="District" maxlength="20" aria-describedby="" placeholder="District" onblur="checkValidation()" autocomplete="off">
					  </div>
					</div>
				  </div-->
				  <div class="row">
					
					<div class="col-xs-12 col-sm-12">
					  <div class="form-group">					  
						<input type="text" class="register-tbox form-control" id="mobileNo" name="mobile" maxlength="10" aria-describedby="" placeholder="Mobile No" required="required" onkeypress="return isNumberKey(event)" onblur="checkValidation()" autocomplete="off">
					  </div>
					</div>
				  </div>
				  <div class="row">
					<div class="col-xs-12">
					<div class="form-group ml-3">
					<a id="otpverify" class='btn btn-secondary mx-1' title="Register" href="javascript:void(0);" style="padding:10px 10px !important;">Register</a>
					  <!--<button type="submit" id="otpverify" class="btn btn-primary register-form-btn">Register</button>-->
					</div>
					</div>
				  </div>
				</form>
			</div>
		</div>
	
		<!-- custom forms -->
		<div class="modal fade" id="thankyouModal" tabindex="-1" role="dialog">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-body">
				<div class="modal-header" style="background: #1383b2; color: #fff;border-bottom: 0; margin: -15px -15px 0;
   border-radius: 5px 5px 0px 0px;">
					<!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
					<h4 class="modal-title" style="text-align:center;font-weight:bold;font-size:20px;">OTP Verification</h4>
				</div>
				<form id="login_form">
					<p id="login_error"></p>
					<p id="otplable" style="font-size: 16px; margin: 20px 0; color:#2c2c2c !important;font-weight:bold;">Please enter OTP which we have send on mobile number <b id="mob_no"></b>: </p>
					<div class="row">
						<div class="col-md-12" style="padding-left:3px;">
							<div class="col-md-1">
								<label for="login_pass">OTP</label>
							</div>	
							<div class="col-md-8">						
								<input type="text" id="login_pass" name="login_pass" size="5" class="register-tbox form-control" placeholder="Enter OTP Number" autocomplete="off"/>
							</div>					
						</div>
					</div>
					<div class="row" style="padding-top:14px;padding-left:37px;">
						<div class="col-md-12">
							<div class="col-md-4">
								<input type="submit" id="otpsubmit" value="Verify OTP"  class="btn btn-primary"/>
							</div>
							<div class="col-md-4" style="padding-top:7px;">		
								<a href="javascript:void(0);" onclick="sendotp()">Resend OTP</a>
							</div>			
						</div>
					</div>
				</form> 
				<style type="text/css">
				#otplable{color:red;} .m-b-15{margin-bottom:15px;}</style>				
			  </div>    
			</div>
		  </div>
		</div>
		<div class="modal fade" id="loader" style="display:none" tabindex="-1" role="dialog">
			<div class="modal-dialog" style="width: 10%;margin-top:20%;">
				<div class="modal-content">
					<div class="modal-body">
						<div class="center" style="text-align: center;">
							<img alt="Wait" src="<?php echo $baseURL; ?>/images/loader.gif" />
						</div>
					</div>
				</div>	
			</div>		
		</div>		
		<?php
		}
		?>
	</div>
<script src="<?php echo $baseURL; ?>/assets/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo $baseURL; ?>/assets/js/jquery.validate.min.js"></script>
<!--<script src="https://caipotesturl.com/themes/investuk/js/jquery-1.js"></script>-->
<script src="<?php echo $baseURL; ?>/assets/js/bootstrap.min.js"></script>
<!--<script src="<?php echo $baseURL; ?>/bootstrap/validate.js"></script>-->
<!--<script src="<?php echo $baseURL; ?>/sso/themes/investuk/js/formValidation.js"></script>-->
<script src="<?php echo $baseURL; ?>/bootstrap/bootstrap.tooltip.js"></script>
<script src="<?php echo $baseURL; ?>/bootstrap/customvalidation.js"></script>

<script type="text/javascript" src="<?php echo $baseURL; ?>/fancybox/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="<?php echo $baseURL; ?>/fancybox/jquery.fancybox-buttons.js"></script>
<script type="text/javascript" src="<?php echo $baseURL; ?>/fancybox/jquery.fancybox-media.js"></script>
<script type="text/javascript" src="<?php echo $baseURL; ?>/fancybox/jquery.fancybox-thumbs.js"></script>
<!-- Optional, Add mousewheel effect -->
<script type="text/javascript" src="<?php echo $baseURL; ?>/fancybox/jquery.mousewheel-3.0.6.pack.js"></script>  
<script src="<?php echo $baseURL; ?>/assets/js/register.js"></script>
<script type="text/javascript">
   $(document).ready(function() { // makes sure the whole site is loaded
    /*    $('#status').fadeOut(); // will first fade out the loading animation
       $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
       $('body').delay(350).css({'overflow':'visible'});	 */
   });
   
   function isNumberKey(evt)
	{
	 var charCode = (evt.which) ? evt.which : event.keyCode
	 if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;

	 return true;
  }
	/* $('#my-modal').on('hidden.bs.modal', function () {
	 location.reload();
	}); */
</script>
