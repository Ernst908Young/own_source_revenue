<title>Onboard CTSP/CR</title>
<style type="text/css">
#overlay {
    position: fixed;
  top:0%;
  left:0%;
  width:100%;
  height:100%;  
  background: #ccc;
  opacity: .5;
}
#overlay_text{
   
 position: absolute;
    vertical-align: middle;
    font-size: 25px;
    z-index: 9;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: #ef7b20;  
    opacity: 100;

   
}
.form-part.bussiness-det .form-group > div {
    margin-bottom: 0px;
}
.form-control-feedback{
  color: red;
}

</style>
<div id="overlay" style="display: none;">
  <div id="overlay_text" style="color: red;">
     <div style="text-align: center; vertical-align: middle;">
      <!-- <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><br> -->
     <strong id="overlay_label">Loading...</strong>
   </div>
  </div>
</div>
<?php 
 

      $agent_user_id = $_SESSION['RESPONSE']['agent_user_id'];
      $comp_arr = Yii::app()->db->createCommand("SELECT a.id, a.company_id, c.company_name, c.reg_no 
        FROM agent_service_provider a
        INNER JOIN bo_company_details c ON a.company_id=c.id
        WHERE a.sp_status='O' AND agent_user_id=$agent_user_id")->queryAll();
?>

<div class="dashboard-home">
  <div class="applied-status">
    <ul class="breadcrumb">
      <li><a href="/backoffice/investor/home/investorWalkthrough">Home</a></li>   
      <li>Onboard Sub Users</li>
    </ul>
  </div>

     
<div class="m-wizard m-wizard--3 m-wizard--success" id="m_wizard">
<div class="reservation-form">  
<?php if($comp_arr){ ?> 
<form id="m_form" method="post" action="<?php echo Yii::app()->createAbsoluteUrl("/investor/serviceprovider/obsubusers"); ?>">

    <div class="form-part bussiness-det">   
        <h4 class="form-heading">Onboard Sub User</h4>   
        <div class="form-row">
            <div class="form-group rbcb-group">
              <label>Select Action Type
               <span style="color: red;">*</span>
              </label><br>
           
             <input name="at_ch_box" type="radio" value="Appointment of Sub User" class="chk_sp"
                    labelname="sp2" required >&nbsp;
                   <span class="rc_label">Appointment of New Sub User</span>
                   <br>
               <input name="at_ch_box" type="radio"  class="chk_sp" value="Change of Sub User" labelname="sp1" required >&nbsp;
                <span class="rc_label">Change of Sub User</span>               
          </div>
       </div>    

<div class="new_sp_form">
  <div class="form-row row">
   <div class="col-lg-6 form-group text-start mb-3">
      <label>First Name <span style="color: red;">*</span></label>
        
    <input type="text" name="first_name" class="form-control" placeholder="Enter First Name" required>

  </div>

<div class="col-lg-6 form-group text-start mb-3">
    <label>Middle Name <span style="color: red;"></span></label>
   
  <input type="text" id="middle_name" name="middle_name" class="form-control" placeholder="Enter Middle Name">


<br>
<input type='checkbox' id='middlenamecheckbox' name='middlenamecheckbox'> I do not have a middle name or middle initial
<span id="middleerror" style="color: red;"></span>
</div>

<div class="col-lg-6 form-group text-start mb-3">
  <label>Last Name <span style="color: red;">*</span></label>
   
     <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name" required>
   
</div>

<div class="col-lg-6 form-group text-start mb-3">
    <label>Gender<span style="color: red;">*</span></label>
    <select name="gender" placeholder="Select gender" id="gender" class="select2-me" required>
             <option value="">Select gender </option>           
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              <option value="Others">Others</option>
      </select>
   
</div>



<div class="col-lg-6 form-group text-start mb-3">
  <label>Mobile Number<span style="color: red;">*</span></label>
  
    <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Enter Moible Number" minlength="10" maxlength="10" required>
 
</div>

<div class="col-lg-6 form-group text-start mb-3">
  <label>Email ID <span style="color: red;">*</span></label>
    
      <input type="text" id="email" name="email" class="form-control" placeholder="Enter Email ID" required>
     
</div>



 <div class="col-lg-12"><strong>Details of Registered Office Address:</strong></div><br><br>
 <div class="col-lg-6 form-group text-start mb-3">
    <label>Registered Office: Address Line 1 <span style="color: red;">*</span></label>
   
        <input type="text" id="addlin1" name="addlin1" class="form-control" placeholder="Enter address line 1" required>
     
  </div>

<div class="col-lg-6 form-group text-start mb-3">
      <label>Registered Office: Address Line 2</label>
   
      <input type="text" id="addlin2" name="addlin2" class="form-control" placeholder="Enter address line 2">
     
     
</div>

<div class="col-md-6 form-group text-start mb-3">                   
            <label>Registered Office: Country<span style="color: red;">*</span></label>
                <select name="country_id" id="country_id" class="select2-me" onchange="getstate($(this).val())" required>
                    <option value="">Select your country </option>

  <?php  $country_arr = Yii::app()->db->createCommand("SELECT * from bo_landregion where is_lr_active='Y' AND lr_type='country' AND parent_id=0")->queryAll();

   foreach ($country_arr  as $key => $val) { 
      
      ?>
    <option value="<?php echo $val['lr_id']; ?>"><?php echo $val['lr_name']; ?></option>
    <?php } ?>
                </select>
</div> 

<div class="col-md-6 form-group mb-3">                   
  <label>Registered Office: State/Parish<span style="color: red;">*</span></label>
      <select name="state_id" class="select2-me" id="state_id" required>
          <option value="">Select state/parish </option>
      </select> 
 
</div> 


<div class="col-lg-6 form-group text-start mb-3">
      <label>Registered Office: City</label>
     
      <input type="text" id="city" name="city" class="form-control" placeholder="Enter city">
   
</div>

<div class="col-lg-6 form-group text-start mb-3">
      <label>Registered Office: Postal Code</label>
    
      <input type="text" id="pin_code" name="pin_code" class="form-control" placeholder="Enter postal code"> 
    
</div>

<br><br>
  </div>
</div> <!--End of new sp form-->

 <div class="comman_sp_form" id="comman_sp_form">
<div class="form-row row">


 <?php if(!empty($comp_arr)){ 
   
?>
    <div class="col-md-6 form-group mb-3">                   
      <label>Select Entity<span style="color: red;">*</span></label>
        <select name="asp_id" id="entity_id" class="select2-me" required>
            <option value="">Select entity </option>
            <?php foreach ($comp_arr  as $key => $val) {
              
             ?>
              <option value="<?php echo $val['id']; ?>"><?php echo $val['reg_no'].' '.$val['company_name']; ?></option>
              <?php } ?>
        </select>    
    </div> 
<?php } ?> 

 <div class="col-md-12 form-group rbcb-group mb-3">  
  <label>Terms & condition <span style="color: red;">*</span></label>  <br> 
   <input type='checkbox' id='tc' name='tc' required> I/We hereby authorise the above mentioned person as the registered Sub User, for availing the services from CAIPO on my/our behalf.
 </div>

  </div>
  <div class="form-row row">
    <div class="form-group col-md-12"  style="text-align: center;">
      <a href="javascript:void(0);" class="submitForm custome-btn" data-wizard-action="submit">
        <span>
          <i class="fa fa-check"></i>
          &nbsp;&nbsp;
          <span>
            Submit
          </span>
        </span>                       
      </a>
   <!--    <input type="button" name="button" style="font-size: 18px; width: 120px;" class="btn btn-primary" value="Submit" />   -->
     
      </div>
  </div>
</div> <!--Comman fields form-->
</div>
       </form>
       <?php }else{
  echo "<strong style='text-align:center;'>No Company has been assigned to you. Or you haven't activated any entity yet</strong>";
} ?> 

       <div class="form-part bussiness-det">   
        <h4 class="form-heading">Onboarded Sub Users</h4>
        <div class="form-row row">  
            <div class="col-lg-12">
                <table class="table">
  <thead>
    <tr>
      <th>SR. No</th>
      <th>Sub Users</th>
      <th>Entity Details</th>
      <th>Status</th>
      <th>Action</th>
    </tr> 
  </thead>
  <tbody>
<?php $sp_s_arr = ['N'=>'Nominated','O'=>'Onboarded','R'=>'Removed','DA'=>'Deactivated','NW'=>'Nomination withdrawn'];

$subusersrecords =  Yii::app()->db->createCommand("SELECT su.* , c.company_name, c.reg_no
        FROM agent_service_provider_sub_user_mapping su
        INNER JOIN agent_service_provider a ON su.asp_id=a.id
        INNER JOIN bo_company_details c ON a.company_id=c.id
        WHERE a.agent_user_id=$agent_user_id ORDER BY created_on DESC")->queryAll();

     foreach($subusersrecords as $k=>$v){ ?>
      <tr>
        <td>
          <?= $k+1 ?>
        </td>
        <td>
          <a href="#" onclick="logopen(<?= $v['id'] ?>)" style="color: blue;">
            <span id="su_name_text<?= $v['id'] ?>"><?= $v['first_name'].' '.$v['middle_name'].' '.$v['surname'].'<br>'.$v['email'] ?></span>
          </a>
          
        </td>
         
         <td>
            <span id="comp_name_text<?= $v['id'] ?>">
          <?= $v['company_name'] ? $v['company_name'] : 'NA' ?> <br><?= $v['reg_no'] ? $v['reg_no'] : 'NA' ?>
        </span>
        </td>
        <td>
          <?php
              if(array_key_exists($v['sp_status'], $sp_s_arr)){
                 echo $sp_s_arr[$v['sp_status']];
              }else{
                echo ' No Status';
              }
            ?>
        </td>
        <td>
           <?php if($v['sp_status']=='N'){ ?>
                 <a href="#" onclick="emailresend(<?= $v['id'] ?>)" style="color: blue;">Resend Email</a> | <a href="#" onclick="withomireq(<?= $v['id'] ?>)" style="color: blue;">Withdraw nomination request</a>
          <?php } ?>
           <?php
              if($v['sp_status']=='O' || $v['sp_status']=='DA'){ ?>  
                 <?php if($v['sp_status']=='O'){ ?>
                  <a href="#" onclick="changestatus(<?= $v['id'] ?>,'d')" style="color: blue;">
                      Deactivate
                  </a> |
                 <?php   }else{ ?>
                  <a href="#" onclick="changestatus(<?= $v['id'] ?>,'a')" style="color: blue;">
                      Activate
                  </a> |
                  <?php  } ?>
                         <br>     
                <a href="#" onclick="revokeopen(<?= $v['id'] ?>)" style="color: blue;">Remove</a>
              <?php } ?>
          
        </td>
      </tr>
    <?php } ?>
  </tbody>
  
</table>

            </div>
        </div>
</div>  


</div>


  </div>
    
       
  <div class="modal" id="logmodal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5>Log Records</h5>
        </div>
         <div class="modal-body">
            <span style="color: red;" id="logdatamsg"> </span>
            <div class="logmodalbody">
              
            </div>
         </div>
      </div>
    </div>
  </div>

  <div class="modal" id="revokemodal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-body">
                <label>Remove Reason</label>
                <textarea  id="rr" name="rr" placeholder="Enter the reason" class="form-control"></textarea> 
                <span id="rr_error" style="color: red;"></span>
                <input type="hidden" id="asp_sum_id" />
                <br>
                
        </div>
         <div class="modal-footer">
           <span class="btn-primary" onclick="rrsub()">Submit</span>
             <button type="button" class="btn-primary" data-dismiss="modal" onclick='rrmc()'>Close</button>
      </div>
    </div>
  </div>
 </div>

 

<script type="text/javascript">

function changestatus(sum_asp_id,s){
  $.ajax({
        type: "POST",
        dataType: 'json',
        url: "/backoffice/investor/serviceprovider/changesubuserstatus/sum_asp_id/"+sum_asp_id+"/s/"+s,              
         beforeSend:function(){
          $("#overlay").attr("style",'display:block;');          
        },
        success: function(result) {    
        window.location.href = "/backoffice/investor/serviceprovider/obsubusers/obsu/1";  
        $("#overlay").attr("style",'display:none;');                             
      }             
    });
}
 function logopen(sum_asp_id){
     $('#logmodal').modal('show');
     $.ajax({
        type: "POST",
          dataType: 'json',
        url: "/backoffice/investor/serviceprovider/sulogdata", 
         data:{sum_asp_id:sum_asp_id},                     
         beforeSend:function(){
              $("#logdatamsg").text("Please wait...");
        },
        success: function(result) {    
        if(result.status==true){
            $("#logdatamsg").text("");
            $summary = '<table class="table table-striped table-bordered table-hover"><tr><td>Representative</td><td>'+$("#su_name_text"+sum_asp_id).text()+'</td></tr><tr><td>Entity Detail</td><td>'+$("#comp_name_text"+sum_asp_id).text()+'</td></tr></table>';
            $(".logmodalbody").html($summary+result.msg);
        }else{
            $("#logdatamsg").text('Something went wrong');
        }                                  
      }             
    });
  }

 function emailresend(sum_asp_id){
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "/backoffice/investor/serviceprovider/resendmail/id/"+sum_asp_id+"/for/subuser",              
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

    function withomireq(sum_asp_id){
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "/backoffice/investor/serviceprovider/withomireq/id/"+sum_asp_id+"/for/subuser",              
         beforeSend:function(){
          $("#overlay").attr("style",'display:block;');
          $("#overlay_label").text('Please wait for Withdrawing nomination');
        },
        success: function(result) {  
         window.location.href = "/backoffice/investor/serviceprovider/observiceprovider/obsp/1";  
          $("#overlay").attr("style",'display:none;');                             
      }             
    });
  }

  function revokeopen(asp_sum_id){
    $("#asp_sum_id").val(asp_sum_id);
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
    var asp_sum_id = $("#asp_sum_id").val();
        if(rr_text){
            $.ajax({
                type: "POST",
                  dataType: 'json',
                url: "/backoffice/investor/serviceprovider/revokebysp/asp_sum_id/"+asp_sum_id, 
                data:{reason:rr_text}, 
                 beforeSend:function(){
                      $("#rr_error").text("Please wait for notification...");
                },
                success: function(result) {    
                if(result.status==false){
                      $("#rr_error").text("Something went wrong");
                }else{
                    window.location.href = "/backoffice/investor/home/investorWalkthrough";  
                }                                   
              }             
            });
        }else{
            $("#rr_error").text("This field is required");
        }
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




/*$(window).load(function() {
  var form = document.getElementById('obsp_form');
  form.button.onclick = function (){
    for(var i=0; i < form.elements.length; i++){     

      if(form.elements[i].value === '' && form.elements[i].hasAttribute('required')){
        $('#error'+i).text('This field is required');
        return false;
      }else{
        if(i==5){       
            const email = $("#email").val();         
            if (validateEmail(email)) {  
            } else {
               $('#error'+i).text('Please enter a valid email');
                return false;
            }
        }
        if(i==1){
          var mnt = $("#middle_name").val();
          if(mnt){
           
          }else{
            var mncb = $('input[name=middlenamecheckbox]:checked').val(); 
            if(mncb){
             
            }else{
               $('#error'+i).text('Please enter the required information or select the check box');
               return false;
            }
          }
        }
        if(i==7){
           var tc = $('input[name=tc]:checked').val(); 
           if(tc){}else{
             $('#error7').text('This field is required');
               return false;
           }

        }
        $('#error'+i).text('');
      }
    }
    form.submit();
  }; 
});
*/
</script>

<script src="/backoffice/themes/swcsNewTheme/fb/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script src="/backoffice/themes/swcsNewTheme/fb/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
<script src="/backoffice/themes/swcsNewTheme/fb/demo/default/custom/components/forms/wizard/onboard_subuser.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/jquery-repeater/jquery.repeater.js" type="text/javascript">
</script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/pages/scripts/form-repeater.min.js" type="text/javascript">
</script>
<!-- form repeater js -->

<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/css/plugins/select2/select2.css">
<!-- select2 -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/plugins/select2/select2.min.js"></script>
<!-- Theme framework -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/eakroko.min.js"></script>