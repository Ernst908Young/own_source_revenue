<style type="text/css">
	/*.form-group .form-control-feedback {
		position: relative !important;
    top: 0 !important;
    left: 0 !important;
	}*/

/*	div#UK-FCL-00231_0-error {
    margin-top: 4em;
}

div#UK-FCL-00233_0-error {
    margin-top: 4em;
}

div#UK-FCL-00308_0-error {
    margin-top: 4em;
}*/


div#div_UK-FCL-00198_0 {
    font-size: 12px;
}

div#div_UK-FCL-00239_0 {
    margin-top: -10em;
}

div#div_UK-FCL-00373_0 {
    margin-top: -3em;
}

div#div_UK-FCL-00364_0 {
    margin-top: -3em;
}

input.chk_UK-FCL-00364_0 {
    float: right;
    margin-top: -17px;
    margin-right: 25em;
}

div#div_UK-FCL-00239_0 {
    overflow: hidden;
    margin-top: -1em;
}

/*div#div_UK-FCL-00238_0 {
    margin-top: -145px;
}*/

/*div#div_UK-FCL-00372_0 {
    margin-top: -7em;
}*/

div#div_UK-FCL-00310_0 {
	 
	 bottom:0px;
	 right:0px;
}

</style>

<script type="text/javascript">

$(document).ready(function(){

$('#UK-FCL-00308_0,#UK-FCL-00309_0,#UK-FCL-00310_0').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });
$('#UK-FCL-00301_0,#UK-FCL-00105_0,#UK-FCL-00324_0, #UK-FCL-00107_0, #UK-FCL-00457_0, #UK-FCL-00463_0').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });

