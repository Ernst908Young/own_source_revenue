<!-- <link rel="stylesheet" href="<1?= Yii::app()->baseUrl ?>/themes/investuk/assets/frontend/dashboard/css/plugins/select2/select2.css">

<script src="<1?= Yii::app()->baseUrl ?>/themes/investuk/assets/frontend/dashboard/js/plugins/select2/select2.min.js"></script> -->
<style type="text/css">
  .form-part.bussiness-det .form-group > div {
    margin-bottom: 0px;
}
.form-control-feedback{
  color: red;
}
.select-box:after {
    border: 0;
}

    .captchainput{
        width:25px;
        border:0;
        background-color: transparent;
    margin-top: 15px;
    }

    .captchainput:focus{
        box-shadow: 0 !important;
        outline: none;
    }
    #captcharesult_onrq{
    display: none;
  }
  
  /* Chrome, Safari, Edge, Opera */
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }

</style>


<div class="dashboard-home">
    <div class="applied-status">
    	<ul class="breadcrumb">
          <?php if(isset($_SESSION['RESPONSE']['user_id'])){?> <li><a href="/backoffice/investor/home/investorWalkthrough">Home</a></li><?php } else{?><li><a href="">Home</a></li>
		  <?php }?>
          <?php if(isset($_SESSION['RESPONSE']['user_id'])){?><li><a href="/backoffice/investor/services/ticketquery/tq">Ticket & Query</a></li>
          <li>Your Query Details</li><?php } else{ ?><li>Query</li><?php }?>
          </ul>
        <div class="status-title d-flex flex-wrap align-items-center justify-content-between">
           <h4>Welcome to Digital Corporate Registry System</h4>
            <div class="serach-bar">
               
            </div>
        </div>
             </div>
        </div>
		<div class="m-wizard m-wizard--3 m-wizard--success" id="m_wizard">
        <div class="reservation-form"> 

<?php if(!isset($_SESSION['RESPONSE']['user_id'])){ ?>
<?php $this->renderPartial('_unreg_search'); ?>
<?php } ?>

				<form id="query_form" method="post" action="<?php echo Yii::app()->createAbsoluteUrl("/queries/default/index"); ?>" enctype="multipart/form-data">
<?php if(!isset($_SESSION['RESPONSE']['user_id'])){ 
	$readonly = $mobile_no = $email = '';
	$name='';
 }else{
 	$readonly = 'readonly=true';
 	$user = Yii::app()->db->createCommand("SELECT sso_users.mobile_no,sso_users.email,sso_profiles.first_name,sso_profiles.last_name,sso_profiles.surname FROM sso_users left join sso_profiles on sso_users.user_id=sso_profiles.user_id WHERE sso_users.user_id=".$_SESSION['RESPONSE']['user_id'])->queryRow();
 	$mobile_no = $user['mobile_no'];
 	 $email = $user['email'];
 	 $name = $user['first_name'];
	 if( $user['last_name']!=""){
		  $name.=" ".$user['last_name'];
	 }
	  $name.=" ".$user['surname'];
 } ?>
<?php if(!isset($_SESSION['RESPONSE']['user_id'])){ ?>
<input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>"/>
<?php } ?>

 <div class="form-part bussiness-det">   
        <h4 class="form-heading">Raise a New Query</h4>
	<div class="form-row row">
		<div class="col-md-6 form-group text-start mb-3">
	   		<label >Name <span style="color: red;">*</span></label>
	   		<input type="text" id="name" value="<?php echo $name; ?>" name="name" class="form-control" placeholder="Enter your Name"  required maxlength="100">
	   	</div>
		
	   	<div class="col-md-6 form-group text-start mb-3">
	   		<label >Mobile Number <span style="color: red;">*</span></label>
	   		<input type="text" id="mobileno" value="<?php echo $mobile_no; ?>" name="mobile_no" class="form-control" placeholder="Enter your Mobile Number" <?php echo $readonly; ?>  required maxlength="20">
	   	</div>
	   	<div class="col-md-6 form-group text-start mb-3">
	   		<label >Email<span style="color: red;">*</span></label>
	   		<input type="text" name="email" id="usermail" value="<?php echo $email; ?>"   class="form-control" placeholder="Enter your Email" <?php echo $readonly; ?> required>
	   		<span id='usermailerror'></span>
	   	</div>
		
		   <div class="col-md-6 form-group text-start mb-3">
                 
				 <label>Query Type <span style="color: red;">*</span></label>
				<?php
					$type = array('Functional'=>'Functional','Technical'=>'Technical','Others'=>'Others');
				?>
	  
				<select name="type" placeholder="Select type" id="type" class="select2-me"   required>
				 <option value="">Select Your Query Type </option>
					 <?php foreach ($type as $key => $val) { ?>
					 <option value="<?php echo $key; ?>" ><?php echo $val; ?></option>
				 <?php } ?>
			 </select> 
		 
			 <span id="type-error" style="color: red;"></span>	 
 </div>
	
	     

		   <div class="col-md-6 form-group text-start mb-3" id="div_cat_select">
                   
				   <label>Service Category </label>	   	
	
				  <select name="servicecategory" placeholder="Select service category" id="servicecategory" class="select2-me"  onchange="getservices($(this).val())" >
				   <option value="">Select Service Category </option>
					   <?php 
				   $service_category =array_merge($service_category,array(array('id'=>'0','category_name'=>'Others')));
					   foreach ($service_category as $key => $val) { ?>
					   <option value="<?php echo $val['id']; ?>" ><?php echo $val['category_name']; ?></option>
				   <?php } ?>
			   </select>  
	   
			   <span id="category-error" style="color: red;"></span>
	 
		  </div> 
	   	
	  	
		   <div class="col-md-6 form-group" id="div_ser_select">
   
        <label>Service Name </label>
        	<div class="select-box"> 
				<select name="service_id" class="select2-me"  placeholder="Select service" id="service_id" style="appearance:none !important; width:100%;">
					<option value="">Select Service Name</option>	
				</select>
			</div>
			<span id="services-error" style="color: red;"></span> 

