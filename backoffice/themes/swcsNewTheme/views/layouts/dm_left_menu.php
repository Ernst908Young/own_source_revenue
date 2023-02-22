<style type="text/css">
    .page-sidebar .page-sidebar-menu li>a>.badge, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu li>a>.badge{
        right: 41px;
        top: 9px;
    }
</style>
<?php
$iconArray = array("icon-diamond", "icon-wallet", "icon-settings", "icon-puzzle", "icon-bulb", "icon-briefcase", "icon-fire", "icon-bar-chart", "icon-layers", "icon-feed", "icon-docs", "icon-folder", "icon-social-dribbble", "icon-note", "icon-graph", "icon-notebook", "icon-grid");
$appsModel = new ApplicationVerificationLevelExt;
$Pendingapp = $appsModel->getApplication($_SESSION['uid']);
$isNoodal = DefaultUtility::isNoodalOfficer();
?>
<ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
    <li class="sidebar-toggler-wrapper hide">
        <div class="sidebar-toggler">
            <span></span>
        </div>
    </li>
    <li class="nav-item start open">
        <a href="<?= Yii::app()->createAbsoluteUrl('/admin'); ?>" class="nav-link nav-toggle">
            <i class="icon-home"></i>
            <span class="title">Dashboard</span>
            <span class="selected"></span>
        </a>
    </li>
    <li class="nav-item">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-bulb"></i>
            <span class="title">Nodal Officers List</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu" style="display: none;">
            <li class="nav-item  ">
                <a href="/backoffice/mis/boApplicationSubmission/GMList" class="nav-link ">
                    <span class="title">DIC GM</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="/backoffice/mis/boApplicationSubmission/StateNodalList" class="nav-link ">
                    <span class="title">SWA State Nodal</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="/backoffice/mis/boApplicationSubmission/DistrictNodalList" class="nav-link ">
                    <span class="title">SWA District Nodal</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="/backoffice/mis/boApplicationSubmission/userlist/ut/NjQ=/title/EoDB District Level Nodal Officer" class="nav-link ">
                    <span class="title">EODB Nodal</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="/backoffice/mis/boApplicationSubmission/userlist/ut/NjI=/title/Head Of Department - User List" class="nav-link ">
                    <span class="title">Panel - Department</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="/backoffice/mis/boApplicationSubmission/userlist/ut/NzE=/title/Secretary Panel - User List" class="nav-link ">
                    <span class="title">Panel - Secretary</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="https://www.doiuk.org/easeofdoingbusiness.php" target="_blank" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">Existing Units List</span>
                </a>
            </li>
           


        </ul>
    </li>
     <!-- LAND LEASE LINK : Added By Rahul Kumar 27022018 ---> 
       <li class="nav-item">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-building-o"></i>
            <span class="title">Land Lease</span>
            <span class="arrow"></span>
        </a>
     <ul class="sub-menu" style="display: none;">
            <li class="nav-item ">
                <a href="<?php echo Yii::app()->createAbsoluteUrl('iloc/landownerConnect/create');?>" class="nav-link nav-toggle">
                    <i class="fa fa-map-marker"></i>
                    <span class="title">Add Land Details</span>
                </a>
            </li>
            <li class="nav-item ">
                <a href="<?php echo Yii::app()->createAbsoluteUrl('iloc/landownerConnect'); ?>" class="nav-link nav-toggle">
                    <i class="fa fa-building-o"></i>
                    <span class="title">Manage Land Listing</span>
                </a>
            </li>
            <li class="nav-item ">
                <a href="<?php echo Yii::app()->createAbsoluteUrl('iloc/landownerMessage/inbox'); ?>" class="nav-link nav-toggle">
                    <i class="fa fa-inbox"></i>
                    <span class="title">Messages</span>
                </a>
            </li>
             <li class="nav-item ">
                <a href="/themes/backend/uploads/LAND_LEASE_GUIDELINES_FOR_DM.pdf" class="nav-link nav-toggle">
                    <i class="fa fa-file-pdf-o"></i>
                    <span class="title">Land Lease Guideline Doc</span>
                </a>
            </li>
            </ul>
           </li>
		<li class="nav-item start open">
			<a href="/backoffice/mis/serviceMapping/l1/FY/ALL/swcs_status/both" class="nav-link nav-toggle">
				<i class="fa fa-file"></i>
				<span class="title">Service Report</span>
				<span class="selected"></span>
			</a>
		</li>   
            <!--LAND LEASE LINK : End Of Adding- Rahul Kumar 27022018 --->  
</ul>