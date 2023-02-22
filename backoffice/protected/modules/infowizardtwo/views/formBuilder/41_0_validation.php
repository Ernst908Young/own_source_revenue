
<script type="text/javascript">
$(document).ready(function(){
	    $("a.back_btn").css('visibility', 'hidden');
		$("#UK-FCL-00089_0,#UK-FCL-00310_0,#UK-FCL-00096_0").attr('readonly',true);



	
	$("#UK-FCL-00403_0").on("blur",function(){
	        var reg_no = $(this).val(); 
	                $.ajax({
	                    type: "POST",
	                    dataType:'json',
	                    url: "/backoffice/infowizardtwo/subFormArticlesOfDissolutionForm23/getcompanyNameByregno/reg_no/" + reg_no,
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

	$("<div class='col-md-12' id='form2regisaddtitle' style='margin-top:10px;'><strong>Documents and records of the company shall be kept for 6 years following the date of dissolution by:</strong></div>").insertBefore("#div_UK-FCL-00132_0");

	   $("#UK-FCL-00105_0").blur(function(){
        if($(this).val()){
            $("input[name=middlenamecheckbox00105_0]").prop('checked', false); 
        }
    });


     $("#div_UK-FCL-00105_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox00105_0' name='middlenamecheckbox00105_0'> I do not have a middle name or middle initial</div>");

     $("input[name=middlenamecheckbox00105_0]").change(function(){
        if($(this).is(':checked')){
            $("#UK-FCL-00105_0").val("");
            $("#UK-FCL-00105_0").attr('readonly',true);     
        }else{
            $("#UK-FCL-00105_0").attr('readonly',false);
        }
    });

       $("#UK-FCL-00096_0").val("BARBADOS");

    $('#UK-FCL-00132_0, #UK-FCL-00105_0, #UK-FCL-00106_0, #UK-FCL-00093_0, #UK-FCL-00238_0, #UK-FCL-00129_0, #UK-FCL-00094_0').keyup(function(){
           $(this).val($(this).val().toUpperCase());
       });

        $("#UK-FCL-00129_0").on("change", function() {
            $("#UK-FCL-00129_0-error").empty();
            $("#div_UK-FCL-00129_0").removeClass("has-error");
       })
           $("#UK-FCL-00613_0").on("change", function() {
            $("#UK-FCL-00613_0-error").empty();
            $("#div_UK-FCL-00613_0").removeClass("has-error");
       })

	

     
   


});	



	</script>

