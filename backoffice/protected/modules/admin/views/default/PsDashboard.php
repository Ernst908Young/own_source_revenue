<?php
die('dcdscsd');
$grandtotal=0; $grandopen=0; $grandclose=0;$resultarr=array();
$sql="SELECT submission_id,application_created_date from bo_application_submission ORDER BY application_created_date";
   $connection=Yii::app()->db;
   $command=$connection->createCommand($sql);
   $datefirst=$command->queryAll();
    $rer=$datefirst[0]['application_created_date'];
    $stateProcesed="'0'";$statePending="'0'";
if(isset($_POST['financial_year'])) {
 $financial_year=$_POST['financial_year']; //print_r($financial_year); //die;
 if($financial_year=="ALL"){ $startdate=date('Y-m-d', strtotime($rer)); $enddate=date('Y-m-d'); }
 else if($financial_year!="ALL"){
 $data=explode("-",$financial_year); $startdate=$data[0]."-04-01"; $enddate=$data[1]."-03-31";
 }
 }
else {
   $fDate = date('Y-m-d');
   //$fDate = '2015-04-01';
   $keyy=explode("-",$fDate);
    $todayDate=date('Y-m-d', strtotime($fDate));
    $sdate=$keyy[0]."-04-01";
    $DateBegin = date('Y-m-d', strtotime($sdate));
    $yy=$keyy[0]; $yy1=$keyy[0]+1; $yy2=$keyy[0]-1;

    if (($todayDate >= $DateBegin)) { $financial_year=$yy."-".$yy1; }
    else if (($todayDate < $DateBegin)) { $financial_year=$yy2."-".$yy; }
$data=explode("-",$financial_year);
$startdate=$data[0]."-04-01";
$enddate=date('Y-m-d'); }

$enddate=date('Y-m-d',strtotime($enddate. '+1 day'));


//print_r($startdate); print_r($enddate); die;

 $sql="SELECT bo_application_forward_level.app_Sub_id,bac.submission_id,bac.application_status,bd.distric_name,bo_application_forward_level.created_on
from  bo_application_forward_level
LEFT JOIN bo_application_submission as bac ON bac.submission_id=bo_application_forward_level.app_Sub_id
LEFT JOIN bo_district as bd ON bd.district_id=bac.landrigion_id
where bo_application_forward_level.forwarded_dept_id = $_SESSION[dept_id]
AND bac.application_id=1 AND bac.submission_id not in('22','268') AND bo_application_forward_level.approv_status='P' AND bo_application_forward_level.next_role_id=5
AND bac.application_status ='F'
AND bo_application_forward_level.created_on >='".$startdate."' AND bo_application_forward_level.created_on <'".$enddate."' GROUP BY bac.submission_id";
$connection=Yii::app()->db;
$command=$connection->createCommand($sql);
$appSub=$command->queryAll();
foreach($appSub as $rte){$statePending="'".$rte['submission_id']."',".$statePending;}
$statePendingCAF=count($appSub);
//print_r($appSub);

// State Processed CAF
 $sqlsas="SELECT bo_application_forward_level.app_Sub_id,bac.submission_id,bac.application_status,bd.distric_name,bo_application_forward_level.created_on
          from  bo_application_forward_level
         LEFT JOIN bo_application_submission as bac ON bac.submission_id=bo_application_forward_level.app_Sub_id
         LEFT JOIN bo_district as bd ON bd.district_id=bac.landrigion_id
         where bo_application_forward_level.forwarded_dept_id = $_SESSION[dept_id]
        AND bac.application_id=1
        AND bac.application_status in('A','R','H','F') AND bac.submission_id not in('22','268') AND bo_application_forward_level.approv_status!='P' AND bo_application_forward_level.next_role_id=5
        AND bo_application_forward_level.created_on >='".$startdate."' AND bo_application_forward_level.created_on <'".$enddate."' AND bac.submission_id NOT IN($statePending) GROUP BY bac.submission_id";
