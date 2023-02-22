<script type="text/javascript">
	$( window ).load(function() {
		$("#div_UK-FCL-0042011_0,#test").hide();
	});
	
   $(document).ready(function(){
	
	$("#UK-FCL-00701_0").attr("readonly",true);
	$("#UK-FCL-00113_0").attr("readonly",false);
	$("#UK-FCL-00712_0").attr("readonly",true);
	
	
	/* $("#UK-FCL-00702_0").blur(function(){
         validate();  
	}); */
	
	
	$("#label_UK-FCL-00137_0, #label_UK-FCL-00481_0").find('b').after('<span style="color:red;"> * </span>');
	$("#div_UK-FCL-00480_0").find('label > b').after('<span style="color:red;"> * </span>');

	$("#UK-FCL-00137_0").bind("keypress",function(){
	var regex=  new RegExp("^[ A-Za-z0-9(),.&:;-]*$"); //;
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
		if (!regex.test(key)) {
			return false;
		}
	});







	 //var checkboxchecked = $(".chk_UK-FCL-00706_0").checked = true;
	 $(".chk_UK-FCL-00706_0").prop("checked", true);

 $('input[type="checkbox"]').on("click", function (e) {
      if($(this).val() == 'The amalgamation agreement consists of all the required details as prescribed under section 207  of the Companies Act') {
      	 e.preventDefault();
        return false;

      }
})

  $('input[type="checkbox"]').on("click", function (e) {
       if($(this).val() == 'That all the companies have duly complied with the provisions of Section 207, 208 and 210 of the Companies Act') {
       	 e.preventDefault();
         return false;

       }
 })
   $('input[type="checkbox"]').on("click", function (e) {
        if($(this).val() == 'The shareholders of the Company have approved the said amalgamation by passing special resolutions of each class or series of the shareholders entitled to vote on the amalgamation.') {
        	 e.preventDefault();
          return false;

        }
  })
    $('input[type="checkbox"]').on("click", function (e) {
         if($(this).val() == 'A duly signed and stamped version of Amalgamation Agreement is attached to this Form') {
         	 e.preventDefault();
           return false;

         }
   })

    $('input[type="checkbox"]').on("click", function (e) {
         if($(this).val() == 'A Statutory Declaration as per Section 211 of the Companies Act of a director or an officer of each amalgamating company is attached to this Form') {
         	 e.preventDefault();
           return false;

         }
   })

	 $(".chk_UK-FCL-00707_0").prop("checked", true);

 $('input[type="checkbox"]').on("click", function (e) {
      if($(this).val() == 'The resolutions provide that ') {
      	 e.preventDefault();
        return false;

      }
})

  $('input[type="checkbox"]').on("click", function (e) {
       if($(this).val() == 'The resolutions provide that <br> (1) the shares of all but one of the amalgamating subsidiary companies will be cancelled without any repayment of capital in respect of the cancellation. <br> (2) he articles of amalgamation will be the same as the articles of incorporation of the amalgamating subsidiary company whose shares are not cancelled.<br>(3) The stated capital of the amalgamating subsidiary companies whose shares are cancelled will be added to the stated capital of the amalgamating') {
       	 e.preventDefault();
         return false;

       }
 })



 $(".chk_UK-FCL-00710_0").prop("checked", true);

 $('input[type="checkbox"]').on("click", function (e) {
      if($(this).val() == 'The amalgamation being filed through this form is between the two or more wholly-owned subsidiary companies of the same holding body corporate.') {
      	 e.preventDefault();
        return false;

      }
})
 $('input[type="checkbox"]').on("click", function (e) {
      if($(this).val() == 'The amalgamation is approved by a resolution of the directors of each amalgamating company.') {
      	 e.preventDefault();
        return false;

      }
})
 $('input[type="checkbox"]').on("click", function (e) {
      if($(this).val() == 'The resolutions provide that <br> (1) the shares of all but one of the amalgamating subsidiary companies will be cancelled without any repayment of capital in respect of the cancellation. <br> (2) the articles of amalgamation will be the same as the articles of incorporation of the amalgamating subsidiary company whose shares are not cancelled <br> (3)  the stated capital of the amalgamating subsidiary companies whose shares are cancelled will be added to the stated capital of the amalgamating') {
      	 e.preventDefault();
        return false;

      }
})
 $('input[type="checkbox"]').on("click", function (e) {
      if($(this).val() == 'A Statutory Declaration as per Section 211 of the Companies Act of a director or an officer of each amalgamating company is attached to this Form.') {
      	 e.preventDefault();
        return false;

      }
})










	
	$("#00706_01,#00707_01,#00710_01").hide();
	
	
	
	
	
	
		$("input[type='checkbox'].chk_UK-FCL-00706_0").change(function(){
			
			var a = $("input[type='checkbox'].chk_UK-FCL-00706_0");
			if(a.length != a.filter(":checked").length){
				return false;
				$("#00706_01").show();
				
				// $("#00706_01").hide();
			}else{
				$("#00706_01").hide();
				return true;
				
			}
		});
		
		//2 step
		$("input[type='checkbox'].chk_UK-FCL-00707_0").change(function(){
			
			var a = $("input[type='checkbox'].chk_UK-FCL-00707_0");
			if(a.length != a.filter(":checked").length){
				return false;
				$("#00707_01").show();
			}else{
				$("#00707_01").hide();
				return true;
				
			}
		});
		//3 step
		$("input[type='checkbox'].chk_UK-FCL-00710_0").change(function(){
			
			var a = $("input[type='checkbox'].chk_UK-FCL-00710_0");
			if(a.length != a.filter(":checked").length){
				return false;
				$("#00710_01").show();
			}else{
				$("#00710_01").hide();
				return true;
				
			}
		});
		
	
	$("#div_UK-FCL-00087_0").hide();
	
	$("#div_UK-FCL-00339_0,#div_UK-FCL-00098_0,#title_UK-FCL-00339_0, #title_UK-FCL-00240_0,#div_UK-FCL-00240_0, #div_UK-FCL-00334_0, #title_UK-FCL-00262_0,#div_UK-FCL-00262_0,#div_UK-FCL-00095_0,#div_UK-FCL-00263_0,#div_UK-FCL-00264_0,#div_UK-FCL-00265_0,#div_UK-FCL-00266_0,#div_UK-FCL-00113_0,#div_UK-FCL-00033_0,#div_UK-FCL-00262_01,#test, #div_UK-FCL-00703_0,#div_UK-FCL-00701_0,#div_UK-FCL-00420_0,#div_UK-FCL-0042011_0,  #div_UK-FCL-00700_0").hide();
	
	
		
	$("<div class='col-md-12' id='div_UK-FCL-0042011_0' style='margin-top:10px;'><strong id='div_UK-FCL-0042011_0'>Details of companies being amalgamated:</strong></div>").insertBefore("#div_UK-FCL-00420_0");
		
		
	
	$("<div class='col-md-12' id='div_UK-FCL-00703_0' style='margin-top:10px;'><strong><br></strong></div>").insertBefore("#div_UK-FCL-00703_0");
	
	$("<div class='col-md-12' id='div_UK-FCL-00403_01' style='margin-top:10px;'><strong>Name of amalgamating entity, which is to be retained:</strong></div>").insertBefore("#div_UK-FCL-00711_0");
	
	$("<div class='col-md-12' id='div_UK-FCL-00704_01' style='margin-top:10px;'><strong>Reserved name for the new company:</strong></div>").insertBefore("#div_UK-FCL-00704_0");
	
	$("<div class='col-md-12' id='test' style='margin-top:10px;'><strong>The classes and maximum number of shares that the company is authorised to issue:</strong></div>").insertBefore("#div_UK-FCL-00262_0");
	
	$("#UK-FCL-00420_0").on("blur",function(){
        var reg_no = $(this).val(); 
		var latest = [];	
		var oldest = [];	
		$("#tbl_4697 tr:not(:first)").each(function(index) {		
            if ($(this).length > 0) {  
				var latest1 =	$('#UK-FCL-00420_0').val(); 
				latest.push(latest1);
				var old_data1 =	$(this).find('input').val(); 
				oldest.push(old_data1);
            }
			
			
		});
			if(latest.length === 0 ){
				var old_data = $('#UK-FCL-00420_0').val();
				var latest_data = '';
			}else{
				var latest_data = latest[0];
				var old_data = oldest[0];
			}
			
			var old_data = old_data;
			var latest_data = latest_data;
			// console.log(old_data);
			$.ajax({
				type: "POST",
				dataType:'json',
				url: "/backoffice/infowizardtwo/subFormArticlesOfAmalgamationForm15/getcompanyNameByregno/reg_no/" + reg_no,
				data:{"old_data":old_data , "latest_data":latest_data},
				beforeSend:function(){
					$("#UK-FCL-00420_0-error").text("Please wait...");                      
				},
				success: function(result) {                     
					if(result.status==true){                            
							$("#UK-FCL-00420_0-error").text("");                 
							$("#UK-FCL-00701_0").val(result.cname);     
																	
					}else{
						$("#UK-FCL-00420_0-error").text(result.msg);                            
						$("#UK-FCL-00701_0").val("");                       
					}
				   console.log(result);
				}
			});                 
    });
	
	
	//match comp number 
	
	
	 
	
	 $("#UK-FCL-00711_0").on("blur",function(){
		
		var abc = $('#UK-FCL-00711_0').val();
		if(abc != 0){
			
		
		var arr = [];
		$("#tbl_4697 tr:not(:first)").each(function(index) {		
            if ($(this).length > 0) {  
               var cn =	$(this).find('input').val(); 
				arr.push(cn);
                             
            }
			// console.log(arr); 
			var reg_no = $("#UK-FCL-00711_0").val(); 
			 // console.log(reg_no);
			if(jQuery.inArray(reg_no,arr) != -1 ){
				$.ajax({
					type: "POST",
					dataType:'json',
					url: "/backoffice/infowizardtwo/subFormArticlesOfAmalgamationForm15/getcompanyNameByregno/reg_no/" + reg_no,
					beforeSend:function(){
						$("#UK-FCL-00711_0-error").text("Please wait...");                      
					},
					success: function(result) {                     
						if(result.status==true){                            
								$("#UK-FCL-00711_0-error").text("");                 
								$("#UK-FCL-00712_0").val(result.cname);     
																		
						}else{
							$("#UK-FCL-00711_0-error").text(result.msg);                            
							$("#UK-FCL-00712_0").val("");                       
						}
					   // console.log(result);
					}
				}); 
			}else{
				$("#UK-FCL-00711_0-error").text("Please ensure that the company entered here belongs to any one of the entities mentioned in field no. 03 above."); 
				$("#UK-FCL-00712_0").val(""); 				
			}
		
		});
		}else{
			$("#UK-FCL-00711_0-error").text("Please ensure that the company entered here belongs to any one of the entities mentioned in field no. 03 above."); 
				$("#UK-FCL-00712_0").val("");
		}
    }); 
	
	$("#div_UK-FCL-00704_0,#div_UK-FCL-00704_01,#div_UK-FCL-00705_0,#div_UK-FCL-00711_0,#div_UK-FCL-00403_01,#div_UK-FCL-00712_0").hide();
	
	$("#UK-FCL-00703_0").on("change",function(){
		if($(this).val()=='Yes'){
			$("#div_UK-FCL-00711_0").show();
			$("#div_UK-FCL-00403_01").show();
			$("#div_UK-FCL-00712_0").show();

			$("#div_UK-FCL-00704_0").hide();
			$("#div_UK-FCL-00704_01").hide();
			$("#div_UK-FCL-00705_0").hide();
		}else{
			$("#div_UK-FCL-00711_0").hide();
			$("#div_UK-FCL-00403_01").hide();
			$("#div_UK-FCL-00712_0").hide();
			
			$("#div_UK-FCL-00704_0").show();
			$("#div_UK-FCL-00704_01").show();
			$("#div_UK-FCL-00705_0").show();
			
		}
	});
	
	$("#UK-FCL-00704_0").bind("keypress",function(){
    var regex=  new RegExp("^[0-9]*$"); //;
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    }); 
    
    $("#UK-FCL-00704_0").on("blur",function(){
        var srn_no = $(this).val();
        getcomapnyname(srn_no);
             
    });
     
    function getcomapnyname(srn_no){
        if(srn_no!=""){
			$.ajax({
				type: "POST",
				dataType:'json',
				url: "/backoffice/infowizardtwo/subFormArticlesOfAmalgamationForm15/getCompanyNameBySrnNo/srn_no/" + srn_no +"/subID/<?= isset($_GET['subID']) ? $_GET['subID'] : NULL ?>",
				beforeSend:function(){
					$("#UK-FCL-00704_0-error").text("Please wait...");                      
				},
				success: function(result) {                     
					if(result.status==true){
						if(result.app_status=='valid'){
							$("#UK-FCL-00705_0").val(result.name);
							$("#UK-FCL-00704_0-error").html("");
							$("#UK-FCL-00705_0-error").html("");    
						}else{
							$("#UK-FCL-00704_0-error").text(result.msg);            
							if ($("#UK-FCL-00705_0-error").length) {
								$("#UK-FCL-00705_0-error").text(errormessages.srn_msg001);
							}else{
								$("#div_UK-FCL-00705_0").find('div').append('<div  style="color:red;" id="UK-FCL-00705_0-error">'+errormessages.srn_msg001+'<br>'+errormessages.srn_msg002+'</div>');
							}    

							$("#UK-FCL-00705_0").val("");  
						}                                           
					}else{
						if(result.user){
							$("#UK-FCL-00704_0-error").text(result.msg);
							$("#UK-FCL-00705_0").val("");   
							$("#UK-FCL-00705_0-error").text("");
						}else{
							//alert(result.msg);
						}                                               
					}
				 //  console.log(result);
				}
			});
        }   
    }
	
	//share detail
	$("#UK-FCL-00262_0").on("change",function(){
		if($(this).val()){
			if($(this).val()=='1'){
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
				$("#div_UK-FCL-00266_0").show();
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
	
	$('input[name=UK-FCL-00265_0]').change(function(){	 	
		if($(this).val()=="Yes"){
			$("#div_UK-FCL-00266_0").show();	
		}else{
			$("#div_UK-FCL-00266_0").hide();	    	
	    	$("#UK-FCL-00266_0").val("");
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
	
	$("#div_UK-FCL-00709_0,#div_UK-FCL-00116_0").hide();
	//share the company trans
	$("#UK-FCL-00334_0").on("change",function(){	
		if($(this).val()=='Yes'){
			if($('.chk_UK-FCL-00709_0 ')[0].checked){
					$("#div_UK-FCL-00116_0").show();
				}else{
					$("#div_UK-FCL-00116_0").hide();
				}
			$("#div_UK-FCL-00709_0").show();
			// $(".chk_UK-FCL-00709_0 ")[0].checked = true;			
		}else{
			$("#div_UK-FCL-00709_0").hide();
			$(".chk_UK-FCL-00115_0 ").prop('checked', false);
			$("#div_UK-FCL-00116_0").hide();
			$("#UK-FCL-00116_0").val("");
		}
	});
	
	$(".chk_UK-FCL-00709_0 ").change(function(){
		if($(this).val()=='Other Restrictions'){
			if($(this).is(":checked")){
				$("#div_UK-FCL-00116_0").show();
				
				// $("<div class='col-md-12' id='div_UK-FCL-00116_01' style='margin-top:10px;color:red'><strong id='div_UK-FCL-00116_0'>In case the text exceeds 4000 characters, please attach a schedule in prescribed format to this Form under document listing tab at the end.</strong></div>").insertAfter("#div_UK-FCL-00116_0");
				
				
			}else{
				$("#div_UK-FCL-00116_0").hide();
				$("#UK-FCL-00116_0").val("");
				$("#UK-FCL-00116_01").hide();
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
	
	/* var maxLength = 15;
	$('#UK-FCL-00116_0').keyup(function() {
	  var textlen = maxLength - $(this).val().length;
	  $('#UK-FCL-00116_0').text(textlen);
	});
	var maxLength = 15; */
	$("<div class='col-md-12' id='precontract' style='margin-top:10px;color:red'><strong id='precontract'></strong></div>").insertAfter("#div_UK-FCL-00116_0");
	$("#UK-FCL-00116_0").keypress(function(){ 
		
		if($(this).val().length>=4000){
			$("#precontract").html("Character not more than 4000");
				
			
			
			return false;
						
		} 
	}); 
	
	//last two field COMPLIANCE DETAILS
	$("#div_UK-FCL-00706_0,#div_UK-FCL-00707_0,#title_UK-FCL-00706_0, #div_UK-FCL-00710_0").hide();
	
	$("#UK-FCL-00699_0").on("change",function(){
		// alert($(this).val());
		if($(this).val()){
			if($(this).val()=='Long Form Amalgamation by Agreement'){
				$("#title_UK-FCL-00706_0").show();
				$("#div_UK-FCL-00706_0").show();
				$("#div_UK-FCL-00707_0").hide();
				$("#div_UK-FCL-00710_0").hide();
				
				$("#00707_01,#00710_01").hide();
				
				$("#div_UK-FCL-00087_0,#div_UK-FCL-00339_0,#div_UK-FCL-00098_0,#title_UK-FCL-00339_0, #title_UK-FCL-00240_0,#div_UK-FCL-00240_0, #div_UK-FCL-00334_0, #title_UK-FCL-00262_0,#div_UK-FCL-00262_0,#div_UK-FCL-00095_0,#div_UK-FCL-00263_0,#div_UK-FCL-00264_0,#div_UK-FCL-00265_0,#div_UK-FCL-00266_0,#div_UK-FCL-00113_0,#div_UK-FCL-00033_0,#div_UK-FCL-00262_01,#test, #div_UK-FCL-00703_0,#div_UK-FCL-00701_0,#div_UK-FCL-00420_0,#div_UK-FCL-0042011_0,  #div_UK-FCL-00700_0").show();
				
				
				
			}else if($(this).val()=='Vertical Short Form Amalgamation'){
				$("#div_UK-FCL-00706_0").hide();
				$("#div_UK-FCL-00710_0").hide();
				$("#div_UK-FCL-00707_0").show();
				$("#title_UK-FCL-00706_0").show();
				
				$("#00706_01,#00710_01").hide();
				
				$("#div_UK-FCL-00087_0,#div_UK-FCL-00339_0,#div_UK-FCL-00098_0,#title_UK-FCL-00339_0, #title_UK-FCL-00240_0,#div_UK-FCL-00240_0, #div_UK-FCL-00334_0, #title_UK-FCL-00262_0,#div_UK-FCL-00262_0,#div_UK-FCL-00095_0,#div_UK-FCL-00263_0,#div_UK-FCL-00264_0,#div_UK-FCL-00265_0,#div_UK-FCL-00266_0,#div_UK-FCL-00113_0,#div_UK-FCL-00033_0,#div_UK-FCL-00262_01,#test, #div_UK-FCL-00703_0,#div_UK-FCL-00701_0,#div_UK-FCL-00420_0,#div_UK-FCL-0042011_0,  #div_UK-FCL-00700_0").show();
				
			}else if($(this).val()=='Horizontal Short Form Amalgamation'){
				
				$("#div_UK-FCL-00087_0,#div_UK-FCL-00339_0,#div_UK-FCL-00098_0,#title_UK-FCL-00339_0, #title_UK-FCL-00240_0,#div_UK-FCL-00240_0, #div_UK-FCL-00334_0, #title_UK-FCL-00262_0,#div_UK-FCL-00262_0,#div_UK-FCL-00095_0,#div_UK-FCL-00263_0,#div_UK-FCL-00264_0,#div_UK-FCL-00265_0,#div_UK-FCL-00266_0,#div_UK-FCL-00113_0,#div_UK-FCL-00033_0,#div_UK-FCL-00262_01,#test, #div_UK-FCL-00703_0,#div_UK-FCL-00701_0,#div_UK-FCL-00420_0,#div_UK-FCL-0042011_0,  #div_UK-FCL-00700_0").show();
				
				$("#00706_01,#00707_01").hide();
				
				$("#div_UK-FCL-00710_0").show();
				$("#div_UK-FCL-00707_0").hide();
				$("#title_UK-FCL-00706_0").hide();
				$("#title_UK-FCL-00706_0").hide();
				$("#div_UK-FCL-00706_0").hide();
				$("#title_UK-FCL-00706_0").show();
				
				
			}else{
				$("#div_UK-FCL-00087_0,#div_UK-FCL-00339_0,#div_UK-FCL-00098_0,#title_UK-FCL-00339_0, #title_UK-FCL-00240_0,#div_UK-FCL-00240_0, #div_UK-FCL-00334_0, #title_UK-FCL-00262_0,#div_UK-FCL-00262_0,#div_UK-FCL-00095_0,#div_UK-FCL-00263_0,#div_UK-FCL-00264_0,#div_UK-FCL-00265_0,#div_UK-FCL-00266_0,#div_UK-FCL-00113_0,#div_UK-FCL-00033_0,#div_UK-FCL-00262_01,#test, #div_UK-FCL-00703_0,#div_UK-FCL-00701_0,#div_UK-FCL-00420_0,#div_UK-FCL-0042011_0,  #div_UK-FCL-00700_0").hide();
				
				$("#00706_01,#00707_01,#00710_01").hide();
			}
		}else{
				$("#div_UK-FCL-00087_0,#div_UK-FCL-00339_0,#div_UK-FCL-00098_0,#title_UK-FCL-00339_0, #title_UK-FCL-00240_0,#div_UK-FCL-00240_0, #div_UK-FCL-00334_0, #title_UK-FCL-00262_0,#div_UK-FCL-00262_0,#div_UK-FCL-00095_0,#div_UK-FCL-00263_0,#div_UK-FCL-00264_0,#div_UK-FCL-00265_0,#div_UK-FCL-00266_0,#div_UK-FCL-00113_0,#div_UK-FCL-00033_0,#div_UK-FCL-00262_01,#test, #div_UK-FCL-00703_0,#div_UK-FCL-00701_0,#div_UK-FCL-00420_0,#div_UK-FCL-0042011_0,  #div_UK-FCL-00700_0").hide();
				
				$("#div_UK-FCL-00707_0").hide();
				$("#title_UK-FCL-00706_0").hide();
				$("#title_UK-FCL-00706_0").hide();
				$("#div_UK-FCL-00706_0").hide();
				
				$("#00706_01,#00707_01,#00710_01").hide();
			}
	});
	//director detail
	
		$("#UK-FCL-00089_0,#UK-FCL-00601_0,#UK-FCL-00603_0").attr('readonly',true);
		$("#UK-FCL-00604_0").attr("min","1");
		$("#UK-FCL-00605_0").attr("min","1");
		var deaultsrn = $("#UK-FCL-00331_0").val();
		if(deaultsrn){
			getcomapnyname(deaultsrn);
		}
	
		var sdinorr = $('input[name=UK-FCL-00240_0]:checked').val();
		if(sdinorr=="Fixed Number of Directors"){
			$("#div_UK-FCL-00241_0").show();
			// $("UK-FCL-00131_0").val($("#UK-FCL-00241_0").val());
				$("#div_UK-FCL-00604_0").hide(); $("#div_UK-FCL-00605_0").hide();
		}else{
			if(sdinorr=="Minimum and Maximum number of Directors"){
				$("#div_UK-FCL-00604_0").show(); $("#div_UK-FCL-00605_0").show();
						$("#div_UK-FCL-00241_0").hide();
			}else{
				$("#div_UK-FCL-00604_0").hide(); $("#div_UK-FCL-00605_0").hide();$("#div_UK-FCL-00241_0").hide();
			}
		}

		$("input[name=UK-FCL-00240_0]").on("change",function(){
			if($(this).val()=="Fixed Number of Directors"){
				$("#div_UK-FCL-00241_0").show();
				$("#div_UK-FCL-00604_0").hide();
				$("#UK-FCL-00604_0").val("");
				$("#div_UK-FCL-00605_0").hide();
				$("#UK-FCL-00605_0").val("");

			}else{
				if($(this).val()=="Minimum and Maximum number of Directors"){
					$("#div_UK-FCL-00604_0").show(); $("#div_UK-FCL-00605_0").show();
					$("#div_UK-FCL-00241_0").hide();
					$("#UK-FCL-00241_0").val("");
				}else{
					$("#div_UK-FCL-00604_0").hide(); $("#div_UK-FCL-00605_0").hide();$("#div_UK-FCL-00241_0").hide();
					$("#UK-FCL-00604_0").val("");$("#UK-FCL-00605_0").val("");$("#UK-FCL-00241_0").val("");
				}           
			}       
		});
    
		$("#UK-FCL-00604_0").blur(function(){
			var maxnu = $("#UK-FCL-00605_0").val();
			if(maxnu){
				if(parseInt($(this).val())>=parseInt(maxnu)){
				$("#UK-FCL-00604_0-error").text("Minimum number should be less than the Maximum number");
				}else{
					$("#UK-FCL-00604_0-error").text("");
					$("#UK-FCL-00605_0-error").text("");
				}
			}       
		});

		$("#UK-FCL-00605_0").blur(function(){
			var minnu = $("#UK-FCL-00604_0").val();
			if(minnu){
				if(parseInt($(this).val())<=parseInt(minnu)){
					$("#UK-FCL-00605_0-error").text("Maximum number should be greater than the Minimum number");
				}else{
					$("#UK-FCL-00605_0-error").text("");
					$("#UK-FCL-00604_0-error").text("");
				}
			}
		});
		
		$("#UK-FCL-00241_0").blur(function(){
			if(parseInt($(this).val())<= 0){
			$("#UK-FCL-00241_0-error").text("Number of Directors should be greater than 0");
		    }else{
				$("#UK-FCL-00241_0-error").text("");
			}
		});
		
		
		//form 4
		
		$('#UK-FCL-00340_0, #UK-FCL-00341_0, #UK-FCL-00344_0, #UK-FCL-00342_0, #UK-FCL-00346_0, #UK-FCL-00343_0, #UK-FCL-00348_0, #UK-FCL-00350_0').keyup(function(){
			$(this).val($(this).val().toUpperCase());
		});
	
	   $("<div class='col-md-12' id='form2regisaddtitle' style='margin-top:10px;'><strong>Address of Registered office:</strong></div>").insertBefore("#div_UK-FCL-00340_0");
	   
	   $("<div class='col-md-12' id='form2mailaddtitle' style='margin-top:10px;'><strong>Mailing Address of the company:</strong></div>").insertBefore("#div_UK-FCL-00342_0");
	   
		//Address detail form 4
		
		$("#UK-FCL-00344_0").prop('readonly',true);
		$("#UK-FCL-00347_0").prop('readonly',true);
		$("#UK-FCL-00347_0").val("BARBADOS");
	
		var f0493_0 = $('input[name=UK-FCL-00493_0]:checked').val();
		if(f0493_0=='Yes'){
			$("#UK-FCL-00342_0").val($("#UK-FCL-00340_0").val());
			$("#UK-FCL-00343_0").val($("#UK-FCL-00341_0").val());

			$("#UK-FCL-00351_0").val(829).trigger("change");	  	

			$("#UK-FCL-00348_0").val($("#UK-FCL-00344_0").val());
			$("#UK-FCL-00350_0").val($("#UK-FCL-00346_0").val());	 
			$("#UK-FCL-00349_0").val($("#UK-FCL-00345_0 option:selected").val());	

			$("#UK-FCL-00342_0, #UK-FCL-00343_0, #UK-FCL-00348_0, #UK-FCL-00350_0").prop('readonly',true);

			$("#UK-FCL-00351_0, #UK-FCL-00349_0").prop('disabled',true);

			$("#div_UK-FCL-00348_0").append("<div id='getcontrystate'><input type='hidden' name='UK-FCL-00351_0' value='829'/><input type='hidden' name='UK-FCL-00349_0' value='"+$("#UK-FCL-00349_0").val()+"'/></div>");
		}else{

		}
		$("input[name=UK-FCL-00493_0]").on("change",function(){	
		  if($(this).val()=='Yes'){
			$("#UK-FCL-00342_0").val($("#UK-FCL-00340_0").val());
			$("#UK-FCL-00343_0").val($("#UK-FCL-00341_0").val());

			$("#UK-FCL-00351_0").val(829).trigger("change");	  	

			$("#UK-FCL-00348_0").val($("#UK-FCL-00344_0").val());
		  //	$("#UK-FCL-00350_0").val($("#UK-FCL-00346_0 option:selected").text());	 
			$("#UK-FCL-00350_0").val($("#UK-FCL-00346_0").val());
			$("#UK-FCL-00342_0, #UK-FCL-00343_0, #UK-FCL-00348_0, #UK-FCL-00350_0").prop('readonly',true);

			$("#UK-FCL-00351_0, #UK-FCL-00349_0").prop('disabled',true);

			$("#div_UK-FCL-00348_0").append("<div id='getcontrystate'><input type='hidden' name='UK-FCL-00351_0' value='829'/><input type='hidden' name='UK-FCL-00349_0' value='"+$("#UK-FCL-00349_0").val()+"'/></div>");

		  }else{

			$("#getcontrystate").html("");
			$("#UK-FCL-00351_0, #UK-FCL-00349_0").val("").trigger("change");
			$("#UK-FCL-00342_0, #UK-FCL-00343_0, #UK-FCL-00348_0, #UK-FCL-00350_0").val("");

			$("#UK-FCL-00342_0, #UK-FCL-00343_0, #UK-FCL-00348_0, #UK-FCL-00350_0").prop('readonly',false);
			$("#UK-FCL-00351_0, #UK-FCL-00349_0").prop('disabled',false);
		  }
		});
		
		$("#UK-FCL-00351_0").on('change', function() {
	
        var countryCode = $(this).val();
			if(countryCode==829){
                $("#UK-FCL-00348_0").val('');
                $("#UK-FCL-00348_0").attr('readonly',true);
            }else{
                $("#UK-FCL-00348_0").attr('readonly',false);
            }    		
			if(countryCode){
				$.ajax({
					type: "POST",
					url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
					success: function(result) {
						//alert(result);
						$("#UK-FCL-00349_0").html(result);
					var ff00493_0 = $('input[name=UK-FCL-00493_0]:checked').val();
						if(ff00493_0=='Yes'){
							$("#UK-FCL-00349_0").val($("#UK-FCL-00345_0").val()).trigger("change");
						}
						
					}
				});
			}else{
				$("#UK-FCL-00349_0").html("<option>Please select</option>");
			}
		});
		
	// form 9
		 $("<div class='col-md-12' id='form2regisaddtitle' style='margin-top:10px;'><strong>The details of the directors of the company as of this date are:</strong></div>").insertBefore("#div_UK-FCL-00132_0");
		 
		$("#UK-FCL-00131_0").on("change",function(){
			if($("#UK-FCL-00131_0-error").length){
				$("#UK-FCL-00131_0-error").remove();
			}
			var min = parseInt($("#UK-FCL-00604_0").val()); 
			var max = parseInt($("#UK-FCL-00605_0").val());
			var cdn = parseInt($(this).val());
			// alert(cdn);
			if(cdn>0){ 
				if(cdn<min || cdn>max){
					$(this).val(""); 
					if ($("#UK-FCL-00131_0-error").length) { //alert($("#UK-FCL-00131_0-error").length);
						//$("#UK-FCL-00131_0-error").text('Enter no. within range '+min+' - '+max);
						if($("#UK-FCL-00131_0-error").length>1)
						{
							$("#UK-FCL-00131_0-error").remove();
						}
						$("#UK-FCL-00131_0-error").text('Please enter the number as provided in the previous form, the number must fall within the range provided');
					}else{
						//$("#div_UK-FCL-00131_0").find('div').append('<div id="UK-FCL-00131_0-error" class="form-control-feedback">Enter no. within range ' +min+' - '+max+'</div>');
						$("#div_UK-FCL-00131_0").find('div').append('<div id="UK-FCL-00131_0-error" class="form-control-feedback">Please enter the number as provided in the previous form, the number must fall within the range provided</div>');
						
					}    
					
				}else{
					$("#UK-FCL-00131_0-error").text("");
				}
			}
	
		});

		$("#UK-FCL-00604_0").blur(function(){
			if(parseInt($(this).val())<= 0){
			$("#UK-FCL-00604_0-error").text("Minimum number should be greater than 0");
		    }else{
				$("#UK-FCL-00604_0-error").text("");
			}
			
				
		});
		$("#UK-FCL-00604_0").blur(function(){
			var maxnu = $("#UK-FCL-00605_0").val();
			if(maxnu){
				if(parseInt($(this).val())>=parseInt(maxnu)){
				$("#UK-FCL-00604_0-error").text("Minimum number should be less than the Maximum number");
				}else{
					$("#UK-FCL-00604_0-error").text("");
					$("#UK-FCL-00605_0-error").text("");
				}
			}		
		});

	$("#UK-FCL-00605_0").blur(function(){
		var minnu = $("#UK-FCL-00604_0").val();
		if(minnu){
		if(parseInt($(this).val())<=parseInt(minnu)){
			$("#UK-FCL-00605_0-error").text("Maximum number should be greater than the Minimum number");
		}else{
			$("#UK-FCL-00605_0-error").text("");
			$("#UK-FCL-00604_0-error").text("");
		}
	}
	});
	
	
		var pro = $("#UK-FCL-00481_0").val("");
		if(pro == '' || pro == "NA"){
			$("#input_UK-FCL-00481_0").append("<div class='form-control-feedback-addmore'>This field is required</div>");
					e.stop();
					e.preventDefault();
					return false;
		}
		
		$("#div_UK-FCL-00481_0").hide();
		$("input[name=UK-FCL-00480_0]").on("change",function(){
			if($(this).val()=="Yes"){
				$("#div_UK-FCL-00481_0").show();
				
			}else{
				$("#div_UK-FCL-00481_0").hide();
				$("#UK-FCL-00481_0").val("NA");
			}
		});
		
		$("#UK-FCL-00133_0").bind("keypress",function(){
			var regex=  new RegExp("^[ A-Za-z]*$"); //;
			var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
			if (!regex.test(key)) {
				return false;
			}
		});
		
		$('#UK-FCL-00132_0, #UK-FCL-00133_0, #UK-FCL-00134_0, #UK-FCL-00093_0, #UK-FCL-00309_0, #UK-FCL-00310_0, #UK-FCL-00094_0').keyup(function(){
        $(this).val($(this).val().toUpperCase());
		});
		
		//middele checkbox
		$("#div_UK-FCL-00133_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox' name='middlenamecheckbox'> I do not have a middle name or middle initial</div>");

		$("#UK-FCL-00133_0").blur(function(){
			if($(this).val()){
				$("input[name=middlenamecheckbox]").prop('checked', false);	
			}
		});

		$("input[name=middlenamecheckbox]").change(function(){
			if($(this).is(':checked')){
				$("#UK-FCL-00133_0").val("");
				$("#UK-FCL-00133_0").attr('readonly',true);		
			}else{
				$("#UK-FCL-00133_0").attr('readonly',false);
			}
		});
		
		// parish
		$("#UK-FCL-00096_0").on('change', function() {
        var countryCode = $(this).val();
		if(countryCode==829){
                $("#UK-FCL-00310_0").val('');
                $("#UK-FCL-00310_0").attr('readonly',true);
            }else{
                $("#UK-FCL-00310_0").attr('readonly',false);
            }    		
			$("#UK-FCL-00372_0").select2("val","");
			$.ajax({
				type: "POST",
				url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
				success: function(result) {
					//alert(result);
					$("#UK-FCL-00372_0").html(result);
					
				}
			});
		});
		
		
		
		//form 9 first step
		
   
   });  


		
	


   
   
   function addmorebtncheckdirector(){
	 var pro = $('input[name="UK-FCL-00480_0"]:checked').val();
	var nofapp = $("#UK-FCL-00131_0").val();
	var totalRowCount = 0;          
      totalRowCount =  $("#tbl_4683 td").closest("tr").length;
		if(nofapp<=totalRowCount){
			/*$("#title_UK-FCL-00131_0").append("<b style='color:red;' class='amalgamatingDetail'>Please Add Number of Director as Per Enter 'No. of directors of the company as of this date are' Field.</b>");*/
			var dem = "Please add details of the Director as per the number entered in this field 'No. of directors of the company as of this date are' Field"; 
							if ($("#directorerrormessage").length) {
								$("#directorerrormessage").text(dem);
							}else{
								$("#title_UK-FCL-00131_0").append('<b style="color:red;" id="directorerrormessage">'+dem+'</b>');
							}
				var titleTot = jQuery("#title_UK-FCL-00131_0").offset().top;
				var addHeight = parseInt(titleTot) - 170;
				jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
				e.stop();
				e.preventDefault();
				return false;
		}
		else if(pro =="Yes"){
			
				var pro = $("#UK-FCL-00481_0").val();
				if(pro == '' || pro == "NA"){
					$(".form-control-feedback-addmore").remove();
					$("#input_UK-FCL-00481_0").append("<div class='form-control-feedback-addmore'>This field is required</div>");
					e.stop();
					e.preventDefault();
					return false;
				}
	
			
		}
		else{
			$("#directorerrormessage").text("");
			return true;	
		}
		
		

	}

    
    function addmoreaction(id,service_id,div_id){

    /* if(div_id==4697){
    	var respon = addmorebtncheckemail();
    	if(respon==false){
    		return false;
    	}
    } */
     
    if(div_id==4683){
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
					let formdata2 = $("#UK-FCL-00480_0").val();
   					if(div_id==2015){

   									if(formchk_id=='UK-FCL-00466_0'){
   								var mnt = $("#UK-FCL-00466_0").val();
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
   							if(formchk_id=='UK-FCL-00397_0' || formchk_id=='UK-FCL-00398_0' || formchk_id=='UK-FCL-00468_0' || formchk_id == 'UK-FCL-00384_0' || formchk_id=='UK-FCL-00372_0'||formchk_id=='UK-FCL-00239_0'||  checkfield == false){

   								var labelData = $("#label_" + formchk_id).text();
   								labelData=labelData.replace('('+formchk_id+')',"");
   								//alert(formchk_id);
   								if(formchk_id=="UK-FCL-00466_0"){
   											$("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>Please enter the required information or select the check box</div>");
   									}else{
   										
   											$("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>This field is required</div>");
   																			
   									}					
   								err = err + 1;
   								return false;
   								}else{
   									$(".form-control-feedback-addmore").remove();
   									/*if(formchk_id=='UK-FCL-00133_0' || formchk_id=='UK-FCL-00137_0'){
   										if(vall==""){
   											vall = 'NA';
   										}
   									}*/
   									td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
   												fieldsIDArr.push(formchk_id);		
   								}	
   					}	
   					if(div_id==4683){
   							
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
   									
   								if(formchk_id=='UK-FCL-00132_0' || checkfield==false || formchk_id=='UK-FCL-00134_0' || formchk_id=='UK-FCL-00093_0' || formchk_id=='UK-FCL-00372_0' || formchk_id=='UK-FCL-00096_0' || formchk_id=='UK-FCL-00137_0' || formchk_id=="UK-FCL-00480_0" ||  (formdata2=='Yes' && formdataval2=="")){
   									
   									var labelData = $("#label_" + formchk_id).text();

   									labelData=labelData.replace('('+formchk_id+')',"");

   									if(formdata2=='Yes' && formdataval2==""){
                                       $("#input_UK-FCL-00481_0").append("<div class='form-control-feedback-addmore'>This field is required</div>");
                               }
   									//alert(formchk_id);
   									else if(formchk_id=="UK-FCL-00133_0"){
   											$("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>Please enter the required information or select the check box</div>");
   									}else{
   										
   											$("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>This field is required</div>");
   																			
   									}
   															
   									err = err + 1;
   									return false;
   									}else{
   										$(".form-control-feedback-addmore").remove();
   										/*if(formchk_id=='UK-FCL-00133_0' || formchk_id=='UK-FCL-00137_0'){
   											if(vall==""){
   												vall = 'NA';
   											}
   										}*/
   										td_ += '<td><input type="text" name="' + formchk_id + '[]" value="' + vall + '" class="form-control" title="'+vall+'"  readonly/></td>';
   													fieldsIDArr.push(formchk_id);		
   									}	
   						}
   					
   					if(div_id==4645){
   								
   						if(formchk_id=='UK-FCL-00095_0' || formchk_id=='UK-FCL-00263_0' || formchk_id=='UK-FCL-00264_0' || formchk_id=='UK-FCL-00265_0'  || formchk_id=='UK-FCL-00113_0'){
   							var labelData = $("#label_" + formchk_id).text();
   							labelData=labelData.replace('('+formchk_id+')',"");
   									//alert(formchk_id);

   							$("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>This field is required</div>");						
   							err = err + 1;
   							return false;
   							}else{
   							$(".form-control-feedback-addmore").remove();
   							td_ += '<td><input type="text" name="' + formchk_id + '[]" value="' + vall + '" class="form-control" title="'+vall+'"  readonly/></td>';
   							fieldsIDArr.push(formchk_id);		
   							}	
   						}
   					if(div_id==4697){
   						    
   							if(formchk_id=='UK-FCL-00420_0' || formchk_id=='UK-FCL-00701_0'  ){
   									var labelData = $("#label_" + formchk_id).text();
   									labelData=labelData.replace('('+formchk_id+')',"");
   									
   									/* $("#UK-FCL-00702_0").blur(function(){
   									   validate();    
   									}); */
   									//alert(formchk_id);

   								$("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>This field is required</div>");						
   								err = err + 1;
   								return false;
   								}else{

   									$(".form-control-feedback-addmore").remove();
   									td_ += '<td><input type="text" name="' + formchk_id + '[]" value="' + vall + '" class="form-control" title="'+vall+'"  readonly/></td>';
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
    }
   
   

         
     
</script>

<script type="text/javascript">
   
       $(function () {
        $("#middlenamecheckbox").click(function () {
            var isChecked = $("#middlenamecheckbox").is(":checked");
            if (isChecked) {
                    $('#err00133_0').html('');
               // $("#err00105_0").removeClass("has-error");
            } else {
                //alert("CheckBox not checked.");
            }
        });
    });



</script>