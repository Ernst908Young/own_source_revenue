<?php
/* @var $this InfowizardQuestionMasterController */
/* @var $model InfowizardQuestionMaster */
/* @var $form CActiveForm */
?>
<style>
    .errorMessage{color:red;}    
</style>

<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>LM Inspection Report Upload</div>
    <div class='tools'>
	
	</div>
	
</div>
<div class="portlet-body">

<div class="site-min-height">
<div class="form form-horizontal" role="form">
<?php 
$iuid_val ="";
/* if (isset($_GET['user_id']) && $_GET['user_id'] != '')
{
    $userid = $_GET['user_id'];
   $get_investor = "SELECT user_id,iuid FROM sso_users where user_id = $userid and is_account_active='Y' order by user_id desc limit 10";
    $connection = Yii::app()->db; 
    $command = $connection->createCommand($get_investor);
    $user_data = $command->queryRow();
    $iuid_val=$user_data['iuid'];
} */
if(isset($_POST) && !empty($_POST) && !empty($_POST['Search']))
{
	$email=trim($_POST['email']);
	$get_investor = "SELECT user_id,iuid FROM sso_users where email LIKE '%$email%' and is_account_active='Y'";
    $connection = Yii::app()->db; 
    $command = $connection->createCommand($get_investor);
    $user_data = $command->queryRow();
    $iuid_val = $user_data['iuid'];	
}	