$connection=Yii::app()->db;
$command=$connection->createCommand($sqlsas);
$applicationSub=$command->queryAll();
foreach($applicationSub as $jh){$stateProcesed="'".$jh['submission_id']."',".$stateProcesed;}
$stateProcessedCAF=count($applicationSub);
//echo "<pre>";print_r($applicationSub);
// State Processed without comment CAF
 $sqlsas="SELECT bo_application_forward_level.app_Sub_id,bac.submission_id,bac.application_status,bd.distric_name,bo_application_forward_level.created_on
          from  bo_application_forward_level
         LEFT JOIN bo_application_submission as bac ON bac.submission_id=bo_application_forward_level.app_Sub_id
         LEFT JOIN bo_district as bd ON bd.district_id=bac.landrigion_id
         where bo_application_forward_level.forwarded_dept_id = $_SESSION[dept_id]
        AND bac.application_id=1
        AND bac.application_status in('A','R') AND bac.submission_id not in('22','268') AND bo_application_forward_level.approv_status='P' AND bo_application_forward_level.next_role_id=5
        AND bo_application_forward_level.created_on >='".$startdate."' AND bo_application_forward_level.created_on <'".$enddate."' AND bac.submission_id NOT IN ($stateProcesed) GROUP BY bac.submission_id ORDER BY bo_application_forward_level.created_on ";
$connection=Yii::app()->db;
$command=$connection->createCommand($sqlsas);
$applicationSub=$command->queryAll();
$stateProcessedWithoutResponseCAF=count($applicationSub);
//echo "<pre>";print_r($applicationSub);die;
//echo "state without respoce: ";print_r($stateProcessedWithoutResponseCAF);


$sql="SELECT * FROM bo_district";
$connection=Yii::app()->db;
$command=$connection->createCommand($sql);
$distDAta=$command->queryAll();

$allpending=0; $allprocessed=0;$pending=array();
foreach($distDAta as $ljk){
$processedCAF=0;$pendingCAF=0;$dID=$ljk['district_id'];$processedWithoutResponse=0;
 $pending[$dID]['name']=$ljk['distric_name'];
 $pending[$dID]['pending']=0;
 $pending[$dID]['processed']=0;
$sqlhjgjh="SELECT bo_application_forward_level.approv_status,bac.application_status,bo_application_forward_level.app_Sub_id,bac.submission_id,bac.application_status,bd.distric_name,bo_application_forward_level.created_on
from  bo_application_forward_level
LEFT JOIN bo_application_submission as bac ON bac.submission_id=bo_application_forward_level.app_Sub_id
LEFT JOIN bo_district as bd ON bd.district_id=bac.landrigion_id
where bo_application_forward_level.forwarded_dept_id = $_SESSION[dept_id]
AND bac.application_id=1 AND bac.submission_id not in('22','268')
AND bac.landrigion_id=$dID AND bo_application_forward_level.next_role_id=3
AND bo_application_forward_level.created_on >='".$startdate."' AND bo_application_forward_level.created_on <'".$enddate."' GROUP BY bac.submission_id";

$connection=Yii::app()->db;
$command=$connection->createCommand($sqlhjgjh);
$allData=$command->queryAll();
 //print_r($allData); die;
// echo "===========";die;
foreach($allData as $ljkdd){

   if($ljkdd['approv_status']=="P" && $ljkdd['application_status']=="F"){
       $pendingCAF=$pendingCAF+1;
       $allpending=$allpending+1;
           $hjk[$dID][]=$ljkdd['submission_id'];
   }elseif($ljkdd['approv_status']=="P" && $ljkdd['application_status']=="A"){
       $processedWithoutResponse=$processedWithoutResponse+1;
   }elseif($ljkdd['approv_status']=="P" && $ljkdd['application_status']=="R" ){
        $processedWithoutResponse=$processedWithoutResponse+1;
   }else{
        if($ljkdd['approv_status']=="V"){
       $processedCAF=$processedCAF+1;
        $allprocessed=$allprocessed+1;
        }
   }
  
$pending[$dID]['pending']=$pendingCAF;
$pending[$dID]['processedWithoutResponse']=$processedWithoutResponse;

/////////////////////////////////////////////////////////////////////////////////////////

$sqlsasgfdg="SELECT bo_application_forward_level.app_Sub_id,bac.submission_id,bac.application_status,bd.distric_name,bo_application_forward_level.created_on
          from  bo_application_forward_level
         LEFT JOIN bo_application_submission as bac ON bac.submission_id=bo_application_forward_level.app_Sub_id
         LEFT JOIN bo_district as bd ON bd.district_id=bac.landrigion_id
         where bo_application_forward_level.forwarded_dept_id = $_SESSION[dept_id]
         AND bac.landrigion_id=$dID
        AND bac.application_id=1
        AND bac.application_status in('A','R','H','F') AND bac.submission_id not in('22','268') AND bo_application_forward_level.approv_status='V' AND bo_application_forward_level.next_role_id=3
        AND bo_application_forward_level.created_on >='".$startdate."' AND bo_application_forward_level.created_on <'".$enddate."' GROUP BY bac.submission_id ORDER BY bo_application_forward_level.created_on ";
$connection=Yii::app()->db;
$command=$connection->createCommand($sqlsasgfdg);
$applicationSubhjgj=$command->queryAll();
$allprocessedhgfhg=count($applicationSubhjgj);


   //
     $pending[$dID]['processed']=$allprocessedhgfhg;
//////////////////////////////////////////////////////////////////////////////////////////////////////////
}

}
// District Prcessed without comment CAF
 $sqlsas="SELECT bo_application_forward_level.app_Sub_id,bac.submission_id,bac.application_status,bd.distric_name,bo_application_forward_level.created_on
          from  bo_application_forward_level
         LEFT JOIN bo_application_submission as bac ON bac.submission_id=bo_application_forward_level.app_Sub_id
         LEFT JOIN bo_district as bd ON bd.district_id=bac.landrigion_id
         where bo_application_forward_level.forwarded_dept_id = $_SESSION[dept_id]
        AND bac.application_id=1
        AND bac.application_status in('A','R') AND bac.submission_id not in('22','268') AND bo_application_forward_level.approv_status='P' AND bo_application_forward_level.next_role_id=3
        AND bo_application_forward_level.created_on >='".$startdate."' AND bo_application_forward_level.created_on <'".$enddate."' GROUP BY bac.submission_id ORDER BY bo_application_forward_level.created_on ";
