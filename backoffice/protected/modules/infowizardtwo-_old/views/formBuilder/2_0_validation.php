<script type="text/javascript">
$(document).ready(function(){

	//$("div.back").hide(); 
	$("a.back_btn").css('visibility', 'hidden');
	
	//Business name individual form uppercase
	$('#UK-FCL-00056_0,#UK-FCL-00062_0,#UK-FCL-00329_0,#UK-FCL-00330_0,#UK-FCL-00064_0,#UK-FCL-00065_0,#UK-FCL-00065_0,#UK-FCL-00067_0,#UK-FCL-00068_0,#UK-FCL-00069_0,#UK-FCL-00082_0,#UK-FCL-00376_0,#UK-FCL-00081_0').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });
	
	//Company name uppercase
	$('#UK-FCL-00015_0,#UK-FCL-00016_0,#UK-FCL-00017_0,#UK-FCL-00020_0,#UK-FCL-00023_0').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });
	
	//Society name uppercase
	$('#UK-FCL-00046_0,#UK-FCL-00047_0,#UK-FCL-00048_0,#UK-FCL-00055_0').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });
	
	/* $("#input_UK-FCL-00003_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='checkbox_UK-FCL-00003_0' name='checkbox_UK-FCL-00003_0' checked> I do not have a middle name or middle initial</div>"); */
	
	$("#input_UK-FCL-00073_0").append("<div class='col-md-12' style='margin-top:10px;color:red;'>(You must be 18 years or over to submit this form.)</div>");
	
	$("#div_UK-FCL-00497_0").hide();
	$("#UK-FCL-00497_0").prop('required',false);	
	$("#div_UK-FCL-00498_0").hide();	
	$("#UK-FCL-00498_0").prop('required',false);	
	$("#div_UK-FCL-00499_0").hide();	
	$("#UK-FCL-00499_0").prop('required',false);
	
	/*$("#UK-FCL-00049_0").select2("val");
	
	$('#checkbox_UK-FCL-00003_0').change(function(){
        if($('#checkbox_UK-FCL-00003_0:checked').length){
            $('#UK-FCL-00003_0').attr('readonly',true); //If checked - Read only
        }else{
            $('#UK-FCL-00003_0').attr('readonly',false);//Not Checked - Normal
        }
    }); */
	
	$("#input_UK-FCL-00065_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='checkbox_UK-FCL-00065_0' name='checkbox_UK-FCL-00065_0'> I do not have a middle name or middle initial</div>");
	
	$('#checkbox_UK-FCL-00065_0').change(function(){
        if($('#checkbox_UK-FCL-00065_0:checked').length){
            $('#UK-FCL-00065_0').attr('readonly',true); //If checked - Read only
        }else{
            $('#UK-FCL-00065_0').attr('readonly',false);//Not Checked - Normal
        }
    });
	
	$("#input_UK-FCL-00260_0").append("<div class='col-md-12' style='margin-top:10px;visibility: hidden;'><input type='checkbox' id='checkbox' name='checkbox'></div>");
	
	//get state according to country
	$("#UK-FCL-00007_0").on('change', function() {
        var countryCode = $(this).val();		
		$("#UK-FCL-00008_0").select2("val","");
        $.ajax({
            type: "POST",
            url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
            success: function(result) {
                //alert(result);
                $("#UK-FCL-00008_0").html(result);
				<?php if (isset($_GET['subID']) || (isset($_GET['app_Sub_id']) && !empty($_GET['app_Sub_id']))) { ?>
				//alert("<?php echo @$fieldValues['UK-FCL-00008_0']; ?>");
                $("#UK-FCL-00008_0").val("<?php echo @$fieldValues['UK-FCL-00008_0']; ?>");
                $("#UK-FCL-00008_0").select2("val", "<?php echo @$fieldValues['UK-FCL-00008_0']; ?>");
                $("#UK-FCL-00008_0").change();
                <?php } ?>
            }
        });
    });
	
	//Business Entity Type On Change
	$("#UK-FCL-00013_0").on('change', function() {
        var bEntitiyType = $(this).val();		
        var Name_Reservation_New_Company = $("#UK-FCL-00031_0").val();
        var Existing_Company = $("#UK-FCL-00492_0").val();
		
		
		$("#UK-FCL-00014_0").select2("val","");
		$("#UK-FCL-00484_0").select2("val","");
		$("#UK-FCL-00485_0").select2("val","");
		
		if(Name_Reservation_New_Company){
			$.ajax({
				type: "POST",
				url: "/backoffice/iloc/property/getBusinessSuffix/businessEntityType/" + bEntitiyType+"/namereserve/"+Name_Reservation_New_Company,
				success: function(result) {
					//alert(result);
					$("#UK-FCL-00014_0").html(result);
					$("#UK-FCL-00484_0").html(result);
					$("#UK-FCL-00485_0").html(result);
					<?php if (isset($_GET['subID']) || (isset($_GET['app_Sub_id']) && !empty($_GET['app_Sub_id']))) { ?>
					
					$("#UK-FCL-00014_0").val("<?php echo @$fieldValues['UK-FCL-00014_0']; ?>");
					$("#UK-FCL-00014_0").select2("val", "<?php echo @$fieldValues['UK-FCL-00014_0']; ?>");
					$("#UK-FCL-00014_0").change();
					
					$("#UK-FCL-00484_0").val("<?php echo @$fieldValues['UK-FCL-00484_0']; ?>");
					$("#UK-FCL-00484_0").select2("val", "<?php echo @$fieldValues['UK-FCL-00484_0']; ?>");
					$("#UK-FCL-00484_0").change();
					
					$("#UK-FCL-00485_0").val("<?php echo @$fieldValues['UK-FCL-00485_0']; ?>");
					$("#UK-FCL-00485_0").select2("val", "<?php echo @$fieldValues['UK-FCL-00485_0']; ?>");
					$("#UK-FCL-00485_0").change();
					<?php } ?>
				}
			});
		}
		
		if(Existing_Company){
			$.ajax({
				type: "POST",
				url: "/backoffice/iloc/property/getBusinessSuffix2/businessEntityType/" + bEntitiyType+"/namereserve/"+Existing_Company,
				success: function(result) {
					//alert(result);
					$("#UK-FCL-00014_0").html(result);
					$("#UK-FCL-00484_0").html(result);
					$("#UK-FCL-00485_0").html(result);
					<?php if (isset($_GET['subID']) || (isset($_GET['app_Sub_id']) && !empty($_GET['app_Sub_id']))) { ?>
					
					$("#UK-FCL-00014_0").val("<?php echo @$fieldValues['UK-FCL-00014_0']; ?>");
					$("#UK-FCL-00014_0").select2("val", "<?php echo @$fieldValues['UK-FCL-00014_0']; ?>");
					$("#UK-FCL-00014_0").change();
					
					$("#UK-FCL-00484_0").val("<?php echo @$fieldValues['UK-FCL-00484_0']; ?>");
					$("#UK-FCL-00484_0").select2("val", "<?php echo @$fieldValues['UK-FCL-00484_0']; ?>");
					$("#UK-FCL-00484_0").change();
					
					$("#UK-FCL-00485_0").val("<?php echo @$fieldValues['UK-FCL-00485_0']; ?>");
					$("#UK-FCL-00485_0").select2("val", "<?php echo @$fieldValues['UK-FCL-00485_0']; ?>");
					$("#UK-FCL-00485_0").change();
					<?php } ?>
				}
			});		
		}
		
		if((Name_Reservation_New_Company!='3' && Existing_Company!='2') || (Name_Reservation_New_Company=='' && Existing_Company=='')){
			$.ajax({
				type: "POST",
				url: "/backoffice/iloc/property/getBusinessSuffix3/businessEntityType/" + bEntitiyType,
				success: function(result) {
					//alert(result);
					$("#UK-FCL-00014_0").html(result);
					$("#UK-FCL-00484_0").html(result);
					$("#UK-FCL-00485_0").html(result);
					<?php if (isset($_GET['subID']) || (isset($_GET['app_Sub_id']) && !empty($_GET['app_Sub_id']))) { ?>
					
					$("#UK-FCL-00014_0").val("<?php echo @$fieldValues['UK-FCL-00014_0']; ?>");
					$("#UK-FCL-00014_0").select2("val", "<?php echo @$fieldValues['UK-FCL-00014_0']; ?>");
					$("#UK-FCL-00014_0").change();
					
					$("#UK-FCL-00484_0").val("<?php echo @$fieldValues['UK-FCL-00484_0']; ?>");
					$("#UK-FCL-00484_0").select2("val", "<?php echo @$fieldValues['UK-FCL-00484_0']; ?>");
					$("#UK-FCL-00484_0").change();
					
					$("#UK-FCL-00485_0").val("<?php echo @$fieldValues['UK-FCL-00485_0']; ?>");
					$("#UK-FCL-00485_0").select2("val", "<?php echo @$fieldValues['UK-FCL-00485_0']; ?>");
					$("#UK-FCL-00485_0").change();
					<?php } ?>
				}
			});		
		}
		
    }); 
	
	
	//get state according to country in individual business details
	$("#UK-FCL-00059_0").on('change', function() {
       // var countryCode = $(this).val();	
	    var countryCode = '829';		
		//$("#UK-FCL-00060_0").select2("val","");
        $.ajax({
            type: "POST",
            url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
            success: function(result) {
                //alert(result);
                $("#UK-FCL-00060_0").html(result);				
            }
        });
    });
	
		
	//get state according to country in indidual details
	$("#UK-FCL-00079_0").on('change', function() {
        var countryCode = $(this).val();		
		$("#UK-FCL-00080_0").select2("val","");
        $.ajax({
            type: "POST",
            url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
            success: function(result) {
                //alert(result);
                $("#UK-FCL-00080_0").html(result);
				
            }
        });
    });
	
	//get state according to country in individual business details
	$("#UK-FCL-00077_0").on('change', function() {
		var countryCode = $(this).val();
		//$("#UK-FCL-00060_0").select2("val","");
        $.ajax({
            type: "POST",
            url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
            success: function(result) {
                //alert(result);
                $("#UK-FCL-00080_0").html(result);				
            }
        });
    });
	
	$("#UK-FCL-00060_0").on("change",function(){
		if($(this).val()){
			$.ajax({
				type: "POST",
				dataType:'html',
				url: "/backoffice/infowizardtwo/subFormCompanyNameReservation/getpostalcode/p_id/" + $(this).val(),
				success: function(result) {	         		            		
					$("#UK-FCL-00061_0").html(result);	
				}
			});
		}	
	}); 
	
	
	$("#UK-FCL-00054_0").on("blur",function(){
		var regNo = $(this).val();		
		if($(this).val()){
			$.ajax({
				type: "POST",
				data: {reg_no: regNo},
				url: "/backoffice/infowizardtwo/subFormCompanyNameReservation/getSocietyName",
				success: function(result) {
					if(result){
						$("#UK-FCL-00055_0").val(result);	
						$("#UK-FCL-00055_0").prop('readonly',true);	
					}else{
						$("#UK-FCL-00055_0").val("");
						$("#UK-FCL-00055_0").prop('readonly',false);
					}
				}
			});
		}	
	}); 
	
	$("#UK-FCL-00019_0").on("blur",function(){
		var regNo = $(this).val();		
		var type_of_company = $("#UK-FCL-00492_0").val();	
		$("#UK-FCL-00020_0").val("");
		$("#UK-FCL-00020_0").prop('readonly',false);
		if(type_of_company){
			if($(this).val()){
				$.ajax({
					type: "POST",
					data: {reg_no: regNo,type_of_company:type_of_company},
					url: "/backoffice/infowizardtwo/subFormCompanyNameReservation/getCompanyName",
					success: function(result) {
						if(result){
							$("#UK-FCL-00020_0").val(result);	
							$("#UK-FCL-00020_0").prop('readonly',true);	
						}
					}
				});
			}	
		}	
	});
	
	$("#UK-FCL-00332_0").on("blur",function(){
		var regNo = $(this).val();		
		$("#UK-FCL-00084_0").val("");
		$("#UK-FCL-00333_0").val("");
		$("#UK-FCL-00085_0").val("");
		$("#UK-FCL-00084_0").prop('readonly',false);
		$("#UK-FCL-00333_0").prop('readonly',false);
		$("#UK-FCL-00085_0").prop('readonly',false);
		if($(this).val()){
			$.ajax({
				type: "POST",
				data: {reg_no: regNo},
				url: "/backoffice/infowizardtwo/subFormCompanyNameReservation/getBusinessName",
				success: function(result) {
					if(result){
						var data=result.split("-");
						$("#UK-FCL-00084_0").val(data[0]);
						$("#UK-FCL-00084_0").prop('readonly',true);
						$("#UK-FCL-00333_0").val(data[1]);
						$("#UK-FCL-00333_0").prop('readonly',true);
						$("#UK-FCL-00085_0").val(data[2]);
						$("#UK-FCL-00085_0").prop('readonly',true);
					}
				}
			});
		}
	});
	
	
	//Personal details 
	$("#div_UK-FCL-00001_0").show();
	$("#div_UK-FCL-00002_0").show();
	$("#div_UK-FCL-00003_0").show();
	$("#div_UK-FCL-00004_0").show();
	$("#div_UK-FCL-00005_0").show();
	$("#div_UK-FCL-00006_0").show();
	$("#div_UK-FCL-00007_0").show();
	$("#div_UK-FCL-00008_0").show();
	$("#div_UK-FCL-00010_0").show();
	$("#div_UK-FCL-00011_0").show();
	
	
	//Business details 
	$("#title_UK-FCL-00012_0").hide();
	$("#hr_UK-FCL-00012_0").hide();
	$("#div_UK-FCL-00012_0").hide();
	
	$("#div_UK-FCL-00031_0").hide();
	$("#div_UK-FCL-00032_0").hide();
	$("#div_UK-FCL-00013_0").hide();
	$("#div_UK-FCL-00014_0").hide();
	$("#div_UK-FCL-00015_0").hide();
	$("#div_UK-FCL-00484_0").hide();
	$("#div_UK-FCL-00485_0").hide();
	$("#div_UK-FCL-00016_0").hide();
	$("#div_UK-FCL-00017_0").hide();
	$("#div_UK-FCL-00018_0").hide();
	$("#div_UK-FCL-00244_0").hide();
	
	$("#div_UK-FCL-00019_0").hide();
	$("#div_UK-FCL-00020_0").hide();
	$("#div_UK-FCL-00021_0").hide();
	$("#div_UK-FCL-00022_0").hide();
	$("#div_UK-FCL-00023_0").hide();
	$("#div_UK-FCL-00033_0").hide();
	$("#div_UK-FCL-00027_0").hide();
	
	$("#title_UK-FCL-00056_0").hide();
	$("#hr_UK-FCL-00056_0").hide();
	$("#div_UK-FCL-00056_0").hide();
	$("#div_UK-FCL-00057_0").hide();
	$("#div_UK-FCL-00058_0").hide();
	$("#div_UK-FCL-00059_0").hide();
	$("#div_UK-FCL-00060_0").hide();
	$("#div_UK-FCL-00061_0").hide();
	$("#div_UK-FCL-00062_0").hide();
	$("#div_UK-FCL-00375_0").hide();
	$("#div_UK-FCL-00063_0").hide();
	
	
	//company details
	$("#title_UK-FCL-00028_0").hide();
	$("#hr_UK-FCL-00028_0").hide();
	$("#div_UK-FCL-00028_0").hide();
	$("#div_UK-FCL-00325_0").hide();
	$("#div_UK-FCL-00492_0").hide();
	
	//Society Details 
	$("#div_UK-FCL-00045_0").hide();
	$("#title_UK-FCL-00046_0").hide();
	$("#hr_UK-FCL-00046_0").hide();
	$("#div_UK-FCL-00046_0").hide();
	$("#div_UK-FCL-00047_0").hide();
	$("#div_UK-FCL-00048_0").hide();
	$("#div_UK-FCL-00049_0").hide();
	$("#div_UK-FCL-00050_0").hide();
	$("#div_UK-FCL-00051_0").hide();
	$("#div_UK-FCL-00052_0").hide();
	$("#div_UK-FCL-00053_0").hide();
	$("#div_UK-FCL-00054_0").hide();
	$("#div_UK-FCL-00055_0").hide();
	$("#div_UK-FCL-00326_0").hide();
	$("#div_UK-FCL-00475_0").hide();
	$("#div_UK-FCL-00486_0").hide();
	$("#div_UK-FCL-00487_0").hide();
	
	//Personal Details of Individual
	$("#title_UK-FCL-00375_0").hide();
	$("#hr_UK-FCL-00375_0").hide();
	$("#title_UK-FCL-00067_0").hide();
	$("#hr_UK-FCL-00067_0").hide();	
	$("#title_UK-FCL-00064_0").hide();
	$("#hr_UK-FCL-00064_0").hide();
	
	$("#title_UK-FCL-00085_0").hide();
	$("#hr_UK-FCL-00085_0").hide();
	$("#div_UK-FCL-00064_0").hide();
	$("#div_UK-FCL-00065_0").hide();
	$("#div_UK-FCL-00066_0").hide();
	$("#div_UK-FCL-00067_0").hide();
	$("#div_UK-FCL-00068_0").hide();
	$("#div_UK-FCL-00069_0").hide();
	$("#div_UK-FCL-00070_0").hide();
	$("#div_UK-FCL-00071_0").hide();
	$("#div_UK-FCL-00072_0").hide();
	$("#div_UK-FCL-00072_0").hide();
	$("#div_UK-FCL-00073_0").hide();
	$("#div_UK-FCL-00074_0").hide();
	$("#div_UK-FCL-00075_0").hide();
	$("#div_UK-FCL-00075_0").hide();
	$("#div_UK-FCL-00076_0").hide();
	$("#div_UK-FCL-00077_0").hide();
	$("#div_UK-FCL-00077_0").hide();
	$("#div_UK-FCL-00078_0").hide();
	$("#div_UK-FCL-00079_0").hide();
	$("#div_UK-FCL-00080_0").hide();
	$("#div_UK-FCL-00081_0").hide();
	$("#div_UK-FCL-00082_0").hide();
	$("#div_UK-FCL-00376_0").hide();
	$("#div_UK-FCL-00086_0").hide();
	$("#div_UK-FCL-00083_0").hide();
	$("#div_UK-FCL-00087_0").hide();
	$("#div_UK-FCL-00329_0").hide();
	$("#div_UK-FCL-00330_0").hide();
	
	
	//Coporate details
	$("#title_UK-FCL-00332_0").hide();
	$("#hr_UK-FCL-00332_0").hide();
	$("#div_UK-FCL-00246_0").hide();
	$("#div_UK-FCL-00084_0").hide();
	$("#div_UK-FCL-00085_0").hide();
	$("#div_UK-FCL-00332_0").hide();
	$("#div_UK-FCL-00333_0").hide();
	$("#div_UK-FCL-00247_0").hide();
	
	
	//by defalut non required society fields
	$("#UK-FCL-00375_0").prop('required', false);
	$("#UK-FCL-00046_0").prop('required',false);
	$("#UK-FCL-00047_0").prop('required',false);
	$("#UK-FCL-00048_0").prop('required',false);
	$("#UK-FCL-00049_0").prop('required',false);
	$("#UK-FCL-00050_0").prop('required',false);
	$("#UK-FCL-00051_0").prop('required',false);
	$("#UK-FCL-00052_0").prop('required',false);
	//$("#UK-FCL-00053_0").prop('required',false);
	$("#UK-FCL-00054_0").prop('required',false);
	$("#UK-FCL-00055_0").prop('required',false);
	
	$("#UK-FCL-00028_0").prop('required', false);
	$("#UK-FCL-00325_0").prop('required',false);
	$("#UK-FCL-00326_0").prop('required',false); 
	$("#UK-FCL-00014_0").prop('required', false);
	$("#UK-FCL-00484_0").prop('required', false);
	$("#UK-FCL-00485_0").prop('required', false);
	//$("#UK-FCL-00029_0").prop('required', false);
	
	$("#UK-FCL-00044_0").on('change',function(){
	
		var id = $(this).val();
		//Business details 
		$("#title_UK-FCL-00012_0").hide();
		$("#hr_UK-FCL-00012_0").hide();
		$("#div_UK-FCL-00012_0").hide();
		$("#div_UK-FCL-00031_0").hide();
		$("#div_UK-FCL-00032_0").hide();
		$("#div_UK-FCL-00013_0").hide();		
		$("#div_UK-FCL-00015_0").hide();
		$("#div_UK-FCL-00016_0").hide();
		$("#div_UK-FCL-00017_0").hide();
		$("#div_UK-FCL-00018_0").hide();
		$("#div_UK-FCL-00244_0").hide();
		$("#div_UK-FCL-00019_0").hide();
		$("#div_UK-FCL-00020_0").hide();
		$("#div_UK-FCL-00021_0").hide();
		$("#div_UK-FCL-00022_0").hide();
		$("#div_UK-FCL-00023_0").hide();
		$("#div_UK-FCL-00033_0").hide();
		$("#div_UK-FCL-00027_0").hide();
		
		$("#title_UK-FCL-00056_0").hide();
		$("#hr_UK-FCL-00056_0").hide();
		$("#div_UK-FCL-00056_0").hide();
		$("#div_UK-FCL-00057_0").hide();
		$("#div_UK-FCL-00058_0").hide();
		$("#div_UK-FCL-00059_0").hide();
		$("#div_UK-FCL-00060_0").hide();
		$("#div_UK-FCL-00061_0").hide();
		$("#div_UK-FCL-00062_0").hide();
		$("#div_UK-FCL-00375_0").hide();
		$("#div_UK-FCL-00063_0").hide();
		
		
		//company details
		$("#title_UK-FCL-00028_0").hide();
		$("#hr_UK-FCL-00028_0").hide();
		$("#div_UK-FCL-00028_0").hide();		
		$("#div_UK-FCL-00492_0").hide();
		//Society Details
		$("#div_UK-FCL-00045_0").hide();
		$("#title_UK-FCL-00046_0").hide();
		$("#hr_UK-FCL-00046_0").hide();
		$("#div_UK-FCL-00046_0").hide();
		$("#div_UK-FCL-00047_0").hide();
		$("#div_UK-FCL-00048_0").hide();
		$("#div_UK-FCL-00049_0").hide();
		$("#div_UK-FCL-00050_0").hide();
		$("#div_UK-FCL-00051_0").hide();
		$("#div_UK-FCL-00052_0").hide();
		$("#div_UK-FCL-00053_0").hide();
		$("#div_UK-FCL-00054_0").hide();
		$("#div_UK-FCL-00055_0").hide();		
		$("#div_UK-FCL-00475_0").hide();		
		$("#div_UK-FCL-00486_0").hide();		
		$("#div_UK-FCL-00487_0").hide();		
		
		//Personal Details of Individual
		$("#title_UK-FCL-00375_0").hide();
		$("#hr_UK-FCL-00375_0").hide();
		$("#title_UK-FCL-00067_0").hide();
		$("#hr_UK-FCL-00067_0").hide();
		$("#title_UK-FCL-00064_0").hide();
		$("#hr_UK-FCL-00064_0").hide();
		$("#div_UK-FCL-00064_0").hide();		
		$("#title_UK-FCL-00085_0").hide();
		$("#hr_UK-FCL-00085_0").hide();
		$("#div_UK-FCL-00065_0").hide();
		$("#div_UK-FCL-00066_0").hide();
		$("#div_UK-FCL-00067_0").hide();
		$("#div_UK-FCL-00068_0").hide();
		$("#div_UK-FCL-00069_0").hide();
		$("#div_UK-FCL-00070_0").hide();
		$("#div_UK-FCL-00071_0").hide();
		$("#div_UK-FCL-00072_0").hide();
		$("#div_UK-FCL-00072_0").hide();
		$("#div_UK-FCL-00073_0").hide();
		$("#div_UK-FCL-00074_0").hide();
		$("#div_UK-FCL-00075_0").hide();
		$("#div_UK-FCL-00075_0").hide();
		$("#div_UK-FCL-00076_0").hide();
		$("#div_UK-FCL-00077_0").hide();
		$("#div_UK-FCL-00077_0").hide();
		$("#div_UK-FCL-00078_0").hide();
		$("#div_UK-FCL-00079_0").hide();
		$("#div_UK-FCL-00080_0").hide();
		$("#div_UK-FCL-00081_0").hide();
		$("#div_UK-FCL-00082_0").hide();
		$("#div_UK-FCL-00376_0").hide();
		$("#div_UK-FCL-00086_0").hide();
		$("#div_UK-FCL-00083_0").hide();		
		$("#div_UK-FCL-00087_0").hide();
		$("#div_UK-FCL-00329_0").hide();
		$("#div_UK-FCL-00330_0").hide();
		
		//Corporate details
		$("#title_UK-FCL-00332_0").hide();
		$("#hr_UK-FCL-00332_0").hide();
		$("#div_UK-FCL-00246_0").hide();
		$("#div_UK-FCL-00084_0").hide();
		$("#div_UK-FCL-00085_0").hide();
		$("#div_UK-FCL-00332_0").hide();
		$("#div_UK-FCL-00333_0").hide();
		$("#div_UK-FCL-00247_0").hide();
		
		//by defalut non required society fields
		$("#UK-FCL-00046_0").prop('required',false);
		$("#UK-FCL-00047_0").prop('required',false);
		$("#UK-FCL-00048_0").prop('required',false);
		$("#UK-FCL-00049_0").prop('required',false);
		$("#UK-FCL-00050_0").prop('required',false);
		$("#UK-FCL-00051_0").prop('required',false);
		$("#UK-FCL-00052_0").prop('required',false);
		//$("#UK-FCL-00053_0").prop('required',false);
		$("#UK-FCL-00054_0").prop('required',false);
		$("#UK-FCL-00055_0").prop('required',false);
		
		//by defalut business name by individual 
		$("#UK-FCL-00056_0").prop('required',false);
		$("#UK-FCL-00057_0").prop('required',false);
		$("#UK-FCL-00058_0").prop('required',false);
		$("#UK-FCL-00059_0").prop('required',false);
		$("#UK-FCL-00060_0").prop('required',false);
		$("#UK-FCL-00061_0").prop('required',false);
		$("#UK-FCL-00062_0").prop('required',false);
		$("#UK-FCL-00329_0").prop('required',false);
		$("#UK-FCL-00330_0").prop('required',false);
		
		$("#UK-FCL-00028_0").prop('required',false);
		$("#UK-FCL-00375_0").prop('required',false);		
		$("#UK-FCL-00475_0").prop('required',false);
		$("#UK-FCL-00486_0").prop('required',false);
		$("#UK-FCL-00487_0").prop('required',false);
		
		if(id==1){
			//consoloe.log("dsfsdfsdfdsf");
			// 1 for society			
			//Society Details 
			$("#title_UK-FCL-00046_0").show();
			$("#hr_UK-FCL-00046_0").show();
			$("#div_UK-FCL-00046_0").show();
			$("#div_UK-FCL-00047_0").show();
			$("#div_UK-FCL-00048_0").show();
			$("#div_UK-FCL-00049_0").show();
			$("#div_UK-FCL-00050_0").show();
			$("#div_UK-FCL-00051_0").show();
			$("#div_UK-FCL-00052_0").show();
			$("#div_UK-FCL-00053_0").show();
			$("#div_UK-FCL-00054_0").show();
			$("#div_UK-FCL-00055_0").show();
			$("#div_UK-FCL-00045_0").show();
			$("#div_UK-FCL-00014_0").hide();
			$("#div_UK-FCL-00484_0").hide();
			$("#div_UK-FCL-00485_0").hide();
			
			$("#div_UK-FCL-00475_0").show();
			$("#div_UK-FCL-00486_0").show();
			$("#div_UK-FCL-00487_0").show();
			
			$("#UK-FCL-00046_0").prop('required',true);
			$("#UK-FCL-00047_0").prop('required',true);
			$("#UK-FCL-00048_0").prop('required',true);
			$("#UK-FCL-00049_0").prop('required',true);
			$("#UK-FCL-00050_0").prop('required',true);
			$("#UK-FCL-00051_0").prop('required',true);
			$("#UK-FCL-00052_0").prop('required',true);			
			$("#UK-FCL-00054_0").prop('required',true);
			$("#UK-FCL-00055_0").prop('required',true); 
			$("#UK-FCL-00475_0").prop('required',true); 
			$("#UK-FCL-00486_0").prop('required',true); 
			$("#UK-FCL-00487_0").prop('required',true); 
			
			
		}else if(id==2){
		
			// 2 for company
			//Business details show
			$("#title_UK-FCL-00012_0").show();
			$("#hr_UK-FCL-00012_0").show();
			$("#div_UK-FCL-00012_0").show();
			$("#div_UK-FCL-00027_0").show();
			
			$("#UK-FCL-00012_0").prop('required', true);
			$("#UK-FCL-00027_0").prop('required', true);
		}
		else if(id==3){
			// 3 for Business Name by Individual
			//Business details show
			/* $("#title_UK-FCL-00012_0").show();
			$("#hr_UK-FCL-00012_0").show(); */
			$("#title_UK-FCL-00375_0").append('<span style="color:red;">Please enter the Number of Individuals and the Number of Corporate Partners if applicable and click on "+Save Detail(s) to add the details.</span><br/>');
			
			$("#title_UK-FCL-00375_0").show();
			$("#hr_UK-FCL-00375_0").show();
			$("#title_UK-FCL-00056_0").show();
			$("#hr_UK-FCL-00056_0").show();
			$("#title_UK-FCL-00064_0").show();
			$("#hr_UK-FCL-00064_0").show();
			$("#title_UK-FCL-00085_0").show();
			$("#hr_UK-FCL-00085_0").show();
			$("#div_UK-FCL-00056_0").show();
			$("#div_UK-FCL-00057_0").show();
			$("#div_UK-FCL-00058_0").show();
			$("#div_UK-FCL-00059_0").show();
			$("#div_UK-FCL-00060_0").show();
			$("#div_UK-FCL-00061_0").show();
			$("#div_UK-FCL-00062_0").show();
			$("#div_UK-FCL-00063_0").show();
			$("#div_UK-FCL-00375_0").show();
			$("#div_UK-FCL-00014_0").hide();
			$("#div_UK-FCL-00484_0").hide();
			$("#div_UK-FCL-00485_0").hide();
			
			$("#UK-FCL-00056_0").prop('required',true);
			$("#UK-FCL-00057_0").prop('required',true);
			$("#UK-FCL-00058_0").prop('required',true);
			$("#UK-FCL-00059_0").prop('required',true);
			$("#UK-FCL-00060_0").prop('required',true);
			//$("#UK-FCL-00061_0").prop('required',true);
			$("#UK-FCL-00062_0").prop('required',true);
			$("#UK-FCL-00063_0").prop('required',true);
			$("#UK-FCL-00375_0").prop('required',true);
			
			//Personal Details of Individual
			$("#title_UK-FCL-00067_0").show();
			$("#hr_UK-FCL-00067_0").show();			
			$("#div_UK-FCL-00064_0").show();
			$("#div_UK-FCL-00065_0").show();
			$("#div_UK-FCL-00066_0").show();
			$("#div_UK-FCL-00067_0").show();
			$("#div_UK-FCL-00068_0").show();
			$("#div_UK-FCL-00069_0").show();
			$("#div_UK-FCL-00070_0").show();
			$("#div_UK-FCL-00071_0").show();
			$("#div_UK-FCL-00072_0").show();
			$("#div_UK-FCL-00072_0").show();
			$("#div_UK-FCL-00073_0").show();
			$("#div_UK-FCL-00074_0").show();
			$("#div_UK-FCL-00075_0").show();
			$("#div_UK-FCL-00075_0").show();
			$("#div_UK-FCL-00076_0").show();
			$("#div_UK-FCL-00077_0").show();
			$("#div_UK-FCL-00077_0").show();
			$("#div_UK-FCL-00078_0").show();
			$("#div_UK-FCL-00079_0").show();
			$("#div_UK-FCL-00080_0").show();
			$("#div_UK-FCL-00081_0").show();
			$("#div_UK-FCL-00082_0").show();
			$("#div_UK-FCL-00376_0").show();
			$("#div_UK-FCL-00086_0").show();
			$("#div_UK-FCL-00083_0").show();
			$("#div_UK-FCL-00087_0").show();
			$("#div_UK-FCL-00329_0").show();
			$("#div_UK-FCL-00330_0").show();
			$("#div_UK-FCL-00325_0").hide();
			$("#div_UK-FCL-00326_0").hide();
			
		}
	});
	
	$("#UK-FCL-00031_0").on('change',function(){
		$("#div_UK-FCL-00028_0").hide();
		$("#UK-FCL-00028_0").prop('required', false);
		$("#div_UK-FCL-00029_0").hide();		
		if($(this).val()==1 || $(this).val()==2){
			$("#div_UK-FCL-00028_0").show();
			//$("#div_UK-FCL-00029_0").show();
			$("#UK-FCL-00028_0").prop('required', true);
			
			if($(this).val()==1){
				$("#UK-FCL-00029_0").select2("val",2);
				$('#UK-FCL-00029_0').select2('readonly', true);
			}			
			if($(this).val()==2){
				$("#UK-FCL-00029_0").select2("val",1);
				$('#UK-FCL-00029_0').select2('readonly', true);
			}
			
		}
	});	
	
	$("#UK-FCL-00492_0").on('change',function(){
		$("#div_UK-FCL-00028_0").hide();
		$("#UK-FCL-00028_0").prop('required', false);
		$("#div_UK-FCL-00029_0").hide();
		
		$('#UK-FCL-00029_0').select2('readonly', false);
		if($(this).val()==1){
			if($(this).val()==1){
				$("#UK-FCL-00029_0").select2("val",2);
				$('#UK-FCL-00029_0').select2('readonly', true);
			}	
			$("#div_UK-FCL-00028_0").show();
			$("#UK-FCL-00028_0").prop('required', true);
		}
	});	
	
	$("#UK-FCL-00246_0").prop('required',false);
	$("#UK-FCL-00375_0").on('change',function(){
		//Corporate Details
		$("#title_UK-FCL-00332_0").hide();
		$("#hr_UK-FCL-00332_0").hide();
		$("#div_UK-FCL-00246_0").hide();		
		if($(this).val()==2)
		{
			//Corporate Details
			$("#title_UK-FCL-00332_0").show();
			$("#hr_UK-FCL-00332_0").show();
			$("#div_UK-FCL-00246_0").show();			
		}		
	});
	
	$("#div_UK-FCL-00084_0").hide();
	$("#div_UK-FCL-00332_0").hide();
	$("#div_UK-FCL-00333_0").hide();
	$("#div_UK-FCL-00085_0").hide();
	$("#div_UK-FCL-00247_0").hide();
	$("#UK-FCL-00246_0").on('change',function(){
		$("#div_UK-FCL-00084_0").hide();
		$("#div_UK-FCL-00332_0").hide();
		$("#div_UK-FCL-00333_0").hide();
		$("#div_UK-FCL-00085_0").hide();
		$("#div_UK-FCL-00247_0").hide();
		if($(this).val()!='')
		{
			$("#div_UK-FCL-00084_0").show();
			$("#div_UK-FCL-00332_0").show();
			$("#div_UK-FCL-00333_0").show();
			$("#div_UK-FCL-00085_0").show();
			$("#div_UK-FCL-00247_0").show();	
		}	
	});
	
	//In case of company
	$("#div_UK-FCL-00325_0").hide();
	$("#UK-FCL-00325_0").prop('required', false);
	$("#UK-FCL-00027_0").on('change',function(){
		$("#div_UK-FCL-00325_0").hide();
		$("#UK-FCL-00325_0").prop('required', false);
		if(($("#UK-FCL-00044_0").val()=='2') && ($(this).val()=='2' || $(this).val()=='3')){
			$("#div_UK-FCL-00325_0").show();
			$("#UK-FCL-00325_0").prop('required', true);
		}	
	});
	
	//In case of society 
	$("#div_UK-FCL-00326_0").hide();
	$("#UK-FCL-00326_0").prop('required', false);
	$("#UK-FCL-00051_0").on('change',function(){
		$("#div_UK-FCL-00326_0").hide();
		$("#UK-FCL-00326_0").prop('required', false);
		if(($("#UK-FCL-00044_0").val()=='1') && ($(this).val()=='2' || $(this).val()=='3')){
			$("#div_UK-FCL-00326_0").show();
			$("#UK-FCL-00326_0").prop('required', true);
		}	
	});
	
	//for in case of company some show hide fields=============================================================
	$("#UK-FCL-00031_0").prop('required', false);
	$("#UK-FCL-00013_0").prop('required', false);
	$("#UK-FCL-00014_0").prop('required', false);
	$("#UK-FCL-00484_0").prop('required', false);
	$("#UK-FCL-00485_0").prop('required', false);
	$("#UK-FCL-00015_0").prop('required', false);
	$("#UK-FCL-00016_0").prop('required', false);
	$("#UK-FCL-00017_0").prop('required', false);
	$("#UK-FCL-00018_0").prop('required', false);
	$("#UK-FCL-00244_0").prop('required', false);
	
	$("#UK-FCL-00032_0").prop('required', false);
	$("#UK-FCL-00019_0").prop('required', false);
	$("#UK-FCL-00020_0").prop('required', false);
	$("#UK-FCL-00492_0").prop('required', false);
	
	
	
	//Existing Company
	$('#UK-FCL-00012_0').on('change', function() {
		//New Company
		$("#div_UK-FCL-00031_0").hide();
		$("#div_UK-FCL-00013_0").hide();
		$("#div_UK-FCL-00014_0").hide();
		$("#div_UK-FCL-00484_0").hide();
		$("#div_UK-FCL-00485_0").hide();
		$("#div_UK-FCL-00015_0").hide();
		$("#div_UK-FCL-00016_0").hide();
		$("#div_UK-FCL-00017_0").hide();
		$("#div_UK-FCL-00018_0").hide();
		$("#div_UK-FCL-00244_0").hide();
		$("#div_UK-FCL-00492_0").hide();
		//New Company
		//Existing Company
		$("#div_UK-FCL-00032_0").hide();
		$("#div_UK-FCL-00019_0").hide();
		$("#div_UK-FCL-00020_0").hide();
		/* $("#div_UK-FCL-00021_0").hide();
		$("#div_UK-FCL-00033_0").hide();
		$("#div_UK-FCL-00022_0").hide(); */
		
		$("#div_UK-FCL-00026_0").hide(); 
		//Existing Company
        var id = $(this).val();
		//alert(id);
		if(id=='Name reservation for new Company')
		{	
			//New Company
			$("#div_UK-FCL-00031_0").show();
			$("#div_UK-FCL-00013_0").show();
			$("#div_UK-FCL-00014_0").show();
			$("#div_UK-FCL-00484_0").show();
			$("#div_UK-FCL-00485_0").show();
			$("#div_UK-FCL-00015_0").show();
			$("#div_UK-FCL-00016_0").show();
			$("#div_UK-FCL-00017_0").show();
			$("#div_UK-FCL-00018_0").show();
			$("#div_UK-FCL-00244_0").show();			
			//New Company
						
			$("#UK-FCL-00031_0").prop('required', true);
			$("#UK-FCL-00013_0").prop('required', true);
			$("#UK-FCL-00014_0").prop('required', true);
			$("#UK-FCL-00484_0").prop('required', true);
			$("#UK-FCL-00485_0").prop('required', true);
			$("#UK-FCL-00015_0").prop('required', true);
			$("#UK-FCL-00016_0").prop('required', true);
			$("#UK-FCL-00017_0").prop('required', true);
			$("#UK-FCL-00018_0").prop('required', true);
			$("#UK-FCL-00244_0").prop('required', true);
			
			
		}
		if(id=='Name change of existing company')
		{
			//Existing Company
			$("#div_UK-FCL-00032_0").show();
			$("#div_UK-FCL-00019_0").show();
			$("#div_UK-FCL-00020_0").show();
			
			
			$("#div_UK-FCL-00013_0").show();
			$("#div_UK-FCL-00014_0").show();
			$("#div_UK-FCL-00484_0").show();
			$("#div_UK-FCL-00485_0").show();
			$("#div_UK-FCL-00015_0").show();
			$("#div_UK-FCL-00016_0").show();
			$("#div_UK-FCL-00017_0").show();
			$("#div_UK-FCL-00018_0").show();
			$("#div_UK-FCL-00244_0").show();
			$("#div_UK-FCL-00492_0").show();
			
			$("#div_UK-FCL-00028_0").hide();
			$("#div_UK-FCL-00029_0").hide();
		
			$("#UK-FCL-00032_0").prop('required', true);
			$("#UK-FCL-00019_0").prop('required', true);
			$("#UK-FCL-00020_0").prop('required', true);
			//
			$("#UK-FCL-00013_0").prop('required', true);
			$("#UK-FCL-00014_0").prop('required', true);
			$("#UK-FCL-00484_0").prop('required', true);
			$("#UK-FCL-00485_0").prop('required', true);
			$("#UK-FCL-00015_0").prop('required', true);
			$("#UK-FCL-00016_0").prop('required', true);
			$("#UK-FCL-00017_0").prop('required', true);
			$("#UK-FCL-00018_0").prop('required', true);
			$("#UK-FCL-00244_0").prop('required', true);
			$("#UK-FCL-00492_0").prop('required', true);
			
		}
	}); 
	
	
	$("#UK-FCL-00021_0").prop('required', false);
	$("#UK-FCL-00033_0").prop('required', false);
	$("#UK-FCL-00022_0").prop('required', false); 
	$("#div_UK-FCL-00021_0").hide();
	$("#div_UK-FCL-00033_0").hide();
	$("#div_UK-FCL-00022_0").hide();
	$("#div_UK-FCL-00023_0").hide();
	//Name Change of Existing Company
	$("#UK-FCL-00032_0").on('change',function(){
		/* $("#UK-FCL-00013_0").css('pointer-events','');
		$("#UK-FCL-00013_0").css('background-color','');
		$('#UK-FCL-00013_0').select2('readonly', false);
		
		$("#UK-FCL-00014_0").css('pointer-events','');
		$("#UK-FCL-00014_0").css('background-color','');
		$('#UK-FCL-00014_0').select2('readonly', false);
		
		$("#UK-FCL-00484_0").css('pointer-events','');
		$("#UK-FCL-00484_0").css('background-color','');
		$('#UK-FCL-00484_0').select2('readonly', false);
		
		$("#UK-FCL-00485_0").css('pointer-events','');
		$("#UK-FCL-00485_0").css('background-color','');
		$('#UK-FCL-00485_0').select2('readonly', false); */
			
		var idNameChangeExisCom = $(this).val();
		$("#UK-FCL-00021_0").prop('required', false);
		$("#UK-FCL-00033_0").prop('required', false);
		$("#UK-FCL-00022_0").prop('required', false); 
		$("#div_UK-FCL-00021_0").hide();
		$("#div_UK-FCL-00033_0").hide();
		$("#div_UK-FCL-00022_0").hide();
		$("#div_UK-FCL-00023_0").hide();
		if(idNameChangeExisCom==1){			
			$("#div_UK-FCL-00021_0").show();
			$("#div_UK-FCL-00033_0").show();
			$("#div_UK-FCL-00022_0").show();
			$("#div_UK-FCL-00023_0").show();
			$("#UK-FCL-00021_0").prop('required', true);
			
		}
	});	
	
	
	$("#UK-FCL-00029_0").prop('required', false);
	$("#div_UK-FCL-00029_0").hide();	
	
	$("#UK-FCL-00013_0").css('pointer-events','');
	$("#UK-FCL-00013_0").css('background-color','');
	$('#UK-FCL-00013_0').select2('readonly', false);
	
	$("#UK-FCL-00014_0").css('pointer-events','');
	$("#UK-FCL-00014_0").css('background-color','');
	$('#UK-FCL-00014_0').select2('readonly', false);
	
	$("#UK-FCL-00484_0").css('pointer-events','');
	$("#UK-FCL-00484_0").css('background-color','');
	$('#UK-FCL-00484_0').select2('readonly', false);
	
	$("#UK-FCL-00485_0").css('pointer-events','');
	$("#UK-FCL-00485_0").css('background-color','');
	$('#UK-FCL-00485_0').select2('readonly', false);
	
	$("#UK-FCL-00028_0").on('change',function(){
		var seekingExem = $(this).val();
		$("#div_UK-FCL-00029_0").hide();
		$("#UK-FCL-00029_0").prop('required', false);
		
		$("#UK-FCL-00013_0").css('pointer-events','');
		$("#UK-FCL-00013_0").css('background-color','');
		$('#UK-FCL-00013_0').select2('readonly', false);
		
		$("#UK-FCL-00014_0").css('pointer-events','');
		$("#UK-FCL-00014_0").css('background-color','');
		$('#UK-FCL-00014_0').select2('readonly', false);
		
		$("#UK-FCL-00484_0").css('pointer-events','');
		$("#UK-FCL-00484_0").css('background-color','');
		$('#UK-FCL-00484_0').select2('readonly', false);
		
		$("#UK-FCL-00485_0").css('pointer-events','');
		$("#UK-FCL-00485_0").css('background-color','');
		$('#UK-FCL-00485_0').select2('readonly', false);
				
		$("#UK-FCL-00013_0").prop('required', true);
		$("#UK-FCL-00014_0").prop('required', true);
		$("#UK-FCL-00484_0").prop('required', true);
		$("#UK-FCL-00485_0").prop('required', true);
		
		
		if(seekingExem=='Yes')
		{
			$("#div_UK-FCL-00029_0").show();
			$("#UK-FCL-00029_0").prop('required', true);
			
			
			$("#UK-FCL-00013_0").select2("val", "");
			$('#UK-FCL-00013_0').select2('readonly', true);
			$("#UK-FCL-00013_0").css('pointer-events','none');
			$("#UK-FCL-00013_0").css('background-color','#EEF1F5');
			
			$("#UK-FCL-00014_0").select2("val", "");
			$('#UK-FCL-00014_0').select2('readonly', true);
			$("#UK-FCL-00014_0").css('pointer-events','none');
			$("#UK-FCL-00014_0").css('background-color','#EEF1F5');
			
			$("#UK-FCL-00484_0").select2("val", "");
			$('#UK-FCL-00484_0').select2('readonly', true);
			$("#UK-FCL-00484_0").css('pointer-events','none');
			$("#UK-FCL-00484_0").css('background-color','#EEF1F5');
			
			$("#UK-FCL-00485_0").select2("val", "");
			$('#UK-FCL-00485_0').select2('readonly', true);
			$("#UK-FCL-00485_0").css('pointer-events','none');
			$("#UK-FCL-00485_0").css('background-color','#EEF1F5');
						
			$("#UK-FCL-00013_0").prop('required', false);
			$("#UK-FCL-00014_0").prop('required', false);
			$("#UK-FCL-00484_0").prop('required', false);
			$("#UK-FCL-00485_0").prop('required', false);
			
			
		}		
	});
	///////////////////////////////For comapny fields/////////////////////////////////////////////////////////
	
	
	//Name Reservation for New Company	
	$("#UK-FCL-00031_0").on('change',function(){
		var id = $(this).val();		
		//$("#UK-FCL-00013_0").select2("val", "1");
		$('#UK-FCL-00013_0').select2('readonly', false);
		$("#UK-FCL-00013_0").css('pointer-events','');
		$("#UK-FCL-00013_0").css('background-color','');
		$("#UK-FCL-00013_0").change();	
		if(id==3){			
			$("#UK-FCL-00013_0").select2("val", "1");
			$('#UK-FCL-00013_0').select2('readonly', true);
			$("#UK-FCL-00013_0").css('pointer-events','none');
			$("#UK-FCL-00013_0").css('background-color','#EEF1F5');
			$("#UK-FCL-00013_0").change();			
		}
	});
	
	
	//In case of existing company
	$("#UK-FCL-00492_0").on('change',function(){
		var id = $(this).val();		
		$('#UK-FCL-00013_0').select2('readonly', false);
		$("#UK-FCL-00013_0").css('pointer-events','');
		$("#UK-FCL-00013_0").css('background-color','');
		$("#UK-FCL-00013_0").change();	
		if(id==2){			
			$("#UK-FCL-00013_0").select2("val", "1");
			$('#UK-FCL-00013_0').select2('readonly', true);
			$("#UK-FCL-00013_0").css('pointer-events','none');
			$("#UK-FCL-00013_0").css('background-color','#EEF1F5');
			$("#UK-FCL-00013_0").change();			
		}
	});
	
	
	$("#UK-FCL-00015_0,#UK-FCL-00016_0,#UK-FCL-00017_0,#UK-FCL-00046_0,#UK-FCL-00047_0,#UK-FCL-00048_0,#UK-FCL-00056_0").keypress(function(e){
		var keyCode = e.which;	 
		//console.log(keyCode);
		$(".proposedName").remove();
		if((keyCode == 33) || (keyCode == 64) || (keyCode == 35) || (keyCode == 36) || (keyCode == 37) || (keyCode == 94) || (keyCode== 42)  || (keyCode== 43) || (keyCode== 126) || (keyCode== 96) || (keyCode== 60) || (keyCode== 61) || (keyCode== 62) || (keyCode== 63) || (keyCode== 123) || (keyCode== 125) || (keyCode== 91) || (keyCode== 93) || (keyCode== 95))
		{
			var id = $(this).attr('id');
			$("#div_"+id).append("<div id="+id+"'-error' class='form-control-feedback-error proposedName' style='color:red; margin-left:1em;'>Only following spcial characters are allowed in propsoed name (),.&:;-</div>");			
			e.preventDefault();		
		}	
	});
	
	$('#UK-FCL-00007_0').select2('readonly', true); 
	$('#UK-FCL-00008_0').select2('readonly', true);
	
	$('#m_form input').on('blur',function(){
		var fieldID = $(this).attr('id');
		
	});  
	
	$("#UK-FCL-00053_0").on('change',function(){
		var valSociety = $(this).val();
		$("#div_UK-FCL-00054_0").hide();
		$("#div_UK-FCL-00055_0").hide();
		$("#UK-FCL-00054_0").prop('required', false);
		$("#UK-FCL-00055_0").prop('required', false);
		if(valSociety=='2')
		{
			$("#div_UK-FCL-00054_0").show();
			$("#div_UK-FCL-00055_0").show();
			$("#UK-FCL-00054_0").prop('required', true);
			$("#UK-FCL-00055_0").prop('required', true);
		}
	});
	
	$('#UK-FCL-00063_0').keyup(function () { 
		this.value = this.value.replace(/[^0-9]/g, '');
	});
	
	
	$("#UK-FCL-00077_0").on('change',function () {
		$("#UK-FCL-00079_0").select2("val",$(this).val());
		$("#UK-FCL-00079_0").change();
		$('#UK-FCL-00079_0').select2('readonly', true);
		$("#s2id_UK-FCL-00079_0").css('pointer-events','none');
		$("#s2id_UK-FCL-00079_0").css('background-color','#EEF1F5');
	});
	
	$("#UK-FCL-00375_0").on("change",function(){		
		$("#UK-FCL-00063_0-error").remove();	
		$("#UK-FCL-00063_0").select2('val','');
		$('#UK-FCL-00063_0').select2('readonly', false);
		$("#s2id_UK-FCL-00063_0").css('pointer-events','');
		$("#s2id_UK-FCL-00063_0").css('background-color','');
		$("#UK-FCL-00063_0").css('pointer-events','');
		$("#UK-FCL-00063_0").css('background-color','');	
		//alert($(this).val());
		if($(this).val() == 1){		
			$("#UK-FCL-00063_0").val(1);
			$("#UK-FCL-00063_0").select2('val',1);
			$('#UK-FCL-00063_0').select2('readonly', true);
			$("#s2id_UK-FCL-00063_0").css('pointer-events','none');
			$("#s2id_UK-FCL-00063_0").css('background-color','#EEF1F5');
			$("#UK-FCL-00063_0").css('pointer-events','none');
			$("#UK-FCL-00063_0").css('background-color','#EEF1F5');			
			//$("#input_UK-FCL-00063_0").append('<div id="UK-FCL-00063_0-error" class="form-control-feedback">No. of individual should be 1 in case of Individual registration.</div>');			
		}
		/* if($(this).val() == 2 && $("#UK-FCL-00063_0").val() < 2){			
						
		} */
	});
	
	//Society
	$("#UK-FCL-00049_0").on('change',function(){
		var idBusinesstypeSociArr = $(this).val();
		$("#div_UK-FCL-00497_0").hide();
		$("#UK-FCL-00497_0").prop('required',false);
		if(jQuery.inArray("165", idBusinesstypeSociArr) !== -1) {
			$("#div_UK-FCL-00497_0").show();
			$("#UK-FCL-00497_0").prop('required',true);			
		}		
	});
	
	//Company
	$("#UK-FCL-00018_0").on('change',function(){
		var idBusinesstypeCompArr = $(this).val();
		$("#div_UK-FCL-00498_0").hide();
		$("#UK-FCL-00498_0").prop('required',false);
		if(jQuery.inArray("165", idBusinesstypeCompArr) !== -1) {
			$("#div_UK-FCL-00498_0").show();
			$("#UK-FCL-00498_0").prop('required',true);			
		}		
	});
	
	
	//Business
	$("#UK-FCL-00057_0").on('change',function(){
		var idBusinesstypeBusArr = $(this).val();
		$("#div_UK-FCL-00499_0").hide();
		$("#UK-FCL-00499_0").prop('required',false);
		if(jQuery.inArray("165", idBusinesstypeBusArr) !== -1) {
			$("#div_UK-FCL-00499_0").show();
			$("#UK-FCL-00499_0").prop('required',true);			
		}		
	});
	
	<?php if(isset($_GET['app_Sub_id']) && !empty($_GET['app_Sub_id'])) { ?>
	
		$("#UK-FCL-00007_0").change();
		$("#UK-FCL-00013_0").change();		
		$("#UK-FCL-00059_0").change();
		$('#UK-FCL-00079_0').change();
		$('#UK-FCL-00044_0').change();		
		$('#UK-FCL-00012_0').change();
		$('#UK-FCL-00068_0').change();
		$('#UK-FCL-00032_0').change();
		$("#UK-FCL-00027_0").change();
		$("#UK-FCL-00051_0").change();
		$("#UK-FCL-00031_0").change();
		$("#UK-FCL-00060_0").change();
		$("#UK-FCL-00053_0").change();
		$("#UK-FCL-00375_0").change();
		$("#UK-FCL-00049_0").change();
		$("#UK-FCL-00018_0").change();
		$("#UK-FCL-00057_0").change();
		
	<?php } ?>
	
});

