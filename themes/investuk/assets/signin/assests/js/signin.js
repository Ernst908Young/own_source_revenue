/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * auther: Hemant Thakur
 * and open the template in the editor.
 */
// $( window ).on( "load", function() {
	// var email = $("#email").val();
	// // if(email){
		// // checkEmail();
	// // }
// });
	

$("#otp_verify").click(function () {
	checkValidation();
});

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

$("#fname").bind("keypress",function(){
		var regex=  new RegExp("^[ A-Za-z]*$"); //;
		var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    		if (!regex.test(key)) {
        		return false;
    		}
});

$("#mname").bind("keypress",function(){
		var regex=  new RegExp("^[ A-Za-z]*$"); //;
		var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    		if (!regex.test(key)) {
        		return false;
    		}
});

$("#lname").bind("keypress",function(){
		var regex=  new RegExp("^[ A-Za-z]*$"); //;
		var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    		if (!regex.test(key)) {
        		return false;
    		}
});


$("#nationality").bind("keypress",function(){
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
	
	// if(maxLength == $(this).val().length){
		// event.preventDefault();
		// return false;
	// }
});

$("#otp_num1,#otp_num2,#otp_num3,#otp_num4").bind("keypress",function(){
	var regex=  new RegExp("^[0-9]*$"); 
	
	var maxLength = $(this).attr('maxlength');
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
	if (!regex.test(key)) {
		event.preventDefault();
		return false;
	}
	
	if(maxLength == $(this).val().length){
		event.preventDefault();
		
		return false;
		
	}
});
$(".otp").bind("input", function() {
	var $this = $(this);
	setTimeout(function() {
		if ( $this.val().length >= parseInt($this.attr("maxlength"),10) )
		$this.next("input").focus();
		
		else if ( $this.val().length <= parseInt($this.attr("maxlength"),10) )
		$this.prev("input").focus();
	},0);
});

$("#telephone").bind("keypress",function(){
	var regex=  new RegExp("^[0-9]*$"); //;
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
	if (!regex.test(key)) {
	     event.preventDefault();
	     return false;
	}
});

$("#dob").on("keypress",function(e){
	e.preventDefault();
	return false;
});

function checkDob() {
	var errors = false;
	$(".errors").remove();
	if($("#dob").val()!=""){
		var dateString = $("#dob").val();
		var parts = dateString.split("-");
		var dtDOB = new Date(parts[1] + "-" + parts[2] + "-" + parts[0]);
		var dtCurrent = new Date();
		if (dtCurrent.getFullYear() - dtDOB.getFullYear() < 18) {
			$("#dob").after( "<span class='errors' style='color:red;'>Age limit for the applicant is 18 years.</span>");
			errors = true;
		}
		//errors = true;
		
	}
}


function checkEmail(){
	var errors = false;
	$(".errors").remove();
	if(!validateEmail($("#email").val())){
		$("#email").after( "<span class='errors' style='color:red;'>Valid Email Id e.g mail@email.com</span>");
		errors = true;
	}
	else{
		checkEmailExist();
	}
}
function checkEmailExist() {
	var posturl = window.location.href.split("account");
    var posturl = posturl[0] + "account/checkExistEmail";
    var postdata = "email=" + $("#email").val();	
	$.ajax({
        type: "post",
        cache: false,
        url: posturl,
        data: postdata,		
        success: function (data) {
			var errors = false;
			$(".errors").remove();
				
				if (data === 'AEEA') 
			{
				$("#email").after( "<span class='errors' style='color:red;'>This Email ID is already registered. Use a different Email ID.</span>");
				//errors = true;
				$("#email").focus();
				return false;
			}
            else{
				//errors = false;
				//return true;
				//$('#register-form').hide();
		$('#otp-form').show();
				sendotp();
			}   
				
		}
	});  
}

