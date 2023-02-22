<footer class="main-footer">
	<div class="container">
		<div class="row">
		 	<div class="col-xs-12 col-sm-6 col-md-3 m-b-15">
				<div>
					<h4 class="footer-hd">Contact Details</h4>
					<ul class="footer-contact">
						<li>
							<p class="footer-contact-icn"><img src="<?php echo $basePath;?>/themes/investuk/images/ftr_address_icon.png" alt="" title="" /></p>
							<p class="p-l-10">4th Floor, Indira Bhawan, Lucknow, Uttar Pradesh</p>
						</li>
						<li>
							<p class="footer-contact-icn"><img src="<?php echo $basePath;?>/themes/investuk/images/ftr_phone_icon.png" alt="" title="" /></p>
							<p class="p-l-10">Toll Free  0191-24345678</p>
						</li>						
						<li>
							<p class="footer-contact-icn"><img src="<?php echo $basePath;?>/themes/investuk/images/ftr_phone_icon.png" alt="" title="" /></p>
							<p class="p-l-10"> 0191-12345678 <br/>
                             0191-12345678</p>
						</li>
						<li>
							<p class="footer-contact-icn"><img src="<?php echo $basePath;?>/themes/investuk/images/ftr_email_icon.png" alt="" title="" /></p>
							<p class="p-l-10"><!--<a href="mailto:mpr@doiuk.org">mpr@doiuk.org</a>--> <a href="mailto:helpdesk@investuttarakhand.com">helpdesk@email.com</a></p>
						</li>
                                                <li> 
							
							<!--<p class="p-l-10">WhatsApp +91-7895857056</p>-->
						</li>
					</ul>
				</div> 
			</div> 
		 	<div class="col-xs-12 col-sm-6 col-md-3 m-b-15">
				<div>
					<h4 class="footer-hd">Quick Links</h4>
					<ul class="footer-quick-links">
						<li><a href="<?php echo $basePath;?>">Home</a></li>
						<li><a href="#">About</a></li>
						<li><a href="#">Contact Us</a></li>
					</ul>
				</div>
			</div>
			<!-- <div class="col-xs-12 col-sm-6 col-md-3 m-b-15">
				<div>
					<h4 class="footer-hd">Resources</h4>
					<ul class="footer-quick-links">
						<li><a href="<?php echo $basePath;?>/site/ActsRulesNotifications">Acts</a></li>
						<li><a href="<?php echo $basePath;?>/site/ActsRulesNotifications">Notifications</a></li>
						<li><a href="<?php echo $basePath;?>/site/ActsRulesNotifications">Rules</a></li>
						<li><a href="<?php echo $basePath;?>/site/Policies">Policies & Guidelines</a></li>
						<li><a href="<?php echo $basePath;?>/site/privacyPolicy">Privacy Policy</a></li>
					</ul>
				</div>
			</div> -->
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div>
					<h4 class="footer-hd">Stay with Us</h4>
					<ul class="footer-stay-us">
						<li><a class="fb" title="Facebook" target ="_blank" href="#"><i aria-hidden="true" class="fa fa-facebook"></i></a></li>
					<li><a class="tw" title="Twitter" target ="_blank" href="#"><i aria-hidden="true" class="fa fa-twitter"></i></a></li>
					</ul>
				</div>
			</div> 
			
		</div>
		<!--<div class="row">
			<div class="col-xs-12 footer-copyright">
				© 2018 Directorate of Industries, Uttarakhand, All rights reserved.&nbsp;&nbsp;&nbsp;&nbsp; <img src="<?php //echo $basePath;?>/themes/investuk/images/ftr_verified_icon.png" alt="" title="" />
			</div>
		</div>-->
            <div class="row">
			<div class="col-xs-12 footer-copyright">
                            <div class="col-xs-9">
				© 2021 E-JUDICIARY, GOVERMENT OF UTTARPRADESH , All rights reserved.&nbsp;&nbsp;&nbsp;&nbsp; 
                               
                        </div>
                     <div class="col-xs-3">Last Updated On : 16-Oct-2021</i></div>
		</div>
	</div>
	</div>
</footer>
 </div>
  </div>
  
  <div class="footer-chat" style="display:none;"><img src="<?php echo $basePath;?>/themes/investuk/images/ftr_chat_img.png" alt="" title="" /></div>
<?php if(!isset($_SESSION['webref'])){ ?>
<div class="sticky-btn-right">
	<!-- <a href="<?php echo $basePath;?>/query/open.php?guest=1" class="sticky-orange-btn">Raise Your Query / Post Issue Or Suggestions</a>
	<a href="<?php echo $basePath;?>/check-services" class="sticky-blue-btn">Know Your Approvals</a>
	<a target="_blank"href="<?php echo $basePath;?>/backoffice/iloc/property/listing/landtype/Pvt" class="sticky-blue-btn">Land Bank</a>	 -->
</div>
<?php }?>
<!-- Bootstrap core JavaScript
    ================================================== -->
	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->


	
	
    <!-- Placed at the end of the document so the pages load faster -->
	<?php $actin = Yii::app()->controller->action->id;
	
	$controller = Yii::app()->controller->id;
	
	if($actin!='create' && $controller!='pis' && $controller!='site' &&  $actin!='ActsRulesNotifications' ){
	?>
    <script src="<?php echo $basePath;?>/themes/investuk/js/jquery-1.js"></script>
	<script src="<?php echo $basePath;?>/themes/investuk/js/bootstrap.min.js"></script>	
	<script src="<?php echo $basePath;?>/themes/investuk/js/nav.js"></script> 
	<?php } 	
	if($actin=='feedbackSurvey' || $actin=='thankyou'){
	?>
		<script src="<?php echo $basePath;?>/themes/investuk/js/jquery-1.js"></script>
		<script src="<?php echo $basePath;?>/themes/investuk/js/bootstrap.min.js"></script>	
		<script src="<?php echo $basePath;?>/themes/investuk/js/nav.js"></script>
	<?php
	}
	?>	
		
   