?>
	<form name="searchiuid" id="seacrhiuid" method="post">
		<div class="row" style="margin:10px 0 10px 0;">		 
			<label class="col-lg-2 col-sm-2 control-label" for="iuid">
			Email ID<span class="required" aria-required="true">*</span>
			</label>
			<div class=" form-group col-md-8">
				<input type="email" name="email" id="email" class="form-control">
			</div>
			<div style="padding-left:10px;">
				<input type="submit" name="Search" value="Serach IUID" class="btn btn-primary">
			</div>
		</div>
	</form>
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'bo-lm-inspection-form',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array('enctype'=>'multipart/form-data')
	)); ?>
	<div class="row" style="margin:10px 0 10px 0;">		 
		<label class="col-lg-2 col-sm-2 control-label" for="iuid">
		IUID<span class="required" aria-required="true">*</span>
		</label>
		<div class=" form-group col-md-8">
			<?php echo $form->textField($model,'iuid',array('class'=>'form-control','autocomplete' => 'off','value'=>$iuid_val,'readonly'=>true));  ?>
			<?php echo $form->error($model,'iuid'); ?>
		</div>
		<div class="row">
           <div class="col-lg-4" id='uldiv'>
                
            </div>
        </div>
	</div>
	
	<div class="row" style="margin:10px 0 10px 0;">
		<label class="col-lg-2 col-sm-2 control-label" for="service_id" > 
		Service<span class="required" aria-required="true">*</span></label>
		<div class="form-group col-md-8">
		<?php echo $form->dropDownList($model,'service_id',$serviceArr,array('class'=>'form-control','autocomplete' => 'off')); ?>
		<?php echo $form->error($model,'service_id'); ?>
		</div>
	</div> 
	
	<div class="row" style="margin:10px 0 10px 0;">		 
		<label class="col-lg-2 col-sm-2 control-label" for="firm_name">
		Firm Name<span class="required" aria-required="true">*</span>
		</label>
		<div class=" form-group col-md-8">
			<?php echo $form->textField($model,'firm_name',array('class'=>'form-control','autocomplete' => 'off'));  ?>
			<?php echo $form->error($model,'firm_name'); ?>
		</div>
	</div>
	<div class="row" style="margin:10px 0 10px 0;">		 
		<label class="col-lg-2 col-sm-2 control-label" for="service_type">
		Service Type<span class="required" aria-required="true">*</span>
		</label>
		<div class=" form-group col-md-8">
			<?php echo $form->textField($model,'service_type',array('class'=>'form-control','autocomplete' => 'off'));  ?>
			<?php echo $form->error($model,'service_type'); ?>
		</div>
	</div>
	<div class="row" style="margin:10px 0 10px 0;">		 
		<label class="col-lg-2 col-sm-2 control-label" for="district_id">
		District<span class="required" aria-required="true">*</span>
		</label>
		<div class=" form-group col-md-8">
			<?php echo $form->dropDownList($model,'district_id',$distArr,array('class'=>'form-control','autocomplete' => 'off','empty'=>'--Select District--'));  ?>
			<?php echo $form->error($model,'district_id'); ?>
		</div>
	</div>
	<div class="row" style="margin:10px 0 10px 0;">		 
		<label class="col-lg-2 col-sm-2 control-label" for="licence_number">
		Licence Number<span class="required" aria-required="true">*</span>
		</label>
		<div class=" form-group col-md-8">
			<?php echo $form->textField($model,'licence_number',array('class'=>'form-control','autocomplete' => 'off'));  ?>
			<?php echo $form->error($model,'licence_number'); ?>
		</div>
	</div>
	<div class="row" style="margin:10px 0 10px 0;">		 
		<label class="col-lg-2 col-sm-2 control-label" for="inspector_name">
		Inspector Name<span class="required" aria-required="true">*</span>
		</label>
		<div class=" form-group col-md-8">
			<?php echo $form->textField($model,'inspector_name',array('class'=>'form-control','autocomplete' => 'off'));  ?>
			<?php echo $form->error($model,'inspector_name'); ?>
		</div>
	</div>
	<div class="row" style="margin:10px 0 10px 0;">		 
		<label class="col-lg-2 col-sm-2 control-label" for="last_inspection_date">
		Last Inspection Date<span class="required" aria-required="true">*</span>
		</label>
		<div class=" form-group col-md-8">
			<?php echo $form->textField($model,'last_inspection_date',array('class'=>'form-control demo-2','autocomplete' => 'off'));  ?>
			<?php echo $form->error($model,'last_inspection_date'); ?>
		</div>
	</div>
	<div class="row" style="margin:10px 0 10px 0;">		 
		<label class="col-lg-2 col-sm-2 control-label" for="inspection_commence">
		Inspection Commence<span class="required" aria-required="true">*</span>
		</label>
		<div class=" form-group col-md-8">
			<?php echo $form->checkBoxList($model, 'inspection_commence', array('2019'=>'2019','2018'=>'2018','2017'=>'2017',' 2016'=>'2016'),array('class'=>'tst')); ?>
			<?php echo $form->error($model,'inspection_commence'); ?>
		</div>
	</div>
	<div class="row" style="margin:10px 0 10px 0;">		 
		<label class="col-lg-2 col-sm-2 control-label" for="inspection_report">
		Select Inpection Report<span class="required" aria-required="true">*</span>
		</label>
		<div class=" form-group col-md-8">
			<?php echo $form->fileField($model, 'inspection_report');  ?>
			<?php echo $form->error($model,'inspection_report'); ?>
		</div>
	</div>
	<div class="row buttons" align="center">
		<?php echo CHtml::submitButton('Save',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div></div></div></div>
	<!-- datepicker js -->
<link href="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<!-- form -->
<script>
	$('.demo-2').datepicker({
		format:'yyyy-mm-dd', 
		keepEmptyValues: true
	});
	$(document).ready(function(){		 
		$("#LmInspection_iuid").keypress(function(){
			var userid = $('#LmInspection_iuid').val();
			$.ajax({
				type: "GET",
				url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/IwApplyService/Getiuid",
				data: {userid: userid},
				success: function (data) { 
				 // alert(data);
					$('#uldiv').html(data);
				}
			});
		});
		
		/* $("li.iuidselect").on("click",function(){			
			var iuidVal = $(this).text();
			$("#LmInspection_iuid").val(iuidVal);
		});	 */
    });
	/* function lettersOnly(evt) {
	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
	  ((evt.which) ? evt.which : 0));
	if (charCode > 33 && (charCode < 65 || charCode > 90) &&
	  (charCode < 97 || charCode > 122)) {
	  return false;
	}
	return true;
	} */
</script>
<style>
	#uldiv {
		margin: 32px 214px;
		background: #fff;
		padding: 0px 14px;
		list-style-type: none;
		border: 1px solid #ccc;
		position: absolute;
		z-index: 1;
	}
	#uldiv li {
		border-bottom: 1px solid #ccc;
		padding: 1px 15px;
		margin: 0 -15px;
	}
	#uldiv li :hover {
		color: orangered;
	}
    a:hover{ color:#000;}
	.dt-buttons {
        margin-top: -52px !important;
	}
	#484_0{display: none;}
	.urlcheckmsg{
		font-size: 14px !important;
		color:#F00;
	}

</style>