$('#UK-FCL-00104_0,#UK-FCL-00335_0,#UK-FCL-00336_0, #UK-FCL-00401_0, #UK-FCL-00351_0').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });
	
	$('#UK-FCL-00397_0,#UK-FCL-00466_0,#UK-FCL-00398_0, #UK-FCL-00468_0, #UK-FCL-00238_0, #UK-FCL-00382_0, #UK-FCL-00383_0').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });

	

  $("#div_UK-FCL-00126_0").hide();

  $("#UK-FCL-00198_0").on("change",function(){
   
   $("#div_UK-FCL-00362_0").css('margin-top','0em');

  });

  var checkboxchecked = $(".chk_UK-FCL-00233_0")[0].checked = true;

 $('input[type="checkbox"]').on("click", function (e) {
      if($(this).val() == 'Any invitation to the public to subscribe for quotas of the society is prohibited') {
      	 e.preventDefault();
        return false;

      }
})


  $(".chk_UK-FCL-00233_0").on("change",function(){

		if($(this).val()=='Others'){

			if($(this).is(":checked")){
               
              $("#div_UK-FCL-00126_0").show();
		   }else{

		   	  $("#div_UK-FCL-00126_0").hide();
			  $("#UK-FCL-00126_0").val("");
		   }		

	    }
	});		

  

  $("#UK-FCL-00104_0").prop('readonly',true);
  $("#UK-FCL-00335_0").prop('readonly',true);
  $("#UK-FCL-00336_0").prop('readonly',true);
  $("#UK-FCL-00351_0").prop('readonly',true);
  $('#UK-FCL-00228_0').attr("disabled", true); 
  $("#UK-FCL-00338_0").attr('disabled',true);
  $("#UK-FCL-00401_0").attr('disabled',true);

  $("#UK-FCL-00374_0").prop('readonly',true);

  $("#div_UK-FCL-00338_0").hide();
  $("#div_UK-FCL-00107_0").hide();
  $("#div_UK-FCL-00457_0").hide();
  $("#div_UK-FCL-00463_0").hide();
  $("#div_UK-FCL-00404_0").hide();
  $("#div_UK-FCL-00455_0").hide();


	
   $("#UK-FCL-00197_0").prop('readonly',true); 
   $("#UK-FCL-00096_0").prop('readonly',true); 
   $("#UK-FCL-00231_0").prop('readonly',true);
   //$("#UK-FCL-00104_0").prop('readonly',true);
   $("#UK-FCL-00320_0").prop('readonly',true);

   $("#UK-FCL-00096_0").val("BARBADOS");
   $("#UK-FCL-00320_0").val("BARBADOS");

   $("#div_UK-FCL-00301_0").hide();
   $("#div_UK-FCL-00105_0").hide();
   $("#div_UK-FCL-00324_0").hide();
   $("#div_UK-FCL-00363_0").hide();
   $("#div_UK-FCL-00320_0").hide();

   //quota validation part
    
   // $("#div_UK-FCL-00370_0").hide();
   // $("#div_UK-FCL-00266_0").hide();
   // $("#div_UK-FCL-00288_0").hide();


   // share quota details
    $("#label_UK-FCL-00367_0 #label_UK-FCL-00368_0, #label_UK-FCL-00369_0, #label_UK-FCL-00371_0").find('b').after('<span style="color:red;"> * </span>');

   var nocos = $("#UK-FCL-00365_0").val();
	if(nocos){
		if(nocos=='01'){

				$("#UK-FCL-00367_0").val("Common Quota ").trigger("change");
			  	$("#UK-FCL-00367_0").prop("disabled", true);
				$("#div_UK-FCL-00370_0").hide();
				$("input[name=UK-FCL-00370_0]").prop('checked', false);
				$("#div_UK-FCL-00266_0").hide();
				$("#UK-FCL-00266_0").val("");

				$("#UK-FCL-00371_0").val("The rights of the holders are equal in all respects as follows:\n(a) the right to vote at any meeting of Quotaholders;\n(b) the right to receive any dividend declared by the Society;\n(c) the right to receive the remaining property of the Society on dissolution.");
				$("#UK-FCL-00371_0").attr("readonly",true);
				$("#div_UK-FCL-00288_0").show();
		}else{
			$("#div_UK-FCL-00288_0").hide();
		}
	}else{
		$("#div_UK-FCL-00370_0").hide();	
		$("#div_UK-FCL-00288_0").hide();
	}


	$("#UK-FCL-00365_0").on("change",function(){
		if($(this).val()){
			if($(this).val()=='01'){

				$("#UK-FCL-00367_0").val("Common Quota").trigger("change");
				$("#UK-FCL-00367_0").prop("disabled", true);
				$("#div_UK-FCL-00370_0").hide();
				$("input[name=UK-FCL-00370_0]").prop('checked', false);

				$("#div_UK-FCL-00266_0").hide();
				$("#UK-FCL-00266_0").val("");
				$("#UK-FCL-00371_0").val("The rights of the holders are equal in all respects as follows:\n(a) the right to vote at any meeting of Quotaholders;\n(b) the right to receive any dividend declared by the Society;\n(c) the right to receive the remaining property of the Society on dissolution.");
				$("#UK-FCL-00371_0").attr("readonly",true);
				$("#div_UK-FCL-00288_0").show();

			}else{
				$("#UK-FCL-00367_0").val("").trigger("change");
				$("#UK-FCL-00288_0").val("");
				$("#div_UK-FCL-00288_0").hide();
				$("#UK-FCL-00371_0").attr("readonly",false);
				$("#UK-FCL-00367_0").prop("disabled", false);
			}
		}else{
				$("#UK-FCL-00367_0").val("").trigger("change");
			    $("#UK-FCL-00288_0").val("");
				$("#div_UK-FCL-00288_0").hide();
				$("#UK-FCL-00371_0").attr("readonly",false);
				$("#UK-FCL-00367_0").prop("disabled", false);			 
		}		
	});


	$("#UK-FCL-00367_0").on("change",function(){
		if($(this).val()){
			if($(this).val()=='Common Quota'){

				$("#div_UK-FCL-00370_0").hide();
				$("#div_UK-FCL-00266_0").hide();
				$("input[name=UK-FCL-00370_0]").prop('checked', false);
				$("#UK-FCL-00266_0").val("");	
				$("#UK-FCL-00371_0").val("");

			}else{
				$("#div_UK-FCL-00370_0").show();
				if($(this).val()=="Preference Quota"){
					$("#UK-FCL-00371_0").val("");
				}else{
					$("#UK-FCL-00371_0").val("");
				}
			}
		}else{
			$("#div_UK-FCL-00370_0").hide();
			$("#div_UK-FCL-00266_0").hide();
			$("input[name=UK-FCL-00370_0]").prop('checked', false);
			$("#UK-FCL-00266_0").val("");
			$("#UK-FCL-00371_0").val("");
			 
		}
		
	});

	var ff00265_0 = $('input[name=UK-FCL-00370_0]:checked').val(); 
	if(ff00265_0 == "Yes"){
		$("#div_UK-FCL-00266_0").show();		   
	}else{		
		$("#div_UK-FCL-00266_0").hide();		   
	}

 $('input[name=UK-FCL-00370_0]').change(function(){	 	
		if($(this).val()=="Yes"){
			$("#div_UK-FCL-00266_0").show();	
		}else{
			$("#div_UK-FCL-00266_0").hide();	    	
	    	$("#UK-FCL-00266_0").val("");
	    }
 	});

   // end quota part


   // second part
   var ff00114 = $('input[name=UK-FCL-00230_0]:checked').val();
	if(ff00114 =='Yes'){
		$("#div_UK-FCL-00231_0").show();
		var ff00115 = $('.chk_UK-FCL-00231_0 ').val();
		if(ff00115=="Others (Please specify)"){
			$("#div_UK-FCL-00377_0").show();
		}else{
			$("#div_UK-FCL-00377_0").hide();
		}
	}else{
		$("#div_UK-FCL-00231_0").hide();
		$(".chk_UK-FCL-00231_0 ").prop('checked', false);
		$("#div_UK-FCL-00377_0").hide();
		$("#UK-FCL-00377_0").val("");
	}


	$("input[name=UK-FCL-00230_0]").on("change",function(){	
		if($(this).val()=='Yes'){
			$("#div_UK-FCL-00231_0").show();
			$(".chk_UK-FCL-00231_0 ")[0].checked = true;			
		}else{
			$("#div_UK-FCL-00231_0").hide();
			$(".chk_UK-FCL-00231_0 ").prop('checked', false);
			$("#div_UK-FCL-00377_0").hide();
			$("#UK-FCL-00377_0").val("");
		}
	});


	//quota detail check box
	$(".chk_UK-FCL-00231_0").change(function(){		
			if($(this).val()=='Others (Please specify)'){
				if($(this).is(":checked")){
					$("#div_UK-FCL-00377_0").show();
				}else{
					$("#div_UK-FCL-00377_0").hide();
					$("#UK-FCL-00377_0").val("");
				}
				//
			}else{
				if($(this).is(":checked")){				
					
				}else{
					var cff00114 = $('input[name=UK-FCL-00230_0]:checked').val();
					if(cff00114 =='Yes'){
						$(".chk_UK-FCL-00231_0 ")[0].checked = true;
				}
				}
			}
		});

   //end second part


  $("#UK-FCL-00377_0").keypress(function(){
		if($(this).val().length>=4000){
			return false;			       	
		}
   });


   $("<div class='row'><div class='col-lg-12'><strong>The registered office of the Society in Barbados</strong></div></div><br>").insertAfter("#hr_UK-FCL-00308_0");

