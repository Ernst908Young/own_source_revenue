<style type="text/css">

div#UK-FCL-00111_0-error {
    margin-top: 3em;
}

</style>

<script type="text/javascript">
$(document).ready(function(){


  $("#UK-FCL-00320_0").prop('readonly',true); 
  $("#UK-FCL-00465_0").prop('readonly',true); 
  $("#UK-FCL-00320_0").val("Barbados");
  $("#UK-FCL-00465_0").val("Barbados");


$("#div_UK-FCL-00111_0").append("<div class='col-md-12 form-group para_text-1'>HEREBY APPLY to have the said charity registered under the abovementioned Act.</div>");	
 

 $("#UK-FCL-00111_0").keypress(function(e){

	var keyCode = e.which;	 
	console.log(keyCode);
	$(".proposedName").remove();
	if((keyCode == 33) || (keyCode == 64) || (keyCode == 35) || (keyCode == 36) || (keyCode == 37) || (keyCode == 94) || (keyCode== 42) || (keyCode== 126) || (keyCode== 96))
	{
		var id = $(this).attr('id');
		$("#div_"+id).append("<div id="+id+"'-error' style='color:red; margin-left:1em;' class='form-control-feedback-error proposedName'>Please enter the permitted special characters only i.e (),.&:;-</div>");			
		e.preventDefault();		
	}		
});


//200 Charactor Validation
var maxchars_2 = 200;
$('#UK-FCL-00111_0').keyup(function () {
    var tlength = $(this).val().length;
    $(this).val($(this).val().substring(0, maxchars_2));
    var tlength = $(this).val().length;
    remain = maxchars_2 - parseInt(tlength);

    $(".char_validation_1").remove();
    if(remain == 0){
      $("#UK-FCL-00111_0-error").parent('div').append("<div style='color:red;'  class='form-control-feedback-error char_validation_1'>Only 200 characters can be inserted in this field. In case you want to provide additional information, then please attach a schedule in required format.</div>");
      return false;
    }
});


//4000 Charactor Validation
var maxchars_3 = 4000;
$('#UK-FCL-00136_0').keyup(function () {
    var tlength = $(this).val().length;
    $(this).val($(this).val().substring(0, maxchars_3));
    var tlength = $(this).val().length;
    remain = maxchars_3 - parseInt(tlength);

    $(".char_validation_2").remove();
    if(remain == 0){
      $("#UK-FCL-00136_0-error").parent('div').append("<div style='color:red;'  class='form-control-feedback-error char_validation_2'>Only 4000 characters can be inserted in this field. In case you want to provide additional information, then please attach a schedule in required format.</div>");
      return false;
    }
});


//500 Charactor Validation
var maxchars_1 = 500;
$('#UK-FCL-00104_0').keyup(function () {
    var tlength = $(this).val().length;
    $(this).val($(this).val().substring(0, maxchars_1));
    var tlength = $(this).val().length;
    remain = maxchars_1 - parseInt(tlength);

    $(".char_validation_3").remove();
    if(remain == 0){
      $("#UK-FCL-00104_0-error").parent('div').append("<div style='color:red;'  class='form-control-feedback-error char_validation_3'>Space of 500 characters to be provided for address.</div>");
      return false;
    }
});


//100 Charactor Validation
var maxchars_4 = 100;
$('#UK-FCL-00137_0').keyup(function () {
    var tlength = $(this).val().length;
    $(this).val($(this).val().substring(0, maxchars_4));
    var tlength = $(this).val().length;
    remain = maxchars_4 - parseInt(tlength);

    $(".char_validation_4").remove();
    if(remain == 0){
      $("#UK-FCL-00137_0-error").parent('div').append("<div style='color:red;'  class='form-control-feedback-error char_validation_4'>Space of 100 characters to be provided for address.</div>");
      return false;
    }
});


//100 Charactor Validation
var maxchars_100 = 100;
$('#UK-FCL-00168_0').keyup(function () {
    var tlength = $(this).val().length;
    $(this).val($(this).val().substring(0, maxchars_100));
    var tlength = $(this).val().length;
    remain = maxchars_100 - parseInt(tlength);

    $(".char_validation_4").remove();
    if(remain == 0){
      $("#UK-FCL-00168_0-error").parent('div').append("<div style='color:red;'  class='form-control-feedback-error char_validation_4'>Space of 100 characters to be provided for Bank Name.</div>");
      return false;
    }
});


//100 Charactor Validation
var maxchars_200 = 200;
$('#UK-FCL-00169_0').keyup(function () {
    var tlength = $(this).val().length;
    $(this).val($(this).val().substring(0, maxchars_200));
    var tlength = $(this).val().length;
    remain = maxchars_200 - parseInt(tlength);

    $(".char_validation_4").remove();
    if(remain == 0){
      $("#UK-FCL-00169_0-error").parent('div').append("<div style='color:red;'  class='form-control-feedback-error char_validation_4'>Space of 100 characters to be provided for Bank Name.</div>");
      return false;
    }
});


//1000 Charactor Validation
var maxchars_5 = 1000;
$('#UK-FCL-00275_0').keyup(function () {
    var tlength = $(this).val().length;
    $(this).val($(this).val().substring(0, maxchars_5));
    var tlength = $(this).val().length;
    remain = maxchars_5 - parseInt(tlength);

    $(".char_validation_5").remove();
    if(remain == 0){
      $("#UK-FCL-00275_0-error").parent('div').append("<div style='color:red;'  class='form-control-feedback-error char_validation_5'>Space of 1000 characters to be provided for Description.</div>");
      return false;
    }
});


//1000 Charactor Validation
var maxchars_6 = 1000;
$('#UK-FCL-00456_0').keyup(function () {
    var tlength = $(this).val().length;
    $(this).val($(this).val().substring(0, maxchars_6));
    var tlength = $(this).val().length;
    remain = maxchars_6 - parseInt(tlength);

    $(".char_validation_6").remove();
    if(remain == 0){
      $("#UK-FCL-00456_0-error").parent('div').append("<div style='color:red;'  class='form-control-feedback-error char_validation_6'>Space of 1000 characters to be provided for Description.</div>");
      return false;
    }
});


//1000 Charactor Validation
var maxchars_7 = 1000;
$('#UK-FCL-00462_0').keyup(function () {
    var tlength = $(this).val().length;
    $(this).val($(this).val().substring(0, maxchars_7));
    var tlength = $(this).val().length;
    remain = maxchars_7 - parseInt(tlength);

    $(".char_validation_7").remove();
    if(remain == 0){
      $("#UK-FCL-00462_0-error").parent('div').append("<div style='color:red;'  class='form-control-feedback-error char_validation_7'>Space of 1000 characters to be provided for Description.</div>");
      return false;
    }
});


//500 Charactor Validation
var maxchars_8 = 500;
$('#UK-FCL-00175_0').keyup(function () {
    var tlength = $(this).val().length;
    $(this).val($(this).val().substring(0, maxchars_8));
    var tlength = $(this).val().length;
    remain = maxchars_8 - parseInt(tlength);

    $(".char_validation_8").remove();
    if(remain == 0){
      $("#UK-FCL-00175_0-error").parent('div').append("<div style='color:red;'  class='form-control-feedback-error char_validation_8'>Space of 500 characters to be provided for Other Description.</div>");
      return false;
    }
});


//500 Charactor Validation
var maxchars_9 = 500;
$('#UK-FCL-00174_0').keyup(function () {
    var tlength = $(this).val().length;
    $(this).val($(this).val().substring(0, maxchars_9));
    var tlength = $(this).val().length;
    remain = maxchars_9 - parseInt(tlength);

    $(".char_validation_8").remove();
    if(remain == 0){
      $("#UK-FCL-00174_0-error").parent('div').append("<div style='color:red;'  class='form-control-feedback-error char_validation_8'>Space of 500 characters to be provided for Other Qualification.</div>");
      return false;
    }
});


//500 Charactor Validation
var maxchars_10 = 1000;
$('#UK-FCL-00177_0').keyup(function () {
    var tlength = $(this).val().length;
    $(this).val($(this).val().substring(0, maxchars_10));
    var tlength = $(this).val().length;
    remain = maxchars_10 - parseInt(tlength);

    $(".char_validation_8").remove();
    if(remain == 0){
      $("#UK-FCL-00177_0-error").parent('div').append("<div style='color:red;'  class='form-control-feedback-error char_validation_8'>Space of 500 characters to be provided for Other Qualification.</div>");
      return false;
    }
});


var today = new Date();
    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        autoclose:true,
        endDate: "today",
        maxDate: today
    }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
 });

 $("<div class='row'><div class='col-lg-12' id='details1'><strong>Address of Administrative Centre</strong></div></div><br>").insertAfter("#div_UK-FCL-00136_0");

 $("<div class='row'><div class='col-lg-12' id='details2'><strong>Details of the Trustees:</strong></div></div><br>").insertAfter("#div_UK-FCL-00452_0");

 $("<div class='row'><div class='col-lg-12' id='details2'><strong>Details of the Secretary:</strong></div></div><br>").insertBefore("#div_UK-FCL-00132_0");

 $("<div class='row'><div class='col-lg-12' id='details2'><strong>Details of the Treasurer:</strong></div></div><br>").insertBefore("#div_UK-FCL-00150_0");

 $("<div class='row'><div class='col-lg-12' id='details2'><strong>Bank Details:</strong></div></div><br>").insertAfter("#div_UK-FCL-00167_0");

 $("<div class='row'><div class='col-lg-12' id='details2'><strong>Details of the Auditor:</strong></div></div><br>").insertBefore("#div_UK-FCL-00172_0");


 $("<div class='row'><div class='col-lg-12' id='details2'><strong>Details of the Properties:</strong></div></div><br>").insertAfter("#div_UK-FCL-00175_0");




 // var trustees = $("input[name='UK-FCL-00301_0[]']")
	// .map(function(){return $(this).val();}).get();

	// //strArray = values.join(',')

 //  $("#UK-FCL-00172_0").on("change",function(){
     
 //     var audotorName = $("#UK-FCL-00172_0").val();

 //     console.log(trustees);
 //     console.log(audotorName);
 //     alert(trustees);

 //  });	



 $("#UK-FCL-00404_0").on("change",function(){

	if($(this).val()){
			$.ajax({
	            type: "POST",
	            dataType:'html',
	            url: "/backoffice/infowizard/subFormRegistrationCharityBoard/getpostalcode/p_id/" + $(this).val(),
	            beforeSend:function(){
	            /*	if ($("#UK-FCL-00228_0-error").length) {
				$("#UK-FCL-00228_0-error").text("Please enter the correct postal code");
			}else{*/
				$("#UK-FCL-00401_0-error").text("Please Wait...");
				//$("#div_UK-FCL-00401_0").find('div').append('<div id="UK-FCL-00401_0-error" class="form-control-feedback">Please Wait...</div>');
			//}	
	        	        	
	            },
	            success: function(result) {	         		            		
        			$("#UK-FCL-00401_0-error").text("");		         
        		    $("#UK-FCL-00401_0").html(result);	
        		   // alert(result);	            	
	            			              
	            }
	        });
	}	
});


