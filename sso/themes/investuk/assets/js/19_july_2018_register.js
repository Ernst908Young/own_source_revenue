/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * auther: Hemant Thakur
 * and open the template in the editor.
 */
$("#otpverify").click(function () {
  checkValidation();
});
function ValidatePass(pass) {
	var expr =/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})$/;	
	return expr.test(pass);
};
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


function checkValidation() {	
	var errors = false;
	$(".errors").remove();
	var re = /[0-9]/;
    var relower = /[a-z]/;
    var reupper = /[A-Z]/;
    var respecial = /[!@#$%^&*()]+/;
	
	if($("#email").val() === ""){
		$("#email").after( "<span class='errors' style='color:red;'>Email is required.</span>");
		errors = true;
	}else
	if(!validateEmail($("#email").val())){
		$("#email").after( "<span class='errors' style='color:red;'>Valid Email Id e.g mail@email.com</span>");
		errors = true;
	}else
	if($("#password1").val() === ""){
		$("#password1").after( "<span class='errors' style='color:red;'>Password is required.</span>");
		errors = true;
	}else
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
	}else
	if($("#password2").val() === ""){
		$("#password2").after( "<span class='errors' style='color:red;'>Same as you entered in password.</span>");
		errors = true;
	}else
	if($("#password1").val() != $("#password2").val()){			
		$("#password2").after( "<span class='errors' style='color:red;'>Confirm password not match with password.</span>");
		errors = true;
	}else
	if($("#fname").val() === ""){
		$("#fname").after( "<span class='errors' style='color:red;'>First name is required</span>");
		errors = true;
	}else
	if($("#lname").val() === ""){
		$("#lname").after( "<span class='errors' style='color:red;'>Last name is required</span>");
		errors = true;
	}else
	if($("#pan").val()!="" && !ValidateAlphaNumeric($("#pan").val())){
		$("#pan").after( "<span class='errors' style='color:red;'>Must be a alphanumeric.</span>");
		errors = true;
	}else
	if($("#address").val() === ""){
		$("#address").after( "<span class='errors' style='color:red;'>Address is required</span>");
		errors = true;
	}else
	if($("#country").val() === "" || $("#country").val() ==null){
		$("#country").after( "<span class='errors' style='color:red;'>Country is required</span>");
		errors = true;
	}else
	if($("#state").val() === ""){
		$("#state").after( "<span class='errors' style='color:red;'>State is required</span>");
		errors = true;
	}else
	if($("#city").val() === ""){
		$("#city").after( "<span class='errors' style='color:red;'>City is required</span>");
		errors = true;
	}else
	if($("#distt").val() === ""){
		$("#distt").after( "<span class='errors' style='color:red;'>District is required</span>");
		errors = true;
	}else
	if($("#pin").val() === ""){
		$("#pin").after( "<span class='errors' style='color:red;'>Pin Code is required</span>");
		errors = true;
	}else
	if($("#mobileNo").val() === ""){
		$("#mobileNo").after( "<span class='errors' style='color:red;'>Mobile No. is required</span>");
		errors = true;
	}else{
		$('.register_disabled').hide();
		sendotp();
	}  
	return !errors;
}


function sendotp() {	
	$('#loader').modal('show');	
 	var posturl = window.location.href.split("account");	
    var posturl = posturl[0] + "account/sendotp";	
    var postdata = "mobile=" + $("#mobileNo").val() + "&email=" + $('#email').val();	
	$.ajax({
        type: "post",
        cache: false,
        url: posturl,
        data: postdata,		
        success: function (data) {
			if (data === 'SUCCESS') {
				$('#loader').modal('hide');
				$('#mob_no').text($("#mobileNo").val());
				$('#thankyouModal').modal('show');
			} else {	
				$('#loader').modal('hide');
                if (data === 'AEEA') {
					//$('#thankyouModal').modal('hide');	
					$("#registration-error").text("This Email Address already Exist");
					$('.register_disabled').show();
				}
                else{
					//$('#thankyouModal').modal('hide');	
					$('.register_disabled').show();
					$("#registration-error").text("There is some error please try again later.");
				}
			}	
		}
	});  
}


$("#country").change(function () {
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
                var js_array = JSON.parse(data);
                var stateElement = document.getElementById("state");
                stateElement.length = 0;
                stateElement.options[0] = new Option('State', '');
                stateElement.selectedIndex = 0;
                $.each(js_array, function (key, obj) {
                    stateElement.options[stateElement.length] = new Option(obj['state'], obj['id']);
                });
            }
            else
                console.log("Error");            
        }
    });

}).change();

function regiteruser() {    
    var formData = $("form").serialize();
    var posturl = window.location.href.split("account");
    var posturl = posturl[0] + "account/savedetail";
    $.ajax({
        type: "post",
        cache: false,
        url: posturl,
        data: formData,
        success: function (data) {
            data = data.split(";");
            if (data[0] === "register-success") {
				$('#loader').modal('hide');
            	$('#register-form').hide();
                myRedirect(data[1]);
            }
            else {
                $("#registration-error").text(console.log(data));
            }
        }
    });   
}
$("#login_form").bind("submit", function (test) {
    var mob = $("#mobileNo").val();
    var otp = $("#login_pass").val();
    var email = $('#email').val();
    if ($("#login_pass").val().length < 4) {
        $("#login_error").show();       
        $("#login_error").text("Please enter valid otp").show();
        return false;
    }   
    var data = "mobile=" + mob + "&otp=" + otp + "&email=" + email;
    var posturl = window.location.href.split("account");
    var posturl = posturl[0] + "account/registerotpverify";	
	$("#loader").modal('show');
    $.ajax({
        type: "post",
        cache: false,
        url: posturl,
        data: data,
        success: function (data) {
            if (data === "SUCCESS") {
				regiteruser();
                $("#otplable").hide();
                $("#login_pass").hide();
                $("#otpsubmit").hide();
                $("#login_error").text("Successfully Verified! Registering you.").show();				
				$('#thankyouModal').modal('hide');				
            }
            else if (data === 'Not Success') {
                $("#login_error").text("Invalid OTP").show();
            }
        }

    });  
    return false;
});

function myRedirect(redirectUrl) {
	$('#preloader').show();
	$('#status').show();
	var form = $('<form action="' + redirectUrl + '" method="post">' +
	'<input type="hidden" name="full_name" value="' + $('#fname').val() + " " + $('#lname').val() + '" />' +
	'<input type="hidden" name="email" value="' + $('#email').val() + '" />' +
	'<input type="hidden" name="mobile" value="' + $('#mobileNo').val() + '" />' +
	'<input type="hidden" name="msg" value="Successfully Registered." />' +
	'</form>');
	$('body').append(form);
	$(form).submit();
	$('#status').fadeOut(); // will first fade out the loading animation
	$('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
	$('body').delay(350).css({'overflow':'visible'});
}



