<script type="text/javascript">
$(document).ready(function(){
		$("a.back_btn").css('visibility', 'hidden');
	$("#UK-FCL-00089_0").attr('readonly',true);

$("<div class='row'><div class='col-lg-12 data-para-graph'><p class='data-para-section' style='font-size:15px;'></p></div></div><br>").insertAfter("#add_more_2836");  

	makeparagraph();

	$("#UK-FCL-00403_0").on("blur",function(){
		var reg_no = $(this).val();	
				$.ajax({
		            type: "POST",
		            dataType:'json',
		            url: "/backoffice/infowizardtwo/subFormFormofProxyForm10/getNameByregno/reg_no/" + reg_no,
		            beforeSend:function(){
		            	$("#UK-FCL-00403_0-error").text("Please wait...");	    	        	
		            },
		            success: function(result) {		            	
		            	if(result.status==true){		            		
		            			$("#UK-FCL-00403_0-error").text("");		         
		            		    $("#UK-FCL-00089_0").val(result.cname);		
		            			            			            	
		            	}else{
		            		$("#UK-FCL-00403_0-error").text(result.msg);							
		            		$("#UK-FCL-00089_0").val("");		            	
		            	}
		               console.log(result);
		            }
		        });
				 
	});

	$("#label_UK-FCL-00132_0, #label_UK-FCL-00134_0, #label_UK-FCL-00093_0, #label_UK-FCL-00096_0, #label_UK-FCL-00129_0").find('b').after('<span style="color:red;"> * </span>');

	$('#UK-FCL-00132_0, #UK-FCL-00133_0, #UK-FCL-00134_0, #UK-FCL-00093_0, #UK-FCL-00309_0, #UK-FCL-00310_0, #UK-FCL-00094_0').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });

	$("#div_UK-FCL-00133_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox133' name='middlenamecheckbox133'> I do not have a middle name or middle initial</div>");

$("#UK-FCL-00133_0").blur(function(){
	if($(this).val()){
		$("input[name=middlenamecheckbox133]").prop('checked', false);	
	}
});

$("input[name=middlenamecheckbox133]").change(function(){
	if($(this).is(':checked')){
		$("#UK-FCL-00133_0").val("");
		$("#UK-FCL-00133_0").attr('readonly',true);		
	}else{
		$("#UK-FCL-00133_0").attr('readonly',false);
	}
});

$("#label_UK-FCL-00150_0, #label_UK-FCL-00106_0, #label_UK-FCL-00107_0, #label_UK-FCL-00320_0, #label_UK-FCL-00372_0").find('b').after('<span style="color:red;"> * </span>');

	$('#UK-FCL-00150_0, #UK-FCL-00106_0, #UK-FCL-00107_0, #UK-FCL-00335_0, #UK-FCL-00354_0, #UK-FCL-00356_0, #UK-FCL-00105_0').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });

	$("#div_UK-FCL-00105_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox105' name='middlenamecheckbox105'> I do not have a middle name or middle initial</div>");

$("#UK-FCL-00105_0").blur(function(){
	if($(this).val()){
		$("input[name=middlenamecheckbox105]").prop('checked', false);	
	}
});

$("input[name=middlenamecheckbox105]").change(function(){
	if($(this).is(':checked')){
		$("#UK-FCL-00105_0").val("");
		$("#UK-FCL-00105_0").attr('readonly',true);		
	}else{
		$("#UK-FCL-00105_0").attr('readonly',false);
	}
});

