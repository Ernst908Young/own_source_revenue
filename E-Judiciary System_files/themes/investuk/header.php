<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-FRAME-OPTIONS" content="DENY">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>E-Judiciary System</title>
<!-- Bootstrap --> 
<?php  $basePath="http://52.172.145.30";?> 
<link rel="shortcut icon" href="<?php echo $basePath;?>/themes/investuk/images/favicon.ico" type="image/x-icon">
<link rel="icon" href="images/favicon.ico" type="image/x-icon">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,500,700,900" rel="stylesheet">
<script src="<?php echo $basePath;?>/themes/investuk/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
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
<style>
	#uttarakhand-state .modal-body {
	position: relative;
	padding-bottom: 56.25%; / 16:9 /
	padding-top: 25px;
	height: 0;
}
#uttarakhand-state .modal-body object, #uttarakhand-state .modal-body embed, #uttarakhand-state .modal-body iframe {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
}


    .sector-items:hover .sector-item-img{
	transform: scale(1.2);
}
/*  #cssmenu ul ul ul.indussummit {
    right: 0;
    margin-right: 250px;
}	 */
#cssmenu ul li.indussummitLi:hover ul.indussummit{
	left: -505px;
	z-index: 0;
	width: 254px;
}

header .otherlogo {
  height: 100%;
  width: auto;
  position: absolute;
  right: 0;
  top: 0;
}

header .mainlogo {
  height: 78px;
  margin: 11px 20px;
}
.top-band {
  position: fixed;
  z-index: 9;
  top: 0;
  display: flex;
  justify-content: center;
  width: 100%;
  background: #843735;
  color: #fdfcc4;
  padding: 10px 0;
  font-size: 20px;
  font-weight: bold;
  text-shadow: 1px 1px 5px #0b0b0b8a;
  letter-spacing: 2px;
}
</style>
<!--<script>document.addEventListener('contextmenu', event => event.preventDefault());</script>-->

<body>






