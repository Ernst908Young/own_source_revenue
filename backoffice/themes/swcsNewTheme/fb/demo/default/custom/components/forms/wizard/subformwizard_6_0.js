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
         
            if (validator.form() !== true) {
                wizardObj.stop();  // don't go to the next step
            }
        })
		
        //== Change event
        //  wizard.on('change', function(wizard) {
        //     mApp.scrollTop();            
        // }); 

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
                    'UK-FCL-00111_0': {	
						minlength:5,
						maxlength:200,
						'uniqueproposedname': true
					},
                },
                messages: {
                     'UK-FCL-00111_0': {
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
				//alert(form_div_id);
				var valid = true;
				
				if(form_div_id==1){


					 //Trustees Section

			     var trusteesFname = $("input[name='UK-FCL-00301_0[]']")
			                  .map(function(){return $(this).val();}).get();

			     var trusteesMname = $("input[name='UK-FCL-00133_0[]']")
			                  .map(function(){return $(this).val();}).get();
			                  

			      var trusteesLname = $("input[name='UK-FCL-00106_0[]']")
			                  .map(function(){return $(this).val();}).get();


			      //Secretary Section

			     var secretaryFname = $("input[name='UK-FCL-00132_0[]']")
			                  .map(function(){return $(this).val();}).get();

			     var secretaryMname = $("input[name='UK-FCL-00105_0[]']")
			                  .map(function(){return $(this).val();}).get();
			                  

			      var secretaryLname = $("input[name='UK-FCL-00317_0[]']")
			                  .map(function(){return $(this).val();}).get();

			       
			      //Treasurer Section

			     var treasurerFname = $("input[name='UK-FCL-00150_0[]']")
			                  .map(function(){return $(this).val();}).get();

			     var treasurerMname = $("input[name='UK-FCL-00316_0[]']")
			                  .map(function(){return $(this).val();}).get();
			                  

			      var treasurerLname = $("input[name='UK-FCL-00324_0[]']")
			                  .map(function(){return $(this).val();}).get();


			     // Auditor Section

			     var audotirFname = $("#UK-FCL-00172_0").val();
			                  
			     var audotirMname = $("#UK-FCL-00466_0").val();         

			     var audotirLname = $("#UK-FCL-00467_0").val();

			                  
			    var indiviualVal = $("#UK-FCL-00477_0").val();


			 if(indiviualVal == 'Individual'){

			    var newArrayAuditor = audotirFname +' '+ audotirMname +' '+ audotirLname;

			    var newArrayTrustees = trusteesFname.map(function(value, index) {
			      return value +' '+ trusteesMname[index] +' '+ trusteesLname[index];
			    });

			    var newArraySecretary = secretaryFname.map(function(value, index) {
			      return value +' '+ secretaryMname[index] +' '+ secretaryLname[index];
			    });


			    var newArrayTreasurer = treasurerFname.map(function(value, index) {
			      return value +' '+ treasurerMname[index] +' '+ treasurerLname[index];
			    });


			    if(jQuery.inArray(newArrayAuditor, newArrayTrustees) != -1) {

			        $(".check_name").remove();
			        $("#title_UK-FCL-00477_0").append("<b style='color:red; margin-left:2em;' class='check_name'>Trustee cannot be the auditor of the charity. An auditor should be an independent person, so please revise the details of auditor.</b>");

			        var titleTot = jQuery("#title_UK-FCL-00477_0").offset().top;
			        var addHeight = parseInt(titleTot) - 1;
			        jQuery('html,body').animate({ scrollTop: addHeight}, 10); 
			         wizardObj.stop();

			    }else{

			        $(".check_name").hide();

			    }

			    if(jQuery.inArray(newArrayAuditor, newArraySecretary) != -1) {

			        $(".check_name").remove();
			        $("#title_UK-FCL-00477_0").append("<b style='color:red; margin-left:2em;' class='check_name'>Secretary cannot be the auditor of the charity. An auditor should be an independent person, so please revise the details of auditor.</b>");

			        var titleTot = jQuery("#title_UK-FCL-00477_0").offset().top;
			        var addHeight = parseInt(titleTot) - 1;
			        jQuery('html,body').animate({ scrollTop: addHeight}, 10); 
			         wizardObj.stop();

			    }else{

			        $(".check_name").hide();

			    }


			    if(jQuery.inArray(newArrayAuditor, newArrayTreasurer) != -1) {

			        $(".check_name").remove();
			        $("#title_UK-FCL-00477_0").append("<b style='color:red; margin-left:2em;' class='check_name'>Treasurer cannot be the auditor of the charity. An auditor should be an independent person, so please revise the details of auditor.</b>");

			        var titleTot = jQuery("#title_UK-FCL-00477_0").offset().top;
			        var addHeight = parseInt(titleTot) - 1;
			        jQuery('html,body').animate({ scrollTop: addHeight}, 10); 
			         wizardObj.stop();

			    }else{

			        $(".check_name").hide();
			        
			    }

			      
			    }

			     var nofTrustee = $("#UK-FCL-00452_0").val();

			     var totalRowCount_1 = 0;          
			     totalRowCount_1 =  $("#tbl_1859 td").closest("tr").length;

			     if(nofTrustee< 3 || totalRowCount_1 != nofTrustee){
			        
			       $(".check_number").remove();
			      
			        $("#title_UK-FCL-00452_0").append("<b style='color:red; margin-left:2em;' class='check_number'>Please add details of the Trustees as per the number entered in this field No. of Trustees in the Charity.</b>");

			        var titleTot = jQuery("#title_UK-FCL-00452_0").offset().top;
			        var addHeight = parseInt(titleTot) - 170;
			        jQuery('html,body').animate({ scrollTop: addHeight}, 1000);

			        $("#UK-FCL-00452_0").css("border", "1px solid #e73d4a");
			         wizardObj.stop();
			         
			     }

// bank detail validation
			     var nofb = $("#UK-FCL-00167_0").val();

			     var totalRowCount_1 = 0;          
			     totalRowCount_1b =  $("#tbl_2180 td").closest("tr").length;

			     if(nofb!=totalRowCount_1b){
			        
			       $(".check_number").remove();
			      
			        $("#title_UK-FCL-00167_0").append("<b style='color:red; margin-left:2em;' class='check_number'>Please add Bank details as per the No. of Banks at which the accounts of the Charity is maintained .</b>");

			        var titleTot = jQuery("#title_UK-FCL-00167_0").offset().top;
			        var addHeight = parseInt(titleTot) - 170;
			        jQuery('html,body').animate({ scrollTop: addHeight}, 1000);

			        $("#UK-FCL-00452_0").css("border", "1px solid #e73d4a");
			         wizardObj.stop();
			         
			     }
                
             // property details validation 
            
              /*var nofp = $("#UK-FCL-00176_0").val();

			     var totalRowCount_1 = 0;          
			     totalRowCount_1p =  $("#tbl_2156 td").closest("tr").length;

			     if(nofp!=totalRowCount_1p){
			        
			       $(".check_number").remove();
			      
			        $("#title_UK-FCL-00176_0").append("<b style='color:red; margin-left:2em;' class='check_number'>Please add Property details as per the No.of properties owned by Charity .</b>");

			        var titleTot = jQuery("#title_UK-FCL-00176_0").offset().top;
			        var addHeight = parseInt(titleTot) - 170;
			        jQuery('html,body').animate({ scrollTop: addHeight}, 1000);

			        $("#UK-FCL-00452_0").css("border", "1px solid #e73d4a");
			         wizardObj.stop();
			         
			     }*/
								
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
			  if ($("#UK-FCL-00111_0")[0] === element) {
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


function submitpertial(){
	$.ajax({
		url:'/backoffice/infowizard/SubFormRegistrationCharity/SaveDataPartial',
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