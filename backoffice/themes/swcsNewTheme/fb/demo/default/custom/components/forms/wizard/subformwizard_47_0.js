
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
            if (validator.form() !== true) {
                wizardObj.stop();  // don't go to the next step
            }
        })
		
        //== Change event
         wizard.on('change', function(wizard) {
            mApp.scrollTop();            
        }); 

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
               
            },
            //== Validation messages
            messages: {
				
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

                var ffs = $("#UK-FCL-00012_0").val();
                if(ffs === 'Appointment of Director(s)'){
                     var totalRowCount_1 = 0;          
                     totalRowCount_1 =  $("#tbl_1832 td").closest("tr").length;
                     if(totalRowCount_1 <= 0){                    
                       $(".check_number").remove();                  
                        $("#title_UK-FCL-00132_0").append("<b style='color:red; margin-left:2em;' class='check_number'>Please add atleast one Appoinment Details.</b>");
                        var titleTot = jQuery("#title_UK-FCL-00132_0").offset().top;
                        var addHeight = parseInt(titleTot) - 170;
                        jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
                        valid=false;                     
                     }
                }
                if(ffs === 'Cessation of Director(s)'){
                     var totalRowCount_1 = 0;          
                     totalRowCount_1 =  $("#tbl_1833 td").closest("tr").length;
                     if(totalRowCount_1 <= 0){                    
                       $(".check_number").remove();                  
                        $("#title_UK-FCL-00431_0").append("<b style='color:red; margin-left:2em;' class='check_number'>Please add atleast one Cessation  Details.</b>");
                        var titleTot = jQuery("#title_UK-FCL-00431_0").offset().top;
                        var addHeight = parseInt(titleTot) - 170;
                        jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
                        valid=false;                     
                     }
                }
                if(ffs === 'Appointment and Cessation of Director(s)'){
                     var totalRowCount_1 = 0;          
                     totalRowCount_1 =  $("#tbl_1832 td").closest("tr").length;
                     if(totalRowCount_1 <= 0){                    
                       $(".check_number").remove();                  
                        $("#title_UK-FCL-00132_0").append("<b style='color:red; margin-left:2em;' class='check_number'>Please add atleast one Appoinment Details.</b>");
                        var titleTot = jQuery("#title_UK-FCL-00132_0").offset().top;
                        var addHeight = parseInt(titleTot) - 170;
                        jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
                        valid=false;                                            
                     }

                     if(valid==true){
                         var totalRowCount_1 = 0;          
                         totalRowCount_1 =  $("#tbl_1833 td").closest("tr").length;
                         if(totalRowCount_1 <= 0){                    
                           $(".check_number").remove();                  
                            $("#title_UK-FCL-00431_0").append("<b style='color:red; margin-left:2em;' class='check_number'>Please add atleast one Cessation  Details.</b>");
                            var titleTot = jQuery("#title_UK-FCL-00431_0").offset().top;
                            var addHeight = parseInt(titleTot) - 170;
                            jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
                            valid=false;                     
                         }
                     }

                }

                if(valid==true){
                     var totalRowCount_1 = 0;          
                         totalRowCount_1 =  $("#tbl_2231 td").closest("tr").length;
                         if(totalRowCount_1 <= 0){                    
                           $(".check_number").remove();                  
                            $("#title_UK-FCL-00441_0").append("<b style='color:red; margin-left:2em;' class='check_number'>Please add atleast one Cessation  Details.</b>");
                            var titleTot = jQuery("#title_UK-FCL-00441_0").offset().top;
                            var addHeight = parseInt(titleTot) - 170;
                            jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
                            valid=false;                     
                         }
                }


				
				if(valid==true){
					
					mApp.unprogress(btn), swal({
						title: "",
						text: "Application form filled successfully. Please upload documents.",
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