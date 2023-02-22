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
	$("#label_UK-FCL-00038_7").html($( "#label_UK-FCL-00038_7" ).html()+ '<a href="https://caipotesturl.com/themes/backend/uploads/New-Categorization-Industries-UEPPCB-January-2014.pdf" target="_blank"> (Click here to know your type) </a>');
	
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
	
	});
	//Male skilled 
	$("#UK-FCL-00045_2").on("blur",function () {			
		var totEmpM = parseInt($("#UK-FCL-00045_2").val()) + parseInt($("#UK-FCL-00046_0").val());		
	
		if(parseInt($("#UK-FCL-00045_2").val())>0)
			addskillEmp('male');
		
		$("#UK-FCL-00045_2").val('');
		$("#UK-FCL-00046_0").val('');
	}); 

	//Female skilled
	$("#UK-FCL-00045_3").on("blur",function () {
		
		var totEmpFM = parseInt($("#UK-FCL-00045_3").val()) + parseInt($("#UK-FCL-00045_4").val());
		
		if(parseInt($("#UK-FCL-00045_3").val())>0)
		addskillEmp('female');
		
		$("#UK-FCL-00045_3").val('');
		$("#UK-FCL-00045_4").val('');
	});		
	 
	function addskillEmp(gender)
	{
		$.ajax({
			type: 'POST',
			url: '/backoffice/frontuser/home2/GetSectorData3/gender/'+gender,
			data: 'natureOfUnit=' + $('#UK-FCL-00038_10').val(),
			dataType: 'html'
		})
		.done(function (data) {
			// show the response
			//console.log(data);

			$('#dynamic-content').html(data);
			// alert(flg);
			$('#addEmployeeSkill').modal({backdrop: 'static', keyboard: false});
			$('#addEmployeeSkill').modal('show');
			
			//Default on model popup load update sector 
			$.ajax({
				type: 'POST',
				url: '/backoffice/frontuser/home2/GetSectorData2',
				data: 'nature_unit_popupdata=' + $("#UK-FCL-00226_1").val(),
				dataType: 'html'
			})
			.done(function (data) {
				$("#UK-FCL-00226_2").html(data);
			})
			.fail(function (data) {
				alert("Posting failed.");
			})
		
			/* var option = '<option value="">--Employment--</option>';
			var domiciles = new Array();
			$(".mskill,.fskill").each(function (e) {
				if ($(this).val() > 0)
				{
					var skillParent = $(this).attr('name');
					var gh = $(this).parent('td').parent('tr').find('td:eq(0)').html();
					var full = gh.split('<br>');
					domiciles = (full[0].trim() + ' ' + full[1].trim());
					option += '<option value="' + skillParent + '">' + domiciles + '</option>';
				}
			});
			$('#domicile_other_popup').html(option); */
		})
		.fail(function () {			
			alert("Posting failed.");
		});
	}
	});
	
	
	

	$(document).on('change', '#UK-FCL-00226_2', function () {
		$.ajax({
			type: 'POST',
			url: '/backoffice/frontuser/home2/GetSkillsData3',
			data: 'sector_popupdata=' + encodeURIComponent($(this).val()),
			dataType: 'html'
		})
		.done(function (data) {
			$("#UK-FCL-00226_3").html(data);
		})
		.fail(function (data) {
			alert("Posting failed.");
		})
	});
	
	$(document).on('click', "#skill-add-more", function () {
		$("#errorpop_up").html('');		
		/* var flag = 0;		
		var parentSkillKey = $("#UK-FCL-00226_7").val();
		$(".skilled_sector_" + parentSkillKey).each(function () {			
			var sector = $(this).val();
			var sector2 = $("#sector_popup").val();
			if (sector == sector2)
			{
				flag = 1;
			}
		});
		var skillMainTotal = 0;
		if(parentSkillKey=='m')
		{
			skillMainTotal = $("input[name=skilled_emp]").val();
		}else if(parentSkillKey=='f'){		
			skillMainTotal = $("input[name=skilled_emp_f]").val();
		}
		
		var skillGrandTotal = 0;
		var skillTotal2 ='';
	
		if(parentSkillKey  != ''){
			skillTotal2 = $("." + parentSkillKey).val();
		}
		if(skillTotal2 != '' && skillTotal2 != undefined)
		{
			var add = 0;		
			$(".skilled_total").each(function(){			
				if($("#empgender_2").val()==$(this).attr('rel')){				
				  add = add + parseInt($(this).val());				  
				  skillGrandTotal = parseInt($("#skilltotal_popup").val()) + add;
				}
			});
		} else {
			skillGrandTotal = parseInt($("#skilltotal_popup").val());
		}
		
		if (skillGrandTotal > skillMainTotal)
		{
			$("#errorpop_up").html('Gender wise skilled resource value can not be greater than proposed employment details, in case if you want to increase the Skill resource information then please update the employment information of respective gender first.');
			return false;
		}
		if (skillGrandTotal < skillMainTotal)
		{
			$("#errorpop_up").html('Gender wise skilled resource value can not be less than proposed employment details, in case if you want to decrease the Skill resource information then please update the employment information of respective gender first.');
		}
		if (flag == 1)
		{
			$("#errorpop_up").html('You have already added skill for this sector please select another.');
			return false;
		}
		 */
		
		//var empgender = $("#empgender_2").val();
		
		//nature of unit
		var nature_unit_popup = $("#UK-FCL-00226_1").val();
		//sector
		var sector_popup = $("#UK-FCL-00226_2").val();
		//skill
		var skill_popup = $("#UK-FCL-00226_3").val();
		//skill total
		var skilltotal_popup = $("#UK-FCL-00226_4").val();
		//skill domicile
		var domicile_other_popupval = $("#UK-FCL-00226_5").val();
		var domicile_other_popup = $("#UK-FCL-00226_5 option:selected").text();		
		//Category
		var emp_category_popupval = $("#UK-FCL-00226_6").val();
		var emp_category = $("#UK-FCL-00226_6 option:selected").text();
		//gender
		var emp_gender = $("#UK-FCL-00226_7 option:selected").text();
		//alert(nature_unit_popup);
		if (nature_unit_popup == '' || nature_unit_popup == undefined)
		{
			$("#UK-FCL-00226_1").prop('required', true);
			$("#UK-FCL-00226_1").parent('div').addClass('has-error');
			
		} else if (sector_popup == '' || sector_popup == undefined)
		{
			$("#UK-FCL-00226_2").prop('required', true);
			$("#UK-FCL-00226_2").parent('div').addClass('has-error');
			$("#UK-FCL-00226_2").prev('div').css({"color": "red", "border": "1px solid red"});
		} else if (skill_popup == '' || skill_popup == undefined)
		{
			$("#UK-FCL-00226_3").prop('required', true);
			$("#UK-FCL-00226_3").parent('div').addClass('has-error');
			$("#UK-FCL-00226_3").prev('div').css({"color": "red", "border": "1px solid red"});
		} else if (skilltotal_popup == '' || skilltotal_popup == undefined)
		{
			$("#UK-FCL-00226_4").prop('required', true);
			$("#UK-FCL-00226_4").parent('div').addClass('has-error');
		} else {
			
		
			$("#UK-FCL-00226_5").prop('required', false);
			$("#UK-FCL-00226_5").parent('div').removeClass('has-error');

			$("#UK-FCL-00226_1").prop('required', false);
			$("#UK-FCL-00226_1").parent('div').removeClass('has-error');

			$("#UK-FCL-00226_2").prop('required', false);
			$("#UK-FCL-00226_2").parent('div').removeClass('has-error');
			$("#UK-FCL-00226_2").prev('div').css({"color": "", "border": ""});
			
			$("#UK-FCL-00226_3").prop('required', false);
			$("#UK-FCL-00226_3").parent('div').removeClass('has-error');
			$("#UK-FCL-00226_3").prev('div').css({"color": "", "border": ""});
			
			$("#UK-FCL-00226_4").prop('required', false);
			$("#UK-FCL-00226_4").parent('div').removeClass('has-error');

			$(".skills_tablepopup").show();

			var trlen1 = $('.skills_tablepopup tbody tr').length;
			if (("<?php echo count(@$skillarray) ?>") > 0) {
				var trlen = parseInt('<?php echo count(@$skillarray) ?>') + parseInt(trlen1);
			} else {
				var trlen = trlen1;
			}

			var rows = "<tr>"
					+ "<td><input type='text' id='skilled_natureunit_"+trlen+"' name='skill_data[" + trlen + "][" + parentSkillKey + "][skilled_natureunit]' value='" + nature_unit_popup + "' class='form-control' readonly/></td>"
					+ "<td class='sector'><input type='text' class='form-control skilled_sector_" + parentSkillKey + "' id='skilled_sector_"+trlen+"' name='skill_data[" + trlen + "][" + parentSkillKey + "][skilled_sector]' value='" + sector_popup + "' readonly /></td>"
					+ "<td><input type='text' id='skilled_name' name='skill_data[" + trlen + "][" + parentSkillKey + "][skilled_name]' value='" + skill_popup + "' class='form-control' readonly /></td>"
					+ "<td style='text-align:center;'><input type='text' id='skilled_total_"+trlen+"' name='skill_data[" + trlen + "][" + parentSkillKey + "][skilled_total]' value=" + skilltotal_popup + " class='" + parentSkillKey + " skilltotal form-control skilled_total' readonly rel='" + parentSkillKey + "'/></td>"
					+ "<td><input type='text' id='skilled_employement_"+trlen+"' name='skill_data[" + trlen + "][" + parentSkillKey + "][skilled_employement]' value='" + domicile_other_popup + "' class='form-control' readonly /></td>"
					+ "<td style='text-align:center;'><input type='text' id='skilled_emp_gender_"+trlen+"' name='skill_data[" + trlen + "][" + parentSkillKey + "][skilled_emp_gender]' value=" + emp_gender + " class='" + parentSkillKey + "  form-control' readonly rel='" + parentSkillKey + "'/></td>"
					+ "<td style='text-align:center;'><input type='text' id='skilled_emp_category_"+trlen+"' name='skill_data[" + trlen + "][" + parentSkillKey + "][skilled_emp_category]' value=" + emp_category + " class='" + parentSkillKey + "  form-control' readonly rel='" + parentSkillKey + "'/></td>"
					+ "</tr>";


			$('.skills_tablepopup tbody').append(rows);

			$("#domicile_other_popup").val('');
			$("#nature_unit_popup").val('');
			$("#sector_popup").val('');
			$('#sector_popup').select2();
			//$("#sector_popup").selectpicker("refresh");			
			$("#skill_popup").val('');
			$('#skill_popup').select2();
			$("#skilltotal_popup").val(''); 
		}
	});
