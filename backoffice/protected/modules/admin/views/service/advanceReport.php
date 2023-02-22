<?php
/* Rahul Kumar : 13072018 */
//print_r($serviceData);die; 
$base = Yii::app()->theme->baseUrl;
$baseUrl = Yii::app()->theme->baseUrl;
// Making Status Array
$statusArray = array('A' => 'Approved', 'P' => 'Pending', 'F' => 'Forwarded', 'I' => 'Incomplete', 'RBI' => 'Reverted', 'R' => 'Rejected');//,'O'=>'Rejected'
$selectedDepartment = explode(",", $departmentList);
$selectedServices = explode(",", $serviceList);
$selectedStatus = explode(",", $statusList);
?>
<style>
    #filterDiv{display:none;}
    #loaderDiv{display:block;}
    .modal .modal-header {
        border-bottom: 1px solid #EFEFEF;
        color: #fff;
        background: #36c6d3;
    }
    table th{ vertical-align: midddle;text-align: center;}

    .select2-container .select2-choice {
        -moz-border-radius: 0;
        -webkit-border-radius: 0;
        border-radius: 0;
        background-image: none;
        background: #fff;
        height: 30px;
    }
    .select2-container .select2-choice div {
        border-left: 0;
        background: none;
    }
    .select2-container .select2-choice .select2-arrow {
        background: none;
        border: 0;
    }
    .select2-container.select2-drop-above .select2-choice {
        -moz-border-radius: 0;
        -webkit-border-radius: 0;
        border-radius: 0;
        background-image: none;
    }
    .select2-container .select2-search-choice-close {
        top: 3px;
    }
    .select2-container .select2-choices {
        background-image: none;
    }
    .select2-container.select2-container-multi .select2-choices {
        -moz-box-shadow: none;
        -webkit-box-shadow: none;
        box-shadow: none;
        background: #fff;
    }
    .select2-container.select2-container-multi .select2-choices .select2-search-field input {
        padding: 9px 5px;
    }
    .select2-container.select2-container-multi .select2-choices .select2-search-choice {
        background: #eee;
        -moz-box-shadow: none;
        -webkit-box-shadow: none;
        box-shadow: none;
        -moz-border-radius: 0;
        -webkit-border-radius: 0;
        border-radius: 0;
    }

    .select2-results, .select2-search, .select2-with-searchbox {
        -webkit-border-radius: 0 !important;
        -moz-border-radius: 0 !important;
        border-radius: 0 !important;
    }
    .select2-results .select2-highlighted {
        background: rgb(38,194,129) !important;
        color: #fff;
    }
    .input-group-lg > .form-control, .input-group-lg > .input-group-addon, .input-group-lg > .input-group-btn > .btn, .input-lg {
        height: 42px;   
    }
	.rangewidth{
		height: 42px; 
	}	
</style>

<link rel="stylesheet" href="https://www.jqueryscript.net/demo/Configurable-Date-Picker-Plugin-For-Bootstrap/dist/css/bootstrap-datepicker3.css">
<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/css/plugins/select2/select2.css">
<!-- select2 -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/plugins/select2/select2.min.js"></script>
<!-- Theme framework -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/eakroko.min.js"></script>
<div class="page-bar">
   <div class="col-md-8">
	  <ul class="page-breadcrumb">
		 <li>
			<span class="pull-left"><a href="/backoffice/mis/newReport/OverallNewReport" title="Go to Dashboard " class="fa fa-home homeredirect"></a></span>
			<b>Welcome to State Monitoring Panel - Uttarakhand</b>  
		 </li>
	  </ul>
	</div>
    <div class="col-md-4">
		<span class="pull-right" style="margin-top:5px;"><a href="/backoffice/mis/newReport/OverallNewReport" class="btn btn-success"><i class="fa fa-arrow-left"></i>&nbsp; Back</a></span>
	</div>
</div>
<div class='portlet box ' id="loaderDiv" <?php if(isset($type) && !empty($type)) { echo "style='display:none;'";}?>>
    <div class="portlet-body" >
        Filters are getting enabled
        <img width = "100px" height="100px" src = "/backoffice/themes/swcsNewTheme/img/straight-loader.gif">
    </div>
