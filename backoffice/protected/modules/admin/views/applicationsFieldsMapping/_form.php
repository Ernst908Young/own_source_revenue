<?php
   /* @var $this ApplicationsFieldsMappingController */
   /* @var $model ApplicationsFieldsMapping */
   /* @var $form CActiveForm */
   ?>
<div class="site-min-height">
<div class="form form-horizontal" role="form">
   <style type="text/css">
      .select_error{
      color:red;
      }
      .errorSummary{
      display: block;
      color:red;
      border: 1px solid red;
      }
      .btn_select{
      	    margin-top: 8px;
      	    padding: 0px 25px;
      	    top:25px;
      	    position: relative;
      }
   </style>
   <?php $form=$this->beginWidget('CActiveForm', array(
      'id'=>'applications-fields-mapping-form',
      // Please note: When you enable ajax validation, make sure the corresponding
      // controller action is handling ajax validation correctly.
      // There is a call to performAjaxValidation() commented in generated controller code.
      // See class documentation of CActiveForm for details on this.
      'enableAjaxValidation'=>false,
      )); ?>
   <p class="note">Fields with <span class="required">*</span> are required.</p>
   <?php echo "<div class='row'>";
      foreach(Yii::app()->user->getFlashes() as $key => $message) {
      echo '<font color="red"><div class="alert-message error"><p>' . $message . "</font></p></div>\n";
      }
      echo "</div>";
      ?>
   
      <?php echo $form->errorSummary($model);
         if(!$model->isNewRecord){
         	$app_name=ApplicationExt::getAppNameViaId($model->application_id);
         	$dept_name=ApplicationExt::getDeptNameFromAppId($model->application_id);
         	?>
   <div class="row ">
       <div class="form-group col-md-6">
         <label class="col-lg-4 col-sm-4 control-label" for="Application" ><?php echo $form->labelEx($model,'Application'); ?></label>
         <div class="col-md-8">
         <input type='text' readonly value="<?php echo $app_name['application_name'];?>" class='form-control'>
         <input type='hidden' name='ApplicationsFieldsMapping[application_id]' value="<?php echo $model->application_id;?>">
         </div>
      </div>
   </div>   

   <div class="row ">
       <div class="form-group col-md-6">
         <label class="col-lg-4 col-sm-4 control-label" for="Departments" ><?php echo $form->labelEx($model,'Departments'); ?></label>
         <div class="col-md-8">
         <input type='text' readonly value="<?php echo $dept_name;?>" class='form-control'>
         </div>
      </div>
   </div>

      <?php
         }
         else{
         ?>
         <div class="row ">
             <div class="form-group col-md-6">
               <label class="col-lg-4 col-sm-4 control-label" for="Departments" ><?php echo $form->labelEx($model,'Departments'); ?></label>
               <div class="col-md-8">
               <?php echo "<select id='ApplicationsFieldsMapping_dept_id' class='form-control' onchange='getApplications(\"".Yii::app()->createUrl('ajax/DeptApp')."\");'></select>";?>
               </div>
            </div>
         </div>

         <div class="row">
             <div class="form-group col-md-6">
               <label class="col-lg-4 col-sm-4 control-label" for="application_id" ><?php echo $form->labelEx($model,'application_id'); ?></label>
               <div class="col-md-8">
               <?php echo $form->DropDownList($model,'application_id',array(''=>'Please Select Appication'),array('class'=>'form-control')); ?>
               <?php echo $form->error($model,'application_id'); ?>
               </div>
            </div>
         </div>

      <?php }?>
      <div class="row">
         <div class="form-group col-md-5">
            <label class="col-lg-4 col-sm-4 control-label" for="field_id" >
            <?php echo $form->labelEx($model,'field_id');?></label>
            <div class="col-md-8">
               <?php 
                  if($model->isNewRecord){
               	$status='Y';$fields=Filelds::model()->findAll(array('select'=>'field_id, field_name','condition'=>'is_field_active=:status','params'=>array(':status'=>$status)));
                echo "<select class='form-control MasterSelectBox  new_field_mapping' multiple>";
                foreach ($fields as $field) {
                  echo "<option id='$field[field_id]' value='$field[field_id]'>$field[field_name]</option>";
                }
                echo "</select>";
      echo "</div>
         </div>";
   echo "<div class='form-group col-md-1'>";
      echo "<div style='float:left;margin:10px;''>
      			<a href='#' class='btn btn-default btn_select' id='btnAdd'>></a><br>
      			<a href='#' class='btn btn-default btn_select' id='btnRemove'><</a>
		      </div>
         </div>";
				
   echo "<div class='form-group col-md-5'>";
            ?>
             <label class="col-lg-4 col-sm-4 control-label" for="field_id">
            <?php
				echo $form->labelEx($model,'Select All Fields of this box');?></label>
            <div class="col-md-8">
            <?php
                echo "<select class='PairedSelectBox form-control' multiple  name='ApplicationsFieldsMapping[field_id][]'' id='ApplicationsFieldsMapping_field_id' style='min-width: 200px;float:left;'>
					  </select>";
               }
               else{
               		$f_name=FieldsExt::getFieldNameFromId($model->field_id);
               		echo "<input type='text' class='form-control' readonly value='$f_name[field_name]'>";
               		echo "<input type='hidden' name='ApplicationsFieldsMapping[field_id]' value='$model->field_id'>";
               	}
               ?>
            <?php echo $form->error($model,'field_id'); ?>
             </div>  
      </div>
   </div>
            
         <div class="row">
            <div class="col-md-6 col-md-offset-8">
               <?php if($model->isNewRecord){ ?>
                  <a data-toggle="modal" class="fields_properties_modal btn btn-info" href="#fields_properties"> Set Properties of Fields</a>
               <?php }?>
            </div>
         </div>

         <div class="row">
          <div class="form-group col-md-6">
            <label class="col-lg-12 col-sm-12 control-label">
               <input name="ApplicationsFieldsMapping_app_custom_css" id="custom_css" value="1" type="checkbox" > I want to add custom CSS for this Application.
            </label>
            <div class="col-md-12 custom_css_values">
            </div>
          </div>
         </div>
         
         <!-- Modal -->
         <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="fields_properties" class="modal fade">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                     <h4 class="modal-title">Properties of your Fields</h4>
                  </div>
                  <div class="modal-body">
                     <div class="row"><span class="select_error"></span></div>
                  </div>
                  <div class="modal-footer">
                     <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                     <button class="btn btn-success" data-dismiss="modal" type="button">Done</button>
                  </div>
               </div>
            </div>
         </div>
         <!-- modal -->
  
         <div class="row">
             <div class="form-group col-md-6">
               <label class="col-lg-4 col-sm-4 control-label" for="is_mapping_active" ><?php echo $form->labelEx($model,'is_mapping_active'); ?></label>
               <div class="col-md-8">
               <?php echo $form->dropDownList($model,'is_mapping_active',array('Y'=>'YES','N'=>'NO'),array('class'=>'form-control')); ?>
               <?php echo $form->error($model,'is_mapping_active'); ?>
               </div>
            </div>
         </div>

         <div class="row">
            <div class="form-gruop col-md-6">
               <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
            </div>
         </div>

      <?php $this->endWidget(); ?>

      </div><!-- form -->
