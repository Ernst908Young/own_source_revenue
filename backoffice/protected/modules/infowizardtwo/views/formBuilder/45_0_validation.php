
<script type="text/javascript">
$(document).ready(function(){

   $("#label_UK-FCL-00357_0").find('b').after('<span style="color:red;"> * </span>');

	
        
   $('#div_UK-FCL-00144_0,#div_UK-FCL-00138_0').hide();


      $("#UK-FCL-00480_0").change(function(){
        if($("#UK-FCL-00480_0").val() == 'Yes'){

            //$("#UK-FCL-00490_0").attr('required','');
            $("#UK-FCL-00481_0").prop('required',true); 
            $("#UK-FCL-00481_0").attr('readonly',false);

        }else{
            
            $("#UK-FCL-00481_0").attr('required',false);
             $("#UK-FCL-00481_0").attr('readonly',true);
        }
    });

//quata details

  var nocos = $("#UK-FCL-00365_0").val();
   if(nocos){
      if(nocos=='01'){

            $("#UK-FCL-00367_0").val("Common Quotas").trigger("change");
            $("#UK-FCL-00367_0").prop("disabled", true);
            $("#div_UK-FCL-00370_0").hide();
            $("input[name=UK-FCL-00370_0]").prop('checked', false);
            $("#div_UK-FCL-00266_0").hide();
            $("#UK-FCL-00266_0").val("");

            $("#UK-FCL-00371_0").val("The rights of the holders are equal in all respects as follows:\n(a) the right to vote at any meeting of Quotaholders;\n(b) the right to receive any dividend declared by the Society;\n(c) the right to receive the remaining property of the Society on dissolution.");
            $("#UK-FCL-00371_0").attr("readonly",true);
            $("#div_UK-FCL-00288_0").show();
      }else{
         $("#div_UK-FCL-00288_0").hide();
      }
   }else{
      $("#div_UK-FCL-00370_0").hide(); 
      $("#div_UK-FCL-00288_0").hide();
   }


   $("#UK-FCL-00365_0").on("change",function(){
      if($(this).val()){
         if($(this).val()=='01'){

            $("#UK-FCL-00367_0").val("Common Quotas").trigger("change");
            $("#UK-FCL-00367_0").prop("disabled", true);
            $("#div_UK-FCL-00370_0").hide();
            $("input[name=UK-FCL-00370_0]").prop('checked', false);

            $("#div_UK-FCL-00266_0").hide();
            $("#UK-FCL-00266_0").val("");
            $("#UK-FCL-00371_0").val("The rights of the holders are equal in all respects as follows:\n(a) the right to vote at any meeting of Quotaholders;\n(b) the right to receive any dividend declared by the Society;\n(c) the right to receive the remaining property of the Society on dissolution.");
            $("#UK-FCL-00371_0").attr("readonly",true);
            $("#div_UK-FCL-00288_0").show();

         }else{
            $("#UK-FCL-00367_0").val("").trigger("change");
            $("#UK-FCL-00288_0").val("");
            $("#div_UK-FCL-00288_0").hide();
            $("#UK-FCL-00371_0").attr("readonly",false);
            $("#UK-FCL-00367_0").prop("disabled", false);
         }
      }else{
            $("#UK-FCL-00367_0").val("").trigger("change");
             $("#UK-FCL-00288_0").val("");
            $("#div_UK-FCL-00288_0").hide();
            $("#UK-FCL-00371_0").attr("readonly",false);
            $("#UK-FCL-00367_0").prop("disabled", false);          
      }     
   });


   $("#UK-FCL-00367_0").on("change",function(){
      if($(this).val()){
         if($(this).val()=='Common Quotas'){

            $("#div_UK-FCL-00370_0").hide();
            $("#div_UK-FCL-00266_0").hide();
            $("input[name=UK-FCL-00370_0]").prop('checked', false);
            $("#UK-FCL-00266_0").val(""); 
            $("#UK-FCL-00371_0").val("");

         }else{
            $("#div_UK-FCL-00370_0").show();
            $("#div_UK-FCL-00371_0").attr("required",true);

            if($(this).val()=="Preference Quota"){
               $("#UK-FCL-00371_0").val("");
            }else{
               $("#UK-FCL-00371_0").val("");
            }
         }
      }else{
         $("#div_UK-FCL-00370_0").hide();
         $("#div_UK-FCL-00266_0").hide();
         $("input[name=UK-FCL-00370_0]").prop('checked', false);
         $("#UK-FCL-00266_0").val("");
         $("#UK-FCL-00371_0").val("");
          
      }
      
   });
   var ff00370_0 = $('input[name=UK-FCL-00370_0]:checked').val(); 
      if(ff00370_0 == "Yes"){
         $("#div_UK-FCL-00266_0").show();
         $("#div_UK-FCL-00266_0").attr("required",true);
         $("#UK-FCL-00371_0").attr("readonly",false);       
      }else{      
         $("#div_UK-FCL-00266_0").hide();       
      }

    $('input[name=UK-FCL-00370_0]').change(function(){      
         if($(this).val()=="Yes"){
            $("#div_UK-FCL-00266_0").show();
            $("#div_UK-FCL-00266_0").attr("required",true); 
         }else{
            $("#div_UK-FCL-00266_0").hide();       
            $("#UK-FCL-00266_0").val("");
          }
      });

        // second part
       $(".chk_UK-FCL-00230_0 ").on("change",function(){
              var ff00114 = $('input[name=UK-FCL-00230_0]:checked').val();
               if(ff00114 =='Yes'){
                  $("#div_UK-FCL-00664_0").show();

                  if($('.chk_UK-FCL-00664_0 ')[1].checked){
                     $("#div_UK-FCL-00671_0").show();
                  }else{
                     $("#div_UK-FCL-00671_0").hide();
                  }
               }else{
                  $("#div_UK-FCL-00664_0").hide();
                  $(".chk_UK-FCL-00664_0 ").prop('checked', false);
                  $("#div_UK-FCL-00671_0").hide();    
               }
       })
     




      $("input[name=UK-FCL-00230_0]").on("change",function(){  
         if($(this).val()=='Yes'){
            $("#div_UK-FCL-00664_0").show();
            $(".chk_UK-FCL-00664_0 ")[0].checked = true;       
         }else{
            $("#div_UK-FCL-00664_0").hide();
            $(".chk_UK-FCL-00664_0 ").prop('checked', false);
            $("#div_UK-FCL-00671_0").hide();
            $("#UK-FCL-00671_0").val("");
         }
      });

   //quota detail check box
   $(".chk_UK-FCL-00664_0").change(function(){     
         if($(this).val()=='Others (Please specify)'){
            if($(this).is(":checked")){
               $("#div_UK-FCL-00671_0").show();
            }else{
               $("#div_UK-FCL-00671_0").hide();
               $("#UK-FCL-00671_0").val("");
            }
            //
         }else{
            if($(this).is(":checked")){            
               
            }else{
               var cff00114 = $('input[name=UK-FCL-00230_0]:checked').val();
               // alert(cff00114);
               if(cff00114 =='Yes'){
                  $(".chk_UK-FCL-00664_0 ")[0].checked = true;
            }
            }
         }
      });

   
   $('input[type=radio][name=UK-FCL-00525_0]').change(function() {
      
        checksubmitbutton();
    }); 

    $("input[type=radio][name=UK-FCL-00526_0]").change(function(){
        checksubmitbutton();
    }); 

      $("#UK-FCL-00347_0,#UK-FCL-00530_0").prop('readonly',true); 
   $("#UK-FCL-00347_0, #UK-FCL-00530_0").val("BARBADOS"); 
    //form 3 on change
   $("#UK-FCL-00012_0").on("change",function(){
      var val12 = $(this).val();
      if(val12=='Notice of Address'){
         showregis(); 
         showmail(); 
         hidepre();
      }
   
      if(val12=='Notice of change in registered office address'){
         
         showregis(); 
         hidemail();
         showpre(); 
      }
      if(val12=='Notice of change in mailing address'){
          hideregis();
          showmail(); 
          hidepre();
      }
      if(val12=='Notice of change in registered office address and mailing address'){
         showregis(); 
         showmail(); 
         showpre(); 
      }
   
   });
   
   //form 2 function hide show
   function showregis(){
    $("#form2regisaddtitle, #div_UK-FCL-00340_0, #div_UK-FCL-00341_0, #div_UK-FCL-00345_0, #div_UK-FCL-00346_0, #div_UK-FCL-00347_0").show();
   }
   function hideregis(){
      // alert("hide");
    $("#form2regisaddtitle, #div_UK-FCL-00340_0, #div_UK-FCL-00341_0, #div_UK-FCL-00345_0, #div_UK-FCL-00346_0, #div_UK-FCL-00347_0").hide();
   }
   function showmail(){
    $("#form2mailaddtitle, #div_UK-FCL-00342_0, #div_UK-FCL-00343_0, #div_UK-FCL-00351_0, #div_UK-FCL-00349_0, #div_UK-FCL-00350_0").show();
   }
   function hidemail(){
    $("#form2mailaddtitle, #div_UK-FCL-00342_0, #div_UK-FCL-00343_0, #div_UK-FCL-00351_0, #div_UK-FCL-00349_0, #div_UK-FCL-00350_0").hide();
   }
   function showpre(){
    $("#form2preaddtitle, #div_UK-FCL-00528_0, #div_UK-FCL-00529_0, #div_UK-FCL-00531_0, #div_UK-FCL-00532_0, #div_UK-FCL-00530_0").show();
   }
   function hidepre(){
    $("#form2preaddtitle, #div_UK-FCL-00528_0, #div_UK-FCL-00529_0, #div_UK-FCL-00531_0, #div_UK-FCL-00532_0, #div_UK-FCL-00530_0").hide();
   }

        // checksubmitbutton();

    function checksubmitbutton(){
     
        var ff00525_0 = $('input[name=UK-FCL-00525_0]:checked').val(); 
        var ff00526_0 = $('input[name=UK-FCL-00526_0]:checked').val(); 
      

        if(ff00525_0=='No' && ff00526_0=='No'){
         
            $(".submitForm").attr("style",'display:inline-block;');
            $(".next_btn").attr("style",'display:none;');
        }else{
         
            $(".submitForm").attr("style",'display:none;');
            $(".next_btn").attr("style",'display:inline-block;');
        }
    } 
$("<div class='col-md-12' id='form2regisaddtitle' style='margin-top:10px;'><strong>Address of Registered office:</strong></div>").insertBefore("#div_UK-FCL-00340_0");
$("<div class='col-md-12' id='form2mailaddtitle' style='margin-top:10px;'><strong>Mailing Address:</strong></div>").insertBefore("#div_UK-FCL-00342_0");
   
   $("<div class='col-md-12' id='form2preaddtitle' style='margin-top:10px;'><strong>If change of address, give previous address of registered office:</strong></div>").insertBefore("#div_UK-FCL-00528_0");


   // country and state/parish code dependency  form 3
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
 $("#UK-FCL-00340_0").attr("maxLength","200");
   $("#UK-FCL-00341_0").attr("maxLength","200");
   $("#UK-FCL-00342_0").attr("maxLength","200");
   $("#UK-FCL-00343_0").attr("maxLength","200");
   $("#UK-FCL-00528_0").attr("maxLength","200");
   $("#UK-FCL-00529_0").attr("maxLength","200");

// form 6 validation

  
 function showappoint(){
        /*$("#div_UK-FCL-00132_0, #div_UK-FCL-00105_0, #middlenamecheckbox00105_0_div, #div_UK-FCL-00106_0, #div_UK-FCL-00093_0, #div_UK-FCL-00238_0, #div_UK-FCL-00096_0, #div_UK-FCL-00129_0, #div_UK-FCL-00310_0, #div_UK-FCL-00094_0, #div_UK-FCL-00137_0").show();*/
        $("#title_UK-FCL-00150_0").closest("div.form-part").show();
    } 
   function hideappoint(){
    /*$("#div_UK-FCL-00132_0, #div_UK-FCL-00105_0, #middlenamecheckbox00105_0_div, #div_UK-FCL-00106_0, #div_UK-FCL-00093_0, #div_UK-FCL-00238_0, #div_UK-FCL-00096_0, #div_UK-FCL-00129_0, #div_UK-FCL-00310_0, #div_UK-FCL-00094_0, #div_UK-FCL-00137_0").hide();*/
    $("#title_UK-FCL-00150_0").closest("div.form-part").hide();
    } 
    function showcess(){
        $("#title_UK-FCL-00301_0").closest("div.form-part").show();
    } 
    function hidecess(){
        $("#title_UK-FCL-00301_0").closest("div.form-part").hide();
    } 
    function showpresent(){
        $("#title_UK-FCL-00172_0").closest("div.form-part").show();
    } 
    function hidepresent(){
        $("#title_UK-FCL-00172_0").closest("div.form-part").hide();
    }

  var maxchars_0 = 4000;
      $('#UK-FCL-00663_0').keyup(function () {
          var tlength = $(this).val().length;
          $(this).val($(this).val().substring(0, maxchars_0));
          var tlength = $(this).val().length;
          remain = maxchars_0 - parseInt(tlength);
          $(".char_validation_1").remove();
          if(remain == 0){
            $("#UK-FCL-00663_0-error").parent('div').append("<div style='color:red;'  class='form-control-feedback-error char_validation_1'>In case the text exceeds 4000 characters, please attach a schedule in prescribed format to this Form under document listing tab at the end.</div>");
            return false;
          }
      });

   // country and state/parish code dependency  form 6
        $("#UK-FCL-00320_0").on('change', function() {
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
   

















   function inarray(arr,index)
   {
      if(arr.indexOf(index)!=-1)
      {
         return 1
      }
      else{
         return 0
      }
 
   }
   
   //$("a.back_btn").css('visibility', 'hidden');
   $(".chk_UK-FCL-00370_0").removeAttr('required',false);

$("#UK-FCL-00197_0, #UK-FCL-00503_0, #UK-FCL-00667_0").attr('readonly',true);

$('#UK-FCL-00583_0').attr('placeholder', 'Please Select');


$("#UK-FCL-00583_0 option[value='']").remove();

$('#UK-FCL-00198_0').attr('placeholder', 'Please Select');


$("#UK-FCL-00198_0 option[value='']").remove();

$('#UK-FCL-00093_0,#UK-FCL-00238_0,#UK-FCL-00094_0,#UK-FCL-00132_0,#UK-FCL-00105_0,#UK-FCL-00106_0').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });

$('#UK-FCL-00340_0,#UK-FCL-00341_0,#UK-FCL-00346_0,#UK-FCL-00342_0,#UK-FCL-00343_0,#UK-FCL-00350_0').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });


