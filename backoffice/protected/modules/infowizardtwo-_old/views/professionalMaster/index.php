

<div class="row">
<div class="dt-buttons" style="margin-bottom: 10px; float:right; margin-right:15px" ><a class="btn btn-success" tabindex="0" href="<?=$this->createUrl('/infowizard/professionalMaster/create')?>"><span>Add New Professional </span></a>
</div></div>
<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>List of Professionals</div>
    <div class='tools'> </div>
	
</div>
 <div class="portlet-body">


<table class="table table-striped table-bordered table-hover" id="sample_2">
    <thead>
    <tr>
        <th>ID</th>
        <th>Professional Name</th>
        <th>Profession Body</th>
        <th>Created</th>
       
        </tr>
        </thead>
        <tbody>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</tbody>
          </table>
     </div>
