

<script type="text/javascript">

$(document).ready(function(){




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


    
    
	
});


function addmorebtncheckmanagersdetail(){

 var nofdirecotor = $("#UK-FCL-00234_0").val();
     var totalRowCount = 0;          
     totalRowCount =  $("#tbl_614 td").closest("tr").length;
     if(nofdirecotor<=totalRowCount){
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

     }else if(nofdirecotor < 3){

     	$(".check_number_three").remove();
        $(".check_fixed_number").hide();

    
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
     } 	 	

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
		if(div_id==614){
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
					if(div_id==614){

						if(formchk_id=='UK-FCL-00236_0'){
					var mnt = $("#UK-FCL-00236_0").val();
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
							if(formchk_id=='UK-FCL-00235_0' || formchk_id=='UK-FCL-00237_0' || formchk_id=='UK-FCL-00238_0' || formchk_id=='UK-FCL-00239_0' || formchk_id == 'UK-FCL-00373_0' || formchk_id=='UK-FCL-00107_0'||formchk_id=='UK-FCL-00372_0'|| formchk_id=='UK-FCL-00384_0'|| formchk_id=='UK-FCL-00239_0'||  checkfield == false){
									var labelData = $("#label_" + formchk_id).text();
								labelData=labelData.replace('('+formchk_id+')',"");
								//alert(formchk_id);
								$("#div_"+formchk_id).append("<span style='color:red;padding-left:16px;' class='errorDetail'>This field is required</span>");						
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
								$("#div_"+formchk_id).append("<span style='color:red;padding-left:16px;' class='errorDetail'>Please fill the required field: "+$.trim(labelData)+"</span>");						
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