<div class="container-fluid">
  <div class="row">
    <section>
      <header>
	  <div class="container-fluid">
	  <div class="row top-header">
		<div class="col-xs-12">
		<div class="">
			<ul class="header-fonts pull-left" style="display:inherit;">
				<li><a href="#body_section" class="skip-main-cnt">Skip to main content</a></li>
				<li><a href="javascript:void(0)" onclick="aless();">A-</a></li>
				<li><a href="javascript:void(0)" onclick="anormal();">A</a></li>
				<li><a href="javascript:void(0)" onclick="aplus();">A+</a></li>
				<li class="screen-reader-li"><a href="/site/screenReader"><i class="fa fa-volume-up"></i> <span>Screen Reader Access</span></a></li>
				<div class="clearfix"></div>
			</ul>	
			<div class="top-header-right pull-right">
				<div class="top-header-social">
							<a class="fb" title="Facebook" target="_blank" href="#"><i aria-hidden="true" class="fa fa-facebook"></i></a>
					<a class="tw" title="Twitter" target="_blank" href="#"><i aria-hidden="true" class="fa fa-twitter"></i></a>
				</div>

				
					<div class="top-header-help">
					<p>Helpdesk (10:00 AM to 5:00 PM IST)&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;Toll Free 1234567890&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;Email helpdesk@email.com&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;WhatsApp +91-0000000000</p>
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
				
			<span class="staymev-jayte thirdpartyweb"><img src="/themes/investuk/images/AshokStambh.png" alt="Satymev Jayte" title="Satymev Jayte" height="70"></span>

			<a href="http://52.172.145.30/"><p class="heading">E-Judiciary System</p>

			<p class="cap">
			GOVERNMENT OF UTTARPRADESH	
			</p>
			</a>
			</h1>

			<div class="mid-header-right pull-right">

				<?php if(isset($_SESSION['lang']) && $_SESSION['lang']=="hn"){ ?>				
				<div class="mid-header-bts">
					<a href="<?php echo $basePath;?>/swcs/sample/one/action/register" class="mid-header-bt">पंजीकरण</a>
					<a href="<?php echo $basePath;?>/swcs/sample/one/action/signin" class="mid-header-bt">निवेशक/आवेदक लॉग इन करें</a>
					<a href="<?php echo $basePath;?>/backoffice/site/login" class="mid-header-bt">विभाग लॉग इन करें</a>
					<a href="https://email.godaddy.com/login.php" target="_blank" class="mid-header-bt thirdpartyweb">विभाग का ईमेल</a>
				</div>
				<?php } else { ?>				
				<div class="mid-header-bts">
					<a href="<?php echo $basePath;?>/swcs/sample/one/action/register" class="mid-header-bt">Registration</a>
					<a href="<?php echo $basePath;?>/swcs/sample/one/action/signin" class="mid-header-bt">Applicant Login</a>
					<a href="<?php echo $basePath;?>/backoffice/site/login" class="mid-header-bt ">Department Login</a>
					<!--<a href="https://email.godaddy.com/login.php" target="_blank" class="mid-header-bt thirdpartyweb">Department Email</a>-->

				</div>
			    <?php  }?>


				
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
                        <a href="http://52.172.145.30/">Home</a>
                     </li>
                         <?php
						 if(isset($_GET['guest']) && ($_GET['guest'] ==1)){  ?> 
						   <li  class='main-header-menu-li has-sub'><a  href='/about' class='dropdown-toggle' data-toggle='dropdown' data-hover='dropdown' data-hover='dropdown'>About</a><ul class=""><li><a href='/industrial-profile' class='sf-with-ul'>Industrial Profile</a></li><li><a href='/single-window-clearance-system' class='sf-with-ul'>Single Window Clearance System</a></li><li><a href='/nodal-agency' class='sf-with-ul'>Nodal Agency</a></li><li><a href='/focus-sector' class='sf-with-ul'>Focus Sector</a></li><li><a href='/start-a-new-business' class='sf-with-ul'>Start a New Business</a></li><li><a href='/gallery' class='sf-with-ul'>Gallery</a></li></ul></li><li  class='main-header-menu-li has-sub'><a  href='/services' class='dropdown-toggle' data-toggle='dropdown' data-hover='dropdown' data-hover='dropdown'>Services</a><ul class=""><li><a target='_blank'  href='/swcs/sample/one/action/register' class='fancybox' data-fancybox-type='iframe'>Single Window Portal - Investor Registration</a></li><li><a target='_blank'  href='/swcs/sample/one/action/signin' class='fancybox' data-fancybox-type='iframe'>Single Window Portal - Investor Login</a></li><li><a target='_blank'  href='/backoffice/site/login' class='fancybox' data-fancybox-type='iframe'>Single Window Portal - Department Login</a></li><li><a target='_blank'  href='http://udyogaadhaar.gov.in/UA/UAM_Registration.aspx' class='fancybox' data-fancybox-type='iframe'>Udyog Aadhar Registration</a></li><li><a   href='/check-status' class='fancybox' data-fancybox-type='iframe'>CAF Status</a></li><li><a target='_blank'  href='/backoffice/deptIntegration/login' class='fancybox' data-fancybox-type='iframe'>Incentives Department Login</a></li><li><a   href='/survey' class='fancybox' data-fancybox-type='iframe'>Survey</a></li></ul></li><li  class='main-header-menu-li has-sub'><a  href='/check-services1' class='dropdown-toggle' data-toggle='dropdown' data-hover='dropdown' data-hover='dropdown'>Know Your Approvals</a><ul class=""><li><a href='/faq' class='sf-with-ul'>FAQ</a></li><li><a href='/check-services' class='sf-with-ul'>Approvals Wizard</a></li><li><a   href='/site/ServiceListingNew/iw/Y' class='fancybox' data-fancybox-type='iframe'>Service Details</a></li></ul></li><li  class='main-header-menu-li has-sub'><a  href='/resources' class='dropdown-toggle' data-toggle='dropdown' data-hover='dropdown' data-hover='dropdown'>Resources</a><ul class=""><li class='has-sub'><a href='/acts' class='has_children'>Acts</a><ul ><li><a target='_blank' href='/themes/backend/uploads/UK_SWCS_ACT_English.pdf' class='fancybox' data-fancybox-type='iframe'>Single Window Act-English</a></li><li><a target='_blank' href='/themes/backend/uploads/UK_SWCS_ACT_Hindi.pdf' class='fancybox' data-fancybox-type='iframe'>Single Window Act-Hindi</a></li><li><a target='_blank' href='/themes/backend/uploads/MSME_Act_2006.pdf' class='fancybox' data-fancybox-type='iframe'>MSME Act-2006</a></li></ul></li><li><a href='/notifications' class='sf-with-ul'>Notifications</a></li><li><a href='/rules' class='sf-with-ul'>Rules</a></li><li class='has-sub'><a href='/policies-&-guidelines' class='has_children'>Policies & Guidelines</a><ul ><li><a target='_blank' href='/themes/backend/uploads/Mega_Industrial_Policy_2015.pdf' class='fancybox' data-fancybox-type='iframe'>Mega Industrial Policy 2015</a></li><li><a target='_blank' href='/themes/backend/uploads/textile_park_policy_2014.pdf' class='fancybox' data-fancybox-type='iframe'>Mega Textile Park Policy 2014</a></li><li><a target='_blank' href='/themes/backend/uploads/msme_policy_2015.pdf' class='fancybox' data-fancybox-type='iframe'>Uttarakhand MSME Policy 2015</a></li><li><a target='_blank' href='/themes/backend/uploads/Chief%20Minister%20Swarojgar%20Yojna.pdf' class='fancybox' data-fancybox-type='iframe'>Chief Minister Swarojgar Yojna</a></li><li><a target='_blank' href='/themes/backend/uploads/Mahila%20Udhyami%20Vishesh%20Protsahan%20Yojna.pdf' class='fancybox' data-fancybox-type='iframe'>Mahila Udhyami Vishesh Protsahan Yojna</a></li><li><a target='_blank' href='/themes/backend/uploads/PRIME%20MINISTER%E2%80%99S%20EMPLOYMENT%20GENERATION%20PROGRAMME%20(PMEGP).pdf' class='fancybox' data-fancybox-type='iframe'>PMEGP</a></li><li><a target='_blank' href='/themes/backend/uploads/Uttarakhand%20Rajya%20Shilp%20Ratna%20Puruskar.pdf' class='fancybox' data-fancybox-type='iframe'>Uttarakhand Rajya Shilp Ratna Puruskar</a></li><li><a target='_blank' href='/themes/backend/uploads/MSME_Policies_Guidelines.pdf' class='fancybox' data-fancybox-type='iframe'>Guidelines-MSME Policies</a></li><li><a href='/mini-industrial-land' class='sf-with-ul'>Mini Industrial Land</a></li><li><a target='_blank' href='/themes/backend/uploads/OLD_land_allotment_policy.pdf' class='fancybox' data-fancybox-type='iframe'>Land Allotment Policy</a></li><li><a target='_blank' href='/themes/backend/uploads/Amendement_Proposed.pdf' class='fancybox' data-fancybox-type='iframe'>Land Allotment Policy Amendment (Proposed)</a></li></ul></li><li class='has-sub'><a href='' class='has_children'>User Manuals</a><ul ><li><a target='_blank' href='http://investuttarakhand.com//themes/backend/uploads/User_Manual_CAF.pdf' class='fancybox' data-fancybox-type='iframe'>Common Application Form (CAF)</a></li><li><a target='_blank' href='/themes/backend/uploads/User_Manual_Registration.pdf' class='fancybox' data-fancybox-type='iframe'>Investor Registration Manual</a></li><li><a target='_blank' href='/themes/backend/uploads/User_Manual_Login.pdf' class='fancybox' data-fancybox-type='iframe'>Investor Login Manual</a></li></ul></li><li class='has-sub'><a href='/single-window-taxes-and-duties' class='has_children'>Taxes and Duties</a><ul ><li><a target='_blank' href='/themes/backend/uploads/state-transport-department-taxes.pdf' class='fancybox' data-fancybox-type='iframe'>State Transport Department</a></li><li><a target='_blank' href='/themes/backend/uploads/ElectricityTariffFeb_4922.pdf' class='fancybox' data-fancybox-type='iframe'>Uttarakhand Power Corporation Ltd.</a></li><li><a target='_blank' href='/themes/backend/uploads/Stamps_and_Registration_-_Stamp_Fees__Regn_Fess.pdf' class='fancybox' data-fancybox-type='iframe'>Stamps & Registration Department</a></li><li><a target='_blank' href='/themes/backend/uploads/ExcisePolicy-2017-18-duties.pdf' class='fancybox' data-fancybox-type='iframe'>Excise Department</a></li></ul></li><li class='has-sub'><a href='/reforms-done-by-state-departments-new' class='has_children'>Reforms done by State Departments</a><ul ><li><a target='_blank' href='/themes/backend/uploads/EoDB-UK3-MSME_Business_Reforms.pdf' class='fancybox' data-fancybox-type='iframe'>Reforms undertaken by MSME Department</a></li><li><a target='_blank' href='/themes/backend/uploads/EoDB-UK3_GoodGovernance_Business_Reforms.pdf' class='fancybox' data-fancybox-type='iframe'>Reforms undertaken by Good Governance and Anti-Corruption De</a></li><li><a target='_blank' href='/themes/backend/uploads/EoDB-UK3-Forest_Business_Reforms.pdf' class='fancybox' data-fancybox-type='iframe'>Reforms undertaken by Department of Forest</a></li><li><a target='_blank' href='/themes/backend/uploads/EoDB-UK3-Revenue_Business_Reforms.pdf' class='fancybox' data-fancybox-type='iframe'>Reforms undertaken by Revenue Department</a></li><li><a target='_blank' href='/themes/backend/uploads/EoDB-UK3-Labour_Business_Reforms.pdf' class='fancybox' data-fancybox-type='iframe'>Reforms undertaken by Department of Labour</a></li><li><a target='_blank' href='/themes/backend/uploads/EoDB-UK3-UPCL_Business_Reforms.pdf' class='fancybox' data-fancybox-type='iframe'>Reforms undertaken by Uttarakhand Power Corporation Limited</a></li><li><a target='_blank' href='/themes/backend/uploads/EoDB-UK3-UEPPCB_Business_Reforms.pdf' class='fancybox' data-fancybox-type='iframe'>Reforms undertaken by UEPPCB</a></li><li><a target='_blank' href='/themes/backend/uploads/EoDB-UK3-SIIDCUL_Business_Reforms.pdf' class='fancybox' data-fancybox-type='iframe'>Reforms undertaken by SIIDCUL</a></li><li><a target='_blank' href='/themes/backend/uploads/EoDB-UK3-SIDA_Business_Reforms.pdf' class='fancybox' data-fancybox-type='iframe'>Reforms undertaken by SIDA</a></li><li><a target='_blank' href='/themes/backend/uploads/EoDB-UK3-Housing_Business_Reforms.pdf' class='fancybox' data-fancybox-type='iframe'>Reforms undertaken by Housing Department</a></li><li><a target='_blank' href='/themes/backend/uploads/EoDB-UK3-Urban_Business_Reforms.pdf' class='fancybox' data-fancybox-type='iframe'>Reforms undertaken by Urban Development Directorate</a></li><li><a target='_blank' href='/themes/backend/uploads/EoDB-UK3-Legal_Metrology_Business_Reforms.pdf' class='fancybox' data-fancybox-type='iframe'>Reforms undertaken by Legal Metrology Department</a></li><li><a target='_blank' href='/themes/backend/uploads/EoDB-UK3-UJS_Business_Reforms.pdf' class='fancybox' data-fancybox-type='iframe'>Reforms undertaken by Uttarakhand Jal Sansthan</a></li><li><a target='_blank' href='/themes/backend/uploads/EoDB-UK3-Fire_Business_Reforms.pdf' class='fancybox' data-fancybox-type='iframe'>Reforms undertaken by Fire and Emergency Services Department</a></li><li><a target='_blank' href='/themes/backend/uploads/EoDB-UK3-Registrarof_FSC_Business_Reforms.pdf' class='fancybox' data-fancybox-type='iframe'>Reforms undertaken by Registrar of Firms, Societies and Chit Funds</a></li><li><a target='_blank' href='/themes/backend/uploads/EoDB-UK3-DHMFW_Business_Reforms.pdf' class='fancybox' data-fancybox-type='iframe'>Reforms undertaken by Directorate of Medical Health and Family Welfare</a></li><li><a target='_blank' href='/themes/backend/uploads/EoDB-UK3-Electrical_Inspectorate_Business_Reforms.pdf' class='fancybox' data-fancybox-type='iframe'>Reforms undertaken by Electrical Inspectorate Department</a></li><li><a target='_blank' href='/themes/backend/uploads/EoDB-UK3-Dept.ofStampsandRegistration_Business_Reforms.pdf' class='fancybox' data-fancybox-type='iframe'>Reforms undertaken by Department of Stamps and Registration</a></li></ul></li><li class='has-sub'><a href='/Start-Up-Uttarakhand' class='has_children'>Start-Up Uttarakhand</a><ul ><li><a target='_blank' href='/themes/backend/uploads/startup policy 2018-notified Hindi copy.pdf' class='fancybox' data-fancybox-type='iframe'>Uttarakhand Start-up Policy 2018</a></li><li><a target='_blank' href='/themes/backend/uploads/Start-Up Guidelines.pdf' class='fancybox' data-fancybox-type='iframe'>Guidelines of Uttarakhand Start-up Policy 2018</a></li><li><a target='_blank' href='/themes/backend/uploads/Public consultation.jpg' class='fancybox' data-fancybox-type='iframe'>Use of public consultation module for newer and disruptive regulations for start-ups</a></li><li><a target='_blank' href='/themes/backend/uploads/Grievance resolution.jpg' class='fancybox' data-fancybox-type='iframe'>Grievance resolution mechanism for Start-ups</a></li><li><a target='_blank' href='/themes/backend/uploads/Nodal officer.jpg' class='fancybox' data-fancybox-type='iframe'>Appointment of Nodal officer for promoting Start-ups in the State</a></li><li><a target='_blank' href='/themes/backend/uploads/Constitution of Startup Council.jpg' class='fancybox' data-fancybox-type='iframe'>Constitution of Start-up Council</a></li><li><a target='_blank' href='/themes/backend/uploads/MOU invest india.pdf' class='fancybox' data-fancybox-type='iframe'>MoU of Invest India and Government of Uttarakhand for promoting Start-ups</a></li><li><a target='_blank' href='/themes/backend/uploads/UCOST.jpg' class='fancybox' data-fancybox-type='iframe'>UCOST -Intellectual Property Facilitation Centre of Uttarakhand</a></li><li><a target='_blank' href='/themes/backend/uploads/Self-Certification Scheme for Start-ups.pdf' class='fancybox' data-fancybox-type='iframe'>Self-Certification Scheme for Start-ups</a></li><li><a target='_blank' href='/themes/backend/uploads/UCOST - innovation society.jpg' class='fancybox' data-fancybox-type='iframe'>UCOST - innovation society for promoting Start-ups</a></li><li><a target='_blank' href='/themes/backend/uploads/Constitution of Startup Cell.jpg' class='fancybox' data-fancybox-type='iframe'>Constitution of dedicated Start-up Cell under Department of Industries</a></li><li><a target='_blank' href='/themes/backend/uploads/Draft%20Uttarakhand%20Procurement%20Policy%202018.pdf' class='fancybox' data-fancybox-type='iframe'>Uttarakhand Procurement Policy 2018 (Draft)</a></li><li><a target='_blank' href='/themes/backend/uploads/Procedure for availing assistance from Government of Uttarakhand under clause 10.pdf' class='fancybox' data-fancybox-type='iframe'>Procedure for availing sponsorship assistance under Start-up Policy 2018</a></li></ul></li></ul></li><li  class='main-header-menu-li has-sub'><a  href='/statistics' class='dropdown-toggle' data-toggle='dropdown' data-hover='dropdown' data-hover='dropdown'>Dashboard / Reports</a><ul class=""><li><a   href='/site/SwcsAnalytics' class='fancybox' data-fancybox-type='iframe'>Single Window Analytics</a></li><li><a   href='/site/Cafdashboard' class='fancybox' data-fancybox-type='iframe'>Proposal Report</a></li><li><a   href='/site/inspectionSchedule' class='fancybox' data-fancybox-type='iframe'>Central Inspection System</a></li><li><a href='/Start-Up-dashboard' class='sf-with-ul'>Start-Up DashBoard Uttarakhand</a></li></ul></li><li  class='main-header-menu-li has-sub'><a  href='/contact-us' class='dropdown-toggle' data-toggle='dropdown' data-hover='dropdown' data-hover='dropdown'>Contact Us</a>
						   <ul class="">
							   <li><a href='/contact' class='sf-with-ul'>Single Window Clearance Cell</a></li>
							   <li><a href='/startup-cell-uttarakhand' class='sf-with-ul'>Start-Up Cell </a></li>
							   <li><a   href='/site/StateNodalList' class='fancybox' data-fancybox-type='iframe'>State Nodal List</a></li>
							   <li><a   href='/site/listgm' class='fancybox' data-fancybox-type='iframe'>General Managers - DIC</a></li>
							   <li class="main-header-menu-li">
								<a href="/site/FocusSector">Investible Project</a>
							   </li>
							</ul>
							</li>



	<?php }else{
                           $langId='';
                           $REDIRECT_URL=$_SERVER['REDIRECT_URL'];
                           $REDIRECT_URL=trim($REDIRECT_URL);
                           $REDIRECT_URL=str_replace("/","",$REDIRECT_URL);
                           $links = Utility::getPageTree(1);//echo "<pre>";print_r($links);die;
                           foreach($links as $link) {
                               if($link['page_stub'] != 'contact-us1'){
								   $tstub=$link['page_stub'];
								   $parent_id=$link['parent_id'];
								   $ck=$tstub;     //remove this after demo 17-10-2015
								   $tstub_id=md5($tstub); 
								   //$tstub=str_replace("/", "", $tstub);
                                                                   $url = $basePath.'/'.$tstub;
								   //$url = Yii::app()->createUrl($tstub);
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
                                           //$childLink = Yii::app()->createUrl($cstub);
                                           $childLink = $basePath.'/'.$cstub;
                                           $childLabel = $child['page_name'.$langId];
                                           if(empty($childLabel)){
                                               $childLabel = $child['page_name'];
                                           }
                                           if($child['is_direct_link']==='Y'){
                                              $tb="";  if($child['new_tab']==='Y'){$tb="target='_blank'";}     echo "<li><a $tb  href='".$child['link_address']."' class='fancybox' data-fancybox-type='iframe'>$childLabel</a></li>";
                                           } else{
                           
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
                                                      
                                                       if($sub['is_direct_link']==='Y'){
                                                         $tb="";  if($sub['new_tab']==='Y'){$tb="target='_blank'";}    echo "<li><a $tb href='".$sub['link_address']."' class='fancybox' data-fancybox-type='iframe'>$schildLabel</a></li>";
                                                   } else{
                                                            echo "<li><a href='$schildLink' class='sf-with-ul'>$schildLabel</a></li>";
                                                   }
                                                   }
                                                   echo "</ul></li>";
                                               }
                                               else{
                                                   if($child['is_direct_link']==='Y'){
                                                    $tb="";  if($child['new_tab']==='Y'){$tb="target='_blank'";}      echo "<li><a $tb  href='".$child['link_address']."' class='fancybox' data-fancybox-type='iframe'>$childLabel</a></li>";
                                                   }  else {
                                                       echo "<li><a href='$childLink' class='sf-with-ul'>$childLabel</a></li>";
                                                   }
                                               }
                                           }
                                       }
                                       echo "</ul></li>";                                                      
                                   }
                                   else{
                                       if($link['is_direct_link']==='Y'){
                                         $tb="";  if(isset($child) && !empty($child) && $child['new_tab']==='Y'){$tb="target='_blank'";}      echo "<li class='main-header-menu-li'><a $tb href='". $link['link_address']."' class='fancybox' data-fancybox-type='iframe'>$pageName</a></li>";
                                       }  else {
                                           echo "<li $aclass><a href='$url'>$pageName</a></li>";
                                       }
                                   }   
								 }
								}
							}
							}
                           ?>  
				
						   <!-- <li class="main-header-menu-li has-sub">
                                    <a href="/backoffice/iloc/landownerConnect/create" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" aria-expanded="false">Sell / Lease Land</a>
                                    <ul class="">
                                        <li class="has-sub"><a href="javascript:void(0)" class="has_children">Land Requirement</a>
											<ul class="has-sub">
                                                <li><a href="/backoffice/iloc/landrequesterConnect/create" class="sf-with-ul">Add Land Requirements</a></li>
                                                <!--<li><a href="/backoffice/iloc/property/listing/landtype/Pvt" class="fancybox" data-fancybox-type="iframe">Search Available Lands</a></li>-->
												<!--<li><a href="/backoffice/iloc/property/advanceSearch" target="_blank">Search Govt. Land</a></li>
												<li><a href="/backoffice/iloc/property/listing/landtype/Pvt" target="_blank">Search Private Land</a></li>
												<li><a href="https://www.siidculsmartcity.com/ViewVacantPlot.aspx" target="_blank">Search SIIDCUL Land</a></li>
												<li><a href="<?php echo $basePath.'/site/PrivateIndustrialEstates';?>" target="_blank">Search Private Industrial Estates</a></li>
												<li><a href="<?php echo $basePath.'/site/specialIndustrialEstates';?>" target="_blank">Search Special Industrial Estates for Mega Projects</a></li>
												<li><a href="<?php echo $basePath.'/site/miniIndustrialEstates';?>" target="_blank">Search Mini Industrial Estates</a></li>
												<li><a href="https://www.siidculsmartcity.com/GIS/" target="_blank">Industrial Estate - GIS Search </a></li>
												<li><a href="<?php echo $basePath.'/site/builtUpSpace';?>" target="_blank">Search Built-up Area</a></li>
                                            </ul>
                                        </li>
                                        <li class="has-sub"><a href="javascript:void(0)" class="has_children">List Your Land For Lease</a>
											<ul class="has-sub">
                                                <li><a href="/backoffice/iloc/landownerConnect/create" class="sf-with-ul">Add Land <br/>Details</a></li>
                                                <li><a href="/backoffice/iloc/property/requirementListing" class="sf-with-ul">Search Land Requirements</a>
												</li>
                                                <li><a href="javascript:void(0)" data-toggle="modal" data-target="#guestLogin">Manage Listing</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="/backoffice/iloc/property/advertisement" target="_blank">Land Lease Video Advertisement</a></li>
                                         <li><a href="/themes/backend/uploads/GO_30_Nov_2016.pdf" target="_blank">UPZALR Land Lease Amendment</a></li>
                                         <li><a href="/themes/backend/uploads/UPZALR-Land-Lease-Amendment-2018.pdf" target="_blank">UPZALR Land Lease Amendment 2018</a></li>
                                         <li><a href="/themes/backend/uploads/User_Manual_Land_Owner_Connect_V1.0.pdf" target="_blank">Land Owner Connect - User Manual</a></li>
                                    </ul>
                                </li>
                                <li class="main-header-menu-li has-sub">
                                     <a href="javascript:void(0);">Investor's Corner</a>
									<ul> -->
										<!--<li class="has-sub indussummitLi"><a href="javascript:void(0);" class="has_children">Industrial Summit 2019</a>
											<ul class="has-sub indussummit">
												<li><a href="<?php //echo $basePath.'/site/conferenceFuture';?>" target="_blank" class="sf-with-ul">Proposed Programme</a></li>											
												<li><a href="/themes/backend/Uttarakhand_Industrial_Summit_2019_Brochure.pdf" target="_blank" class="sf-with-ul">Brochure</a></li>
											</ul>
										</li>-->
										
										<!-- <li class="has-sub indussummitLi DesLi"><a href="javascript:void(0);" class="has_children">Destination Uttarakhand 2018</a>
											<ul class="has-sub indussummit Des">
												<li><a href="<?php echo $basePath.'/site/announcedmou';?>" class="sf-with-ul">Announced MoU's</a></li>

												<li><a href="<?php echo $basePath.'/site/mouGroundingStatus';?>" class="sf-with-ul">MoU Grounding Status</a></li>
												<li><a href="<?php echo $basePath.'/site/FocusSector';?>" class="sf-with-ul">Investible Projects</a></li>
												<!--<li><a href="<?php echo $basePath.'/site/schedule';?>" class="sf-with-ul">Schedule</a></li>-->
												<!--<li><a href="<?php echo $basePath.'/backoffice/site/mobilelogin';?>" class="sf-with-ul">IP-Dept Login</a></li>
												<li class = "hd-block"><a href="#">Uttarakhand State Pitch Video</a></li>
											</ul>
										</li>
										<li class="indussummitLi DesLi"><a href="<?php echo $basePath.'/backoffice/globalEventMaster/index';?>" class="has_children">Outreach</a>
										</li> -->
										 <!--<li><a href="/wellness1" target="_blank">Uttarakhand Wellness Summit 2020</a></li>-->
										 
										 <!--<li class="has-sub indussummitLi"><a href="javascript:void(0);" class="has_children">Uttarakhand Roadshow in Japan 2020 </a>
											<ul class="has-sub indussummit">
										 <li><a href="/backoffice/ukJapanVisitUsers/registration" target="_blank">Registration Form for Participation (English)</a></li>
										 <li><a href="/backoffice/ukJapanVisitUsers/registration/lang/ja" target="_blank">å?‚åŠ ç™»éŒ²ãƒ•ã‚©ãƒ¼ãƒ ï¼ˆæ—¥æœ¬èªžï¼‰</a></li>
										 </ul>
										 </li>-->
										 <!--<li class="has-sub indussummitLi RdLi"><a href="javascript:void(0);">Uttarakhand Roadshow in Japan 2020 </a>
					<ul class="indussummit Rd" style="">
						<li><a href="/backoffice/ukJapanVisitUsers/registration" target="_blank">Registration Form for Participation (English)</a>
						</li>						
						<li><a href="/themes/backend/uploads/Uttarakhand Policy Brochure.pdf" target="_blank">Uttarakhand Policy Brochure</a>
						</li>
						<li><a href="/themes/backend/uploads/Uttarakhand Brochure.pdf" target="_blank">Uttarakhand State Brochure</a>
						</li>
						<li><a href="/backoffice/ukJapanVisitUsers/registration/lang/ja" target="_blank">å?‚åŠ ç™»éŒ²ãƒ•ã‚©ãƒ¼ãƒ ï¼ˆæ—¥æœ¬èªžï¼‰</a>
						</li>
						<li><a href="/themes/backend/uploads/Uttarakhand Policy Brochure - Japanese.pdf" target="_blank">ã‚¦ãƒƒã‚¿ãƒ©ãƒ¼ã‚«ãƒ³ãƒ‰å·žæ?¿ç­–ãƒ‘ãƒ³ãƒ•ãƒ¬ãƒƒãƒˆ </a>
						</li>
						<li><a href="/themes/backend/uploads/Uttarakhand Brochure- Japanese.pdf" target="_blank">ã‚¦ãƒƒã‚¿ãƒ©ãƒ¼ã‚«ãƒ³ãƒ‰å·žã?®ãƒ‘ãƒ³ãƒ•ãƒ¬ãƒƒãƒˆ</a>
						</li>
					</ul>
				</li>
									 </ul> 
									 
                                </li>-->
										  <!--  <li class="main-header-menu-li"><a href="/site/ProposalReport">Proposal Reports</a></li> -->
                  <!-- </ul>
				  </li> -->
				  <!-- <li class="main-header-menu-li has-sub">
					<a href="javascript:void(0);">Need Help</a>
					<ul class="has-sub indussummit Des"> 
						<li title ="Please login to Single Window Clearance System to raise a ticket for resolution of technical issue"><a href="<?php echo $basePath;?>/swcs/sample/one/action/signin" class="sf-with-ul">Facing Technical Issue With Online System (Ticket System)</a></li>
						<li><a href="<?php echo $basePath.'/query/open.php?guest=1';?>" class="sf-with-ul">Raise Your Query / Post Issue Or Suggestions</a></li>
						<li title ="Please login to Single Window Clearance System and click on Grievance to raise your grievances"><a href="<?php echo $basePath;?>/swcs/sample/one/action/signin" class="sf-with-ul">File Grievance</a></li>
						
					</ul>
				 </li>
                                 <li class="main-header-menu-li"><a href="/govt-covid19-comm">
                                 Important Govt. Communications Regarding COVID-19 Prevention</a></li>  -->
				  
	
    </div>
  </div>
