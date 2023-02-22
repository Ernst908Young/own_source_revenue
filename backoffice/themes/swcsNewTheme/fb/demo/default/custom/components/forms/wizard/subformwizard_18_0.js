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
			
				var form_div_id = wizard.getStep();
				var valid = true;
				
				var ff012 = $("#UK-FCL-00012_0").val();	
				if(ff012 != "Cessation of Secretary"){
					var mnt = $("#UK-FCL-00105_0").val();
						if(mnt){
							valid = true;
						}else{
							var mncb = $('input[name=middlenamecheckbox-1]:checked').val(); 
							if(mncb){
								valid = true;
							}else{
								valid = false;
								$(".form-control-feedback-addmore").remove();	
								$("#input_UK-FCL-00105_0").append("<div class='form-control-feedback-addmore'>Please enter the required information or select the check box</div>");
							}
						}
				}

				if(valid==true){
					if(ff012 != "Appointment of Secretary"){
					var mnt = $("#UK-FCL-00466_0").val();
						if(mnt){
							valid = true;
						}else{
							var mncb = $('input[name=middlenamecheckbox]:checked').val(); 
							if(mncb){
								valid = true;
							}else{
								valid = false;
								$(".form-control-feedback-addmore").remove();	
								$("#input_UK-FCL-00466_0").append("<div class='form-control-feedback-addmore'>Please enter the required information or select the check box</div>");
							}
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
		
	
	WizardDemo.init()
   
});


function submitpertial(){
$.ajax({
		url:'/backoffice/infowizard/SubFormNoticeofSecretary/SaveDataPartial',
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
