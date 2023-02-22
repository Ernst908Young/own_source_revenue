<?php
	$pageID = $_GET['pageID'];
	$categoryPreference = array();
//print_r($formData); die(); // this variable provides the data of fields and section category name
$oldcategorysection = NULL;
	foreach ($formData as $key => $fd) {	
		if ($ap['id'] == $fd['page_name']) {
			$inputType = $fd['input_type'];
			$maxLength = $fd['max_length'];
			$minLength = $fd['min_length'];
			$pattern = $fd['pattern'];
			$button_id = $fd['id'];

			$_exist_addmore_table = InfowizardQuestionMasterExt::checkExist($fd['service_id'], $fd['page_name'], $fd['id']);
			if ($_exist_addmore_table && $fd['is_required'] == 'Y')
				$val_cls = 'val';
			else
				$val_cls = '';
			$id = $fd['id'];

			if(isset($checkseccat)){
				if($checkseccat!=$fd['category_id']){
					echo '</div></div>';
				}
			}

			if (!in_array($fd['category_id'], $categoryPreference)) { 
				$checkseccat = $fd['category_id'];				
				$categoryPreference[] = $fd['category_id'];
				$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id'); ?>
				<div class="form-part bussiness-det">
				 	<div id="title_<?php echo $tablefieldname;?>">		
						<h4 class="form-heading">
							<?php echo @$formName = InfowizardQuestionMasterExt::getMasterName('bo_infowiz_form_categories', $fd['category_id'], 'category_name', 'id'); 				
								?>
						</h4>
					</div>
					<hr id="hr_<?php echo $tablefieldname;?>" style="height: 0px; margin: 0px;">
					<div class="form-row row">
			<?php } ?>


<?php    if ($inputType == "html") {
	$sql="select * from bo_infowiz_form_builder_html_container where mapped_form_field_primary_id=$fd[id] AND is_active='Y'";
	 $result = Yii::app()->db->createCommand($sql)->queryRow(); 
	  echo @$result['html_content'];
	  }
		   
		
if ($inputType == "text" || $inputType == "number" || $inputType == "password" || $inputType == "email" || $inputType=="url"){

$this->renderPartial('subform/formfields/text_number_password_email_url',['fd'=>$fd,'inputType'=>$inputType,'maxLength'=>$maxLength,'minLength'=>$minLength,'val_cls'=>$val_cls,'pattern'=>$pattern]); 

}				
         
if ($inputType == "select" || $inputType == "multipleselect"){
				
$this->renderPartial('subform/formfields/select_multiselect',['fd'=>$fd,'inputType'=>$inputType,'maxLength'=>$maxLength,'minLength'=>$minLength,'val_cls'=>$val_cls]); 				
} 

if ($inputType == "checkbox" || $inputType == "radio") {
	$this->renderPartial('subform/formfields/checkbox_radio',['fd'=>$fd,'inputType'=>$inputType,'maxLength'=>$maxLength,'minLength'=>$minLength,'val_cls'=>$val_cls]);				
} 

if ($inputType == "textarea") {
	$this->renderPartial('subform/formfields/textarea',['fd'=>$fd,'inputType'=>$inputType,'maxLength'=>$maxLength,'minLength'=>$minLength,'val_cls'=>$val_cls]);					
} 

if ($inputType == "calender") {
	$this->renderPartial('subform/formfields/calender',['fd'=>$fd,'inputType'=>$inputType,'maxLength'=>$maxLength,'minLength'=>$minLength,'val_cls'=>$val_cls]);				
} 
                       
if ($inputType == "add_more_button") {
	$this->renderPartial('subform/formfields/addmore',['fd'=>$fd,'inputType'=>$inputType,'maxLength'=>$maxLength,'minLength'=>$minLength,'val_cls'=>$val_cls,'id'=>$id,'button_id'=>$button_id]);							
                            
} ?>




          <?php  }
        }
        ?>
    </div></div>

    <div class="form-part bussiness-det" id="main_booking_schedule">
	 	<div id="title_booking_calendar">		
			<h4 class="form-heading">
				Booking Calendar
			</h4>
		</div>
		
		<hr id="hr_<?php echo 'booking_calendar' ;?>" style="height: 0px; margin: 0px;">
		<div class="form-row row" id="div_booking_calendar">
			<?php 
				$this->renderPartial('subform/booking_calender',['serviceID'=>$serviceID,'month'=>date('m'),'year'=>date('Y')]);		
			?>
		</div>
	</div>