<script type="text/javascript">
   $(document).ready(function(){

    $("a.back_btn").css('visibility', 'hidden');
    $("#UK-FCL-00089_0, #UK-FCL-00340_0, #UK-FCL-00341_0, #UK-FCL-00347_0, #UK-FCL-00385_0,#UK-FCL-00344_0, #UK-FCL-00346_0, #UK-FCL-00570_0, #UK-FCL-00571_0, #UK-FCL-00572_0,#UK-FCL-00573_0, #UK-FCL-00574_0, #UK-FCL-00575_0").attr('readonly',true);

 $("#UK-FCL-00403_0").on("blur",function(){
        var reg_no = $(this).val(); 
                $.ajax({
                    type: "POST",
                    dataType:'json',
                    url: "/backoffice/infowizardtwo/subFormNoticeOfCancellationOfExternalCompany/getcompanyNameByregno/reg_no/" + reg_no,
                    beforeSend:function(){
                        $("#UK-FCL-00403_0-error").text("Please wait...");                      
                    },
                    success: function(result) {                     
                        if(result.status==true){                            
                                $("#UK-FCL-00403_0-error").text("");                 
                                $("#UK-FCL-00089_0").val(result.cname);  
                                $("#UK-FCL-00340_0").val(result.regaddress1);
                                $("#UK-FCL-00341_0").val(result.regaddress2);
                                $("#UK-FCL-00347_0").val(result.regcountry);
                                $("#UK-FCL-00385_0").val(result.regstate);  
                                $("#UK-FCL-00344_0").val(result.regcity);
                                $("#UK-FCL-00346_0").val(result.regpostal);
                                $("#UK-FCL-00570_0").val(result.priaddress1);
                                $("#UK-FCL-00571_0").val(result.priaddress2);
                                $("#UK-FCL-00572_0").val(result.pricity);
                                $("#UK-FCL-00573_0").val(result.pristate);                               
                                $("#UK-FCL-00574_0").val(result.pripostal); 
                                $("#UK-FCL-00575_0").val(result.pricountry);      
                                                                        
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

                        }
                       console.log(result);
                    }
                });
                 
    });

   $("<div class='col-md-12' id='form2regisaddtitle' style='margin-top:10px;'><strong>Address of Registered office:</strong></div>").insertBefore("#div_UK-FCL-00340_0");
      

   $("<div class='col-md-12' id='form2preaddtitle' style='margin-top:10px;'><strong>Address of principal office in Barbados (if any):</strong></div>").insertBefore("#div_UK-FCL-00570_0");
   
      $("#UK-FCL-00347_0").on('change', function() {
           var countryCode = $(this).val();     
        $("#UK-FCL-00385_0").select2("val","");
           $.ajax({
               type: "POST",
               url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
               success: function(result) {
                  $("#UK-FCL-00385_0").html(result);
            
               }
           });
       });

 $("#UK-FCL-00575_0").on('change', function() {
           var countryCode = $(this).val();     
        $("#UK-FCL-00573_0").select2("val","");
           $.ajax({
               type: "POST",
               url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
               success: function(result) {
                  $("#UK-FCL-00573_0").html(result);
            
               }
           });
       });




   
   });
   
   
   
   
         
     
</script>