$("<div class='row'><div class='col-lg-12'><strong>The classes and maximum number of Quota that the Society is authorised to issue:</strong></div></div><br>").insertAfter("#hr_UK-FCL-00365_0");

   $("<div class='row'><div class='col-lg-12' id='details_of_society'><strong>The details of the Society’s agent in Barbados:</strong></div></div><br>").insertAfter("#div_UK-FCL-00362_0");


   // $("<div class='row'><div class='col-lg-12' id='details_of_society'><strong>The classes and maximum number of Quota that the Society is authorised to issue:</strong></div></div><br>").insertAfter("#div_UK-FCL-00365_0");


   $("#details_of_society").css('display','none');
   $("#title_UK-FCL-00301_0").css('display','none');
   $("#hr_UK-FCL-00301_0").css('display','none');


   $("#UK-FCL-00362_0").on("change",function(){
		if($(this).val()=='Yes'){

            // $("<div style='color:red; float: right; margin-right: 34em; margin-top: -2em;' class='col-md-6 char_validation_4'>In the case of an international society, you may provide the address of its agent in Barbados</div>").insertAfter("#div_UK-FCL-00308_0");

           $("#div_UK-FCL-00301_0").show();
		   $("#div_UK-FCL-00105_0").show();
		   $("#div_UK-FCL-00324_0").show();
		   $("#div_UK-FCL-00363_0").show();
		   $("#div_UK-FCL-00320_0").show();
           $("#div_UK-FCL-00107_0").show();
           $("#div_UK-FCL-00457_0").show();
           $("#div_UK-FCL-00463_0").show();
           $("#div_UK-FCL-00404_0").show();
           $("#div_UK-FCL-00455_0").show();



		   $("#details_of_society").css('display','block');
		   $("#title_UK-FCL-00301_0").css('display','block');
           $("#hr_UK-FCL-00301_0").css('display','block');



		   $(".m-wizard__step:nth-last-child(1)").css('display', 'block');

		   // $("#div_UK-FCL-00309_0").css('position','absolute');
		   // $("#div_UK-FCL-00309_0").css('margin-left','26em');
		   // $("#div_UK-FCL-00309_0").css('margin-top','4px');

		  

		}else{
			
			$(".char_validation_4").hide();

		   $("#div_UK-FCL-00301_0").hide();
		   $("#div_UK-FCL-00105_0").hide();
		   $("#div_UK-FCL-00324_0").hide();
		   $("#div_UK-FCL-00363_0").hide();
		   $("#div_UK-FCL-00320_0").hide();
           $("#div_UK-FCL-00107_0").hide();
           $("#div_UK-FCL-00457_0").hide();
           $("#div_UK-FCL-00463_0").hide();
           $("#div_UK-FCL-00404_0").hide();
           $("#div_UK-FCL-00455_0").hide();



		   $("#details_of_society").css('display','none');
		   $("#title_UK-FCL-00301_0").css('display','none');
           $("#hr_UK-FCL-00301_0").css('display','none');

		   $(".m-wizard__step:nth-last-child(1)").hide();

           //$("#div_UK-FCL-00310_0").css('margin-top','6em');

		  

		}
	});

   

   // $("#div_UK-FCL-00364_0").append("<div class='col-md-12 form-group' style='margin-top:10px;'> Know all men by these presents that the said society hereby appoints the above mentioned agent as its registered agent to act as such, and as such to sue or be sued, plead and be impleaded in any Court in Barbados, and generally on behalf of the Society within Barbados to accept service of process and to receive all lawful notices and, for the purposes of the Society to do all the acts and to execute all deeds and other instruments relating to the matters within the scope of this appointment. It is hereby declared that service of process in respect of suits and proceedings against the society and of lawful notices on the Registered Agent will be binding on the Society for all purposes.</div>");


   $("<div class='row'><div class='col-lg-12' style='margin-top:10px;'><div style='text-align: justify;  text-justify: inter-word; margin-bottom:10px;'>Know all men by these presents that the said society hereby appoints the above mentioned agent as its registered agent to act as such, and as such to sue or be sued, plead and be impleaded in any Court in Barbados, and generally on behalf of the Society within Barbados to accept service of process and to receive all lawful notices and, for the purposes of the Society to do all the acts and to execute all deeds and other instruments relating to the matters within the scope of this appointment. It is hereby declared that service of process in respect of suits and proceedings against the society and of lawful notices on the Registered Agent will be binding on the Society for all purposes.</div></div></div><br>").insertBefore("#div_UK-FCL-00364_0");



   // agent detail validation 
	$("#div_UK-FCL-00105_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox' name='middlenamecheckbox' class='group1'> I do not have a middle name or middle initial</div>");
	$("#UK-FCL-00105_0").blur(function(){
		if($(this).val()){
			$("input[name=middlenamecheckbox]").prop('checked', false);	
		}
	});

	$("input[name=middlenamecheckbox]").change(function(){
		if($(this).val()){
			$("#UK-FCL-00105_0").val("");
		}
	});

	$('#middlenamecheckbox').change(function(){

        if($("#middlenamecheckbox").prop('checked') == true){


         $("#UK-FCL-00105_0").prop('readonly',true);

        }else{

          $("#UK-FCL-00105_0").prop('readonly',false);

        }

   });




	// Manager detail validation 
	$("#div_UK-FCL-00466_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckboxManager' name='middlenamecheckboxmger' class='group1'> I do not have a middle name or middle initial</div>");
	$("#UK-FCL-00466_0").blur(function(){
		if($(this).val()){
			$("input[name=middlenamecheckboxmger]").prop('checked', false);	
		}
	});

	$("input[name=middlenamecheckboxmger]").change(function(){
		if($(this).val()){
			$("#UK-FCL-00466_0").val("");
		}
	});


	$('#middlenamecheckboxManager').change(function(){

        if($("#middlenamecheckboxManager").prop('checked') == true){


         $("#UK-FCL-00466_0").prop('readonly',true);

        }else{

          $("#UK-FCL-00466_0").prop('readonly',false);

        }

   });


   $("#UK-FCL-00384_0").on('change', function() {
        var countryCode = $(this).val();		
		$("#UK-FCL-00372_0").select2("val","");
        $.ajax({
            type: "POST",
            url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
            success: function(result) {
                //alert(result);
                $("#UK-FCL-00372_0").html(result);
				<?php if (isset($_GET['subID']) || (isset($_GET['app_Sub_id']) && !empty($_GET['app_Sub_id']))) { ?>
				//alert("<?php echo @$fieldValues['UK-FCL-00372_0']; ?>");
                $("#UK-FCL-00372_0").val("<?php echo @$fieldValues['UK-FCL-00372_0']; ?>");
                $("#UK-FCL-00372_0").select2("val", "<?php echo @$fieldValues['UK-FCL-00372_0']; ?>");
                $("#UK-FCL-00372_0").change();
                <?php } ?>
            }
        });
    });	


    
    
	// $("#UK-FCL-00360_0").on('change', function() {
         
 //      var srnNum = $(this).val();
      
 //      if(srnNum>0){

 //      	$.ajax({
	//             type: "POST",
	//             dataType:'json',
	//             url: "/backoffice/infowizard/subFormRegistrationOfSocieties/checkCompanyNameBySrnNo/srn_no/" + srnNum,
	//             beforeSend:function(){
	//             	$("#UK-FCL-00360_0-error").text("Please wait...");	    	        	
	//             },
	//             success: function(result) {		            	
	//             	if(result.status==true){
	//             	  $("#UK-FCL-00197_0").val(result.recomended_value);
	//             	  $("#UK-FCL-00197_0-error").text("");	
	//             	  $("#UK-FCL-00197_0-error").text("");	
	            		
	//             	}else if(result.status=='invalid'){
 //        			$("#UK-FCL-00197_0-error").text(result.msg);

 //        			//alert(result.msg1+"\r\n"+result.msg2);
 //        			$(".msg_remove").remove();

 //        			$("#div_UK-FCL-00197_0").find('div').append('<div class="form-group form-control-feedback msg_remove" id="UK-FCL-00197_0-error">'+result.msg1+'<br>'+result.msg2+'</div>');

 //        		    $("#UK-FCL-00197_0").val("");
 //        		    $("#UK-FCL-00197_0").val("");		
	            			            			            	
	//             	}else{
	//             		$("#UK-FCL-00197_0-error").text(result.msg);
	//             		//$("#UK-FCL-00197_0").val("");		            	
	//             	}
	//                console.log(result);
	//             }

	//         });
 //     } 	

 // });


 var deaultsrn = $("#UK-FCL-00360_0").val();
	if(deaultsrn){
		getcomapnyname(deaultsrn);
	}

	$("#UK-FCL-00360_0").on("blur",function(){
		var srn_no = $(this).val();
		getcomapnyname(srn_no);
			 
	});


 function getcomapnyname(srn_no){
	if(srn_no!=""){
				$.ajax({
		            type: "POST",
		            dataType:'json',
		            url: "/backoffice/infowizardtwo/subFormRegistrationOfSocieties/getCompanyNameBySrnNo/srn_no/" + srn_no +"/subID/<?= isset($_GET['subID']) ? $_GET['subID'] : NULL ?>",
		            beforeSend:function(){
		            	$("#UK-FCL-00360_0-error").text("Please wait...");	    	        	
		            },
		            success: function(result) {		            	
		            	if(result.status==true){
		            		if(result.app_status=='valid'){
		            			$("#UK-FCL-00197_0").val(result.name);
		            			$("#UK-FCL-00360_0-error").html("");
		            			$("#UK-FCL-00197_0-error").html("");	
		            		}else{
		            			$("#UK-FCL-00360_0-error").text(result.msg);			
		            			if ($("#UK-FCL-00197_0-error").length) {
									$("#UK-FCL-00197_0-error").text(errormessages.srn_msg001);
				    			}else{
				    				$("#div_UK-FCL-00197_0").find('div').append('<div  style="color:red;" id="UK-FCL-00197_0-error">'+errormessages.srn_msg001+'<br>'+errormessages.srn_msg002+'</div>');
				    			}    

				    			$("#UK-FCL-00197_0").val("");  
		            		}	            			            	
		            	}else{
		            		if(result.user){
		            			$("#UK-FCL-00360_0-error").text(result.msg);
		            		    $("#UK-FCL-00197_0").val("");	
		            		    $("#UK-FCL-00197_0-error").text("");
		            		}else{
		            			alert(result.msg);
		            		}		            			            	
		            	}
		             //  console.log(result);
		            }
		        });
		}	
}	


 //validation for not allowed the number and special charector

  $("#UK-FCL-00150_0, #UK-FCL-00105_0, #UK-FCL-00106_0, #UK-FCL-00235_0, #UK-FCL-00236_0, #UK-FCL-00237_0, #UK-FCL-00239_0").keypress(function(event){
        var inputValue = event.charCode;
        if(!(inputValue >= 65 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)){
            event.preventDefault();
        }
    });


  //Allow only number validation
  $("#UK-FCL-00229_0").keypress(function(event){
        var k = event.which;
        var charCode = (event.which) ? event.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
    });


