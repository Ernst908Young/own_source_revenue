<script type="text/javascript">
$(document).ready(function(){
   // code here
   	$("#UK-FCL-00089_0").attr('readonly',true);
	     $("#div_UK-FCL-00132_0").find("label").append('<span style="color:red;"> *</span>')
		 $("#div_UK-FCL-00105_0").find("label").append('<span style="color:red;"> *</span>')
		 $("#div_UK-FCL-00106_0").find("label").append('<span style="color:red;"> *</span>')
		 $("#div_UK-FCL-00093_0").find("label").append('<span style="color:red;"> *</span>')
		 $("#div_UK-FCL-00096_0").find("label").append('<span style="color:red;"> *</span>')
		 $("#div_UK-FCL-00304_0").find("label").append('<span style="color:red;"> *</span>')
		 $("#div_UK-FCL-00431_0").find("label").append('<span style="color:red;"> *</span>')
		 $("#div_UK-FCL-00432_0").find("label").append('<span style="color:red;"> *</span>')
		 $("#div_UK-FCL-00433_0").find("label").append('<span style="color:red;"> *</span>')
		 $("#div_UK-FCL-00434_0").find("label").append('<span style="color:red;"> *</span>')
		 $("#div_UK-FCL-00437_0").find("label").append('<span style="color:red;"> *</span>')
		 $("#div_UK-FCL-00441_0").find("label").append('<span style="color:red;"> *</span>')
		 $("#div_UK-FCL-00442_0").find("label").append('<span style="color:red;"> *</span>')
		 $("#div_UK-FCL-00443_0").find("label").append('<span style="color:red;"> *</span>')
		 $("#div_UK-FCL-00444_0").find("label").append('<span style="color:red;"> *</span>')
		 $("#div_UK-FCL-00446_0").find("label").append('<span style="color:red;"> *</span>')
		 $("#div_UK-FCL-00450_0").find("label").append('<span style="color:red;"> *</span>')

   $("#UK-FCL-00132_0").bind("keypress",function(){
	var regex=  new RegExp("^[ A-Za-z]*$"); //;
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        return false;
    }
});
$("#UK-FCL-00481_0").attr('readonly',true);
$("#UK-FCL-00491_0").attr('readonly',true);
$("#UK-FCL-00490_0").attr('readonly',true);

$("#UK-FCL-00106_0").bind("keypress",function(){
	var regex=  new RegExp("^[ A-Za-z]*$"); //;
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        return false;
    }
});
$("#UK-FCL-00105_0").bind("keypress",function(){
	var regex=  new RegExp("^[ A-Za-z]*$"); //;
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        return false;
    }
});	
$("#UK-FCL-00304_0").bind("keypress",function(){
	var regex=  new RegExp("^[ A-Za-z]*$"); //;
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        return false;
    }
});	
// Cassetion Text Validation
$("#UK-FCL-00431_0").bind("keypress",function(){
	var regex=  new RegExp("^[ A-Za-z]*$"); //;
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        return false;
    }
});
$("#UK-FCL-00432_0").bind("keypress",function(){
	var regex=  new RegExp("^[ A-Za-z]*$"); //;
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        return false;
    }
});
$("#UK-FCL-00433_0").bind("keypress",function(){
	var regex=  new RegExp("^[ A-Za-z]*$"); //;
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        return false;
    }
});	


// Director text validation
$("#UK-FCL-00441_0").bind("keypress",function(){
	var regex=  new RegExp("^[ A-Za-z]*$"); //;
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        return false;
    }
});
$("#UK-FCL-00442_0").bind("keypress",function(){
	var regex=  new RegExp("^[ A-Za-z]*$"); //;
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        return false;
    }
});
$("#UK-FCL-00443_0").bind("keypress",function(){
	var regex=  new RegExp("^[ A-Za-z]*$"); //;
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        return false;
    }
});	
$("#UK-FCL-00450_0").bind("keypress",function(){
	var regex=  new RegExp("^[ A-Za-z]*$"); //;
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        return false;
    }
});	
   //middle name validation
$("#div_UK-FCL-00105_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox' name='middlenamecheckbox'> I do not have a middle name or middle initial</div>");

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
// middle name 1
$("#div_UK-FCL-00432_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox-1' name='middlenamecheckbox-1'> I do not have a middle name or middle initial</div>");

