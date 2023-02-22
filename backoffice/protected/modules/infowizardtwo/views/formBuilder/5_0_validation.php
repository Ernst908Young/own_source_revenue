
	

<style type="text/css">


.form-control-feedback {
	margin-top:5px;
}

 .form-control-feedback-error.char_validation_1 {
    margin-top: 12px;
    margin-left: 0em;
    font-size: 14px;
}

.form-control-feedback-error.char_validation_2 {
    margin-top: 12px;
    font-size: 14px;
}


input.chk_UK-FCL-00030_0 {
    margin-top: 2em;
}

label#label_UK-FCL-00149_0 {
    font-size: 13px;
}

/*.append_table {
    display: flex;
    position: absolute;
    margin-top: 3em;
}*/


table#tbl_2299 {
    width: 100%;
    overflow: scroll;
    display: flow-root;
}

div#div_UK-FCL-00137_0 {
    margin-top: 18em;
    visibility: hidden;
}

div#UK-FCL-00117_0\[\]-error {
    display: contents;
}

div#div_UK-FCL-00320_0{
	/*margin-top: -4em;*/
}

</style>

<script type="text/javascript">

$(document).ready(function(){

	$('#UK-FCL-00093_0,#UK-FCL-00309_0,#UK-FCL-00310_0').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });

   
     $("#UK-FCL-00310_0").attr('readonly',true);

    $('#UK-FCL-00150_0,#UK-FCL-00133_0,#UK-FCL-00134_0, #UK-FCL-00107_0, #UK-FCL-00390_0, #UK-FCL-00463_0, #UK-FCL-00383_0').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });

    $('#UK-FCL-00104_0,#UK-FCL-00335_0,#UK-FCL-00336_0, #UK-FCL-00094_0').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });




// Check SRN Number
  $("#UK-FCL-00149_0").prop('readonly',true);

  $("#UK-FCL-00090_0").prop('readonly',true);  	
  $("#UK-FCL-00096_0").prop('readonly',true);  

  //$("#UK-FCL-00104_0").prop('readonly',true);
  //$("#UK-FCL-00335_0").prop('readonly',true);
  //$("#UK-FCL-00295_0").prop('readonly',true);
 // $("#UK-FCL-00336_0").prop('readonly',true);
  //$("#UK-FCL-00094_0").prop('readonly',true);

  $("#UK-FCL-00228_0").prop('readonly',true);

  
  // address fields
  $("#UK-FCL-00352_0").prop('readonly',true);
  $("#UK-FCL-00353_0").prop('readonly',true);
  $("#UK-FCL-00354_0").prop('readonly',true);
  $("#UK-FCL-00355_0").prop('readonly',true);
  $("#UK-FCL-00356_0").prop('readonly',true);
  $("#UK-FCL-00357_0").prop('readonly',true);


 
  $("#div_UK-FCL-00337_0").hide();
  $("#div_UK-FCL-00338_0").hide();
  $("#div_UK-FCL-00100_0").hide();
  /*$("#div_UK-FCL-00103_0").hide();*/
  $("#div_UK-FCL-00483_0").hide();


  $("#UK-FCL-00137_0").val('Director Occupation');

var ff00245_0 = $('input[name=UK-FCL-00245_0]:checked').val();
if(ff00245_0 =='Yes'){

}else{
	//check decleration to enable fields  	
  $("#UK-FCL-00091_0").prop('readonly',true);  	
  $("#UK-FCL-00494_0").prop('readonly',true);
  $("#UK-FCL-00150_0").prop('readonly',true);
  $("#UK-FCL-00390_0").prop('readonly',true);
  $("#UK-FCL-00383_0").prop('readonly',true);
  $("#UK-FCL-00463_0").prop('readonly',true);
  $("#UK-FCL-00133_0").prop('readonly',true);
  $("#UK-FCL-00134_0").prop('readonly',true);
  $("#UK-FCL-00107_0").prop('readonly',true);
  $("#UK-FCL-00093_0").prop('readonly',true);
  $("#UK-FCL-00310_0").prop('readonly',true);
  $("#UK-FCL-00309_0").prop('readonly',true);
  $('#UK-FCL-00405_0').attr("disabled", true); 
  $('#UK-FCL-00400_0').attr("disabled", true); 
  $("#UK-FCL-00242_0").attr('disabled',true);
  $("#UK-FCL-00320_0").attr('disabled',true);
  $(".chk_UK-FCL-00098_0").prop('disabled',true);
  $('.chk_UK-FCL-00240_0 ').attr('disabled',true);  	
  //End
}


