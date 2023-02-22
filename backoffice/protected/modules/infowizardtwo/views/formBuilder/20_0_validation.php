
<script type="text/javascript">
$(document).ready(function(){

	  $("#UK-FCL-00669_0").on("change", function() {
       $("#UK-FCL-00669_0-error").empty();
       $("#div_UK-FCL-00669_0").removeClass("has-error");
  })
  $("#UK-FCL-00667_0").on("change", function() {
       $("#UK-FCL-00667_0-error").empty();
       $("#div_UK-FCL-00667_0").removeClass("has-error");
  })
	$('#UK-FCL-00669_0').attr('placeholder', 'Please Select');


	$("#UK-FCL-00669_0 option[value='']").remove();


	$("#UK-FCL-00266_0").removeAttr('required');


	function inarray(arr,index)
	{

	   if(arr.indexOf(index)!=-1)
	   {
		return 1
	   }
	   else{
		return 0
	   }
 
	}

$("a.back_btn").css('visibility', 'hidden');
$("#UK-FCL-00089_0, #UK-FCL-00507_0").attr('readonly',true);

$("#label_UK-FCL-00262_0, #label_UK-FCL-00095_0, #label_UK-FCL-00264_0, #label_UK-FCL-00265_0, #label_UK-FCL-00266_0, #label_UK-FCL-00113_0, #label_UK-FCL-00122_0").find('b').after('<span style="color:red;"> * </span>');


	$("#div_UK-FCL-00331_0, #div_UK-FCL-00507_0, #div_UK-FCL-00262_0, #div_UK-FCL-00095_0, #div_UK-FCL-00263_0, #div_UK-FCL-00264_0, #div_UK-FCL-00265_0, #div_UK-FCL-00266_0, #div_UK-FCL-00334_0, #div_UK-FCL-00113_0, #div_UK-FCL-00504_0, #div_UK-FCL-00240_0, #div_UK-FCL-00118_0, #div_UK-FCL-00119_0, #div_UK-FCL-00120_0, #div_UK-FCL-00233_0, #div_UK-FCL-00186_0, #div_UK-FCL-00116_0, #div_UK-FCL-00241_0, #div_UK-FCL-00122_0, #div_UK-FCL-00306_0").hide();
	
	
	//on select changes
	var ff669 = $("#UK-FCL-00669_0").val();
	if(ff669){
		manupulatefields(ff669); 
	}
	
	$('#UK-FCL-00669_0').on('change', function() {
		if($(this).val()){
			console.log($(this).val());
			var step_data = $(this).val();
			manupulatefields($(this).val());
			
			var reg_no = $("#UK-FCL-00403_0").val();
			$.ajax({
				type: "POST",
				dataType:'json',
				url: "/backoffice/infowizardtwo/subFormArticleofamendmentform5/getcompanyNameByregno/reg_no/" + reg_no,
				beforeSend:function(){
					$("#UK-FCL-00290_0-error").text("Please wait...");	    	        	
				},
				success: function(result) {
					// alert(result);	
					if(result.status==true){
						// console.log(result);
						var arr = [step_data];
							if(arr.length > 0){
						
							// console.log(result.restriction_on_business);
							if(inarray(arr[0],"Name of the Company")){
							  // srn 33 & name of comp
								one_show(); // srn 33 & name of comp
							}else{
								one_hide();
							}
							if(inarray(arr[0],"Details of share capital and share transfer")){
							  // 6 to 9  
								two_show(); // srn 33 & name of comp
								// console.log(result.noclasssahre)
								$('#add_more_4211').show();
								$('#tbl_4211').show();
								$('#tbl_4211').find('tbody').empty();
								$(result.sharecapital_table).appendTo($('#tbl_4211')); 
								$("#UK-FCL-00262_0").val(result.noclasssahre).trigger("change");
								//$("input[name=UK-FCL-00334_0]").val(result.companytransable).prop('checked', true);
								
								$(".chk_UK-FCL-00334_0").each(function(i, obj) {
									//test
									if(i==1)
									{
									 obj.value="No"
									 $(".chk_UK-FCL-00334_0").prop('checked', true)
									}
									else{
									//test
									
									 obj.value="Yes"
									$(".chk_UK-FCL-00334_0").prop('checked', true)
								   
									}
								});
							}else{
								$('#add_more_4211').hide();
								
								$('#tbl_4211').hide();
								two_hide();
							}
							if(inarray(arr[0],"Details of Directors")){
							
								third_show(); 
								
								  if(result.directorno == 'Fixed Number'){
									$("input[name=UK-FCL-00240_0][value='Fixed Number']").prop('checked', true);
									$("#div_UK-FCL-00241_0").show();	
									$("#UK-FCL-00241_0").val(result.fixed);
								 } 
									
								 if(result.directorno == 'In Range'){
									
									$("input[name=UK-FCL-00240_0][value='In Range']").prop('checked', true);
									$("#div_UK-FCL-00119_0").show(); $("#div_UK-FCL-00120_0").show();
									$("#UK-FCL-00119_0").val(result.minranged);
									$("#UK-FCL-00120_0").val(result.maxranged);
								}     
							}else{
								third_hide();
								$("#div_UK-FCL-00119_0").hide();	
								$("#div_UK-FCL-00120_0").hide();	
								$("#div_UK-FCL-00241_0").hide();	
							}
							if(inarray(arr[0],"Business of the Company")){
							
								fourth_show(); 
								$("#div_UK-FCL-00122_0").show();
								$("#UK-FCL-00122_0").val(result.restriction_on_business);	
								
							}else{
								fourth_hide();
								$("#div_UK-FCL-00122_0").hide();
							}
							if(inarray(arr[0],"Type of Company")){
								// console.log(result.company_type);
								$("input[name=UK-FCL-00306_0]").val(result.company_type).prop('checked', true);
								five_show(); 
							}else{
								five_hide();
							}
							if(inarray(arr[0],"Other Provisions")){
							
								$("#div_UK-FCL-00233_0").show();
								$("#UK-FCL-00233_0").val(result.otherpro);	
								six_show(); 
							}else{
								$("#div_UK-FCL-00233_0").hide();
								six_hide();
							}
		
							
							
								
																	
					}else{
						
						
						$("#UK-FCL-00290_0-error").text(result.msg);
						
						$(result.sharecapital_table).val("");		            	
					}
					}			
				   
				}
			});
		}
		
	});
	
	function manupulatefields(ff669){
		var myarr = ff669.toString().split(",");
		// console.log(myarr);
		if (myarr.includes('Name of the Company')) {  // srn 33 & name of comp
			one_show(); // srn 33 & name of comp
		}else{
			one_hide();
		}
		if (myarr.includes('Details of share capital and share transfer')) {  // 6 to 9  
			two_show(); // srn 33 & name of comp
		}else{
			two_hide();
		}
		if (myarr.includes('Details of Directors')) {  // 10  
			third_show(); // srn 33 & name of comp
			$("#UK-FCL-00119_0").blur(function(){
				// console.log($(this).val());
				if(parseInt($(this).val())<= 0){
					$("#UK-FCL-00119_0-error").text("Minimum number should be greater than 0");
				}else{
					$("#UK-FCL-00119_0-error").text("");
				}
			});
			
			$("#UK-FCL-00119_0").blur(function(){
				var maxnu = $("#UK-FCL-00120_0").val();
				// console.log(maxnu);
				if(maxnu){
					if(parseInt($(this).val())>=parseInt(maxnu)){
					$("#UK-FCL-00119_0-error").text("Minimum number should be less than the Maximum number");
					}else{
						$("#UK-FCL-00119_0-error").text("");
						$("#UK-FCL-00120_0-error").text("");
					}
				}		
			});
			$("#UK-FCL-00120_0").blur(function(){
				var minnu = $("#UK-FCL-00119_0").val();
				if(minnu){
				if(parseInt($(this).val())<=parseInt(minnu)){
					$("#UK-FCL-00120_0-error").text("Maximum number should be greater than the Minimum number");
				}else{
					$("#UK-FCL-00120_0-error").text("");
					$("#UK-FCL-00119_0-error").text("");
				}
			}
			});
			
			$("#UK-FCL-00241_0").blur(function(){
				// console.log($(this).val());
				if(parseInt($(this).val())<= 0){
					$("#UK-FCL-00241_0-error").text("Minimum number should be greater than 0");
				}else{
					$("#UK-FCL-00241_0-error").text("");
				}
			});
	
		}else{
			third_hide();
		}
		
		if (myarr.includes('Business of the Company')) {  
			
			fourth_show(); 
		}else{
			fourth_hide();
		}
		if (myarr.includes('Type of Company')) {  
			
			five_show(); 
		}else{
			five_hide();
		}
		if (myarr.includes('Other Provisions')) {  
			
			six_show(); 
		}else{
			six_hide();
		}
		
	}
	
	function one_show(){
		
		$("#div_UK-FCL-00331_0").show();
		$("#div_UK-FCL-00507_0").show();
	}
	function one_hide(){
		$("#div_UK-FCL-00331_0").hide();
		$("#div_UK-FCL-00507_0").hide();
	}
	
	//6 to 9
	function two_show(){
		// alert("2");
		$("#div_UK-FCL-00262_0").show();
		$("#div_UK-FCL-00095_0").show();
		$("#div_UK-FCL-00263_0").show();
		$("#div_UK-FCL-00264_0").show();
		$("#div_UK-FCL-00265_0").show();
		$("#div_UK-FCL-00266_0").show();
		$("#div_UK-FCL-00113_0").show();
		$("#div_UK-FCL-00186_0").show();
		$("#div_UK-FCL-00334_0").show();

        $(".details1").hide();
		$("<div class='row details1'><div class='col-lg-12' ><strong>The classes and maximum number of shares that the company is authorised to issue:</strong></div></div><br>").insertBefore("#div_UK-FCL-00262_0");
		$("#UK-FCL-00262_0").prop('required',true);
		
	}
	function two_hide(){
		$(".details1").hide();
		$("#div_UK-FCL-00262_0").hide();
		$("#div_UK-FCL-00095_0").hide();
		$("#div_UK-FCL-00263_0").hide();
		$("#div_UK-FCL-00264_0").hide();
		$("#div_UK-FCL-00265_0").hide();
		$("#div_UK-FCL-00266_0").hide();
		$("#div_UK-FCL-00113_0").hide();
		$("#div_UK-FCL-00186_0").hide();
		$("#div_UK-FCL-00334_0").hide();
		$('#div_UK-FCL-00504_0').hide();
		
	}
	
	// two step
	
	
	$("#UK-FCL-00262_0").on("change",function(){
		if($(this).val()){
			if($(this).val()=='01'){
				$("#UK-FCL-00095_0").val("Common shares").trigger("change");
				$("#UK-FCL-00095_0").prop("disabled", true);
				$("#div_UK-FCL-00265_0").hide();
				$("input[name=UK-FCL-00265_0]").prop('checked', false);
				$("#div_UK-FCL-00266_0").hide();
				$("#UK-FCL-00266_0").val("");
				$("#UK-FCL-00113_0").val("The rights of the holders are equal in all respects as follows:\n(a) the right to vote at any meeting of shareholders;\n(b) the right to receive any dividend declared by the company;\n(c) the right to receive the remaining property of the company on dissolution.");
				$("#UK-FCL-00113_0").attr("readonly",true);
				$("#div_UK-FCL-00288_0").show();
			}else{
				$("#UK-FCL-00095_0").val("").trigger("change");
				$("#UK-FCL-00288_0").val("");
				$("#div_UK-FCL-00288_0").hide();
				$("#UK-FCL-00113_0").attr("readonly",false);
				$("#UK-FCL-00095_0").prop("disabled", false);
			}
		}else{
				$("#UK-FCL-00095_0").val("").trigger("change");
			    $("#UK-FCL-00288_0").val("");
				$("#div_UK-FCL-00288_0").hide();
				$("#UK-FCL-00113_0").attr("readonly",false);
				$("#UK-FCL-00095_0").prop("disabled", false);			 
		}		
	});
	
	$("#UK-FCL-00095_0").on("change",function(){
		if($(this).val()){
			
			if($(this).val()=='Common shares'){
				$("#div_UK-FCL-00265_0").hide();
				$("#div_UK-FCL-00266_0").hide();
				$("input[name=UK-FCL-00265_0]").prop('checked', false);
				$("#UK-FCL-00266_0").val("");	
				$("#UK-FCL-00113_0").val("");
			}else{
				$("#div_UK-FCL-00265_0").show();
				if($(this).val()=="Preference shares"){
					$("#UK-FCL-00113_0").val("");
				}else{
					$("#UK-FCL-00113_0").val("");
				}
			}
		}else{
			$("#div_UK-FCL-00265_0").hide();
			$("#div_UK-FCL-00266_0").hide();
			$("input[name=UK-FCL-00265_0]").prop('checked', false);
			$("#UK-FCL-00266_0").val("");
			$("#UK-FCL-00113_0").val("");
			 
		}
		
	});
	
	var ff00265_0 = $('input[name=UK-FCL-00265_0]:checked').val(); 
	if(ff00265_0 == "Yes"){
		$("#div_UK-FCL-00266_0").show();		   
	}else{		
		$("#div_UK-FCL-00266_0").hide();		   
	}
	
	$('input[name=UK-FCL-00265_0]').change(function(){	 	
		if($(this).val()=="Yes"){
			$("#div_UK-FCL-00266_0").show();	
		}else{
			$("#div_UK-FCL-00266_0").hide();	    	
	    	$("#UK-FCL-00266_0").val("");
	    }
 	});

	// 2 to 3
	$("input[name=UK-FCL-00334_0]").on("change",function(){	
	// console.log($(this).val());
		if($(this).val()=='Yes'){
			if($('.chk_UK-FCL-00504_0 ')[0].checked){
					$("#div_UK-FCL-00116_0").show();
				}else{
					$("#div_UK-FCL-00116_0").hide();
				}
			$("#div_UK-FCL-00504_0").show();
			$(".chk_UK-FCL-00504_0 ")[0].checked = true;			
		}else{
			$("#div_UK-FCL-00504_0").hide();
			$(".chk_UK-FCL-00115_0 ").prop('checked', false);
			$("#div_UK-FCL-00116_0").hide();
			$("#UK-FCL-00116_0").val("");
		}
	});
	
	$(".chk_UK-FCL-00504_0 ").change(function(){
		if($(this).val()=='Other Restrictions'){
			if($(this).is(":checked")){
				$("#div_UK-FCL-00116_0").show();
			}else{
				$("#div_UK-FCL-00116_0").hide();
				$("#UK-FCL-00116_0").val("");
			}
			//
		}else{
			if($(this).is(":checked")){				
				
			}else{
				var cff00114 = $('input[name=UK-FCL-00334_0]:checked').val();
				// alert(cff00114);
				if(cff00114 =='Yes'){
					$(".chk_UK-FCL-00504_0 ")[0].checked = true;
				}
			}
		}
	});
	
	$("#UK-FCL-00116_0").keypress(function(){ 
		if($(this).val().length>=4000){
			return false;			       	
		}
	});

	var maxchars_0 = 100;
		$('#UK-FCL-00668_0').keyup(function () {
		    var tlength = $(this).val().length;
		    $(this).val($(this).val().substring(0, maxchars_0));
		    var tlength = $(this).val().length;
		    remain = maxchars_0 - parseInt(tlength);
		    $(".char_validation_1").remove();
		    if(remain == 0){
		      $("#UK-FCL-00668_0-error").parent('div').append("<div style='color:red;'  class='form-control-feedback-error char_validation_1'>Text Box to have a text limit of 100 characters</div>");
		      return false;
		    }
		});


	// 3point

	function third_show(){
		$("#div_UK-FCL-00240_0").show();
		$("#UK-FCL-00240_0").prop('required',true);	
	}
	function third_hide(){
		$("#div_UK-FCL-00240_0").hide();
	}
	
	var f0240_0 = $('input[name=UK-FCL-00240_0]:checked').val();
	if(f0240_0=="Fixed Number"){
			$("#div_UK-FCL-00241_0").show();
			$("#div_UK-FCL-00119_0").hide();			
		    $("#div_UK-FCL-00120_0").hide();
		}else{
			if(f0240_0=="In Range"){
				$("#div_UK-FCL-00119_0").show(); 
				$("#div_UK-FCL-00120_0").show();
				$("#div_UK-FCL-00241_0").hide();				
			}		
		}

	$("input[name=UK-FCL-00240_0]").on("change",function(){
		// console.log($(this).val());
		if($(this).val()=="Fixed Number"){
			$("#div_UK-FCL-00241_0").show();
			$("#div_UK-FCL-00119_0").hide();
			$("#UK-FCL-00119_0").val("");
		    $("#div_UK-FCL-00120_0").hide();
		    $("#UK-FCL-00120_0").val("");

		}else{
			if($(this).val()=="In Range"){
				$("#div_UK-FCL-00119_0").show(); $("#div_UK-FCL-00120_0").show();
				$("#div_UK-FCL-00241_0").hide();
				$("#UK-FCL-00241_0").val("");
			}else{
				$("#div_UK-FCL-00119_0").hide(); $("#div_UK-FCL-00120_0").hide();$("#div_UK-FCL-00241_0").hide();
				$("#UK-FCL-00119_0").val("");$("#UK-FCL-00120_0").val("");$("#UK-FCL-00241_0").val("");
			}			
		}		
	});

	$("#UK-FCL-00403_0").on("blur",function(){
		var reg_no = $(this).val();	
				$.ajax({
		            type: "POST",
		            dataType:'json',
		            url: "/backoffice/infowizardtwo/subFormArticleofamendmentform5/getcompanyNameByregno/reg_no/" + reg_no,
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

	var ff331 = $("#UK-FCL-00331_0").val();
	if(ff331){
			$("#div_UK-FCL-00331_0").show();
	    	$("#div_UK-FCL-00507_0").show();
	    	
			
				getcomapnyname(ff331);
			   	
	}else{
		// $("#div_UK-FCL-00331_0").hide();
	    	// $("#div_UK-FCL-00507_0").hide();
	}




	$('input[name=UK-FCL-00502_0]').change(function(){	 	
		if($(this).val()=="Yes"){
			$("#div_UK-FCL-00331_0").show();
	    	$("#div_UK-FCL-00507_0").show();	    	
		}else{
			// $("#div_UK-FCL-00331_0").hide();
	    	$("#div_UK-FCL-00507_0").hide();	    	
	    	$("#UK-FCL-00331_0").val("");
	    	$("#UK-FCL-00507_0").val("");
	    	
		}
 	});

 	

	
	$("#UK-FCL-00331_0").on("blur",function(){
		var srn_no = $(this).val();
		getcomapnyname(srn_no);
			 
	});
});

	//4 point

	function fourth_show(){
		$("#div_UK-FCL-00122_0").show();
		// $("#UK-FCL-00240_0").prop('required',true);	
	}
	function fourth_hide(){
		$("#div_UK-FCL-00122_0").hide();
		
		
	}

	function five_show(){
		$("#div_UK-FCL-00306_0").show();
			
	}
	function five_hide(){
		$("#div_UK-FCL-00306_0").hide();
	}

	function six_show(){
		$("#div_UK-FCL-00233_0").show();
			
	}
	function six_hide(){
		$("#div_UK-FCL-00233_0").hide();
	}


function getcomapnyname(srn_no){
	if(srn_no!=""){
				$.ajax({
		            type: "POST",
		            dataType:'json',
		            url: "/backoffice/infowizardtwo/subFormArticleofamendmentform5/getCompanyNameBySrnNo/srn_no/" + srn_no +"/subID/<?= isset($_GET['subID']) ? $_GET['subID'] : NULL ?>",
		            beforeSend:function(){
		            	$("#UK-FCL-00088_0-error").text("Please wait...");	    	        	
		            },
		            success: function(result) {		            	
		            	if(result.status==true){
		            		if(result.app_status=='valid'){
		            			$("#UK-FCL-00507_0").val(result.name);
		            			$("#UK-FCL-00331_0-error").html("");		            			
		            		}else{
		            			$("#UK-FCL-00088_0-error").text(result.msg);			
		            			if ($("#UK-FCL-00507_0-error").length) {
									$("#UK-FCL-00507_0-error").text(errormessages.srn_msg001);
				    			}else{
				    				$("#div_UK-FCL-00507_0").find('div').append('<div  style="color:red;" id="UK-FCL-00507_0-error">'+errormessages.srn_msg001+'<br>'+errormessages.srn_msg002+'</div>');
				    			}    

				    			$("#UK-FCL-00507_0").val("");  
		            		}	            			            	
		            	}else{
		            		if(result.user){
		            			$("#UK-FCL-00331_0-error").text(result.msg);
		            		    $("#UK-FCL-00507_0").val("");	
		            		    $("#UK-FCL-00507_0-error").text("");
		            		}else{
		            			//alert(result.msg);
		            		}		            			            	
		            	}
		             //  console.log(result);
		            }
		        });
		}	
}


// add more

function addmorebtnchecksharecapitaldetail(){
	var nofapp = $("#UK-FCL-00262_0").val();
	var totalRowCount = 0;          
      totalRowCount =  $("#tbl_4211 td").closest("tr").length;
	if(nofapp<=totalRowCount){
		/*$("#title_UK-FCL-00262_0").append("<b style='color:red;' class='amalgamatingDetail'>Please Add Number of Shares Capital Details as Per Enter 'No. of classes of shares' Field.</b>");*/
		var scdem = "Please add details of the Shares Capital Details as per the number entered in this field 'No. of classes of shares'"; 
						if ($("#scd").length) {
							$("#scd").text(scdem);
		    			}else{
		    				$("#title_UK-FCL-00262_0").append('<b style="color:red;" id="scd">'+scdem+'</b>');
		    			}	
			var titleTot = jQuery("#title_UK-FCL-00262_0").offset().top;
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
 	if(div_id==1239){
		var respon = addmorebtncheckdirector();
		if(respon==false){
			return false;
		}
	}else{
		if(div_id==188){
			var respon = addmorebtncheckincorporation();
			if(respon==false){
				return false;
			}
		}else{
			if(div_id==4211){
				var respon = addmorebtnchecksharecapitaldetail();
			if(respon==false){
				return false;
			}
			}
		}
	}

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
						if(div_id==1239){
							
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

								if(formchk_id=='UK-FCL-00132_0' || checkfield==false || formchk_id=='UK-FCL-00134_0' || formchk_id=='UK-FCL-00093_0' || formchk_id=='UK-FCL-00372_0' || formchk_id=='UK-FCL-00096_0' || formchk_id=='UK-FCL-00137_0' || formchk_id=="UK-FCL-00480_0" || formchk_id=="UK-FCL-00481_0"){
									
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
										$(".form-control-feedback-addmore").remove();						td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' title='"+vall+"'  readonly/></td>";
													fieldsIDArr.push(formchk_id);		
									}	
						}	
						if(div_id==188){
							
								if(formchk_id=='UK-FCL-00140_0' || formchk_id=='UK-FCL-00142_0' || formchk_id=='UK-FCL-00143_0'){
										var labelData = $("#label_" + formchk_id).text();
									labelData=labelData.replace('('+formchk_id+')',"");
									//alert(formchk_id);
									$("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>This field is required</div>");						
									err = err + 1;
									return false;
									}else{
										$(".form-control-feedback-addmore").remove();
										td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' title='"+vall+"'  readonly/></td>";
													fieldsIDArr.push(formchk_id);		
									}	
						}	
						if(div_id==4211){
								
								if(formchk_id=='UK-FCL-00095_0' || formchk_id=='UK-FCL-00263_0' || formchk_id=='UK-FCL-00264_0' || formchk_id=='UK-FCL-00113_0'){
										var labelData = $("#label_" + formchk_id).text();
									labelData=labelData.replace('('+formchk_id+')',"");
									//alert(formchk_id);

									$("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>This field is required</div>");						
									err = err + 1;
									return false;
									}else{
										$(".form-control-feedback-addmore").remove();
										td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' title='"+vall+"'  readonly/></td>";
													fieldsIDArr.push(formchk_id);		
									}	
						}			
					}
					else {
						$(".form-control-feedback-addmore").remove();
						//console.log(typeVal);
						td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' title='"+vall+"'  readonly/></td>";
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
					$("input[name=middlenamecheckbox]").prop('checked', false);	
					$("#UK-FCL-00133_0").attr('readonly',false);
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
		
	// range validation
	
	
 }
</script>