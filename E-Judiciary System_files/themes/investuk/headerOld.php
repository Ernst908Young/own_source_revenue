<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Single Window Clearance System, Uttarakhand</title>
<!-- Bootstrap -->
<?php  $basePath=BASE_PATH;?> 
<link rel="shortcut icon" href="<?php echo $basePath;?>/themes/investuk/images/favicon.ico" type="image/x-icon">
<link rel="icon" href="images/favicon.ico" type="image/x-icon">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,500,700,900" rel="stylesheet">
<link href="<?php echo $basePath;?>/themes/investuk/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $basePath;?>/themes/investuk/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo $basePath;?>/themes/investuk/css/home_style.css" rel="stylesheet">
<link href="<?php echo $basePath;?>/themes/investuk/css/home_slider.css" rel="stylesheet">
<!-- Inner Pages CSS-->
<link href="<?php echo $basePath;?>/themes/investuk/css/inner_style.css" rel="stylesheet">
<link href="<?php echo $basePath;?>/themes/investuk/css/main_nav.css" rel="stylesheet">

<link href="<?php echo $basePath;?>/themes/investuk/css/media.css" rel="stylesheet">
  <!-- SmartMenus jQuery Bootstrap Addon CSS -->
    <link href="<?php echo $basePath;?>/themes/investuk/css/jquery.css" rel="stylesheet">
	
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="<?php echo $basePath;?>/themes/investuk/js/html5shiv.min.js"></script>
      <script src="<?php echo $basePath;?>/themes/investuk/js/respond.min.js"></script>
    <![endif]-->
<!-- Added By : Rahul Kumar -->
</head>

<script>document.addEventListener('contextmenu', event => event.preventDefault());</script>
<body>






