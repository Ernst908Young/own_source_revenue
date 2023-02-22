
<script type="text/javascript">
$(document).ready(function(){

$("#div_UK-FCL-00650_0,#div_UK-FCL-00651_0 ,#div_UK-FCL-00676_0,#div_UK-FCL-00677_0").hide();

 $('#UK-FCL-00132_0,#UK-FCL-00105_0,#UK-FCL-00106_0,#UK-FCL-00093_0,#UK-FCL-00238_0,#UK-FCL-00310_0,#UK-FCL-00094_0').keyup(function(){
              $(this).val($(this).val().toUpperCase());
          });


$("a.back_btn").css('visibility', 'hidden');
//$("#UK-FCL-00089_0, #UK-FCL-00507_0").attr('readonly',true);
$("#UK-FCL-00651_0,#UK-FCL-00593_0,#UK-FCL-00684_0").attr('readonly',true);



$("#UK-FCL-00675_0").on("change",function(){
    if($(this).val()){
        if($(this).val()=="Company other than Unregistered External Company" || $(this).val()=="Society"){
            one_show(); 
        }else{
            one_hide();
        }
        if($(this).val()=="Unregistered External Company"){
            two_show(); 
        }else{
            two_hide();
        }
      
    }
});

function one_show(){
    $("#div_UK-FCL-00650_0").show();
    $("#div_UK-FCL-00651_0").show();
}
function one_hide(){
    $("#div_UK-FCL-00650_0").hide();
    $("#div_UK-FCL-00651_0").hide();
}
function two_show(){
    $("#div_UK-FCL-00676_0").show();
    $("#div_UK-FCL-00677_0").show();
   
}
function two_hide(){
    $("#div_UK-FCL-00676_0").hide();
    $("#div_UK-FCL-00677_0").hide();
    
}


     $("#UK-FCL-00650_0").on("blur",function(){
         var reg_no = $(this).val(); 
		 var type_of_entity = $("#UK-FCL-00675_0").val();
                 $.ajax({
                     type: "POST",
                     dataType:'json',
					 data:{"type_of_entity":type_of_entity},
                     url: "/backoffice/infowizardtwo/subFormRegistrationOfEnforcementOfSecutiryForm8/getcompanyNameByregno/reg_no/" + reg_no,
                     beforeSend:function(){
                         $("#UK-FCL-00650_0-error").text("Please wait...");                      
                     },
                     success: function(result) {                     
                         if(result.status==true){                            
                                 $("#UK-FCL-00650_0-error").text("");                 
                                 $("#UK-FCL-00651_0").val(result.cname);     
                                                                         
                         }else{
                             $("#UK-FCL-00650_0-error").text(result.msg);                            
                             $("#UK-FCL-00651_0").val("");                       
                         }
                        console.log(result);
                     }
                 });
                  
     });

	// 1
    $('input[name=UK-FCL-00693_0]').change(function(){      
        if($(this).val()=="Yes"){
            $("#div_UK-FCL-00617_0").attr("required",true);
            $("#UK-FCL-00617_0").val("");
            $("#UK-FCL-00617_0").attr("readonly",false);
                
        }else{
            $("#UK-FCL-00617_0").attr("readonly",true);             
            $("#UK-FCL-00617_0").val("Not Applicable");
            $("#div_UK-FCL-00617_0").removeAttr('required',false);
            
            
        }
    });
	
	// 2
	$('input[name=UK-FCL-00694_0]').change(function(){      
        if($(this).val()=="Yes"){
            $("#div_UK-FCL-00636_0").attr("required",true);
            $("#UK-FCL-00636_0").val("");
            $("#UK-FCL-00636_0").attr("readonly",false);
                
        }else{
            $("#UK-FCL-00636_0").attr("readonly",true);             
            $("#UK-FCL-00636_0").val("Not Applicable");
            $("#div_UK-FCL-00636_0").removeAttr('required',false);
            
            
        }
    });
	
	// 3
	$('input[name=UK-FCL-00695_0]').change(function(){      
        if($(this).val()=="Yes"){
            $("#div_UK-FCL-00637_0").attr("required",true);
            $("#UK-FCL-00637_0").val("");
            $("#UK-FCL-00637_0").attr("readonly",false);
                
        }else{
            $("#UK-FCL-00637_0").attr("readonly",true);             
            $("#UK-FCL-00637_0").val("Not Applicable");
            $("#div_UK-FCL-00637_0").removeAttr('required',false);
            
            
        }
    });
	
	// 4
	$('input[name=UK-FCL-00696_0]').change(function(){      
        if($(this).val()=="Yes"){
            $("#div_UK-FCL-00689_0").attr("required",true);
            $("#UK-FCL-00689_0").val("");
            $("#UK-FCL-00689_0").attr("readonly",false);
                
        }else{
            $("#UK-FCL-00689_0").attr("readonly",true);             
            $("#UK-FCL-00689_0").val("Not Applicable");
            $("#div_UK-FCL-00689_0").removeAttr('required',false);
            
            
        }
    });
	// 5
	$('input[name=UK-FCL-00697_0]').change(function(){      
        if($(this).val()=="Yes"){
            $("#div_UK-FCL-00698_0").attr("required",true);
            $("#UK-FCL-00698_0").val("");
            $("#UK-FCL-00698_0").attr("readonly",false);
                
        }else{
            $("#UK-FCL-00698_0").attr("readonly",true);             
            $("#UK-FCL-00698_0").val("Not Applicable");
            $("#div_UK-FCL-00698_0").removeAttr('required',false);
            
            
        }
    });

$("<div class='row regoffice'><div class='col-lg-12' id='pro'><strong>Persons entitled to the charge:</strong></div></div><br>").insertBefore("#div_UK-FCL-00132_0");

	 $("#div_UK-FCL-00105_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox' name='middlenamecheckbox'> I do not have a middle name or middle initial</div>");

        $("input[name=middlenamecheckbox]").change(function() {
            if ($(this).is(':checked')) {
                $("#UK-FCL-00105_0").val("");
                $("#UK-FCL-00105_0").attr('readonly', true);
            } else {
                $("#UK-FCL-00105_0").attr('readonly', false);
            }
        });
		

	/* $("#div_UK-FCL-00105_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox00105_0' name='middlenamecheckbox00105_0' class='group1'> I do not have a middle name or middle initial</div>");

	$("#UK-FCL-00105_0").blur(function(){
            if($(this).val()){
                $("input[name=middlenamecheckbox00105_0]").prop('checked', false);  
            }
        });
    $("input[name=middlenamecheckbox00105_0]").change(function(){
        if($(this).val()){
            $("#UK-FCL-00105_0").val("");
        }
    });
        $('#middlenamecheckbox00105_0').change(function(){

            if($("#middlenamecheckbox00105_0").prop('checked') == true){


             $("#UK-FCL-00105_0").prop('readonly',true);

            }else{

              $("#UK-FCL-00105_0").prop('readonly',false);

            }

       });
 */
var maxchars_0 = 1000;
        $('#UK-FCL-00596_0').keyup(function () {
            var tlength = $(this).val().length;
            $(this).val($(this).val().substring(0, maxchars_0));
            var tlength = $(this).val().length;
            remain = maxchars_0 - parseInt(tlength);
            $(".char_validation_1").remove();
            if(remain == 0){
              $("#UK-FCL-00596_0-error").parent('div').append("<div style='color:red;'  class='form-control-feedback-error char_validation_1'>Maximum permissble text limit is 1000 characters.</div>");
              return false;
            }
        });


         // country and state/parish code dependency
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


        $('input[name=UK-FCL-00681_0]').change(function(){      
            if($(this).val()=="Yes"){
                $("#div_UK-FCL-00617_0").attr("required",true);
                $("#UK-FCL-00617_0").val("");
                $("#UK-FCL-00617_0").attr("readonly",false);
                    
            }else{
                $("#UK-FCL-00617_0").attr("readonly",true);             
                $("#UK-FCL-00617_0").val("Not Applicable");
                $("#div_UK-FCL-00617_0").removeAttr('required',false);
                
                
            }
            });
        $('input[name=UK-FCL-00682_0]').change(function(){      
            if($(this).val()=="Yes"){               
                $("#div_UK-FCL-00683_0").show();
                $("#div_UK-FCL-00684_0").show();
                $("#div_UK-FCL-00685_0").show();

                $("#div_UK-FCL-00686_0").show();
                $("#div_UK-FCL-00687_0").show();
                $("#div_UK-FCL-00688_0").show();
            
            }else{
            
                $("#div_UK-FCL-00683_0").hide();
                $("#div_UK-FCL-00684_0").hide();
                $("#div_UK-FCL-00685_0").hide();

                $("#div_UK-FCL-00686_0").hide();
                $("#div_UK-FCL-00687_0").hide();
                $("#div_UK-FCL-00688_0").hide();                
                

                $("#div_UK-FCL-00683_0").val("");
                $("#div_UK-FCL-00684_0").val("");
                $("#div_UK-FCL-00685_0").val("");

                $("#div_UK-FCL-00686_0").val("");
                $("#div_UK-FCL-00687_0").val("");
                $("#div_UK-FCL-00688_0").val("");
                
                
            }
            });
    

    

});


</script>