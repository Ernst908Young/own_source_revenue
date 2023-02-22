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
                var totalRowCount = 0;
                totalRowCount = $("#tbl_3233 td").closest("tr").length;
                if (totalRowCount >= 1) {
                    $("#appd").text("");
                } else {
                    var appdm = "Please add Applicant Details atleast one record is required";
                    if ($("#appd").length) {} else {
                        $("#title_UK-FCL-00521_0").append('<b style="color:red;" id="appd">' + appdm + '</b>');
                    }
                    var titleTot = jQuery("#title_UK-FCL-00521_0").offset().top;
                    var addHeight = parseInt(titleTot) - 170;
                    jQuery('html,body').animate({
                        scrollTop: addHeight
                    }, 1000);
                    wizardObj.stop = true;
                }
                



            }
      

            /*step 3*/

            


           
               



            if (validator.form() !== true) {
                wizardObj.stop() // don't go to the next step
            }
        });

        
        


        //== Change event
         wizard.on('change', function(wizard) {
          
            var ps =  $("#prestep").val();
              var cs = wizard.getStep();
                  console.log(ps+'--'+cs);
             

            


       

          
            
                          
                      
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
           var valid = true;
           var totalDirectors=$("#UK-FCL-00131_0").val();
           var totalRowCount = 0;
           totalRowCount = $("#tbl_3897 td").closest("tr").length;
           if(totalDirectors != totalRowCount){
                var appdm = "Please enter the field according to information filled in form no. 1 above";
                $("#title_UK-FCL-00131_0").find('b').first().remove();
                $("#title_UK-FCL-00131_0").append('<b style="color:red;" id="appd">' + appdm + '</b>');
                var titleTot = jQuery("#title_UK-FCL-00131_0").offset().top;
                var addHeight = parseInt(titleTot) - 170;
                jQuery('html,body').animate({
                    scrollTop: addHeight
                }, 1000);
                wizard.stop = true;
                valid = false;
               
           }
           if (validator.form()) {
               var form_div_id = wizard.getStep();
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