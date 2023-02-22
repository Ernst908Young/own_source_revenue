
<script type="text/javascript">
$(document).ready(function(){

$("a.back_btn").css('visibility', 'hidden');
$("#UK-FCL-00089_0, #UK-FCL-00507_0").attr('readonly',true);

	$("#UK-FCL-00403_0").on("blur",function(){
		var reg_no = $(this).val();	
				$.ajax({
		            type: "POST",
		            dataType:'json',
		            url: "/backoffice/infowizardtwo/subFormStatementOfCharge/getcompanyNameByregno/reg_no/" + reg_no,
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
		$("#div_UK-FCL-00331_0").hide();
	    	$("#div_UK-FCL-00507_0").hide();
	}




	$('input[name=UK-FCL-00502_0]').change(function(){	 	
		if($(this).val()=="Yes"){
			$("#div_UK-FCL-00331_0").show();
	    	$("#div_UK-FCL-00507_0").show();	    	
		}else{
			$("#div_UK-FCL-00331_0").hide();
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

function getcomapnyname(srn_no){
	if(srn_no!=""){
				$.ajax({
		            type: "POST",
		            dataType:'json',
		            url: "/backoffice/infowizardtwo/subFormStatementOfCharge/getCompanyNameBySrnNo/srn_no/" + srn_no +"/subID/<?= isset($_GET['subID']) ? $_GET['subID'] : NULL ?>",
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
</script>