<script type="text/javascript">
$(document).ready(function(){
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

});
	

function addmorebtncheckdirector(){
	var nofapp = $("#UK-FCL-00254_0").val();
	 var totalRowCount = 0;          
      totalRowCount =  $("#tbl_1254 td").closest("tr").length;
	if(nofapp<=totalRowCount){
		//$("#title_UK-FCL-00254_0").append("<b style='color:red;' class='amalgamatingDetail'>Please Add Number of Director as Per Enter 'No. of Directors in the company' Field.</b>");
		var dem = "Please Add Number of Director as Per Enter 'No. of Directors in the company' Field."; 
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
						//alert(formchk_id+' -- '+ cls +' ---- '+vall+ ' from if' );
						if(div_id==641){

							var labelData = $("#label_" + formchk_id).text();
							labelData=labelData.replace('('+formchk_id+')',"");
							//alert(formchk_id);
							$("#div_"+formchk_id).append("<span style='color:red;padding-left:16px;' class='errorDetail'>This field is required</span>");		
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
						$("#UK-FCL-00133_0").attr('readonly',false);
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