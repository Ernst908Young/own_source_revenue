<style>

.activeq, ul.sub-menu li.activeq a i, ul.sub-menu li.activeq a span.title, li.activeq a span.title{
 color:#fff !important;
 background: #36c6d3 !important;
}
</style>
<?php
$iconArray = array("icon-diamond", "icon-wallet", "icon-settings", "icon-puzzle", "icon-bulb", "icon-briefcase", "icon-fire", "icon-bar-chart", "icon-layers", "icon-feed", "icon-docs", "icon-folder", "icon-social-dribbble", "icon-note", "icon-graph", "icon-notebook", "icon-grid");
?>
<ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
    <li class="sidebar-toggler-wrapper hide">
        <div class="sidebar-toggler">
            <span></span>
        </div>
    </li>
    <?php $url_now = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>
    <li class="nav-item start <?php if(((strpos($url_now, 'investorWalkthrough')) !== false) && ((strpos($url_now, 'QUERIES')) === false)
		&& ((strpos($url_now, 'TICKETS')) === false)
	&& ((strpos($url_now, 'GRIEVANCE')) === false)) echo 'activeq '; ?> ">
        <?php $invDash = "/frontuser/home/investorWalkthrough" ?>
        <a href="<?= Yii::app()->createAbsoluteUrl($invDash); ?>" class="nav-link nav-toggle">
            <i class="icon-home"></i>
            <span class="title">Dashboard</span>
            <span class="selected"></span>
        </a>
    </li>
    <li class="nav-item start">
        <a href="" class="nav-link nav-toggle">
            <i class="icon-note"></i>
            <span class="title">Apply for Departmental Services</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu" <?php if((strpos($url_now, 'service') !== false) || (strpos($url_now, 'Pollution') !== false ) || (strpos($url_now, 'applyServiceCP') !== false ))echo 'open ' . "style ='display : block'" ?>>
            <li class="nav-item start <?php if(strpos($url_now, 'serviceNew') !== false) echo "activeq" ?>">
                <a href="/backoffice/frontuser/home/serviceNew/type/CAF/financial_year/ALL/is/service/" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">New Establishments</span>

                </a>
            </li>   

            <li class="nav-item start <?php if(strpos($url_now, 'serviceExisting') !== false) echo 'activeq'; ?>">
                <a href="/backoffice/frontuser/home/serviceExisting/type/EU/financial_year/ALL/is/service/" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">Existing Establishments</span> 

                </a>
            </li>
            <li class="nav-item start  <?php if(strpos($url_now, 'applyServiceCP') !== false) echo 'activeq'; ?>">
                <a href="<?= Yii::app()->createAbsoluteUrl('frontuser/applyServiceCP/ServiceListing'); ?>" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">Apply for Sectoral Clearances (Beta)</span>

                </a>
            </li>
            <?php
            $SpApps = SpApplicationsExt::getAllSSODeptTemp();
            $iconCount = 0;
            $iconLastVal = end($iconArray);
            $iconLastKey = key($iconArray);
            reset($iconArray);
            if (!empty($SpApps)) {
                foreach ($SpApps as $apps) {
                    if ($iconCount > $iconLastKey)
                        $iconCount = 0;
                    if (($apps['service_provider_name'] != 'Public Consultation') && ($apps['service_provider_name'] != 'Incentive')) {
						if(strpos($url_now, 'Pollution') !== false){
							echo '<li class="nav-item start activeq ">
       			   <a href="' . Yii::app()->createAbsoluteUrl('frontuser/application_form/applicationList/service/' . $apps['service_provider_name'] . '/serviceProvider/' . $apps['sp_id']) . '" class="nav-link nav-toggle">
       			   <i class="' . $iconArray[$iconCount++] . '"></i>
       			   <span class="title">';
						}else{
                        echo '<li class="nav-item start">
       			   <a href="' . Yii::app()->createAbsoluteUrl('frontuser/application_form/applicationList/service/' . $apps['service_provider_name'] . '/serviceProvider/' . $apps['sp_id']) . '" class="nav-link nav-toggle">
       			   <i class="' . $iconArray[$iconCount++] . '"></i>
       			   <span class="title">';
                    }}
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
            }
            ?>
        </ul>
    </li>

    <li <?php if ((strpos($url_now, 'property/advanceSearch') !== false) || 
            (strpos($url_now, 'landtype/Pvt') !== false) || 
            (strpos($url_now, 'landAllotment/estateList') !== false) ||
            (strpos($url_now, 'landrequesterConnect/create') !== false)) echo 'style = "display: block;"'; ?> class="nav-item start">
        <a href="" class="nav-link nav-toggle">
            <i class="icon-note"></i>
            <span class="title">Land Bank</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu" <?php if ((strpos($url_now, 'land') !== false) || (strpos($url_now, 'iloc') !== false)) echo 'style = "display: block;"'; ?>>
            <li class="nav-item start <?php if ((strpos($url_now, 'land') !== false) || (strpos($url_now, 'iloc') !== false)) echo 'open'; ?>">
                <a href="" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">Post Land <br>Requirement</span>
                    <span class="arrow"></span>

                </a>
                <ul class="sub-menu" <?php if( (strpos($url_now, 'property/advanceSearch') !== false) || (strpos($url_now, 'landtype/Pvt') !== false) || (strpos($url_now, 'landAllotment/estateList') !== false) || (strpos($url_now, 'landrequesterConnect/create') !== false))echo 'style = "display:block"'; ?>>                    
                    <li class="nav-item <?php if (strpos($url_now, 'property/advanceSearch') !== false) echo 'activeq'; ?>">
                        <a href="/backoffice/iloc/property/advanceSearch" class="nav-link nav-toggle">
                            <i class="fa fa-file"></i>
                            <span class="title">Search Available Land-Govt.</span>
                        </a>                
                    </li>
                    <li class="nav-item <?php if (strpos($url_now, 'landtype/Pvt') !== false) echo 'activeq'; ?>">
                        <a href="/backoffice/iloc/property/listing/landtype/Pvt" class="nav-link nav-toggle">
                            <i class="fa fa-file"></i>
                            <span class="title">Search Available Land-Pvt.</span>
                        </a>                
                    </li>
                    <li class="nav-item ">
                        <a href="https://www.siidculsmartcity.com/ViewVacantPlot.aspx" target="_blank" class="nav-link nav-toggle">
                            <i class="fa fa-file"></i>
                            <span class="title">Search Industrial Estate Plots(SIIDCUL)</span>
                        </a>                
                    </li>
                    <li class="nav-item <?php if (strpos($url_now, 'landAllotment/estateList') !== false) echo 'activeq'; ?>">
                        <a href="/backoffice/frontuser/landAllotment/estateList" class="nav-link nav-toggle">
                            <i class="fa fa-file"></i>
                            <span class="title">Search Industrial Estate Plots(MSME)</span>
                        </a>                
                    </li>
                    <li class="nav-item <?php if (strpos($url_now, 'landrequesterConnect/create') !== false) echo 'activeq'; ?>">
                        <a href="/backoffice/iloc/landrequesterConnect/create" class="nav-link nav-toggle">
                            <i class="fa fa-file"></i>
                            <span class="title">Add Specific Land Requirements</span>
                        </a>                
                    </li>
                </ul> 
            </li>
            <li class="nav-item start ">
                <a href="" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">List Your Land <br>For Lease</span>
                    <span class="arrow"></span>

                </a>
                <ul class="sub-menu" <?php if ((strpos($url_now, 'landownerConnect/create') !== false) || (strpos($url_now, 'property/requirementListing') !== false)) echo 'style = "display:block"'; ?>>                    
                    <li class="nav-item start  <?php if (strpos($url_now, 'landownerConnect/create') !== false) echo 'activeq'; ?>">
                        <a href="/backoffice/iloc/landownerConnect/create" class="nav-link nav-toggle">
                            <i class="fa fa-file"></i>
                            <span class="title">Add Land Details</span>
                        </a>                
                    </li>
                    <li class="nav-item  <?php if (strpos($url_now, 'property/requirementListing') !== false) echo 'activeq'; ?>">
                        <a href="/backoffice/iloc/property/requirementListing" class="nav-link nav-toggle">
                            <i class="fa fa-file"></i>
                            <span class="title">Search Land Requirement</span>
                        </a>                
                    </li>

                </ul> 
            </li>       
            <li class="nav-item start <?php if (strpos($url_now, 'landownerConnect/manage') !== false) echo 'activeq'; ?>">
                <a href="/backoffice/iloc/landownerConnect/manage">
                    <i class="icon-layers"></i>
                    <span class="title">Manage Land Listing</span>
                </a>                
            </li>

            <li class="nav-item start <?php if (strpos($url_now, 'property/advertisement') !== false) echo 'activeq'; ?>">
                <a href="/backoffice/iloc/property/advertisement" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">Land Lease Video Advertisement</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start ">
                <a href="https://caipotesturl.com/themes/backend/uploads/GO_30_Nov_2016.pdf" target = "_blank" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">UPZALR Land Lease Amendment</span>
                    <span class="selected"></span>
                </a>
            </li>
        </ul>
    </li>

    <!--   <li class="nav-item start ">
    
          <a href="<? //= Yii::app()->createAbsoluteUrl('dms/DocumentManagement/myDocuments');   ?>" class="nav-link nav-toggle">
    
          <i class="icon-envelope"></i>
    
          <span class="title">Document Management</span>
    
          <span class="selected"></span>
    
          </a>
    
       </li>-->
    <!--<li class="nav-item start ">
      <a href="<? //= Yii::app()->createAbsoluteUrl('Grievance/grievanceUpdate/suggestions');   ?>" class="nav-link nav-toggle">
      <i class="icon-envelope"></i>
      <span class="title">Grievance</span>
      <span class="selected"></span>
      </a>
   </li> -->
    <!--    <li class="nav-item start ">
          <a href="<? //= Yii::app()->createAbsoluteUrl('appeal');   ?>" class="nav-link nav-toggle">
          <i class="icon-envelope"></i>
          <span class="title">Appeal</span>
          <span class="selected"></span>
          </a>
       </li>-->
    <!--<li class="nav-item start ">
        <a href="<? //= Yii::app()->createAbsoluteUrl('iloc/landownerConnect');   ?>" class="nav-link nav-toggle">
            <i class="icon-envelope"></i>
            <span class="title">List Your Land</span>
            <span class="selected"></span>
        </a>
    </li>
    <li class="nav-item start ">
        <a href="<? //= Yii::app()->createAbsoluteUrl('iloc/property/listing');   ?>" class="nav-link nav-toggle">
            <i class="icon-envelope"></i>
            <span class="title">Search Available Lands</span>
            <span class="selected"></span>
        </a>
    </li>-->

    <?php
    /* $Departments = DefaultUtility::getAllDept();
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
      } */
    ?>


    <!--<li class="nav-item start ">
<a href="<?= Yii::app()->createAbsoluteUrl('/frontuser/ApplyService/ServiceListing/id/1'); ?>" class="nav-link nav-toggle">
<i class="fas fa fa-suitcase"></i>
<span class="title">Existing Industry Registration</span>
<span class="selected"></span>
</a>
</li>-->



    <!-- Commented on 23-04-2018
    
    <li class="nav-item start ">

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

    <li class="nav-item start" <?php if ((strpos($url_now, 'QUERIES') !== false) || (strpos($url_now, 'TICKET') !== false) || (strpos($url_now, 'GRIEVANCE') !== false)) echo 'style = "display: block;"'; ?>>

        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-layers"></i>
            <span class="title">Help Desk</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu" <?php if ((strpos($url_now, 'QUERIES') !== false) || (strpos($url_now, 'TICKET') !== false) || (strpos($url_now, 'GRIEVANCE') !== false)) echo 'style = "display: block;"'; ?>>
            <li class="nav-item start ">
                <a href="<?php echo $pc; ?>" class="nav-link nav-toggle">	
                    <a href="http://www.ukpublicconsultation.in/consultation/index" target = "_blank" class="nav-link nav-toggle">	
                        <i class="icon-settings"></i>
                        <span class="title">Public Consultation</span>
                        <span class="selected"></span>
                    </a>
            </li>
            <li class="nav-item start <?php if ((strpos($url_now, 'QUERIES') !== false)) echo "activeq"; ?>">
                <a href="/backoffice/frontuser/home/investorWalkthroughLevel2/type/QUERIES/financial_year/ALL/dboard/yes" class="nav-link nav-toggle">
                    <i class="fa fa-file"></i>
                    <span class="title">Ask a Question to our team (Query System)</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="nav-item start <?php if ((strpos($url_now, 'TICKETS') !== false)) echo "activeq"; ?>">
                <a href="/backoffice/frontuser/home/investorWalkthroughLevel2/type/TICKETS/financial_year/ALL/dboard/yes" class="nav-link nav-toggle">
                    <i class="fa fa-file"></i>
                    <span class="title">Facing Trouble (Ticket System)</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="nav-item start <?php if ((strpos($url_now, 'GRIEVANCE')) !== false) echo "activeq"; ?> ">
                <a href="/backoffice/frontuser/home/investorWalkthroughLevel2/type/GRIEVANCE/financial_year/ALL/dboard/yes" class="nav-link nav-toggle">
                    <i class="fa fa-file"></i>
                    <span class="title">Angry with Us (Grievance)</span>
                    <span class="selected"></span>
                </a>
            </li>
        </ul>
    </li>




<?php /* ------------------------------------------------------ */ ?>

</ul>