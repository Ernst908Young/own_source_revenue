<script type="text/javascript">
$(document).ready(function(){

		// Interest details
$("#label_UK-FCL-00301_0, #label_UK-FCL-00324_0, #label_UK-FCL-00323_0, #label_UK-FCL-00181_0, #label_UK-FCL-00185_0, #label_UK-FCL-00182_0, #label_UK-FCL-00206_0").find('b').after('<span style="color:red;"> * </span>');

$("<div class='row'><div class='col-lg-12'><p style='font-size:15px;'>Please give details of any applicant, trustee, officer and beneficiary who holds or has held <br>a) a prominent public office, for example, a Head of State, any Judicial Officer, a Permanent Secretary, a Minister or a Chief Executive Officer or director of a state owned enterprise <br>b) a prominent public office in an international organization, for example, director, deputy director, member of the board or an equivalent function.</p></div></div><br>").insertAfter("#hr_UK-FCL-00301_0");

$("#UK-FCL-00187_0").attr('readonly',true);
$("#UK-FCL-00096_0").prop('readonly',true);
$("#UK-FCL-00096_0").val("Barbados");
$("#UK-FCL-00193_0").prop('readonly',true);
$("#UK-FCL-00194_0").prop('readonly',true);



$("#UK-FCL-00187_0").attr("placeholder","Name of the charity");

$("#div_UK-FCL-00187_0").append("<div class='col-md-12 form-group' style='margin-top:10px;'>hereby apply to be incorporated as a Board under the provisions of the Charities Act Cap. 243.</div>");



$("#UK-FCL-00307_0").on("blur",function(){
		var reg_no = $(this).val();
	
		if(reg_no>0){
				$.ajax({
		            type: "POST",
		            dataType:'json',
		            url: "/backoffice/infowizard/subFormRegistrationCharityBoard/getCharityNameByregno/reg_no/" + reg_no,
		            beforeSend:function(){
		            	$("#UK-FCL-00307_0-error").text("Please wait...");	    	        	
		            },
		            success: function(result) {		            	
		            	if(result.status==true){		            		
		            			$("#UK-FCL-00307_0-error").text("");		         
		            		    $("#UK-FCL-00187_0").val(result.cname);		
		            			            			            	
		            	}else{
		            		$("#UK-FCL-00307_0-error").text(result.msg);
		            		$("#UK-FCL-00187_0").val("");		            	
		            	}
		               console.log(result);
		            }
		        });
		}		 
	});

 // BOARD DETAILS validation
document.getElementById("UK-FCL-00189_0").maxLength = "200";

$("#UK-FCL-00189_0").bind("keypress",function(){
	var regex=  new RegExp("^[ A-Za-z0-9(),.&:;-]*$"); //;
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
});

//address validation 
//$("#UK-FCL-00190_0").attr("style","height:185px");

$("#UK-FCL-00094_0").blur(function(){
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
		}else{
			//console.log(bb5a);
		}
		}
		
	});

$("#UK-FCL-00129_0").on("change",function(){
	if($(this).val()){
				$.ajax({
		            type: "POST",
		            dataType:'html',
		            url: "/backoffice/infowizard/subFormRegistrationCharityBoard/getpostalcode/p_id/" + $(this).val(),
		            beforeSend:function(){
		            /*	if ($("#UK-FCL-00129_0-error").length) {
					$("#UK-FCL-00129_0-error").text("Please enter the correct postal code");
    			}else{*/
    				$("#UK-FCL-00129_0-error").text("Please Wait...");
    				//$("#div_UK-FCL-00129_0").find('div').append('<div id="UK-FCL-00129_0-error" class="form-control-feedback">Please Wait...</div>');
    			//}	
		        	        	
		            },
		            success: function(result) {	         		            		
            			$("#UK-FCL-00129_0-error").text("");		         
            		    $("#UK-FCL-00094_0").html(result);	
            		   // alert(result);	            	
		            			              
		            }
		        });
		}	
});

// SOCIETY DETAILS validation
var atasfwtta = $('input[name=UK-FCL-00191_0]:checked').val();
	if(atasfwtta=='Yes'){
		$("#div_UK-FCL-00313_0").show();
	    $("#div_UK-FCL-00193_0").show();
	    $("#div_UK-FCL-00194_0").show();
	    $("#div_UK-FCL-00195_0").show();
	    
	}else{
		$("#div_UK-FCL-00313_0").hide();
	    $("#div_UK-FCL-00193_0").hide();
	    $("#div_UK-FCL-00194_0").hide();
	    $("#div_UK-FCL-00195_0").hide();
	}

 $('input[name=UK-FCL-00191_0]').change(function(){	 	
		if($(this).val()=="Yes"){
			$("#div_UK-FCL-00313_0").show();
	    	$("#div_UK-FCL-00193_0").show();
	    	$("#div_UK-FCL-00194_0").show();
	    	$("#div_UK-FCL-00195_0").show();
		}else{
			$("#div_UK-FCL-00313_0").hide();
	    	$("#div_UK-FCL-00193_0").hide();
	    	$("#div_UK-FCL-00194_0").hide();
	    	$("#div_UK-FCL-00195_0").hide();
	    	$("#UK-FCL-00313_0").val("");
	    	$("#UK-FCL-00193_0").val("");
	    	$("#UK-FCL-00194_0").val("");
	    	$("input[name=UK-FCL-00195_0]").prop('checked', false);	
	    	
		}
 	});


