

<script type="text/javascript">
$(document).ready(function(){
//$("#div_UK-FCL-00105_0").append("<div class='form-control-feedback-addmore' id='00105midlename'></div>");

$('#UK-FCL-00340_0,#UK-FCL-00341_0,#UK-FCL-00344_0,#UK-FCL-00346_0').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });
$('#UK-FCL-00352_0,#UK-FCL-00353_0,#UK-FCL-00354_0').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });

 $("#UK-FCL-00354_0").attr('readonly',true);

$('#UK-FCL-00132_0,#UK-FCL-00133_0,#UK-FCL-00134_0, #UK-FCL-00093_0, #UK-FCL-00309_0, #UK-FCL-00310_0, #UK-FCL-00094_0').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });

$('#UK-FCL-00150_0,#UK-FCL-00105_0,#UK-FCL-00106_0, #UK-FCL-00107_0, #UK-FCL-00335_0, #UK-FCL-00399_0, #UK-FCL-00401_0').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });

	$("#UK-FCL-00211_0").attr('readonly',true);



		// share capital details
$("#label_UK-FCL-00248_0, #label_UK-FCL-00249_0, #label_UK-FCL-00250_0, #label_UK-FCL-00256_0, #label_UK-FCL-00257_0, #label_UK-FCL-00258_0, #label_UK-FCL-00259_0").find('b').after('<span style="color:red;"> * </span>');

	// Director details
$("#label_UK-FCL-00132_0, #label_UK-FCL-00134_0, #label_UK-FCL-00093_0,#label_UK-FCL-00372_0,  #label_UK-FCL-00096_0, #label_UK-FCL-00137_0,  #label_UK-FCL-00496_0").find('b').after('<span style="color:red;"> * </span>');

$("#div_UK-FCL-00495_0").find("label > b").after('<span style="color:red;"> * </span>');
$("#div_UK-FCL-00496_0").hide();

 $('input[name=UK-FCL-00495_0]').change(function(){	 
 	if($(this).val()=='Yes'){
 		$("#div_UK-FCL-00496_0").show();
 	}else{
 		$("#div_UK-FCL-00496_0").hide();
 	}
 });

	
	
	$("#UK-FCL-00331_0").on("blur",function(){
		var srn_no = $(this).val();
		getcomapnyname(srn_no);
			 
	});

	
// postal code

	/*$("#UK-FCL-00094_0").blur(function(){
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
    				$("#div_UK-FCL-00094_0").find('div').append('<div style="color:red;" id="pcem">Please enter the correct postal code</div>');
    			}				
				$(this).val('');	
			}					
		}
	 }
		
	});*/

// address detail validation
/*$("<div class='row'><div class='col-lg-12'><strong>Address of Registered Office or Head Office</strong></div></div><br>").insertAfter("#hr_UK-FCL-00340_0");

$("<div class='row' id='pohl'><div class='col-lg-12'><strong>The Address of the Principal Office in Barbados</strong></div></div><br>").insertAfter("#div_UK-FCL-00213_0");*/


$("#UK-FCL-00347_0").on('change', function() {
        var countryCode = $(this).val();		
		$("#UK-FCL-00385_0").select2("val","");
        $.ajax({
            type: "POST",
            url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
            success: function(result) {
                //alert(result);
                $("#UK-FCL-00385_0").html(result);
			
            }
        });
    });


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

	
	var wtchpib = $('input[name=UK-FCL-00213_0]:checked').val();
	if(wtchpib=='Yes'){
		$("#div_UK-FCL-00352_0").show();
	    $("#div_UK-FCL-00353_0").show();
	    $("#div_UK-FCL-00354_0").show();
	    $("#div_UK-FCL-00355_0").show();
	    $("#div_UK-FCL-00356_0").show();
	    $("#div_UK-FCL-00357_0").show();
	    $("#pohl").show();
	    
	}else{
		$("#div_UK-FCL-00352_0").hide();
	    $("#div_UK-FCL-00353_0").hide();
	    $("#div_UK-FCL-00354_0").hide();
	    $("#div_UK-FCL-00355_0").hide();
	    $("#div_UK-FCL-00356_0").hide();
	    $("#div_UK-FCL-00357_0").hide();
	     $("#pohl").hide();
	}

	 $('input[name=UK-FCL-00213_0]').change(function(){	 
	// alert($(this).val());	
		if($(this).val()=="Yes"){
			 $("#pohl").show();
			$("#div_UK-FCL-00352_0").show();
		    $("#div_UK-FCL-00353_0").show();
		    $("#div_UK-FCL-00354_0").show();
		    $("#div_UK-FCL-00355_0").show();
		    $("#div_UK-FCL-00356_0").show();
		    $("#div_UK-FCL-00357_0").show();
		}else{
			 $("#pohl").hide();
			$("#div_UK-FCL-00352_0").hide();
		    $("#div_UK-FCL-00353_0").hide();
		    $("#div_UK-FCL-00354_0").hide();
		    $("#div_UK-FCL-00355_0").hide();
		    $("#div_UK-FCL-00356_0").hide();
		    $("#div_UK-FCL-00357_0").hide();
	    	$("#div_UK-FCL-00352_0").val("");
		    $("#div_UK-FCL-00353_0").val("");
		    $("#div_UK-FCL-00354_0").val("");
		    $("#div_UK-FCL-00355_0").val("").trigger("change");
		    $("#div_UK-FCL-00356_0").val("").trigger("change");		    
	      	
		}
 	});

	/* $("#UK-FCL-00215_0").blur(function(){
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
    				$("#div_UK-FCL-00215_0").find('div').append('<div style="color:red;" id="pcem">Please enter the correct postal code</div>');
    			}				
				$(this).val('');	
			}					
		}
	 }
	});*/

