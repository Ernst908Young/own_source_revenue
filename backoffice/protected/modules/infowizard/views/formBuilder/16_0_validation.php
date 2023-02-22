<script type="text/javascript">
$(document).ready(function(){
	$("#UK-FCL-00197_0").attr('readonly',true);
	$("#UK-FCL-00413_0").attr('readonly',true);
	$("#UK-FCL-00476_0").attr('readonly',true);

	//first name
	$("#UK-FCL-00132_0").bind("keypress",function(){
		var regex=  new RegExp("^[ A-Za-z]*$"); //;
		var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    		if (!regex.test(key)) {
        		return false;
    		}
	});

	//middle name
	$("#UK-FCL-00105_0").bind("keypress",function(){
		var regex=  new RegExp("^[ A-Za-z]*$"); //;
		var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    		if (!regex.test(key)) {
        		return false;
    		}
	});

	//last name
	$("#UK-FCL-00106_0").bind("keypress",function(){
		var regex=  new RegExp("^[ A-Za-z]*$"); //;
		var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    		if (!regex.test(key)) {
        		return false;
    		}
	});
	
	$("#div_UK-FCL-00105_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox' name='middlenamecheckbox'> I do not have a middle name or middle initial</div>");

	$("#UK-FCL-00105_0").blur(function(){
		if($(this).val()){
			$("input[name=middlenamecheckbox]").prop('checked', false);	
		}
	});

	$("input[name=middlenamecheckbox]").change(function(){
		if($(this).is(':checked')){
			$("#UK-FCL-00105_0").val("");
			$("#UK-FCL-00105_0").attr('readonly',true);		
		}else{
			$("#UK-FCL-00105_0").attr('readonly',false);
		}
	});

// end director detail
   $("#UK-FCL-00096_0").on('change', function() {
        var countryCode = $(this).val();		
		$("#UK-FCL-00129_0").select2("val","");
        $.ajax({
            type: "POST",
            url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
            success: function(result) {
                //alert(result);
                $("#UK-FCL-00129_0").html(result);
				<?php if (isset($_GET['subID']) || (isset($_GET['app_Sub_id']) && !empty($_GET['app_Sub_id']))) { ?>
				//alert("<?php echo @$fieldValues['UK-FCL-00129_0']; ?>");
                $("#UK-FCL-00129_0").val("<?php echo @$fieldValues['UK-FCL-00129_0']; ?>");
                $("#UK-FCL-00129_0").select2("val", "<?php echo @$fieldValues['UK-FCL-00129_0']; ?>");
                $("#UK-FCL-00129_0").change();
                <?php } ?>
            }
        });
    });

	$("#UK-FCL-00290_0").on("blur",function(){
		var sreg_no = $(this).val();
	
		if(sreg_no>0){
				$.ajax({
		            type: "POST",
		            dataType:'json',
		            url: "/backoffice/infowizard/SubFormRegisteredAgent/getSocityNameByregno/reg_no/" + sreg_no,
		            beforeSend:function(){
		            	$("#UK-FCL-00290_0-error").text("Please wait...");	    	        	
		            },
		            success: function(result) {		            	
		            	if(result.status==true){		            		
		            			$("#UK-FCL-00290_0-error").text("");		         
		            		    	$("#UK-FCL-00197_0").val(result.sname);	
		            		    	$("#UK-FCL-00413_0").val(result.address);
						$("#UK-FCL-00476_0").val(result.address);			
		            			            			            	
		            	}else{
		            		$("#UK-FCL-00290_0-error").text(result.msg);
		            		$("#UK-FCL-00197_0").val("");	
		            		$("#UK-FCL-00413_0").val("");	
					$("#UK-FCL-00476_0").val("");	            	
		            	}
		               console.log(result);
		            }
		        });
		}		 
	});

	$("#UK-FCL-00290_0").bind("keypress",function(){
	var regex=  new RegExp("^[0-9]*$"); //;
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
	    if (!regex.test(key)) {
	        event.preventDefault();
	        return false;
	    }
	});	

});
</script>