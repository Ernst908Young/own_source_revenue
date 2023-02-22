var WizardDemo = function() {
    //== Base elements
    var wizardEl = $('#m_wizard');
    var formEl = $('#m_form');
    var validator;
    var wizard;
	
    //== Private functions
    var initWizard = function () {
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
				
			},
			unhighlight: function(element) {
				$(element).parents('.form-group').removeClass('has-error');
				
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
		
				var valid = true;
				var serviceprovider_user_id = $("#serviceprovider_user_id").val();
				if(serviceprovider_user_id){
					valid = true;
				}else{
					var checkmail = validate();
					if(checkmail==false){
						valid = false;
						wizardObj.stop();
					}
					var mnt = $("#middle_name").val();
					if(mnt){
						valid = true;
					}else{
						var mncb = $('input[name=middlenamecheckbox]:checked').val(); 
						if(mncb){
							valid = true;
						}else{
							valid = false;
							$("#middleerror").text("Please enter the required information or select the check box");
							wizardObj.stop();
						}
					}
				}
				

				

				
				if(valid==true){
					document.getElementById("m_form").submit();    
				}
				/*if(valid==true){					
					mApp.unprogress(btn), swal({
						title: "",
						text: "Application details saved, please proceed ahead",
						type: "success",
						confirmButtonClass: "btn btn-secondary m-btn m-btn--wide"
					});
					document.getElementById("m_form").submit();
				}  */    
				     
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