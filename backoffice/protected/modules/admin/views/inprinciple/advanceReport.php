<?php  
extract($_POST);
extract($_GET);
/* Rahul Kumar : 13072018 */
$base = Yii::app()->theme->baseUrl;
$baseUrl = Yii::app()->theme->baseUrl;
// Making Status Array
$statusArray = array('A' => 'Approved', 'P' => 'Pending', 'F' => 'Forwarded', 'I' => 'Incomplete', 'H' => 'Reverted', 'R' => 'Rejected', 'Z' => 'Archived');
$selected_district = explode(",", $districtListStr); 
$selected_nature_unit = explode(",", $natureUnitList); 
$selected_nicCodeList = explode(",", $nicCodeList);	
$selectedStatus = explode(",", $statusList);
$selected_nature_type = explode(",", $unitTypeList); 
?>
<style>
<?php if(!in_array("A", $status)) { ?> 
.approved_caf{display: none !important;} 
 <?php } ?> 
<?php if(!in_array("P", $status)) { ?> 
.pending_caf{display: none !important;}    
<?php } ?>
<?php if(!in_array("F", $status)) { ?>
.forward_caf{display: none !important;} 
 <?php } ?>
<?php if(!in_array("I", $status)) { ?>
.incomplete_caf{display: none !important;}
<?php } ?>	
<?php if(!in_array("H", $status)) { ?>
.reverted_caf{display: none !important;}
<?php } ?>
<?php if(!in_array("R", $status)) { ?> 
.rejected_caf{display: none !important;}
<?php } ?>
<?php if(!in_array("Z", $status)) { ?>
.archived_caf{display: none !important;} 
<?php } ?>

<?php if(!in_array("Manufacturing", $nature_unit) && !empty($nature_unit) && !in_array("All", $nature_unit)) {?>
.manufacturing_caf{display: none !important;} 
<?php } ?>
<?php if(!in_array("Services", $nature_unit) && !empty($nature_unit) && !in_array("All", $nature_unit)) { ?>
.service_caf{display: none !important;} 
<?php } ?>

#filterDiv{
	display:none;
}
#loaderDiv{
	display:block;
}
.modal .modal-header {
	border-bottom: 1px solid #EFEFEF;
	color: #fff;
	background: #36c6d3;
}
table th{
	vertical-align: midddle;
	text-align: center;
}
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

.portlet.box .dataTables_wrapper .dt-buttons {
	margin-top: -51px;
}

</style>

<?php 
if(isset($applicationData) && !empty($applicationData)) {
?>
<style>
.portlet.box div#sample_2_wrapper.dataTables_wrapper .dt-buttons {
	margin-top: -51px !important;
}
</style>
<?php
} else{
?>
<style>
.portlet.box div#sample_2_wrapper.dataTables_wrapper .dt-buttons {
	margin-top: -69px !important;
}
</style>
<?php
}  
?>
<link rel="stylesheet" href="https://www.jqueryscript.net/demo/Configurable-Date-Picker-Plugin-For-Bootstrap/dist/css/bootstrap-datepicker3.css">
<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/css/plugins/select2/select2.css">
<!-- select2 -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/plugins/select2/select2.min.js">
</script>
<!-- Theme framework -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/eakroko.min.js">
</script>
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
<div class='portlet box ' id="loaderDiv">    
  <div class="portlet-body" >
    Filters are getting enabled
    <img width = "100px" height="100px" src = "/backoffice/themes/swcsNewTheme/img/straight-loader.gif">
  </div>
</div>

