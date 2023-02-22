<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>View Question</div>
    <div class='tools'> </div>
</div>
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
        <?php //echo CHtml::submitButton('Back',array('class'=>'btn btn-primary','onclick'=>'window.history.back()')); 
        //history.go(-1) ?>
   
	<div class="row buttons" align="center">
		 <a class="btn btn-success" tabindex="0" href="<?=$this->createUrl('/infowizard/infowizardQuestionMaster/listQuestion/')?>"><span>View list of Question</span></a>
		<a class="btn btn-success" tabindex="0" href="<?=$this->createUrl('/infowizard/infowizardQuestionMaster/create/')?>"><span>Add New Question</span></a>
 </div>
</div>
</div>
</div>


 <?php
$base=Yii::app()->theme->baseUrl;
?>