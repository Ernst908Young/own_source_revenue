<?php
$iconArray = array("icon-diamond", "icon-wallet", "icon-settings", "icon-puzzle", "icon-bulb", "icon-briefcase", "icon-fire", "icon-bar-chart", "icon-layers", "icon-feed", "icon-docs", "icon-folder", "icon-social-dribbble", "icon-note", "icon-graph", "icon-notebook", "icon-grid");
?>
<ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
    <li class="sidebar-toggler-wrapper hide">
        <div class="sidebar-toggler">
            <span></span>
        </div>
    </li>
    <li class="nav-item start open">
        <a href="/" target="_blank" class="nav-link nav-toggle">
            <i class="icon-home"></i>
            <span class="title">Home</span>
            <span class="selected"></span>
        </a>
    </li>
    <?php $url_now = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];  ?>
    <li class="nav-item start  <?php if($url_now=='https://caipotesturl.com/backoffice/frontuser/home/investorWalkthrough') echo 'active';?> open">
        <?php          
          $invDash = "/frontuser/home/investorWalkthrough" ?>
        <a href="<?= Yii::app()->createAbsoluteUrl($invDash); ?>" class="nav-link nav-toggle">
            <i class="icon-home"></i>
            <span class="title">Dashboard</span>
            <span class="selected"></span>
        </a>
    </li>
    <li class="nav-item start open <?php if((strpos($url_now, 'service') !== false) || (strpos($url_now, 'Service') !== false)) echo 'active';?>">
        <a href="" class="nav-link nav-toggle">
            <i class="icon-note"></i>
            <span class="title">Apply for Departmental Services</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item start open"  <?php if($url_now=='https://caipotesturl.com/backoffice/frontuser/home/serviceNew/type/CAF/financial_year/ALL/is/service/') echo 'active';?>>
                <a href="https://caipotesturl.com/backoffice/frontuser/home/serviceNew/type/CAF/financial_year/ALL/is/service/" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">New Estabilshments</span>

                </a>
            </li>   

            <li class="nav-item start open <?php if($url_now=='https://caipotesturl.com/backoffice/frontuser/home/serviceExisting/type/EU/financial_year/ALL/is/service/') echo 'active';?>">
                <a href="https://caipotesturl.com/backoffice/frontuser/home/serviceExisting/type/EU/financial_year/ALL/is/service/" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">Existing Estabilshments</span> 

                </a>
            </li>
            <li class="nav-item start open <?php if($url_now=='https://caipotesturl.com/backoffice/frontuser/applyServiceCP/ServiceListing') echo 'active';?>">
                <a href="<?= Yii::app()->createAbsoluteUrl('frontuser/applyServiceCP/ServiceListing'); ?>" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">Apply for Sectoral Clearances (Beta)</span>
                    
                </a>
            </li>
			<?php $SpApps = SpApplicationsExt::getAllSSODeptTemp();
					    $iconCount = 0;
    $iconLastVal = end($iconArray);
    $iconLastKey = key($iconArray);
    reset($iconArray);
            if (!empty($SpApps)) {
                foreach ($SpApps as $apps) {
                    if ($iconCount > $iconLastKey)
                        $iconCount = 0;
                    if (($apps['service_provider_name'] != 'Public Consultation') && ($apps['service_provider_name'] != 'Incentive')) {
                        echo '<li class="nav-item start open">
       			   <a href="' . Yii::app()->createAbsoluteUrl('frontuser/application_form/applicationList/service/' . $apps['service_provider_name'] . '/serviceProvider/' . $apps['sp_id']) . '" class="nav-link nav-toggle">
       			   <i class="' . $iconArray[$iconCount++] . '"></i>
       			   <span class="title">';
                    }
                    if ($apps['service_provider_name'] == 'Pollution') {
                        echo 'UEPPCB';
                    } elseif ($apps['service_provider_name'] == 'Public Consultation') {
                        $pc = '/backoffice/frontuser/application_form/applicationList/service/Public%20Consultation/serviceProvider/' . $apps['sp_id'];
                    } elseif ($apps['service_provider_name'] == 'Incentive') {
                        
                    } else
                        echo $apps['service_provider_name'];

                    echo '</span>
       			   </a>
       			</li>';
                }
            }?>
        </ul>
    </li>

    <li class="nav-item start open <?php if((strpos($url_now, 'land') !== false) || (strpos($url_now, 'iloc') !== false)) echo 'active';?>">
        <a href="" class="nav-link nav-toggle">
            <i class="icon-note"></i>
            <span class="title">Land Bank</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item start open">
                <a href="" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">Post Land Requirement</span>

                </a>
                <ul class="sub-menu">                    
                    <li class="nav-item start open">
                        <a href="https://caipotesturl.com/backoffice/iloc/property/advanceSearch" class="nav-link nav-toggle">
                            <i class="icon-layers"></i>
                            <span class="title">Search Available Land-Govt.</span>
                        </a>                
                    </li>
                    <li class="nav-item start open">
                        <a href="https://caipotesturl.com/backoffice/iloc/property/listing/landtype/Pvt" class="nav-link nav-toggle">
                            <i class="icon-layers"></i>
                            <span class="title">Search Available Land-Pvt.</span>
                        </a>                
                    </li>
                    <li class="nav-item start open">
                        <a href="https://www.siidculsmartcity.com/ViewVacantPlot.aspx" target="blank" class="nav-link nav-toggle">
                            <i class="icon-layers"></i>
                            <span class="title">Search Industrial Plots</span>
                        </a>                
                    </li>
                    <li class="nav-item start open">
                        <a href="https://caipotesturl.com/backoffice/frontuser/landAllotment/estateList" class="nav-link nav-toggle">
                            <i class="icon-layers"></i>
                            <span class="title">Search Industrial Estate Plots</span>
                        </a>                
                    </li>
                    <li class="nav-item start open">
                        <a href="https://caipotesturl.com/backoffice/iloc/landrequesterConnect/create" class="nav-link nav-toggle">
                            <i class="icon-layers"></i>
                            <span class="title">Add Specific Land Requirements</span>
                        </a>                
                    </li>
                </ul> 
            </li>
            <li class="nav-item start open">
                <a href="" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">List Your Land For Lease</span>

                </a>
                <ul class="sub-menu">
                    <li class="nav-item start open">
                        <a href="https://caipotesturl.com/backoffice/iloc/landownerConnect/create" class="nav-link nav-toggle">
                            <i class="icon-layers"></i>
                            <span class="title">Add Land Details</span>
                        </a>                
                    </li>
                    <li class="nav-item start open">
                        <a href="https://caipotesturl.com/backoffice/iloc/property/requirementListing" class="nav-link nav-toggle">
                            <i class="icon-layers"></i>
                            <span class="title">Search Land Requirement</span>
                        </a>                
                    </li>
                    <li class="nav-item start open">
                        <a href="https://caipotesturl.com/backoffice/iloc/landownerConnect/manage">
                            <i class="icon-layers"></i>
                            <span class="title">Manage Listing</span>
                        </a>                
                    </li>
                </ul> 
            </li>            
            <li class="nav-item start open">
                <a href="https://caipotesturl.com/backoffice/iloc/property/advertisement" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">Land Lease Video Advertisement</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start open">
                <a href="https://caipotesturl.com/themes/backend/uploads/GO_30_Nov_2016.pdf" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">UPZALR Land Lease Amendment</span>
                    <span class="selected"></span>
                </a>
            </li>
        </ul>
    </li>

    <!--   <li class="nav-item start open">
    
          <a href="<? //= Yii::app()->createAbsoluteUrl('dms/DocumentManagement/myDocuments'); ?>" class="nav-link nav-toggle">
    
          <i class="icon-envelope"></i>
    
          <span class="title">Document Management</span>
    
          <span class="selected"></span>
    
          </a>
    
       </li>-->
    <!--<li class="nav-item start open">
      <a href="<? //= Yii::app()->createAbsoluteUrl('Grievance/grievanceUpdate/suggestions'); ?>" class="nav-link nav-toggle">
      <i class="icon-envelope"></i>
      <span class="title">Grievance</span>
      <span class="selected"></span>
      </a>
   </li> -->
    <!--    <li class="nav-item start open">
          <a href="<? //= Yii::app()->createAbsoluteUrl('appeal'); ?>" class="nav-link nav-toggle">
          <i class="icon-envelope"></i>
          <span class="title">Appeal</span>
          <span class="selected"></span>
          </a>
       </li>-->
    <!--<li class="nav-item start open">
        <a href="<? //= Yii::app()->createAbsoluteUrl('iloc/landownerConnect'); ?>" class="nav-link nav-toggle">
            <i class="icon-envelope"></i>
            <span class="title">List Your Land</span>
            <span class="selected"></span>
        </a>
    </li>
    <li class="nav-item start open">
        <a href="<? //= Yii::app()->createAbsoluteUrl('iloc/property/listing'); ?>" class="nav-link nav-toggle">
            <i class="icon-envelope"></i>
            <span class="title">Search Available Lands</span>
            <span class="selected"></span>
        </a>
    </li>-->

    <?php
    /*$Departments = DefaultUtility::getAllDept();
    $iconCount = 0;
    $iconLastVal = end($iconArray);
    $iconLastKey = key($iconArray);
    reset($iconArray);
    foreach ($Departments as $Departments) {
        $apps = DefaultUtility::getDeptApp($Departments['dept_id']);
        if (!empty($apps)) {
            if ($iconCount > $iconLastKey)
                $iconCount = 0;
            echo ' <li class="nav-item  ">
					      <a href="javascript:;" class="nav-link nav-toggle">
					      <i class="' . $iconArray[$iconCount++] . '"></i>
					      <span class="title">' . $Departments['department_name'] . '</span>
					      <span class="arrow"></span>
					      </a>
					      <ul class="sub-menu">';
            foreach ($apps as $key => $app) {
                echo ' <li class="nav-item ">';
                if ($app['application_name'] === 'CAF')
                    echo '<a href="' . Yii::app()->createAbsoluteUrl('frontuser/home/cafForm') . '" class="nav-link ">';
                else if ($app['application_name'] === 'Land_Allotment')
                    echo '<a href="' . Yii::app()->createAbsoluteUrl('frontuser/landAllotment/estateList') . '" class="nav-link ">';
                else
                    echo '<a href="' . Yii::app()->createAbsoluteUrl('frontuser/application_form/generateapplication/department/' . $Departments['dept_id'] . '/application/' . $app['application_id']) . '" class="nav-link ">';

                echo '<span class="title">' . str_replace("_", " ", $app["application_name"]) . '</span>
					      		   </a>
					      		</li>';
            }
            echo '
					      </ul>
					   </li>';
        }
    }*/
    ?>


    <!--<li class="nav-item start open">