</div>
	   <div class="col-lg-12 form-group text-start mb-3">
	   		<label >Subject <span style="color: red;">*</span></label>
	   		<input type="text" name="subject" class="form-control" placeholder="Enter Subject of Query" required maxlength="300" onkeyup="countChars(this,'charNumSubject',300);">
	   		 <small style="display:none;"><span id="charNumSubject">300</span>/300 characters remaining</small> 
	   		
	   	</div>
	   	<div class="col-lg-12 form-group text-start mb-3">
	   		<label >Message <span style="color: red;">*</span></label>
	   	     <textarea name="message" id="message" placeholder="Enter your Message here" rows='12' class="form-control" required maxlength="1000" onkeyup="countChars(this,'charNumMessage',1000);"></textarea>
	   	     <small style="display:none;"><span id="charNumMessage">1000</span>/1000 characters remaining</small> 
	   	     <!-- <small><span id="messageword">1000</span> Characters </small> -->
	   	</div>

<?php if(!isset($_SESSION['RESPONSE']['user_id'])){ 

	 $random_num    = md5(random_bytes(64));
  $captcha_code  = substr($random_num, 0, 6);
  // Assign captcha in session
  $_SESSION['CAPTCHA_CODE'] = $captcha_code;
	?>

	

<div class="form-group col-6">
    <label>Enter Captcha <span style="color: red;">*</span></label>
    <input type="text" class="form-control" name="captcha" id="captcha_onrq" required>
    <span id="captchaerror_onrq" style="color:red"></span>
		 <span id="captchasuccess_onrq" style="color:green"></span> 
</div>
<div class="form-group col-6">
    <label>Captcha Code</label>          
    <div style="background-color: #ef7b20; color: #0f6fb5; height: 35px; border-radius: 5px; padding: 5px; font-size: 18px; text-align: center; width: 100%;">
  		<strong><span id="captcha_img_text"><?= $captcha_code ?></span></strong>
	</div>
</div>

<!-- <div class="form-group col-md-12">
    <p><b>Solve this captcha to register</b></p>
    <div class="d-flex justify-content-start">
       <div class="d-flex justify-content-start">
      <span class="captchainput" id="capnum1_onrq" name="capnum1_onrq"></span>
      <span class="captchainput" id="capsign_onrq" name="capsign_onrq" style="width:35px !important;">+</span>
      <span class="captchainput" id="capnum2_onrq"  name="capnum2_onrq"></span>
      <span class=""id="captcharesult_onrq"  name="captcharesult_onrq"></span>
     
      </div>
      <div class="d-flex justify-content-start">
        <p class="mt-3">=</p>
        <input class="form-control" type="text" value="" id="capnum3_onrq" name="capnum3_onrq" style="width:50px;margin-left:15px;">
        <a  class="mt-3 ml-3" href="javascript:void(0);" onclick="getCaptcha_onrq()">Refresh Captcha</a>
      </div>
         
    </div> <br>
    <span id="captchaerror_onrq" style="color:red"></span>
    <span id="captchasuccess_onrq" style="color:green"></span> 
    <input type="hidden" id="captcha_check" value="1"></span> 
  </div>  -->
  <input type="hidden" id="captcha_check" value="1"></span> 
<?php }else{ ?>
		<input type="hidden" id="captcha_check" value="0"></span>
<?php } ?>

	   </div>
	 
	   <div class="form-row row">
	   		<div class="form-group col-md-12" style="text-align: center;">
	   	     <a href="javascript:void(0);" class="submitForm custome-btn" data-wizard-action="submit">
            <span>
              <i class="fa fa-check"></i>
              &nbsp;&nbsp;
              <span>
                Submit
              </span>
            </span>                       
          </a>
	   	    </div>
	   </div>
					</div>
   </form>
		</div>	</div>	
					</div>


