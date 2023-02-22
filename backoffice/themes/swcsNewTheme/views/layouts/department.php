<?php $hideDashboardLinkRoleArray = array('85','82'); ?>


<style type="text/css">
    .page-sidebar .page-sidebar-menu li>a>.badge, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu li>a>.badge{
        right: 41px;
        top: 9px;
    }
    <?php if (RolesExt::isIpAdmin()) { ?>
        .page-sidebar.navbar-collapse.collapse {display: none !important;}
        .page-content{margin-left:0px !important;}

    <?php } ?>
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
    <?php if (DefaultUtility::is_PRINCIPAL_SECRETARY() || DefaultUtility::is_CHEIF_SECRETARY()) { ?>

        <li class="nav-item start open">
            <a href="<?= Yii::app()->createAbsoluteUrl('admin'); ?>" class="nav-link nav-toggle">
                <i class="icon-home"></i>
                <span class="title">Overall Dashboard</span>
                <span class="selected"></span>
            </a>
        </li>
        <?php } if (DefaultUtility::is_PRINCIPAL_SECRETARY() || DefaultUtility::is_CHEIF_SECRETARY()) {
        ?>  
        <li class="nav-item start open">
            <a href="<?= Yii::app()->createAbsoluteUrl('mis/psReport/dashboard'); ?>" class="nav-link nav-toggle">
                <i class="icon-home"></i>
                <span class="title">Department's Dashboard</span>
                <span class="selected"></span>
            </a>
        </li>
        <li class="nav-item start open">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-layers"></i>
                <span class="title">In-Principle Reports</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item ">
                    <a href="<?= $this->createUrl('/mis/boApplicationSubmission/newoverallreport') ?>" class="nav-link nav-toggle">
                        <i class="icon-settings"></i>
                        <span class="title">Overall Caf</span>
                        <span class="selected"></span>
                    </a>
                </li>


                <li class="nav-item  ">
                    <a href="<?= $this->createUrl('/mis/boApplicationSubmission/CategoryWiseInvestment') ?>" class="nav-link nav-toggle">
                        <i class="icon-settings"></i>
                        <span class="title">Category Wise</span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="<?= $this->createUrl('/mis/boApplicationSubmission/IndustryWiseReport') ?>" class="nav-link nav-toggle">
                        <i class="icon-settings"></i>
                        <span class="title">Industry Wise</span>
                        <span class="selected"></span>
                    </a>

                </li>
                <li class="nav-item">

                    <a href="<?= $this->createUrl('/mis/boApplicationSubmission/NICCodeReport') ?>" class="nav-link ">
                        <i class="icon-bulb"></i>
                        <span class="title">Manufacturing-2 Digit</span>
                    </a>
                </li>
                <li class="nav-item  ">

                    <a href="<?= $this->createUrl('/mis/boApplicationSubmission/NICCodeServiceReport') ?>" class="nav-link ">
                        <i class="icon-bulb"></i>
                        <span class="title">Service-2 Digit</span>
                    </a>
                </li>
            </ul>
        </li>


        <li class="nav-item  ">
            <a href="<?= $this->createUrl('/admin/adminTasks/viewAllUsers') ?>" class="nav-link nav-toggle">
                <i class="icon-puzzle"></i>
                <span class="title">Investor List</span>
            </a>
        </li>
    <?php
    } else {
        if (!in_array($_SESSION['role_id'], $hideDashboardLinkRoleArray)) {
            ?>
            <li class="nav-item start open" id="hide_me_li">
                <a href="<?= Yii::app()->createAbsoluteUrl('/admin'); ?>" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                </a>
            </li>

        <?php } ?>
    <?php } ?>
