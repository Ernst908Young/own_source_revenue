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
	.dataTables_wrapper .dataTables_processing {
		top:84px !important;
		height:100px !important;
	}
	#swu:hover{ cursor:pointer}
	#dpu:hover{ cursor:pointer}
	#label:hover{ cursor:pointer}
</style>
<div class="row after-fixed-element" style="margin-top: 126px;">
	<div class="col-md-12">
		<div class="col-md-2">
			<input type="checkbox" name="swu" id="swu" checked="checked" style="cursor;pointer">
			<label for="swu" style="cursor;pointer">Single Window Users</label>&nbsp;&nbsp;
		</div>
		<div class="col-md-2">
			<input type="checkbox" name="dpu" id="dpu" style="cursor;pointer">
			<label for="dpu" style="cursor;pointer">Departmental Portal Users</label>&nbsp;&nbsp;
		</div>
		<div class="col-md-8" style="display:none;" id="showgroup">
			<div class="col-md-8">
				<div class="col-md-2"><label>Group By </label></div>
				<select name="groupdata" id="groupdata" class="form-control" style="width:50%;">
					<option value="applicant_email">Applicant Email</option>
					<!--<option value="applicant_name">Applicant Name</option>-->
					<option value="unit_name">Applicant Unit name</option>
					<option value="applicant_contact_no">Applicant Contact Number</option>
				</select>
			</div>
		</div>
		<?php
		/* $sql = "select name,issuerby_id from bo_infowizard_issuerby_master where issuerby_id in (select distinct infowiz_dept_id from bo_dept_service_application)";
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sql);
		$deptdata = $command->queryAll(); */
		
		/* <div class="col-md-4" style="display:none;" id="showdept">			
			<div style="float:left;"><label>Department</label></div>
			<div style="float:right;">
				<select name="deptdata" id="deptdata" class="form-control" style="width:50%;">
					<option value="">All</option>
					<?php foreach($deptdata as $k=>$v){  ?>
						<option value="<?php echo $v['issuerby_id'];?>"><?php echo $v['name'];?></option>
					<?php }?>
				</select>
			</div>			
		</div> */
		?>
	</div>
	<br/><br/>
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		
		<div class="portlet box green" id="first_data">
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
				  <div class="form form-horizontal" role="form"></div>
				</div>								
				<table class="table table-bordered" id="sample_1">
					<thead>
						<tr>
							<th>S.No.</th>
							<th>IUID</th>
							<th>Investor Detail</th>							
							<th>In-Principle Application (CAF)</th>
							<th>Existing Enterprises</th>
							<th>Departmental Clearances</th>
							<th>Inspection Clearances</th>	
							<th>Action</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
		<div class="portlet box green" id="second_data" style="display:none;">
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
				  <div class="form form-horizontal" role="form"></div>
				</div>
				<table class="table table-bordered" id="sample_2">
					<thead>
						<tr>
							<th>S.No.</th>
							<th>Department User Id</th>
							<th>Investor Detail</th>
							<th>Departmental Clearances</th>
							<th>Inspection Clearances</th>	
							<th>Action</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>	
	</div>
</div>
<div id="loading-mask"></div>
<!-- page start-->
<?php
$base=Yii::app()->theme->baseUrl;
?>
 <link href="<?=$base?>/assets/global/scripts/data_table_investor/dataTables.min.css" rel="stylesheet" type="text/css" />
  <!--<script src="<?=$base?>/assets/global/scripts/data_table_investor/jquery.min.js" type="text/javascript"></script>-->
 <script src="<?=$base?>/assets/global/scripts/data_table_investor/dataTables.min.js" type="text/javascript"></script>
