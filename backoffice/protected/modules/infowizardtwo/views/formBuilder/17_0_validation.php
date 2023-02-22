<style type="text/css">

input#UK-FCL-00488_0 {
    width: 100%;
    margin-left: 2px;
}

#details1{
	display: none;
}

#details2{
  display: none;
}

#details3{
  display: none;
}

#details4{
  display: none;
}

#details5{
  display: none;
}

#details6{
  display: none;
}
#details66{
	display:none;
}
</style>

<script type="text/javascript">



$(document).ready(function(){



$("a.back_btn").css('visibility', 'hidden');
	$('#UK-FCL-00301_0, #UK-FCL-00105_0, #UK-FCL-00106_0, #UK-FCL-00093_0, #UK-FCL-00309_0, #UK-FCL-00315_0, #UK-FCL-00133_0, #UK-FCL-00419_0, #UK-FCL-00104_0, #UK-FCL-00238_0').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });

$("#label_UK-FCL-00093_0, #label_UK-FCL-00096_0, #label_UK-FCL-00106_0, #label_UK-FCL-00301_0, #label_UK-FCL-00404_0").find('b').after('<span style="color:red;"> * </span>');


$("#label_UK-FCL-00315_0, #label_UK-FCL-00419_0, #label_UK-FCL-00104_0, #label_UK-FCL-00405_0, #label_UK-FCL-00384_0").find('b').after('<span style="color:red;"> * </span>');

$("#label_UK-FCL-00420_0, #label_UK-FCL-00084_0, #label_UK-FCL-00421_0, #label_UK-FCL-00422_0").find('b').after('<span style="color:red;"> * </span>');


  $("#label_UK-FCL-00397_0, #label_UK-FCL-00423_0, #label_UK-FCL-00424_0, #label_UK-FCL-00425_0").find('b').after('<span style="color:red;"> * </span>');
  // conpany textbox

/*  $("#UK-FCL-00420_0").prop('readonly',true); 
  $("#UK-FCL-00084_0").prop('readonly',true); 
  $("#UK-FCL-00421_0").prop('readonly',true); 
  $("#UK-FCL-00417_0").prop('readonly',true); 
 */

 /* $("#UK-FCL-00420_0").val("01");
  $("#UK-FCL-00084_0").val("ABC Company");
  $("#UK-FCL-00421_0").val("ABC Company Address");*/
  

  $("#UK-FCL-00096_0").prop('readonly',true); 
  $("#UK-FCL-00384_0").prop('readonly',true); 
  $("#UK-FCL-00320_0").prop('readonly',true); 
  $("#UK-FCL-00096_0").val("BARBADOS");	
  $("#UK-FCL-00384_0").val("BARBADOS");	
  $("#UK-FCL-00320_0").val("BARBADOS");

 // 1 Change of name of firm
 $("#div_UK-FCL-00418_0").hide();

 // 2 Change of persons with names in full of new individuals
  $("#div_UK-FCL-00301_0").hide();
  $("#div_UK-FCL-00105_0").hide();
  $("#div_UK-FCL-00106_0").hide();
  $("#div_UK-FCL-00093_0").hide();
  $("#div_UK-FCL-00309_0").hide();
  $("#div_UK-FCL-00404_0").hide();
  $("#div_UK-FCL-00094_0").hide();
  $("#div_UK-FCL-00096_0").hide();
  $("#div_UK-FCL-00087_0").hide();
  $("#add_more_1705").hide();
  //3 Change of the name of persons who own the firm or business

  $("#div_UK-FCL-00315_0").hide();
  $("#div_UK-FCL-00133_0").hide();
  $("#div_UK-FCL-00419_0").hide();
  $("#div_UK-FCL-00104_0").hide();
  $("#div_UK-FCL-00238_0").hide();
  $("#div_UK-FCL-00405_0").hide();
  $("#div_UK-FCL-00383_0").hide();
  $("#div_UK-FCL-00384_0").hide();
  $("#div_UK-FCL-00138_0").hide();
  $("#add_more_1726").hide();


  //4 Change in Partner details where partner is a company:
  $("#div_UK-FCL-00420_0").hide();
  $("#div_UK-FCL-00084_0").hide();
  $("#div_UK-FCL-00421_0").hide();
  $("#div_UK-FCL-00422_0").hide();
  $("#div_UK-FCL-00207_0").hide();
  $("#add_more_1732").hide();

  //5 Change in Nationality of persons who own firm or business:

  $("#div_UK-FCL-00397_0").hide();
  $("#div_UK-FCL-00316_0").hide();
  $("#div_UK-FCL-00423_0").hide();
  $("#div_UK-FCL-00424_0").hide();
  $("#div_UK-FCL-00425_0").hide();
  $("#div_UK-FCL-00144_0").hide();
  $("#add_more_1738").hide();
  //6  Change of place of business registered office:

  $("#div_UK-FCL-00107_0").hide();
  $("#div_UK-FCL-00335_0").hide();
  $("#div_UK-FCL-00406_0").hide();
  $("#div_UK-FCL-00401_0").hide();
  $("#div_UK-FCL-00320_0").hide();

  //7 Change of Nature of Business:

  $("#div_UK-FCL-00426_0").hide();
  $("#div_UK-FCL-00427_0").hide();
  $("#div_UK-FCL-00428_0").hide();

  // 8 any other changes
  $("#div_UK-FCL-00429_0").hide();

