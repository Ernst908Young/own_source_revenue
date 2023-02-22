<?php  
extract($_POST);

/* Rahul Kumar : 13072018 */
$base = Yii::app()->theme->baseUrl;
$baseUrl = Yii::app()->theme->baseUrl;
// Making Status Array
$statusArray = array('A' => 'Approved', 'P' => 'Pending', 'F' => 'Forwarded', 'I' => 'Incomplete', 'RBI' => 'Reverted', 'R' => 'Rejected', 'O' => 'Rejected');
$selected_district = explode(",", $districtListStr); 
$selected_nature_unit = explode(",", $natureUnitList); 
$selected_nicCodeList = explode(",", $nicCodeList);
?>
<style>
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
</style>
<link rel="stylesheet" href="https://www.jqueryscript.net/demo/Configurable-Date-Picker-Plugin-For-Bootstrap/dist/css/bootstrap-datepicker3.css">
<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/css/plugins/select2/select2.css">
<!-- select2 -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/plugins/select2/select2.min.js">
</script>
<!-- Theme framework -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/eakroko.min.js">
</script>
<div class='portlet box ' id="loaderDiv">    
  <div class="portlet-body" >
    Filters are getting enabled
    <img width = "100px" height="100px" src = "/backoffice/themes/swcsNewTheme/img/straight-loader.gif">
  </div>