<div class='portlet box green' id="filterDiv">    
	<div class="portlet-body" >
    <form method="POST">
      <div class="row">
	  <?php 
		$display = "none";
		$display1 = "block";
		if(isset($fy) && !empty($fy)){
			$display="none";
			$display1="block";
		}
		if(isset($start) && !empty($end)){
			$display="block";
			$display1="none";
		}
		?>
        <div class="col-md-12">
          <div class="col-md-6">
            <!--<label class="col-md-3 control-label">Select Date Range</label>-->
            <div class="mt-radio-inline">
              <label class="mt-radio">
                <input type="radio" name="optionsRadios" id="optionsRadios25" value="date" class="date_range form-control" <?php if($display=="block"){ echo "checked=checked";}else{ echo "";}?>> Date Range
                <span></span>
              </label>
              <label class="mt-radio">
                <input type="radio" name="optionsRadios" id="optionsRadios26" value="fy" class="date_range form-control" <?php if($display1=="block"){ echo "checked=checked";}else{ echo "";}?>> Financial Year
                <span></span>
              </label>							
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="col-md-6">
            <span id="dept" style="display:<?php echo $display;?>">
              <label>Select Date Range</label>                  
              <div class="input-daterange input-group demo-3" id="datepicker" style="z-index: 9991;">
                <input type="text" class="input-lg form-control" name="start" autocomplete="off" value="<?php echo @$start; ?>" />
                <span class="input-group-addon input-lg">to
                </span>
                <input type="text" class="input-lg form-control" name="end" autocomplete="off" value="<?php echo @$end; ?>"/>
              </div>
            </span>
			
            <span id="fy_year" style="display:<?php echo $display1;?>">
              <label>Select Financial Year</label>
              <?php
                $m = date('m');
                $yyy = date('Y');
                if ($m > 3) {
                $yyy = $yyy - 1;
                }
                $pp = '2015';
                ?>
				<select name="fy" class="select2-me fy_y">
					<option value="All" 
					<?php
					if (isset($fy) && $fy == "All") {
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
						  if (isset($fy) && $fy == $kv) {
						  echo "selected='selected'";
						  }
						  ?>>
						  <?php echo $k; ?>
						  </option>
				<?php } ?>           
				</select>
          </span>
		</div>
		  <div class="col-md-6">
			<label>Select District</label>
			<select name="district[]" class="select2-me"  multiple="multiple"  id="district">
			  <option value="All" <?php if (in_array('All', $district)) {
											echo " selected";
										}?>>All District</option>
			  <?php foreach ($districtList as $key => $val) { ?>
			  <option value="<?php echo $val['district_id']; ?>" <?php
									if (in_array($val['district_id'], $selected_district)) {
										echo " selected";
									}
									?>>
				<?php echo $val['distric_name']; ?>
			  </option>
			  <?php } ?>
			</select>                    
		  </div>
      </div>
		<div class="col-md-12" style="margin-top:15px;">
		  <div class="col-md-6">
			<label>Nature of Unit</label>
			<select class="select2-me" multiple="multiple" name="nature_unit[]" id="nature_unit">
			  <option value="All" <?php
										if (in_array('All', $nature_unit)) {
											echo " selected";
										}
										?>>ALL Nature of Unit</option>
			  <option value="Manufacturing" <?php
										if (in_array('Manufacturing', $selected_nature_unit)) {
											echo " selected";
										}
										?>>Manufacturing</option>
			  <option value="Services" <?php
										if (in_array('Services', $selected_nature_unit)) {
											echo " selected";
										}
										?>>Services</option>
			</select>
		  </div>
		
		  <div class="col-md-6">
			<label>NIC Codes</label>
			<select class="select2-me" multiple="multiple" name="nic_code[]" id="nic_code">
			  <option value="All"  <?php
										if (in_array('All', $nic_code)) {
											echo " selected";
										}
										?>>ALL NIC Codes</option>
				<?php
				$sql = "select II_DIGIT_Code,SUBSTRING(Description,1,100) as Description from NIC_II_DIGIT";
				$connection=Yii::app()->db; 
				$command=$connection->createCommand($sql);
				$allNicList=$command->queryAll();
				//$allNicList = Yii::app()->db->createCommand($sql)->queryAll();
				?>
				  <?php foreach ($allNicList as $k => $v) { ?>
				  <option value="<?php echo $v['II_DIGIT_Code']; ?>" <?php if(isset($selected_nicCodeList) && in_array($v['II_DIGIT_Code'],$selected_nicCodeList)){ echo "selected";} ?>>
					<?php echo $v['II_DIGIT_Code'] . '-' . $v['Description']; ?>
				  </option>  
				  <?php } ?>
			</select>
		  </div>
		</div>
		<div class="col-md-12" style="margin-top:15px;">
			<div class="col-md-6">
				<label>Unit Type</label>
				<select class="select2-me"  name="unit_type[]" id="unit_type"> 
				<option value="All" <?php
										if (in_array('All', $unit_type)) {
											echo " selected";
										}
										?>>ALL Unit Type</option>
				<option value="micro" <?php
										if(in_array('micro', $selected_nature_type)) {
											echo " selected";
										} 
										?>>Micro</option>                           
				<option value="medium" <?php
										if(in_array('medium', $selected_nature_type)) {
											echo " selected";
										} 
										?>>Medium</option>                           
				<option value="small" <?php
										if(in_array('small', $selected_nature_type)) {
											echo " selected";
										}
										?>>Small</option>                           
				<option value="large" <?php
										if(in_array('large', $selected_nature_type)) {
											echo " selected";
										}
										?>>Large</option>                           
				</select>
			</div> 
			<div class="col-md-6">
				<label>Select Timeline</label>
				<select class="select2-me" name="timeline" id="timeline">    
					<option value="All">All Timeline</option>
					<option value="less_15" <?php if(isset($timeline) && $timeline == 'less_15') {echo "selected"; } ?>>Less Than 15 Days
					</option>
					<option value="more_15" <?php if(isset($timeline) && $timeline == 'more_15') {echo "selected";} ?>>More Than 15 Days
					</option>   
				</select>
			</div>
		</div>
		<div class="col-md-12" style="margin-top:15px;">
			<div class="col-md-6">
				<label>Status</label>
				<select name="status[]" class="select2-me"  multiple="multiple" id="status"> 
					<option value="All" <?php
						if (in_array('All', @$status)) {
							echo " selected";
						}
						?>>All Status</option>
					<?php foreach($statusArray as $key => $status_val) { ?>
						<option value="<?php echo $key; ?>" <?php
						if (in_array($key, $selectedStatus)) {
							echo " selected";
						}
						?>>
						<?php echo $status_val; ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="col-md-6">
				<label>Application Number</label>
				<input type="text" class="form-control" id="textbox_app_number" placeholder="Application Number" name="applicationNumber" <?php if (!empty($applicationNumber)) { ?> value="<?php echo $applicationNumber; ?>" <?php } ?>>
			</div>
		</div>
		<div class="col-md-12" style="margin-top:15px;">	  
		  <div class="col-md-6">
			<label>Unit Name</label>
			<input type="text" class="form-control textboxfield" id="textbox_unit_name" placeholder="Unit Name" name="unitName" id="unitName" <?php if (!empty($unitName)) { ?> value="<?php echo $unitName; ?>" <?php } ?>>
		  </div>
		</div>
	</div>
	<div class="row">
	  <div class="col-md-12" style="text-align:center;margin-top:15px;">
		<input type="submit" value="Generate Report" name="submit" class="btn btn-success" >
		<input type="reset" value="Reset" id="reset" class="btn btn-primary" onclick="clearForm(this.form);">
	  </div>
	</div>
	</form>
	
	</div>
</div>

<div class='portlet box green'>
    <div class='portlet-title'>
		<?php 
		if(!empty($fy) && $fy!='All') 
		{
			$fyarr = explode(':',$fy); 				
			$msg ="CAF Summary for financial year ".date('Y',strtotime(@$fyarr[0])).'-'.date('Y',strtotime(@$fyarr[1]));
		}else if($fy=='All' && empty($start)){
			$msg ="CAF Summary for 'All' financial year";
		}else if(isset($start) && !empty($end))
		{
			$msg ="CAF Summary from date ".date('d-M-Y',strtotime($start))." to ".date('d-M-Y',strtotime($end));
		}else{
			$msg ="CAF Summary";
		}
		
		$naturemsg = "";
		if(isset($nature_unit[0]) && ($nature_unit[0]=='All'))
		{
			$naturemsg =", Nature of Unit:All"; 
		}else if(isset($nature_unit[0]) && ($nature_unit[0]!='All')){
			$naturemsg =", Nature of Unit: ".implode(", ", $nature_unit); 
		}
		
		$unittypemsg = "";
		if(isset($unit_type[0]) && ($unit_type[0]=='All'))
		{
			$unittypemsg =", Unit Type: All"; 
		}else if(isset($unit_type[0]) && ($unit_type[0]!='All')){
			$unittypemsg =", Unit Type: ".implode(", ", $unit_type); 
		}
		
		$statusmsg = "";
		$smsg = "";
		if(isset($status[0]) && ($status[0]=='All'))
		{
			$statusmsg =", Status: All"; 
		}
		else if(isset($status[0]) && ($status[0]!='All'))
		{
			//$statusmsg =", Status: ".implode(", ", $status);
			foreach($status as $k=>$v)
			{
				if($v=='A')
					$smsg .= 'Approved,';
				if($v=='I')
					$smsg .= 'Incomplete,'; 
				if($v=='P')
					$smsg .= 'Pending,';
				if($v=='H')
					$smsg .= 'Reverted,';
				if($v=='R')
					$smsg .= 'Rejected,';
				if($v=='F')
					$smsg .= 'Forwarded,';	
				if($v=='Z')
					$smsg .= 'Archived,';	
			}
			$statusmsg = ', Status: '.$smsg;
		}
		?>
        <div class='caption' style="cursor:pointer;" title="">
            <i style="font-size:20px;" class='fa fa-list'></i>
			<span><?php echo $msg;?></span><span> <i class="fa fa-question-circle" style="font-size:20px;text-align:right;"  aria-hidden="true" data-toggle="tooltip" data-placement="top" title="<?php echo $msg.$naturemsg.$unittypemsg.$statusmsg;?>"></i></span>
		</div>
        <div class='tools'>	
        </div>
        <div class="dto-buttons" style="margin:3px 5px 0 0;float: right; "></div>	
    </div>
	<div class="portlet-body">	
		<table class="table table-bordered summary_table" id="sample_1">	
			<thead>
				<tr>
					<th style="text-align:center;vertical-align:middle;"><b>S.No.</b></th>
					<th style="text-align:center;vertical-align:middle;"><b>District</b></th>
					<th style="text-align:center;vertical-align:middle;"><b>Total <br/>Submitted</b></th>
					<th style="text-align:center;vertical-align:middle;" class="manufacturing_caf"><b>Total<br/> Manufacturing</b></th>
					<th style="text-align:center;vertical-align:middle;" class="service_caf"><b>Total <br/>Services</b></th>
					<th style="text-align:center;vertical-align:middle;" class="pending_caf"><b>Pending with DIC</b></th>
					<th style="text-align:center;vertical-align:middle;" class="reverted_caf"><b>Reverted back to <br/>Investor</b></th>
					<th style="text-align:center;vertical-align:middle;" class="forward_caf"><b>Forwarded to <br/>Departments</b></th>
					<th style="text-align:center;vertical-align:middle;" class="pending_caf"><b>Pending with <br/>Departments</b></th>
					<th style="text-align:center;vertical-align:middle;" class="approved_caf"><b>Approved</b></th>
					<th style="text-align:center;vertical-align:middle;" class="rejected_caf"><b>Rejected</b></th>
					<th style="text-align:center;vertical-align:middle;" class="incomplete_caf"><b>Incomplete</b></th>
					<th style="text-align:center;vertical-align:middle;" class="archived_caf"><b>Archived</b></th>
					<th style="text-align:center;vertical-align:middle;"><b>Total Employment <br/>(Proposed)</b></th>
					<th style="text-align:center;vertical-align:middle;" class="approved_caf"><b>Total Employment <br/>(Approved)</b></th>
					<th style="text-align:center;vertical-align:middle;"><b>Total Investment <br/>(in INR Cr.)<br/>(Proposed)</b></th>
					<th style="text-align:center;vertical-align:middle;" class="approved_caf"><b>Total Investment <br/>(in INR Cr.)<br/>(Approved)</b></th>
				</tr>
			</thead>
			<tbody>
			<?php
			$count1 = 0;
			$count2 = 0;
			$count3 = 0;
			$count4 = 0;
			$count5 = 0;
			$count6 = 0;
			$count7 = 0;
			$count8 = 0;
			$count9 = 0;
			$count10 = 0;
			$count11 = 0;
			$count12 = 0;
			$count13 = 0;
			$count14 = 0;
			$c10 = 0;
			$totalDIC48Pending = 0;
			$countmalefemalecount = 0;
			$tot = 1;	
			$countManufacturing = 0;
			$countService = 0;
			
			if(!empty($districtArr))
			{	
				foreach($districtArr as $key=>$val)
				{	
					$totalCAFrecived = InprincipleController::getCafStatusCount($val['district_id'], 'districtSubmitted',@$start,@$end,@$fy,@$applicationNumber,@$nature_unit,@$unit_type,@$nic_code,@$status);
					$totalIncomplete = InprincipleController::getCafStatusCount($val['district_id'], 'districtIncomplete',@$start,@$end,@$fy,@$applicationNumber,@$nature_unit,@$unit_type,@$nic_code,@$status);
					$totalArchived = InprincipleController::getCafStatusCount($val['district_id'], 'districtArchived',@$start,@$end,@$fy,@$applicationNumber,@$nature_unit,@$unit_type,@$nic_code,@$status);
					$totalDICPending = InprincipleController::getCafStatusCount($val['district_id'], 'districtPending',@$start,@$end,@$fy,@$applicationNumber,@$nature_unit,@$unit_type,@$nic_code,@$status);
					$totalReverted = InprincipleController::getCafStatusCount($val['district_id'], 'districtReverted',@$start,@$end,@$fy,@$applicationNumber,@$nature_unit,@$unit_type,@$nic_code,@$status);
					$totalForwarded = InprincipleController::getCafStatusCount($val['district_id'], 'districtForwardedAndDisposed',@$start,@$end,@$fy,@$applicationNumber,@$nature_unit,@$unit_type,@$nic_code,@$status);
					$totalApproved = InprincipleController::getCafStatusCount($val['district_id'], 'districtApproved',@$start,@$end,@$fy,@$applicationNumber,@$nature_unit,@$unit_type,@$nic_code,@$status);
					$totalRejected = InprincipleController::getCafStatusCount($val['district_id'], 'districtRejected',@$start,@$end,@$fy,@$applicationNumber,@$nature_unit,@$unit_type,@$nic_code,@$status);
					$totalForwardedDept = InprincipleController::getCafStatusCount($val['district_id'], 'districtForwarded',@$start,@$end,@$fy,@$applicationNumber,@$nature_unit,@$unit_type,@$nic_code,@$status);
					$totalMaleEmp = InprincipleController::getCafStatusCount($val['district_id'],'districtMaleEmployment',@$start,@$end,@$fy,@$applicationNumber,@$nature_unit,@$unit_type,@$nic_code,@$status);
					$totalFemaleEmp = InprincipleController::getCafStatusCount($val['district_id'],'districtFemaleEmployment',@$start,@$end,@$fy,@$applicationNumber,@$nature_unit,@$unit_type,@$nic_code,@$status);
					$totalInvestment = InprincipleController::getCafStatusCount($val['district_id'],'districtInvestment',@$start,@$end,@$fy,@$applicationNumber,@$nature_unit,@$unit_type,@$nic_code,@$status);
					$totalDistrictManufacturing = InprincipleController::getCafStatusCount($val['district_id'],'districtProposedManufacturing',@$start,@$end,@$fy,@$applicationNumber,@$nature_unit,@$unit_type,@$nic_code,@$status);
                    $totalDistrictService = InprincipleController::getCafStatusCount($val['district_id'],'districtProposedService',@$start,@$end,@$fy,@$applicationNumber,@$nature_unit,@$unit_type,@$nic_code,@$status);	
					
					$totalProposedDistrictMaleEmployment = InprincipleController::getCafStatusCount($val['district_id'],'districtProposedMaleEmployment',@$start,@$end,@$fy,@$applicationNumber,@$nature_unit,@$unit_type,@$nic_code,@$status);					
                    $totalProposedDistrictFemaleEmployment = InprincipleController::getCafStatusCount($val['district_id'],'districtProposedFemaleEmployment',@$start,@$end,@$fy,@$applicationNumber,@$nature_unit,@$unit_type,@$nic_code,@$status);
					
					$totalProposedDistrictInvestment = InprincipleController::getCafStatusCount($val['district_id'],'districtProposedInvestment',@$start,@$end,@$fy,@$applicationNumber,@$nature_unit,@$unit_type,@$nic_code,@$status);
					
					$count1 += $totalCAFrecived; 
					$count2 += $totalDICPending;
					$count3 += $totalIncomplete;
					$count4 += $totalReverted;
					$count5 += $totalForwarded;
					$count6 += $totalApproved;
					$count7 += $totalRejected;
					$count8 += $totalForwardedDept;
					$count9 += $totalArchived;
					$countmalefemalecount += $totalMaleEmp + $totalFemaleEmp;
					$count11 += $totalInvestment;
					$countManufacturing +=$totalDistrictManufacturing;
                    $countService +=$totalDistrictService;
					$count13 +=$totalProposedDistrictMaleEmployment+$totalProposedDistrictFemaleEmployment;
					$count14 +=$totalProposedDistrictInvestment;
					
					
					if($totalCAFrecived > 0){
			?>
				<tr>
					<td><?php echo $tot++;?></td>
					<td><?php echo $val['distric_name']; ?></td>
					<td style="text-align:center;"><?php echo $totalCAFrecived;?></td>
					<td style="text-align:center;" class="manufacturing_caf"><?php echo $totalDistrictManufacturing; ?></td>
                    <td style="text-align:center;" class="service_caf"><?php echo $totalDistrictService; ?></td>
					<td style="text-align:center;" class="pending_caf"><?php echo $totalDICPending + $totalDIC48Pending; ?></td>
					<td style="text-align:center;" class="reverted_caf"><?php echo $totalReverted; ?></td>
					<td style="text-align:center;" class="forward_caf"><?php echo $totalForwarded; ?></td>
					<td style="text-align:center;" class="pending_caf"><?php echo $totalForwardedDept; ?></td>
					<td style="text-align:center;" class="approved_caf"><?php echo $totalApproved; ?></td>
					<td style="text-align:center;" class="rejected_caf"><?php echo $totalRejected; ?></td>
					<td style="text-align:center;" class="incomplete_caf"><?php echo $totalIncomplete; ?></td>
					<td style="text-align:center;" class="archived_caf"><?php echo $totalArchived; ?></td>
					<td style="text-align:center;"><?php echo $totalProposedDistrictMaleEmployment+$totalProposedDistrictFemaleEmployment; ?></td>
					<td style="text-align:center;overflow: hidden;" class="approved_caf"> 
					<?php
						$c10 += $totalMaleEmp + $totalFemaleEmp;
                        echo $totalMaleEmp + $totalFemaleEmp; 
					?>
					</td>
					<td style="text-align:center;"> <?php echo $totalProposedDistrictInvestment; ?></td>
					<td style="text-align:center;" class="approved_caf"> <?php echo $totalInvestment; ?></td>
				</tr>
			<?php }
				}
			}
			?>	
			</tbody>	
		</table>		
	</div>
</div>	

<div class='portlet box green'>
  <div class='portlet-title'>
    <div class='caption'>
      <i style=" font-size:20px;" class='fa fa-list'></i>
	  <?php $totalRec =0; echo "Total Applied CAF:" ?><span id="totalRec"></span>   
    </div>
    <div class='tools'>	
    </div>
    <div class="dto-buttons" style="margin:3px 5px 0 0;float: right; ">
    </div>	
  </div>
  <div class="portlet-body">
    <div class="site-min-height">
      <div class="form form-horizontal" role="form">
      </div>
    </div>
    <table class="table table-striped table-bordered table-hover" id="sample_2">
		<thead>
			<tr>
				<th style='vertical-align: middle;text-align: center;'>S.No.</th>
				<th style='vertical-align: middle;text-align: center;'>District</th>
				<th style='vertical-align: middle;text-align: center;'>Nature Of Unit</th>
				<th style='vertical-align: middle;text-align: center;'>CAF Submitted
				<br> By & On 
				</th>
				<th style='vertical-align: middle;text-align: center;'>Investment<br/>(In Cr.)</th>
				<th style='vertical-align: middle;text-align: center;'>NIC Codes</th>
				<th style='vertical-align: middle;text-align: center;'>Overall<br>Status</th>
				<th style='vertical-align: middle;text-align: center;'>Investor<br> Details</th>
				<th style='vertical-align: middle;text-align: center;'>Track</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$count=1;
		$grandTotalInvest = 0;
		$industry_type = '';
$all=array();
		if(isset($applicationData) && !empty($applicationData)) {
				
			foreach ($applicationData as $key => $dept) {
				
				$nature = InprincipleController::getValueByJsonField($dept['submission_id'],'ntrofunit');
				$natureofType = InprincipleController::getValueByJsonField($dept['submission_id'],'ntrofunittype');
				$company_name = InprincipleController::getValueByJsonField($dept['submission_id'],'company_name');
				$industry_type = InprincipleController::getValueByJsonField($dept['submission_id'],'industry_type');
				$nodalTime = InprincipleController::GetTimeTakenInCAF($dept['submission_id']);
				$auth_name = InprincipleController::getValueByJsonField($dept['submission_id'],'auth_name');
				$auth_designation = InprincipleController::getValueByJsonField($dept['submission_id'],'auth_designation');
				$auth_email = InprincipleController::getValueByJsonField($dept['submission_id'],'auth_email');
				$auth_mob = InprincipleController::getValueByJsonField($dept['submission_id'],'auth_mob');
				
				$flag =1;
				if(isset($_POST['nature_unit']) && !empty($_POST['nature_unit']) && $_POST['nature_unit'][0]!='All'){
					$flag =0;
					if(in_array($nature,@$_POST['nature_unit']))
					{
						 $flag =1;
					}
				}
				
				$flag2 =1;
				if(isset($_POST['unit_type']) && !empty($_POST['unit_type']) && $_POST['unit_type'][0]!='All'){
					$flag2 =0;
					if(in_array($natureofType,@$_POST['unit_type']))
					{
						 $flag2 =1;
					}
				}
                                
				if(isset($_GET['unit_type'])){
					$flag2 =0;
					if(in_array($natureofType,$_POST['unit_type']))
					{
						$flag2 =1;
					}
				}
				
				$flag3 =1;
				if(isset($_POST['unitName']) && !empty($_POST['unitName'])){
					$flag3 =0;
					if(strcmp($company_name, $_POST['unitName']) == 0)
					{
						 $flag3 =1;						
					}
				}
				
				$flag4 =1;
				if(isset($_POST['nic_code']) && !empty($_POST['nic_code']) && $_POST['nic_code'][0]!='All'){
				   $flag4 =0;
					foreach($_POST['nic_code'] as $val)
					{
						if(!empty($industry_type))
						{
							if($val==substr($industry_type,0,2))
							{
								 $flag4 =1;
							}
						}	
					}
				}  
				
				$flag5 =1;
				if(isset($_POST['timeline']) && !empty($_POST['timeline']) && $_POST['timeline']!='All'){
					$flag5 =0;
					if(!empty($nodalTime))
					{		
						if($_POST['timeline']=='less_15')
						{
							if($nodalTime < 15)
							{
								$flag5 =1;
							}
						}
						if($_POST['timeline']=='more_15')
						{						
							if($nodalTime > 15)
							{
								$flag5 =1;
							}
						}	
					}	
				}			
				
			$cafindname = ApplicationExt::getIndustryNamefromCAF($dept['submission_id']);
			$url1 = Yii::app()->createAbsoluteUrl('admin/ApplicationView/downloadapp/id');
			$urlNew =Yii::app()->createAbsoluteUrl('mis/ProdTestDev/CafTrackingTimelineEmail/application/');
			$subID = $dept['submission_id'];
			if($flag==1 && $flag2==1 && $flag3==1 && $flag4==1 && $flag5 ==1){
				$totalRec = $totalRec + 1;
				$invstmnt_in_total = InprincipleController::getValueByJsonField($dept['submission_id'],'invstmnt_in_total');
				$grandTotalInvest = $grandTotalInvest + $invstmnt_in_total[0];
			?>
			<tr>
			<td style="vertical-align: middle; text-align: center;"> 
				<?php echo $count; ?>
			</td>
			<td style="vertical-align: middle; text-align: center;" width="1%">
				<?php
					if(!empty($dept['landrigion_id'])) {
						$sql = "SELECT distric_name from bo_district where district_id=$dept[landrigion_id]";
						$connection = Yii::app()->db;
						$command = $connection->createCommand($sql);
						$dname = $command->queryRow();
						echo $dname['distric_name'];
					}
				?>
			</td>
			<td><?php echo $nature; ?></br></br><?php if(!empty($natureofType)) { echo "(Unit Type:". ucWords($natureofType).")"; } ?></td>
			<td style="vertical-align: middle; text-align: left;" width="18%">
				<?php echo $cafindname ?>
				<hr style="margin:2px;">
				CAF ID:  
				<!--<a target='_balnk' class='hyplink' href=
				   <?php //echo $url1 . '/' . $dept['submission_id'] . '/name/CAF' ?>>-->
				<a target="_blank" class='hyplink' href="<?php echo $urlNew.'/'. base64_encode($dept['submission_id']); ?>">   
				<?php echo $dept['submission_id'] ?> 
				</a>
				<hr style="margin:2px;">
				<?php
					$sql = "SELECT * FROM bo_application_flow_logs where submission_id=$dept[submission_id] AND application_status='ISA'";
					$connection = Yii::app()->db;
					$command = $connection->createCommand($sql);
					$flowLogs = $command->queryRow();
					if (!empty($flowLogs)) {
						echo date('d M y H:i:s', strtotime($flowLogs['created_date_time']));
					} else {
						$sql = "SELECT * FROM bo_application_flow_logs where submission_id=$dept[submission_id] AND application_status='F' ORDER BY created_date_time ASC ";
						$connection = Yii::app()->db;
						$command = $connection->createCommand($sql);
						$flowLogs = $command->queryRow();
						if (!empty($flowLogs))
							echo date('d M y H:i:s', strtotime($flowLogs['created_date_time']));
						}
					?>
				</td>
				<td style="text-align:center;"><?php $price = number_format((float)$invstmnt_in_total[0],2); echo '~'.$price;?> </td>
				<td style="vertical-align: middle; text-align: center;"> 
					<?php $code = substr($industry_type,0,2);
					$name = InprincipleController::getNicCodeNameBy2DigitCode($code);
					echo $code."-".$name;
					?>
				</td>
				<?php
				$lastFinalAction = date('d M y H:i:s', strtotime($dept['application_updated_date_time']));
				echo
				$appstatus = "";
				if (!empty($dept['application_status'])) {
					$apps = $dept['application_status'];
				}
				 
				if (!empty($pendingAtNodal)) {
					$apps = "P"; // Pending at Nodal
				}
				/*
				if (!empty($pendingAtApprover)) {
				$apps = "PAA"; // Pending at Approver
				} */
				
				/* if(isset($dept['landrigion_id']) && !empty($dept['landrigion_id']))
				{
					if(isset($all[$dept['landrigion_id']]))
						$all[$dept['landrigion_id']]=array();
					
					if(isset($all[$dept['landrigion_id']]['TA']))
						$all[$dept['landrigion_id']]['TA']=0;
					
					if(isset($all[$dept['landrigion_id']]['TV']))
						$all[$dept['landrigion_id']]['TV']=0;
					
					if($nodalTime < 15){
						$all[$dept['landrigion_id']]['TA'] = @$all[$dept['landrigion_id']]['TA']+1;
					}
					else{
						$all[$dept['landrigion_id']]['TV'] = @$all[$dept['landrigion_id']]['TV']+1;
					} 
				} */					
				switch ($apps) {
					case "A":
					echo "<td style='vertical-align: middle;text-align: center;'> <span>  Approved <hr style='margin:2px;'>$lastFinalAction ". "<br/><b>Time Taken By Nodal Officer:</b> ".$nodalTime.' Days'."</span></td>";
					break;
					case "B":
					echo "<td style='vertical-align: middle;text-align: center;'> <span>  Payment ". "<br/><b>Time Taken By Nodal Officer:</b> ".$nodalTime.' Days'."</span></td>";
					break;
					case "P":
					echo "<td style='vertical-align: middle;text-align: center;'> <span> Pending with <br>Nodal Officer </br>(DoI) ". "<br/><b>Time Taken By Nodal Officer:</b> ".$nodalTime.' Days'."</span></td>";
					break;
					case "F":
					echo "<td style='vertical-align: middle;text-align: center;'> <span>Forwarded<hr style='margin:2px;'> $lastFinalAction ". "<br/><b>Time Taken By Nodal Officer:</b> ".$nodalTime.' Days'."</span></td>";
					break;
					case "Z":
					echo "<td style='vertical-align: middle;text-align: center;'> <span>Archived ". "<br/><b>Time Taken By Nodal Officer:</b> ".$nodalTime.' Days'."</span></td>";
					break;
					case "DBD":
					echo "<td style='vertical-align: middle;text-align: center;'> <span> Disposed by<br>Department ". "<br/><b>Time Taken By Nodal Officer:</b> ".$nodalTime.' Days'."</span></td>";
					break;
					case "I":
					echo "<td style='vertical-align: middle;text-align: center;'> <span>  Incomplete  <hr style='margin:2px;'> $lastFinalAction ". "<br/><b>Time Taken By Nodal Officer:</b> ".$nodalTime.' Days'."</span></td>";
					break;
					case "H":
					echo "<td style='vertical-align: middle;text-align: center;'> <span>  Reverted Back to Investor <hr style='margin:2px;'> $lastFinalAction ". "<br/><b>Time Taken By Nodal Officer:</b> ".$nodalTime.' Days'."</span></td>";
					break;
					case "R":
					echo "<td style='vertical-align: middle;text-align: center;'> <span>  Rejected  <hr style='margin:2px;'> $lastFinalAction ". "<br/><b>Time Taken By Nodal Officer:</b> ".$nodalTime.' Days'."</span></td>";
					break;
					case "PAD":
					echo "<td style='vertical-align: middle;text-align: center;'> <span>Pending with <br>Department ". "<br/><b>Time Taken By Nodal Officer:</b> ".$nodalTime.' Days'."</span></td>";
					break;
					case "PAA":
					echo "<td style='vertical-align: middle;text-align: center;'> <span>Pending with Approver(DoI)  <hr style='margin:2px;'> $lastFinalAction ". "<br/><b>Time Taken By Nodal Officer:</b> ".$nodalTime.' Days'."</span></td>";
					break;
					default:
					echo "<td style='vertical-align: middle;text-align: center;'> <span>  Status Not <br>Available". "<br/><b>Time Taken By Nodal Officer:</b> ".$nodalTime.' Days'."</span></td>";
				}
				?>
				<td style="width:5%">
					<?php echo $auth_name; ?>
					<br/>
					Designation: <?php echo $auth_designation; ?>
					<br/>
					Email: <?php echo $auth_email; ?>
					<br/>
					Mobile No.: <?php echo $auth_mob; ?>
				</td>
				<td style="vertical-align: middle; text-align: center;">
				  <a target='_BLANK' href="<?= Yii::app()->createAbsoluteUrl('mis/ProdTestDev/CafTrackingTimelineEmail/application/' . base64_encode($dept['submission_id'])) ?>" class='btn dark btn-sm btn-outline sbold uppercase'>
					<i class='fa fa-share'>	</i> View 
				  </a>
				</td>
								
			</tr>
		<?php
		$count++;
			}
		}
		?>
		<tr>
			<td style="visibility:hidden;"><?php echo $count; ?></td>
			<td></td>
			<td></td>			
			<td style="text-align:right;">GrandTotal</td>
			<td style="text-align:center;"><b><?php echo "~".number_format((float)$grandTotalInvest,2); ?></b></td>
			<td></td>
			<td></td>
			<td></td>			
			<td></td>
		</tr>
		<?php
		}else {
			echo "No Record(s) Found.";
		}
		?>
		</tbody>
	</table>
	</div>
</div>
<?php
//print_r($all);
$base = Yii::app()->theme->baseUrl;
?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?= $base ?>/assets/global/scripts/datatable.js" type="text/javascript">
</script>
<script src="<?= $base ?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript">
</script>
<script src="<?= $base ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript">
</script>
<script src="<?= $base ?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript">
</script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?= $base ?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?= $base ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
</script>
<script src="https://www.jqueryscript.net/demo/Configurable-Date-Picker-Plugin-For-Bootstrap/dist/js/bootstrap-datepicker.js">
</script>
<script type="text/javascript">
	$('.demo-3').datepicker({
		//format:'mm-dd-yyyy', 
		format:'yyyy-mm-dd', 
		keepEmptyValues: true
	});
</script>
<script type="text/javascript">
	function clearForm(oForm) {    
		var elements = oForm.elements;
		$(".select2-me").select2("val","");
		$("#textbox_app_number").attr("value","");
		$("#textbox_unit_name").attr("value","");	
		for(i=0; i<elements.length; i++) {	  
			field_type = elements[i].type.toLowerCase();			
			switch(field_type) {				
				case "text": 
					elements[i].value = ""; 
					break;
				case "password": 
				case "textarea":
					elements[i].value = ""; 
					break;
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
		//Onclick Form submit
		// Show hide Date Range / FY
		$(".date_range").on('click', function () {
			var id_val = $(this).val();		
			if (id_val == "date")
			{
				$("#dept").show();
				$("#fy_year").hide();
				$(".fy_y").select2("val","");	
			} else {
				$("#fy_year").show();
				$("#dept").hide();
				$('input[name=start]').val("");
				$('input[name=end]').val("");
			}
		});
		// Show nic code on change Department
		$("#nature_unit").on('change', function () {
			var selectedValues = [];
			$("#nature_unit option:selected").each(function () {
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
				url: '/backoffice/admin/inprinciple/GetNicCodesByUnit',
				data: 'unit=' + encodeURIComponent(selectedValues),
				dataType: 'html'
			})
			.done(function (data) {
				$("#nic_code").html(data);
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
          }
          ,
          emptyTable: "No data available in table",
          info: "Showing _START_ to _END_ of _TOTAL_ entries",
          infoEmpty: "No entries found",
          infoFiltered: "(filtered1 from _MAX_ total entries)",
          lengthMenu: "_MENU_ entries",
          search: "Search:",
          zeroRecords: "No matching records found"
        }
        ,
        buttons: [{
			  extend: "print",
			  className: "btn white btn-outline"
			}
		  ,{
			extend: "pdf",
			className: "btn white btn-outline"
		   }
		  ,{
			extend: "excel",
			className: "btn white btn-outline "
		  }],       
        order: [
          [0, "asc"]
        ],
        lengthMenu: [
          [5, 10, 15, 20, -1],
          [5, 10, 15, 20, "All"]
        ],
        pageLength: -1,
        dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
      });
	  $("#sample_1_tools > li > a.tool-action").on("click", function () {
		var e = $(this).attr("data-action");
		t.DataTable().button(e).trigger()
	  })
    }
	,t = function () {
          var e = $("#sample_2");
          e.dataTable({
            language: {
              aria: {
                sortAscending: ": activate to sort column ascending",
                sortDescending: ": activate to sort column descending"
              }
              ,
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
            }
			,{
				extend: "pdf",
				className: "btn white btn-outline"
			  }
			  , {
				extend: "excel",
				className: "btn white btn-outline"
			  }
			],
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
        }
		,
        a = function () {
          var e = $("#sample_3"),
              t = e.dataTable({
                language: {
                  aria: {
                    sortAscending: ": activate to sort column ascending",
                    sortDescending: ": activate to sort column descending"
                  }
                  ,
                  emptyTable: "No data available in table",
                  info: "Showing _START_ to _END_ of _TOTAL_ entries",
                  infoEmpty: "No entries found",
                  infoFiltered: "(filtered1 from _MAX_ total entries)",
                  lengthMenu: "_MENU_ entries",
                  search: "Search:",
                  zeroRecords: "No matching records found"
                }
                ,
                buttons: [{
                  extend: "print",
                  className: "btn dark btn-outline"
                }
                , {
                            extend: "copy",
                            className: "btn red btn-outline"
                          }
                          , {
                            extend: "pdf",
                            className: "btn green btn-outline"
                          }
                          , {
                            extend: "excel",
                            className: "btn yellow btn-outline "
                          }
                          , {
                            extend: "csv",
                            className: "btn purple btn-outline "
                          }
                          , {
                            extend: "colvis",
                            className: "btn dark btn-outline",
                            text: "Columns"
                          }
                         ],
                responsive: !0,
                order: [
                  [0, "asc"]
                ],
                lengthMenu: [
                  [5, 10, 15, 20, -1],
                  [5, 10, 15, 20, "All"]
                ],
                pageLength: 10
              });
          $("#sample_3_tools > li > a.tool-action").on("click", function () {
            var e = $(this).attr("data-action");
            t.DataTable().button(e).trigger()
          })
        }
		,
        n = function () {
         /*  $(".date-picker").datepicker({
            rtl: App.isRTL(),
            autoclose: !0
          }); */
          var e = new Datatable;
          e.init({
            src: $("#datatable_ajax"),
            onSuccess: function (e, t) {
            }
            ,
            onError: function (e) {
            }
            ,
            onDataLoad: function (e) {
            }
            ,
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
              }
              ,
              order: [
                [1, "asc"]
              ],
              buttons: [{
                extend: "print",
                className: "btn default"
              }
				, {
				  extend: "copy",
				  className: "btn default"
				}
				, {
				  extend: "pdf",
				  className: "btn default"
				}
				, {
				  extend: "excel",
				  className: "btn default"
				}
				, {
				  extend: "csv",
				  className: "btn default"
				}
				, {
				  text: "Reload",
				  className: "btn default",
				  action: function (e, t, a, n) {
					t.ajax.reload(), alert("Datatable reloaded!")
				  }
				}
			   ]
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
            }
) : 0 === e.getSelectedRowsCount() && App.alert({
              type: "danger",
              icon: "warning",
              message: "No record selected",
              container: e.getTableWrapper(),
              place: "prepend"
            })
          }), $("#datatable_ajax_tools > li > a.tool-action").on("click", function () {
            var t = $(this).attr("data-action");
            e.getDataTable().button(t).trigger()
          }
                                                                                              )
        };
    return {
      init: function () {
        jQuery().dataTable && (e(), t(), a(), n())
      }
    }
  }
  ();
  jQuery(document).ready(function () {
    TableDatatablesButtons.init()
  });
  $(window).load(function () {
    $("#filterDiv").css('display', 'block');
    $("#loaderDiv").css('display', 'none');
	$("input[name='start']").removeClass("input-lg");
	$("input[name='end']").removeClass("input-lg");
	$("input[name='start']").addClass("rangewidth");
	$("input[name='end']").addClass("rangewidth");
	$(".input-group-addon").removeClass("input-lg");
	$("#totalRec").html(<?php echo $totalRec;?>);
  });
</script>