//9 Change of place of business
  $("#div_UK-FCL-00169_0").hide();
  $("#div_UK-FCL-00353_0").hide();
  $("#div_UK-FCL-00295_0").hide();
  $("#div_UK-FCL-00129_0").hide();
  $("#div_UK-FCL-00310_0").hide();
  $("#div_UK-FCL-00242_0").hide();



 $("<div class='row'><div class='col-lg-12' id='details66'><strong>Change of place of business:</strong></div></div><br>").insertBefore("#div_UK-FCL-00169_0");
 
 $("<div class='row'><div class='col-lg-12' id='details1'><strong>Change of persons with names in full of new individuals:</strong></div></div><br>").insertBefore("#div_UK-FCL-00301_0");


 $("<div class='row'><div class='col-lg-12' id='details2'><strong>Change of the name of persons who own the firm or business:</strong></div></div><br>").insertBefore("#div_UK-FCL-00315_0");

 $("<div class='row'><div class='col-lg-12' id='details3'><strong>Change in Partner details where partner is a company:</strong></div></div><br>").insertBefore("#div_UK-FCL-00420_0");


 $("<div class='row'><div class='col-lg-12' id='details4'><strong>Change in Nationality of persons who own firm or business:</strong></div></div><br>").insertBefore("#div_UK-FCL-00397_0");


 $("<div class='row'><div class='col-lg-12' id='details5'><strong> Change of place of business registered office:</strong></div></div><br>").insertBefore("#div_UK-FCL-00107_0");


 $("<div class='row'><div class='col-lg-12' id='details6'><strong>Change of Nature of Business:</strong></div></div><br>").insertBefore("#div_UK-FCL-00426_0");

 $("#div_UK-FCL-00430_0").append("<div class='col-md-12 form-group para_text-1'>hereby give you notice of the following changes in respect of the <input type='text' name='UK-FCL-00488_0' class='form-control' id='UK-FCL-00488_0' readonly>carrying on business in the name of.<input type='text' name='UK-FCL-00489_0' class='form-control' id='UK-FCL-00489_0' readonly>which is required to be registered under section 8 of the Registration of Business Names Act, Cap. 317.</div>");

  var ff416 = $("#UK-FCL-00416_0").val();
