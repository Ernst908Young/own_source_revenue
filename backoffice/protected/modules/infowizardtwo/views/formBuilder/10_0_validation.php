<style type="text/css">
table#tbl_695 {
    width: 94%;
    margin-left: 26px;
}

.col-lg-12.prttext {
    margin-left: 22px;
    margin-bottom: 15px;
}

div#div_UK-FCL-00273_0 {
    margin-top: -5em;
}

input#UK-FCL-00414_0 {
    display: none;
}

label#label_UK-FCL-00414_0 {
    display: none;
}
</style>

<script type="text/javascript">

 $(document).ready(function(){

$("a.back_btn").css('visibility', 'hidden');
 	$('#UK-FCL-00268_0, #UK-FCL-00107_0, #UK-FCL-00309_0, #UK-FCL-00310_0').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });

    $("#UK-FCL-00310_0").attr('readonly',true);

 	$('#UK-FCL-00301_0, #UK-FCL-00105_0, #UK-FCL-00324_0, #UK-FCL-00093_0, #UK-FCL-00335_0, #UK-FCL-00399_0, #UK-FCL-00460_0').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });

 $("#div_UK-FCL-00275_0").find("label b").before('<span style="color:red;"> *</span>')
  $("#UK-FCL-00096_0").prop('readonly',true); 
  $("#UK-FCL-00275_0").prop('readonly',true); 
  $("#UK-FCL-00278_0").prop('readonly',true); 
  $("#UK-FCL-00096_0").val("BARBADOS");


  $("<div class='row'><div class='col-lg-12' id='details1'><strong>Principal Place of Business:</strong></div></div><br>").insertAfter("#div_UK-FCL-00269_0");


 
  
   $("#UK-FCL-00268_0").keypress(function(e){
		var keyCode = e.which;	 
		console.log(keyCode);
		$(".proposedName").remove();
		if((keyCode == 33) || (keyCode == 64) || (keyCode == 35) || (keyCode == 36) || (keyCode == 37) || (keyCode == 94) || (keyCode== 42) || (keyCode== 126) || (keyCode== 96))
		{
			var id = $(this).attr('id');
			$("#div_"+id).append("<div id="+id+"'-error' style='color:red; margin-left:1em;' class='form-control-feedback-error proposedName'>Please enter the permitted special characters only i.e (),.&:;-</div>");			
			e.preventDefault();		
		}		
	});


   $("#UK-FCL-00274_0").on("change",function(){
		if($(this).val()=='Limited Partner'){
            $("#UK-FCL-00275_0").prop('readonly',false); 
		}else{
		 $("#UK-FCL-00275_0").val(" ");
         $("#UK-FCL-00275_0").prop('readonly',true);

		}
	});


  /* $("#UK-FCL-00320_0").on("change",function(){
       
    
       var country =  $('#UK-FCL-00320_0 option:selected').text();

		
	});
*/

  $("#UK-FCL-00404_0").on("change",function(){
	if($(this).val()){
			$.ajax({
	            type: "POST",
	            dataType:'html',
	            url: "/backoffice/infowizard/subFormRegistrationCharityBoard/getpostalcode/p_id/" + $(this).val(),
	            beforeSend:function(){
	            /*	if ($("#UK-FCL-00094_0-error").length) {
				$("#UK-FCL-00228_0-error").text("Please enter the correct postal code");
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


  $("#UK-FCL-00320_0").on('change', function() {
    var countryCode = $(this).val();		
	$("#UK-FCL-00372_0").select2("val","");

	
   $(".char_country").remove(); 

	 if(countryCode==829){
	        	$("#UK-FCL-00399_0").val('');
	        	$("#UK-FCL-00399_0").attr('readonly',true);
	        	 $(".char_country").hide(); 
	        }else{
	        	$("#UK-FCL-00399_0").attr('readonly',false);
	        	 $("<div style='color:red; float: right; margin-right: 34em; margin-top: -2em; font-size:15px;' class='col-md-6 char_country'>In case of a foreign partner, please provide details of CTSP as an attachment under document listing page</div>").insertAfter("#div_UK-FCL-00320_0");
	        	
	        }

    $.ajax({
        type: "POST",
        url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
        success: function(result) {
            //alert(result);
            $("#UK-FCL-00372_0").html(result);
			<?php if (isset($_GET['subID']) || (isset($_GET['app_Sub_id']) && !empty($_GET['app_Sub_id']))) {
				
				/*if(isset($fieldValues['UK-FCL-00372_0'])){
					//echo $fieldValues['UK-FCL-00372_0'];
					//die();
					?>
					
					 $("#UK-FCL-00372_0").val("<?php echo implode(",",$fieldValues['UK-FCL-00372_0']); ?>");
					  $("#UK-FCL-00372_0").select2("val", "<?php //echo @$fieldValues['UK-FCL-00372_0']; ?>");
					<?php
				}*/
				?>
		
           
           
            $("#UK-FCL-00372_0").change();
            <?php } ?>
        }
    });
});