$("#UK-FCL-00129_0").on("change",function(){

	if($(this).val()){
			$.ajax({
	            type: "POST",
	            dataType:'html',
	            url: "/backoffice/infowizard/subFormRegistrationCharityBoard/getpostalcode/p_id/" + $(this).val(),
	            beforeSend:function(){
	            /*	if ($("#UK-FCL-00228_0-error").length) {
				$("#UK-FCL-00228_0-error").text("Please enter the correct postal code");
			}else{*/
				$("#UK-FCL-00464_0-error").text("Please Wait...");
				//$("#div_UK-FCL-00464_0").find('div').append('<div id="UK-FCL-00464_0-error" class="form-control-feedback">Please Wait...</div>');
			//}	
	        	        	
	            },
	            success: function(result) {	         		            		
        			$("#UK-FCL-00464_0-error").text("");		         
        		    $("#UK-FCL-00464_0").html(result);	
        		   // alert(result);	            	
	            			              
	            }
	        });
	}	
}); 


$("#UK-FCL-00402_0").on('change', function() {
    var countryCode = $(this).val();		
	$("#UK-FCL-00372_0").select2("val","");
    $.ajax({
        type: "POST",
        url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
        success: function(result) {
            //alert(result);
            $("#UK-FCL-00372_0").html(result);
			<?php if (isset($_GET['subID']) || (isset($_GET['app_Sub_id']) && !empty($_GET['app_Sub_id']))) { ?>
			//alert("<?php echo @$fieldValues['UK-FCL-00372_0']; ?>");
            $("#UK-FCL-00372_0").val("<?php echo @$fieldValues['UK-FCL-00372_0']; ?>");
            $("#UK-FCL-00372_0").select2("val", "<?php echo @$fieldValues['UK-FCL-00372_0']; ?>");
            $("#UK-FCL-00372_0").change();
            <?php } ?>
        }
    });
});