$(window).on('load',function() 
{	

	<?php if(isset($_GET['subID']) && !empty($_GET['subID'])) { ?>
	
		//$("#UK-FCL-00007_0").change();
		$("#UK-FCL-00013_0").change();		
		$("#UK-FCL-00059_0").change();
		$('#UK-FCL-00079_0').change();
		$('#UK-FCL-00044_0').change();		
		$('#UK-FCL-00012_0').change();
		$('#UK-FCL-00068_0').change();
		$('#UK-FCL-00032_0').change();
		$("#UK-FCL-00027_0").change();
		$("#UK-FCL-00051_0").change();
		$("#UK-FCL-00031_0").change();
		$("#UK-FCL-00060_0").change();
		$("#UK-FCL-00053_0").change();
		$("#UK-FCL-00375_0").change();
		$("#UK-FCL-00049_0").change();
		$("#UK-FCL-00018_0").change();
		$("#UK-FCL-00057_0").change();
	<?php } ?>
	
	//get state according to country in individual business details
	<?php if(!isset($_GET['subID']) && empty($_GET['subID'])) { ?>
		$.ajax({
			type: "POST",
			url: "/backoffice/iloc/property/getStateByCountryID/countryCode/829",
			success: function(result) {
				$("#UK-FCL-00060_0").html(result);			
			}
		}); 
	<?php } ?>
	<?php
	/*  echo "<pre>";
	print_r($_SESSION['RESPONSE']);die; */
	if (isset($_SESSION['RESPONSE']) && !empty($_SESSION['RESPONSE'])) {
		$iuid = $_SESSION['RESPONSE']['iuid'];
		$email = $_SESSION['RESPONSE']['email'];
		$first_name = $_SESSION['RESPONSE']['first_name'];
		$last_name = $_SESSION['RESPONSE']['last_name'];
		$surname = $_SESSION['RESPONSE']['surname'];
		$mobile_number = $_SESSION['RESPONSE']['mobile_number'];
		$country_name = $_SESSION['RESPONSE']['country_name'];
		$country_name = $_SESSION['RESPONSE']['country_name'];
		$state_name = $_SESSION['RESPONSE']['state_name'];
		$city_name = $_SESSION['RESPONSE']['city_name'];
		$address = $_SESSION['RESPONSE']['address'];
		$address2 = $_SESSION['RESPONSE']['address2'];
		$pin_code = $_SESSION['RESPONSE']['pin_code'];
	?>
		$('#UK-FCL-00001_0').val('<?php echo @$iuid; ?>');
		$('#UK-FCL-00001_0').attr('readonly', true);
		$('#UK-FCL-00002_0').val('<?php echo @$first_name; ?>');
		$('#UK-FCL-00002_0').attr('readonly', true);
		$('#UK-FCL-00003_0').val('<?php echo @$last_name; ?>');
		$('#UK-FCL-00003_0').attr('readonly', true);
		$('#UK-FCL-00260_0').val('<?php echo @$surname; ?>');
		$('#UK-FCL-00260_0').attr('readonly', true);
		$('#UK-FCL-00005_0').val('<?php echo @$mobile_number; ?>');
		$('#UK-FCL-00005_0').attr('readonly', true);
		$('#UK-FCL-00006_0').val('<?php echo @$email; ?>');
		$('#UK-FCL-00006_0').attr('readonly', true); 
		
		$("#UK-FCL-00007_0").val("<?php echo @$country_name; ?>");
		$("#UK-FCL-00007_0").select2("val", "<?php echo @$country_name; ?>");
		//$("#UK-FCL-00007_0").change();
		$('#UK-FCL-00007_0').select2('readonly', true);
		$("#s2id_UK-FCL-00007_0").css('pointer-events','none');
		$("#s2id_UK-FCL-00007_0").css('background-color','#EEF1F5');
		$("#UK-FCL-00007_0").css('pointer-events','none');
		$("#UK-FCL-00007_0").css('background-color','#EEF1F5');
		
		$("#UK-FCL-00008_0").val("<?php echo @$state_name; ?>");
		$("#UK-FCL-00008_0").select2("val", "<?php echo @$state_name; ?>");			
		$('#UK-FCL-00008_0').select2('readonly', true);
		$("#s2id_UK-FCL-00008_0").css('pointer-events','none');
		$("#s2id_UK-FCL-00008_0").css('background-color','#EEF1F5');
		$("#UK-FCL-00008_0").css('pointer-events','none');
		$("#UK-FCL-00008_0").css('background-color','#EEF1F5');
		
		$('#UK-FCL-00010_0').val('<?php echo @$city_name; ?>');
		$('#UK-FCL-00010_0').attr('readonly', true); 
		$('#UK-FCL-00011_0').val("<?php echo $address; ?>");
		$('#UK-FCL-00011_0').attr('readonly', true); 
		$('#UK-FCL-00327_0').val("<?php echo $address2; ?>");
		$('#UK-FCL-00327_0').attr('readonly', true); 
		$('#UK-FCL-00328_0').val("<?php echo $pin_code; ?>");
		$('#UK-FCL-00328_0').attr('readonly', true);
	<?php
	}
	?>	
	//barbados selected
	$("#UK-FCL-00059_0").val("829");
	$("#UK-FCL-00059_0").select2("val", "829");			
	$('#UK-FCL-00059_0').select2('readonly', true);
	$("#s2id_UK-FCL-00059_0").css('pointer-events','none');
	$("#s2id_UK-FCL-00059_0").css('background-color','#EEF1F5');
	$("#UK-FCL-00059_0").css('pointer-events','none');
	$("#UK-FCL-00059_0").css('background-color','#EEF1F5');
	
	//for society
	//$("#label_UK-FCL-00045_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00046_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00047_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00048_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00049_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00050_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00051_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00052_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00054_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00055_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00325_0").find('b').after('<span style="color:red;">* </span>');
	
	//for company
	$("#label_UK-FCL-00056_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00057_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00058_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00059_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00060_0").find('b').after('<span style="color:red;">* </span>');
	//$("#label_UK-FCL-00061_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00062_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00063_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00375_0").find('b').after('<span style="color:red;">* </span>');
	//$("#label_UK-FCL-00246_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00326_0").find('b').after('<span style="color:red;">* </span>');
	//new Company
	$("#label_UK-FCL-00012_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00027_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00031_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00013_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00014_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00484_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00485_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00015_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00016_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00017_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00018_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00244_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00028_0").find('b').after('<span style="color:red;">* </span>');
	
	//Existing company
	$("#label_UK-FCL-00032_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00019_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00020_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00021_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00022_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00023_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00029_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00492_0").find('b').after('<span style="color:red;">* </span>');
	
	
	
	//individual details
	$("#label_UK-FCL-00064_0").find('b').after('<span style="color:red;">* </span>');
	//$("#label_UK-FCL-00065_0").find('b').after('<span style="color:red;">* </span>');
	//$("#label_UK-FCL-00066_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00067_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00068_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00069_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00070_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00071_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00072_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00073_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00074_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00075_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00076_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00077_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00078_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00079_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00080_0").find('b').after('<span style="color:red;">* </span>');
	//$("#label_UK-FCL-00081_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00082_0").find('b').after('<span style="color:red;">* </span>');
	//$("#label_UK-FCL-00376_0").find('b').after('<span style="color:red;">* </span>');
	//$("#label_UK-FCL-00086_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00083_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00084_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00085_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00332_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00333_0").find('b').after('<span style="color:red;">* </span>');
	//$("#label_UK-FCL-00246_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00475_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00486_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00487_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00497_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00498_0").find('b').after('<span style="color:red;">* </span>');
	$("#label_UK-FCL-00499_0").find('b').after('<span style="color:red;">* </span>');
	
});		
</script>