// mailing address check is same as reg
	$("#UK-FCL-00103_0").on("change",function(){

		
		if($(this).val()=='Yes'){

		  //var postalcode = $("#UK-FCL-00094_0").text();

		 var postalcode =  $('#UK-FCL-00094_0 option:selected').text();
		 



		  $("#UK-FCL-00104_0").prop('readonly',true);
		  $("#UK-FCL-00335_0").prop('readonly',true);
		  $("#UK-FCL-00336_0").prop('readonly',true);
		  $("#UK-FCL-00351_0").prop('readonly',true);
		  $('#UK-FCL-00228_0').attr("disabled", true); 
		  $("#UK-FCL-00338_0").attr('disabled',true);
		  $("#UK-FCL-00401_0").attr('disabled',true);

		   $("#div_UK-FCL-00401_0").show();
		   $("#div_UK-FCL-00338_0").hide();

			$("#UK-FCL-00104_0").val($("#UK-FCL-00308_0").val());
			$("#UK-FCL-00335_0").val($("#UK-FCL-00309_0").val());
			$("#UK-FCL-00336_0").val($("#UK-FCL-00310_0").val());
			$("#UK-FCL-00351_0").val($("#UK-FCL-00096_0").val());	
			$("#UK-FCL-00228_0").val($("#UK-FCL-00405_0").val()).trigger("change");
			$("#UK-FCL-00401_0").val(postalcode);

		}else{

		   $("#UK-FCL-00104_0").prop('readonly',false);
		   $("#UK-FCL-00335_0").prop('readonly',false);
		   $("#UK-FCL-00336_0").prop('readonly',false);
		   $("#UK-FCL-00351_0").prop('readonly',false);
		   $('#UK-FCL-00228_0').attr("disabled", false); 
		   $("#UK-FCL-00338_0").attr('disabled',false);

		   $("#div_UK-FCL-00401_0").hide();
		   $("#div_UK-FCL-00338_0").show();

			$("#UK-FCL-00104_0").val("");
			$("#UK-FCL-00335_0").val("");
			$("#UK-FCL-00336_0").val("");
			$("#UK-FCL-00351_0").val("");	
			$("#UK-FCL-00228_0").val("").trigger("change");
			$("#UK-FCL-00338_0").val("").trigger("change");	
		}
});



