
<script type="text/javascript">
$(document).ready(function(){


 	$('#UK-FCL-00340_0, #UK-FCL-00341_0, #UK-FCL-00344_0, #UK-FCL-00342_0, #UK-FCL-00343_0, #UK-FCL-00348_0, #UK-FCL-00350_0').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });


	$("#UK-FCL-00344_0").attr('readonly',true);
    $('#UK-FCL-00132_0, #UK-FCL-00133_0, #UK-FCL-00134_0, #UK-FCL-00093_0, #UK-FCL-00309_0, #UK-FCL-00310_0, #UK-FCL-00094_0').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });

	// share capital details
$("#label_UK-FCL-00095_0, #label_UK-FCL-00263_0, #label_UK-FCL-00264_0, #label_UK-FCL-00113_0").find('b').after('<span style="color:red;"> * </span>');

	// Director details
$("#label_UK-FCL-00132_0, #label_UK-FCL-00134_0, #label_UK-FCL-00093_0,#label_UK-FCL-00372_0,  #label_UK-FCL-00096_0, #label_UK-FCL-00137_0, #label_UK-FCL-00480_0, #label_UK-FCL-00481_0").find('b').after('<span style="color:red;"> * </span>');
$("#div_UK-FCL-00480_0").find('label > b').after('<span style="color:red;"> * </span>');

$("#UK-FCL-00089_0").prop('readonly',true);

$("#UK-FCL-00347_0").prop('readonly',true);
$("#UK-FCL-00347_0").val("BARBADOS");

$("<div class='row'><div class='col-lg-12'><strong>Address of Registered Office</strong></div></div><br>").insertBefore("#div_UK-FCL-00340_0");

$("<div class='row'><div class='col-lg-12'><strong>Mailing Address of the Company</strong></div></div><br>").insertBefore("#div_UK-FCL-00342_0");

$("<div class='row'><div class='col-lg-12'><strong>The classes and maximum number of shares that the company is authorised to issue:</strong></div></div><br>").insertAfter("#hr_UK-FCL-00262_0");
	// company details validation

	var itartbmco = $('input[name=UK-FCL-00121_0]:checked').val();
	if(itartbmco=='Yes'){
		$("#div_UK-FCL-00339_0").show();
	}else{
		$("#div_UK-FCL-00339_0").hide();
	}

	$("input[name=UK-FCL-00121_0]").on("change",function(){		
	    if($(this).val()=='Yes'){
	    	$("#div_UK-FCL-00339_0").show();
	    }else{
	    	$("#div_UK-FCL-00339_0").hide();
	    	$("#UK-FCL-00339_0").val("");
	    }
	});

/*var pcorpc = $('input[name=UK-FCL-00123_0]:checked').val();
	if(pcorpc=='Public Company'){
		$("#div_UK-FCL-00124_0").hide();
	    	$("input[name=UK-FCL-00124_0]").prop('checked', false);

	    	$("#div_UK-FCL-00098_0").hide();
			$(".chk_UK-FCL-00098_0 ").prop('checked', false);

			$("#div_UK-FCL-00126_0").hide();
			$("#UK-FCL-00126_0").val("");
	}else{
		if(pcorpc=='Private Company'){
			$("#div_UK-FCL-00124_0").show();
			$("input[name=UK-FCL-00124_0][value='Yes']").prop('checked', true);
			$("#div_UK-FCL-00098_0").show();
			$(".chk_UK-FCL-00098_0 ")[0].checked = true;		
			$("#div_UK-FCL-00126_0").hide();
			$("#UK-FCL-00126_0").val("");
		}else{
			$("#div_UK-FCL-00124_0").hide();
			$("#div_UK-FCL-00098_0").hide();
		}		
	}*/


//Address detail form 4

var f0493_0 = $('input[name=UK-FCL-00493_0]:checked').val();
if(f0493_0=='Yes'){
		$("#UK-FCL-00342_0").val($("#UK-FCL-00340_0").val());
	  	$("#UK-FCL-00343_0").val($("#UK-FCL-00341_0").val());

	  	$("#UK-FCL-00351_0").val(829).trigger("change");	
	  	$("#UK-FCL-00349_0").val($("#UK-FCL-00345_0").val()).trigger("change");

	  	$("#UK-FCL-00348_0").val($("#UK-FCL-00344_0").val());
	  	$("#UK-FCL-00350_0").val($("#UK-FCL-00346_0 option:selected").text());	 

	  	$("#UK-FCL-00342_0, #UK-FCL-00343_0, #UK-FCL-00348_0, #UK-FCL-00350_0").prop('readonly',true);

	  	$("#UK-FCL-00351_0, #UK-FCL-00349_0").prop('disabled',true);

	  	$("#div_UK-FCL-00348_0").append("<div id='getcontrystate'><input type='hidden' name='UK-FCL-00351_0' value='829'/><input type='hidden' name='UK-FCL-00349_0' value='"+$("#UK-FCL-00345_0").val()+"'/></div>");

}