$connection=Yii::app()->db;
$command=$connection->createCommand($sqlsas);
$applicationSub=$command->queryAll();
$districtProcessedWithoutResponseCAF=count($applicationSub);
 //print_r($DistrictProcessedWithoutResponseCAF);
//die;

// District Prcessed CAF
 $sqlsas="SELECT bo_application_forward_level.app_Sub_id,bac.submission_id,bac.application_status,bd.distric_name,bo_application_forward_level.created_on
          from  bo_application_forward_level
         LEFT JOIN bo_application_submission as bac ON bac.submission_id=bo_application_forward_level.app_Sub_id
         LEFT JOIN bo_district as bd ON bd.district_id=bac.landrigion_id
         where bo_application_forward_level.forwarded_dept_id = $_SESSION[dept_id]
        AND bac.application_id=1
        AND bac.application_status in('A','R','H','F') AND bac.submission_id not in('22','268') AND bo_application_forward_level.approv_status='V' AND bo_application_forward_level.next_role_id=3
        AND bo_application_forward_level.created_on >='".$startdate."' AND bo_application_forward_level.created_on <'".$enddate."' GROUP BY bac.submission_id ORDER BY bo_application_forward_level.created_on ";
$connection=Yii::app()->db;
$command=$connection->createCommand($sqlsas);
$applicationSub=$command->queryAll();
$allprocessed=count($applicationSub);

//////////////////////////////////////////////////////////////////////////Grivance/////////////////////////////////////////////////////////////////////
foreach($distDAta as $hjgkghk){
    $key=$hjgkghk['district_id'];
    $resultarr[$key]['dname']=$hjgkghk['distric_name'];
					$resultarr[$key]['open']=0;
					$resultarr[$key]['close']=0;
					$resultarr[$key]['total']=0; 
    
}
 	
	$sqlgfgf="SELECT d.department_name ,gd.grievence_no ,g.grievance_status,g.grievence_created_on ,gsd.status_change_date ,
	ds.distric_name ,ds.district_id FROM bo_grievance g
INNER JOIN bo_grievance_detail gd ON g.grievence_no = gd.grievence_no
INNER JOIN bo_departments d ON gd.dept_id=d.dept_id
INNER JOIN bo_district ds ON gd.district_id=ds.district_id
LEFT JOIN bo_grievance_status_detail gsd ON gsd.grievence_no=g.grievence_no where  
d.dept_id='".$_SESSION['dept_id']."' and g.grievance_status IN ('O','C')
and g.grievence_created_on >='".$startdate."' and g.grievence_created_on <'".$enddate."' ";     
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sqlgfgf);
		$Fields=$command->queryAll();	
		// echo "<pre>";print_r($Fields); die;
		  if(!empty($Fields))
		{
		
		foreach ($Fields as $key => $field)
		{  
		if( isset($field['district_id'])) 
			{  	
			   $sectorid=$field['district_id'];
			   $newdetails[$sectorid][$key]['grievence_no']=$field['grievence_no']; 
			   $newdetails[$sectorid][$key]['grievance_status']=$field['grievance_status']; 
			   $newdetails[$sectorid][$key]['distname']=$field['distric_name'];       
			}
			
		 }
		// print_r($newdetails); die;
		
		 foreach ($newdetails as $key => $countdetails)
		    {     $open=0; $close=0; 
					foreach($countdetails as $df){  //print_r($df); die;
					 if($df['grievance_status']=='O') { $open=$open+1; }
					 if($df['grievance_status']=='C') { $close=$close+1; }
					 $resultarr[$key]['dname']=$df['distname'];
					$resultarr[$key]['open']=$open;
					$resultarr[$key]['close']=$close;
					$resultarr[$key]['total']=$open+$close;
												 }
					$grandtotal=$grandtotal+($open+$close);
					$grandopen=$grandopen+$open;
					$grandclose=$grandclose+$close;						 
			} 
		//	print_r($resultarr);
		 
		}
				 
	// die;
	