<?php if (DefaultUtility::isValidDocumentVerifierLogin()) { ?>
        <li class="nav-item start open">
            <a href="<?= Yii::app()->createAbsoluteUrl('/dms/DepartmentDMS/ViewDMSIs'); ?>" class="nav-link nav-toggle">
                <i class="icon-layers"></i>
                <span class="title">Applications Processed</span>
                <span class="arrow"></span>
            </a>
        </li>
    <?php } else if(RolesExt::isIwDataEntry() && $_SESSION['uid']==865) { ?>
        
     
            <li class="nav-item  ">
                <a href="<?= $this->createUrl('/infowizard/infowizardFormvariableMaster/create') ?>" class="nav-link ">
                    <span class="title">Form Field Master</span>
                </a>
            </li>

            <li class="nav-item  ">
                <a href="<?= $this->createUrl('/infowizard/formCategory') ?>" class="nav-link ">
                    <span class="title">Category Master</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?= $this->createUrl('/infowizard/formTypes') ?>" class="nav-link ">
                    <span class="title">Form Type Master</span>
                </a>
            </li>

            <li class="nav-item  ">
                <a href="<?= $this->createUrl('/infowizard/serviceFormMapping/create') ?>" class="nav-link ">
                    <span class="title">Sub Form - Step 1</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="<?= $this->createUrl('/infowizard/subForm/subFormListing/startPaging/1/endPaging/10') ?>" class="nav-link ">
                    <span class="title">Sub Form - Page Category Mapping & Form Genrator</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="<?= $this->createUrl('/infowizard/serviceFormWorkflow/creation/service_id//workflowID/1/id/0') ?>" class="nav-link ">
                    <span class="title">Sub Form - Workflow Configurator</span> 
                </a>
            </li>
            <li class="nav-item  ">
                <a href="<?= $this->createUrl('/infowizard/FormBuilderConfiguration/create/department_id/1') ?>" class="nav-link ">
                    <span class="title">Sub Form - Workflow Configurator-2 </span> 
                </a>
            </li>
      

        
    <?php 
    } else if (RolesExt::isHelpdeskUser()) {
        $dept_id = base64_encode($_SESSION['uid']);
        $department_email = $_SESSION['email'];
        ?> 
        <li class="nav-item start open">
            <a href="<?php echo FRONT_BASEURL; ?>backoffice/admin/default/index"  class="nav-link nav-toggle">
                <i class="fa fa-file"></i>
                <span class="title">Ticket Management System</span>
                <span class="selected"></span>
            </a>
        </li>
        <li class="nav-item start open">
            <a href="<?php echo FRONT_BASEURL; ?>backoffice/admin/default/query"  class="nav-link nav-toggle">
                <i class="fa fa-file"></i>
                <span class="title">Query Management System</span>
                <span class="selected"></span>
            </a>
        </li>
        <li class="nav-item start open">
            <a href="<?php echo FRONT_BASEURL; ?>backoffice/messages/messages/inbox" class="nav-link nav-toggle">
                <i class="icon-layers"></i> 
                <span class="title">Messages</span>
                <span class="arrow"></span>
            </a>
        </li>
        <li class="nav-item start open">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-layers"></i>
                <span class="title">Self Service Desk</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item start open">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-layers"></i>
                        <span class="title">Ask a Question to our team (Query System)</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item start open">
                            <a target="_blank" href="<?php echo FRONT_BASEURL . "query/open.php"; ?>"  class="nav-link nav-toggle">
                                <i class="fa fa-file"></i>
                                <span class="title">Ask Question</span>
                                <span class="selected"></span>
                            </a>
                        </li>
                        <li class="nav-item start open">
                            <a target="_blank" href="<?php echo FRONT_BASEURL . "backoffice/query/query/search"; ?>" class="nav-link nav-toggle">
                                <i class="fa fa-file"></i>
                                <span class="title">View Asked Questions</span>
                                <span class="selected"></span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item start open">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-layers"></i>
                        <span class="title">Facing Trouble (Ticket System)</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item start open">
                            <a href="<?php echo FRONT_BASEURL . 'ticket/open.php?dept_uid=' . $dept_id; ?>"   class="nav-link nav-toggle">
                                <i class="fa fa-file"></i>
                                <span class="title">Create Ticket</span>
                                <span class="selected"></span>
                            </a>
                        </li>
                        <li class="nav-item start open"> 
                            <a  href="<?php echo FRONT_BASEURL . 'ticket/autologin.php?luser=' . $department_email . '&flag=view&type=departmental'; ?>" class="nav-link nav-toggle">
                                <i class="fa fa-file"></i>
                                <span class="title">View My Tickets</span>
                                <span class="selected"></span>
                            </a>
                        </li>
                        <li class="nav-item start open"> 
                            <a  href="<?php echo FRONT_BASEURL . 'ticket/autologin.php?luser=' . $department_email . '&flag=all&type=departmental'; ?>" class="nav-link nav-toggle">
                                <i class="fa fa-file"></i>
                                <span class="title">View All Tickets</span>
                                <span class="selected"></span> 
                            </a>
                        </li>

                    </ul>
                </li>


            </ul>
        </li>
        <li>
<a href="<?php echo FRONT_BASEURL; ?>backoffice/messages/messages/chat" class="nav-link nav-toggle">
                        <i class="icon-layers"></i> 
                        <span class="title">Live Chat</span>
                        <span class="arrow"></span>
                    </a></li>


        <style>
            #hide_me_li{display:none;}
        </style>
<?php } else if (RolesExt::isIwDataEntry() && $_SESSION['uid']==654) { ?>
        <li class="nav-item start open"><a href="<?= $this->createUrl('/infowizard/actMaster') ?>" class="nav-link "><span class="title">Act Master</span></a></li>
        <li class="nav-item start open"><a href="<?= $this->createUrl('/infowizard/infowizardFormvariableMaster/create') ?>" class="nav-link "><span class="title">Form-Field Master</span></a></li>             
        <li class="nav-item start open"><a href="<?= $this->createUrl('/infowizard/infowizardQuestionMaster/listQuestion') ?>" class="nav-link "><span class="title">Questions</span></a></li>
        <li class="nav-item start open"><a href="<?= $this->createUrl('/infowizard/infowizardQuesansMapping/listquestionanswer') ?>" class="nav-link "><span class="title">Questions/Answers</span></a></li>
		<li class="nav-item start open"><a href="<?= $this->createUrl('/infowizard/iwApplyService') ?>" class="nav-link "><span class="title">Apply Incentive Service</span></a></li>
		<li class="nav-item start open"><a href="<?= $this->createUrl('/infowizard/iwApplyService/lmInspectionUpload') ?>" class="nav-link "><span class="title">Upload LM Inspection Report</span></a></li>
		<li class="nav-item start open"><a href="<?= $this->createUrl('/infowizard/iwApplyService/listLmReport') ?>" class="nav-link "><span class="title">List LM Inspection Reports</span></a></li>
		<li class="nav-item start open"><a href="<?= $this->createUrl('/infowizard/iwApplyService/lmApprovalCertificateUpload') ?>" class="nav-link "><span class="title">Upload LM Approval Certificates</span></a></li>
		<li class="nav-item start open"><a href="<?= $this->createUrl('/infowizard/iwApplyService/listLmApprovalCertificate') ?>" class="nav-link "><span class="title">List LM Approval Certificates</span></a></li>
		
		<li class="nav-item start open"><a href="<?= $this->createUrl('/infowizard/IwApplyService/lmIndex') ?>" class="nav-link "><span class="title">Apply for Legal Metrology Service</span></a></li>
		
        <?php
    } else if(RolesExt::isIwDataEntry() && $_SESSION['uid']==823) { ?>
		
		<li class="nav-item start open"><a href="<?= $this->createUrl('/infowizard/IwApplyService/lmIndex') ?>" class="nav-link "><span class="title">Apply for Legal Metrology Service</span></a></li>
		
	<?php } else if ($_SESSION['role_id'] == '83') {
        ?>
        <li class="nav-item start open">
            <a href="/backoffice/infowizard/subForm/processedApplication" class="nav-link nav-toggle">
                <i class="fa fa-file"></i>
                <span class="title">Processed Application</span>
                <span class="selected"></span>
            </a>
        </li>
        <?php
    } else if ($_SESSION['role_id'] == '85') {
        ?>
        <li class="nav-item start open">
            <a href="/backoffice/mis/serviceMapping/l1/FY/ALL/swcs_status/both" title="View Application" ><i class="fa fa-file"></i>Service Report </a>
        </li>

        <li class="nav-item start open">
            <a href="http://investuttarakhand.co.in/themes/backend/uploads/Service_Integration_Steps_API_Ver2.0.pdf"  target="_blank"><i class="fa fa-file"></i>SWCS API KIT</a>
        </li>

        <li class="nav-item start open">
            <a href="/themes/backend/uploads/Integration_Kit_MIS_Sync_DeptPortal_with_SWCS_V1.1.pdf"  target="_blank"><i class="fa fa-file"></i>MIS Integration Kit</a>
        </li>
        <li class="nav-item start open">
            <a href="/backoffice/admin/viewAPIAccessLog/VendorApiLogs" title="Mis SYNC Api Log" ><i class="fa fa-file"></i>Mis SYNC Api Log</a>
        </li>
    <?php
} else if ($_SESSION['role_id'] == '79') {
    ?>
        <li class="nav-item start open">
            <a href="/backoffice/PisMou/create" class="nav-link nav-toggle">
                <i class="fa fa-file"></i>
                <span class="title">Manage PIS MoU Detail</span>
                <span class="selected"></span>
            </a>
        </li>
    <?php
} else if ($_SESSION['role_id'] == '84') {
    ?>
        <li class="nav-item start open">
            <a href="/backoffice/infowizard/subForm/deptProcessedApp" class="nav-link nav-toggle">
                <i class="fa fa-file"></i>
                <span class="title">Processed Application</span>
                <span class="selected"></span>
            </a>
        </li>
    <?php } else {
    ?>
    <?php
    if (!(DefaultUtility::isSMSSender() || DefaultUtility::isSubAdmin() || DefaultUtility::isHODNodal() || DefaultUtility::isSECRETARY() || DefaultUtility::is_PRINCIPAL_SECRETARY() || DefaultUtility::is_CHEIF_SECRETARY() )) {
        ?>
            <li class="nav-item start open">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">Reports</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item ">
                        <a href="<?= Yii::app()->createAbsoluteUrl('mis/nodalreport') ?>" class="nav-link ">
                            <span class="title">CAF Applications</span>
                        </a>
                    </li>
        <?php
        if (DefaultUtility::isStateCommentLevelUser()) {
            echo '<li class="nav-item">
					      <a href="' . Yii::app()->createAbsoluteUrl('mis/nodalreport/districtwisenodalcafreport') . '" class="nav-link">
					      <span class="title">District wise CAF</span>
					      </a>
					  </li>';
        }
        ?>
                    <?php
                    if (DefaultUtility::isDisttApproverUser()) {
                        echo '
		<li class="nav-item ">
     		<a href="' . Yii::app()->createAbsoluteUrl('admin/landAllotmentView/applicationDetailRankWise') . '" class="nav-link ">
     			<span class="title">Allotment by Evaluation Criteria</span>
     		</a>
     	</li>
     	<li class="nav-item ">
     		<a href="' . Yii::app()->createAbsoluteUrl('admin/landAllotmentView/applicationDetailDateWise') . '" class="nav-link ">
     			<span class="title">Allotment by Submission Date&Time</span>
     		</a>
     	</li>';
                    }
                    ?>

                    <!--	<li class="nav-item ">
                              <a href="<?= Yii::app()->createAbsoluteUrl('/mis') ?>" class="nav-link ">
                                      <span class="title"> MIS</span>
                              </a>
                      </li>-->
                </ul>
            </li>
        <?php echo '<li class="nav-item start open">
			      <a href="' . Yii::app()->createAbsoluteUrl('/Profile/viewUpdate/otp') . '" class="nav-link nav-toggle">
			      <i class="icon-cloud-upload"></i>
			      <span class="title">Verify Contact Detail</span>
			      </a>
			  </li>'; ?>
            <?php
        }

        if (DefaultUtility::isSMSSender()) {
            echo '<li class="nav-item start open">
			      <a href="' . Yii::app()->createAbsoluteUrl('/admin/sendSMS') . '" class="nav-link nav-toggle">
			      <i class="icon-cloud-upload"></i>
			      <span class="title">Send SMS</span>
			      </a>
			  </li>';
        }
        if (DefaultUtility::isStateNodalUser()) {
            echo '<li class="nav-item start open">
			      <a href="' . Yii::app()->createAbsoluteUrl('/appeal/listAppeals') . '" class="nav-link nav-toggle">
			      <i class="icon-cloud-upload"></i>
			      <span class="title">Appeals</span>
			      </a>
			  </li>
				<li class="nav-item start open">
			      <a href="' . Yii::app()->createAbsoluteUrl('/admin/mom') . '" class="nav-link nav-toggle">
			      <i class="icon-cloud-upload"></i>
			      <span class="title">Minutes of Meetings</span>
			      </a>
			  </li>';
        } else if (!($isNoodal || DefaultUtility::isSubAdmin() || DefaultUtility::isHODNodal() || DefaultUtility::isSECRETARY() || DefaultUtility::is_PRINCIPAL_SECRETARY() || DefaultUtility::is_CHEIF_SECRETARY())) {
            /* echo '<li class="nav-item start open">
              <a href="'.Yii::app()->createAbsoluteUrl('/admin/uploadDocuments').'" class="nav-link nav-toggle">
              <i class="icon-cloud-upload"></i>
              <span class="title">Upload In-Principle</span>
              </a>
              </li> */
            echo ' <li class="nav-item start open">
			      <a href="' . Yii::app()->createAbsoluteUrl('Grievance/grievanceUpdate') . '" class="nav-link nav-toggle"> 
			      <i class="icon-question"></i>
			      <span class="title">Grievance</span>
			      </a>
			  </li>';
            $pCount = 0;
            echo '<li class="nav-item start open">
			      <a href="javascript:;" class="nav-link nav-toggle">
				      <i class="icon-bell"></i>
	     			  <span class="title">Pending</span>
	     			  <span class="badge badge-danger pBadge">0</span>
				      <span class="arrow"></span>
			      </a>';
            // echo "<pre>";print_r($Pendingapp);die;
            if (!empty($Pendingapp)) {
                echo "<ul class='sub-menu'>";
                foreach ($Pendingapp as $app) {
                    $pCount++;
                    $app_name = ApplicationExt::getAppNameViaId($app['application_id']);
                    //	echo '<li class="nav-item ">
                    //  		<a href="'.Yii::app()->createUrl('admin/ApplicationView/applicationfulldetail/app_sub_id/')."/".$app['app_sub_id'].'" class="nav-link ">
                    //		<span class="title"> '.$app_name['application_name']. '-'.$app['app_sub_id'].'</span>
                    //	</a>
                    //	</li>';
                }
                echo "</ul>";
            }
            echo "</li>";
        } else if (DefaultUtility::isSubAdmin()) {
            echo '<li class="nav-item start open">
			      <a href="javascript:;" class="nav-link nav-toggle">
				      <i class="icon-user"></i>
	     			  <span class="title">HOD User</span>
				      <span class="arrow"></span>
			      </a>
			      <ul class="sub-menu">
			      	<li class="nav-item ">
			      		<a href="' . Yii::app()->createUrl('admin/user/createHODUser') . '" class="nav-link ">Create</a>
			      	</li>
			      	<li class="nav-item ">
			      		<a href="' . Yii::app()->createUrl('admin/user/listHODUser') . '" class="nav-link ">Manage</a>
			      	</li>
			      </ul>';
            echo ' <li class="nav-item start open">
			      <a href="' . Yii::app()->createAbsoluteUrl('admin/InvestorDetail') . '" class="nav-link nav-toggle">
			      <i class="icon-bell"></i>
			      <span class="title">Activate Investor</span>
			      </a>
			   </li>';
            echo ' <li class="nav-item start open">
			      <a href="' . Yii::app()->createAbsoluteUrl('admin/ApplicationActivity/ArchiveCAF') . '" class="nav-link nav-toggle">
			      <i class="icon-bell"></i>
			      <span class="title">Archive CAF</span>
			      </a>
			   </li>';


            echo '<li class="nav-item start open">
			      <a href="javascript:;" class="nav-link nav-toggle">
				      <i class="icon-user"></i>
	     			  <span class="title">Survey</span>
				      <span class="arrow"></span>
			      </a>
			      <ul class="sub-menu">
			      	
			      	<li class="nav-item ">
			      		<a href="' . Yii::app()->createUrl('/survey/surveyQuestionAnswerMapping') . '" class="nav-link ">Manage Question Answer</a>
			      	</li>
			      	<li class="nav-item ">
			      		<a href="' . Yii::app()->createUrl('/survey/Survey') . '" class="nav-link ">View / Create Survey</a>
			      	</li></ul>';


            echo '<li class="nav-item start open">
			      <a href="javascript:;" class="nav-link nav-toggle">
				      <i class="icon-user"></i>
	     			  <span class="title">Feedack</span>
				      <span class="arrow"></span>
			      </a>
			      <ul class="sub-menu">
			      	
			      	<li class="nav-item ">
			      		<a href="' . Yii::app()->createUrl('/feedback/feedbackCategory') . '" class="nav-link ">Category Management</a>
			      	</li>
			      	<li class="nav-item ">
			      		<a href="' . Yii::app()->createUrl('/feedback/feedbackQuestionAnswerMapping') . '" class="nav-link ">Question Answer Management</a>
			      	</li>
			      	<li class="nav-item ">
			      		<a href="' . Yii::app()->createUrl('/feedback/feedbackForms') . '" class="nav-link ">Create Feedback</a>
			      	</li>



			      </ul>';
        } elseif (DefaultUtility::isHODNodal() || DefaultUtility::isSECRETARY()) {
            echo '<li class="nav-item start open">
	   	<a href="' . Yii::app()->createAbsoluteUrl('/user/indexState') . '" class="nav-link nav-toggle">
	   	<i class="icon-globe"></i>
		   	 <span class="title">Manage State Level Nodal</span>
	      <span class="selected"></span>
	      </a>
	   </li>
	   <li class="nav-item start open">
	      <a href="' . Yii::app()->createAbsoluteUrl('/user/indexDistrict') . '" class="nav-link nav-toggle">
	      <i class="icon-globe"></i>
	      <span class="title">Manage District Level Nodal</span>
	      <span class="selected"></span>
	      </a>
	   </li>
           <!--<li class="nav-item start open">
	   	<a href="' . Yii::app()->createAbsoluteUrl('/mis/ranking') . '" class="nav-link nav-toggle">
	   	<i class="icon-globe"></i>
		   	 <span class="title">Department Ranking</span>
	      <span class="selected"></span>
	      </a>
	   </li>-->';
            ?>
            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-bulb"></i>
                    <span class="title">Nodal Officers List</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="<?= $this->createUrl('/mis/boApplicationSubmission/GMList') ?>" class="nav-link ">
                            <span class="title">DIC GM</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?= $this->createUrl('/mis/boApplicationSubmission/StateNodalList') ?>" class="nav-link ">
                            <span class="title">SWA State Nodal</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?= $this->createUrl('/mis/boApplicationSubmission/DistrictNodalList') ?>" class="nav-link ">
                            <span class="title">SWA District Nodal</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?php $role = base64_encode(64);
        echo $this->createUrl("/mis/boApplicationSubmission/userlist/ut/$role/title/EoDB District Level Nodal Officer") ?>" class="nav-link ">
                            <span class="title">EODB Nodal</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?php $role = base64_encode(62);
        echo $this->createUrl("/mis/boApplicationSubmission/userlist/ut/$role/title/Head Of Department - User List"); ?>" class="nav-link ">
                            <span class="title">Panel - Department</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?php $role = base64_encode(71);
        echo $this->createUrl("/mis/boApplicationSubmission/userlist/ut/$role/title/Secretary Panel - User List"); ?>" class="nav-link ">
                            <span class="title">Panel - Secretary</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item start open">
                <a href="javascript:void(0)" title="View Application" class="nav-link policybenchmark">
                    <span class="title"><i class="fa-gavel fa"></i> Policy Benchmark Report</span>        			    	    </a>
                <form action="http://uksubsidy.in/production/department-dashboard" class="nav-link " method="POST" target="_blank" id="policybenchmark">
                    <input type="hidden" name="token" value="<?php echo strtotime(date('Y-m-d H:i:s')) . "-" . ($_SESSION['uid'] + date('Y')); ?>" >
                    <input type="hidden" name="department_user_id" value="<?php echo base64_encode($_SESSION['uid']); ?>">
                </form>         
            </li>
            <li class="nav-item  ">
                <a href="https://www.doiuk.org/easeofdoingbusiness.php" target="_blank" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">Existing Units List</span>
                </a>
            </li>
        <?php
        if (DefaultUtility::isHODNodal()) {
//echo "<!--<pre> 04040404"; print_r($_SESSION); echo "</pre>-->"; 
            ?>	 
                  <!--<li class="nav-item start open">       <a href="javascript:void(0)" title="View Application" class="nav-link publicconsultancy">           <span class="title"><i class="fa-gavel fa"></i> Public Consultation</span>        			    	    </a>    <form action="http://www.ukpublicconsultation.in/admin/index" class="nav-link " method="POST" target="_blank" id="publicconsultancy">        <input type="hidden" name="access_token" value="<?php echo @$_SESSION['token']; ?>" >        <input type="hidden" name="user_id" value="<?php echo $_SESSION['uid']; ?>">				 <input type="hidden" name="department_id" value="<?php echo $_SESSION['dept_id']; ?>">		 		  <input type="hidden" name="user_name" value="<?php echo $_SESSION['uname']; ?>">		  <?php //print_r($_SESSION);  ?>    </form>            </li>-->
                <li class="nav-item start open">   
            <?php //print_r($_SESSION); ?>
                    <a href="javascript:void(0)" title="View Application" class="nav-link publicconsultancy">  
                        <span class="title"><i class="fa-gavel fa"></i> Public Consultation</span>   
                    </a>    <form action="http://www.ukpublicconsultation.in/admin/index" class="nav-link " method="POST" target="_blank" id="publicconsultancy"> 
                        <input type="hidden" name="access_token" value="<?php echo @$_SESSION['token']; ?>" > 
                        <input type="hidden" name="email" value="<?php echo @$_SESSION['email']; ?>" >   
                        <input type="hidden" name="user_id" value="<?php echo @$_SESSION['uid']; ?>">	
                        <input type="hidden" name="department_id" value="<?php echo @$_SESSION['dept_id']; ?>">
                        <input type="hidden" name="department_name" value="<?php $departmentData = UserExt::getUserDept($_SESSION['uid']);
            echo @$departmentData['department_name']; ?>">
                        <input type="hidden" name="user_name" value="<?php echo @$_SESSION['uname']; ?>">	
                        <input type="hidden" name="mobile" value="<?php echo @$_SESSION['mobile']; ?>">
                        <input type="hidden" name="role_id" value="<?php echo @$_SESSION['role_id']; ?>"> 

            <?php //print_r($_SESSION);  ?>    </form>            </li>
            <?php echo '<li class="nav-item">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-building-o"></i>
            <span class="title">Land Lease</span>
            <span class="arrow"></span>
        </a>
     <ul class="sub-menu" style="display: none;">
     <li class="nav-item">
			      <a href="' . Yii::app()->createAbsoluteUrl('iloc/landownerConnect/create') . '" class="nav-link nav-toggle">
			      <i class="fa fa-map-marker"></i>
			      <span class="title">Add Land Details</span>
			      </a>
			  </li>
                          <li class="nav-item">
			      <a href="' . Yii::app()->createAbsoluteUrl('iloc/landownerConnect') . '" class="nav-link nav-toggle">
			      <i class="fa fa-building-o"></i>
			      <span class="title">Manage Land Listing</span>
			      </a>
			  </li>
                          <li class="nav-item ">
                <a href="' . Yii::app()->createAbsoluteUrl('iloc/landownerMessage/inbox') . '" class="nav-link nav-toggle">
                    <i class="fa fa-inbox"></i>
                    <span class="title">Messages</span>
                </a>
            </li>
            </ul>
            </li>
            


'; ?>
                <li class="nav-item">   
                    <a href="/backoffice/mis/serviceMapping/l1/FY/ALL/swcs_status/both" title="View Application" ><i class="fa fa-file"></i>Service Report </a>

                </li> <?php }
        ?>
            <?php if (DefaultUtility::isSECRETARY()) { ?>

                <li class="nav-item">   
                    <a href="/backoffice/mis/serviceMapping/l1/FY/ALL/swcs_status/both" title="View Application" ><i class="fa fa-file"></i>Service Report </a>

                </li>



            <?php } ?>
        <?php //if(DefaultUtility::isSECRETARY() || DefaultUtility::isHODNodal() || DefaultUtility::is_PRINCIPAL_SECRETARY() ){ 

        if (DefaultUtility::isHODNodal() || DefaultUtility::isSECRETARY()) {
            ?> 
                <li class="nav-item">   
                    <a href="/backoffice/PisMou/hodIndex/page/admin_listing1" title="View PIS/MOU" ><i class="fa fa-file"></i>Investor Summit</a>

                </li> <?php } ?>
            <?php
            echo '<li class="nav-item start open" style="display:none;">
      <a href="javascript:;" class="nav-link nav-toggle">
	      <i class="icon-layers"></i>
	      <span class="title">Reports</span>
	      <span class="arrow"></span>
      </a>
      <ul class="sub-menu">
      
      	<li class="nav-item">
					      <a href="' . Yii::app()->createAbsoluteUrl('mis/hodreport/districtwisenodalcafreport') . '" class="nav-link">
					      <span class="title">Distirct Level Overall CAF</span> 
					      </a>
					  </li>
                                          	<li class="nav-item ">
      		<a href="' . Yii::app()->createAbsoluteUrl('mis/CsReport/overallstate') . '" class="nav-link ">
      			<span class="title">State Level Overall CAF</span>
      		</a>
      	</li>
                                          
<li class="nav-item">
					      <a href="' . Yii::app()->createAbsoluteUrl('mis/boApplicationSubmission/PendencyreportHod/days/0/daysto/10000') . '" class="nav-link">
					      <span class="title">District Level Pending CAF </span>
					      </a>
					  </li>
                                          
<li class="nav-item">
					      <a href="' . Yii::app()->createAbsoluteUrl('mis/boApplicationSubmission/PendencyreportHodState/days/0/daysto/10000') . '" class="nav-link">
					      <span class="title">State Level Pending CAF </span>
					      </a>
					  </li>
                                          
<li class="nav-item">
					      <a href="' . Yii::app()->createAbsoluteUrl('mis/hodreport/disposeddistrict?financial_year=2017-2018') . '" class="nav-link">
					      <span class="title">District Level: CAF disposed with comments  </span>
					      </a>
					  </li>
<li class="nav-item">
					      <a href="' . Yii::app()->createAbsoluteUrl('mis/CsReport/districtdisposedwithoutcomment/fID/2017-2018') . '" class="nav-link">
					      <span class="title">District Level: CAF disposed without comments </span>
					      </a>
					  </li>
                                          <li class="nav-item">
					      <a href="' . Yii::app()->createAbsoluteUrl('mis/CsReport/index/fID/2017-2018') . '" class="nav-link">
					      <span class="title">State Level: CAF disposed with comments</span>
					      </a>
					  </li>
                                          <li class="nav-item">
					      <a href="' . Yii::app()->createAbsoluteUrl('mis/CsReport/statedisposedwithoutcomment/fID/2017-2018') . '" class="nav-link">
					      <span class="title">State Level: CAF disposed without comments </span>
					      </a>
					  </li>';
        } elseif (DefaultUtility::is_PRINCIPAL_SECRETARY()) {

            echo '  <!--<li class="nav-item start open">
	   	<a href="' . Yii::app()->createAbsoluteUrl('/user/indexState') . '" class="nav-link nav-toggle">
	   	<i class="icon-globe"></i>
		   	 <span class="title">Manage State Level Nodal</span>
	      <span class="selected"></span>
	      </a>
	   </li>
	   <li class="nav-item start open">
	      <a href="' . Yii::app()->createAbsoluteUrl('/user/indexDistrict') . '" class="nav-link nav-toggle">
	      <i class="icon-globe"></i>
	      <span class="title">Manage District Level Nodal</span>
	      <span class="selected"></span>
	      </a>
	   </li>
          <li class="nav-item start open">
	   	<a href="' . Yii::app()->createAbsoluteUrl('/mis/ranking') . '" class="nav-link nav-toggle">
	   	<i class="icon-globe"></i>
		   	 <span class="title">Department Ranking</span>
	      <span class="selected"></span>
	      </a>
	   </li>-->';
            ?>

            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-bulb"></i>
                    <span class="title">Nodal Officers List</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="<?= $this->createUrl('/mis/boApplicationSubmission/GMList') ?>" class="nav-link ">
                            <span class="title">DIC GM</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?= $this->createUrl('/mis/boApplicationSubmission/StateNodalList') ?>" class="nav-link ">
                            <span class="title">SWA State Nodal</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?= $this->createUrl('/mis/boApplicationSubmission/DistrictNodalList') ?>" class="nav-link ">
                            <span class="title">SWA District Nodal</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?php $role = base64_encode(64);
        echo $this->createUrl("/mis/boApplicationSubmission/userlist/ut/$role/title/EoDB District Level Nodal Officer") ?>" class="nav-link ">
                            <span class="title">EODB Nodal</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?php $role = base64_encode(62);
        echo $this->createUrl("/mis/boApplicationSubmission/userlist/ut/$role/title/Head Of Department - User List"); ?>" class="nav-link ">
                            <span class="title">Panel - Department</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?php $role = base64_encode(71);
        echo $this->createUrl("/mis/boApplicationSubmission/userlist/ut/$role/title/Secretary Panel - User List"); ?>" class="nav-link ">
                            <span class="title">Panel - Secretary</span>
                        </a>
                    </li>

                </ul>
            </li> <li class="nav-item start open">
                <a href="<?php echo Yii::app()->createAbsoluteUrl('/mis/DepartmentRanking/ranking'); ?>" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Department Performance</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start open">
                <a href="javascript:void(0)" title="View Application" class="nav-link policybenchmark">
                    <span class="title"><i class="fa-gavel fa"></i> Policy Benchmark Report</span>
                </a>
                <form action="http://uksubsidy.in/production/department-dashboard" class="nav-link " method="POST" target="_blank" id="policybenchmark">
                    <input type="hidden" name="token" value="<?php echo strtotime(date('Y-m-d H:i:s')) . "-" . ($_SESSION['uid'] + date('Y')); ?>" >
                    <input type="hidden" name="department_user_id" value="<?php echo base64_encode($_SESSION['uid']); ?>">
                </form>  

            </li>
            <li class="nav-item  ">
                <a href="https://www.doiuk.org/easeofdoingbusiness.php" target="_blank" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">Existing Units List</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="/backoffice/mis/serviceMapping/l1/FY/ALL/swcs_status/both" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">Service Report- Synced From Departments</span>
                </a>
            </li>

            <li class="nav-item  ">
                <a href="/backoffice/admin/service/advanceReport" title="Service Search" >
                    <i class="fa fa-list"></i>
                    <span class="title">Service Search- Applied via Single Window</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="/backoffice/admin/inprinciple/advanceReport" title="Service Search" >
                    <i class="fa fa-list"></i>
                    <span class="title">CAF Search</span>
                </a>
            </li>

        <?php
        echo '<li class="nav-item start open" style="display:none">
      <a href="javascript:;" class="nav-link nav-toggle">
	      <i class="icon-layers"></i>
	      <span class="title">Reports</span>
	      <span class="arrow"></span>
      </a>
      <ul class="sub-menu">
       
      	<li class="nav-item">
					      <a href="' . Yii::app()->createAbsoluteUrl('mis/psReport/districtwisenodalcafreport') . '" class="nav-link">
					      <span class="title">Distirct Level Overall CAF</span> 
					      </a>
					  </li>
                                          	<li class="nav-item ">
      		<a href="' . Yii::app()->createAbsoluteUrl('mis/psReport/overallstate') . '" class="nav-link ">
      			<span class="title">State Level Overall CAF</span>
      		</a>
      	</li>
                                          
<li class="nav-item">
					      <a href="' . Yii::app()->createAbsoluteUrl('mis/psReport/PendencyreportHod/days/0/daysto/10000') . '" class="nav-link">
					      <span class="title">District Level Pending CAF</span>
					      </a>
					  </li>
                                          
<li class="nav-item">
					      <a href="' . Yii::app()->createAbsoluteUrl('mis/psReport/PendencyreportHodState/days/0/daysto/10000') . '" class="nav-link">
					      <span class="title">State Level Pending CAF </span>
					      </a>
					  </li>
                                          
<li class="nav-item">
					      <a href="' . Yii::app()->createAbsoluteUrl('mis/psReport/disposeddistrict?financial_year=2017-2018') . '" class="nav-link">
					      <span class="title">District Level: CAF disposed with comments </span>
					      </a>
					  </li>
<li class="nav-item">
					      <a href="' . Yii::app()->createAbsoluteUrl('mis/psReport/districtdisposedwithoutcomment/fID/2017-2018') . '" class="nav-link">
					      <span class="title">District Level: CAF disposed without comments</span>
					      </a>
					  </li>
                                          <li class="nav-item">
					      <a href="' . Yii::app()->createAbsoluteUrl('mis/psReport/index/fID/2017-2018') . '" class="nav-link">
					      <span class="title">State Level: CAF disposed with comments</span>
					      </a>
					  </li>
                                          <li class="nav-item">
					      <a href="' . Yii::app()->createAbsoluteUrl('mis/psReport/statedisposedwithoutcomment/fID/2017-2018') . '" class="nav-link">
					      <span class="title">State Level: CAF disposed without comments</span>
					      </a>
					  </li>
                                          	<li class="nav-item">
					      <a href="' . Yii::app()->createAbsoluteUrl('mis/serviceReport') . '" class="nav-link">
					      <span class="title">Service Report</span> 
					      </a>
					  </li>
                                          
                                          

';
    } elseif (DefaultUtility::is_CHEIF_SECRETARY()) {
        echo ' <!--<li class="nav-item start open">
	   	<a href="' . Yii::app()->createAbsoluteUrl('/user/indexState') . '" class="nav-link nav-toggle">
	   	<i class="icon-globe"></i>
		   	 <span class="title">Manage State Level Nodal</span>
	      <span class="selected"></span>
	      </a>
	   </li>
	   <li class="nav-item start open">
	      <a href="' . Yii::app()->createAbsoluteUrl('/user/indexDistrict') . '" class="nav-link nav-toggle">
	      <i class="icon-globe"></i>
	      <span class="title">Manage District Level Nodal</span>
	      <span class="selected"></span>
	      </a>
	   </li>
          <li class="nav-item start open">
	   	<a href="' . Yii::app()->createAbsoluteUrl('/mis/ranking') . '" class="nav-link nav-toggle">
	   	<i class="icon-globe"></i>
		   	 <span class="title">Department Ranking</span>
	      <span class="selected"></span>
	      </a>
	   </li>-->'
        ?>
            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-bulb"></i>
                    <span class="title">Nodal Officers List</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="<?= $this->createUrl('/mis/boApplicationSubmission/GMList') ?>" class="nav-link ">
                            <span class="title">DIC GM</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?= $this->createUrl('/mis/boApplicationSubmission/StateNodalList') ?>" class="nav-link ">
                            <span class="title">SWA State Nodal</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?= $this->createUrl('/mis/boApplicationSubmission/DistrictNodalList') ?>" class="nav-link ">
                            <span class="title">SWA District Nodal</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?php $role = base64_encode(64);
        echo $this->createUrl("/mis/boApplicationSubmission/userlist/ut/$role/title/EoDB District Level Nodal Officer") ?>" class="nav-link ">
                            <span class="title">EODB Nodal</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?php $role = base64_encode(62);
        echo $this->createUrl("/mis/boApplicationSubmission/userlist/ut/$role/title/Head Of Department - User List"); ?>" class="nav-link ">
                            <span class="title">Panel - Department</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="<?php $role = base64_encode(71);
        echo $this->createUrl("/mis/boApplicationSubmission/userlist/ut/$role/title/Secretary Panel - User List"); ?>" class="nav-link ">
                            <span class="title">Panel - Secretary</span>
                        </a>
                    </li>

                </ul>
            </li><li class="nav-item start open">
                <a href="<?php echo Yii::app()->createAbsoluteUrl('/mis/DepartmentRanking/ranking'); ?>" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Department Performance</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start open">
                <a href="javascript:void(0)" title="View Application" class="nav-link policybenchmark">
                    <span class="title"><i class="fa-gavel fa"></i> Policy Benchmark Report</span>
                </a>
                <form action="http://uksubsidy.in/production/department-dashboard" class="nav-link " method="POST" target="_blank" id="policybenchmark">
                    <input type="hidden" name="token" value="<?php echo strtotime(date('Y-m-d H:i:s')) . "-" . ($_SESSION['uid'] + date('Y')); ?>" >
                    <input type="hidden" name="department_user_id" value="<?php echo base64_encode($_SESSION['uid']); ?>">
                </form>  

            </li>
            <li class="nav-item  ">
                <a href="https://www.doiuk.org/easeofdoingbusiness.php" target="_blank" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">Existing Units List</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="/backoffice/mis/serviceMapping/l1/FY/ALL/swcs_status/both" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">Single Window Service Report</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="/backoffice/admin/service/advanceReport" title="Service Search" >
                    <i class="fa fa-list"></i>
                    <span class="title">Single Window Service Search</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="/backoffice/admin/inprinciple/advanceReport" title="Service Search" >
                    <i class="fa fa-list"></i>
                    <span class="title">CAF Search</span>
                </a>
            </li>
        <?php
        echo '<li class="nav-item start open" style="display:none">
      <a href="javascript:;" class="nav-link nav-toggle">
	      <i class="icon-layers"></i>
	      <span class="title">Reports</span>
	      <span class="arrow"></span>
      </a>
      <ul class="sub-menu">
       
      	<li class="nav-item">
					      <a href="' . Yii::app()->createAbsoluteUrl('mis/psReport/districtwisenodalcafreport') . '" class="nav-link">
					      <span class="title">Distirct Level Overall CAF</span> 
					      </a>
					  </li>
                                          	<li class="nav-item ">
      		<a href="' . Yii::app()->createAbsoluteUrl('mis/psReport/overallstate') . '" class="nav-link ">
      			<span class="title">State Level Overall CAF</span>
      		</a>
      	</li>
                                          
<li class="nav-item">
					      <a href="' . Yii::app()->createAbsoluteUrl('mis/psReport/PendencyreportHod/days/0/daysto/10000') . '" class="nav-link">
					      <span class="title">District Level Pending CAF
					      </a>
					  </li>
                                          
<li class="nav-item">
					      <a href="' . Yii::app()->createAbsoluteUrl('mis/psReport/PendencyreportHodState/days/0/daysto/10000') . '" class="nav-link">
					      <span class="title">State Level Pending CAF 
					      </a>
					  </li>
                                          
<li class="nav-item">
					      <a href="' . Yii::app()->createAbsoluteUrl('mis/psReport/disposeddistrict?financial_year=2017-2018') . '" class="nav-link">
					      <span class="title">District Level: CAF disposed with comments 
					      </a>
					  </li>
<li class="nav-item">
					      <a href="' . Yii::app()->createAbsoluteUrl('mis/psReport/districtdisposedwithoutcomment/fID/2017-2018') . '" class="nav-link">
					      <span class="title">District Level: CAF disposed without comments
					      </a>
					  </li>
                                          <li class="nav-item">
					      <a href="' . Yii::app()->createAbsoluteUrl('mis/psReport/index/fID/2017-2018') . '" class="nav-link">
					      <span class="title">State Level: CAF disposed with comments
					      </a>
					  </li>
                                          <li class="nav-item">
					      <a href="' . Yii::app()->createAbsoluteUrl('mis/psReport/statedisposedwithoutcomment/fID/2017-2018') . '" class="nav-link">
					      <span class="title">State Level: CAF disposed without comments
					      </a>
					  </li>
                                          	<li class="nav-item">
					      <a href="' . Yii::app()->createAbsoluteUrl('mis/serviceReport') . '" class="nav-link">
					      <span class="title">Service Report</span> 
					      </a>
					  </li>
                                          

';
    }
}