</div>
<div class='portlet box ' id="filterDiv">    
  <div class="portlet-body" >
    <form method="POST" id="filterForm" name="filterForm">
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-6">
            <!--<label class="col-md-3 control-label">Select Date Range</label>-->
            <div class="mt-radio-inline">
              <label class="mt-radio">
                <input type="radio" name="optionsRadios" id="optionsRadios25" value="date" checked="checked" class="date_range"> Date Range
                <span></span>
              </label>
              <label class="mt-radio">
                <input type="radio" name="optionsRadios" id="optionsRadios26" value="fy"  class="date_range"> Financial Year
                <span></span>
              </label>							
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="col-md-6">
            <span id="dept">
              <label>Select Date Range
              </label>                  
              <div class="input-daterange input-group demo-3" id="datepicker">
                <input type="text" class="input-lg form-control" name="start" autocomplete="off" value="<?php echo @$start; ?>" />
                <span class="input-group-addon input-lg">to
                </span>
                <input type="text" class="input-lg form-control" name="end" autocomplete="off" value="<?php echo @$end; ?>"/>
              </div>
            </span>
            <span id="fy_year" style="display:none;">
              <label>Select Financial Year</label>
              <?php
                $m = date('m');
                $yyy = date('Y');
                if ($m > 3) {
                $yyy = $yyy - 1;
                }
                $pp = '2015';
                ?>
              <select name="fy" class="select2-me">
                <option value="" 
                        <?php
                if (isset($fy) && $fy == "ALL") {
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
            <?php }
            ?>           
            </select>
          </span>
      </div>
		  <div class="col-md-6">
			<label>Select District</label>
			<select name="district[]" class="select2-me"  multiple="multiple"  id="district">
			  <option value="">All District</option>
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
          <option value="">ALL</option>
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
      <?php //print_r($allList);die;   ?>
      <div class="col-md-6">
        <label>Nic Codes</label>
        <select class="select2-me" multiple="multiple" name="nic_code[]" id="nic_code">
          <option value="">ALL</option>
			<?php
			$sql = "select II_DIGIT_Code,SUBSTRING(Description,1,100) as Description from NIC_II_DIGIT";
			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql);
			$allNicList=$command->queryAll();
			//$allNicList = Yii::app()->db->createCommand($sql)->queryAll();
			?>
			  <?php foreach($allNicList as $k => $v) { ?>
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
			<select class="select2-me" name="unit_type" id="unit_type"> 
			<option value="">ALL</option>
			<option value="micro" <?php if (isset($unit_type) && $unit_type == 'micro') {echo "selected"; } ?>>Micro</option>                           
			<option value="medium" <?php if (isset($unit_type) && $unit_type == 'medium') {echo "selected"; } ?>>Medium</option>                           
			<option value="small" <?php if (isset($unit_type) && $unit_type == 'small') {echo "selected"; } ?>>Small</option>                           
			<option value="large" <?php if (isset($unit_type) && $unit_type == 'large') {echo "selected"; } ?>>Large</option>                           
			</select>
		</div>
		<div class="col-md-6">
			<label>Select Timeline</label>
			<select class="select2-me" name="timeline" id="timeline">    
				<option value="">All</option>
				<option value="less_15" <?php if(isset($timeline) && $timeline == 'less_15') {echo "selected"; } ?>>Less Then 15 Days
				</option>
				<option value="more_15" <?php if(isset($timeline) && $timeline == 'more_15') {echo "selected";} ?>>More Then 15 Days
				</option>   
			</select>
		</div>
	</div>
	<div class="col-md-12" style="margin-top:15px;">
		<div class="col-md-6">
			<label>Status</label>
			<select class="select2-me" name="status" id="status">    
				<option value="" >All</option>
				<option value="A" <?php if (isset($status) && $status == 'A') {echo "selected"; } ?>>Approved
				</option>
				<!--<option value="B" <?php //if (isset($status) && $status == 'B') {echo "selected";} ?>>Payment
				</option>-->
				<option value="F" <?php if (isset($status) && $status == 'F') {echo "selected";} ?>>Forwarded
				</option> 
				<option value="H" <?php if (isset($status) && $status == 'H') {echo "selected";} ?>>Reverted
				</option> 
				<option value="I" <?php if (isset($status) && $status == 'I') {echo "selected";} ?>>Incomplete
				</option> 
				<option value="P" <?php if (isset($status) && $status == 'P') {echo "selected";} ?>>Pending
				</option> 
				<option value="R" <?php if (isset($status) && $status == 'R') {echo "selected";} ?>>Rejected
				</option> 
				<option value="Z" <?php if (isset($status) && $status == 'Z') {echo "selected";} ?>>Archived
				</option> 				
			</select>
		</div>
		<div class="col-md-6">
			<label>Application Number</label>
			<input class="form-control" placeholder="Application Number" name="applicationNumber" 
				   <?php if (!empty($applicationNumber)) { ?> value="
			<?php echo $applicationNumber; ?>" 
			<?php } ?>>
		</div>
	</div>
	<div class="col-md-12" style="margin-top:15px;">	  
	  <div class="col-md-6">
		<label>Unit Name</label>
		<input class="form-control" placeholder="Unit Name" name="unitName" id="unitName"
			   <?php if (!empty($unitName)) { ?> value="<?php echo $unitName; ?>" <?php } ?>>
	  </div>
	</div>
	</div>
<div class="row">
  <div class="col-md-12" style="text-align:center;margin-top:15px;">
    <input type="submit" value="Generate Report" name="submit" class="btn btn-success" >
    <input type="button" value="Reset" id="reset" class="btn btn-primary" onclick="clearForm(this.form);">
  </div>
</div>
</form>
</div>
</div>
<div class='portlet box green'>
  <div class='portlet-title'>
    <div class='caption'>
      <i style=" font-size:20px;" class='fa fa-list'></i>All Applied CAF by Investor  <?php //> Total Applied CAF : echo count($applicationData);  ?>   
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
          <th style='vertical-align: middle;text-align: center;'>SNo</th>
          <th style='vertical-align: middle;text-align: center;'>District</th>
          <th style='vertical-align: middle;text-align: center;'>Nature Of Unit</th>
		  <th style='vertical-align: middle;text-align: center;'>Unit Type</th>
          <th style='vertical-align: middle;text-align: center;'>CAF Submitted
            <br> By & On 
          </th>
		  <th style='vertical-align: middle;text-align: center;'>Investment (In Cr.)</th>
		  <th style='vertical-align: middle;text-align: center;'>NIC Codes</th>
		  <th style='vertical-align: middle;text-align: center;'>Timeline</th>
          <th style='vertical-align: middle;text-align: center;'>Overall<br> Status</th>
          <th style='vertical-align: middle;text-align: center;'>Track</th>
        </tr>
      </thead>
      <tbody>
        <?php $count=1;
			$grandTotalInvest = 0;
			$industry_type = '';
			if (isset($applicationData) && !empty($applicationData)) {
				
			foreach ($applicationData as $key => $dept) {
				
				$nature = Inprinciple2Controller::getValueByJsonField($dept['submission_id'],'ntrofunit');
				$natureofType = Inprinciple2Controller::getValueByJsonField($dept['submission_id'],'ntrofunittype');
				$company_name = Inprinciple2Controller::getValueByJsonField($dept['submission_id'],'company_name');
				$industry_type = Inprinciple2Controller::getValueByJsonField($dept['submission_id'],'industry_type');
				$nodalTime = Inprinciple2Controller::GetTimeTakenInCAF($dept['submission_id']);
				
				$flag =1;
				if(isset($_POST['nature_unit']) && !empty($_POST['nature_unit'])){
                    $flag =0;
					if(in_array($nature,@$_POST['nature_unit']))
					{
						 $flag =1;
					}
				}
				
				$flag2 =1;
				if(isset($_POST['unit_type']) && !empty($_POST['unit_type'])){
                    $flag2 =0;
					if($natureofType==$_POST['unit_type'])
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
				if(isset($_POST['nic_code']) && !empty($_POST['nic_code'])){
                   $flag4 =0;
					foreach($_POST['nic_code'] as $val)
					{	
						if($val==substr($industry_type,0,2))
						{
							 $flag4 =1;
						}	
					}
						
				}  
				
				$flag5 =1;
				if(isset($_POST['timeline']) && !empty($_POST['timeline'])){
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
				$subID = $dept['submission_id'];
                if($flag==1 && $flag2==1 && $flag3==1 && $flag4==1 && $flag5 ==1){
					$invstmnt_in_total = Inprinciple2Controller::getValueByJsonField($dept['submission_id'],'invstmnt_in_total');
					$grandTotalInvest = $grandTotalInvest + $invstmnt_in_total[0];
					
				?>
			<tr>
			  <td style="font-size: 13px; vertical-align: middle; text-align: center;"> 
				<?php echo $count; ?>
			  </td>
			  <td style="font-size: 13px; vertical-align: middle; text-align: center;" width="1%">
				<?php
					if (!empty($dept['landrigion_id'])) {
						$sql = "SELECT distric_name from bo_district where district_id=$dept[landrigion_id]";
						$connection = Yii::app()->db;
						$command = $connection->createCommand($sql);
						$dname = $command->queryRow();
						echo $dname['distric_name'];
					}
				?>
			</td>
			<td><?php echo $nature; ?></td>
			<td><?php echo ucWords($natureofType); ?></td>
			<td style="font-size: 13px; vertical-align: middle; text-align: left;" width="18%">
            <?php echo $cafindname ?>
            <hr style="margin:2px;">
            CAF ID:  
            <a target='_balnk' class='hyplink' href=
               <?php echo $url1 . '/' . $dept['submission_id'] . '/name/CAF' ?>>
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
			<td style="text-align:center;"><?php echo $invstmnt_in_total[0];?> </td>
			<td style="font-size: 13px; vertical-align: middle; text-align: center;"> 
				<?php $code = substr($industry_type,0,2);
				$name = Inprinciple2Controller::getNicCodeNameBy2DigitCode($code);
				echo $code."-".$name;
				?>
			</td>
			<td><?php echo $nodalTime.' Days'; ?></td>
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
			if (!empty($pendingAtApprover)) {
			$apps = "PAA"; // Pending at Approver
			}
			switch ($apps) {
			case "A":
			echo "<td style='vertical-align: middle;text-align: center;'> <span>  Approved <hr style='margin:2px;'>$lastFinalAction</span></td>";
			break;
			case "B":
			echo "<td style='vertical-align: middle;text-align: center;'> <span>  Payment</span></td>";
			break;
			case "P":
			echo "<td style='vertical-align: middle;text-align: center;'> <span> Pending with <br>Nodal Officer </br>(DoI) </span></td>";
			break;
			case "DBD":
			echo "<td style='vertical-align: middle;text-align: center;'> <span> Disposed by<br>Department</span></td>";
			break;
			case "I":
			echo "<td style='vertical-align: middle;text-align: center;'> <span>  Incomplete  <hr style='margin:2px;'> $lastFinalAction</span></td>";
			break;
			case "H":
			echo "<td style='vertical-align: middle;text-align: center;'> <span>  Reverted Back to Investor <hr style='margin:2px;'> $lastFinalAction</span></td>";
			break;
			case "R":
			echo "<td style='vertical-align: middle;text-align: center;'> <span>  Rejected  <hr style='margin:2px;'> $lastFinalAction</span></td>";
			break;
			case "PAD":
			echo "<td style='vertical-align: middle;text-align: center;'> <span>Pending with <br>Department</span></td>";
			break;
			case "PAA":
			echo "<td style='vertical-align: middle;text-align: center;'> <span>Pending with Approver(DoI)  <hr style='margin:2px;'> $lastFinalAction</span></td>";
			break;
			default:
			echo "<td style='vertical-align: middle;text-align: center;'> <span>  Status Not <br>Available</span></td>";
			}
			?>
			<td style="font-size: 13px; vertical-align: middle; text-align: center;">
			  <a target='_BLANK' href="<?= Yii::app()->createAbsoluteUrl('mis/ProdTestDev/CafTrackingTimelineEmail/application/' . base64_encode($dept['submission_id'])) ?>" class='btn dark btn-sm btn-outline sbold uppercase'>
				<i class='fa fa-share'>
				</i> View 
			  </a>
			</td>
		</tr>
    <?php
        $count++;
			}
		}
        ?>
		<tr><td colspan="5" style="text-align:right;"><b>Grand Total</b></td><td style="text-align:center;"><b><?php echo $grandTotalInvest; ?></b></td><td colspan="4"></td></tr>
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
<script>
  $('.demo-3').datepicker({format:'mm-dd-yyyy'});
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
      }
      else {
        $("#fy_year").show();
        $("#dept").hide();
      }
    });
    // Show nic code on change Department
    $("#unit").on('change', function () {
      $.ajax({
        type: 'POST',
        url: '/backoffice/admin/inprinciple2/GetNicCodesByUnit',
        data: 'unit=' + encodeURIComponent($(this).val()),
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
          className: "btn dark btn-outline"
        }, {
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
                     ],
            order: [
              [0, "asc"]
            ],
            lengthMenu: [
              [5, 10, 15, 20, -1],
              [5, 10, 15, 20, "All"]
            ],
            pageLength: '',
            dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
          }
                     )
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
                } , {
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
        },
        n = function () {
          $(".date-picker").datepicker({
            rtl: App.isRTL(),
            autoclose: !0
          } );
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
          }
                ), e.getTableWrapper().on("click", ".table-group-action-submit", function (t) {
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
            }
                                               )
          }
                                         ), $("#datatable_ajax_tools > li > a.tool-action").on("click", function () {
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
  });
  
</script>