?>

<style type="text/css">
  #chartdiv {
  width: 100%;
  height: 500px;
}
</style>
<?php

   $deptModel = new DepartmentsExt;

   $dept      = $deptModel->getDeptbyId($_SESSION['dept_id']);

?>

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
<br />
   <div class="page-bar">
      <ul class="page-breadcrumb">
         <li>
                 <?php echo "<b>Welcome -" . $dept['department_name'] ?> <?php if(DefaultUtility::is_PRINCIPAL_SECRETARY()){ ?>State Level Monitoring<?php } ?>  </b>
         </li>
      </ul>

      <div class="page-toolbar">
         <div id="" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom">
           <span class="thin uppercase hidden-xs" id="clock"><?=date('d-M Y')?>&nbsp;</span>
            <span class="thin uppercase hidden-xs"></span>&nbsp;

         </div>
      </div>
   </div>

   <br />
   <?php

    ///////////////////////////////////Previous Date //////////////////////////////////////////////
   $previousdate=date('Y-m-d', strtotime($rer)); $keyyfd=explode("-",$previousdate);
    $ppdate=$keyyfd[0]."-04-01"; //echo "<br>";
       $ppstartBegin = date('Y-m-d', strtotime($ppdate));
     if ($previousdate >= $ppstartBegin) {  $pp=$keyyfd[0];  } else {  $pp=$keyyfd[0]-1;  }

     ///////////////////////////////////Current Date //////////////////////////////////////////////
    $gfg=date('Y-m-d');
   $todayDate=date('Y-m-d', strtotime($gfg)); $keyyfdgfg=explode("-",$todayDate);  // echo "<br>";
    $ssdate=$keyyfdgfg[0]."-04-01";
    $startBegin = date('Y-m-d', strtotime($ssdate));
    if ($todayDate >= $startBegin) {  $yyy=$keyyfdgfg[0]+1; } else {  $yyy=$keyyfdgfg[0]; }
//////////////////////////////////////////////////////////////////////////////////////////////////////
?>
  <div class="portlet-body">
      

    <div class="clearfix">
   <br />
   <div class="page-bar">
   <form name="form" action="" method="POST" >
   <table>
   <tr>
   <td><b>Currently you are viewing data for "<?php echo $financial_year; ?>" ,If you want to change then select Financial Year : </b>&nbsp;&nbsp;</td>
   <td>
    <select name="financial_year" class="form-control" onchange="this.form.submit()"  >
          <option value="ALL" <?php if($financial_year=="ALL"){ echo "selected='selected'"; } ?> >ALL</option>
   <?php for($i=$pp;$i<$yyy;$i++){ $j=$i+1; $k=$i.'-'.$j; ?>
         <option value="<?php echo $k; ?>" <?php if($financial_year==$k){ echo "selected='selected'"; } ?>><?php echo $k; ?></option>
    <?php } ?>
    </select>
       </td>
         <td style="padding-left:100px;padding-right:20px"><b>Selected Department</b></td>
          <td> 
   <select name="department" style="float:left;" class="form-control" onchange="window.location.href='/backoffice/mis/psReport/change/id/'+this.value;"                         >
    <?php $allList=ApplicationExt::getMasterList('bo_departments','dept_id','department_name'); ?>
            <?php foreach($allList as $k=>$v){ ?> 
    <option value="<?php echo $k;?>" <?php if(!empty($_SESSION['dept_id']) && $_SESSION['dept_id']==$k){ echo " selected"; } ?>><?php echo $v; ?></option> 
            <?php } ?>
          </select>  
