<?php
//print_r($_SESSION);
$baseUrl = Yii::app()->theme->baseUrl;
?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?= $baseUrl ?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?= $baseUrl ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<style>
    a:hover{color:#000;}
</style>

<!-- END PAGE HEADER-->
<?php if (isset($_SESSION['RESPONSE']['user_id']) && !empty($_SESSION['RESPONSE']['user_id'])) {  ?>
	<!--<div class="page-bar">
		<div class="col-md-8">
			<ul class="page-breadcrumb">
				<li>
				<span class="pull-left"><a href="/backoffice/frontuser/home/serviceNew" title="Go to Departmental Services : New" class="fa fa-home homeredirect" ></a><b> <?php /* if(!empty(@$_SESSION['RESPONSE']['user_id']) || (isset($_GET['panel']) && $_GET['panel'] = 'investor')) 
						echo "Welcome to Investor Panel - Uttarakhand";
					else{
						if(isset($iuid) && $iuid != '')
						echo " Details of IUID - ".$iuid ;
					} */?> 
					</b></span> 					 
				</li>
			</ul>
		</div>
		<div class="col-md-4">
			<span class="pull-right" style="margin-top:5px;"><a href="https://caipotesturl.com/backoffice/frontuser/home/investorWalkthrough" class="btn btn-success"><i class="fa fa-arrow-left"></i>&nbsp; Back</a></span>
		</div>
	</div>-->
	<br><div class="dashboard-welcome">
		<h2 class="full-width">
			<div class="dashboard-inner-hd-left">
			<p class="dashbrd-inner-hd">
				<?php 
				if(!empty(@$_SESSION['RESPONSE']['user_id']) || (isset($_GET['panel']) && $_GET['panel'] = 'investor')) 
					echo "Welcome to Investor Panel - Uttarakhand";
				else{
					if(isset($iuid) && $iuid != '')
						echo " Details of IUID - ".$iuid ;
				}?> 
			</p>
			</div>
			<div class="dashboard-inner-hd-right"><a href="/backoffice/frontuser/home/investorWalkthrough" class="blue-btn-new"><i class="fa fa-angle-left"></i>Back</a></div>
			<div class="clearfix"></div>
		</h2>
		<!--<div class="welcome-date hidden-xs"><i class="icon-calendar"></i>&nbsp;<?php echo date('d-M-Y'); ?></div>-->
		<div class="clearfix"></div>
	</div>	
<?php } ?>
<?php 
$class ="";
$class2 = "margin:0px 0px 20px 0px;";
    // WITHOUT LOGIN [CHANGE 2]- EXTRA CODE
    if (empty($_SESSION['RESPONSE']['user_id']) && empty($_SESSION['uid'])) {
        ?>
		<link href="https://caipotesturl.com/themes/investuk/assets/global/css/components.min.css" rel="stylesheet">
		<link href="https://caipotesturl.com/themes/investuk/css/dashboard_style.css" rel="stylesheet">
		<div class="inner-header" >
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<h2 class="pageTitle"></h2>
						<ul class="inner-header-breadcrum">
							<li><a href="#">You are now on</a></li>
							<li class="pageTitle">search land</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		
		
    <?php $class = "margin: 0px 85px 0px 25px;";
	$class2 = "margin: 27px 85px 40px 25px;";
	} // WITHOUT LOGIN [CHANGE 2] - EXTRA CODE - ENDS HERE?>
       
<div class="row" style="<?php echo $class2; ?>" style="background-color:#fff;">
    <div class="portlet-body">       
		<div class="col-md-2 caption-subject bold uppercase" style="text-align:left;margin-top:10px;">Are You Looking For</div>
		<div class="col-md-4">
			<select class="form-control la_type" name="LandownerConnect[la_type]" id="LandownerConnect_la_type" >
				<option value="Gov">Govt. Land</option>
				<option value="Pvt">Private Land</option>
				<option value="SIIDCUL">SIIDCUL Land</option>
				<option value="PrivateIndustrialEstates">Private Industrial Estates</option> 
				<option value="SpecialIndustrialEstates">Special Industrial Estates for Mega Projects</option>  					
				<option value="MiniIndustrialEstates">Mini Industrial Estates</option>
				<option value="GIS">Industrial Estate - GIS Search</option>
			</select>
		</div>
    </div>
</div>
<script>
$("#LandownerConnect_la_type").change(function(){                                    
	if($(this).val()=="Gov"){
		window.location = '/backoffice/iloc/property/advanceSearch';
	}
	if($(this).val()=="Pvt"){
		window.location = '/backoffice/iloc/property/listing/landtype/Pvt';
	}
	if($(this).val()=="SIIDCUL"){		
		window.open('https://www.siidculsmartcity.com/ViewVacantPlot.aspx','_blank');
	}
	if($(this).val()=="PrivateIndustrialEstates"){		
		window.open('https://caipotesturl.com/site/PrivateIndustrialEstates','_blank');
	}
	if($(this).val()=="SpecialIndustrialEstates"){	
		window.open('https://caipotesturl.com/site/specialIndustrialEstates','_blank');
	}
	if($(this).val()=="MiniIndustrialEstates"){		
		window.open('https://caipotesturl.com/site/miniIndustrialEstates','_blank');
	}
	if($(this).val()=="GIS"){
		window.open('https://www.siidculsmartcity.com/GIS/','_blank');
	}
});
</script>
<div class="row" style="<?php echo $class;?>" >
    <div class="content-blocks">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i style="font-size:24px" class="fa fa-building-o"></i>
                   Government Land - District Magistrate
                </div>
            </div>

            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-hover" id="ppp00">
                        <thead>
                            <tr>
                                <th class="mid_center" align="center" width="10%">S. No.</th>
                                <th class="mid_center" align="center" width="60%">District Magistrate</th>
                                <th class="mid_center" align="center" width="30%"> Land Available  </th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($districts)) {
                                $count = 1;
                                foreach ($districts as $key => $data) {
                                    ?> 

                                    <tr>
                                        <td class="mid_center"><?php echo $count; ?></td>
                                        <td >D.M. <?php echo $data['distric_name']; ?></td>
                                        <!-- Getting All Land Added by DM  -- Rahul Kumar 14032018 -->
                                        <td class="mid_center" align="center"><a href="/backoffice/iloc/property/listing/district/<?php echo $data['district_id']; ?>/AddedBy/DM"><?php echo LandownerConnectEXT::getLandAddedByDM($data['district_id']); ?></a> </td>						 
                                    </tr>

                                    <?php $count++;
                                }
                            } else { ?>
                                <tr><td colspan="5">No record(s) found.</td></tr>
<?php } ?>

                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
