<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>View Issuer </div>
    <div class='tools'> </div>
</div>
 <div class="portlet-body">
          <table class="table table-striped table-bordered table-hover" id="sample_2" >
            <thead>
            <?php
              if(empty($apps)){
                echo "<tr><td colspan='3'>No applications</td></tr>";

              }
              else{
                    ?>
            <tr>
                <th>S.No.</th> <td><?=@$apps['issuer_id']?></td>
            </tr>  
            <tr>
                <th>Issuer </th> <td><?=@$apps['name']?></td>
            </tr>
            <tr>
                <th >Active</th> <td><?=@$apps['is_issuer_active']?></td>
            </tr>
            </thead>
            <tbody>
            
            <?php
               }
            ?>

            </tbody>
        </table>
        <div class="row buttons" align="center">
		<a class="btn btn-success" tabindex="0" href="<?=$this->createUrl('/infowizard/IssuerMaster/index/')?>"><span>View list of issuer</span></a>
		<a class="btn btn-success" tabindex="0" href="<?=$this->createUrl('/infowizard/IssuerMaster/create/')?>"><span>Add New Issuer</span></a>
    </div>
	
</div>
</div>
</div>


 <?php
$base=Yii::app()->theme->baseUrl;
?>