</td>
   </tr>

   </table>
         </form>
         </div>
        <hr />
		</div></div>


      <div class="page-bar alert-info">
          <ul class="page-breadcrumb " style="text-align:center;width:100%;">
         <li>
         <h3><b>OVERALL CAF (<?php echo $allprocessed+$allpending+$stateProcessedCAF+$statePendingCAF+$districtProcessedWithoutResponseCAF+$stateProcessedWithoutResponseCAF; ?>)</b></h3>
         </li>
      </ul>
          </div>

    <div class="row">

        <div class="portlet light bordered col-md-6">
                                    <div class="portlet-title">
                                        <div class="caption" style="width:100%;text-align: center;">
                                            <span class="caption-subject font-dark bold uppercase text-center">
                                         Total District Level CAF </b>(<?php echo $allprocessed+$allpending+$districtProcessedWithoutResponseCAF; ?>)</b> </span>
                                        </div>

                                    </div>
                                    <div class="portlet-body">

        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-16">
           <a class="dashboard-stat dashboard-stat-v2 blue" href="/backoffice/mis/psReport/disposeddistrict?financial_year=<?=$financial_year?>">
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details">
                    <div class="number"> <?=$allprocessed?>

                        <!--<span data-counter="counterup" data-value=""></span>-->
                    </div>
                    <div class="desc">CAF Disposed</div>
                </div>
            </a>
        </div>
<div class="col-lg-4 col-md-4 col-sm-8 col-xs-16">
            <a class="dashboard-stat dashboard-stat-v2 yellow" href="/backoffice/mis/psReport/districtdisposedwithoutcomment/fID/<?=$financial_year?>">
                <div class="visual">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <div class="details">
                    <div class="number"><?=$districtProcessedWithoutResponseCAF?>
                       <!-- <span data-counter="counterup" data-value="<?=$districtProcessedWithoutResponseCAF;?>"></span>-->
                    </div>
                    <div class="desc" style="text-align:right;">CAF Disposed without Response</div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-16">
          <a class="dashboard-stat dashboard-stat-v2 red" href="/backoffice/mis/psReport/PendencyreportHod/days/0/daysto/10000/bw/<?=$financial_year?>">
                <div class="visual">
                    <i class="fa fa-bar-chart-o"></i>
                </div>
                <div class="details">
                    <div class="number">
                       <?=$allpending?>
                       <!-- <span data-counter="counterup" data-value=""></span>-->
                       </div>
                    <div class="desc">Pending CAF  </div>
                </div>
            </a>
        </div>
                                    </div>
                                </div>


      <div class="portlet light bordered col-md-6">
                                    <div class="portlet-title">
                                        <div class="caption" style="width:100%;text-align: center;">
                                            <span class="caption-subject font-dark bold uppercase text-center">
                                         Total State Level CAF </b>(<?php echo $stateProcessedCAF+$statePendingCAF+$stateProcessedWithoutResponseCAF;; ?>)</b> </span>
                                        </div>

                                    </div>
                                    <div class="portlet-body">
        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-16">
            <a class="dashboard-stat dashboard-stat-v2 blue" href="/backoffice/mis/psReport/index/fID/<?=$financial_year?>">
                <div class="visual">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <div class="details">
                    <div class="number"><?=$stateProcessedCAF?>
                       <!-- <span data-counter="counterup" data-value="<?=$stateProcessedCAF?>"></span>-->
                    </div>
                    <div class="desc">CAF Disposed</div>
                </div>
            </a>
        </div>
                                         <div class="col-lg-4 col-md-4 col-sm-8 col-xs-16">
            <a class="dashboard-stat dashboard-stat-v2 yellow" href="/backoffice/mis/psReport/statedisposedwithoutcomment/fID/<?=$financial_year?>">
                <div class="visual">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <div class="details">
                    <div class="number"><?=$stateProcessedWithoutResponseCAF?>
                       <!-- <span data-counter="counterup" data-value="<?=$stateProcessedWithoutResponseCAF?>"></span>-->
                    </div>
                    <div class="desc" style="text-align:right;">CAF Disposed without Response</div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-16">
            <a class="dashboard-stat dashboard-stat-v2 red" href="/backoffice/mis/psReport/PendencyreportHodState/days/0/daysto/10000/bw/<?=$financial_year?>">
                <div class="visual">
                    <i class="fa fa-bar-chart-o"></i>
                </div>
                <div class="details">
                    <div class="number"><?=$statePendingCAF?>
                        <!--<span data-counter="counterup" data-value="<?=$statePendingCAF?>"></span>-->
                        </div>
                    <div class="desc">Pending CAF </div>
                </div>
            </a>
        </div>
            </div>
                                </div>
    </div>
    <br />

 <!--------------------------------------------------------------------------------------------------------------------------------------------------------->
  <div class="page-bar alert-info">
          <ul class="page-breadcrumb " style="text-align:center;width:100%;">
         <li>
         <h3><b>TOTAL GRIEVANCE <a href="/backoffice/mis/GrievanceReport/greviencetotaldetailhod/d/<?=$_SESSION['dept_id']?>/s/T/d1/<?=$startdate?>/d2/<?=$enddate?>">(<?php echo @$grandtotal; ?>)</a> </b></h3> 
         </li>
      </ul>
          </div>

    <div class="row">

      
       <div class="portlet light bordered col-md-6">
             <div class="col-lg-12 col-md-12 col-sm-16 col-xs-32" >
           <a class="dashboard-stat dashboard-stat-v2 blue" href="/backoffice/mis/GrievanceReport/greviencetotaldetailhod/d/<?=$_SESSION['dept_id']?>/s/C/d1/<?=$startdate?>/d2/<?=$enddate?>">
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
               <div class="details" style="right: 0px;width: 100%;">
                   <div class="number" style="text-align:center;"> <?php echo $grandclose;?>
          </div>
                    <div class="desc" style="text-align:center;">Close</div>
                </div>
            </a>
        </div>
                                   
		</div>
			 <div class="portlet light bordered col-md-6">
             <div class="col-lg-12 col-md-12 col-sm-16 col-xs-32" >
           <a class="dashboard-stat dashboard-stat-v2 red" href="/backoffice/mis/GrievanceReport/greviencetotaldetailhod/d/<?=$_SESSION['dept_id']?>/s/O/d1/<?=$startdate?>/d2/<?=$enddate?>">
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details" style="right: 0px;width: 100%;">
                   <div class="number" style="text-align:center;">  <?php echo $grandopen;?>

                     </div>
                    <div class="desc" style="text-align:center;">Open</div>
                </div>
            </a>
        </div>
                                   
		</div>							
		</div>							
