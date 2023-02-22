<script type="text/javascript">

	
	$(document).ready(function() {

		$("a.back_btn").css('visibility', 'hidden');
		$("#div_UK-FCL-00098_0").hide();


$('#UK-FCL-00675_0').change(function() {
	var abc = $('#UK-FCL-00675_0').val();
	if(abc == 'Society'){
		$('#popupid_4577').val('');
		$('#popupid_4577').remove();
	}else{
		$('#popupsocid_4577').val('');
		$('#popupsocid_4577').remove();
	}

	$('#UK-FCL-00650_0').val('')
	$('#UK-FCL-00651_0').val('')
	
	$('#UK-FCL-00652_0').val('')
	$('#UK-FCL-00233_0').val('')
	$('#UK-FCL-00240_0').val('')
	$('#UK-FCL-00241_0').val('')
	$('#UK-FCL-00119_0').val('')
	$('#UK-FCL-00120_0').val('')
	$('#UK-FCL-00199_0').val('')
	$('#UK-FCL-00200_0').val('')
	$('#UK-FCL-00093_0').val('')
	$('#UK-FCL-00238_0').val('')
	$('#UK-FCL-00129_0').val('')
	$('#UK-FCL-00094_0').val('')
	$('#UK-FCL-00096_0').val('')



	$('#UK-FCL-00362_0').val('')
	$('#UK-FCL-00132_0').val('')
	$('#UK-FCL-00105_0').val('')
	$('#UK-FCL-00106_0').val('')
	$('#UK-FCL-00104_0').val('')
	$('#UK-FCL-00309_0').val('')
	$('#UK-FCL-00372_0').val('')
	$('#UK-FCL-00242_0').val('')
	$('#UK-FCL-00320_0').val('')
	$('#UK-FCL-00123_0').val('')
	$('#UK-FCL-00124_0').val('')
	$('#div_UK-FCL-00659_0').after("");
	$('#div_UK-FCL-00659_0').empty('');

}); 


	
	$(".chk_UK-FCL-00124_0").on('change',function(){
		var val=$("input[type='radio'][name='UK-FCL-00124_0']:checked").val();
		if(val=='Yes'){
			
			$("#div_UK-FCL-00098_0").show();
			
			
		}
		else{
			
			$("#div_UK-FCL-00098_0").hide();
		}

	})
	
	// $("#UK-FCL-00098_0").keypress(function(e){
	// 	var tval = $(this).val();
 //        tlength = tval.length;
       
	// 	if(tlength  >= 4000){
			
	// 		 $("#UK-FCL-00098_0-error").text("Please enter upto 4000 character only.");
	// 		// alert("Please enter upto 4000 character only.");
	// 		return false;		       	
	// 	}
 //   });

 $("#UK-FCL-00098_0").keypress(function(){
		if($(this).val().length>=4000){
			return false;		       	
		}
   });

	var maxchars_0 = 4000;
		$('#UK-FCL-00098_0').keyup(function () {
		    var tlength = $(this).val().length;
		    $(this).val($(this).val().substring(0, maxchars_0));
		    var tlength = $(this).val().length;
		    remain = maxchars_0 - parseInt(tlength);
		    $(".char_validation_1").remove();
		    if(remain == 0){
		      $("#UK-FCL-00098_0-error").parent('div').append("<div style='color:red;'  class='form-control-feedback-error char_validation_1'>In case the text exceeds 4000 characters, please attach a schedule in prescribed format to this Form under document listing tab at the end.</div>");
		      return false;
		    }
		});
	
	
	// $("#div_UK-FCL-00650_0, #div_UK-FCL-00651_0").hide();
	var ff675 = $("#UK-FCL-00675_0").val();
	if(ff675){
		manupulatefields(ff675); 
	}
	$("#UK-FCL-00675_0").on("change",function(){
		if($(this).val()){
			 manupulatefields($(this).val());
			
		}
	});
	
	function manupulatefields(ff675){
	    var myarr = ff675.toString().split(",");
	    // alert(myarr);
	 
		if (myarr.includes('Company')) {
	      one_show();
	    }else{
	       one_hide();
	    }

	    if (myarr.includes('Society')) {
			two_show();
	    }else{
	       two_hide();
	    }

	}
	
	function one_show(){
	   $("#title_UK-FCL-00123_0,#hr_UK-FCL-00123_0,#div_UK-FCL-00123_0,#div_UK-FCL-00124_0,  #title_UK-FCL-00240_0,#div_UK-FCL-00240_0,#div_UK-FCL-00241_0,#div_UK-FCL-00119_0,#div_UK-FCL-00120_0").show();
	}

	function one_hide(){
	    $("#title_UK-FCL-00123_0,#hr_UK-FCL-00123_0,#div_UK-FCL-00123_0,#div_UK-FCL-00124_0,  #title_UK-FCL-00240_0,#div_UK-FCL-00240_0,#div_UK-FCL-00241_0,#div_UK-FCL-00119_0,#div_UK-FCL-00120_0").hide();
	   
	    
	}
	function two_show(){
	    $("#title_UK-FCL-00199_0,#div_UK-FCL-00199_0,#div_UK-FCL-00200_0,#div_UK-FCL-00093_0,#div_UK-FCL-00238_0,#div_UK-FCL-00310_0,#div_UK-FCL-00129_0,#div_UK-FCL-00094_0,#div_UK-FCL-00096_0,#div_UK-FCL-00362_0  ,#div_UK-FCL-00132_0,#div_UK-FCL-00105_0,#div_UK-FCL-00106_0,#div_UK-FCL-00104_0,#div_UK-FCL-00309_0,#div_UK-FCL-00336_0,#div_UK-FCL-00372_0,#div_UK-FCL-00242_0,#div_UK-FCL-00320_0, #regis").show();
	}

	function two_hide(){
	   $("#title_UK-FCL-00199_0,#div_UK-FCL-00199_0,#div_UK-FCL-00200_0,#div_UK-FCL-00093_0,#div_UK-FCL-00238_0,#div_UK-FCL-00310_0,#div_UK-FCL-00129_0,#div_UK-FCL-00094_0,#div_UK-FCL-00096_0,#div_UK-FCL-00362_0  ,#div_UK-FCL-00132_0,#div_UK-FCL-00105_0,#div_UK-FCL-00106_0,#div_UK-FCL-00104_0,#div_UK-FCL-00309_0,#div_UK-FCL-00336_0,#div_UK-FCL-00372_0,#div_UK-FCL-00242_0,#div_UK-FCL-00320_0, #regis").hide();
	   
	    
	}

	
	
	$("#div_UK-FCL-00033_0").hide();
	
	$("#UK-FCL-00651_0,#UK-FCL-00199_0,#UK-FCL-00200_0,#UK-FCL-00093_0,#UK-FCL-00238_0,#UK-FCL-00310_0,#UK-FCL-00129_0,#UK-FCL-00094_0,#UK-FCL-00096_0,#UK-FCL-00362_0,#UK-FCL-00132_0,#UK-FCL-00105_0,#UK-FCL-00106_0,#UK-FCL-00104_0,#UK-FCL-00309_0,#UK-FCL-00336_0,#UK-FCL-00372_0,#UK-FCL-00242_0,#UK-FCL-00320_0,#UK-FCL-00654_0,#UK-FCL-00655_0,#UK-FCL-00656_0,#UK-FCL-00657_0,#UK-FCL-00266_0,#UK-FCL-00658_0,#UK-FCL-00692_0,#UK-FCL-00659_0").attr('readonly',true);

	$("#label_UK-FCL-00691_0, #label_UK-FCL-00654_0, #label_UK-FCL-00655_0, #label_UK-FCL-00656_0, #label_UK-FCL-00657_0, #label_UK-FCL-00266_0, #label_UK-FCL-00658_0, #label_UK-FCL-00692_0,#label_UK-FCL-00659_0").find('b').after('<span style="color:red;"> * </span>');

	$("#UK-FCL-00691_0").attr('readonly',true);
	$("#UK-FCL-00652_0,#UK-FCL-00124_0,#UK-FCL-00233_0,#UK-FCL-00241_0,#UK-FCL-00119_0,#UK-FCL-00120_0,#UK-FCL-00129_0,#UK-FCL-00096_0,#UK-FCL-00362_0").attr('readonly',true);

	$("#UK-FCL-00691_0,#input_UK-FCL-00654_0,#UK-FCL-00372_0,#UK-FCL-00320_0").css('pointer-events','none');
	$("#UK-FCL-00691_0,#input_UK-FCL-00654_0,#UK-FCL-00372_0,#UK-FCL-00320_0").css('background-color','#e9ecef');
	$(".chk_UK-FCL-00362_0,.chk_UK-FCL-00123_0,.chk_UK-FCL-00240_0").css('pointer-events','none');
	$(".chk_UK-FCL-00362_0,.chk_UK-FCL-00123_0,.chk_UK-FCL-00240_0").css('background-color','#e9ecef')

	$("#UK-FCL-00650_0").on("blur", function() {
		    var entityType=$('#UK-FCL-00675_0').val();
		    $("#UK-FCL-00675_0-error").remove();
		    if(entityType.length==0){
		    	$("#input_UK-FCL-00675_0").append('<div id="UK-FCL-00675_0-error" class="form-control-feedback">Please select entity type first</div>');
		    	$(this).val('');
		    	return false;

		    }
			var reg_no = $(this).val();
			$("#popupid_4577").html('');
			$("#popupsocid_4577").html('');
			var type_of_entity = $("#UK-FCL-00675_0").val();
           $.ajax({
				type: "POST",
				dataType: 'json',
				data:{"type_of_entity":type_of_entity},
				url: "/backoffice/infowizardtwo/subFormRestatedArticlesForm13/getcompanyNameByregno/reg_no/" + reg_no,
				beforeSend: function() {
                   $("#UK-FCL-00650_0-error").text("Please wait...");
				},
				success: function(result) {
					if(result.status == true) {
						$('#tbl_4577').remove();
						$('#div_UK-FCL-00659_0').empty();


						$("#UK-FCL-00650_0-error").text("");
						$("#UK-FCL-00651_0").val(result.cname);
						$("#UK-FCL-00199_0").val(result.purposesociety);						
						$("#UK-FCL-00200_0").val(result.durationsociety);

						$("#UK-FCL-00093_0").val(result.regadd1);
                        $("#UK-FCL-00238_0").val(result.regadd2);
                        $("#UK-FCL-00310_0").val(result.regcity);
                        $("#UK-FCL-00129_0").val(result.regstate);
                        $("#UK-FCL-00094_0").val(result.regpostal);
                        $("#UK-FCL-00096_0").val(result.regcountry);

                        $("#UK-FCL-00362_0").val(result.regagent);

                        $("#UK-FCL-00132_0").val(result.agentfirst);
                        $("#UK-FCL-00105_0").val(result.agentmiddle);
                        $("#UK-FCL-00106_0").val(result.agentsurname);
                        $("#UK-FCL-00104_0").val(result.agnetadd1);
                        $("#UK-FCL-00309_0").val(result.agentadd2);
                        $("#UK-FCL-00336_0").val(result.agentcity);
                        $("#UK-FCL-00372_0").val(result.agentstate);
                        $("#UK-FCL-00242_0").val(result.agnetpostal);
                        $("#UK-FCL-00320_0").val(result.agentcountry);	


                        $("#UK-FCL-00652_0").val(result.businesscarryon);
                        $("#UK-FCL-00233_0").val(result.otherprovision);

                        $("input[name=UK-FCL-00123_0][value='" + result.publicprivate + "']").prop('checked', true);

                        // $("#UK-FCL-00123_0").val(result.publicprivate);
                         $("#UK-FCL-00124_0").val(result.provisionincluded);


                        // $("#UK-FCL-00240_0").val(result.fixedrange);
                        $("input[name=UK-FCL-00240_0][value='" + result.fixedrange + "']").prop('checked', true);                      

                        $("#UK-FCL-00119_0").val(result.minrange);
                        $("#UK-FCL-00120_0").val(result.maxrange);
                        $("#UK-FCL-00241_0").val(result.noofdirector);
					
					    //$('#div_UK-FCL-00033_0').after(result.sharecapital_table);
						
						$("#UK-FCL-00651_0-error").empty();
						$("#div_UK-FCL-00651_0").removeClass("has-error");				   
						
					} else {
						$("#UK-FCL-00650_0-error").empty();
                       $("#UK-FCL-00650_0-error").text(result.msg);
                       $("#UK-FCL-00651_0").val("");
                       $("#UK-FCL-00652_0").val("");
                       $("#UK-FCL-00098_0").val("");
                       $("#UK-FCL-00660_0").val("");
					}

					if(result.company_detail == 'NA'){
						$("#title_UK-FCL-00123_0,#hr_UK-FCL-00123_0,#div_UK-FCL-00123_0,#div_UK-FCL-00124_0,  #title_UK-FCL-00240_0,#div_UK-FCL-00240_0,#div_UK-FCL-00241_0,#div_UK-FCL-00119_0,#div_UK-FCL-00120_0").hide();
						
						
					}
					else{
						 $('#div_UK-FCL-00659_0').after("");
						 $('#div_UK-FCL-00659_0').after(result.shareDetails);
						$("#title_UK-FCL-00123_0,#hr_UK-FCL-00123_0,#div_UK-FCL-00123_0,#div_UK-FCL-00124_0,  #title_UK-FCL-00240_0,#div_UK-FCL-00240_0,#div_UK-FCL-00241_0,#div_UK-FCL-00119_0,#div_UK-FCL-00120_0").show();
					}

					 if(result.fixedrange=='Fixed Number'){
                        	$("#div_UK-FCL-00241_0").show();
                        	$("#div_UK-FCL-00119_0").hide();
                        	
                            $("#div_UK-FCL-00120_0").hide();
                          

                        }
                        else{
                        	if(result.fixedrange=='In Range'){  
                        	// alert('ddddddddddddd');                      			
                        		$("#div_UK-FCL-00119_0").show(); 
                        		$("#div_UK-FCL-00120_0").show();
                        		$("#div_UK-FCL-00241_0").hide();
                        		
                        	}else{
                        		$("#div_UK-FCL-00119_0").hide(); $("#div_UK-FCL-00120_0").hide();$("#div_UK-FCL-00241_0").hide();
                        	
                        	}			
                        }		


					if(result.society_detail == 'NA'){					

						$("#title_UK-FCL-00199_0,#div_UK-FCL-00199_0,#div_UK-FCL-00200_0,#div_UK-FCL-00093_0,#div_UK-FCL-00238_0,#div_UK-FCL-00310_0,#div_UK-FCL-00129_0,#div_UK-FCL-00094_0,#div_UK-FCL-00096_0,#div_UK-FCL-00362_0  ,#div_UK-FCL-00132_0,#div_UK-FCL-00105_0,#div_UK-FCL-00106_0,#div_UK-FCL-00104_0,#div_UK-FCL-00309_0,#div_UK-FCL-00336_0,#div_UK-FCL-00372_0,#div_UK-FCL-00242_0,#div_UK-FCL-00320_0, #regis").hide();
					}else{
							$('#div_UK-FCL-00659_0').after("");
						 $('#div_UK-FCL-00659_0').after(result.managerDetails);

						$("#title_UK-FCL-00199_0,#div_UK-FCL-00199_0,#div_UK-FCL-00200_0,#div_UK-FCL-00093_0,#div_UK-FCL-00238_0,#div_UK-FCL-00310_0,#div_UK-FCL-00129_0,#div_UK-FCL-00094_0,#div_UK-FCL-00096_0,#div_UK-FCL-00362_0  ,#div_UK-FCL-00132_0,#div_UK-FCL-00105_0,#div_UK-FCL-00106_0,#div_UK-FCL-00104_0,#div_UK-FCL-00309_0,#div_UK-FCL-00336_0,#div_UK-FCL-00372_0,#div_UK-FCL-00242_0,#div_UK-FCL-00320_0, #regis").show();
					}


					if(result.regagent=='Yes'){
                        	$("#div_UK-FCL-00132_0").show();
                        	$("#div_UK-FCL-00105_0").show();
                        	$("#div_UK-FCL-00106_0").show();
                        	$("#div_UK-FCL-00104_0").show();
                        	$("#div_UK-FCL-00309_0").show();
                        	$("#div_UK-FCL-00336_0").show();
                        	$("#div_UK-FCL-00372_0").show();
                        	$("#div_UK-FCL-00242_0").show();
                        	$("#div_UK-FCL-00320_0").show();

                        	$(".regoffice132").show();                  
                          

                        }
                        else{
                        	if(result.regagent=='No'){  
                        	// alert('ddddddddddddd');                      			
                        	$("#div_UK-FCL-00132_0").hide();
                        	$("#div_UK-FCL-00105_0").hide();
                        	$("#div_UK-FCL-00106_0").hide();
                        	$("#div_UK-FCL-00104_0").hide();
                        	$("#div_UK-FCL-00309_0").hide();
                        	$("#div_UK-FCL-00336_0").hide();
                        	$("#div_UK-FCL-00372_0").hide();
                        	$("#div_UK-FCL-00242_0").hide();
                        	$("#div_UK-FCL-00320_0").hide();

                        	$(".regoffice132").hide();

                        	$("#UK-FCL-00132_0").val("");                           
                            $("#UK-FCL-00105_0").val("");
                            $("#UK-FCL-00106_0").val("");                           
                            $("#UK-FCL-00104_0").val("");
                            $("#UK-FCL-00309_0").val("");                           
                            $("#UK-FCL-00336_0").val("");
                            $("#UK-FCL-00372_0").val("");                           
                            $("#UK-FCL-00242_0").val("");
                            $("#UK-FCL-00320_0").val("");   

                        	}		
                        }

					console.log(result);
				}
			});
		});

$("<div id='regis' class='row regoffice'><div  class='col-lg-12'><strong >The registered office of the Society in Barbados:</strong></div></div><br>").insertBefore("#div_UK-FCL-00093_0");

$("<div id='regis' class='row regoffice132'><div  class='col-lg-12'><strong >The details of the Society’s agent in Barbados:</strong></div></div><br>").insertBefore("#div_UK-FCL-00132_0");   
	   
	});

	
$("#UK-FCL-00675_0").on("change", function() {
            $("#UK-FCL-00675_0-error").empty();
            $("#div_UK-FCL-00675_0").removeClass("has-error");
       });


  


	
		
 
	




</script>