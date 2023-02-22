<div class="container-fluid main-menu">
	<div class="row">
		<div class="col-xs-12">
			<div class="nav-top">
				<div class="">
					<div id="cssmenu" class="dashboard-header-menu">
						<ul class="main-header-menu ">										
							<li class="main-header-menu-li <?php if(($controller=='default') && ($action=='index' || $action=='NewReportList')){ echo "active";} ?>"><a href="<?=Yii::app()->createAbsoluteUrl('/admin');?>">Dashboard</a></li>
							<li class="main-header-menu-li <?php if(($controller=='user') && ($action=='indexState'|| $action=="editState")){ echo "active";} ?>"><a href="<?=Yii::app()->createAbsoluteUrl('/user/indexState');?>">Manage State Level Nodal</a></li>
							<li class="main-header-menu-li <?php if(($controller=='user') && ($action=='indexDistrict' || $action=="editDistrict")){ echo "active";} ?>"><a href="<?=Yii::app()->createAbsoluteUrl('/user/indexDistrict');?>">Manage District Level Nodal</a></li>
							<li class="main-header-menu-li has-sub <?php if(($controller=='boApplicationSubmission') && ($action=='GMList' || $action=='StateNodalList' || $action=='DistrictNodalList' || $action=='userlist')){ echo "active";} ?>"><a href="#">Nodal Officers List</a>
								<ul>
									  <li>
										<a href="<?=$this->createUrl('/mis/boApplicationSubmission/GMList')?>">
										DIC GM
										</a>
									 </li>
									 <li>
										<a href="<?=$this->createUrl('/mis/boApplicationSubmission/StateNodalList')?>">
										SWA State Nodal
										</a>
									 </li>
									 <li>
										<a href="<?=$this->createUrl('/mis/boApplicationSubmission/DistrictNodalList')?>">
										SWA District Nodal
										</a>
									 </li>
									 <li>
										  <a href="<?php $role= base64_encode(64); echo $this->createUrl("/mis/boApplicationSubmission/userlist/ut/$role/title/EoDB District Level Nodal Officer")?>">
										EODB Nodal
										</a>
									 </li>
									 <li>
										<a href="<?php $role= base64_encode(62); echo $this->createUrl("/mis/boApplicationSubmission/userlist/ut/$role/title/Head Of Department - User List"); ?>">
										Panel - Department
										</a>
									 </li>
									 <li>
										<a href="<?php $role= base64_encode(71); echo $this->createUrl("/mis/boApplicationSubmission/userlist/ut/$role/title/Secretary Panel - User List"); ?>">
										Panel - Secretary
										</a>
									 </li>												  
								</ul>
							</li>								
							
							<?php if(DefaultUtility::isHODNodal()){ ?>							
								<li class="main-header-menu-li has-sub <?php if(($controller=='landownerConnect') && ($action=='create' || $action=='index')){ echo "active";} ?> <?php if(($controller=='landownerMessage') && ($action=='inbox' || $action=='sent')){ echo "active";} ?>"><a href="#">Land Lease</a>
									<ul>
										<li>
											<a href="<?=Yii::app()->createAbsoluteUrl('iloc/landownerConnect/create');?>" class="nav-link nav-toggle">
											<i class="fa fa-map-marker"></i>
											<span class="title">Add Land Details</span>
											</a>
										</li>
										<li>
											<a href="<?=Yii::app()->createAbsoluteUrl('iloc/landownerConnect');?>" class="nav-link nav-toggle">
											<i class="fa fa-building-o"></i>
											<span class="title">Manage Land Listing</span>
											</a>
										</li>
										<li>
											<a href="<?=Yii::app()->createAbsoluteUrl('iloc/landownerMessage/inbox');?>" class="nav-link nav-toggle">
											<i class="fa fa-inbox"></i>
											<span class="title">Messages</span>
											</a>
										</li>		
									</ul>	
								</li>
								
							<?php } ?>
							<li class="main-header-menu-li"><a href="/backoffice/mis/serviceMapping/l1/FY/ALL/swcs_status/both">Service Report</a></li>
							<li class="main-header-menu-li has-sub"><a href="#">Others</a>
								<ul>								
									<li>
										<a href="javascript:void(0)" title="View Application" class="nav-link policybenchmark">Policy Benchmark Report</a>
									</li>
									<li>
										<a href="https://www.doiuk.org/easeofdoingbusiness.php" target="_blank">Existing Units List</a>
									</li>
									<?php if(DefaultUtility::isHODNodal()){ ?>
										<li class="main-header-menu-li publicconsultancy"><a href="#">Public Consultation</a>
										</li>
									<?php } ?>
									<li><a href="/backoffice/PisMou/hodIndex/page/admin_listing1">Investor Summit</a></li>	
								</ul>
							</li>
						</ul>	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	
<form action="http://uksubsidy.in/production/department-dashboard" class="nav-link " method="POST" target="_blank" id="policybenchmark">
	<input type="hidden" name="token" value="<?php echo strtotime(date('Y-m-d H:i:s'))."-".($_SESSION['uid']+date('Y')); ?>" >
	<input type="hidden" name="department_user_id" value="<?php echo base64_encode($_SESSION['uid']);?>">
</form> 
<form action="http://www.ukpublicconsultation.in/admin/index" class="nav-link " method="POST" target="_blank" id="publicconsultancy"> 
	<input type="hidden" name="access_token" value="<?php echo @$_SESSION['token']; ?>" > 
	<input type="hidden" name="email" value="<?php echo @$_SESSION['email']; ?>" >   
	<input type="hidden" name="user_id" value="<?php echo @$_SESSION['uid'];?>">	
	<input type="hidden" name="department_id" value="<?php echo @$_SESSION['dept_id'];?>">
	<input type="hidden" name="department_name" value="<?php $departmentData =UserExt::getUserDept($_SESSION['uid']); echo @$departmentData['department_name']; ?>">
	<input type="hidden" name="user_name" value="<?php echo @$_SESSION['uname'];?>">	
	<input type="hidden" name="mobile" value="<?php echo @$_SESSION['mobile'];?>">
	<input type="hidden" name="role_id" value="<?php echo @$_SESSION['role_id'];?>"> 
</form>

<script type="text/javascript">
	$(document).ready(function(){		
		$(".policybenchmark").click(function(){
		   $("#policybenchmark").submit();                    
		});	
		$(".publicconsultancy").click(function(){
		   $("#publicconsultancy").submit();                    
		});	
	});
</script>
