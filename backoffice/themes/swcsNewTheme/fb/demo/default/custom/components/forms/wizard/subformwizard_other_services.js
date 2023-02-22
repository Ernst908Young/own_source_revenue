var WizardDemo = function() {
    $("#m_wizard");
    var i, e, n = $("#other_service_form");
    return {
        init: function() {
            var r;
            $("#m_wizard"), n = $("#other_service_form"), (e = new mWizard("m_wizard", {
                startStep: 1
            })).on("beforeNext", function(e) {
            	//console.log(i);
            	//console.log(e.getStep());
                var form_div_id = e.getStep();
				var service_id = $(n.find('[data-wizard-action="next"]')).attr("rel");
				
				!0 !== i.form() && e.stop(); 
				 
            }), e.on("change", function(e) {				
				
				$.ajax({
					url:'/backoffice/infowizard/SubFormPartialOtherService/SaveDataPartial',
					type:'post',
					data:$("#other_service_form").serialize(),
					dataType:'json',
					success:function(response){
						if(response.success && response.hiddenfield ){							
							$('<input>').attr({
								type: 'hidden',
								id: 'submission_id',
								name: 'submission_id',
								value:response.application_id
							}).appendTo('#other_service_form');							
						}
					},
					error:function(error){
						
					}
					
				});				
                mApp.scrollTop();
            }), i = n.validate({
                ignore: ":hidden",
                rules: {
                    
                },
                messages: {
                    
                },
                invalidHandler: function(e, r) {
                    mApp.scrollTop(), swal({
                        title: "",
                        text: "There are some mandatory fields left blank. Please fill them to proceed.",
                        type: "error",
                        confirmButtonClass: "btn btn-secondary m-btn m-btn--wide"
                    })
                },
                submitHandler: function(e) {}
            }), (r = n.find('[data-wizard-action="submit"]')).on("click", function(e) {
					alert("casc");
						document.getElementById("other_service_form").submit();
						var service_id = $(this).attr("rel");
						var serviceIDsArr = ["119.0", "226.0", "227.0", "228.0"];
						var serviceExist  = serviceIDsArr.includes(service_id);
						if(serviceExist){	
							mApp.unprogress(r), swal({
								title: "",
								text: "The application has been successfully submitted!",
								type: "success",
								confirmButtonClass: "btn btn-secondary m-btn m-btn--wide"
							});
						}else{
							mApp.unprogress(r), swal({
								title: "",
								text: "The application has been successfully submitted!",
								type: "success",
								confirmButtonClass: "btn btn-secondary m-btn m-btn--wide"
							});
						}	
						
					/* e.preventDefault(),	i.form() && (mApp.progress(r), n.ajaxSubmit({
						success: function() {
							mApp.unprogress(r), swal({
								title: "",
								text: "The application has been successfully submitted!",
								type: "success",
								confirmButtonClass: "btn btn-secondary m-btn m-btn--wide"
							})
						}
					}))	  */
            })
        }
    }
}();
jQuery(document).ready(function() {
    WizardDemo.init()
});