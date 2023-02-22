<?php
/* @var $this SurveyController */
/* @var $model Survey */
/* @var $form CActiveForm */
$base=Yii::app()->theme->baseUrl;

$question_answer_datas = SurveyUtility::getAllQuestionAnswerMapping();
//SurveyUtility::pr($question_answer_datas,1);

?>
<div class="site-min-height">
<div class="form form-horizontal" role="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'survey-form',
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">	
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="title"><?php echo $form->labelEx($model,'title'); ?></label>
			<div class="col-md-8">
			<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255,'class'=>'form-control','required'=>'required')); ?>
			<?php echo $form->error($model,'title'); ?>
			</div>
		</div>
	</div>

	<!-- <div class="row">	
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="category_id"><?php echo $form->labelEx($model,'category_id'); ?></label>
			<div class="col-md-8">
			<?php 
			echo $form->dropDownList($model,'category_id',CHtml::listData(SurveyCategory::model()->findAll('is_active=:is_active', array(':is_active'=>'Y')),'category_id','category_name'),array('class'=>'form-control','prompt'=>'Select Category')); ?>
			<?php echo $form->error($model,'category_id'); ?>
			</div>
		</div>
	</div> -->
	
	<div class="row">	
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="department_id"><?php echo "Survey To Be Conducted For";//$form->labelEx($model,'department_id'); ?> <span class="required">*</span></label>
			<div class="col-md-8">
			<?php 
			echo $form->dropDownList($model,'department_id',CHtml::listData(Departments::model()->findAll('is_department_active=:is_active', array(':is_active'=>'1')),'dept_id','department_name'),array('class'=>'form-control','required'=>'required','prompt'=>'Select Department')); ?>
			<?php echo $form->error($model,'department_id'); ?>
			</div>
		</div>
	</div>

	
	<div class="row">	
		<div class="form-group col-md-8">
			<label class="col-lg-3 col-sm-3 control-label" for="title">	<?php echo $form->labelEx($model,'survey_start_date'); ?></label>
			<div class="col-md-6 input-group date start_date margin-bottom-5" data-date-format="dd/mm/yyyy">

		<?php echo $form->textField($model,'survey_start_date',array('class'=>'form-control','required'=>true,'readonly'=>'readonly','style'=>'margin-left:14px; width:95%;')); ?>
			<div class="input-group-btn">
				<button class="btn btn-sm default" type="button">
				<i class="fa fa-calendar"></i>
				</button>
			</div>


		<?php echo $form->error($model,'survey_start_date'); ?>
		</div>
		</div>
	</div>
	<div class="row">	
		<div class="form-group col-md-8">
			<label class="col-lg-3 col-sm-3 control-label" for="title">	<?php echo $form->labelEx($model,'survey_end_date'); ?></label>
			<div class="col-md-6 input-group date end_date margin-bottom-5" data-date-format="dd/mm/yyyy">

		<?php echo $form->textField($model,'survey_end_date',array('class'=>'form-control','required'=>true,'readonly'=>'readonly','style'=>'margin-left:14px; width:95%;')); ?>
			<div class="input-group-btn">
				<button class="btn btn-sm default" type="button">
				<i class="fa fa-calendar"></i>
				</button>
			</div>


		<?php echo $form->error($model,'survey_end_date'); ?>
		</div>
		</div>
	</div>
	<?php if($action == 'create'){ ?>
	<div class="row">	
		<div class="form-group col-md-12">
			<label class="col-lg-2 col-sm-2 control-label" for="max_allowed_question">Select Questions</label>
			<div class="col-md-4">
			<a href="#questionDiv" data-toggle="modal" class="pull-right btn btn-default">+ View & Select Questions</a>
			
			</div>
			
		</div>
	</div>

	<div class="row">	
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="is_active">Have Any Documents</label>
			<div class="col-md-8">
			<select name="doc" id="doc" onchange="showHideDocDiv(this.value)" class='form-control'>
				<option value="Y">Yes</option>
				<option value="N" selected="selected">No</option>
			</select>
			</div>
		</div>
	</div>
	<div class="row" id="docDiv" style="display: none;">	
		<div class="form-group col-md-10">
			<label class="col-lg-2 col-sm-2 control-label" for="is_active">Upload Documents</label>
			
			<div class="col-md-10">
				<table class="table table-bordered table-lg mt-lg mb-0">
					<thead>
						<tr>
						<th>S.No</th>
						<th>File Type</th>
						<th>Doc/URL (Max 2MB & Only PDF)</th>
						<th>Name of Document/Label</th>
						</tr>
					</thead>
					<tbody>
					<?php 
					for ($i=1; $i<=4;$i++) {
						
					?>
							<tr>
							<td><?php echo $i; ?></td>
							<td>
								<select class='form-control' name="file_type<?php echo $i; ?>" id="file_type<?php echo $i; ?>" onchange="showHideFileType(this.value,'<?php echo $i; ?>')">
									<option value="file" selected="selected">File</option>
									<option value="url">URL</option>
								</select>
							</td>
							<td>
							<input class='form-control pdf_file' type="file" name="file<?php echo $i; ?>" id="file<?php echo $i; ?>" accept=".pdf">
							

							<input class='form-control' name="url<?php echo $i; ?>" id="url<?php echo $i; ?>" class="cls" type="text" value="" style="display: none" placeholder="Please enter document URL">
							</td>
							<td>
							<input class='form-control' name="url_label<?php echo $i; ?>" id="url_label<?php echo $i; ?>" class="cls" type="text" value="" placeholder="Please enter document Name" maxlength="100">
							</td>
							</tr>
						<?php
					} ?>
					
					
					</tbody>
					
				</table>
			</div>
			
		</div>
		
	</div>
    <?php } ?>

	<div class="row">	
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="thankyou_message"><?php echo $form->labelEx($model,'thankyou_message'); ?></label>

			<div class="col-md-8">
			<?php echo $form->textArea($model,'thankyou_message',array('rows'=>6,'cols'=>50,'required'=>'required')); ?>
			<?php echo $form->error($model,'thankyou_message'); ?>
			</div>
		</div>
	</div>
	
	<div class="row">	
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="is_rating_required"><?php echo $form->labelEx($model,'is_rating_required'); ?></label>
			<div class="col-md-8">
			<?php echo $form->dropDownList($model,'is_rating_required',array('Y'=>'Y','N'=>'N'),array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'is_rating_required'); ?>
			</div>
		</div>
	</div>

	<div class="row">	
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="is_active"><?php echo $form->labelEx($model,'is_active'); ?></label>
			<div class="col-md-8">
			<?php echo $form->dropDownList($model,'is_active',array('Y'=>'Y','N'=>'N'),array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'is_active'); ?>
			</div>
		</div>
	</div>
	
	<div class="row">	
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="is_publish"><?php echo $form->labelEx($model,'is_publish'); ?></label>
			<div class="col-md-8">
			<?php echo $form->dropDownList($model,'is_publish',array('Y'=>'Y','N'=>'N'),array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'is_publish'); ?>
			</div>
		</div>
	</div>

	
	
	
	<div class="row">
		<div class="form-gruop col-md-6">
			<?php echo CHtml::submitButton($action=='create' ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
		</div>
	</div>

 <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="questionDiv" class="modal abc">
        <div class="modal-header">
          <button type="button" class="" data-dismiss="modal" aria-hidden="true" style="margin-right:50px; float:right;">Add & Close</button>
            <h4 class="modal-title">Select Questions</h4>
        </div>
       
       <div class="model-content">
        	<table class="table table-bordered table-lg mt-lg mb-0">
					<thead>
						<tr>
						<th></th>
						<th>Question</th>
						<th>Mandatory</th>
						<th>Section</th>
						</tr>
					</thead>
					<tbody>
					<?php 
		        	if(count($question_answer_datas)){ 
		        		foreach ($question_answer_datas as $key => $data) {
							$close_cls = '';
							if(date("Y-m-d", strtotime($data["created_time"])) != date("Y-m-d")){
								$close_cls = "close_cls";
							}
		        	?>
							<tr class="question <?php echo $close_cls; ?>">
							<td width="3%"><input name="qa_id[]" id="<?php echo $data['qa_mapping_id']; ?>" value="<?php echo $data['qa_mapping_id']; ?>" class="chbx" type="checkbox"> </td>
							<td width="80%">
								<?php echo $data['question']; ?>
								<br>
								<span style="margin-top: 20px; display: none;" id="ans_<?php echo $data['qa_mapping_id']; ?>">
									<?php echo SurveyUtility::displayAnswerHTML($data['qa_mapping_id'],$data['answer_type'],$data['answer_type_value'],1); ?>
								</span>
							</td>
							<td width="3%">
								<input name="mandatory_<?php echo $data['qa_mapping_id']; ?>" value="1" class="chbx" type="checkbox">
							</td>
							<td width="14%">
								<?php 
									//echo CHtml::dropDownList('category_'.$data['qa_mapping_id'],'question_category_id',CHtml::listData(SurveyCategory::model()->findAll('is_active=:is_active', array(':is_active'=>'Y')),'category_id','category_name'),array('class'=>'form-control','prompt'=>'Select Section')); 
									echo CHtml::dropDownList('category_'.$data['qa_mapping_id'],'question_category_id',CHtml::listData(SurveyCategory::model()->findAll('is_active=:is_active', array(':is_active'=>'Y')),'category_id','category_name'),array('class'=>'form-control'));
								?>
							</td>
							</tr>
						<?php }} ?>
					
					
					</tbody>
					</table>
<button type="button" class="" data-dismiss="modal" aria-hidden="true" style="margin-right:50px; float:right;">Add & Close</button>
<button type="button" style="margin-right:10px; float:right;" onclick="$('.close_cls').show();">Display Older Questions</button>
        </div>
     
 </div>
<?php $this->endWidget(); ?>

</div><!-- form -->
</div>
<style type="text/css">
	.abc{
		padding-bottom: 20px !important; 
		width:900px !important;
		left: 40% !important;
	}
	.close_cls{
		display:none;
	}

</style>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?=$base?>/assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" />
<link href="<?=$base?>/assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?=$base?>/assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
<script src="<?=$base?>/assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>

<script src="<?=$base?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?=$base?>/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
<script src="<?=$base?>/assets/global/plugins/bootstrap-datepicker/js/moment.min.js" type="text/javascript"></script>

<!-- END PAGE LEVEL PLUGINS -->
<script type="text/javascript">
$(document).ready(function () {
   $("input[name='qa_id[]']").change(function () {
      var maxAllowed = 100; // How many max question allowed in Survery
      var cnt = $("input[name='qa_id[]']:checked").length;
      if (cnt > maxAllowed)
      {
         $(this).prop("checked", "");
         alert('Select maximum ' + maxAllowed + ' questions!');
         return false;
      }
      var id = $(this).attr('id');
	  
      //alert(id);
      //$('#ans_'+id).slideToggle();
  });
  /*$(".chbx").change(function () {
      var id = $(this).attr('id');
      //alert(id);
      $('#ans_'+id).slideToggle();
  });*/

  var startDate;
   $(".start_date").datepicker({
    	autoclose: !0,
    	startDate: "dateToday",
    	format: 'd-MM-yyyy',
    	useCurrent: false,
    	/*onChangeDateTime: function(dp,$input){
                               startDate = $("#Survey_survey_start_date").val();
                                                           }                                            */
    }).on('changeDate', function (selected) {
			var startDate = new Date(selected.date.valueOf());
			$(".end_date").datepicker('setStartDate', startDate);
		});
   $(".end_date").datepicker({
    	autoclose: !0,
    	startDate: "dateToday",
    	format: 'd-MM-yyyy',
    	useCurrent: false,
    	/*onClose: function(current_time, $input){
                            var endDate = $("#Survey_survey_end_date").val();
                            if(startDate>endDate){
                                   alert('Please select correct date');
                             }
                             }*/
    });
	
	$(".pdf_file").on('change', function(event) {
		var file = event.target.files[0];
		if(file.type != 'application/pdf'){
			alert("Wrong file selected. Only PDF file is allowed.");
			$('#'+$(this).attr('id')).val(''); //the tricky part is to "empty" the input file here I reset the form.
			return;
		}else if(file.size>=2*1024*1024) {
			alert("File size is greater than 2MB. Please upload leass than 2MB file.");
			$('#'+$(this).attr('id')).val(''); //the tricky part is to "empty" the input file here I reset the form.
			return;
		}
	});

});
function showHideFileType(val,id){
	var hd_val = val == 'file'?'url':'file';
	$('#'+hd_val+id).hide();
	$('#'+val+id).show();
}

function showHideDocDiv(val){
	val == 'Y'?$('#docDiv').show():$('#docDiv').hide();
}
</script>