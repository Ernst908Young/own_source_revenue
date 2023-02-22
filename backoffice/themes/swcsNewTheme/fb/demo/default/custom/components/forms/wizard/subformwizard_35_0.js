var WizardDemo = function() {
    //== Base elements
    var wizardEl = $('#m_wizard');
    var formEl = $('#m_form');
    var validator;
    var wizard;
	
    //== Private functions
    var initWizard = function () {
        //== Initialize form wizard
        wizard = new mWizard('m_wizard', {
            startStep: 1,
			clickableSteps: false, // allow step clicking
			navigation: false // disable default navigation handlers
        });
        //== Validation before going to next page
         wizard.on('beforeNext', function(wizardObj) {
         	console.log(wizardObj);
         	
         	
            if (validator.form() !== true) {
                wizardObj.stop();  // don't go to the next step
            }
        })
		
        //== Change event
         wizard.on('change', function(wizard) {
            mApp.scrollTop();            
        }); 

        //== Change event
         wizard.on('change', function(wizard) {
           	var fs = wizard.getStep();
              //$(".form-step").removeClass("active");
              $("#div_tab"+fs).addClass("active");  
                    
        }); 
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
				$(element).parents('.pcr').addClass('has-error');
			},
			unhighlight: function(element) {
				$(element).parents('.form-group').removeClass('has-error');
				$(element).parents('.pcr').removeClass('has-error');
				// if (element.hasClass("select2-offscreen")) {
					// $("#s2id_" + element.attr("id") + " ul").removeClass('has-error');
				// } 
			},
			errorPlacement: function(error, element) {
				if($(element).is("textarea")){
					error.addClass('textarea-error');	
				}
				if (element.parent('.rbcb-group').length) {
				  error.insertAfter(element.parent());					  
				} else {
					  if (element.parent('.input-group').length) {
					  error.insertAfter(element.parent());					  
					} else {
					  error.insertAfter(element);
					}
				}	
			},
            //== Display error  
            invalidHandler: function(event, validator) {     
                mApp.scrollTop();
                swal({
                    "title": "", 
                    "text": "There are some errors in your submission. Please correct them.", 
                    "type": "error",
                    "confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
                });
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
                
                    var form_div_id = wizard.getStep();
                    var valid = true;
                    var mnt = $("#UK-FCL-00105_0").val();
                    
                    if(mnt){
                     valid = true;
                    }else{

                    var mncb = $('input[name=middlenamecheckbox]:checked').val(); 
                        if(mncb){
                        valid = true;
                        }else{
                        valid = false;
                        if ($("#miderror").length) {
                        $("#miderror").text("Please enter the required information or select the check box");
                                   }else{
                        $("input#UK-FCL-00105_0").after("<span style='color:red' class='errorDetail' id='miderror'>Please enter the required information or select the check box</span>");
                                                    
                                  }
                    wizardObj.stop();                                           
                               }
                }

                    if(valid==true){
                        
                        mApp.unprogress(btn), swal({
                            title: "",
                            text: "Application details saved, please proceed ahead",
                            type: "success",
                            confirmButtonClass: "btn btn-secondary m-btn m-btn--wide"
                        });
                        document.getElementById("m_form").submit();
                        $(".reset_btn").hide();
                        $(".submitForm").addClass('disabled_btn');
                        $(".submitForm").html('<span><i class="fa fa-spinner"></i>&nbsp;&nbsp;<span>Submiting...</span></span>');
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