$nodleAgency = DefaultUtility::isNoodalAgency();
if ($nodleAgency || DefaultUtility::isNodalUser()) {


    $frdApps = ApplicationVerificationLevelExt::getForwardedApplications($_SESSION['uid']);
    $countfw = 0;
    echo '<li class="nav-item start open">
			      <a href="javascript:;" class="nav-link nav-toggle">
				      <i class="icon-bell"></i>
	     			  <span class="title">Forwarded</span>
	     			  <span class="badge badge-danger fBadge">0</span>
				      <span class="arrow"></span>
			      </a>';
    if (!empty($frdApps)) {
        echo "<ul class='sub-menu'>";
        $prevApp = '';
        foreach ($frdApps as $apps) {
            if ($prevApp == $apps['app_sub_id'])
                continue;
            $app_name = ApplicationExt::getAppNameViaId($apps['application_id']);
            // echo '<li class="nav-item ">
            //<a href="'.Yii::app()->createUrl('admin/ApplicationView/applicationfulldetail/app_sub_id/')."/".$apps['app_sub_id'].'" title="View Application" class="nav-link ">
            //<span class="title"> '.$app_name["application_name"]."-".$apps['app_sub_id'].'</span>
            // </a>
            // </li>';

            $prevApp = $apps['app_sub_id'];
            $countfw++;
        }
        echo "</ul>";
    }
    echo "</li>";
}