$("#UK-FCL-00405_0").on("change",function(){
	if($(this).val()){
			$.ajax({
	            type: "POST",
	            dataType:'html',
	            url: "/backoffice/infowizard/subFormRegistrationCharityBoard/getpostalcode/p_id/" + $(this).val(),
	            beforeSend:function(){
	            /*	if ($("#UK-FCL-00094_0-error").length) {
				$("#UK-FCL-00094_0-error").text("Please enter the correct postal code");
			}else{*/
				$("#UK-FCL-00094_0-error").text("Please Wait...");
				//$("#div_UK-FCL-00094_0").find('div').append('<div id="UK-FCL-00094_0-error" class="form-control-feedback">Please Wait...</div>');
			//}	
	        	        	
	            },
	            success: function(result) {	         		            		
        			$("#UK-FCL-00094_0-error").text("");		         
        		    $("#UK-FCL-00094_0").html(result);	
        		   // alert(result);	            	
	            			              
	            }
	        });
	}	
});


$("#UK-FCL-00404_0").on("change",function(){
	if($(this).val()){
			$.ajax({
	            type: "POST",
	            dataType:'html',
	            url: "/backoffice/infowizard/subFormRegistrationCharityBoard/getpostalcode/p_id/" + $(this).val(),
	            beforeSend:function(){
	            /*	if ($("#UK-FCL-00405_0-error").length) {
				$("#UK-FCL-00405_0-error").text("Please enter the correct postal code");
			}else{*/
				$("#UK-FCL-00455_0-error").text("Please Wait...");
				//$("#div_UK-FCL-00455_0").find('div').append('<div id="UK-FCL-00455_0-error" class="form-control-feedback">Please Wait...</div>');
			//}	
	        	        	
	            },
	            success: function(result) {	         		            		
        			$("#UK-FCL-00455_0-error").text("");		         
        		    $("#UK-FCL-00455_0").html(result);	
        		   // alert(result);	            	
	            			              
	            }
	        });
	}	
});


$("#UK-FCL-00228_0").on("change",function(){
	if($(this).val()){
			$.ajax({
	            type: "POST",
	            dataType:'html',
	            url: "/backoffice/infowizard/subFormRegistrationCharityBoard/getpostalcode/p_id/" + $(this).val(),
	            beforeSend:function(){
	            /*	if ($("#UK-FCL-00228_0-error").length) {
				$("#UK-FCL-00228_0-error").text("Please enter the correct postal code");
			}else{*/
				$("#UK-FCL-00228_0-error").text("Please Wait...");
				//$("#div_UK-FCL-00228_0").find('div').append('<div id="UK-FCL-00228_0-error" class="form-control-feedback">Please Wait...</div>');
			//}	
	        	        	
	            },
	            success: function(result) {	         		            		
        			$("#UK-FCL-00228_0-error").text("");		         
        		    $("#UK-FCL-00338_0").html(result);	
        		   // alert(result);	            	
	            			              
	            }
	        });
	}	
});




