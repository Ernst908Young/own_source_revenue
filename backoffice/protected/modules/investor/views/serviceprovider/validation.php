<script type="text/javascript">

   $(document).ready(function () {

    var date = new Date();
    date.setDate(date.getDate());
    $(".datepicker").datepicker({
      changeMonth: true,
      changeYear: true,
      maxDate: date,
      dateFormat: 'dd-mm-yy'
    });

      var at_ch_box_v = $('input[name=at_ch_box]:checked').val();
      if(at_ch_box_v){        
        $("#sp_type_div").removeClass('hidden');      
      }else{       
        $("#sp_type_div").addClass('hidden');  
      } 

  $("input[name=at_ch_box]").on("change",function(){     
      if($(this).val()){        
        $("#sp_type_div").removeClass('hidden');      
      }else{       
        $("#sp_type_div").addClass('hidden');  
      }   
  });

  var sp_ch_box_v = $('input[name=sp_ch_box]:checked').val();
      if(sp_ch_box_v==1){        
        $("#exist_sp_form, #comman_sp_form").removeClass('hidden');     
        $("#new_sp_form").addClass('hidden');       
      }else{       
        $("#new_sp_form, #comman_sp_form").removeClass('hidden');
        $("#exist_sp_form").addClass('hidden');       
      } 
  
  $("input[name=sp_ch_box]").on("change",function(){     
      if($(this).val()==1){   
        $("#exist_sp_form, #comman_sp_form").removeClass('hidden');     
        $("#new_sp_form").addClass('hidden');
        $("#e_name, #e_type").val("");
        $('#first_name').val("");
      }else{
        $("#new_sp_form, #comman_sp_form").removeClass('hidden');
        $("#exist_sp_form").addClass('hidden');  
        $("#serviceprovider_user_id").val("").trigger("change");
      }   
  });


 var sp_type_v = $('input[name=sp_type]:checked').val();
 if(sp_type_v){
     if(sp_type_v=="Corporate Representative (CR)"){
        $("#app_entity_type_div").addClass("hidden");
        $("input[name=app_entity_type_id]").prop('checked', false); 
        $(".rt_sp").text("Corporate Representative (CR)");
     }else{
        $("#app_entity_type_div").removeClass("hidden");
        $(".rt_sp").text("Corporate Trust Service Provider (CTSP)");
     }
     
      $("#sp_ch_box_div").removeClass("hidden");
      documentsh_initially(); 
 }


   $("input[name=sp_type]").on("change",function(){     
      if($(this).val()=='Corporate Representative (CR)'){   
        $("#app_entity_type_div").addClass("hidden");
        $("input[name=app_entity_type_id]").prop('checked', false); 
        $(".rt_sp").text("Corporate Representative (CR)");
      }else{ //Corporate Trust Service Provider (CTSP)
        $("#app_entity_type_div").removeClass("hidden");
        $(".rt_sp").text("Corporate Trust Service Provider (CTSP)");
      }   
      getsplist($(this).val());
       $("#sp_ch_box_div").removeClass("hidden");
       documentsh();     
       $('#entity_id').val("").trigger("change");
       $('#match_date, #late_fee').val("");


  });

$("input[name=app_entity_type_id]").on("change",function(){     
  if($(this).val()==1){
    var ec = 'EC';
  }else{
    ec = 'ALL';
  }

  $.ajax({
            type: "POST",
            url: "/backoffice/investor/serviceprovider/getentity/ec/" + ec,
            success: function(result) {               
              $("#entity_id").html(result);        
            }
        });

   documentsh();  
    $('#entity_id').val("").trigger("change");
    $('#match_date, #late_fee').val("");
});

var en = $('#ind_ent').val();
if(en){
  if(en=="Entity"){
        $("#div_e_name, #div_e_type").removeClass("hidden");
    }else{
        $("#div_e_name, #div_e_type").addClass("hidden");
       
    }
}

var c_id = $('#country_id').val();
if(c_id){
  if(c_id=='829'){
     $("#city").attr("readonly",true);
    }else{
      $("#city").attr("readonly",false);
    }
}

var inexsp = $('#serviceprovider_user_id').val();
if(inexsp){
  spchange(inexsp);
}


  $("#middle_name").blur(function(){
    if($(this).val()){
      $("input[name=middlenamecheckbox]").prop('checked', false); 
    }
  });

$("input[name=middlenamecheckbox]").change(function(){
  if($(this).is(':checked')){
    $("#middle_name").val("");
    $("#middle_name").attr('readonly',true);   
  }else{
    $("#middle_name").attr('readonly',false);
  }
});

$("#mobile").bind("keypress",function(){
  var regex=  new RegExp("^[0-9()]*$"); //;
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        return false;
    }
});



  $("#email").blur(function(){
    checkemailexits();    
});



  $("#input-id").fileinput({
    uploadUrl: "/backoffice/investor/serviceprovider/appfileupload",
     uploadAsync: false,
   
    enableResumableUpload: true,
    showCaption: false,
    showRemove: false,
    showCancel: false,
    showUpload: true,
    allowedFileExtensions: ["png", "jpg", "pdf"],
    resumableUploadOptions: {
      // uncomment below if you wish to test the file for previous partial uploaded chunks
      // to the server and resume uploads from that point afterwards
      // testUrl: "http://localhost/test-upload.php"
    },
    uploadExtraData: {
      'uploadToken': 'SOME-TOKEN', // for access control / security 
      'user_id' : "<?= $user_id ?>",
      'doc_no' : 1
      
    },
   
    initialPreviewAsData: false,
   // initialPreview:'',
   // overwriteInitial: false,

     initialPreview: '<?= $initial_pre ?>',          // if you have previously uploaded preview files
     initialPreviewConfig:[{caption:'Uploaded File'}],    // if you have previously uploaded preview files
    theme: 'fas',
  }).on('fileuploaded', function(event, data) {   
       $("#input-id").attr("required",false);
    });

   $("#input-id2").fileinput({
    uploadUrl: "/backoffice/investor/serviceprovider/appfileupload",
    uploadAsync: false,   
    enableResumableUpload: true,
    showCaption: false,
    showRemove: false,
    showCancel: false,
    showUpload: true,
    allowedFileExtensions: ["png", "jpg", "pdf"],
    resumableUploadOptions: {     
    },
    uploadExtraData: {
      'uploadToken': 'SOME-TOKEN', 
      'user_id' : "<?= $user_id ?>",
      'doc_no' : 2
    },
   
    initialPreviewAsData: false,
    initialPreview: '<?= $initial_pre2 ?>',     
    initialPreviewConfig:[{caption:'Uploaded File'}],  
    theme: 'fas',
  }).on('fileuploaded', function(event, data) {   
       $("#input-id2").attr("required",false);
    });

  $(".kv-fileinput-error, .fileinput-remove").hide();

  });