$(".chk_UK-FCL-00233_0")[0].checked = true;

$(".chk_UK-FCL-00233_0").on("change",function(){
		if($(this).val()=='Other Provisions'){
			if($(this).is(":checked")){
				$("#div_UK-FCL-00494_0").show();
			}else{
				$("#div_UK-FCL-00494_0").hide();
				$("#UK-FCL-00494_0").val("");
			}
			//
		}else{
			$(".chk_UK-FCL-00233_0 ")[0].checked = true;
		}
	});
  

  //Check radio button to enable the fields

 	$(".chk_UK-FCL-00245_0") 
    .change(function(){ 
        if( $(this).is(":checked") ){ 
            var chekcRadioBtnVal = $(this).val();

         if(chekcRadioBtnVal == 'Yes'){
           
              $(".check_radio_button_enable").hide();
              $("#UK-FCL-00091_0").prop('readonly',false);  	
			  $("#UK-FCL-00494_0").prop('readonly',false);
			  $("#UK-FCL-00150_0").prop('readonly',false);
			  $("#UK-FCL-00390_0").prop('readonly',false);
			  $("#UK-FCL-00383_0").prop('readonly',false);
			  $("#UK-FCL-00463_0").prop('readonly',false);
			  $("#UK-FCL-00133_0").prop('readonly',false);
			  $("#UK-FCL-00134_0").prop('readonly',false);
			  $("#UK-FCL-00107_0").prop('readonly',false);
			  $("#UK-FCL-00093_0").prop('readonly',false);
			  
              $("#UK-FCL-00309_0").prop('readonly',false);
              $('#UK-FCL-00405_0').attr("disabled", false); 
              $('#UK-FCL-00400_0').attr("disabled", false); 
			  $("#UK-FCL-00242_0").attr('disabled',false);
			  $("#UK-FCL-00320_0").attr('disabled',false);
			  $(".chk_UK-FCL-00098_0").prop('disabled',false);
			  $('.chk_UK-FCL-00240_0 ').attr('disabled',false);
			  $("input.group1").removeAttr("disabled");

         }
  
        }
    });  	

  //End


	$("#UK-FCL-00331_0").on("blur",function(){
		var srn_no = $(this).val();
		getcomapnyname(srn_no);
			 
	});

	

 


 

$(document).on('change', '.dateFieldselect', function () {

	
  	if($(this).val()=='Yes'){

  		$(".dateFieldselect").prop('required',true);
        //$(".details-office").prop('readonly',false);
        $(this).parents('tr').find('.details-office').prop('readonly',false);  	

    }else if($(this).val()=='No'){
        
  		$(".dateFieldselect").prop('required',false);
        //$(".details-office").prop('readonly',true);
        $(this).parents('tr').find('.details-office').prop('readonly',true);  	

    }		

  });		


  $("#UK-FCL-00320_0").on('change', function() {
        var countryCode = $(this).val();		
		$("#UK-FCL-00400_0").select2("val","");
		if(countryCode==829){
	        	$("#UK-FCL-00463_0").val('');
	        	$("#UK-FCL-00463_0").attr('readonly',true);
	        }else{
	        	$("#UK-FCL-00463_0").attr('readonly',false);
	        }
        $.ajax({
            type: "POST",
            url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
            success: function(result) {
                //alert(result);
                $("#UK-FCL-00400_0").html(result);
			
            }
        });
    });



   $("#UK-FCL-00295_0").on('change', function() {
        var countryCode = $(this).val();		
		$("#UK-FCL-00471_0").select2("val","");
		if(countryCode==829){
	        	$("#UK-FCL-00336_0").val('');
	        	$("#UK-FCL-00336_0").attr('readonly',true);
	        }else{
	        	$("#UK-FCL-00336_0").attr('readonly',false);
	        }
        $.ajax({
            type: "POST",
            url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
            success: function(result) {
                //alert(result);
                $("#UK-FCL-00471_0").html(result);
				var ff00103_0_0 = $('input[name=UK-FCL-00103_0]:checked').val();
                if(ff00103_0_0=='Yes'){
                	$("#UK-FCL-00471_0").val($("#UK-FCL-00405_0").val()).trigger("change");
                }
            }
        });
    }); 	


var invalidChars = ["-", "e", "+", "E"];

