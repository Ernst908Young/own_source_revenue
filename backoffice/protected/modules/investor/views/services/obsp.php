<title>Onboard CTSP/CR</title>
<style type="text/css">
#overlay {
    position: fixed;
  top:0%;
  left:0%;
  width:100%;
  height:100%;  
  background: black;
  opacity: .2;
}
#overlay_text{
   width: 50px;
    height: 57px;
    position: absolute;
    top: 50%;
    left: 50%;
    margin: -28px 0 0 -25px;   
    font-size: 25px;
    opacity: 10;
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
      <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
      <span class="sr-only">Loading...</span>
  </div>
</div>

<?php 
 


 $user_id = $_SESSION['RESPONSE']['user_id'];





 $comp_arr = BoCompanyDetails::GetAllentity($user_id);


//$regi_link = CURL_URL."/sso/account/signin";
//echo $regi_link;
?>

<div class="dashboard-home">
  <div class="applied-status">
  	<ul class="breadcrumb">
      <li><a href="/backoffice/investor/home/investorWalkthrough">Home</a></li>   
      <li>Onboard Corporate Trust Service Provider (CTSP) / Corporate Representative (CR)</li>
    </ul>
  </div>
  
<?php if($comp_arr){ ?>

<div class="m-wizard m-wizard--3 m-wizard--success" id="m_wizard">
<div class="reservation-form">  
	


<?php 

 $copany_alredy_assign = Yii::app()->db->createCommand("SELECT a.company_id, a.first_name, a.middle_name, a.surname,a.id ,a.email,c.reg_no,c.company_name, a.user_id, a.agent_user_id, a.sp_status
FROM agent_service_provider a
LEFT JOIN bo_company_details c ON c.id = a.company_id
where  a.user_id='".$user_id."' AND a.is_revoke=0")->queryAll();

  




    $get_all_company = [];
    if($copany_alredy_assign){
       foreach ($copany_alredy_assign as $c_id) {
         $get_all_company[] = $c_id['company_id'];
       }
    }

    $unassigen_entity  = [];
    foreach ($comp_arr as $key => $value) {
      if(in_array($value['id'], $get_all_company)){

      }else{
        $unassigen_entity[] = $value;
      }
    }



     if(!empty($unassigen_entity)){
  

?>
<form id="m_form" method="post" action="<?php echo Yii::app()->createAbsoluteUrl("/investor/serviceprovider/observiceprovider"); ?>">

    <div class="form-part bussiness-det">   
        <h4 class="form-heading">Onboard CTSP / CR</h4>
        <div class="form-row">
            <div class="form-group rbcb-group">
              <label>Select Action Type
               <span style="color: red;">*</span>
              </label><br>
           
             <input name="at_ch_box" type="radio" value="Appointment of CTSP/CR" class="chk_sp"
                    labelname="sp2" required >&nbsp;
                   <span class="rc_label">Appointment of CTSP/CR</span>
                   <br>
               <input name="at_ch_box" type="radio"  class="chk_sp" value="Change of CTSP/CR" labelname="sp1" required >&nbsp;
                <span class="rc_label">Change of CTSP/CR</span>               
          </div>
       </div>

        <div class="form-row hidden" id="sp_type_div">
          <div class="form-group rbcb-group">
            <label>Select Type of Corporate Representative
             <span style="color: red;">*</span>
            </label><br>
          
                  <input name="sp_type" type="radio" value="Corporate Representative (CR)" class="chk_sp" labelname="sp2" required >&nbsp;
                   <span class="spt_label">Corporate Representative (CR)</span>
              <br>
                   <input name="sp_type" type="radio"  class="chk_sp" value="Corporate Trust Service Provider (CTSP)" labelname="sp1" required >&nbsp;
                    <span class="spt_label">Corporate Trust Service Provider (CTSP)</span>                   
          </div>            
        </div>


 <div class="app_entity_type_div hidden" id="app_entity_type_div">
    <?php $appentitytype = Yii::app()->db->createCommand("SELECT * FROM applicant_entity_type_for_sp where is_active=1")->queryAll(); ?>
        <div class="form-row">
          <div class="form-group rbcb-group">
            <label>Entity Type
             <span style="color: red;">*</span>
            </label><br>
          <?php 
          if($appentitytype){
          foreach($appentitytype as $v){ 
            $aet_id = $v['id'];
            ?>
                  <input name="app_entity_type_id" type="radio" value="<?= $aet_id ?>" class="chk_sp" labelname="sp2" required >&nbsp;
                   <span class="spt_label"><?= $v['type_of_entity'] ?></span>
                   <br>
                            <?php } } ?>   
          </div>            
        </div>  
    </div>    

        <div class="form-row hidden" id="sp_ch_box_div">
          <div class="form-group rbcb-group">
              <label>Select Existing or New <span class="rt_sp"></span>
               <span style="color: red;">*</span>
              </label><br>
           
             <input name="sp_ch_box" type="radio" value="1" class="chk_sp"
                    labelname="sp2" required >&nbsp;
                   <span class="rc_label">Select existing <span class="rt_sp"></span></span>
                   <br>
               <input name="sp_ch_box" type="radio"  class="chk_sp" value="2"    labelname="sp1" required >&nbsp;
                <span class="rc_label">Add new <span class="rt_sp"></span></span>               
          </div>
       </div>



  <div class="exist_sp_form hidden" id="exist_sp_form">
  
          <div class="form-row row">            
               <div class="col-lg-12 mb-3">
                  <div class="form-group">
                      <label >Select <span class="rt_sp"></span> <span style="color: red;">*</span></label>
                  </div>
                  <select name="serviceprovider_user_id" id="serviceprovider_user_id" class="select2-me" onchange="spchange($(this).val())" required>
                   <option value=''>Please Service Provider </options>
                  </select>  
                  <span style="color: red;" id="sp_user_id-error"></span>                   
               </div>
          </div>
          <div id="exit_sp_table">   
          
          </div>
         
  </div>        

<div class="new_sp_form hidden" id="new_sp_form">
  <div class="form-row row">
            <div class="col-lg-12">
              <strong>Details of the <span class="rt_sp"></span>:</strong>
            </div><br><br>

<div class="col-lg-12 text-start mb-3">
  <div class="form-group">
     <label>Whether the <span class="rt_sp"></span> is an Individual or an Entity
    <span style="color: red;">*</span></label>
  </div> 
      <select name="ind_ent" id="ind_ent" onchange="checkentity($(this).val())" class="select2-me" required>
         <option value="">Please Select </option>           
          <option value="Individual">Individual</option>
          <option value="Entity">Entity</option>        
      </select> 
         
</div>

<!-- <div class="col-lg-6 form-group text-start mb-3"></div> -->

<div class="col-lg-6 form-group text-start mb-3 hidden" id="div_e_name">
  <label>Name of the Entity<span style="color: red;">*</span></label>
    <div class="col-lg-12">
      <input type="text" name="entity_name" id="e_name" class="form-control" placeholder="Enter name of the entity" required>
    </div>       
</div>

<div class="col-lg-6 form-group text-start mb-3 hidden" id="div_e_type">
  <label>Type of Entity<span style="color: red;">*</span></label>
    <div class="col-lg-12">
      <input type="text" name="entity_type" id="e_type" class="form-control" placeholder="Enter type of entity" required>
    </div>
</div>



 <div class="col-lg-12">
  <strong>Details of the Authorised Person:</strong>
</div><br><br>

 <div class="col-lg-6 form-group text-start mb-3">
      <label>First Name <span style="color: red;">*</span></label>
         <div class="col-lg-12">
		<input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter First Name" required>
</div>
  </div>

<div class="col-lg-6 form-group mb-3">
    <label>Middle Name <span style="color: red;"></span></label>
     <div class="col-lg-12">
	<input type="text" id="middle_name" name="middle_name" class="form-control" placeholder="Enter Middle Name">
</div>

<br>
<input type='checkbox' id='middlenamecheckbox' name='middlenamecheckbox'> I do not have a middle name or middle initial
<span id="middleerror" style="color: red;"></span>
</div>

<div class="col-lg-6 form-group mb-3">
  <label>Last Name <span style="color: red;">*</span></label>
    <div class="col-lg-12">
	   <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name" required>
    </div>
</div>

<div class="col-lg-6 form-group mb-3">
    <label>Gender<span style="color: red;">*</span></label>
    <select name="gender" placeholder="Select gender" id="gender" class="select2-me" required>
             <option value="">Select gender </option>           
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              <option value="Others">Others</option>
      </select>
   
</div>



<div class="col-lg-6 form-group mb-3">
  <label>Mobile Number<span style="color: red;">*</span></label>
   <div class="col-lg-12">
    <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Enter Moible Number" required>
  </div>
</div>

<div class="col-lg-6 form-group mb-3">
  <label>Email ID <span style="color: red;">*</span></label>
    <div class="col-lg-12">
	    <input type="text" id="email" name="email" class="form-control" placeholder="Enter Email ID" required>
    </div>     
</div>



 <div class="col-lg-12"><strong>Details of Registered Office Address:</strong></div><br><br>
 <div class="col-lg-6 form-group mb-3">
    <label>Registered Office: Address Line 1 <span style="color: red;">*</span></label>
     <div class="col-lg-12">
        <input type="text" id="addlin1" name="addlin1" class="form-control" placeholder="Enter address line 1" required>
      </div>
  </div>

<div class="col-lg-6 form-group mb-3">
      <label>Registered Office: Address Line 2</label>
      <div class="col-lg-12">
      <input type="text" id="addlin2" name="addlin2" class="form-control" placeholder="Enter address line 2">
      </div>
     
</div>

<div class="col-md-6 form-group mb-3">                   
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


<div class="col-lg-6 form-group mb-3">
      <label>Registered Office: City</label>
       <div class="col-lg-12">
      <input type="text" id="city" name="city" class="form-control" placeholder="Enter city">
    </div>
    
</div>

<div class="col-lg-6 form-group mb-3">
      <label>Registered Office: Postal Code</label>
      <div class="col-lg-12">
      <input type="text" id="pin_code" name="pin_code" class="form-control" placeholder="Enter postal code">
    </div>
    
</div>
<br><br>
  </div>
</div> <!--End of new sp form-->

 <div class="comman_sp_form hidden" id="comman_sp_form">

<div class="form-row row hidden" id="date_of_div">
  <div class="form-group rbcb-group">
      <label>Date Of
       <span style="color: red;">*</span>
      </label><br>   
     <input name="date_of" type="radio" value="Incorporation of the Company" class="chk_sp"
            labelname="sp2" required >&nbsp;
           <span class="rc_label">Incorporation of the Company</span>
           <br>
       <input name="date_of" type="radio"  class="chk_sp" value="Post-Incorporation of the Company" labelname="sp1" required >&nbsp;
        <span class="rc_label">Post-Incorporation of the Company</span>               
  </div>
</div>

<div class="form-row row"> 
    <div class="col-md-6 form-group mb-3">                   
      <label>Select Entity<span style="color: red;">*</span></label>
        <select name="entity_id" id="entity_id" class="select2-me" onchange="getdates($(this).val())" required>
            <option value="">Select entity </option>
            <?php foreach ($unassigen_entity  as $key => $val) {
               
             ?>
              <option value="<?php echo $val['id']; ?>">
                <?php echo $val['reg_no'].' '.$val['company_name']; ?>
              </option>
              <?php } ?>
        </select>    
    </div> 
    <div class="col-md-6 form-group mb-3" id="match_date_div">
       <label>Date of <span id="match_date_label"></span></label>  <br> 
        <input type="inputType" autocomplete="off" id="match_date" name="match_date" class="datepicker form-control hasDatepicker" required readonly="">
        <span id="dateof_error" style="color: red;"></span>
      </div>

    <div class="col-md-6 form-group mb-3 hidden" id="late_fee_div">
       <label>Late Fees</label>  <br> 
        <input type="inputType" autocomplete="off" id="late_fee" name="late_fee" class="form-control" readonly="">        
      </div>


 <div class="col-md-12 form-group rbcb-group mb-3">  
  <label>Terms & condition <span style="color: red;">*</span></label>  <br> 
   <input type='checkbox' id='tc' name='tc' required> I, being the Director hereby give my consent to appoint as the <span class="rt_sp"></span> of the Company.
 </div>

 <div class="col-md-12 form-group rbcb-group mb-3 hidden" id="dec_document">  
  <label>Signed version of the declaration attachment  <span style="color: red;">*</span></label>  <br> 
  <input type="file" id="input-id" name="input-100" accept="image/*, application/pdf">
            <!-- <input type="file" id="input-id" name="input-100[]" multiple>  -->
            <small><i>(Please upload PDF, JPG, PNG only.)</i></small>
 </div>


  </div>
  <div class="form-row row">
 		<div class="form-group col-md-12"  style="text-align: center;">
      <a href="javascript:void(0);" class="submitForm custome-btn" data-wizard-action="submit">
        <span>
         
          <span id="action_btn">
            Submit
          </span>
        </span>                       
      </a>

 	    </div>
  </div>
</div> <!--Comman fields form-->
</div>
       </form>
<?php } ?>
       <div class="form-part bussiness-det">   
        <h4 class="form-heading">Onboarded CTSP / CR</h4>
        <div class="form-row row">  
            <div class="col-lg-12">
                <table class="table">
  <thead>
    <tr>
      <th>SR. No</th>
      <th>CTSP / CR</th>
      <th>Entity Reg. Number</th>
      <th>Entity Name</th>
      <th>Status</th>
      <th>Action</th>
    </tr> 
  </thead>
  <tbody>
<?php $sp_s_arr = ['N'=>'Nominated','O'=>'Onboarded','R'=>'Revoked'];
     foreach($copany_alredy_assign as $k=>$v){ ?>
      <tr>
        <td>
          <?= $k+1 ?>
        </td>
        <td>
          <?php
               if($v['agent_user_id']){
                  $spd = Yii::app()->db->createCommand("SELECT u.email, p.first_name as first_name, p.last_name as middle_name, p.surname as surname  
        from sso_users u 
        INNER JOIN sso_profiles p ON p.user_id=u.user_id
        where u.user_id=".$v['agent_user_id'])->queryRow();
 echo $spd['first_name'].' '.$spd['middle_name'].' '.$spd['surname'].'<br>'.$spd['email'];
                }else{
                  /*echo '<spna style="color:red;">'.$v['first_name'].' '.$v['middle_name'].' '.$v['surname'].'<br>'.$v['email'].'</span>';*/                
echo $v['first_name'].' '.$v['middle_name'].' '.$v['surname'].'<br>'.$v['email'];


                }
           ?>
        </td>
          <td>
          <?= $v['reg_no'] ? $v['reg_no'] : 'NA' ?>
        </td>
         <td>
          <?= $v['company_name'] ? $v['company_name'] : 'NA' ?>
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
           <?php
              if($v['sp_status']=='O'){ ?>
                 <a href="#" onclick="revokeopen(<?= $v['id'] ?>)" style="color: blue;">Revoke</a>
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
    </div>
 <!--       
  <div class="modal" id="myModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-body">
      
        </div>
        </div>
    </div>
  </div>
 -->
  <div class="modal" id="revokemodal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-body">
                <label>Revoke Reason</label>
                <textarea  id="rr" name="rr" placeholder="Enter the reason" class="form-control"></textarea> 
                <span id="rr_error" style="color: red;"></span>
                <input type="hidden" id="sp_id" />
                <br>
                
        </div>
         <div class="modal-footer">
           <span class="btn-primary" onclick="rrsub()">Submit</span>
             <button type="button" class="btn-primary" data-dismiss="modal" onclick='rrmc()'>Close</button>
      </div>
    </div>
  </div>
  </div>

<?php }else{
  echo "<div class='reservation-form'> <strong style='text-align:center;'>Sorry! Please registered a entity for Representative onboarding</strong></div>";
} ?>
<!-- <script type="text/javascript">
  $(window).load(function() {

  });
  
</script> -->


<script type="text/javascript">

function spchange(sp_id){
 /* if(sp_id){
    $("#new_sp_form").addClass('hidden');
  }else{
    $("#new_sp_form").removeClass('hidden');
  }*/
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
  var callajax = false;
  if(ue_id){
    var et = $('input[name=app_entity_type_id]:checked').val();
    if(et==1){
      callajax = true;
      var dof = 'Incorporation of the Company';
    }

    if(et==2){
      callajax = true;
      var dof = 'Post-Incorporation of the Company';
    }

    if(et==3){     
       var dof = $('input[name=date_of]:checked').val();
        if(dof){
           callajax = true;           
         }
        
    }   
   
   if(callajax==true){
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
                    window.location.href = "/backoffice/investor/home/investorWalkthrough";  
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

  $(document).ready(function () {

 
  $("input[name=at_ch_box]").on("change",function(){     
      if($(this).val()){        
        $("#sp_type_div").removeClass('hidden');      
      }else{       
        $("#sp_type_div").addClass('hidden');  
      }   
  });
  
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
       $("input[name=date_of]").prop('checked', false); 
       $('#entity_id').val("").trigger("change");
       $('#match_date, #late_fee').val("");


  });

$("input[name=app_entity_type_id]").on("change",function(){     
   documentsh();
    $("input[name=date_of]").prop('checked', false); 
    $('#entity_id').val("").trigger("change");
    $('#match_date, #late_fee').val("");
});

$("input[name=date_of]").on("change",function(){     
   documentsh();
   $('#entity_id').val("").trigger("change");
    $('#match_date, #late_fee').val("");
});



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
      'user_id' : "<?= $user_id ?>"
    },
   
    initialPreviewAsData: false,
   // initialPreview:'',
   // overwriteInitial: false,

     initialPreview: '<a href="/backoffice/protected/uploads/applicantdoc/11/201384_Name_Related_1645205751.pdf" target="_blank"  title="Click to see or download uploaded document"><img src="/themes/investuk/assets/applicant/images/print-icon.png"></a>',          // if you have previously uploaded preview files
     initialPreviewConfig:[{caption:'Uploaded File'}],    // if you have previously uploaded preview files
    theme: 'fas',
    deleteUrl: "http://localhost/file-delete.php"
  });
  /*$('#kvFileinputModal').appendTo('body').modal('show');*/
  $(".kv-fileinput-error, .fileinput-remove").hide();

  });

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

  function documentsh(){
    var sp_type = $('input[name=sp_type]:checked').val();
    var app_entity_type_id = $('input[name=app_entity_type_id]:checked').val();

    $("#date_of_div").addClass('hidden');
    $("#late_fee_div").addClass('hidden');
    $("#late_fee").val("");
    if(sp_type=="Corporate Trust Service Provider (CTSP)"){
      if(app_entity_type_id==1){
        $("#dec_document").removeClass('hidden');
        $("#match_date_div").removeClass('hidden');
        $("#match_date_label").text("Incorporation of the Company");
      }else{
        if(app_entity_type_id==2){
          $("#dec_document").removeClass('hidden');
          $("#match_date_div").removeClass('hidden');
          $("#match_date_label").text("Post-Incorporation of the Company");
        }else{
          if(app_entity_type_id==3){
            $("#date_of_div").removeClass('hidden');
            $("#dec_document").removeClass('hidden');
             var date_of = $('input[name=date_of]:checked').val();
             if(date_of){
               if(date_of=='Incorporation of the Company'){
                $("#match_date_label").text("Incorporation of the Company");
               }else{
                  $("#match_date_label").text("Post-Incorporation of the Company");
               }
               $("#match_date_div").removeClass('hidden');
             }else{
               $("#match_date_div").addClass('hidden');
             }
              
            //
          }else{
            $("#dec_document").addClass('hidden');
            $("#match_date_div").addClass('hidden');           
          }
        }
      }      
    }else{
      $("#dec_document").addClass('hidden');
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
  if(c_id){
    $.ajax({
            type: "POST",
            url: "/backoffice/iloc/property/getStateByCountryID/countryCode/" + c_id,
            success: function(result) {      
                $("#state_id").html(result);       
            }
        });
  }else{
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
<script src="/backoffice/themes/swcsNewTheme/fb/demo/default/custom/components/forms/wizard/onboard_serviceprovider.js" type="text/javascript"></script>
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

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
<!-- alternatively you can use the font awesome icon library if using with `fas` theme (or Bootstrap 4.x) by uncommenting below. -->
<!-- link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" crossorigin="anonymous" -->
<!-- the fileinput plugin styling CSS file -->
<link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<!-- if using RTL (Right-To-Left) orientation, load the RTL CSS file after fileinput.css by uncommenting below -->
<!-- link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/css/fileinput-rtl.min.css" media="all" rel="stylesheet" type="text/css" /-->
<!-- piexif.min.js is needed for auto orienting image files OR when restoring exif data in resized images and when you
    wish to resize images before upload. This must be loaded before fileinput.min.js -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/plugins/piexif.min.js" type="text/javascript"></script>
<!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview. 
    This must be loaded before fileinput.min.js -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/plugins/sortable.min.js" type="text/javascript"></script>
<!-- bootstrap.bundle.min.js below is needed if you wish to zoom and preview file content in a detail modal
    dialog. bootstrap 5.x or 4.x is supported. You can also use the bootstrap js 3.3.x versions. -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<!-- the main fileinput plugin script JS file -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/fileinput.min.js"></script>
<!-- following theme script is needed to use the Font Awesome 5.x theme (`fas`). Uncomment if needed. -->
<!-- script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/themes/fas/theme.min.js"></script -->
<!-- optionally if you need translation for your language then include the locale file as mentioned below (replace LANG.js with your language locale) -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/locales/LANG.js"></script>