<script type="text/javascript">
   $(document).ready(function() {
       // code here
       $("a.back_btn").css('visibility', 'hidden');
       $("#UK-FCL-00089_0").attr('readonly', true);
       $("#UK-FCL-00557_0").attr('readonly', true);
       $("#UK-FCL-00347_0").prop('readonly',true); 
       $("#UK-FCL-00347_0").val("BARBADOS");
       $("<div class='col-md-12' id='div_UK-FCL-00248_0' style='margin-top:10px;'><strong>Share Capital:</strong></div>").insertBefore("#div_UK-FCL-00248_0");
   
       $("<div class='col-md-12' id='div_UK-FCL-00559_0' style='margin-top:10px;'><strong>Issued by Company in the year ending:</strong></div>").insertBefore("#div_UK-FCL-00559_0");
       $("<div class='col-md-12' id='div_UK-FCL-00564_0' style='margin-top:10px;'><strong>Transferred by Company in the year ending:</strong></div>").insertBefore("#div_UK-FCL-00564_0");
       $("<div class='col-md-12' id='div_UK-FCL-00099_0' style='margin-top:10px;'><strong>Authorised Share Capital:</strong></div>").insertBefore("#div_UK-FCL-00099_0");
       $('#UK-FCL-00341_0,#UK-FCL-00344_0,#UK-FCL-00346_0,#UK-FCL-00317_0,#UK-FCL-00093_0,#UK-FCL-00309_0,#UK-FCL-00310_0,#UK-FCL-00094_0,#UK-FCL-00132_0, #UK-FCL-00340_0,#UK-FCL-00105_0, #UK-FCL-00150_0, #UK-FCL-00107_0, #UK-FCL-00335_0, #UK-FCL-00354_0, #UK-FCL-00356_0').keyup(function(){
              $(this).val($(this).val().toUpperCase());
          });
   
   
   
          $("#UK-FCL-00344_0").attr('readonly',true);

       $("#UK-FCL-00403_0").on("blur", function() {
           var reg_no = $(this).val();
           $.ajax({
               type: "POST",
               dataType: 'json',
               url: "/backoffice/infowizardtwo/subFormRestatedArticlesForm13/getCompanyNameBySrnNo/reg_no/" + reg_no,
               beforeSend: function() {
                   $("#UK-FCL-00403_0-error").text("Please wait...");
               },
               success: function(result) {
                   if(result.status == true) {
                       $("#UK-FCL-00403_0-error").text("");
                       $("#UK-FCL-00089_0").val(result.name);
                       $("#UK-FCL-00089_0-error").empty();
                       $("#div_UK-FCL-00089_0").removeClass("has-error");
                   } else {
                       $("#UK-FCL-00403_0-error").text(result.msg);
                       $("#UK-FCL-00089_0").val("");
                   }
                   console.log(result);
               }
           });
       });
       $("#UK-FCL-00557_0").on("change", function() {
            $("#UK-FCL-00557_0-error").empty();
            $("#div_UK-FCL-00557_0").removeClass("has-error");
       })
       $("title_UK-FCL-00132_0").on("change", function() {
            $("title_UK-FCL-00132_0-error").empty();
            $("title_UK-FCL-00132_0").removeClass("has-error");
       })
        $("#UK-FCL-00345_0").on("change", function() {
            $("#UK-FCL-00345_0-error").empty();
            $("#div_UK-FCL-00345_0").removeClass("has-error");
       })

       /*$("#UK-FCL-00302_0").datepicker({
           maxDate: 0
       });*/
       //director details
       $("#div_UK-FCL-00105_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox' name='middlenamecheckbox'> I do not have a middle name or middle initial</div>");
        $("#div_UK-FCL-00133_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox' name='middlenamecheckbox'> I do not have a middle name or middle initial</div>");
       $('#UK-FCL-00132_0, #UK-FCL-00133_0, #UK-FCL-00324_0').keyup(function() {
           $(this).val($(this).val().toUpperCase());
       });
       $("#UK-FCL-00105_0").blur(function() {
           if($(this).val()) {
               $("input[name=middlenamecheckbox]").prop('checked', false);
           }
       });
       $("#UK-FCL-00133_0").blur(function() {
           if($(this).val()) {
               $("input[name=middlenamecheckbox]").prop('checked', false);
           }
       });
       $("input[name=middlenamecheckbox]").change(function() {
           var parentId=$(this).parent().parent().attr('id');
           if(parentId=='div_UK-FCL-00105_0') {
              if($(this).is(':checked')){
                $("#UK-FCL-00105_0").val("");
                $("#UK-FCL-00105_0").attr('readonly', true);
              }
              else {
               $("#UK-FCL-00105_0").attr('readonly', false);
              }
              
           }
           else if(parentId=='div_UK-FCL-00133_0'){
                if($(this).is(':checked')) {
                    $("#UK-FCL-00133_0").val("");
                    $("#UK-FCL-00133_0").attr('readonly', true);
                } else {
                    $("#UK-FCL-00133_0").attr('readonly', false);
                }
           } 

       });
       $("<div class='col-md-12' id='form2regisaddtitle' style='margin-top:10px;'><strong>Name of Person Soliciting:</strong></div>").insertBefore("#div_UK-FCL-00132_0");
   
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
   
          $("#UK-FCL-00320_0").on('change', function() {
           var countryCode = $(this).val();  
           if(countryCode==829){
            $("#UK-FCL-00354_0").val('');
            $("#UK-FCL-00354_0").attr('readonly',true);
        }else{
            $("#UK-FCL-00354_0").attr('readonly',false);
        }    
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
                           // console.log(div_id);
                           $(".form-control-feedback-addmore").remove();
                           if(div_id==2892){                           
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
                               }
                               else{
                                   var checkfield = true;
                               }
                           } 
                           if(div_id=='2892' && (formchk_id=='UK-FCL-00132_0' || checkfield==false || formchk_id=='UK-FCL-00317_0' || formchk_id=='UK-FCL-00093_0' || formchk_id=='UK-FCL-00096_0' || formchk_id=='UK-FCL-00129_0'  || formchk_id=='UK-FCL-00137_0')){                             
                               
                               var labelData = $("#label_" + formchk_id).text();
                           
                               labelData=labelData.replace('('+formchk_id+')',"");
                               //alert(formchk_id);
                               if(formchk_id=="UK-FCL-00105_0"){
                                       $("#div_"+formchk_id).append("<div class='form-control-feedback-addmore'>Please enter the required information or select the check box</div>");
                               }
                               else{
                                   
                                       $("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>This field is required</div>");
                                                                       
                               }
                               err = err + 1;
                               return false;
                           }
                           else  if(div_id=='2913' && (formchk_id=='UK-FCL-00248_0' || formchk_id=='UK-FCL-00249_0' || formchk_id=='UK-FCL-00559_0' || formchk_id=='UK-FCL-00564_0')){
                               
                               var labelData = $("#label_" + formchk_id).text();
                           
                               labelData=labelData.replace('('+formchk_id+')',"");
                               //alert(formchk_id);
                                   
                                $("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>This field is required</div>");
                               err = err + 1;
                               return false;
                           }
                          else  if(div_id=='2912' && (formchk_id=='UK-FCL-00099_0' || formchk_id=='UK-FCL-00561_0')){
                               
                               var labelData = $("#label_" + formchk_id).text();
                           
                               labelData=labelData.replace('('+formchk_id+')',"");
                               //alert(formchk_id);
                                   
                                $("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>This field is required</div>");
                               err = err + 1;
                               return false;
                           }
                           else{
                            $(".form-control-feedback-addmore").remove();
                            //console.log(typeVal);
                            td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' title='"+vall+"'  readonly/></td>";
                            fieldsIDArr.push(formchk_id);       
                           }    
                               
                       }
                       else {
                        console.log("adding...");
                           $(".form-control-feedback-addmore").remove();
                           //console.log(typeVal);
                           td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' title='"+vall+"'  readonly/></td>";
                           fieldsIDArr.push(formchk_id);       
                       }
      
                   }); 
                   if (err == 0) {
                       //alert(JSON.stringify(fieldsIDArr));
                       if(confirm('Before adding, please check whether the details entered is correct.')) 
                       {
                            console.log('div adding');
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
   
   
</script>