$('#UK-FCL-00150_0,#UK-FCL-00133_0,#UK-FCL-00134_0,#UK-FCL-00107_0,#UK-FCL-00335_0,#UK-FCL-00354_0').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });


  var ff00114 = $('input[name=UK-FCL-00230_0]:checked').val();
   if(ff00114 =='Yes'){
      $("#div_UK-FCL-00664_0").show();

      if($('.chk_UK-FCL-00664_0 ')[0].checked){
         $("#div_UK-FCL-00671_0").show();
        console.log(ff00114);
      }else{
      console.log("else" + ff00114);

         $("#div_UK-FCL-00671_0").hide();
      }
   }else{
      $("#div_UK-FCL-00664_0").hide();
      $(".chk_UK-FCL-00664_0 ").prop('checked', false);
      $("#div_UK-FCL-00671_0").hide();    
   }
$("#UK-FCL-00528_0").attr("readonly",true);
   $("#UK-FCL-00529_0").attr("readonly",true);
   $("#UK-FCL-00531_0").attr("readonly",true);
   $("#UK-FCL-00532_0").attr("readonly",true);
   $("#UK-FCL-00395_0").attr("readonly",true);


 $("#UK-FCL-00301_0,#UK-FCL-00466_0,#UK-FCL-00419_0,#UK-FCL-00169_0,#UK-FCL-00353_0,#UK-FCL-00357_0,#UK-FCL-00372_0,#UK-FCL-00399_0,#UK-FCL-00356_0,#UK-FCL-00304_0,#UK-FCL-00172_0,#UK-FCL-00316_0,#UK-FCL-00423_0,#UK-FCL-00308_0,#UK-FCL-00390_0,#UK-FCL-00453_0,#UK-FCL-00400_0,#UK-FCL-00382_0,#UK-FCL-00455_0,#UK-FCL-00461_0").attr("readonly",true);


   $("#UK-FCL-00290_0").on("blur",function(){
      var reg_no = $(this).val();   
            $.ajax({
                  type: "POST",
                  dataType:'json',
                  url: "/backoffice/infowizardtwo/subFormArticlesofReOrganisationArrangementofSocietyForm20/getsocietyNameByregno/reg_no/" + reg_no,
                  beforeSend:function(){
                     $("#UK-FCL-00290_0-error").text("Please wait...");                
                  },
                  success: function(result) {                     
                     if(result.status==true){                        
                           $("#UK-FCL-00290_0-error").text("");               
                            $("#UK-FCL-00197_0").val(result.cname);
                             
                            $("#UK-FCL-00665_0").val(result.carryon);   
                            $("#UK-FCL-00233_0").val(result.otherprovisions);
                            $("#UK-FCL-00200_0").val(result.durationofsociety);
							       $("#UK-FCL-00365_0").val(result.noclassquota).trigger("change");
                            

                            $("#UK-FCL-00528_0").val(result.add1);     
                            $("#UK-FCL-00529_0").val(result.add2);     
                            $("#UK-FCL-00531_0").val (result.parish);     
                            $("#UK-FCL-00532_0").val(result.postal);

                            $("#UK-FCL-00533_0").on("change",function(){
                              if($(this).val() == 'Notice of Change (Appointment of Managers(s))'){
                                 //cessaction
                                 // $('#add_more_3190').hide();
                                 $('#tbl_4592').hide();
                                 // $('#tbl_3190').find('tbody').empty();
                                 // $(result.cessation_table).appendTo($('#tbl_3190')); 
                              }
                              
                              else{
                                 
                                  //present
                                  $('#add_more_4592').show();
                                  $('#tbl_4592').show();
                                  $('#tbl_4592').find('tbody').empty();
                                  $(result.present_table).appendTo($('#tbl_4592'));
                                       
                                  //cessaction
                                  $('#add_more_4593').show();
                                  $('#tbl_4593').show();
                                  $('#tbl_4593').find('tbody').empty();
                                  $(result.cessation_table).appendTo($('#tbl_4593')); 
                              }
                            });



                            
                           
                          
                                                               
                     }else{
                        $("#UK-FCL-00290_0-error").text(result.msg);                     
                        $("#UK-FCL-00197_0").val("");     
                                        
                     }
                    
                  }
              });
             
   });

   var ff331 = $("#UK-FCL-00132_0").val();
   if(ff331){
            $("#div_UK-FCL-00132_0, .agentdetail").show();
            $("#div_UK-FCL-00105_0").show();
            $("#div_UK-FCL-00106_0").show();
            $("#div_UK-FCL-00104_0").show();
            $("#div_UK-FCL-00309_0").show();
            $("#div_UK-FCL-00336_0").show();     
            $("#div_UK-FCL-00228_0").show();
            $("#div_UK-FCL-00242_0").show(); 
            $("#div_UK-FCL-00295_0").show();
         
         
            getcomapnyname(ff331);
               
   }else{
         $("#div_UK-FCL-00132_0, .agentdetail").hide();
            $("#div_UK-FCL-00105_0").hide();
            $("#div_UK-FCL-00106_0").hide();
            $("#div_UK-FCL-00104_0").hide();
            $("#div_UK-FCL-00309_0").hide();
            $("#div_UK-FCL-00336_0").hide();     
            $("#div_UK-FCL-00228_0").hide();
            $("#div_UK-FCL-00242_0").hide(); 
            $("#div_UK-FCL-00295_0").hide();  
   }

   $('input[name=UK-FCL-00362_0]').change(function(){    
      if($(this).val()=="Yes"){
      $("#div_UK-FCL-00132_0, .agentdetail").show();
          $("#div_UK-FCL-00105_0").show();
            $("#div_UK-FCL-00106_0").show();
            $("#div_UK-FCL-00104_0").show();
            $("#div_UK-FCL-00309_0").show();
            $("#div_UK-FCL-00336_0").show();     
            $("#div_UK-FCL-00228_0").show();
            $("#div_UK-FCL-00242_0").show(); 
            $("#div_UK-FCL-00295_0").show();     
      }else{
         $("#div_UK-FCL-00132_0, .agentdetail").hide();
          $("#div_UK-FCL-00105_0").hide();
            $("#div_UK-FCL-00106_0").hide();
            $("#div_UK-FCL-00104_0").hide();
            $("#div_UK-FCL-00309_0").hide();
            $("#div_UK-FCL-00228_0").hide();     
            $("#div_UK-FCL-00336_0").hide();
            $("#div_UK-FCL-00242_0").hide(); 
            $("#div_UK-FCL-00295_0").hide();           
   
            $("#div_UK-FCL-00132_0").val("");
            $("#div_UK-FCL-00105_0").val("");
            $("#div_UK-FCL-00106_0").val("");
            $("#div_UK-FCL-00104_0").val("");
            $("#div_UK-FCL-00309_0").val("");
            $("#div_UK-FCL-00336_0").val("");    
            $("#div_UK-FCL-00228_0").val("");
            $("#div_UK-FCL-00242_0").val(""); 
            $("#div_UK-FCL-00295_0").val("");
         
      }
   });