<?php /* data:{'from_date':'<?php echo @$from_date?>','to_date':'<?php echo @$to_date?>','fy_date':'<?php echo $fy_date;?>'}, */?>
<script type="text/javascript" language="javascript" >
        $(document).ready(function() {
            var dataTable = $('#sample_1').DataTable( {
                "processing": true,
                "serverSide": true,
				"language": 
				{          
					"processing": "<img src='<?php echo $base=Yii::app()->theme->baseUrl; ?>/assets/global/img/image_loader.gif'/>",
				},
				buttons: [{
					 extend: "print",
					 className: "btn white btn-outline"
				 }, {
					 extend: "pdf",
					 className: "btn white btn-outline"
				 }, {
					 extend: "excel",
					 className: "btn white btn-outline"
				 }],
                "ajax":{
                    url :"/backoffice/admin/adminTasks/getInvestors",
                    type: "post",					
                    error: function(){
                        $(".sample_1-error").html("");
                        $("#sample_1").append('<tbody class="sample_1-error"><tr><th colspan="8">No data found in the server</th></tr></tbody>');
                        $("#sample_1_processing").css("display","none");

                    }
                },
                "aoColumns": [					
                    { data: 'SNo' } ,
                    { data: 'iuid' } ,
                    { data: 'InvestorDetail'},
                    { data: 'InPrincipleApplication'},                    
                    { data: 'ExistingEnterprises' },                   
					{ data: 'DepartmentalClearance'},
					{ data: 'Inspection',orderable: false },
                    { data: 'Action' } 
                ],
                "columnDefs": [
                    {
                        "targets":7,
                        orderable: false,
                        "render": function(data, type, row, meta){							
							if(row['Action']){
								return '<a href="'+row['Action']+'" target="_blank">View Investor Dashboard</a>';
							}else{
									return "";
							}
                        }
                    }
                ]
            });
			
			$("#swu").on('click',function(){
				
				$('#first_data').show();
				$('#second_data').hide();
				$("#showgroup").hide();								
				$("#dpu" ).prop("checked",false);				
				$('#sample_1').dataTable().fnDestroy();
				var dataTable = $('#sample_1').DataTable( {
					"processing": true,
					"serverSide": true,
					"language": 
					{          
						"processing": "<img src='<?php echo $base=Yii::app()->theme->baseUrl; ?>/assets/global/img/image_loader.gif'/>",
					},
					buttons: [{
                         extend: "print",
                         className: "btn white btn-outline"
                     }, {
                         extend: "pdf",
                         className: "btn white btn-outline"
                     }, {
                         extend: "excel",
                         className: "btn white btn-outline"
                     }],	
					"ajax":{
						url :"/backoffice/admin/adminTasks/getInvestors",
						type: "post",						
						error: function(){
							$(".sample_1-error").html("");
							$("#sample_1").append('<tbody class="sample_1-error"><tr><th colspan="8">No data found in the server</th></tr></tbody>');
							$("#sample_1_processing").css("display","none");

						}
					},
					"aoColumns": [					
						{ data: 'SNo' } ,
						{ data: 'iuid' } ,
						{ data: 'InvestorDetail'},
						{ data: 'InPrincipleApplication'},
						{ data: 'ExistingEnterprises' },
						{ data: 'DepartmentalClearance'},
						{ data: 'Inspection',orderable: false },
						{ data: 'Action' } 
					],
					"columnDefs": [
						{
							"targets":7,
							orderable: false,
							"render": function(data, type, row, meta){	
								if(row['Action']){
									return '<a href="'+row['Action']+'" target="_blank">View Investor Dashboard</a>';
								}else{
									return "";
								}
							}
						}
					]
				});
			});
			
			
			$("#dpu").on('click',function(){		
				
				$('#first_data').hide();
				$('#second_data').show();
				$("#swu" ).prop("checked",false);				
				$("#showgroup").show();	
					
				$('#sample_2').dataTable().fnDestroy();
				var dataTable = $('#sample_2').DataTable( {
					"processing": true,
					"serverSide": true,
					"language": 
					{          
						"processing": "<img src='<?php echo $base=Yii::app()->theme->baseUrl; ?>/assets/global/img/image_loader.gif'/>",
					},	
					"ajax":{
						url :"/backoffice/admin/adminTasks/getDeptInvestors2",
						type: "post",
						data:{"groupdata":'applicant_email'},
						error: function(){
							$(".sample_2-error").html("");
							$("#sample_2").append('<tbody class="sample_2-error"><tr><th colspan="6">No data found in the server</th></tr></tbody>');
							$("#sample_2_processing").css("display","none");

						}
					},
					"aoColumns": [					
						{ data: 'SNo' } ,
						{ data: 'iuid' } ,
						{ data: 'InvestorDetail'},						
						/* { data: 'InPrincipleApplication'},						
						{ data: 'ExistingEnterprises'},  */						
						{ data: 'DepartmentalClearance'},
						{ data: 'Inspection',orderable: false },
						{ data: 'Action' } 
					],
					"columnDefs": [
						{
							"targets":5,
							orderable: false,
							"render": function(data, type, row, meta){
								/* return meta.row + meta.settings._iDisplayStart + 1; */
								if(row['Action']){
									return '<a href='+row['Action']+' target="_blank">View Certificate</a>';
								}else{
									return "";
								}

							}
						}
					]
				});
			});	
			
			$("#groupdata").on('change',function(){
				var grouData = $(this).val();
				$("#swu" ).prop("checked",false);
				$("#showgroup").show();	
				$('#sample_2').dataTable().fnDestroy();
				var dataTable = $('#sample_2').DataTable( {
					"processing": true,
					"serverSide": true,
					"language": 
					{          
						"processing": "<img src='<?php echo $base=Yii::app()->theme->baseUrl; ?>/assets/global/img/image_loader.gif'/>",
					},	
					"ajax":{
						url :"/backoffice/admin/adminTasks/getDeptInvestors2",
						type: "post",
						data:{"groupdata":grouData},
						error: function(){
							$(".sample_2-error").html("");
							$("#sample_2").append('<tbody class="sample_2-error"><tr><th colspan="6">No data found in the server</th></tr></tbody>');
							$("#sample_2_processing").css("display","none");

						}
					},
					"aoColumns": [					
						{ data: 'SNo' } ,
						{ data: 'iuid' } ,
						{ data: 'InvestorDetail'},						
						/* { data: 'InPrincipleApplication'},						
						{ data: 'ExistingEnterprises'},  */						
						{ data: 'DepartmentalClearance'},
						{ data: 'Inspection',orderable: false },
						{ data: 'Action' } 
					],
					"columnDefs": [
						{
							"targets":5,
							orderable: false,
							"render": function(data, type, row, meta){
								
								if(row['Action']){
									return '<a href="'+row['Action']+'" target="_blank">View Certificate</a>';
								}else{
									return "";
								}

							}
						}
					]
				});
			});
			
			/* $("#deptdata").on('change',function(){
				var deptData = $(this).val();
				$("#swu" ).prop("checked",false);
				$("#showgroup").show();	
				$("#showdept").show();	
				$('#sample_1').dataTable().fnDestroy();
				var dataTable = $('#sample_1').DataTable( {
					"processing": true,
					"serverSide": true,
					"language": 
					{          
						"processing": "<img src='<?php echo $base=Yii::app()->theme->baseUrl; ?>/assets/global/img/image_loader.gif'/>",
					},	
					"ajax":{
						url :"/backoffice/admin/adminTasks1/getDeptInvestors2",
						type: "post",
						data:{"deptData":deptData},
						error: function(){
							$(".sample_1-error").html("");
							$("#sample_1").append('<tbody class="sample_1-error"><tr><th colspan="6">No data found in the server</th></tr></tbody>');
							$("#sample_1_processing").css("display","none");

						}
					},
					"aoColumns": [					
						{ data: 'SNo' } ,
						{ data: 'iuid' } ,
						{ data: 'InvestorDetail'},
						{ data: 'InPrincipleApplication'},
						{ data: 'ExistingEnterprises' },
						{ data: 'DepartmentalClearance',orderable: false},
						{ data: 'Action' } 
					],
					"columnDefs": [
						{
							"targets":6,
							orderable: false,
							"render": function(data, type, row, meta){
								if(row['Action']){
									return '<a href="'+row['Action']+'" target="_blank">View Certificate</a>';
								}else{
									return "";
								}

							}
						}
					]
				});
			}); */
        });
 </script>