if(ff416){
  //alert(ff416)
  //hideonchange();
  manupulatefields(ff416); 
}

 $("#UK-FCL-00430_0").on('change', function() { 
      var rgstrVal = $(this).val();
      if(rgstrVal == 'I'){
      	var strText = 'individual';
      }else if(rgstrVal == 'We'){
      	var strText = 'firm';
      }else{
      	var strText = '';
      }
     $("#UK-FCL-00488_0").val(strText); 

 });


var ff00430_0 = $("#UK-FCL-00430_0").val();
if(ff00430_0 == 'I'){
        var strText = 'individual';
      }else{
          if(ff00430_0 == 'We'){
          var strText = 'firm';
        }else{
          var strText = '';
        }
      } 
$("#UK-FCL-00488_0").val(strText);


 $("#UK-FCL-00295_0").on('change', function() {
        var countryCode = $(this).val();    
    $("#UK-FCL-00129_0").select2("val","");
        $.ajax({
            type: "POST",
            url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
            success: function(result) {
                //alert(result);
                $("#UK-FCL-00129_0").html(result);
        
            }
        });
    });

 var ff00415_0 = $("#UK-FCL-00415_0").val();
  if(ff00415_0){
            $.ajax({
                type: "POST",
                dataType:'json',
                url: "/backoffice/infowizardtwo/subFormStatementGivingNoticeOfChangesForm3/getCompanyNameByregno/reg_no/" + ff00415_0,
               
                success: function(result) {                     
                    if(result.status==true){                                        
                      $("#UK-FCL-00489_0").val(result.cname);                                          
                    }                  
                }
            });
    }  


$("#UK-FCL-00415_0").on("blur",function(){
        var reg_no = $(this).val();

    if(reg_no){
            $.ajax({
                type: "POST",
                dataType:'json',
                url: "/backoffice/infowizardtwo/subFormStatementGivingNoticeOfChangesForm3/getCompanyNameByregno/reg_no/" + reg_no,
                beforeSend:function(){
                    $("#UK-FCL-00415_0-error").text("Please wait...");                      
                },
                success: function(result) {                     
                    if(result.status==true){                            
                            $("#UK-FCL-00415_0-error").text("");                 
                            $("#UK-FCL-00489_0").val(result.cname); 

							$("#UK-FCL-00489_0").prop('readonly',true);
                                                                    
                    }else{
                        $("#UK-FCL-00415_0-error").text(result.msg);
						$("#UK-FCL-00489_0").val("");                       
                    }
                   console.log(result);
                }
            });
    }        
});


/*var today = new Date();
$('.datepicker').datepicker({
    format: 'dd-mm-yyyy',
    autoclose:true,
    endDate: "today",
    maxDate: today
}).on('changeDate', function (ev) {
        $(this).datepicker('hide');
    });*/


$("#UK-FCL-00418_0").keypress(function(e){
		var keyCode = e.which;	 
		console.log(keyCode);
		$(".proposedName").remove();
		if((keyCode == 33) || (keyCode == 64) || (keyCode == 35) || (keyCode == 36) || (keyCode == 37) || (keyCode == 94) || (keyCode== 42) || (keyCode== 126) || (keyCode== 96))
		{
			var id = $(this).attr('id');
			$("#div_"+id).append("<div id="+id+"'-error' style='color:red; margin-left:1em;' class='form-control-feedback-error proposedName'>Only following Special Characters should be allowed (),.&:;-</div>");			
			e.preventDefault();		
		}		
	});


var maxchars = 300;
$('#UK-FCL-00418_0').keyup(function () {
    var tlength = $(this).val().length;
    $(this).val($(this).val().substring(0, maxchars));
    var tlength = $(this).val().length;
    remain = maxchars - parseInt(tlength);
    $(".char_validation_1").remove();
    if(remain == 0){
      $("#UK-FCL-00418_0-error").parent('div').append("<div style='color:red;'  class='form-control-feedback-error char_validation_1'>Name should have maximum 300 characters.</div>");
      return false;
    }
});


