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
        /* wizard.on('beforeNext', function(wizardObj) {
            if (validator.form() !== true) {
                wizardObj.stop();  // don't go to the next step
            }
        })
		*/
        //== Change event
       /*  wizard.on('change', function(wizard) {
            mApp.scrollTop();            
        }); */

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
                    'UK-FCL-00189_0': {	
						minlength:0,
						maxlength:200,
						'uniqueproposedname': true
					},
                },
                messages: {
                     'UK-FCL-00189_0': {
					  maxlength: "Name should have maximum 200 characters."
					},
            },				
			highlight: function(element) {
				$(element).parents('.form-group').addClass('has-error');
				
			},
			unhighlight: function(element) {
				$(element).parents('.form-group').removeClass('has-error');
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
				if(form_div_id==1)
				{
					
						
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
		
	$.validator.setDefaults({
		  onkeyup: function () {
			var originalKeyUp = $.validator.defaults.onkeyup;
			var customKeyUp =  function (element, event) {
			  if ($("#UK-FCL-00189_0")[0] === element) {
				return false;
			  }
			  else {
				return originalKeyUp.call(this, element, event);
			  }
			}

			return customKeyUp;
		  }()
		});
	
		var msg="", $valid = false;
		jQuery.validator.addMethod("uniqueproposedname", function(value, element) {
			console.log("1function");
			//debugger;
			var name = element.name; 
			$.ajax({
				type: "POST",
				url: "/backoffice/infowizard/subFormRegistrationCharityBoard/CheckProposedName",
				data: "getProposedWord="+value,
				dataType:"html",
				async:false,
				success: function(result) {
					
					console.log(result);
					$(".reserevdname").remove();
					if(result=='ILLEGAL_ENDING'){						
							msg = 	"Proposed name should not contain legal ending.";
							$valid =  false;					
						}
						if(result=='BANNED_WORDS'){						
							msg = 	"Proposed name contains prohibited word, please propose other name";
							$valid =  false;					
						}	
						if(result=='BANNED_WORDS_PART'){						
							msg = 	"Proposed name is too close to prohibited word, please propose another name or you still want to proceed";
							$valid = true;	
							color = '#E77200';
						}
						if(result=='LIMITEDSUFFIXERROR'){						
							msg = 	"Please insert any one of following as the legal ending of the proposed name -  'Incorporated, Inc., Limited, Ltd., Corporation, Corp.'";
							$valid = false;	
						}
						if(result=='ICCSUFFIXERROR'){						
							msg = 	"Please insert any one of following as the legal ending of the proposed name -   'Incorporated cell company or ICC";
							$valid = false;	
						}
						if(result=='SCCSUFFIXERROR'){						
							msg = 	"Please insert any one of following as the legal ending of the proposed name -   'Segregated Cell Company or SCC";
							$valid = false;	
						}
						if(result=='PTCSUFFIXERROR'){						
							msg = 	"Please insert any one of following as the legal ending of the proposed name - 'Private Trust Company or PTC";
							$valid = false;	
						}
						if(result=='COMPANY_RESERVED'){					
							msg = 	"Proposed name matches with the name of exisiting company name, please propose another name";						
							$valid = false;					
						}
						if(result=='COMPANY_RESERVED_PART'){					
							msg = 	"The proposed name is similar to the name of an existing entity. You may choose another name or you can proceed with this one. If you proceed, the name will be reviewed by a CAIPO Officer to make sure it is distinguishable from the one(s) on record. ";						
							$valid = true;	
							color = '#E77200';						
						}
						if(result=='SOCIETY_NAME'){					
							msg = 	"Proposed name matches with the name of exisiting society name, please propose another name";						
							$valid = false;	
						}
						if(result=='SOCIETY_NAME_PART'){					
							msg = 	"The proposed name is similar to the name of an existing entity. You may choose another name or you can proceed with this one. If you proceed, the name will be reviewed by a CAIPO Officer to make sure it is distinguishable from the one(s) on record. ";						
							$valid = true;		
							color = '#E77200';
						}
						if(result=='CHARITY_NAME'){	
							msg = 	"Proposed name matches with the name of exisiting charity name, please propose another name";						
							$valid = false;	
						}
						if(result=='CHARITY_NAME_PART'){
							msg = 	"The proposed name is similar to the name of an existing entity. You may choose another name or you can proceed with this one. If you proceed, the name will be reviewed by a CAIPO Officer to make sure it is distinguishable from the one(s) on record. ";					
							$valid = true;		
							color = '#E77200';	
						}	
						if(result=='MINISTRY_DEPARTMENT'){					
							msg = 	"Proposed name matches with the name of exisiting ministry name, please propose another name";						
							$valid = false;				
						}
						if(result=='MINISTRY_DEPARTMENT_PART'){					
							msg = 	"The proposed name is similar to the name of an existing entity. You may choose another name or you can proceed with this one. If you proceed, the name will be reviewed by a CAIPO Officer to make sure it is distinguishable from the one(s) on record. ";						
							$valid = true;	
							color = '#E77200';
						}
						if(result=='BUSINESS_NAME'){					
							msg = 	"Proposed name matches with the name of exisiting business name, please propose another name";						
							$valid = false;							
						}
						if(result=='BUSINESS_NAME_PART'){					
							msg = 	"The proposed name is similar to the name of an existing entity. You may choose another name or you can proceed with this one. If you proceed, the name will be reviewed by a CAIPO Officer to make sure it is distinguishable from the one(s) on record. ";						
							$valid = true;
							color = '#E77200';
						}
						if(result=='POLTICAL_PARTY'){						
							msg ="Proposed name matches with the name of exisiting political party, please propose another name";
							$valid = false;	
						}
						if(result=='POLTICAL_PARTY_PART'){						
							msg ="Proposed name is too close to the existing political party, please propose another name or you still want to proceed";
							$valid = true;
							color = '#E77200';
						}
						if(result=='UNIVERSITY_NAME'){						
							msg ="Proposed name matches with the name of existing university, please propose another name";
							$valid = false;	
						}
						if(result=='UNIVERSITY_NAME_PART'){						
							msg ="Proposed name is too close to the existing university, please propose another name or you still want to proceed";
							$valid = true;
							color = '#E77200';
						}
						if(result=='ASSOCIATION_NAME'){	
							msg ="Proposed name matches with the name of existing professional association, please propose another name";
							$valid = false;	
						} 
						if(result=='ASSOCIATION_NAME_PART'){						
							msg ="Proposed name is too close to existing professional association, please propose another name or you still want to proceed";	
							$valid = true;
							color = '#E77200';
							
						}
						if(result=='0'){
							msg = "Name is available, please proceed ahead";
							$valid = true;
							color = 'green';
						}	
				}									
			});			
			/* console.log(msg);
			console.log($valid); */
			if($valid==true)
			{	
				if(msg){
					$("#"+name).after("<div id="+name+"-error' class='form-control-feedback-error3 reserevdname' style='color:"+color+"'>"+msg+"</div>");
				}
				return $valid;
			}else{
				if(msg){
					$.validator.messages["uniqueproposedname"] = msg;
				}
				return $valid;
			}
			
		},'');	
		
		/* jQuery.validator.addMethod("proposed_name_compare", function(value, element) {
			if(("UK-FCL-00015_0" == "UK-FCL-00016_0") || ("UK-FCL-00015_0" == "UK-FCL-00017_0")  || ("UK-FCL-00016_0" == "UK-FCL-00017_0")){
			return false;
			}else{
			return true;	
			}	
		}, "Proposed name should not be same"); */
	
	WizardDemo.init()
   
});