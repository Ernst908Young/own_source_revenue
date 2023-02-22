<div class="row">
	<div class="dt-buttons" style="margin-bottom: 10px; float:right; margin-right:15px" >
	   <a class="btn btn-success" tabindex="0" href="<?=$this->createUrl('/infowizard/documentCheckPoint/index/')?>"><span>Document Check Point List</span></a>
	</div> 
</div>
<div class='portlet box green'>

<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>View Document Check Point </div>
    <div class='tools'> </div>
</div>
 <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover" id="sample_2" >
            <thead>
            <?php
              if(empty($model)){
                echo "<tr><td colspan='3'>No applications</td></tr>";

              }
              else{
                    ?>
            <tr>
                <th>S.No.</th> <td><?=@$model->id;?></td>
            </tr>  
			 
			<tr>
				<th>Form  Category </th> <td><?=@$model->name;?></td>
			</tr>
            <tr>
                <th >Active</th> <td><?=@$model->is_active;?></td>
            </tr>
            </thead>
            <tbody>
            
            <?php
               }
            ?>

            </tbody>
        </table> 
</div>
</div>
</div>


 <?php
$base=Yii::app()->theme->baseUrl;
?>