$("#UK-FCL-00345_0").on("change",function(){
	if($(this).val()){
				$.ajax({
		            type: "POST",
		            dataType:'html',
		            url: "/backoffice/infowizardtwo/subFormRegistrationCharityBoard/getpostalcode/p_id/" + $(this).val(),
		            beforeSend:function(){
		        		$("#UK-FCL-00345_0-error").text("Please Wait...");
		        		$("#UK-FCL-00346_0").html("");
    				        },
		            success: function(result) {	         		            		
            			$("#UK-FCL-00345_0-error").text("");		         
            		    $("#UK-FCL-00346_0").html(result);	
                    }
		        });
		}	
});



$("#UK-FCL-00355_0").on("change",function(){
	if($(this).val()){
				$.ajax({
		            type: "POST",
		            dataType:'html',
		            url: "/backoffice/infowizardtwo/subFormRegistrationCharityBoard/getpostalcode/p_id/" + $(this).val(),
		            beforeSend:function(){
		        		$("#UK-FCL-00355_0-error").text("Please Wait...");
		        		$("#UK-FCL-00356_0").html("");
    				        },
		            success: function(result) {	         		            		
            			$("#UK-FCL-00355_0-error").text("");		         
            		    $("#UK-FCL-00356_0").html(result);	
                    }
		        });
		}	
});

    $("#UK-FCL-00357_0").attr('readonly',true);
    $("#UK-FCL-00357_0").val("BARBADOS");


    $("#UK-FCL-00217_0, #UK-FCL-00219_0, #UK-FCL-00221_0").bind("keypress",function(){
	var regex=  new RegExp("^[ A-Za-z0-9(),.&:;-]*$"); //;
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
	    if (!regex.test(key)) {
	        event.preventDefault();
	        return false;
	    }
	});	 

	// business detail validation 
	 
	$("#UK-FCL-00223_0").bind("keypress",function(){
	var regex=  new RegExp("^[ A-Za-z0-9(),.&:;-]*$"); //;
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
	    if (!regex.test(key)) {
	        event.preventDefault();
	        return false;
	    }
	});	 
	// DIRECTORS DETAILS

	$("#UK-FCL-00254_0, #UK-FCL-00331_0").bind("keypress",function(){
	var regex=  new RegExp("^[0-9]*$"); //;
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
	    if (!regex.test(key)) {
	        event.preventDefault();
	        return false;
	    }
	});	

 $("#UK-FCL-00254_0").blur(function(){ 	
 	if($(this).val()){
 		if($(this).val()>=2){
 			$("#UK-FCL-00254_0-error").text("");
 		}else{ 			
 			$("#UK-FCL-00254_0-error").text("The number of directors is at least 2 or more");
 			$("#UK-FCL-00254_0").val("");
 		}
 	}else{
 		$("#UK-FCL-00254_0").val("");
 		$("#UK-FCL-00254_0-error").text("");
 	}
 });

 $("#UK-FCL-00132_0, #UK-FCL-00150_0").bind("keypress",function(){
	var regex=  new RegExp("^[ A-Za-z]*$"); //;
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        return false;
    }
});
$("#UK-FCL-00134_0, #UK-FCL-00105_0").bind("keypress",function(){
	var regex=  new RegExp("^[ A-Za-z]*$"); //;
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        return false;
    }
});
$("#UK-FCL-00133_0, #UK-FCL-00106_0").bind("keypress",function(){
	var regex=  new RegExp("^[ A-Za-z]*$"); //;
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        return false;
    }
});

