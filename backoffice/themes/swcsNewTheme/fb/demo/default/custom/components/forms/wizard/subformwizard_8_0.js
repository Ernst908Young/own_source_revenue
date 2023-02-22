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
         	var form_div_id = wizard.getStep();			
				if(form_div_id==1)
				{	
					var nofapp = $("#UK-FCL-00254_0").val();
					var totalRowCount = 0;          
				    totalRowCount =  $("#tbl_2245 td").closest("tr").length;
					if(nofapp==totalRowCount){					
						$("#directorerrormessage").text("");
					}else{		
						var dem = "Please add details of the Director as per the number entered in this field 'No. of Directors in the company' "; 
						if ($("#directorerrormessage").length) {
							$("#directorerrormessage").text(dem);
		    			}else{
		    				$("#title_UK-FCL-00254_0").append('<b style="color:red;" id="directorerrormessage">'+dem+'</b>');
		    			}				
						//$("#title_UK-FCL-00254_0").append("<b style='color:red;' id='directorerrormessage'>"+dem+"</b>");
								var titleTot = jQuery("#title_UK-FCL-00254_0").offset().top;
								var addHeight = parseInt(titleTot) - 170;
								jQuery('html,body').animate({ scrollTop: addHeight}, 1000);								
								wizardObj.stop();	
					}	
				}
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
             $("#div_tab"+fs).addClass("active");  
                    
        }); 
    }

    var initValidation = function() {
        validator = formEl.validate({
            //== Validate only visible fields
            ignore: ":hidden",
            //== Validation rules
             rules: {
                    	'UK-FCL-00212_0': {
						  maxlength: 500
						},
						'UK-FCL-00214_0': {
						  maxlength: 500
						},
						'UK-FCL-00217_0': {
						  maxlength: 100
						},
						'UK-FCL-00219_0': {
						  maxlength: 500
						},
						'UK-FCL-00221_0': {
						  maxlength: 1000
						},
						'UK-FCL-00223_0': {
						  maxlength: 2000
						}
                },
                messages: {
                    'UK-FCL-00212_0': {
					  maxlength: "Only 500 characters can be inserted in this field."
					},
					'UK-FCL-00214_0': {
					  maxlength: "Only 500 characters can be inserted in this field."
					},
					'UK-FCL-00217_0': {
					  maxlength: "Only 100 characters can be inserted in this field."
					},
					'UK-FCL-00219_0': {
					  maxlength: "Only 500 characters can be inserted in this field."
					},
					'UK-FCL-00221_0': {
					  maxlength: "Only 1000 characters can be inserted in this field."
					},
					'UK-FCL-00223_0': {
					  maxlength: "Only 2000 characters can be inserted in this field."
					}
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
							var mncb = $('input[name=middlenamecheckbox_a]:checked').val(); 
							if(mncb){
								valid = true;
							}else{
								valid = false;
								$(".form-control-feedback-addmore").remove();	
								$("#div_UK-FCL-00105_0").append("<div class='form-control-feedback-addmore'>Please enter the required information or select the check box</div>");
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