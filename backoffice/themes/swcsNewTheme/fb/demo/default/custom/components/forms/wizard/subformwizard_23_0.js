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

            
            if(wizardObj.currentStep==1){
                var totalRowCount = 0;          
                totalRowCount =  $("#tbl_2433 td").closest("tr").length;
                if(totalRowCount>=1){                  
                        $("#appd").text("");
                    }else{  
                    var appdm = "Please add Applicant Details atleast one record is required"; 
                        if ($("#appd").length) {
                            $("#appd").text(scdem);
                        }else{
                            $("#title_UK-FCL-00521_0").append('<b style="color:red;" id="appd">'+appdm+'</b>');
                        }                       
                        var titleTot = jQuery("#title_UK-FCL-00521_0").offset().top;
                        var addHeight = parseInt(titleTot) - 170;
                        jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
                        wizardObj.stop();   
                    }

            }

             
            if(wizardObj.currentStep==3){


             		var nofapp = $("#UK-FCL-00649_0").val();
					var totalRowCount = 0;          
				      totalRowCount =  $("#tbl_4135 td").closest("tr").length;
					if(nofapp==totalRowCount){					
						$("#scd").text("");
					}else{	
					var scdem = "Please enter the field according to information filled in form no. 1 above' "; 
						if ($("#scd").length) {
							$("#scd").text(scdem);
		    			}else{
		    				$("#title_UK-FCL-00649_0").append('<b style="color:red;" id="scd">'+scdem+'</b>');
		    			}						
						var titleTot = jQuery("#title_UK-FCL-00649_0").offset().top;
						var addHeight = parseInt(titleTot) - 170;
						jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
						wizardObj.stop();	
					}

					// $("#UK-FCL-00132_0").val("");
             


            	var address1 = $("#UK-FCL-00340_0").val();
				var address2 = $("#UK-FCL-00341_0").val();
				var parish = $("#UK-FCL-00345_0").val();
				var postal = $("#UK-FCL-00346_0").val();
				var country = $("#UK-FCL-00347_0").val();
				
				$("#UK-FCL-00169_0").attr('readonly',true);
				$("#UK-FCL-00353_0").attr('readonly',true);
				$("#UK-FCL-00460_0").attr('readonly',true); //postal
				$("#UK-FCL-00355_0").attr("disabled", true); //parish
				$("#UK-FCL-00399_0").attr("disabled", true);
				
				$("#UK-FCL-00169_0").val(address1);
				$("#UK-FCL-00353_0").val(address2);
				$("#UK-FCL-00460_0").val(postal);
				$("#UK-FCL-00355_0").val(parish).trigger('change');


                var val533 = $("#UK-FCL-00649_0").val();
                // var middleerr = 'Please enter the required information or select the check box';
               

                //         var mnt = $("#UK-FCL-00105_0").val();
                //         if(mnt){}else{
                //             var mncb = $('input[name=middlenamecheckbox00105_0]:checked').val(); 
                //             if(mncb){}else{                              
                //                  if ($("#err00105_0").length) {
                //                     $("#err00105_0").text(middleerr);
                //                 }else{
                //                     $("#input_UK-FCL-00105_0").append("<div class='form-control-feedback-addmore' id='err00105_0'>"+middleerr+"</div>");
                //                 }
                //                 wizardObj.stop(); 
                //             }
                //         }
                  
          
                if(val533=='Notice of Change (Appointment of Manager(s))'){
                   
                    var mnt = $("#UK-FCL-00105_0").val();
                        if(mnt){}else{
                            var mncb = $('input[name=middlenamecheckbox00105_0]:checked').val(); 
                            if(mncb){}else{                              
                                 if ($("#err00105_0").length) {
                                    $("#err00105_0").text(middleerr);
                                }else{
                                    $("#input_UK-FCL-00105_0").append("<div class='form-control-feedback-addmore' id='err00105_0'>"+middleerr+"</div>");
                                }
                                wizardObj.stop(); 
                            }
                        }
                    var mnt = $("#UK-FCL-00316_0").val();
                        if(mnt){}else{
                            var mncb = $('input[name=middlenamecheckbox00316_0]:checked').val(); 
                            if(mncb){}else{                              
                                 if ($("#err00316_0").length) {
                                    $("#err00316_0").text(middleerr);
                                }else{
                                    $("#input_UK-FCL-00316_0").append("<div class='form-control-feedback-addmore' id='err00316_0'>"+middleerr+"</div>");
                                }
                                wizardObj.stop(); 
                            }
                        }
                }
                if(val533=='Notice of Change (Cessation of Manager(s))'){
                    var mnt = $("#UK-FCL-00133_0").val();
                        if(mnt){}else{
                            var mncb = $('input[name=middlenamecheckbox00133_0]:checked').val(); 
                            if(mncb){}else{                              
                                 if ($("#err00133_0").length) {
                                    $("#err00133_0").text(middleerr);
                                }else{
                                    $("#input_UK-FCL-00133_0").append("<div class='form-control-feedback-addmore' id='err00133_0'>"+middleerr+"</div>");
                                }
                                wizardObj.stop(); 
                            }
                        }
                    var mnt = $("#UK-FCL-00316_0").val();
                        if(mnt){}else{
                            var mncb = $('input[name=middlenamecheckbox00316_0]:checked').val(); 
                            if(mncb){}else{                              
                                 if ($("#err00316_0").length) {
                                    $("#err00316_0").text(middleerr);
                                }else{
                                    $("#input_UK-FCL-00316_0").append("<div class='form-control-feedback-addmore' id='err00316_0'>"+middleerr+"</div>");
                                }
                                wizardObj.stop(); 
                            }
                        }
                }
                if(val533=='Notice of Change (Appointment and Cessation of Manager(s))'){
                     var mnt = $("#UK-FCL-00105_0").val();
                        if(mnt){}else{
                            var mncb = $('input[name=middlenamecheckbox00105_0]:checked').val(); 
                            if(mncb){}else{                              
                                 if ($("#err00105_0").length) {
                                    $("#err00105_0").text(middleerr);
                                }else{
                                    $("#input_UK-FCL-00105_0").append("<div class='form-control-feedback-addmore' id='err00105_0'>"+middleerr+"</div>");
                                }
                                wizardObj.stop(); 
                            }
                        }
                    var mnt = $("#UK-FCL-00133_0").val();
                        if(mnt){}else{
                            var mncb = $('input[name=middlenamecheckbox00133_0]:checked').val(); 
                            if(mncb){}else{                              
                                 if ($("#err00133_0").length) {
                                    $("#err00133_0").text(middleerr);
                                }else{
                                    $("#input_UK-FCL-00133_0").append("<div class='form-control-feedback-addmore' id='err00133_0'>"+middleerr+"</div>");
                                }
                                wizardObj.stop(); 
                            }
                        }
                    var mnt = $("#UK-FCL-00316_0").val();
                        if(mnt){}else{
                            var mncb = $('input[name=middlenamecheckbox00316_0]:checked').val(); 
                            if(mncb){}else{                              
                                 if ($("#err00316_0").length) {
                                    $("#err00316_0").text(middleerr);
                                }else{
                                    $("#input_UK-FCL-00316_0").append("<div class='form-control-feedback-addmore' id='err00316_0'>"+middleerr+"</div>");
                                }
                                wizardObj.stop(); 
                            }
                        }
                }
                $(".form-control-feedback-addmore").remove();

            } // form 3 end

             if(wizardObj.currentStep==4){

             	
                 var middleerr = 'Please enter the required information or select the check box';
                    var mnt = $("#UK-FCL-00466_0").val();
                        if(mnt){}else{
                            var mncb = $('input[name=middlenamecheckbox00466_0]:checked').val(); 
                            if(mncb){}else{                              
                                 if ($("#err00466_0").length) {
                                    $("#err00466_0").text(middleerr);
                                }else{
                                    $("#input_UK-FCL-00466_0").append("<div class='form-control-feedback-addmore' id='err00466_0'>"+middleerr+"</div>");
                                }
                                wizardObj.stop(); 
                            }
                        }
             }
           var forform3 = $('input[name=UK-FCL-00525_0]:checked').val(); 
         	if(forform3=='No'){
                $("#m_wizard_form_step_2").addClass("hidden");
             }else{
                $("#m_wizard_form_step_2").removeClass("hidden");
            }

            var forform6 = $('input[name=UK-FCL-00526_0]:checked').val(); 
            if(forform6=='No'){
                $("#m_wizard_form_step_3").addClass("hidden");
            }else{
                $("#m_wizard_form_step_3").removeClass("hidden");
            }

            var forform19 = $('input[name=UK-FCL-00527_0]:checked').val(); 
            if(forform19=='No'){
                $("#m_wizard_form_step_4").addClass("hidden");
            }else{
                $("#m_wizard_form_step_4").removeClass("hidden");
            }




           

         	  
            if (validator.form() !== true) {
                wizardObj.stop();  // don't go to the next step
            }
              
                var fs = wizard.getStep();
                $("#prestep").val(fs);

               /*   if(wizardObj.currentStep==2){
                    if(forform6=='No' && forform19=='No'){
                    sshn();
                 }else{
                   hssn();                    
                }  
            }

                if(wizardObj.currentStep==3){
                    if(forform19=='No'){
                     sshn();
                }else{                   
                    hssn();
                }   
            }
                if(wizardObj.currentStep==4){
                    sshn();
                } */
        });
		


        //== Change event
         wizard.on('change', function(wizard) {
          
            var ps =  $("#prestep").val();
              var cs = wizard.getStep();
                  console.log(ps+'--'+cs);
             
                  var forform3 = $('input[name=UK-FCL-00525_0]:checked').val(); 
                  if(cs==2 && forform3=='No'){
                    if(cs>ps){
                         wizard.goTo(3);   
                     }else{
                        wizard.goTo(1);     
                     }
                  }

                var forform6 = $('input[name=UK-FCL-00526_0]:checked').val(); 
                  if(cs==3 && forform6=='No'){
                    if(cs>ps){
                         wizard.goTo(4);   
                     }else{
                        wizard.goTo(2);     
                     }
                  }

                  var forform19 = $('input[name=UK-FCL-00527_0]:checked').val(); 
                  if(cs==4 && forform19=='No'){
                    if(cs>ps){                          
                     }else{
                        wizard.goTo(3);     
                     }
                  }

                  if(cs==2){
                    if(forform6=='No' && forform19=='No'){
                    sshn();                    
                 }else{
                   hssn();                                      
                }  
            }

                if(cs==3){
                    if(forform19=='No'){
                     sshn();
                }else{                   
                    hssn();
                }   
            }
                if(cs==4){
                    sshn();
                } 
                
                if(cs==1){
                    checksubmitbutton();
                }
                          
                      
              mApp.scrollTop();  
                 $("#div_tab"+cs).addClass("active");   
                       
                    
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
                var middleerr = 'Please enter the required information or select the check box';
                   var mnt = $("#UK-FCL-00466_0").val();
                       if(mnt){}else{
                           var mncb = $('input[name=middlenamecheckbox00466_0]:checked').val(); 
                           if(mncb){}else{                              
                                if ($("#err00466_0").length) {
                                   $("#err00466_0").text(middleerr);
                               }else{
                                   $("#input_UK-FCL-00466_0").append("<div class='form-control-feedback-addmore' id='err00466_0'>"+middleerr+"</div>");
                               }
                               wizardObj.stop(); 
                           }
                       }
          /*      var mnt = $("#UK-FCL-00466_0").val();
                
                if(mnt){
                 valid = true;
                }else{

                var mncb = $('input[name=middlenamecheckbox00466_0]:checked').val(); 
                    if(mncb){
                    valid = true;
                    }else{
                    valid = false;
                    if ($("#miderror").length) {
                    $("#miderror").text("Please enter the required information or select the check box");
                               }else{
                    $("input#UK-FCL-00466_0").after("<span style='color:red' class='errorDetail' id='miderror'>Please enter the required information or select the check box</span>");
                                                
                              }
                wizardObj.stop();                                           
                           }
            }*/

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