//director details
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

// end director detail

$("<div class='row'><div class='col-lg-12'> <div style='text-align: justify;  text-justify: inter-word; margin-bottom:10px;'>Know all men by these presents that the said external company hereby appoints the above mentioned attorney as its true and lawful attorney, to act as such, and as such to sue and be sued, plead and be impleaded in any Court in Barbados, and generally on behalf of the Company within Barbados to accept service of process and to receive all lawful notices and, for the purposes of the Company to do all the acts and to execute all deeds and other instruments relating to the matters within the scope of this power of attorney. It is hereby declared that service of process in respect of suits and proceedings by or against the Company and of lawful notices on the attorney will be binding on the Company for all purposes. Where more than one person is hereby appointed attorney, any one of them, without the others, may act as true and lawful Attorney of the Company. This appointment revokes all previous appointments in so far as such appointment relates to the scope of the powers prescribed by this power.</div></div></div><br>").insertBefore("#div_UK-FCL-00364_0");

/*$("#div_UK-FCL-00364_0").append("<div class='col-md-12 form-group' style='margin-top:10px;'> </div>");*/


//Attorney  details
$("#div_UK-FCL-00105_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox_a' name='middlenamecheckbox_a'> I do not have a middle name or middle initial</div>");

$("#UK-FCL-00105_0").blur(function(){
	if($(this).val()){
		$("input[name=middlenamecheckbox_a]").prop('checked', false);	
	}
});

$("input[name=middlenamecheckbox_a]").change(function(){
	if($(this).is(':checked')){
		$("#UK-FCL-00105_0").val("");
		$("#UK-FCL-00105_0").attr('readonly',true);		
	}else{
		$("#UK-FCL-00105_0").attr('readonly',false);
	}
});



$("#UK-FCL-00402_0").on('change', function() {
        var countryCode = $(this).val();		
		$("#UK-FCL-00400_0").select2("val","");
		 if(countryCode==829){
	        	$("#UK-FCL-00399_0").val('');
	        	$("#UK-FCL-00399_0").attr('readonly',true);
	        }else{
	        	$("#UK-FCL-00399_0").attr('readonly',false);
	        }
        $.ajax({
            type: "POST",
            url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
            success: function(result) {
                //alert(result);
                $("#UK-FCL-00400_0").html(result);
				
            }
        });
    });



var bdatev = $('input[name=UK-FCL-00366_0]:checked').val();
	if(bdatev=='Select Date'){
		$("#div_UK-FCL-00253_0").show();    
	}else{
		$("#div_UK-FCL-00253_0").hide();	   
	}

	 $('input[name=UK-FCL-00366_0]').change(function(){	 
		if($(this).val()=="Select Date"){
			 $("#div_UK-FCL-00253_0").show();    
		}else{
			
			$("#div_UK-FCL-00253_0").hide();		   
	    	$("#UK-FCL-00253_0").val("");   	    
	      	
		}
 	});


});
	
function getcomapnyname(srn_no){
		if(srn_no!=""){
				$.ajax({
		            type: "POST",
		            dataType:'json',
		            url: "/backoffice/infowizardtwo/subFormRegistrationofExternalCompanies/getCompanyNameBySrnNo/srn_no/" + srn_no+"/subID/<?= isset($_GET['subID']) ? $_GET['subID'] : NULL ?>",
		            beforeSend:function(){
		            	$("#UK-FCL-00331_0-error").text("Please wait...");	    	        	
		            },
		            success: function(result) {		            	
		            	if(result.status==true){
		            		if(result.app_status=='valid'){
		            			$("#UK-FCL-00211_0").val(result.name);
		            			$("#UK-FCL-00331_0-error").html("");
		            			//$("#UK-FCL-00211_0-error").html("");	
		            		}else{
		            			$("#UK-FCL-00331_0-error").text(result.msg);
		            			//$("#UK-FCL-00211_0-error").text(result.msg);			
		            			/*if ($("#UK-FCL-00211_0-error").length) {
									$("#UK-FCL-00211_0-error").text(errormessages.srn_msg001);
				    			}else{
				    				$("#div_UK-FCL-00211_0").find('div').append('<div  style="color:red;" id="UK-FCL-00211_0-error">'+errormessages.srn_msg001+'<br>'+errormessages.srn_msg002+'</div>');
				    			} */   
				    			$("#UK-FCL-00211_0").val("");  
		            		}	            			            	
		            	}else{
		            		if(result.user){
		            			$("#UK-FCL-00331_0-error").text(result.msg);
		            		    $("#UK-FCL-00211_0").val("");	
		            		   // $("#UK-FCL-00211_0-error").text("");
		            		}else{
		            			//alert(result.msg);
		            		}		            			            	
		            	}
		             //  console.log(result);
		            }
		        });
		}	
}