</div>


<?php /*   All department List   */ ?>

<div class="row" style="<?php echo $class;?>" >
    <div class="content-blocks">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
     <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i style="font-size:24px" class="fa fa-building-o"></i>
                    Government Land - Department
                </div>
            </div>

            <div class="portlet-body">

                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-hover" id="ppp00">
                        <thead>
                            <tr >
                                <th class="mid_center" align="center" width="10%">S. No.</th>
                                <th class="mid_center" align="center" width="60%">Department Name</th>
                                <th class="mid_center" align="center" width="30%"> Land Available  </th> 
                            </tr>
                        </thead>
                        <tbody>
<?php if (count($departments)) {
    $count = 1;
    foreach ($departments as $key => $data) {
        ?> 
                                    <tr>
                                        <td align="center"><?php echo $count; ?></td>
                                        <td><?php echo $data['department_name']; ?></td>
                                         <!-- Getting All Land Added by Department [ HOD ] -- Rahul Kumar 14032018 -->                                            
                                        <td class="mid_center" align="center"><a href="/backoffice/iloc/property/listing/department/<?php echo $data['dept_id']; ?>/AddedBy/DEPT"> <?php echo LandownerConnectEXT::getLandAddedByDepartment($data['dept_id']); ?></a> </td>						 
                                    </tr>

        <?php $count++;
    }
} else { ?>
                                <tr><td colspan="5">No record(s) found.</td></tr>
<?php } ?>

                        </tbody>
                    </table>

                </div>
            </div>



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