$("input[name=UK-FCL-00493_0]").on("change",function(){	
	  if($(this).val()=='Yes'){
	  	$("#UK-FCL-00342_0").val($("#UK-FCL-00340_0").val());
	  	$("#UK-FCL-00343_0").val($("#UK-FCL-00341_0").val());

	  	$("#UK-FCL-00351_0").val(829).trigger("change");	  	

	  	$("#UK-FCL-00348_0").val($("#UK-FCL-00344_0").val());
	  	$("#UK-FCL-00350_0").val($("#UK-FCL-00346_0 option:selected").text());	 
	  
	  	$("#UK-FCL-00342_0, #UK-FCL-00343_0, #UK-FCL-00348_0, #UK-FCL-00350_0").prop('readonly',true);

	  	$("#UK-FCL-00351_0, #UK-FCL-00349_0").prop('disabled',true);

	  	$("#div_UK-FCL-00348_0").append("<div id='getcontrystate'><input type='hidden' name='UK-FCL-00351_0' value='829'/><input type='hidden' name='UK-FCL-00349_0' value='"+$("#UK-FCL-00345_0").val()+"'/></div>");

	  }else{

	  	$("#getcontrystate").html("");
	  	$("#UK-FCL-00351_0, #UK-FCL-00349_0").val("").trigger("change");
	  	$("#UK-FCL-00342_0, #UK-FCL-00343_0, #UK-FCL-00348_0, #UK-FCL-00350_0").val("");

	  	$("#UK-FCL-00342_0, #UK-FCL-00343_0, #UK-FCL-00348_0, #UK-FCL-00350_0").prop('readonly',false);
	  	$("#UK-FCL-00351_0, #UK-FCL-00349_0").prop('disabled',false);
	  }
});
//




	$("input[name=UK-FCL-00123_0]").on("change",function(){		
	    if($(this).val()=='Public Company'){
	    	//$("#div_UK-FCL-00124_0").hide();
	    	$("input[name=UK-FCL-00124_0]").prop('checked', false);
	    	$("input[name=UK-FCL-00124_0][value='No']").prop("style","");

	    	$("#div_UK-FCL-00098_0").hide();
			$(".chk_UK-FCL-00098_0 ").prop('checked', false);

			$("#div_UK-FCL-00126_0").hide();
			$("#UK-FCL-00126_0").val("");

	    }else{
	    	if($(this).val()=='Private Company'){
	    		//$("#div_UK-FCL-00124_0").show();
			$("input[name=UK-FCL-00124_0][value='Yes']").prop('checked', true);
			$("input[name=UK-FCL-00124_0][value='No']").prop("style","opacity: 0.2");

			$("#div_UK-FCL-00098_0").show();
			$(".chk_UK-FCL-00098_0 ").prop('checked', false);
			$(".chk_UK-FCL-00098_0 ")[0].checked = true;		

			$("#div_UK-FCL-00126_0").hide();
			$("#UK-FCL-00126_0").val("");
		}	    	
	    }
	    $("#UK-FCL-00241_0, #UK-FCL-00119_0, #UK-FCL-00120_0").val("");
	});

	var optextbox = $("#UK-FCL-00126_0").val();
	if(optextbox==''){
		$("#div_UK-FCL-00126_0").hide();
	}else{
		$("#div_UK-FCL-00126_0").show();
	}

	var itaop = $("input[name=UK-FCL-00124_0]:checked").val();
	if(itaop=="Yes"){
		$("#div_UK-FCL-00098_0").show();
	}else{
		$("#div_UK-FCL-00098_0").hide();
	}

	$("input[name=UK-FCL-00124_0]").on("change",function(){
		if($(this).val()=='No'){
			var citcporp = $('input[name=UK-FCL-00123_0]:checked').val();
				if(citcporp =='Private Company'){
					$("input[name=UK-FCL-00124_0][value='Yes']").prop('checked', true);
				}else{
					$("#div_UK-FCL-00098_0").hide();
					$("input[name=UK-FCL-00098_0]").prop('checked', false);
					$("#div_UK-FCL-00126_0").hide();
					$("#UK-FCL-00126_0").val("");
				}			
		}else{
			$("#div_UK-FCL-00098_0").show();			
			$("#div_UK-FCL-00126_0").hide();
			$("#UK-FCL-00126_0").val("");
		}
	});

//company detail check box
	$(".chk_UK-FCL-00098_0 ").on("change",function(){
		if($(this).val()=='Others - Please State'){
			if($(this).is(":checked")){
				$("#div_UK-FCL-00126_0").show();
			}else{
				$("#div_UK-FCL-00126_0").hide();
			$("#UK-FCL-00126_0").val("");
			}
			//
		}else{
			if($(this).is(":checked")){				
				
			}else{
				var citcporp = $('input[name=UK-FCL-00123_0]:checked').val();
				if(citcporp =='Private Company'){
					$(".chk_UK-FCL-00098_0 ")[0].checked = true;
				}
			}
		}
	});

//share capital detail check box
$(".chk_UK-FCL-00115_0 ").change(function(){		
		if($(this).val()=='Other Restrictions'){
			if($(this).is(":checked")){
				$("#div_UK-FCL-00116_0").show();
			}else{
				$("#div_UK-FCL-00116_0").hide();
				$("#UK-FCL-00116_0").val("");
			}
			//
		}else{
			if($(this).is(":checked")){				
				
			}else{
				var cff00114 = $('input[name=UK-FCL-00334_0]:checked').val();
				if(cff00114 =='Yes'){
					//$(".chk_UK-FCL-00115_0 ")[0].checked = true;
				}
			}
		}
	});
	



