/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * auther: Hemant Thakur
 * and open the template in the editor.
 */
$("#otpverify").click(function () {
	// $('.register_disabled').hide();
  checkValidation();
});
function checkValidation() {	
	var errors = false;
	$(".errors").remove();
	if($("#email").val() === ""){
		$("#email").after( "<span class='errors' style='color:red;'>Email is required.</span>");
		errors = true;
	}else
	if($("#password1").val() === ""){
		$("#password1").after( "<span class='errors' style='color:red;'>Password is required.</span>");
		errors = true;
	}else
	if($("#password2").val() === ""){
		$("#password2").after( "<span class='errors' style='color:red;'>Confirm password is required.</span>");
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
   /*  if($("#register-form").valid()) {		
        $("#login_error").text('');
        $("#otpverify").fancybox({
            'scrolling': 'no',
            'titleShow': false,
            'afterClose': function () {
                $("#login_error").hide();
                $("#login_pass").val('');
            },
            'beforeShow': function () {
                if (checkValidation()){
					$('.register_disabled').hide();
					$('#preloader').show();
					$('#status').show();
					sendotp();
                }
                else {
                    $("#registration-error").text("Please fillup all the fields correctly");
                    $.fancybox.close();
                }
            }
        });
        return true;
    }
    return false; */
	return !errors;
}


function sendotp() {	
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
				$('#mob_no').text($("#mobileNo").val());
				$('#thankyouModal').modal('show');	
				
			} else {				
                if (data === 'AEEA') {
					$("#registration-error").text("This Email Address already Exist");
					$('.register_disabled').show();
				}
                else{
					$('.register_disabled').show();
					 $("#registration-error").text("There is some error please try again later.");
				}
			}	
		}
	});  
}


$("#country").change(function () {
    /*start preloader */
    $('#preloader').show();
    $('#status').show();
    var str = "";
    str = $("#country").val();
    /* var posturl="<?php echo BO_API_BASEURL; ?>";
     posturl+="/getcontrystates";*/
    var posturl = window.location.href.split("account");
    var posturl = posturl[0] + "account/getstates";
    var postdata = "country=" + str;
    $.ajax({
        type: "post",
        cache: false,
        url: posturl,
        data: postdata,
//dataType: "text json",
        success: function (data) {
            if (data != '') {
				
                var js_array = JSON.parse(data);
                //js_array = js_array.slice(1, -1);
//  console.log(js_array);
                var stateElement = document.getElementById("state");
                stateElement.length = 0;
                stateElement.options[0] = new Option('State', '');
                stateElement.selectedIndex = 0;
                $.each(js_array, function (key, obj) {
                    stateElement.options[stateElement.length] = new Option(obj['state'], obj['id']);
                });

//console.log("coming "+data);
            }
            else
                console.log("Error");
             // stop preloader
                $('#status').fadeOut(); // will first fade out the loading animation
                $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
                $('body').delay(350).css({'overflow':'visible'});
        }
    });

}).change();

function regiteruser() {
    /*start preloader */
    $('#preloader').show();
    $('#status').show();
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
            	$('#register-form').hide();
                myRedirect(data[1]);
            }
            else {
                $("#registration-error").text(console.log(data));
            }
        }
    });
    // stop preloader
	$('#status').fadeOut(); // will first fade out the loading animation
	$('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
	$('body').delay(350).css({'overflow':'visible'});
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
	$('#preloader').show();
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
				$('#preloader').hide();
            }
            else if (data === 'Not Success') {
                $("#login_error").text("Invalid OTP").show();
            }
        }

    });
    // stop preloader
	/* $('#status').fadeOut(); // will first fade out the loading animation
	$('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
	$('body').delay(350).css({'overflow':'visible'}); */
    return false;
});
$(document).ready(function () {

    /* $("#register-form").validate({
        rules: {
            email: {email: true, required: true, maxlength: 150},
            First_Name: {required: true, lettersonly: true, maxlength: 20},
            Last_Name: {required: true, lettersonly: true, maxlength: 20},
            City: {required: true, lettersonly: true, maxlength: 20},
            District: {required: true, lettersonly: true, maxlength: 20},
            mobile: {required: true, integer:true,minlength: 10, maxlength: 10},
            PAN: {alphabetsonly: true, minlength: 10, maxlength: 10},
            PIN: {required: true, maxlength: 7, minlength: 6},
            password1: {required: true, minlength: 8, maxlength: 64, stronpassword: true},
            password2: {required: true, minlength: 8, maxlength: 64, equalTo: "#password1"},
            address: {minlength: 10, required: true, addressField: true, maxlength: 150},
            Adhaar: {nowhitespace: true, maxlength: 12, alphabetsonly: true},
            country: {required: true, nowhitespace: true},
        },
        messages: {
            address:"Please enter alphanumric character with space, comma,/,\\,;,# only minimum 10 characters"
        },
        tooltip_options: {
            fname: {trigger: 'focus'},
            '_all_': {placement: 'left', html: true}
        },
        submitHandler: function (form) {
        },

        invalidHandler: function (form, validator) {
            // grecaptcha.reset(); 
            // Recaptcha.reload();
            $("#validity_label").html('<div class="row"><div class="alert alert-error">There be ' + validator.numberOfInvalids() + ' error' + (validator.numberOfInvalids() > 1 ? 's' : '') + ' here.  OH NOES!!!!!</div></div>');
        }
    }); 

    $(".fancybox").fancybox({
        openEffect: 'none',
        closeEffect: 'none',
        iframe: {
            preload: false
        }
    });
    $(".various").fancybox({
        maxWidth: 800,
        maxHeight: 600,
        fitToView: false,
        width: '70%',
        height: '70%',
        autoSize: false,
        closeClick: false,
        openEffect: 'none',
        closeEffect: 'none'
    });
    $('.fancybox-media').fancybox({
        openEffect: 'none',
        closeEffect: 'none',
        helpers: {
            media: {}
        }
    });*/

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



