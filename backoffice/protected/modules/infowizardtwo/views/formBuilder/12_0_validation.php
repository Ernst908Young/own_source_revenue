<style type="text/css">
  div#details1 {
    display: none;
} 

div#details2 {
    display: none;
}   
</style>

<script type="text/javascript">
 
 $(document).ready(function(){
  $("a.back_btn").css('visibility', 'hidden');
	$('#UK-FCL-00132_0,#UK-FCL-00105_0,#UK-FCL-00324_0,#UK-FCL-00093_0,#UK-FCL-00132_0,#UK-FCL-00309_0,#UK-FCL-00310_0,#UK-FCL-00094_0,#UK-FCL-00097_0,#UK-FCL-00133_0,#UK-FCL-00398_0,#UK-FCL-00107_0,#UK-FCL-00335_0,#UK-FCL-00399_0,#UK-FCL-00401_0,#UK-FCL-00315_0,#UK-FCL-00316_0,#UK-FCL-00317_0,#UK-FCL-00104_0,#UK-FCL-00238_0,#UK-FCL-00382_0,#UK-FCL-00383_0,#UK-FCL-00397_0,#UK-FCL-00133_0,#UK-FCL-00398_0,#UK-FCL-00107_0,#UK-FCL-00335_0,#UK-FCL-00399_0,#UK-FCL-00401_0').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });

  $("#UK-FCL-00193_0").prop('readonly',true);
  $("#UK-FCL-00395_0").prop('readonly',true);


  //select first option
  /*$("#title_UK-FCL-00132_0").hide();
  $("#hr_UK-FCL-00132_0").hide();
  $("#div_UK-FCL-00132_0").hide();
  $("#div_UK-FCL-00105_0").hide();
  $("#div_UK-FCL-00324_0").hide();
  $("#div_UK-FCL-00093_0").hide();
  $("#div_UK-FCL-00309_0").hide();
  $("#div_UK-FCL-00310_0").hide();
  $("#div_UK-FCL-00129_0").hide();
  $("#div_UK-FCL-00094_0").hide();
  $("#div_UK-FCL-00096_0").hide();
  $("#div_UK-FCL-00304_0").hide();
  $("#div_UK-FCL-00087_0").hide();*/


  //select second option

  /*$("#title_UK-FCL-00315_0").hide();
  $("#hr_UK-FCL-00315_0").hide();
  $("#div_UK-FCL-00315_0").hide();
  $("#div_UK-FCL-00316_0").hide();
  $("#div_UK-FCL-00317_0").hide();
  $("#div_UK-FCL-00104_0").hide();
  $("#div_UK-FCL-00238_0").hide();
  $("#div_UK-FCL-00382_0").hide();
  $("#div_UK-FCL-00471_0").hide();
  $("#div_UK-FCL-00383_0").hide();
  $("#div_UK-FCL-00320_0").hide();
  $("#div_UK-FCL-00138_0").hide();*/
  
  
  
  
  $("<div class='row'><div class='col-lg-12' id='details1'><strong>Notice is given that the following person(s) was/ were appointed as Manager(s):</strong></div></div><br>").insertAfter("#hr_UK-FCL-00132_0");


  $("<div class='row'><div class='col-lg-12' id='details2'><strong>Notice is given that the following person(s) ceased to hold office as Manager(s):</strong></div></div><br>").insertAfter("#hr_UK-FCL-00315_0");


  $("<div class='row'><div class='col-lg-12' id='details3'><strong>The Managers of the company as of this date are:</strong></div></div><br>").insertAfter("#hr_UK-FCL-00397_0");


  // APPOINTMENT DETAILS

   $("#div_UK-FCL-00105_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox' name='middlenamecheckbox'> I do not have a middle name or middle initial</div>");
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



    // CESSATION DETAILS

    $("#div_UK-FCL-00316_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox_2' name='middlenamecheckbox_2' class='group1'> I do not have a middle name or middle initial</div>");
    $("#UK-FCL-00316_0").blur(function(){
        if($(this).val()){
            $("input[name=middlenamecheckbox_2]").prop('checked', false); 
        }
    });

    $("input[name=middlenamecheckbox_2]").change(function(){
        if($(this).val()){
            $("#UK-FCL-00316_0").val("");
        }
    });


     // PRESENT MANAGERS

    $("#div_UK-FCL-00133_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox_3' name='middlenamecheckbox_3' class='group1'>  I do not have a middle name or middle initial </div>");
    $("#UK-FCL-00133_0").blur(function(){
        if($(this).val()){
            $("input[name=middlenamecheckbox_3]").prop('checked', false); 
        }
    });

    $("input[name=middlenamecheckbox_3]").change(function(){
        if($(this).val()){
            $("#UK-FCL-00133_0").val("");
        }
    });

    
    $('#middlenamecheckbox').change(function(){

        if($("#middlenamecheckbox").prop('checked') == true){

         $("#UK-FCL-00105_0").prop('readonly',true);

        }else{

          $("#UK-FCL-00105_0").prop('readonly',false);

        }

   });


    $('#middlenamecheckbox_2').change(function(){

        if($("#middlenamecheckbox_2").prop('checked') == true){

         $("#UK-FCL-00316_0").prop('readonly',true);

        }else{

          $("#UK-FCL-00316_0").prop('readonly',false);

        }

   });


    $('#middlenamecheckbox_3').change(function(){

        if($("#middlenamecheckbox_3").prop('checked') == true){

         $("#UK-FCL-00133_0").prop('readonly',true);

        }else{

          $("#UK-FCL-00133_0").prop('readonly',false);

        }

   });

    var ff394 = $("#UK-FCL-00394_0").val();

    if(ff394){
      fieldsmanupulate(ff394);
    }else{
      hideallform();
    }


    $("#UK-FCL-00394_0").on("change",function(){
      var ff394 = $(this).val();
      if(ff394){
       fieldsmanupulate(ff394);
      }else{
        hideallform();
        }
     });


    /* var today = new Date();
      
    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        autoclose:true,
        endDate: "today",
        maxDate: today
    }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });*/


   $("#UK-FCL-00290_0").on("blur",function(){
        var reg_no = $(this).val();
    
    if(reg_no){
            $.ajax({
                type: "POST",
                dataType:'json',
                url: "/backoffice/infowizardtwo/subFormNoticeofChangeofManagerForm6/getCompanyNameByregno/reg_no/" + reg_no,
                beforeSend:function(){
                    $("#UK-FCL-00290_0-error").text("Please wait...");                      
                },
                success: function(result) {                     
                    if(result.status==true){                            
                            $("#UK-FCL-00290_0-error").text("");                 
                            $("#UK-FCL-00193_0").val(result.cname);  

							$("#UK-FCL-00193_0").prop('readonly',true);
                                                                    
                    }else{
                        $("#UK-FCL-00290_0-error").text(result.msg);
                        
						// $("#UK-FCL-00290_0-error").text("");
						// $("#UK-FCL-00193_0").prop('readonly',false);
						 $("#UK-FCL-00193_0").val("");       
						
						
                    }
                   console.log(result);
                }
            });
    }        
});