//share capital below fields js
//document.getElementById("UK-FCL-00113_0").maxLength = "4000";
	$("#UK-FCL-00113_0").keypress(function(){
		if($(this).val().length>=4000){
			return false;		       	
		}
   });

//document.getElementById("UK-FCL-00116_0").maxLength = "4000";
	$("#UK-FCL-00116_0").keypress(function(){
		if($(this).val().length>=4000){
			return false;			       	
		}
   });
	 
/*var ff00115 =  $('input[name=UK-FCL-00115_0]:checked').val();
	if(ff00115=='Yes'){
		$("#div_UK-FCL-00115_0").show();
	}else{
		$("#div_UK-FCL-00115_0").hide();
	}

var ff00116 = $("#UK-FCL-00116_0").val();
	if(ff00116==''){
		$("#div_UK-FCL-00116_0").hide();
	}else{
		$("#div_UK-FCL-00116_0").show();
	}*/

var ff00114 = $('input[name=UK-FCL-00334_0]:checked').val();

if(ff00114 =='Yes'){

	$("#div_UK-FCL-00115_0").show();
	var ff00115 = $('.chk_UK-FCL-00115_0 ').val();
	if(ff00115=="Other Restrictions"){
		$("#div_UK-FCL-00116_0").show();
	}else{
		$("#div_UK-FCL-00116_0").hide();
	}
}else{
	$("#div_UK-FCL-00115_0").hide();
	$(".chk_UK-FCL-00115_0 ").prop('checked', false);
	$("#div_UK-FCL-00116_0").hide();
	$("#UK-FCL-00116_0").val("");
}

	$("input[name=UK-FCL-00334_0]").on("change",function(){	
		if($(this).val()=='Yes'){
			$("#div_UK-FCL-00115_0").show();
			//$(".chk_UK-FCL-00115_0 ")[0].checked = true;			
		}else{
			$("#div_UK-FCL-00115_0").hide();
			$(".chk_UK-FCL-00115_0 ").prop('checked', false);
			$("#div_UK-FCL-00116_0").hide();
			$("#UK-FCL-00116_0").val("");
		}
	});

	



// share capital below fields js end

	/*$("#UK-FCL-00098_0").on("change",function(){	
		var val = $(this).val();
		var strArray = val.toString().split(",");        	
	 		alert(strArray);
	});*/


	//Director panel JS
var sdinorr = $('input[name=UK-FCL-00240_0]:checked').val();
//alert(sdinorr);
if(sdinorr=="Fixed Number"){
	$("#div_UK-FCL-00241_0").show();
	//$("UK-FCL-00131_0").val($("#UK-FCL-00241_0").val());
		$("#div_UK-FCL-00119_0").hide(); $("#div_UK-FCL-00120_0").hide();
}else{
	if(sdinorr=="In Range"){
		$("#div_UK-FCL-00119_0").show(); $("#div_UK-FCL-00120_0").show();
				$("#div_UK-FCL-00241_0").hide();
	}else{
		$("#div_UK-FCL-00119_0").hide(); $("#div_UK-FCL-00120_0").hide();$("#div_UK-FCL-00241_0").hide();
	}
}

	$("input[name=UK-FCL-00240_0]").on("change",function(){
		if($(this).val()=="Fixed Number"){
			$("#div_UK-FCL-00241_0").show();
			$("#div_UK-FCL-00119_0").hide();
			$("#UK-FCL-00119_0").val("");
		    $("#div_UK-FCL-00120_0").hide();
		    $("#UK-FCL-00120_0").val("");

		}else{
			if($(this).val()=="In Range"){
				$("#div_UK-FCL-00119_0").show(); $("#div_UK-FCL-00120_0").show();
				$("#div_UK-FCL-00241_0").hide();
				$("#UK-FCL-00241_0").val("");
			}else{
				$("#div_UK-FCL-00119_0").hide(); $("#div_UK-FCL-00120_0").hide();$("#div_UK-FCL-00241_0").hide();
				$("#UK-FCL-00119_0").val("");$("#UK-FCL-00120_0").val("");$("#UK-FCL-00241_0").val("");
			}			
		}		
	});

	$("#UK-FCL-00241_0").blur(function(){
		var pcorpc_chd = $('input[name=UK-FCL-00123_0]:checked').val();
		//alert(pcorpc_chd);
		if(pcorpc_chd=='Public Company'){
			if($(this).val()>=3){
				$("#UK-FCL-00241_0-error").text("");				
			}else{
				$("#UK-FCL-00241_0-error").text("Minimum number to be entered is 03 in case of public company");
				$("#UK-FCL-00241_0").val("");
			}
		}

		if(pcorpc_chd=='Private Company'){
			if($(this).val()>=1){
				$("#UK-FCL-00241_0-error").text("");				
			}else{
				$("#UK-FCL-00241_0-error").text("Minimum number to be entered is 01 in case of Private Company");
				$("#UK-FCL-00241_0").val("");
			}
		}

	});

		$("#UK-FCL-00119_0").blur(function(){
		var pcorpc_chd = $('input[name=UK-FCL-00123_0]:checked').val();
		//alert(pcorpc_chd);
		if(pcorpc_chd=='Public Company'){
			if($(this).val()>=3){
				$("#UK-FCL-00119_0-error").text("");				
			}else{
				$("#UK-FCL-00119_0-error").text("Minimum number to be entered is 03 in case of public company");
				$("#UK-FCL-00119_0").val("");
			}
		}

		if(pcorpc_chd=='Private Company'){
			if($(this).val()>=1){
				$("#UK-FCL-00119_0-error").text("");				
			}else{
				$("#UK-FCL-00119_0-error").text("Minimum number to be entered is 01 in case of Private Company");
				$("#UK-FCL-00119_0").val("");
			}
		}

	});


