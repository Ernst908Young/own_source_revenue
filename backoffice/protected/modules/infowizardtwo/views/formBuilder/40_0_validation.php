
<script type="text/javascript">
$(document).ready(function(){
	    $("a.back_btn").css('visibility', 'hidden');
		$("#UK-FCL-00197_0,#UK-FCL-00193_0").attr('readonly',true);

		getCompanyDetailValue();

	
	$("#UK-FCL-00290_0").on("blur",function(){
	        var reg_no = $(this).val(); 
	                $.ajax({
	                    type: "POST",
	                    dataType:'json',
	                    url: "/backoffice/infowizardtwo/subFormStatementOfIntentToDissolveForm7/getcompanyNameByregno/reg_no/" + reg_no,
	                    beforeSend:function(){
	                        $("#UK-FCL-00290_0-error").text("Please wait...");                      
	                    },
	                    success: function(result) {                     
	                        if(result.status==true){                            
	                                $("#UK-FCL-00290_0-error").text("");                 
	                                $("#UK-FCL-00197_0").val(result.cname);     
	                                                                        
	                        }else{
	                            $("#UK-FCL-00290_0-error").text(result.msg);                            
	                            $("#UK-FCL-00197_0").val("");                       
	                        }
	                       console.log(result);
	                    }
	                });                 
	    });


	$(".chk_UK-FCL-00618_0").on('change',function(){
		var val=$("input[type='radio'][name='UK-FCL-00618_0']:checked").val();
		if(val=='Intends to liquidate and dissolve'){
			
			$("#div_UK-FCL-00617_0").show();
			$("#div_UK-FCL-00619_0,#div_UK-FCL-00193_0").hide();
			$("#div_UK-FCL-00619_0,#div_UK-FCL-00193_0").removeAttr("required",false);
			
			
		}
		else{
			$("#div_UK-FCL-00619_0,#div_UK-FCL-00193_0").show();
			$("#div_UK-FCL-00619_0,#div_UK-FCL-00193_0").attr("required",true);
			$("#div_UK-FCL-00617_0").hide();
		}

	})

	
	function getCompanyDetailValue(){
        
		if($('input[name="UK-FCL-00618_0"]:checked').val() == 'Intends to liquidate and dissolve'){
			$("#div_UK-FCL-00617_0").show();
			 $("#div_UK-FCL-00617_0").attr("required",true);
			 $("#div_UK-FCL-00619_0,#div_UK-FCL-00193_0").hide();
			 $("#div_UK-FCL-00619_0,#div_UK-FCL-00193_0").removeAttr("required",false);
		}
		else if($('input[name="UK-FCL-00618_0"]:checked').val() == 'Revokes its intent to dissolve'){
			 
			 
			 $("#div_UK-FCL-00617_0").hide();
			 $("#div_UK-FCL-00617_0").removeAttr("required",false);
			 $("#div_UK-FCL-00619_0,#div_UK-FCL-00193_0").show();
			 $("#div_UK-FCL-00619_0,#div_UK-FCL-00193_0").attr("required",true);
			 
		} else {
			 $("#div_UK-FCL-00619_0,#div_UK-FCL-00193_0,#div_UK-FCL-00617_0").hide();
			 $("#div_UK-FCL-00619_0,#div_UK-FCL-00193_0,#div_UK-FCL-00617_0").removeAttr("required",false);
		}
	}

     $("#UK-FCL-00619_0").on("blur",function(){
        var srn_no = $(this).val();
        getcomapnyname(srn_no);
             
    });
     
    function getcomapnyname(srn_no){
        if(srn_no!=""){
                    $.ajax({
                        type: "POST",
                        dataType:'json',
                        url: "/backoffice/infowizardtwo/subFormStatementOfIntentToDissolveForm7/getCompanyNameBySrnNo/srn_no/" + srn_no +"/subID/<?= isset($_GET['subID']) ? $_GET['subID'] : NULL ?>",
                        beforeSend:function(){
                            $("#UK-FCL-00619_0-error").text("Please wait...");                      
                        },
                        success: function(result) {                     
                            if(result.status==true){
                                if(result.app_status=='valid'){
                                    $("#UK-FCL-00193_0").val(result.name);
                                    $("#UK-FCL-00619_0-error").html("");
                                    $("#UK-FCL-00193_0-error").html("");    
                                }else{
                                    $("#UK-FCL-00619_0-error").text(result.msg);            
                                    if ($("#UK-FCL-00193_0-error").length) {
                                        $("#UK-FCL-00193_0-error").text(errormessages.srn_msg001);
                                    }else{
                                        $("#div_UK-FCL-00193_0").find('div').append('<div  style="color:red;" id="UK-FCL-00193_0-error">'+errormessages.srn_msg001+'<br>'+errormessages.srn_msg002+'</div>');
                                    }    

                                    $("#UK-FCL-00193_0").val("");  
                                }                                           
                            }else{
                                if(result.user){
                                    $("#UK-FCL-00619_0-error").text(result.msg);
                                    $("#UK-FCL-00193_0").val("");   
                                    $("#UK-FCL-00193_0-error").text("");
                                }else{
                                    //alert(result.msg);
                                }                                               
                            }
                         //  console.log(result);
                        }
                    });
            }   
    }


});	



	</script>