$("#UK-FCL-00199_0, #UK-FCL-00308_0, #UK-FCL-00107_0, #UK-FCL-00231_0, #UK-FCL-00232_0, #UK-FCL-00233_0").keypress(function(e){
		var keyCode = e.which;
			 
		console.log(keyCode);
		$(".proposedName").remove();
		if((keyCode == 33) || (keyCode == 64) || (keyCode == 35) || (keyCode == 36) || (keyCode == 37) || (keyCode == 94) || (keyCode== 42) || (keyCode== 126) || (keyCode== 96) || (keyCode== 63) || (keyCode== 60) || (keyCode== 62))
		{
			var id = $(this).attr('id');
			$("#div_"+id).append("<div id="+id+"'-error' style='color:red; margin-left:1em;' class='form-control-feedback-error proposedName'>Only following spcial characters are allowed (),.&:;-</div>");			
			e.preventDefault();		
		}		
	});


$("#UK-FCL-00230_0").on("change",function(){
		if($(this).val()=='Yes'){
            $("#UK-FCL-00231_0").prop('readonly',false);
		}else{
			$("#UK-FCL-00231_0").val(" ");
         $("#UK-FCL-00231_0").prop('readonly',true);

		}
	});






var maxchars_0 = 4000;
	$('#UK-FCL-00126_0').keyup(function () {
	    var tlength = $(this).val().length;
	    $(this).val($(this).val().substring(0, maxchars_0));
	    var tlength = $(this).val().length;
	    remain = maxchars_0 - parseInt(tlength);
	    $(".char_validation_1").remove();
	    if(remain == 0){
	      $("#UK-FCL-00126_0-error").parent('div').append("<div style='color:red;'  class='form-control-feedback-error char_validation_1'>Please attach a schedule in prescribed format to this Form under document listing tab at the end.</div>");
	      return false;
	    }
	});

//4000 Charactor Validation
  var maxchars_1 = 4000;
	$('#UK-FCL-00231_0').keyup(function () {
	    var tlength = $(this).val().length;
	    $(this).val($(this).val().substring(0, maxchars_1));
	    var tlength = $(this).val().length;
	    remain = maxchars_1 - parseInt(tlength);
	    $(".char_validation_1").remove();
	    if(remain == 0){
	      $("#UK-FCL-00231_0-error").parent('div').append("<div style='color:red;'  class='form-control-feedback-error char_validation_1'>Please add Schedule as an attachment, if the text limit exceeds 4000 characters.</div>");
	      return false;
	    }
	});

	//4000 Charactor Validation
  var maxchars_2 = 4000;
	$('#UK-FCL-00233_0').keyup(function () {
	    var tlength = $(this).val().length;
	    $(this).val($(this).val().substring(0, maxchars_2));
	    var tlength = $(this).val().length;
	    remain = maxchars_2 - parseInt(tlength);
	    $(".char_validation_1").remove();
	    if(remain == 0){
	      $("#UK-FCL-00233_0-error").parent('div').append("<div style='color:red;'  class='form-control-feedback-error char_validation_1'>Please add Schedule as an attachment, if the text limit exceeds 4000 characters.</div>");
	      return false;
	    }
	});


	//4000 Charactor Validation
  var maxchars_3 = 4000;
	$('#UK-FCL-00232_0').keyup(function () {

	    var tlength = $(this).val().length;
	    $(this).val($(this).val().substring(0, maxchars_3));
	    var tlength = $(this).val().length;
	    remain = maxchars_3 - parseInt(tlength);
	    console.log(remain);
	    $(".char_validation_1").remove();
	    if(remain == 0){
	      $("#UK-FCL-00232_0-error").parent('div').append("<div style='color:red;'  class='form-control-feedback-error char_validation_1'>Please add Schedule as an attachment, if the text limit exceeds 4000 characters.</div>");
	      return false;
	    }
	});


//2000 Charactor Validation
  var maxchars_4 = 2000;
	$('#UK-FCL-00199_0').keyup(function () {
	    var tlength = $(this).val().length;
	    $(this).val($(this).val().substring(0, maxchars_4));
	    var tlength = $(this).val().length;
	    remain = maxchars_4 - parseInt(tlength);
	    $(".char_validation_1").remove();
	    if(remain == 0){
	      $("#UK-FCL-00199_0-error").parent('div').append("<div style='color:red;'  class='form-control-feedback-error char_validation_1'>Only 2000 characters can be inserted in this field. In case you want to provide additional information, then please attach a schedule in required format  under document listing page at the end.</div>");
	      return false;
	    }
	});

	//500 Charactor Validation
  var maxchars_5 = 500;
	$('#UK-FCL-00308_0, #UK-FCL-00107_0,#UK-FCL-00238_0').keyup(function () {
	    var tlength = $(this).val().length;
	    $(this).val($(this).val().substring(0, maxchars_5));
	    var tlength = $(this).val().length;
	    remain = maxchars_5 - parseInt(tlength);
	    $(".char_validation_1").remove();
	    if(remain == 0){
	      $("#UK-FCL-00308_0-error").parent('div').append("<div style='color:red;'  class='form-control-feedback-error char_validation_1'>Space of 500 characters to be given for this field</div>");
	      return false;
	    }
	});

	
});