// form 9 Director detail validation
$("#UK-FCL-00131_0").on("change",function(){
	var min = parseInt($("#UK-FCL-00119_0").val()); 
	var max = parseInt($("#UK-FCL-00120_0").val());
	var cdn = parseInt($(this).val());
if(cdn>0){
	if(cdn<min || cdn>max){
		$(this).val("");
		if ($("#UK-FCL-00131_0-error").length) {
			//$("#UK-FCL-00131_0-error").text('Enter no. within range '+min+' - '+max);
			$("#UK-FCL-00131_0-error").text('Please enter the field according to information filled in form no. 1 above');
		}else{
			//$("#div_UK-FCL-00131_0").find('div').append('<div id="UK-FCL-00131_0-error" class="form-control-feedback">Enter no. within range ' +min+' - '+max+'</div>');
			$("#div_UK-FCL-00131_0").find('div').append('<div id="UK-FCL-00131_0-error" class="form-control-feedback">Please enter the field according to information filled in form no. 1 above</div>');
			
		}    
		
	}else{
		$("#UK-FCL-00131_0-error").text("");
	}
}
	
});

	$("#UK-FCL-00119_0").blur(function(){
		var maxnu = $("#UK-FCL-00120_0").val();
		if(maxnu){
			if(parseInt($(this).val())>=parseInt(maxnu)){
			$("#UK-FCL-00119_0-error").text("Minimum number should be less than Maximum number");
			}else{
				$("#UK-FCL-00119_0-error").text("");
				$("#UK-FCL-00120_0-error").text("");
			}
		}		
	});

	$("#UK-FCL-00120_0").blur(function(){
		var minnu = $("#UK-FCL-00119_0").val();
		if(minnu){
		if(parseInt($(this).val())<=parseInt(minnu)){
			$("#UK-FCL-00120_0-error").text("Maximum number should be greater than Minimum number");
		}else{
			$("#UK-FCL-00120_0-error").text("");
			$("#UK-FCL-00119_0-error").text("");
		}
	}
	});

	$("#div_UK-FCL-00481_0").hide();

	$("input[name=UK-FCL-00480_0]").on("change",function(){
		if($(this).val()=="Yes"){
			$("#div_UK-FCL-00481_0").show();
		}else{
			$("#div_UK-FCL-00481_0").hide();
			$("#UK-FCL-00481_0").val("NA");
		}
	});
	

	/*$("#UK-FCL-00119_0,#UK-FCL-00120_0").blur(function(){
		if($(this).val()>0){
			//$("#UK-FCL-00118_0").prop("disabled",true);
			$("#UK-FCL-00118_0").val("").trigger("change");
			//$("#UK-FCL-00120_0").prop('readonly',false);
		}else{
			
		}
	});*/


	
	
	// address detail validation

$("#UK-FCL-00102_0").bind("keypress",function(){
	var regex=  new RegExp("^[ A-Za-z0-9(),.&:;-]*$"); //;
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       return false
    }
});