$("#UK-FCL-00384_0").on('change', function() {
    var countryCode = $(this).val();		
	$("#UK-FCL-00454_0").select2("val","");
    $.ajax({
        type: "POST",
        url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
        success: function(result) {
            //alert(result);
            $("#UK-FCL-00454_0").html(result);
			<?php if (isset($_GET['subID']) || (isset($_GET['app_Sub_id']) && !empty($_GET['app_Sub_id']))) { ?>
			//alert("<?php echo @$fieldValues['UK-FCL-00454_0']; ?>");
            $("#UK-FCL-00454_0").val("<?php echo @$fieldValues['UK-FCL-00454_0']; ?>");
            $("#UK-FCL-00454_0").select2("val", "<?php echo @$fieldValues['UK-FCL-00454_0']; ?>");
            $("#UK-FCL-00454_0").change();
            <?php } ?>
        }
    });
});

$("#UK-FCL-00453_0").on('change', function() {
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


$("#UK-FCL-00470_0").on('change', function() {
    var countryCode = $(this).val();		
	$("#UK-FCL-00471_0").select2("val","");
    $.ajax({
        type: "POST",
        url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
        success: function(result) {
            //alert(result);
            $("#UK-FCL-00471_0").html(result);
			<?php if (isset($_GET['subID']) || (isset($_GET['app_Sub_id']) && !empty($_GET['app_Sub_id']))) { ?>
			//alert("<?php echo @$fieldValues['UK-FCL-00471_0']; ?>");
            $("#UK-FCL-00471_0").val("<?php echo @$fieldValues['UK-FCL-00471_0']; ?>");
            $("#UK-FCL-00471_0").select2("val", "<?php echo @$fieldValues['UK-FCL-00471_0']; ?>");
            $("#UK-FCL-00471_0").change();
            <?php } ?>
        }
    });
});

  


// Trustee detail validation 
	$("#div_UK-FCL-00133_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox' name='middlenamecheckbox' class='group1'> I do not have a middle name or middle initial</div>");
	$("#UK-FCL-00133_0").blur(function(){
		if($(this).val()){
			$("input[name=middlenamecheckbox]").prop('checked', false);	
		}
	});

	$("input[name=middlenamecheckbox]").change(function(){
		if($(this).val()){
			$("#UK-FCL-00133_0").val("");
		}
	});

	$('#middlenamecheckbox').change(function(){

        if($("#middlenamecheckbox").prop('checked') == true){


         $("#UK-FCL-00133_0").prop('readonly',true);

        }else{

          $("#UK-FCL-00133_0").prop('readonly',false);

        }

   });


  // Details of the Secretary:
	$("#div_UK-FCL-00105_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox-1' name='middlenamecheckbox-1' class='group1'> I do not have a middle name or middle initial</div>");
	$("#UK-FCL-00105_0").blur(function(){
		if($(this).val()){
			$("input[name=middlenamecheckbox-1]").prop('checked', false);	
		}
	});

	$("input[name=middlenamecheckbox-1]").change(function(){
		if($(this).val()){
			$("#UK-FCL-00105_0").val("");
		}
	});

	$('#middlenamecheckbox-1').change(function(){

        if($("#middlenamecheckbox-1").prop('checked') == true){


         $("#UK-FCL-00105_0").prop('readonly',true);

        }else{

          $("#UK-FCL-00105_0").prop('readonly',false);

        }

   });


   // Details of the Treasurer:
	$("#div_UK-FCL-00316_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox-2' name='middlenamecheckbox-2' class='group1'> I do not have a middle name or middle initial</div>");
	$("#UK-FCL-00316_0").blur(function(){
		if($(this).val()){
			$("input[name=middlenamecheckbox-2]").prop('checked', false);	
		}
	});

	$("input[name=middlenamecheckbox-2]").change(function(){
		if($(this).val()){
			$("#UK-FCL-00316_0").val("");
		}
	});

	$('#middlenamecheckbox-2').change(function(){

        if($("#middlenamecheckbox-2").prop('checked') == true){


         $("#UK-FCL-00316_0").prop('readonly',true);

        }else{

          $("#UK-FCL-00316_0").prop('readonly',false);

        }

   });


	// Details of the Auditor:
	$("#div_UK-FCL-00466_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox-3' name='middlenamecheckbox-3' class='group1'> I do not have a middle name or middle initial</div>");
	$("#UK-FCL-00466_0").blur(function(){
		if($(this).val()){
			$("input[name=middlenamecheckbox-3]").prop('checked', false);	
		}
	});

	$("input[name=middlenamecheckbox-3]").change(function(){
		if($(this).val()){
			$("#UK-FCL-00466_0").val("");
		}
	});

	$('#middlenamecheckbox-3').change(function(){

        if($("#middlenamecheckbox-3").prop('checked') == true){


         $("#UK-FCL-00466_0").prop('readonly',true);

        }else{

          $("#UK-FCL-00466_0").prop('readonly',false);

        }

   });


});