function addmorebtncheckmanagersdetail(){

 var nofdirecotor = $("#UK-FCL-00234_0").val();

     	//alert(nofdirecotor);

     var totalRowCount = 0;          
     totalRowCount =  $("#tbl_2015 td").closest("tr").length;

     if(nofdirecotor<=totalRowCount){

     	//alert(nofdirecotor);
     	
     $(".check_fixed_number").remove();
     $(".check_number_three").hide();

		$("#title_UK-FCL-00234_0").append("<b style='color:red; margin-left:2em;' class='check_fixed_number'>Sorry if you want to add more Manager  then please update No. of appointed managers.</b>");

		var titleTot = jQuery("#title_UK-FCL-00234_0").offset().top;
		var addHeight = parseInt(titleTot) - 170;
		jQuery('html,body').animate({ scrollTop: addHeight}, 1000);

		$("#UK-FCL-00234_0").css("border", "1px solid #e73d4a");

     	e.stop();
		  e.preventDefault();
		  return false;

     }
     /*else if(nofdirecotor < 3){

     	$(".check_number_three").remove();
        $(".check_fixed_number").hide();

     	//alert(nofdirecotor);


    
		$("#title_UK-FCL-00234_0").append("<b style='color:red; margin-left:2em;' class='check_number_three'>Please note, that the minimum no. of managers should be three.</b>");

		var titleTot = jQuery("#title_UK-FCL-00234_0").offset().top;
		var addHeight = parseInt(titleTot) - 170;
		jQuery('html,body').animate({ scrollTop: addHeight}, 1000);

		$("#UK-FCL-00234_0").css("border", "1px solid #e73d4a");

     	e.stop();
		  e.preventDefault();
		  return false;

     }else{
     
		  $("#UK-FCL-00234_0").css("border", "1px solid gray");
      	return true;
     } 	*/ 	

}


