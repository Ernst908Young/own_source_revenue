<style type="text/css">
div#details1 {
    margin-top: 1em;
}

div#details2 {
    margin-top: 1em;
}

#details1, #details2{
	display: none;
}


</style>

<script type="text/javascript">

 $(document).ready(function(){


	 $("a.back_btn").css('visibility', 'hidden');
	$('#UK-FCL-00301_0, #UK-FCL-00466_0, #UK-FCL-00324_0, #UK-FCL-00468_0, #UK-FCL-00469_0, #UK-FCL-00354_0, #UK-FCL-00094_0, #UK-FCL-00132_0, #UK-FCL-00105_0, #UK-FCL-00317_0, #UK-FCL-00352_0, #UK-FCL-00105_0, #UK-FCL-00309_0, #UK-FCL-00310_0, #UK-FCL-00338_0').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });
   
   $("#UK-FCL-00089_0").prop('readonly',true);
   $("#UK-FCL-00395_0").prop('readonly',true);


  /* var today = new Date();
    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        autoclose:true,
        endDate: "today",
        maxDate: today
    }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });*/


 $("<div class='row'><div class='col-lg-12' id='details1'><strong>Notice is given that the following person ceased to hold office as Secretary:</strong></div></div><br>").insertAfter("#title_UK-FCL-00301_0"); 


 $("<div class='row'><div class='col-lg-12' id='details2'><strong>Notice is given that the following person was appointed as Secretary:</strong></div></div><br>").insertAfter("#title_UK-FCL-00132_0"); 


 //select first CESSATION DETAILS
  $("#title_UK-FCL-00301_0").hide();
  $("#div_UK-FCL-00301_0").hide();
  $("#div_UK-FCL-00466_0").hide();
  $("#div_UK-FCL-00324_0").hide();
  $("#div_UK-FCL-00468_0").hide();
  $("#div_UK-FCL-00469_0").hide();
  $("#div_UK-FCL-00470_0").hide();
  $("#div_UK-FCL-00400_0").hide();
  $("#div_UK-FCL-00354_0").hide();
  $("#div_UK-FCL-00094_0").hide();
  

  //select second APPOINTMENT DETAILS
  $("#title_UK-FCL-00132_0").hide();
  $("#div_UK-FCL-00132_0").hide();
  $("#div_UK-FCL-00105_0").hide();
  $("#div_UK-FCL-00317_0").hide();
  $("#div_UK-FCL-00352_0").hide();
  $("#div_UK-FCL-00309_0").hide();
  $("#div_UK-FCL-00402_0").hide();
  $("#div_UK-FCL-00471_0").hide();
  $("#div_UK-FCL-00310_0").hide();
  $("#div_UK-FCL-00338_0").hide();
  $("#div_UK-FCL-00137_0").hide();