/*var assir = $('input[name=UK-FCL-00195_0]:checked').val();
	if(assir=='Yes'){
		$("#title_UK-FCL-00179_0").show();
		$("#div_UK-FCL-00179_0").show();
		$("#div_UK-FCL-00205_0").show();
		$("#div_UK-FCL-00180_0").show();
		$("#div_UK-FCL-00207_0").show();
			  
	}else{
		$("#title_UK-FCL-00179_0").hide();
		$("#div_UK-FCL-00179_0").hide();
		$("#div_UK-FCL-00205_0").hide();
		$("#div_UK-FCL-00180_0").hide();
		$("#div_UK-FCL-00207_0").hide();	   
	}*/

 /*$('input[name=UK-FCL-00195_0]').change(function(){	 	
		if($(this).val()=="Yes"){
			$("#title_UK-FCL-00179_0").show();	
			$("#div_UK-FCL-00179_0").show();
			$("#div_UK-FCL-00205_0").show();
			$("#div_UK-FCL-00180_0").show();  
			$("#div_UK-FCL-00207_0").show(); 
		}else{
			$("#title_UK-FCL-00179_0").hide();	    	
	    	$("#div_UK-FCL-00179_0").hide();
			$("#div_UK-FCL-00205_0").hide();
			$("#div_UK-FCL-00180_0").hide();
			$("#div_UK-FCL-00207_0").hide();
			$("#div_UK-FCL-00181_0, #div_UK-FCL-00185_0, #div_UK-FCL-00182_0, #div_UK-FCL-00183_0, #div_UK-FCL-00206_0").hide();
			$("#UK-FCL-00181_0, #UK-FCL-00185_0, #UK-FCL-00182_0, #UK-FCL-00183_0, #UK-FCL-00206_0").val("");

			$("#UK-FCL-00179_0").val("").trigger("change");
			$("#UK-FCL-00205_0").val("");
			$("input[name=UK-FCL-00180_0]").prop('checked', false);	    	
		}
 	});*/

/* var wtcaopn = $('input[name=UK-FCL-00180_0]:checked').val(); 
	if(wtcaopn == "Applicable"){
		$("#div_UK-FCL-00181_0").show();
		$("#div_UK-FCL-00185_0").show();	
		$("#div_UK-FCL-00182_0").show();	
		$("#div_UK-FCL-00183_0").show();
		$("#div_UK-FCL-00206_0").show();	   
	}else{		
		$("#div_UK-FCL-00181_0").hide();	
		$("#div_UK-FCL-00185_0").hide();	
		$("#div_UK-FCL-00182_0").hide();	
		$("#div_UK-FCL-00183_0").hide();	
		$("#div_UK-FCL-00206_0").hide();	   
	}*/

/* $('input[name=UK-FCL-00180_0]').change(function(){	 	
		if($(this).val()=="Applicable"){
			$("#div_UK-FCL-00181_0").show();
			$("#div_UK-FCL-00185_0").show();	
			$("#div_UK-FCL-00182_0").show();	
			$("#div_UK-FCL-00183_0").show();
			$("#div_UK-FCL-00206_0").show();    
		}else{
			$("#div_UK-FCL-00181_0").hide();	
			$("#div_UK-FCL-00185_0").hide();	
			$("#div_UK-FCL-00182_0").hide();	
			$("#div_UK-FCL-00183_0").hide();	
			$("#div_UK-FCL-00206_0").hide();	    	
	    	$("#UK-FCL-00181_0").val("");
	    	$("#UK-FCL-00185_0").val("");
	    	$("#UK-FCL-00182_0").val("");
	    	$("#UK-FCL-00183_0").val("");
	    	$("#UK-FCL-00206_0").val("");
	    	
		}
 	});*/



$("#UK-FCL-00183_0").on("change",function(){
	if($("#UK-FCL-00182_0").val() && $("#UK-FCL-00183_0").val()){
		var resul = (compare($("#UK-FCL-00182_0").val(), $("#UK-FCL-00183_0").val()));
		if(resul== 1 || resul==0){
			if ($("#cderr").length) {
					$("#cderr").text("Cessation date is greater then appointment");
    			}else{
    				$("#div_UK-FCL-00183_0").find('div').append('<div style="color:red;" id="cderr">Cessation date is greater then appointment</div>');
    			}	
			$("#UK-FCL-00183_0").val("");			
		}else{
			$("#cderr").text("");
		}
	}	
});

