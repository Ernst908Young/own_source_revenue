var WizardDemo = function() {
    //== Base elements
	$('#usermailerror').html();
    var wizardEl = $('#m_wizard');
    var formEl = $('#query_form');
    var validator;
    var wizard;
	
    //== Private functions
    var initWizard = function () {
    }

    var initValidation = function() {
        validator = formEl.validate({
         
            ignore: ":hidden",         
            rules: {
                    
                	 email: {
						required: true,
						// Specify that email should be validated
						// by the built-in "email" rule
						email: true
					  },
					  message:{
						  maxlength: '1000'
					  }
						
                },
                messages: {
					
                   
            },				
			highlight: function(element) {
				$(element).parents('.form-group').addClass('has-error');
				
			},
			unhighlight: function(element) {
				$(element).parents('.form-group').removeClass('has-error');
				
			},
			errorPlacement: function(error, element) {
				if($(element).is("textarea")){
					error.addClass('textarea-error');	
				}
				if (element.parent('.input-group').length) {
				  error.insertAfter(element.parent());					  
				} else {
				  error.insertAfter(element);
				}
			},
            //== Display error  
            invalidHandler: function(event, validator) {     
                mApp.scrollTop();
               
            },

            //== Submit valid form
            submitHandler: function (form) {

            }
        });   
    }

    var initSubmit = function() {
        var btn = formEl.find('[data-wizard-action="submit"]');

        btn.on('click', function(e) {
            e.preventDefault();
            if (validator.form()) {  		
		
				var valid = true;
				/*var checkmail = validate();
				if(checkmail==false){
					valid = false;
					wizardObj.stop();
				}
*/
				if($("#captcha_check").val()==1){
					if($("#captcha_onrq").val() == ""){
					    $("#captchaerror_onrq").html( "Please Verify Captcha");
					    $("#captcha_onrq").focus();
					     valid = false;
					     
					  } else {
					        var ctext = $("#captcha_img_text").text();
					        var input = $("#captcha_onrq").val();
					        if (ctext == input) {
					          valid = true;
					        }else{
					        	$("#captchaerror_onrq").html( "Invalid Captcha");
					   			$("#captcha_onrq").focus();
					         	valid = false;
					        }
					  }
				}

			
				if(valid===true){
					document.getElementById("query_form").submit();    
				}
				
				     
            }
        });
    }

    return {
        // public functions
        init: function() {
            wizardEl = $('#m_wizard');
            formEl = $('#query_form');

            initWizard(); 
            initValidation();
            initSubmit();
        }
    };
}();

jQuery(document).ready(function() {
	WizardDemo.init()
   
});