function addmorebtncheckdirector(){
	var nofapp = $("#UK-FCL-00254_0").val();
	 var totalRowCount = 0;          
      totalRowCount =  $("#tbl_1254 td").closest("tr").length;
	if(nofapp<=totalRowCount){
		//$("#title_UK-FCL-00254_0").append("<b style='color:red;' class='amalgamatingDetail'>Please Add Number of Director as Per Enter 'No. of Directors in the company' Field.</b>");
		var dem = "Please add details of the Director as per the number entered in this field 'No. of Directors in the company'"; 
						if ($("#directorerrormessage").length) {
							$("#directorerrormessage").text(dem);
		    			}else{
		    				$("#title_UK-FCL-00254_0").append('<b style="color:red;" id="directorerrormessage">'+dem+'</b>');
		    			}	
			var titleTot = jQuery("#title_UK-FCL-00254_0").offset().top;
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

   // Add more button code

function addmoreaction(id,service_id,div_id){
		if(div_id==1254){
		var respon = addmorebtncheckdirector();
		if(respon==false){
			return false;
		}
	}
 	//alert(div_id);
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
				//alert(JSON.stringify(data));
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
						var getSelectedValue = document.querySelector( 'input[name="'+formchk_id+'"]:checked');
							if(getSelectedValue!= null){
								vall = getSelectedValue.value
							}else{
								vall = 'undefined';
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
						//alert(formchk_id+' -- '+ cls +' ---- '+vall+ ' from if' );
						if(div_id==641){

							var labelData = $("#label_" + formchk_id).text();
							labelData=labelData.replace('('+formchk_id+')',"");
							//alert(formchk_id);
							$("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>This field is required</div>");		
							err = err + 1;
							return false;							
						}else{

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

							if(formchk_id=='UK-FCL-00132_0' || checkfield==false || formchk_id=='UK-FCL-00134_0' || formchk_id=='UK-FCL-00093_0' || formchk_id=='UK-FCL-00372_0' || formchk_id=='UK-FCL-00096_0' || formchk_id=='UK-FCL-00137_0'){	
								var labelData = $("#label_" + formchk_id).text();
							labelData=labelData.replace('('+formchk_id+')',"");
							
							if(formchk_id=="UK-FCL-00133_0"){
											$("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>Please enter the required information or select the check box</div>");
									}else{
										$("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>This field is required</div>");
									}

												
							err = err + 1;
							return false;
							}else{
								$(".errorDetail").remove();
								td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' title='"+vall+"' readonly/></td>";
											fieldsIDArr.push(formchk_id);		
							}
						}		
						
																
					}
					else {
					//	alert(formchk_id+' -- '+ cls +' ---- '+vall);	
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
						$("#div_UK-FCL-00496_0").hide();
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

	if ($("#scdadi").length) {
		/*$("#scdadi").text("In case additional details are to be provided, then please attached a schedule to the form.");*/
	}else{
		$("#add_more_641").find('table').append('<tr  style="color:red;" id="scdadi"><td colspan="8">In case additional details are to be provided, then please attached a schedule to the form</td></tr>');
	} 
 }
</script>

<?php if(isset($_SESSION['RESPONSE']["user_id"])){ ?>
            <script type="text/javascript">
            	 $(document).ready(function(){
               var deaultsrn = $("#UK-FCL-00331_0").val();
				if(deaultsrn){
					getcomapnyname(deaultsrn);
				}
				 });	
            </script>   
<?php if(isset($_GET['subID'])){ ?>
	 <script type="text/javascript">
            	$(document).ready(function(){
                  var ff466_0 = $("#UK-FCL-00105_0").val();
               
                    if(ff466_0==''){
                        $("input[name=middlenamecheckbox_a]").prop('checked', true);
                    }else{
                        $("input[name=middlenamecheckbox_a]").prop('checked', false);
                    }
                    
                     });
            </script> 
	<?php	}
 } ?>

<?php if(isset($_SESSION['uid'])){ ?>
            <script type="text/javascript">
            	 $(document).ready(function(){
                 var ff466_0 = $("#UK-FCL-00105_0").val();
               
                    if(ff466_0==''){
                        $("input[name=middlenamecheckbox_a]").prop('checked', true);
                    }else{
                        $("input[name=middlenamecheckbox_a]").prop('checked', false);
                    }
                     $("input[name=middlenamecheckbox_a]").prop('disabled', true);
                      });	
            </script>   
<?php } ?>