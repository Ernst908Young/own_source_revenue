<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$baseUrl=Yii::app()->theme->baseUrl;
$this->breadcrumbs=array(
	'Users',
);
extract($_GET);
$this->menu=array(
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?=$baseUrl?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?=$baseUrl?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<div class="dt-buttons" style="margin-bottom: 10px; float: right; "><a class="btn blue btn-outline" tabindex="0" href="<?=$this->createUrl('/userCreate/CreateUser/')?>"><span>Add New </span></a>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i style="font-size:24px" class="fa fa-eye-slash"></i>
                    <span class="caption-subject bold uppercase">Departmental Users</span>
                </div>

                
            </div>
            <div class="portlet-body table-both-scroll">
                <table class="table table-striped table-bordered order-column" id="sample_31">
                    <thead>
                        <tr>
                           <th>S.No</th> 
                           <th>Full Name</th> 
                           <th>Email</th> 
                           <?php  if(isset($showField)){ ?>    <th><?php echo $showField; ?></th>  <?php } ?>
                           <th>Mobile</th> 
                           <th>Department</th> 
                           <th>District</th> 
                           <th>Role</th> 
                           <th>Is Active</th>
                           <th>Created Time</th>
                           <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php if(count($datas)){
                       			foreach ($datas as $key => $data) {
                       				
                       ?>
                        			  <tr>
                                         <td><?php echo $data['uid']; ?></td>
                                         <td><?php echo $data['full_name']; ?></td>
                                         <td><?php echo $data['email']; ?></td>
                                     <?php  if(isset($showField)){ ?>  <td><?php echo $data[$showField]; ?></td> <?php } ?>
                                         <td><?php echo $data['mobile']; ?></td>
										 <td><?php echo $data['department_name']; ?></td>
										 <td><?php echo $data['distric_name']; ?></td>
										 <td><?php echo $data['role_name']; ?></td>
                                         <td><?php echo $data['uis_active']=='1'?'Y':'N'; ?></td>
                                         <td><?php echo $data['created_datetime']; ?></td>
                                         <td>
                                         	NA
                                         </td>
                                        </tr>
                        <?php }}else{ ?>
                                        <tr>
                                         <td colspan="7">No record(s) found.</td>
                                         
                                        </tr>
                        <?php } ?>
                                         
                                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?=$baseUrl?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?=$baseUrl?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?=$baseUrl?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="<?=$baseUrl?>/assets/pages/scripts/table-datatables-scroller.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#sample_31').dataTable( {
        "order": [[0,'DESC']]
    } );
} );
</script>
<!-- END PAGE LEVEL PLUGINS -->