/*-------------Functions-------------*/

function spchange(sp_id){

  if(sp_id){
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/backoffice/investor/serviceprovider/getspdetails/sp_id/"+sp_id,           
                beforeSend:function(){
                      $("#sp_user_id-error").text("Please wait...");
                      //$("#serviceprovider_user_id-error").text("");
                },
                success: function(result) {    
                if(result.status==false){
                   $("#sp_user_id-error").text("Something went wrong");
                     // $("#serviceprovider_user_id-error").text("Something went wrong");
                }else{
                   $("#sp_user_id-error").text("");
                  var details = result.details;
                  $("#exit_sp_table").html("<div class='form-row row'><div class='col-lg-12'><table class='table table-striped table-bordered table-hover'><tr><td><b>Type of Corporate Representative</b></td><td>"+details.sp_type+"</td><td><b>IUID</b></td><td>"+details.iuid+"</td></tr> <tr><td><b>Full Name</b></td><td>"+details.full_name+"</td> <td><b>Mobile No.</b></td><td>"+details.mobile_number+"</td> </tr>  <tr>  <td><b>Gender</b></td>    <td>"+details.gender+"</td>    <td><b>Email</b></td>    <td><span id='cesp'>"+details.email+"</span></td>  </tr>  <tr>    <td><b>Address Line 1</b></td>    <td>"+details.address+"</td>    <td><b>Address Line 2</b></td>  <td>"+details.address2+"</td>  </tr>  <tr>    <td><b>City</b></td>    <td>"+details.city_name+"</td>    <td><b>State/Parish</b></td>    <td>"+result.state_name+"</td>  </tr>  <tr>    <td><b>Country</b></td>    <td>"+result.country_name+"</td>    <td><b>Postal Code</b></td>    <td>"+details.pin_code+"</td>  </tr>  <tr>    <td><b>Licence Number</b></td>    <td>"+details.lic_no+"</td><td><b>Company / Business Name</b></td>    <td>"+details.entity_name+"</td>     </tr> </table></div></div>");
                }                                   
              }             
            });
        }else{
            $("#exit_sp_table").html("");
        }
}

