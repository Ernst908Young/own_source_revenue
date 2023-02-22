<style type="text/css">
#overlay {
    position: fixed;
	top:0%;
	left:0%;
	width:100%;
	height:100%;	
	background: black;
	opacity: .2;
}
#overlay_text{
	 width: 50px;
    height: 57px;
    position: absolute;
    top: 50%;
    left: 50%;
    margin: -28px 0 0 -25px;   
    font-size: 25px;
    opacity: 10;
}

</style>
<div id="overlay" style="display: none;">
	<div id="overlay_text" style="color: red;">
	<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
	<span class="sr-only">Loading...</span>
</div>
</div>
<?php

$ID = $_GET['service_id'];
if(isset($_SESSION['role_id'])) $role_id = $_SESSION['role_id'];
else $_SESSION['role_id']= 0;
$submittion_id = $_GET['subID'];
$formCodeID_ = $_GET['formCodeID'];
$pageID_ = $_GET['pageID'];
$form_name_ = '';
$applicationStatusFromSubmission = Yii::app()->db->createCommand("SELECT * FROM bo_new_application_submission where submission_id=$submittion_id")->queryRow();
//$allData = Yii::app()->db->createCommand("SELECT id,service_id,current_role_id,next_role_id FROM bo_infowiz_form_builder_configuration where service_id=$ID AND current_role_id=$role_id")->queryRow();

?>

<!-- <link href="/backoffice/themes/swcsNewTheme/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" /> -->
<?php  
/*	include($_SERVER["DOCUMENT_ROOT"].'/backoffice/themes/swcsNewTheme/views/layouts/subfromtabs.php'); */

	$get_form_name = InfowizardQuestionMasterExt::getFormNameFrmMap($ID,$formCodeID_);
	//echo "<pre/>"; print_r($get_form_name);
