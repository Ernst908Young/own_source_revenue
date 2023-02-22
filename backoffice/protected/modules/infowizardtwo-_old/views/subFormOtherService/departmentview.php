<?php
/* Rahul Kumar  25032018 */
//echo "<pre/>"; print_r($_SESSION);
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
<style>
.a_cent{ text-align:center; vertical-align:middle !important;}
.v_a{ vertical-align:middle !important; }
.portlet.box .dataTables_wrapper .dt-buttons { margin-top: -148px !important;}
<?php if(!isset($_GET['status'])){ ?>
<?php } ?>
<?php if(isset($_GET['status']) && $_GET['status']=="A"){ ?>
.showApprov{display:block;}
<?php } ?>
<?php if(isset($_GET['status']) && $_GET['status']=="F"){  ?>
.showFwd{display:block;}
<?php } ?>
<?php if(isset($_GET['status']) && $_GET['status']=="H"){  ?>
.showRev{display:block;}
<?php } ?>
<?php if(isset($_GET['status']) && $_GET['status']=="R"){  ?>
.showRej{display:block;}
<?php } ?>


    .errorSummary{ color:red;  }
    .text-left{  text-align:left !important;
    }
    hr{ margin: 2px !important;}
	
	a:hover{ background:#36C6D3 !important;	}
	textarea{height: 90px !important;}
	.page-footer-inner { padding: 1px 1px 1px !important; }
	.mt-step-col{cursor: pointer;}
    .portlet.box .dataTables_wrapper .dt-buttons { margin-top: 14px; }
    @media (min-width: 700px){
        .col-lg-3 { width: 20%;}
    }
    .href_link:hover{ color:#23527c;}
    .href_link1{ color: #ffffff; font-size: 13px; font-family: "Open Sans",sans-serif; font-weight: 300; text-align: center;vertical-align: top; padding: 2px 5px; }        
    .movetoDashboard{ cursor: pointer; }
    /*.top_tab { padding: 10px; background-color: #36C6D3 !important; color: #fff !important; }*/
    .flt_rgt { float: right !important;  border: 1px solid; margin-bottom: 5px; margin-right: 10px;}
    .portlet.green { background-color: #fff !important; }
    .padding10 tr td {padding: 10px !important;}
    .portlet.box.green{ border-top: 1px solid #5cd1db; }
    
</style>

<link href="/backoffice/themes/swcsNewTheme/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<?php  
	include($_SERVER["DOCUMENT_ROOT"].'/backoffice/themes/swcsNewTheme/views/layouts/subfromtabs.php'); 

	$get_form_name = InfowizardQuestionMasterExt::getFormNameFrmMap($ID,$formCodeID_);
	//echo "<pre/>"; print_r($get_form_name);
?>
<div class="portlet light bordered">
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
	<div class="portlet box green">
		<div class="portlet-title">
			<div class="caption"><?php echo $get_form_name['form_name'];  ?></div>
            <div class="tools"> <a href="/backoffice/infowizard/subForm/downloadNewApp/service_id/<?php echo $_GET['service_id'];?>/pageID/1/subID/<?php echo $submittion_id;?>/formCodeID/1" target="blank" class="btn btn-primary" style="height: 33px;">Print Application</a></div>
		</div>
		<div class="portlet-body">
			<table class="table table-striped table-bordered table-hover">						
				<tr>
					<td><strong style="color: #333;">Investor Name:</strong> <?php echo $invData['first_name']." ".$invData['last_name']; ?></td>
					<td><strong style="color: #333;">IUID:</strong> <?php echo $invData['iuid']; ?></td>	
				</tr>
				<tr>
					<td><strong  style='color: #333;'>Contact Number:&nbsp;&nbsp;</strong><?php echo  $invData['mobile_number']; ?></td>
					<td><strong  style='color: #333;'>Email Id:&nbsp;&nbsp;</strong><?php echo  $invData['email']; ?></td>
				</tr>	
				<?php
				$allResIns = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_formbuilder_application_forward_level where app_Sub_id=$submittion_id AND action_status='SINS'")->queryRow();
				/* echo "<pre>";
				print_r($allRes); */
				if(isset($allResIns) && !empty($allResIns)){
				
				//echo "<a href=/themes/backend/lm_approval_certificate/".$approvalCertArr['approval_certificate']." title='Certificate'>Download Certificate</a><br/>";
									

				?>
					<tr>
						<td><strong  style='color: #333;'>Inspection Start Date:&nbsp;&nbsp;</strong><?php echo $allResIns['inspection_start_date']?></td>
						<td><strong  style='color: #333;'>Inspection End Date:&nbsp;&nbsp;</strong><?php echo $allResIns['inspection_end_date']?></td>
					</tr>
					<tr>
						<td><strong  style='color: #333;'>Inspection Report:&nbsp;&nbsp;</strong><a href="/themes/backend/lm_inspection/<?php echo $allResIns['inspection_report']?>" target="_blank">Download</a></td>
						<td><strong  style='color: #333;'></strong></td>
					</tr>	
				<?php } ?>
			</table>
		<?php 
        $get_inv_submit_log = InfowizardQuestionMasterExt::getInvestorSubmitLog($ID,$submittion_id);
		$get_logg = InfowizardQuestionMasterExt::getApplicationLog($ID,$formCodeID_,$submittion_id);
		$investTotalLog=count($get_logg);
		//echo count($get_logg);
		if(!empty($get_logg)){
			$dept_pend = array();
			if($formCodeID_!=1){
				
			
			$allFormTypeId = Yii::app()->db->createCommand("Select form_type_id from bo_infowiz_form_builder_configuration where current_role_id='$_SESSION[role_id]' AND service_id='$_GET[service_id]'")->queryAll();
			foreach($allFormTypeId as $k=>$v)
			{
				$form_type_id[] = $v['form_type_id'];
			}
			$dept_pend=array();
			$dept_pend1=array();
			$dept_pend_form_id = 0;
            if(isset($_SESSION['uid']) && in_array($_GET['formCodeID'],$form_type_id)){               
             	 $dept_pend = InfowizardQuestionMasterExt::getDepartmentPendencyg($ID,$formCodeID_,$submittion_id); 
                // $dept_pend = InfowizardQuestionMasterExt::getDepartmentPendencyg($ID,$formCodeID_,$submittion_id); 
				 //echo count($dept_pend);
			 //echo "<!--ECHOHERE<pre>"; print_r($dept_pend); echo "</pre>-->";
				if(isset($dept_pend) && !empty($dept_pend[0]['form_id']))
				{
                                   
					$dept_pend_form_id = $dept_pend[0]['form_id'];
				}	
            }
            
			$processAnyTimeArr = Yii::app()->db->createCommand("Select process_anytime,form_type_id from bo_infowiz_form_builder_configuration where current_role_id='$_SESSION[role_id]' AND form_type_id='$_GET[formCodeID]' AND service_id='$_GET[service_id]'")->queryRow();
			 
			//if(empty($dept_pend) && $_GET['formCodeID']!=1 && $_GET['formCodeID']!=6 ){
			if($dept_pend_form_id!=$_GET['formCodeID'] && $processAnyTimeArr['process_anytime']=='Y'){
				$dept_pend1 = InfowizardQuestionMasterExt::getDepartmentPendencyOnOther($ID,$formCodeID_,$submittion_id); 
				// echo "<pre/>"; print_r($dept_pend1);
			}       
             
		/*  echo "<pre/>"; print_r($get_logg); 
		 print_r($dept_pend); 
		  print_r($dept_pend1); die; */
                   
                        
            $get_logg = array_merge($get_logg,$get_inv_submit_log,$dept_pend,$dept_pend1);
            $keys = array_keys($get_logg);
            array_multisort(array_column($get_logg, 'created'), SORT_ASC, SORT_STRING, $get_logg, $keys);
            $array_check = array_combine($keys, $get_logg);
			}
			?>
			<hr style="color: #36c6d3;" />
			<table class="table table-striped table-bordered table-hover">
				<tr>
					<tbody>
					<th>S.No.</th>
					<th>Action Taken By</th>
					<th>Department</th>
					<th>Action Taken On</th>
					<th>Action Type</th>
					<th>Status</th>
					<th>Comments</th>
					<th>Time Taken By Applicant</th>
					<th>Time Taken By Department User</th>
					<?php if(isset($_SESSION['uid'])){ ?><th>Action</th><?php } ?>
					</tbody>
				</tr>
			<?php 
			/*  */
			$i=1; 	
			$flg=0;
			$viewCount = 1;
                        
			$total_count= count($array_check);
			$arrayEnd=array_keys($array_check);
			$totalLog = end($arrayEnd);
			/*  echo "<pre>";
			print_r($totalLog); die; */
			$invTime = 0;
			$tcount = 1;
			$nodTime=0;
			$dept_name = "";
                      // if($_GET['subID'] == 6005){echo "<pre>";print_r($get_logg);die;}
					  
			foreach($array_check as $key=>$vall)
			{
                           
				$flg=0;
				if(isset($vall['appr_lvl_id']) && isset($vall['next_role_id']) && isset($vall['forwarded_dept_id']) && $_GET['formCodeID']==6 && $vall['next_role_id']==$_SESSION['role_id'] && $vall['forwarded_dept_id']!=$_SESSION['dept_id']){
					$flg=1;
				}
				if($flg==0)
				{
    
                    if(($vall['form_id']==$_GET['formCodeID']  || $vall['action_status']=='PF') || $_GET['formCodeID'] == 5 )
					{	
						if(isset($vall['department_user_id']) && $vall['department_user_id'] > 0 && $_GET['formCodeID']!=1) 
						{ 
							$dept_name = InfowizardQuestionMasterExt::getMasterName('bo_departments',$vall['core_department_id'],'department_name','dept_id');
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
						<td><?php echo $i; ?></td>
						<td><?php echo $vall['action_taken_by_name'];?></td>
						<td><?php echo @$dept_name; ?></td>
						<td><?php echo date("d-M-Y H:i:s",strtotime($vall['created']));?></td>
						<td><?php echo $vall['action_message'];?></td>
						<td><?php  echo $btn_name;?></td>
						<td><?php echo $vall['department_comment'];?></td>
						<td><?php if(!empty($vall['investor_log_id'])) echo @$timetaken; ?></td>
						<td><?php if(empty($vall['investor_log_id']))echo @$ntimetaken; ?></td>
						<?php if(isset($_SESSION['uid'])){ ?>
						<td>
							<?php 
							
							if(!empty($vall['investor_log_id']))
							{								
								
								if($viewCount == $investTotalLog){
							?>
							<button class="btn btn-success flt_rgt top_tab btn_view <?php echo $btn_cls; ?>" rel="<?php echo $btn_cls; ?>" rel1="<?php echo $ID; ?>" rel2="1" rel3="<?php echo $vall['app_Sub_id'];?>" rel4="<?php echo $vall['id'];?>" rel5="Investor" rel6="<?php echo @$vall['next_role_id'];?>" rel7="<?php echo @$vall['action_status'];?>" rel8="<?php echo @$vall['dept_log_id']; ?>" rel9="<?php echo @$vall['department_comment'];?>" rel10="<?php echo @$vall['action_taken_by_name'];?>" rel11="<?php echo @$vall['core_department_id'];?>" rel12="<?php echo @$vall['created'];?>">View</button>
						<?php 
								}
								$viewCount++;
							}
						
						else{
								//if($total_count == $i){
							?>
								<button class="btn btn-success flt_rgt top_tab btn_view <?php echo $btn_cls; ?>" rel="<?php echo $btn_cls; ?>" rel1="<?php echo $ID; ?>" rel2="<?php echo $_GET['formCodeID'];?>" rel3="<?php echo $vall['app_Sub_id'];?>" rel4="<?php echo @$vall['appr_lvl_id'];?>" rel5="Department" rel6="<?php echo @$vall['next_role_id'];?>" rel7="<?php echo $vall['action_status'];?>" rel8="<?php echo @$vall['dept_log_id']; ?>" rel9="<?php echo @$vall['department_comment'];?>" rel10="<?php echo @$vall['action_taken_by_name'];?>" rel11="<?php echo @$vall['core_department_id'];?>" rel12="<?php echo $vall['created'];?>">View</button>
						<?php // }
						}	
						?>
						</td>
					<?php } ?>
					</tr>
		<?php $i++;$tcount++;
                                        } }
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
					<td><?php echo $i; ?></td>
					<td><?php echo $vall['action_taken_by_name'];?></td>
					<td><?php echo @$dept_name;?></td>
					<td><?php echo date("d-M-Y H:i:s",strtotime($vall['created']));?></td>
					<td><?php echo $vall['action_message'];?></td>
					<td><?php  echo $btn_name;?></td>
					<td><?php echo $vall['department_comment'];?></td>
					<td><?php echo "NA"; ?></td>
					<td><?php echo "NA"; ?></td>
					<?php if(isset($_SESSION['uid'])){ ?>
					<td>
						<?php 
						if(!empty($vall['investor_log_id']))
						{
						?>
						<button class="btn btn-success flt_rgt top_tab btn_view <?php echo $btn_cls; ?>" rel="<?php echo $btn_cls; ?>" rel1="<?php echo $ID; ?>" rel2="1" rel3="<?php echo $vall['app_Sub_id'];?>" rel4="<?php echo $vall['id'];?>" rel5="Investor" rel6="<?php echo @$vall['next_role_id'];?>" rel7="<?php echo @$vall['action_status'];?>" rel8="<?php echo @$vall['dept_log_id']; ?>" rel9="<?php echo @$vall['department_comment'];?>" rel10="<?php echo @$vall['action_taken_by_name'];?>" rel11="<?php echo @$vall['core_department_id'];?>" rel12="<?php echo @$vall['created'];?>">View</button>
					<?php }
					
					else{?>
							<button class="btn btn-success flt_rgt top_tab btn_view <?php echo $btn_cls; ?>" rel="<?php echo $btn_cls; ?>" rel1="<?php echo $ID; ?>" rel2="<?php echo $_GET['formCodeID'];?>" rel3="<?php echo $vall['app_Sub_id'];?>" rel4="<?php echo @$vall['appr_lvl_id'];?>" rel5="Department" rel6="<?php echo @$vall['next_role_id'];?>" rel7="<?php echo $vall['action_status'];?>" rel8="<?php echo @$vall['dept_log_id']; ?>" rel9="<?php echo @$vall['department_comment'];?>" rel10="<?php echo @$vall['action_taken_by_name'];?>" rel11="<?php echo @$vall['core_department_id'];?>" rel12="<?php echo $vall['created'];?>">View</button>
					<?php } ?>
					</td>
				<?php 
					} ?>
				</tr>
			<?php }?>
	 		</table>
			
			<form class="form form-horizontal" id="FB_form" role="form" method="POST" enctype= "multipart/form-data"
			action="<?php echo Yii::app()->createAbsoluteUrl("/infowizard/subFormOtherService/processData"); ?>">
				<div id="frm" style="text-align:center;display:none;"><img src="<?= Yii::app()->theme->baseUrl ?>/images/ajax-loader.gif" /></div>
			</form>
	 	<?php } ?>
			<?php 			
			if($applicationStatusFromSubmission['application_status']=='AB')
			{
			?>
			<form class="form form-horizontal" id="abeyance_form" method="POST" enctype= "multipart/form-data" action="<?php echo Yii::app()->createAbsoluteUrl("/infowizard/subFormOtherService/processData"); ?>">
				<table class="table table-striped table-bordered table-hover">					
					<input type="hidden" name="app_Sub_id" value="<?php echo @$_GET['subID']; ?>">
					<input type="hidden" name="app_status" value="H">
					<input type="hidden" name="service_id" value="<?php echo @$_GET['service_id'];?>">
					<input type="hidden" name="form_id" value="<?php echo @$_GET['formCodeID'];?>">
					<tr>
						<td><span style="text-align:center;vertical-align:middle;">Comment: </span></td>
						<td><textarea name="UK-FCL-00181_2" id="UK-FCL-00181_2" class="form-control comment" row="2"></textarea></td>
					</tr>
					<tr><td style="text-align:center;vertical-align:middle;" colspan="2"><input type="submit" name="revert" value="Revert to Investor" class="btn btn-success"></td></tr>
				</table>
			</form>	
			<?php
			}
			?>
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
				$('.modal-body').html('<table class="table table-striped table-bordered table-hover"><tr><td><strong style="color: #333;">Status: </strong>'+appStatus+'</td><td><strong style="color: #333;">Action Taken On: </strong> '+created_on+'</td></tr><tr><td><strong style="color: #333;">Action Taken By:</strong> '+action_taken_by_name+'</td><td><strong style="color: #333;">Action Type: </strong>'+department_comment+'</td></tr></table>');
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
				url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/formFieldMasterOtherService/getFormHtml",
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