if ($_SESSION['role_id'] == 33) {
    echo '<li class="nav-item">   
		<a href="/backoffice/PisMou/hodIndex/page/admin_listing1" title="View PIS/MOU" ><i class="fa fa-file"></i>Investor Summit</a>
   
		</li>';
}

if ($isNoodal) {
    $user_dept = UserExt::getUserDept($_SESSION['uid']);
    $otherfrdApps = ApplicationVerificationLevelExt::getForwardedAppOfDept($user_dept['dept_id']);
    $countoth = 0;
    echo '<li class="nav-item start open">
			      <a href="' . Yii::app()->createAbsoluteUrl('Grievance/grievanceUpdate') . '" class="nav-link nav-toggle">
			      <i class="icon-question"></i>
			      <span class="title">Grievance</span>
			      </a>
			  </li>
                    
                          <!--<li class="nav-item start open">
			      <a href="' . Yii::app()->createAbsoluteUrl('iloc/property/listing') . '" class="nav-link nav-toggle">
			      <i class="fa fa-building-o"></i>
			      <span class="title">Search Land Ads</span>
			      </a>
			  </li>-->
			  <li class="nav-item start open">
			      <a href="javascript:;" class="nav-link nav-toggle">
				      <i class="icon-bell"></i>
	     			  <span class="title">Other</span>
	     			  <span class="badge badge-danger oBadge">0</span>
				      <span class="arrow"></span>
			      </a>';
    if (!empty($otherfrdApps)) {
        echo "<ul class='sub-menu'>";
        $prevApp = '';
        foreach ($otherfrdApps as $app) {
            $countoth++;
            if ($prevApp == $app['app_sub_id'])
                continue;
            $app_name = ApplicationExt::getAppNameViaId($app['application_id']);
            echo '<li class="nav-item ">
        			    		<a href="' . Yii::app()->createUrl('admin/ApplicationView/forwardedApplication/application_sub_id/') . "/" . $app['app_sub_id'] . '" title="View Application" class="nav-link ">
        			    			<span class="title"> ' . $app_name["application_name"] . '-' . $app['app_sub_id'] . '</span>
        			    	    </a>
        			    	  </li>';
            $prevApp = $app['app_sub_id'];
        }
        echo "</ul>";
    }
    echo "</li>";
}