$("#UK-FCL-00432_0").blur(function(){
	if($(this).val()){
		$("input[name=middlenamecheckbox-1]").prop('checked', false);	
	}
});

$("input[name=middlenamecheckbox-1]").change(function(){
	if($(this).is(':checked')){
		$("#UK-FCL-00432_0").val("");
		$("#UK-FCL-00432_0").attr('readonly',true);		
	}else{
		$("#UK-FCL-00432_0").attr('readonly',false);
	}
});
// middle name 2
$("#div_UK-FCL-00442_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox-2' name='middlenamecheckbox-2'> I do not have a middle name or middle initial</div>");

$("#UK-FCL-00442_0").blur(function(){
	if($(this).val()){
		$("input[name=middlenamecheckbox-2]").prop('checked', false);	
	}
});

$("input[name=middlenamecheckbox-2]").change(function(){
	if($(this).is(':checked')){
		$("#UK-FCL-00442_0").val("");
		$("#UK-FCL-00442_0").attr('readonly',true);		
	}else{
		$("#UK-FCL-00442_0").attr('readonly',false);
	}
});

// end middle name validation
// country and parish selection 
   $("#UK-FCL-00096_0").on('change', function() {
        var countryCode = $(this).val();		
		$("#UK-FCL-00400_0").select2("val","");
        $.ajax({
            type: "POST",
            url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
            success: function(result) {
                //alert(result);
                $("#UK-FCL-00400_0").html(result);
				<?php if (isset($_GET['subID']) || (isset($_GET['app_Sub_id']) && !empty($_GET['app_Sub_id']))) { ?>
				//alert("<?php echo @$fieldValues['UK-FCL-00400_0']; ?>");
                $("#UK-FCL-00400_0").val("<?php echo @$fieldValues['UK-FCL-00400_0']; ?>");
                $("#UK-FCL-00400_0").select2("val", "<?php echo @$fieldValues['UK-FCL-00400_0']; ?>");
                $("#UK-FCL-00400_0").change();
                <?php } ?>
            }
        });
    });
// country and parish selection for Directors
$("#UK-FCL-00446_0").on('change', function() {
        var countryCode = $(this).val();		
		$("#UK-FCL-00447_0").select2("val","");
        $.ajax({
            type: "POST",
            url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
            success: function(result) {
                //alert(result);
                $("#UK-FCL-00447_0").html(result);
				<?php if (isset($_GET['subID']) || (isset($_GET['app_Sub_id']) && !empty($_GET['app_Sub_id']))) { ?>
				//alert("<?php echo @$fieldValues['UK-FCL-00447_0']; ?>");
                $("#UK-FCL-00447_0").val("<?php echo @$fieldValues['UK-FCL-00447_0']; ?>");
                $("#UK-FCL-00447_0").select2("val", "<?php echo @$fieldValues['UK-FCL-00447_0']; ?>");
                $("#UK-FCL-00447_0").change();
                <?php } ?>
            }
        });
    });
	// country and parish selection for Cassetion
$("#UK-FCL-00437_0").on('change', function() {
        var countryCode = $(this).val();		
		$("#UK-FCL-00438_0").select2("val","");
        $.ajax({
            type: "POST",
            url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
            success: function(result) {
                //alert(result);
                $("#UK-FCL-00438_0").html(result);
				<?php if (isset($_GET['subID']) || (isset($_GET['app_Sub_id']) && !empty($_GET['app_Sub_id']))) { ?>
				//alert("<?php echo @$fieldValues['UK-FCL-00438_0']; ?>");
                $("#UK-FCL-00438_0").val("<?php echo @$fieldValues['UK-FCL-00438_0']; ?>");
                $("#UK-FCL-00438_0").select2("val", "<?php echo @$fieldValues['UK-FCL-00438_0']; ?>");
                $("#UK-FCL-00438_0").change();
                <?php } ?>
            }
        });
    });
	// validation for selecting Purpose of Filing the Form 
