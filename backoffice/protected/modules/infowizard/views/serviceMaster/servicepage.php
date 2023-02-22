<div class="dashboard-home">
   <div class="applied-status">
        <div class="status-title d-flex flex-wrap align-items-center justify-content-between">
            <h4>Add New Service</h4>
        </div>
        <br>
         <form name="" action="" method="POST">
			
  <div class="row">
	
<div class="col-md-6">
	<label  for="application_name" >State/Central<span class="required">*</span></label>

			
		<select name="central_state" id="central_state" class="form-control"  onchange="showUser(this.value)" required  >
		<?php  $sql = "SELECT issuer_id,name FROM bo_infowizard_issuer_master where is_issuer_active='Y' and issuer_id IN (1,2)";
$connection = Yii::app()->db;
$command = $connection->createCommand($sql);
$AllIssuer = $command->queryAll();
echo "<option value=''><-----Select-----></option>";
if (isset($AllIssuer)) {
foreach ($AllIssuer as $v) {
echo "<option value='$v[issuer_id]'>$v[name]</option>";
}
}
?>
		</select>
	
</div>

	
		<div class="col-md-6">
	<label  for="application_name" >Select Department <span class="required">*</span></label>
			
	<select class="form-control"  name="issuerby_id" id="issuerby_id" >
		<option value="CAIPO">CAIPO</option>
	</select>
	
</div>
</div>
	          
         <br>  
			
			<div class="row">
	        <div class="col-md-6">
			<label for="application_name" >Enter Service Name<span class="required">*</span></label>
			
		
		<input type="text" id="service_name" maxlength="500" class="form-control lettersonly" value="" name="service_name" placeholder="* Name of the Service" size="60"
		 maxlength="500"  required />
	</div>  
	</div>
			  
			   <br>  
			
			<div class="row">
	<div class="col-md-12">
	<label for="application_name" >Service Incidence <span class="required">*</span></label>
		
		<br>
                      <input type="checkbox"  id="incidence_pre_establishment"   value="1" name="incidence_pre_establishment" >    Pre Establishment 
                       
		
                        <input type="checkbox"  id="incidence_pre_operation"   value="1" name="incidence_pre_operation" >  Pre Operations 
                       
		
	
                       <input type="checkbox"  id="incidence_post_operation"   value="1" name="incidence_post_operation" >   Post Operations  
                      
		
                            
                           
                       <input type="checkbox"  id="incidence_post_operation"   value="1" name="is_incentive">   Is Incentive  
                      
	</div></div>
                
               <!-- <div class="row">
	        <div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >To Be Used In CIS<span class="required">*</span></label>
			<div class="col-md-8">
                            <select name="to_be_used_in_cis" class="form-control">
                                   <option value="N">No</option>
                                <option value="Y">Yes</option>                            
                            </select>
		
	</div></div></div> 
	<div class="row">
	        <div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >To Be Used In Online Offline<span class="required">*</span></label>
			<div class="col-md-8">
                            <select name="to_be_used_in_online_offline" class="form-control">
                                      <option value="N">No</option>
                                <option value="Y">Yes</option>
                          
                            </select>
		
	</div></div></div> 
	<div class="row">
	        <div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >To Be Used In Information Wizard<span class="required">*</span></label>
			<div class="col-md-8">
                            <select name="to_be_used_in_iw" class="form-control">
                                      <option value="N">No</option>
                                <option value="Y">Yes</option>  
                            </select>
		
	</div></div></div> 
	<div class="row">
	        <div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >To Be Used In CAF 2<span class="required">*</span></label>
			<div class="col-md-8">
                            <select name="to_be_used_in_caf_2" class="form-control">
                                        <option value="N">No</option>
                                <option value="Y">Yes</option>  
                            </select>
		
	</div></div></div> 
	<div class="row">
	        <div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >To Be Used In Sectorial Clearances<span class="required">*</span></label>
			<div class="col-md-8">
                            <select name="to_be_used_in_construction_permit" class="form-control">
                                        <option value="N">No</option>
                                <option value="Y">Yes</option>  
                            </select>
		
	</div></div></div>-->
	<br>
	<div class="row">
	   <div class="ol-md-6">
			<label  for="application_name" > Sector Type <span class="required">*</span></label>
		
			<select name="service_sector[]" id="service_sector" class="form-control" multiple="multiple" required >
<?php  $sql = "select id,name from bo_information_wizard_sector";
$connection = Yii::app()->db;
$command = $connection->createCommand($sql);
$AllSector = $command->queryAll();/*
$vq="";
foreach ($AllSector as $v) {
    $vq=$vq.",".$v['id'];
}
echo "<option value='$vq'>All</option>";*/

if (isset($AllSector)) {
foreach ($AllSector as $v) {
echo "<option value='$v[id]' >$v[name]</option>";
}
}
?>
</select>
        <p>( You can select multiple option by pressing CTRL  ) </p>
	</div></div>
			                    
	
	<br>
	<input type="submit" value="Save & Next" class="btn btn-primary" >
  	
                
                
            </form>
    </div>
</div>

           
     
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
	   </script>