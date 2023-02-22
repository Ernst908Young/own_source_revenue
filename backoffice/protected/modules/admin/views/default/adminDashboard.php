<style type="text/css">
  #chartdiv {
  width: 100%;
  height: 500px;
} 

   .marquee_container { float:left; margin-right:195px; margin-left: 195px; margin-top: -45px;}
.marquee_container p {  display:inline; margin-left:16px; color:red; font-size:14.5px; line-height:33px; text-indent:8px; padding:25px;}
.date_container {color: #fff;float: right;height: 60px;position: absolute;right: 10px;text-align: right;width: 100px;z-index: 999;}
</style>


<script type="text/javascript">

function updateClock ( )
  {
  var currentTime = new Date ( );
  var currentdate=currentTime.toDateString();
    var currentHours = currentTime.getHours ( );
    var currentMinutes = currentTime.getMinutes ( );
    var currentSeconds = currentTime.getSeconds ( );

    // Pad the minutes and seconds with leading zeros, if required
    currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
    currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;

    // Choose either "AM" or "PM" as appropriate
    var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";

    // Convert the hours component to 12-hour format if needed
    currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;

    // Convert an hours component of "0" to "12"
    currentHours = ( currentHours == 0 ) ? 12 : currentHours;

    // Compose the string for display
    var currentTimeString = currentdate + " "+ currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
    
    
    $("#clock").html(currentTimeString);
        
 }

</script>



<?php
$base=Yii::app()->theme->baseUrl;
?>
<!-- BEGIN CONTENT BODY -->
   <div class="page-bar">
      <ul class="page-breadcrumb">
         <li>
            <a href="index.html">Home</a>
            <i class="fa fa-circle"></i>
         </li>
         <li>
            <span>Dashboard</span>
         </li>
      </ul>
      <div class="page-toolbar">
         <div id="" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom">
           <span class="thin uppercase hidden-xs" id="clock"><?=date('d-M Y')?>&nbsp;</span>
            <span class="thin uppercase hidden-xs"></span>&nbsp;
       
         </div>
          
      </div>
   </div>
   <div class="marquee_container">  
                       <marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();">
                            <!--<p><b>State Level Empowered Committie Meeting Schedule on 17-04-2017 at 5:00 PM </b></p>-->
                            </marquee>
                        </div>
   <h1 class="page-title"> Admin Dashboard
       <small>statistics, charts, recent events and reports</small>
   </h1>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details">
                    <div class="number">
                       <?php
                         $uid=@$_SESSION['uid'];
                         $time=time();
                         $api_hash=hash_hmac('sha1', md5($uid.$time), SSO_API_PUBLIC_KEY);
                         $post_data=array('user_id'=>$uid,'time'=>$time,'api_hash'=>$api_hash);
                         $response=json_decode(DefaultUtility::postViaCurl(TOKE_API_BASEURL.'/apiv1/TotalNewUserRegistered',$post_data));
                         $user_count=0;
                         if($response->STATUS==200){
                         $user_count=$response->RESPONSE->user_count;
                         }
                       ?>
                        <span data-counter="counterup" data-value="<?=@$user_count?>"></span>
                    </div>
                    <div class="desc"> Active Investors </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                <div class="visual">
                    <i class="fa fa-bar-chart-o"></i>
                </div>
                <div class="details">
                    <div class="number">
                       <?php $stMalecount=ApplicationExt::getProjectTotalStateEMPMale();
                          $stFemalecount= ApplicationExt::getProjectTotalStateEMPFemale();
                       ?>
                        <span data-counter="counterup" data-value="<?=$stMalecount+$stFemalecount?>"></span></div>
                    <div class="desc"> Total Employment </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                <div class="visual">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="<?php echo ApplicationExt::getStateTotalGrievance()  ?>"></span>
                    </div>
                    <div class="desc"> Total Grievance </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                <div class="visual">
                    <i class="fa fa-globe"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="<?php echo ApplicationExt::getProjectTotalStateInvestment()  ?>"></span></div>
                    <div class="desc">Total Investment (in Cr.) </div>
                </div>
            </a>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-lg-6 col-xs-12 col-sm-12">
         <div class="portlet light ">
             <div class="portlet-title">
                 <div class="caption ">
                     <span class="caption-subject font-dark bold uppercase">Monthly Approved</span>
                     <span class="caption-helper">CAF Application</span>
                 </div>
             
                <div class="actions">

    <label><input type="radio" value="0" name="dataset" checked="checked" onclick="selectDataset(0);" />2016</label>
    &nbsp;&nbsp;&nbsp;
    <label><input type="radio" value="1" name="dataset" onclick="selectDataset(1);" />2017</label>&nbsp;&nbsp;&nbsp;

                  <!-- <a class="btn btn-circle btn-icon-only btn-default" href="#">
                      <i class="icon-cloud-upload"></i>
                  </a>
                  <a class="btn btn-circle btn-icon-only btn-default" href="#">
                      <i class="icon-wrench"></i>
                  </a>
                  <a class="btn btn-circle btn-icon-only btn-default" href="#">
                      <i class="icon-trash"></i>
                  </a> -->
                  <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"> </a>
                </div>
            </div>
             <div class="portlet-body">
                 <div id="chart_109" class="CSSAnimationChart" style="height: 500px;"> </div>
             </div>
         </div>
      </div>
      <div class="col-lg-6 col-xs-12 col-sm-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-dark">District Wise</span>
                    <span class="caption-helper">CAF Application</span>
                </div>
                <div class="actions">
                   <!--  <a class="btn btn-circle btn-icon-only btn-default" href="#">
                        <i class="icon-cloud-upload"></i>
                    </a>
                    <a class="btn btn-circle btn-icon-only btn-default" href="#">
                        <i class="icon-wrench"></i>
                    </a>
                    <a class="btn btn-circle btn-icon-only btn-default" href="#">
                        <i class="icon-trash"></i>
                    </a> -->
                    <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"> </a>
                </div>
            </div>
            <div class="portlet-body">
                <div id="chartdiv" class="CSSAnimationChart"></div>
            </div>
        </div>
      </div>
    </div>

    <div class="row">
      <?php
      $apps=ApplicationExt::getDistricPendingMoreThan25();
      // echo "<pre>";print_r($apps);die;
      ?>
      <div class="col-lg-6 col-xs-12 col-sm-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-bar-chart font-green-haze"></i>
                    <span class="caption-subject bold uppercase font-green-haze"> District CAF</span>
                    <span class="caption-helper">More Than 25 Days</span>
                </div>
                <div class="tools">
                   <!--  <a href="javascript:;" class="collapse"> </a>
                    <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                    <a href="javascript:;" class="reload"> </a> -->
                    <a href="javascript:;" class="fullscreen"> </a>
                    <!-- <a href="javascript:;" class="remove"> </a> -->
                </div>
            </div>
            <div class="portlet-body">
                <div id="chart_4" class="chart" style="height: 400px;"> </div>
            </div>
        </div>
      </div>
      <div class="col-lg-6 col-xs-12 col-sm-12">
          <div class="portlet light " style="min-height: 494px">
              <div class="portlet-title">
                  <div class="caption caption-md">
                      <i class="icon-bar-chart font-dark hide"></i>
                      <span class="caption-subject font-dark bold uppercase">Grievances</span>
                      <span class="caption-helper">Report</span>
                  </div>
              </div>
              <div class="portlet-body">
                  <?php
                  $criteria=new CDbCriteria();
                  $criteria->order="grievence_no DESC";
                  $grevienceModel=Grievance::model()->findAll($criteria);
                  // echo "<pre>";print_r($grevienceModel);die;
                  ?>
                  <div class="scroller" style="height: 338px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                      <div class="general-item-list">
                          <?php
                            foreach ($grevienceModel as $key => $grev) {
                              echo ' <div class="item">
                            <div class="item-head">
                              <div class="item-details">
                                <span class="badge  ';
                                   if($grev['grievance_status']=='C'){
                                    echo "badge-success ";
                                  }
                                  else{
                                    echo "badge-danger";
                                  }
                                  echo '">'.$grev['grievence_no'].'</span>
                                  &nbsp;&nbsp; 
                                <a href="mailto:'.$grev['grievence_created_by'].'" class="item-name primary-link">'.$grev['grievence_created_by'].'</a>
                                <span class="item-label">';
                                $now=strtotime(date('Y-m-d H:i:s'));
                                $grevTime=strtotime($grev['grievence_created_on']);
                                $diff=$now-$grevTime;
                                echo DefaultUtility::formatTime($diff)." Ago";
                                echo '</span>
                              </div>
                              <span class="item-status">
                                <span class="badge badge-empty ';
                                  $status='Open';
                                  if($grev['grievance_status']=='C'){
                                    $status='Closed';
                                    echo "badge-success";
                                  }
                                  else{
                                    $status='Open';
                                    echo "badge-danger";
                                  }

                                echo '"></span>'.$status.'</span>
                            </div>
                            <div class="item-body">'.substr($grev['grievence'], 0,100).' </div>
                          </div>';
                            }

                          ?>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
          <!-- BEGIN CHART PORTLET-->
          <div class="portlet light bordered">
              <div class="portlet-title">
                  <div class="caption">
                      <i class="icon-bar-chart font-green-haze"></i>
                      <span class="caption-subject bold uppercase font-green-haze"> Overall State Total </span>
                      <span class="caption-helper">CAF Applications (Total: 
                      <?php
                        $statePendingCAF=ApplicationExt::getTotalCountCAF('P');
                        $stateForwardedCAF=ApplicationExt::getTotalCountCAF('F');
                        $stateRejectedCAF=ApplicationExt::getTotalCountCAF('R');
                        $stateRevertedCAF=ApplicationExt::getTotalCountCAF('H');
                        $stateApprovedCAF=ApplicationExt::getTotalCountCAF('A');
                        $stateIncompleteCAF=ApplicationExt::getTotalCountCAF('I');
                        echo $stateForwardedCAF + $stateApprovedCAF + $statePendingCAF + $stateRevertedCAF + $stateRejectedCAF + $stateIncompleteCAF;
                      ?>)

                      </span>
                  </div>
                  <div class="tools">
                      <a href="javascript:;" class="fullscreen"> </a>
                  </div>
              </div>
              <div class="portlet-body">
                  <div id="chart_7" class="chart" style="height: 400px;"> </div>
                  <div class="well margin-top-20">
                      <div class="row">
                          <div class="col-sm-3">
                              <label class="text-left">Top Radius:</label>
                              <input class="chart_7_chart_input" data-property="topRadius" type="range" min="0" max="1.5" value="1" step="0.01" /> </div>
                          <div class="col-sm-3">
                              <label class="text-left">Angle:</label>
                              <input class="chart_7_chart_input" data-property="angle" type="range" min="0" max="89" value="30" step="1" /> </div>
                          <div class="col-sm-3">
                              <label class="text-left">Depth:</label>
                              <input class="chart_7_chart_input" data-property="depth3D" type="range" min="1" max="120" value="40" step="1" /> </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- END CHART PORTLET-->
      </div>
      <div class="col-md-6">
          <!-- BEGIN CHART PORTLET-->
          <div class="portlet light bordered">
              <div class="portlet-title">
                  <div class="caption">
                      <i class="icon-bar-chart font-green-haze"></i>
                      <span class="caption-subject bold uppercase font-green-haze"> Categories Wise CAF Total </span>
                      <span class="caption-helper">caf
                      <?php
                        $industyEstablish=ApplicationExt::getMicroTotalProject();
                        $totalIndustyEstablish=@$industyEstablish['micro']+@$industyEstablish['small']+@$industyEstablish['medium']+@$industyEstablish['large'];
                        $projectType=ApplicationExt::getProjectStatusTotalProject();
                        $totalProjectType=@$projectType['New']+@$projectType['Expansion']+@$projectType['Diversification'];
                        $industryType=ApplicationExt::getUnitTypeTotalProject();
                        $totalIndustryType=@$industryType['Manufacturing']+@$industryType['Services'];
                        $natureOfOrg=ApplicationExt::getNatureofOrganizationTotal();
                        $totalNatureOfOrg=@$natureOfOrg['Proprietary']+@$natureOfOrg['Partnership']+@$natureOfOrg['Private Limited']+@$natureOfOrg['Public Limited']+@$natureOfOrg['Co-Operative']+@$natureOfOrg['Other'];

                      ?>

                      </span>
                  </div>
                  <div class="tools">
                      <a href="javascript:;" class="fullscreen"> </a>
                  </div>
              </div>
              <div class="portlet-body">
                  <div id="chart_8" class="chart" style="height: 526px;"> </div>
              </div>
          </div>
          <!-- END CHART PORTLET-->
      </div>
    </div>
    <script src="<?=$base?>/assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
    <script src="<?=$base?>/assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
    <script src="<?=$base?>/assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
    <script src="<?=$base?>/assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
    <script src="<?=$base?>/assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
    <script src="<?=$base?>/assets/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
    <script src="<?=$base?>/assets/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
    <script src="<?=$base?>/assets/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
    <script src="<?=$base?>/assets/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
    <script src="<?=$base?>/assets/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
    <?php
    $jan=ApplicationExt::getTotalApprovedMonthwiSECAF('1');
    $feb=ApplicationExt::getTotalApprovedMonthwiSECAF('2');
    $mar=ApplicationExt::getTotalApprovedMonthwiSECAF('3');
    $apr=ApplicationExt::getTotalApprovedMonthwiSECAF('4');
    $may=ApplicationExt::getTotalApprovedMonthwiSECAF('5'); 
    $jun=ApplicationExt::getTotalApprovedMonthwiSECAF('6');
    $jul=ApplicationExt::getTotalApprovedMonthwiSECAF('7');
    $aug=ApplicationExt::getTotalApprovedMonthwiSECAF('8');
    $sept=ApplicationExt::getTotalApprovedMonthwiSECAF('9');
    $oct=ApplicationExt::getTotalApprovedMonthwiSECAF('10');
    $nov=ApplicationExt::getTotalApprovedMonthwiSECAF('11'); 
    $dec=ApplicationExt::getTotalApprovedMonthwiSECAF('12');
    // processing Fees
    $janFee=ApplicationExt::getTotalProcessingFeesMonthWiseCAF('1');
    $febFee=ApplicationExt::getTotalProcessingFeesMonthWiseCAF('2');
    $marFee=ApplicationExt::getTotalProcessingFeesMonthWiseCAF('3');
    $aprFee=ApplicationExt::getTotalProcessingFeesMonthWiseCAF('4');
    $mayFee=ApplicationExt::getTotalProcessingFeesMonthWiseCAF('5'); 
    $junFee=ApplicationExt::getTotalProcessingFeesMonthWiseCAF('6');
    $julFee=ApplicationExt::getTotalProcessingFeesMonthWiseCAF('7');
    $augFee=ApplicationExt::getTotalProcessingFeesMonthWiseCAF('8');
    $septFee=ApplicationExt::getTotalProcessingFeesMonthWiseCAF('9');
    $octFee=ApplicationExt::getTotalProcessingFeesMonthWiseCAF('10');
    $novFee=ApplicationExt::getTotalProcessingFeesMonthWiseCAF('11'); 
    $decFee=ApplicationExt::getTotalProcessingFeesMonthWiseCAF('12');

    /*
    * Distric wise caf Report
    */
    $pending1=ApplicationExt::getTotalDistrictApps('1','P');
    $pending2=ApplicationExt::getTotalDistrictApps('2','P');
    $pending3=ApplicationExt::getTotalDistrictApps('3','P');
    $pending4=ApplicationExt::getTotalDistrictApps('4','P');
     $pending5=ApplicationExt::getTotalDistrictApps('6','P');
    $pending6=ApplicationExt::getTotalDistrictApps('7','P');
    $pending7=ApplicationExt::getTotalDistrictApps('8','P');
    $pending8=ApplicationExt::getTotalDistrictApps('9','P');
    $pending9=ApplicationExt::getTotalDistrictApps('13','P');
    $pending10=ApplicationExt::getTotalDistrictApps('14','P');
    $pending11=ApplicationExt::getTotalDistrictApps('15','P');
    $pending12=ApplicationExt::getTotalDistrictApps('16','P');
    $pending13=ApplicationExt::getTotalDistrictApps('20','P');
    // forwarded
    $forrwd1=ApplicationExt::getTotalDistrictApps('1','F');
    $forrwd2=ApplicationExt::getTotalDistrictApps('2','F');
    $forrwd3=ApplicationExt::getTotalDistrictApps('3','F');
    $forrwd4=ApplicationExt::getTotalDistrictApps('4','F');
    $forrwd5=ApplicationExt::getTotalDistrictApps('6','F');
    $forrwd6=ApplicationExt::getTotalDistrictApps('7','F');
    $forrwd7=ApplicationExt::getTotalDistrictApps('8','F');
    $forrwd8=ApplicationExt::getTotalDistrictApps('9','F');
    $forrwd9=ApplicationExt::getTotalDistrictApps('13','F');
    $forrwd10=ApplicationExt::getTotalDistrictApps('14','F');
    $forrwd11=ApplicationExt::getTotalDistrictApps('15','F');
    $forrwd12=ApplicationExt::getTotalDistrictApps('16','F');
    $forrwd13=ApplicationExt::getTotalDistrictApps('20','F');
    // approved
    $apprv1=ApplicationExt::getTotalDistrictApps('1','A');
    $apprv2=ApplicationExt::getTotalDistrictApps('2','A');
    $apprv3=ApplicationExt::getTotalDistrictApps('3','A');
    $apprv4=ApplicationExt::getTotalDistrictApps('4','A');
    $apprv5=ApplicationExt::getTotalDistrictApps('6','A');
    $apprv6=ApplicationExt::getTotalDistrictApps('7','A');
    $apprv7=ApplicationExt::getTotalDistrictApps('8','A');
    $apprv8=ApplicationExt::getTotalDistrictApps('9','A');
    $apprv9=ApplicationExt::getTotalDistrictApps('13','A');
    $apprv10=ApplicationExt::getTotalDistrictApps('14','A');
    $apprv11=ApplicationExt::getTotalDistrictApps('15','A');
    $apprv12=ApplicationExt::getTotalDistrictApps('16','A');
    $apprv13=ApplicationExt::getTotalDistrictApps('20','A');

    // Rejected
    $reject1=ApplicationExt::getTotalDistrictApps('1','R');
    $reject2=ApplicationExt::getTotalDistrictApps('2','R');
    $reject3=ApplicationExt::getTotalDistrictApps('3','R');
    $reject4=ApplicationExt::getTotalDistrictApps('4','R');
    $reject5=ApplicationExt::getTotalDistrictApps('6','R');
    $reject6=ApplicationExt::getTotalDistrictApps('7','R');
    $reject7=ApplicationExt::getTotalDistrictApps('8','R');
    $reject8=ApplicationExt::getTotalDistrictApps('9','R');
    $reject9=ApplicationExt::getTotalDistrictApps('13','R');
    $reject10=ApplicationExt::getTotalDistrictApps('14','R');
    $reject11=ApplicationExt::getTotalDistrictApps('15','R');
    $reject12=ApplicationExt::getTotalDistrictApps('16','R');
    $reject13=ApplicationExt::getTotalDistrictApps('20','R');

    ?>
    <script type="text/javascript">
      var chart;
      var legend;
      var selected;

      var types = [{
        type: "Industry Established",
        percent: <?=@$totalIndustyEstablish?>,
        color: "#ff9e01",
        subs: [{
          type: "Micro",
          percent: <?=@$industyEstablish['micro']?>
        }, {
          type: "Small",
          percent: <?=@$industyEstablish['small']?>
        }, {
          type: "Medium",
          percent: <?=@$industyEstablish['medium']?>
        }, {
          type: "Large",
          percent: <?=@$industyEstablish['large']?>
        }]
      }, 
      {
        type: "Industry Type",
        percent: <?=@$totalIndustryType?>,
        color: "#b7b83f",
        subs: [{
          type: "Manufacturing",
          percent: <?=@$industryType['Manufacturing']?>
        }, {
          type: "Services",
          percent: <?=@$industryType['Services']?>
        }]
      }, 
      {
        type: "Nature Of Organisation",
        percent: <?=@$totalNatureOfOrg?>,
        color: "#cd82ad",
        subs: [{
          type: "Proprietary",
          percent: <?=@$natureOfOrg['Proprietary']?>
        }, {
          type: "Partnership",
          percent: <?=@$natureOfOrg['Partnership']?>
        }, {
          type: "Private Limited",
          percent: <?=@$natureOfOrg['Private Limited']?>
        }, {
          type: "Public Limited",
          percent: <?=@$natureOfOrg['Public Limited']?>
        }, {
          type: "Co-Operative",
          percent: <?=@$natureOfOrg['Co-Operative']?>
        },
         {
          type: "Other",
          percent: <?=@$natureOfOrg['Other']?>
        }]
      }, 
      {
        type: "Project Type",
        percent: <?=$totalProjectType?>,
        color: "#b0de09",
        subs: [{
          type: "NEW",
          percent: <?=@$projectType['New']?>
        }, {
          type: "EXPANSION",
          percent: <?=@$projectType['Expansion']?>
        }, {
          type: "DIVERSIFICATION",
          percent: <?=@$projectType['Diversification']?>
        }]
      }];
      function generateChartData() {
        var chartData = [];
        for (var i = 0; i < types.length; i++) {
          if (i == selected) {
            for (var x = 0; x < types[i].subs.length; x++) {
              chartData.push({
                type: types[i].subs[x].type,
                percent: types[i].subs[x].percent,
                color: types[i].color,
                pulled: true
              });
            }
          } else {
            chartData.push({
              type: types[i].type,
              percent: types[i].percent,
              color: types[i].color,
              id: i
            });
          }
        }
        return chartData;
      }

      var ChartsAmcharts = function() {
         var e = function() {
                 var e = AmCharts.makeChart("chart_1", {
                     type: "serial",
                     addClassNames: !0,
                     theme: "light",
                     path: "../assets/global/plugins/amcharts/ammap/images/",
                     autoMargins: !1,
                     marginLeft: 45,
                     marginRight: 8,
                     marginTop: 10,
                     marginBottom: 26,
                     dataProvider: [{
                         year: 'MAR',
                         Approved: <?=$mar?>,
                         Fees: <?=$marFee?>,
                         additional: "K"
                     }, {
                         year: 'APR',
                         Approved: <?=$apr?>,
                         Fees: <?=$aprFee?>,
                         additional: "K"
                     }, {
                         year: 'MAY',
                         Approved: <?=$may?>,
                         Fees: <?=$mayFee?>,
                         additional: "K"
                     }, {
                         year: 'JUN',
                         Approved: <?=$jun?>,
                         Fees: <?=$junFee?>,
                         additional: "K"
                     },
                      {
                         year: 'JUL',
                         Approved: <?=$jul?>,
                         Fees: <?=$julFee?>,
                         additional: "K"
                     },
                      {
                         year: 'AUG',
                         Approved: <?=$aug?>,
                         Fees: <?=$augFee?>,
                         additional: "K"
                     },
                      {
                         year: 'SEPT',
                         Approved: <?=$sept?>,
                         Fees: <?=$septFee?>,
                         additional: "K"
                     },
                      {
                         year: 'OCT',
                         Approved: <?=$oct?>,
                         Fees: <?=$octFee?>,
                         additional: "K"
                     },
                      {
                         year: 'NOV',
                         Approved: <?=$nov?>,
                         Fees: <?=$novFee?>,
                         additional: "K"
                     },
                      {
                         year: 'DEC',
                         Approved: <?=$dec?>,
                         Fees: <?=$decFee?>,
                         additional: "K"
                     },{
                         year: 'JAN 2017',
                         Approved: <?=$jan?>,
                         Fees: <?=$janFee?>,
                         additional: "K"
                     }, {
                         year: 'FEB 2017',
                         Approved: <?=$feb?>,
                         Fees: <?=$febFee?>,
                         additional: "K"
                     }],
                     valueAxes: [{
                         axisAlpha: 0,
                         position: "left"
                     }],
                     startDuration: 1,
                     graphs: [{
                         alphaField: "alpha",
                         balloonText: "<span style='font-size:13px;'>[[title]] in [[category]]:<b>[[value]]</b></span>",
                         dashLengthField: "dashLengthColumn",
                         fillAlphas: 1,
                         title: "Approved",
                         type: "column",
                         valueField: "Approved"
                     }, {

                        id: "graph2",
                        balloonText: "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
                        bullet: "round",
                        lineThickness: 3,
                        bulletSize: 7,
                        bulletBorderAlpha: 1,
                        bulletColor: "#FFFFFF",
                        useLineColorForBulletBorder: !0,
                        bulletBorderThickness: 3,
                        fillAlphas: 0,
                        lineAlpha: 1,
                        title: "Fees",
                        valueField: "Fees"
                     }],
                     categoryField: "year",
                     categoryAxis: {
                         gridPosition: "start",
                         axisAlpha: 0,
                         tickLength: 0
                     }
                 });
                 $("#chart_1").closest(".portlet").find(".fullscreen").click(function() {
                     e.invalidateSize()
                 })
          },
          dp=function(){
            var dp=AmCharts.makeChart("chart_8", {
              "type": "pie",
              "theme": "light",

              "dataProvider": generateChartData(),
              "labelText": "[[title]]: [[value]]",
              "balloonText": "[[title]]: [[value]]",
              "titleField": "type",
              "valueField": "percent",
              "outlineColor": "#FFFFFF",
              "outlineAlpha": 0.8,
              "outlineThickness": 2,
              "colorField": "color",
              "fontSize": 8,
        "marginLeft": 30,
        "marginRight": 30,
        "marginBottom": 30,
        "marginTop": 30,
              "autoMargins": false,
              "pulledField": "pulled",
              "titles": [{
                "text": "Click a slice to see the details"
              }],
              "listeners": [{
                "event": "clickSlice",
                "method": function(event) {
                  var chart = event.chart;
                  if (event.dataItem.dataContext.id != undefined) {
                    selected = event.dataItem.dataContext.id;
                  } else {
                    selected = undefined;
                  }
                  chart.dataProvider = generateChartData();
                  chart.validateData();
                }
              }],
              "export": {
                "enabled": true
              }
            });
            $("#chart_8").closest(".portlet").find(".fullscreen").click(function() {
                e.invalidateSize()
            })
          },
          d = function() {
              var e = AmCharts.makeChart("chart_7", {
                  type: "pie",
                  theme: "light",
                  fontFamily: "Open Sans",
                  color: "#888",
                  dataProvider: [{
                      CAF: "Pending",
                      value: <?=$statePendingCAF?>
                  }, {
                      CAF: "Forwarded",
                      value: <?=$stateForwardedCAF?>
                  }, {
                      CAF: "Approved",
                      value: <?=$stateApprovedCAF?>
                  }, {
                      CAF: "Rejected",
                      value: <?=$stateRejectedCAF?>
                  }, {
                      CAF: "Reverted",
                      value: <?=$stateRevertedCAF?>
                  }, {
                      CAF: "Incomplete",
                      value: <?=$stateIncompleteCAF?>
                  }],
                  valueField: "value",
                  titleField: "CAF",
                  outlineAlpha: .4,
                  depth3D: 15,
                  balloonText: "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
                  angle: 5,
                  exportConfig: {
                      menuItems: [{
                          icon: "/lib/3/images/export.png",
                          format: "png"
                      }]
                  }
              });
              jQuery(".chart_7_chart_input").off().on("input change", function() {
                  var t = jQuery(this).data("property"),
                      a = e,
                      l = Number(this.value);
                  e.startDuration = 0, "innerRadius" == t && (l += "%"), a[t] = l, e.validateNow()
              }), $("#chart_7").closest(".portlet").find(".fullscreen").click(function() {
                  e.invalidateSize()
              })
          },
          l = function() {
              var e = AmCharts.makeChart("chart_4", {
                  type: "serial",
                  theme: "light",
                  handDrawn: !0,
                  handDrawScatter: 3,
                  legend: {
                      useGraphSettings: !0,
                      markerSize: 12,
                      valueWidth: 0,
                      verticalGap: 0
                  },
                  dataProvider: [
                  <?php
                    foreach ($apps as $key => $app) {
                       echo "{
                          District : '".$app['distric_name']."',
                          CAF : ".$app['count']."
                       },";
                    }
                    
                  ?>
                  ],
                  valueAxes: [{
                      minorGridAlpha: .08,
                      minorGridEnabled: !0,
                      position: "top",
                      integersOnly: true,
                      axisAlpha: 0
                  }],
                  startDuration: 1,
                  graphs: [{
                      balloonText: "<span style='font-size:13px;'>[[title]] in [[category]]:<b>[[value]]</b></span>",
                      title: "CAF",
                      type: "column",
                      fillAlphas: .8,
                      valueField: "CAF"
                  }],
                  rotate: !0,
                  categoryField: "District",
                  categoryAxis: {
                      gridPosition: "start"
                  }
              });
              $("#chart_4").closest(".portlet").find(".fullscreen").click(function() {
                  e.invalidateSize()
              })
          };
              
          return {
              init: function() {
                  e(),l(),d(),dp();
              }
          }
      }();
      
      jQuery(document).ready(function() {
          setInterval('updateClock()', 1000);
          var pendingCount=$('.totalPendingCAF').val();
          $('.showPendingCAF').text(pendingCount);
          ChartsAmcharts.init();
         var chart = AmCharts.makeChart("chartdiv", {
           "type": "serial",
           "theme": "light",
           "dataDateFormat": "YYYY-MM-DD",
           "precision": 2,
           "valueAxes": [{
             "id": "v1",
             "title": "Total CAF",
             "position": "left",
             "autoGridCount": false,
             "labelFunction": function(value) {
               return Math.round(value);
             }
           }],
           "graphs": [{
             "id": "g3",
             "valueAxis": "v1",
             "lineColor": "#58D3F7",
             "fillColors": "#58D3F7",
             "fillAlphas": 1,
             "type": "column",
             "title": "Pending",
             "valueField": "Pending",
             "clustered": false,
             "columnWidth": 0.5,
             "legendValueText": "[[value]]",
             "balloonText": "[[title]]<br /><b style='font-size: 130%'>[[value]]</b>"
           }, {
             "id": "g4",
             "valueAxis": "v1",
             "lineColor": "#62cf73",
             "fillColors": "#62cf73",
             "fillAlphas": 1,
             "type": "column",
             "title": "Approved",
             "valueField": "Approved",
             "clustered": false,
             "columnWidth": 0.3,
             "legendValueText": "[[value]]",
             "balloonText": "[[title]]<br /><b style='font-size: 130%'>[[value]]</b>"
           }, {
             "id": "g1",
             "valueAxis": "v2",
             "bullet": "round",
             "bulletBorderAlpha": 1,
             "bulletColor": "#FFFFFF",
             "bulletSize": 5,
             "hideBulletsCount": 50,
             "lineThickness": 2,
             "lineColor": "#FFBF00",
             "type": "smoothedLine",
             "title": "Forwarded",
             "useLineColorForBulletBorder": true,
             "valueField": "Forwarded",
             "balloonText": "[[title]]<br /><b style='font-size: 130%'>[[value]]</b>"
           }, {
             "id": "g2",
             "valueAxis": "v2",
             "bullet": "round",
             "bulletBorderAlpha": 1,
             "bulletColor": "#FFFFFF",
             "bulletSize": 5,
             "hideBulletsCount": 50,
             "lineThickness": 2,
             "lineColor": "#DF0101",
             "type": "smoothedLine",
             "dashLength": 5,
             "title": "Rejected",
             "useLineColorForBulletBorder": true,
             "valueField": "Rejected",
             "balloonText": "[[title]]<br /><b style='font-size: 130%'>[[value]]</b>"
           }],
           "chartScrollbar": {
             "graph": "g1",
             "oppositeAxis": false,
             "offset": 30,
             "scrollbarHeight": 50,
             "backgroundAlpha": 0,
             "selectedBackgroundAlpha": 0.1,
             "selectedBackgroundColor": "#888888",
             "graphFillAlpha": 0,
             "graphLineAlpha": 0.5,
             "selectedGraphFillAlpha": 0,
             "selectedGraphLineAlpha": 1,
             "autoGridCount": true,
             "color": "#AAAAAA"
           },
           "chartCursor": {
             "pan": true,
             "valueLineEnabled": true,
             "valueLineBalloonEnabled": true,
             "cursorAlpha": 0,
             "valueLineAlpha": 0.2
           },
           "categoryField": "date",
           "categoryAxis": {
             "parseDates": false,
             "dashLength": 1,
             "minorGridEnabled": true
           },
           "legend": {
             "useGraphSettings": true,
             "position": "top"
           },
           "balloon": {
             "borderThickness": 1,
             "shadowAlpha": 0
           },
           "export": {
            "enabled": true
           },
           "dataProvider": [{
             "date": "AL",
             "Forwarded": <?=$forrwd1?>,
             "Pending": <?=$pending1?>,
             "Approved": <?=$apprv1?>,
             "Rejected": <?=$reject1?>
           }, {
             "date": "BG",
             "Forwarded": <?=$forrwd2?>,
             "Pending": <?=$pending2?>,
             "Approved": <?=$apprv2?>,
             "Rejected": <?=$reject2?>
           }, {
             "date": "CP",
             "Forwarded": <?=$forrwd3?>,
             "Pending": <?=$pending3?>,
             "Approved": <?=$apprv3?>,
             "Rejected": <?=$reject3?>
           }, {
             "date": "CL",
             "Forwarded": <?=$forrwd4?>,
             "Pending": <?=$pending4?>,
              "Approved": <?=$apprv4?>,
             "Rejected": <?=$reject4?>
           }, {
             "date": "DD",
             "Forwarded": <?=$forrwd5?>,
             "Pending": <?=$pending5?>,
             "Approved": <?=$apprv5?>,
             "Rejected": <?=$reject5?>
           }, {
             "date": "HA",
             "Forwarded": <?=$forrwd6?>,
             "Pending": <?=$pending6?>,
              "Approved": <?=$apprv6?>,
             "Rejected": <?=$reject6?>
           }, {
             "date": "NA",
             "Forwarded": <?=$forrwd7?>,
             "Pending": <?=$pending7?>,
              "Approved": <?=$apprv7?>,
             "Rejected": <?=$reject7?>
           }, {
             "date": "PG",
             "Forwarded": <?=$forrwd8?>,
             "Pending": <?=$pending8?>,
              "Approved": <?=$apprv8?>,
             "Rejected": <?=$reject8?>
           }, {
             "date": "PI",
             "Forwarded": <?=$forrwd9?>,
             "Pending": <?=$pending9?>,
              "Approved": <?=$apprv9?>,
             "Rejected": <?=$reject9?>
           }, {
             "date": "RP",
             "Forwarded": <?=$forrwd10?>,
             "Pending": <?=$pending10?>,
              "Approved": <?=$apprv10?>,
             "Rejected": <?=$reject10?>
           }, {
             "date": "TG",
             "Forwarded": <?=$forrwd11?>,
             "Pending": <?=$pending11?>,
              "Approved": <?=$apprv11?>,
             "Rejected": <?=$reject11?>
           }, {
             "date": "US",
             "Forwarded": <?=$forrwd12?>,
             "Pending": <?=$pending12?>,
              "Approved": <?=$apprv12?>,
             "Rejected": <?=$reject12?>
           }, {
             "date": "UT",
             "Forwarded": <?=$forrwd13?>,
             "Pending": <?=$pending13?>,
             "Approved": <?=$apprv13?>,
             "Rejected": <?=$reject13?>
           }]
         });

      });