$("#UK-FCL-00012_0").on('change', function() {
        var code = $(this).val();		
		if(code === 'Appointment of Director(s)'){
		$("#title_UK-FCL-00431_0,#div_UK-FCL-00431_0,#div_UK-FCL-00432_0,#div_UK-FCL-00433_0,#div_UK-FCL-00434_0,#div_UK-FCL-00435_0,#div_UK-FCL-00436_0,#div_UK-FCL-00437_0,#div_UK-FCL-00438_0,#div_UK-FCL-00439_0,#div_UK-FCL-00440_0,#add_more_1824").hide();
		$("#title_UK-FCL-00132_0,#div_UK-FCL-00132_0,#div_UK-FCL-00105_0,#div_UK-FCL-00106_0,#div_UK-FCL-00093_0,#div_UK-FCL-00309_0,#div_UK-FCL-00096_0,#div_UK-FCL-00400_0,#div_UK-FCL-00401_0,#div_UK-FCL-00399_0,#div_UK-FCL-00304_0,#div_UK-FCL-00087_0,#add_more_1793").show();
		}if(code === 'Cessation of Director(s)'){
			$("#title_UK-FCL-00431_0,#div_UK-FCL-00431_0,#div_UK-FCL-00432_0,#div_UK-FCL-00433_0,#div_UK-FCL-00434_0,#div_UK-FCL-00435_0,#div_UK-FCL-00436_0,#div_UK-FCL-00437_0,#div_UK-FCL-00438_0,#div_UK-FCL-00439_0,#div_UK-FCL-00440_0,#add_more_1824").show();
		$("#title_UK-FCL-00132_0,#div_UK-FCL-00132_0,#div_UK-FCL-00105_0,#div_UK-FCL-00106_0,#div_UK-FCL-00093_0,#div_UK-FCL-00309_0,#div_UK-FCL-00096_0,#div_UK-FCL-00400_0,#div_UK-FCL-00401_0,#div_UK-FCL-00399_0,#div_UK-FCL-00304_0,#div_UK-FCL-00087_0,#add_more_1793").hide();
		}if(code === 'Appointment and Cessation of Director(s)'){
			$("#title_UK-FCL-00431_0,#div_UK-FCL-00431_0,#div_UK-FCL-00432_0,#div_UK-FCL-00433_0,#div_UK-FCL-00434_0,#div_UK-FCL-00435_0,#div_UK-FCL-00436_0,#div_UK-FCL-00437_0,#div_UK-FCL-00438_0,#div_UK-FCL-00439_0,#div_UK-FCL-00440_0,#add_more_1824").show();
		$("#title_UK-FCL-00132_0,#div_UK-FCL-00132_0,#div_UK-FCL-00105_0,#div_UK-FCL-00106_0,#div_UK-FCL-00093_0,#div_UK-FCL-00309_0,#div_UK-FCL-00096_0,#div_UK-FCL-00400_0,#div_UK-FCL-00401_0,#div_UK-FCL-00399_0,#div_UK-FCL-00304_0,#div_UK-FCL-00087_0,#add_more_1793").show();
		}
    });
	
        var code = $("#UK-FCL-00012_0").val();		
		if(code === 'Appointment of Director(s)'){
		$("#title_UK-FCL-00431_0,#div_UK-FCL-00431_0,#div_UK-FCL-00432_0,#div_UK-FCL-00433_0,#div_UK-FCL-00434_0,#div_UK-FCL-00435_0,#div_UK-FCL-00436_0,#div_UK-FCL-00437_0,#div_UK-FCL-00438_0,#div_UK-FCL-00439_0,#div_UK-FCL-00440_0,#add_more_1824").hide();
		$("#title_UK-FCL-00132_0,#div_UK-FCL-00132_0,#div_UK-FCL-00105_0,#div_UK-FCL-00106_0,#div_UK-FCL-00093_0,#div_UK-FCL-00309_0,#div_UK-FCL-00096_0,#div_UK-FCL-00400_0,#div_UK-FCL-00401_0,#div_UK-FCL-00399_0,#div_UK-FCL-00304_0,#div_UK-FCL-00087_0,#add_more_1793").show();
		}if(code === 'Cessation of Director(s)'){
			$("#title_UK-FCL-00431_0,#div_UK-FCL-00431_0,#div_UK-FCL-00432_0,#div_UK-FCL-00433_0,#div_UK-FCL-00434_0,#div_UK-FCL-00435_0,#div_UK-FCL-00436_0,#div_UK-FCL-00437_0,#div_UK-FCL-00438_0,#div_UK-FCL-00439_0,#div_UK-FCL-00440_0,#add_more_1824").show();
		$("#title_UK-FCL-00132_0,#div_UK-FCL-00132_0,#div_UK-FCL-00105_0,#div_UK-FCL-00106_0,#div_UK-FCL-00093_0,#div_UK-FCL-00309_0,#div_UK-FCL-00096_0,#div_UK-FCL-00400_0,#div_UK-FCL-00401_0,#div_UK-FCL-00399_0,#div_UK-FCL-00304_0,#div_UK-FCL-00087_0,#add_more_1793").hide();
		}if(code === 'Appointment and Cessation of Director(s)'){
			$("#title_UK-FCL-00431_0,#div_UK-FCL-00431_0,#div_UK-FCL-00432_0,#div_UK-FCL-00433_0,#div_UK-FCL-00434_0,#div_UK-FCL-00435_0,#div_UK-FCL-00436_0,#div_UK-FCL-00437_0,#div_UK-FCL-00438_0,#div_UK-FCL-00439_0,#div_UK-FCL-00440_0,#add_more_1824").show();
		$("#title_UK-FCL-00132_0,#div_UK-FCL-00132_0,#div_UK-FCL-00105_0,#div_UK-FCL-00106_0,#div_UK-FCL-00093_0,#div_UK-FCL-00309_0,#div_UK-FCL-00096_0,#div_UK-FCL-00400_0,#div_UK-FCL-00401_0,#div_UK-FCL-00399_0,#div_UK-FCL-00304_0,#div_UK-FCL-00087_0,#add_more_1793").show();
		}
    // new fields validation
	$("#UK-FCL-00480_0").on('change', function() {
        var code = $(this).val();	

		//alert(code);	
		if(code === 'Yes'){
			$("#UK-FCL-00481_0").attr('readonly',false);
			$("#div_UK-FCL-00481_0").find("label").append('<span class ="mandatory" style="color:red;"> *</span>')
		}if(code === 'No'){
			$("#UK-FCL-00481_0").attr('readonly',true);
			$("#UK-FCL-00481_0").val("");
			$('span.mandatory').remove();

		}
    }); 
	$("#UK-FCL-00488_0").on('change', function() {
        var code = $(this).val();	

		//alert(code);	
		if(code === 'Yes'){
			$("#UK-FCL-00491_0").attr('readonly',false);
			$("#div_UK-FCL-00491_0").find("label").append('<span class ="mandatory" style="color:red;"> *</span>')
		}if(code === 'No'){
			$("#UK-FCL-00491_0").attr('readonly',true);
			$("#UK-FCL-00491_0").val("");
			$('span.mandatory').remove();

		}
    }); 
	$("#UK-FCL-00489_0").on('change', function() {
        var code = $(this).val();	

		//alert(code);	
		if(code === 'Yes'){
			$("#UK-FCL-00490_0").attr('readonly',false);
			$("#div_UK-FCL-00481_0").find("label").append('<span class ="mandatory" style="color:red;"> *</span>')
		}if(code === 'No'){
			$("#UK-FCL-00490_0").attr('readonly',true);
			$("#UK-FCL-00490_0").val("");
			$('span.mandatory').remove();

		}
    }); 
