<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>Create Service Master</div>
    <div class='tools'>
	
	</div>
	
</div>
<div class="portlet-body">

<div class="site-min-height">
<div class="form form-horizontal" role="form">

            <form name="" action="" method="POST">
		<?php $sql = "SELECT issuer_id,name FROM bo_infowizard_issuer_master where is_issuer_active='Y' and issuer_id IN (1,2)";
$connection = Yii::app()->db;
$command = $connection->createCommand($sql);
$AllIssuer = $command->queryAll();
//print_r($AllIssuer);die; 
?>
            <div class="row">
	<div class="form-group col-md-6">
	<label class="col-lg-4 col-sm-4 control-label" for="application_name" >State/Central<span class="required">*</span></label>
			<div class="col-md-8">
		<select name="central_state" id="central_state" class="form-control"  onchange="showUser(this.value)" required  >
		<?php $issuer_id=$model['central_state'];
		
echo "<option value=''><-----Select-----></option>";
if (isset($AllIssuer)) {
foreach ($AllIssuer as $v) { ?>
<option value="<?php echo $v['issuer_id']; ?>" <?php if($v['issuer_id']==$model['central_state']) echo "selected"; ?>><?php echo $v['name']; ?></option>
<?php 
}
}

?>

		</select>
	</div></div></div>
	
	<div class="row">
	<div class="form-group col-md-6">
	<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Select Department <span class="required">*</span></label>
			<div class="col-md-8">
			<?php if(!empty($model['issuerby_id'])) {  $data=$model['issuerby_id'];  ?>
			
<select name="issuerby_id" id="issuerby_id" class="form-control"  required  >

<?php  $sql="SELECT m.issmap_id as issmap_id,i.name as name FROM bo_infowizard_issuer_mapping m,bo_infowizard_issuerby_master i WHERE m.issuer_id=$issuer_id and 
		i.issuerby_id = m.issuerby_id and is_issmap_active='Y'";
$connection = Yii::app()->db;
$command = $connection->createCommand($sql);
$AllIssuerBy = $command->queryAll();
echo "<option value=''><-----Select-----></option>";
if (isset($AllIssuerBy)) {
foreach ($AllIssuerBy as $vs) { ?>
<option value="<?php echo $vs['issmap_id']; ?>" <?php if($vs['issmap_id']==$data) echo "selected"; ?> ><?php echo $vs['name']; ?></option>
<?php 
}
}

?>
</select>
			
	<?php	} else { ?>

	<select class="form-control"  name="issuerby_id" id="issuerby_id" ></select>
	<?php  } ?>
	</div></div></div>
	          
           
			
			<div class="row">
	        <div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Enter Service Name<span class="required">*</span></label>
			<div class="col-md-8">
		
		<input type="text" id="service_name" maxlength="500" class="form-control lettersonly" value="<?php echo $model['service_name'];?>" name="service_name" placeholder="* Name of the Service" size="60" maxlength="255" required />
	</div></div></div>  
	
			  
			  <div class="row">
	<div class="form-group col-md-6">
	<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Service Incidence <span class="required">*</span></label>
			<div class="col-md-8">
			 <label class="col-lg-4 col-sm-4 control-label " for="service_incidence" >
                      <input type="checkbox"  id="incidence_pre_establishment"   value="1" name="incidence_pre_establishment" <?php if(!empty($model['incidence_pre_establishment'])){ echo "checked"; } ?> >    Pre Establishment 
                        </label>
		 <label class="col-lg-4 col-sm-4 control-label " for="service_incidence" >
                        <input type="checkbox"  id="incidence_pre_operation"   value="1" name="incidence_pre_operation" <?php if(!empty($model['incidence_pre_operation'])){ echo "checked"; } ?>>  Pre Operations 
                        </label>
		
		 <label class="col-lg-4 col-sm-4 control-label " for="service_incidence" >
                       <input type="checkbox"  id="incidence_post_operation"   value="1" name="incidence_post_operation"  >   Post Operations  
                        </label>
                            
                             <label class="col-lg-4 col-sm-4 control-label " for="is_incentive" >
                       <input type="checkbox"  id="is_incentive"   value="1" name="is_incentive" <?php if(!empty($model['is_incentive'])){ echo "checked"; } ?>>   Is Incentive  
                        </label>
		
	</div></div></div>
                
                
                			  <div class="row">
	<div class="form-group col-md-6">
	<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Service Incidence <span class="required">*</span></label>
			<div class="col-md-8">
			 <label class="col-lg-4 col-sm-4 control-label " for="service_incidence" >
                      <input type="checkbox"  id="incidence_pre_establishment"   value="1" name="incidence_pre_establishment" <?php if(!empty($model['incidence_pre_establishment'])){ echo "checked"; } ?> >    Pre Establishment 
                        </label>
		 <label class="col-lg-4 col-sm-4 control-label " for="service_incidence" >
                        <input type="checkbox"  id="incidence_pre_operation"   value="1" name="incidence_pre_operation" <?php if(!empty($model['incidence_pre_operation'])){ echo "checked"; } ?>>  Pre Operations 
                        </label>
		
		 <label class="col-lg-4 col-sm-4 control-label " for="service_incidence" >
                       <input type="checkbox"  id="incidence_post_operation"   value="1" name="incidence_post_operation"  >   Post Operations  
                        </label>
                            
                             <label class="col-lg-4 col-sm-4 control-label " for="is_incentive" >
                       <input type="checkbox"  id="is_incentive"   value="1" name="is_incentive" <?php if(!empty($model['is_incentive'])){ echo "checked"; } ?>>   Is Incentive  
                        </label>
		
	</div></div></div>
        <div class="row">
	<div class="form-group col-md-6">
	<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Incentive Scheme<span class="required">*</span></label>
        <div class="col-md-8">
        <select name="incentive_id" id="incentive_id" class="form-control"  <!--onchange="showUser(this.value)"--> required  >
        <?php   		
              echo "<option value=''><-----Select-----></option>";
              $sql = "select service_id,service_name from bo_incentive_master";
              $connection = Yii::app()->db;
              $command = $connection->createCommand($sql);
              $AllInc = $command->queryAll();

              if (!empty($AllInc)) {
              foreach ($AllInc as $v) {
              ?>
             <option value="<?php echo $v['service_id']; ?>" <?php if($v['service_id']==$model['incentive_id']) echo "selected"; ?>><?php echo $v['service_name']; ?></option>
             <?php  }} ?>

        </select></div></div></div>
                
                
        <div class="row">
	<div class="form-group col-md-6">
	<label class="col-lg-4 col-sm-4 control-label" for="incentive_incidence" >Incentive Incidence<span class="required">*</span></label>
        <div class="col-md-8">
            <?php $options=explode(',',$model['incentive_incidence_code']); ?>
			
