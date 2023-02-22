<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>Edit Question</div>
    <div class='tools'> </div>
</div>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'user-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>
<p class="note">Fields with <span class="required">*</span> are required.</p>
<?php echo $form->errorSummary($apps); ?>

 <div class="portlet-body">
          <table class="table table-striped table-bordered table-hover" id="sample_2" >
            <thead>
            <?php
              if(empty($apps)){
                echo "<tr><td colspan='5'>No applications</td></tr>";

              }
              else{
                    ?>
            <tr>
                <th>S.No.</th> <td><?=@$apps[0]['question_id']?></td>
            </tr>   
            <tr>
                <th>Questions</th> <td><?=@$apps[0]['name']?></td>
            </tr>
            <tr>
                <th >Active</th> <td><?=@$apps[0]['is_question_active']?></td>
            </tr>
            <tr>
                <th >Created On</th> <td><?=@$apps[0]['created_date']?></td>
            </tr>
            </thead>
            <tbody>
            
            <?php
               }
            ?>

            </tbody>
        </table>
        <div class="row buttons" align="center">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
    </div>

<?php $this->endWidget(); ?>
</div>

</div>
</div>


 <?php
$base=Yii::app()->theme->baseUrl;
?>