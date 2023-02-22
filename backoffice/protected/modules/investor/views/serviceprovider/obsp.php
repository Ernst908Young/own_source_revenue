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
<?php if(Yii::app()->user->hasFlash('success')): ?>

<div style="text-align:center;font-size:16px;color:green;">
    <?php echo Yii::app()->user->getFlash('success'); ?>
</div>

<?php endif; ?> 
<?php if(Yii::app()->user->hasFlash('error')): ?>

<div style="text-align:center;font-size:16px;color:red;">
    <?php echo Yii::app()->user->getFlash('error'); ?>
</div>

<?php endif; ?> 
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<div id="overlay" style="display: none;">
  <div id="overlay_text" style="color: red;">
     <div style="text-align: center; vertical-align: middle;">
     <!--  <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><br> -->
     <strong id="overlay_label">Loading...</strong>
   </div>
  </div>
</div>

<?php 



 
$basePath="/themes/investuk";

 $user_id = $_SESSION['RESPONSE']['user_id'];

 $comp_arr = BoCompanyDetails::GetAllentity($user_id);

 /*$post_data= array('host'=>'smtp.gmail.com','port'=>'587','user'=>'caipodummy@gmail.com','pass'=>'caipo@1234', 'subject'=>'Test Mail','to'=>'zenmax20820@gmail.com','content'=>'Hi aamir','email_name'=>'CAIPO TEST');       

 Yii::import('application.extensions.phpmailer.PHPMailer');
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host = EMAIL_HOST;                    // Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   // Enable SMTP authentication
            $mail->Username = EMAIL_USERNAME;                     // SMTP username
            $mail->Password = EMAIL_PASSWORD;                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port = 587;                                    // TCP port to connect to
            $mail->setFrom(EMAIL_USERNAME, 'GOV.BB');
            $mail->addAddress($to);               // Name is optional
            $mail->addReplyTo(EMAIL_USERNAME, 'GOV.BB');
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->send();
        } catch (Exception $e) {
            echo "<br>Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }*/
                 
?>

<?php 
    $exist_doc = Yii::app()->db->createCommand("SELECT * from agent_service_provider_file_temp where doc_no=1 AND user_id=".$_SESSION['RESPONSE']['user_id']." ORDER BY id DESC")->queryRow();

if($exist_doc){
  $file_path = $exist_doc['file_path'];
  $initial_pre = '<a href="'.$file_path.'" target="_blank"  title="Click to see or download uploaded document"><img src="/themes/investuk/assets/applicant/images/print-icon.png"></a>';
    $initial_pre_value = true;
  }else{
     $initial_pre = $initial_pre_value = NULL;
  }


   $exist_doc2 = Yii::app()->db->createCommand("SELECT * from agent_service_provider_file_temp where doc_no=2 AND user_id=".$_SESSION['RESPONSE']['user_id']." ORDER BY id DESC")->queryRow();
if($exist_doc2){
  $file_path2 = $exist_doc2['file_path'];
  $initial_pre2 = '<a href="'.$file_path2.'" target="_blank"  title="Click to see or download uploaded document"><img src="/themes/investuk/assets/applicant/images/print-icon.png"></a>';
    $initial_pre_value2 = true;
  }else{
     $initial_pre2 = $initial_pre_value2 = NULL;
  }

 // $this->renderPartial('validation',['user_id'=>$user_id,'initial_pre'=>$initial_pre]);
  
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
where a.sp_status IN ('N','O','PD','PI') AND a.user_id='".$user_id."' AND a.is_revoke=0")->queryAll();



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
                   <span class="rc_label">Appointment of New CTSP/CR</span>
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
      <input type="text" name="entity_name" id="e_name" class="form-control" placeholder="Enter name of the entity" required>    
</div>

<div class="col-lg-6 form-group text-start mb-3 hidden" id="div_e_type">
  <label>Type of Entity<span style="color: red;">*</span></label>  
      <input type="text" name="entity_type" id="e_type" class="form-control" placeholder="Enter type of entity" required>    
</div>



 <div class="col-lg-12">
  <strong>Details of the Authorised Person:</strong>
</div><br><br>

 <div class="col-lg-6 form-group text-start mb-3">
      <label>First Name <span style="color: red;">*</span></label>         
            <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter First Name" required>       
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

<div class="col-md-6 form-group text-start mb-3">                   
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