var ff12 = $("#UK-FCL-00012_0").val();
if(ff12){
    mainfunction(ff12);
}

  $("#UK-FCL-00012_0").on("change",function(){
    if($(this).val()){
     // alert($(this).val());
      mainfunction($(this).val());
  }
});



  $("#UK-FCL-00402_0").on('change', function() {
        var countryCode = $(this).val();	
        var countryCode = $(this).val();      
        if(countryCode==829){
            $("#UK-FCL-00310_0").val('');
            $("#UK-FCL-00310_0").attr('readonly',true);
        }else{
            $("#UK-FCL-00310_0").attr('readonly',false);
        } 	
		$("#UK-FCL-00471_0").select2("val","");
        $.ajax({
            type: "POST",
            url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
            success: function(result) {
                //alert(result);
                $("#UK-FCL-00471_0").html(result);
				<?php if (isset($_GET['subID']) || (isset($_GET['app_Sub_id']) && !empty($_GET['app_Sub_id']))) { ?>
				//alert("<?php echo @$fieldValues['UK-FCL-00471_0']; ?>");
                $("#UK-FCL-00471_0").val("<?php echo @$fieldValues['UK-FCL-00471_0']; ?>");
                $("#UK-FCL-00471_0").select2("val", "<?php echo @$fieldValues['UK-FCL-00471_0']; ?>");
                $("#UK-FCL-00471_0").change();
                <?php } ?>
            }
        });
    });



    $("#UK-FCL-00470_0").on('change', function() {
        var countryCode = $(this).val();	
        var countryCode = $(this).val();      
        if(countryCode==829){
            $("#UK-FCL-00354_0").val('');
            $("#UK-FCL-00354_0").attr('readonly',true);
        }else{
            $("#UK-FCL-00354_0").attr('readonly',false);
        }  	
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

   
   $("#div_UK-FCL-00466_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox' name='middlenamecheckbox' class='group1'> I do not have a middle name or middle initial</div>");
	$("#UK-FCL-00466_0").blur(function(){
		if($(this).val()){
			$("input[name=middlenamecheckbox]").prop('checked', false);	
		}
	});

	$("input[name=middlenamecheckbox]").change(function(){
		if($(this).val()){
			$("#UK-FCL-00466_0").val("");
		}
	});

	$('#middlenamecheckbox').change(function(){

        if($("#middlenamecheckbox").prop('checked') == true){


         $("#UK-FCL-00466_0").prop('readonly',true);

        }else{

          $("#UK-FCL-00466_0").prop('readonly',false);

        }

   });
   


    $("#div_UK-FCL-00105_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox-1' name='middlenamecheckbox-1' class='group1'> I do not have a middle name or middle initial</div>");
	$("#UK-FCL-00105_0").blur(function(){
		if($(this).val()){
			$("input[name=middlenamecheckbox-1]").prop('checked', false);	
		}
	});

	$("input[name=middlenamecheckbox-1]").change(function(){
		if($(this).val()){
			$("#UK-FCL-00105_0").val("");
		}
	});

	$('#middlenamecheckbox-1').change(function(){

        if($("#middlenamecheckbox-1").prop('checked') == true){


         $("#UK-FCL-00105_0").prop('readonly',true);

        }else{

          $("#UK-FCL-00105_0").prop('readonly',false);

        }

   });


 // $("#UK-FCL-00403_0").on('change', function() {
         
 //      var srnNum = $(this).val();
      
 //      if(srnNum>0){

 //      	$.ajax({
	//             type: "POST",
	//             dataType:'json',
	//             url: "/backoffice/infowizard/subFormNoticeofSecretary/checkCompanyNameBySrnNo/srn_no/" + srnNum,
	//             beforeSend:function(){
	//             	$("#UK-FCL-00403_0-error").text("Please wait...");	    	        	
	//             },
	//             success: function(result) {		            	
	//             	if(result.status==true){
	//             	  $("#UK-FCL-00089_0").val(result.company_name);
	//             	  $("#UK-FCL-00089_0-error").text("");	
	//             	  $("#UK-FCL-00089_0-error").text("");	
	            		
	//             	}else{
	//             		$("#UK-FCL-00403_0-error").text(result.msg);
	//             		//$("#UK-FCL-00197_0").val("");		            	
	//             	}
	//                console.log(result);
	//             }

	//         });
 //     } 	

 // });


 $("#UK-FCL-00403_0").on("blur",function(){
        var reg_no = $(this).val();

    if(reg_no){
            $.ajax({
                type: "POST",
                dataType:'json',
                url: "/backoffice/infowizardtwo/subFormNoticeofSecretary/getCompanyNameByregno/reg_no/" + reg_no,
                beforeSend:function(){
                    $("#UK-FCL-00403_0-error").text("Please wait...");                      
                },
                success: function(result) {                     
                    if(result.status==true){                            
                            $("#UK-FCL-00403_0-error").text("");                 
                            $("#UK-FCL-00089_0").val(result.cname);     
							
							$("#UK-FCL-00089_0").prop('readonly',true);
                                                                    
                    }else{
                        $("#UK-FCL-00403_0-error").text(result.msg);
                        
						// $("#UK-FCL-00403_0-error").text("");
						// $("#UK-FCL-00089_0").prop('readonly',false);
						 $("#UK-FCL-00089_0").val("");                       
                    }
                   console.log(result);
                }
            });
    }        
});

 });	