// Get Company name by aompany no.
	$("#UK-FCL-00403_0").on("blur",function(){
		var reg_no = $(this).val();	
		if(reg_no!=""){
				$.ajax({
		            type: "POST",
		            dataType:'json',
		            url: "/backoffice/infowizardtwo/SubFormNoticeofChangeofDirectorForm9/getCompanyNameBySrnNo/srn_no/" + reg_no,
		            beforeSend:function(){
		            	$("#UK-FCL-00403_0-error").text("Please wait...");	    	        	
		            },
		            success: function(result) {		            	
		            	if(result.status==true){
		            		if(result.app_status=='valid'){
		            			$("#UK-FCL-00089_0").val(result.name);
		            			$("#UK-FCL-00403_0-error").html("");
		            			//$("#UK-FCL-00089_0-error").html("");	
		            		}else{
		            			$("#UK-FCL-00403_0-error").text(result.msg);
		            			//$("#UK-FCL-00089_0-error").text(result.msg);			
		            			$("#UK-FCL-00089_0").val("");  
		            		}	            			            	
		            	}else{
		            		if(result.user){
		            			$("#UK-FCL-00403_0-error").text(result.msg);
		            		    $("#UK-FCL-00089_0").val("");	
		            		   // $("#UK-FCL-00089_0-error").text("");
		            		}else{
		            			alert(result.msg);
		            		}		            			            	
		            	}
		             //  console.log(result);
		            }
		        });
		}		 
	});

	$("#UK-FCL-00403_0").bind("keypress",function(){
	var regex=  new RegExp("^[0-9]*$"); //;
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
	    if (!regex.test(key)) {
	        event.preventDefault();
	        return false;
	    }
	});	