$("#UK-FCL-00104_0").bind("keypress",function(){
	var regex=  new RegExp("^[ A-Za-z0-9(),.&:;-]*$"); //;
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        return false;
    }
});

	/*$("#UK-FCL-00127_0").blur(function(){
		$("#pcem").text("");
		if($(this).val()!=''){
			var bb5 = /^B{2}\d{5}$/i;
		var bb5a = bb5.exec($(this).val());
		if(bb5a==null){
			var bb8 = /^B{2}\d{8}$/i;
			var bb8a = bb8.exec($(this).val());
			if(bb8a==null){
				if ($("#pcem").length) {
					$("#pcem").text("Please enter the correct postal code");
    			}else{
    				$("#div_UK-FCL-00127_0").find('div').append('<div style="color:red;" id="pcem">Please enter the correct postal code</div>');
    			}				
				
				$(this).val('');	
			}					
		}else{
			
		}
		}
		
	});*/
	/*var ff00345_0 = $("#UK-FCL-00345_0").val();
	callpostalcode(ff00345_0,1);*/

	$("#UK-FCL-00345_0").on("change",function(){
		callpostalcode($(this).val(),0);
});

	/*$("#UK-FCL-00096_0").on("change",function(){
	if($(this).val()){
				$.ajax({
		            type: "POST",
		            dataType:'html',
		            url: "/backoffice/infowizard/subFormRegistrationCharityBoard/getpostalcode/c_id/" + $(this).val(),
		            beforeSend:function(){		         
    				$("#UK-FCL-00096_0-error").text("Please Wait...");
    			   },
		            success: function(result) {	         		            		
            			$("#UK-FCL-00096_0-error").text("");		         
            		    $("#UK-FCL-00372_0").html(result);	
            	    }
		        });
		}	
});*/

	$("#UK-FCL-00096_0").on('change', function() {
        var countryCode = $(this).val();		
		$("#UK-FCL-00372_0").select2("val","");
		 if(countryCode==829){
	        	$("#UK-FCL-00310_0").val('');
	        	$("#UK-FCL-00310_0").attr('readonly',true);
	        }else{
	        	$("#UK-FCL-00310_0").attr('readonly',false);
	        }
        $.ajax({
            type: "POST",
            url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
            success: function(result) {
                //alert(result);
                $("#UK-FCL-00372_0").html(result);
				
            }
        });
    });




	/*$("#UK-FCL-00349_0").on("change",function(){
	if($(this).val()){
				$.ajax({
		            type: "POST",
		            dataType:'html',
		            url: "/backoffice/infowizardtwo/subFormRegistrationCharityBoard/getpostalcode/p_id/" + $(this).val(),
		            beforeSend:function(){		         
    				$("#UK-FCL-00349_0-error").text("Please Wait...");
    			   },
		            success: function(result) {	         		            		
            			$("#UK-FCL-00349_0-error").text("");		         
            		    $("#UK-FCL-00350_0").html(result);	

            		    var maddsr = $('input[name=UK-FCL-00103_0]:checked').val();
            		    if(maddsr=='Yes'){
            		    	$("#UK-FCL-00350_0").val($("#UK-FCL-00346_0").val()).trigger("change");	
            		    }else{
            		    	
            		    	
            		    }
            	    }
		        });
		}else{
			$("#UK-FCL-00350_0").val("").trigger("change");
			$("#UK-FCL-00350_0").html("");
            	
		}	
});*/

	
$("#UK-FCL-00351_0").on('change', function() {
	
        var countryCode = $(this).val();	
         if(countryCode==829){
	        	$("#UK-FCL-00348_0").val('');
	        	$("#UK-FCL-00348_0").attr('readonly',true);
	        }else{
	        	$("#UK-FCL-00348_0").attr('readonly',false);
	        }	
	if(countryCode){
		$.ajax({
            type: "POST",
            url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
            success: function(result) {
                //alert(result);
                $("#UK-FCL-00349_0").html(result);
			var ff00493_0 = $('input[name=UK-FCL-00493_0]:checked').val();
                if(ff00493_0=='Yes'){
                	$("#UK-FCL-00349_0").val($("#UK-FCL-00345_0").val()).trigger("change");
                }
				
            }
        });
	}else{
        	 $("#UK-FCL-00349_0").html("<option>Please select</option>");
        }
    });
	