$("#UK-FCL-00182_0").on("change",function(){
	$("#UK-FCL-00183_0").val("");			
});
 


	$("#UK-FCL-00313_0").on("blur",function(){
		var sreg_no = $(this).val();
	
		if(sreg_no>0){
				$.ajax({
		            type: "POST",
		            dataType:'json',
		            url: "/backoffice/infowizard/subFormRegistrationCharityBoard/getSocityNameByregno/reg_no/" + sreg_no,
		            beforeSend:function(){
		            	$("#UK-FCL-00313_0-error").text("Please wait...");	    	        	
		            },
		            success: function(result) {		            	
		            	if(result.status==true){		            		
		            			$("#UK-FCL-00313_0-error").text("");		         
		            		    $("#UK-FCL-00193_0").val(result.sname);	
		            		     $("#UK-FCL-00194_0").val(result.rdate);			
		            			            			            	
		            	}else{
		            		$("#UK-FCL-00313_0-error").text(result.msg);
		            		 $("#UK-FCL-00193_0").val("");	
		            		     $("#UK-FCL-00194_0").val("");		            	
		            	}
		               console.log(result);
		            }
		        });
		}		 
	});

	$("#div_UK-FCL-00105_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox' name='middlenamecheckbox'> I do not have a middle name or middle initial</div>");


$("#UK-FCL-00205_0").bind("keypress",function(){
	var regex=  new RegExp("^[ A-Za-z]*$"); //;
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        return false;
    }
});
$("#UK-FCL-00185_0").bind("keypress",function(){
	var regex=  new RegExp("^[ A-Za-z]*$"); //;
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        return false;
    }
});

$("#UK-FCL-00307_0").bind("keypress",function(){
	var regex=  new RegExp("^[0-9]*$"); //;
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        return false;
    }
});

$("#UK-FCL-00105_0").blur(function(){
	if($(this).val()){
		$("input[name=middlenamecheckbox]").prop('checked', false);	
	}
});

$("input[name=middlenamecheckbox]").change(function(){
	if($(this).is(':checked')){
		$("#UK-FCL-00105_0").val("");
		$("#UK-FCL-00105_0").attr('readonly',true);		
	}else{
		$("#UK-FCL-00105_0").attr('readonly',false);
	}
});

//$("#UK-FCL-00182_0").datepicker({  maxDate: 0 });

});	

function compare(dateTimeA, dateTimeB) {
    var momentA = moment(dateTimeA,"DD/MM/YYYY");
    var momentB = moment(dateTimeB,"DD/MM/YYYY");
    if (momentA > momentB) return 1;
    else if (momentA < momentB) return -1;
    else return 0;
}

function addmoreaction(id,service_id,div_id){
 	
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
						else if ($("input[name='" + formchk_id + "']").attr('type') == 'inputType') {
							vall = $("input[name='" + formchk_id + "']").val();
							typeVal = 'inputType';
							$("input[name='" + formchk_id + "']").addClass('val');
							if ($("input[name='" + formchk_id + "']").hasClass('val')) {
								cls = 'val';
							}							
						}
						else{
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

					if(formchk_id=='UK-FCL-00105_0'){
						var mnt = $("#UK-FCL-00105_0").val();
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

					//alert(formchk_id+' -- '+ cls +' ---- '+vall+ ' from if' );
	if(formchk_id=='UK-FCL-00301_0' || checkfield==false || formchk_id=='UK-FCL-00324_0' || formchk_id=='UK-FCL-00323_0' || formchk_id=='UK-FCL-00181_0' || formchk_id=='UK-FCL-00185_0' || formchk_id=='UK-FCL-00182_0' || formchk_id=='UK-FCL-00206_0'){
						
					

						var labelData = $("#label_" + formchk_id).text();
						labelData=labelData.replace('('+formchk_id+')',"");
						if(formchk_id=="UK-FCL-00105_0"){
											$("#div_"+formchk_id).append("<span style='color:red;padding-left:16px;' class='errorDetail'>Please enter the required information or select the check box</span>");
									}else{
										$("#div_"+formchk_id).append("<span style='color:red;padding-left:16px;' class='errorDetail'>This field is required</span>");
									}

										
						err = err + 1;
						return false;


				}else{
					$(".errorDetail").remove();
					td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
								fieldsIDArr.push(formchk_id);		
				}										
}
					else {
					//	alert(formchk_id+' -- '+ cls +' ---- '+vall);	
						$(".errorDetail").remove();
						//console.log(typeVal);
						td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
						fieldsIDArr.push(formchk_id);						
					}

				}); 
				if (err == 0) {
					//alert(JSON.stringify(fieldsIDArr));
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
					$("#UK-FCL-00105_0").attr('readonly',false);
			
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
