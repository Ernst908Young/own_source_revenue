<?php 
	//print_r($_GET); die;
	$serviceID=$_GET['service_id'];
	$formID=$_GET['form_id']; 
	$formCodeID=$_GET['formCodeID']; 
	$page_id = $formData[0]['page_name'];
	$idd = $formData[0]['id'];
	$preference_ = $formData[0]['preference'];
?>
<style>
  .red{color:red;padding: 2px;}
  .col-md-3{margin-top: 20px;}
  .col-md-2 {margin-top: 20px;}
  .portlet.box .dataTables_wrapper .dt-buttons { margin-top: -53px !important;}
  .errorSummary{ color:red;}
</style>
<link rel="stylesheet" href="<?=Yii::app()->theme->baseUrl?>/assets/frontend/dashboard/css/plugins/select2/select2.css">
<!-- select2 -->
<script src="<?=Yii::app()->theme->baseUrl?>/assets/frontend/dashboard/js/plugins/select2/select2.min.js"></script>
<!-- Theme framework -->
<script src="<?=Yii::app()->theme->baseUrl?>/assets/frontend/dashboard/js/eakroko.min.js"></script>
<?php  
 //echo "<pre/>"; print_r($formData);die;
//echo $formData[0]['service_id']; die;
?>
<div class='portlet box green'>
  <div class="portlet-title">
      <div class="caption" >
      <i class="fa fa-plus-square-o font-dark" style="color:#fff !important;"></i>
      <span class="caption-subject font-dark bold uppercase" style="color:#fff !important;">Update Sub Form Field for Service ID : <?php echo @$serviceID; ?></span>      
    </div>
    <div  style="float: right !important; padding: 5px;">
    	<a href="<?php echo Yii::app()->request->baseUrl; ?>/infowizard/formBuilder/createform/service_id/<?php echo $serviceID; ?>/pageID/<?php echo @$page_id; ?>/formCodeID/<?php echo $formCodeID;?>/formID/<?php echo $formID;?>" style="color:#fff;" class="pull-right btn btn-primary">Back</a>
    </div>
  </div>
  <div class="portlet-body">
    <form role="form" id="update_service">
      <div class="row">
      <div class="col-md-3"> 
            <?php  $allList=InfowizardQuestionMasterExt::getPageNameOfServiceForm(@$_GET[service_id],@$formCodeID); ?>
            <input type="hidden" name="page_id_" id="page_id_" value="<?php echo $page_id;?>">
            <input type="hidden" name="service_id_" id="service_id_" value="<?php echo $serviceID;?>">
            <input type="hidden" name="preference_" id="preference_" value="<?php echo$preference_;?>">
            <input type="hidden" name="idd" value="<?php echo $idd;?>">
          <select id="pagename" name="page_name" required class="form-control">
            <option value="">Select Page Name</option>		
            <?php if(!empty($allList)){
                	$selected='';
					foreach($allList as $k=>$v){
						// Getting First Page for paasing in URL while genrating Page
						if($formData[0]['page_name']==$k) { ?>
              <option value="<?php echo $k; ?>" selected><?php echo $v;?></option>  
            <?php } else {?>
						   <option value="<?php echo $k; ?>"><?php echo $v;?></option>  
					<?php } } 
			       }   ?>
          </select>
        </div>
        <div class="col-md-3">
          <select name="category_id" required id="formCATID" class="form-control">
            <!--<option value="">Select Category </option>-->
          </select>
        </div>       
         <div class="col-md-3">
          <input type="hidden" name="caption_slug">
          <input type="hidden" name="service_id" value="<?php echo $serviceID; ?>">
          <input type="hidden" name="sub_form" value="2<?php //echo $subform; ?>">
          <input type="hidden" name="form_id" value="<?php echo @$_GET['formCodeID']?>">
          <select class="select2-me" name="form_field_id" id="form_field_id">
            <!--<option value="">Form Field </option>-->
            <?php 
              $allList=InfowizardQuestionMasterExt::getMasterListTwoValue('bo_infowizard_formvariable_master','formvar_id','formchk_id','is_formvar_active','Y','name'); 
            ?>
            <?php 
            	$selected = '';
            	foreach($allList as $k=>$v){ 
            	//if($formData[0]['form_field_id']==$k){
            	if($formData[0]['form_field_id']==$k) $selected ='selected="selected"'; ?>
            	<option value="<?php echo $k; ?>" <?php if($formData[0]['form_field_id']==$k) echo "selected"; ?>> <?php echo $v; ?></option>  
            <?php } //} ?>
          </select> 
        </div>     
        <?php  ?>  
        
	<div class="col-md-3">
		<select  name="input_type" required class="form-control">
			<option value="">Field Type</option>
			<option value="text" <?php if($formData[0]['input_type']=='text') echo "selected"; ?>>Text </option>
			<option value="number" <?php if($formData[0]['input_type']=='number') echo "selected"; ?>>Number</option>
			<option value="email" <?php if($formData[0]['input_type']=='email') echo "selected"; ?>>Email</option>
			<option value="url" <?php if($formData[0]['input_type']=='url') echo "selected"; ?>>URL</option>
			<option value="textarea" <?php if($formData[0]['input_type']=='textarea') echo "selected"; ?>>Textarea</option>
			<option value="multipleselect" <?php if($formData[0]['input_type']=='multipleselect') echo "selected"; ?>>Multiple Select</option>
			<option value="select" <?php if($formData[0]['input_type']=='select') echo "selected"; ?>>Dropdown </option>
			<option value="radio" <?php if($formData[0]['input_type']=='radio') echo "selected"; ?>>Radio </option>
			<option value="checkbox" <?php if($formData[0]['input_type']=='checkbox') echo "selected"; ?>>Checkbox </option>
			<option value="password" <?php if($formData[0]['input_type']=='password') echo "selected"; ?>>Password</option>
			<option value="calender" <?php if($formData[0]['input_type']=='calender') echo "selected"; ?>>Calendar</option>
			<option value="datetimecalendar" <?php if($formData[0]['input_type']=='datetimecalendar') echo "selected"; ?>>Date Time Calendar</option>
			<option value="button" <?php if($formData[0]['input_type']=='button') echo "selected"; ?>>Button</option>
			<option value="add_more_button" <?php if($formData[0]['input_type']=='add_more_button') echo "selected"; ?>>Add more button</option>
		</select>
	</div>
	<div class="col-md-3">
		<input type="text" name="helptext" placeholder="Input Field Help Text" class="form-control" value="<?php echo $formData[0]['helptext'];?>">
	</div>
	<div class="col-md-3">
		<select  name="is_with_caf" class="form-control">
			<option value="N" <?php if($formData[0]['is_with_caf']=='N') echo "selected"; ?>>To be used in CAF-No</option>
			<option value="Y" <?php if($formData[0]['is_with_caf']=='Y') echo "selected"; ?>>To be used in CAF-Yes</option>
		</select>
	</div>
	<div class="col-md-3">
		<select name="is_required" class="form-control">
			<option value="N" <?php if($formData[0]['is_required']=='N') echo "selected"; ?>>Is Mandatory-No</option>
			<option value="Y" <?php if($formData[0]['is_required']=='Y') echo "selected"; ?>>Is Mandatory-Yes</option>
		</select>
	</div>
	<div class="col-md-3">
		<select name="validation_rule" class="form-control">
			<option value="">No Extra Validation</option>                         
			<option value="email" <?php if($formData[0]['validation_rule']=='email') echo "selected"; ?>>Email </option>
			<option value="number" <?php if($formData[0]['validation_rule']=='number') echo "selected"; ?>>Number</option>
			<option value="alphanumeric" <?php if($formData[0]['validation_rule']=='alphanumeric') echo "selected"; ?>>Alphanumeric</option>
			<option value="date" <?php if($formData[0]['validation_rule']=='date') echo "selected"; ?>>Date </option>
		</select>
	</div>
	<div class="col-md-3">
		<select  name="row_type" readonly  class="form-control">
			<option value="">In A Row</option>                         
			<option value="1">1</option>
			<option value="2" selected>2</option>
			<option value="3">3</option>
			<option value="4">4</option>
		</select>
	</div>
	 <div class="col-md-3">
      <input type="number" name="min_length" placeholder="minlength" class="form-control" value="<?php if($formData[0]['max_length']) echo $formData[0]['max_length'];?>"> 
    </div>
    <div class="col-md-3">
      <input type="number" name="max_length" placeholder="maxlength" class="form-control" value="<?php echo $formData[0]['max_length'];?>"> 
    </div>
	<div class="col-md-3">
		<!--  <input type="number" name="preference" class="form-control" placeholder="Preference">-->
		<?php  //echo $formData[0]['preference']."Pankaj"; ?>
		<select  name="preference" id="preferenceUnderCategory" class="form-control">
			<option value="0">Form Field Preference</option>
		</select>
	</div>
	 <div class="col-md-3">
        <select  name="is_editable" class="form-control">
              <option value="N" <?php if($formData[0]['is_editable']=='N') echo "selected"; ?>>Is Editable - No </option>
              <option value="Y" <?php if($formData[0]['is_editable']=='Y') echo "selected"; ?>>Is Editable - Yes</option>
        </select>
    </div>
	<div class="col-md-2">
		<div class="actions">
			<a class="btn btn-primary" href="javascript:void(0);" id="Update">
				<i class="fa fa-floppy-o"></i> Update Sub Form Field for Service ID : <?php echo @$serviceID; ?> 
			</a>
		</div>
	</div>
	<div class="col-md-2">&nbsp;</div>
	<!--<div class="col-md-2">
		<div class="actions">
			<a class="btn btn-primary" href="javascript:void(0);" id="AddMore">
				<i class="fa fa-floppy-o"></i> Delete Sub Form Field for Service ID : <?php echo @$serviceID; ?> 
			</a>
		</div>        
	</div>-->