</div>
<?php 
if(!empty($type)){
	include_once('/var/www/html/backoffice/themes/investuk/views/layouts/service_filter.php');
}
?>
<div class='portlet box ' id="filterDiv" <?php if(isset($type) && !empty($type)) { echo "style='display:none;'";}?>>
    <div class="portlet-body" >
        <form method="POST">
            <div class="row">
				<?php 
					$display = "none";
					$display1 = "block";
					if(isset($fy) && !empty($fy)){
						$display="block";
						$display1="none";
					}
					?>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <!--<label class="col-md-3 control-label">Select Date Range</label>-->
                        <div class="mt-radio-inline">
                            <label class="mt-radio">
                                <input type="radio" name="optionsRadios" id="optionsRadios25" value="date" class="date_range form-control" <?php if($display1=="block"){ echo "checked=checked";}else{ echo "";}?>> Date Range
                                <span></span>
                            </label>
                            <label class="mt-radio">
                                <input type="radio" name="optionsRadios" id="optionsRadios26" value="fy"  class="date_range form-control" <?php if($display=="block"){ echo "checked=checked";}else{ echo "";}?>> Financial Year
                                <span></span>
                            </label>							
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-6">
                        <span id="dept" style="display:<?php echo $display1;?>">
                            <label>Select Date Range</label>                  
                            <div class="input-daterange input-group demo-3" id="datepicker">
                                <input type="text" class="input-lg form-control" name="start" autocomplete="off" value="<?php echo @$start;?>"/>
                                <span class="input-group-addon input-lg">to</span>
                                <input type="text" class="input-lg form-control" name="end" autocomplete="off" value="<?php echo @$end;?>"/>
                            </div>
                        </span>

                        <span id="fy_year" style="display:<?php echo $display;?>">
                            <label>Select Financial Year</label>
                            <?php
                            $m = date('m');
                            $yyy = date('Y');
                            if ($m > 3) {
                                $yyy = $yyy - 1;
                            }
                            $pp = '2015';
                            ?>
                            <select name="fy" class="fy_select form-control" style="border-color:#aaa;height:40px;width:680px !important;">
                                <option value="" 
                                <?php
                                if ($fy == "ALL") {
                                    echo "selected='selected'";
                                }
                                ?> >ALL
                                </option>
                                <?php
                                for ($i = $pp; $i <= $yyy + 1; $i++) {
                                    $j = $i + 1;
                                    $k = $i . '-' . $j;
                                    $kv = $i . '-04-01:' . $j . '-03-31';
                                    ?>
                                    <option value="<?php echo $kv; ?>" 
                                    <?php
                                    if ($fy == $kv) {
                                        echo "selected='selected'";
                                    }
                                    ?>>
                                                <?php echo $k; ?>
                                    </option>
                                <?php }
                                ?>           
                            </select>

                        </span>
                    </div>
                    <div class="col-md-6">
                        <label>Select Incidence</label>
                        <select name="incidence[]" class="select2-me dept_incendence"  multiple="multiple"  id="incidence">
                            <option value="All">All Incidences</option>
                            <option value="pre_establishment" <?php if(isset($preEstabmishment) && !empty($preEstabmishment)){ echo "selected='selected'"; } ?>>Pre Establishment</option>
                            <option value="pre_operation" <?php if(isset($preOperation) && !empty($preOperation)){ echo "selected='selected'"; } ?>>Pre Operation</option>
                            <option value="post_operation" <?php if(isset($postOperation) && !empty($postOperation)){ echo "selected='selected'"; } ?>>Post Operation</option>                        
                        </select>                    
                    </div>
                </div>
                <div class="col-md-12" style="margin-top:15px;">
                    <div class="col-md-6">
                        <label>Select Department</label>
                        <select class="select2-me dept_incendence" multiple="multiple" name="department[]" id="department">
                            <option value="All" <?php
                                if (in_array('All', $selectedDepartment)) {
                                    echo " selected";
                                }
                                ?>>All Departments</option>
                            <?php
                            $sql = "SELECT ssp.sp_id, bd.department_name from sso_service_providers as ssp LEFT JOIN bo_departments as bd ON ssp.department_id=bd.dept_id where ssp.is_service_provider_active='Y' AND bd.department_name!=''";
                            // Gettting values from dattabase as per passed parameters for services
                            $allList = Yii::app()->db->createCommand($sql)->queryAll();
                            // print_r($allList);die;
                            ?>
                            <?php foreach ($allList as $k => $v) { ?>
                                <option value="<?php echo $v['sp_id']; ?>" <?php
                                if (in_array($v['sp_id'], $selectedDepartment)) {
                                    echo " selected";
                                }
                                ?>><?php echo $v['department_name']; ?></option>  
                                    <?php } ?>
                        </select>
                    </div>
                    <?php //print_r($allList);die;  ?>
                    <div class="col-md-6">
                        <label>Select Service</label>
                        <select class="select2-me" multiple="multiple" name="service[]" id="service">
                            <option value="All" <?php
                                if (in_array('All', $selectedServices)) {
                                    echo " selected";
                                }
                                ?>>All Services</option>
                            <?php
                            if (!isset($departmentID)) {
                                $departmentID = "select sp_id From sso_service_providers where is_service_provider_active='Y'";
                            }
                            $sql = "select app_id,app_name from bo_sp_all_applications where sp_id IN ($departmentID) AND is_app_active='Y'";
                            // Gettting values from dattabase as per passed parameters for services 
                            $allList = Yii::app()->db->createCommand($sql)->queryAll();
                            ?>
                            <?php foreach ($allList as $k => $v) { ?>
                                <option value="<?php echo $v['app_id']; ?>" <?php
                                if (in_array($v['app_id'], $selectedServices)) {
                                    echo " selected";
                                }
                                ?>><?php echo $v['app_name']; ?></option>  
                                    <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top:15px;">
                    <div class="col-md-6">
                        <label>Select Status</label>
                        <select class="select2-me" multiple="multiple" name="serviceStatus[]"> 
                            <option value="All" <?php
                                if (in_array('All', $selectedStatus)) {
                                    echo " selected";
                                }
                                ?>>All Status</option>
                            <?php foreach ($statusArray as $key => $status) { ?>
                                <option value="<?php echo $key; ?>" <?php
                                if (in_array($key, $selectedStatus)) {
                                    echo " selected";
                                }
                                ?>><?php echo $status; ?></option>
                                    <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Select Timeline</label>
                        <select class="select2-me" name="timeline">    
                            <option value="All" <?php if(isset($timeline) && $timeline=='All'){ echo "selected"; }?> >All</option>
                            <option value="TA" <?php if(isset($timeline) && $timeline=='TA'){ echo "selected"; }?> >Timeline Adhered</option>
                            <option value="TV" <?php if(isset($timeline) && $timeline=='TV'){ echo "selected"; }?> >Timeline Violated</option>   
                        </select>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top:15px;">
                    <div class="col-md-6">
                        <label>Application Number</label>
                        <input class="form-control" placeholder="Application Number" name="applicationNumber" <?php if (!empty($applicationNumber)) { ?> value="<?php echo $applicationNumber; ?>" <?php } ?>>
                    </div>
                    <div class="col-md-6">
                        <label>Unit Name</label>
                        <input class="form-control" placeholder="Unit Name" name="unitName" <?php if (!empty($unitName)) { ?> value="<?php echo $unitName; ?>" <?php } ?>>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="text-align:center;margin-top:15px;">
                    <input type="submit" value="Genrate Report"  name="submit" class="btn btn-success" >
                    <input type="button" value="Reset" onclick="clearForm(this.form);" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>
<?php
if (!empty($serviceData)) {
?>
<div class='portlet box green'>
    <div class='portlet-title'>
        <div class='caption'>
            <i style=" font-size:20px;" class='fa fa-list'></i>
			<?php 
			if(isset($type) && !empty($type) && $type=='cte_services') {
				echo 'CTE Services Summary'; 
			}else if(isset($type) && !empty($type) && $type=='cto_services') {
				echo 'CTO Services Summary'; 
			}else if(isset($type) && !empty($type) && $type=='post_operation') {
				echo 'Post Operation Services Summary'; 
			}else if(isset($type) && !empty($type) && $type=='adhered') {
				echo 'Timeline Adhered Services Summary'; 
			}else { ?>
			Summary
			<?php }?></div>
        <div class='tools'>	
        </div>
        <div class="dto-buttons" style="margin:3px 5px 0 0;float: right; "></div>	
    </div>
	<div class="portlet-body">	
		<table class="table table-striped table-bordered table-hover" id="sample_2">	
			<thead>
			<tr>
				<td style="text-align:center;"><b>S.No.</b></td>
				<td style="text-align:center;"><b>Name of Department</b></td>
				<td style="text-align:center;" id="toar"><b>Total Submitted Application</b></td>
				<td style="text-align:center;" id="ta"><b>Timeline Adhered</b></td>
				<td style="text-align:center;" id="tv"><b>Timeline Violated</b></td>
				<td style="text-align:center;" id="notapp"><b>Not Applicable</b></td>
			</tr>
			</thead>
			<tbody>
		    <?php 
			//
			foreach($serviceData as $key => $serviceDetail) { 
				$getIncedence = ServiceController::getServiceIncendence($serviceDetail['sp_app_id']); 
				$inc = explode("<br/>",$getIncedence);
				$applied_date = $serviceDetail['Application Date'];
				$sql = "SELECT timeline_type_service,timeline_type_service_value from bo_infowizard_service_timeline_new "
						. "where core_service_id = $serviceDetail[sp_app_id] and from_date < '" . $applied_date . "' order by from_date desc limit 1 ";
				$tline = Yii::app()->db->createCommand($sql)->queryAll();
				if($serviceDetail['sno'] != '') {
					$getDeptTime = ServiceController::getServiceTimetakenbyDept($serviceDetail['sno']);
				}

				//$getDeptTime = $serviceDetail['application_time_taken_by_department'];
				$days_exceed = 0;
				if (!empty($tline[0]['timeline_type_service_value']) && !empty($getDeptTime)) {
					$days_exceed = $tline[0]['timeline_type_service_value'] - $getDeptTime;
				} elseif (empty($getDeptTime)) {
					$days_exceed = 'NA';
				}elseif(empty($tline[0]['timeline_type_service_value'])){
					$days_exceed = 'NA';
				}
				if(isset($timeline) && ($timeline != ''))
				{
                                    if(isset($_GET['jk']) && ($_GET['jk']=='m')){ 
                        if($serviceDetail['issuerby_id']=='63'){
                        print_r($timeline);die(); }
                        }
					if((($timeline == 'TA') && ($days_exceed >= 0)) || (($timeline == 'TV') && ($days_exceed < 0)) || ($timeline == 'All')){				
						
						if (empty($days_exceed)) {
							$result[$serviceDetail['issuerby_id']][$serviceDetail['service_id']]['TNOTAPP']= @$result[$serviceDetail['issuerby_id']][$serviceDetail['service_id']]['TNOTAPP']+1;
						} elseif($days_exceed < 0)
						{
							$result[$serviceDetail['issuerby_id']][$serviceDetail['service_id']]['TV']= @$result[$serviceDetail['issuerby_id']][$serviceDetail['service_id']]['TV']+1;
						}else{
							$result[$serviceDetail['issuerby_id']][$serviceDetail['service_id']]['TA']= @$result[$serviceDetail['issuerby_id']][$serviceDetail['service_id']]['TA']+1;
						} 
					}
				}		
			}			
			$count = 1;
			/* echo "<pre>";
			print_r($result);die();  */
			foreach($result as $key=>$v)
			{ 		
				
				$ta =0;
				$tv =0;
				$tnot =0;
				foreach($v as $k1=>$v1)
				{
					$ta = $ta + @$v1['TA'];
					$tv = $tv + @$v1['TV'];
					$tnot = $tnot + @$v1['TNOTAPP'];
				}
				
			?>
			<tr>
				<td><?php echo $count++; ?></td>
				<td><?php if(!empty($key)) { echo $name = ServiceController::getDepartMentNameByIsseurId($key);} ?></td>
				<td style="text-align:center;"><?php echo $ta+$tv+$tnot; ?></td>
				<td style="text-align:center;"><?php echo $ta; ?></td>
				<td style="text-align:center;"><?php echo $tv;?></td>
				<td style="text-align:center;"><?php echo $tnot;?></td>
			</tr>	
			<?php 				
			} 
			?>
			</tbody>	
		</table>		
	</div>
</div>	
<?php } ?>
<div class='portlet box green'>
    <div class='portlet-title'>
        <div class='caption'>		
        <i style=" font-size:20px;" class='fa fa-list'></i>
		<?php if(isset($type) && !empty($type) && $type=='cte_services') {
				echo 'CTE Services'; 
			}else if(isset($type) && !empty($type) && $type=='cto_services') {
				echo 'CTO Services'; 
			}else if(isset($type) && !empty($type) && $type=='post_operation') {
				echo 'Post Operation Services'; 
			}else if(isset($type) && !empty($type) && $type=='adhered') {
				echo 'Timeline Adhered Services'; 
			}else {
		?>Services Applied <?php } ?>: <?php $hj=0;?><b id="hj"></b>  
		</div>
        <div class='tools'>	
        </div>
        <div class="dto-buttons" style="margin:3px 5px 0 0;float: right; "></div>	
    </div>
    <div class="portlet-body">		
        <div class="site-min-height">
            <div class="form form-horizontal" role="form">
            </div>
        </div>
        <?php
		/* echo "<pre>";
		print_r($serviceData);
		die();	 */
        if (!empty($serviceData)) {
            ?>
            <table id="sample_3" class="table table-striped table-bordered" width="100%">
                <thead>
                    <tr>
                        <th style="vertical-align:middle;">S.No.</th>
                        <th width="5%" style="vertical-align:middle;">Name of<br/> Department</th>
                        <th width="15%" style="vertical-align:middle;">Applied Service <br/> Detail</th>
                        <th width="10%" style="vertical-align:middle;">Incidence</th>
                        <th width="5%" style="vertical-align:middle;">Timeline <br/>(in days)</th>
                        <th width="10%" style="vertical-align:middle;">Unit Detail</th>                        
                        <th width="10%" style="vertical-align:middle;">Status at</th>                       
                        <th width="5%" style="vertical-align:middle;">Timeline<br/>Adhered</th>
                        <th style="vertical-align:middle;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
					$count = 1;
					foreach($serviceData as $key => $serviceDetail) {
					
                        $applied_date = $serviceDetail['Application Date'];
                        $sql = "SELECT timeline_type_service,timeline_type_service_value from bo_infowizard_service_timeline_new "
                                . "where core_service_id = $serviceDetail[sp_app_id] and from_date < '" . $applied_date . "' order by from_date desc limit 1 ";

                        $tline = Yii::app()->db->createCommand($sql)->queryAll();
                        if($serviceDetail['sno'] != '') {
                            $getDeptTime = ServiceController::getServiceTimetakenbyDept($serviceDetail['sno']);
                        }

                        $days_exceed = 0;
                        if (!empty($tline[0]['timeline_type_service_value']) && !empty($getDeptTime)) {
                            $days_exceed = $tline[0]['timeline_type_service_value'] - $getDeptTime;
                        } elseif (empty($getDeptTime)) {
                            $days_exceed = 'NA';
                        }elseif(empty($tline[0]['timeline_type_service_value'])){
							$days_exceed = 'NA';
						}
                       if(isset($timeline) && ($timeline != ''))
                            if((($timeline == 'TA') && ($days_exceed >= 0)) || (($timeline == 'TV') && ($days_exceed < 0)) || ($timeline == 'All')){
							$hj=$hj+1;
                        ?>
                        <tr>
							<td>
								<?php echo $count++; ?>
							</td>
							<td>
								<?php echo @$serviceDetail['Name of Department']; ?>
							</td>
							<td>
								<b title="Application Number"><?php echo @$serviceDetail['Application No.']; ?></b>
								<br><c title="Service Name"><?php echo @$serviceDetail['Service Name']; ?>
								<br><c title="applied at"><?php echo @$serviceDetail['Application Date']; ?></c>
							</td>
							<td>
								<?php echo $getIncedence = ServiceController::getServiceIncendence($serviceDetail['sp_app_id']); ?>
							</td>
							<td style="text-align:center;">
								<c title="TimeLine"> <?php echo @$tline[0]['timeline_type_service_value']; ?></c>
							</td>
							<td>
								<?php if(!empty($serviceDetail['Unit Name'])) { ?>
									<c title="Unit Name"> <?php echo @$serviceDetail['Unit Name']; ?></c>
									</br><c title="Unit Location"><?php echo @$serviceDetail['Unit Location']; ?></c>
									<b><c title="Unit District"><?php echo @$serviceDetail['Unit District']; ?></c></b>
									<br/><br/>
								<?php }  ?>						
								<span><b>Investor Detail:</b></span>
								<?php echo @$serviceDetail['Investor Name']; ?>
								</br><?php echo @$serviceDetail['Investor Email']; ?>
								</br><?php echo @$serviceDetail['Investor Mobile Number']; ?>
							</td>							
							<td>
								<b>
									<?php
									$status = $serviceDetail['Status'];
									echo $statusArray[$status];
									?> 
								</b>
								<br><?php echo @$serviceDetail['Last Updated']; ?>
								<hr style="margin:2px;">
								<b>Time Taken <br/> By Department:</b>
								<?php
								if (is_numeric($getDeptTime)) {
									echo $getDeptTime . ' ' . 'Days';
								} else
									echo 'NA';
								?>
							</td>                        
							<td>
								<?php 
								if (empty($days_exceed)) {
									echo 'Not Applicable in<br/> Single Window Act.';
								} elseif($days_exceed >= 0) {
									echo 'Yes';
								} else {
									echo 'No';
								} 
								?>
							</td>
							<td>     
								<a href="<?php echo Yii::app()->createAbsoluteUrl('mis/ServiceReport/servicedetail1/sid/' . @$serviceDetail['sno']) ?>/d1/2015-04-01/d2/<?php echo date('Y-m-d')?>/type/SERVICES/financial_year/ALL/dsa/<?php //echo $encodeddsa; ?>" > View Timeline
								</a>
							</td>
                        </tr>
                    <?php 							
						}	
					}
					
					?>
                    </tbody>
            </table>
            <?php				
        } else {
            echo "No Service Found.";
        }
        ?>
    </div>
</div>

<?php
$base = Yii::app()->theme->baseUrl;
?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?= $base ?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?= $base ?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?= $base ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="<?= $base ?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?= $base ?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?= $base ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->


<!--<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
<script src="https://www.jqueryscript.net/demo/Configurable-Date-Picker-Plugin-For-Bootstrap/dist/js/bootstrap-datepicker.js"></script>
<script>
// $('.demo-3').datepicker();
$('.demo-3').datepicker({
    format: 'dd-mm-yyyy',
	keepEmptyValues: true
})
</script>
<script type="text/javascript">
	function clearForm(oForm) {    
		var elements = oForm.elements;
		$(".select2-me").select2("val", "");
		for(i=0; i<elements.length; i++) {	  
			field_type = elements[i].type.toLowerCase();
			switch(field_type) {
				case "text": 
				case "password": 
				case "textarea":
				case "hidden": 			  
				  elements[i].value = ""; 
				  break;			
				case "radio":
				case "checkbox":
					if (elements[i].checked) {
						elements[i].checked = false; 
					}
					break;
				case "select":
					elements[i].selectedIndex = -1;
					break;
				default: 
					break;
			}
		}	
	}
    $(document).ready(function () {
		// Show hide Date Range / FY
        $(".date_range").on('click', function () {
            var id_val = $(this).val();
            if (id_val == "date")
            {
                $("#dept").show();
                $("#fy_year").hide();
				$(".fy_select").select2("val", "");
				$("#fyear option").prop("selected", false);
            } else {
                $("#fy_year").show();
                $("#dept").hide();
				$('input[name=start]').val("");
				$('input[name=end]').val("");
            }
        });
        // Show Services on change Department
        $(".dept_incendence").on('change', function () {
			var selectedValues = [];
            $("#department option:selected").each(function () {
                selectedValues += $(this).val() + ",";
            });
			if(selectedValues!='')
			{
				selectedValues = selectedValues.replace(/,\s*$/, "");
			}else{
				selectedValues = '';
			}
			var incedenceValues  = [];
            $("#incidence option:selected").each(function() {
				incedenceValues += $(this).val() + ",";
            });
			if(incedenceValues!='')
			{			
				incedenceValues = incedenceValues.replace(/,\s*$/, "");
			}else{
				incedenceValues = '';
			}
            $.ajax({
                type: 'POST',
                url: '/backoffice/admin/service/GetServicesByDepartment',
                data: 'sp_id=' + encodeURIComponent(selectedValues)+'&incedence=' + encodeURIComponent(incedenceValues),
                dataType: 'html'
            })
			.done(function (data) {
				$("#service").html(data);
			})
			.fail(function (data) {
				alert("Something went wrong please try again.");
			})
        });
        // Show Department on change Incidence
        $("#incidence").on('change', function () {
            var incedence = $(this).val();
            var selectedValues = [];
            $("#incidence option:selected").each(function () {
                selectedValues += $(this).val() + ",";
            });
			if(selectedValues!='')
			{
				selectedValues = selectedValues.replace(/,\s*$/, "");
			}else{
				selectedValues = '';
			}	
            $.ajax({
				type: 'POST',
				url: '/backoffice/admin/service/GetDepartmentByIncedence',
				data: 'incedence=' + encodeURIComponent(selectedValues),
				dataType: 'html'
			})
			.done(function (data) {
				$("#department").html(data);
			})
			.fail(function (data) {
				alert("Something went wrong please try again.");
			})            
        });
    });
    var TableDatatablesButtons = function () {
        var e = function () {
            var e = $("#sample_1");
            e.dataTable({
                language: {
                    aria: {
                        sortAscending: ": activate to sort column ascending",
                        sortDescending: ": activate to sort column descending"
                    },
                    emptyTable: "No data available in table",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No entries found",
                    infoFiltered: "(filtered1 from _MAX_ total entries)",
                    lengthMenu: "_MENU_ entries",
                    search: "Search:",
                    zeroRecords: "No matching records found"
                },
                buttons: [{
                        extend: "print",
                        className: "btn dark btn-outline"
                    }, {
                        extend: "copy",
                        className: "btn red btn-outline"
                    }, {
                        extend: "pdf",
                        className: "btn green btn-outline"
                    }, {
                        extend: "excel",
                        className: "btn yellow btn-outline "
                    }, {
                        extend: "csv",
                        className: "btn purple btn-outline "
                    }, {
                        extend: "colvis",
                        className: "btn dark btn-outline",
                        text: "Columns"
                    }],
                responsive: !0,
                order: [
                    [0, "asc"]
                ],
                lengthMenu: [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"]
                ],
                pageLength: 10,
                dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
            })
        },
                t = function () {
                    var e = $("#sample_2");
                    e.dataTable({
                        language: {
                            aria: {
                                sortAscending: ": activate to sort column ascending",
                                sortDescending: ": activate to sort column descending"
                            },
                            emptyTable: "No data available in table",
                            info: "Showing _START_ to _END_ of _TOTAL_ entries",
                            infoEmpty: "No entries found",
                            infoFiltered: "(filtered1 from _MAX_ total entries)",
                            lengthMenu: "_MENU_ entries",
                            search: "Search:",
                            zeroRecords: "No matching records found"
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
                        order: [
                            [0, "asc"]
                        ],
                        lengthMenu: [
                            [5, 10, 15, 20, -1],
                            [5, 10, 15, 20, "All"]
                        ],
                        pageLength: 10,
                        dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
                    });
					$("#sample_2_tools > li > a.tool-action").on("click", function () {
						var e = $(this).attr("data-action");
						t.DataTable().button(e).trigger()
					})
                },
                a = function () {
                    var e = $("#sample_3"),
					t = e.dataTable({
						language: {
							aria: {
								sortAscending: ": activate to sort column ascending",
								sortDescending: ": activate to sort column descending"
							},
							emptyTable: "No data available in table",
							info: "Showing _START_ to _END_ of _TOTAL_ entries",
							infoEmpty: "No entries found",
							infoFiltered: "(filtered1 from _MAX_ total entries)",
							lengthMenu: "_MENU_ entries",
							search: "Search:",
							zeroRecords: "No matching records found"
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
						responsive: !0,
						order: [
							[0, "asc"]
						],
						lengthMenu: [
							[5, 10, 15, 20, -1],
							[5, 10, 15, 20, "All"]
						],
						pageLength: 10,
                        dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
					});
                    $("#sample_3_tools > li > a.tool-action").on("click", function () {
                        var e = $(this).attr("data-action");
                        t.DataTable().button(e).trigger()
                    })
                },
                n = function () {
                  /*   $(".date-picker").datepicker({
                        rtl: App.isRTL(),
                        autoclose: !0
                    }); */
                    var e = new Datatable;
                    e.init({
                        src: $("#datatable_ajax"),
                        onSuccess: function (e, t) {},
                        onError: function (e) {},
                        onDataLoad: function (e) {},
                        loadingMessage: "Loading...",
                        dataTable: {
                            bStateSave: !0,
                            lengthMenu: [
                                [10, 20, 50, 100, 150, -1],
                                [10, 20, 50, 100, 150, "All"]
                            ],
                            pageLength: 10,
                            ajax: {
                                url: "../demo/table_ajax.php"
                            },
                            order: [
                                [1, "asc"]
                            ],
                            buttons: [{
                                    extend: "print",
                                    className: "btn default"
                                }, {
                                    extend: "copy",
                                    className: "btn default"
                                }, {
                                    extend: "pdf",
                                    className: "btn default"
                                }, {
                                    extend: "excel",
                                    className: "btn default"
                                }, {
                                    extend: "csv",
                                    className: "btn default"
                                }, {
                                    text: "Reload",
                                    className: "btn default",
                                    action: function (e, t, a, n) {
                                        t.ajax.reload(), alert("Datatable reloaded!")
                                    }
                                }]
                        }
                    }), e.getTableWrapper().on("click", ".table-group-action-submit", function (t) {
                        t.preventDefault();
                        var a = $(".table-group-action-input", e.getTableWrapper());
                        "" != a.val() && e.getSelectedRowsCount() > 0 ? (e.setAjaxParam("customActionType", "group_action"), e.setAjaxParam("customActionName", a.val()), e.setAjaxParam("id", e.getSelectedRows()), e.getDataTable().ajax.reload(), e.clearAjaxParams()) : "" == a.val() ? App.alert({
                            type: "danger",
                            icon: "warning",
                            message: "Please select an action",
                            container: e.getTableWrapper(),
                            place: "prepend"
                        }) : 0 === e.getSelectedRowsCount() && App.alert({
                            type: "danger",
                            icon: "warning",
                            message: "No record selected",
                            container: e.getTableWrapper(),
                            place: "prepend"
                        })
                    }), $("#datatable_ajax_tools > li > a.tool-action").on("click", function () {
                        var t = $(this).attr("data-action");
                        e.getDataTable().button(t).trigger()
                    })
                };
        return {
            init: function () {
                jQuery().dataTable && (e(), t(), a(), n())
            }
        }
    }();
    jQuery(document).ready(function () {
        TableDatatablesButtons.init()
    });

    $(window).load(function () {
	<?php if(empty($type)) { ?>
        $("#filterDiv").css('display', 'block');
        $("#loaderDiv").css('display', 'none');
	<?php } ?>	
		$("input[name='start']").removeClass("input-lg");
		$("input[name='end']").removeClass("input-lg");
		$("input[name='start']").addClass("rangewidth");
		$("input[name='end']").addClass("rangewidth");
		$(".input-group-addon").removeClass("input-lg");
		$("#hj").html(<?php echo $hj; ?>);
    });
</script>