function addmorebtnchecksTristeedetail(){

 var nofTrustee = $("#UK-FCL-00452_0").val();

     var totalRowCount = 0;          
     totalRowCount =  $("#tbl_1859 td").closest("tr").length;

     if(nofTrustee< 3){
     	
       $(".check_number").remove();
      
		$("#title_UK-FCL-00452_0").append("<b style='color:red; margin-left:2em;' class='check_number'>Minimum no. of Trustees to be appointed is 3.</b>");

		var titleTot = jQuery("#title_UK-FCL-00452_0").offset().top;
		var addHeight = parseInt(titleTot) - 170;
		jQuery('html,body').animate({ scrollTop: addHeight}, 1000);

		$("#UK-FCL-00452_0").css("border", "1px solid #e73d4a");

     	 e.stop();
		  e.preventDefault();
		  return false;

     }else{
     
		  $("#UK-FCL-00452_0").css("border", "1px solid gray");
		  $(".check_number").hide();
      	return true;
     } 	 	

}


function addmorebtnchecksBankdetail(){

 var nofTrusteebank = $("#UK-FCL-00167_0").val();

 //alert(nofTrusteebank)

     var totalRowCount = 0;          
     totalRowCount =  $("#tbl_1914 td").closest("tr").length;

     if(nofTrusteebank < 1){
     	
       $(".check_number").remove();
      
		$("#title_UK-FCL-00167_0").append("<b style='color:red; margin-left:2em;' class='check_number'>Number should be greater then or equal to 01.</b>");

		var titleTot = jQuery("#title_UK-FCL-00167_0").offset().top;
		var addHeight = parseInt(titleTot) - 170;
		jQuery('html,body').animate({ scrollTop: addHeight}, 1000);

		$("#UK-FCL-00167_0").css("border", "1px solid #e73d4a");

     	 e.stop();
		  e.preventDefault();
		  return false;

     }else{
     
		  $("#UK-FCL-00167_0").css("border", "1px solid gray");
		  $(".check_number").hide();
      	return true;
     } 	 	

}