$("#UK-FCL-00149_0, #UK-FCL-00119_0, #UK-FCL-00120_0, #UK-FCL-00331_0").on("keydown", function(e){ 
    if(invalidChars.includes(e.key)){
         e.preventDefault();
    }
});

$("<div class='row'><div class='col-lg-12'><strong>The address of the principal office or premises of the Company is</strong></div></div><br>").insertAfter("#hr_UK-FCL-00352_0");


$("<div class='row'><div class='col-lg-12'><strong>Mailing Address of the Company</strong></div></div><br>").insertAfter("#div_UK-FCL-00103_0");


$("<div class='row'><div class='col-lg-12'><strong>The address of the principal office or premises of the Company is:</strong></div></div><br>").insertAfter("#title_UK-FCL-00093_0");



 
  $(".add-more-btn").click(function(e){

  
     if($('.chk_UK-FCL-00240_0 ').is(':checked'))
      { 

      	$("#UK-FCL-00133_0").prop('required',false);
        
        $(".errorDetail").remove();
      	var radioBtnVal = $("input[type='radio'][name='UK-FCL-00240_0']:checked").val();

      	if(radioBtnVal=="Fixed Number"){

         $(".no_val_selected").hide();
         $(".check_min_max_number").hide();
	     var nofdirecotor = $("#UK-FCL-00149_0").val();
	     var totalRowCount = 0;          
	     totalRowCount =  $("#tbl_2299 td").closest("tr").length;


	      
	     if(nofdirecotor<=totalRowCount){
	     	
	     	$(".check_fixed_number").remove();
	      $(".check_fixed_number_three").hide();	

			$("#title_UK-FCL-00240_0").append("<b style='color:red; margin-left:2em;' class='check_fixed_number'>Sorry if you want to add more directors  then please update number of directors</b>");

			var titleTot = jQuery("#title_UK-FCL-00240_0").offset().top;
			var addHeight = parseInt(titleTot) - 170;
			jQuery('html,body').animate({ scrollTop: addHeight}, 1000);

			$("#UK-FCL-00149_0").css("border", "1px solid #e73d4a");

	     	e.stop();
			e.preventDefault();
			return false;

	     }else if(nofdirecotor < 3){
	       
	      $(".check_fixed_number_three").remove();
	      $(".check_fixed_number").hide();
	      $(".check_min_max_number_three").hide();

			$("#title_UK-FCL-00240_0").append("<b style='color:red; margin-left:2em;' class='check_fixed_number_three'>Please note, that the minimum no. of directors in NPC should be three</b>");
			var titleTot = jQuery("#title_UK-FCL-00240_0").offset().top;
			var addHeight = parseInt(titleTot) - 170;
			jQuery('html,body').animate({ scrollTop: addHeight}, 1000);

			$("#UK-FCL-00149_0").css("border", "1px solid #e73d4a");

	     	e.stop();
			e.preventDefault();
			return false;
				
	     }else{
	     
			  $("#UK-FCL-00149_0").css("border", "1px solid gray");
	      	return true;
	     } 	 	

        }else if(radioBtnVal=="In Range"){
          
          $(".check_fixed_number").hide();
          $(".no_val_selected").hide();
          
          var mindirecotor = parseInt($("#UK-FCL-00119_0").val());
          var maxdirecotor = parseInt($("#UK-FCL-00120_0").val());
          var rangeInDirector = parseInt($("#UK-FCL-00483_0").val());
	      var totalRowCount = 0;          
	      totalRowCount =  $("#tbl_2299 td").closest("tr").length;

	      if(rangeInDirector < mindirecotor || rangeInDirector > maxdirecotor){
	
	      	$(".check_min_max_number_range").remove();	
			$("#title_UK-FCL-00149_0").append("<b style='color:red; margin-left:2em;' class='check_min_max_number_range'>Please Enter No. of Directors between "+mindirecotor+" to "+maxdirecotor+" </b>");

			var titleTot = jQuery("#title_UK-FCL-00149_0").offset().top;
			var addHeight = parseInt(titleTot) - 170;
			jQuery('html,body').animate({ scrollTop: addHeight}, 1000);

			$("#UK-FCL-00483_0").css("border", "1px solid #e73d4a");
		
	     	e.stop();
			e.preventDefault();
			return false;
             
	      }else if(rangeInDirector<=totalRowCount){

	      	$(".check_min_max_number_range").remove();	
			$("#title_UK-FCL-00149_0").append("<b style='color:red; margin-left:2em;' class='check_min_max_number_range'>Please update minimum and maximun number of directors.</b>");

			var titleTot = jQuery("#title_UK-FCL-00149_0").offset().top;
			var addHeight = parseInt(titleTot) - 170;
			jQuery('html,body').animate({ scrollTop: addHeight}, 1000);

			$("#UK-FCL-00483_0").css("border", "1px solid #e73d4a");
		
	     	e.stop();
			e.preventDefault();
			return false;


	      }else if(maxdirecotor<=totalRowCount){
             
		    $(".add_min_number_director").hide();	
	      	$(".check_min_max_number").remove();	
			$("#title_UK-FCL-00240_0").append("<b style='color:red; margin-left:2em;' class='check_min_max_number'>Please update minimum and maximun number of directors</b>");

			var titleTot = jQuery("#title_UK-FCL-00240_0").offset().top;
			var addHeight = parseInt(titleTot) - 170;
			jQuery('html,body').animate({ scrollTop: addHeight}, 1000);

			$("#UK-FCL-00120_0").css("border", "1px solid #e73d4a");
			$("#UK-FCL-00119_0").css("border", "1px solid #e73d4a");


	     	e.stop();
			e.preventDefault();
			return false;

	      }else if(maxdirecotor < mindirecotor){

	      $(".check_min_max_number").remove();	
	      $(".check_min_max_number_three").hide();

			$("#title_UK-FCL-00240_0").append("<b style='color:red; margin-left:2em;' class='check_min_max_number'>Please update minimum and maximun number of directors</b>");

			var titleTot = jQuery("#title_UK-FCL-00240_0").offset().top;
			var addHeight = parseInt(titleTot) - 170;
			jQuery('html,body').animate({ scrollTop: addHeight}, 1000);

			$("#UK-FCL-00119_0").css("border", "1px solid #e73d4a");
			$("#UK-FCL-00120_0").css("border", "1px solid #e73d4a");

	     	e.stop();
			e.preventDefault();
			return false;

	      }else if(mindirecotor <3){

	      $(".check_min_max_number_three").remove();
	      $(".check_min_max_number").hide();	
	      $(".check_fixed_number_three").hide();	
	      $(".check_min_max_number_range").hide();	

			$("#title_UK-FCL-00240_0").append("<b style='color:red; margin-left:2em;' class='check_min_max_number_three'>Please note, that the minimum no. of directors in NPC should be three</b>");

			var titleTot = jQuery("#title_UK-FCL-00240_0").offset().top;
			var addHeight = parseInt(titleTot) - 170;
			jQuery('html,body').animate({ scrollTop: addHeight}, 1000);

			$("#UK-FCL-00119_0").css("border", "1px solid #e73d4a");
			$("#UK-FCL-00120_0").css("border", "1px solid #e73d4a");

	     	e.stop();
			e.preventDefault();
			return false;
              
	      }else{
              
            $("#UK-FCL-00119_0").css("border", "1px solid gray");
			  $("#UK-FCL-00120_0").css("border", "1px solid gray");
			  return true;

	      }	


        }		

     }else{

     	$(".no_val_selected").remove();	
		$("#title_UK-FCL-00240_0").append("<b style='color:red; margin-left:2em;' class='no_val_selected'>Select atleast one of the options, then insert the number of Directors in numeric only.</b>");

		var titleTot = jQuery("#title_UK-FCL-00240_0").offset().top;

		var addHeight = parseInt(titleTot) - 170;
		jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
		e.stop();
		e.preventDefault();
		return false;
     }



 })