// Director detail validation 
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




   //Check Whether the firm will carry on the business of Banking conditio Yes OR NO
   $("#UK-FCL-00270_0").on("change",function(){

	 $(".check_yes_no_empty_val").remove();

	  if($(this).val()=='Yes'){

		  $("#UK-FCL-00271_0").val("");
	      $("#UK-FCL-00272_0").val("");
	      $("#UK-FCL-00273_0").val("");
	      $("#UK-FCL-00274_0").val("");
	      $("#UK-FCL-00275_0").val("");
	      $("#tbl_694 td").parent().remove();

		}else if($(this).val()=='No'){

		  $("#UK-FCL-00271_0").val("");
	      $("#UK-FCL-00272_0").val("");
	      $("#UK-FCL-00273_0").val("");
	      $("#UK-FCL-00274_0").val("");
	      $("#UK-FCL-00275_0").val("");
	      $("#tbl_694 td").parent().remove();
	      
		}
	});


   $(".add-more-btn").click(function(e){

   	var firm_will_carry_on = $("#UK-FCL-00270_0").val()
   	var nofpartnerfirm = $("#UK-FCL-00271_0").val();
	var totalRowCount = 0;          
	totalRowCount =  $("#tbl_694 td").closest("tr").length;
	$("#UK-FCL-00270_0").css("border", "1px solid gray");
	$(".check_yes_no_empty_val").remove();
	$(".check_num_two_to_ten").remove();
	$(".check_num_two_to_twenty").remove();
	$(".check_num_less_to_table").remove();


	if(firm_will_carry_on == 'Yes'){

	   if(nofpartnerfirm < 2 || nofpartnerfirm > 10){

	   	$("#title_UK-FCL-00271_0").append("<b style='color:red; margin-left:2em;' class='check_num_two_to_ten'>Please select number between 2 to 10.</b>");
		var titleTot = jQuery("#title_UK-FCL-00271_0").offset().top;
		var addHeight = parseInt(titleTot) - 170;
		jQuery('html,body').animate({ scrollTop: addHeight}, 1000);

		$("#UK-FCL-00271_0").css("border", "1px solid #e73d4a");

     	e.stop();
		e.preventDefault();
		return false;	

	   }else if(nofpartnerfirm<=totalRowCount){

	   	$("#title_UK-FCL-00271_0").append("<b style='color:red; margin-left:2em;' class='check_num_less_to_table'>Please update number of partners in the firm.</b>");
		var titleTot = jQuery("#title_UK-FCL-00271_0").offset().top;
		var addHeight = parseInt(titleTot) - 170;
		jQuery('html,body').animate({ scrollTop: addHeight}, 1000);

		$("#UK-FCL-00271_0").css("border", "1px solid #e73d4a");

     	e.stop();
		e.preventDefault();
		return false;	

	   }	

	}else if(firm_will_carry_on == 'No'){

		if(nofpartnerfirm < 2 || nofpartnerfirm > 20){

		   	$("#title_UK-FCL-00271_0").append("<b style='color:red; margin-left:2em;' class='check_num_two_to_twenty'>Please select number between 2 to 20.</b>");
			var titleTot = jQuery("#title_UK-FCL-00271_0").offset().top;
			var addHeight = parseInt(titleTot) - 170;
			jQuery('html,body').animate({ scrollTop: addHeight}, 1000);

			$("#UK-FCL-00271_0").css("border", "1px solid #e73d4a");

	     	e.stop();
			e.preventDefault();
			return false;	

	   }else if(nofpartnerfirm<=totalRowCount){

	  	$("#title_UK-FCL-00271_0").append("<b style='color:red; margin-left:2em;' class='check_num_less_to_table'>Please update number of partners in the firm.</b>");
		var titleTot = jQuery("#title_UK-FCL-00271_0").offset().top;
		var addHeight = parseInt(titleTot) - 170;
		jQuery('html,body').animate({ scrollTop: addHeight}, 1000);

		$("#UK-FCL-00271_0").css("border", "1px solid #e73d4a");

     	e.stop();
		e.preventDefault();
		return false;	

	   }	

	}else if(firm_will_carry_on == ''){

	  $("#title_UK-FCL-00271_0").append("<b style='color:red; margin-left:2em;' class='check_yes_no_empty_val'>Please select Whether the firm will carry on the business of Banking value.</b>");
		var titleTot = jQuery("#title_UK-FCL-00271_0").offset().top;
		var addHeight = parseInt(titleTot) - 280;
		jQuery('html,body').animate({ scrollTop: addHeight}, 1000);

		$("#UK-FCL-00270_0").css("border", "1px solid #e73d4a");

     	e.stop();
		e.preventDefault();
		return false;	
	}

	// add partners OTHER DETAILS in table
	 var type_of_partner = $("#UK-FCL-00274_0").val();

    if(totalRowCount == 0){

	  var tableHtml = '<table class="table table-striped table-bordered table-hover responsive-table" i="" id="tbl_695"><thead><tr class="add_more_695"></tr><th><b class="ukfcl" title="690"></b>Name</th> <th><b class="ukfcl"  title="691"></b> Value of Contribution</th><th><b class="ukfcl"  title="692"></b>Mode of Contribution</th><th><b class="ukfcl"  title="693"></b>Other Details</th><th style="text-align:center;">Action</th></thead><tbody></tbody></table>';

      $("#label_UK-FCL-00414_0").css('display','block');
      $("#div_UK-FCL-00414_0").after(tableHtml);

    }


	 if(type_of_partner == 'Limited Partner'){

	 	   var limited_partner_name = $("#UK-FCL-00301_0").val();
            var markup = '<tr><td><input class="form-control" name="UK-FCL-00280_0[]" readonly="readonly"  type="text" value="'+limited_partner_name+'" aria-invalid="false" /></td><td><input class="form-control" name="UK-FCL-00281_0[]" type="text" aria-invalid="false" required="required" /></td><td><select name="UK-FCL-00282_0[]" class="form-control"><option value="Cash">Cash</option><option value="Otherwise">Otherwise</option></select></td><td><input class="form-control" name="UK-FCL-00283_0[]" type="text" aria-invalid="false" required="required" /></td><td style="text-align:center;"><a class="btn btn-danger del_1" pi="add_more_695"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>';
            $("#tbl_695 tbody").append(markup);


         
   //          $('.del_1').click(function(e){
			//   // var rowIndex = $(this).closest('tr').prop('rowIndex');
			//   var index = $('table tr').index(tr);
			//   alert(index);
			//   $('.blank tr').filter(function () {
			//     return this.rowIndex === rowIndex;
			//   }).remove();
			// });

	 }

   });

   //End


    var today = new Date();
    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        autoclose:true,
        endDate: "today",
        maxDate: today
    }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });



 //validation for not allowed the number and special charector
  $("#UK-FCL-00272_0, #UK-FCL-00280_0").keypress(function(event){
        var inputValue = event.charCode;
        if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)){
            event.preventDefault();
        }
    });


 
  //300 Charactor Validation
  var maxchars_300 = 300;
	$('#UK-FCL-00268_0').keyup(function () {
	    var tlength = $(this).val().length;
	    $(this).val($(this).val().substring(0, maxchars_300));
	    var tlength = $(this).val().length;
	    remain = maxchars_300 - parseInt(tlength);
	    $(".char_validation_1").remove();
	    if(remain == 0){
	      $("#UK-FCL-00268_0-error").parent('div').append("<div style='color:red;'  class='form-control-feedback-error char_validation_1'>Please enter the proposed name of Limited Partnership Firm in 300 characters only.</div>");
	      return false;
	    }
	});


  //4000 Charactor Validation
  var maxchars = 4000;
	$('#UK-FCL-00269_0').keyup(function () {
	    var tlength = $(this).val().length;
	    $(this).val($(this).val().substring(0, maxchars));
	    var tlength = $(this).val().length;
	    remain = maxchars - parseInt(tlength);
	    $(".char_validation_1").remove();
	    if(remain == 0){
	      $("#UK-FCL-00269_0-error").parent('div').append("<div style='color:red;'  class='form-control-feedback-error char_validation_1'>Only 4000 characters can be inserted in this field. In case you want to provide additional information, then please attach a schedule in required format.</div>");
	      return false;
	    }
	});

 });


 

 function addmoreaction(id,service_id,div_id){

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
					if(div_id==694){

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
							if(formchk_id=='UK-FCL-00301_0' || formchk_id=='UK-FCL-00324_0' || formchk_id=='UK-FCL-00093_0' || formchk_id=='UK-FCL-00320_0' || formchk_id=='UK-FCL-00372_0' || formchk_id=='UK-FCL-00274_0' || formchk_id=='UK-FCL-00275_0' || checkfield == false){
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
					if(div_id==669){
							if(formchk_id=='UK-FCL-00095_0' || formchk_id=='UK-FCL-00263_0' || formchk_id=='UK-FCL-00264_0' || formchk_id=='UK-FCL-00113_0'){
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
                if(confirm('Before adding, please check whether the details entered is correct.'))
				
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

 //End //add more code	
</script>