function checkPassword(){
	var re = /[0-9]/;
    var relower = /[a-z]/;
    var reupper = /[A-Z]/;
    var respecial = /[!@#$%^&*()]+/;
	var errors = false;
	$(".errors").remove();
	
	if(!re.test($("#password1").val())){
		$("#password1").after( "<span class='errors' style='color:red;'>Password must contain 1 Capital Letter, 1 Lower Letter, 1 Number and 1 Special Character.</span>");
		errors = true;
	}else
	if(!relower.test($("#password1").val())){
		$("#password1").after( "<span class='errors' style='color:red;'>Password must contain 1 Capital Letter, 1 Lower Letter, 1 Number and 1 Special Character.</span>");
		errors = true;
	}else
	if(!reupper.test($("#password1").val())){
		$("#password1").after( "<span class='errors' style='color:red;'>Password must contain 1 Capital Letter, 1 Lower Letter, 1 Number and 1 Special Character.</span>");
		errors = true;
	}else
	if(!respecial.test($("#password1").val())){
		$("#password1").after( "<span class='errors' style='color:red;'>Password must contain 1 Capital Letter, 1 Lower Letter, 1 Number and 1 Special Character.</span>");
		errors = true;
	}
}

function checkConfirmPassword(){
	//alert('cpass');
	var errors = false;
	$(".errors").remove();
	var password1 = $("#password1").val();
	var password2 = $("#password2").val();
	if(password1 != password2){	
		$("#password2").after( "<span class='errors' style='color:red;'>Confirm password not match with password.</span>");
		return false;
	}else{
		return true;
	}
}
function checkMobile(){
	var errors = false;
	$(".errors").remove();
	if($("#mobile").val().length !== 10){
		$("#mobspanerror").html( "Mobile no. Must be 10 Digits.");
		errors = true;
	}
	else{
		checkMobileExist();
	}
  }

function checkMobileExist() {
	var posturl = window.location.href.split("account");
    var posturl = posturl[0] + "account/checkExistMobile";
    var postdata = "mobile=" + $("#mobile").val();	
	$.ajax({
        type: "post",
        cache: false,
        url: posturl,
        data: postdata,		
        success: function (data) {
			var errors = false;
			$(".errors").remove();
				
			if (data === 'exist') 
			{
				$("#mobspanerror").html( "This Mobile Number is already registered. Use a different Mobile Number.");
				$("#email").focus();
				return false;
			}
            else{
				$("#mobspanerror").html( "");
				
			}   
				
		}
	});  
}
$("#country").on("change",function () {
    var str = "";
    str = $("#country").val();
    var posturl = window.location.href.split("account");
    var posturl = posturl[0] + "account/getstates";
    var postdata = "country=" + str;
    $.ajax({
        type: "post",
        cache: false,
        url: posturl,
        data: postdata,
        success: function (data) { 
			if (data != '') {				
                $("#state").html(data);
			}
            else
                console.log("Error");            
        }
    });

});


$("#mname").blur(function(){
	if($(this).val()){
		$("input[name=middlenamecheckbox]").prop('checked', false);	
		$("#middlenameerror").html("");
	}
});

$("input[name=middlenamecheckbox]").change(function(){
	var errors = false;
	if($(this).is(':checked')){
		$("#mname").attr('readonly',true);
		$("#mname").val("");
		$("#middlenameerror").html("");
	}
	else{
		$("#mname").attr('readonly',false);
	}
});


$("input[id=user_type]").change(function(){
	if($("input[id=user_type]").is(':checked')){
		
		$("#user_type_error").html("");
	}
});

$("input[name=termcondition]").change(function(){
	if($(this).is(':checked')){
		
		$("#termconditionerror").html("");
	}
});

 function getCaptcha(){
	var num1 = Math.floor((Math.random() * 30));
    var num2 = Math.floor((Math.random() * 10));
	var total = parseInt(num1) + parseInt(num2);
	$("#capnum1").html(num1);
	$("#capnum2").html(num2);
	$("#captcharesult").html(total);
	$("#capnum3").val("");
	
 }

$( window ).on( "load", function() {
        getCaptcha();
		validDate();
    });
$("#capnum3").keyup(function() {
	var num1 = $("#capnum1").html();
	var num2 = $("#capnum2").html();num2
	var total = parseInt(num1) + parseInt(num2);
	var input = $(this).val();
	if (input == total) {
		$("#captchaerror").html("");
		$("#captchasuccess").html("Captcha verified successfully");
	}

});

function validDate(){
    var today = new Date().toISOString().split('T')[0];
	$("#dob").attr("max", today);
}


function checkValidation() {

	var errors = false;
	$(".errors").remove();
	var re = /[0-9]/;
    var relower = /[a-z]/;
    var reupper = /[A-Z]/;
    var respecial = /[!@#$%^&*()]+/;
	var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
	
	if($("#fname").val() === ""){
		$("#fname").after( "<span class='errors' style='color:red;'>First Name is required</span>");
		$("#fname").focus();
		errors = true;
	}
	
	else if (!$("#mnamechekbox").is(":checked") && $("#mname").val()=="") {
		$("#mnamechekbox").focus();
		$("#middlenameerror").html( "Please enter the required information or select the check box");
		errors = true;
	}
	
	
	else if($("#lname").val() === ""){
		$("#lname").after( "<span class='errors' style='color:red;'>Last Name is required</span>");
		$("#lname").focus();
		errors = true;
	}
	else if($("#gender").val()==""){
		$("#gender").after( "<span class='errors' style='color:red;'>Please select an option</span>");
		$("#gender").focus();
		errors = true;
	}
	else if($("#dob").val()==""){
		$("#dob").after( "<span class='errors' style='color:red;'>Date of Birth is required.</span>");
		$("#dob").focus();
		errors = true;
	}
	
	else if($("#countrycode").val() == ""){
		$("#mobspanerror").html( "Country code is required.");
		$("#countrycode").focus();
		errors = true;
	}
	else if($("#mobile").val() === ""){
		$("#mobspanerror").html( "Mobile is required.");
		$("#mobile").focus();
		errors = true;
	}
	
	else if($("#email").val() === ""){
		$("#email").after( "<span class='errors' style='color:red;'>Email is required.</span>");
		$("#email").focus();
		errors = true;
	}
	else if($("#password1").val() === ""){
		$("#password1").after( "<span class='errors' style='color:red;'>Password is required.</span>");
		$("#password1").focus();
		errors = true;
	}
	
	else if($("#password2").val() === ""){
		$("#password2").after( "<span class='errors' style='color:red;'>Same as you entered in password.</span>");
		$("#password2").focus();
		errors = true;
	}	
	
	
	else if($("#address1").val() === ""){
		$("#address1").after( "<span class='errors' style='color:red;'>Address Line 1 is required</span>");
		$("#address1").focus();
		errors = true;
	}
	else if($("#nationality").val() == null){
		$("#nationality").after( "<span class='errors' style='color:red;'>Nationality is required</span>");
		$("#nationality").focus();
		errors = true;
	}
	else if($("#country").val() == null){
		$("#country").after( "<span class='errors' style='color:red;'>Country is required</span>");
		$("#country").focus();
		errors = true;
	}
	else if($("#state").val() == null){
		$("#state").after( "<span class='errors' style='color:red;'>State is required</span>");
		$("#state").focus();
		errors = true;
	}
	else if($("#city").val() === ""){
		$("#city").after( "<span class='errors' style='color:red;'>City is required</span>");
		$("#city").focus();
		errors = true;
	}
	else if($("#pincode").val() === ""){
		$("#pincode").after( "<span class='errors' style='color:red;'>Postal Code is required</span>");
		$("#pincode").focus();
		errors = true;
	}
	
	else if (!$("input[id=user_type]").is(":checked")) {
		$("#user_type_error").html("Please select user type.");
		$("#user_type").focus();
		errors = true;
	}
	
	else if (!$("#termcondition").is(":checked")) {
		$("#termconditionerror").html("Please check the box of term & condition to proceed.");
		$("#termcondition").focus();
		errors = true;
	}
	
	else if($("#capnum3").val() == ""){
		$("#captchaerror").html( "Please Verify Captcha");
		$("#capnum3").focus();
		errors = true;
	}
	 
	else if(parseInt($("#capnum3").val()) != parseInt($("#captcharesult").html())){
		$("#captchaerror").html( "Captcha verification failed, try again!");
		$("#captchasuccess").hide();
		
		$("#capnum3").focus();
		errors = true;
	}
	
	
	
	else
	{
		//checkConfirmPassword();
		checkEmail();
		
	}  
	return !errors;
}

function sendotp() {
	$('#register-form').hide();
	$('#otp-form').show();
	var posturl = window.location.href.split("account");	
    var posturl = posturl[0] + "account/sendotp";	
    var postdata = "mobile=" + $("#mobile").val() + "&email=" + $("#email").val() + "&fname=" + $("#fname").val() + "&mname=" + $("#mname").val() + "&lname=" + $("#lname").val();	
	$.ajax({
        type: "post",
        cache: false,
        url: posturl,
        data: postdata,		
        success: function (data) {
			if (data) {
				//$("#userotp").html(data);
				console.log(data);
			}
			if(data == 'Max count reached'){
				$("#otperror").html('Maximum 10 retry for each mobile number is allowed.');
			}
			else {	
				console.log('error');
			}	
		}
	});  
}

$("#register_verify").click(function () {
	verifyotp();
});

function verifyotp() {
	var otp_num1 = $('#otp_num1').val();
	var otp_num2 = $('#otp_num2').val();
	var otp_num3 = $('#otp_num3').val();
	var otp_num4 = $('#otp_num4').val();
	var otp = otp_num1+otp_num2+otp_num3+otp_num4;
	//alert(otpres);
	var posturl = window.location.href.split("account");	
    var posturl = posturl[0] + "account/verifyotp";	
    var postdata = "mobile=" + $("#mobile").val() + "&otp=" + otp;
	
	if(otp_num1=="" && otp_num2=="" && otp_num3=="" && otp_num4==""){
		$("#otperror").html("Please enter your OTP");
	}
	else if(otp_num1=="" || otp_num2=="" || otp_num3=="" || otp_num4==""){
		$("#otperror").html("Invalid OTP");
	}
	else{
		$.ajax({
			type: "post",
			cache: false,
			url: posturl,
			data: postdata,		
			beforeSend: function() {
              $("#beforesend").html('Please wait...');
           },
			success: function (data) {
				if(data == 'SUCCESS'){
					$("#userotp").html("");
					$("#otperror").html("");
					$('#otp_num1').val("");
					$('#otp_num2').val("");
					$('#otp_num3').val("");
					$('#otp_num4').val("");
					regiteruser();
				}
				if(data == 'otp expired'){
					$("#otperror").html("OTP Expired!");
				}
				else {	
					console.log('error');
				}	
			}
		});  
	}
	
		
	
}


function regiteruser() { 
    var formData = $("#register-form").serialize();
    var posturl = window.location.href.split("account");
    var posturl = posturl[0] + "account/savedetail";
    $.ajax({
        type: "post",
        cache: false,
        url: posturl,
        data: formData,
        success: function (data) {
            data = data.split(";"); 
			if (data == "register-success") {
				//alert("Your Profile Registered Successfully in CAIPO Portal.");
				$('#register-form')[0].reset();
				$('#register-form').show();
				$('#captchasuccess').html("");
				$('#otp-form').hide();
				
				
				$('#success-register-alert').show();
				
				$("body").scrollTop(0);
				
            }
            else {
                $("#registration-error").text('error');
            }
        }
    });   
}

