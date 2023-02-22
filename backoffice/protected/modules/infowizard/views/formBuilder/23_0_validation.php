<script type="text/javascript">
$(document).ready(function(){

// parish and postal code dependency
	$("#UK-FCL-00345_0").on("change",function(){
	if($(this).val()){
				$.ajax({
		            type: "POST",
		            dataType:'html',
		            url: "/backoffice/infowizardtwo/subFormRegistrationCharityBoard/getpostalcode/p_id/" + $(this).val(),
		            beforeSend:function(){
		        		$("#UK-FCL-00345_0-error").text("Please Wait...");
		        		$("#UK-FCL-00346_0").html("");
    				        },
		            success: function(result) {	         		            		
            			$("#UK-FCL-00345_0-error").text("");		         
            		    $("#UK-FCL-00346_0").html(result);	
                    }
		        });
		}	
});

// parish and postal code dependency
$("#UK-FCL-00531_0").on("change",function(){
	if($(this).val()){
				$.ajax({
		            type: "POST",
		            dataType:'html',
		            url: "/backoffice/infowizardtwo/subFormRegistrationCharityBoard/getpostalcode/p_id/" + $(this).val(),
		            beforeSend:function(){
		        		$("#UK-FCL-00531_0-error").text("Please Wait...");
		        		$("#UK-FCL-00532_0").html("");
    				        },
		            success: function(result) {	         		            		
            			$("#UK-FCL-00531_0-error").text("");		         
            		    $("#UK-FCL-00532_0").html(result);	
                    }
		        });
		}	
});	

// country and state/parish code dependency
    $("#UK-FCL-00007_0").on('change', function() {
        var countryCode = $(this).val();        
        $("#UK-FCL-00523_0").select2("val","");
        $.ajax({
            type: "POST",
            url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
            success: function(result) {
               $("#UK-FCL-00523_0").html(result);
            
            }
        });
    });

  // country and state/parish code dependency
 	$("#UK-FCL-00351_0").on('change', function() {
        var countryCode = $(this).val();		
		$("#UK-FCL-00349_0").select2("val","");
        $.ajax({
            type: "POST",
            url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
            success: function(result) {
               $("#UK-FCL-00349_0").html(result);
			
            }
        });
    });

	
 // country and state/parish code dependency
 	$("#UK-FCL-00096_0").on('change', function() {
        var countryCode = $(this).val();		
		$("#UK-FCL-00129_0").select2("val","");
        $.ajax({
            type: "POST",
            url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
            success: function(result) {
               $("#UK-FCL-00129_0").html(result);
			
            }
        });
    });

     // country and state/parish code dependency
 	$("#UK-FCL-00384_0").on('change', function() {
        var countryCode = $(this).val();		
		$("#UK-FCL-00534_0").select2("val","");
        $.ajax({
            type: "POST",
            url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
            success: function(result) {
               $("#UK-FCL-00534_0").html(result);
			
            }
        });
    });

     // country and state/parish code dependency
 	$("#UK-FCL-00295_0").on('change', function() {
        var countryCode = $(this).val();		
		$("#UK-FCL-00372_0").select2("val","");
        $.ajax({
            type: "POST",
            url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
            success: function(result) {
               $("#UK-FCL-00372_0").html(result);
			
            }
        });
    });




});
</script>