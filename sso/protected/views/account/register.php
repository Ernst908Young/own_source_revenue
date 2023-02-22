<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/font-awesome.min.css" rel="stylesheet">
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/login.css" type="text/css" />
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/login-form.css" type="text/css" />
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/bootstrap/validate.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/bootstrap/bootstrap.tooltip.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/bootstrap/customvalidation.js"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/fancybox/jquery.fancybox.pack.js"></script>
<!-- Optional, Add fancyBox for media, buttons, thumbs -->
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/fancybox/jquery.fancybox-buttons.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/fancybox/jquery.fancybox-buttons.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/fancybox/jquery.fancybox-media.js"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/fancybox/jquery.fancybox-thumbs.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/fancybox/jquery.fancybox-thumbs.js"></script>
<!-- Optional, Add mousewheel effect -->
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/fancybox/jquery.mousewheel-3.0.6.pack.js"></script>  
<style type="text/css">
   input[type=number]::-webkit-inner-spin-button, 
   input[type=number]::-webkit-outer-spin-button { 
   -webkit-appearance: none; 
   margin: 0; 
   }
   .body-s {
   max-width: 55%;
   }

   fieldset {
   display: block;   
   padding: 25px 30px 5px;
   border: none;
   background: rgba(255,255,255,9);
}
form
{
background-color: #58ACFA;
}
   label.valid {
   width: 24px;
   height: 24px;
   background: url(valid.png) center center no-repeat;
   display: inline-block;
   text-indent: -9999px;
   }
   label.error {
   font-weight: bold;
   color: red;
   padding: 2px 8px;
   margin-top: 2px;
   }
   button,input,optgroup,select,textarea{color:inherit;font:inherit;margin:0}button{overflow:visible}button,select{text-transform:none}button,html input[type=button],input[type=reset],input[type=submit]{-webkit-appearance:button;cursor:pointer}button[disabled],html input[disabled]{cursor:default}button::-moz-focus-inner,input::-moz-focus-inner{border:0;padding:0}input{line-height:normal}.validation-form-container{position:relative;background-color:#fff;font-family:"Helvetica Neue",Helvetica,Arial;color:rgba(0,0,0,.7);font-size:16px;padding:16px;width:100%;max-width:500px;border-radius:4px;-webkit-box-shadow:0 0 0 1px rgba(0,0,0,.1) inset;box-shadow:0 0 0 1px rgba(0,0,0,.1) inset;line-height:16px}.validation-form-container *{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}.validation-form-container :last-child{margin-bottom:0}.validation-form-container .field{clear:both;margin:0 0 1em}.validation-form-container ul{list-style:none;margin:.2em 0;padding:0}.validation-form-container .ui.loader.active{display:block}.validation-form-container .ui.loader{width:32px;height:32px;background:url(loader-medium.gif) 48% 0 no-repeat;display:none;position:absolute;top:50%;left:50%;margin:0;z-index:1000;-webkit-transform:translateX(-50%) translateY(-50%);-ms-transform:translateX(-50%) translateY(-50%);transform:translateX(-50%) translateY(-50%)}.validation-form-container .ui.button{cursor:pointer;display:inline-block;min-height:1em;outline:0;border:none;background-color:#FAFAFA;color:grey;margin:0;padding:.8em 1.5em;font-size:1rem;text-transform:uppercase;line-height:1;font-weight:700;font-style:normal;text-align:center;text-decoration:none;background-image:-webkit-gradient(linear,left top,left bottom,from(rgba(0,0,0,0)),to(rgba(0,0,0,.05)));background-image:-webkit-linear-gradient(rgba(0,0,0,0),rgba(0,0,0,.05));background-image:linear-gradient(rgba(0,0,0,0),rgba(0,0,0,.05));border-radius:.25em;-webkit-box-shadow:0 0 0 1px rgba(0,0,0,.08) inset;box-shadow:0 0 0 1px rgba(0,0,0,.08) inset;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;box-sizing:border-box;-webkit-tap-highlight-color:transparent;-webkit-transition:opacity .25s ease,background-color .25s ease,color .25s ease,background .25s ease,-webkit-box-shadow .25s ease;transition:opacity .25s ease,background-color .25s ease,color .25s ease,background .25s ease,box-shadow .25s ease}.validation-form-container .ui.button,.validation-form-container .ui.label{vertical-align:middle;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;-ms-box-sizing:border-box}.validation-form-container .ui.blue.button{background-color:#6ECFF5;color:#FFF}.validation-form-container .ui.blue.button.active,.validation-form-container .ui.blue.button:hover{background-color:#1AB8F3;color:#FFF}.validation-form-container .ui.blue.button:active{background-color:#0AA5DF;color:#FFF}.validation-form-container .ui.mini.button{font-size:.8rem;padding:.6em .8em}.validation-form-container .ui.basic.button{background-color:transparent!important;background-image:none;color:grey!important;font-weight:400;text-transform:none;-webkit-box-shadow:0 0 0 1px rgba(0,0,0,.1) inset;box-shadow:0 0 0 1px rgba(0,0,0,.1) inset}.validation-form-container .ui.input{width:100%;font-size:1em;display:inline-block;position:relative;color:rgba(0,0,0,.7)}.validation-form-container .ui.labeled.input input{padding-right:2.5em!important}.validation-form-container input[type=text],.validation-form-container input[type=password],.validation-form-container textarea{width:100%;margin:0;padding:.65em 1em;font-size:1em;background-color:#FFF;border:1px solid rgba(0,0,0,.15);outline:0;color:rgba(0,0,0,.7);border-radius:.3125em;-webkit-transition:background-color .3s ease-out,-webkit-box-shadow .2s ease,border-color .2s ease;transition:background-color .3s ease-out,box-shadow .2s ease,border-color .2s ease;-webkit-box-shadow:0 0 0 0 rgba(0,0,0,.3) inset;box-shadow:0 0 0 0 rgba(0,0,0,.3) inset;-webkit-appearance:none;-webkit-tap-highlight-color:rgba(255,255,255,0)}.validation-form-container input[type=text]:focus,.validation-form-container input[type=password]:focus,.validation-form-container textarea:focus{color:rgba(0,0,0,.85);border-color:rgba(0,0,0,.2);border-bottom-left-radius:0;border-top-left-radius:0;-webkit-appearance:none;-webkit-box-shadow:.3em 0 0 0 rgba(0,0,0,.2) inset;box-shadow:.3em 0 0 0 rgba(0,0,0,.2) inset}.validation-form-container input[disabled],.validation-form-container input[readonly],.validation-form-container textarea[disabled],.validation-form-container textarea[readonly]{cursor:not-allowed;background-color:#f7f7f7;color:#999}.validation-form-container .field>label{margin:0 0 .3em;display:block;color:#555;font-size:.875em;position:relative}.validation-form-container .ui.label{display:inline-block;margin:-.25em .25em 0;background-color:#E8E8E8;border-color:#E8E8E8;padding:.5em .8em;color:rgba(0,0,0,.65);text-transform:uppercase;font-weight:400;border-radius:.325em;box-sizing:border-box;-webkit-transition:background .1s linear;transition:background .1s linear}.validation-form-container .ui.corner.label{top:1px;right:1px;overflow:hidden;font-size:.7em;border-radius:0 .3125em;background-color:transparent;position:absolute;z-index:10;margin:0;width:3em;height:3em;padding:0;text-align:center;-webkit-transition:color .2s ease;transition:color .2s ease}.validation-form-container .ui.corner.label:after{position:absolute;content:"";right:0;top:0;z-index:-1;width:0;height:0;border-top:0 solid transparent;border-right:3em solid transparent;border-bottom:3em solid transparent;border-left:0 solid transparent;border-right-color:inherit;-webkit-transition:border-color .2s ease;transition:border-color .2s ease}.validation-form-container .ui.corner.label .icon{font-size:2em;margin:.25em 0 0 .5em;width:auto;display:inline-block;height:1em;font-style:normal;line-height:1;font-weight:400;text-decoration:inherit;text-align:center;speak:none;-webkit-font-smoothing:antialiased;-moz-font-smoothing:antialiased;font-smoothing:antialiased}div.error,div.error-list,input.error,label.error,select.error,textarea.error{color:#D95C5C!important;border-color:#D95C5C!important}.validation-form-container .error .corner.label{border-color:#D95C5C;color:#FFF}
</style>
<div id="preloader">
   <div id="status">&nbsp;</div>
</div>
<div class="body body-s">
<?php
   if (!empty($error)) {
       echo "<font color='red'>$error</font>";
   } else {
       ?>             
<?php extract($_POST); ?>
<form id="register-form" name="register-form" action="" method="post" role="form" data-toggle="validator" class="sky-form">
   <input type="hidden" name="CALL_BACK_URL" value="<?php echo $CALL_BACK_URL; ?>" />
   <input type="hidden" name="callback_failure_url" value="<?php echo $callback_failure_url; ?>" />
   <input type="hidden" name="callback_success_url" value="<?php echo $callback_success_url; ?>" />
   <header><b>Investor Registration Forms</b></header>
   <fieldset>
      <section> 
         <?php
            foreach (Yii::app()->user->getFlashes() as $key => $message) {
                echo '<font color="red"><center><div class="alert-message error"><p>' . $message . "</center></font></p></div>\n";
            }
            ?> 
      </section>
       <section>
         <div class="form-control-group">
         <label class="control-label">User Type</label>
            <label class="input">
               <i class="icon-append icon-user"></i>
               <div class="controls">
                 <label class="radio-inline"><input type="radio" name="optradio" checked>Individual</label>
<label class="radio-inline"><input type="radio" name="optradio">Service Provider</label>
               </div>
            </label>
         </div>
      </section>
      <section>
         <div class="form-control-group">
         <label class="control-label">Enter Email-ID</label>
            <label class="input">
               <i class="icon-append icon-envelope-alt"></i>
               <div class="controls">
                  <input type="text" required="required" class="form-control email_check" name="email" required="required" maxlength="150" id="email" type="email" placeholder="E-mail Address">
                  <b class="tooltip tooltip-bottom-right">Valid Email Id e.g mail@email.com.</b>
               </div>
            </label>
         </div>
      </section>
      <section>
         <div class="form-control-group">
         <label class="control-label">Choose Password</label>
            <label class="input">
               <i class="icon-append icon-lock"></i>
               <div class="controls">
                  <input type="password" required="required" class="form-control" name="password1" id="password1" placeholder="Password">
                  <b class="tooltip tooltip-bottom-right">Password must contain 1 Capital Letter, 1 Number and 1 Special Character.</b>
               </div>
            </label>
         </div>
      </section>
      <section>
         <div class="form-control-group">
         <label class="control-label">Re-type Password</label>
            <label class="input">
               <i class="icon-append icon-lock"></i>
               <div class="controls">
                  <input type="password" required="required" class="form-control" id="password2" name="password2" placeholder="Confirm Password">
                  <b class="tooltip tooltip-bottom-right">Same as you entered above</b>
               </div>
            </label>
         </div>
      </section>
   </fieldset>
   <fieldset>
      <div class="row">
         <section class="col col-6">
            <div class="form-control-group">
            <label class="control-label">Enter First Name</label>
               <label class="input">
                  <div class="controls">
                    <input type="text" required="required" id="fname" class="form-control" name="First_Name" maxlength="20" placeholder="First Name">
                     <b class="tooltip tooltip-bottom-right">Contains only Letters.</b>
                  </div>
               </label>
            </div>
         </section>
         <section class="col col-6">
         <label class="control-label">Enter Last Name</label>
            <label class="input">
            <input type="text" required="required" id="lname" class="form-control" name="Last_Name" maxlength="20" placeholder="Last Name">
               <b class="tooltip tooltip-bottom-right">Contains only Letters.</b>

            </label>
         </section>
      </div>
      <div class="row">
         <section class="col col-6">
            <div class="form-control-group">
            <label class="control-label">Enter PAN</label>
               <label class="input">
                  <div class="controls">    <input type="text" id="pan"  class="form-control" name="PAN" maxlength="10" placeholder="PAN Card No">
                         <b class="tooltip tooltip-bottom-right">10 Digit Alphanumeric.</b>

                  </div>
               </label>
            </div>
         </section>
         <section class="col col-6">
            <div class="form-control-group">
            <label class="control-label">Enter Aadhaar</label>
               <label class="input">
                  <div class="controls">  <input type="text" id="uid" class="form-control" name="Adhaar" maxlength="12" placeholder="Adhaar No">
                        <b class="tooltip tooltip-bottom-right">12 Digit Numeric only.</b>
                  </div>
               </label>
            </div>
         </section>
      </div>
      <section>
         <div class="form-control-group">
         <label class="control-label">Enter Address</label>
            <label class="input">
               <div class="controls">
                  <input type="text" id="address" class="form-control" name="address" maxlength="150" placeholder="Addess">
                   <b class="tooltip tooltip-bottom-right">Minimum 10 Alpha numeric character. Only space,comma,\/, # character allowed</b>
               </div>
            </label>
         </div>
      </section>
      <section>
         <div class="form-control-group">
         <label class="control-label">Select Country</label>
            <label class="select">
               <div class="controls">
                  <?php
                     if (isset($countries)) {
                         echo "<select id='country' name='country'>";
                         echo "<option value='0' selected disabled>Country</option>";
                         foreach ($countries as $country)
                             echo "<option value='$country->lr_id'>$country->lr_name</option>";
                         echo "</select>";
                         echo "<i></i>";
                     } else {
                         echo"<input type='text' name='country' id='country' placeholder='Pleas Enter your country'";
                     }
                     ?>
               </div>
            </label>
         </div>
      </section>
      <section>
         <div class="form-control-group">
         <label class="control-label">Select State</label>
            <label class="select">
               <div class="controls">
                  <select required="required" id="state" name="state">
                  	<option value="0" selected disabled>State</option>
		  </select>
                  <i></i>
               </div>
            </label>
         </div>
      </section>
      <div class="row">
         <section class="col col-6" >
            <div class="form-control-group">
            <label class="control-label">Enter City</label>
               <label class="input">
                  <div class="controls">     <input type="text" required="required" id="city" class="form-control" name="City" maxlength="20" placeholder="City Name">
                   <b class="tooltip tooltip-bottom-right">Letters Only.</b>

                  </div>
               </label>
            </div>
         </section>
         <section class="col col-6">
            <div class="form-control-group">
            <label class="control-label">Enter District</label>
               <label class="input">
                  <div class="controls">      <input type="text" required="required" id="distt" class="form-control" name="District" maxlength="20" placeholder="District Name">
                   <b class="tooltip tooltip-bottom-right">Letters Only.</b>

                  </div>
               </label>
            </div>
         </section>
      </div>
      <div class="row">
         <section class="col col-6">
            <div class="form-control-group">
            <label class="control-label">Enter Pin Code</label>
               <label class="input">
                  <div class="controls"> <input type="text"  id="pin" style="-webkit-appearance: none;margin: 0;" class="form-control" name="PIN" maxlength="7" placeholder="PIN Code">
                   <b class="tooltip tooltip-bottom-right">6 or 7 digit Pin number.</b>
                  
                  </div>
               </label>
            </div>
         </section>
         <section class="col col-6">
            <div class="form-control-group">
            <label class="control-label">Enter Mobile</label>
               <label class="input">
                  <div class="controls">  <input type="text" style="-webkit-appearance: none;margin: 0;" class="form-control" id="mobileNo" name="mobile" maxlength="10" placeholder="Mobile Number">
                   <b class="tooltip tooltip-bottom-right">10 Digita mobile number without country code.</b>
                  
                  </div>
               </label>
            </div>
         </section>
      </div>
      <div class="row">
      <section class="col col-6">
            <div class="form-group">
               </div>
            </div>
      </section>
      
      <div class="row">
      <section class="col col-6"> 
      <p id="registration-error" style="color:red"></p>
      </section>
      </div>
   </fieldset>
   <footer>
    <div class="register_disabled"><p class="h"><a id="otpverify" class='button' title="Register" href="#login_form">Register</a></p></div>
</form>
</footer>
</div>
<!-- custom forms -->
<div id="successhide" style="display:none">
   <form id="login_form">
      <p id="login_error"></p>
      <p>
         <label for="login_pass" >
      <p id="otplable"> OTP: </p></label>
      <input type="text" id="login_pass" name="login_pass" size="30" />
      </p>
      <p>
         <input type="submit" id="otpsubmit" value="Verify OTP" />
      </p>
   </form>
   <style type="text/css">#login_error{color:red;}</style>
</div>
<?php
   }?>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/register.js"></script>
<script type="text/javascript">
   $(document).ready(function() { // makes sure the whole site is loaded
       $('#status').fadeOut(); // will first fade out the loading animation
       $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
       $('body').delay(350).css({'overflow':'visible'});
   });
</script>
