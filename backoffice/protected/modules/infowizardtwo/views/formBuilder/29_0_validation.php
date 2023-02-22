<script type="text/javascript">
   $(document).ready(function() {
  $("#input_UK-FCL-00634_0").find('span').after('<span style="color:red;"> * </span>');
     $("#div_UK-FCL-00634_0").find('span').first().remove();//('<span style="color:red;"> * </span>');

     window.onload = function () {
          //Reference the DropDownList.
          var ddlYears = document.getElementById("UK-FCL-00556_0");
     
          //Determine the Current Year.
          var currentYear = (new Date()).getFullYear();
     
          //Loop and add the Year values to DropDownList.
          for (var i = 2015; i < currentYear; i++) {
              var option = document.createElement("OPTION");
              option.innerHTML = i;
              option.value = i;
              ddlYears.appendChild(option);
          }
      };
        

      $("#UK-FCL-00198_0").on("change",function(){
       
       //$("#div_UK-FCL-00362_0").css('margin-top','0em');

      });

      $("#UK-FCL-00198_0").on('change',function(){
        var idBusinesstypeSociArr = $(this).val();
       
        if(jQuery.inArray("165", idBusinesstypeSociArr) !== -1) {
            
        }       
      });
    

    $(".chk_UK-FCL-00634_0").on('click',function(){
        // console.log($("input[type='checkbox'][name='UK-FCL-00622_0[]']:checked"));
        if ($("input[type='checkbox'][name='UK-FCL-00634_0[]']:checked").length>0)
       {           
        $(".chk_UK-FCL-00634_0").attr("required",true);
        }
        else{           
            $(".chk_UK-FCL-00634_0").removeAttr("required");
        }

    })  
    autopopulated();
   
     $("#div_UK-FCL-00087_0").hide();
     //$("#div_UK-FCL-00033_0").hide();
     // $("input[name=middlenamecheckbox]").prop('disabled', true);
     // $("#UK-FCL-00105_0").attr('disabled',true);

       // code here
       $("a.back_btn").css('visibility', 'hidden');
       $("#UK-FCL-00632_0").attr('readonly', true);
       $("#UK-FCL-00557_0").attr('readonly', true);
       $("#UK-FCL-00347_0").prop('readonly',true); 
       $("#UK-FCL-00340_0").prop('readonly',true); 
       $("#UK-FCL-00341_0,#UK-FCL-00643_0,#UK-FCL-00644_0").prop('readonly',true); 
       $('#UK-FCL-00639_0').prop('readonly',true);  
       
       $("#UK-FCL-00347_0").val("BARBADOS");

        $("<div class='col-md-12' id='div_UK-FCL-00340_0' style='margin-top:10px;'><strong>Registered Office of Company/Society:</strong></div>").insertBefore("#div_UK-FCL-00340_0");
	   
       $("<div class='col-md-12' id='div_UK-FCL-00639_0' style='margin-top:10px;'><strong>Share Capital/Quota:</strong></div>").insertBefore("#div_UK-FCL-00639_0");

      
   
       $("<div class='col-md-12' id='div_UK-FCL-00640_0' style='margin-top:10px;'><strong>Issued by Company/Society in the year ending:</strong></div>").insertBefore("#div_UK-FCL-00640_0");
	   
       $("<div class='col-md-12' id='div_UK-FCL-00641_0' style='margin-top:10px;'><strong>Transferred by Company/Society in the year ending:</strong></div>").insertBefore("#div_UK-FCL-00641_0");

	   
       
	   
       $('#UK-FCL-00341_0,#UK-FCL-00344_0,#UK-FCL-00346_0,#UK-FCL-00317_0,#UK-FCL-00093_0,#UK-FCL-00309_0,#UK-FCL-00310_0,#UK-FCL-00094_0,#UK-FCL-00132_0, #UK-FCL-00340_0,#UK-FCL-00105_0, #UK-FCL-00150_0, #UK-FCL-00107_0, #UK-FCL-00335_0, #UK-FCL-00354_0, #UK-FCL-00356_0').keyup(function(){
              $(this).val($(this).val().toUpperCase());
          });

	
	
//secretary detail start validation

var ff331 = $("#UK-FCL-00150_0").val();
    if(ff331){
              $("#div_UK-FCL-00150_0, .agentdetail").show();
           // $("#div_UK-FCL-00105_0").show();
            $("#div_UK-FCL-00133_0").show();
            $("#div_UK-FCL-00324_0").show();
            $("#div_UK-FCL-00107_0").show();
            $("#div_UK-FCL-00335_0").show();     
            $("#div_UK-FCL-00396_0").show();
            $("#div_UK-FCL-00320_0").show(); 
            $("#div_UK-FCL-00372_0").show();
            $("#div_UK-FCL-00354_0").show();
            $("#div_UK-FCL-00356_0").show();
            $("#div_UK-FCL-00304_0").show();

            
                getcomapnyname(ff331);
                
    }else{
            $("#div_UK-FCL-00150_0, .agentdetail").hide();
         //   $("#div_UK-FCL-00105_0").hide();
            $("#div_UK-FCL-00133_0").hide();
            $("#div_UK-FCL-00324_0").hide();
            $("#div_UK-FCL-00107_0").hide();
            $("#div_UK-FCL-00335_0").hide();     
            $("#div_UK-FCL-00396_0").hide();
            $("#div_UK-FCL-00320_0").hide(); 
            $("#div_UK-FCL-00372_0").hide(); 
            $("#div_UK-FCL-00354_0").hide(); 
            $("#div_UK-FCL-00356_0").hide(); 
            $("#div_UK-FCL-00304_0").hide(); 
    }

    $('input[name=UK-FCL-00672_0]').change(function(){      
        if($(this).val()=="Yes"){
        $("#div_UK-FCL-00150_0, .agentdetail").show();
           // $("#div_UK-FCL-00105_0").show();
            $("#div_UK-FCL-00133_0").show();
            $("#div_UK-FCL-00324_0").show();
            $("#div_UK-FCL-00107_0").show();
            $("#div_UK-FCL-00335_0").show();     
            $("#div_UK-FCL-00396_0").show();
            $("#div_UK-FCL-00320_0").show(); 
            $("#div_UK-FCL-00372_0").show();  
            $("#div_UK-FCL-00354_0").show();   
            $("#div_UK-FCL-00356_0").show();   
            $("#div_UK-FCL-00304_0").show();     
        }else{
            $("#div_UK-FCL-00150_0, .agentdetail").hide();
          //  $("#div_UK-FCL-00105_0").hide();
            $("#div_UK-FCL-00133_0").hide();
            $("#div_UK-FCL-00324_0").hide();
            $("#div_UK-FCL-00107_0").hide();
            $("#div_UK-FCL-00335_0").hide();     
            $("#div_UK-FCL-00396_0").hide();
            $("#div_UK-FCL-00320_0").hide(); 
            $("#div_UK-FCL-00372_0").hide();   
            $("#div_UK-FCL-00354_0").hide(); 
            $("#div_UK-FCL-00356_0").hide(); 
            $("#div_UK-FCL-00304_0").hide();          
            

            $("#div_UK-FCL-00150_0").val("");
            //$("#div_UK-FCL-00105_0").val("");
            $("#div_UK-FCL-00133_0").val("");
            $("#div_UK-FCL-00324_0").val("");
            $("#div_UK-FCL-00107_0").val("");
            $("#div_UK-FCL-00335_0").val("");    
            $("#div_UK-FCL-00396_0").val("");
            $("#div_UK-FCL-00320_0").val(""); 
            $("#div_UK-FCL-00372_0").val("");
            $("#div_UK-FCL-00354_0").val("");
            $("#div_UK-FCL-00356_0").val("");
            $("#div_UK-FCL-00304_0").val("");
            
        }
    });



// end secretary








   
   
   
          $("#UK-FCL-00344_0").attr('readonly',true);
          $("#UK-FCL-00345_0").attr('readonly',true);
          $("#UK-FCL-00346_0").attr('readonly',true);
          
        function autopopulated(){
            var reg_no = $("#UK-FCL-00631_0").val();
            if(reg_no.length == 0)
                return false;
           $.ajax({
               type: "POST",
               dataType: 'json',
               url: "/backoffice/infowizardtwo/subFormANNUALRETURNForm35/getCompanyNameBySrnNo/reg_no/" + reg_no,
               beforeSend: function() {
                   $("#UK-FCL-00631_0-error").text("Please wait...");
               },
               success: function(result) {
                   if(result.status == true) {
                       $("#UK-FCL-00631_0-error").text("");
                       $("#UK-FCL-00632_0").val(result.name);
                       $("#UK-FCL-00089_0-error").empty();
                       $("#div_UK-FCL-00089_0").removeClass("has-error");
                       
                        
                        var regdate = moment(result.date_of_incorporation).format('DD/MM/YYYY');  
                        $("#UK-FCL-00557_0").val(regdate);
                        // $("#UK-FCL-00557_0").val(result.);
                         
                        $("#UK-FCL-00340_0").val(result.regaddress1);
                        $("#UK-FCL-00341_0").val(result.regaddress2);
                        
                        $("#UK-FCL-00344_0").val(result.regcity);
                       
                       $("#UK-FCL-00345_0").val(result.regparish);
                        
                        $("#UK-FCL-00346_0").val(result.regportal);
                        
                        $("#UK-FCL-00347_0").val(result.regcountry);
                        $("#UK-FCL-00639_0").val(result.no_of_share_holder);  
                        if(result.no_of_share_holder.length == 0){
                            console.log(result.no_of_share_holder.length);
                            $("#UK-FCL-00639_0").removeAttr('readonly');               
                        }
                        $('#add_more_2912').show();
                        $('#add_more_2912').empty();
                        if(result.classes_of_shares=='npc'){
                            $("#UK-FCL-00643_0, #UK-FCL-00644_0").removeAttr("readonly");
                            $("#UK-FCL-00643_0, #UK-FCL-00644_0").prop("required",true);
                        }
                        else
                        $("#add_more_2912").append(result.classes_of_shares);
                        // $('#add_more_2912').show();
                        // $('#add_more_2912').empty();
                        $('#add_more_3822').show();
                        $('#add_more_3822').empty();
						// console.log(result.director_detail);
                        $("#add_more_3822").append(result.director_detail);
                        // $('#tbl_2912').show();
                   } else {
                       $("#UK-FCL-00631_0-error").text(result.msg);
                       $("#UK-FCL-00089_0").val("");
                   }
                   console.log(result);
               }
           });
        }
       $("#UK-FCL-00631_0").on("blur", function() {
            autopopulated();
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
       $("#div_UK-FCL-00105_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox00105_0' name='middlenamecheckbox00105_0'> I do not have a middle name or middle initial</div>");
	   
        $("#div_UK-FCL-00133_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox00133_0' name='middlenamecheckbox00133_0'> I do not have a middle name or middle initial</div>");
       $('#UK-FCL-00132_0, #UK-FCL-00133_0, #UK-FCL-00324_0').keyup(function() {
           $(this).val($(this).val().toUpperCase());
       });
       $("#UK-FCL-00105_0").blur(function() {
           if($(this).val()) {
               $("input[name=middlenamecheckbox00105_0]").prop('checked', false);
           }
       });
       $("#UK-FCL-00133_0").blur(function() {
           if($(this).val()) {
               $("input[name=middlenamecheckbox00133_0]").prop('checked', false);
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

           $("input[name=middlenamecheckbox00133_0]").change(function(){
            if($(this).is(':checked')){
                $("#UK-FCL-00133_0").val("");
                $("#UK-FCL-00133_0").attr('readonly',true);     
            }else{
                $("#UK-FCL-00133_0").attr('readonly',false);
            }
        });
       

     
       $("<div class='col-md-12' id='form2regisaddtitle' style='margin-top:10px;'><strong>The Directors/Managers of the Company/Society as of the date of the Annual Return are:</strong></div>").insertBefore("#div_UK-FCL-00132_0");

       $("<div class='col-md-12 agentdetail' id='form2regisaddtitle' style='margin-top:10px;'><strong>The Secretary (if any) of the Company as of the date of the Annual Return is:</strong></div>").insertBefore("#div_UK-FCL-00150_0");
       $("div.agentdetail").hide();
   
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
                           if(div_id==3822){                           
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
                           } 
                           if(div_id=='3822' && (formchk_id=='UK-FCL-00132_0' || checkfield==false || formchk_id=='UK-FCL-00317_0' || formchk_id=='UK-FCL-00093_0' || formchk_id=='UK-FCL-00096_0' || formchk_id=='UK-FCL-00129_0'  || formchk_id=='UK-FCL-00137_0')){                             
                               
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
                           else  if(div_id=='3842' && (formchk_id=='UK-FCL-00639_0' || formchk_id=='UK-FCL-00642_0' || formchk_id=='UK-FCL-00640_0' || formchk_id=='UK-FCL-00641_0')){
                               
                               var labelData = $("#label_" + formchk_id).text();
                           
                               labelData=labelData.replace('('+formchk_id+')',"");
                               //alert(formchk_id);
                                   
                                $("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>This field is required</div>");
                               err = err + 1;
                               return false;
                           }
                          else  if(div_id=='2912' && (formchk_id=='UK-FCL-00643_0' || formchk_id=='UK-FCL-00644_0')){
                               
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
                            td_ += '<td><input type="text" name="' + formchk_id + '[]" value="' + vall + '" class="form-control" title="'+vall+'"  readonly/></td>';
                            fieldsIDArr.push(formchk_id);       
                           }    
                               
                       }
                       else {
                        console.log("adding...");
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
                            console.log('div adding');
                           $('#add_more_' + div_id).show();
                           $('#tbl_' + div_id).show();
                           td_ += "<td style='text-align:center;'><a class='btn btn-danger del_1' pi='add_more_"+div_id+"'><i class='fa fa-trash' aria-hidden='true'></i></a></td>";
                           tr_ += td_ + "</tr>";
                           $(tr_).appendTo($('#tbl_' + div_id));
                           fieldsIDArr.forEach(myFunction);
                           function myFunction(value, index, array) { 
                               var autoShareHolderVal='';
                               if(div_id==3842)
                                    autoShareHolderVal=$("#UK-FCL-00639_0").val();
                               
                               $("input:radio[name='" + value + "']").prop('checked', false);
                               $('#' + value).val("");
                               $("#" + value + "").select2("val", "");
                               $('.chk_' + value + ':checked').removeAttr('checked');
                               if(div_id==3842)
                                    $("#UK-FCL-00639_0").val(autoShareHolderVal);
                           }
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
   
   
</script>