//  Add Sub heading Appointment Detail
$("#title_UK-FCL-00132_0").append("<h5 id='appointdetail'>Notice is given that the following person(s) was/ were appointed as director(s):</h5>");
//  Add Sub heading Cassetion Detail
$("#title_UK-FCL-00431_0").append("<h5 id='cassetiondetail'>Notice is given that the following person(s) ceased to hold office as director(s):</h5>");
//  Add Sub heading Director Detail
$("#title_UK-FCL-00441_0").append("<h5 id='directordetail'>The directors of the company as of this date are:</h5>");
	
});
function addmoreaction(id,service_id,div_id){
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
						 if ($("input[name='" + formchk_id + "']").attr('type') == 'number') {
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
						// for appointment detail
						if(div_id==1832){

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
// requerd filed validation
								if(formchk_id=='UK-FCL-00132_0' || checkfield==false || formchk_id=='UK-FCL-00106_0' || formchk_id=='UK-FCL-00093_0' || formchk_id=='UK-FCL-00096_0' || formchk_id=='UK-FCL-00304_0'){
										var labelData = $("#label_" + formchk_id).text();
									labelData=labelData.replace('('+formchk_id+')',"");
									//alert(formchk_id);
									if(formchk_id=="UK-FCL-00105_0"){
											$("#div_"+formchk_id).append("<span style='color:red;padding-left:16px;' class='errorDetail'>Please enter the required information or select the check box</span>");
									}else{ 
									
										$("#div_"+formchk_id).append("<div class='form-control-feedback-addmore'>This field is required</div>");


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
						// for cessation detail
						if(div_id==1833){
							if(formchk_id=='UK-FCL-00432_0'){
										var mnt = $("#UK-FCL-00432_0").val();
										if(mnt){
											var checkfield = true;
										}else{
											var mncb = $('input[name=middlenamecheckbox-1]:checked').val(); 
											if(mncb){
												var checkfield = true;
											}else{
												var checkfield = false;
											}
										}
									}else{
										var checkfield = true;
									}
									if(formchk_id=='UK-FCL-00431_0' || checkfield==false || formchk_id=='UK-FCL-00433_0' || formchk_id=='UK-FCL-00434_0' || formchk_id=='UK-FCL-00437_0'){
										var labelData = $("#label_" + formchk_id).text();
									labelData=labelData.replace('('+formchk_id+')',"");
									//alert(formchk_id);
									if(formchk_id=="UK-FCL-00432_0"){
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
						// for director detail	
						if(div_id==1834){
							if(formchk_id=='UK-FCL-00442_0'){
										var mnt = $("#UK-FCL-00442_0").val();
										if(mnt){
											var checkfield = true;
										}else{
											var mncb = $('input[name=middlenamecheckbox-2]:checked').val(); 
											if(mncb){
												var checkfield = true;
											}else{
												var checkfield = false;
											}
										}
									}else{
										var checkfield = true;
									}
									if(formchk_id=='UK-FCL-00441_0' || checkfield==false || formchk_id=='UK-FCL-00443_0' || formchk_id=='UK-FCL-00444_0' || formchk_id=='UK-FCL-00446_0' || formchk_id=='UK-FCL-00450_0'){
										var labelData = $("#label_" + formchk_id).text();
									labelData=labelData.replace('('+formchk_id+')',"");
									//alert(formchk_id);
									if(formchk_id=="UK-FCL-00442_0"){
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
 }
</script>