var chart;

var chartData = [
    // Data set #1
    [
		{ country: "JAN", Approved: <?php echo ApplicationExt::getTotalApprovedMonthWiseWithYearCAF(1,2016)?>},
        { country: "FEB", Approved: <?php echo ApplicationExt::getTotalApprovedMonthWiseWithYearCAF(2,2016)?>},
        { country: "MAR", Approved: <?php echo ApplicationExt::getTotalApprovedMonthWiseWithYearCAF(3,2016)?>},
        { country: "APR", Approved: <?php echo ApplicationExt::getTotalApprovedMonthWiseWithYearCAF(4,2016)?>},
        { country: "MAY", Approved: <?php echo ApplicationExt::getTotalApprovedMonthWiseWithYearCAF(5,2016)?>},
        { country: "JUN", Approved: <?php echo ApplicationExt::getTotalApprovedMonthWiseWithYearCAF(6,2016)?>},
        { country: "JUL", Approved: <?php echo ApplicationExt::getTotalApprovedMonthWiseWithYearCAF(7,2016)?>},
        { country: "AUG", Approved: <?php echo ApplicationExt::getTotalApprovedMonthWiseWithYearCAF(8,2016)?>},
        { country: "SEP", Approved: <?php echo ApplicationExt::getTotalApprovedMonthWiseWithYearCAF(9,2016)?>},
        { country: "OCT", Approved: <?php echo ApplicationExt::getTotalApprovedMonthWiseWithYearCAF(10,2016)?>},
        { country: "NOV", Approved: <?php echo ApplicationExt::getTotalApprovedMonthWiseWithYearCAF(11,2016)?>},
        { country: "DEC", Approved: <?php echo ApplicationExt::getTotalApprovedMonthWiseWithYearCAF(12,2016)?>}
 
    ],
    // Data set #2
    [
        { country: "JAN", Approved: <?php echo ApplicationExt::getTotalApprovedMonthWiseWithYearCAF(1,2017)?>},
        { country: "FEB", Approved: <?php echo ApplicationExt::getTotalApprovedMonthWiseWithYearCAF(2,2017)?>},
        { country: "MAR", Approved: <?php echo ApplicationExt::getTotalApprovedMonthWiseWithYearCAF(3,2017)?>},
        { country: "APR", Approved: <?php echo ApplicationExt::getTotalApprovedMonthWiseWithYearCAF(4,2017)?>},
        { country: "MAY", Approved: <?php echo ApplicationExt::getTotalApprovedMonthWiseWithYearCAF(5,2017)?>},
        { country: "JUN", Approved: <?php echo ApplicationExt::getTotalApprovedMonthWiseWithYearCAF(6,2017)?>},
        { country: "JUL", Approved: <?php echo ApplicationExt::getTotalApprovedMonthWiseWithYearCAF(7,2017)?>},
        { country: "AUG", Approved: <?php echo ApplicationExt::getTotalApprovedMonthWiseWithYearCAF(8,2017)?>},
        { country: "SEP", Approved: <?php echo ApplicationExt::getTotalApprovedMonthWiseWithYearCAF(9,2017)?>},
        { country: "OCT", Approved: <?php echo ApplicationExt::getTotalApprovedMonthWiseWithYearCAF(10,2017)?>},
        { country: "NOV", Approved: <?php echo ApplicationExt::getTotalApprovedMonthWiseWithYearCAF(11,2017)?>},
        { country: "DEC", Approved: <?php echo ApplicationExt::getTotalApprovedMonthWiseWithYearCAF(12,2017)?>}
    ]
]
AmCharts.ready(function() {
    // RADAR CHART
    chart = new AmCharts.AmSerialChart();

    chart.dataProvider = chartData[0];
    chart.categoryField = "country";
    chart.startDuration = 1;
    chart.sequencedAnimation = false;

    // VALUE AXIS
    var valueAxis = new AmCharts.ValueAxis();
    valueAxis.axisAlpha = 0.15;
    valueAxis.minimum = 0;
    valueAxis.dashLength = 3;
    valueAxis.integersOnly = true;
    chart.addValueAxis(valueAxis);

    // GRAPH
    var graph = new AmCharts.AmGraph();
    graph.type = "column";
    graph.valueField = "Approved";
    graph.fillAlphas = 0.6;
    graph.fillColorsField= "color";
    graph.balloonText = "[[value]] CAF has been Approved";
    chart.addGraph(graph);

    // WRITE
    chart.write("chart_109");
});

function selectDataset(d) {
    chart.dataProvider = chartData[d];
    chart.validateData();
    chart.animateAgain();
}


    </script>

         