$("#UK-FCL-00096_0").on('change', function() {
        var countryCode = $(this).val();    
		if(countryCode==829){
			$("#UK-FCL-00310_0").val('');
			$("#UK-FCL-00310_0").attr('readonly',true);
		}else{
			$("#UK-FCL-00310_0").attr('readonly',false);
		}    
        $("#UK-FCL-00129_0").select2("val","");
        $.ajax({
            type: "POST",
            url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
            success: function(result) {
               $("#UK-FCL-00129_0").html(result);
            
            }
        });
    });


    $("#UK-FCL-00320_0").on('change', function() {
        var countryCode = $(this).val();   
		if(countryCode==829){
                $("#UK-FCL-00354_0").val('');
                $("#UK-FCL-00354_0").attr('readonly',true);
            }else{
                $("#UK-FCL-00354_0").attr('readonly',false);
            }     
        $("#UK-FCL-00372_0").select2("val","");
        $.ajax({
            type: "POST",
            url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
            success: function(result) {
               $("#UK-FCL-00372_0").html(result);
            
            }
        });
    });

});

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
						if(div_id==2837){

							if(formchk_id=='UK-FCL-00133_0'){
										var mnt = $("#UK-FCL-00133_0").val();
										if(mnt){
											var checkfield = true;
										}else{
											var mncb = $('input[name=middlenamecheckbox133]:checked').val(); 
											if(mncb){
												var checkfield = true;
											}else{
												var checkfield = false;
											}
										}
									}else{
										var checkfield = true;
									}

								if(formchk_id=='UK-FCL-00132_0' || checkfield==false || formchk_id=='UK-FCL-00134_0' || formchk_id=='UK-FCL-00093_0' || formchk_id=='UK-FCL-00096_0' || formchk_id=='UK-FCL-00129_0'){
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
										$(".form-control-feedback-addmore").remove();
										
										td_ += '<td><input type="text" name="' + formchk_id + '[]" value="' + vall + '" class="form-control" title="'+vall+'"  readonly/></td>';
													fieldsIDArr.push(formchk_id);		
									}	
						}	
						if(div_id==2836){

							if(formchk_id=='UK-FCL-00105_0'){
										var mnt = $("#UK-FCL-00105_0").val();
										if(mnt){
											var checkfield = true;
										}else{
											var mncb = $('input[name=middlenamecheckbox105]:checked').val(); 
											if(mncb){
												var checkfield = true;
											}else{
												var checkfield = false;
											}
										}
									}else{
										var checkfield = true;
									}

								if(formchk_id=='UK-FCL-00150_0' || checkfield==false || formchk_id=='UK-FCL-00106_0' || formchk_id=='UK-FCL-00107_0' || formchk_id=='UK-FCL-00320_0' || formchk_id=='UK-FCL-00372_0'){
										var labelData = $("#label_" + formchk_id).text();
									labelData=labelData.replace('('+formchk_id+')',"");
									//alert(formchk_id);
									if(formchk_id=="UK-FCL-00105_0"){
											$("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>Please enter the required information or select the check box</div>");
									}else{
										$("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>This field is required</div>");
									}
															
									err = err + 1;
									return false;
									}else{
										$(".errorDetail").remove();									
										td_ += '<td><input type="text" name="' + formchk_id + '[]" value="' + vall + '" class="form-control" title="'+vall+'"  readonly/></td>';
													fieldsIDArr.push(formchk_id);		
									}	
						}
									
					}
					else {
						$(".form-control-feedback-addmore").remove();
						//console.log(typeVal);
						td_ += '<td><input type="text" name="' + formchk_id + '[]" value="' + vall + '" class="form-control" readonly/></td>';
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
					$("input[name=middlenamecheckbox133]").prop('checked', false);
					$("input[name=middlenamecheckbox105]").prop('checked', false);	
					$("#UK-FCL-00133_0, #UK-FCL-00105_0").attr('readonly',false);

					makeparagraph();
				}
			} else
					return false;
                                    
				$('.del_1').on('click', function () {					
					$(this).closest('tr').remove();
					var uio= $(this).attr('pi');
					if($("."+uio).length<2){
						$("#"+uio).css('display','none');
					}
					makeparagraph();
                                        
				});
			} // success function close here
		}); //ajax end here
 }