var maxchars = 2000;
$('#UK-FCL-00427_0').keyup(function () {
    var tlength = $(this).val().length;
    $(this).val($(this).val().substring(0, maxchars));
    var tlength = $(this).val().length;
    remain = maxchars - parseInt(tlength);
    $(".char_validation_1").remove();
    if(remain == 0){
      $("#UK-FCL-00427_0-error").parent('div').append("<div style='color:red;'  class='form-control-feedback-error char_validation_1'>Length of the nature of business text box will be 2000 characters.</div>");
      return false;
    }
});

var maxchars = 2000;
$('#UK-FCL-00429_0').keyup(function () {
    var tlength = $(this).val().length;
    $(this).val($(this).val().substring(0, maxchars));
    var tlength = $(this).val().length;
    remain = maxchars - parseInt(tlength);
    $(".char_validation_1").remove();
    if(remain == 0){
      $("#UK-FCL-00429_0-error").parent('div').append("<div style='color:red;'  class='form-control-feedback-error char_validation_1'>Space of 2000 characters is to be provided for this field.</div>");
      return false;
    }
});


// middile name -1
$("#div_UK-FCL-00105_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox' name='middlenamecheckbox' class='group1'> I do not have a middle name or middle initial</div>");
	$("#UK-FCL-00105_0").blur(function(){
		if($(this).val()){
			$("input[name=middlenamecheckbox]").prop('checked', false);	
		}
	});

	$("input[name=middlenamecheckbox]").change(function(){
		if($(this).val()){
			$("#UK-FCL-00105_0").val("");
		}
	});


	$('#middlenamecheckbox').change(function(){

        if($("#middlenamecheckbox").prop('checked') == true){


         $("#UK-FCL-00105_0").prop('readonly',true);

        }else{

          $("#UK-FCL-00105_0").prop('readonly',false);

        }

   });



	// middile name -2
$("#div_UK-FCL-00133_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox-1' name='middlenamecheckbox-1' class='group1'> I do not have a middle name or middle initial</div>");
	$("#UK-FCL-00133_0").blur(function(){
		if($(this).val()){
			$("input[name=middlenamecheckbox-1]").prop('checked', false);	
		}
	});

	$("input[name=middlenamecheckbox-1]").change(function(){
		if($(this).val()){
			$("#UK-FCL-00133_0").val("");
		}
	});


	$('#middlenamecheckbox-1').change(function(){

        if($("#middlenamecheckbox-1").prop('checked') == true){


         $("#UK-FCL-00133_0").prop('readonly',true);

        }else{

          $("#UK-FCL-00133_0").prop('readonly',false);

        }

   });


// middile name -2
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


  $("#UK-FCL-00404_0").on("change",function(){
  if($(this).val()){
      $.ajax({
              type: "POST",
              dataType:'html',
              url: "/backoffice/infowizard/subFormRegistrationCharityBoard/getpostalcode/p_id/" + $(this).val(),
              beforeSend:function(){
              /*  if ($("#UK-FCL-00094_0-error").length) {
        $("#UK-FCL-00094_0-error").text("Please enter the correct postal code");
      }else{*/
        $("#UK-FCL-00094_0-error").text("Please Wait...");
        //$("#div_UK-FCL-00094_0").find('div').append('<div id="UK-FCL-00094_0-error" class="form-control-feedback">Please Wait...</div>');
      //} 
                      
              },
              success: function(result) {                             
              $("#UK-FCL-00094_0-error").text("");             
                $("#UK-FCL-00094_0").html(result);  
               // alert(result);                
                                  
              }
          });
  } 
});


