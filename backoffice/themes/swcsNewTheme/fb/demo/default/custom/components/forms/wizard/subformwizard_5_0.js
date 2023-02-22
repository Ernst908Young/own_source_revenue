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
			totalRowCount =  $("#tbl_2299 td").closest("tr").length;


         	 if(form_div_id==1){

         	        var snofd = $("#UK-FCL-00118_0").val();
					var mindirecotor = parseInt($("#UK-FCL-00119_0").val());
				    var maxdirecotor = parseInt($("#UK-FCL-00120_0").val());
      	            var chekcRadioBtnVal = $("input[type='radio'][name='UK-FCL-00245_0']:checked").val();
				    var nofdirecotor = parseInt($("#UK-FCL-00149_0").val());

				    if(snofd < totalRowCount){
						var ndvalid = false;
					}else{
						if(mindirecotor >totalRowCount){
						   $(".check_min_max_number").hide();	
							var ndvalid = false;
						}else if(maxdirecotor < totalRowCount){
							var ndvalid = false;
						}else if(chekcRadioBtnVal== undefined){
							var ndvalid = false;	
						}else if(mindirecotor < 3){
							var ndvalid = false;	
						}else if(nofdirecotor < 3){
							var ndvalid = false;	
						}else if(totalRowCount < 3){
							var ndvalid = false;	
						}else{
							var ndvalid = true;	

						}
					}

					if(ndvalid==false){

						 var radioBtnVal = $("input[type='radio'][name='UK-FCL-00240_0']:checked").val();

                       
                       if(radioBtnVal=="Fixed Number"){
						 // number of director fixed only
						 var nofdirecotor = $("#UK-FCL-00149_0").val();

					     var totalRowCount = 0;          
					     totalRowCount =  $("#tbl_2299 td").closest("tr").length;

					   
					     if(nofdirecotor<totalRowCount){
					     	$(".check_fixed_number").hide();
					     	$(".add_more_tbl").remove();	
							$("#title_UK-FCL-00240_0").append("<b style='color:red; margin-left:2em;' class='add_more_tbl'>Sorry if you want to add more directors  then please update number of directors</b>");

								var titleTot = jQuery("#title_UK-FCL-00240_0").offset().top;
								var addHeight = parseInt(titleTot) - 170;
								jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
								$("#UK-FCL-00149_0").css("border", "1px solid #e73d4a");

					     	wizardObj.stop();

					     }else if((nofdirecotor==totalRowCount) && nofdirecotor != 0){
			                $("#UK-FCL-00149_0").css("border", "1px solid gray");
					     	//return true;
					     }else if(nofdirecotor < 3 || totalRowCount < 3){

					     	    $(".check_fixed_number").remove();
						     	$(".check_director_no").hide();	
						     	$(".check_fixed_number_three").hide();	
								$("#title_UK-FCL-00240_0").append("<b style='color:red; margin-left:2em;' class='check_fixed_number'>Please add details of the director as per the number entered in this field No. of Directors, each of whom shall become a member of the Company, are.</b>");

									var titleTot = jQuery("#title_UK-FCL-00240_0").offset().top;
									var addHeight = parseInt(titleTot) - 170;
									jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
									$("#UK-FCL-00149_0").css("border", "1px solid #e73d4a");

						     	wizardObj.stop();

					     }

					    }

					    if(radioBtnVal=="In Range"){
                            
      	                  	$(".check_fixed_number").hide();
                            $(".no_val_selected").hide();

                            var mindirecotor = parseInt($("#UK-FCL-00119_0").val());
				            var maxdirecotor = parseInt($("#UK-FCL-00120_0").val());
					        
					        var totalRowCount = 0;          
					        totalRowCount =  $("#tbl_2299 td").closest("tr").length;





					       if(mindirecotor >totalRowCount) {
                                
						      	$(".check_fixed_number").hide();
                                $(".no_val_selected").hide();
	                            $(".check_min_max_number_three").hide();


						      	$(".add_min_number_director").remove();	
								$("#title_UK-FCL-00240_0").append("<b style='color:red; margin-left:2em;' class='add_min_number_director'>Please note, that the minimum no. of directors in NPC should be three</b>");

								var titleTot = jQuery("#title_UK-FCL-00240_0").offset().top;
								var addHeight = parseInt(titleTot) - 170;
								jQuery('html,body').animate({ scrollTop: addHeight}, 1000);

								$("#UK-FCL-00119_0").css("border", "1px solid #e73d4a");
								$("#UK-FCL-00120_0").css("border", "1px solid #e73d4a");

						     	wizardObj.stop();

						      }

					        else if(maxdirecotor<totalRowCount){

						      	$(".check_min_max_number").remove();
	                            $(".check_min_max_number_three").hide();	
								$("#title_UK-FCL-00240_0").append("<b style='color:red; margin-left:2em;' class='check_min_max_number'>Please update minimum and maximun number of directors</b>");

								var titleTot = jQuery("#title_UK-FCL-00240_0").offset().top;
								var addHeight = parseInt(titleTot) - 170;
								jQuery('html,body').animate({ scrollTop: addHeight}, 1000);

								$("#UK-FCL-00120_0").css("border", "1px solid #e73d4a");
								$("#UK-FCL-00119_0").css("border", "1px solid #e73d4a");


						     	wizardObj.stop();

						      }else if(maxdirecotor < mindirecotor){

						      	$(".check_min_max_number").remove();	
								$("#title_UK-FCL-00240_0").append("<b style='color:red; margin-left:2em;' class='check_min_max_number'>Please update minimum and maximun number of directors</b>");

								var titleTot = jQuery("#title_UK-FCL-00240_0").offset().top;
								var addHeight = parseInt(titleTot) - 170;
								jQuery('html,body').animate({ scrollTop: addHeight}, 1000);

								$("#UK-FCL-00119_0").css("border", "1px solid #e73d4a");
								$("#UK-FCL-00120_0").css("border", "1px solid #e73d4a");

						     	wizardObj.stop();

						      }else if(mindirecotor < 3){
                                 
					            $(".check_fixed_number").hide();
						     	$(".check_director_no").remove();	
								$("#title_UK-FCL-00240_0").append("<b style='color:red; margin-left:2em;' class='check_director_no'>Please note, that the minimum no. of directors in NPC should be three.</b>");

									var titleTot = jQuery("#title_UK-FCL-00240_0").offset().top;
									var addHeight = parseInt(titleTot) - 170;
									jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
									$("#UK-FCL-00149_0").css("border", "1px solid #e73d4a");

						     	 wizardObj.stop();

						      }else{
                                 
					              $("#UK-FCL-00119_0").css("border", "1px solid gray");
								  $("#UK-FCL-00120_0").css("border", "1px solid gray");
								  //return true;

						      }	

      	                 } 

					}							
					
				}



            if (validator.form() !== true) {
                wizardObj.stop();  // don't go to the next step
            }
        })
		
        //== Change event
         wizard.on('change', function(wizard) {
         	
            mApp.scrollTop();            
        }); 

        wizard.on('change', function(wizard) {
               
              var principlaAddress1 = $("#UK-FCL-00093_0").val();
			  var principlaAddress2 = $("#UK-FCL-00309_0").val();
			  var principlCountry = $("#UK-FCL-00096_0").val();
			  var principlCity = $("#UK-FCL-00310_0").val();
			  var principlParises = $("#UK-FCL-00405_0 option:selected");
			  var principlPostalCode = $("#UK-FCL-00242_0 option:selected");
			  
			  
			  $("#UK-FCL-00352_0").val(principlaAddress1);
			  $("#UK-FCL-00353_0").val(principlaAddress2);
			  $("#UK-FCL-00354_0").val(principlCity);
			  $("#UK-FCL-00355_0").val(principlParises.text());
			  $("#UK-FCL-00356_0").val(principlPostalCode.text());
			  $("#UK-FCL-00357_0").val(principlCountry);	


             /* var values = $("input[name='UK-FCL-00117_0[]']")
              .map(function(){return $(this).val();}).get();*/

            

	           $(".append_table").remove();

            	var tableData = $('<div />').html($('#tbl_2299').clone()).html();

            	//alert(tableData);

            	
            	$("#hr_UK-FCL-00137_0").after("<div class='append_table'>"+tableData+"</div>");

            	$('#tbl_2299').find('tr').each(function(k){ 

            	
            		var o_ex = document.getElementById("d_o"+k);
            		if(o_ex){
            				var o = $("#d_o"+k).val();
            			}else{
            				var o = '';
            			}

            		var ppo_ex = document.getElementById("d_ppo"+k);
            		ppo_yes = ppo_no = '';
            		if(ppo_ex){
            				var ppo = $("#d_ppo"+k).val();
            				if(ppo=='Yes'){
            					var ppo_yes = 'selected';            					
            				}
            				if(ppo=='No'){
            					var ppo_no = 'selected';            					
            				}
            			}

            		var do_ex = document.getElementById("do_o"+k);
            		if(do_ex){
            				var ddo = $("#do_o"+k).val();
            			}else{
            				var ddo = '';
            			}

            		$(this).find('th').eq(8).after('<th>Occupation</th>'); 	
            		$(this).find('td').eq(8).after('<td><input type="text" name="UK-FCL-00117_0[]"  class="form-control" value="'+o+'" required /></td>');

            		$(this).find('th').eq(9).after('<th title="Please select whether a Prominent public office is held, and if yes provide details of such office.">Prominent public office</th>'); 	
            		$(this).find('td').eq(9).after('<td><select name="UK-FCL-00217_0[]" class="form-control dateFieldselect"  required><option value=" ">Select</option><option value="Yes" '+ppo_yes+'>Yes</option><option value="No" '+ppo_no+'>No</option></select></td>');

            		$(this).find('th').eq(10).after('<th title ="Prominent public office means an office as defined under section 2 of the Act and as also given under Amended Companies Regulations 2021">Details of office</th>'); 	
            		$(this).find('td').eq(10).after('<td><input type="text" name="UK-FCL-00317_0[]"  class="form-control details-office"  value="'+ddo+'"/></td>');

            		$(this).children("th:eq(12)").remove();
            		$(this).children("td:eq(12)").remove();
            	});

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
			
				var form_div_id = wizard.getStep();

				
				var valid = true;
				
				 /*var input = document.getElementsByName('UK-FCL-00117_0[]');
  					 var input_length = (input.length)/2;
            for (var i = 0; i < input_length; i++) {
               			var a = input[i];
             
            }*/
				/*$('#tbl_2299').find('tr').each(function(k){ 
					if(k==0){
						var valid = true;
					}else{
						if($("#occ_l"+k).val()==''){
							var valid = false;

							alert($("#occ_l3").val());
							
							
						}else{
							if($("#ppo_l"+k).val()==''){
								alert('Prominent public office is required');
								valid = false;
								
							}else{
								if($("#ppo_l"+k).val()=='Yes'){
									if($("#doo_l"+k).val()==''){
										alert('Details of office is required');
											valid = false;
											
									}else{
										valid = true;
									}
								}else{
									valid = true;
								}
							}
						}
					}
				});

				var valid = false;*/
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
			url:'/backoffice/infowizard/SubFormIncorporationOfaNonProfitCompanyPartial/SaveDataPartial',
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