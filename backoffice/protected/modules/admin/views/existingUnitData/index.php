<?php
/* @var $this FeedbackTypeMasterController */
/* @var $dataProvider CActiveDataProvider */
$baseUrl=Yii::app()->theme->baseUrl;


?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?=$baseUrl?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?=$baseUrl?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<style>
a:hover{color:#000;}
</style>

<!-- END PAGE HEADER-->

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i style="font-size:24px" class="fa fa-eye-slash"></i>
                    <span class="caption-subject bold uppercase">Existing Unit Data</span>
                </div>

                
            </div>
			
			<div class="portlet-body">
			
			
			<div class="row">
				<div class="col-md-6 col-sm-12">
					<div class="dataTables_length">&nbsp;
					</div>
				</div>
				<div class="col-md-6 col-sm-12">
				
				<form  action="<?=Yii::app()->createAbsoluteUrl('admin/existingUnitData/index');?>" method="get">
				
					<div id="sample_2_filter" class="dataTables_filter">
						<label><input name="search" value="<?php  echo !empty($search)?$search:'';   ?>" type="search" class="form-control input-sm input-small input-inline" placeholder="Search" aria-controls="sample_2"></label>
					    <button type="submit" class="btn btn-info">Search</button>
					</div>
					
				</form>	
					
					
				</div>
			</div>
			<div class="table-scrollable">
               <table class="table table-striped table-bordered table-hover" id="ppp00">
                    <thead>
                        <tr>
						 <th class="mid_center" align="center">REGISTRATION NO</th>
						 
                           <th class="mid_center" align="center">ENTERPRISE NAME</th>
						  <th class="mid_center" align="center">PROPRIETOR NAME</th>
						<th class="mid_center" align="center">DATE OF PRODUCTION</th>
						 <?php /*<th class="mid_center" align="center">REGISTRATION TYPE</th>  */ ?>
						 <?php /*  <th class="mid_center" align="center">CERTIFICATE</th>
						 <th class="mid_center" align="center">DISTRICT</th> */ ?>
						  <th class="mid_center" align="center">MOBILE NO</th>
						 <?php /*  <th class="mid_center" align="center">LEGAL STATUS ID</th>
						   <th class="mid_center" align="center">ENTERPRISE STATUS</th> */ ?>
                          <th class="mid_center" align="center"> Action  </th> 
                        </tr>
                    </thead>
                    <tbody>
                       <?php if(count($datas)){
                          foreach ($datas as $key => $data) {
                           
                       ?>
                             <tr>
							   <td><a href="<?=Yii::app()->createAbsoluteUrl('admin/existingUnitData/view/id/'.$data['swcs_id']);?>" target="_blank"> <?php echo $data['registration_no']; ?></a></td>
							   
							   <td><?php echo $data['enterprise_name']; ?></td>
							   <td><?php echo $data['proprietor_name']; ?></td>
							   <td><?php echo $data['date_of_production']; ?></td>
							    <?php /*<td class="mid_center"><?php echo $data['registration_type']; ?></td> */ ?>
							   <?php /* <td><?php echo $data['certificate_name']; ?></td>
							   <td class="mid_center"><?php echo $data['districtid']; ?></td> */ ?>
							   <td><?php echo $data['mobile_no']; ?></td>
							    <?php /* <td class="mid_center"><?php echo $data['legalstatusid']; ?></td>
							   <td class="mid_center"><?php echo $data['enterprise_status']; ?></td> */ ?>
							   	<td><a href="<?=Yii::app()->createAbsoluteUrl('admin/existingUnitData/view/id/'.$data['swcs_id']);?>" target="_blank"><i class="fa fa-eye"></i> View</a></td>						 
							  </tr>
											<?php }}else{ ?>
															<tr>
															 <td colspan="5">No record(s) found.</td>
															 
															</tr>
											<?php } ?>
															 
															</tr>
											
										</tbody>
                        </table>
				
				  </div>
				  </div>
				
				 <?php
				$this->widget('CLinkPager',array(
					'header'=>'',
					'firstPageLabel' => ' << ',
					'lastPageLabel' => ' >> ',
					'prevPageLabel' => ' < ',
					'nextPageLabel' => ' > ',
					'pages' => $pages,
					'pageSize'=>100,
					'maxButtonCount'=>10,
					'cssFile'=>false,
					'htmlOptions' =>array("class"=>"pagination"),
					'selectedPageCssClass'=>"active"
				  )
				);
				?>
				
				
          
			
			
		
          
		
			
			
        </div>
    </div>
</div>

<style>

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


<!-- END PAGE LEVEL PLUGINS -->