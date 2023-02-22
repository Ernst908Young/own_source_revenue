<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>View Issued By </div>
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
                <th>S.No.</th> <td><?=@$apps['issuerby_id']?></td>
            </tr> 
			<tr>
                <th>Issuer</th> <td><?php $ss=InfowizardQuestionMasterExt::getIssuerDetailById($apps['issuer_id']); echo $ss['name'];
                    ?></td>
            </tr>  
            <tr>
                <th>Issued By </th> <td><?=@$apps['name']?></td>
            </tr>
            <tr>
                <th >Abbreviations</th> <td><?=@$apps['abb']?></td>
            </tr>
            <tr>
                <th >Created On</th> <td><?=@$apps['is_issuerby_active']?></td>
            </tr>
			<tr>
                <th>Left Side Department Logo</th> <td><?php echo CHtml::image(@$apps['left_department_logo']);?></td>
            </tr>
			<tr>
                <th>Middle Side Department Logo</th> <td><?php echo CHtml::image(@$apps['middle_department_logo']);?></td>
            </tr>
			<tr>
                <th>Right Side Department Logo</th> <td><?php echo CHtml::image(@$apps['right_department_logo']);?></td>
            </tr>
            </thead>
            <tbody>
            
            <?php
               }
            ?>

            </tbody>
        </table>
         <div class="row buttons" align="center">
		<a class="btn btn-success" tabindex="0" href="<?=$this->createUrl('/infowizard/IssuerbyMaster/index/')?>"><span>View list of Issued By</span></a>
		<a class="btn btn-success" tabindex="0" href="<?=$this->createUrl('/infowizard/IssuerbyMaster/create/')?>"><span>Add New Issued By</span></a>
        <?php //echo CHtml::submitButton('Back',array('class'=>'btn btn-primary','onclick'=>'window.history.back()')); 
        //history.go(-1) ?>
    </div>
</div>
</div>
</div>


 <?php
$base=Yii::app()->theme->baseUrl;
?>