// 


	
	$("#UK-FCL-00088_0").on("blur",function(){
		var srn_no = $(this).val();
		getcomapnyname(srn_no);
			 
	});


	// share detail js

	/*var tofshare = $("#UK-FCL-00095_0").val();
	if(tofshare){
		if(tofshare=='Common Shares '){
			$("#div_UK-FCL-00265_0").hide();
			$("#div_UK-FCL-00266_0").hide();
		}else{
			$("#div_UK-FCL-00265_0").show();
			$("#div_UK-FCL-00266_0").show();
		}
	}else{
		$("#div_UK-FCL-00265_0").hide();
		$("#div_UK-FCL-00266_0").hide();
	}*/
	

	var nocos = $("#UK-FCL-00262_0").val();
	if(nocos){
		if(nocos=='01'){

				$("#UK-FCL-00095_0").val("Common Shares ").trigger("change");
			  	$("#UK-FCL-00095_0").prop("disabled", true);
				$("#div_UK-FCL-00265_0").hide();
				$("input[name=UK-FCL-00265_0]").prop('checked', false);
				$("#div_UK-FCL-00266_0").hide();
				$("#UK-FCL-00266_0").val("");
				$("#UK-FCL-00113_0").val("The rights of the holders are equal in all respects as follows:\n(a) the right to vote at any meeting of shareholders;\n(b) the right to receive any dividend declared by the company;\n(c) the right to receive the remaining property of the company on dissolution.");
				$("#UK-FCL-00113_0").attr("readonly",true);
				$("#div_UK-FCL-00288_0").show();
		}else{
			$("#div_UK-FCL-00288_0").hide();
		}
	}else{
		$("#div_UK-FCL-00265_0").hide();	
		$("#div_UK-FCL-00288_0").hide();
	}
	

	

	$("#UK-FCL-00262_0").on("change",function(){
		if($(this).val()){
			if($(this).val()=='01'){
				$("#UK-FCL-00095_0").val("Common Shares ").trigger("change");
				$("#UK-FCL-00095_0").prop("disabled", true);
				$("#div_UK-FCL-00265_0").hide();
				$("input[name=UK-FCL-00265_0]").prop('checked', false);
				$("#div_UK-FCL-00266_0").hide();
				$("#UK-FCL-00266_0").val("");
				$("#UK-FCL-00113_0").val("The rights of the holders are equal in all respects as follows:\n(a) the right to vote at any meeting of shareholders;\n(b) the right to receive any dividend declared by the company;\n(c) the right to receive the remaining property of the company on dissolution.");
				$("#UK-FCL-00113_0").attr("readonly",true);
				$("#div_UK-FCL-00288_0").show();
			}else{
				$("#UK-FCL-00095_0").val("").trigger("change");
				$("#UK-FCL-00288_0").val("");
				$("#div_UK-FCL-00288_0").hide();
				$("#UK-FCL-00113_0").attr("readonly",false);
				$("#UK-FCL-00095_0").prop("disabled", false);
			}
		}else{
				$("#UK-FCL-00095_0").val("").trigger("change");
			    $("#UK-FCL-00288_0").val("");
				$("#div_UK-FCL-00288_0").hide();
				$("#UK-FCL-00113_0").attr("readonly",false);
				$("#UK-FCL-00095_0").prop("disabled", false);			 
		}		
	});

	$("#UK-FCL-00095_0").on("change",function(){
		if($(this).val()){
			if($(this).val()=='Common Shares '){
				$("#div_UK-FCL-00265_0").hide();
				$("#div_UK-FCL-00266_0").hide();
				$("input[name=UK-FCL-00265_0]").prop('checked', false);
				$("#UK-FCL-00266_0").val("");	
				$("#UK-FCL-00113_0").val("");
			}else{
				$("#div_UK-FCL-00265_0").show();
				if($(this).val()=="Preference shares"){
					$("#UK-FCL-00113_0").val("");
				}else{
					$("#UK-FCL-00113_0").val("");
				}
			}
		}else{
			$("#div_UK-FCL-00265_0").hide();
			$("#div_UK-FCL-00266_0").hide();
			$("input[name=UK-FCL-00265_0]").prop('checked', false);
			$("#UK-FCL-00266_0").val("");
			$("#UK-FCL-00113_0").val("");
			 
		}
		
	});


	

	
	var ff00265_0 = $('input[name=UK-FCL-00265_0]:checked').val(); 
	if(ff00265_0 == "Yes"){
		$("#div_UK-FCL-00266_0").show();		   
	}else{		
		$("#div_UK-FCL-00266_0").hide();		   
	}

 $('input[name=UK-FCL-00265_0]').change(function(){	 	
		if($(this).val()=="Yes"){
			$("#div_UK-FCL-00266_0").show();	
		}else{
			$("#div_UK-FCL-00266_0").hide();	    	
	    	$("#UK-FCL-00266_0").val("");
	    }
 	});

	$("#UK-FCL-00135_0").bind("keypress",function(){
	var regex=  new RegExp("^[ A-Za-z0-9(),.&:;-]*$"); //;
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        return false;
    }
});
$("#UK-FCL-00137_0").bind("keypress",function(){
	var regex=  new RegExp("^[ A-Za-z0-9(),.&:;-]*$"); //;
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        return false;
    }
});
$("#UK-FCL-00143_0").bind("keypress",function(){
	var regex=  new RegExp("^[ A-Za-z0-9(),.&:;-]*$"); //;
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        return false;
    }
});


// $("#UK-FCL-00132_0").bind("keypress",function(){
// 	var regex=  new RegExp("^[ A-Za-z]*$"); //;
// 	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
//     if (!regex.test(key)) {
//         return false;
//     }
// });
// $("#UK-FCL-00134_0").bind("keypress",function(){
// 	var regex=  new RegExp("^[ A-Za-z]*$"); //;
// 	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
//     if (!regex.test(key)) {
//         return false;
//     }
// });
// $("#UK-FCL-00133_0").bind("keypress",function(){
// 	var regex=  new RegExp("^[ A-Za-z]*$"); //;
// 	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
//     if (!regex.test(key)) {
//         return false;
//     }
// });

$("#UK-FCL-00140_0").bind("keypress",function(){
	var regex=  new RegExp("^[ A-Za-z]*$"); //;
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        return false;
    }
});
$("#UK-FCL-00141_0").bind("keypress",function(){
	var regex=  new RegExp("^[ A-Za-z]*$"); //;
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        return false;
    }
});
$("#UK-FCL-00142_0").bind("keypress",function(){
	var regex=  new RegExp("^[ A-Za-z]*$"); //;
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        return false;
    }
});

$("#UK-FCL-00241_0, #UK-FCL-00119_0, #UK-FCL-00120_0").bind("keypress",function(){
	var regex=  new RegExp("^[0-9]*$"); //;
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        return false;
    }
});


// Director detail validation 

$("#div_UK-FCL-00133_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox' name='middlenamecheckbox'> I do not have a middle name or middle initial</div>");

$("#UK-FCL-00133_0").blur(function(){
	if($(this).val()){
		$("input[name=middlenamecheckbox]").prop('checked', false);	
	}
});

$("input[name=middlenamecheckbox]").change(function(){
	if($(this).is(':checked')){
		$("#UK-FCL-00133_0").val("");
		$("#UK-FCL-00133_0").attr('readonly',true);		
	}else{
		$("#UK-FCL-00133_0").attr('readonly',false);
	}
});



});	