var ff0000098_0  = $('input[name=UK-FCL-00098_0]:checked').val();
if(ff0000098_0=='Yes'){
	 $("#div_UK-FCL-00494_0").show();
}else{
	 $("#div_UK-FCL-00494_0").hide();
}

 $('input[name=UK-FCL-00098_0]').change(function(){
		if($(this).val()=="Yes"){
			$("#div_UK-FCL-00494_0").show();
		}else{
			 $("#div_UK-FCL-00494_0").hide();
		}
});

var ff00240_0 = $('input[name=UK-FCL-00240_0]:checked').val();
if(ff00240_0 =="Fixed Number"){


            $("#div_UK-FCL-00320_0").css("margin-top", "0em");	
            $("#div_UK-FCL-00107_0").css("margin-top", "0em");

            $("#div_UK-FCL-00100_0").show();	

			$("#div_UK-FCL-00149_0").show();
			$("#div_UK-FCL-00119_0").hide();
			$("#UK-FCL-00119_0").val("");
		    $("#div_UK-FCL-00120_0").hide();
		    $("#UK-FCL-00120_0").val("");
            $("#div_UK-FCL-00483_0").hide();
		    $("#UK-FCL-00483_0").val("");

}else{
	 if(ff00240_0 =="In Range"){
	 	 $("#div_UK-FCL-00100_0").hide();
                $("#UK-FCL-00100_0").val('');	


				$("#div_UK-FCL-00119_0").show(); 
				$("#div_UK-FCL-00120_0").show();
				$("#div_UK-FCL-00149_0").hide();
				$("#UK-FCL-00241_0").val("");
                $("#div_UK-FCL-00483_0").show();
	 }else{
	 	$("#div_UK-FCL-00119_0").hide(); 
		$("#div_UK-FCL-00120_0").hide();
		$("#div_UK-FCL-00149_0").hide();
		$("#UK-FCL-00119_0").val("");
		$("#UK-FCL-00120_0").val("");
		$("#UK-FCL-00149_0").val("");
	 }            

}
	

 $('input[name=UK-FCL-00240_0]').change(function(){
		if($(this).val()=="Fixed Number"){

            $("#div_UK-FCL-00320_0").css("margin-top", "0em");	
            $("#div_UK-FCL-00107_0").css("margin-top", "0em");

            $("#div_UK-FCL-00100_0").show();	

			$("#div_UK-FCL-00149_0").show();
			$("#div_UK-FCL-00119_0").hide();
			$("#UK-FCL-00119_0").val("");
		    $("#div_UK-FCL-00120_0").hide();
		    $("#UK-FCL-00120_0").val("");
            $("#div_UK-FCL-00483_0").hide();
		    $("#UK-FCL-00483_0").val("");




		    //change radio button to reset range number text box and table values
		          $("#UK-FCL-00119_0").val("");
		          $("#UK-FCL-00120_0").val("");
		          $("#UK-FCL-00150_0").val("");
		          $("#UK-FCL-00390_0").val("");
		          $("#UK-FCL-00383_0").val("");
		          $("#UK-FCL-00463_0").val("");
		          $("#UK-FCL-00133_0").val("");
		          $("#UK-FCL-00134_0").val("");
		          $("#UK-FCL-00107_0").val("");
		          $("#tbl_2299 td").parent().remove();
		          //End

		}else{
			if($(this).val()=="In Range"){

                //$("#div_UK-FCL-00320_0").css("margin-top", "-4em");

                $("#div_UK-FCL-00100_0").hide();
                $("#UK-FCL-00100_0").val('');	


				$("#div_UK-FCL-00119_0").show(); 
				$("#div_UK-FCL-00120_0").show();
				$("#div_UK-FCL-00149_0").hide();
				$("#UK-FCL-00241_0").val("");
                $("#div_UK-FCL-00483_0").show();


				//change radio button to reset fixed number text box and table values
		          $("#UK-FCL-00149_0").val("");
		          $("#UK-FCL-00150_0").val("");
		          $("#UK-FCL-00390_0").val("");
		          $("#UK-FCL-00383_0").val("");
		          $("#UK-FCL-00463_0").val("");
		          $("#UK-FCL-00134_0").val("");
		          $("#UK-FCL-00133_0").val("");
		          $("#UK-FCL-00107_0").val("");
		          $("#tbl_2299 td").parent().remove();
		          //End
			}		
		}		
	});



 $("#UK-FCL-00100_0").blur(function(){
   
    var nofdirecotors = $("#UK-FCL-00100_0").val();
    $("#UK-FCL-00149_0").val(nofdirecotors);

 });

 $("#UK-FCL-00119_0").blur(function(){
		var maxnu = $("#UK-FCL-00120_0").val();
		if(maxnu){
			if(Number($(this).val())>= Number(maxnu)){
			$("#UK-FCL-00119_0-error").text("Minimum number should be less then Maximum number");
			}else{
				$("#UK-FCL-00119_0-error").text("");
				$("#UK-FCL-00120_0-error").text("");
			}
		}		
	});

	$("#UK-FCL-00120_0").blur(function(){
		var minnu = $("#UK-FCL-00119_0").val();
		if(minnu){
		if(Number($(this).val())<= Number(minnu)){
			$("#UK-FCL-00120_0-error").text("Maximum number should be greater then Minimum number");
		}else{
			$("#UK-FCL-00120_0-error").text("");
			$("#UK-FCL-00119_0-error").text("");
		}
	}
	});



  // $("#UK-FCL-00150_0").blur(function(){ 

  //    var directorName = $("#UK-FCL-00150_0").val();
	 //  $("#UK-FCL-00108_0").val(directorName);

  // });

  // $("UK-FCL-00107_0").blur(function(){ 

  //    var directorAddress = $("#UK-FCL-00107_0").val();
	 //  $("#UK-FCL-00109_0").val(directorAddress);

  // });	

  var f00103_0 = $('input[name=UK-FCL-00103_0]:checked').val();
