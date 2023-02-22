<script type="text/javascript">
   $(document).ready(function(){

   	window.onload = function () {
   	     //Reference the DropDownList.
   	     var ddlYears = document.getElementById("UK-FCL-00569_0");
   	
   	     //Determine the Current Year.
   	     var currentYear = (new Date()).getFullYear();
   	
   	     //Loop and add the Year values to DropDownList.
   	     for (var i = 2006; i < currentYear; i++) {
   	         var option = document.createElement("OPTION");
   	         option.innerHTML = i;
   	         option.value = i;
   	         ddlYears.appendChild(option);
   	     }
   	 };


      // code here
       $('#div_UK-FCL-00186_0').hide();
       $('#div_UK-FCL-00138_0').hide();

      $("a.back_btn").css('visibility', 'hidden');
      	$("#UK-FCL-00089_0").attr('readonly',true);
      	$("#UK-FCL-00194_0").attr('readonly',true);
      	$("#UK-FCL-00340_0").attr('readonly',true);
      	$("#UK-FCL-00341_0").attr('readonly',true);
      	$("#UK-FCL-00347_0").attr('readonly',true);
      	$("#UK-FCL-00385_0").attr('readonly',true);
      	$("#UK-FCL-00344_0").attr('readonly',true);
      	$("#UK-FCL-00346_0").attr('readonly',true);
      	$("#UK-FCL-00570_0").attr('readonly',true);
      	$("#UK-FCL-00571_0").attr('readonly',true);
      	$("#UK-FCL-00573_0").attr('readonly',true);
      	$("#UK-FCL-00574_0").attr('readonly',true);
      	$("#UK-FCL-00132_0").attr('readonly',true);
      	$("#UK-FCL-00105_0").attr('readonly',true);
      	$("#UK-FCL-00106_0").attr('readonly',true);
      	$("#UK-FCL-00093_0").attr('readonly',true);
      	$("#UK-FCL-00309_0").attr('readonly',true);
      	$("#UK-FCL-00096_0").attr('readonly',true);
      	$("#UK-FCL-00129_0").attr('readonly',true);
      	$("#UK-FCL-00310_0").attr('readonly',true);
      	$("#UK-FCL-00094_0").attr('readonly',true);
    
    var ff403 = $("#UK-FCL-00403_0").val();
    if(ff403){
      getdetails(ff403);
    }
      	$("#UK-FCL-00403_0").on("blur",function(){
          if($(this).val()){  
            getdetails($(this).val());      	             
          }
      	});
      
 
   
   
   
   //attorney details
   $("#div_UK-FCL-00105_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox' name='middlenamecheckbox' disabled> I do not have a middle name or middle initial</div>");
   $("#UK-FCL-00105_0").blur(function(){
   	if($(this).val()){
   		$("input[name=middlenamecheckbox]").prop('checked', false);	
   	}
   });
   
   
   
   
      //director details
       $("#div_UK-FCL-00133_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox' name='middlenamecheckbox' disabled> I do not have a middle name or middle initial</div>");
   
   	    $("#UK-FCL-00133_0").blur(function(){
   		if($(this).val()){
   			$("input[name=middlenamecheckbox]").prop('checked', false);	
   		}
   		});
   
   		$("input[name=middlenamecheckbox]").change(function(){
   			var parentId=$(this).parent().parent().attr('id');
   			if(parentId=='div_UK-FCL-00105_0') {
   			   if($(this).is(':checked')){
   			     $("#UK-FCL-00105_0").val("");
   			     $("#UK-FCL-00105_0").attr('readonly', true);
   			   }
   			   else {
   			    $("#UK-FCL-00105_0").attr('readonly', true);
   			   }
   			   
   			}
   			else if(parentId=='div_UK-FCL-00133_0'){
   			     if($(this).is(':checked')) {
   			         $("#UK-FCL-00133_0").val("");
   			         $("#UK-FCL-00133_0").attr('readonly', true);
   			     } else {
   			         $("#UK-FCL-00133_0").attr('readonly', false);
   			     }
   			} 
   		});
   
   

    $("#UK-FCL-00572_0").attr('readonly',true);
   $("<div class='col-md-12' id='form1regisaddtitle' style='margin-top:10px;'><strong>Address of Registered or Head office:</strong></div>").insertBefore("#div_UK-FCL-00340_0");
   $("<div class='col-md-12' id='form1principalofficetitle' style='margin-top:10px;'><strong>Address of principal office, if any, in Barbados:</strong></div>").insertBefore("#div_UK-FCL-00570_0");
   $("<div class='col-md-12' id='form1sharecapitaltitle' style='margin-top:10px;'><strong>Share Capital:</strong></div>").insertBefore("#div_UK-FCL-00248_0");
   $("<div class='col-md-12' id='form1attorneytitle' style='margin-top:10px;'><strong>Name and address of Attorney or Attorneys appoint under Section 332:</strong></div>").insertBefore("#div_UK-FCL-00132_0");
   $("<div class='col-md-12' id='form1directortitle' style='margin-top:10px;'><strong>Director(s) of Company:</strong></div>").insertBefore("#div_UK-FCL-00150_0");
   // end director detail
    
   $("#UK-FCL-00096_0").on('change', function() {
      var countryCode = $(this).val();   
      if(countryCode==829){
	        	$("#UK-FCL-00310_0").val('');
	        	$("#UK-FCL-00310_0").attr('readonly',true);
	        }else{
	        	$("#UK-FCL-00310_0").attr('readonly',false);
	        }  
   $("#UK-FCL-00129_0").select2("val","");
      $.ajax({
          type: "POST",
          url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
          success: function(result) {
             $("#UK-FCL-00129_0").html(result);
       
          }
      });
  });
  
     $("#UK-FCL-00295_0").on('change', function() {
      var countryCode = $(this).val();    
      if(countryCode==829){
	        	$("#UK-FCL-00354_0").val('');
	        	$("#UK-FCL-00354_0").attr('readonly',true);
	        }else{
	        	$("#UK-FCL-00354_0").attr('readonly',false);
	        } 
   $("#UK-FCL-00372_0").select2("val","");
      $.ajax({
          type: "POST",
          url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
          success: function(result) {
             $("#UK-FCL-00372_0").html(result);
       
          }
      });
  });
     $("#UK-FCL-00347_0").on('change', function() {
      var countryCode = $(this).val();   
        if(countryCode==829){
            $("#UK-FCL-00344_0").val('');
            $("#UK-FCL-00344_0").attr('readonly',true);
        }else{
            $("#UK-FCL-00344_0").attr('readonly',false);
        }  
   $("#UK-FCL-00385_0").select2("val","");
      $.ajax({
          type: "POST",
          url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
          success: function(result) {
             $("#UK-FCL-00385_0").html(result);
       
          }
      });
  });



   $("#UK-FCL-00575_0").prop('readonly',true); 
   // $("#UK-FCL-00575_0").val("BARBADOS");
   
   
   	/*$("#UK-FCL-00403_0").bind("keypress",function(){
   	var regex=  new RegExp("^[0-9]*$"); //;
   	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
   	    if (!regex.test(key)) {
   	        event.preventDefault();
   	        return false;
   	    }
   	});	*/

      

       

        

        
   	
   });
   
     function getdetails(reg_no){
  
                    $.ajax({
                        type: "POST",
                        dataType:'json',
                        url: "/backoffice/infowizardtwo/subFormAnnualReturnForm31/getcompanyNameByregno/reg_no/" + reg_no,
                        beforeSend:function(){
                            $("#UK-FCL-00403_0-error").text("Please wait...");
                            $("#add_more_186, #add_more_138").html("");                      
                        },
                        success: function(result) {                     
                            if(result.status==true){                            
                                    $("#UK-FCL-00403_0-error").text("");                 
                                    $("#UK-FCL-00089_0").val(result.cname);     
                                    $("#UK-FCL-00340_0").val(result.regaddress1);  
								  $("#UK-FCL-00340_0").attr('readonly', true);
								  
								  $("#UK-FCL-00341_0").val(result.regaddress2);  
								  $("#UK-FCL-00341_0").attr('readonly', true);
								  
								  $("#UK-FCL-00347_0").val(result.officecountry);  
								  $("#UK-FCL-00347_0").attr('readonly', true);
								  
								  $("#UK-FCL-00385_0").val(result.regstate);  
								  $("#UK-FCL-00385_0").attr('readonly', true);
								  
								  $("#UK-FCL-00344_0").val(result.regcity);  
								  $("#UK-FCL-00344_0").attr('readonly', true);
								  
								  $("#UK-FCL-00346_0").val(result.regpostal);  
								  $("#UK-FCL-00346_0").attr('readonly', true);
								  
								  $("#UK-FCL-00570_0").val(result.priaddress1);  
								  $("#UK-FCL-00570_0").attr('readonly', true);
								  
								  $("#UK-FCL-00571_0").val(result.priaddress2);  
								  $("#UK-FCL-00571_0").attr('readonly', true);
								  
								  $("#UK-FCL-00572_0").val(result.pricity);  
								  $("#UK-FCL-00572_0").attr('readonly', true);
								  
								  $("#UK-FCL-00573_0").val(result.pristate);  
								  $("#UK-FCL-00573_0").attr('readonly', true);
								  
								  $("#UK-FCL-00574_0").val(result.pripostal);  
								  $("#UK-FCL-00574_0").attr('readonly', true);
								  
								  $("#UK-FCL-00575_0").val(result.pricountry);  
								  $("#UK-FCL-00575_0").attr('readonly', true);
								  
								  $("#UK-FCL-00194_0").val(result.pridate);  
								  $("#UK-FCL-00194_0").attr('readonly', true);
								  
								  $("#UK-FCL-00132_0").val(result.firstname);  
								  $("#UK-FCL-00132_0").attr('readonly', true);
								  
								  $("#UK-FCL-00105_0").val(result.middlename);  
								  $("#UK-FCL-00105_0").attr('readonly', true);
								  
								  $("#UK-FCL-00106_0").val(result.lastname);  
								  $("#UK-FCL-00106_0").attr('readonly', true);
								  
								  $("#UK-FCL-00093_0").val(result.address1);  
								  $("#UK-FCL-00093_0").attr('readonly', true);
								  
								  $("#UK-FCL-00309_0").val(result.address2);  
								  $("#UK-FCL-00309_0").attr('readonly', true);
								  
								  $("#UK-FCL-00096_0").val(result.attrcountry);  
								  $("#UK-FCL-00096_0").attr('readonly', true);
								  
								  $("#UK-FCL-00129_0").val(result.attstate);  
								  $("#UK-FCL-00129_0").attr('readonly', true);
								  
								  $("#UK-FCL-00310_0").val(result.attcity);  
								  $("#UK-FCL-00310_0").attr('readonly', true);
								  
								  $("#UK-FCL-00094_0").val(result.attcity);  
								  $("#UK-FCL-00094_0").attr('readonly', true);
								  
								  // share capital
								  $("#UK-FCL-00248_0").attr('readonly',true);
								  $("#UK-FCL-00249_0").attr('readonly',true);
								  $("#UK-FCL-00250_0").attr('readonly',true);
								  $("#UK-FCL-00256_0").attr('readonly',true);
								  $("#UK-FCL-00257_0").attr('readonly',true);
								  $("#UK-FCL-00258_0").attr('readonly',true);
								  $("#UK-FCL-00259_0").attr('readonly',true);
								  
								  //director detail 
								  $("#UK-FCL-00150_0").attr('readonly',true);
								  $("#UK-FCL-00133_0").attr('readonly',true);
								  $("#UK-FCL-00134_0").attr('readonly',true);
								  $("#UK-FCL-00169_0").attr('readonly',true);
								  $("#UK-FCL-00335_0").attr('readonly',true);
								  $("#UK-FCL-00295_0").attr('disabled',true);
								  $("#UK-FCL-00372_0").attr('disabled',true);
								  $("#UK-FCL-00354_0").attr('readonly',true);
								  $("#UK-FCL-00356_0").attr('readonly',true);
								  $("#UK-FCL-00137_0").attr('readonly',true);
								 
								  
								  /* $.each(result.fieldValues, function (key, val) {
									console.log(val);
								  }); */
								  $('#div_UK-FCL-00186_0').after(result.sharecapital_table);          
								  $('#div_UK-FCL-00138_0').after(result.director_table);
                  
                                                                            
                            }else{
                                $("#UK-FCL-00403_0-error").text(result.msg);                            
                                $("#UK-FCL-00089_0").val("");                       
                                $("#UK-FCL-00340_0").val("");                       
                                $("#UK-FCL-00341_0").val("");                       
                                $("#UK-FCL-00347_0").val("");                       
                                $("#UK-FCL-00385_0").val("");                       
                                $("#UK-FCL-00344_0").val("");                       
                                $("#UK-FCL-00346_0").val("");                       
                                $("#UK-FCL-00570_0").val("");                       
                                $("#UK-FCL-00571_0").val("");                       
                                $("#UK-FCL-00572_0").val("");                       
                                $("#UK-FCL-00573_0").val("");                       
                                $("#UK-FCL-00574_0").val("");                       
                                $("#UK-FCL-00575_0").val("");                       
                                $("#UK-FCL-00194_0").val("");                       
                                $("#UK-FCL-00132_0").val("");                       
                                $("#UK-FCL-00105_0").val("");                       
                                $("#UK-FCL-00106_0").val("");                       
                                $("#UK-FCL-00093_0").val("");                       
                                $("#UK-FCL-00309_0").val("");                       
                                $("#UK-FCL-00096_0").val("");                       
                                $("#UK-FCL-00129_0").val("");                       
                                $("#UK-FCL-00310_0").val("");                       
                                $("#UK-FCL-00094_0").val("");  
                $('.test').hide();                
                $('.director').hide();
              
                            }
                           //console.log(result);
                        }
                    });
     }
</script>