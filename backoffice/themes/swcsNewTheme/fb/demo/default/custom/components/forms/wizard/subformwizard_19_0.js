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

         	 if(form_div_id==1){

         	 	
				
					var f362 =  $("#UK-FCL-00362_0").val();
					if(f362=='Yes'){
							var mnt = $("#UK-FCL-00105_0").val();
							if(mnt){
						var af1mcheckfield = true;
						}else{
							var mncb = $('input[name=middlenamecheckbox]:checked').val(); 
							if(mncb){
								var af1mcheckfield = true;
							}else{
								var af1mcheckfield = false;
							}
						}
					}else{
							var af1mcheckfield = true;
					}
					

					


				
					var nofapp = $("#UK-FCL-00365_0").val();
					var totalRowCount = 0;          
				    totalRowCount =  $("#tbl_1168 td").closest("tr").length;

					if(nofapp==totalRowCount){
					   					
						$("#scd").text("");
					}else{
					    					

					var scdem = "Please Add Number of Quota Details as Per Enter 'No. of classes of Quota' Field."; 
						if ($("#scd").length) {
							$("#scd").text(scdem);
		    			}else{
		    				$("#title_UK-FCL-00365_0").append('<b style="color:red;" id="scd">'+scdem+'</b>');
		    			}						
						var titleTot = jQuery("#title_UK-FCL-00365_0").offset().top;
						var addHeight = parseInt(titleTot) - 170;
						jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
						wizardObj.stop();
					}

					$("#UK-FCL-00367_0").prop("disabled", false);
				}


				if(form_div_id==3)
				{	
				 			
					var nofapp = $("#UK-FCL-00234_0").val();
					var totalRowCount = 0;          
				    totalRowCount =  $("#tbl_2015 td").closest("tr").length;

				    if(nofapp > totalRowCount){

                          $(".check_number_three").remove();

					    	$("#title_UK-FCL-00234_0").append("<b style='color:red; margin-left:2em;' class='check_number_three'>Please note, that the minimum no. of managers should be three.</b>");
							var titleTot = jQuery("#title_UK-FCL-00234_0").offset().top;
							var addHeight = parseInt(titleTot) - 170;
							jQuery('html,body').animate({ scrollTop: addHeight}, 1000);

							$("#UK-FCL-00234_0").css("border", "1px solid #e73d4a");

						     wizardObj.stop();
					     	
					   			
						
					}
				}



            if (validator.form() !== true) {
                wizardObj.stop();  // don't go to the next step
            }else{
            	if(af1mcheckfield==false){
						$("#input_UK-FCL-00105_0").after("<div class='form-control-feedback-addmore'>Please enter the required information or select the check box</div>");					
						$("#input_UK-FCL-00105_0").focus();
						 wizardObj.stop();
					}
            }
        })
		
        //== Change event
         wizard.on('change', function(wizard) {
         	
            mApp.scrollTop();            
        }); 

        wizard.on('change', function(wizard) {

               $("#div_UK-FCL-00374_0").hide();
               $("#div_UK-FCL-00364_0").css('margin-top', '1em');
               $(".chk_UK-FCL-00364_0").css('margin-right', '29em');
               $("#div_UK-FCL-00364_0 label").css('display', 'none');

              
               //Hide And Show Checckbox
        	    var agentName = $("#UK-FCL-00301_0").val();
        	    var agentMiddleName = $("#UK-FCL-00105_0").val();
			    var agentLastname = $("#UK-FCL-00324_0").val();
			    var  address1 = $("#UK-FCL-00107_0").val();
			    var address2 = $("#UK-FCL-00457_0").val();
			    var city = $("#UK-FCL-00463_0").val();
			    var country = $("#UK-FCL-00320_0").val();
		        var parish =  $('#UK-FCL-00457_0 option:selected').text();
		        var postalCode =  $('#UK-FCL-00455_0 option:selected').text();

			   
			   var fullName = agentName + ' '+agentMiddleName + ' ' + agentLastname;

			   $("#UK-FCL-00479_0").val(fullName);
			   $("#UK-FCL-00169_0").val(address1);
			   $("#UK-FCL-00469_0").val(address2);
			   $("#UK-FCL-00459_0").val(city);
			   $("#UK-FCL-00406_0").val(parish);
			   $("#UK-FCL-00464_0").val(postalCode);
			   $("#UK-FCL-00465_0").val(country);


		      $("#UK-FCL-00479_0").prop('readonly',true);
			  $("#UK-FCL-00169_0").prop('readonly',true);
			  $("#UK-FCL-00469_0").prop('readonly',true);
			  $("#UK-FCL-00459_0").prop('readonly',true);
			  $("#UK-FCL-00465_0").prop('readonly',true);
			  $('#UK-FCL-00406_0').attr("disabled", true); 
			  $('#UK-FCL-00464_0').attr("disabled", true); 

			   
			   var text = $("#UK-FCL-00362_0").val();
			   if(text =='No'){


			  $("#div_UK-FCL-00479_0").hide();
			  $("#div_UK-FCL-00169_0").hide();
			  $("#div_UK-FCL-00469_0").hide();
			  $("#div_UK-FCL-00459_0").hide();
			  $("#div_UK-FCL-00465_0").hide();
			  $('#div_UK-FCL-00406_0').hide(); 
			  $('#div_UK-FCL-00464_0').hide(); 

                 

			 }else if(text =='Yes'){

			  $("#div_UK-FCL-00479_0").show();
			  $("#div_UK-FCL-00169_0").show();
			  $("#div_UK-FCL-00469_0").show();
			  $("#div_UK-FCL-00459_0").show();
			  $("#div_UK-FCL-00465_0").show();
			  $('#div_UK-FCL-00406_0').show(); 
			  $('#div_UK-FCL-00464_0').show(); 

			   }

			   //End Hide And Show Checckbox

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
                    'UK-FCL-00268_0': {	
						minlength:5,
						maxlength:300,
						'uniqueproposedname': true
					},
                },
                messages: {
                     'UK-FCL-00268_0': {
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
    				 // console.log('validating...');
    				var form_div_id = wizard.getStep();
    				var valid = true;
    				
    				var society= $("#UK-FCL-00501_0").val();
    				 var selectedVal='';
					 $.each(society, function( index, value ) {
					   if(value=='Registered Agent')
					   	 selectedVal='Registered Agent';
					 });
					 console.log(selectedVal);
					 if(selectedVal && $('input[name="UK-FCL-00362_0"]:checked').val()=='Yes'){
					 	console.log('validating');
					 	var mnt = $("#UK-FCL-00105_0").val();
					 	if (mnt) {
					 		console.log("middler");
					 	    valid = true;   
					 	}
					 	else{
						 	var mncb = $('input[name=middlenamecheckbox00105_0]:checked').val();
						 	var parentId = $('input[name=middlenamecheckbox00105_0]:checked').parent().parent().attr('id');
						 	// if (parentId == 'div_UK-FCL-00105_0') {
						 	    if (mncb) {
						 	        valid = true;
						 	    } else {
						 	        valid = false;
						 	        if ($("#miderror").length) {
						 	            $("#miderror").text("Please enter the required information or select the check box");
						 	        } else {
						 	            $("#div_UK-FCL-00105_0").append("<span style='color:red;' class='errorDetail' id='miderror'>Please enter the required information or select the check box</span>");

						 	        }
						 	        // wizardObj.stop();
						 	    }
						 	// }
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

function submitpertial(){
	$.ajax({
		url:'/backoffice/infowizard/SubFormRegistrationOfSocieties/SaveDataPartial',
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
