var WizardDemo = function() {
    //== Base elements
    var wizardEl = $('#m_wizard');
    var formEl = $('#m_form');
    var validator;
    var wizard;
	
    //== Private functions
    var initWizard = function () {
    }

    var initValidation = function() {
        validator = formEl.validate({
            //== Validate only visible fields
            ignore: ":hidden",
            //== Validation rules
            rules: {
                    
                	
						
                },
                messages: {
                   
            },				
			highlight: function(element) {
				$(element).parents('.form-group').addClass('has-error');
				console.log(element);
				
			},
			unhighlight: function(element) {
				$(element).parents('.form-group').removeClass('has-error');
				
			},
			errorPlacement: function(error, element) {
				if($(element).is("textarea")){
					error.addClass('textarea-error');	
				}
				if (element.parent('.rbcb-group').length) {
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
				/*var serviceprovider_user_id = $("#serviceprovider_user_id").val();
				if(serviceprovider_user_id){
					valid = true;
				}else{
					var checkmail = validate();
					if(checkmail==false){
						valid = false;
						wizardObj.stop();
					}
					
				}*/

				var seornew = $('input[name=sp_ch_box]:checked').val();
				if(seornew){
					if(seornew==1){
						$("#overlay").attr("style",'display:block;');
							//console.log('submit');
						document.getElementById("m_form").submit();
					}else{
						var mnt = $("#middle_name").val();
							if(mnt){
								valid = true;
							}else{
								var mncb = $('input[name=middlenamecheckbox]:checked').val(); 
								if(mncb){
									valid = true;
									$("#middleerror").text("");
								}else{
									valid = false;
									$("#middleerror").text("Please enter the required information or select the check box");
								}
							}

						 var v = validate();
					//	 console.log(v);
    if(v==true){
       $.ajax({
                type: "POST",
                  dataType: 'json',
                url: "/backoffice/investor/serviceprovider/validatemail",
                data:{email:$("#email").val()},                 
                success: function(result) {    
                if(result.status==false){                
                  $("#email-error").text('Email is Already Registered');  
                             
                }else{
                    $("#overlay").attr("style",'display:block;');
					//console.log('submit');
					document.getElementById("m_form").submit();
                }                                   
              }             
            });
    }else{
    	valid=false;
    }
					
					}
				}else{
					valid=false;
				}

				
				
				
  
				     
            }
        });
    }

    return {
        // public functions
        init: function() {
            wizardEl = $('#m_wizard');
            formEl = $('#m_form');

            initWizard(); 
            initValidation();
            initSubmit();
        }
    };
}();

jQuery(document).ready(function() {
	WizardDemo.init()
   
});

function validate() { 
  const $result = $("#email-error");
  const email = $("#email").val();
  $result.text("");
  if (validateEmail(email)) { 
     return true;
  } else {
    $result.text("Please enter a valid email");  
     return false;
  } 
}

function validateEmail(email) {
  const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}