if(f00103_0=='Yes'){
		 

	  	$("#UK-FCL-00104_0, #UK-FCL-00335_0, #UK-FCL-00336_0, #UK-FCL-00094_0").prop('readonly',true);

	  	$("#UK-FCL-00295_0, #UK-FCL-00471_0").prop('disabled',true);

	  	$("#div_UK-FCL-00295_0").append("<div id='getcontrystate'><input type='hidden' name='UK-FCL-00295_0' value='829'/><input type='hidden' name='UK-FCL-00471_0' value='"+$("#UK-FCL-00405_0").val()+"'/></div>");
}else{

}


$("input[name=UK-FCL-00103_0]").on("change",function(){	
	  if($(this).val()=='Yes'){
	  	$("#UK-FCL-00104_0").val($("#UK-FCL-00093_0").val());
	  	$("#UK-FCL-00335_0").val($("#UK-FCL-00309_0").val());

	  	$("#UK-FCL-00295_0").val(829).trigger("change");	  	

	  	$("#UK-FCL-00336_0").val($("#UK-FCL-00310_0").val());
	  	$("#UK-FCL-00094_0").val($("#UK-FCL-00242_0 option:selected").text());	 
	  
	  	$("#UK-FCL-00104_0, #UK-FCL-00335_0, #UK-FCL-00336_0, #UK-FCL-00094_0").prop('readonly',true);

	  	$("#UK-FCL-00295_0, #UK-FCL-00471_0").prop('disabled',true);

	  	$("#div_UK-FCL-00295_0").append("<div id='getcontrystate'><input type='hidden' name='UK-FCL-00295_0' value='829'/><input type='hidden' name='UK-FCL-00471_0' value='"+$("#UK-FCL-00405_0").val()+"'/></div>");

	  }else{

	  	$("#getcontrystate").html("");


	  		$("#UK-FCL-00104_0, #UK-FCL-00335_0, #UK-FCL-00336_0, #UK-FCL-00094_0").val("");

	  	$("#UK-FCL-00295_0, #UK-FCL-00471_0").val("").trigger("change");
	  	$("#UK-FCL-00104_0, #UK-FCL-00335_0, #UK-FCL-00336_0, #UK-FCL-00094_0").prop('readonly',false);

	  	$("#UK-FCL-00295_0, #UK-FCL-00471_0").prop('disabled',false);
	  }
});


  

   //Check Postal Code.

 $("#UK-FCL-00096_0").val("BARBADOS"); 