<script type="text/javascript">
	$(document).ready(function(){
		$("#mobileno").bind("keypress",function(){
	var regex=  new RegExp("^[0-9]*$"); 
	
	var maxLength = $(this).attr('maxlength');
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
	if (!regex.test(key)) {
		event.preventDefault();
		return false;
	}
	
	
});


	});

/*function getCaptcha_onrq(){
    var num1 = Math.floor((Math.random() * 30));
    var num2 = Math.floor((Math.random() * 10));
    var total = parseInt(num1) + parseInt(num2);
    $("#capnum1_onrq").html(num1);
    $("#capnum2_onrq").html(num2);
    $("#captcharesult_onrq").html(total);
    $("#capnum3_onrq").val("");  
 }

$(window).on( "load", function() {
        getCaptcha_onrq();   
    });

$("#capnum3_onrq").keyup(function() {
  var num1 = $("#capnum1_onrq").html();
  var num2 = $("#capnum2_onrq").html();
  var total = parseInt(num1) + parseInt(num2);
  var input = $(this).val();
  if (input == total) {
    $("#captchaerror_onrq").html("");
    $("#captchasuccess_onrq").html("Captcha verified successfully");
  }else{
    $("#captchaerror_onrq").html("Invalid Captcha");
    $("#captchasuccess_onrq").html("");
  }

});*/
	

/* 
 *Count character in text box 
 */
function countChars(obj,ID,count){
    var maxLength = count;
    var strLength = obj.value.length;
    var charRemain = (maxLength - strLength);
    
    if(charRemain < 0){
        document.getElementById(ID).innerHTML = '<span style="color: red; font-size: 16px;" >Maximum characters '+maxLength+' allowed</span>';
            obj.value = obj.value.substring(0, maxLength);
    }  else{
        document.getElementById(ID).innerHTML = charRemain;
    }
}
	function getservices(cat){
		if(cat=="" || cat=="Others"){
			$("#service_id").html("<option>-</option>");
		}else{
				$.ajax({
		            type: "POST",
		            dataType:'html',
		            url: "/backoffice/queries/default/getservices/category/" + cat,
		            beforeSend:function(){
		            /*	if ($("#UK-FCL-00129_0-error").length) {
					$("#UK-FCL-00129_0-error").text("Please enter the correct postal code");
    			}else{*/
    				$("#category-error").text("Please Wait...");
    				//$("#div_UK-FCL-00129_0").find('div').append('<div id="UK-FCL-00129_0-error" class="form-control-feedback">Please Wait...</div>');
    			//}	
		        	        	
		            },
		            success: function(result) {	       
						$("#category-error").text("");      
            		    $("#service_id").html(result);	
            		   // alert(result);	            	
		            			              
		            }
		        });
		}	
	}

	

	
</script>
<script src="/backoffice/themes/swcsNewTheme/fb/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script src="/backoffice/themes/swcsNewTheme/fb/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
<script src="/backoffice/themes/swcsNewTheme/fb/demo/default/custom/components/forms/wizard/querywizard.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/jquery-repeater/jquery.repeater.js" type="text/javascript">
</script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/pages/scripts/form-repeater.min.js" type="text/javascript">
</script>
<!-- form repeater js -->

<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/css/plugins/select2/select2.css">
<!-- select2 -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/plugins/select2/select2.min.js"></script>
<!-- Theme framework -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/eakroko.min.js"></script>


 
<!-- default icons used in the plugin are from Bootstrap 5.x icon library (which can be enabled by loading CSS below) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
 
<!-- alternatively you can use the font awesome icon library if using with `fas` theme (or Bootstrap 4.x) by uncommenting below. -->
<!-- link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" crossorigin="anonymous" -->
 
<!-- the fileinput plugin styling CSS file -->
<link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
 
<!-- if using RTL (Right-To-Left) orientation, load the RTL CSS file after fileinput.css by uncommenting below -->
<!-- link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/css/fileinput-rtl.min.css" media="all" rel="stylesheet" type="text/css" /-->
 
 
<!-- piexif.min.js is needed for auto orienting image files OR when restoring exif data in resized images and when you
    wish to resize images before upload. This must be loaded before fileinput.min.js -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/plugins/piexif.min.js" type="text/javascript"></script>
 
<!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview. 
    This must be loaded before fileinput.min.js -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/plugins/sortable.min.js" type="text/javascript"></script>
 
<!-- bootstrap.bundle.min.js below is needed if you wish to zoom and preview file content in a detail modal
    dialog. bootstrap 5.x or 4.x is supported. You can also use the bootstrap js 3.3.x versions. -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
 
<!-- the main fileinput plugin script JS file -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/fileinput.min.js"></script>
 
<!-- following theme script is needed to use the Font Awesome 5.x theme (`fas`). Uncomment if needed. -->
<!-- script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/themes/fas/theme.min.js"></script -->
 
<!-- optionally if you need translation for your language then include the locale file as mentioned below (replace LANG.js with your language locale) -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/locales/LANG.js"></script>





