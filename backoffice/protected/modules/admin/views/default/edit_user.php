<style>
.form-part .form-group > div.services {
    max-width: 100%;
    margin-bottom: 44px;
}
#div_error{text-align:center;}
.active-lnk{color:blue;}
ul.dashboard-menu > li a {
    padding: 0 15px 0 60px;
}
.flash-Error{color:red;}
input:disabled, input[readonly] {
    background-color: #e9ecef;
    opacity: 1;
}
</style>
<div class="dashboard-home">
	<div class="applied-status">
		<div class="status-title d-flex flex-wrap align-items-center justify-content-between">
		    
		</div>
	</div>
</div>
	<div style="text-align:center;font-size:16px;color:green;">
<?php
	foreach(Yii::app()->user->getFlashes() as $key => $message) {
		echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
	}
?>
</div>
<div id="div_error"></div>
<div class="m-wizard__form reservation-form" style="padding: 17px 33px 0px;">
<div class="m-wizard__form-step m-wizard__form-step--current" id="m_wizard_form_step_1">
<form id="adduser-form" method="post" data-toggle="validator" action="<?php echo Yii::app()->createAbsoluteUrl('admin/default/updateuser')?>" enctype="multipart/form-data" >
<input type="hidden" name="uid" id="uid" value="<?php echo $res['uid'];?>">
<div class="form-part bussiness-det">
<?php

		
	
		
	/*$sql1="SELECT 
	* from bo_user 
		where  
		bo_user.uid='".$_REQUEST['uid']."'";
		$connection=Yii::app()->db; 
		$command1=$connection->createCommand($sql1);
		$res = $command1->queryRow();*/

		?>

				 	<div>								<h4 class="form-heading">
							Update User						</h4>
					</div>
					<hr id="hr_UK-FCL-00150_0" style="height: 0px; margin: 0px;">
					<div class="form-row row">
			

				<div class="form-group col-md-6" >
					
					<label class="col-md-12 control-label text-left" >
						 First Name	<span style="color:red;">* </span>	</label>

					<div class="col-md-12">
					<input type="text" name="full_name" id="full_name" value="<?php echo $res['full_name'];?>">
					</div>
				</div>
				<div class="form-group col-md-6" >
					
					<label class="col-md-12 control-label text-left" >
						 Middle Name	<span style="color:red;">* </span></label>

					<div class="col-md-12">
					<input type="text" name="middle_name" id="middle_name"  value="<?php echo $res['middle_name'];?>" <?php if($res['middle_name']==""){?> readonly <?php }?>>
					<input type="checkbox" id="mnamechekbox" name="middlenamecheckbox"  <?php if($res['middle_name']==""){?> checked <?php }?> >
					<label for="middlenamecheckbox"> I don't have middle name</label><br>
						<span style="color:red" id="middlenameerror"></span>
					</div>
				</div>
			
				<div class="form-group col-md-6" >
					
					<label class="col-md-12 control-label text-left" >
						 Last Name	<span style="color:red;">* </span>	</label>

					<div class="col-md-12">
					<input type="text" name="last_name" id="last_name"  value="<?php echo $res['last_name'];?>">
					</div>
				</div>
				<div class="form-group col-md-6" >
					
					<label class="col-md-12 control-label text-left" >
						 Email<span style="color:red;">* </span></label>

					<div class="col-md-12">
					<input type="text" name="email" id="email" value="<?php echo $res['email'];?>">
					</div>
				</div>
				<!--<div class="form-group col-md-6" >
					
					<label class="col-md-12 control-label text-left" >
						 Password <span style="color:red;">* </span>	</label>

					<div class="col-md-12">
					<input type="password" name="password" id="password1" value="">
					</div>
				</div>
				<div class="form-group col-md-6" >
					
					<label class="col-md-12 control-label text-left" >
						 Confirm Password <span style="color:red;">* </span>	</label>

					<div class="col-md-12">
					<input type="password" name="cpassword" id="cpassword" value="">
					</div>
				</div>-->
				<div class="form-group col-md-6" >
					
					<label class="col-md-12 control-label text-left" >
						 Mobile </label>

					<div class="col-md-12">
					<input type="text" name="mobile" id="mobile"  value="<?php echo $res['mobile'];?>">
					</div>
				</div>
				
				<div class="form-group col-md-6" >
					
					<label class="col-md-12 control-label text-left" >
						 Fax </label>

					<div class="col-md-12">
					<input type="text" name="fax" id="fax" value="<?php echo $res['fax'];?>">
					</div>
				</div>
				<div class="form-group col-md-6" >
					
					<label class="col-md-12 control-label text-left" >
						 Delegate Officer No	</label>

					<div class="col-md-12">
					<input type="text" name="delegate_officer_number" id="delegate_officer_number" value="<?php echo $res['delegate_officer_number'];?>">
					</div>
				</div>
				<div class="form-group col-md-6" >
					
					<label class="col-md-12 control-label text-left" >
						 Delegate Officer Name	</label>

					<div class="col-md-12">
					<input type="text" name="delegate_officer_name" id="delegate_officer_name" value="<?php echo $res['delegate_officer_name'];?>">
					</div>
				</div>
					<div class="form-group col-md-6" >
					
					<label class="col-md-12 control-label text-left" >
						 Delegate Officer Email	</label>

					<div class="col-md-12">
					<input type="text" name="delegate_officer_email" id="delegate_officer_email" value="<?php echo $res['delegate_officer_email'];?>">
					</div>
				</div>
				<div class="form-group col-md-6" >
					
					<label class="col-md-12 control-label text-left" >
						 Office Number	</label>

					<div class="col-md-12">
					<input type="text" name="office_no" id="office_no" value="<?php echo $res['office_no'];?>">
					</div>
				</div>
			

				<div class="form-group col-md-6">
					
					<label class="col-md-12 control-label text-left" >
						 Active<span style="color:red;">* </span>	</label>

					<div class="col-md-12">
						<input type="radio" name="is_active" value="1" <?php if($res['is_active']==1){?>checked<?php }?>> <span>Yes</span> &nbsp; <input type="radio" name="is_active" value="0" <?php if($res['is_active']==0){?>checked<?php }?>> <span>No</span>
					</div>
				</div>
				
				<!--<div class="form-group col-md-6">
					
					<label class="col-md-12 control-label text-left" >
						 System User<span style="color:red;">* </span>	</label>

					<div class="col-md-12">
						<input type="radio" name="system_user" id="system_user" value="Y" <?php if($res['system_user']=='Y'){?>checked<?php }?>> <span>Yes</span> &nbsp; <input type="radio" name="system_user" id="system_user" 
						value="N" <?php if($res['system_user']!='Y'){?>checked<?php }?>> <span>No</span>
					</div>
				</div> -->

			

				
			
				<div class="col-md-12 mb-3">
					  <input type="button" class="btn btn-primary " value="Update User" name="update_user" id="update_user_btn">
					
				</div>
			</div>
