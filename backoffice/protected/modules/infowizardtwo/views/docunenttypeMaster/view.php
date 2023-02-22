<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>View Document Type</div>
    <div class='tools'> </div>
</div>
 <div class="portlet-body">
          <table class="table table-striped table-bordered table-hover" id="sample_2" >
            <thead>
            <?php
              if(empty($apps)){
                echo "<tr><td colspan='5'>No applications</td></tr>";

              }
              else{  //print_r($apps);
                    ?>
            <tr>
                <th>S.No.</th> <td><?=@$apps['doc_id']?></td>
            </tr>   
            <tr>
                <th>Document Type Name</th> <td><?=@$apps['name']?></td>
            </tr>
			 <tr>
                <th>Abbreviations</th> <td><?=@$apps['abbr']?></td>
            </tr>
            <tr>
                <th >Active</th> <td><?=@$apps['is_doc_active']?></td>
            </tr>
            <tr>
                <th >Created On</th> <td><?=@$apps['created_date']?></td>
            </tr>
            </thead>
            <tbody>
            
            <?php
               }
            ?>

            </tbody>
        </table>
       <div class="row buttons" align="center">
		<a class="btn btn-success" tabindex="0" href="<?=$this->createUrl('/infowizard/DocunenttypeMaster/index/')?>"><span>View list of Document Type</span></a>
		<a class="btn btn-success" tabindex="0" href="<?=$this->createUrl('/infowizard/DocunenttypeMaster/create/')?>"><span>Add New Document Type</span></a>
 </div>
</div>
</div>
</div>


 <?php
$base=Yii::app()->theme->baseUrl;
?>