// $("#UK-FCL-00242_0").blur(function(){
// 		$("#pcem").text("");
// 		if($(this).val()!=''){
// 			var bb5 = /^B{2}\d{5}$/i;
// 		var bb5a = bb5.exec($(this).val());
// 		if(bb5a==null){
// 			var bb8 = /^B{2}\d{8}$/i;
// 			var bb8a = bb8.exec($(this).val());
// 			if(bb8a==null){
// 				if ($("#pcem").length) {
// 					$("#pcem").text("Please enter the correct postal code");
//     			}else{
//     				$("#div_UK-FCL-00242_0").find('div').append('<div style="color:red;" id="pcem">Please enter the correct postal code</div>');
//     			}				
// 				/*$("#div_UK-FCL-00127_0").append('<div style="color:red;">Please enter the correct postal code</div>');*/
// 				//alert("Please enter the correct postal code");
// 				$(this).val('');	
// 			}					
// 		}else{
// 			//console.log(bb5a);
// 		}
// 		}
		
// 	});


$("#UK-FCL-00405_0").on("change",function(){
	if($(this).val()){
			$.ajax({
	            type: "POST",
	            dataType:'html',
	            url: "/backoffice/infowizard/subFormRegistrationCharityBoard/getpostalcode/p_id/" + $(this).val(),
	            beforeSend:function(){
	            /*	if ($("#UK-FCL-00405_0-error").length) {
				$("#UK-FCL-00405_0-error").text("Please enter the correct postal code");
			}else{*/
				$("#UK-FCL-00405_0-error").text("Please Wait...");
				//$("#div_UK-FCL-00405_0").find('div').append('<div id="UK-FCL-00405_0-error" class="form-control-feedback">Please Wait...</div>');
			//}	
	        	        	
	            },
	            success: function(result) {	         		            		
        			$("#UK-FCL-00405_0-error").text("");		         
        		    $("#UK-FCL-00242_0").html(result);	
        		   // alert(result);	            	
	            			              
	            }
	        });
	}	
});  




