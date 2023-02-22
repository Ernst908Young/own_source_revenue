<!DOCTYPE html>
<!-- saved from url=(0046)/backoffice/admin -->
<?php  $basePath="/themes/investuk";?> 
<?php  $basePath2="/backoffice/themes/swcsNewTheme";?> 
<html lang="en">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">	
	<title>CAIPO</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<meta content="CAIPO" name="description">
	<meta content="" name="CAIPO">
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<!--<link href="<?php echo $basePath;?>/css/css" rel="stylesheet" type="text/css">-->
	<link href="<?php echo $basePath;?>/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">	
	<link href="<?php echo $basePath;?>/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $basePath;?>/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $basePath;?>/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css">
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->	
	<link href="<?php echo $basePath;?>/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css">	
	<link href="<?php echo $basePath;?>/assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css">

	<link href="<?php echo $basePath;?>/assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $basePath;?>/assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css">
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN THEME GLOBAL STYLES -->	
	<link href="<?php echo $basePath;?>/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css">	
	<link href="<?php echo $basePath;?>/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css">
	<!-- END THEME GLOBAL STYLES -->
	<!-- BEGIN THEME LAYOUT STYLES -->	
	<link href="<?php echo $basePath;?>/assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $basePath;?>/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color">
	<link href="<?php echo $basePath;?>/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css">
	<!-- END THEME LAYOUT STYLES -->
	<link rel="shortcut icon" href="/backoffice/frontuser/home/favicon.ico">	
	
	<!-- <link href="css/extension-page-style.css" rel="stylesheet" type="text/css"  /> -->
	<!-- Bootstrap new edit sanjay-->	
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,500,700,900" rel="stylesheet">
	<link href="<?php echo $basePath;?>/css/home_style.css" rel="stylesheet">
	<link href="<?php echo $basePath;?>/css/dashboard_style.css" rel="stylesheet">
	<link href="<?php echo $basePath;?>/css/main_nav.css" rel="stylesheet">
	<link href="<?php echo $basePath;?>/css/media.css" rel="stylesheet">
	<link href="<?php echo $basePath;?>/css/media_dashboard.css" rel="stylesheet">
	<!-- SmartMenus jQuery Bootstrap Addon CSS -->
	<link href="<?php echo $basePath;?>/css/jquery.css" rel="stylesheet">
	
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="js/html5shiv.min.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	<!-- BEGIN CORE PLUGINS -->
	 <script src="<?php echo $basePath;?>/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
	 
      <script src="<?php echo $basePath;?>/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
      <script src="<?php echo $basePath;?>/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
      <script src="<?php echo $basePath;?>/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
      <script src="<?php echo $basePath;?>/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
      <script src="<?php echo $basePath;?>/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
      <script src="<?php echo $basePath;?>/assets/global/scripts/pair-select.min.js" type="text/javascript"></script>
      <script src="<?php echo $basePath;?>/assets/global/scripts/common.js" type="text/javascript"></script>
	  
	<!-- END CORE PLUGINS -->
    <style>
    .fy_select{width:200px;}
	.dropdown-user .dropdown-menu { width:300px !important;} 
	.page-header.navbar .top-menu .navbar-nav > li.dropdown-extended .dropdown-menu { max-width:300px !important}
    </style>
	<script type="text/javascript">		
		jQuery(document).on("click", ".expand", function() {	
			$(this).removeClass('expand');				
			$(this).addClass('collapse');					
			$(this).parent('div').parent('div').parent('div').find('.portlet-body').slideToggle('slow');
		});
		jQuery(document).on("click", ".collapse", function() {				
			$(this).removeClass('collapse');
			$(this).addClass('expand');			
			$(this).parent('div').parent('div').parent('div').find('.portlet-body').slideToggle('slow');
		});
		
	</script>
	<Script>
	$(document).ready(function(){
		//FO user notification	
		function Load_unseen_notification()
		{
			$.ajax({
				url:"/backoffice/infowizard/subFormCompanyNameReservation/getAllNotification",
				method:"POST",
				dataType : "Json",
				success:function(Data)
				{
					$('#notification_list').html(Data.Notification);
					if(Data.Unseen_notification > 0)
					{
						$('.total_notification').html(Data.Unseen_notification);
						$('.total_notification_msg').html(Data.Unseen_notification+' Pending Notification');
					}else{
						$('.total_notification').html('0');
						$('.total_notification_msg').html('0 Pending Notification');
					}
				}
			});
		}
		//Load_unseen_notification();
		
		$(document).on('click', '.dropdown-toggle', function(){	
			//alert("fo");
			$('.total_notification').html('');
			$('.total_notification_msg').html('');
			Load_unseen_notification();
		});
		setInterval(function(){
			 Load_unseen_notification();
			}, 1000); 
			
		
		//Bo user notification			
		function Load_unseen_notification_bo()
		{
			$.ajax({
				url:"/backoffice/infowizard/subFormCompanyNameReservation/getBoAllNotification",
				method:"POST",
				dataType : "Json",
				success:function(Data)
				{
					$('#notification_list_bo').html(Data.Notification);
					if(Data.Unseen_notification > 0)
					{
						$('.total_notification_bo').html(Data.Unseen_notification);
						$('.total_notification_msg_bo').html(Data.Unseen_notification+' Pending Notification');
					}else{
						$('.total_notification_bo').html('0');
						$('.total_notification_msg_bo').html('0 Pending Notification');
					}
				}
			});
		}
		//Load_unseen_notification();
		
		$(document).on('click', '.dropdown-toggle-bo', function(){	
			//alert("bo");
			$('.total_notification_bo').html('');
			$('.total_notification_msg_bo').html('');
			Load_unseen_notification_bo();
		});
		setInterval(function(){
			 Load_unseen_notification_bo();
			}, 1000); 	
		
	});
	
	$(document).on("click", '.list_services', function(){
		var id = $(this).attr('rel');
		$.ajax({
			url:"/backoffice/infowizard/subFormCompanyNameReservation/updateNotification",
			method:"POST",
			data:{id:id},
			dataType : "Json",
			success:function(data)
			{
				//alert(data);
				window.location.href ='/backoffice/frontuser/home/investorWalkthroughLevel2/type/SERVICES/financial_year/ALL';
			}
		});
	});	
	
	
	$(document).on("click", '.list_services_bo', function(){
		var id = $(this).attr('rel');
		$.ajax({
			url:"/backoffice/infowizard/subFormCompanyNameReservation/updateBoNotification",
			method:"POST",
			data:{id:id},
			dataType : "Json",
			success:function(data)
			{
				//alert(data);
				window.location.href ='/backoffice/infowizard/subFormCompanyNameReservation/revokeNameReservation';
			}
		});
	});	
