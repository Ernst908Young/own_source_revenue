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
        /* wizard.on('change', function(wizard) {
            if (wizard.getStep() === 1) {
                 alert(1);
            }           
        }); */ 
    }

    var initValidation = function() {
        validator = formEl.validate({
            //== Validate only visible fields
            ignore: ":hidden",
            //== Validation rules
            rules: {
                'UK-FCL-00046_0': {	
					/* minlength:5, */
					noSpace: true,
					maxlength:300,
					'uniqueproposedname': true
				},
				'UK-FCL-00047_0': {
					/* minlength:5, */
					noSpace: true,
					maxlength:300,		
					'uniqueproposedname': true
				},
				'UK-FCL-00048_0': {	
					/* minlength:5, */
					noSpace: true,
					maxlength:300,
					'uniqueproposedname': true
				},
				'UK-FCL-00015_0':{
					/* minlength:5, */
					noSpace: true,
					maxlength:300,						
					'uniqueproposedname': true
				},
				'UK-FCL-00016_0':{
					/* minlength:5, */
					noSpace: true,
					maxlength:300,						
					'uniqueproposedname': true
				},
				'UK-FCL-00017_0':{
					/* minlength:5, */
					noSpace: true,
					maxlength:300,						
					'uniqueproposedname': true
				},
				'UK-FCL-00056_0':{
					/* minlength:5, */
					noSpace: true,
					maxlength:300,
					'uniqueproposedname': true
				},
				'UK-FCL-00050_0': {
				  maxlength: 4000
				},
				'UK-FCL-00027_0': {
				  maxlength: 1000
				},
				'UK-FCL-00051_0':{
				  maxlength: 1000	
				},	
				'UK-FCL-00058_0': {
				  maxlength: 4000
				},
				'UK-FCL-00244_0': {
				  maxlength: 4000
				},
				'UK-FCL-00325_0':{
				  maxlength: 1000
				},
				'UK-FCL-00326_0':{
				  maxlength: 1000
				}

            },
            //== Validation messages
            messages: {
				'UK-FCL-00046_0': {
				  maxlength: "Name should have maximum 300 characters."
				},
			   'UK-FCL-00047_0': {
				  maxlength: "Name should have maximum 300 characters."
				},
			   'UK-FCL-00048_0': {
				  maxlength: "Name should have maximum 300 characters."
				},
			   'UK-FCL-00015_0': {
				  maxlength: "Name should have maximum 300 characters."
				},
			   'UK-FCL-00016_0': {
				  maxlength: "Name should have maximum 300 characters."
				},
			   'UK-FCL-00017_0': {
				  maxlength: "Name should have maximum 300 characters."
				},
			   'UK-FCL-00056_0': {
				  maxlength: "Name should have maximum 300 characters."
				},
				'UK-FCL-00050_0': {
				  maxlength: "Only 4000 characters can be inserted in this field. In case you want to provide additional information, then please attach a schedule in required format."
				},
				'UK-FCL-00027_0': {
				  maxlength: "Only 1000 characters can be inserted in this field. In case you want to provide additional information, then please attach a schedule in required format."
				},
				'UK-FCL-00051_0': {
				  maxlength: "Only 1000 characters can be inserted in this field. In case you want to provide additional information, then please attach a schedule in required format."
				},
				'UK-FCL-00058_0': {
				  maxlength: "Only 4000 characters can be inserted in this field. In case you want to provide additional information, then please attach a schedule in required format."
				},
				'UK-FCL-00244_0': {
				  maxlength: "Only 4000 characters can be inserted in this field. In case you want to provide additional information, then please attach a schedule in required format."
				},
				'UK-FCL-00325_0':{
				  maxlength: "Only 1000 characters can be inserted in this field. In case you want to provide additional information, then please attach a schedule in required format under document listing page at the end."
				},
				'UK-FCL-00326_0':{
				  maxlength: "Only 1000 characters can be inserted in this field. In case you want to provide additional information, then please attach a schedule in required format under document listing page at the end."
				}
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
				if (element.parent('.input-group').length) {
				  error.insertAfter(element.parent());					  
				} else {
				  error.insertAfter(element);
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
					$(".amalgamatingDetail").remove();	
					//check in corporate partner
					$(".corporateDetail").remove();	
					$(".indiviDetail").remove();	
					$(".individualDetail").remove();							
					var lengthofAddedComp = $("#tbl_36").find("tbody tr").length;
					//check in case of partnership firm
					if($("#UK-FCL-00021_0").val()>0 && ($('tr', $('#tbl_36').find('tbody')).length < 1))
					{
						var amalgamating_comp_details_div = $("#add_more_36").css("display");
						if(amalgamating_comp_details_div != "none") {
							var amalgamatingCompDetail = 0;
						} else {
							var amalgamatingCompDetail = 1;
						}
												
						if(amalgamatingCompDetail == 1)
						{
							$("#title_UK-FCL-00012_0").append("<b style='color:red;' class='amalgamatingDetail'>Please add details of the Amalgamating Company as per the number entered in this field 'No. of Amalgamating Companies'</b>");
							var titleTot = jQuery("#title_UK-FCL-00012_0").offset().top;
							var addHeight = parseInt(titleTot) - 170;
							jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
							valid = false;
							wizardObj.stop();					
						}
					}			
					/* alert(lengthofAddedComp);
						alert($("#UK-FCL-00021_0").val()); */ 
					if(lengthofAddedComp != $("#UK-FCL-00021_0").val())
					{						
						$("#title_UK-FCL-00012_0").append("<b style='color:red;' class='amalgamatingDetail'>Please add details of the Amalgamating Company as per the number entered in this field 'No. of Amalgamating Companies'</b>");
						var titleTot = jQuery("#title_UK-FCL-00012_0").offset().top;
						var addHeight = parseInt(titleTot) - 170;
						jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
						valid = false;
						wizardObj.stop();								
					}
					
					//check in business name individual								
					/* if($("#UK-FCL-00044_0").val()==3 && $("#UK-FCL-00063_0").val()>0 && ($('tr', $('#tbl_95').find('tbody')).length < 1))
					{
						var individual_details_div = $("#add_more_95").css("display");
						if(individual_details_div != "none") {
							var individualDetail = 0;
						} else {
							var individualDetail = 1;
						}
												
						if(individualDetail == 1)
						{
							$("#title_UK-FCL-00064_0").append("<b style='color:red;' class='individualDetail'>Please Add At least One Individual Details.</b>");
							var titleTot = jQuery("#title_UK-FCL-00064_0").offset().top;
							var addHeight = parseInt(titleTot) - 170;
							jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
							valid = false;
							wizardObj.stop();						
						}
					} 
					
					var lengthofAddedIndiduals = $("#tbl_95").find("tbody tr").length;
					if(lengthofAddedIndiduals != $("#UK-FCL-00063_0").val())
					{						
						$("#title_UK-FCL-00064_0").append("<b style='color:red;' class='individualDetail'>Please add details of the Individual Details as per the number entered in this field 'Number of Individuals'</b>");
						var titleTot = jQuery("#title_UK-FCL-00064_0").offset().top;
						var addHeight = parseInt(titleTot) - 170;
						jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
						valid = false;
						wizardObj.stop();								
					}*/
					
					var type_of_reg = $("#UK-FCL-00375_0").val();
					var number_of_indiv = $("#UK-FCL-00063_0").val();
					var number_of_corporate = $("#UK-FCL-00246_0").val();				
						
					/*if(type_of_reg==2 && number_of_indiv==1 && number_of_corporate==0)
					{
							
					}	
					
					if(type_of_reg==2 && number_of_indiv==0 && number_of_corporate==1)
					{
						$("#title_UK-FCL-00375_0").append("<b style='color:red;' class='indiviDetail'>Please update the field 'no. of individuals' or the 'no. of corporate partners', as the type of registration selected is 'Firm Registration'</b>");
						var titleTot = jQuery("#title_UK-FCL-00375_0").offset().top;
						var addHeight = parseInt(titleTot) - 170;
						jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
						valid = false;
						wizardObj.stop();	
					}

					if(type_of_reg==2 && number_of_indiv==0 && number_of_corporate==0)
					{
						$("#title_UK-FCL-00375_0").append("<b style='color:red;' class='indiviDetail'>Please update the field 'no. of individuals' or the 'no. of corporate partners', as the type of registration selected is 'Firm Registration'</b>");
						var titleTot = jQuery("#title_UK-FCL-00375_0").offset().top;
						var addHeight = parseInt(titleTot) - 170;
						jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
						valid = false;
						wizardObj.stop();	
					}	*/

					$(".individual").remove();
					if(type_of_reg==1){
						if(number_of_indiv==1){							
							var totalRowCount = 0;          
						      totalRowCount =  $("#tbl_95 td").closest("tr").length;
							if(1==totalRowCount){					
								$("#scd").text("");
							}else{	
							var scdem = "Please add details of the APPLICANT DETAILS : INDIVIDUAL(S) as per the number entered in this field 'Number of Individuals' "; 
								if ($("#scd").length) {
									$("#scd").text(scdem);
				    			}else{
				    				$("#title_UK-FCL-00064_0").append('<b style="color:red;" id="scd">'+scdem+'</b>');
				    			}						
								var titleTot = jQuery("#title_UK-FCL-00064_0").offset().top;
								var addHeight = parseInt(titleTot) - 170;
								jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
								wizardObj.stop();	
							}

						}else{
							$("#title_UK-FCL-00375_0").append("<b style='color:red;' class='individual'>No. of individual should be 1 in case of Individual registration.</b>");
							var titleTot = jQuery("#title_UK-FCL-00375_0").offset().top;
							var addHeight = parseInt(titleTot) - 170;
							jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
							valid = false;
							wizardObj.stop();
						}						
							
					}else{
						var frc = parseInt(number_of_indiv)+parseInt(number_of_corporate);
						if(frc<2){
							$("#title_UK-FCL-00375_0").append("<b style='color:red;' class='indiviDetail'>Minimum number to be select is 02 Please update the field 'no. of individuals' or the 'no. of corporate partners' , as the type of registration selected is 'Firm Registration'</b>");
							var titleTot = jQuery("#title_UK-FCL-00375_0").offset().top;
							var addHeight = parseInt(titleTot) - 170;
							jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
							valid = false;
							wizardObj.stop();
						}else{
							
							var tbl_95Count = 0;          
						      tbl_95Count =  $("#tbl_95 td").closest("tr").length;
							if(number_of_indiv==tbl_95Count){					
								$("#scd").text("");
							}else{	
							var scdem = "Please add details of the APPLICANT DETAILS : INDIVIDUAL(S) as per the number entered in this field 'Number of Individuals' "; 
								if ($("#scd").length) {
									$("#scd").text(scdem);
				    			}else{
				    				$("#title_UK-FCL-00064_0").append('<b style="color:red;" id="scd">'+scdem+'</b>');
				    			}						
								var titleTot = jQuery("#title_UK-FCL-00064_0").offset().top;
								var addHeight = parseInt(titleTot) - 170;
								jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
								wizardObj.stop();	
							}


							var tbl_580Count = 0;          
						      tbl_580Count =  $("#tbl_580 td").closest("tr").length;
							if(number_of_corporate==tbl_580Count){					
								$("#pcd").text("");
							}else{	
							var pcdem = "Please add details of the PARTNER CORPORATE DETAILS as per the number entered in this field 'No. of Corporate Partners' "; 
								if ($("#pcd").length) {
									$("#pcd").text(pcdem);
				    			}else{
				    				$("#title_UK-FCL-00332_0").append('<b style="color:red;" id="pcd">'+pcdem+'</b>');
				    			}						
								var titleTot = jQuery("#title_UK-FCL-00332_0").offset().top;
								var addHeight = parseInt(titleTot) - 170;
								jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
								wizardObj.stop();	
							}
						}					
						
					}					
					
					/*var lengthofCorporateIndiduals = $("#tbl_580").find("tbody tr").length;
					if(lengthofCorporateIndiduals != $("#UK-FCL-00246_0").val())
					{						
						$("#title_UK-FCL-00246_0").append("<b style='color:red;' class='corporateDetail'>Please add details of the Number of corporate as per the number entered in this field 'No. of Corporate Partners'</b>");
						var titleTot = jQuery("#title_UK-FCL-00246_0").offset().top;
						var addHeight = parseInt(titleTot) - 170;
						jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
						valid = false;
						wizardObj.stop();								
					}*/
					
					
					
					$(".proposedname").remove();
					
					if($("#UK-FCL-00044_0").val()==1 && $("#UK-FCL-00046_0").val()!='' && $("#UK-FCL-00047_0").val()!='' && $("#UK-FCL-00048_0").val()!='' && (($("#UK-FCL-00046_0").val()===$("#UK-FCL-00047_0").val()) || ($("#UK-FCL-00047_0").val()===$("#UK-FCL-00048_0").val())  || ($("#UK-FCL-00046_0").val()===$("#UK-FCL-00048_0").val())))
					{
						$("#title_UK-FCL-00046_0").append("<b style='color:red;' class='proposedname'>Proposed name should not be same.</b>");
						var titleTot = jQuery("#title_UK-FCL-00046_0").offset().top;
						var addHeight = parseInt(titleTot) - 170;
						jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
						valid = false;
						wizardObj.stop();							
					}
					
					if($("#UK-FCL-00044_0").val()==2 && $("#UK-FCL-00015_0").val()!='' && $("#UK-FCL-00016_0").val()!='' && $("#UK-FCL-00017_0").val()!='' && (($("#UK-FCL-00015_0").val()===$("#UK-FCL-00016_0").val()) || ($("#UK-FCL-00016_0").val()===$("#UK-FCL-00017_0").val())  || ($("#UK-FCL-00015_0").val()===$("#UK-FCL-00017_0").val())))
					{
						$("#title_UK-FCL-00012_0").append("<b style='color:red;' class='proposedname'>Proposed name should not be same.</b>");
						var titleTot = jQuery("#title_UK-FCL-00012_0").offset().top;
						var addHeight = parseInt(titleTot) - 170;
						jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
						valid = false;
						wizardObj.stop();							
					}
					
					
					/* if($("#UK-FCL-00375_0").val()==2 && $("#UK-FCL-00063_0").val() < 2){
						$("#title_UK-FCL-00375_0").append("<b style='color:red;' class='individual'>No. of individual should be more than 1 in case of Firm registration.</b>");
						var titleTot = jQuery("#title_UK-FCL-00375_0").offset().top;
						var addHeight = parseInt(titleTot) - 170;
						jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
						valid = false;
						wizardObj.stop();	
					} */
						
				}
				if(valid==true){
					
					mApp.unprogress(btn), swal({
						title: "",
						text: "Application form filled successfully. Please upload documents.",
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

		jQuery.validator.addMethod("noSpace", function(value, element) { 
		  return value == '' || value.trim().length != 0; 
		}, "Please enter a valid name.");
		
		$.validator.setDefaults({
		  onkeyup: function () {
			var originalKeyUp = $.validator.defaults.onkeyup;
			var customKeyUp =  function (element, event) {
			  if ($("#UK-FCL-00046_0")[0] === element) {
				return false;
			  }
			  else {
				return originalKeyUp.call(this, element, event);
			  }
			}

			return customKeyUp;
		  }()
		});
		
		$.validator.setDefaults({
		  onkeyup: function () {
			var originalKeyUp = $.validator.defaults.onkeyup;
			var customKeyUp =  function (element, event) {
			  if ($("#UK-FCL-00047_0")[0] === element) {
				return false;
			  }
			  else {
				return originalKeyUp.call(this, element, event);
			  }
			}

			return customKeyUp;
		  }()
		});
		
		$.validator.setDefaults({
		  onkeyup: function () {
			var originalKeyUp = $.validator.defaults.onkeyup;
			var customKeyUp =  function (element, event) {
			  if ($("#UK-FCL-00048_0")[0] === element) {
				return false;
			  }
			  else {
				return originalKeyUp.call(this, element, event);
			  }
			}

			return customKeyUp;
		  }()
		});
		
		$.validator.setDefaults({
		  onkeyup: function () {
			var originalKeyUp = $.validator.defaults.onkeyup;
			var customKeyUp =  function (element, event) {
			  if ($("#UK-FCL-00056_0")[0] === element) {
				return false;
			  }
			  else {
				return originalKeyUp.call(this, element, event);
			  }
			}

			return customKeyUp;
		  }()
		});
	
		var msg="",color="red",$valid = false;
		jQuery.validator.addMethod("uniqueproposedname", function(value, element) {
			
			if(value != ''){				
				var name = element.name; 
				var ncfec = $("#UK-FCL-00032_0").val();
				if(ncfec!=1){
					var btype = $('#UK-FCL-00013_0').val(); 				
				$.ajax({
					type: "POST",
					url: "/backoffice/infowizardtwo/subFormCompanyNameReservation/CheckProposedName",
					data: {"getProposedWord":value,"business_type":btype},
					async:false,
					success: function(result) {
						$(".reserevdname").remove();
						//console.log(result);
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
			}else{
				$("#"+name).after("<div id="+name+"-error' class='form-control-feedback-error3'></div>");
					return true;
				}
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