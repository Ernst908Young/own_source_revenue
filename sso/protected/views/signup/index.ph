<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Login / Register - SSO :: SWCS DEMO</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link href='http://fonts.googleapis.com/css?family=Raleway:500' rel='stylesheet' type='text/css'>
        <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
         <link rel="stylesheet" href="/SWCS/frontoffice/themes/SWCS/fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />
        <script type="text/javascript" src="/SWCS/frontoffice/themes/SWCS/fancybox/source/jquery.fancybox.pack.js"></script>

        <!-- Optional, Add fancyBox for media, buttons, thumbs -->
        <link rel="stylesheet" href="/SWCS/frontoffice/themes/SWCS/fancybox/source/helpers/jquery.fancybox-buttons.css" type="text/css" media="screen" />
        <script type="text/javascript" src="/SWCS/frontoffice/themes/SWCS/fancybox/source/helpers/jquery.fancybox-buttons.js"></script>
        <script type="text/javascript" src="/SWCS/frontoffice/themes/SWCS/fancybox/source/helpers/jquery.fancybox-media.js"></script>
        <link rel="stylesheet" href="/SWCS/frontoffice/themes/SWCS/fancybox/source/helpers/jquery.fancybox-thumbs.css" type="text/css" media="screen" />
        <script type="text/javascript" src="/SWCS/frontoffice/themes/SWCS/fancybox/source/helpers/jquery.fancybox-thumbs.js"></script>

        <!-- Optional, Add mousewheel effect -->
        <script type="text/javascript" src="/SWCS/frontoffice/themes/SWCS/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>  

        <style type="text/css">
        	fieldset {
        	    padding-top:10px;
        	    border:1px solid #666;
        	    border-radius:4px;
        	    padding-left: 20px;
        	    padding-right: 20px;
        	    padding-bottom: 20px;
        	}
        	#heading{
        		background-color: #006699;
        		text-align: center;
        		color:#fff;
        		padding-top: 7px;
        		padding-bottom: 7px;
        		margin-bottom: 20px;
        	}
        </style>

    <body>
    	<div class="container">
    	    <div class="row">
    	        <div class="container">
    	          <fieldset>
    	            <div class="panel panel-login">
    	                <div class="panel-heading">
    	                	<div class="row">
    	                	    <div class="col-xs-12"></div>
    	                	    <div class="col-xs-12-">
    	                	        <?php
    	                	        foreach (Yii::app()->user->getFlashes() as $key => $message) {
    	                	            echo '<font color="red"><center><div class="alert-message error"><p>' . $message . "</center></font></p></div>\n";
    	                	        }
    	                	        ?>
    	                	    </div>
    	                	</div>
    	                	<!-- <div class="row">
    	                	
    	                	    <div class="col-xs-6 col-md-4">
    	                	        	<a href="#" class="active" id="login-form-link">Login</a>
    	                	    </div>
    	                	
    	                	    <div class="col-xs-12 col-sm-6 col-md-8">
    	                	        	<a href="#" id="register-form-link">Register</a>
    	                	    </div>
    	                	</div>
    	                	<hr> -->
    	                </div>
    	                <div class="panel-body">
    	                    <div class="row">
    	                        <div class="col-xs-6 col-md-4">
    	                          <fieldset>
    	                           <div id="heading"> Login with your Credentials </div>
    	                            <form id="login-form" action="<?= $this->createUrl('/signup') ?>" method="post" role="form" style="display: block;">

    	                                <input type="hidden" name="CALL_BACK_URL" value="<?= $CALL_BACK_URL ?>" />

    	                                <div class="form-group">
    	                                    <input type="text" required="required" name="username" class="form-control" id="exampleInputEmail1" placeholder="IUID / Email-ID">
    	                                </div>
    	                                <div class="form-group">
    	                                    <input type="password" required="required" name="passwd" class="form-control" id="exampleInputPassword1" placeholder="Password">
    	                                </div>

    	                                <center>
    	                                    <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="btn btn-info btn-block" value="Log In">
    	                                </center>
    	                                <input type="hidden" name="CALL_BACK_URL" value="<?= $CALL_BACK_URL ?>" />
    	                                <input type="hidden" name="callback_failure_url" value="<?= $callback_failure_url ?>" />
    	                                <input type="hidden" name="callback_success_url" value="<?= $callback_success_url ?>" />
    	                            </form>
    	                           </fieldset>
    	                        </div>
    	                        <div class="col-xs-12 col-sm-6 col-md-8">
    	                            <form action="<?= $this->createUrl('/signup') ?>" method="post" id="register-form" >

    	                                <input type="hidden" name="CALL_BACK_URL" value="<?= $CALL_BACK_URL ?>" />
    	                                <input type="hidden" name="CALLBACK_FAILURE_URL" value="<?= $CALL_BACK_URL ?>" />
    	                                <input type="hidden" name="CALLBACK_SUCCESS_URL" value="<?= $CALL_BACK_URL ?>" />
    	                                <fieldset>
    	                                    <div id="heading"> Entrepreneur Registration </div>
    	                                    
    	                                    <div class="row"> 
    	                                    	<div class="col-xs-8 col-sm-6">
    	                                    		<div class="form-group">
    	                                        		<input type="text" required="required" id="fname" class="form-control" name="First Name" placeholder="First Name">
    	                                       		 </div>
    	                                        </div>
    	                                        <div class="col-xs-4 col-sm-6">
    	                                        	<div class="form-group">
    	                                        		<input type="text" required="required" id="lname" class="form-control" name="Last Name" placeholder="Last Name">
    	                                       		 </div>
    	                                    	</div>
    	                                    </div>
    	                                   <div class="row"> 
    	                                    	<div class="col-xs-8 col-sm-6">
    	                                   			 <div class="form-group">
    	                                        		<input type="text" id="pan" required="required" class="form-control" name="PAN" placeholder="PAN Card No">
    	                                        	 </div>
    	                                    	</div>
    	                                    <div class="col-xs-4 col-sm-6">
    	                                    	<div class="form-group">
    	                                        	<input type="text" id="uid" required="required" class="form-control" name="Adhaar" maxlength="12" placeholder="Adhaar No">
    	                                         </div>
    	                                    </div>
    	                                  </div>
    	                                <div id="heading"> Contact Details </div>
    	                                <div class="row"> 
    	                                <div class="col-xs-4 col-sm-6">
    	                                    <div class="form-group">
    	                                        <textarea name="address" type="text" id="addr" required="required" class="form-control"  placeholder="Address"></textarea>
    	                                         </div>
    	                                    </div>
    	                                   <div class="col-xs-4 col-sm-6">
    	                                    <div class="form-group">
    	                                        <input type="text" required="required" class="form-control" name="City" placeholder="City Name">
    	                                         </div>
    	                                    </div>
    	                                    </div>
    	                                    <div class="row"> 
    	                                   <div class="col-xs-4 col-sm-6">
    	                                    <div class="form-group">
    	                                        <input type="text" required="required" class="form-control" name="District" placeholder="District Name">
    	                                         </div>
    	                                    </div>

    	                                    <div class="col-xs-4 col-sm-6">
    	                                    <div class="form-group">
    	                                        <input type="text" required="required" class="form-control" name="State" placeholder="State Name">
    	                                         </div>
    	                                    </div>
    	                                     </div>
    	                                    <div class="row">
    	                                    <div class="col-xs-4 col-sm-6">
    	                                    <div class="form-group">
    	                                        <input type="text" required="required" class="form-control" name="Country" placeholder="Country Name">
    	                                         </div>
    	                                    </div>
    	                                    <div class="col-xs-4 col-sm-6">
    	                                    <div class="form-group">
    	                                        <input type="text" required="required" class="form-control" name="PIN" placeholder="PIN Code">
    	                                         </div>
    	                                    </div>
    	                                     </div>
    	                                    <div class="row">
    	                                    <div class="col-xs-4 col-sm-6">
    	                                    <div class="form-group">
    	                                        <input type="text" required="required" class="form-control" id="mobileNo" name="mobile" placeholder="Mobile Number">
    	                                         </div>
    	                                    </div>
    	                                    <div class="col-xs-4 col-sm-6">
    	                                    <div class="form-group">
    	                                        <input type="text" required="required" class="form-control" name="email" placeholder="E-mail Address">
    	                                         </div>
    	                                    </div>
    	                                    </div>
    	                                     <div id="heading"> Login Details </div>
    	                                     <div class="row">
    	                                    <div class="col-xs-4 col-sm-6">
    	                                    <div class="form-group">
    	                                        <label>Password</label>
    	                                        <input type="text" required="required" class="form-control" name="password1" placeholder="Password">
    	                                    </div>
    	                                    </div>
    	                                    <div class="col-xs-4 col-sm-6">
    	                                    <div class="form-group">
    	                                        <label>Confirm Password</label>
    	                                        <input type="text" required="required" class="form-control" name="password2" placeholder="Confirm Password">
    	                                    </div>
    	                                    </div>
    	                                    </div>
    	                                  <!--  <div class="form-group">
                                            <div id="captcha"><center>&nbsp;</center></div>
                                            <div id="recaptcha_image"></div>
                                            <div class="recaptcha_only_if_incorrect_sol" style="color:red">Incorrect please try again</div>
                                            <label class="solution"> <span class="recaptcha_only_if_image">Type the text:</span> <span class="recaptcha_only_if_audio">Enter the numbers you hear:</span>
                                                <input type="text" id="recaptcha_response_field" name="recaptcha_response_field" />
                                            </label>
                                            <div class="options">
                                                <a href="javascript:Recaptcha.reload()" id="icon-reload">Get another CAPTCHA</a>
                                                <a class="recaptcha_only_if_image_" href="javascript:Recaptcha.switch_type('audio')" id="icon-audio">Get an audio CAPTCHA</a>
                                                <a class="recaptcha_only_if_audio_" href="javascript:Recaptcha.switch_type('image')" id="icon-image">Get an image CAPTCHA</a>
                                                <a href="javascript:Recaptcha.showhelp()" id="icon-help">Help</a>
                                            </div>

                                        </div> -->

                                        <script type="text/javascript" src="http://www.google.com/recaptcha/api/challenge?k=<?= SSO_PUBLIC_KEY ?>"></script>
                                        <div class="row">
    	                                    <div class="form-group">
                                        <noscript>
                                        <iframe src="http://www.google.com/recaptcha/api/noscript?k=<?= SSO_PUBLIC_KEY ?>"
                                                height="300" width="100%" frameborder="0"></iframe>
                                        <br>
                                        <textarea name="recaptcha_challenge_field" rows="3" cols="40" required="required"></textarea>
                                        <input type="hidden" name="recaptcha_response_field"
                                               value="manual_challenge">
                                        </noscript>
                                        </div>
										</div>
                                        	<div class="row">
                                        	<div class="col-xs-4 col-sm-6">
                                        		<input type="reset" name="Cancel" class="btn btn-info btn-block" value="Cancel">
                                        	</div>
                                        	<div class="col-xs-4 col-sm-6">
                                            <input type="submit" name="login-submit" id="register-form-link" tabindex="4" class="btn btn-info btn-block" value="Register" style="display:none">
                                            <p class="h"><a id="otpverify" class='btn btn-info btn-block' title="Login" href="#login_form">Try now</a></p></p>

                                            <!-- <a href='#login_form' class='fancybox btn btn-info btn-block' id="otpverify" data-fancybox-type='iframe'>Confirm</a> -->
                                            </div>
                                            </div>
    	                                </fieldset>
    	                            </form>
    	                        </div>
    	                    </div>
    	                </div>
    	            </div>
    	          </fieldset>
    	        </div>
    	    </div>
    	</div>
    	<!-- custom forms -->


    	<div id="successhide" style="display:none">
			<form id="login_form">
	    	<p id="login_error">Please, enter data</p>
		<p>
			<label for="login_pass">OTP: </label>
			<input type="password" id="login_pass" name="login_pass" size="30" />
		</p>
		<p>
			<input type="submit" value="Verify OTP" />
		</p>
		</form>
	</div>
    <script type="text/javascript">
    	$("#otpverify").fancybox({
	'scrolling'		: 'no',
	'titleShow'		: false,
	'onClosed'		: function() {
	    $("#login_error").hide();
	}
  });
    	</script>
    	<script type="text/javascript">
    		$("#login_form").bind("submit", function(test){
    			var mob=$("#mobileNo").val();
    			var otp=$("#login_pass").val();
    			if ($("#login_pass").val().length < 4) {
    			    $("#login_error").show();
    			   /* $.fancybox.resize();*/
    			    return false;
    			}


    			/*$.fancybox.showActivity();*/
    			
    			/*getvalues();*/

    			var data="mobile="+mob+"&otp="+otp;
    			var posturl=window.location.href.split("one");
    			posturl=posturl[0]+ "otpverify";
    			console.log(posturl);
    			console.log(data);
    			$.ajax({
    				type	: "post",
    				cache	: false,
    				url		: posturl,
    				data		: data,
    				success: function(data) {
    					if(data==="SUCCESS"){
    						$("#successhide").hide();
    						$("#otpverify").hide();
    						$("#register-form-link").show();
    						console.log("hur hur");
    					}
    				}
    			});

    			return false;
    		});

    	</script>
    </body>

