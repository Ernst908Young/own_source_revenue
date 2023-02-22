<script>
    $(document).ready(function(){
$("#UK-FCL-00320_0").val("Barbados")
$("#UK-FCL-00320_0").attr("disabled","disabled")
$("#UK-FCL-00079_0").val("Barbados")
$("#UK-FCL-00079_0").attr("disabled","disabled")
$("#UK-FCL-00403_0-error").addClass("star")




		 $("#div_UK-FCL-00064_0").find("label").append('<span style="color:red;"> *</span>')
		 $("#divUK-FCL-00065_0").find("label").append('<span style="color:red;"> *</span>')
		 $("#div_UK-FCL-00066_0").find("label").append('<span style="color:red;"> *</span>')
		 $("#div_UK-FCL-00302_0").find("label").append('<span style="color:red;"> *</span>')
		 $("#div_UK-FCL-00319_0").find("label").append('<span style="color:red;"> *</span>')
		 $("#div_UK-FCL-00079_0").find("label").append('<span style="color:red;"> *</span>')
		 $("#div_UK-FCL-00304_0").find("label").append('<span style="color:red;"> *</span>')

		 $("#div_UK-FCL-00315_0").find("label").append('<span style="color:red;"> *</span>')
		 $("#div_UK-FCL-00316_0").find("label").append('<span style="color:red;"> *</span>')
		 $("#div_UK-FCL-00317_0").find("label").append('<span style="color:red;"> *</span>')
		 $("#div_UK-FCL-00318_0").find("label").append('<span style="color:red;"> *</span>')
		 $("#div_UK-FCL-00303_0").find("label").append('<span style="color:red;"> *</span>')
		 $("#div_UK-FCL-00320_0").find("label").append('<span style="color:red;"> *</span>')


        
 
var individualmiddlename=1
var cessationmiddlename=1



$("#div_UK-FCL-00065_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox'  name='middlenamecheckbox'> I do not have a middle name or middle initial</div>");
	$("#UK-FCL-00065_0").blur(function(){
	if($(this).val()){
		$("input[name=middlenamecheckbox]").prop('checked', false);	
	}
});
$("input[name=middlenamecheckbox]").change(function(){
	if($(this).is(':checked')){
		$("#UK-FCL-00065_0").val("");
		$("#UK-FCL-00065_0").attr('readonly',true);	
        individualmiddlename=0	
       
	}else{
		$("#UK-FCL-00065_0").attr('readonly',false);
        individualmiddlename=1
        
	}
});
$("#div_UK-FCL-00316_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox'  name='middlenamecheckbox'> I do not have a middle name or middle initial</div>");
	$("#UK-FCL-00316_0").blur(function(){
	if($(this).val()){
		$("input[name=middlenamecheckbox]").prop('checked', false);	
	}
});
$("input[name=middlenamecheckbox]").change(function(){
	if($(this).is(':checked')){
		$("#UK-FCL-00316_0").val("");
		$("#UK-FCL-00316_0").attr('readonly',true);	
        cessationmiddlename=0	
	}else{
		$("#UK-FCL-00316_0").attr('readonly',false);
        cessationmiddlename=1
	}
});



    })

    function addmoreaction(id,service_id,div_id){
 	if(div_id==1610){
		latestdate.call({"id":"UK-FCL-00302_0"})
		
		if(parseInt($("#UK-FCL-00063_0").val()) == parseInt($("[name='UK-FCL-00064_0[]']").length))
						{
							$(".errorDetail").remove()
							$(".trustee").remove()
	                 	   $(".banker").remove()
							$("#UK-FCL-00146_0").parent().parent().append("<p class='trustee' style='color:red'>No more of trustee allowed  </p>")
							
							e.stop();
							e.preventDefault();
							return false
						}	 
                        					
						
	}else{
		if(div_id==904){
			latestdate.call({"id":"UK-FCL-00318_0"})

			if(parseInt($("#UK-FCL-00300_0").val()) == parseInt($("[name='UK-FCL-00064_0[]']").length))
						{
							$(".errorDetail").remove()
							$(".trustee").remove()
		                    $(".banker").remove()
							$("#UK-FCL-00167_0").parent().parent().append("<p class='banker' style='color:red'>No more of bannker allowed  </p>")
							$(".trustee").hide()
							e.stop();
							e.preventDefault();
							return false
						}
		}
		
			
		}
		$(".trustee").remove()
		$(".banker").remove()
	
	
						
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
							vall = $("input:radio[name='" + formchk_id + "']:checked").val();
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
						if(div_id==1610){
							$("#UK-FCL-00320_0").val("Barbados")

                              $("#UK-FCL-00079_0").val("Barbados")
				               
							if(individualmiddlename ==1)
									{
										
										
										if(formchk_id=='UK-FCL-00064_0' ||formchk_id=='UK-FCL-00065_0'||formchk_id=='UK-FCL-00066_0'|| formchk_id=='UK-FCL-00304_0' ||formchk_id=='UK-FCL-00082_0'||formchk_id=='UK-FCL-00079_0'){
									
									var labelData = $("#label_" + formchk_id).text();
								labelData=labelData.replace('('+formchk_id+')',"");
								//alert(formchk_id);
								$(".errorDetail").remove()
								$("#div_"+formchk_id).append("<span style='color:red;padding-left:16px;' class='errorDetail'>Please fill the required field: "+$.trim(labelData)+"</span>");						
								err = err + 1;
								return false;
								}else{
									$(".errorDetail").remove();
									td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
												fieldsIDArr.push(formchk_id);		
								}	
									}
									else{
										
								if(formchk_id=='UK-FCL-00064_0' || formchk_id=='UK-FCL-00066_0'|| formchk_id=='UK-FCL-00304_0' ||formchk_id=='UK-FCL-00082_0'||formchk_id=='UK-FCL-00079_0' ){
									
										var labelData = $("#label_" + formchk_id).text();
									labelData=labelData.replace('('+formchk_id+')',"");
									//alert(formchk_id);
									$(".errorDetail").remove()
									$("#div_"+formchk_id).append("<span style='color:red;padding-left:16px;' class='errorDetail'>Please fill the required field: "+$.trim(labelData)+"</span>");						
									err = err + 1;
									return false;
									}else{
										$(".errorDetail").remove();
										td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
													fieldsIDArr.push(formchk_id);		
									}	
								}
						}	
						if(div_id==904){
							$("#UK-FCL-00320_0").val("Barbados")

                              $("#UK-FCL-00079_0").val("Barbados")
                            if(cessationmiddlename ==1)
									{
										
										if(formchk_id=='UK-FCL-00315_0' ||formchk_id=='UK-FCL-00316_0'||formchk_id=='UK-FCL-00317_0'|| formchk_id=='UK-FCL-00303_0' ){
									
									var labelData = $("#label_" + formchk_id).text();
								labelData=labelData.replace('('+formchk_id+')',"");
								//alert(formchk_id);
								$(".errorDetail").remove()
								$("#div_"+formchk_id).append("<span style='color:red;padding-left:16px;' class='errorDetail'>Please fill the required field: "+$.trim(labelData)+"</span>");						
								err = err + 1;
								return false;
								}else{
									$(".errorDetail").remove();
									td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
												fieldsIDArr.push(formchk_id);		
								}	
									}
									else{
										
                                        if(formchk_id=='UK-FCL-00315_0' ||formchk_id=='UK-FCL-00317_0'|| formchk_id=='UK-FCL-00303_0' ){
									
										var labelData = $("#label_" + formchk_id).text();
									labelData=labelData.replace('('+formchk_id+')',"");
									//alert(formchk_id);
									$(".errorDetail").remove()
									$("#div_"+formchk_id).append("<span style='color:red;padding-left:16px;' class='errorDetail'>Please fill the required field: "+$.trim(labelData)+"</span>");						
									err = err + 1;
									return false;
									}else{
										$(".errorDetail").remove();
										td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
													fieldsIDArr.push(formchk_id);		
									}	
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