</Script>
</head>
	<body class="<?php if(DefaultUtility::is_PRINCIPAL_SECRETARY() || DefaultUtility::is_CHEIF_SECRETARY() || RolesExt::isMISManager() || RolesExt::isMISAdmin() || (isset($_SESSION['RESPONSE']['user_id']) && DefaultUtility::isInvestorLoggedIn()) || RolesExt::isDMUser() || DefaultUtility::isHODNodal() || DefaultUtility::isSECRETARY() || DefaultUtility::isDisttApproverUser() || DefaultUtility::isNoodalAgency() || DefaultUtility::isStateNodalUser() || DefaultUtility::isStateApproverUser() || DefaultUtility::isDisttCommentLevelUser() || DefaultUtility::isStateCommentLevelUser() || DefaultUtility::isValidDocumentVerifierLogin() || DefaultUtility::isVerifier() || DefaultUtility::isSupport() || DefaultUtility::isApprover() || DefaultUtility::isAdmin()){ echo "ps-page-header-fixed";}else{ echo "page-header-fixed"; }?>  page-sidebar-closed-hide-logo page-content-white dashboard">
		<div class="page-wrapper">
		<!-- BEGIN HEADER -->		  
		<header class="page-header navbar navbar-fixed-top fixed-header">
			<div class="container-fluid">
				<div class="row top-header">
					<div class="col-xs-12">
						<div class="">
							<ul class="header-fonts pull-left">
								<li><a href="#" class="skip-main-cnt">Skip to main content</a></li>
								<li><a href="#">A-</a></li>
								<li><a href="#">A</a></li>
								<li><a href="#">A+</a></li>
								<div class="clearfix"></div>
							</ul>
							<div class="top-header-right pull-right">
								<div class="top-header-social">
									<a class="fb" title="Facebook" href="https://www.facebook.com/DestinationUKIS/"><i aria-hidden="true" class="fa fa-facebook"></i></a>
									<a class="tw" title="Twitter" href="https://twitter.com/DestinationUKIS"><i aria-hidden="true" class="fa fa-twitter"></i></a>
								</div>
								<div class="top-header-help">
									<p>Helpdesk (10:00 AM to 5:00 PM)&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;Toll Free XXXX-XXX-XXXX</p>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">		
						<div class="mid-header">		
							<h1 class="logo pull-left">
								
								<a href="/">
									<p class="heading">CORPORATE AFFAIRS AND INTELLECTUAL PROPERTY OFFICE</p>
									<p class="cap">A Division of the Ministry of International Business and Industry, BARBADOS</p>
								</a>
							</h1>
							<?php if(isset($_SESSION['RESPONSE']['user_id']) || isset($_SESSION['role_id'])){ ?>
							<div class="mid-header-right pull-right">								
							   <!-- END RESPONSIVE MENU TOGGLER -->
								<div class="top-menu">								  
								  <ul class="nav navbar-nav pull-right">
										<?php 
										if(isset($_SESSION['RESPONSE']['user_id']) && !empty($_SESSION['RESPONSE']['user_id']))
										{
											$loggedUserId = $_SESSION['RESPONSE']['user_id'];
											$userDetails  = Yii::app()->db->createCommand("SELECT * FROM bo_notification WHERE receiver_id='$loggedUserId' and status='0'")->queryAll();				
										?>
											<li class="dropdown dropdown-user dropdown-extended dropdown-notification" style="padding-right:44px;" id="header_notification_bar">
												<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
												<i class="fa fa-bell-o" style="font-size:24px;" aria-hidden="true"></i>
												<span class="badge badge-danger total_notification" style="top:-15px;right: -8px;"></span>
												</a>
												<ul class="dropdown-menu">
													<li class="external" id="totalNotification">
														<h3><span class="bold total_notification_msg"></h3>
													</li>
													<li>
														<ul class="dropdown-menu-list scroller" style="height: 220px;overflow:auto;" data-handle-color="#637283" id="notification_list">
														</ul>
													</li>
												</ul>
											</li>	
										<?php 
										}
										if(isset($_SESSION['uid']) && !empty($_SESSION['uid']))
										{
											$loggedUserId = $_SESSION['uid'];
											$userDetails  = Yii::app()->db->createCommand("SELECT * FROM bo_notification WHERE receiver_id='$loggedUserId' and status='0'")->queryAll();
										?>
											<li class="dropdown dropdown-user dropdown-extended dropdown-notification" style="padding-right:44px;" id="header_notification_bar">
												<a href="javascript:;" class="dropdown-toggle-bo" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
												<i class="fa fa-bell-o" style="font-size:24px;" aria-hidden="true"></i>
												<span class="badge badge-danger total_notification_bo" style="top: -1px;right: 9px;position:absolute;"></span>
												</a>
												<ul class="dropdown-menu">
													<li class="external" id="totalNotification">
														<h3><span class="bold total_notification_msg_bo"></h3>
													</li>
													<li>
														<ul class="dropdown-menu-list scroller" style="height: 220px;overflow:auto;" data-handle-color="#637283" id="notification_list_bo">
														</ul>
													</li>
												</ul>
											</li>										
										<?php }?>
										<li class="dropdown dropdown-user">
											<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
												<span class="username username-hide-on-mobile"> 
													<span class="username">
													<?php
													   if(isset($_SESSION['RESPONSE']))
															  echo "<span class='username'>".$_SESSION['RESPONSE']['first_name']." ".$_SESSION['RESPONSE']['last_name']."</span>";
													   else
															 echo "<span class='username'>".$_SESSION['uname']."</span>";
													   
													   ?>
													</span> 
												</span>
												<i class="fa fa-angle-down"></i>
											</a>
											<ul class="dropdown-menu dropdown-menu-default">
												<li class="dropdown-user-info">
													<i class="icon-user"></i>
													<div class="user-name-email">
														<h6>
														<?php
														/* echo "<pre>";
														print_r($_SESSION); */
													   if(isset($_SESSION['RESPONSE']))
															  echo "<span class='username'>".$_SESSION['RESPONSE']['first_name']." ".$_SESSION['RESPONSE']['last_name']."</span>";
													   else
															 echo "<span class='username'>".$_SESSION['uname']."</span>";
													   
													   ?>
													   </h6>
														<a><?php echo @$_SESSION['RESPONSE']['email'];?></a>
													</div>
													<div class="clearfix"></div>
												</li>
												<li class="dropdown-user-links">
												  <a href="<?=Yii::app()->createAbsoluteUrl('/Profile/ViewUpdate/editProfile')?>">
												  <i class="icon-note"></i> Edit Profile </a>
												</li>
												<?php if(DefaultUtility::isDisttApproverUser() || DefaultUtility::isNoodalAgency() || DefaultUtility::isStateNodalUser() || DefaultUtility::isStateApproverUser() || DefaultUtility::isDisttCommentLevelUser() || DefaultUtility::isStateCommentLevelUser() || DefaultUtility::isVerifier() || DefaultUtility::isApprover() || DefaultUtility::isAdmin()){ ?>
												<li class="dropdown-user-links">
												  <a href="<?=Yii::app()->createAbsoluteUrl('/Profile/viewUpdate/otp');?>">
												  <i class="icon-settings"></i> Verify Contact Detail </a>
												</li>
												<?php } ?>
												<li class="dropdown-user-links">
												  <a href="<?=Yii::app()->createAbsoluteUrl('/Profile/ViewUpdate')?>">
												  <i class="icon-user"></i> My Account </a>
												</li>												
												<li class="dropdown-user-links-logout">
												  <a href="/backoffice/site/logout">
												  <i class="icon-key"></i> Log Out </a>
												</li>
											</ul>
										</li>
														  <!-- END USER LOGIN DROPDOWN -->
									 <!-- BEGIN QUICK SIDEBAR TOGGLER -->
								  </ul>
								</div>
								<!--<a class="user-rel user-email" href="#"><i class="icon-envelope"></i><span class="count-sup">8</span></a>
								<a class="user-rel user-noti" href="#"><i class="icon-bell"></i><span class="count-sup">4</span></a>-->
								<div class="clearfix"></div>
							</div>	
							<?php } ?>						
						</div>
					</div>
				</div>
			</div>
			<?php //These link should be show when ps login			
			if(DefaultUtility::is_PRINCIPAL_SECRETARY() || DefaultUtility::is_CHEIF_SECRETARY() || RolesExt::isMISManager() || RolesExt::isMISAdmin())
			{
				$controller = Yii::app()->controller->id;							
				$action = Yii::app()->controller->action->id;
				require_once("ps_cs_headerlink.php");
			?>
				<form action="http://uksubsidy.in/production/department-dashboard" class="nav-link " method="POST" target="_blank" id="policybenchmark">
					<input type="hidden" name="token" value="<?php echo strtotime(date('Y-m-d H:i:s'))."-".($_SESSION['uid']+date('Y')); ?>" >
					<input type="hidden" name="department_user_id" value="<?php echo base64_encode($_SESSION['uid']);?>">
				</form> 		
				<script type="text/javascript">
					$('document').ready(function(){		
						$(".policybenchmark").click(function(){
						   $("#policybenchmark").submit();                    
						});		
					});
				</script>
			<?php	
			}
			if(DefaultUtility::isInvestorLoggedIn())
			{
				//Start link should be show when Investor Login
				$controller = Yii::app()->controller->id;
				$action = Yii::app()->controller->action->id;				
				require_once("/var/www/html/backoffice/themes/investuk/investor_headerlink.php");
				//End link should be show when Investor Login
			}
			if(RolesExt::isDMUser())
			{
				//Start link should be show when DM Login
				$controller = Yii::app()->controller->id;				
				$action = Yii::app()->controller->action->id;				
				require_once("dm_headerlink.php");
				//End link should be show when DM Login
			}if(DefaultUtility::isHODNodal() || DefaultUtility::isSECRETARY())
			{
				//Start link should be show when HOD And Secy Login
				$controller = Yii::app()->controller->id;					
				$action = Yii::app()->controller->action->id;				
				require_once("hod_secy_headerlink.php");
				//End link should be show when HOD And Secy Login
			}if(DefaultUtility::isDisttApproverUser())
			{
				//Start link should be show when District CAF Approver Login
				$controller = Yii::app()->controller->id;
				$action = Yii::app()->controller->action->id;				
				require_once("is_district_caf_approver_user.php");
				//End link should be show when District CAF Approver Login
			}if(DefaultUtility::isNoodalAgency())
			{
				//Start link should be show when District CAF verifier Login
				$controller = Yii::app()->controller->id;					
				$action = Yii::app()->controller->action->id;				
				require_once("is_district_caf_verifier_user.php");
				//End link should be show when District CAF verifier Login
			}if(DefaultUtility::isStateNodalUser())
			{
				//Start link should be show when State CAF verifier Login
				$controller = Yii::app()->controller->id;
				$action = Yii::app()->controller->action->id;				
				require_once("is_state_caf_verifier_user.php");
				//End link should be show when State CAF verifier Login
			}if(DefaultUtility::isStateApproverUser())
			{
				//Start link should be show when State CAF approver Login
				$controller = Yii::app()->controller->id;				
				$action = Yii::app()->controller->action->id;				
				require_once("is_state_caf_approver_user.php");
				//End link should be show when State CAF approver Login
			}if(DefaultUtility::isDisttCommentLevelUser())
			{
				//Start link should be show when District Comment level User Login
				$controller = Yii::app()->controller->id;
				$action = Yii::app()->controller->action->id;				
				require_once("is_department_district_comment_level_user.php");
				//End link should be show when District Comment level User Login
			}
			if(DefaultUtility::isStateCommentLevelUser())
			{
				//Start link should be show when State Comment level User Login
				$controller = Yii::app()->controller->id;
				$action = Yii::app()->controller->action->id;				
				require_once("is_department_state_comment_level_user.php");
				//End link should be show when State Comment level User Login
			}
			if(DefaultUtility::isValidDocumentVerifierLogin())
			{
				//Start link should be show when document verifier Login
				$controller = Yii::app()->controller->id;
				$action = Yii::app()->controller->action->id;				
				require_once("is_document_verifier.php");
				//End link should be show when document verifier Login
			}
            if(isset($_SESSION['role_id']) && $_SESSION['role_id']=='92')
			{
				//Start link should be show when document verifier Login
				$controller = Yii::app()->controller->id;
				$action = Yii::app()->controller->action->id;				
				require_once("is_pmu_admin.php");
				//End link should be show when document verifier Login
			}
            if(isset($_SESSION['role_id']) && $_SESSION['role_id']=='89')
			{
				//Start link should be show when document verifier Login
				$controller = Yii::app()->controller->id;
				$action = Yii::app()->controller->action->id;				
				require_once("is_pmu_user.php");
				//End link should be show when document verifier Login
			}
            if(isset($_SESSION['role_id']) && $_SESSION['role_id']=='90')
			{
				//Start link should be show when document verifier Login
				$controller = Yii::app()->controller->id;
				$action = Yii::app()->controller->action->id;				
				require_once("is_nsdc_user.php");
				//End link should be show when document verifier Login
			}
			if(DefaultUtility::isVerifier())
			{
				//Start link should be show when document verifier Login
				$controller = Yii::app()->controller->id;
				$action = Yii::app()->controller->action->id;				
				require_once("is_verifier.php");
				//End link should be show when document verifier Login
			}
			if(DefaultUtility::isApprover())
			{
				//Start link should be show when document verifier Login
				$controller = Yii::app()->controller->id;
				$action = Yii::app()->controller->action->id;				
				require_once("is_approver.php");
				//End link should be show when document verifier Login
			}	
			if(DefaultUtility::isAdmin())
			{
				//Start link should be show when document verifier Login
				$controller = Yii::app()->controller->id;
				$action = Yii::app()->controller->action->id;				
				require_once("is_admin.php");
				//End link should be show when document verifier Login
			}	
			?>	
		</header> 
			
		<div class="clearfix"> </div>
 
	<div class="page-container ps-dashboard-container"> 

		
		<div class="page-content-wrapper">
            <div class="page-content">	
            <div class=content>
            	<?php
			/* Including Inner Content */
			echo $content;
			/* End of Adding Inner Content */
			?>
            </div>			
			
			<?php
			/* Including Footer  */
			/*if(!isset($_SESSION['RESPONSE']['user_id']) && !isset($_SESSION['role_id'])){
                include('/var/www/html/themes/investuk/footer.php');
            }else{*/
				/* Including Footer  */
				include('/var/www/html/backoffice/themes/investuk/footer_logged.php');
				/* End of Adding Footer */
            //} 			
			?>
			</div>				
		</div>
    </div>
	</div>	
  <!-- </div>      
   </div>      
   </div> -->	     
<?php
/* Including Footer  */
//include('/var/www/html/backoffice/themes/investuk/footer_logged.php');
/* End of Adding Footer */
?>