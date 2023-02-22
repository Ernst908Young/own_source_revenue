<div class="container-fluid main-menu">
	<div class="row">
		<div class="col-xs-12">
			<div class="nav-top">
				<div class="">
					<div id="cssmenu" class="dashboard-header-menu">				
						<ul class="main-header-menu ">										
							<li class="main-header-menu-li <?php if(($controller=='default') && ($action=='index')){ echo "active";} ?><?php if(($controller=='subForm') && ($action=='departmentFormView')){ echo "active";} ?><?php if(($controller=='subForm') && ($action=='applicationTimeline')){ echo "active";} ?>">
								<a href="<?=Yii::app()->createAbsoluteUrl('/admin');?>">Dashboard</a>
							</li>
							<li class="main-header-menu-li <?php if(($controller=='subForm') && ($action=='processedApplication')){ echo "active";} ?>">
								<a href="<?=Yii::app()->createAbsoluteUrl('infowizard/subForm/processedApplication');?>">Processed Applications</a>
							</li>
							<li class="main-header-menu-li <?php if(($controller=='subFormCompanyNameReservation') && ($action=='revokeNameReservation')){ echo "active";} ?>">
								<a href="<?=Yii::app()->createAbsoluteUrl('infowizard/subFormCompanyNameReservation/revokeNameReservation');?>">Revoke Name</a>
							</li>
							<!--<li class="main-header-menu-li <?php if(($controller=='applicationView') && ($action=='applicationfulldetail')){ echo "active";} ?><?php if(($controller=='departmentDMS') && ($action=='ViewDMSIs')){ echo "active";} ?><?php if(($controller=='departmentDMS') && ($action=='view')){ echo "active";} ?>">
								<a href="<?= Yii::app()->createAbsoluteUrl('/Profile/viewUpdate/otp');?>">Verify Contact Detail</a>
							</li>	
							<?php  $dept_id=base64_encode ($_SESSION['uid']); $department_email=$_SESSION['email']; ?> 
							<li class="main-header-menu-li  has-sub">
								<a href="<?=Yii::app()->createAbsoluteUrl('Grievance/grievanceUpdate');?>">Grievance</a>
							</li> -->
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>