function addmorebtnchecksSecretary(){

     var totalRowCount = 0;          
     totalRowCount =  $("#tbl_1886 td").closest("tr").length;

     if(totalRowCount == 1){
        
       $(".check_number").remove();
      
        $("#title_UK-FCL-00452_0").append("<b style='color:red; margin-left:2em;' class='check_number'>You can not add more than 1 Secretary.</b>");

        var titleTot = jQuery("#title_UK-FCL-00452_0").offset().top;
        var addHeight = parseInt(titleTot) - 170;
        jQuery('html,body').animate({ scrollTop: addHeight}, 1000);

        //$("#UK-FCL-00452_0").css("border", "1px solid #e73d4a");

         e.stop();
          e.preventDefault();
          return false;

     }else{
     
          //$("#UK-FCL-00452_0").css("border", "1px solid gray");
          $(".check_number").hide();
        return true;
     }      

}


function addmorebtnchecksTreasurer(){

     var totalRowCount = 0;          
     totalRowCount =  $("#tbl_1900 td").closest("tr").length;

     if(totalRowCount == 1){
        
       $(".check_number").remove();
      
        $("#title_UK-FCL-00452_0").append("<b style='color:red; margin-left:2em;' class='check_number'>You can not add more than 1 Treasurer.</b>");

        var titleTot = jQuery("#title_UK-FCL-00452_0").offset().top;
        var addHeight = parseInt(titleTot) - 170;
        jQuery('html,body').animate({ scrollTop: addHeight}, 1000);

        //$("#UK-FCL-00452_0").css("border", "1px solid #e73d4a");

         e.stop();
          e.preventDefault();
          return false;

     }else{
     
          //$("#UK-FCL-00452_0").css("border", "1px solid gray");
          $(".check_number").hide();
        return true;
     }      

}