</div>
<!-- min-height end here -->
<script type="text/javascript">
   $( document ).ready(function() {
   	var url ="<?php echo Yii::app()->createUrl('ajax/alldept');?>";
     	    getAllDeptAPI(url,'#ApplicationsFieldsMapping_dept_id');
    $('.MasterSelectBox').pairMaster();

    $('#btnAdd').click(function(){
    	$('.MasterSelectBox').addSelected('.PairedSelectBox');
    });

    $('#btnRemove').click(function(){
    	$('.PairedSelectBox').removeSelected('.MasterSelectBox'); 
    });
   });
</script>
<script type="text/javascript">
   $('#ApplicationsFieldsMapping_field_name').keyup(function(){
   	var fname=$('#ApplicationsFieldsMapping_field_name').val();
   	 fname = fname.replace(' ', '_');
   	 fname = fname.replace('/[^A-Za-z\-]/', ''); 
   	$('#ApplicationsFieldsMapping_field_name').val(fname);
   })
   /*$('#ApplicationsFieldsMapping_field_id').change(function(){
   	var f_id=$('#ApplicationsFieldsMapping_field_id').val();
   	var url="<?php echo Yii::app()->createUrl('ajax');?>";
   	getFieldsInfo(url,f_id);
   })*/
   $('.fields_properties_modal').click(function(event){
   	var f_id=$('#ApplicationsFieldsMapping_field_id').val();
   	if(f_id==null){
   		$('#fields_properties').modal('toggle');
   		$('.select_error').text('Please select the Fields First');
   		return false;
   	}
   	else{
   		$('.select_error').text('Please wait...');
   		$('.select_error').css('color','green');
   		var url="<?php echo Yii::app()->createUrl('ajax');?>";
   		getFieldsInfo(url,f_id);
   	}
   
   })
   $('#custom_css').click(function(){
   	if(this.checked) {
   		$('.custom_css_values').empty();
   		var txt_ara='<textarea class="form-control" name="custom_css_val" rows="10" id="custom_css_val" placeholder="paste your css here"></textarea>'+
   		'<span style="color:red">Minify Your css first. Use <a href="http://cssminifier.com/" target="_blank">Link</a> to minify the css </span>';
   		$('.custom_css_values').append(txt_ara);
       }
       else
       	$('.custom_css_values').empty();
   })
   $('.select_fields').click(function(){
   	var valq=$('.select_prev').val();
   	$.each(valq,function(key,val){
   		var prev_map=$('.new_mapping').val();
   		var match=false;
   		$.each(prev_map,function(k,v){
   			if(v==val)
   				match=true;
   		})
   		if(!match)
   			$('.new_mapping').append("<option value='"+val+"' selected >"+val+"</option>");
   	})
   	
   })
   $('.new_select_fields').click(function(){
   	var valq=$('.new_field_mapping').val();
   	$.each(valq,function(key,val){
   		var txt='#'+val;
   		txt=$(txt).text();
   		   var prev_map=$('#ApplicationsFieldsMapping_field_id').val();
   		   var match=false;
   		   if(prev_map != null){
   		   		   $.each(prev_map,function(k,v){
   		   			if(v==val && txt != 'separator')
   		   				match=true;
   		   		  })
   		   }
   		if(!match)
   			$('#ApplicationsFieldsMapping_field_id').append("<option value='"+val+"' selected >"+txt+"</option>");
   	})
   	
   })
   
   
   /*	$('#fields_properties').on('show', function (e) {
   	var f_id=$('#ApplicationsFieldsMapping_field_id').val();
   	if(f_id==null){
   		$('.select_error').text('Please select the Fields First');
   		return e.preventDefault()
   	}
   })*/
</script>
<!--this page  script only-->

<script type="text/javascript">
 $(document).ready(function() {
   var last_valid_selection = null;
   $('.new_field_mapping').change(function(event) {
     if ($(this).val().length > 7) {
       $(this).val(last_valid_selection);
     } else {
       last_valid_selection = $(this).val();
     }
   });
 });
</script>
