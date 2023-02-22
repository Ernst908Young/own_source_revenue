var WizardDemo = function () {
    //== Base elements
    var wizardEl = $('#m_wizard');
    var formEl = $('#m_form');
    var validator;
    var wizard;
    var form3Checked
    var form6Checked

    //== Private functions
    var initWizard = function () {
        //== Initialize form wizard
        wizard = new mWizard('m_wizard', {
            startStep: 0,
            clickableSteps: false, // allow step clicking
            navigation: false // disable default navigation handlers
        });
        //== Validation before going to next page
        wizard.on('beforeNext', function (wizardObj) {
            //console.log(wizardObj.currentStep);

            if (wizardObj.currentStep == 1) {
                var totalRowCount = 0;
                totalRowCount = $("#tbl_3449 td").closest("tr").length;
                if (totalRowCount >= 1) {
                    $("#appd").text("");
                } else {
                    var appdm = "Please add Society Details atleast one record is required";
                    if ($("#appd").length) {} else {
                        $("#title_UK-FCL-00290_0").append('<b style="color:red;" id="appd">' + appdm + '</b>');
                    }
                    var titleTot = jQuery("#title_UK-FCL-00290_0").offset().top;
                    var addHeight = parseInt(titleTot) - 170;
                    jQuery('html,body').animate({
                        scrollTop: addHeight
                    }, 1000);
                    wizardObj.stop = true;
                }
                form3Checked = $('input[name=UK-FCL-00525_0]:checked').val();
                form6Checked = $('input[name=UK-FCL-00526_0]:checked').val();


            }
            if (wizardObj.currentStep == 3) {
                var ff00525_0 = $('input[name=UK-FCL-00525_0]:checked').val();
                var ff00526_0_0 = $('input[name=UK-FCL-00526_0]:checked').val();
                if (ff00525_0 == 'No' && ff00526_0 == 'Yes') {
                    wizardObj.steps("setStep", 1);
                    $("#m_wizard_form_step_1").show();
                    $(".submitForm").attr("data-wizard-action", 'false');
                    $("#m_wizard_form_step_3").hide();
                    /*
                    $(".submitForm").attr("style",'display:none;');
                    $("#m_wizard_form_step_3").hide();
                    */
                }

            }

            /*step 3*/


            if (validator.form() !== true) {
                wizardObj.stop() // don't go to the next step
            }
        });


        //== Change event
        wizard.on('change', function (wizard) {
            // console.log(wizard);
            mApp.scrollTop();
            var fs = wizard.getStep();
            console.log(fs);
            if (fs == 2 && form3Checked == 'No') {
                removeStep2Required();
                wizard.goLast();
            }
            if ((fs == 3) && form6Checked == 'No') {
                //console.log('ddds');
                removeStep3Required();
                document.getElementById("m_form").submit();
                // initSubmit();
            }
            if (fs == 2 && form6Checked == 'No' && form3Checked == 'No') {
                removeStep3Required();
                document.getElementById("m_form").submit();
                initSubmit();
            }

            //$(".form-step").removeClass("active");
            $("#div_tab" + fs).addClass("active");
            $(".back_btn").on('click',function(){
               mApp.scrollTop();
               var fs = wizard.getStep();
               if (fs == 3 && form3Checked == 'No') {
                   removeStep2Required();
                   wizard.goFirst();
               }
               $("#div_tab" + fs).addClass("active");
            })
        });
    }
    var removeStep2Required = function () {
        $("#UK-FCL-00012_0").removeAttr('required');
        $("#UK-FCL-00340_0").removeAttr('required');
        $("#UK-FCL-00345_0").removeAttr('required');
        $("#UK-FCL-00342_0").removeAttr('required');
        $("#UK-FCL-00351_0").removeAttr('required');

        $("#UK-FCL-00349_0").removeAttr('required');
        $("#UK-FCL-00528_0").removeAttr('required');
        $("#UK-FCL-00531_0").removeAttr('required');


    }

    var removeStep3Required = function () {
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
    var initValidation = function () {
        validator = formEl.validate({
            //== Validate only visible fields
            ignore: ":hidden",
            //== Validation rules
            rules: {

            },
            messages: {

            },
            highlight: function (element) {
                $(element).parents('.form-group').addClass('has-error');
                $(element).parents('.pcr').addClass('has-error');
            },
            unhighlight: function (element) {
                $(element).parents('.form-group').removeClass('has-error');
                $(element).parents('.pcr').removeClass('has-error');
                // if (element.hasClass("select2-offscreen")) {
                // $("#s2id_" + element.attr("id") + " ul").removeClass('has-error');
                // } 
            },
            errorPlacement: function (error, element) {
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
            invalidHandler: function (event, validator) {
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

    var initSubmit = function () {
        var btn = formEl.find('[data-wizard-action="submit"]');

        btn.on('click', function (e) {
            e.preventDefault();
            var valid = true;
            if (validator.form()) {
                var form_div_id = wizard.getStep();
                var form6CheckedAttr = $('input[name=UK-FCL-00547_0]:checked').val();

               /* if (form6CheckedAttr == 'Yes') {
                    var mnt = $("#UK-FCL-00105_0").val();
                    if (mnt) {
                        valid = true;
                    } else {

                        var mncb = $('input[name=middlenamecheckbox]:checked').val();
                        var parentId = $('input[name=middlenamecheckbox]:checked').parent().parent().attr('id');
                        if (parentId == 'div_UK-FCL-00105_0') {
                            if (mncb) {
                                valid = true;
                            } else {
                                valid = false;
                                if ($("#miderror").length) {
                                    $("#miderror").text("Please enter the required information or select the check box");
                                } else {
                                    $("#div_UK-FCL-00105_0").append("<span style='color:red;padding-left:16px;' class='errorDetail' id='miderror'>Please enter the required information or select the check box</span>");

                                }
                                wizardObj.stop();
                            }
                        }
                    }*/


                    // at least one record condition
                    var totalRowCount = 0;
                    var purposeOfFilling = $("#UK-FCL-00533_0").val();
                    // console.log(purposeOfFilling);
                    totalRowCount = $("#tbl_3495 td").closest("tr").length;
                    if ( form6Checked =='Yes' && (purposeOfFilling == 'Notice of Change (Appointment of Manager(s))' || purposeOfFilling == 'Notice of Change (Appointment and Cessation of Manager(s))') && totalRowCount == 0) {
                        var appdm = "Please add Applicant Details atleast one record is required";
                        $("#title_UK-FCL-00132_0").find('b').first().remove();
                        $("#title_UK-FCL-00132_0").append('<b style="color:red;" id="appd">' + appdm + '</b>');
                        var titleTot = jQuery("#title_UK-FCL-00132_0").offset().top;
                        var addHeight = parseInt(titleTot) - 170;
                        jQuery('html,body').animate({
                            scrollTop: addHeight
                        }, 1000);
                        wizard.stop = true;
                        valid = false;
                        // return false;   

                    } else {
                        $("#appd").text("");

                    }
                    totalRowCount = $("#tbl_3505 td").closest("tr").length;
                    if ( form6Checked =='Yes' && (purposeOfFilling == 'Notice of Change (Cessation of Manager(s))' || purposeOfFilling == 'Notice of Change (Appointment and Cessation of Manager(s))') && totalRowCount == 0) {
                        var appdm = "Please add Applicant Details atleast one record is required";
                        $("#title_UK-FCL-00150_0").find('b').first().remove();
                        $("#title_UK-FCL-00150_0").append('<b style="color:red;" id="appd">' + appdm + '</b>');
                        var titleTot = jQuery("#title_UK-FCL-00150_0").offset().top;
                        var addHeight = parseInt(titleTot) - 170;
                        jQuery('html,body').animate({
                            scrollTop: addHeight
                        }, 1000);
                        wizard.stop = true;
                        valid = false;
                        // return false;  

                    } else {

                        $("#appd").text("");
                    }

                    totalRowCount = $("#tbl_3516 td").closest("tr").length;
                    if ( form6Checked =='Yes' && totalRowCount == 0) {
                        var appdm = "Please add Applicant Details atleast one record is required";
                        $("#title_UK-FCL-00172_0").find('b').first().remove();
                        $("#title_UK-FCL-00172_0").append('<b style="color:red;" id="appd">' + appdm + '</b>');
                        var titleTot = jQuery("#title_UK-FCL-00172_0").offset().top;
                        var addHeight = parseInt(titleTot) - 170;
                        jQuery('html,body').animate({
                            scrollTop: addHeight
                        }, 1000);
                        wizard.stop = true;
                        valid = false;
                        // return false;   

                       
                    } else {
                        $("#appd").text("");
                    }

                // alert(valid);
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
        init: function () {
            wizardEl = $('#m_wizard');
            formEl = $('#m_form');

            initWizard();
            initValidation();
            initSubmit();
        }
    };
}();

jQuery(document).ready(function () {


    WizardDemo.init()

});