function getcomapnyname(srn_no){
	if(srn_no!=""){
				$.ajax({
		            type: "POST",
		            dataType:'json',
		            url: "/backoffice/infowizardtwo/subFormIncorporationOfCompany/getCompanyNameBySrnNo/srn_no/" + srn_no +"/subID/<?= isset($_GET['subID']) ? $_GET['subID'] : NULL ?>",
		            beforeSend:function(){
		            	$("#UK-FCL-00088_0-error").text("Please wait...");	    	        	
		            },
		            success: function(result) {		            	
		            	if(result.status==true){
		            		if(result.app_status=='valid'){
		            			$("#UK-FCL-00089_0").val(result.name);
		            			$("#UK-FCL-00088_0-error").html("");
		            			$("#UK-FCL-00089_0-error").html("");	
		            		}else{
		            			$("#UK-FCL-00088_0-error").text(result.msg);			
		            			if ($("#UK-FCL-00089_0-error").length) {
									$("#UK-FCL-00089_0-error").text(errormessages.srn_msg001);
				    			}else{
				    				$("#div_UK-FCL-00089_0").find('div').append('<div  style="color:red;" id="UK-FCL-00089_0-error">'+errormessages.srn_msg001+'<br>'+errormessages.srn_msg002+'</div>');
				    			}    

				    			$("#UK-FCL-00089_0").val("");  
		            		}	            			            	
		            	}else{
		            		if(result.user){
		            			$("#UK-FCL-00088_0-error").text(result.msg);
		            		    $("#UK-FCL-00089_0").val("");	
		            		    $("#UK-FCL-00089_0-error").text("");
		            		}else{
		            			//alert(result.msg);
		            		}		            			            	
		            	}
		             //  console.log(result);
		            }
		        });
		}	
}

function callpostalcode(parish,is_default){
	if(parish){
		$.ajax({
            type: "POST",
            dataType:'html',
            url: "/backoffice/infowizardtwo/subFormRegistrationCharityBoard/getpostalcode/p_id/" + parish,
            beforeSend:function(){		         
			$("#UK-FCL-00345_0-error").text("Please Wait...");
		   },
            success: function(result) {	         		            		
    			$("#UK-FCL-00345_0-error").text("");		         
    		    $("#UK-FCL-00346_0").html(result);	
    	    }
        });

		     
		}	
}

function addmorebtncheckdirector(){
	var nofapp = $("#UK-FCL-00131_0").val();
	 var totalRowCount = 0;          
      totalRowCount =  $("#tbl_1239 td").closest("tr").length;
	if(nofapp<=totalRowCount){
		/*$("#title_UK-FCL-00131_0").append("<b style='color:red;' class='amalgamatingDetail'>Please Add Number of Director as Per Enter 'No. of directors of the company as of this date are' Field.</b>");*/
		var dem = "Please add details of the Director as per the number entered in this field 'No. of directors of the company as of this date are' Field"; 
						if ($("#directorerrormessage").length) {
							$("#directorerrormessage").text(dem);
		    			}else{
		    				$("#title_UK-FCL-00131_0").append('<b style="color:red;" id="directorerrormessage">'+dem+'</b>');
		    			}
			var titleTot = jQuery("#title_UK-FCL-00131_0").offset().top;
			var addHeight = parseInt(titleTot) - 170;
			jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
			e.stop();
			e.preventDefault();
			return false;
	}
	else{
		$("#directorerrormessage").text("");
		return true;	
	}
}

function addmorebtncheckincorporation(){
	var nofapp = $("#UK-FCL-00139_0").val();
	var totalRowCount = 0;          
      totalRowCount =  $("#tbl_188 td").closest("tr").length;
	if(nofapp<=totalRowCount){
		/*$("#title_UK-FCL-00139_0").append("<b style='color:red;' class='amalgamatingDetail'>Please Add Number of Incorporators as Per Enter 'No. of Incorporators' Field.</b>");*/
		var iem = "Please add details of the Incorporators as per the number entered in this field 'No. of Incorporators' "; 
			if ($("#investorerrormessage").length) {
				$("#investorerrormessage").text(iem);
			}else{
				$("#title_UK-FCL-00139_0").append('<b style="color:red;" id="investorerrormessage">'+iem+'</b>');
			}
			var titleTot = jQuery("#title_UK-FCL-00139_0").offset().top;
			var addHeight = parseInt(titleTot) - 170;
			jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
			e.stop();
			e.preventDefault();
			return false;
	}
	else{
		$("#investorerrormessage").text("");
		return true;	
	}
}