</div>


			</div>
		</div>
	  </div>
	  <script>
		function roadShowMenuRemoveClass(){
			$('.RdLi').removeClass('indussummitLi');
			$('.Rd').removeClass('indussummit');
			$('.DesLi').removeClass('indussummitLi');
			$('.Des').removeClass('indussummit');
		};
		function roadShowMenuAddClass(){
			$('.RdLi').addClass('indussummitLi');
			$('.Rd').addClass('indussummit');
			$('.DesLi').addClass('indussummitLi');
			$('.Des').addClass('indussummit');
		};
		$(document).ready(function(){
			var wSize = $(window).innerWidth();
			if(wSize<1171){
				roadShowMenuRemoveClass();
			}
			else{
				roadShowMenuAddClass();
			}
		});
		$(window).resize(function(){
			var wSize = $(window).innerWidth();
			if(wSize<1171){
				roadShowMenuRemoveClass();
			}
			else{
				roadShowMenuAddClass();
			}
		});
	</script>
	  <!--<script>
		function roadShowMenuRemoveClass(){
			$('.RdLi').removeClass('indussummitLi');
			$('.Rd').removeClass('indussummit');
		};
		function roadShowMenuAddClass(){
			$('.RdLi').addClass('indussummitLi');
			$('.Rd').addClass('indussummit');
		};
		$(document).ready(function(){
			var wSize = $(window).innerWidth();
			if(wSize<1171){
				roadShowMenuRemoveClass();
			}
			else{
				roadShowMenuAddClass();
			}
		});
		$(window).resize(function(){
			var wSize = $(window).innerWidth();
			if(wSize<1171){
				roadShowMenuRemoveClass();
			}
			else{
				roadShowMenuAddClass();
			}
		});
	</script>-->
	  </header>
    <div class="clearfix"></div>

    
<div class="modal fade global-popup" id="hd-uttarakhand-state" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body text-center">
        <iframe width="800" height="450" src="https://www.youtube.com/embed/aADG8fI0S0o?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe> 
      </div>
    </div>
  </div>
</div>    
    
<script>
$(".hd-block").click(function() {
$("#hd-uttarakhand-state").modal();
});
</script>