function getdates(ue_id){
  $("#match_date, #late_fee").val("");

  if(ue_id){
    var et = $('input[name=app_entity_type_id]:checked').val();
    if(et==1){     
      var dof = 'Incorporation of the Company';
       $.ajax({
          type: "POST",
            dataType: 'json',
          url: "/backoffice/investor/serviceprovider/getinorpostdate/dof/"+dof, 
          data:{ue_id:ue_id}, 
           beforeSend:function(){
                $("#dateof_error").text("Please wait...");
          },
          success: function(result) {    
          if(result.status==false){
              $("#dateof_error").text(result.msg);
          }else{
            $("#late_fee_div").removeClass('hidden');
            $("#match_date").val(result.date);
            $("#late_fee").val(result.late_fee);
            if(parseFloat(result.late_fee) > 0){
              $("#action_btn").text('Next');
            }else{
              $("#action_btn").text('Submit');
            }
            $("#dateof_error").text(result.post_date_hint);
          }                                  
        }             
      });
    } 
   }
}

function sdlfc(sdate){ 
  $.ajax({
          type: "POST",
            dataType: 'json',
          url: "/backoffice/investor/serviceprovider/cdlfc", 
          data:{sdate:sdate}, 
           beforeSend:function(){
                $("#dateof_error").text("Please wait...");
          },
          success: function(result) {    
          if(result.status==false){
              $("#dateof_error").text(result.msg);
          }else{
            $("#late_fee_div").removeClass('hidden');           
            $("#late_fee").val(result.late_fee);
            if(parseFloat(result.late_fee) > 0){
              $("#action_btn").text('Next');
            }else{
              $("#action_btn").text('Submit');
            }
            $("#dateof_error").text("");
          }                                  
        }             
      });
}



  function logopen(asp_id){
     $('#logmodal').modal('show');
     $.ajax({
                type: "POST",
                  dataType: 'json',
                url: "/backoffice/investor/serviceprovider/logdata", 
                 data:{asp_id:asp_id},                     
                 beforeSend:function(){
                      $("#logdatamsg").text("Please wait...");
                },
                success: function(result) {    
                if(result.status==true){
                    $("#logdatamsg").text("");
                    $summary = '<table class="table table-striped table-bordered table-hover"><tr><td>Representative</td><td>'+$("#sp_name_text"+asp_id).text()+'</td></tr><tr><td>Type</td><td>'+$("#sp_type_text"+asp_id).text()+'</td></tr><tr><td>Entity Detail</td><td>'+$("#comp_name_text"+asp_id).text()+'</td></tr></table>';
                    $(".logmodalbody").html($summary+result.msg);
                }else{
                    $("#logdatamsg").text('Something went wrong');
                }                                  
              }             
            });
  }

   function emailresend(asp_id){
    $.ajax({
                type: "POST",
                dataType: 'json',
                url: "/backoffice/investor/serviceprovider/resendmail/id/"+asp_id+"/for/ctspcr",              
                 beforeSend:function(){
                  $("#overlay").attr("style",'display:block;');
                  $("#overlay_label").text('Please wait as email notification is in progress');
                },
                success: function(result) {    
                if(result.status==true){
                   alert('Email has been sent with new activation key');             
                }else{
                   alert('Something went wrong while notification send');
                }     
                $("#overlay").attr("style",'display:none;');                             
              }             
            });
  }

  function withomireq(asp_id){
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "/backoffice/investor/serviceprovider/withomireq/id/"+asp_id+"/for/ctspcr",              
         beforeSend:function(){
          $("#overlay").attr("style",'display:block;');
          $("#overlay_label").text('Please wait for Withdrawing nomination');
        },
        success: function(result) {   
          window.location.href = window.location.href; 
          $("#overlay").attr("style",'display:none;');   

      }             
    });
  }

  function revokeopen(asp_id){
    $("#sp_id").val(asp_id);
    $('#revokemodal').modal('show');   
  }
  function rrmc(){
    /*$('#revokemodal').removeClass('show').attr("style","display:none;");  
    $('#revokemodal').attr("aria-hidden",'true'); 
    $('#revokemodal').removeAttr("aria-modal",'true'); 
     $('.modal-backdrop').remove();*/
     location.reload();
  }

  function rrsub(){ 
    var rr_text = $("#rr").val();
    var sp_id = $("#sp_id").val();
        if(rr_text){
            $.ajax({
                type: "POST",
                  dataType: 'json',
                url: "/backoffice/investor/serviceprovider/revokebyapplicant/sp_id/"+sp_id, 
                data:{reason:rr_text}, 
                 beforeSend:function(){
                      $("#rr_error").text("Please wait for notification...");
                },
                success: function(result) {    
                if(result.status==false){
                      $("#rr_error").text("Something went wrong");
                }else{
                    window.location.href = "/backoffice/investor/serviceprovider/aspr";  
                }                                   
              }             
            });
        }else{
            $("#rr_error").text("This field is required");
        }
  }

  function checkentity(en){
    if(en=="Entity"){
        $("#div_e_name, #div_e_type").removeClass("hidden");
    }else{
        $("#div_e_name, #div_e_type").addClass("hidden");
        $("#e_name, #e_type").val("");
    }
  }

  function getsplist(sp_type){
    $("#serviceprovider_user_id").val("").trigger('change');
    if(sp_type){
       $.ajax({
            type: "POST",
            url: "/backoffice/investor/serviceprovider/getspusers/sp_type/" + sp_type,
            success: function(result) {               
                $("#serviceprovider_user_id").html(result);        
            }
        });
    }
  }

   function documentsh_initially(){
    var sp_type = $('input[name=sp_type]:checked').val();
    var app_entity_type_id = $('input[name=app_entity_type_id]:checked').val();
    $("#match_date_label").html("Date of Appointment <span style='color: red;'>*</span>");
    $("#match_date").attr('placeholder','Click to select date');
   if(sp_type=="Corporate Trust Service Provider (CTSP)"){
      if(app_entity_type_id==1){
        $("#dec_document").removeClass('hidden');
        $("#match_date_div").removeClass('hidden'); 
        $("#late_fee_div").removeClass('hidden');
        getdates($("#entity_id").val());
      }else{
        if(app_entity_type_id==2){
          $("#dec_document").removeClass('hidden');
          //$("#dec_document2").removeClass('hidden');
          $("#match_date_div").removeClass('hidden');
         
          
           $("#late_fee_div").removeClass('hidden');
           sdlfc($("#match_date").val());
        }else{
          if(app_entity_type_id==3){
 
          $("#dec_document").removeClass('hidden');
          $("#match_date_div").removeClass('hidden');    
          $("#late_fee_div").removeClass('hidden');
            sdlfc($("#match_date").val());
          }else{
            $("#dec_document, #dec_document2").addClass('hidden');
            $("#match_date_div").addClass('hidden'); 
               
          }
        }
      }      
    }else{
      $("#dec_document, #dec_document2").addClass('hidden');
      $("#match_date_div").addClass('hidden');     
    } 
  }

  function documentsh(){
    var sp_type = $('input[name=sp_type]:checked').val();
    var app_entity_type_id = $('input[name=app_entity_type_id]:checked').val();

   // $("#date_of_div").addClass('hidden');
    $("#late_fee_div").addClass('hidden');
    $("#late_fee").val("");
    $("#match_date").val("");
    $("#match_date").css('pointer-events','');    
    $("#dec_document2").addClass('hidden');

     $("#match_date_label").html("Date of Appointment <span style='color: red;'>*</span>");
    $("#match_date").attr('placeholder','Click to select date');

    if(sp_type=="Corporate Trust Service Provider (CTSP)"){
      if(app_entity_type_id==1){
        $("#dec_document").removeClass('hidden');
        $("#match_date_div").removeClass('hidden');
      
       
      }else{
        if(app_entity_type_id==2){
          $("#dec_document").removeClass('hidden');
        //   $("#dec_document2").removeClass('hidden');
          $("#match_date_div").removeClass('hidden');
          
        }else{
          if(app_entity_type_id==3){
 
            $("#dec_document").removeClass('hidden');
             $("#match_date_div").removeClass('hidden');
         
           
          }else{
            $("#dec_document, #dec_document2").addClass('hidden');
            $("#match_date_div").addClass('hidden'); 
               
          }
        }
      }      
    }else{
      $("#dec_document, #dec_document2").addClass('hidden');
      $("#match_date_div").addClass('hidden');     
    } 
  }

  function checkemailexits(){
     var v = validate();
    if(v==true){
       $.ajax({
                type: "POST",
                  dataType: 'json',
                url: "/backoffice/investor/serviceprovider/validatemail",
                data:{email:$("#email").val()}, 
                
                success: function(result) {    
                if(result.status==false){                
                  $("#email-error").text('Email is Already Registered');  
                               return false;      
                }else{
                     return true;
                }                                   
              }             
            });
    }
  }







function getstate(c_id){
  $("#city").val("");
  $("#state_id").val("").trigger("change");
  if(c_id){
    if(c_id==829){
      $("#city").attr("readonly",true);
    }else{
      $("#city").attr("readonly",false);
    }
    $.ajax({
            type: "POST",
            url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + c_id,
            success: function(result) {      
                $("#state_id").html(result);       
            }
        });
  }else{
     $("#city").attr("readonly",false);
     $("#state_id").html(' <option value="">Select state/parish </option>');
  }
}



</script>