?>
<div class="dashboard-home">
<?php 
	$btn_name = "Start";
	$frm_styl = "display:none";
	$get_Subtd_app = InfowizardQuestionMasterExt::getBusinessApplicationLog($ID,$formCodeID_,$submittion_id);
	$btn_name = "Submitted";
	$btn_cls = "submitted"; 
	$invData = InfowizardQuestionMasterExt::getUserApplicationInfo($submittion_id); 
	$form_name_ = $get_form_name['form_name'];
        
       // $first_entry_of_application = Yii::app()->db->createCommand("select * from bo_infowiz_form_builder_investor_logs where submission_id = $submittion_id where application_status = 'P' order by application_created_date ASC Limit 1")->queryRow();
		
	$statusArray=array('A'=>'Approved','B'=>'Pending For Payment','PD'=>'Pending For Payment','H'=>'Reverted','I'=>'Incomplete','R'=>'Rejected','F'=>'Forwarded','Z'=>'Archived','P'=>'Pending','V'=>'Verified','PF'=>'Forwarded','FA'=>'Forwarded to Approver','DP'=>'Document Pending','AB'=>'Abeyance');?>
	 <div class="applied-status">
        <div class="status-title d-flex flex-wrap align-items-center justify-content-between">
            <h4><?php echo $get_form_name['form_name'];  ?></h4>
         </div>
        
       
          
    
	<div class="portlet box green">
		<div class="portlet-title">
			<div class="caption"></div>
			<div class="tools"> 
			<?php 
			$action = Yii::app()->db->createCommand("SELECT form_action_controller,form_service_js FROM   bo_infowiz_form_builder_configuration where service_id=$_GET[service_id]")->queryRow();
			?>
			<a href="/backoffice/infowizardtwo/<?php echo $action['form_action_controller'];?>/downloadNewApp/service_id/<?php echo $_GET['service_id'];?>/pageID/1/subID/<?php echo $submittion_id;?>/formCodeID/1" target="blank" class="btn btn-primary" style="height: 33px;">Print Application</a>
			</div>
		</div>
		<div class="portlet-body">
			<table class="table table-striped table-bordered table-hover">						
				<tr>
					<td class="a_cent"><strong style="color: #333;">Applicant Name:</strong> <?php echo $invData['first_name']." ".$invData['last_name']; ?></td>
					<td class="a_cent"><strong style="color: #333;">UID:</strong> <?php echo $invData['iuid']; ?></td>	
				</tr>
				<tr>
					<td class="a_cent"><strong  style='color: #333;'>Contact Number:&nbsp;&nbsp;</strong><?php echo  $invData['mobile_number']; ?></td>
					<td class="a_cent"><strong  style='color: #333;'>Email Id:&nbsp;&nbsp;</strong><?php echo  $invData['email']; ?></td>
				</tr>	
				<tr>
					<td class="a_cent"><strong  style='color: #333;'>Supporting Documents</strong>
						<?php 
						$sqlSuppDocu= Yii::app()->db->createCommand("SELECT support_document FROM bo_infowiz_formbuilder_application_forward_level where app_Sub_id=$submittion_id AND support_document!='' order by appr_lvl_id desc")->queryAll();
						//print_r($sqlSuppDocu);die;
						$i = 1;
						foreach($sqlSuppDocu as $ksd=>$vsd)
						{
						?>
							<ul>
								<li><a href="/themes/backend/supportive_documents/<?php echo @$vsd['support_document'];?>" target="_blank">Download Supporting Doc <?php echo $i++;?></a></li>
							</ul>				
						<?php 
						
						}
						?>
					</td>
				</tr>
			</table>
		<?php 
		$array_check = array();
		$get_logg = array();
		$dept_pend = array();
		$dept_pend1 = array();
		$get_inv_submit_log = InfowizardQuestionMasterExt::getInvestorSubmitLog($ID,$submittion_id);
		if($formCodeID_==1){
			$get_logg = $get_inv_submit_log;
		}		
		$get_logg = InfowizardQuestionMasterExt::getApplicationLog($ID,$formCodeID_,$submittion_id);
		$investTotalLog=count($get_logg);
			//echo count($get_logg);
		if (!empty($get_logg)) 
		{
			$dept_pend = array();
			if ($formCodeID_ != 1) {
				$allFormTypeId = Yii::app()->db->createCommand("Select form_type_id from bo_infowiz_form_builder_configuration where current_role_id='$_SESSION[role_id]' AND service_id='$_GET[service_id]'")->queryAll();
				foreach ($allFormTypeId as $k => $v) {
					$form_type_id[] = $v['form_type_id'];
				}
				$dept_pend = array();
				$dept_pend1 = array();
				$dept_pend_form_id = 0;
				if (isset($_SESSION['uid']) && in_array($_GET['formCodeID'], $form_type_id)) {
					$dept_pend = InfowizardQuestionMasterExt::getDepartmentPendencyg($ID, $formCodeID_, $submittion_id);
					if (isset($dept_pend) && !empty($dept_pend[0]['form_id'])) {
						$dept_pend_form_id = $dept_pend[0]['form_id'];
					}
				}
				$processAnyTimeArr = Yii::app()->db->createCommand("Select process_anytime,form_type_id from bo_infowiz_form_builder_configuration where current_role_id='$_SESSION[role_id]' AND form_type_id='$_GET[formCodeID]' AND service_id='$_GET[service_id]'")->queryRow();
				if ($dept_pend_form_id != $_GET['formCodeID'] && $processAnyTimeArr['process_anytime'] == 'Y') {
					$dept_pend1 = InfowizardQuestionMasterExt::getDepartmentPendencyOnOther($ID, $formCodeID_, $submittion_id);                        
				}
				$get_logg = array_merge($get_logg,$dept_pend,$dept_pend1);
			}				
			$keys = array_keys($get_logg);				
			$array_check = array_combine($keys, $get_logg);
			
        /* $get_inv_submit_log = InfowizardQuestionMasterExt::getInvestorSubmitLog($ID,$submittion_id);
		$get_logg = InfowizardQuestionMasterExt::getApplicationLog($ID,$formCodeID_,$submittion_id);
		$investTotalLog=count($get_logg);
		
		if(!empty($get_logg))
		{
			$dept_pend = array();
			if($formCodeID_!=1)
			{
				$allFormTypeId = Yii::app()->db->createCommand("Select form_type_id from bo_infowiz_form_builder_configuration where current_role_id='$_SESSION[role_id]' AND service_id='$_GET[service_id]'")->queryAll();
				foreach($allFormTypeId as $k=>$v)
				{
					$form_type_id[] = $v['form_type_id'];
				}
				$dept_pend=array();
				$dept_pend1=array();
				$dept_pend_form_id = 0;
				if(isset($_SESSION['uid']) && in_array($_GET['formCodeID'],$form_type_id))
				{               
					$dept_pend = InfowizardQuestionMasterExt::getDepartmentPendencyg($ID,$formCodeID_,$submittion_id); 
					if(isset($dept_pend) && !empty($dept_pend[0]['form_id']))
					{                                   
						$dept_pend_form_id = $dept_pend[0]['form_id'];
					}	
				}
				
				$processAnyTimeArr = Yii::app()->db->createCommand("Select process_anytime,form_type_id from bo_infowiz_form_builder_configuration where current_role_id='$_SESSION[role_id]' AND form_type_id='$_GET[formCodeID]' AND service_id='$_GET[service_id]'")->queryRow();
				
				if($dept_pend_form_id!=$_GET['formCodeID'] && $processAnyTimeArr['process_anytime']=='Y'){
					$dept_pend1 = InfowizardQuestionMasterExt::getDepartmentPendencyOnOther($ID,$formCodeID_,$submittion_id);
				}  
				
				$get_logg = array_merge($get_logg,$get_inv_submit_log,$dept_pend,$dept_pend1);
				$keys = array_keys($get_logg);
				array_multisort(array_column($get_logg, 'created'), SORT_ASC, SORT_STRING, $get_logg, $keys);
				$array_check = array_combine($keys, $get_logg);
			} */
			?>
			<hr style="color: #36c6d3;" />
			<table class="table table-striped table-bordered table-hover">
				<tr>
					<tbody>
					<th>S.No.</th>
					<th>Action Taken By</th>
					<th>Action Taken On</th>
					<th>Action Type</th>
					<th>Status</th>
					<th>Comments</th>
					<?php if(isset($_SESSION['uid'])){ ?>
					<!--<th>Time Taken By Applicant</th>
					<th>Time Taken By Department User</th>
					<th>Action</th>-->
					<?php } ?>
					</tbody>
				</tr>
			<?php 			
			$i=1; 	
			$flg=0;
			$viewCount = 1;                        
			$total_count = count($array_check);
			$arrayEnd = array_keys($array_check);
			$totalLog = end($arrayEnd);
			
			$invTime = 0;
			$tcount = 1;
			$nodTime=0;
			$dept_name = "";
            
			foreach($array_check as $key=>$vall)
			{                           
				$flg=0;
				if(isset($vall['appr_lvl_id']) && isset($vall['next_role_id']) && isset($vall['forwarded_dept_id']) && $_GET['formCodeID']==6 && $vall['next_role_id']==$_SESSION['role_id'] && $vall['forwarded_dept_id']!=$_SESSION['dept_id'])
				{
					$flg=1;
				}
				if($flg==0)
				{
    
                    if(($vall['form_id']==$_GET['formCodeID']  || $vall['action_status']=='PF') || $_GET['formCodeID'] == 5 )
					{	
						if(isset($vall['department_user_id']) && $vall['department_user_id'] > 0 && $_GET['formCodeID']!=1) 
						{ 
							$dept_name = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_issuerby_master',$vall['core_department_id'],'name','issuerby_id');
						}else{
							$dept_name = "";
						}	
				
						if((($vall['investor_log_id'] != NULL)  && $_GET['formCodeID'] == 5) || ($vall['investor_log_id'] == NULL || $_GET['formCodeID']==1) )
						{					
							$btn_name= $statusArray[$vall['action_status']];
							$btn_cls= $statusArray[$vall['action_status']].'_'.$vall['id'];
							
							$c=$tcount-1;
							$Time[$c]=$vall['created'];
							$timetaken="";
							if($tcount!=1){  
								$timeInString = abs(strtotime($Time[$c]) - strtotime($Time[$c-1]));
								if(!empty($vall['investor_log_id']) ){ $invTime=$invTime+$timeInString;}
								else{$nodTime=$timeInString;}
								$years = floor($invTime / (365 * 60 * 60 * 24));
								$months = floor(($invTime - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
								$days = floor(($invTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
								$hours = floor(($invTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
								$minuts = floor(($invTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
								$seconds = floor(($invTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
								$allDays = ($years*365)+($months * 30) + $days;  
								$timetaken= "$allDays days, $hours hrs, $minuts min";
								
								$nyears = floor($nodTime / (365 * 60 * 60 * 24));
								$nmonths = floor(($nodTime - $nyears * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
								$ndays = floor(($nodTime - $nyears * 365 * 60 * 60 * 24 - $nmonths * 30 * 60 * 60 * 24) / (60 * 60 * 24));
								$nhours = floor(($nodTime - $nyears * 365 * 60 * 60 * 24 - $nmonths * 30 * 60 * 60 * 24 - $ndays * 60 * 60 * 24) / (60 * 60));
								$nminuts = floor(($nodTime - $nyears * 365 * 60 * 60 * 24 - $nmonths * 30 * 60 * 60 * 24 - $ndays * 60 * 60 * 24 - $nhours * 60 * 60) / 60);
								$nseconds = floor(($nodTime - $nyears * 365 * 60 * 60 * 24 - $nmonths * 30 * 60 * 60 * 24 - $ndays * 60 * 60 * 24 - $nhours * 60 * 60 - $minuts * 60));
								$nallDays = ($nyears*365)+($nmonths * 30) + $ndays;  
								$ntimetaken= "$nallDays days, $nhours hrs, $nminuts min"; 
							}      
                    ?>				
						<tr>
							<td class="a_cent"><?php echo $i; ?></td>
							<td class="a_cent"><?php echo $vall['action_taken_by_name'];?></td>
							<td class="a_cent"><?php echo date("d-M-Y H:i:s",strtotime($vall['created']));?></td>
							<td class="a_cent"><?php echo $vall['action_message'];?></td>
							<td class="a_cent"><?php echo $btn_name;?></td>
							<td class="a_cent"><?php echo $vall['department_comment'];?></td>
							<!--<td class="a_cent" style="visibility: hidden;"><?php if(!empty($vall['investor_log_id'])) echo @$timetaken; ?></td>
							<td class="a_cent" style="visibility: hidden;"><?php if(empty($vall['investor_log_id']))echo @$ntimetaken; ?></td>-->
							<?php if(isset($_SESSION['uid'])){ ?>
							<td class="a_cent" style="display: none;">
								<?php 
								
								if(!empty($vall['investor_log_id']))
								{								
									
									if($viewCount == $investTotalLog){
								?>
								<button class="btn btn-success flt_rgt top_tab btn_view <?php echo $btn_cls; ?>" rel="<?php echo $btn_cls; ?>" rel1="<?php echo $ID; ?>" rel2="1" rel3="<?php echo $vall['app_Sub_id'];?>" rel4="<?php echo $vall['id'];?>" rel5="Investor" rel6="<?php echo @$vall['next_role_id'];?>" rel7="<?php echo @$vall['action_status'];?>" rel8="<?php echo @$vall['dept_log_id']; ?>" rel9="<?php echo @$vall['department_comment'];?>" rel10="<?php echo @$vall['action_taken_by_name'];?>" rel11="<?php echo @$vall['core_department_id'];?>" rel12="<?php echo @$vall['created'];?>" style="visibility: hidden;">View</button>
							<?php 
									}
									$viewCount++;
								}							
								else{
									if(empty($vall['department_comment'])){
							?>		
									<button class="btn btn-success flt_rgt top_tab btn_view <?php echo $btn_cls; ?>" rel="<?php echo $btn_cls; ?>" rel1="<?php echo $ID; ?>" rel2="<?php echo $_GET['formCodeID'];?>" rel3="<?php echo $vall['app_Sub_id'];?>" rel4="<?php echo @$vall['appr_lvl_id'];?>" rel5="Department" rel6="<?php echo @$vall['next_role_id'];?>" rel7="<?php echo $vall['action_status'];?>" rel8="<?php echo @$vall['dept_log_id']; ?>" rel9="<?php echo @$vall['department_comment'];?>" rel10="<?php echo @$vall['action_taken_by_name'];?>" rel11="<?php echo @$vall['core_department_id'];?>" rel12="<?php echo $vall['created'];?>" style="visibility: hidden;">View</button>
									<?php 
									}
								}	
							?>
							</td>
						<?php } ?>
						</tr>
					<?php 	
						$i++;
						$tcount++;
						} 
					}
				}                                 
			} 
			?>
			<?php
			if($_GET['formCodeID']==7 && isset($applicationStatusFromSubmission['application_status']) && $applicationStatusFromSubmission['application_status']=='FA')
			{
				$btn_name= $statusArray[$vall['action_status']];
				$btn_cls= $statusArray[$vall['action_status']].'_'.$vall['id'];
				if(isset($vall['department_user_id']) && $vall['department_user_id'] > 0 && $_GET['formCodeID']!=1) { 
					$dept_name = InfowizardQuestionMasterExt::getMasterName('bo_departments',$vall['core_department_id'],'department_name','dept_id');
				}else{
					$dept_name = "";
				}	
			?>
				<tr>
					<td class="a_cent"><?php echo $i; ?></td>
					<td class="a_cent"><?php echo $vall['action_taken_by_name'];?></td>
					<td class="a_cent"><?php echo @$dept_name;?></td>
					<td class="a_cent"><?php echo date("d-M-Y H:i:s",strtotime($vall['created']));?></td>
					<td class="a_cent"><?php echo $vall['action_message'];?></td>
					<td class="a_cent"><?php  echo $btn_name;?></td>
					<td class="a_cent"><?php echo $vall['department_comment'];?></td>
					<td class="a_cent"><?php echo "NA"; ?></td>
					<!--<td class="a_cent"><?php echo "NA"; ?></td>-->
					<?php if(isset($_SESSION['uid'])){ ?>
					<td class="a_cent">
						<?php 
						if(!empty($vall['investor_log_id']))
						{
						?>
						<button class="btn btn-success flt_rgt top_tab btn_view <?php echo $btn_cls; ?>" rel="<?php echo $btn_cls; ?>" rel1="<?php echo $ID; ?>" rel2="1" rel3="<?php echo $vall['app_Sub_id'];?>" rel4="<?php echo $vall['id'];?>" rel5="Investor" rel6="<?php echo @$vall['next_role_id'];?>" rel7="<?php echo @$vall['action_status'];?>" rel8="<?php echo @$vall['dept_log_id']; ?>" rel9="<?php echo @$vall['department_comment'];?>" rel10="<?php echo @$vall['action_taken_by_name'];?>" rel11="<?php echo @$vall['core_department_id'];?>" rel12="<?php echo @$vall['created'];?>" style="visibility: hidden;">View</button>
					<?php }
					
					else{?>
							<button class="btn btn-success flt_rgt top_tab btn_view <?php echo $btn_cls; ?>" rel="<?php echo $btn_cls; ?>" rel1="<?php echo $ID; ?>" rel2="<?php echo $_GET['formCodeID'];?>" rel3="<?php echo $vall['app_Sub_id'];?>" rel4="<?php echo @$vall['appr_lvl_id'];?>" rel5="Department" rel6="<?php echo @$vall['next_role_id'];?>" rel7="<?php echo $vall['action_status'];?>" rel8="<?php echo @$vall['dept_log_id']; ?>" rel9="<?php echo @$vall['department_comment'];?>" rel10="<?php echo @$vall['action_taken_by_name'];?>" rel11="<?php echo @$vall['core_department_id'];?>" rel12="<?php echo $vall['created'];?>" style="visibility: hidden;">View</button>
					<?php } ?>
					</td>
				<?php 
					} ?>
				</tr>
			<?php }?>
	 		</table>
			
			<form class="form form-horizontal" id="FB_form" role="form" method="POST" enctype= "multipart/form-data"
			action="<?php echo Yii::app()->createAbsoluteUrl("/infowizard/subFormNoticeofChangeofManagerForm6/processData"); ?>">
				<div id="frm" style="text-align:center;display:none;"><img src="<?= Yii::app()->theme->baseUrl ?>/img/ajax-loader.gif" /></div>
			</form>
	 	<?php 
		}
		?>			
	 	</div>
 	</div>	
</div>	
</div>
<!--- Dynamic from model-->
<div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document" style="width: 1000px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><strong><?php echo $form_name_;?></strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer" style="margin-top: 54px;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- datepicker js-->
<link href="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" /> 
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/js/typeahead.min.js" type="text/javascript"></script>
<!-- datepicker js -->

<!-- Date time picker js css-->
<link href="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/css/bootstrap_datetimepicker.css"  rel="stylesheet" type="text/css">
<link href="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/css/bootstrap-datetimepicker.min.css"  rel="stylesheet" type="text/css">
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/bootstrap-datetimepicker.min.js" charset="UTF-8"></script>
<!-- Date time picker js css-->

<!-- form repeater js -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/jquery-repeater/jquery.repeater.js" type="text/javascript">
</script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/pages/scripts/form-repeater.min.js" type="text/javascript">
</script>
<!-- form repeater js -->

<link rel="stylesheet" href="<?=Yii::app()->theme->baseUrl?>/assets/frontend/dashboard/css/plugins/select2/select2.css">
<!-- select2 -->
<script src="<?=Yii::app()->theme->baseUrl?>/assets/frontend/dashboard/js/plugins/select2/select2.min.js"></script>
<!-- Theme framework -->
<script src="<?=Yii::app()->theme->baseUrl?>/assets/frontend/dashboard/js/eakroko.min.js"></script>


<script>
    $(window).load(function() {
       $('.btn_view').click();
       $('.doc_app').focus();   
});
    $(document).ready(function () {
    
		$(".status_butt").on('click',function(){
			var butt_sttaus = $(this).attr('rel');
			$("#app_status").val(butt_sttaus);
			//alert(butt_sttaus);
			$("#FB_form").submit();			
		});
		
        $(".datepicker").datepicker({
            changeMonth: true,
            changeYear: true
        });
		
    	$("#show_ukfcl").on('click',function(){
			$(".ukfcl").toggle();		
		});

		$('.btn_view').on('click',function(){
			$('#frm').show();
			var service_id = $(this).attr('rel1');
			var form_id = $(this).attr('rel2');
			var app_Sub_id = $(this).attr('rel3');
			var idds = $(this).attr('rel4'); // appr_lvl_id
			var table = $(this).attr('rel5');
			var next_role_id = $(this).attr('rel6');
			var co = $(this).attr('rel7'); // Application Status
			var dep_log_id = $(this).attr('rel8');
			var action_taken_by_name = $(this).attr('rel10');
			var department_comment = $(this).attr('rel9');
			var core_department_id = $(this).attr('rel11');
			var created_on  = $(this).attr('rel12');
			var appStatus;
			if(co=='F'){appStatus="Forwarded"}
			if(co=='A'){appStatus="Approved"}
			if(co=='R'){appStatus="Rejected"}
			if(co=='P'){appStatus="Pending"}
			if(co=='H'){appStatus="Reverted"}
			if(co=='I'){appStatus="Incomplete"}
			if(co=='V'){appStatus="Verified"}
			//$('.modal').open();
			if(next_role_id == "<?php echo $_SESSION['role_id']; ?>" && co =="F" && dep_log_id){
				$('#frm').hide();
				$('.modal').modal();
				//$('.modal-body').html("<p>Investor Comment for you:  <strong>"+$(this).attr('rel9')+"</strong></p>");
				$('.modal-body').html('<table class="table table-striped table-bordered table-hover"><tr><td class="a_cent"><strong style="color: #333;">Status: </strong>'+appStatus+'</td><td class="a_cent"><strong style="color: #333;">Action Taken On: </strong> '+created_on+'</td></tr><tr><td class="a_cent"><strong style="color: #333;">Action Taken By:</strong> '+action_taken_by_name+'</td><td class="a_cent"><strong style="color: #333;">Action Type: </strong>'+department_comment+'</td></tr></table>');
				return false;
			}
			if(co=='V' && department_comment !=''){	
				$('#frm').hide();
				table = "Verified";			
				//$('.modal').modal();
				//$('.modal-body').html("<p>"+action_taken_by_name+" comment:  <strong>"+$(this).attr('rel9')+"</strong></p>");
				//$('.modal-body').html(data);
				//return false;
			}
			$.ajax({
				type: "GET",
				/*dataType: 'json',*/
				data:{"app_Sub_id":app_Sub_id,"service_id":service_id,"form_id":form_id,"idds":idds,"table":table,"next_role_id":next_role_id,'dep_log_id':dep_log_id,'core_department_id':core_department_id,'app_status':co,'created_on':created_on},
				url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizardtwo/formFieldMasterNoticeofChangeofManagerForm6/getFormHtml",
				success: function(data){
					console.log(data);
                                      //  alert(next_role_id+"===="+co);
					if(next_role_id && co !='V' && co !='F' && table!='Investor'){
						$('#frm').html(data);
					}else{
						$('#frm').hide();
						$('.modal').modal();
						$('.modal-body').html(data);
					}
				}
			});
		})
	});	
</script>