</div>
</form>




              </div>
		</div>	
<div class="m-wizard__form reservation-form" style="padding: 17px 33px 0px;">		
<div class="m-wizard__form-step m-wizard__form-step--current" id="m_wizard_form_step_2">
<form id="changepwd-form" method="post" data-toggle="validator" action="<?php echo Yii::app()->createAbsoluteUrl('admin/default/updatepwd')?>" enctype="multipart/form-data" >
<input type="hidden" name="uid" id="uid" value="<?php echo $res['uid'];?>">
<div class="form-part bussiness-det">


				 	<div>								<h4 class="form-heading">
							Change Password						</h4>
					</div>
					<hr id="hr_UK-FCL-00150_0" style="height: 0px; margin: 0px;">
					<div class="form-row row">
			

				
			
				<div class="form-group col-md-6" >
					
					<label class="col-md-12 control-label text-left" >
						New Password	<span style="color:red;">*<i class="fa fa-question-circle text-info fa-lg" data-html="true" data-toggle="tooltip" title="Your password must contain a minimum of 6 characters included with at least 1 upper case letter, 1 number, and 1 special character from !, #, $, ^, %, @, & and * (other special characters are not supported)." style="color: skyblue;"></i></span>	</label>

					<div class="col-md-12">
					<input type="password" name="password" id="password1"  value="">					
					<span style="color: red;" id="password1error"></span>
					</div>
				</div>
				<div class="form-group col-md-6" >
					
					<label class="col-md-12 control-label text-left" >
						 Confirm Password<span style="color:red;">* </span></label>

					<div class="col-md-12">
					<input type="password" name="cpassword" id="cpassword" value="">
					<span style="color: red;" id="cpassworderror"></span>
					</div>
				</div>
				
				
			
				<div class="col-md-12 mb-3">
					  <input type="button" class="btn btn-primary " value="Update Password" name="update_pwd" id="update_pwd_btn">
					
				</div>
			</div>
</div>
</form>




              </div>			  

</div>	
<?php

   $base=Yii::app()->theme->baseUrl;

?>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<link rel="stylesheet" href="<?=$base?>/assets/frontend/dashboard/css/plugins/select2/select2.css">

<script src="<?=$base?>/assets/frontend/dashboard/js/plugins/select2/select2.min.js"></script>

<!--<link href="<?=$base?>/css/main-style.css" rel="stylesheet">	-->		  
			  <script>
			   $("#update_pwd_btn").click(function(){
			   		var pass1 = $("#password1").val();
			   		var cpass = $("#cpassword").val();
			   		var result = checkPassword();
			   		if(result==true){
			   			if(pass1==cpass){
			   				 $('#changepwd-form').hide();
						     $('#changepwd-form').submit();
			   			}else{
			   				$("#cpassworderror").text("The password confirmation does not match.");
			   			}
			   		} 
				   
			   });

			 


			 $("#middle_name").blur(function(){
				if($(this).val().trim()){
					$("input[name=middlenamecheckbox]").prop('checked', false);	
					$("#middlenameerror").html("");
				}
			});

			$("input[name=middlenamecheckbox]").change(function(){
				var errors = false;
				if($(this).is(':checked')){
					$("#middle_name").attr('readonly',true);
					$("#middle_name").val("");
					$("#middlenameerror").html("");
				}
				else{
					$("#middle_name").attr('readonly',false);
				}
			});
			  $("#update_user_btn").click(function(){
				  
				  if(checkValidation()){
					  $.ajax({
						type: "post",
						cache: false,
						
						url: "/backoffice/admin/default/editemailExist",
						data: {email:$("#email").val(),uid:<?php echo $res['uid'];?>},		
						success: function (data) {
							
							//$(".errors").remove();
							$("#email").next("span.errors").remove();	
							if (data=='dup') 
							{
								$("#email").after( "<span class='errors' style='color:red;'>This Email ID is already registered. Use a different Email ID.</span>");
								$("#email").focus();
								errors=true;
								
							}
							else{
								$('#adduser-form').hide();
											$('#adduser-form').submit();
								
							}  
								
						}
					});
					}
				  
			  });
