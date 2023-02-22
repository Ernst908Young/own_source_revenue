<style type="text/css">
  div#details1 {
    display: none;
} 

div#details2 {
    display: none;
}

div#details3 {
    display: none;
}    
</style>

<script type="text/javascript">

$(document).ready(function(){
$("a.back_btn").css('visibility', 'hidden');
$("#UK-FCL-00305_0").prop('readonly',true);

$("#UK-FCL-00096_0").prop('readonly',true);

$("#UK-FCL-00384_0").prop('readonly',true);


$("#UK-FCL-00096_0").val('BARBADOS');
$("#UK-FCL-00384_0").val('BARBADOS');

$("#UK-FCL-00104_0").prop('readonly',true);
$("#UK-FCL-00238_0").prop('readonly',true);
$("#UK-FCL-00406_0").prop('readonly',true);
$("#UK-FCL-00383_0").prop('readonly',true);


 //300 Charactor Validation
  var maxchars_200 = 200;
    $('#UK-FCL-00107_0, #UK-FCL-00335_0').keyup(function () {
        var tlength = $(this).val().length;
        $(this).val($(this).val().substring(0, maxchars_200));
        var tlength = $(this).val().length;
        remain = maxchars_200 - parseInt(tlength);
        $(".char_validation_1").remove();
        if(remain == 0){
          $("#UK-FCL-00268_0-error").parent('div').append("<div style='color:red;'  class='form-control-feedback-error char_validation_1'></div>");
          return false;
        }
    });




 //select first option registered
  $("#div_UK-FCL-00093_0").hide();
  $("#div_UK-FCL-00309_0").hide();
  $("#div_UK-FCL-00404_0").hide();
  $("#div_UK-FCL-00094_0").hide();
  $("#div_UK-FCL-00096_0").hide();
  

  //select second option mailing
  $("#div_UK-FCL-00107_0").hide();
  $("#div_UK-FCL-00335_0").hide();
  $("#div_UK-FCL-00458_0").hide();
  $("#div_UK-FCL-00401_0").hide();
  $("#div_UK-FCL-00402_0").hide();


  //select thirld option others
  $("#div_UK-FCL-00104_0").hide();
  $("#div_UK-FCL-00238_0").hide();
  $("#div_UK-FCL-00406_0").hide();
  $("#div_UK-FCL-00383_0").hide();
  $("#div_UK-FCL-00384_0").hide();

 
 $("<div class='row'><div class='col-lg-12' id='details1'><strong>New Address of Registered office:</strong></div></div><br>").insertAfter("#div_UK-FCL-00012_0");

 $("<div class='row'><div class='col-lg-12' id='details2'><strong>Mailing Address:</strong></div></div><br>").insertAfter("#div_UK-FCL-00096_0");


 $("<div class='row'><div class='col-lg-12' id='details3'><strong>Previous Address of registered office:</strong></div></div><br>").insertAfter("#div_UK-FCL-00401_0");


 $("#UK-FCL-00403_0").on("blur",function(){
        var reg_no = $(this).val();
    
    if(reg_no){
            $.ajax({
                type: "POST",
                dataType:'json',
                url: "/backoffice/infowizardtwo/subFormNoticeofChangeofAddressForm4/getCompanyNameByregno/reg_no/" + reg_no,
                beforeSend:function(){
                    $("#UK-FCL-00403_0-error").text("Please wait...");                      
                },
                success: function(result) {  
						
                    if(result.status==true){                            
                            $("#UK-FCL-00403_0-error").text("");                 
                            $("#UK-FCL-00305_0").val(result.cname);  
							$("#UK-FCL-00104_0").val(result.address1);  
                            $("#UK-FCL-00238_0").val(result.address2);  
                            $("#UK-FCL-00406_0").val(result.parish);  
                            $("#UK-FCL-00383_0").val(result.postal_code);

							$("#UK-FCL-00305_0").prop('readonly',true);
							$("#UK-FCL-00104_0").prop('readonly',true);
							$("#UK-FCL-00238_0").prop('readonly',true);
							$("#UK-FCL-00406_0").prop('readonly',true);
							$("#UK-FCL-00383_0").prop('readonly',true);
                                                                    
                    }else{
                        $("#UK-FCL-00403_0-error").text(result.msg);
                        $("#UK-FCL-00305_0").val(""); 
						$("#UK-FCL-00104_0").val("");      
						$("#UK-FCL-00238_0").val("");  
						$("#UK-FCL-00406_0").val("");  
						$("#UK-FCL-00383_0").val("");  
						
						// $("#UK-FCL-00403_0-error").text("");
						// $("#UK-FCL-00305_0").prop('readonly',false);
						// $("#UK-FCL-00104_0").prop('readonly',false);
						// $("#UK-FCL-00238_0").prop('readonly',false);
						// $("#UK-FCL-00406_0").prop('readonly',false);
						// $("#UK-FCL-00383_0").prop('readonly',false);
                    }
                   console.log(result);
                }
            });
    }        
}); 


if($("#UK-FCL-00012_0").val()=='Change in registered office address'){

$("div#details1").css('display','block');
$("div#details2").css('display','none');
$("div#details3").css('display','block');

 
//select first option registered
$("#div_UK-FCL-00093_0").show();
$("#div_UK-FCL-00309_0").show();
$("#div_UK-FCL-00404_0").show();
$("#div_UK-FCL-00094_0").show();
$("#div_UK-FCL-00096_0").show();


//select second option mailing
$("#div_UK-FCL-00107_0").hide();
$("#div_UK-FCL-00335_0").hide();
$("#div_UK-FCL-00458_0").hide();
$("#div_UK-FCL-00401_0").hide();
$("#div_UK-FCL-00402_0").hide();


//select thirld option others
$("#div_UK-FCL-00104_0").show();
$("#div_UK-FCL-00238_0").show();
$("#div_UK-FCL-00406_0").show();
$("#div_UK-FCL-00383_0").show();
$("#div_UK-FCL-00384_0").show();


}else if($("#UK-FCL-00012_0").val()=='Change in mailing address'){

   $("div#details1").css('display','none');
   $("div#details2").css('display','block');
   $("div#details3").css('display','none');

 

  //select first option registered
    $("#div_UK-FCL-00093_0").hide();
    $("#div_UK-FCL-00309_0").hide();
    $("#div_UK-FCL-00404_0").hide();
    $("#div_UK-FCL-00094_0").hide();
    $("#div_UK-FCL-00096_0").hide();
    

    //select second option mailing
    $("#div_UK-FCL-00107_0").show();
    $("#div_UK-FCL-00335_0").show();
    $("#div_UK-FCL-00458_0").show();
    $("#div_UK-FCL-00401_0").show();
    $("#div_UK-FCL-00402_0").show();


    //select thirld option others
    $("#div_UK-FCL-00104_0").hide();
    $("#div_UK-FCL-00238_0").hide();
    $("#div_UK-FCL-00406_0").hide();
    $("#div_UK-FCL-00383_0").hide();
    $("#div_UK-FCL-00384_0").hide();

}else if($("#UK-FCL-00012_0").val()=='Change in registered office address and mailing address'){

   $("div#details1").css('display','block');
   $("div#details2").css('display','block');
   $("div#details3").css('display','block');


  //select first option registered
    $("#div_UK-FCL-00093_0").show();
    $("#div_UK-FCL-00309_0").show();
    $("#div_UK-FCL-00404_0").show();
    $("#div_UK-FCL-00094_0").show();
    $("#div_UK-FCL-00096_0").show();
    

    //select second option mailing
    $("#div_UK-FCL-00107_0").show();
    $("#div_UK-FCL-00335_0").show();
    $("#div_UK-FCL-00458_0").show();
    $("#div_UK-FCL-00401_0").show();
    $("#div_UK-FCL-00402_0").show();


    //select thirld option others
    $("#div_UK-FCL-00104_0").show();
    $("#div_UK-FCL-00238_0").show();
    $("#div_UK-FCL-00406_0").show();
    $("#div_UK-FCL-00383_0").show();
    $("#div_UK-FCL-00384_0").show();

}  


 $("#UK-FCL-00012_0").on("change",function(){

        if($(this).val()=='Change in registered office address'){

          $("div#details1").css('display','block');
          $("div#details2").css('display','none');
          $("div#details3").css('display','block');

           
         //select first option registered
          $("#div_UK-FCL-00093_0").show();
          $("#div_UK-FCL-00309_0").show();
          $("#div_UK-FCL-00404_0").show();
          $("#div_UK-FCL-00094_0").show();
          $("#div_UK-FCL-00096_0").show();
          

          //select second option mailing
          $("#div_UK-FCL-00107_0").hide();
          $("#div_UK-FCL-00335_0").hide();
          $("#div_UK-FCL-00458_0").hide();
          $("#div_UK-FCL-00401_0").hide();
          $("#div_UK-FCL-00402_0").hide();


          //select thirld option others
          $("#div_UK-FCL-00104_0").show();
          $("#div_UK-FCL-00238_0").show();
          $("#div_UK-FCL-00406_0").show();
          $("#div_UK-FCL-00383_0").show();
          $("#div_UK-FCL-00384_0").show();


          }else if($(this).val()=='Change in mailing address'){

             $("div#details1").css('display','none');
             $("div#details2").css('display','block');
             $("div#details3").css('display','none');

           

            //select first option registered
              $("#div_UK-FCL-00093_0").hide();
              $("#div_UK-FCL-00309_0").hide();
              $("#div_UK-FCL-00404_0").hide();
              $("#div_UK-FCL-00094_0").hide();
              $("#div_UK-FCL-00096_0").hide();
              

              //select second option mailing
              $("#div_UK-FCL-00107_0").show();
              $("#div_UK-FCL-00335_0").show();
              $("#div_UK-FCL-00458_0").show();
              $("#div_UK-FCL-00401_0").show();
              $("#div_UK-FCL-00402_0").show();


              //select thirld option others
              $("#div_UK-FCL-00104_0").hide();
              $("#div_UK-FCL-00238_0").hide();
              $("#div_UK-FCL-00406_0").hide();
              $("#div_UK-FCL-00383_0").hide();
              $("#div_UK-FCL-00384_0").hide();

          }else if($(this).val()=='Change in registered office address and mailing address'){

             $("div#details1").css('display','block');
             $("div#details2").css('display','block');
             $("div#details3").css('display','block');


            //select first option registered
              $("#div_UK-FCL-00093_0").show();
              $("#div_UK-FCL-00309_0").show();
              $("#div_UK-FCL-00404_0").show();
              $("#div_UK-FCL-00094_0").show();
              $("#div_UK-FCL-00096_0").show();
              

              //select second option mailing
              $("#div_UK-FCL-00107_0").show();
              $("#div_UK-FCL-00335_0").show();
              $("#div_UK-FCL-00458_0").show();
              $("#div_UK-FCL-00401_0").show();
              $("#div_UK-FCL-00402_0").show();


              //select thirld option others
              $("#div_UK-FCL-00104_0").show();
              $("#div_UK-FCL-00238_0").show();
              $("#div_UK-FCL-00406_0").show();
              $("#div_UK-FCL-00383_0").show();
              $("#div_UK-FCL-00384_0").show();

          }  
     });

 $("#UK-FCL-00404_0").on("change",function(){
    if($(this).val()){
            $.ajax({
                type: "POST",
                dataType:'html',
                url: "/backoffice/infowizard/subFormRegistrationCharityBoard/getpostalcode/p_id/" + $(this).val(),
                beforeSend:function(){
                /*  if ($("#UK-FCL-00404_0-error").length) {
                $("#UK-FCL-00404_0-error").text("Please enter the correct postal code");
            }else{*/
                $("#UK-FCL-00404_0-error").text("Please Wait...");
                //$("#div_UK-FCL-00404_0").find('div').append('<div id="UK-FCL-00404_0-error" class="form-control-feedback">Please Wait...</div>');
            //} 
                            
                },
                success: function(result) {                                     
                    $("#UK-FCL-00404_0-error").text("");                 
                    $("#UK-FCL-00094_0").html(result);  
                   // alert(result);                    
                                          
                }
            });
    }   
});  



// $("#UK-FCL-00458_0").on("change",function(){
//     if($(this).val()){
//             $.ajax({
//                 type: "POST",
//                 dataType:'html',
//                 url: "/backoffice/infowizard/subFormRegistrationCharityBoard/getpostalcode/p_id/" + $(this).val(),
//                 beforeSend:function(){
//                 /*  if ($("#UK-FCL-00458_0-error").length) {
//                 $("#UK-FCL-00458_0-error").text("Please enter the correct postal code");
//             }else{*/
//                 $("#UK-FCL-00458_0-error").text("Please Wait...");
//                 //$("#div_UK-FCL-00458_0").find('div').append('<div id="UK-FCL-00458_0-error" class="form-control-feedback">Please Wait...</div>');
//             //} 
                            
//                 },
//                 success: function(result) {                                     
//                     $("#UK-FCL-00458_0-error").text("");                 
//                     $("#UK-FCL-00401_0").html(result);  
//                    // alert(result);                    
                                          
//                 }
//             });
//     }   
// }); 



$("#UK-FCL-00402_0").on('change', function() {
    var countryCode = $(this).val();        
    $("#UK-FCL-00458_0").select2("val","");
    $.ajax({
        type: "POST",
        url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
        success: function(result) {
            //alert(result);
            $("#UK-FCL-00458_0").html(result);
            <?php if (isset($_GET['subID']) || (isset($_GET['app_Sub_id']) && !empty($_GET['app_Sub_id']))) { ?>
            //alert("<?php echo @$fieldValues['UK-FCL-00458_0']; ?>");
            $("#UK-FCL-00458_0").val("<?php echo @$fieldValues['UK-FCL-00458_0']; ?>");
            $("#UK-FCL-00458_0").select2("val", "<?php echo @$fieldValues['UK-FCL-00458_0']; ?>");
            $("#UK-FCL-00458_0").change();
            <?php } ?>
        }
    });
});   



$("#UK-FCL-00406_0").on("change",function(){
    if($(this).val()){
            $.ajax({
                type: "POST",
                dataType:'html',
                url: "/backoffice/infowizard/subFormRegistrationCharityBoard/getpostalcode/p_id/" + $(this).val(),
                beforeSend:function(){
                /*  if ($("#UK-FCL-00406_0-error").length) {
                $("#UK-FCL-00406_0-error").text("Please enter the correct postal code");
            }else{*/
                $("#UK-FCL-00406_0-error").text("Please Wait...");
                //$("#div_UK-FCL-00406_0").find('div').append('<div id="UK-FCL-00406_0-error" class="form-control-feedback">Please Wait...</div>');
            //} 
                            
                },
                success: function(result) {                                     
                    $("#UK-FCL-00406_0-error").text("");                 
                    $("#UK-FCL-00383_0").html(result);  
                   // alert(result);                    
                                          
                }
            });
    }   
});    

	$('#UK-FCL-00093_0, #UK-FCL-00309_0, #UK-FCL-00096_0, #UK-FCL-00290_0, #UK-FCL-00104_0, #UK-FCL-00238_0, #UK-FCL-00384_0, #UK-FCL-00107_0, #UK-FCL-00335_0, #UK-FCL-00401_0').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });


});	

</script>