function addmorebtnchecksharecapitaldetail(){
	var nofapp = $("#UK-FCL-00262_0").val();
	var totalRowCount = 0;          
      totalRowCount =  $("#tbl_669 td").closest("tr").length;
	if(nofapp<=totalRowCount){
		/*$("#title_UK-FCL-00262_0").append("<b style='color:red;' class='amalgamatingDetail'>Please Add Number of Shares Capital Details as Per Enter 'No. of classes of shares' Field.</b>");*/
		var scdem = "Please add details of the Shares Capital Details as per the number entered in this field 'No. of classes of shares'"; 
						if ($("#scd").length) {
							$("#scd").text(scdem);
		    			}else{
		    				$("#title_UK-FCL-00262_0").append('<b style="color:red;" id="scd">'+scdem+'</b>');
		    			}	
			var titleTot = jQuery("#title_UK-FCL-00262_0").offset().top;
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
 	if(div_id==1239){
		var respon = addmorebtncheckdirector();
		if(respon==false){
			return false;
		}
	}else{
		if(div_id==188){
			var respon = addmorebtncheckincorporation();
			if(respon==false){
				return false;
			}
		}else{
			if(div_id==669){
				var respon = addmorebtnchecksharecapitaldetail();
			if(respon==false){
				return false;
			}
			}
		}
	}

 	$.ajax({
			type: "GET",
			dataType: 'json',
			data: {"button_id": id, "service_id": service_id, "add_more_button_di": div_id},
			url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizardtwo/formFieldMaster/getAddmoreData",
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
						$(".form-control-feedback-addmore").remove();
						if(div_id==1239){
							
							if(formchk_id=='UK-FCL-00133_0'){
										var mnt = $("#UK-FCL-00133_0").val();
										if(mnt){
											var checkfield = true;
										}else{
											var mncb = $('input[name=middlenamecheckbox]:checked').val(); 
											if(mncb){
												var checkfield = true;
											}else{
												var checkfield = false;
											}
										}
									}else{
										var checkfield = true;
									}

								if(formchk_id=='UK-FCL-00132_0' || checkfield==false || formchk_id=='UK-FCL-00134_0' || formchk_id=='UK-FCL-00093_0' || formchk_id=='UK-FCL-00372_0' || formchk_id=='UK-FCL-00096_0' || formchk_id=='UK-FCL-00137_0' || formchk_id=="UK-FCL-00480_0" || formchk_id=="UK-FCL-00481_0"){
									
									var labelData = $("#label_" + formchk_id).text();

									labelData=labelData.replace('('+formchk_id+')',"");
									//alert(formchk_id);
									if(formchk_id=="UK-FCL-00133_0"){
											$("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>Please enter the required information or select the check box</div>");
									}else{
										
											$("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>This field is required</div>");
																			
									}
															
									err = err + 1;
									return false;
									}else{
										$(".form-control-feedback-addmore").remove();						td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' title='"+vall+"'  readonly/></td>";
													fieldsIDArr.push(formchk_id);		
									}	
						}	
						if(div_id==188){
							
								if(formchk_id=='UK-FCL-00140_0' || formchk_id=='UK-FCL-00142_0' || formchk_id=='UK-FCL-00143_0'){
										var labelData = $("#label_" + formchk_id).text();
									labelData=labelData.replace('('+formchk_id+')',"");
									//alert(formchk_id);
									$("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>This field is required</div>");						
									err = err + 1;
									return false;
									}else{
										$(".form-control-feedback-addmore").remove();
										td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' title='"+vall+"'  readonly/></td>";
													fieldsIDArr.push(formchk_id);		
									}	
						}	
						if(div_id==669){
								
								if(formchk_id=='UK-FCL-00095_0' || formchk_id=='UK-FCL-00263_0' || formchk_id=='UK-FCL-00264_0' || formchk_id=='UK-FCL-00113_0'){
										var labelData = $("#label_" + formchk_id).text();
									labelData=labelData.replace('('+formchk_id+')',"");
									//alert(formchk_id);

									$("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>This field is required</div>");						
									err = err + 1;
									return false;
									}else{
										$(".form-control-feedback-addmore").remove();
										td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' title='"+vall+"'  readonly/></td>";
													fieldsIDArr.push(formchk_id);		
									}	
						}			
					}
					else {
						$(".form-control-feedback-addmore").remove();
						//console.log(typeVal);
						td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' title='"+vall+"'  readonly/></td>";
						fieldsIDArr.push(formchk_id);						
					}

				}); 
				if (err == 0) {
					//alert(JSON.stringify(fieldsIDArr));
					if(confirm('Before adding, please check whether the details entered is correct.')) 
					{
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
					$("input[name=middlenamecheckbox]").prop('checked', false);	
					$("#UK-FCL-00133_0").attr('readonly',false);
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

<?php if(isset($_SESSION['RESPONSE']["user_id"])){ ?>
			<script type="text/javascript">
				  $(document).ready(function(){
				var deaultsrn = $("#UK-FCL-00088_0").val();
				if(deaultsrn){
					getcomapnyname(deaultsrn);
				}
				   });
			</script>	
<?php } ?>

<?php if(isset($_SESSION['uid'])){ ?>
  <!--   <script type="text/javascript">
        var mc_id = $("#UK-FCL-00351_0").val();
			if(mc_id){
				$("#UK-FCL-00351_0").val(mc_id).trigger("change");
			}

			//$("#UK-FCL-00350_0").val($("#UK-FCL-00350_0").val());
			
		var f0493_0 = $('input[name=UK-FCL-00493_0]:checked').val();
		if(f0493_0=='Yes'){
			$("#UK-FCL-00350_0").val($("#UK-FCL-00346_0").val());
		}
    </script>  -->  
<?php } ?>