$("#password1").on("blur",function(){
	checkPassword();
	
});

$("#cpassword").on("blur",function(){
	checkConfirmPassword();
	
});
	function checkValidation() {

	var errors = false;
	$(".errors").remove();
	var re = /[0-9]/;
    var relower = /[a-z]/;
    var reupper = /[A-Z]/;
    var respecial = /[!@#$%^&*()]+/;
	var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
	//first name
	
	if($("#full_name").val().trim() == ""){
		$("#full_name").after( "<span class='errors' style='color:red;'>First Name is required.</span>");
		//$("#full_name").focus();
		errors = true;
	}
   if (!$("#mnamechekbox").is(":checked") && $("#middle_name").val().trim()=="") {
		$("#mnamechekbox").focus();
		$("#middlenameerror").html( "Please enter the required information or select the check box");
		errors = true;
	}
	if($("#last_name").val().trim() == ""){
		$("#last_name").after( "<span class='errors' style='color:red;'>Last Name is required.</span>");
		//$("#full_name").focus();
		errors = true;
	}
	
	 if($("#email").val().trim() == ""){
		$("#email").after( "<span class='errors' style='color:red;'>Email is required.</span>");
		//$("#email").focus();
		errors = true;
	}
	else if(checkEmail()){
		
		//$("#email").after( "<span class='errors' style='color:red;'>Please enter valid email address.</span>");
		//$("#email").focus();
		errors = true;
	}
	
	
	 /*if($("#mobile").val()==""){
		$("#mobile").after( "<span class='errors' style='color:red;'>Mobile is required.</span>");
		//$("#mobile").focus();
		errors = true;
	}*/
	
	
	
	return !errors;
}
		  
$("#full_name").bind("keypress",function(){
		var regex=  new RegExp("^[ A-Za-z]*$"); //;
		var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    		if (!regex.test(key)) {
        		return false;
    		}
});
$("#last_name").bind("keypress",function(){
		var regex=  new RegExp("^[ A-Za-z]*$"); //;
		var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    		if (!regex.test(key)) {
        		return false;
    		}
});

$("#mobile").bind("keypress",function(){
	var regex=  new RegExp("^[0-9]*$"); 
	
	var maxLength = $(this).attr('maxlength');
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
	if (!regex.test(key)) {
		event.preventDefault();
		return false;
	}
	
	/*if(maxLength == $(this).val().length){
		event.preventDefault();
		return false;
	}*/
});
$("#email").on("blur", function(){
	checkEmail();
});
function checkEmail(){
	var errors = false;
	//$(".errors").remove();
	$("#email").next("span.errors").remove();
	if(!validateEmail($("#email").val())){
		
		$("#email").after( "<span class='errors' style='color:red;'>Valid Email Id e.g mail@email.com</span>");
		errors = true;
		
	}
	/*else{
		errors = checkEmailExist();
	}*/
	return errors;
}
function ValidateChar(data) {
	var expr =/^[a-z]+$/;	
	return expr.test(data);
};
function ValidateAlphaNumeric(data) {
	var expr =/^[(a-z)(A-Z)(0-9)]+$/;	
	return expr.test(data);
};
function validateEmail(Email) {
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(Email)) {
        return true;
    }
    else {
        return false;
    }
}

function checkPassword(){
	var password = $("#password1").val();
		var pattern = /^.*(?=.{6,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!#@$^*%&]).*$/;
		if(pattern.test(password)){
			$("#password1error").text("");
			return true;
		}else{
			$("#password1error").text( "Password must contain 1 Capital Letter, 1 Lower Letter, 1 Number and 1 Special Character.");			
			return false;
		}	
}

function checkConfirmPassword(){

	var password1 = $("#password1").val();
	var password2 = $("#cpassword").val();

	if(password1 != password2){	
		$("#cpassworderror").text("The password confirmation does not match.");
	}else{
		$("#cpassworderror").text("");
	}	
}

function checkMobile(){
	var errors = false;
	//$(".errors").remove();
	$("#mobile").next("span.errors").remove();
	if($("#mobile").val().length !== 10){
		$("#mobile").after( "<span class='errors' style='color:red;'>Mobile no. Must be 10 Digits.</span>");
		errors = true;
	}
	/*else{
		checkMobileExist();
	}*/
	return errors;
  }
	
			
  
 
			  </script>