<!-------------------------------------------------------------------------------------------------------------------------------------------------------->
   <div class="col-lg-6 col-xs-12 col-sm-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <?php $totalcafall=$allprocessed + $allpending +$districtProcessedWithoutResponseCAF + $statePendingCAF + $stateProcessedCAF +$stateProcessedWithoutResponseCAF;  ?>
                    <span class="caption-subject bold uppercase font-dark">Overall CAF (State + District) : <?php echo $totalcafall; ?> </span>
					<br /><span style="font-size:12px" class="caption-subject bold font-dark">(*CAF disposed without comments : <?php echo $districtProcessedWithoutResponseCAF+$stateProcessedWithoutResponseCAF; ?> )</span>
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
      <div class="col-md-6">
       <!-- BEGIN CHART PORTLET-->
          <div class="portlet light bordered">
              <div class="portlet-title">
                  <div class="caption">
                      <i class="icon-bar-chart font-green-haze"></i>
                      <span class="caption-subject bold uppercase font-green-haze"> Overall Pending CAF (State + District)</span>
                      <span class="caption-helper">(Total: <?php   echo $statePendingCAF + $allpending ;  ?>)

                      </span>
                  </div>
                  <div class="tools">
                      <a href="javascript:;" class="fullscreen"> </a>
                  </div>
              </div>
              <div class="portlet-body">
                  <div id="chartdivpie" class="chart" style="height: 500px;"> </div>
              </div>
          </div>
          <!-- END CHART PORTLET-->

      </div>
</div>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------>

<div class="col-lg-6 col-xs-12 col-sm-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <?php $totalcafall=$allprocessed + $allpending +$districtProcessedWithoutResponseCAF + $statePendingCAF + $stateProcessedCAF +$stateProcessedWithoutResponseCAF;  ?>
                    <span class="caption-subject bold uppercase font-dark">Total Grievance: <?php echo @$grandtotal; ?> </span>
					<br /><span style="font-size:12px" class="caption-subject bold font-dark"></span>
        </div>
                <div class="actions">
                    <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"> </a>
                </div>
            </div>
            <div class="portlet-body">
                <div id="chartdivGrivance" class="CSSAnimationChart"></div>
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
                      <span class="caption-subject bold uppercase font-green-haze"> Total Open Grievance</span>
                      <span class="caption-helper">(Total: <?php   echo @$grandopen;  ?>)

                      </span>
                  </div>
                  <div class="tools">
                      <a href="javascript:;" class="fullscreen"> </a>
                  </div>
              </div>
              <div class="portlet-body">
                  <div id="chartdivpieGrivance" class="chart" style="height: 500px;"> </div>  
              </div>
          </div>
          <!-- END CHART PORTLET-->

      </div>
</div>