<select name="incentive_incidence_code[]" id="servicincentive_incidence" class="form-control" multiple="multiple" required >
       
        <?php   		
              $sql = "select incentive_incidence_code,incentive_incidence_name from bo_incentive_incidence_master";
              $connection = Yii::app()->db;
              $command = $connection->createCommand($sql);
              $AllIncinc = $command->queryAll();

              if (!empty($AllIncinc)) {
              foreach ($AllIncinc as $v) {
              ?>
              <option value="<?php echo $v['incentive_incidence_code'];?>"  <?php if(in_array($v['incentive_incidence_code'],$options)){ echo "selected";} ?>> <?php echo $v['incentive_incidence_name']; ?></option>
             
             <?php  }} ?>

        </select></div></div></div> 
                	<!--<div class="row">
	        <div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >To Be Used In CIS<span class="required">*</span></label>
			<div class="col-md-8">
                            <select name="to_be_used_in_cis" class="form-control">
                                <option value="N" <?php //if(!empty($model['to_be_used_in_cis']) && $model['to_be_used_in_cis']=="N"){ echo " selected"; } ?>>No</option>                           
                                <option value="Y" <?php ////if(!empty($model['to_be_used_in_cis']) && $model['to_be_used_in_cis']=="Y"){ echo " selected"; } ?>>Yes</option>
                            </select>
		
	</div></div></div> 
	<div class="row">
	        <div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >To Be Used In Online Offline<span class="required">*</span></label>
			<div class="col-md-8">
                            <select name="to_be_used_in_online_offline" class="form-control">
                                   <option value="N" <?php //if(!empty($model['to_be_used_in_online_offline']) && $model['to_be_used_in_online_offline']=="N"){ echo " selected"; } ?>>No</option>
                            <option value="Y" <?php //if(!empty($model['to_be_used_in_online_offline']) && $model['to_be_used_in_online_offline']=="Y"){ echo " selected"; } ?>>Yes</option>
                            </select>
		
	</div></div></div> 
	<div class="row">
	        <div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >To Be Used In Information Wizard<span class="required">*</span></label>
			<div class="col-md-8">
                            <select name="to_be_used_in_iw" class="form-control">
                                <option value="N" <?php //if(!empty($model['to_be_used_in_iw']) && $model['to_be_used_in_iw']=="N"){ echo " selected"; } ?>>No</option>
                                <option value="Y" <?php //if(!empty($model['to_be_used_in_iw']) && $model['to_be_used_in_iw']=="Y"){ echo " selected"; } ?>>Yes</option>
                               
                            </select>
		
	</div></div></div>
		<div class="row">
	        <div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >To Be Used In CAF 2<span class="required">*</span></label>
			<div class="col-md-8">
                            <select name="to_be_used_in_caf_2" class="form-control">
                               <option value="N" <?php if(!empty($model['to_be_used_in_caf_2']) && $model['to_be_used_in_caf_2']=="N"){ echo " selected"; } ?>>No</option>
                                <option value="Y" <?php if(!empty($model['to_be_used_in_caf_2']) && $model['to_be_used_in_caf_2']=="Y"){ echo " selected"; } ?>>Yes</option>
                               
                           
                            </select>
                            </div></div></div>
							
							<div class="row">
	        <div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >To Be Used In Sectorial Clearances<span class="required">*</span></label>
			<div class="col-md-8">
                            <select name="to_be_used_in_construction_permit" class="form-control">
           <option value="N" <?php //if(!empty($model['to_be_used_in_construction_permit']) && $model['to_be_used_in_construction_permit']=="N"){ echo " selected"; } ?>>No</option>
           <option value="Y" <?php //if(!empty($model['to_be_used_in_construction_permit']) && $model['to_be_used_in_construction_permit']=="Y"){ echo " selected"; } ?>>Yes</option>
                               
                           
                            </select>
                            </div></div></div>-->
	<div class="row">
	   <div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" > Sector Type <span class="required">*</span></label>
			<div class="col-md-8">
			<?php $options=explode(',',$model['service_sector']); ?>
			