function mainfunction(val){
   if(val=='Cessation of Secretary'){

          $("div#details1").css('display','block');
          $("div#details2").css('display','none');
          
         $("#title_UK-FCL-00301_0").show();
     $("#div_UK-FCL-00301_0").show();
     $("#div_UK-FCL-00466_0").show();
     $("#div_UK-FCL-00324_0").show();
     $("#div_UK-FCL-00468_0").show();
     $("#div_UK-FCL-00469_0").show();
     $("#div_UK-FCL-00470_0").show();
     $("#div_UK-FCL-00400_0").show();
     $("#div_UK-FCL-00354_0").show();
     $("#div_UK-FCL-00094_0").show();


       $("#title_UK-FCL-00132_0").hide();
        $("#div_UK-FCL-00132_0").hide();
        $("#div_UK-FCL-00105_0").hide();
        $("#div_UK-FCL-00317_0").hide();
        $("#div_UK-FCL-00352_0").hide();
        $("#div_UK-FCL-00309_0").hide();
        $("#div_UK-FCL-00402_0").hide();
        $("#div_UK-FCL-00471_0").hide();
        $("#div_UK-FCL-00310_0").hide();
        $("#div_UK-FCL-00338_0").hide();
        $("#div_UK-FCL-00137_0").hide();


          }else if(val=='Appointment of Secretary'){

             $("div#details1").css('display','none');
             $("div#details2").css('display','block');
            

             $("#title_UK-FCL-00132_0").show();
        $("#div_UK-FCL-00132_0").show();
        $("#div_UK-FCL-00105_0").show();
        $("#div_UK-FCL-00317_0").show();
        $("#div_UK-FCL-00352_0").show();
        $("#div_UK-FCL-00309_0").show();
        $("#div_UK-FCL-00402_0").show();
        $("#div_UK-FCL-00471_0").show();
        $("#div_UK-FCL-00310_0").show();
        $("#div_UK-FCL-00338_0").show();
        $("#div_UK-FCL-00137_0").show();


          $("#title_UK-FCL-00301_0").hide();
         $("#div_UK-FCL-00301_0").hide();
         $("#div_UK-FCL-00466_0").hide();
         $("#div_UK-FCL-00324_0").hide();
         $("#div_UK-FCL-00468_0").hide();
         $("#div_UK-FCL-00469_0").hide();
         $("#div_UK-FCL-00470_0").hide();
         $("#div_UK-FCL-00400_0").hide();
         $("#div_UK-FCL-00354_0").hide();
         $("#div_UK-FCL-00094_0").hide();

          }else if(val=='Cessation and appointment of Secretary'){

             $("div#details1").css('display','block');
             $("div#details2").css('display','block');
           

            $("#title_UK-FCL-00132_0").show();
        $("#div_UK-FCL-00132_0").show();
        $("#div_UK-FCL-00105_0").show();
        $("#div_UK-FCL-00317_0").show();
        $("#div_UK-FCL-00352_0").show();
        $("#div_UK-FCL-00309_0").show();
        $("#div_UK-FCL-00402_0").show();
        $("#div_UK-FCL-00471_0").show();
        $("#div_UK-FCL-00310_0").show();
        $("#div_UK-FCL-00338_0").show();
        $("#div_UK-FCL-00137_0").show();


          $("#title_UK-FCL-00301_0").show();
         $("#div_UK-FCL-00301_0").show();
         $("#div_UK-FCL-00466_0").show();
         $("#div_UK-FCL-00324_0").show();
         $("#div_UK-FCL-00468_0").show();
         $("#div_UK-FCL-00469_0").show();
         $("#div_UK-FCL-00470_0").show();
         $("#div_UK-FCL-00400_0").show();
         $("#div_UK-FCL-00354_0").show();
         $("#div_UK-FCL-00094_0").show();
          }  
}
</script>

<?php if(isset($_SESSION['RESPONSE']["user_id"]) && isset($_GET['subID'])){ ?>
           

   <script type="text/javascript">
              $(document).ready(function(){
                  var ff466_0 = $("#UK-FCL-00466_0").val();
               
                    if(ff466_0==''){
                        $("input[name=middlenamecheckbox]").prop('checked', true);
                        $("#UK-FCL-00466_0").attr('readonly',true);
                    }else{
                        $("input[name=middlenamecheckbox]").prop('checked', false);
                    }

                    var ff105_0 = $("#UK-FCL-00105_0").val();
               
                    if(ff105_0==''){
                        $("input[name=middlenamecheckbox-1]").prop('checked', true);
                        $("#UK-FCL-00105_0").attr('readonly',true);
                    }else{
                        $("input[name=middlenamecheckbox-1]").prop('checked', false);
                    }


                    
                     });
            </script> 
  <?php 
 } ?>

<?php if(isset($_SESSION['uid'])){ ?>
            <script type="text/javascript">
               $(document).ready(function(){
                 var ff466_0 = $("#UK-FCL-00466_0").val();
               
                    if(ff466_0==''){
                        $("input[name=middlenamecheckbox]").prop('checked', true);
                    }else{
                        $("input[name=middlenamecheckbox]").prop('checked', false);
                    }
                     $("input[name=middlenamecheckbox]").prop('disabled', true);
                     

               var ff105_0 = $("#UK-FCL-00105_0").val();
               
                    if(ff105_0==''){
                        $("input[name=middlenamecheckbox-1]").prop('checked', true);
                    }else{
                        $("input[name=middlenamecheckbox-1]").prop('checked', false);
                    }
                     $("input[name=middlenamecheckbox-1]").prop('disabled', true);
                      }); 


            </script>   
<?php } ?>