$("<div class='row regoffice'><div class='col-lg-12'><strong>The registered office of the Society in Barbados:</strong></div></div><br>").insertBefore("#div_UK-FCL-00093_0");
$("<div class='row agentdetail'><div class='col-lg-12'><strong>The details of the Society’s agent in Barbados:</strong></div></div><br>").insertBefore("#div_UK-FCL-00132_0");
$("<div class='row maxquotas'><div class='col-lg-12'><strong>The classes and maximum number of Quotas that the Society is authorised to issue:</strong></div></div><br>").insertBefore("#div_UK-FCL-00367_0");



   var ff501 = $("#UK-FCL-00583_0").val();
   if(ff501){
   //alert(ff416)
   //hideonchange();
   manupulatefields(ff501); 
   }
   $("#UK-FCL-00583_0").on("change",function(){
     if($(this).val()){
       var step_data = $(this).val();
       manupulatefields($(this).val());

       var reg_no = $("#UK-FCL-00290_0").val(); 
      $.ajax({
            type: "POST",
            dataType:'json',
            url: "/backoffice/infowizardtwo/subFormArticlesofReOrganisationArrangementofSocietyForm20/getsocietyNameByregno/reg_no/" + reg_no,
            beforeSend:function(){
               $("#UK-FCL-00290_0-error").text("");                  
            },
            success: function(result) {                     
               if(result.status==true){                        
                     var arr = [step_data];
                  // console.log(arr);
               if(arr.length > 0){
                     if(inarray(arr[0],"Name of the Society")){
                        one_show(); 
                     }else{
                        one_hide();
                     }
                     
                     if(inarray(arr[0],"Business Activity/Purpose of Society")){
                        two_show(); 
                     }else{
                        two_hide();
                     }
                     if(inarray(arr[0],"Duration of the Society")){
                        three_show(); 
                     }else{
                        three_hide();
                     }
                     if(inarray(arr[0],"Registered office of the Society")){
                        four_show(); 
                     }else{
                        four_hide();
                     }
                     if(inarray(arr[0],"Registered Agent")){
                        five_show(); 
                     }else{
                        five_hide();
                     }
                     if(inarray(arr[0],"Details of quotas and quota transfer")){
                        $('#add_more_4356').show();
                        $('#tbl_4356').show();
                        $('#tbl_4356').find('tbody').empty();
                        $(result.managerDetails).appendTo($('#tbl_4356'));
                        six_show(); 
                     }else{
                        six_hide();
                        $('#add_more_4356').hide();
                        $('#tbl_4356').hide();
                     }
                     if(inarray(arr[0],"Business of the Society")){
                        seven_show(); 
                     }else{
                        seven_hide();
                     }
                     if(inarray(arr[0]," Other Provisions")){
                        eight_show(); 
                     }else{
                        eight_hide();
                     }
                        
                                                         
               }else{
                  $("#UK-FCL-00290_0-error").text(result.msg);
               
                  $("#UK-FCL-00197_0").val("");                   
               }
            }
               console.log(result);
            }
        });

     }
    
   });

   function manupulatefields(ff501){
        var myarr = ff501.toString().split(",");
       
    
      if (myarr.includes('Name of the Society')) {
         one_show();
       }else{
          one_hide();
       }

        if (myarr.includes('Business Activity/Purpose of Society')) {
         two_show();
       }else{
          two_hide();
       }

       if (myarr.includes('Duration of the Society')) {
         three_show();
       }else{
          three_hide();
       }

       if (myarr.includes('Registered office of the Society')) {
         four_show();
       }else{
          four_hide();
       }

       if (myarr.includes('Registered Agent')) {
         five_show();
       }else{
          five_hide();
       }

       if (myarr.includes('Details of quotas and quota transfer')) {
         six_show();
       }else{
          six_hide();
       }

       if (myarr.includes('Business of the Society')) {
         seven_show();
       }else{
          seven_hide();
       }

       if (myarr.includes(' Other Provisions')) {
         eight_show();
       }else{
          eight_hide();
       }

   }
   function one_show(){
       $("#div_UK-FCL-00360_0").show();
       $("#div_UK-FCL-00503_0").show();
   }

   function two_show(){
       $("#div_UK-FCL-00198_0").show();
       $("#div_UK-FCL-00663_0").show();
      
   }

   function three_show(){
        $("#div_UK-FCL-00200_0").show();
      
   }

   function four_show(){
        $("#div_UK-FCL-00093_0, .regoffice").show();
         $("#div_UK-FCL-00238_0").show();
         $("#div_UK-FCL-00310_0").show();
         $("#div_UK-FCL-00337_0").show();
         $("#div_UK-FCL-00094_0").show();
         $("#div_UK-FCL-00096_0").show();
      
   }

   function five_show(){
       $("#div_UK-FCL-00362_0, .agentdetail").show();
     
   }

   function six_show(){
         $("#div_UK-FCL-00365_0").show();
         $("#div_UK-FCL-00367_0, .maxquotas").show();
         $("#div_UK-FCL-00368_0").show();
         $("#div_UK-FCL-00369_0").show();
         $("#div_UK-FCL-00370_0").show();
         $("#div_UK-FCL-00266_0").show();
         $("#div_UK-FCL-00371_0").show();
         $("#div_UK-FCL-00033_0").show();

         $("#div_UK-FCL-00230_0").show();
        
   }

	function seven_show(){
       $("#div_UK-FCL-00665_0").show();
      
	}

   function eight_show(){
       $("#div_UK-FCL-00233_0").show();
      
   }

   //hide functions
   function one_hide(){
       $("#div_UK-FCL-00360_0").hide();
       $("#div_UK-FCL-00503_0").hide();
   }

   function two_hide(){
       $("#div_UK-FCL-00198_0").hide();
       $("#div_UK-FCL-00663_0").hide();
     
   }

   function three_hide(){
       $("#div_UK-FCL-00200_0").hide();

   }

   function four_hide(){
       $("#div_UK-FCL-00093_0, .regoffice").hide();
   
         $("#div_UK-FCL-00238_0").hide();
         $("#div_UK-FCL-00310_0").hide();
         $("#div_UK-FCL-00337_0").hide();
         $("#div_UK-FCL-00094_0").hide();
         $("#div_UK-FCL-00096_0").hide();
   
            $("#div_UK-FCL-00132_0, .agentdetail").hide();
            $("#div_UK-FCL-00105_0").hide();
            $("#div_UK-FCL-00106_0").hide();
            $("#div_UK-FCL-00104_0").hide();
            $("#div_UK-FCL-00309_0").hide();
            $("#div_UK-FCL-00336_0").hide();     
            $("#div_UK-FCL-00228_0").hide();
            $("#div_UK-FCL-00242_0").hide(); 
            $("#div_UK-FCL-00295_0").hide();            
            
   
            $("#div_UK-FCL-00132_0").val("");
            $("#div_UK-FCL-00105_0").val("");
            $("#div_UK-FCL-00106_0").val("");
            $("#div_UK-FCL-00104_0").val("");
            $("#div_UK-FCL-00309_0").val("");
            $("#div_UK-FCL-00336_0").val("");    
            $("#div_UK-FCL-00228_0").val("");
            $("#div_UK-FCL-00242_0").val(""); 
            $("#div_UK-FCL-00295_0").val("");
   
            $("#UK-FCL-00093_0").val("");
            $("#UK-FCL-00238_0").val("");
            $("#UK-FCL-00337_0").val("");    
       
   }

   function five_hide(){
       $("#div_UK-FCL-00362_0, .agentdetail").hide();

       $("input:radio[name='UK-FCL-00362_0']").each(function(i) {
              this.checked = false;
       });
      
   }

   function six_hide(){
         $("#div_UK-FCL-00365_0").hide();
         $("#div_UK-FCL-00367_0, .maxquotas").hide();
         $("#div_UK-FCL-00368_0").hide();
         $("#div_UK-FCL-00369_0").hide();
         $("#div_UK-FCL-00370_0").hide();
         $("#div_UK-FCL-00266_0").hide();
         $("#div_UK-FCL-00371_0").hide();
         $("#div_UK-FCL-00033_0").hide();

          $("#div_UK-FCL-00664_0").hide();
           $("#div_UK-FCL-00671_0").hide();

         $("#div_UK-FCL-00230_0").hide();
        // $("#div_UK-FCL-00664_0").hide();
   }

   function seven_hide(){
       $("#div_UK-FCL-00665_0").hide();
    
   }

   function eight_hide(){
       $("#div_UK-FCL-00233_0").hide();
    
   }
   

   $("#UK-FCL-00360_0").on("blur",function(){
      var srn_no = $(this).val();
      getcomapnyname(srn_no);
          
   });



      $("#UK-FCL-00533_0").on("change",function(){
    var val533 = $(this).val();

  
      if(val533=='Notice of Change (Appointment of Managers(s))'){
         $("#div_UK-FCL-00395_0").show();
         showappoint(); 
          hidecess();
         showpresent(); 
      }
      if(val533=='Notice of Change (Cessation of Managers(s))'){
         $("#div_UK-FCL-00395_0").show();
         hideappoint();
         showcess(); 
         showpresent();
      }
      if(val533=='Notice of Change (Appointment and Cessation of Managers(s))'){
         $("#div_UK-FCL-00395_0").show();
         showappoint(); 
         showcess();
         showpresent(); 
      }

   });



   var maxchars = 2000;
   $('#UK-FCL-00663_0').keyup(function () {
       var tlength = $(this).val().length;
       $(this).val($(this).val().substring(0, maxchars));
       var tlength = $(this).val().length;
       remain = maxchars - parseInt(tlength);
       $(".char_validation_1").remove();
       if(remain == 0){
         $("#UK-FCL-00663_0-error").parent('div').append("<div style='color:red;'  class='form-control-feedback-error char_validation_1'>Only 2000 characters can be inserted in this field. In case you want to provide additional information, then please attach a schedule in required format  under document listing page at the end.</div>");
         return false;
       }
   });

   $("#UK-FCL-00096_0,#UK-FCL-00310_0,#UK-FCL-00295_0").prop('readonly',true); 
   $("#UK-FCL-00096_0").val("BARBADOS");  

   $("#div_UK-FCL-00105_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox00105_0' name='middlenamecheckbox00105_0' class='group1'> I do not have a middle name or middle initial</div>");
      $("#UK-FCL-00105_0").blur(function(){
         if($(this).val()){
            $("input[name=middlenamecheckbox00105_0]").prop('checked', false);   
         }
      });
   $("input[name=middlenamecheckbox00105_0]").change(function(){
      if($(this).val()){
         $("#UK-FCL-00105_0").val("");
      }
   });
      $('#middlenamecheckbox00105_0').change(function(){

           if($("#middlenamecheckbox00105_0").prop('checked') == true){


            $("#UK-FCL-00105_0").prop('readonly',true);

           }else{

             $("#UK-FCL-00105_0").prop('readonly',false);

           }

      });

      $("#div_UK-FCL-00133_0").append("<div class='col-md-12' style='margin-top:10px;'><input type='checkbox' id='middlenamecheckbox00133_0' name='middlenamecheckbox00133_0' class='group1'> I do not have a middle name or middle initial</div>");
      $("#UK-FCL-00133_0").blur(function(){
         if($(this).val()){
            $("input[name=middlenamecheckbox00133_0]").prop('checked', false);   
         }
      });
   $("input[name=middlenamecheckbox00133_0]").change(function(){
      if($(this).val()){
         $("#UK-FCL-00133_0").val("");
      }
   });
      $('#middlenamecheckbox00133_0').change(function(){

           if($("#middlenamecheckbox00133_0").prop('checked') == true){


            $("#UK-FCL-00133_0").prop('readonly',true);

           }else{

             $("#UK-FCL-00133_0").prop('readonly',false);

           }

      });

    var f0362_0 = $('input[name=UK-FCL-00362_0]:checked').val();
    if(f0362_0=='Yes'){
            $("#UK-FCL-00104_0").val($("#UK-FCL-00093_0").val());
            $("#UK-FCL-00309_0").val($("#UK-FCL-00238_0").val());
   
            $("#UK-FCL-00295_0").val(829).trigger("change");    
            $("#UK-FCL-00228_0").val($("#UK-FCL-00337_0").val()).trigger("change");       
   
            $("#UK-FCL-00336_0").val($("#UK-FCL-00310_0").val());
            $("#UK-FCL-00242_0").val($("#UK-FCL-00094_0").val());  
   
            $("#UK-FCL-00104_0, #UK-FCL-00295_0, #UK-FCL-00309_0, #UK-FCL-00336_0,  #UK-FCL-00242_0").prop('readonly',true);
   
            $("#UK-FCL-00295_0,#input_UK-FCL-00228_0").css('pointer-events','none');
            $("#UK-FCL-00295_0,#input_UK-FCL-00228_0").css('background-color','#e9ecef');                  
   
    }


   $("input[name=UK-FCL-00362_0]").on("change",function(){ 
          if($(this).val()=='Yes'){
            $("#UK-FCL-00104_0").val($("#UK-FCL-00093_0").val());
            $("#UK-FCL-00309_0").val($("#UK-FCL-00238_0").val());
   
            $("#UK-FCL-00295_0").val(829).trigger("change");    
            $("#UK-FCL-00228_0").val($("#UK-FCL-00337_0").val()).trigger("change");                     
   
            $("#UK-FCL-00336_0").val($("#UK-FCL-00310_0").val());
            $("#UK-FCL-00242_0").val($("#UK-FCL-00094_0").val());  
          
            $("#UK-FCL-00104_0, #UK-FCL-00295_0, #UK-FCL-00309_0, #UK-FCL-00336_0, #UK-FCL-00242_0").prop('readonly',true);   
    
            $("#UK-FCL-00295_0,#input_UK-FCL-00228_0").css('pointer-events','none');
            $("#UK-FCL-00295_0,#input_UK-FCL-00228_0").css('background-color','#e9ecef');  
           
   
          }else{
   
            $("#getcontrystate").html("");
            $("#UK-FCL-00351_0, #UK-FCL-00228_0").val("").trigger("change");
            $("#UK-FCL-00342_0, #UK-FCL-00343_0, #UK-FCL-00336_0, #UK-FCL-00242_0").val("");
   
            $("#UK-FCL-00342_0, #UK-FCL-00343_0, #UK-FCL-00336_0, #UK-FCL-00242_0").prop('readonly',false);
            $("#UK-FCL-00351_0").prop('disabled',false);
   
            $("#UK-FCL-00295_0,#input_UK-FCL-00228_0").css('pointer-events','none');
            $("#UK-FCL-00295_0,#input_UK-FCL-00228_0").css('background-color','#e9ecef');
   
            
   
          }
    });



   var maxchars_0 = 4000;
      $('#UK-FCL-00671_0').keyup(function () {
          var tlength = $(this).val().length;
          $(this).val($(this).val().substring(0, maxchars_0));
          var tlength = $(this).val().length;
          remain = maxchars_0 - parseInt(tlength);
          $(".char_validation_1").remove();
          if(remain == 0){
            $("#UK-FCL-00671_0-error").parent('div').append("<div style='color:red;'  class='form-control-feedback-error char_validation_1'>In case the text exceeds 4000 characters, please attach a schedule in prescribed format to this Form under document listing tab at the end.</div>");
            return false;
          }
      });

      // var maxchars_0 = 100;
      //    $('#UK-FCL-00668_0').keyup(function () {
      //        var tlength = $(this).val().length;
      //        $(this).val($(this).val().substring(0, maxchars_0));
      //        var tlength = $(this).val().length;
      //        remain = maxchars_0 - parseInt(tlength);
      //        $(".char_validation_1").remove();
      //        if(remain == 0){
      //          $("#UK-FCL-00668_0-error").parent('div').append("<div style='color:red;'  class='form-control-feedback-error char_validation_1'>Text Box to have a text limit of 100 characters</div>");
      //          return false;
      //        }
      //    });
   // var maxchars_0 = 4000;
   //    $('#UK-FCL-00371_0').keyup(function () {
   //        var tlength = $(this).val().length;
   //        $(this).val($(this).val().substring(0, maxchars_0));
   //        var tlength = $(this).val().length;
   //        remain = maxchars_0 - parseInt(tlength);
   //        $(".char_validation_1").remove();
   //        if(remain == 0){
   //          $("#UK-FCL-00371_0-error").parent('div').append("<div style='color:red;'  class='form-control-feedback-error char_validation_1'>In case the text exceeds 4000 characters, please attach a schedule in prescribed format to this Form under document listing tab at the end.</div>");
   //          return false;
   //        }
   //    });

   var maxchars_0 = 100;
      $('#UK-FCL-00126_0').keyup(function () {
          var tlength = $(this).val().length;
          $(this).val($(this).val().substring(0, maxchars_0));
          var tlength = $(this).val().length;
          remain = maxchars_0 - parseInt(tlength);
          $(".char_validation_1").remove();
          if(remain == 0){
            $("#UK-FCL-00126_0-error").parent('div').append("<div style='color:red;'  class='form-control-feedback-error char_validation_1'>Max characters limit 100.</div>");
            return false;
          }
      });




    


});



