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

?>

<?php 
    $exist_doc = Yii::app()->db->createCommand("SELECT * from agent_service_provider where id=".$model->id)->queryRow();
     $initial_pre = $initial_pre_value = NULL;
     $initial_pre2 = $initial_pre_value2 = NULL;
if($exist_doc){
  $file_path = $exist_doc['file_path'];
  if($file_path){
    $initial_pre = '<a href="'.$file_path.'" target="_blank"  title="Click to see or download uploaded document"><img src="/themes/investuk/assets/applicant/images/print-icon.png"></a>';
    $initial_pre_value = true;
  }

  $file_path2 = $exist_doc['file_path_2'];
  if($file_path2){
    $initial_pre2 = '<a href="'.$file_path2.'" target="_blank"  title="Click to see or download uploaded document"><img src="/themes/investuk/assets/applicant/images/print-icon.png"></a>';
    $initial_pre_value2 = true;
  }
    
  }


  
  $this->renderPartial('validation',['user_id'=>$user_id,'initial_pre'=>$initial_pre,'initial_pre2'=>$initial_pre2 ]);
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
where  a.user_id='".$user_id."' AND a.is_revoke=0 AND sp_status AND sp_status NOT IN ('PD')")->queryAll();

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
<form id="m_form" method="post" action="<?php echo Yii::app()->createAbsoluteUrl("/investor/serviceprovider/obspupdate/obsp/1/asp_id/'".base64_encode($model->id)."'"); ?>">
    <div class="form-part bussiness-det">   
      <h4 class="form-heading">Onboard CTSP / CR</h4>
        <div class="form-row">
          <div class="form-group rbcb-group">
            <label>Select Action Type
              <span style="color: red;">*</span>
            </label><br>

              <?php 
                  $at_ch_box1 = $model->action_type == 'Appointment of CTSP/CR' ? 'checked' : '';
                  $at_ch_box2 = $model->action_type == 'Change of CTSP/CR' ? 'checked' : '';
              ?>
              <input name="at_ch_box" type="radio" value="Appointment of CTSP/CR" class="chk_sp"
                    labelname="sp2" required <?= $at_ch_box1 ?> >&nbsp;
                   <span class="rc_label">Appointment of New CTSP/CR</span>
                   <br>
              <input name="at_ch_box" type="radio"  class="chk_sp" value="Change of CTSP/CR" labelname="sp1" required <?= $at_ch_box2 ?> >&nbsp;
                <span class="rc_label">Change of CTSP/CR</span>               
          </div>
       </div>

        <div class="form-row hidden" id="sp_type_div">
          <div class="form-group rbcb-group">
            <label>Select Type of Corporate Representative
             <span style="color: red;">*</span>
            </label><br>
            <?php 

                  $sp_type1 = $model->sp_type == 'Corporate Representative (CR)' ? 'checked' : '';
                  $sp_type2 = $model->sp_type == 'Corporate Trust Service Provider (CTSP)' ? 'checked' : '';
              ?>
                  <input name="sp_type" type="radio" value="Corporate Representative (CR)" class="chk_sp" labelname="sp2" required <?= $sp_type1 ?>>&nbsp;
                   <span class="spt_label">Corporate Representative (CR)</span>
              <br>
                   <input name="sp_type" type="radio"  class="chk_sp" value="Corporate Trust Service Provider (CTSP)" labelname="sp1" required <?= $sp_type2 ?>>&nbsp;
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
             $app_entity_type_id_s = $model->app_entity_type_id ==$aet_id ? 'checked' : '';
            ?>
                  <input name="app_entity_type_id" type="radio" value="<?= $aet_id ?>" class="chk_sp" labelname="sp2" required <?= $app_entity_type_id_s ?>>&nbsp;
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
            <?php 

                  $sp_ch_box1 = $model->first_name == '' ? 'checked' : '';
                  $sp_ch_box2 = $model->first_name != '' ? 'checked' : '';
              ?>
             <input name="sp_ch_box" type="radio" value="1" class="chk_sp"
                    labelname="sp2" required <?= $sp_ch_box1 ?>>&nbsp;
                   <span class="rc_label">Select existing <span class="rt_sp"></span></span>
                   <br>
               <input name="sp_ch_box" type="radio"  class="chk_sp" value="2"    labelname="sp1" required <?= $sp_ch_box2 ?>>&nbsp;
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
                   <option value=''>Please Select Service Provider </options>
                   <?php 
                    $sp_arr = Yii::app()->db->createCommand("SELECT CONCAT(p.first_name,' ',p.last_name,' ',p.surname) as full_name,  u.iuid, u.email, u.user_id
        FROM sso_users u INNER JOIN sso_profiles p ON p.user_id=u.user_id
        WHERE u.is_account_active='Y' AND u.user_type=2 AND sp_type='".$model->sp_type."'
        ")->queryAll();

                    
         $aselected  = '';
        foreach ($sp_arr as $k => $v) {
           if($model->first_name == ''){
          $aselected = $model->agent_user_id==$v['user_id'] ? 'selected' : ''; 
        }
           echo "<option $aselected value='$v[user_id]' >$v[full_name] $v[email]</options>";
        
       } ?> 
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
    <?php 
      $ind_ent1 = $model->service_provider_type == 'Individual' ? 'selected' : '';
      $ind_ent2 = $model->service_provider_type == 'Entity' ? 'selected' : '';
  ?>
      <select name="ind_ent" id="ind_ent" onchange="checkentity($(this).val())" class="select2-me" required>
         <option value="">Please Select </option>           
          <option value="Individual" <?=  $ind_ent1 ?>>Individual</option>
          <option value="Entity" <?=  $ind_ent2 ?>>Entity</option>        
      </select> 
         
</div>

<!-- <div class="col-lg-6 form-group text-start mb-3"></div> -->

<div class="col-lg-6 form-group text-start mb-3 hidden" id="div_e_name">
  <label>Name of the Entity<span style="color: red;">*</span></label>    
      <input type="text" value="<?= $model->entity_name ?>" name="entity_name" id="e_name" class="form-control" placeholder="Enter name of the entity" required>    
</div>

<div class="col-lg-6 form-group text-start mb-3 hidden" id="div_e_type">
  <label>Type of Entity<span style="color: red;">*</span></label>  
      <input type="text" value="<?= $model->entity_type ?>" name="entity_type" id="e_type" class="form-control" placeholder="Enter type of entity" required>    
</div>



 <div class="col-lg-12">
  <strong>Details of the Authorised Person:</strong>
</div><br><br>

 <div class="col-lg-6 form-group text-start mb-3">
      <label>First Name <span style="color: red;">*</span></label>         
      <input type="text" value="<?= $model->first_name ?>" name="first_name" id="first_name" class="form-control" placeholder="Enter First Name" required>       
  </div>

<div class="col-lg-6 form-group text-start mb-3">
  <?php if($model->middle_name){
      $mn_r = '';
      $mnc_c = '';
  }else{
      $mn_r = 'readonly';
      $mnc_c = 'checked';
  } ?>
    <label>Middle Name <span style="color: red;"></span></label>    
      <input type="text" value="<?= $model->middle_name ?>" id="middle_name" name="middle_name" class="form-control" placeholder="Enter Middle Name" <?= $mn_r ?>>
      <br>
      <input type='checkbox' id='middlenamecheckbox' name='middlenamecheckbox' <?= $mnc_c ?>> I do not have a middle name or middle initial
      <span id="middleerror" style="color: red;"></span>
</div>

<div class="col-lg-6 form-group text-start mb-3">
  <label>Last Name <span style="color: red;">*</span></label>   
     <input type="text" value="<?= $model->surname ?>" name="last_name" class="form-control" placeholder="Enter Last Name" required>  
</div>

<div class="col-lg-6 form-group text-start mb-3">
    <label>Gender<span style="color: red;">*</span></label>
     <?php 
      $g1 = $model->gender == 'Male' ? 'selected' : '';
      $g2 = $model->gender == 'Female' ? 'selected' : '';
      $g3 = $model->gender == 'Others' ? 'selected' : '';
  ?>
    <select name="gender" placeholder="Select gender" id="gender" class="select2-me" required>
         <option value="">Select gender </option>           
          <option value="Male" <?= $g1 ?>>Male</option>
          <option value="Female" <?= $g2 ?>>Female</option>
          <option value="Others" <?= $g3 ?>>Others</option>
    </select>   
</div>



<div class="col-lg-6 form-group text-start mb-3">
  <label>Mobile Number<span style="color: red;">*</span></label>  
    <input type="text" value="<?= $model->mobile ?>" name="mobile" id="mobile" class="form-control" placeholder="Enter Moible Number" minlength="10" maxlength="10" required>
</div>

<div class="col-lg-6 form-group text-start mb-3">
  <label>Email ID <span style="color: red;">*</span></label>  
      <input type="text" id="email" value="<?= $model->email ?>" name="email" class="form-control" placeholder="Enter Email ID" required>  
</div>



 <div class="col-lg-12"><strong>Details of Registered Office Address:</strong></div><br><br>
 <div class="col-lg-6 form-group text-start mb-3">
    <label>Registered Office: Address Line 1 <span style="color: red;">*</span></label>     
        <input type="text" id="addlin1" value="<?= $model->address_line1 ?>" name="addlin1" class="form-control" placeholder="Enter address line 1" required>     
  </div>

<div class="col-lg-6 form-group text-start mb-3">
      <label>Registered Office: Address Line 2</label>    
      <input type="text" id="addlin2" value="<?= $model->address_line2 ?>" name="addlin2" class="form-control" placeholder="Enter address line 2"> 
</div>

<div class="col-md-6 form-group text-start mb-3">                   
            <label>Registered Office: Country<span style="color: red;">*</span></label>
                <select name="country_id" id="country_id" class="select2-me" onchange="getstate($(this).val())" required>
                    <option value="">Select your country </option>

  <?php  $country_arr = Yii::app()->db->createCommand("SELECT * from bo_landregion where is_lr_active='Y' AND lr_type='country' AND parent_id=0")->queryAll();

   foreach ($country_arr  as $key => $val) { 
         $cselected = $model->country_id==$val['lr_id'] ? 'selected' : ''; 
      ?>
    <option value="<?php echo $val['lr_id']; ?>" <?= $cselected ?>><?php echo $val['lr_name']; ?></option>
    <?php } ?>
                </select>
</div> 

<div class="col-md-6 form-group text-start mb-3">                   
  <label>Registered Office: State/Parish<span style="color: red;">*</span></label>
  <?php 
  if($model->country_id){
      $psoptions =  Yii::app()->db->createCommand("SELECT lr_id,lr_name FROM bo_landregion where parent_id='$model->country_id' and lr_type='state' AND is_lr_active='Y'")->queryAll();
    }else{
      $psoptions = [];
    }
 
  ?>
      <select name="state_id" class="select2-me" id="state_id" required>
          <option value="">Select state/parish </option>
          <?php foreach($psoptions as $spv){
            $select = $model->state_id==$spv['lr_id'] ? 'selected' : '';
              echo "<option value='".$spv['lr_id']."' $select>".$spv['lr_name']."</option>";
          } ?>
      </select> 
 
</div> 


<div class="col-lg-6 form-group text-start mb-3">
      <label>Registered Office: City</label>      
      <input type="text" id="city"  value="<?= $model->city_name ?>" name="city" class="form-control" placeholder="Enter city">   
</div>

<div class="col-lg-6 form-group text-start mb-3">
      <label>Registered Office: Postal Code</label>   
      <input type="text" id="pin_code" value="<?= $model->pin_code ?>" name="pin_code" class="form-control" placeholder="Enter postal code"> 
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
               $selectae = $model->company_id==$val['id'] ? 'selected' : '';
             ?>
              <option value="<?php echo $val['id']; ?>" <?= $selectae ?>>
                <?php echo $val['reg_no'].' '.$val['company_name']; ?>
              </option>
              <?php } ?>
        </select>    
    </div> 
    <div class="col-md-12 form-group text-start mb-3" id="match_date_div">
       <label><span id="match_date_label"></span></label>  <br> 
        <input type="inputType" autocomplete="off" value="<?= $model->match_date ?>" id="match_date" name="match_date" class="datepicker form-control" required readonly="" onchange="sdlfc($(this).val())">
        <span id="dateof_error" style="color: red;"></span>
      </div>

    <div class="col-md-6 form-group text-start mb-3 hidden" id="late_fee_div">
       <label>Late Fees (BBD $)<span style="color: red;">*</span> </label>  <br> 
       <input type="inputType" value="<?= $model->late_fee ?>"  autocomplete="off" id="late_fee" name="late_fee" class="form-control" readonly="">        
    </div>


 <div class="col-md-12 form-group rbcb-group mb-3">  
  <label>Terms & condition <span style="color: red;">*</span></label>  <br> 
  <input type='checkbox' id='tc'   name='tc' required checked> I, being the Director hereby give my consent to appoint as the <span class="rt_sp"></span> of the Entity.
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
where  a.user_id='".$user_id."'  ORDER BY a.created_on DESC")->queryAll();

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