<!------------------------------------------------------------------------------------------------------------------------------------------------------------>
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

<?php             $r1[]= array();
                  $r1[1]="#FF6600";  $r1[2]="#41e8f4"; $r1[3]="#DDDDDD";  $r1[4]="#F8FF01";  //#FCD202   #f44141
                  $r1[6]="#27a352"; $r1[7]="#0D8ECF"; $r1[8]="#f441f1";  $r1[9]="#2A0CD0"; $r1[10]="#8A0CCF";
                  // $r1[5]="B0DE09";
                  $r1[13]="#FF9E01"; $r1[14]="#B0DE09"; $r1[15]="#f44197";$r1[16]="#f4dc41"; $r1[20]="#41f455";
                  $chartdata[]= array();
                 // print_r($pending); //die;
                  foreach($pending as $hghg => $endin)
        {

                $chartdata[$hghg]=$endin;
                $chartdata[$hghg]['color']= @$r1[$hghg];

        }
        unset($chartdata[0]);
        //print_r($chartdata);
    ?>

  <script>
  var chart = AmCharts.makeChart( "chartdivpie", {
  "type": "pie",
  "theme": "light",
  "titles": [ {
    "text": "",
    "size": 16
  } ],
  "dataProvider": [
  <?php foreach($chartdata as $ee=>$chartgfgf){ ?>
        {
            "country": "<?=$chartgfgf['name']?>",
            "visits":<?=$chartgfgf['pending']?>,
            "color":"<?=$chartgfgf['color']?>",
                        "url": "/backoffice/mis/psReport/detailpendencyreport1/id/<?=$ee?>/days/0/daysto/10000/bw/<?=$financial_year?>"
        },
  <?php } ?>
   {
    "country": "State Level",
    "visits":<?=$statePendingCAF?>,
    "color": "#CD0D74",
        "url": "/backoffice/mis/psReport/PendencyreportHodState/days/0/daysto/10000/bw/<?=$financial_year?>"
  }
  ],
  "valueField": "visits",
  "titleField": "country",

  "colorField": "color",
  "startEffect": "elastic",
  "startDuration": 2,
  "labelRadius": 15,
  "innerRadius": "30%",
  "depth3D": 10,
  "labelText": "[[title]]: [[value]]",
   "urlField": "url",
  "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
  "angle": 15,
  "export": {
    "enabled": true
  }
} );
 $(".chart").css("width","140%");
 $(".chart").css("margin-left","-80px");
    </script>

    <script>
 var chart = AmCharts.makeChart("chartdiv", {
    "type": "serial",
     "theme": "light",
    "categoryField": "year",
    "rotate": true,
    "startDuration": 1,
    "categoryAxis": {
        "gridPosition": "start",
        "position": "left"
    },
    "trendLines": [],
    "graphs": [
        {
            "balloonText": "Pending:[[value]]",
            "fillAlphas": 0.8,
            "id": "AmGraph-1",
            "lineAlpha": 0.2,
            "title": "Pending",
            "type": "column",
            "valueField": "Pending",
            "labelText": "P: [[value]]",
        },
        {
            "balloonText": "Disposed:[[value]]",
            "fillAlphas": 0.8,
            "id": "AmGraph-2",
            "lineAlpha": 0.2,
            "title": "Disposed",
            "type": "column",
            "valueField": "Disposed",
            "labelText": "D: [[value]]",
        }
    ],
    "guides": [],
    "valueAxes": [
        {
            "id": "ValueAxis-1",
            "position": "top",
            "axisAlpha": 0
        }
    ],
    "allLabels": [],
    "balloon": {},
    "titles": [],
    "dataProvider": [
    <?php foreach($pending as $fHGHKHGK){ ?>
        {
            "year": "<?php echo $fHGHKHGK['name']; ?>",
            "Pending":<?=$fHGHKHGK['pending']?>,
            "Disposed": <?=$fHGHKHGK['processed']?>
        },
        <?php } //echo $statePendingCAF + $stateProcessedCAF ?>
        {
        "year": "State Level",
        "Pending":<?=$statePendingCAF?>,
        "Disposed": <?=$stateProcessedCAF?>
        }
    ],
    "export": {
        "enabled": true
     }

});
    </script>
	
	<!----------------------------------------------------------------------Grivance-------------------------------------------------------------->
	
	<?php             $r1[]= array();
                  $r1[1]="#FF6600";  $r1[2]="#41e8f4"; $r1[3]="#DDDDDD";  $r1[4]="#F8FF01";  //#FCD202   #f44141
                  $r1[6]="#27a352"; $r1[7]="#0D8ECF"; $r1[8]="#f441f1";  $r1[9]="#2A0CD0"; $r1[10]="#8A0CCF";
                  // $r1[5]="B0DE09";
                  $r1[13]="#FF9E01"; $r1[14]="#B0DE09"; $r1[15]="#f44197";$r1[16]="#f4dc41"; $r1[20]="#41f455";
                  $chartdatagggg[]= array();
                 // print_r($resultarr);die;
                  foreach($resultarr as $hghggfg => $endinhg)
        {
                //print_r($resultarr); die;
                $chartdatagggg[$hghggfg]=$endinhg;
                $chartdatagggg[$hghggfg]['color']= @$r1[$hghggfg];

        }
        unset($chartdatagggg[0]);
         // print_r($chartdatagggg); die;
    ?>

  <script>
  var chart = AmCharts.makeChart( "chartdivpieGrivance", {
  "type": "pie",
  "theme": "light",
  "titles": [ {
    "text": "",
    "size": 16
  } ],
  "dataProvider": [
   <?php foreach($chartdatagggg as $chartgriv){  ?>
            { 
			"country": '<?php echo $chartgriv['dname']; ?>',
            "visits": <?php echo $chartgriv['open']; ?>,
            "color":'<?php echo $chartgriv['color']; ?>'
			},
			
		<?php  } ?>	
  ],
  "valueField": "visits",
  "titleField": "country",

  "colorField": "color",
  "startEffect": "elastic",
  "startDuration": 2,
  "labelRadius": 15,
  "innerRadius": "30%",
  "depth3D": 10,
  "labelText": "[[title]]: [[value]]",
   "urlField": "url",
  "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
  "angle": 15,
  "export": {
    "enabled": true
  }
} );
 $(".chart").css("width","140%");
 $(".chart").css("margin-left","-80px");
    </script>

    <script>
 var chart = AmCharts.makeChart("chartdivGrivance", {
    "type": "serial",
     "theme": "light",
    "categoryField": "year",
    "rotate": true,
    "startDuration": 1,
    "categoryAxis": {
        "gridPosition": "start",
        "position": "left"
    },
    "trendLines": [],
    "graphs": [
        {
            "balloonText": "Open:[[value]]",
            "fillAlphas": 0.8,
            "id": "AmGraph-1",
            "lineAlpha": 0.2,
            "title": "Open",
            "type": "column",
            "valueField": "Open",
            "labelText": "O: [[value]]",
        },
        {
            "balloonText": "Closed:[[value]]",
            "fillAlphas": 0.8,
            "id": "AmGraph-2",
            "lineAlpha": 0.2,
            "title": "Closed",
            "type": "column",
            "valueField": "Closed",
            "labelText": "C: [[value]]",
        }
    ],
    "guides": [],
    "valueAxes": [
        {
            "id": "ValueAxis-1",
            "position": "top",
            "axisAlpha": 0
        }
    ],
    "allLabels": [],
    "balloon": {},
    "titles": [],
    "dataProvider": [
    <?php foreach($resultarr as $fHGHKHGKhjghj){ ?>
        {
            "year": "<?php echo $fHGHKHGKhjghj['dname']; ?>",
            "Open":<?=$fHGHKHGKhjghj['open']?>,
            "Closed": <?=$fHGHKHGKhjghj['close']?>
        },
        <?php }  ?>
       
    ],
    "export": {
        "enabled": true
     }

});
    </script>
    <script>
        
<?php if(empty(@$_SESSION['donewithdepartment'])){
    $_SESSION['donewithdepartment']="selected";
    ?>
 $(document).ready(function(){
 $('#myModal').modal('show');
 });
<?php }?>
    </script>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
        <h4 class="modal-title">Welcome <?php echo $_SESSION['uname'];?></h4>
      </div>
      <div class="modal-body">
          <div class="col-md-12">
              
              <p> <label><b>Select Department</label><select name="department" style="float:left;" class="form-control" onchange="window.location.href='/backoffice/mis/psReport/change/id/'+this.value;"                         >
    <?php $allList=ApplicationExt::getMasterList('bo_departments','dept_id','department_name'); ?>
            <?php foreach($allList as $k=>$v){ ?> 
    <option value="<?php echo $k;?>" <?php if(!empty($_SESSION['dept_id']) && $_SESSION['dept_id']==$k){ echo " selected"; } ?>><?php echo $v; ?></option> 
            <?php } ?>
          </select>  </p>
      </div>
          <br>
          <br>
          <br>
          <br>
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
      </div>
    </div>

  </div>
</div>