$("#UK-FCL-00337_0").on("change",function(){
	if($(this).val()){
			$.ajax({
	            type: "POST",
	            dataType:'html',
	            url: "/backoffice/infowizard/subFormRegistrationCharityBoard/getpostalcode/p_id/" + $(this).val(),
	            beforeSend:function(){
	            /*	if ($("#UK-FCL-00338_0-error").length) {
				$("#UK-FCL-00338_0-error").text("Please enter the correct postal code");
			}else{*/
				$("#UK-FCL-00338_0-error").text("Please Wait...");
				//$("#div_UK-FCL-00338_0").find('div').append('<div id="UK-FCL-00338_0-error" class="form-control-feedback">Please Wait...</div>');
			//}	
	        	        	
	            },
	            success: function(result) {	         		            		
        			$("#UK-FCL-00338_0-error").text("");		         
        		    $("#UK-FCL-00338_0").html(result);	
        		   // alert(result);	            	
	            			              
	            }
	        });
	}	
});



  $("#UK-FCL-00100_0").on("change",function(){
		if($(this).val()>0){
			$("#UK-FCL-00119_0, #UK-FCL-00120_0").val("");
		}else{
			
		}
	});


  $("#UK-FCL-00119_0,#UK-FCL-00120_0").blur(function(){
		if($(this).val()>0){
			
			$("#UK-FCL-00100_0").val("").trigger("change");
			
		}else{
			
		}
	});


  //validation for not allowed the number and special charector

  $("#UK-FCL-00150_0, #UK-FCL-00133_0, #UK-FCL-00134_0, #UK-FCL-00052_0, #UK-FCL-00105_0, #UK-FCL-00106_0, #UK-FCL-00110_0").keypress(function(event){
        var inputValue = event.charCode;
      
        if(!(inputValue >= 65) && (inputValue != 32 && inputValue != 0)){
            event.preventDefault();
        }
    });


 //4000 Charactor Validation
  var maxchars = 4000;
	$('textarea#UK-FCL-00091_0').keyup(function () {
	    var tlength = $(this).val().length;
	    $(this).val($(this).val().substring(0, maxchars));
	    var tlength = $(this).val().length;
	    remain = maxchars - parseInt(tlength);
	    $(".char_validation_1").remove();
	    if(remain == 0){
	      $("#UK-FCL-00091_0-error").parent('div').append("<div style='color:red;'  class='form-control-feedback-error char_validation_1'>Please add Schedule as an attachment, if the text exceeds the limit of 4000 characters.</div>");
	      return false;
	    }
	});


	var maxchars = 4000;
	$('textarea#UK-FCL-00494_0').keyup(function () {
	    var tlength = $(this).val().length;
	    $(this).val($(this).val().substring(0, maxchars));
	    var tlength = $(this).val().length;
	    remain = maxchars - parseInt(tlength);
	    $(".char_validation_2").remove();
	    if(remain == 0){
	      $("#UK-FCL-00494_0-error").parent('div').append("<div style='color:red;' class='form-control-feedback-error char_validation_2'>Please add Schedule as an attachment, if the text exceeds the limit of 4000 characters.</div>");
	      return false;
	    }
	});

	var maxchars = 500;
	$('textarea#UK-FCL-00093_0').keyup(function () {
	    var tlength = $(this).val().length;
	    $(this).val($(this).val().substring(0, maxchars));
	    var tlength = $(this).val().length;
	    remain = maxchars - parseInt(tlength);
	    
	});


	var maxchars = 100;
	$('#UK-FCL-00110_0').keyup(function () {
	    var tlength = $(this).val().length;
	    $(this).val($(this).val().substring(0, maxchars));
	    var tlength = $(this).val().length;
	    remain = maxchars - parseInt(tlength);
	    $(".char_validation_2").remove();
	    if(remain == 0){
	      $("#UK-FCL-00110_0-error").parent('div').append("<div style='color:red;' class='form-control-feedback-error char_validation_2'>Can not exceed 100 characters limit.</div>");
	      return false;
	    }
	});


	$("textarea#UK-FCL-00091_0,#UK-FCL-00494_0").on("blur",function(){
		  $(".char_validation_1").hide();
		  $(".char_validation_2").hide();
		 
	});



	// Director detail validation 
	$("#div_UK-FCL-00133_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox' name='middlenamecheckbox' class='group1'> I do not have a middle name or middle initial</div>");
	$("#UK-FCL-00133_0").blur(function(){
	/*	if($(this).val()){
			$("input[name=middlenamecheckbox]").prop('checked', false);	
		}*/
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


  });