<div class="comman_sp_form hidden" id="comman_sp_form">
<div class="form-row row"> 
    <div class="col-md-6 form-group text-start mb-3">                   
      <label>Select Entity<span style="color: red;">*</span></label>
       <!--  <select name="entity_id" id="entity_id" class="select2-me" onchange="getdates($(this).val())" required> -->
           <select name="entity_id" id="entity_id" class="select2-me" required>
            <option value="">Select entity </option>
            <?php foreach ($unassigen_entity  as $key => $val) {
               
             ?>
              <option value="<?php echo $val['id']; ?>">
                <?php echo $val['reg_no'].' '.$val['company_name']; ?>
              </option>
              <?php } ?>
        </select>    
    </div> 
    <div class="col-md-12 form-group text-start mb-3" id="match_date_div">
       <label><span id="match_date_label"></span></label>  <br> 
        <input type="inputType" autocomplete="off" id="match_date" name="match_date" class="datepicker form-control" required readonly="" onchange="sdlfc($(this).val())">
        <span id="dateof_error" style="color: red;"></span>
      </div>

    <div class="col-md-6 form-group text-start mb-3 hidden" id="late_fee_div">
       <label>Late Fees (BBD $)</label>  <br> 
       <input type="inputType" autocomplete="off" id="late_fee" name="late_fee" class="form-control" readonly="">        
    </div>


 <div class="col-md-12 form-group rbcb-group mb-3">  
  <label>Terms & condition <span style="color: red;">*</span></label>  <br> 
  <input type='checkbox' id='tc' name='tc' required> I, being the Director hereby give my consent to appoint as the <span class="rt_sp"></span> of the Entity.
 </div>

 <div class="col-md-6 form-group rbcb-group mb-3 hidden" id="dec_document">  
  <label>Signed version of the declaration attachment  <span style="color: red;">*</span></label>  <br> 
  <?php if($initial_pre_value){
    $f_is_required = '';
  }else{
    $f_is_required = 'required';
  } ?>
  <input type="file" id="input-id" name="input-100" accept="image/*, application/pdf" <?= $f_is_required ?>>
            <!-- <input type="file" id="input-id" name="input-100[]" multiple>  -->
     <small><i>(Please upload PDF, JPG, PNG only.)</i></small>
 </div>

<?php
  $finance_doc_show = false;
 if($finance_doc_show==true){ ?>
 <div class="col-md-6 form-group rbcb-group mb-3 hidden" id="dec_document2">  
  <label>Financial Statements  <span style="color: red;">*</span></label>  <br> 
  <?php if($initial_pre_value2){
    $f_is_required2 = '';
  }else{
    $f_is_required2 = 'required';
  } ?>
  <input type="file" id="input-id2" name="input-101" accept="image/*, application/pdf" <?= $f_is_required2 ?>>
            <!-- <input type="file" id="input-id" name="input-100[]" multiple>  -->
            <small><i>(Please upload PDF, JPG, PNG only.)</i></small>
 </div>
<?php } ?>

  </div>
  <div class="form-row row">
    <div class="form-group col-md-12"  style="text-align: center;">
      <a href="javascript:void(0);" class="submitForm custome-btn" data-wizard-action="submit">
        <span id="action_btn">
            Submit
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
      <th>Representative</th>
      <th class="text-center">Type</th>
      <th class="text-center">Entity Detail</th>
      <th class="text-center">Status</th>
      <th class="text-center">Action</th>
    </tr> 
  </thead>
  <tbody>
