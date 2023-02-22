<div class="row">
	<div class="col-xs-12">
		<div class="nav-top">
			<div class="">
				<div id="cssmenu" class="dashboard-header-menu">
						
					<ul class="main-header-menu ">
						<?php 
						if((isset($_POST['logintype']) && $_POST['logintype']=='service') || (isset($_GET['logintype']) && $_GET['logintype']=='service') || isset($_GET['name'])){ ?>
							<li class="main-header-menu-li <?php if($controller=='home' && $action=="investorWalkthrough") { echo "active"; } ?>"><a href="javascript:void(0);">Dashboard</a>
								<ul>
									<li><a style="width:226px;" href="/backoffice/frontuser/home/investorWalkthrough/logintype/service">Master Dashboard</a></li>
									<li><a style="width:226px;" href="/backoffice/frontuser/home/investorWalkthrough/name/<?php echo  base64_encode("Insurance Corporation of Barbados Ltd.");?>">Insurance Corporation of Barbados Ltd.</a></li>
									<li><a style="width:226px;" href="/backoffice/frontuser/home/investorWalkthrough/name/<?php echo  base64_encode("Insurance Corporation of Barbados Ltd.");?>">Insurance Corporation of Barbados Ltd.</a></li>
									<li><a style="width:226px;" href="/backoffice/frontuser/home/investorWalkthrough/name/<?php echo  base64_encode("Insurance Corporation Ltd.");?>">Insurance Corporation Ltd.</a></li>
									<li><a style="width:226px;" href="/backoffice/frontuser/home/investorWalkthrough/name/<?php echo  base64_encode("Light & Power Holdings Ltd.");?>">Light & Power Holdings Ltd.</a></li>
									<li><a style="width:226px;" href="/backoffice/frontuser/home/investorWalkthrough/name/<?php echo  base64_encode("One Media Limited.");?>">One Media Limited.</a></li>
								</ul>	
							</li>
						<?php }else{ ?>
							<li class="main-header-menu-li <?php if($controller=='home' && $action=="investorWalkthrough") { echo "active"; } ?>"><a href="/backoffice/admin">Dashboard</a></li>
						<?php } ?>		
						
                        
						
						<li class="main-header-menu-li"><a href="#">
                        Help Desk </a>
                        <ul class="dropdown-menu">
                             <li><a tabindex="-1" href="/backoffice/ticketing/default/supportindex"> Tickets</a></li>
                            <li><a tabindex="-1" href="/backoffice/queries/default/supportindex">Queries</a></li>
                       </ul>
							
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
/*
$iconArray = array("icon-diamond", "icon-wallet", "icon-settings", "icon-puzzle", "icon-bulb", "icon-briefcase", "icon-fire", "icon-bar-chart", "icon-layers", "icon-feed", "icon-docs", "icon-folder", "icon-social-dribbble", "icon-note", "icon-graph", "icon-notebook", "icon-grid");

<ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
    <li class="sidebar-toggler-wrapper hide">
        <div class="sidebar-toggler">
            <span></span>
        </div>
    </li>
    <?php $url_now = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>
    <li class="nav-item start <?php if(((strpos($url_now, 'investorWalkthrough')) !== false) && ((strpos($url_now, 'QUERIES')) === false) && ((strpos($url_now, 'TICKETS')) === false) && ((strpos($url_now, 'GRIEVANCE')) === false)) echo 'activeq '; ?> ">
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
                <a href="/themes/backend/uploads/GO_30_Nov_2016.pdf" target = "_blank" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">UPZALR Land Lease Amendment</span>
                    <span class="selected"></span>
                </a>
            </li>
        </ul>
    </li>
    <?php
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
                    <span class="title">Angry with Us</span>
                    <span class="selected"></span>
                </a>
            </li>
        </ul>
    </li>
</ul>
*/
?>