$("#UK-FCL-00096_0").on('change', function() {
    var countryCode = $(this).val();  
    if(countryCode==829){
        $("#UK-FCL-00310_0").val('');
        $("#UK-FCL-00310_0").attr('readonly',true);
    }else{
        $("#UK-FCL-00310_0").attr('readonly',false);
    }      
    $("#UK-FCL-00129_0").select2("val","");
    $.ajax({
        type: "POST",
        url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
        success: function(result) {
            //alert(result);
            $("#UK-FCL-00129_0").html(result);
            <?php if (isset($_GET['subID']) || (isset($_GET['app_Sub_id']) && !empty($_GET['app_Sub_id']))) { 
			if(!is_array(@$fieldValues['UK-FCL-00129_0'])){
			?>
            //alert("<?php echo @$fieldValues['UK-FCL-00129_0']; ?>");
            $("#UK-FCL-00129_0").val("<?php echo @$fieldValues['UK-FCL-00129_0']; ?>");
            $("#UK-FCL-00129_0").select2("val", "<?php echo @$fieldValues['UK-FCL-00129_0']; ?>");
            $("#UK-FCL-00129_0").change();
            <?php }} ?>
        }
    });
});


$("#UK-FCL-00320_0").on('change', function() {
    var countryCode = $(this).val();   
    if(countryCode==829){
        $("#UK-FCL-00382_0").val('');
        $("#UK-FCL-00382_0").attr('readonly',true);
    }else{
        $("#UK-FCL-00382_0").attr('readonly',false);
    }     
    $("#UK-FCL-00471_0").select2("val","");
    $.ajax({
        type: "POST",
        url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
        success: function(result) {
            //alert(result);
            $("#UK-FCL-00471_0").html(result);
            <?php if (isset($_GET['subID']) || (isset($_GET['app_Sub_id']) && !empty($_GET['app_Sub_id']))) {
	if(!is_array(@$fieldValues['UK-FCL-00471_0'])){				?>
            //alert("<?php echo @$fieldValues['UK-FCL-00471_0']; ?>");
            $("#UK-FCL-00471_0").val("<?php echo @$fieldValues['UK-FCL-00471_0']; ?>");
            $("#UK-FCL-00471_0").select2("val", "<?php echo @$fieldValues['UK-FCL-00471_0']; ?>");
            $("#UK-FCL-00471_0").change();
            <?php } }?>
        }
    });
});


