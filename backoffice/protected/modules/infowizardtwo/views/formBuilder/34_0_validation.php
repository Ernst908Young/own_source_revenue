
<script type="text/javascript">
$(document).ready(function(){

$("<div class='row regoffice'><div class='col-lg-12' id='pro'><strong>Property or undertaking charged:</strong></div></div><br>").insertBefore("#div_UK-FCL-00678_0");

//hide  650 enter comp/soc,  00632_0 name of comp/soc   00676_0,unregis   00677_0 name of un
$("#div_UK-FCL-00650_0 , #div_UK-FCL-00632_0,#div_UK-FCL-00676_0,#div_UK-FCL-00677_0").hide();
//$("#title_UK-FCL-00676_0").hide();

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
	    $("#div_UK-FCL-00632_0").show();
	}
	function one_hide(){
	    $("#div_UK-FCL-00650_0").hide();
	    $("#div_UK-FCL-00632_0").hide();
	}
	function two_show(){
	    $("#div_UK-FCL-00676_0").show();
	    $("#div_UK-FCL-00677_0").show();
	    $("#title_UK-FCL-00676_0").show();
	}
	function two_hide(){
	    $("#div_UK-FCL-00676_0").hide();
	    $("#div_UK-FCL-00677_0").hide();
	    $("#title_UK-FCL-00676_0").hide();
	}

$("a.back_btn").css('visibility', 'hidden');
$("#UK-FCL-00632_0").attr('readonly',true);

	$("#UK-FCL-00650_0").on("blur",function(){
		var reg_no = $(this).val();	
		var type_of_entity = $("#UK-FCL-00675_0").val();	
				$.ajax({
		            type: "POST",
		            dataType:'json',
					data:{"type_of_entity":type_of_entity},
		            url: "/backoffice/infowizardtwo/subFormMemorandumOfSatisfactionForm7/getcompanyNameByregno/reg_no/" + reg_no,
		            beforeSend:function(){
		            	$("#UK-FCL-00650_0-error").text("Please wait...");	    	        	
		            },
		            success: function(result) {		            	
		            	if(result.status==true){		            		
		            			$("#UK-FCL-00650_0-error").text("");		         
		            		    $("#UK-FCL-00632_0").val(result.cname);		
		            			            			            	
		            	}else{
		            		$("#UK-FCL-00650_0-error").text(result.msg);							
		            		$("#UK-FCL-00632_0").val("");		            	
		            	}
		               // console.log(result);
		            }
		        });
				 
	});

	
});

function getcomapnyname(srn_no){
	if(srn_no!=""){
				$.ajax({
		            type: "POST",
		            dataType:'json',
		            url: "/backoffice/infowizardtwo/subFormMemorandumOfSatisfactionForm7/getCompanyNameBySrnNo/srn_no/" + srn_no +"/subID/<?= isset($_GET['subID']) ? $_GET['subID'] : NULL ?>",
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