<div class="container-fluid">
  <div class="row">
    <section>
      <header>
	  <div class="container-fluid">
	  <div class="row top-header">
		<div class="col-xs-12">
		<div class="">
			<ul class="header-fonts pull-left">
				<li><a href="<?php echo $basePath;?>/themes/investuk/#" class="skip-main-cnt">Skip to main content</a></li>
				<li><a href="<?php echo $basePath;?>/themes/investuk/#">A-</a></li>
				<li><a href="<?php echo $basePath;?>/themes/investuk/#">A</a></li>
				<li><a href="<?php echo $basePath;?>/themes/investuk/#">A+</a></li>
				<div class="clearfix"></div>
			</ul>
			<div class="top-header-right pull-right">
				<div class="top-header-social">
					<a class="fb" title="Facebook" href="https://www.facebook.com/investmentinuk/"><i aria-hidden="true" class="fa fa-facebook"></i></a>
					<a class="tw" title="Twitter" href="https://twitter.com/investmentinuk"><i aria-hidden="true" class="fa fa-twitter"></i></a>
				</div>
				<?php if(isset($_SESSION['lang']) && $_SESSION['lang']=="hn"){ ?> 
					<div class="top-header-help">
					<p>सहायता केंद�?र (स�?बह 10:00 बजे से शाम 5:00 बजे तक )&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;नि: श�?ल�?क  1800-270-1213  &nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;ईमेल helpdesk@investuttarakhand.com&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;व�?हाट�?स�?प�?प  +91-7895857056</p>
				</div>
				    <?php }  else { ?>
					<div class="top-header-help">
					<p>Helpdesk (10:00 AM to 5:00 PM IST)&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;Toll Free 1800-270-1213&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;Email helpdesk@investuttarakhand.com&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;WhatsApp +91-7895857056</p>
				</div>
				   <?php  } ?>
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
			<span class="staymev-jayte thirdpartyweb"><img src="<?php echo $basePath;?>/themes/backend/uploads/satyamevjayate-logo.png" alt="Satymev Jayte" title="Satymev Jayte" height="70" /></span>
				 <span class="staymev-jayte thirdpartyweb"><img src="<?php echo $basePath;?>/themes/backend/uploads/destination_uk_logo_high_res.png" height="70" alt="Destination Uttarakhand"></span>
				 	<span class="staymev-jayte" style="margin-left:-14px;" ><img src="<?php echo $basePath;?>/themes/backend/uploads/utk-logo.png" alt="Uttarakhand Shashan" title="Uttarakhand Shashan" height="70" /></span>
				<!--span class="staymev-jayte" style="margin-left:-14px;"><img src="http://52.172.145.30/themes/backend/uploads/utk-logo.png" alt="Uttarakhand Shashan" title="Uttarakhand Shashan" height="70"></span-->
				<a href="<?php echo $basePath;?>">
					<!--<p class="heading">Invest Uttarakhand</p>-->
					<p class="heading"><?php  $flgheader=0;
								if(isset($_SESSION['webref']) && $_SESSION['webref']=="CMRYUK"){
									$controllerName=Yii::app()->controller->id;
									$actionName=Yii::app()->controller->action->id;
									$controllerArray=array('account','sample');
									$actionArray=array('signin','register','one','PasswordResetRequest','resendActivationLink');	 							
									if(((in_array($controllerName,$controllerArray) && in_array($actionName,$actionArray)) || (isset($_GET['service_id']) && $_GET['service_id']=="629.0"))){
										$flgheader=1;
										if(isset($_SESSION['lang']) && $_SESSION['lang']=="hn"){
											echo "म�?ख�?यमंत�?री स�?वरोजगार योजना (CMRY)";
										}else{
											echo "Chief Minister's Swarojgar Yojana (CMRY)";
										}
										}
								}
								if($flgheader==0){
							 		echo "Invest Uttarakhand"; 
										} 
										if($flgheader==1){ ?>
										<style>
												/*body{background-color: rgb(238, 198, 146) !important; position: relative; min-height: 100%; top: 0px;} */
												.heading{color:darkred !important;}
												h3{color:darkred !important;}
												.stats-icon{color:darkred !important;}
												.main-footer{display: none;}
												.main-menu{display: none;}
												.thirdpartyweb{display:none;}
										</style>

								<?php } ?></p>
					<p class="cap">DIRECTORATE OF INDUSTRIES, GOVERNMENT OF UTTARAKHAND</p>
				</a>
			</h1>
			<div class="mid-header-right pull-right">
				<div class="mid-header-bts">
					<a href="<?php echo $basePath;?>/swcs/sample/one/action/register" class="mid-header-bt">Registration</a>
					<a href="<?php echo $basePath;?>/swcs/sample/one/action/signin" class="mid-header-bt">Investor Login</a>
					<a href="<?php echo $basePath;?>/backoffice/site/login" class="mid-header-bt">Department Login</a>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		</div>
		</div>
	  </div>	  
	  <div class="container-fluid main-menu">
		<div class="row">
			<div class="col-xs-12">
			


			<div class="nav-top">
  <div class="">
    <div id="cssmenu">
	<ul class="main-header-menu">
                     <li class="main-header-menu-li active">
                        <a href="https://investuttarakhand.com">Home</a>
                     </li>
                         <?php
						 if(isset($_GET['guest']) && ($_GET['guest'] ==1)){?> 
                         <li  class='main-header-menu-li has-sub'><a  href='/about' class='dropdown-toggle' data-toggle='dropdown' data-hover='dropdown' data-hover='dropdown'>About</a><ul class=""><li><a href='/industrial-profile' class='sf-with-ul'>Industrial Profile</a></li><li><a href='/single-window-clearance-system' class='sf-with-ul'>Single Window Clearance System</a></li><li><a href='/nodal-agency' class='sf-with-ul'>Nodal Agency</a></li><li><a href='/focus-sector' class='sf-with-ul'>Focus Sector</a></li><li><a href='/start-a-new-business' class='sf-with-ul'>Start a New Business</a></li><li><a href='/gallery' class='sf-with-ul'>Gallery</a></li></ul></li><li  class='main-header-menu-li has-sub'><a  href='/services' class='dropdown-toggle' data-toggle='dropdown' data-hover='dropdown' data-hover='dropdown'>Services</a><ul class=""><li class='has-sub'><a href='/list-of-approval-through-swcs' class='has_children'>Apply for Approvals</a><ul ><li><a href='/pre-establishment' class='sf-with-ul'>Pre-Establishment</a></li><li><a href='/pre-operations' class='sf-with-ul'>Pre-Operations</a></li></ul></li><li><a target='_blank'  href='http://52.172.145.30/swcs/sample/one/action/register' class='fancybox' data-fancybox-type='iframe'>Single Window Portal - Investor Registration</a></li><li><a target='_blank'  href='http://52.172.145.30/swcs/sample/one/action/signin' class='fancybox' data-fancybox-type='iframe'>Single Window Portal - Investor Login</a></li><li><a target='_blank'  href='http://52.172.145.30/backoffice/site/login' class='fancybox' data-fancybox-type='iframe'>Single Window Portal - Department Login</a></li><li><a target='_blank'  href='http://udyogaadhaar.gov.in/UA/UAM_Registration.aspx' class='fancybox' data-fancybox-type='iframe'>Udyog Aadhar Registration</a></li><li><a target='_blank'  href='http://52.172.145.30/check-status' class='fancybox' data-fancybox-type='iframe'>CAF Status</a></li><li><a target='_blank'  href='http://52.172.145.30/backoffice/deptIntegration/login' class='fancybox' data-fancybox-type='iframe'>Incentives Department Login</a></li></ul></li><li  class='main-header-menu-li has-sub'><a  href='/check-services1' class='dropdown-toggle' data-toggle='dropdown' data-hover='dropdown' data-hover='dropdown'>Know Your Approvals</a><ul class=""><li><a href='/check-services' class='sf-with-ul'>Know Your Approvals</a></li><li><a target='_blank'  href='http://52.172.145.30/site/ServiceListingNew/iw/Y' class='fancybox' data-fancybox-type='iframe'>Service Details</a></li><li><a target='_blank'  href='http://52.172.145.30/site/ServiceListingInspectionNew/iw/Y' class='fancybox' data-fancybox-type='iframe'>Service Details - Inspections</a></li><li><a target='_blank'  href='http://52.172.145.30/site/inspectionSchedule' class='fancybox' data-fancybox-type='iframe'>C.I.S.</a></li><li class='has-sub'><a href='/reforms-done-by-state-departments-new' class='has_children'>Reforms done by State Departments</a><ul ><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/EoDB-UK3-MSME_Business_Reforms.pdf' class='fancybox' data-fancybox-type='iframe'>Reforms undertaken by MSME Department</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/EoDB-UK3-Forest_Business_Reforms.pdf' class='fancybox' data-fancybox-type='iframe'>Reforms undertaken by Department of Forest</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/EoDB-UK3_GoodGovernance_Business_Reforms.pdf' class='fancybox' data-fancybox-type='iframe'>Reforms undertaken by Good Governance and Anti-Corruption De</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/EoDB-UK3-Revenue_Business_Reforms.pdf' class='fancybox' data-fancybox-type='iframe'>Reforms undertaken by Revenue Department</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/EoDB-UK3-Labour_Business_Reforms.pdf' class='fancybox' data-fancybox-type='iframe'>Reforms undertaken by Department of Labour</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/EoDB-UK3-UPCL_Business_Reforms.pdf' class='fancybox' data-fancybox-type='iframe'>Reforms undertaken by Uttarakhand Power Corporation Limited</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/EoDB-UK3-UEPPCB_Business_Reforms.pdf' class='fancybox' data-fancybox-type='iframe'>Reforms undertaken by UEPPCB</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/EoDB-UK3-SIIDCUL_Business_Reforms.pdf' class='fancybox' data-fancybox-type='iframe'>Reforms undertaken by SIIDCUL</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/EoDB-UK3-SIDA_Business_Reforms.pdf' class='fancybox' data-fancybox-type='iframe'>Reforms undertaken by SIDA</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/EoDB-UK3-Housing_Business_Reforms.pdf' class='fancybox' data-fancybox-type='iframe'>Reforms undertaken by Housing Department</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/EoDB-UK3-Urban_Business_Reforms.pdf' class='fancybox' data-fancybox-type='iframe'>Reforms undertaken by Urban Development Directorate</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/EoDB-UK3-Legal_Metrology_Business_Reforms.pdf' class='fancybox' data-fancybox-type='iframe'>Reforms undertaken by Legal Metrology Department</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/EoDB-UK3-UJS_Business_Reforms.pdf' class='fancybox' data-fancybox-type='iframe'>Reforms undertaken by Uttarakhand Jal Sansthan</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/EoDB-UK3-Fire_Business_Reforms.pdf' class='fancybox' data-fancybox-type='iframe'>Reforms undertaken by Fire and Emergency Services Department</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/EoDB-UK3-Registrarof_FSC_Business_Reforms.pdf' class='fancybox' data-fancybox-type='iframe'>Reforms undertaken by Registrar of Firms, Societies and Chit Funds</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/EoDB-UK3-DHMFW_Business_Reforms.pdf' class='fancybox' data-fancybox-type='iframe'>Reforms undertaken by Directorate of Medical Health and Family Welfare</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/EoDB-UK3-Electrical_Inspectorate_Business_Reforms.pdf' class='fancybox' data-fancybox-type='iframe'>Reforms undertaken by Electrical Inspectorate Department</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/EoDB-UK3-Dept.ofStampsandRegistration_Business_Reforms.pdf' class='fancybox' data-fancybox-type='iframe'>Reforms undertaken by Department of Stamps and Registration</a></li></ul></li></ul></li><li  class='main-header-menu-li has-sub'><a  href='/resources' class='dropdown-toggle' data-toggle='dropdown' data-hover='dropdown' data-hover='dropdown'>Resources</a><ul class=""><li class='has-sub'><a href='/acts' class='has_children'>Acts</a><ul ><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/UK_SWCS_ACT_English.pdf' class='fancybox' data-fancybox-type='iframe'>Single Window Act-English</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/UK_SWCS_ACT_Hindi.pdf' class='fancybox' data-fancybox-type='iframe'>Single Window Act-Hindi</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/MSME_Act_2006.pdf' class='fancybox' data-fancybox-type='iframe'>MSME Act-2006</a></li></ul></li><li><a href='/notifications' class='sf-with-ul'>Notifications</a></li><li><a href='/rules' class='sf-with-ul'>Rules</a></li><li class='has-sub'><a href='/policies-&-guidelines' class='has_children'>Policies & Guidelines</a><ul ><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/Mega_Industrial_Policy_2015.pdf' class='fancybox' data-fancybox-type='iframe'>Mega Industrial Policy 2015</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/textile_park_policy_2014.pdf' class='fancybox' data-fancybox-type='iframe'>Mega Textile Park Policy 2014</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/msme_policy_2015.pdf' class='fancybox' data-fancybox-type='iframe'>Uttarakhand MSME Policy 2015</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/Chief%20Minister%20Swarojgar%20Yojna.pdf' class='fancybox' data-fancybox-type='iframe'>Chief Minister Swarojgar Yojna</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/Mahila%20Udhyami%20Vishesh%20Protsahan%20Yojna.pdf' class='fancybox' data-fancybox-type='iframe'>Mahila Udhyami Vishesh Protsahan Yojna</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/PRIME%20MINISTER%E2%80%99S%20EMPLOYMENT%20GENERATION%20PROGRAMME%20(PMEGP).pdf' class='fancybox' data-fancybox-type='iframe'>PMEGP</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/Uttarakhand%20Rajya%20Shilp%20Ratna%20Puruskar.pdf' class='fancybox' data-fancybox-type='iframe'>Uttarakhand Rajya Shilp Ratna Puruskar</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/MSME_Policies_Guidelines.pdf' class='fancybox' data-fancybox-type='iframe'>Guidelines-MSME Policies</a></li><li><a href='/mini-industrial-land' class='sf-with-ul'>Mini Industrial Land</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/OLD_land_allotment_policy.pdf' class='fancybox' data-fancybox-type='iframe'>Land Allotment Policy</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/Amendement_Proposed.pdf' class='fancybox' data-fancybox-type='iframe'>Land Allotment Policy Amendment (Proposed)</a></li></ul></li><li class='has-sub'><a href='/single-window-user-manual' class='has_children'>User Manuals</a><ul ><li><a target='_blank' href='http://investuttarakhand.com//themes/backend/uploads/User_Manual_CAF.pdf' class='fancybox' data-fancybox-type='iframe'>Common Application Form (CAF)</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/User_Manual_Registration.pdf' class='fancybox' data-fancybox-type='iframe'>Investor Registration Manual</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/User_Manual_Login.pdf' class='fancybox' data-fancybox-type='iframe'>Investor Login Manual</a></li></ul></li><li class='has-sub'><a href='/single-window-taxes-and-duties' class='has_children'>Taxes and Duties</a><ul ><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/state-transport-department-taxes.pdf' class='fancybox' data-fancybox-type='iframe'>State Transport Department</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/ElectricityTariffFeb_4922.pdf' class='fancybox' data-fancybox-type='iframe'>Uttarakhand Power Corporation Ltd.</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/Stamps_and_Registration_-_Stamp_Fees__Regn_Fess.pdf' class='fancybox' data-fancybox-type='iframe'>Stamps & Registration Department</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/ExcisePolicy-2017-18-duties.pdf' class='fancybox' data-fancybox-type='iframe'>Excise Department</a></li></ul></li><li class='has-sub'><a href='/Start-Up-Uttarakhand' class='has_children'>Start-Up Uttarakhand</a><ul ><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/startup policy 2018-notified Hindi copy.pdf' class='fancybox' data-fancybox-type='iframe'>Uttarakhand Start-up Policy 2018</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/Start-Up Guidelines.pdf' class='fancybox' data-fancybox-type='iframe'>Guidelines of Uttarakhand Start-up Policy 2018</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/Grievance resolution.jpg' class='fancybox' data-fancybox-type='iframe'>Grievance resolution mechanism for Start-ups</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/Public consultation.jpg' class='fancybox' data-fancybox-type='iframe'>Use of public consultation module for newer and disruptive regulations for start-ups</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/Nodal officer.jpg' class='fancybox' data-fancybox-type='iframe'>Appointment of Nodal officer for promoting Start-ups in the State</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/Constitution of Startup Council.jpg' class='fancybox' data-fancybox-type='iframe'>Constitution of Start-up Council</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/MOU invest india.pdf' class='fancybox' data-fancybox-type='iframe'>MoU of Invest India and Government of Uttarakhand for promoting Start-ups</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/UCOST.jpg' class='fancybox' data-fancybox-type='iframe'>UCOST -Intellectual Property Facilitation Centre of Uttarakhand</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/Self-Certification Scheme for Start-ups.pdf' class='fancybox' data-fancybox-type='iframe'>Self-Certification Scheme for Start-ups</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/UCOST - innovation society.jpg' class='fancybox' data-fancybox-type='iframe'>UCOST - innovation society for promoting Start-ups</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/Constitution of Startup Cell.jpg' class='fancybox' data-fancybox-type='iframe'>Constitution of dedicated Start-up Cell under Department of Industries</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/Draft%20Uttarakhand%20Procurement%20Policy%202018.pdf' class='fancybox' data-fancybox-type='iframe'>Uttarakhand Procurement Policy 2018 (Draft)</a></li><li><a target='_blank' href='http://52.172.145.30/themes/backend/uploads/Procedure for availing assistance from Government of Uttarakhand under clause 10.pdf' class='fancybox' data-fancybox-type='iframe'>Procedure for availing sponsorship assistance under Start-up Policy 2018</a></li></ul></li></ul></li><li  class='main-header-menu-li has-sub'><a  href='/contact-us' class='dropdown-toggle' data-toggle='dropdown' data-hover='dropdown' data-hover='dropdown'>Contact Us</a><ul class=""><li><a href='/faq' class='sf-with-ul'>FAQ</a></li><li><a href='/contact' class='sf-with-ul'>SWCS-CELL</a></li><li><a href='/general-managers---dic' class='sf-with-ul'>General Managers - DIC</a></li><li><a href='/startup-cell-uttarakhand' class='sf-with-ul'>Start-Up Cell Uttarakhand</a></li><li><a target='_blank'  href='http://52.172.145.30/survey' class='fancybox' data-fancybox-type='iframe'>SURVEY</a></li></ul></li><li  class='main-header-menu-li has-sub'><a  href='/statistics' class='dropdown-toggle' data-toggle='dropdown' data-hover='dropdown' data-hover='dropdown'>Dashboard</a><ul class=""><li><a target='_blank'  href='http://52.172.145.30/site/SwcsAnalytics' class='fancybox' data-fancybox-type='iframe'>SWCS-Analytics</a></li><li><a target='_blank'  href='http://52.172.145.30/site/Cafdashboard' class='fancybox' data-fancybox-type='iframe'>CAF-DashBoard</a></li><li><a href='/Start-Up-dashboard' class='sf-with-ul'>Start-Up DashBoard Uttarakhand</a></li></ul></li>
						 <?php }else{
                           $langId='';
                           $REDIRECT_URL=$_SERVER['REDIRECT_URL'];
                           $REDIRECT_URL=trim($REDIRECT_URL);
                           $REDIRECT_URL=str_replace("/","",$REDIRECT_URL);
                           $links = Utility::getPageTree(1);
                           foreach ($links as $link) {
                               if($link['page_stub'] != 'contact-us'){
                               $tstub=$link['page_stub'];
                               $ck=$tstub;     //remove this after demo 17-10-2015
                               $tstub_id=md5($tstub); 
                               $tstub=str_replace("/", "", $tstub);
                               $url = Yii::app()->createUrl($tstub);
                               $children=$link['children'];
                               $pageName = $link['page_name'.$langId];
                               if(empty($pageName)) {
                                   $pageName = $link['page_name'];
                               }
                               $aclass="";
                               $aid = "";
                               //if($REDIRECT_URL==$tstub){
                               if($REDIRECT_URL=="NOT-----"){
                                   $aclass="class=''";
                                   $aid="id='current'";
                               }
                               else{
                           
                                   if(count($children)>0) {
                                       echo "<li  class='main-header-menu-li has-sub'>";
                                       echo "<a $aid href='$url' class='dropdown-toggle' data-toggle='dropdown' data-hover='dropdown' data-hover='dropdown'>$pageName</a>";
                                       echo '<ul class="">';
                           
                                       foreach ($children as $child) {
                           
                                           $cstub=$child['page_stub'];
                                           $cstub=str_replace("/", "", $cstub);
                                           $childLink = Yii::app()->createUrl($cstub);
                                           $childLabel = $child['page_name'.$langId];
                                           if(empty($childLabel)){
                                               $childLabel = $child['page_name'];
                                           }
                                           if($child['is_direct_link']==='Y')
                                               echo "<li><a target='_blank'  href='".$child['link_address']."' class='fancybox' data-fancybox-type='iframe'>$childLabel</a></li>";
                                           else{
                           
                                               $subchild=$child['children'];
                                               if(count($subchild)>0){
                                                   echo "<li class='has-sub'>";
                                                   echo "<a href='$childLink' class='has_children'>$childLabel";
                                                   echo '</a>';
                                                   echo "<ul >";
                                                   foreach ($subchild as $sub) {
                                                       $sstub=$sub['page_stub'];
                                                       $sstub=str_replace("/", "", $sstub);
                                                       $schildLink = Yii::app()->createUrl($sstub);
                                                       $schildLabel = $sub['page_name'.$langId];
                                                       if(empty($schildLabel)){
                                                           $schildLabel = $sub['page_name'];
                                                       }
                                                      
                                                       if($sub['is_direct_link']==='Y')
                                                            echo "<li><a target='_blank' href='".$sub['link_address']."' class='fancybox' data-fancybox-type='iframe'>$schildLabel</a></li>";
                                                      else
                                                            echo "<li><a href='$schildLink' class='sf-with-ul'>$schildLabel</a></li>";
                                                   }
                                                   echo "</ul></li>";
                                               }
                                               else{
                                                   if($child['is_direct_link']==='Y')
                                                       echo "<li><a target='_blank'  href='".$child['link_address']."' class='fancybox' data-fancybox-type='iframe'>$childLabel</a></li>";
                                                   else
                                                       echo "<li><a href='$childLink' class='sf-with-ul'>$childLabel</a></li>";
                                               }
                                           }
                                       }
                                       echo "</ul></li>";                                                      
                                   }
                                   else{
                                       if($link['is_direct_link']==='Y')
                                           echo "<li class='main-header-menu-li'><a target='_blank' href='". $link['link_address']."' class='fancybox' data-fancybox-type='iframe'>$pageName</a></li>";
                                       else
                                           echo "<li $aclass><a href='$url'>$pageName</a></li>";
                                   }   
                               }
                                                 }}}
                           ?>  
				
						   <li class="main-header-menu-li has-sub">
                                    <a href="/backoffice/iloc/landownerConnect/create" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" aria-expanded="false">Sell / Lease Land</a>
                                    <ul class="">
                                        <li class="has-sub"><a href="/single-window-user-manual" class="has_children">Land Requirement</a>
										<ul class="has-sub">
                                                <li><a href="/backoffice/iloc/landrequesterConnect/create" class="sf-with-ul">Add Land Requirements</a></li>
                                                <li><a href="/backoffice/iloc/property/listing/landtype/Pvt" class="fancybox" data-fancybox-type="iframe">Search Available Lands</a></li>
                                            </ul>
                                        </li>
                                        <li class=""><a href="/single-window-user-manual" class="has_children">List Your Land For Lease</a>
										<ul class="has-sub">
                                                <li><a href="/backoffice/iloc/landownerConnect/create" class="sf-with-ul">Add Land Details</a></li>
                                                <li><a href="/backoffice/iloc/property/requirementListing" class="sf-with-ul">Search Land Requirements</a></li>
                                                <li><a href="javascript:void(0)" data-toggle="modal" data-target="#guestLogin">Manage Listing</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="/backoffice/iloc/property/advertisement" target="_blank">Land Lease Video Advertisement</a></li>
                                         <li><a href="/themes/backend/uploads/GO_30_Nov_2016.pdf" target="_blank">UPZALR Land Lease Amendment</a></li>
                                    </ul>
                                </li>
										   <li class="main-header-menu-li"><a href="/site/ProposalReport">Proposal Reports</a></li>
                  </ul>
	
    </div>
  </div>
</div>


			</div>
		</div>
	  </div>
	  </header>
    <div class="clearfix"></div>
	