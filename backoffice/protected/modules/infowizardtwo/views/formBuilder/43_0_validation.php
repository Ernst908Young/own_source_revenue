<style type="text/css">

input#UK-FCL-00488_0 {
    width: 100%;
    margin-left: 2px;
}
input#UK-FCL-00489_0 {
    width: 100%;
    margin-left: 2px;
}


</style>

<script type="text/javascript">



$(document).ready(function(){



	$("a.back_btn").css('visibility', 'hidden');




 $("#UK-FCL-00132_0,#UK-FCL-00105_0,#UK-FCL-00106_0,#UK-FCL-00093_0,#UK-FCL-00238_0,#UK-FCL-00337_0,#UK-FCL-00094_0,#UK-FCL-00310_0,#UK-FCL-00096_0, #UK-FCL-00624_0, #UK-FCL-00625_0, #UK-FCL-00627_0,#UK-FCL-00637_0,#UK-FCL-00430_0").prop('readonly',true); 

$("#UK-FCL-00096_0").val("Barbados");
	

 
	$("#UK-FCL-00415_0").on("blur",function(){
        var reg_no = $(this).val();

    if(reg_no){
            $.ajax({
                type: "POST",
                dataType:'json',
                url: "/backoffice/infowizardtwo/subFormNoticeofCessationofBusinessForm4/getCompanyNameByregno/reg_no/" + reg_no,
                beforeSend:function(){
                    $("#UK-FCL-00415_0-error").text("Please wait...");                      
                },
                success: function(result) { 
					console.log(result);
                    if(result.status==true){                            
                            $("#UK-FCL-00415_0-error").text("");                 
                            $("#UK-FCL-00624_0").val(result.cname);
                           
							$("#UK-FCL-00132_0").val(result.regfirstname);
                           
							$("#UK-FCL-00105_0").val(result.regmiddlename);
                           
							$("#UK-FCL-00106_0").val(result.reglastname);
                           
							$("#UK-FCL-00093_0").val(result.regaddress1);
                           
							$("#UK-FCL-00238_0").val(result.regaddress2);
                           
							$("#UK-FCL-00337_0").val(result.regparish);
                           
							$("#UK-FCL-00094_0").val(result.regpostalcode);
                           
							$("#UK-FCL-00310_0").val(result.regcity);
                           
							$("#UK-FCL-00096_0").val(result.regcountry);
                            
							var regdate = moment(result.regdate).format('DD/MM/YYYY');  
							$("#UK-FCL-00625_0").val(regdate); 

							var today = new Date();
							var dd = String(today.getDate()).padStart(2, '0');
							var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
							var yyyy = today.getFullYear();
							today = dd + '/' + mm + '/' + yyyy;
							
							$("#UK-FCL-00627_0").val(today);
							$("#UK-FCL-00637_0").val(today);
							
							if(result.regtotheregister == 1 || result.regtotheregister == 0){
								$('#UK-FCL-00430_0').val('I');
								$('#UK-FCL-00430_0').attr("readonly", true); 
								
							}
							else{
								$('#UK-FCL-00430_0').val('We').trigger('change');
								// $("#UK-FCL-00430_0").val("We").change();
								// $('#UK-FCL-00430_0').attr("disabled", true); 
								
							}
							                                    
                    }else{
                        $("#UK-FCL-00415_0-error").text(result.msg);
                        $("#UK-FCL-00624_0, #UK-FCL-00132_0, #UK-FCL-00105_0, #UK-FCL-00106_0, #UK-FCL-00093_0, #UK-FCL-00238_0, #UK-FCL-00337_0,#UK-FCL-00094_0, #UK-FCL-00310_0, #UK-FCL-00096_0, #UK-FCL-00491_0").val("");                       
                                            
                    }
                   // console.log(result);
                }
            });
    }        
});








 



//end of sahil code

	


 // 1 Change of name of firm
 

var ff416 = $("#UK-FCL-00416_0").val();
if(ff416){
  hideonchange();
  manupulatefields(ff416); 
}



$("#UK-FCL-00416_0").on("change",function(){
  
  var selectedValues = $(this).val();
   hideonchange();
manupulatefields(selectedValues);

});







 

 





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

 





/* var today = new Date();
$('.datepicker').datepicker({
    format: 'dd-mm-yyyy',
    autoclose:true,
    endDate: "today",
    maxDate: today
}).on('changeDate', function (ev) {
        $(this).datepicker('hide');
    });
 */

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















  $("#UK-FCL-00404_0").on("change",function(){
  if($(this).val()){
      $.ajax({
              type: "POST",
              dataType:'html',
              url: "/backoffice/infowizard/subFormNoticeofCessationofBusinessForm4/getpostalcode/p_id/" + $(this).val(),
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
              url: "/backoffice/infowizard/subFormNoticeofCessationofBusinessForm4/getpostalcode/p_id/" + $(this).val(),
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


});

function hideonchange(){
  one_hide();
  two_hide();
  three_hide();
  four_hide();
  five_hide();
  six_hide();
  seven_hide();
  eight_hide();
  nine_hide();
}
function manupulatefields(ff416){
     var myarr = ff416.toString().split(",");
   var t416 = '';
 for(var i = 0; i < myarr.length; i++){
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
    }else if(selectedValues == 'Change of registered office'){
     seven_show();
    }else if(selectedValues == 'Change of nature of business'){
       eight_show();  
    }else if(selectedValues == 'Any other change'){    
     nine_show();
    }

  }
}
  







</script>

<?php 
if(isset($_SESSION['RESPONSE']["user_id"])){
  if(isset($_GET['subID'])){
     $subId = $_GET['subID'];
     $submissiondaterecord =  Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_application_log where app_Sub_id = $subId and action_status='P' order BY id DESC")->queryRow();
     if($submissiondaterecord){
      $date = NULL;
     }else{
      $date = date('d/m/Y');
     }
  }else{
    $date = date('d/m/Y');
  }
  
 
  if($date){ ?>
       <script type="text/javascript">
               $(document).ready(function(){
                $("#UK-FCL-00627_0").val("<?= $date ?>");                    
                   
                }); 
      </script>  
  <?php  }
}

 ?>