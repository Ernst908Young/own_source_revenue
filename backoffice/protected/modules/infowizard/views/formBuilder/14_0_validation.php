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

$("#UK-FCL-00305_0").prop('readonly',true);

$("#UK-FCL-00096_0").prop('readonly',true);
$("#UK-FCL-00402_0").prop('readonly',true);
$("#UK-FCL-00384_0").prop('readonly',true);


$("#UK-FCL-00096_0").val('Barbados');
$("#UK-FCL-00402_0").val('Barbados');
$("#UK-FCL-00384_0").val('Barbados');




 //select first option registered
  $("#div_UK-FCL-00093_0").hide();
  $("#div_UK-FCL-00309_0").hide();
  $("#div_UK-FCL-00404_0").hide();
  $("#div_UK-FCL-00094_0").hide();
  $("#div_UK-FCL-00096_0").hide();
  

  //select second option mailing
  $("#div_UK-FCL-00107_0").hide();
  $("#div_UK-FCL-00335_0").hide();
  $("#div_UK-FCL-00405_0").hide();
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


 $("<div class='row'><div class='col-lg-12' id='details3'><strong>Previous Address of registered office:</strong></div></div><br>").insertAfter("#div_UK-FCL-00402_0");


 $("#UK-FCL-00403_0").on("blur",function(){
        var reg_no = $(this).val();
    
    if(reg_no>0){
            $.ajax({
                type: "POST",
                dataType:'json',
                url: "/backoffice/infowizard/subFormNoticeofChangeofAddressForm4/getCharityNameByregno/reg_no/" + reg_no,
                beforeSend:function(){
                    $("#UK-FCL-00403_0-error").text("Please wait...");                      
                },
                success: function(result) {                     
                    if(result.status==true){                            
                            $("#UK-FCL-00403_0-error").text("");                 
                            $("#UK-FCL-00305_0").val(result.cname);     
                                                                    
                    }else{
                        $("#UK-FCL-00403_0-error").text(result.msg);
                        $("#UK-FCL-00305_0").val("");                       
                    }
                   console.log(result);
                }
            });
    }        
}); 



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
          $("#div_UK-FCL-00405_0").hide();
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
              $("#div_UK-FCL-00405_0").show();
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
              $("#div_UK-FCL-00405_0").show();
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



$("#UK-FCL-00405_0").on("change",function(){
    if($(this).val()){
            $.ajax({
                type: "POST",
                dataType:'html',
                url: "/backoffice/infowizard/subFormRegistrationCharityBoard/getpostalcode/p_id/" + $(this).val(),
                beforeSend:function(){
                /*  if ($("#UK-FCL-00405_0-error").length) {
                $("#UK-FCL-00405_0-error").text("Please enter the correct postal code");
            }else{*/
                $("#UK-FCL-00405_0-error").text("Please Wait...");
                //$("#div_UK-FCL-00405_0").find('div').append('<div id="UK-FCL-00405_0-error" class="form-control-feedback">Please Wait...</div>');
            //} 
                            
                },
                success: function(result) {                                     
                    $("#UK-FCL-00405_0-error").text("");                 
                    $("#UK-FCL-00401_0").html(result);  
                   // alert(result);                    
                                          
                }
            });
    }   
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



});	

</script>