$("#UK-FCL-00402_0").on('change', function() {
    var countryCode = $(this).val();      
    if(countryCode==829){
        $("#UK-FCL-00399_0").val('');
        $("#UK-FCL-00399_0").attr('readonly',true);
    }else{
        $("#UK-FCL-00399_0").attr('readonly',false);
    }  
    $("#UK-FCL-00400_0").select2("val","");
    $.ajax({
        type: "POST",
        url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
        success: function(result) {
            //alert(result);
            $("#UK-FCL-00400_0").html(result);
            <?php if (isset($_GET['subID']) || (isset($_GET['app_Sub_id']) && !empty($_GET['app_Sub_id']))) {
if(!is_array(@$fieldValues['UK-FCL-00400_0'])){				?>
            //alert("<?php echo @$fieldValues['UK-FCL-00400_0']; ?>");
            $("#UK-FCL-00400_0").val("<?php echo @$fieldValues['UK-FCL-00400_0']; ?>");
            $("#UK-FCL-00400_0").select2("val", "<?php echo @$fieldValues['UK-FCL-00400_0']; ?>");
            $("#UK-FCL-00400_0").change();
            <?php } 
			}?>
        }
    });
});                        


 });

function hideallform(){
              $("#title_UK-FCL-00315_0").hide();
              $("#hr_UK-FCL-00315_0").hide();
              $("#div_UK-FCL-00315_0").hide();
              $("#div_UK-FCL-00316_0").hide();
              $("#div_UK-FCL-00317_0").hide();
              $("#div_UK-FCL-00104_0").hide();
              $("#div_UK-FCL-00238_0").hide();
              $("#div_UK-FCL-00382_0").hide();
              $("#div_UK-FCL-00471_0").hide();
              $("#div_UK-FCL-00383_0").hide();
              $("#div_UK-FCL-00320_0").hide();
              $("#div_UK-FCL-00138_0").hide();
              $("#add_more_1994").hide();
              $("#tbl_1994 > tbody").html("");

              $("#title_UK-FCL-00132_0").hide();
              $("#hr_UK-FCL-00132_0").hide();
              $("#div_UK-FCL-00132_0").hide();
              $("#div_UK-FCL-00105_0").hide();
              $("#div_UK-FCL-00324_0").hide();
              $("#div_UK-FCL-00093_0").hide();
              $("#div_UK-FCL-00309_0").hide();
              $("#div_UK-FCL-00310_0").hide();
              $("#div_UK-FCL-00129_0").hide();
              $("#div_UK-FCL-00094_0").hide();
              $("#div_UK-FCL-00096_0").hide();
              $("#div_UK-FCL-00304_0").hide();
              $("#div_UK-FCL-00087_0").hide();
              $("#add_more_1358").hide();
              $("#tbl_1358 > tbody").html("");
             

  $("#title_UK-FCL-00397_0,#hr_UK-FCL-00397_0,#details3,#div_UK-FCL-00397_0,#div_UK-FCL-00133_0,#div_UK-FCL-00398_0,#div_UK-FCL-00107_0,#div_UK-FCL-00335_0,#div_UK-FCL-00402_0,#div_UK-FCL-00400_0,#div_UK-FCL-00399_0,#div_UK-FCL-00401_0,#div_UK-FCL-00137_0,#div_UK-FCL-00207_0,#div_UK-FCL-00451_0,#add_more_1370").hide();
  $("#tbl_1370 > tbody").html("");

   $("div#details1").css('display','none');
   $("div#details2").css('display','none');

  //$("#title_UK-FCL-00087_0").hide();
}