/* function makeparagraph(){
 	 shtr =  $("#tbl_2837 td").closest("tr").length;
 	 pdtr =  $("#tbl_2836 td").closest("tr").length;  

 	 if(shtr>0 && pdtr>0){
 	 	if(shtr==1){
 	 		var s1 = 'I';
 	 		var s2 = 'shareholder in the above Company appoints';
 	 		var s3 = 'my';
 	 	}else{
 	 		var s1 = 'We';
 	 		var s2 = 'shareholders in the above Company appoint';
 	 		var s3 = 'our';
 	 	}



 	 	$(".data-para-section").html(s1+' '+s2+' '+s3);
 	 }else{
 	 	$(".data-para-section").html('');
 	 } 	
 }*/


 function makeparagraph(){
 	 shtr =  $("#tbl_2837 td").closest("tr").length;
 	 pdtr =  $("#tbl_2836 td").closest("tr").length;  

 	  if(shtr>0 && pdtr>0){
 	 	if(shtr==1){
 	 		var s1 = 'I';
 	 		var s2 = 'shareholder in the above Company appoints';
 	 		var s3 = 'my';
 	 	}else{
 	 		var s1 = 'We';
 	 		var s2 = 'shareholders in the above Company appoint';
 	 		var s3 = 'our';
 	 	}
 	 	var shMytext = '';
 	 	 $("table#tbl_2837 tr:not(:first)").each(function() {           
              
                fn = $(this).find('input[name="UK-FCL-00132_0[]"]').val();
                mn = $(this).find('input[name="UK-FCL-00133_0[]"]').val();
                sn = $(this).find('input[name="UK-FCL-00134_0[]"]').val();
                add1 = $(this).find('input[name="UK-FCL-00093_0[]"]').val();
                add2 = $(this).find('input[name="UK-FCL-00309_0[]"]').val();
                country = $(this).find('input[name="UK-FCL-00096_0[]"]').val();
                state = $(this).find('input[name="UK-FCL-00129_0[]"]').val();
                city = $(this).find('input[name="UK-FCL-00310_0[]"]').val();
                pcode = $(this).find('input[name="UK-FCL-00094_0[]"]').val();

                finalstring = fn+' '+mn+' '+sn+' of '+add1+' '+add2+'  '+state+' '+city+'  ' +pcode+ ' '+country+'';
                if(shMytext==''){
                	isand = '';
                }else{
                	isand = ' and ';
                }
               shMytext = shMytext+isand+finalstring;
            
        });

 	 	 var pdMytext = '';
 	 	 $("table#tbl_2836 tr:not(:first)").each(function() {           
              
                fn = $(this).find('input[name="UK-FCL-00150_0[]"]').val();
                mn = $(this).find('input[name="UK-FCL-00105_0[]"]').val();
                sn = $(this).find('input[name="UK-FCL-00106_0[]"]').val();
                add1 = $(this).find('input[name="UK-FCL-00107_0[]"]').val();
                add2 = $(this).find('input[name="UK-FCL-00335_0[]"]').val();
                country = $(this).find('input[name="UK-FCL-00320_0[]"]').val();
                state = $(this).find('input[name="UK-FCL-00372_0[]"]').val();
                city = $(this).find('input[name="UK-FCL-00354_0[]"]').val();
                pcode = $(this).find('input[name="UK-FCL-00356_0[]"]').val();

                finalstring = fn+' '+mn+' '+sn+' of '+add1+' '+add2+'  '+state+' '+city+'  '+pcode+ ' '+country+'';
                if(pdMytext==''){
                	isand = '';
                }else{
                	isand = ' & ';
                }
               pdMytext = pdMytext+isand+finalstring;
            
        });

 	 	$(".data-para-section").html(s1+' '+shMytext+' '+s2+' '+pdMytext+' to be '+s3+' proxy at the above meeting and any adjournment thereof.');
 	 }else{
 	 	$(".data-para-section").html('');
 	 } 	      
  
 }
</script>