if ($nodleAgency || DefaultUtility::isNodalUser()) {
    echo '<li class="nav-item start open">
			      <a href="' . Yii::app()->createAbsoluteUrl('admin/ApplicationActivity/ArchiveCAF') . '" class="nav-link nav-toggle">
			      <i class="icon-question"></i>
			      <span class="title">Incomplete</span>
			      </a>
			  </li>';
}
if ($_SESSION['role_id'] == 7) {
    echo '<li class="nav-item">   
		<a href="/backoffice/PisMou/hodIndex/page/admin_listing1" title="View PIS/MOU" ><i class="fa fa-file"></i>Investor Summit</a>
   
		</li>';
}

if(isset($_SESSION['role_id']) &&($_SESSION['role_id']==86)){ 
   echo '<li class="nav-item survey">
      <a href="javascript:;" class="nav-link nav-toggle">
      <i class="icon-bulb"></i>
      <span class="title">Survey Managment</span>
      <span class="arrow"></span>
      </a>
      <ul class="sub-menu">
         <li class="nav-item">
            <a href="/backoffice/survey/surveyCategory/" class="nav-link">
            <span class="title">Manage Category Master</span>
            </a>
         </li>
         <li class="nav-item">
            <a href="/backoffice/survey/surveyQuestionAnswerMapping/" class="nav-link">
            <span class="title">Manage Question Answer</span>
            </a>
         </li>
         <li class="nav-item">
            <a href="/backoffice/survey/Survey/" class="nav-link">
            <span class="title">View/Create Survey</span>
            </a>
         </li>
         
		 
      </ul>
   </li>' ;
}
?>

</ul>
<script type="text/javascript">
    $('document').ready(function () {
        $('.pBadge').html('<?= @$pCount ?>');
        $('.fBadge').html('<?= @$countfw ?>');
        $('.oBadge').html('<?= @$countoth ?>');
        $(".rdt").click(function () {
            window.location.href = "https://caipotesturl.com/backoffice/admin";
        });
        $(".policybenchmark").click(function () {
            $("#policybenchmark").submit();
        });
        $(".publicconsultancy").click(function () {
            $("#publicconsultancy").submit();
        });
    });
</script>