<?php $sp_s_arr = ['N'=>'Nominated','O'=>'Onboarded','R'=>'Removed','PD'=>'Payment Due','PI'=>'Payment Initiated','NW'=>'Nomination withdrawn'];
$onboarded =  Yii::app()->db->createCommand("SELECT a.company_id, a.first_name, a.middle_name, a.surname,a.id ,a.email,c.reg_no,c.company_name, a.user_id, a.agent_user_id, a.sp_status, a.sp_type
FROM agent_service_provider a
LEFT JOIN bo_company_details c ON c.id = a.company_id
where  a.user_id='".$user_id."' ORDER BY a.created_on DESC")->queryAll();

     foreach($onboarded as $k=>$v){ ?>
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
                    where u.is_account_active='Y' AND u.user_id=".$v['agent_user_id'])->queryRow();
                    $sp_name = $spd['first_name'].' '.$spd['middle_name'].' '.$spd['surname'].'<br> '.$spd['email'];
                }else{                                 
                  $sp_name = $v['first_name'].' '.$v['middle_name'].' '.$v['surname'].'<br> '.$v['email'];
                }
           ?>
           <a href="#" onclick="logopen(<?= $v['id'] ?>)" style="color: blue;">
            <span id="sp_name_text<?= $v['id'] ?>"><?= $sp_name ?></span>
          </a>
        </td>
		
          <td class="text-center">
            <span id="sp_type_text<?= $v['id'] ?>">
               <?= $v['sp_type']  ?>
          </span>
        </td>
         <td class="text-center">
           <span id="comp_name_text<?= $v['id'] ?>">
            <?= $v['company_name'] ? $v['company_name'] : 'NA' ?> <br> <?= $v['reg_no'] ? $v['reg_no'] : 'NA' ?>
          </span>
        </td>
        <td class="text-center">
          <?php
              if(array_key_exists($v['sp_status'], $sp_s_arr)){
                if($v['sp_status']=='PD'){
                  echo '<a href="/backoffice/investor/serviceprovider/payment/obsp/1/asp_id/'.base64_encode($v['id']).'" style="color:blue;">'.$sp_s_arr[$v['sp_status']].'</a>';
                }else{
                  echo $sp_s_arr[$v['sp_status']];
                }
              }else{
                echo ' No Status';
              }
            ?>
        </td>
        <td class="text-center">
          <?php if($v['sp_status']=='PI'){ ?>
              <a target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl('investor/serviceprovider/printofflinefeeform/asp_id/'. base64_encode($v['id']));?>" title="Offline Payment Form">  
              <img src="<?php echo $basePath; ?>/assets/applicant/images/ic_print_refund.png">
          <?php } ?>
          <?php if($v['sp_status']=='N'){ ?>
                 <a href="#" onclick="emailresend(<?= $v['id'] ?>)" style="color: blue;">Resend Email</a> | <a href="#" onclick="withomireq(<?= $v['id'] ?>)" style="color: blue;">Withdraw nomination request</a>
          <?php } ?>
          <?php if($v['sp_status']=='O'){ ?>
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
  echo "<div class='reservation-form'> <strong style='text-align:center;'>Sorry! Please register an entity first in order to onboard the Representative.</strong></div>";
} ?>


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
             window.location.href = "/backoffice/investor/serviceprovider/observiceprovider/obsp/1";
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

  $(document).ready(function () {

    var date = new Date();
    date.setDate(date.getDate());
    $(".datepicker").datepicker({
      changeMonth: true,
      changeYear: true,
      maxDate: date,
      dateFormat: 'dd-mm-yy'
    });

 
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
       //$("input[name=date_of]").prop('checked', false); 
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
   // $("input[name=date_of]").prop('checked', false); 
    $('#entity_id').val("").trigger("change");
    $('#match_date, #late_fee').val("");
});

/*$("input[name=date_of]").on("change",function(){     
   documentsh();
   $('#entity_id').val("").trigger("change");
    $('#match_date, #late_fee').val("");
});*/



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
  //  deleteUrl: "http://localhost/file-delete.php"
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

   // $("#date_of_div").addClass('hidden');
    $("#late_fee_div").addClass('hidden');
    $("#late_fee").val("");
    $("#dec_document2").addClass('hidden');
        $("#match_date").val("");
        $("#match_date").css('pointer-events','');       
    if(sp_type=="Corporate Trust Service Provider (CTSP)"){
      if(app_entity_type_id==1){
        $("#dec_document").removeClass('hidden');
        $("#match_date_div").removeClass('hidden');
       /* $("#match_date_label").html("Date of Incorporation of the Entity <span style='color: red;'>*</span>");*/
        $("#match_date_label").html("Date of Appointment <span style='color: red;'>*</span>");
        $("#match_date").attr('placeholder','Click to select date');              
        //$("#match_date").css('pointer-events','none');
       
      }else{
        if(app_entity_type_id==2){
          $("#dec_document").removeClass('hidden');
          //$("#dec_document2").removeClass('hidden');
          $("#match_date_div").removeClass('hidden');
          /*$("#match_date_label").html("End date of Financial Year in which company's gross revenue exceeded $1 million as per the financial statements <span style='color: red;'>*</span>");*/
          $("#match_date_label").html("Date of Appointment <span style='color: red;'>*</span>");
          $("#match_date").attr('placeholder','Click to select date');
        }else{
          if(app_entity_type_id==3){
 
            $("#dec_document").removeClass('hidden');
             $("#match_date_div").removeClass('hidden');
          /*$("#match_date_label").html("Date on which the Limited Partnership appointed a partner which is an entity that has been incorporated, registered, or otherwise constituted outside of Barbados <span style='color: red;'>*</span>");*/
           $("#match_date_label").html("Date of Appointment <span style='color: red;'>*</span>");
          $("#match_date").attr('placeholder','Click to select date');
           
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