</form>
</div>
</div>
<script>
	$(document).ready(function () {
		//page_id_
		var page_id_=$('#page_id_').val();
		var preference_ =$('#preference_').val();
		var cat_id_ = $("#formCATID").val();
		var pageID=$("#pagename").val();
		//if(page_id_) {
		//	$('#page_id_').prop('disabled', true);
		//}
		get_cat(page_id_,'sel');
		get_prefrence(cat_id_,pageID,preference_);

		$("#pagename").change(function(){		
         var pageID=$(this).val();  
         get_cat(pageID,null);
      });
       $("#formCATID").change(function(){
        var categoryID=$(this).val(); 
        preference_ = 0;     
        get_prefrence(categoryID,pageID,preference_);
           	   
      });
       function get_prefrence(cat_id,page_id,prefrence){
       	$.ajax({
          type: "POST",
          url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/formBuilder/getUpdatPageCategoryPreference/pageID/"+page_id+"/categoryID/"+cat_id+"/serviceID/<?php echo @$_GET['service_id'];?>/formCodeID/<?php echo @$_GET['formCodeID'];?>/pref/"+prefrence,
          success: function (data) {
              $("#preferenceUnderCategory").html(data);              
           }
        });    
       }
       function get_cat(pageID){
       	$data = "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/formBuilder/getMappedCategoryWithPageUpdate/pageID/"+pageID+"/formCodeID/<?php echo $_GET['formCodeID'];?>/selected/<?php echo $formData[0]['category_id'];?>";       
       	$.ajax({
          type: "POST",
          url: $data,
          success: function (data) {
              $("#formCATID").html(data);
             // alert(data);
           // location.reload();
          }
        });
       }

       $("#Update").click(function () {
        $.ajax({
          type: "POST",
          data: $("#update_service").serialize(),
          url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/formBuilder/updateformajax/",
          success: function (data) {
          	alert('Sucessfully Updated'); 
            //location.reload();
            window.location.href="<?php echo Yii::app()->request->baseUrl; ?>/infowizard/formBuilder/createform/service_id/<?php echo $serviceID; ?>/pageID/<?php echo @$page_id; ?>/formCodeID/<?php echo $formCodeID;?>/formID/<?php echo $formID;?>";
            //console.log(data);
          }
        });
      });
	});
</script>