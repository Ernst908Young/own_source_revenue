var WizardDemo = function() {
    //== Base elements
    var wizardEl = $('#m_wizard');
    var formEl = $('#m_form');
    var validator;
    var wizard;
    var form4Checked
    var form9Checked

    //== Private functions
    var initWizard = function() {
        //== Initialize form wizard
        wizard = new mWizard('m_wizard', {
            startStep: 0,
            clickableSteps: false, // allow step clicking
            navigation: false // disable default navigation handlers
        });
        //== Validation before going to next page
        wizard.on('beforeNext', function(wizardObj) {
            //console.log(wizardObj.currentStep);


             if (wizardObj.currentStep == 1) {
                   
                    var nofapp = $("#UK-FCL-00700_0").val();
                    
                    var totalRowCount = 0;          
                      totalRowCount =  $("#tbl_4697 td").closest("tr").length;
                    if(nofapp==totalRowCount){                  
                        $("#scd1").text("");
                    }else{  
                    var scd1em = "Please add details of companies being amalgamated as per of entities being amalgamated "; 
                        if ($("#scd1").length) {
                            $("#scd1").text(scd1em);
                        }else{
                            $("#title_UK-FCL-00699_0").append('<b style="color:red;" id="scd1">'+scd1em+'</b>');
                        }                       
                        var titleTot = jQuery("#title_UK-FCL-00699_0").offset().top;
                        var addHeight = parseInt(titleTot) - 170;
                        jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
                        valid = false;
                        wizardObj.stop();   
                    }  
                    $("#UK-FCL-00420_0").attr("readonly", true);            

            }




            	// alert(wizardObj.currentStep)
            if (wizardObj.currentStep == 1) {
            	
              		 var nofapp = $("#UK-FCL-00262_0").val();
					var totalRowCount = 0;          
				      totalRowCount =  $("#tbl_4645 td").closest("tr").length;
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
         	//alert(dnorr);
					if(dnorr =='Minimum and Maximum number of Directors'){
						var myElement = document.getElementById("UK-FCL-00131_0");
					//	console.log(myElement);
						if(myElement){
					     	//$("#UK-FCL-00131_0").val();
					     	$("#UK-FCL-00131_0").prop('readonly',false); 
						}
					}else{ 
				       	//console.log('ahsdjsj wewe');
					    //console.log(dnorr);
						var myElement = document.getElementById("UK-FCL-00131_0");
						if(myElement){
							$("#UK-FCL-00131_0").prop('readonly',true);
							$("#UK-FCL-00131_0").val($("#UK-FCL-00241_0").val());
						}
					}

            /*step 3*/

            if (validator.form() !== true) {
                wizardObj.stop() // don't go to the next step
            }
        });


        //== Change event
        wizard.on('change', function(wizard) {
            console.log(wizard);
            mApp.scrollTop();
            var fs = wizard.getStep();
            console.log(fs);
            if (fs == 2 && form4Checked == 'No') {
                removeStep2Required();
                wizard.goLast();
            }
            if ((fs == 3) && form9Checked == 'No') {
                //console.log('ddds');
                removeStep3Required();
                document.getElementById("m_form").submit();
                // initSubmit();
            }
            if (fs == 2 && form9Checked == 'No' && form4Checked == 'No') {
                removeStep3Required();
                document.getElementById("m_form").submit();
                initSubmit();
            }

            //$(".form-step").removeClass("active");
            $("#div_tab" + fs).addClass("active");
            $(".back_btn").on('click',function(){
               mApp.scrollTop();
               var fs = wizard.getStep();
               if (fs == 3 && form4Checked == 'No') {
                   removeStep2Required();
                   wizard.goFirst();
               }
               $("#div_tab" + fs).addClass("active");
            })
        });
    }
    var removeStep2Required = function() {
        $("#UK-FCL-00012_0").removeAttr('required');
        $("#UK-FCL-00340_0").removeAttr('required');
        $("#UK-FCL-00345_0").removeAttr('required');
        $("#UK-FCL-00342_0").removeAttr('required');
        $("#UK-FCL-00351_0").removeAttr('required');

        $("#UK-FCL-00349_0").removeAttr('required');
        $("#UK-FCL-00528_0").removeAttr('required');
        $("#UK-FCL-00531_0").removeAttr('required');


    }

    var removeStep3Required = function() {
        $("#UK-FCL-00533_0").removeAttr('required');
        $("#UK-FCL-00395_0").removeAttr('required');
        $("#UK-FCL-00132_0").removeAttr('required');
        $("#UK-FCL-00106_0").removeAttr('required');
        $("#UK-FCL-00093_0").removeAttr('required');

        $("#UK-FCL-00096_0").removeAttr('required');
        $("#UK-FCL-00129_0").removeAttr('required');
        $("#UK-FCL-00137_0").removeAttr('required');

        $("#UK-FCL-00480_0").removeAttr('required');
        $("#UK-FCL-00150_0").removeAttr('required');
        $("#UK-FCL-00134_0").removeAttr('required');
        $("#UK-FCL-00107_0").removeAttr('required');
        $("#UK-FCL-00320_0").removeAttr('required');
        $("#UK-FCL-00372_0").removeAttr('required');
        $("#UK-FCL-00304_0").removeAttr('required');
        $("#UK-FCL-00488_0").removeAttr('required');
        $("#UK-FCL-00172_0").removeAttr('required');
        $("#UK-FCL-00423_0").removeAttr('required');
        $("#UK-FCL-00169_0").removeAttr('required');
        $("#UK-FCL-00295_0").removeAttr('required');
        $("#UK-FCL-00400_0").removeAttr('required');
        $("#UK-FCL-00461_0").removeAttr('required');
        $("#UK-FCL-00489_0").removeAttr('required');

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
                if ($(element).is("textarea")) {
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
            submitHandler: function(form) {

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

               	


               

				if(form_div_id==3)
				{	
				 			
					var nofapp = $("#UK-FCL-00131_0").val();
					//alert(nofapp);
					var totalRowCount = 0;          
				    totalRowCount =  $("#tbl_4683 td").closest("tr").length;
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

               if (valid == true) {

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