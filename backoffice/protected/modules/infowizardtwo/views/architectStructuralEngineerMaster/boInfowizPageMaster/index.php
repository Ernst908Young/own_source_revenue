<?php
/* @var $this BoInfowizPageMasterController */
/* @var $dataProvider CActiveDataProvider */

/* $this->breadcrumbs=array(
	'Bo Infowiz Page Masters',
);

$this->menu=array(
	array('label'=>'Create BoInfowizPageMaster', 'url'=>array('create')),
	array('label'=>'Manage BoInfowizPageMaster', 'url'=>array('admin')),
);
?>

<h1>Bo Infowiz Page Masters</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));  */ ?>

<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>Bo Infowiz Page Masters</div>
    <div class='tools'> </div>
</div>
 <div class="portlet-body">
 
           
			
			<div class="row">
				<div class="col-md-9 col-sm-12">
					    <div class="btn-group">
						   <a href="<?=Yii::app()->createAbsoluteUrl('infowizard/BoInfowizPageMaster/create');?>" class="btn sbold green"> Create New Page <i class="fa fa-plus"></i></a>
						</div>
				</div>
				<div class="col-md-3 col-sm-12">
				    <form  action="<?=Yii::app()->createAbsoluteUrl('infowizard/BoInfowizPageMaster/index');?>" method="get">
					
						<div id="sample_2_filter" class="dataTables_filter">
							<label><input name="search" value="<?php  echo !empty($search)?$search:'';   ?>" type="search" class="form-control input-sm input-small input-inline" placeholder="Search" aria-controls="sample_2"></label>
							<button type="submit" class="btn btn-info">Search</button>
						</div>
						
					</form>	
				</div>
			</div>
 
 
 
          <table class="table table-striped table-bordered table-hover" id="sample_2" >
            <thead>
            <tr>
                <th>Service Id</th>
                <th>Page Name</th>
                <th>Is Active</th>				
                <th>Created At</th>
				<th>Modified At</th>
				<th>Action</th>
            </tr>
            </thead>
            <tbody>
                 
            <?php //echo '<pre/>';  print_r($dataProvider); exit();
              if(empty($dataProvider)){
                echo "<tr><td colspan='5'>No Estate list</td></tr>";
              }
              else{
                $count=1;
                foreach ($dataProvider as $key => $data) {
                    ?>
                    <tr>
                   <td align="center" ><?=$data['service_id'];?></td>
		           <td><?=$data['page_name'];?></td>
                   <td align="center"><?=$data['is_active'];?></td>
				   <td><?=$data['created'];?></td>
				   <td><?=$data['modified'];?></td>   
				   <td><span class="label label-sm label-success">  <a href="/backoffice/infowizard/BoInfowizPageMaster/update/<?php echo $data['id'];  ?>" class="edit_class"> Edit </a>  </span></td>
               </tr>
                 <?php
               }
                }
            ?>

            </tbody>

        </table>
      <?php
		$base=Yii::app()->theme->baseUrl;
	  ?>
    
	 </div>
	 
	  <?php
				$this->widget('CLinkPager',array(
					'header'=>'',
					'firstPageLabel' => ' << ',
					'lastPageLabel' => ' >> ',
					'prevPageLabel' => ' < ',
					'nextPageLabel' => ' > ',
					'pages' => $pages,
					'pageSize'=>10,
					'maxButtonCount'=>10,
					'cssFile'=>false,
					'htmlOptions' =>array("class"=>"pagination"),
					'selectedPageCssClass'=>"active"
				  )
				);
				?>
	 
	 
	 
</div>
</div>



 <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?=$base?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="<?=$base?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="<?=$base?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->



   <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?=$base?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
		<style>
	
				.edit_class{ color: #ffffff !important;   }
					

				.pagination{  float:right;  }
				.portlet.box>.portlet-body {
					padding-left: 10px !important;
				}

				.table>thead>tr>th{
					background: #f3f4f6 !important;
					text-align:center !important;
				}

				.table thead tr th {
					font-size: 13px !important;
				}

				.dataTables_filter{
				  float:right !important;	
					
				}

				.mid_center{
					text-align:center;
					vertical-align:middle !important;
				}

    </style>
	