function addmorebtnchecksharecapitaldetail(){
	var nofapp = $("#UK-FCL-00365_0").val();

	var totalRowCount = 0;          
      totalRowCount =  $("#tbl_1168 td").closest("tr").length;
	if(nofapp<=totalRowCount){
		/*$("#title_UK-FCL-00262_0").append("<b style='color:red;' class='amalgamatingDetail'>Please Add Number of Shares Capital Details as Per Enter 'No. of classes of shares' Field.</b>");*/
		var scdem = "Please Add Number of Quota Details as Per Enter 'No. of classes of Quota' Field."; 
						if ($("#scd").length) {
							$("#scd").text(scdem);
		    			}else{
		    				$("#title_UK-FCL-00365_0").append('<b style="color:red;" id="scd">'+scdem+'</b>');
		    			}	
			var titleTot = jQuery("#title_UK-FCL-00365_0").offset().top;
			var addHeight = parseInt(titleTot) - 170;
			jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
			e.stop();
			e.preventDefault();
			return false;
	}
	else{
		$("#scd").text("");
		return true;	
	}
}


 function addmoreaction(id,service_id,div_id){
     
 	if(div_id==1168){
		var respon = addmorebtnchecksharecapitaldetail();
		if(respon==false){
			return false;
		}
	}else{
		if(div_id==2015){
			var respon = addmorebtncheckmanagersdetail();
			if(respon==false){
				return false;
			}
		}
	}

 	//alert(div_id);
 	
 	$.ajax({
		type: "GET",
		dataType: 'json',
		data: {"button_id": id, "service_id": service_id, "add_more_button_di": div_id},
		url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/formFieldMaster/getAddmoreData",
		success: function (data) {
			console.log(data);
			var tr_ = "<tr class='add_more_"+div_id+"'>";
			var td_ = '';
			var err = 0;
			var fieldsIDArr = new Array();
			$.each(data, function (key, item) {
				var id = item.id;
				var vall;
				var typeVal;
				var name = item.full_name;
				var formchk_id = item.formchk_id;
				var selector = $('[name="' + formchk_id + '"]');
				var cls = '';
			
				if ($(selector).is("input")) {
					if ($("input:radio[name='" + formchk_id + "']").attr('type') == 'radio') {
						/*vall = $("input:radio[name='" + formchk_id + "']:checked").val();
						typeVal = 'radio';
						$("input:radio[name='" + formchk_id + "']").addClass('val');
						if ($("input:radio[name='" + formchk_id + "']").hasClass('val')) {
							cls = 'val';
						}*/
						var getSelectedValue = document.querySelector( 'input[name="'+formchk_id+'"]:checked');
						if(getSelectedValue!= null){
							vall = getSelectedValue.value
						}else{
							vall = '';
						}

						typeVal = 'radio';
						$("input:radio[name='" + formchk_id + "']").addClass('val');
						if ($("input:radio[name='" + formchk_id + "']").hasClass('val')) {
							cls = 'val';
						}
					}else if ($("input[name='" + formchk_id + "']").attr('type') == 'number') {
						vall = $("input[name='" + formchk_id + "']").val();
						typeVal = 'number';
						$("input[name='" + formchk_id + "']").addClass('val');
						if ($("input[name='" + formchk_id + "']").hasClass('val')) {
							cls = 'val';
						}							
					}
					else {
						vall = $("input[name='" + formchk_id + "']").val();
						typeVal = 'text';
						$("input:text[name='" + formchk_id + "']").addClass('val');
						if ($("input[name*='" + formchk_id + "']").hasClass('val')) {
							cls = 'val';
						}
						
					}
				}

				else if ($(selector).is("select") || $('#' + formchk_id).is("select")) {						
					if ($('#' + formchk_id).prop('multiple')) {
						typeVal = 'multiple';
						var selMulti = $.map($("#" + formchk_id + " option:selected"), function (el, i) {
							return $(el).text();
						});
						vall = selMulti.join(", ");
						$('#' + formchk_id).addClass('val');
						if ($('#' + formchk_id).hasClass('val')) {
							cls = 'val';
						}
						$("#" + formchk_id + " option").removeAttr("selected");
					}
					else {	
						typeVal = 'dropdown';
						vall = $("select[name='" + formchk_id + "'] option:selected").text();
						$("select[name='" + formchk_id + "']").addClass('val');	
						if ($("select[name='" + formchk_id + "']").hasClass('val')) {
							cls = 'val';
						}
						$("#" + formchk_id + " option").removeAttr("selected");
					}
				}
				else if ($(selector).is("textarea")) {	
					typeVal = 'textarea';
					vall = $("textarea[name='" + formchk_id + "']").val();
					$("textarea[name='" + formchk_id + "']").addClass('val');
					if ($("textarea[name='" + formchk_id + "']").hasClass('val')) {
						cls = 'val';
					}
				}
				else if ($('.chk_' + formchk_id).is(':checkbox')) {
					typeVal = 'checkbox';
					vall = $('.chk_' + formchk_id + ':checked').map(function () {
						return this.value;
					}).get().join(',');
					$('.chk_' + formchk_id).addClass('val');
					if ($('.chk_' + formchk_id).hasClass('val')) {
						cls = 'val';
					}	
				}

				if (cls == 'val' && (vall == '' || vall == 'undefined' || vall == 'Please Select ')) {
					$(".errorDetail").remove();
					if(div_id==2015){

						if(formchk_id=='UK-FCL-00466_0'){
					var mnt = $("#UK-FCL-00466_0").val();
					if(mnt){
						var checkfield = true;
					}else{
						var mncb = $('input[name=middlenamecheckboxmger]:checked').val(); 
						if(mncb){
							var checkfield = true;
						}else{
							var checkfield = false;
						}
					}
				}else{
					var checkfield = true;
				}	
							if(formchk_id=='UK-FCL-00397_0' || formchk_id=='UK-FCL-00398_0' || formchk_id=='UK-FCL-00468_0' || formchk_id == 'UK-FCL-00384_0' || formchk_id=='UK-FCL-00372_0'||formchk_id=='UK-FCL-00239_0'||  checkfield == false){
									var labelData = $("#label_" + formchk_id).text();
								labelData=labelData.replace('('+formchk_id+')',"");
								//alert(formchk_id);
								if(formchk_id=="UK-FCL-00466_0"){
											$("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>Please enter the required information or select the check box</div>");
									}else{
										
											$("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>This field is required</div>");
																			
									}					
								err = err + 1;
								return false;
								}else{
									$(".errorDetail").remove();
									/*if(formchk_id=='UK-FCL-00133_0' || formchk_id=='UK-FCL-00137_0'){
										if(vall==""){
											vall = 'NA';
										}
									}*/
									td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
												fieldsIDArr.push(formchk_id);		
								}	
					}	
					if(div_id==188){
							if(formchk_id=='UK-FCL-00140_0' || formchk_id=='UK-FCL-00142_0' || formchk_id=='UK-FCL-00143_0'){
									var labelData = $("#label_" + formchk_id).text();
								labelData=labelData.replace('('+formchk_id+')',"");
								//alert(formchk_id);
								$("#div_"+formchk_id).append("<span style='color:red;padding-left:16px;' class='errorDetail'>This field is required</span>");						
								err = err + 1;
								return false;
								}else{
									$(".errorDetail").remove();
									td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
												fieldsIDArr.push(formchk_id);		
								}	
					}	
					if(div_id==1168){
							if(formchk_id=='UK-FCL-00367_0' || formchk_id=='UK-FCL-00368_0' || formchk_id=='UK-FCL-00369_0' || formchk_id=='UK-FCL-00371_0'){
									var labelData = $("#label_" + formchk_id).text();
								labelData=labelData.replace('('+formchk_id+')',"");
								//alert(formchk_id);
								$("#div_"+formchk_id).append("<span style='color:red;padding-left:16px;' class='errorDetail'>This field is required</span>");						
								err = err + 1;
								return false;
								}else{
									$(".errorDetail").remove();
									td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
												fieldsIDArr.push(formchk_id);		
								}	
					}			
				}
				else {
					$(".errorDetail").remove();
					//console.log(typeVal);
					td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
					fieldsIDArr.push(formchk_id);						
				}

			}); 
			if (err == 0) {
				//alert(JSON.stringify(fieldsIDArr));
                if(confirm('Before adding, please check whether the details entered is correct.'))
				
				$('#add_more_' + div_id).show();
				$('#tbl_' + div_id).show();
				td_ += "<td style='text-align:center;'><a class='btn btn-danger del_1' pi='add_more_"+div_id+"'><i class='fa fa-trash' aria-hidden='true'></i></a></td>";
				tr_ += td_ + "</tr>";
				$(tr_).appendTo($('#tbl_' + div_id));
				//alert(fieldsIDArr);
				fieldsIDArr.forEach(myFunction);
				function myFunction(value, index, array) {	
					$("input:radio[name='" + value + "']").prop('checked', false);
					$('#' + value).val("");
					$("#" + value + "").select2("val", "");
					$('.chk_' + value + ':checked').removeAttr('checked');
				}
		
			} else
				return false;
	                            
			$('.del_1').on('click', function () {					
				$(this).closest('tr').remove();
				var uio= $(this).attr('pi');
				if($("."+uio).length<2){
					$("#"+uio).css('display','none');
				}
	                                
			});
		} // success function close here
	}); //ajax end here
 }



</script>



