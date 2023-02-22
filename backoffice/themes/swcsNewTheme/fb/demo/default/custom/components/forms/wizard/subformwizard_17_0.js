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
                    'UK-FCL-00418_0': {	
						minlength:5,
						maxlength:300,
						'uniqueproposedname': true
					},
                },
                messages: {
                     'UK-FCL-00418_0': {
					  maxlength: "Name should have maximum 300 characters."
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
				
				var ff416 = $("#UK-FCL-00416_0").val();
				var myarr = ff416.toString().split(",");	
				console.log(myarr);
				 if (myarr.includes('Change of persons with names in full of new individuals')) {
				     	var totalRowCount_1 = 0;          
                         totalRowCount_1 =  $("#tbl_1705 td").closest("tr").length;
                         if(totalRowCount_1 <= 0){  
                         $(".check_number").remove();                                         
                            $("#details1").append("<br><b style='color:red;' class='check_number'>Please add atleast one Details.</b>");
                            var titleTot = jQuery("#details1").offset().top;
                            var addHeight = parseInt(titleTot) - 170;
                            jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
                            valid=false;                     
                         }
				 }

				 if(valid==true){
				 	if (myarr.includes('Change of the name of persons who own the firm or business')) {
				      	var totalRowCount_2 = 0;          
                         totalRowCount_2 =  $("#tbl_1726 td").closest("tr").length;
                         if(totalRowCount_2 <= 0){  
                         $(".check_number").remove();                                         
                            $("#details2").append("<br><b style='color:red;' class='check_number'>Please add atleast one Details.</b>");
                            var titleTot = jQuery("#details2").offset().top;
                            var addHeight = parseInt(titleTot) - 170;
                            jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
                            valid=false;                     
                         }
				    }
				 }

				    
				 if(valid==true){
				    if (myarr.includes('Change in Partner details where partner is a company')) {
				     	var totalRowCount_3 = 0;          
                         totalRowCount_3 =  $("#tbl_1732 td").closest("tr").length;
                         if(totalRowCount_3 <= 0){  
                         $(".check_number").remove();                                         
                            $("#details3").append("<br><b style='color:red;' class='check_number'>Please add atleast one Details.</b>");
                            var titleTot = jQuery("#details3").offset().top;
                            var addHeight = parseInt(titleTot) - 170;
                            jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
                            valid=false;                     
                         }
				    }
				}
				 if(valid==true){   
				    if (myarr.includes('Nationality of persons who own firm or business')) {
				      var totalRowCount_4 = 0;          
                         totalRowCount_4 =  $("#tbl_1738 td").closest("tr").length;
                         if(totalRowCount_4 <= 0){  
                         $(".check_number").remove();                                         
                            $("#details4").append("<br><b style='color:red;' class='check_number'>Please add atleast one Details.</b>");
                            var titleTot = jQuery("#details4").offset().top;
                            var addHeight = parseInt(titleTot) - 170;
                            jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
                            valid=false;                     
                         }
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
		
	$.validator.setDefaults({
		  onkeyup: function () {
			var originalKeyUp = $.validator.defaults.onkeyup;
			var customKeyUp =  function (element, event) {
			  if ($("#UK-FCL-00418_0")[0] === element) {
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
						msg = 	"Proposed name is too close to the name of exisiting company name, please propose another name or you still want to proceed";						
						$valid = true;	
						color = '#E77200';						
					}
					if(result=='SOCIETY_NAME'){					
						msg = 	"Proposed name matches with the name of exisiting society name, please propose another name";						
						$valid = false;	
					}
					if(result=='SOCIETY_NAME_PART'){					
						msg = 	"Proposed name is too close to the name of exisiting society name, please propose another name or you still want to proceed";						
						$valid = true;		
						color = '#E77200';
					}
					if(result=='MINISTRY_DEPARTMENT'){					
						msg = 	"Proposed name matches with the name of exisiting ministry name, please propose another name";						
						$valid = false;				
					}
					if(result=='MINISTRY_DEPARTMENT_PART'){					
						msg = 	"Proposed name is too close to the name of exisiting ministry name, please propose another name or you still want to proceed";						
						$valid = true;	
						color = '#E77200';
					}
					if(result=='BUSINESS_NAME'){					
						msg = 	"Proposed name matches with the name of exisiting business name, please propose another name";						
						$valid = false;							
					}
					if(result=='BUSINESS_NAME_PART'){					
						msg = 	"Proposed name is too close to the name of exisiting business name, please propose another name or you still want to proceed";						
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


function submitpertial(){
$.ajax({
			url:'/backoffice/infowizard/subFormStatementGivingNoticeOfChangesForm3/SaveDataPartial',
			type:'post',
			data:$("#m_form").serialize(),
			dataType:'json',
			success:function(response){
				if(response.success && response.hiddenfield ){							
					$('<input>').attr({
						type: 'hidden',
						id: 'submission_id',
						name: 'submission_id',
						value:response.application_id
					}).appendTo('#m_form');							
				}
			},
			error:function(error){
				
			}
			
		});				
        mApp.scrollTop();
}