function getcomapnyname(srn_no){
	if(srn_no!=""){
				$.ajax({
		            type: "POST",
		            dataType:'json',
		            url: "/backoffice/infowizardtwo/subFormIncorporationOfaNonProfitCompany/getCompanyNameBySrnNo/srn_no/" + srn_no +"/subID/<?= isset($_GET['subID']) ? $_GET['subID'] : NULL ?>",
		            beforeSend:function(){
		            	$("#UK-FCL-00331_0-error").text("Please wait...");	    	        	
		            },
		            success: function(result) {		            	
		            	if(result.status==true){
		            		if(result.app_status=='valid'){
		            			$("#UK-FCL-00090_0").val(result.name);
		            			$("#UK-FCL-00331_0-error").html("");
		            			$("#UK-FCL-00090_0-error").html("");	
		            		}else{
		            			$("#UK-FCL-00331_0-error").text(result.msg);			
		            			if ($("#UK-FCL-00090_0-error").length) {
									$("#UK-FCL-00090_0-error").text(errormessages.srn_msg001);
				    			}else{
				    				$("#div_UK-FCL-00090_0").find('div').append('<div  style="color:red;" id="UK-FCL-00090_0-error">'+errormessages.srn_msg001+'<br>'+errormessages.srn_msg002+'</div>');
				    			}    

				    			$("#UK-FCL-00090_0").val("");  
		            		}	            			            	
		            	}else{
		            		if(result.user){
		            			$("#UK-FCL-00331_0-error").text(result.msg);
		            		    $("#UK-FCL-00090_0").val("");	
		            		    $("#UK-FCL-00090_0-error").text("");
		            		}else{
		            			alert(result.msg);
		            		}		            			            	
		            	}
		             //  console.log(result);
		            }
		        });
		}	
}


 function addmoreaction(id,service_id,div_id){

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
					if(div_id==2299){

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
							if(formchk_id=='UK-FCL-00150_0' || formchk_id=='UK-FCL-00134_0' || formchk_id=='UK-FCL-00107_0' || formchk_id=='UK-FCL-00320_0' || formchk_id=='UK-FCL-00400_0' || checkfield == false){
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
								$("#div_"+formchk_id).append("<span style='color:red;padding-left:16px;' class='errorDetail'>This field is required</span>");						
								err = err + 1;
								return false;
								}else{
									$(".errorDetail").remove();
									td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
												fieldsIDArr.push(formchk_id);		
								}	
					}	
					if(div_id==669){
							if(formchk_id=='UK-FCL-00095_0' || formchk_id=='UK-FCL-00263_0' || formchk_id=='UK-FCL-00264_0' || formchk_id=='UK-FCL-00113_0'){
									var labelData = $("#label_" + formchk_id).text();
								labelData=labelData.replace('('+formchk_id+')',"");
								//alert(formchk_id);
								$("#div_"+formchk_id).append("<span style='color:red;padding-left:16px;' class='errorDetail'>This field is required</span>");						
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
				if(confirm('Before adding, please check whether the details entered is correct.'))
					
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
				$("input[name=middlenamecheckbox]").prop('checked', false);	
					$("#UK-FCL-00133_0").attr('readonly',false);
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



<?php if(isset($_SESSION['RESPONSE']["user_id"])){ ?>
    <script type="text/javascript">
        var deaultsrn = $("#UK-FCL-00331_0").val();
			if(deaultsrn){
				getcomapnyname(deaultsrn);
			}
    </script>   
<?php } ?>
<?php if(isset($_SESSION['uid'])){ ?>
    <!-- <script type="text/javascript">
        var mc_id = $("#UK-FCL-00295_0").val();
			if(mc_id){
				$("#UK-FCL-00295_0").val(mc_id).trigger("change");
			}
    </script>   --> 
<?php } ?>