function addmorebtnchecksPropertiesdetail(){

 var nofProperties = $("#UK-FCL-00176_0").val();

     var totalRowCount = 0;          
     totalRowCount =  $("#tbl_1933 td").closest("tr").length;

     if(nofProperties <= totalRowCount){
        
       $(".check_number").remove();
      
        $("#title_UK-FCL-00167_0").append("<b style='color:red; margin-left:2em;' class='check_number'>Please Update No.of properties owned by Charity</b>");

        var titleTot = jQuery("#title_UK-FCL-00167_0").offset().top;
        var addHeight = parseInt(titleTot) - 170;
        jQuery('html,body').animate({ scrollTop: addHeight}, 1000);

        $("#UK-FCL-00176_0").css("border", "1px solid #e73d4a");

         e.stop();
          e.preventDefault();
          return false;

     }else{
     
          $("#UK-FCL-00176_0").css("border", "1px solid gray");
          $(".check_number").hide();
        return true;
     }      

}


function addmoreaction(id,service_id,div_id){
     
 	if(div_id==1859){
		var respon = addmorebtnchecksTristeedetail();
		if(respon==false){
			return false;
		}
	}else if(div_id==1914){
       
       var respon = addmorebtnchecksBankdetail();
		if(respon==false){
			return false;
		}
	}else if(div_id ==1886){

        var respon = addmorebtnchecksSecretary();
        if(respon==false){
            return false;
        }
    }else if(div_id ==1900){

        var respon = addmorebtnchecksTreasurer();
        if(respon==false){

            return false;
        }
    }else if(div_id ==1933){

        var respon = addmorebtnchecksPropertiesdetail();
        if(respon==false){

            return false;
        }
    }

 	//alert(div_id);
 	
 	$.ajax({
		type: "GET",
		dataType: 'json',
		data: {"button_id": id, "service_id": service_id, "add_more_button_di": div_id},
		url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/formFieldMaster/getAddmoreData",
		success: function (data) {
			console.log(data);
			var tr_ = "<tr class='add_more_"+div_id+"'>";
			var td_ = '';
			var err = 0;
			var fieldsIDArr = new Array();
			$.each(data, function (key, item) {
				var id = item.id;
				var vall;
				var typeVal;
				var name = item.full_name;
				var formchk_id = item.formchk_id;
				var selector = $('[name="' + formchk_id + '"]');
				var cls = '';
			
				if ($(selector).is("input")) {
					if ($("input:radio[name='" + formchk_id + "']").attr('type') == 'radio') {
						/*vall = $("input:radio[name='" + formchk_id + "']:checked").val();
						typeVal = 'radio';
						$("input:radio[name='" + formchk_id + "']").addClass('val');
						if ($("input:radio[name='" + formchk_id + "']").hasClass('val')) {
							cls = 'val';
						}*/
						var getSelectedValue = document.querySelector( 'input[name="'+formchk_id+'"]:checked');
						if(getSelectedValue!= null){
							vall = getSelectedValue.value
						}else{
							vall = '';
						}

						typeVal = 'radio';
						$("input:radio[name='" + formchk_id + "']").addClass('val');
						if ($("input:radio[name='" + formchk_id + "']").hasClass('val')) {
							cls = 'val';
						}
					}else if ($("input[name='" + formchk_id + "']").attr('type') == 'number') {
						vall = $("input[name='" + formchk_id + "']").val();
						typeVal = 'number';
						$("input[name='" + formchk_id + "']").addClass('val');
						if ($("input[name='" + formchk_id + "']").hasClass('val')) {
							cls = 'val';
						}							
					}
					else {
						vall = $("input[name='" + formchk_id + "']").val();
						typeVal = 'text';
						$("input:text[name='" + formchk_id + "']").addClass('val');
						if ($("input[name*='" + formchk_id + "']").hasClass('val')) {
							cls = 'val';
						}
						
					}
				}

				else if ($(selector).is("select") || $('#' + formchk_id).is("select")) {						
					if ($('#' + formchk_id).prop('multiple')) {
						typeVal = 'multiple';
						var selMulti = $.map($("#" + formchk_id + " option:selected"), function (el, i) {
							return $(el).text();
						});
						vall = selMulti.join(", ");
						$('#' + formchk_id).addClass('val');
						if ($('#' + formchk_id).hasClass('val')) {
							cls = 'val';
						}
						$("#" + formchk_id + " option").removeAttr("selected");
					}
					else {	
						typeVal = 'dropdown';
						vall = $("select[name='" + formchk_id + "'] option:selected").text();
						$("select[name='" + formchk_id + "']").addClass('val');	
						if ($("select[name='" + formchk_id + "']").hasClass('val')) {
							cls = 'val';
						}
						$("#" + formchk_id + " option").removeAttr("selected");
					}
				}
				else if ($(selector).is("textarea")) {	
					typeVal = 'textarea';
					vall = $("textarea[name='" + formchk_id + "']").val();
					$("textarea[name='" + formchk_id + "']").addClass('val');
					if ($("textarea[name='" + formchk_id + "']").hasClass('val')) {
						cls = 'val';
					}
				}
				else if ($('.chk_' + formchk_id).is(':checkbox')) {
					typeVal = 'checkbox';
					vall = $('.chk_' + formchk_id + ':checked').map(function () {
						return this.value;
					}).get().join(',');
					$('.chk_' + formchk_id).addClass('val');
					if ($('.chk_' + formchk_id).hasClass('val')) {
						cls = 'val';
					}	
				}

				if (cls == 'val' && (vall == '' || vall == 'undefined' || vall == 'Please Select ')) {
					$(".errorDetail").remove();
					if(div_id==1859){

						if(formchk_id=='UK-FCL-00133_0'){
					var mnt = $("#UK-FCL-00133_0").val();
					if(mnt){
						var checkfield = true;
					}else{
						var mncb = $('input[name=middlenamecheckbox]:checked').val(); 
						if(mncb){
							var checkfield = true;
						}else{
							var checkfield = false;
						}
					}
				}else{
					var checkfield = true;
				}	
							if(formchk_id=='UK-FCL-00301_0' || formchk_id=='UK-FCL-00106_0' || formchk_id=='UK-FCL-00104_0' || formchk_id=='UK-FCL-00402_0' || formchk_id == 'UK-FCL-00372_0' || formchk_id=='UK-FCL-00137_0'||  checkfield == false){
									var labelData = $("#label_" + formchk_id).text();
								labelData=labelData.replace('('+formchk_id+')',"");
								//alert(formchk_id);
								$("#div_"+formchk_id).append("<span style='color:red;padding-left:16px;' class='errorDetail'>This field is required</span>");						
								err = err + 1;
								return false;
								}else{
									$(".errorDetail").remove();
									/*if(formchk_id=='UK-FCL-00133_0' || formchk_id=='UK-FCL-00137_0'){
										if(vall==""){
											vall = 'NA';
										}
									}*/
									td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
												fieldsIDArr.push(formchk_id);		
								}	
					}

					if(div_id==1886){

						if(formchk_id=='UK-FCL-00105_0'){
					var mnt = $("#UK-FCL-00105_0").val();
					if(mnt){
						var checkfield = true;
					}else{
						var mncb = $('input[name=middlenamecheckbox-1]:checked').val(); 
						if(mncb){
							var checkfield = true;
						}else{
							var checkfield = false;
						}
					}
				}else{
					var checkfield = true;
				}	
							if(formchk_id=='UK-FCL-00132_0' || formchk_id=='UK-FCL-00317_0' || formchk_id=='UK-FCL-00107_0' || formchk_id=='UK-FCL-00384_0' || formchk_id == 'UK-FCL-00454_0' || formchk_id=='UK-FCL-00304_0'||  checkfield == false){
									var labelData = $("#label_" + formchk_id).text();
								labelData=labelData.replace('('+formchk_id+')',"");
								//alert(formchk_id);
								$("#div_"+formchk_id).append("<span style='color:red;padding-left:16px;' class='errorDetail'>This field is required</span>");						
								err = err + 1;
								return false;
								}else{
									$(".errorDetail").remove();
									/*if(formchk_id=='UK-FCL-00133_0' || formchk_id=='UK-FCL-00137_0'){
										if(vall==""){
											vall = 'NA';
										}
									}*/
									td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
												fieldsIDArr.push(formchk_id);		
								}	
					}


					if(div_id==1900){

						if(formchk_id=='UK-FCL-00316_0'){
					var mnt = $("#UK-FCL-00316_0").val();
					if(mnt){
						var checkfield = true;
					}else{
						var mncb = $('input[name=middlenamecheckbox-2]:checked').val(); 
						if(mncb){
							var checkfield = true;
						}else{
							var checkfield = false;
						}
					}
				}else{
					var checkfield = true;
				}	
							if(formchk_id=='UK-FCL-00150_0' || formchk_id=='UK-FCL-00324_0' || formchk_id=='UK-FCL-00308_0' || formchk_id=='UK-FCL-00453_0' || formchk_id == 'UK-FCL-00458_0' || formchk_id=='UK-FCL-00461_0'||  checkfield == false){
									var labelData = $("#label_" + formchk_id).text();
								labelData=labelData.replace('('+formchk_id+')',"");
								//alert(formchk_id);
								$("#div_"+formchk_id).append("<span style='color:red;padding-left:16px;' class='errorDetail'>This field is required</span>");						
								err = err + 1;
								return false;
								}else{
									$(".errorDetail").remove();
									/*if(formchk_id=='UK-FCL-00133_0' || formchk_id=='UK-FCL-00137_0'){
										if(vall==""){
											vall = 'NA';
										}
									}*/
									td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
												fieldsIDArr.push(formchk_id);		
								}	
					}

					if(div_id==188){
							if(formchk_id=='UK-FCL-00140_0' || formchk_id=='UK-FCL-00142_0' || formchk_id=='UK-FCL-00143_0'){
									var labelData = $("#label_" + formchk_id).text();
								labelData=labelData.replace('('+formchk_id+')',"");
								//alert(formchk_id);
								$("#div_"+formchk_id).append("<span style='color:red;padding-left:16px;' class='errorDetail'>Please fill the required field: "+$.trim(labelData)+"</span>");						
								err = err + 1;
								return false;
								}else{
									$(".errorDetail").remove();
									td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
												fieldsIDArr.push(formchk_id);		
								}	
					}

                    if(div_id==1933){
                            if(formchk_id=='UK-FCL-00177_0'){
                                    var labelData = $("#label_" + formchk_id).text();
                                labelData=labelData.replace('('+formchk_id+')',"");
                                //alert(formchk_id);
                                $("#div_"+formchk_id).append("<span style='color:red;padding-left:16px;' class='errorDetail'>Please fill the required field: "+$.trim(labelData)+"</span>");                        
                                err = err + 1;
                                return false;
                                }else{
                                    $(".errorDetail").remove();
                                    td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
                                                fieldsIDArr.push(formchk_id);       
                                }   
                    }


					if(div_id==1914){
							if(formchk_id=='UK-FCL-00168_0' || formchk_id=='UK-FCL-00169_0' || formchk_id=='UK-FCL-00129_0' || formchk_id=='UK-FCL-00465_0'){
									var labelData = $("#label_" + formchk_id).text();
								labelData=labelData.replace('('+formchk_id+')',"");
								//alert(formchk_id);
								$("#div_"+formchk_id).append("<span style='color:red;padding-left:16px;' class='errorDetail'>Please fill the required field: "+$.trim(labelData)+"</span>");						
								err = err + 1;
								return false;
								}else{
									$(".errorDetail").remove();
									td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
												fieldsIDArr.push(formchk_id);		
								}	
					}		
					
				}
				else {
					$(".errorDetail").remove();
					//console.log(typeVal);
					td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
					fieldsIDArr.push(formchk_id);						
				}

			}); 
			if (err == 0) {
				//alert(JSON.stringify(fieldsIDArr));
				$('#add_more_' + div_id).show();
				$('#tbl_' + div_id).show();
				td_ += "<td style='text-align:center;'><a class='btn btn-danger del_1' pi='add_more_"+div_id+"'><i class='fa fa-trash' aria-hidden='true'></i></a></td>";
				tr_ += td_ + "</tr>";
				$(tr_).appendTo($('#tbl_' + div_id));
				//alert(fieldsIDArr);
				fieldsIDArr.forEach(myFunction);
				function myFunction(value, index, array) {	
					$("input:radio[name='" + value + "']").prop('checked', false);
					$('#' + value).val("");
					$("#" + value + "").select2("val", "");
					$('.chk_' + value + ':checked').removeAttr('checked');
				}

				$("#UK-FCL-00465_0").attr('readonly',true);
				$("#UK-FCL-00465_0").val("Barbados");
		
			} else
				return false;
	                            
			$('.del_1').on('click', function () {					
				$(this).closest('tr').remove();
				var uio= $(this).attr('pi');
				if($("."+uio).length<2){
					$("#"+uio).css('display','none');
				}
	                                
			});
		} // success function close here
	}); //ajax end here
 }
</script>