function fieldsmanupulate(val394){
   if(val394=='Notice of Appointment of Manager'){

          $("div#details1").css('display','block');
          $("div#details2").css('display','none');

           
          $("#title_UK-FCL-00132_0").show();
          $("#hr_UK-FCL-00132_0").show();
          $("#div_UK-FCL-00132_0").show();
          $("#div_UK-FCL-00105_0").show();
          $("#div_UK-FCL-00324_0").show();
          $("#div_UK-FCL-00093_0").show();
          $("#div_UK-FCL-00309_0").show();
          $("#div_UK-FCL-00310_0").show();
          $("#div_UK-FCL-00129_0").show();
          $("#div_UK-FCL-00094_0").show();
          $("#div_UK-FCL-00096_0").show();
          $("#div_UK-FCL-00304_0").show();
          $("#div_UK-FCL-00087_0").show();
         // $("#add_more_1994").show();

         totalRowCount2 =  $("#tbl_1994 td").closest("tr").length;
       if(totalRowCount2>=1){
         $("#add_more_1994").show();
       }


             $("#title_UK-FCL-00315_0").hide();
              $("#hr_UK-FCL-00315_0").hide();
              $("#div_UK-FCL-00315_0").hide();
              $("#div_UK-FCL-00316_0").hide();
              $("#div_UK-FCL-00317_0").hide();
              $("#div_UK-FCL-00104_0").hide();
              $("#div_UK-FCL-00238_0").hide();
              $("#div_UK-FCL-00382_0").hide();
              $("#div_UK-FCL-00471_0").hide();
              $("#div_UK-FCL-00383_0").hide();
              $("#div_UK-FCL-00320_0").hide();
              $("#div_UK-FCL-00138_0").hide();
              $("#add_more_1358").hide();
              $("#tbl_1358 > tbody").html("");
            

              $("#title_UK-FCL-00138_0").hide();

              $("#title_UK-FCL-00397_0,#hr_UK-FCL-00397_0,#details3,#div_UK-FCL-00397_0,#div_UK-FCL-00133_0,#div_UK-FCL-00398_0,#div_UK-FCL-00107_0,#div_UK-FCL-00335_0,#div_UK-FCL-00402_0,#div_UK-FCL-00400_0,#div_UK-FCL-00399_0,#div_UK-FCL-00401_0,#div_UK-FCL-00137_0,#div_UK-FCL-00207_0,#div_UK-FCL-00451_0").show();

               totalRowCount2 =  $("#tbl_1370 td").closest("tr").length;
               if(totalRowCount2>=1){
                 $("#add_more_1370").show();
               }

          }else if(val394=='Notice of Cessation of Manager(s)'){

            $("div#details2").css('display','block');
            $("div#details1").css('display','none');


             $("#title_UK-FCL-00315_0").show();
              $("#hr_UK-FCL-00315_0").show();
              $("#div_UK-FCL-00315_0").show();
              $("#div_UK-FCL-00316_0").show();
              $("#div_UK-FCL-00317_0").show();
              $("#div_UK-FCL-00104_0").show();
              $("#div_UK-FCL-00238_0").show();
              $("#div_UK-FCL-00382_0").show();
              $("#div_UK-FCL-00471_0").show();
              $("#div_UK-FCL-00383_0").show();
              $("#div_UK-FCL-00320_0").show();
              $("#div_UK-FCL-00138_0").show();

              totalRowCount2 =  $("#tbl_1358 td").closest("tr").length;
               if(totalRowCount2>=1){
                 $("#add_more_1358").show();
               }
             // $("#add_more_1358").show();

              $("#title_UK-FCL-00132_0").hide();
              $("#hr_UK-FCL-00132_0").hide();
              $("#div_UK-FCL-00132_0").hide();
              $("#div_UK-FCL-00105_0").hide();
              $("#div_UK-FCL-00324_0").hide();
              $("#div_UK-FCL-00093_0").hide();
              $("#div_UK-FCL-00309_0").hide();
              $("#div_UK-FCL-00310_0").hide();
              $("#div_UK-FCL-00129_0").hide();
              $("#div_UK-FCL-00094_0").hide();
              $("#div_UK-FCL-00096_0").hide();
              $("#div_UK-FCL-00304_0").hide();
              $("#div_UK-FCL-00087_0").hide();
              $("#add_more_1994").hide();
              $("#tbl_1994 > tbody").html("");

              $("#title_UK-FCL-00087_0").hide();

              $("#title_UK-FCL-00397_0,#hr_UK-FCL-00397_0,#details3,#div_UK-FCL-00397_0,#div_UK-FCL-00133_0,#div_UK-FCL-00398_0,#div_UK-FCL-00107_0,#div_UK-FCL-00335_0,#div_UK-FCL-00402_0,#div_UK-FCL-00400_0,#div_UK-FCL-00399_0,#div_UK-FCL-00401_0,#div_UK-FCL-00137_0,#div_UK-FCL-00207_0,#div_UK-FCL-00451_0").show();

              totalRowCount2 =  $("#tbl_1370 td").closest("tr").length;
               if(totalRowCount2>=1){
                 $("#add_more_1370").show();
               }

          }else if(val394=='Notice of Appointment and Cessation of Manager(s)'){

            $("div#details1").css('display','block');
            $("div#details2").css('display','block');

             $("#title_UK-FCL-00132_0").show();
              $("#hr_UK-FCL-00132_0").show();
              $("#div_UK-FCL-00132_0").show();
              $("#div_UK-FCL-00105_0").show();
              $("#div_UK-FCL-00324_0").show();
              $("#div_UK-FCL-00093_0").show();
              $("#div_UK-FCL-00309_0").show();
              $("#div_UK-FCL-00310_0").show();
              $("#div_UK-FCL-00129_0").show();
              $("#div_UK-FCL-00094_0").show();
              $("#div_UK-FCL-00096_0").show();
              $("#div_UK-FCL-00304_0").show();
              $("#div_UK-FCL-00087_0").show();
             // $("#add_more_1994").show();


             $("#title_UK-FCL-00315_0").show();
              $("#hr_UK-FCL-00315_0").show();
              $("#div_UK-FCL-00315_0").show();
              $("#div_UK-FCL-00316_0").show();
              $("#div_UK-FCL-00317_0").show();
              $("#div_UK-FCL-00104_0").show();
              $("#div_UK-FCL-00238_0").show();
              $("#div_UK-FCL-00382_0").show();
              $("#div_UK-FCL-00471_0").show();
              $("#div_UK-FCL-00383_0").show();
              $("#div_UK-FCL-00320_0").show();
              $("#div_UK-FCL-00138_0").show();
             // $("#add_more_1358").show();

             $("#title_UK-FCL-00397_0,#hr_UK-FCL-00397_0,#details3,#div_UK-FCL-00397_0,#div_UK-FCL-00133_0,#div_UK-FCL-00398_0,#div_UK-FCL-00107_0,#div_UK-FCL-00335_0,#div_UK-FCL-00402_0,#div_UK-FCL-00400_0,#div_UK-FCL-00399_0,#div_UK-FCL-00401_0,#div_UK-FCL-00137_0,#div_UK-FCL-00207_0,#div_UK-FCL-00451_0").show();

             totalRowCount1 =  $("#tbl_1994 td").closest("tr").length;
               if(totalRowCount1>=1){
                 $("#add_more_1994").show();
               }
               totalRowCount2 =  $("#tbl_1370 td").closest("tr").length;
               if(totalRowCount2>=1){
                 $("#add_more_1370").show();
               }
              totalRowCount3 =  $("#tbl_1358 td").closest("tr").length;
                 if(totalRowCount3>=1){
                   $("#add_more_1358").show();
                 }


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
                    $(".form-control-feedback-addmore").remove();
                    if(div_id==1994){

                        if(formchk_id=='UK-FCL-00105_0'){
                    var mnt = $("#UK-FCL-00105_0").val();
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
                    if(formchk_id=='UK-FCL-00132_0' || formchk_id=='UK-FCL-00324_0' || formchk_id=='UK-FCL-00093_0' || formchk_id=='UK-FCL-00096_0' || formchk_id == 'UK-FCL-00129_0' || formchk_id=='UK-FCL-00304_0'||  checkfield == false){
                            
                               var labelData = $("#label_" + formchk_id).text();
                                labelData=labelData.replace('('+formchk_id+')',"");
                     if(formchk_id=="UK-FCL-00105_0"){
                          $("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>Please enter the required information or select the check box</div>");
                      }else{ 
                      
                        $("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>This field is required</div>");
                      }
                                  
                      err = err + 1;
                      return false;
                                }else{
                                    $(".form-control-feedback-addmore").remove();
                                    td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
                                                fieldsIDArr.push(formchk_id);       
                                }   
                    }

                 if(div_id==1358){

                        if(formchk_id=='UK-FCL-00316_0'){
                    var mnt = $("#UK-FCL-00316_0").val();
                    if(mnt){
                        var checkfield = true;
                    }else{
                        var mncb = $('input[name=middlenamecheckbox_2]:checked').val(); 
                        if(mncb){
                            var checkfield = true;
                        }else{
                            var checkfield = false;
                        }
                    }
                }else{
                    var checkfield = true;
                }   
                            if(formchk_id=='UK-FCL-00315_0' || formchk_id=='UK-FCL-00317_0' || formchk_id=='UK-FCL-00104_0' || formchk_id=='UK-FCL-00320_0' || formchk_id == 'UK-FCL-00471_0' ||  checkfield == false){
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

                     if(div_id==1370){

                        if(formchk_id=='UK-FCL-00133_0'){
                    var mnt = $("#UK-FCL-00133_0").val();
                    if(mnt){
                        var checkfield = true;
                    }else{
                        var mncb = $('input[name=middlenamecheckbox_3]:checked').val(); 
                        if(mncb){
                            var checkfield = true;
                        }else{
                            var checkfield = false;
                        }
                    }
                }else{
                    var checkfield = true;
                }   
                            if(formchk_id=='UK-FCL-00397_0' || formchk_id=='UK-FCL-00398_0' || formchk_id=='UK-FCL-00107_0' || formchk_id=='UK-FCL-00402_0' || formchk_id == 'UK-FCL-00400_0' || formchk_id=='UK-FCL-00137_0'||  checkfield == false){
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

                $("input[name=middlenamecheckbox]").prop('checked', false); 
                $("input[name=middlenamecheckbox_2]").prop('checked', false); 
                $("input[name=middlenamecheckbox_3]").prop('checked', false); 
                $("#UK-FCL-00316_0, #UK-FCL-00105_0, #UK-FCL-00133_0").attr('readonly',false);
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