function addmorebtnchecksharecapitaldetail(){
   var nofapp = $("#UK-FCL-00365_0").val();

   var totalRowCount = 0;          
      totalRowCount =  $("#tbl_4356 td").closest("tr").length;
   if(nofapp<=totalRowCount){
      /*$("#title_UK-FCL-00262_0").append("<b style='color:red;' class='amalgamatingDetail'>Please Add Number of Shares Capital Details as Per Enter 'No. of classes of shares' Field.</b>");*/
      var scdem = "Please Add Number of Quota Details as Per Enter 'No. of classes of Quota' Field."; 
                  if ($("#scd").length) {
                     $("#scd").text(scdem);
                  }else{
                     $("#title_UK-FCL-00365_0").append('<b style="color:red;" id="scd">'+scdem+'</b>');
                  }  
         var titleTot = jQuery("#title_UK-FCL-00365_0").offset().top;
         var addHeight = parseInt(titleTot) - 170;
         jQuery('html,body').animate({ scrollTop: addHeight}, 1000);
         e.stop();
         e.preventDefault();
         return false;
   }
   else{
      $("#scd").text("");
      return true;   
   }
}



 function addmoreaction(id,service_id,div_id){
     
   if(div_id==4356){
      var respon = addmorebtnchecksharecapitaldetail();
      if(respon==false){
         return false;
      }
   }else{
      if(div_id==2015){
         var respon = addmorebtncheckmanagersdetail();
         if(respon==false){
            return false;
         }
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
          var RandomString =  1 + Math.floor(Math.random() * 6);
          var amm = `${RandomString} del_${RandomString}`;

         var tr_ = "<tr class='add_more_" +amm+"' >";
         var tr1_ = "<tr class='add_more_" +amm+"' >";
         var td_ = '';
         var td1_ = '';
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
               if(div_id==4393){                           
                   if(formchk_id=='UK-FCL-00133_0'){
                       var mnt = $("#UK-FCL-00133_0").val();
                       if(mnt){
                           var checkfield = true;
                       }else{
                           var mncb = $('input[name=middlenamecheckbox00133_0]:checked').val(); 
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
                
            
               if(div_id==4356){
                   console.log(formchk_id);
                     if(formchk_id=='UK-FCL-00367_0' || formchk_id=='UK-FCL-00368_0' || formchk_id=='UK-FCL-00369_0'  || formchk_id=='UK-FCL-00371_0'){
                           var labelData = $("#label_" + formchk_id).text();
                        labelData=labelData.replace('('+formchk_id+')',"");
                        //alert(formchk_id);
                        $("#div_"+formchk_id).append("<span style='color:red;' class='errorDetail'>This field is required</span>");                
                        err = err + 1;
                        return false;
                        }else{
                           $(".errorDetail").remove();
                           td_ += "<td><input type='text' name='" + formchk_id + "[]'  value='" + vall + "' class='form-control' readonly/></td>";
                           td1_ += "<td><input type='text' name='" + formchk_id + "1[]'  value='" + vall + "' class='form-control' readonly/></td>";
                                    fieldsIDArr.push(formchk_id);    
                        }  
               }

           
            count = 0;
            if(div_id==4393){
                console.log(formchk_id);
                  if(formchk_id=='UK-FCL-00150_0' ||  formchk_id=='UK-FCL-00134_0' ||   formchk_id=='UK-FCL-00107_0' ||  formchk_id=='UK-FCL-00320_0' ||  formchk_id=='UK-FCL-00129_0' ||  formchk_id=='UK-FCL-00137_0'){
                        var labelData = $("#label_" + formchk_id).text();
                     labelData=labelData.replace('('+formchk_id+')',"");
                     //alert(formchk_id);
                     
                     $("#div_"+formchk_id).append("<span style='color:red;' class='errorDetail'>This field is required</span>");                
                     err = err + 1;
                     return false;
                     }else{
                        $(".errorDetail").remove();
                        td_ += "<td><input type='text' name='" + formchk_id + "[]' id='a_"+count+"' value='" + vall + "' class='form-control' readonly/></td>";
                        td1_ += "<td><input type='text' name='" + formchk_id + "1[]' id='a_"+count+"' value='" + vall + "' class='form-control' readonly/></td>";
                                 fieldsIDArr.push(formchk_id);    
                     }  
            }

                 ++count;
            if(div_id==4593){
                console.log(formchk_id);
                  if(formchk_id=='UK-FCL-00301_0' ||  formchk_id=='UK-FCL-00419_0' ||   formchk_id=='UK-FCL-00169_0' ||  formchk_id=='UK-FCL-00357_0' ||  formchk_id=='UK-FCL-00372_0' ||  formchk_id=='UK-FCL-00304_0'){
                        var labelData = $("#label_" + formchk_id).text();
                     labelData=labelData.replace('('+formchk_id+')',"");
                     //alert(formchk_id);
                     
                     $("#div_"+formchk_id).append("<span style='color:red;' class='errorDetail'>This field is required</span>");                
                     err = err + 1;
                     return false;
                     }else{
                        $(".errorDetail").remove();
                        td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
                        td1_ += "<td><input type='text' name='" + formchk_id + "1[]' value='" + vall + "' class='form-control' readonly/></td>";
                                 fieldsIDArr.push(formchk_id);    
                     }  
            }

            if(div_id==4592){
                console.log(formchk_id);
                  if(formchk_id=='UK-FCL-00172_0' ||  formchk_id=='UK-FCL-00423_0' ||   formchk_id=='UK-FCL-00308_0' ||  formchk_id=='UK-FCL-00453_0' ||  formchk_id=='UK-FCL-00400_0' ||  formchk_id=='UK-FCL-00461_0'){
                        var labelData = $("#label_" + formchk_id).text();
                     labelData=labelData.replace('('+formchk_id+')',"");
                     //alert(formchk_id);
                     
                     $("#div_"+formchk_id).append("<span style='color:red;' class='errorDetail'>This field is required</span>");                
                     err = err + 1;
                     return false;
                     }else{
                        $(".errorDetail").remove();
                        td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
                        td1_ += "<td><input type='text' name='" + formchk_id + "1[]' value='" + vall + "' class='form-control' readonly/></td>";
                                 fieldsIDArr.push(formchk_id);    
                     }  
            }

            }
            else {
               $(".errorDetail").remove();
               //console.log(typeVal);
               td_ += "<td><input type='text' name='" + formchk_id + "[]'  value='" + vall + "' class='form-control' readonly/></td>";
               td1_ += "<td><input type='text' name='" + formchk_id + "1[]'  value='" + vall + "' class='form-control' readonly/></td>";
               fieldsIDArr.push(formchk_id);                
            }

         }); 

         if (err == 0) {
            //alert(JSON.stringify(fieldsIDArr));
                if(confirm('Before adding, please check whether the details entered is correct.'))
            //var RandomString =  1 + Math.floor(Math.random() * 6);
            if(div_id == '4393'){
               
               $('#add_more_4592').show();//
               $('#add_more_4393').show();//
               $('#tbl_4393').show();//
               $('#tbl_4592').show();//
               
               // td_ = '';
               td_ += "<td style='text-align:center;'><a class='btn btn-danger del_1' id='a_"+RandomString+"' pi='add_more_4592'><i class='fa fa-trash' aria-hidden='true'></i></a></td>";
               td1_ += "<td style='text-align:center;'><a class='btn btn-danger del_1' id='a_"+RandomString+"' pi='add_more_4592'><i class='fa fa-trash' aria-hidden='true'></i></a></td>";
               
               // td_ += "<td style='text-align:center;'><a class='btn btn-danger del_1' pi='add_more_3108'><i class='fa fa-trash' aria-hidden='true'></i></a></td>";
               
               tr_ += td_ + "</tr>";
               tr1_ += td1_ + "</tr>";
               
               
               $(tr1_).appendTo($('#tbl_4592'));//

               // let result = tr_.replace("[]", "1");
               $(tr_).appendTo($('#tbl_4393'));//


               <?php
                  define('RANDOM', 0);
               ?>
               
            }else{

            var count = 0;
            $('#add_more_' + div_id).show();
            $('#tbl_' + div_id).show();
            td_ += "<td style='text-align:center;'><a class='btn btn-danger del_1' id='a_"+RandomString+"' pi='add_more_"+div_id+"'><i class='fa fa-trash' aria-hidden='true'></i></a></td>";
            td1_ += "<td style='text-align:center;'><a class='btn btn-danger del_1' id='a_"+RandomString+"' pi='add_more_"+div_id+"'><i class='fa fa-trash' aria-hidden='true'></i></a></td>";
            tr_ += td_ + "</tr>";
            tr1_ += td1_ + "</tr>";
            $(tr_).appendTo($('#tbl_' + div_id));
            $(tr1_).appendTo($('#tbl_' + div_id));
            count++;

         }
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
               let inputid = $(this).attr("id"); 
               let myArray = inputid.split("_");

               if(myArray[0]=='a'){
                  $('.del_'+myArray[1]).remove();
               }
               else if(myArray[0]=='c'){
                $('.del1_'+myArray[1]).remove();
               }
                                               
         });
      } // success function close here
   }); //ajax end here
 }



