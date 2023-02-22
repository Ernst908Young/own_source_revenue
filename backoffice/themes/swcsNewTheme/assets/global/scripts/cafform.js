/**
this function is used to CAF 2.0
*
*/
/*function to 
* author: 
*@Param: string
*/
/* function getUserDetails(url,dept_id,dist_id){
    jQuery.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: {'dept_id':dept_id,'disctrict_id':dist_id} ,
            success: function (data) {
                if(data!=''){
                    if(data==='NONE')
                        return false;
                    else{
                       //console.log(data);
                      $('#User_full_name').val(data.full_name);
                      $('#User_email').val(data.email);
                      //$('#User_password').val(data.password);
                      $('#User_mobile').val(data.mobile);
                      $('#User_uid').val(data.uid);
                    }
                }
         },
            error: function (data) {
                console.log(data);
            }
        });
   
} */
	
$(document).ready(function(){
	$( "#label_UK-FCL-00038_7" ).html($( "#label_UK-FCL-00038_7" ).html()+ '<a href="https://caipotesturl.com/themes/backend/uploads/New-Categorization-Industries-UEPPCB-January-2014.pdf" target="_blank"> (Click here to know your type) </a>');
	
	//NIC 5 digit code 
	$("#label_UK-FCL-00038_3").html($("#label_UK-FCL-00038_3").html()+'<a href="https://caipotesturl.com/themes/backend/uploads/nic_2008_17apr09.pdf" target="_blank">Click to know your NIC 5 Digit Code</a></span>');	
	
	//HSN code 
	$("#label_UK-FCL-00038_4").html($("#label_UK-FCL-00038_4").html()+'<a href="https://caipotesturl.com/themes/backend/uploads/gst_hsn_code_list.pdf" target="_blank">Click to know your HSN Code</a></span>');
	
	//SAC code 
	$("#label_UK-FCL-00038_5").html($("#label_UK-FCL-00038_5").html()+'<a href="https://caipotesturl.com/themes/backend/uploads/gst_hsn-sac_codes.pdf" target="_blank">Click to know your SAC Code</a></span>');
	
	
	
	
	//sole proprietor
	$('#div_UK-FCL-00002_4').hide();
	$('#div_UK-FCL-00002_5').hide(); 
	$('#div_UK-FCL-00002_6').hide();	
	$('#div_UK-FCL-00024_0').hide();
	$('#div_UK-FCL-00009_2').hide(); 	
	//end of sole proprietor
	
	//LLP Select	
	$('#div_UK-FCL-00025_0').hide();
	$('#div_UK-FCL-00002_7').hide();
	$('#div_UK-FCL-00002_8').hide();
	$('#div_UK-FCL-00002_9').hide();
	$('#div_UK-FCL-00026_0').hide();
	$('#div_UK-FCL-00027_0').hide();
	$('#div_UK-FCL-00028_0').hide(); 
	//LLP Select
	
	//(Partnership Firm)
	$('#div_UK-FCL-00002_7').hide();
	$('#div_UK-FCL-00002_8').hide();
	$('#div_UK-FCL-00002_9').hide();	
	$('#div_UK-FCL-00026_0').hide();
	$('#div_UK-FCL-00029_0').hide();
	$('#div_UK-FCL-00009_4').hide();
	//(Partnership Firm)
	
	//One person company
	$('#div_UK-FCL-00002_10').hide();
	$('#div_UK-FCL-00002_11').hide();
	$('#div_UK-FCL-00002_12').hide();
	
	$('#div_UK-FCL-00002_13').hide();	
	$('#div_UK-FCL-00002_14').hide();	
	$('#div_UK-FCL-00002_15').hide();
	
	$('#div_UK-FCL-00009_3').hide();
	$('#div_UK-FCL-00030_0').hide();	
	//One Person Company
	
	//Private Limited Company
	$('#div_UK-FCL-00031_0').hide();	
	$('#div_UK-FCL-00002_16').hide();
	$('#div_UK-FCL-00002_17').hide();
	$('#div_UK-FCL-00002_18').hide();
	$('#div_UK-FCL-00033_0').hide();
	//Private Limited Company
	
	//Public Limited Company
	$('#div_UK-FCL-00031_0').hide();
	//director 
	$('#div_UK-FCL-00002_19').hide();
	$('#div_UK-FCL-00002_20').hide();
	$('#div_UK-FCL-00002_21').hide();
	//director
	//Public Limited Company
	
	//Lead Promoter
	$('#div_UK-FCL-00002_25').hide();
	$('#div_UK-FCL-00035_0').hide();
	$('#div_UK-FCL-00036_0').hide();
	$('#div_UK-FCL-00005_3').hide();
	$('#div_UK-FCL-00006_4').hide();
	//Lead Promoter
	
	//cooperative society
	$('#div_UK-FCL-00032_0').hide();
	//cooperative society
	
	
	$('#div_UK-FCL-00002_25').hide();
	$('#div_UK-FCL-00002_26').hide();
	$('#div_UK-FCL-00002_27').hide();
	
	$('#div_UK-FCL-00055_0').hide();
		
	$('#div_UK-FCL-00054_0').hide();
	
	//Trusty name
	$('#div_UK-FCL-00002_28').hide();
	$('#div_UK-FCL-00002_29').hide();
	$('#div_UK-FCL-00002_30').hide();
	//Trusty name
	$('#div_UK-FCL-00056_0').hide();	

	$('#UK-FCL-00008_0').on('change', function() {
		
		//sole proprietor
		$('#div_UK-FCL-00002_4').hide();
		$('#div_UK-FCL-00002_5').hide(); 
		$('#div_UK-FCL-00002_6').hide();	
		$('#div_UK-FCL-00024_0').hide();
		$('#div_UK-FCL-00009_2').hide(); 	
		//end of sole proprietor
		
		//LLP Select	
		$('#div_UK-FCL-00025_0').hide();
		$('#div_UK-FCL-00002_7').hide();
		$('#div_UK-FCL-00002_8').hide();
		$('#div_UK-FCL-00002_9').hide();
		$('#div_UK-FCL-00026_0').hide();
		$('#div_UK-FCL-00027_0').hide();
		$('#div_UK-FCL-00028_0').hide(); 
		//LLP Select
		
		//(Partnership Firm)
		$('#div_UK-FCL-00002_7').hide();
		$('#div_UK-FCL-00002_8').hide();
		$('#div_UK-FCL-00002_9').hide();	
		$('#div_UK-FCL-00026_0').hide();
		$('#div_UK-FCL-00029_0').hide();
		$('#div_UK-FCL-00009_4').hide();
		//(Partnership Firm)
		
		//One person company
		$('#div_UK-FCL-00002_10').hide();
		$('#div_UK-FCL-00002_11').hide();
		$('#div_UK-FCL-00002_12').hide();
		
		$('#div_UK-FCL-00002_13').hide();	
		$('#div_UK-FCL-00002_14').hide();	
		$('#div_UK-FCL-00002_15').hide();
		
		$('#div_UK-FCL-00009_3').hide();
		$('#div_UK-FCL-00030_0').hide();	
		//One Person Company
		
		//Private Limited Company
		$('#div_UK-FCL-00031_0').hide();	
		$('#div_UK-FCL-00002_16').hide();
		$('#div_UK-FCL-00002_17').hide();
		$('#div_UK-FCL-00002_18').hide();
		$('#div_UK-FCL-00033_0').hide();
		//Private Limited Company
		
		//Public Limited Company
		$('#div_UK-FCL-00031_0').hide();
		//director 
		$('#div_UK-FCL-00002_19').hide();
		$('#div_UK-FCL-00002_20').hide();
		$('#div_UK-FCL-00002_21').hide();
		//director
		//Public Limited Company
		
		//Lead Promoter
		$('#div_UK-FCL-00002_25').hide();
		$('#div_UK-FCL-00035_0').hide();
		$('#div_UK-FCL-00036_0').hide();
		$('#div_UK-FCL-00005_3').hide();
		$('#div_UK-FCL-00006_4').hide();
		//Lead Promoter
		
		//cooperative society
		$('#div_UK-FCL-00032_0').hide();
		//cooperative society
		
		
		$('#div_UK-FCL-00002_25').hide();
		$('#div_UK-FCL-00002_26').hide();
		$('#div_UK-FCL-00002_27').hide();	
		
		$('#div_UK-FCL-00055_0').hide();		
		$('#div_UK-FCL-00054_0').hide();
		$('#div_UK-FCL-00056_0').hide();
		//Trusty name
		$('#div_UK-FCL-00002_28').hide();
		$('#div_UK-FCL-00002_29').hide();
		$('#div_UK-FCL-00002_30').hide();
		//Trusty name
		
		var id = $(this).val();
		
		if (id == 1){
			$('#div_UK-FCL-00002_4').show();
			$('#div_UK-FCL-00002_5').show(); 
			$('#div_UK-FCL-00002_6').show();	
			$('#div_UK-FCL-00024_0').show();
			$('#div_UK-FCL-00009_2').show(); 	
		}else if (id == 2){
			$('#div_UK-FCL-00025_0').show();
			$('#div_UK-FCL-00002_7').show();
			$('#div_UK-FCL-00002_8').show();
			$('#div_UK-FCL-00002_9').show();
			$('#div_UK-FCL-00026_0').show();
			$('#div_UK-FCL-00027_0').show();
			$('#div_UK-FCL-00028_0').show(); 
		}else if (id == 3){
			$('#div_UK-FCL-00002_7').show();
			$('#div_UK-FCL-00002_8').show();
			$('#div_UK-FCL-00002_9').show();	
			$('#div_UK-FCL-00026_0').show();
			$('#div_UK-FCL-00029_0').show();
			$('#div_UK-FCL-00009_4').show();					
		}  else if (id == 4){
			$('#div_UK-FCL-00002_10').show();
			$('#div_UK-FCL-00002_11').show();
			$('#div_UK-FCL-00002_12').show();			
			$('#div_UK-FCL-00002_13').show();	
			$('#div_UK-FCL-00002_14').show();	
			$('#div_UK-FCL-00002_15').show();			
			$('#div_UK-FCL-00009_3').show();
			$('#div_UK-FCL-00030_0').show();				
		}  else if (id == 5){
			$('#div_UK-FCL-00031_0').show();	
			$('#div_UK-FCL-00002_16').show();			
			$('#div_UK-FCL-00002_17').show();
			$('#div_UK-FCL-00002_18').show();
			$('#div_UK-FCL-00033_0').show();			
		} else if (id == 6){
			$('#div_UK-FCL-00031_0').show();
			//director 
			$('#div_UK-FCL-00002_19').show();
			$('#div_UK-FCL-00002_20').show();
			$('#div_UK-FCL-00002_21').show();
			//director
		}else if(id == 7){
			//director 
			$('#div_UK-FCL-00002_19').show();
			$('#div_UK-FCL-00002_20').show();
			$('#div_UK-FCL-00002_21').show();
			$('#div_UK-FCL-00056_0').show();
			//director
		}else if (id == 8){
			$('#div_UK-FCL-00032_0').show(); 
		}else if(id == 9){
			$('#div_UK-FCL-00002_19').show();
			$('#div_UK-FCL-00002_20').show();
			$('#div_UK-FCL-00002_21').show();
		}else if(id == 10){
			$('#div_UK-FCL-00002_19').show();
			$('#div_UK-FCL-00002_20').show();
			$('#div_UK-FCL-00002_21').show();
		}else if(id == 11){			
			$('#div_UK-FCL-00002_25').show();
			$('#div_UK-FCL-00002_26').show();
			$('#div_UK-FCL-00002_27').show();			
		}else if(id == 12){
			$('#div_UK-FCL-00055_0').show();
		}else if(id == 13){
			$('#div_UK-FCL-00054_0').show();
			$('#div_UK-FCL-00002_28').show();
			$('#div_UK-FCL-00002_29').show();
			$('#div_UK-FCL-00002_30').show();
		}		
	});
	$("#UK-FCL-00038_12").on('change', function() {
		var id=$(this).val();
		$("#div_UK-FCL-00038_13").show();
		$("#div_UK-FCL-00012_7").show();
		$("#div_UK-FCL-00012_5").show();
		$("#div_UK-FCL-00012_6").show();
		$("#div_UK-FCL-00012_2").show();
		$("#div_UK-FCL-00012_3").show();
		$("#div_UK-FCL-00043_1").show();
		if(id=='No')
		{
			$("#div_UK-FCL-00038_13").hide();
			$("#div_UK-FCL-00012_7").hide();
			$("#div_UK-FCL-00012_5").hide();
			$("#div_UK-FCL-00012_6").hide();
			$("#div_UK-FCL-00012_2").hide();
			$("#div_UK-FCL-00012_3").hide();
			$("#div_UK-FCL-00043_1").hide();
		}	
	});
	
	$("#UK-FCL-00014_0").on('change', function() {
		var stateCode = $(this).val();
		$.ajax({
			type: "POST",
			url: "/backoffice/iloc/property/getDistrict/stateCode/" + stateCode,
			success: function(result) {
				$("#UK-FCL-00015_1").html(result);
			}
		});
	});
	
	$("#UK-FCL-00020_0").on('change', function() {
		
		var sel_val = $(this).val();
		var startUpIndia = $("#UK-FCL-00021_0").val();
		var startUpUttrakhand = $("#UK-FCL-00022_0").val();
		/* alert(sel_val);
		alert(startUpIndia);
		alert(startUpUttrakhand); */
		if(sel_val=='Yes' && startUpIndia=='' && startUpUttrakhand=='')
		{
			$("#UK-FCL-00021_0").attr("required","required");
			$("#UK-FCL-00021_0").css("border-color", "#FF0000");
			$("#UK-FCL-00022_0").attr("required","required");
			$("#UK-FCL-00022_0").css("border-color", "#FF0000");
		}else{
			$("#UK-FCL-00021_0").removeAttr("required");
			$("#UK-FCL-00021_0").css("border-color", "#c2cad8");
			$("#UK-FCL-00022_0").removeAttr("required");
			$("#UK-FCL-00022_0").css("border-color", "#c2cad8");
		}	
	});
	
	$("#UK-FCL-00021_0").on('keyup', function() {
		$("#UK-FCL-00021_0").removeAttr("required");
		$("#UK-FCL-00021_0").css("border-color", "#c2cad8");
		$("#UK-FCL-00022_0").removeAttr("required");
		$("#UK-FCL-00022_0").css("border-color", "#c2cad8");
	});
	$("#UK-FCL-00022_0").on('keyup', function() {
		$("#UK-FCL-00021_0").removeAttr("required");
		$("#UK-FCL-00021_0").css("border-color", "#c2cad8");
		$("#UK-FCL-00022_0").removeAttr("required");
		$("#UK-FCL-00022_0").css("border-color", "#c2cad8");
	});
	
	//Hide Industrial Area
	$('#div_UK-FCL-00012_4').hide();
	$('#div_UK-FCL-00057_0').hide();
	//Location Unit Change
	
	$('#UK-FCL-00038_2').on("change",function(){
		$('#div_UK-FCL-00012_4').hide();
		$('#div_UK-FCL-00057_0').hide();
		var loctionunitId = $(this).val();
		if(loctionunitId=="SIIDCUL Land" || loctionunitId=="Private Industrial Estate")
		{
			$('#div_UK-FCL-00012_4').show();
		}
		else if(loctionunitId=="MSME Estate")
		{
			$('#div_UK-FCL-00057_0').show();
		}
	});
	
	//on change unit district get tehsil
	$('#UK-FCL-00015_2').on('change', function() {	
		var districtValue = $(this).val();
		$.ajax({
			type: "POST",
			url: "/backoffice/iloc/property/getTehsil1/districtID/" + districtValue,
			success: function (result) {
				$("#UK-FCL-00041_1").html(result);
			}
		});	
	});
	//on change unit tehsil get village
	$('#UK-FCL-00041_1').on('change', function() {	
		var tehsilValue = $(this).val();
		$.ajax({
			type: "POST",
			url: "/backoffice/iloc/property/getVilagesOfTehsil/subDistCode/" + tehsilValue,
			success: function (result) {
				$("#UK-FCL-00042_1").html(result);
			}
		});	
	});
	
        
        //on change get service according to department
	$('#UK-FCL-00050_1').on('change', function() {	
		var dept_id = $(this).val();
		$.ajax({
			type: "POST",
			url: "/backoffice/iloc/property/getServicebydept/dept_id/" + dept_id,
			success: function (result) {
				$("#UK-FCL-00050_2").html(result);
			}
		});	
	});
	
	//on change manufacturing and service 
	$('#title_UK-FCL-00052_1').hide();
	$('#hr_UK-FCL-00052_1').hide();
	$('#div_UK-FCL-00052_1').hide();
	$('#div_UK-FCL-00052_2').hide();
	$('#div_UK-FCL-00052_3').hide();
	$('#div_UK-FCL-00052_4').hide();			
	$('#div_UK-FCL-00052_5').hide();
	
	$('#title_UK-FCL-00053_1').hide();
	$('#hr_UK-FCL-00053_1').hide();
	$('#div_UK-FCL-00053_1').hide();
	$('#div_UK-FCL-00053_2').hide();
	$('#div_UK-FCL-00053_3').hide();
	$('#div_UK-FCL-00053_4').hide();
	
	$("#UK-FCL-00038_6").children("option[value^='1']").hide();	
	$("#UK-FCL-00038_6").children("option[value^='2']").hide();	
	$("#UK-FCL-00038_6").children("option[value^='3']").hide();	
	$("#UK-FCL-00038_6").children("option[value^='4']").hide();	
	$("#UK-FCL-00038_6").children("option[value^='5']").hide();	
	$("#UK-FCL-00038_6").children("option[value^='6']").hide();	
	$("#UK-FCL-00038_6").children("option[value^='7']").hide();	
	$("#UK-FCL-00038_6").children("option[value^='8']").hide();
	
	$('#UK-FCL-00038_10').on('change',function(){
		var id =$(this).val();
		$("#UK-FCL-00038_6").children("option[value^='1']").hide();	
		$("#UK-FCL-00038_6").children("option[value^='2']").hide();	
		$("#UK-FCL-00038_6").children("option[value^='3']").hide();	
		$("#UK-FCL-00038_6").children("option[value^='4']").hide();	
		$("#UK-FCL-00038_6").children("option[value^='5']").hide();	
		$("#UK-FCL-00038_6").children("option[value^='6']").hide();	
		$("#UK-FCL-00038_6").children("option[value^='7']").hide();	
		$("#UK-FCL-00038_6").children("option[value^='8']").hide();	
		if(id=='Manufacturing')
		{
			$('#label_UK-FCL-00051_3').text("Investment in Plant & Machinery (In Lakhs)");
			$("#UK-FCL-00051_3").attr("placeholder", "Investment in Plant & Machinery (In Lakhs)");
			
			$('#title_UK-FCL-00052_1').show();
			$('#hr_UK-FCL-00052_1').show();
			$('#div_UK-FCL-00052_1').show();
			$('#div_UK-FCL-00052_2').show();
			$('#div_UK-FCL-00052_3').show();
			$('#div_UK-FCL-00052_4').show();			
			$('#div_UK-FCL-00052_5').show();
			
			$('#title_UK-FCL-00053_1').show();
			$('#hr_UK-FCL-00053_1').show();
			$('#div_UK-FCL-00053_1').show();
			$('#div_UK-FCL-00053_2').show();
			$('#div_UK-FCL-00053_3').show();
			$('#div_UK-FCL-00053_4').show();
			
			$("#UK-FCL-00038_6").children("option[value^='1']").show();	
			$("#UK-FCL-00038_6").children("option[value^='2']").show();	
			$("#UK-FCL-00038_6").children("option[value^='3']").show();	
			$("#UK-FCL-00038_6").children("option[value^='4']").show();	
			$("#UK-FCL-00038_6").children("option[value^='5']").hide();	
			$("#UK-FCL-00038_6").children("option[value^='6']").hide();	
			$("#UK-FCL-00038_6").children("option[value^='7']").hide();	
			$("#UK-FCL-00038_6").children("option[value^='8']").hide();
							
		}else{
			$('#label_UK-FCL-00051_3').text("Investment in Equipment (In Lakhs)");
			$("#UK-FCL-00051_3").attr("placeholder", "Investment in Equipment (In Lakhs)");
			$('#title_UK-FCL-00052_1').hide();
			$('#hr_UK-FCL-00052_1').hide();
			$('#div_UK-FCL-00052_1').hide();
			$('#div_UK-FCL-00052_2').hide();
			$('#div_UK-FCL-00052_3').hide();
			$('#div_UK-FCL-00052_4').hide();			
			$('#div_UK-FCL-00052_5').hide();
			
			$('#title_UK-FCL-00053_1').hide();
			$('#hr_UK-FCL-00053_1').hide();
			$('#div_UK-FCL-00053_1').hide();
			$('#div_UK-FCL-00053_2').hide();
			$('#div_UK-FCL-00053_3').hide();
			$('#div_UK-FCL-00053_4').hide();
			
			
			$("#UK-FCL-00038_6").children("option[value^='5']").show();	
			$("#UK-FCL-00038_6").children("option[value^='6']").show();	
			$("#UK-FCL-00038_6").children("option[value^='7']").show();	
			$("#UK-FCL-00038_6").children("option[value^='8']").show();
			$("#UK-FCL-00038_6").children("option[value^='1']").hide();	
			$("#UK-FCL-00038_6").children("option[value^='2']").hide();	
			$("#UK-FCL-00038_6").children("option[value^='3']").hide();	
			$("#UK-FCL-00038_6").children("option[value^='4']").hide();
		}
	
	});
	
	//electricity
	$('#div_UK-FCL-00047_2').hide();
	$('#div_UK-FCL-00047_3').hide();
	$('#div_UK-FCL-00047_4').hide();
	$('#div_UK-FCL-00048_0').hide();
	
	//water
	$('#div_UK-FCL-00047_5').hide();
	$('#div_UK-FCL-00047_6').hide();
	$('#div_UK-FCL-00047_7').hide();
	$('#div_UK-FCL-00047_9').hide();
	$('#div_UK-FCL-00048_1').hide();
	
	//gas
	$('#div_UK-FCL-00047_10').hide();
	$('#div_UK-FCL-00047_11').hide();
	$('#div_UK-FCL-00047_12').hide();
	$('#div_UK-FCL-00047_13').hide();
	$('#div_UK-FCL-00066_0').hide();
	
	$('#UK-FCL-00047_1').on('change',function(){
		//electricity
		$('#div_UK-FCL-00047_2').hide();
		$('#div_UK-FCL-00047_3').hide();
		$('#div_UK-FCL-00047_4').hide();
		$('#div_UK-FCL-00048_0').hide();
		$('#div_UK-FCL-00066_0').hide();
		
		//water
		$('#div_UK-FCL-00047_5').hide();
		$('#div_UK-FCL-00047_6').hide();
		$('#div_UK-FCL-00047_7').hide();
		$('#div_UK-FCL-00047_9').hide();
		$('#div_UK-FCL-00048_1').hide();
		
		//gas
		$('#div_UK-FCL-00047_10').hide();
		$('#div_UK-FCL-00047_11').hide();
		$('#div_UK-FCL-00047_12').hide();
		$('#div_UK-FCL-00047_13').hide();
		var id =$(this).val();
		if(id=="Electricity")
		{
			$('#div_UK-FCL-00047_2').show();
			$('#div_UK-FCL-00047_3').show();
			$('#div_UK-FCL-00047_4').show();
			$('#div_UK-FCL-00048_0').show();
			$('#div_UK-FCL-00066_0').show();	
		}
		if(id=="Water")
		{
			$('#div_UK-FCL-00047_5').show();
			$('#div_UK-FCL-00047_6').show();
			$('#div_UK-FCL-00047_7').show();
			$('#div_UK-FCL-00047_9').show();
			$('#div_UK-FCL-00048_1').show();
			$('#div_UK-FCL-00066_0').show();				
		}
		if(id=="Gas")
		{
			$('#div_UK-FCL-00047_10').show();
			$('#div_UK-FCL-00047_11').show();
			$('#div_UK-FCL-00047_12').show();
			$('#div_UK-FCL-00047_13').show();
			$('#div_UK-FCL-00066_0').show();		
		}
	
	})
	/*$('#UK-FCL-00255_0').change(function () {<span class="help-block"><a href="https://caipotesturl.com/themes/backend/uploads/New-Categorization-Industries-UEPPCB-January-2014.pdf" target="_blank"><b>Click to know your type of Industry</b></a></span>
		var sel_val = $(this).val();					
		if(sel_val=='SIIDCUL Land'){
			$("#div_UK-FCL-00344_0").show();
			$.ajax({
				type: "POST",
				url: "/backoffice/iloc/property/getIndustrialArea/landType/" + sel_val,
				success: function(result) {
					$("#UK-FCL-00344_0").html(result);
				}
			});
		}else if(sel_val=='Private Industrial Estate'){		
			$("#div_UK-FCL-00344_0").show();
			$.ajax({
				type: "POST",
				url: "/backoffice/iloc/property/getIndustrialArea/landType/" + sel_val,
				success: function(result) {
					$("#UK-FCL-00344_0").html(result);
				}
			});
		}else{
			$("#div_UK-FCL-00344_0").hide();
		}
	});
	
	
	$('#div_UK-FCL-00015').hide();
	$("#UK-FCL-00016").on('change', function () {
	  //alert("hi");
		var districtValue = $(this).val();
		$.ajax({
			type: "POST",
			url: "/backoffice/iloc/property/getTehsil1/districtID/" + districtValue,
			success: function (result) {					
				if(result=="blank"){		
					$("#div_UK-FCL-00015").show();
					$("#UK-FCL-00015").attr('disabled',false);
					
					$("#div_UK-FCL-00040_0").hide();
					$("#UK-FCL-00040_0").prop('disabled',true);
				}else{					
					$("#div_UK-FCL-00040_0").show();
					$("#UK-FCL-00040_0").prop('disabled',false);
					
					$("#div_UK-FCL-00015").hide();
					$("#UK-FCL-00015").attr('disabled',true);	
					$("#UK-FCL-00040_0").html(result);
				}	
			}
		});
	});
	
	$('#UK-FCL-00284_0').on('click', function() {
		$(".datepicker .datepicker-days").show();	
	});
	$("#UK-FCL-00280_0").children('option:gt(0)').hide();
	$('#UK-FCL-00269_0').on('change',function(){
		var id =$(this).val();
		$("#UK-FCL-00280_0").children('option:gt(0)').hide();
		if(id=='Manufacturing')
		{
			$('#title_UK-FCL-00271_0').show();
			$('#title_UK-FCL-00275_0').show();
			$('#div_UK-FCL-00271_0').show();
			$('#div_UK-FCL-00272_0').show();
			$('#div_UK-FCL-00273_0').show();
			$('#div_UK-FCL-00274_0').show();			
			$('#div_UK-FCL-00275_0').show();
			$('#div_UK-FCL-00276_0').show();
			$('#div_UK-FCL-00277_0').show();
			$('#div_UK-FCL-00278_0').show();
			$('#div_UK-FCL-00279_0').show();
			$("#UK-FCL-00280_0").children("option[value^='1']").show();	
			$("#UK-FCL-00280_0").children("option[value^='2']").show();	
			$("#UK-FCL-00280_0").children("option[value^='3']").show();	
			$("#UK-FCL-00280_0").children("option[value^='4']").show();				
		}else{
			$('#title_UK-FCL-00271_0').hide();
			$('#title_UK-FCL-00275_0').hide();
			$('#div_UK-FCL-00271_0').hide();
			$('#div_UK-FCL-00272_0').hide();
			$('#div_UK-FCL-00273_0').hide();
			$('#div_UK-FCL-00274_0').hide();			
			$('#div_UK-FCL-00275_0').hide();
			$('#div_UK-FCL-00276_0').hide();
			$('#div_UK-FCL-00277_0').hide();
			$('#div_UK-FCL-00278_0').hide();
			$('#div_UK-FCL-00279_0').hide();
			$("#UK-FCL-00280_0").children("option[value^='5']").show();	
			$("#UK-FCL-00280_0").children("option[value^='6']").show();	
			$("#UK-FCL-00280_0").children("option[value^='7']").show();	
			$("#UK-FCL-00280_0").children("option[value^='8']").show();	
		}
	
	});
	
	// Proposed Land validation
	$('#div_UK-FCL-00315_0').hide();
	$('#div_UK-FCL-00314_0').hide();
	$('#div_UK-FCL-00318_0').hide();
	$("#UK-FCL-00304_0").on('change',function(){	
		var id=$(this).val();
		if(id=="Rented Space")
		{
			$('#div_UK-FCL-00315_0').show();
			$('#div_UK-FCL-00314_0').show();
			$('#div_UK-FCL-00318_0').show();
			$('#div_UK-FCL-00312_0').hide();
		}else{
			$('#div_UK-FCL-00315_0').hide();
			$('#div_UK-FCL-00314_0').hide();
			$('#div_UK-FCL-00318_0').hide();
			$('#div_UK-FCL-00312_0').show();
		}
	});
	
	$('#div_UK-FCL-00347_0').hide();
	$('#div_UK-FCL-00348_0').hide();
	$('#div_UK-FCL-00349_0').hide();
	$('#div_UK-FCL-00350_0').hide();
	$('#div_UK-FCL-00359_0').hide();
	$('#div_UK-FCL-00351_0').hide();
	$('#div_UK-FCL-00352_0').hide();
	$('#div_UK-FCL-00353_0').hide();
	$('#div_UK-FCL-00354_0').hide();	
	$('#div_UK-FCL-00360_0').hide();
	$('#div_UK-FCL-00355_0').hide();
	$('#div_UK-FCL-00356_0').hide();
	$('#div_UK-FCL-00357_0').hide();
	$('#div_UK-FCL-00358_0').hide();
	$('#div_UK-FCL-00361_0').hide();
	
	$("#UK-FCL-00362_0").on('change',function(){	
		$('#div_UK-FCL-00347_0').hide();
		$('#div_UK-FCL-00348_0').hide();
		$('#div_UK-FCL-00349_0').hide();
		$('#div_UK-FCL-00350_0').hide();
		$('#div_UK-FCL-00359_0').hide();
		$('#div_UK-FCL-00351_0').hide();
		$('#div_UK-FCL-00352_0').hide();
		$('#div_UK-FCL-00353_0').hide();
		$('#div_UK-FCL-00354_0').hide();	
		$('#div_UK-FCL-00360_0').hide();
		$('#div_UK-FCL-00355_0').hide();
		$('#div_UK-FCL-00356_0').hide();
		$('#div_UK-FCL-00357_0').hide();
		$('#div_UK-FCL-00358_0').hide();
		$('#div_UK-FCL-00361_0').hide();
		var id = $(this).val();	
		if(id=='1')
		{
			$('#div_UK-FCL-00347_0').show();
			$('#div_UK-FCL-00348_0').show();
			$('#div_UK-FCL-00349_0').show();
			$('#div_UK-FCL-00350_0').show();
			$('#div_UK-FCL-00359_0').show();
		}
		if(id=='2')
		{
			$('#div_UK-FCL-00351_0').show();
			$('#div_UK-FCL-00352_0').show();
			$('#div_UK-FCL-00353_0').show();
			$('#div_UK-FCL-00354_0').show();	
			$('#div_UK-FCL-00360_0').show();
		}
		if(id=='3')
		{
			$('#div_UK-FCL-00355_0').show();
			$('#div_UK-FCL-00356_0').show();
			$('#div_UK-FCL-00357_0').show();
			$('#div_UK-FCL-00358_0').show();
			$('#div_UK-FCL-00361_0').show();
		}	
	});	 */
	
});