<!-- BEGIN PAGE LEVEL PLUGINS -->
<div id="guestLogin" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color:red"><i class="fa fa-desktop"></i> Verify Your Mobile Number</h4>
            </div>
            <form method="POST" id="mobilenumberform" >
                <div class="modal-body">
                    <div class="content">
                            <!-- BEGIN VERIFY MOBILE FORM // 27012018-->
                            <p>Verify your mobile number to Submit this Land Record</p>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div class="input-icon">
                                        <i class="fa fa-mobile"></i>
                                        <input name="lID" type="hidden" value="<?php echo @$_GET['landID'] ?>" >
                                        <input class="form-control placeholder-no-fix" autocomplete="off" placeholder="Enter Mobile Number" name="mobile_number" id="mobileNumber" type="number" value="<?php $rf=@$requestedProperty1['agent_contact_no'];if(empty($rf)){ echo @$requestedProperty1['owner_contact_no'];}else{echo $rf;} ?>">
                                    </div>
                                </div>
                            </div>
                            <!-- END Verify Mobile Number FORM // 27012018 -->
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-actions">
                        <button type="button" id="back-btn" class="btn" data-dismiss="modal">
                            <i class="m-icon-swapleft"></i> Back </button>
                        <button type="button" class="btn green-haze pull-right verifymobilenumber" hideit="mobilenumberform" showit="otpform">
                            Send OTP <i class="m-icon-swapright m-icon-white"></i>
                        </button>
                    </div>
                </div>
            </form>
                        <!-- OTP FORM STARTS HERE -->
                        <form  id="otpform"  method="POST" style="display:none;">
                <div class="modal-body">
                    <div class="content">

                        <!-- BEGIN VERIFY MOBILE FORM // 27012018-->

                            <p>
                                Please enter otp sent on your mobile number
                            </p>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div class="input-icon">
                                        <i class="fa fa-mobile"></i>
                                        <input name="lID" type="hidden" value="<?php echo @$_GET['landID'] ?>" >


                                        <input class="form-control placeholder-no-fix" autocomplete="off" placeholder="Enter OTP" name="mobile_number" id="OTP" type="number" >
                                    </div>
                                </div>
                            </div>
                            <!-- END Verify Mobile Number FORM // 27012018 -->
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-actions">
                        <button type="button" id="back-btn" class="btn verifymobilenumber" hideit="otpform" showit="mobilenumberform">
                            <i class="m-icon-swapleft"></i> Resend OTP </button>
                        <button type="button"  class="btn green-haze pull-right verifyOtp">
                            Verify OTP <i class="m-icon-swapright m-icon-white"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
  
	
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-123351394-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-123351394-1');
</script>
<script>
    // Added by Rahul Kumar : 06022018
    $(document).ready(function(){
    //  alert("h");
        $('.verifymobilenumber').click(function(){
           // alert("hi");
            var hideit=$(this).attr('hideit');
            var showit=$(this).attr('showit');
            $("#"+hideit).css('display','none');
            $("#"+showit).css('display','block');

            $.ajax({
				type: "POST",
				url: "/backoffice/iloc/property/sentOtp/mobileNumber/"+$("#mobileNumber").val() ,
				success: function (result) {
					if(result==true){
					 } else{

						}
				}
			});
        });
		
		$('.verifyOtp').click(function(){
            $.ajax({
				type: "POST",
				url: "/backoffice/iloc/property/verifyOtp/otp/"+$("#OTP").val()+"/mobileNumber/"+$("#mobileNumber").val(),
				success: function (result) {
					if(result=="Otp Verified"){
					   //location.reload();
					   $("#landAdSetting").submit();
					  }else{
						 alert(result);
					  }
				}
			});
		});

	});	

	//A+ A A-
	function aplus() {
		var plus = new Number($('body').css('font-size').replace("px", ""));
		if (plus == 16) {
			plus = plus;
		}
		else {
			plus = plus + 1;
		}
		$('body').css('font-size', plus + 'px');
	}

	function anormal() {
		$('body').css('font-size', '14px');
	}

	function aless() {
		var less = new Number($('body').css('font-size').replace("px", ""));
		if (less == 12) {
			less = less;
		}
		else {
			less = less - 1;
		}

		$('body').css('font-size', less + 'px');
	}
	
	
</script>

<?php //include_once $_SERVER['DOCUMENT_ROOT']."/chatroom/pages/chat.php" ; ?>

<div class="sticky-footer" style="position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  background-color: #f05518;
  color: white;
  text-align: center;">

</div>
</body>
</html>
