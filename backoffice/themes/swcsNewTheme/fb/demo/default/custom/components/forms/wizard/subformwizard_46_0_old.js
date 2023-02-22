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
         	if(wizardObj.currentStep==1){							
					var nofapp = $("#UK-FCL-00262_0").val();
					var totalRowCount = 0;          
				      totalRowCount =  $("#tbl_669 td").closest("tr").length;
					if(nofapp==totalRowCount){					
						$("#scd").text("");
					}else{	
					var scdem = "Please add details of the Shares Capital Details as per the number entered in this field 'No. of classes of shares' "; 
						if ($("#scd").length) {
							$("#scd").text(scdem);
		    			}else{
		    				$("#title_UK-FCL-00262_0").append('<b style="color:red;" id="scd">'+scdem+'</b>');
		    			}						
						var titleTot = jQuery("#title_UK-FCL-00262_0").offset().top;
						var addHeight = parseInt(titleTot) - 170;
						jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
						wizardObj.stop();	
					}

					$("#UK-FCL-00095_0").prop("disabled", false);
				}
         	var dnorr = $('input[name=UK-FCL-00240_0]:checked').val();
					if(dnorr=='In Range'){
						var myElement = document.getElementById("UK-FCL-00131_0");
						if(myElement){
					     	//$("#UK-FCL-00131_0").val();
					     	$("#UK-FCL-00131_0").prop('readonly',false);
						}
					}else{
						var myElement = document.getElementById("UK-FCL-00131_0");
						if(myElement){
							$("#UK-FCL-00131_0").prop('readonly',true);
							$("#UK-FCL-00131_0").val($("#UK-FCL-00241_0").val());
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
                    
                		'UK-FCL-00339_0': {
						  maxlength: 4000
						},
						'UK-FCL-00126_0': {
						  maxlength: 4000
						},
                		'UK-FCL-00113_0': {
						  maxlength: 4000
						},
						'UK-FCL-00116_0': {
						  maxlength: 4000
						},
                    	'UK-FCL-00341_0': {
						  maxlength: 200
						},
						'UK-FCL-00340_0': {
						  maxlength: 200
						},
						'UK-FCL-00342_0': {
						  maxlength: 200
						},
						'UK-FCL-00343_0': {
						  maxlength: 200
						},
						'UK-FCL-00093_0': {
						  maxlength: 200
						},
						'UK-FCL-00309_0': {
						  maxlength: 200
						}
						
                },
                messages: {
                    'UK-FCL-00339_0': {
						  maxlength: "Only 4000 characters can be inserted in this field. In case you want to provide additional information, then please attach a schedule in required format."
						},
						'UK-FCL-00126_0': {
						  maxlength: "Only 4000 characters can be inserted in this field. In case you want to provide additional information, then please attach a schedule in required format."
						},
                		'UK-FCL-00113_0': {
						  maxlength: "Only 4000 characters can be inserted in this field. In case you want to provide additional information, then please attach a schedule in required format."
						},
						'UK-FCL-00116_0': {
						  maxlength: "Only 4000 characters can be inserted in this field. In case you want to provide additional information, then please attach a schedule in required format."
						},
                    	'UK-FCL-00341_0': {
						  maxlength: "Only 200 characters can be inserted in this field."
						},
						'UK-FCL-00340_0': {
						  maxlength: "Only 200 characters can be inserted in this field."
						},
						'UK-FCL-00342_0': {
						  maxlength: "Only 200 characters can be inserted in this field."
						},
						'UK-FCL-00343_0': {
						  maxlength: "Only 200 characters can be inserted in this field."
						},
						'UK-FCL-00093_0': {
						  maxlength: "Only 200 characters can be inserted in this field."
						},
						'UK-FCL-00309_0': {
						  maxlength: "Only 200 characters can be inserted in this field."
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
				if(form_div_id==1){							
					var nofapp = $("#UK-FCL-00262_0").val();
					var totalRowCount = 0;          
				      totalRowCount =  $("#tbl_669 td").closest("tr").length;
					if(nofapp==totalRowCount){					
						$("#scd").text("");
					}else{	
					var scdem = "Please add details of the Shares Capital Details as per the number entered in this field 'No. of classes of shares' "; 
						if ($("#scd").length) {
							$("#scd").text(scdem);
		    			}else{
		    				$("#title_UK-FCL-00262_0").append('<b style="color:red;" id="scd">'+scdem+'</b>');
		    			}						
						var titleTot = jQuery("#title_UK-FCL-00262_0").offset().top;
						var addHeight = parseInt(titleTot) - 170;
						jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
						valid = false;
						wizardObj.stop();	
					}

					$("#UK-FCL-00095_0").prop("disabled", false);
				}
				if(form_div_id==3)
				{	
				 			
					var nofapp = $("#UK-FCL-00131_0").val();
					var totalRowCount = 0;          
				    totalRowCount =  $("#tbl_1239 td").closest("tr").length;
					if(nofapp==totalRowCount){					
						$("#directorerrormessage").text("");
					}else{	
					var dem = "Please add details of the Director as per the number entered in this field 'No. of directors of the company as of this date are' "; 
						if ($("#directorerrormessage").length) {
							$("#directorerrormessage").text(dem);
		    			}else{
		    				$("#title_UK-FCL-00131_0").append('<b style="color:red;" id="directorerrormessage">'+dem+'</b>');
		    			}						
						//$("#title_UK-FCL-").append("<b style='color:red;' class='amalgamatingDetail'></b>");
								var titleTot = jQuery("#title_UK-FCL-00131_0").offset().top;
								var addHeight = parseInt(titleTot) - 170;
								jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
								valid = false;
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