$("#UK-FCL-00405_0").on("change",function(){
  if($(this).val()){
      $.ajax({
              type: "POST",
              dataType:'html',
              url: "/backoffice/infowizard/subFormRegistrationCharityBoard/getpostalcode/p_id/" + $(this).val(),
              beforeSend:function(){
              /*  if ($("#UK-FCL-00383_0_0-error").length) {
        $("#UK-FCL-00383_0_0-error").text("Please enter the correct postal code");
      }else{*/
        $("#UK-FCL-00383_0-error").text("Please Wait...");
        //$("#div_UK-FCL-00383_0").find('div').append('<div id="UK-FCL-00383_0-error" class="form-control-feedback">Please Wait...</div>');
      //} 
                      
              },
              success: function(result) {                             
              $("#UK-FCL-00383_0-error").text("");             
                $("#UK-FCL-00383_0").html(result);  
               // alert(result);                
                                  
              }
          });
  } 
});


$("#UK-FCL-00406_0").on("change",function(){
  if($(this).val()){
      $.ajax({
              type: "POST",
              dataType:'html',
              url: "/backoffice/infowizard/subFormRegistrationCharityBoard/getpostalcode/p_id/" + $(this).val(),
              beforeSend:function(){
              /*  if ($("#UK-FCL-00383_0_0-error").length) {
        $("#UK-FCL-00383_0_0-error").text("Please enter the correct postal code");
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






$("#UK-FCL-00416_0").on("change",function(){
  if($(this).val()){
    //hideonchange($(this).val());
    manupulatefields($(this).val());
  }
 
});


});


function manupulatefields(ff416){
     var myarr = ff416.toString().split(",");
    
 
   if (myarr.includes('Change of name of firm')) {
      one_show();
    }else{
       one_hide();
    }

     if (myarr.includes('Change of persons with names in full of new individuals')) {
      two_show();
    }else{
       two_hide();
    }

    if (myarr.includes('Change of the name of persons who own the firm or business')) {
      three_show();
    }else{
       three_hide();
    }

    if (myarr.includes('Change in Partner details where partner is a company')) {
      four_show();
    }else{
       four_hide();
    }

    if (myarr.includes('Nationality of persons who own firm or business')) {
      five_show();
    }else{
       five_hide();
    }

    if (myarr.includes('Change of place of business')) {
      six_show();
    }else{
       six_hide();
    }

    if (myarr.includes('Change of registered office')) {
      seven_show();
    }else{
       seven_hide();
    }

    if (myarr.includes('Change of nature of business')) {
      eight_show();
    }else{
       eight_hide();
    }

    if (myarr.includes('Any other change')) {
      nine_show();
    }else{
       nine_hide();
    }
 /*for(var i = 0; i < myarr.length; i++){
      var selectedValues = myarr[i];
    
    if(selectedValues == 'Change of name of firm'){
       one_show();    
    }else if(selectedValues == 'Change of persons with names in full of new individuals'){
        two_show();
    }else if(selectedValues == 'Change of the name of persons who own the firm or business'){
        three_show();
    }else if(selectedValues == 'Change in Partner details where partner is a company'){
      four_show();
    }else if(selectedValues == 'Nationality of persons who own firm or business'){      
        five_show();       
    }else if(selectedValues == 'Change of place of business'){
     six_show();
    }else if(selectedValues == 'Change of registered office'){
     seven_show();
    }else if(selectedValues == 'Change of nature of business'){
       eight_show();  
    }else if(selectedValues == 'Any other change'){    
     nine_show();
    }
  }*/
}
  


function one_show(){
    $("#div_UK-FCL-00418_0").show();
}

function two_show(){
    $("#div_UK-FCL-00301_0").show();
    $("#div_UK-FCL-00105_0").show();
    $("#div_UK-FCL-00106_0").show();
    $("#div_UK-FCL-00093_0").show();
    $("#div_UK-FCL-00309_0").show();
    $("#div_UK-FCL-00404_0").show();
    $("#div_UK-FCL-00094_0").show();
    $("#div_UK-FCL-00096_0").show();
    $("#div_UK-FCL-00087_0").show();
    $("#details1").show();
     totalRowCount =  $("#tbl_1705 td").closest("tr").length;
     if(totalRowCount>=1){
       $("#add_more_1705").show();
     }
    
}

function three_show(){
     $("#div_UK-FCL-00315_0").show();
      $("#div_UK-FCL-00133_0").show();
      $("#div_UK-FCL-00419_0").show();
      $("#div_UK-FCL-00104_0").show();
      $("#div_UK-FCL-00238_0").show();
      $("#div_UK-FCL-00405_0").show();
      $("#div_UK-FCL-00383_0").show();
      $("#div_UK-FCL-00384_0").show();
      $("#div_UK-FCL-00138_0").show();
      $("#details2").show();
      totalRowCount =  $("#tbl_1726 td").closest("tr").length;
     if(totalRowCount>=1){
       $("#add_more_1726").show();
     }
  
}

function four_show(){
     $("#div_UK-FCL-00420_0").show();
     $("#div_UK-FCL-00084_0").show();
     $("#div_UK-FCL-00421_0").show();
     $("#div_UK-FCL-00422_0").show();
     $("#div_UK-FCL-00207_0").show();
     $("#details3").show();
     totalRowCount =  $("#tbl_1732 td").closest("tr").length;
     if(totalRowCount>=1){
       $("#add_more_1732").show();
     }
   
}

function five_show(){
    $("#div_UK-FCL-00397_0").show();
    $("#div_UK-FCL-00316_0").show();
    $("#div_UK-FCL-00423_0").show();
    $("#div_UK-FCL-00424_0").show();
    $("#div_UK-FCL-00425_0").show();
    $("#div_UK-FCL-00144_0").show();
    $("#details4").show();
    totalRowCount =  $("#tbl_1738 td").closest("tr").length;
     if(totalRowCount>=1){
       $("#add_more_1738").show();
     }
 
}

function six_show(){
      $("#div_UK-FCL-00169_0").show();
      $("#div_UK-FCL-00353_0").show();
      $("#div_UK-FCL-00295_0").show();
      $("#div_UK-FCL-00129_0").show();
      $("#div_UK-FCL-00310_0").show();
      $("#div_UK-FCL-00242_0").show();
	    $("#details66").show();
}

function seven_show(){
    $("#div_UK-FCL-00107_0").show();
    $("#div_UK-FCL-00335_0").show();
    $("#div_UK-FCL-00406_0").show();
    $("#div_UK-FCL-00401_0").show();
    $("#div_UK-FCL-00320_0").show();
    $("#details5").show();
}

function eight_show(){
    $("#div_UK-FCL-00426_0").show();
    $("#div_UK-FCL-00427_0").show();
    $("#div_UK-FCL-00428_0").show();
    $("#details6").show();
}

function nine_show(){
    $("#div_UK-FCL-00429_0").show();
}

//hide functions
function one_hide(){
    $("#div_UK-FCL-00418_0").hide();
}

function two_hide(){
    $("#div_UK-FCL-00301_0").hide();
    $("#div_UK-FCL-00105_0").hide();
    $("#div_UK-FCL-00106_0").hide();
    $("#div_UK-FCL-00093_0").hide();
    $("#div_UK-FCL-00309_0").hide();
    $("#div_UK-FCL-00404_0").hide();
    $("#div_UK-FCL-00094_0").hide();
    $("#div_UK-FCL-00096_0").hide();
    $("#div_UK-FCL-00087_0").hide();
    $("#details1").hide();
    $("#add_more_1705").hide();
    $("#tbl_1705 > tbody").html("");
   
}

function three_hide(){
     $("#div_UK-FCL-00315_0").hide();
      $("#div_UK-FCL-00133_0").hide();
      $("#div_UK-FCL-00419_0").hide();
      $("#div_UK-FCL-00104_0").hide();
      $("#div_UK-FCL-00238_0").hide();
      $("#div_UK-FCL-00405_0").hide();
      $("#div_UK-FCL-00383_0").hide();
      $("#div_UK-FCL-00384_0").hide();
      $("#div_UK-FCL-00138_0").hide();
      $("#details2").hide();
      $("#add_more_1726").hide();
      $("#tbl_1726 > tbody").html("");
}

function four_hide(){
     $("#div_UK-FCL-00420_0").hide();
     $("#div_UK-FCL-00084_0").hide();
     $("#div_UK-FCL-00421_0").hide();
     $("#div_UK-FCL-00422_0").hide();
     $("#div_UK-FCL-00207_0").hide();
     $("#details3").hide();
     $("#add_more_1732").hide();
     $("#tbl_1732 > tbody").html("");
}

function five_hide(){
     $("#div_UK-FCL-00397_0").hide();
    $("#div_UK-FCL-00316_0").hide();
    $("#div_UK-FCL-00423_0").hide();
    $("#div_UK-FCL-00424_0").hide();
    $("#div_UK-FCL-00425_0").hide();
    $("#div_UK-FCL-00144_0").hide();
    $("#details4").hide();
    $("#add_more_1738").hide();
    $("#tbl_1738 > tbody").html("");
    
}

function six_hide(){
      $("#div_UK-FCL-00169_0").hide();
      $("#div_UK-FCL-00353_0").hide();
      $("#div_UK-FCL-00295_0").hide();
      $("#div_UK-FCL-00129_0").hide();
      $("#div_UK-FCL-00310_0").hide();
      $("#div_UK-FCL-00242_0").hide();
    $("#details66").hide();
}

function seven_hide(){
    $("#div_UK-FCL-00107_0").hide();
    $("#div_UK-FCL-00335_0").hide();
    $("#div_UK-FCL-00406_0").hide();
    $("#div_UK-FCL-00401_0").hide();
    $("#div_UK-FCL-00320_0").hide();
    $("#details5").hide();
}

function eight_hide(){
    $("#div_UK-FCL-00426_0").hide();
    $("#div_UK-FCL-00427_0").hide();
    $("#div_UK-FCL-00428_0").hide();
    $("#details6").hide();
}
function nine_hide(){
    $("#div_UK-FCL-00429_0").hide();
}
//hide function end


function addmoreaction(id,service_id,div_id){
     
  //Aamir
  
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
         $(".form-control-feedback-addmore").remove();
          if(div_id==1705){

            if(formchk_id=='UK-FCL-00105_0'){
          var mnt = $("#UK-FCL-00105_0").val();
         // alert(mnt)
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
              if(formchk_id=='UK-FCL-00301_0' || formchk_id=='UK-FCL-00106_0' || formchk_id=='UK-FCL-00093_0' || formchk_id == 'UK-FCL-00404_0' || formchk_id == 'UK-FCL-00096_0' || checkfield==false){
                  var labelData = $("#label_" + formchk_id).text();
                labelData=labelData.replace('('+formchk_id+')',"");
                //alert(formchk_id);
               if(formchk_id=="UK-FCL-00105_0"){
                      $("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>Please enter the required information or select the check box</div>");
                    }else{ 
                       $("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>This field is required</div>");
                    }          
                err = err + 1;
                return false;
                }else{
                  $(".form-control-feedback-addmore").remove();
                  /*if(formchk_id=='UK-FCL-00133_0' || formchk_id=='UK-FCL-00137_0'){
                    if(vall==""){
                      vall = 'NA';
                    }
                  }*/
                  td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
                        fieldsIDArr.push(formchk_id);   
                } 
          }

          if(div_id==1726){

            if(formchk_id=='UK-FCL-00133_0'){
          var mnt = $("#UK-FCL-00133_0").val();
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
              if(formchk_id=='UK-FCL-00315_0' || formchk_id=='UK-FCL-00419_0' || formchk_id=='UK-FCL-00104_0' || formchk_id == 'UK-FCL-00405_0'  ||checkfield == false || formchk_id=='UK-FCL-00384_0'){
                  var labelData = $("#label_" + formchk_id).text();
                labelData=labelData.replace('('+formchk_id+')',"");
                //alert(formchk_id);
                 if(formchk_id=="UK-FCL-00133_0"){
                      $("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>Please enter the required information or select the check box</div>");
                    }else{ 
                       $("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>This field is required</div>");
                    }           
                err = err + 1;
                return false;
                }else{
                 $(".form-control-feedback-addmore").remove();
                  /*if(formchk_id=='UK-FCL-00133_0' || formchk_id=='UK-FCL-00137_0'){
                    if(vall==""){
                      vall = 'NA';
                    }
                  }*/
                  td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
                        fieldsIDArr.push(formchk_id);   
                } 
          }

        if(div_id==1738){

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
              if(formchk_id=='UK-FCL-00397_0' || formchk_id=='UK-FCL-00423_0' || formchk_id=='UK-FCL-00424_0' || formchk_id == 'UK-FCL-00425_0'  || checkfield == false){
                  var labelData = $("#label_" + formchk_id).text();
                labelData=labelData.replace('('+formchk_id+')',"");
                //alert(formchk_id);
                if(formchk_id=="UK-FCL-00316_0"){
                    $("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>Please enter the required information or select the check box</div>");
                  }else{ 
                  
                    $("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>This field is required</div>");


                  }  
                err = err + 1;
                return false;
                }else{
                  $(".form-control-feedback-addmore").remove();
                  /*if(formchk_id=='UK-FCL-00133_0' || formchk_id=='UK-FCL-00137_0'){
                    if(vall==""){
                      vall = 'NA';
                    }
                  }*/
                  td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
                        fieldsIDArr.push(formchk_id);   
                } 
          } 
          if(div_id==1732){
              if(formchk_id=='UK-FCL-00420_0' || formchk_id=='UK-FCL-00084_0' || formchk_id=='UK-FCL-00421_0' ||formchk_id=='UK-FCL-00422_0'){
                  var labelData = $("#label_" + formchk_id).text();
                labelData=labelData.replace('('+formchk_id+')',"");
                //alert(formchk_id);
               $("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>This field is required</div>");            
                err = err + 1;
                return false;
                }else{
                   $(".form-control-feedback-addmore").remove();
                  td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
                        fieldsIDArr.push(formchk_id);   
                } 
          } 
          
        }
        else {
          $(".errorDetail").remove();
           $(".form-control-feedback-addmore").remove();
          //console.log(typeVal);
          td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
          fieldsIDArr.push(formchk_id);           
        }

      }); 
      if (err == 0) {
      if(confirm('Before adding, please check whether the details entered is correct.')) 
          {
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
       


        }
    
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

<?php if(isset($_SESSION['uid'])){ ?>
   <script type="text/javascript">
     $(document).ready(function(){

           totalRowCount1 =  $(".tbl_1705 td").closest("tr").length;         
           if(totalRowCount1>=1){
            $("<strong>Change of persons with names in full of new individuals:</strong><br>").insertBefore(".tbl_1705");            
           }
        totalRowCount2 =  $(".tbl_1726 td").closest("tr").length;
           if(totalRowCount2>=1){
               $("<strong>Change of the name of persons who own the firm or business:</strong><br>").insertBefore(".tbl_1726");
           }
       totalRowCount3 =  $(".tbl_1732 td").closest("tr").length;
           if(totalRowCount3>=1){
               $("<strong>Change in Partner details where partner is a company:</strong><br>").insertBefore(".tbl_1732");
           }
       totalRowCount4 =  $(".tbl_1738 td").closest("tr").length;
           if(totalRowCount4>=1){
              $("<strong>Change in Nationality of persons who own firm or business:</strong><br>").insertBefore(".tbl_1738");
           }
      }); 
   </script>   
<?php } ?>