<script type="text/javascript">
   $(document).ready(function(){

    $("#UK-FCL-00403_0").on("blur",function(){
        var reg_no = $(this).val(); 
        $.ajax({
            type: "POST",
            dataType:'json',
            url: "/backoffice/infowizardtwo/subFormArticlesofRevivalform21/getcompanyNameByregno/reg_no/" + reg_no,
            beforeSend:function(){
                $("#UK-FCL-00403_0-error").text("Please wait...");                      
            },
            success: function(result) {                     
                if(result.status==true){                            
                    $("#UK-FCL-00403_0-error").text("");                 
                    $("#UK-FCL-00539_0").val(result.cname);     
                    $("#UK-FCL-00131_0").val(result.noOfDirector);                                           
                }else{
                    $("#UK-FCL-00403_0-error").text(result.msg);                            
                    $("#UK-FCL-00539_0").val("");                       
                }
               console.log(result);
            }
        });
                 
    });


  function getcomapnyname(srn_no){
    if(srn_no!=""){
                $.ajax({
                    type: "POST",
                    dataType:'json',
                    url: "/backoffice/infowizardtwo/subFormArticlesofRevivalform21/getCompanyNameBySrnNo/srn_no/" + srn_no +"/subID/<?= isset($_GET['subID']) ? $_GET['subID'] : NULL ?>",
                    beforeSend:function(){
                        $("#UK-FCL-00645_0-error").text("Please wait...");                      
                    },
                    success: function(result) {                     
                        if(result.status==true){
                            if(result.app_status=='valid'){
                                $("#UK-FCL-00646_0").val(result.name);
                                $("#UK-FCL-00645_0-error").html("");
                                $("#UK-FCL-00646_0-error").html("");    
                            }else{
                                $("#UK-FCL-00645_0-error").text(result.msg);            
                                if ($("#UK-FCL-00646_0-error").length) {
                                    $("#UK-FCL-00646_0-error").text(errormessages.srn_msg001);
                                }else{
                                    $("#div_UK-FCL-00646_0").find('div').append('<div  style="color:red;" id="UK-FCL-00646_0-error">'+errormessages.srn_msg001+'<br>'+errormessages.srn_msg002+'</div>');
                                }    

                                $("#UK-FCL-00646_0").val("");  
                            }                                           
                        }else{
                            if(result.user){
                                $("#UK-FCL-00645_0-error").text(result.msg);
                                $("#UK-FCL-00646_0").val("");   
                                $("#UK-FCL-00646_0-error").text("");
                            }else{
                                alert(result.msg);
                            }                                               
                        }
                     //  console.log(result);
                    }
                });
        }   
}

 $("#UK-FCL-00646_0,#UK-FCL-00344_0,#UK-FCL-00131_0").attr('readonly',true);
 $("#UK-FCL-00132_0,#UK-FCL-00106_0,#UK-FCL-00093_0,#UK-FCL-00096_0,#UK-FCL-00129_0,#UK-FCL-00137_0,#UK-FCL-00480_0,#UK-FCL-00181_0").removeAttr('required');


 var f0493_0 = $('input[name=UK-FCL-00493_0]:checked').val();
if(f0493_0=='Yes'){
        $("#UK-FCL-00342_0").val($("#UK-FCL-00340_0").val());
        $("#UK-FCL-00343_0").val($("#UK-FCL-00341_0").val());

        $("#UK-FCL-00351_0").val(829).trigger("change");    
        $("#UK-FCL-00349_0").val($("#UK-FCL-00345_0").val()).trigger("change");

        $("#UK-FCL-00348_0").val($("#UK-FCL-00344_0").val());
        $("#UK-FCL-00350_0").val($("#UK-FCL-00346_0").val());  

        $("#UK-FCL-00342_0, #UK-FCL-00343_0, #UK-FCL-00348_0, #UK-FCL-00350_0").prop('readonly',true);

        $("#UK-FCL-00351_0, #UK-FCL-00349_0").prop('disabled',true);

        $("#div_UK-FCL-00348_0").append("<div id='getcontrystate'><input type='hidden' name='UK-FCL-00351_0' value='829'/><input type='hidden' name='UK-FCL-00349_0' value='"+$("#UK-FCL-00345_0").val()+"'/></div>");

}

$("input[name=UK-FCL-00493_0]").on("change",function(){ 
      if($(this).val()=='Yes'){
        $("#UK-FCL-00342_0").val($("#UK-FCL-00340_0").val());
        $("#UK-FCL-00343_0").val($("#UK-FCL-00341_0").val());

        $("#UK-FCL-00351_0").val(829).trigger("change");        

        $("#UK-FCL-00348_0").val($("#UK-FCL-00344_0").val());
        $("#UK-FCL-00350_0").val($("#UK-FCL-00346_0").val());  
      
        $("#UK-FCL-00342_0, #UK-FCL-00343_0, #UK-FCL-00348_0, #UK-FCL-00350_0").prop('readonly',true);

        $("#UK-FCL-00351_0, #UK-FCL-00349_0").prop('disabled',true);

        $("#div_UK-FCL-00348_0").append("<div id='getcontrystate'><input type='hidden' name='UK-FCL-00351_0' value='829'/><input type='hidden' name='UK-FCL-00349_0' value='"+$("#UK-FCL-00345_0").val()+"'/></div>");

      }else{

        $("#getcontrystate").html("");
        $("#UK-FCL-00351_0, #UK-FCL-00349_0").val("").trigger("change");
        $("#UK-FCL-00342_0, #UK-FCL-00343_0, #UK-FCL-00348_0, #UK-FCL-00350_0").val("");

        $("#UK-FCL-00342_0, #UK-FCL-00343_0, #UK-FCL-00348_0, #UK-FCL-00350_0").prop('readonly',false);
        $("#UK-FCL-00351_0, #UK-FCL-00349_0").prop('disabled',false);
      }
});

$("#UK-FCL-00351_0").on('change', function() {
    
        var countryCode = $(this).val();    
         if(countryCode==829){
                $("#UK-FCL-00348_0").val('');
                $("#UK-FCL-00348_0").attr('readonly',true);
            }else{
                $("#UK-FCL-00348_0").attr('readonly',false);
            }   
    if(countryCode){
        $.ajax({
            type: "POST",
            url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + countryCode,
            success: function(result) {
                //alert(result);
                $("#UK-FCL-00349_0").html(result);
            var ff00493_0 = $('input[name=UK-FCL-00493_0]:checked').val();
                if(ff00493_0=='Yes'){
                    $("#UK-FCL-00349_0").val($("#UK-FCL-00345_0").val()).trigger("change");
                }
                
            }
        });
    }else{
             $("#UK-FCL-00349_0").html("<option>Please select</option>");
        }
    });


$("#UK-FCL-00480_0").change(function(){
        if($("#UK-FCL-00480_0").val() == 'Yes'){

            //$("#UK-FCL-00490_0").attr('required','');
           
            $("#UK-FCL-00181_0").attr('readonly',false);

        }else{
            
           
             $("#UK-FCL-00181_0").attr('readonly',true);
        }
    });
   
$("<div class='col-md-12' id='form2regisaddtitle' style='margin-top:10px;'><strong>Address of Registered office:</strong></div>").insertBefore("#div_UK-FCL-00340_0");
   
   
   $("<div class='col-md-12' id='form2mailaddtitle' style='margin-top:10px;'><strong>Mailing Address:</strong></div>").insertBefore("#div_UK-FCL-00342_0");
      $("<div class='col-md-12' id='form2mailaddtitle' style='margin-top:10px;'><strong>The details of the directors of the company as of this date are:</strong></div>").insertBefore("#div_UK-FCL-00132_0");
   
  
   
     $("#div_UK-FCL-00105_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox00105_0' name='middlenamecheckbox00105_0'> I do not have a middle name or middle initial</div>");
   
      
   // form 33 srn match
	
	$("#UK-FCL-00645_0").on("blur",function(){
        var srn_no = $(this).val();
        getcomapnyname(srn_no);
             
    });
	$("#UK-FCL-00539_0, #UK-FCL-00347_0, #UK-FCL-00530_0, #UK-FCL-00395_0, #UK-FCL-00357_0").attr('readonly',true);
   
    $("#div_UK-FCL-00003_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox' name='middlenamecheckbox'> I do not have a middle name or middle initial</div>");
   
    $("#UK-FCL-00003_0").blur(function(){
        if($(this).val()){
            $("input[name=middlenamecheckbox]").prop('checked', false); 
        }
    });
   
    $("#UK-FCL-00105_0").blur(function(){
        if($(this).val()){
            $("input[name=middlenamecheckbox00105_0]").prop('checked', false); 
        }
    });
   
   
   

   
    
   
    $("input[name=middlenamecheckbox]").change(function(){
        if($(this).is(':checked')){
            $("#UK-FCL-00003_0").val("");
            $("#UK-FCL-00003_0").attr('readonly',true);     
        }else{
            $("#UK-FCL-00003_0").attr('readonly',false);
        }
    });
       $("input[name=middlenamecheckbox00105_0]").change(function(){
        if($(this).is(':checked')){
            $("#UK-FCL-00105_0").val("");
            $("#UK-FCL-00105_0").attr('readonly',true);     
        }else{
            $("#UK-FCL-00105_0").attr('readonly',false);
        }
    });
 
   
      
   
    $("#label_UK-FCL-00002_0, #label_UK-FCL-00004_0, #label_UK-FCL-00011_0, #label_UK-FCL-00007_0, #label_UK-FCL-00523_0").find('b').after('<span style="color:red;"> * </span>');
   
    $('#UK-FCL-00348_0,#UK-FCL-00002_0, #UK-FCL-00003_0, #UK-FCL-00105_0,  #UK-FCL-00004_0, #UK-FCL-00011_0, #UK-FCL-00327_0, #UK-FCL-00010_0, #UK-FCL-00328_0,#UK-FCL-00238_0').keyup(function(){
           $(this).val($(this).val().toUpperCase());
       });
   
   
     $("#UK-FCL-00539_0").on("change", function() {
            $("#UK-FCL-00539_0-error").empty();
            $("#div_UK-FCL-00539_0").removeClass("has-error");
       })
      $("#UK-FCL-00012_0").on("change", function() {
            $("#UK-FCL-00012_0-error").empty();
            $("#div_UK-FCL-00012_0").removeClass("has-error");
       })
       $("#UK-FCL-00345_0").on("change", function() {
            $("#UK-FCL-00345_0-error").empty();
            $("#div_UK-FCL-00345_0").removeClass("has-error");
       })
        $("#UK-FCL-00351_0").on("change", function() {
            $("#UK-FCL-00351_0-error").empty();
            $("#div_UK-FCL-00351_0").removeClass("has-error");
       })
         $("#UK-FCL-00349_0").on("change", function() {
            $("#UK-FCL-00349_0-error").empty();
            $("#div_UK-FCL-00349_0").removeClass("has-error");
       })
           $("#UK-FCL-00531_0").on("change", function() {
              $("#UK-FCL-00531_0-error").empty();
              $("#div_UK-FCL-00531_0").removeClass("has-error");
         })
   
   
    //3rd step
   
     $("#UK-FCL-00533_0").on("change", function() {
            $("#UK-FCL-00533_0-error").empty();
            $("#div_UK-FCL-00533_0").removeClass("has-error");
       })
      $("#UK-FCL-00395_0").on("change", function() {
            $("#UK-FCL-00395_0-error").empty();
            $("#div_UK-FCL-00395_0").removeClass("has-error");
       })
       $("#UK-FCL-00096_0").on("change", function() {
            $("#UK-FCL-00096_0-error").empty();
            $("#div_UK-FCL-00096_0").removeClass("has-error");
       })
        $("#UK-FCL-00129_0").on("change", function() {
            $("#UK-FCL-00129_0-error").empty();
            $("#div_UK-FCL-00129_0").removeClass("has-error");
       })
         $("#UK-FCL-00480_0").on("change", function() {
            $("#UK-FCL-00480_0-error").empty();
            $("#div_UK-FCL-00480_0").removeClass("has-error");
       })
          $("#UK-FCL-00320_0").on("change", function() {
            $("#UK-FCL-00320_0-error").empty();
            $("#div_UK-FCL-00320_0").removeClass("has-error");
       })
           $("#UK-FCL-00372_0").on("change", function() {
            $("#UK-FCL-00372_0-error").empty();
            $("#div_UK-FCL-00372_0").removeClass("has-error");
       })
            $("#UK-FCL-00488_0").on("change", function() {
            $("#UK-FCL-00488_0-error").empty();
            $("#div_UK-FCL-00488_0").removeClass("has-error");
       })
             $("#UK-FCL-00295_0").on("change", function() {
            $("#UK-FCL-00295_0-error").empty();
            $("#div_UK-FCL-00295_0").removeClass("has-error");
       })
              $("#UK-FCL-00400_0").on("change", function() {
            $("#UK-FCL-00400_0-error").empty();
            $("#div_UK-FCL-00400_0").removeClass("has-error");
       })
               $("#UK-FCL-00489_0").on("change", function() {
             $("#UK-FCL-00489_0-error").empty();
             $("#div_UK-FCL-00489_0").removeClass("has-error");
        })
            $("#UK-FCL-00105_0").on("change", function() {
             $("#UK-FCL-00105_0-error").empty();
             $("#div_UK-FCL-00105_0").removeClass("has-error");
        })
                $("#UK-FCL-00316_0").on("change", function() {
                $("#UK-FCL-00316_0-error").empty();
                $("#div_UK-FCL-00316_0").removeClass("has-error");
               })
                $("#UK-FCL-00133_0").on("change", function() {
                $("#UK-FCL-00133_0-error").checked();
                $("#div_UK-FCL-00133_0").removeClass("has-error");
                      })
   
   
   
   
   //form 2 validation
   // $("#div_UK-FCL-00105_0").append("<div class='col-md-12' id='middlenamecheckbox00105_0_div' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox00105_0' name='middlenamecheckbox00105_0'> I do not have a middle name or middle initial</div>");
   $("#UK-FCL-00347_0, #UK-FCL-00530_0").val("BARBADOS");
   $('#UK-FCL-00340_0, #UK-FCL-00341_0, #UK-FCL-00342_0, #UK-FCL-00343_0, #UK-FCL-00350_0, #UK-FCL-00528_0, #UK-FCL-00529_0').keyup(function(){
           $(this).val($(this).val().toUpperCase());
       });
   
   //$("<div class='col-md-12' id='form2regisaddtitle' style='margin-top:10px;'><strong>Address of Registered office:</strong></div>").insertBefore("#div_UK-FCL-00340_0");
   
   $("#UK-FCL-00340_0").attr("maxLength","200");
   $("#UK-FCL-00341_0").attr("maxLength","200");
   $("#UK-FCL-00342_0").attr("maxLength","200");
   $("#UK-FCL-00343_0").attr("maxLength","200");
   $("#UK-FCL-00528_0").attr("maxLength","200");
   $("#UK-FCL-00529_0").attr("maxLength","200");

   
 
   
   
   // form 3 validation
   
   
   $('#UK-FCL-00150_0,#UK-FCL-00132_0, #UK-FCL-00133_0, #UK-FCL-00134_0, #UK-FCL-00104_0, #UK-FCL-00309_0, #UK-FCL-00336_0, #UK-FCL-00242_0,#UK-FCL-00105_0,#UK-FCL-00106_0,#UK-FCL-00093_0,#UK-FCL-00310_0,#UK-FCL-00094_0,#UK-FCL-00423_0,#UK-FCL-00169_0,#UK-FCL-00353_0,#UK-FCL-00399_0,#UK-FCL-00401_0').keyup(function(){
           $(this).val($(this).val().toUpperCase());
       });
   
   
   $('#UK-FCL-00172_0, #UK-FCL-00316_0, #UK-FCL-00419_0, #UK-FCL-00107_0, #UK-FCL-00335_0, #UK-FCL-00354_0, #UK-FCL-00356_0').keyup(function(){
           $(this).val($(this).val().toUpperCase());
       });

   
   
    // country and state/parish code dependency
       $("#UK-FCL-00007_0").on('change', function() {
           var countryCode = $(this).val();   
           if(countryCode==829){
                $("#UK-FCL-00010_0").val('');
                $("#UK-FCL-00010_0").attr('readonly',true);
            }else{
                $("#UK-FCL-00010_0").attr('readonly',false);
            }      
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
                  $("#UK-FCL-00129_0").html(result);
            
               }
           });
       });
      
   });
    

   
   function addmoreaction(id,service_id,div_id){
        
        $.ajax({
            type: "GET",
            dataType: 'json',
            data: {"button_id": id, "service_id": service_id, "add_more_button_di": div_id},
            url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizardtwo/formFieldMaster/getAddmoreData",
            success: function (data) {
                var tr_ = "<tr class='add_more_"+div_id+"'>";
                var td_ = '';
                var err = 0;
                var fieldsIDArr = new Array();
                // console.log(div_id);
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
                    if (cls == 'val' && (vall == '' || vall == 'undefined' || vall == 'Please Select ' || vall.length==0)) {
                        console.log(div_id);
                        $(".form-control-feedback-addmore").remove();
                        if(div_id==3233){                           
                            if(formchk_id=='UK-FCL-00003_0'){
                                var mnt = $("#UK-FCL-00003_0").val();
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
                            }
                            else{
                                var checkfield = true;
                            }
   
                            if(formchk_id=='UK-FCL-00002_0' || checkfield==false || formchk_id=='UK-FCL-00004_0' || formchk_id=='UK-FCL-00011_0' || formchk_id=='UK-FCL-00007_0' || formchk_id=='UK-FCL-00523_0'){
                                
                                
                                var labelData = $("#label_" + formchk_id).text();
   
                                labelData=labelData.replace('('+formchk_id+')',"");
                                //alert(formchk_id);
                                if(formchk_id=="UK-FCL-00003_0"){
                                        $("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>Please enter the required information or select the check box</div>");
                                }
                                else{
                                    
                                        $("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>This field is required</div>");
                                                                        
                                }
                                err = err + 1;
                                return false;
                            }
                            else{
                                $(".form-control-feedback-addmore").remove();
                                /*if(formchk_id=='UK-FCL-00133_0' || formchk_id=='UK-FCL-00137_0'){
                                    if(vall==""){
                                        vall = 'NA';
                                    }
                                }*/
                                td_ +='<td><input type="text" name="' + formchk_id + '[]" value="' + vall + '" class="form-control" title="'+vall+'"  readonly/></td>';
                                            fieldsIDArr.push(formchk_id);       
                            }   
                        }

                    else if(div_id==3897){                           
                        if(formchk_id=='UK-FCL-00105_0'){
                            var mnt = $("#UK-FCL-00105_0").val();
                            if(mnt){
                                var checkfield = true;
                            }else{
                                var mncb = $('input[name=middlenamecheckbox00105_0]:checked').val(); 
                                if(mncb){
                                    var checkfield = true;
                                }else{
                                    var checkfield = false;
                                } 
                            }
                        }
                        else{
                            var checkfield = true;
                        }
                        
                        var publicOfficeSel=$("#UK-FCL-00480_0").val();                
                        if(formchk_id=='UK-FCL-00132_0' || checkfield==false || formchk_id=='UK-FCL-00106_0' || formchk_id=='UK-FCL-00093_0' || formchk_id=='UK-FCL-00096_0' || formchk_id=='UK-FCL-00129_0' || formchk_id=='UK-FCL-00137_0' || formchk_id=='UK-FCL-00480_0' || (formchk_id=='UK-FCL-00181_0' && publicOfficeSel=='Yes')){
                            
                            
                            var labelData = $("#label_" + formchk_id).text();
                    
                            labelData=labelData.replace('('+formchk_id+')',"");
                            //alert(formchk_id);
                            if(formchk_id=="UK-FCL-00105_0"){
                                    $("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>Please enter the required information or select the check box</div>");
                            }
                           

                            else{
                                
                                    $("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>This field is required</div>");
                                                                    
                            }

                            err = err + 1;
                            return false;
                        }
                        else{
                            $(".form-control-feedback-addmore").remove();
                            /*if(formchk_id=='UK-FCL-00133_0' || formchk_id=='UK-FCL-00137_0'){
                                if(vall==""){
                                    vall = 'NA';
                                }
                            }*/
                            td_ += '<td><input type="text" name="' + formchk_id + '[]" value="' + vall + '" class="form-control" title="'+vall+'"  readonly/></td>';
                                        fieldsIDArr.push(formchk_id);       
                        }   
                    }
                       

                            
                    }
                    else {
                        $(".form-control-feedback-addmore").remove();
                        //console.log(typeVal);
                        td_ += '<td><input type="text" name="' + formchk_id + '[]" value="' + vall + '" class="form-control" title="'+vall+'"  readonly/></td>';
                        fieldsIDArr.push(formchk_id);       
                    }
   
                }); 
                if (err == 0) {
                    //alert(JSON.stringify(fieldsIDArr));
                    if(confirm('Before adding, please check whether the details entered is correct.')) 
                    {
                        $('#add_more_' + div_id).show();
                        $('#tbl_' + div_id).show();
                        td_ += "<td style='text-align:center;'><a class='btn btn-danger del_1' pi='add_more_"+div_id+"'><i class='fa fa-trash' aria-hidden='true'></i></a></td>";
                        tr_ += td_ + "</tr>";
                        $(tr_).appendTo($('#tbl_' + div_id));
                        fieldsIDArr.forEach(myFunction);
                        function myFunction(value, index, array) {  
                            $("input:radio[name='" + value + "']").prop('checked', false);
                            $('#' + value).val("");
                            $("#" + value + "").select2("val", "");
                            $('.chk_' + value + ':checked').removeAttr('checked');
                        }
                        $("input[name=middlenamecheckbox]").prop('checked', false); 
                        $("#UK-FCL-00003_0").attr('readonly',false);
                         $("input[name=middlenamecheckbox00105_0]").prop('checked', false); 
                        $("#UK-FCL-00105_0").attr('readonly',false);
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


   
   
        $('#UK-FCL-00132_0, #UK-FCL-00003_0, #UK-FCL-00105_0, #UK-FCL-00106_0, #UK-FCL-00093_0, #UK-FCL-00309_0, #UK-FCL-00310_0').keyup(function(){
            $(this).val($(this).val().toUpperCase());
        });
   
         
     
</script>
