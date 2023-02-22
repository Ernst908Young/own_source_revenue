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

  $("#UK-FCL-00193_0").prop('readonly',true);


  //select first option
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


  //select second option

  $("#title_UK-FCL-00315_0").hide();
  $("#hr_UK-FCL-00315_0").hide();
  $("#div_UK-FCL-00315_0").hide();
  $("#div_UK-FCL-00316_0").hide();
  $("#div_UK-FCL-00317_0").hide();
  $("#div_UK-FCL-00104_0").hide();
  $("#div_UK-FCL-00238_0").hide();
  $("#div_UK-FCL-00382_0").hide();
  $("#div_UK-FCL-00396_0").hide();
  $("#div_UK-FCL-00383_0").hide();
  $("#div_UK-FCL-00320_0").hide();
  $("#div_UK-FCL-00138_0").hide();
  
  
  
  
  $("<div class='row'><div class='col-lg-12' id='details1'><strong>Notice is given that the following person(s) was/ were appointed as Manager(s):</strong></div></div><br>").insertAfter("#hr_UK-FCL-00132_0");


  $("<div class='row'><div class='col-lg-12' id='details2'><strong>Notice is given that the following person(s) ceased to hold office as Manager(s):</strong></div></div><br>").insertAfter("#hr_UK-FCL-00315_0");


  $("<div class='row'><div class='col-lg-12' id='details3'><strong>The Managers of the company as of this date are:</strong></div></div><br>").insertAfter("#hr_UK-FCL-00397_0");


  // APPOINTMENT DETAILS

    $("#div_UK-FCL-00105_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox' name='middlenamecheckbox' class='group1'> Please confirm that this person does not have a middle name</div>");
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

    $("#div_UK-FCL-00316_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox_2' name='middlenamecheckbox_2' class='group1'> Please confirm that this person does not have a middle name</div>");
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

    $("#div_UK-FCL-00133_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox_3' name='middlenamecheckbox_3' class='group1'> Please confirm that this person does not have a middle name</div>");
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


    $("#UK-FCL-00394_0").on("change",function(){

        if($(this).val()=='Notice of Appointment of Manager'){

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


             $("#title_UK-FCL-00315_0").hide();
              $("#hr_UK-FCL-00315_0").hide();
              $("#div_UK-FCL-00315_0").hide();
              $("#div_UK-FCL-00316_0").hide();
              $("#div_UK-FCL-00317_0").hide();
              $("#div_UK-FCL-00104_0").hide();
              $("#div_UK-FCL-00238_0").hide();
              $("#div_UK-FCL-00382_0").hide();
              $("#div_UK-FCL-00396_0").hide();
              $("#div_UK-FCL-00383_0").hide();
              $("#div_UK-FCL-00320_0").hide();
              $("#div_UK-FCL-00138_0").hide();


          }else if($(this).val()=='Notice of Cessation of Manager(s)'){

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
              $("#div_UK-FCL-00396_0").show();
              $("#div_UK-FCL-00383_0").show();
              $("#div_UK-FCL-00320_0").show();
              $("#div_UK-FCL-00138_0").show();


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

          }else if($(this).val()=='Notice of Appointment and Cessation of Manager(s)'){

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


             $("#title_UK-FCL-00315_0").show();
              $("#hr_UK-FCL-00315_0").show();
              $("#div_UK-FCL-00315_0").show();
              $("#div_UK-FCL-00316_0").show();
              $("#div_UK-FCL-00317_0").show();
              $("#div_UK-FCL-00104_0").show();
              $("#div_UK-FCL-00238_0").show();
              $("#div_UK-FCL-00382_0").show();
              $("#div_UK-FCL-00396_0").show();
              $("#div_UK-FCL-00383_0").show();
              $("#div_UK-FCL-00320_0").show();
              $("#div_UK-FCL-00138_0").show();

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


   $("#UK-FCL-00290_0").on("blur",function(){
        var reg_no = $(this).val();
    
    if(reg_no>0){
            $.ajax({
                type: "POST",
                dataType:'json',
                url: "/backoffice/infowizard/subFormNoticeofChangeofManagerForm6/getCharityNameByregno/reg_no/" + reg_no,
                beforeSend:function(){
                    $("#UK-FCL-00290_0-error").text("Please wait...");                      
                },
                success: function(result) {                     
                    if(result.status==true){                            
                            $("#UK-FCL-00290_0-error").text("");                 
                            $("#UK-FCL-00193_0").val(result.cname);     
                                                                    
                    }else{
                        $("#UK-FCL-00290_0-error").text(result.msg);
                        $("#UK-FCL-00193_0").val("");                       
                    }
                   console.log(result);
                }
            });
    }        
});            


 });


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
                    if(div_id==813){

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
                            if(formchk_id=='UK-FCL-00235_0' || formchk_id=='UK-FCL-00237_0' || formchk_id=='UK-FCL-00238_0' || formchk_id=='UK-FCL-00239_0' || formchk_id == 'UK-FCL-00373_0' || formchk_id=='UK-FCL-00107_0'||formchk_id=='UK-FCL-00372_0'|| formchk_id=='UK-FCL-00384_0'|| formchk_id=='UK-FCL-00239_0'||  checkfield == false){
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
                            if(formchk_id=='UK-FCL-00235_0' || formchk_id=='UK-FCL-00237_0' || formchk_id=='UK-FCL-00238_0' || formchk_id=='UK-FCL-00239_0' || formchk_id == 'UK-FCL-00373_0' || formchk_id=='UK-FCL-00107_0'||formchk_id=='UK-FCL-00372_0'|| formchk_id=='UK-FCL-00384_0'|| formchk_id=='UK-FCL-00239_0'||  checkfield == false){
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
                            if(formchk_id=='UK-FCL-00235_0' || formchk_id=='UK-FCL-00237_0' || formchk_id=='UK-FCL-00238_0' || formchk_id=='UK-FCL-00239_0' || formchk_id == 'UK-FCL-00373_0' || formchk_id=='UK-FCL-00107_0'||formchk_id=='UK-FCL-00372_0'|| formchk_id=='UK-FCL-00384_0'|| formchk_id=='UK-FCL-00239_0'||  checkfield == false){
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

                    if(div_id==813){
                            if(formchk_id=='UK-FCL-00132_0' || formchk_id=='UK-FCL-00324_0' || formchk_id=='UK-FCL-00093_0' || formchk_id=='UK-FCL-00096_0' || formchk_id=='UK-FCL-00304_0'){
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
                    if(div_id==1358){
                            if(formchk_id=='UK-FCL-00315_0' || formchk_id=='UK-FCL-00317_0' || formchk_id=='UK-FCL-00104_0' || formchk_id=='UK-FCL-00320_0'){
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


                    if(div_id==1370){
                            if(formchk_id=='UK-FCL-00397_0' || formchk_id=='UK-FCL-00398_0' || formchk_id=='UK-FCL-00107_0' || formchk_id=='UK-FCL-00402_0' || formchk_id=='UK-FCL-00137_0'){
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
