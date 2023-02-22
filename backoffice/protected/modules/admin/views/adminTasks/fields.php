<?php 
//include("/var/www/html/backoffice/themes/swcsNewTheme/views/layouts/pageBarStateMonitering.php");
include(getcwd().'/themes/investuk/views/layouts/cs_ps_page_bar.php');
?>
<style type="text/css">
div.DTFC_LeftBodyLiner{
		top:-10px !important;
	}
	table td {
		valign:middle;
	}
</style>
<div class="row after-fixed-element">

	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div><input type="checkbox" name="swu" id="swu" checked="checked">Single Window Users&nbsp;
		<input type="checkbox" name="dpu" id="dpu">Departmental Portal Users</div>
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i style="font-size:24px" class="icon-users"></i>
					<span class="caption-subject bold uppercase">Registered Investor Details</span>
				</div>
				<div class="tools"> </div>
				<div class="dto-buttons" style="margin:3px 5px 0 0;float: right; ">  </div>	
			</div>
			<div class="portlet-body">
				 <div class="site-min-height">
				  <div class="form form-horizontal" role="form">
				  </div>
				</div>
				<table class="table table-bordered" id="sample_1">
					<thead>
						<tr>
							<th>S.No.</th>
							<th>ID</th>
							<th>Field</th>							
							<th>Name</th>
							<th>Service</th>
							
						</tr>
					</thead>
                                        
                                      <?php  $sql="SELECT * FROM `bo_infowizard_formvariable_master` WHERE `is_formvar_active` = 'Y'";	
			$connection=Yii::app()->db;
			$command=$connection->createCommand($sql);
			$data=$command->queryAll(); 
                        ?>
                                        
                                        <tbody>
                                            <?php foreach($data as $datarow){ ?>
						<tr>
							<td>S.No.</td>
							<td><?php echo $datarow['formvar_id'];?></td>
							<td><?php echo $datarow['formchk_id'];?></td>							
							<td><?php echo $datarow['name'];?></td>
							<td><?php 
                                                        $sql="select distinct(core_service_name) from bo_information_wizard_service_parameters
left join bo_information_wizard_form_builder 
on concat(bo_information_wizard_service_parameters.service_id,'.','0') = bo_information_wizard_form_builder.service_id
where bo_information_wizard_service_parameters.is_active = 'Y' and form_id = 1 and bo_information_wizard_form_builder.is_active = 'Y'and form_field_id = $datarow[formvar_id]
";	
			$connection=Yii::app()->db;
			$command=$connection->createCommand($sql);
			$services=$command->queryAll();
                        foreach ($services as $service) {
                            echo $service['core_service_name'].','.' ';
                        }
                        ?>
                                                        
                                                        </td>
							
						</tr>
                                            <?php }?>
					</tbody>
				</table>
                            
			</div>
		</div>
	</div>
</div>
<!-- page start-->
<?php
$base=Yii::app()->theme->baseUrl;
?>
<!-- BEGIN PAGE LEVEL PLUGINS
<script src="<?=$base?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?=$base?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<link href="<?=$base?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
 END PAGE LEVEL PLUGINS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" >
        $(document).ready(function() {
            var dataTable = $('#sample_1').DataTable( {
                "processing": true,
                "serverSide": true,
                "ajax":{
                    url :"/backoffice/admin/adminTasks/viewAllUsers1",
                    type: "post",
                    error: function(){
                        $(".users-error").html("");
                        $("#sample_1").append('<tbody class="users-error"><tr><th colspan="6">No data found in the server</th></tr></tbody>');
                        $("#users_processing").css("display","none");

                    }
                },
                "aoColumns": [					
                    { data: 'SNo' } ,
                    { data: 'iuid' } ,
                    { data: 'InvestorDetail'},
                    { data: 'InPrincipleApplication'},
                    { data: 'DepartmentalClearance',orderable: false },
                    { data: 'Action' } 
                ],
                "columnDefs": [
                    {
                        "targets":5,
                        orderable: false,
                        "render": function(data, type, row, meta){
							return '<a href="'+row['Action']+'">View Investor Dashboard</a>';
                        }
                    }
                ]
            });
        });
 </script>