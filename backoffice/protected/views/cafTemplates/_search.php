<?php
/* @var $this CafTemplatesController */
/* @var $model CafTemplates */
/* @var $form CActiveForm */
?>
<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'> <i style=" font-size:20px;" class='fa fa-list'></i>List of Templates</div>
    <div class='tools'> </div>	
</div>
 <div class="portlet-body">
          <table class="table table-striped table-bordered table-hover" id="sample_2" >
            <thead>
				<tr>
					<th>S.No.</th>
					<th>Department Name</th>
					<th>Role Name</th>
					<th>Template Message</th>
					<th>Active</th>				
					<th>Created On</th>
					<th>Action</th>
				</tr>
            </thead>
            <tbody>
					<?php
					$i=1;
					/* echo "<pre>";
					print_r($allData); */
					foreach($allData as $key=>$val)
					{
					?>
					<tr>
					
					<div class="wide form">	
					<?php /* $form=$this->beginWidget('CActiveForm', array(
						'action'=>Yii::app()->createUrl($this->route),
						'method'=>'get',
					));  */
					//$form->textField($model,'id');
					?>
					<td>									
						<?php echo $i++;?>						
					</td>
					<td>												
						<?php echo $val['department_name']; //echo $form->textField($model,'dept_id',array('size'=>11,'maxlength'=>11)); ?>						
					</td>
					<td>
						<?php echo $val['role_name']; ///echo $form->textField($model,'role_id',array('size'=>10,'maxlength'=>10)); ?>						
					</td>
					<td>
						<?php echo $val['template']; //echo $form->textField($model,'is_active',array('size'=>1,'maxlength'=>1)); ?>
					</td>
					<td>
						<?php echo $val['is_active'];//echo $form->textField($model,'created'); ?>						
					</td>
					<td>					
						<?php  echo $val['created'];//echo $form->textField($model,'created'); ?>
					</td>
					<td>
						<a href="<?php echo Yii::app()->createAbsoluteUrl("/cafTemplates/update/id/".$val['id'])?>" >Edit Template</a>	
					</td>
					<?php //$this->endWidget(); ?>
					</div><!-- search-form -->	
					</tr>	
					<?php 
					}
					?>
			</tbody>
        </table>	
	</div>
</div>		