<a href="<?= Yii::app()->createAbsoluteUrl('/frontuser/ApplyService/ServiceListing/id/1'); ?>" class="nav-link nav-toggle">
<i class="fas fa fa-suitcase"></i>
<span class="title">Existing Industry Registration</span>
<span class="selected"></span>
</a>
</li>-->



    <!-- Commented on 23-04-2018
    
    <li class="nav-item start open">

  <a href="<?= Yii::app()->createAbsoluteUrl('frontuser/offlineApplication/listing'); ?>" class="nav-link nav-toggle">

  <i class="icon-note"></i>

  <span class="title">Offline Applications</span>

  <span class="selected"></span>

  </a>

</li> -->
    <?php
    /* Pankaj Kumar Tiwari Created at 19 Feb 2018  */
    $investor_id = !empty($_SESSION['RESPONSE']['user_id']) ? base64_encode($_SESSION['RESPONSE']['user_id']) : '';
    ?>

    <li class="nav-item start open">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-layers"></i>
            <span class="title">Help Desk</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item start open">
                <a href="<?php echo $pc; ?>" class="nav-link nav-toggle">	
                    <i class="icon-settings"></i>
                    <span class="title">Public Consultation</span>
                    <span class="selected"></span>
                </a>
            </li>
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
                        <a href="<?php echo FRONT_BASEURL . "ticket/open.php?user_id=" . $investor_id; ?>"  class="nav-link nav-toggle">
                            <i class="fa fa-file"></i>
                            <span class="title">Create Ticket</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="nav-item start open">
                        <a href="<?php echo FRONT_BASEURL . "ticket/autologin.php?luser=" . $_SESSION['RESPONSE']['email'] . "&flag=view&type=investor"; ?>" class="nav-link nav-toggle">
                            <i class="fa fa-file"></i>
                            <span class="title">View Ticket</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item start open">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">Angry with Us</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start open">
                        <?php $greivanceUpdateUrl = "GrievanceNew/grievanceDetail/ListUserGrievance?trackId=" . @$_SESSION['RESPONSE']['email']; ?>
                        <a href="<?= Yii::app()->createAbsoluteUrl('GrievanceNew/grievanceDetail/createGrievance'); ?>"  class="nav-link nav-toggle">
                            <i class="fa fa-file"></i>
                            <span class="title">Create Grievance</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="nav-item start open">
                        <a href="<?= Yii::app()->createAbsoluteUrl($greivanceUpdateUrl); ?>" class="nav-link nav-toggle">
                            <i class="fa fa-file"></i>
                            <span class="title">View Grievance</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </li>




    <?php /* ------------------------------------------------------ */ ?>

</ul>