function getcomapnyname(srn_no){
   if(srn_no!=""){
            $.ajax({
                  type: "POST",
                  dataType:'json',
                  url: "/backoffice/infowizardtwo/subFormArticlesofReOrganisationArrangementofSocietyForm20/getCompanyNameBySrnNo/srn_no/" + srn_no +"/subID/<?= isset($_GET['subID']) ? $_GET['subID'] : NULL ?>",
                  beforeSend:function(){
                     $("#UK-FCL-00088_0-error").text("Please wait...");                
                  },
                  success: function(result) {                     
                     if(result.status==true){
                        if(result.app_status=='valid'){
                           $("#UK-FCL-00503_0").val(result.name);
                           $("#UK-FCL-00360_0-error").html("");                           
                        }else{
                           $("#UK-FCL-00088_0-error").text(result.msg);       
                           if ($("#UK-FCL-00503_0-error").length) {
                           $("#UK-FCL-00503_0-error").text(errormessages.srn_msg001);
                        }else{
                           $("#div_UK-FCL-00503_0").find('div').append('<div  style="color:red;" id="UK-FCL-00503_0-error">'+errormessages.srn_msg001+'<br>'+errormessages.srn_msg002+'</div>');
                        }    

                        $("#UK-FCL-00503_0").val("");  
                        }                                      
                     }else{
                        if(result.user){
                           $("#UK-FCL-00360_0-error").text(result.msg);
                            $("#UK-FCL-00503_0").val("");   
                            $("#UK-FCL-00503_0-error").text("");
                        }else{
                           //alert(result.msg);
                        }                                         
                     }
                   //  console.log(result);
                  }
              });
      }  
}

</script>