<select name="service_sector[]" id="service_sector" class="form-control" multiple="multiple" required >
<?php 
$sql = "select id,name from bo_information_wizard_sector";
$connection = Yii::app()->db;
$command = $connection->createCommand($sql);
$AllSector = $command->queryAll();

if (isset($AllSector)) {
foreach ($AllSector as $v) {
?>
<option value="<?php echo $v['id'];?>"  <?php if(in_array($v['id'],$options)){ echo "selected";} ?>> <?php echo $v['name']; ?></option>
<?php
}
}
?>
</select>
        <p>( You can select multiple option by pressing CTRL  ) </p>
	</div></div></div>
			                    
	
<div class="row buttons" align="center">
	<input type="submit" value="Save & Next" class="btn btn-primary" >
	</div>   	
                
                
            </form>
       </div></div></div></div><!-- form -->
	   <script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>

<script>
	function showUser(str) { //alert(str); //alert("<?php echo Yii::app()->request->baseUrl; ?>/infowizard/infowizarddocumentchklist/issuermapping"); 
$.ajax({
                type: "POST",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/InfowizardDocumentchklist/issuermappingall",
				dataType:'json',
			    data:
                {
                post_issuerid: str
                },
			   
               success:  function(data) { //alert(data);
			   var $select = $('#issuerby_id');
			   $select.html('');
                $.each(data, function(index, element) {
           	
					$select.append('<option value="' + element.issmap_id + '">' + element.name + '</option>');
        		});
				//alert(data);
				},
			
            error:function(jqXHR, textStatus, errorThrown){
                alert('error::'+errorThrown);
            }
            });
}


$(document).ready(function() {
    var $checkBox = $('#is_incentive'),
        $select = $('#incentive_incidence'),
        $select_inc = $('#incentive_id');
    if ($checkBox).is(':checked'){
        $select.removeAttr('disabled');
        $select_inc.removeAttr('disabled');
    }else{
       $select.attr('disabled','disabled');
       $select_inc.attr('disabled','disabled');
    }        
$checkBox.on('change',function(e){
   // var tol = this.parent('.field').find('#is_incentive');
    if ($(this).is(':checked')){
        $select.removeAttr('disabled');
        $select_inc.removeAttr('disabled');
    }else{
       $select.attr('disabled','disabled');
       $select_inc.attr('disabled','disabled');
    }
});
});
	   </script>