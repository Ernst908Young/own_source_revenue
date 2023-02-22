<?php $grandtotal=0; $grandopen=0; $grandclose=0;$resultarr=array();$totalServ=0;$incomServ=0;$appServ=0; $pendServ=0; $fordServ=0; $rejServ=0; $incomServ=0; $reveServ=0; $otherServ=0;



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
        AND bac.application_status in('A','R','H') AND bac.submission_id not in('22','268') AND bo_application_forward_level.approv_status='P' AND bo_application_forward_level.next_role_id=3
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

	/////////Grivance////////////////////////////
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
				if(isset($field['district_id'])) 
				{  	
				   $sectorid=$field['district_id'];
				   $newdetails[$sectorid][$key]['grievence_no']=$field['grievence_no']; 
				   $newdetails[$sectorid][$key]['grievance_status']=$field['grievance_status']; 
				   $newdetails[$sectorid][$key]['distname']=$field['distric_name'];       
				}
				
			}
			// print_r($newdetails); die;		
			foreach ($newdetails as $key => $countdetails)
			{    
				$open=0; $close=0; 
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
    /////////////////////SERVICE REPORT ///////////////////////////////
           
    $sqlssss="SELECT sso_service_providers.sp_id,sso_service_providers.service_provider_name,sso_service_providers.service_provider_tag,bo_sp_all_applications.app_id, bo_sp_all_applications.app_name, bo_sp_all_applications.department_name, bo_sp_applications.sno, bo_sp_applications.sp_tag, bo_sp_applications.sp_app_id, bo_sp_applications.app_fields, bo_sp_applications.app_status, bo_sp_applications.caf_id, bo_sp_applications.unit_name,bo_sp_applications.created_on
FROM sso_service_providers
LEFT JOIN bo_sp_all_applications ON sso_service_providers.sp_id = bo_sp_all_applications.sp_id
LEFT JOIN bo_sp_applications ON  bo_sp_all_applications.app_id =bo_sp_applications.sp_app_id 
where sso_service_providers.department_id='".$_SESSION['dept_id']."' and bo_sp_applications.app_status IN ('A','P','F','R','I','RBI','H','O')
and bo_sp_applications.created_on  >='".$startdate."' and bo_sp_applications.created_on <'".$enddate."' AND bo_sp_applications.user_id NOT IN ('11')";
        $connection=Yii::app()->db;
        $command=$connection->createCommand($sqlssss);
        $Fieldsas=$command->queryAll();   
        // echo "<pre>";print_r($Fieldsas); die;
         
	if(!empty($Fieldsas))
	{
        foreach ($Fieldsas as $key => $fieldsss)
        {   //print_r($key);
			if(isset($fieldsss['app_name']))
			{     
			   $sectorid=$fieldsss['app_id']; //$sectorid=$fieldsss['app_name'];
			   $newdetailssss[$sectorid][$key]['sno']=$fieldsss['sno'];
			   $newdetailssss[$sectorid][$key]['app_status']=$fieldsss['app_status'];
			   $newdetailssss[$sectorid][$key]['caf_id']=$fieldsss['caf_id'];
			   $newdetailssss[$sectorid][$key]['app_id']=$fieldsss['app_id'];       
			}
		}
            // print_r($newdetailssss); die;
            $resultarrssss=array();
		foreach ($newdetailssss as $keywwww => $countdetailssss)
		{ 	//print_r($countdetailssss[$keywwww]['app_status']); //die; 
			$approvedservice=0; $pendingservice=0; $forwardedservice=0; $rejectedservice=0; $incompleteservice=0; $revertedservice=0; $otherservice=0;
	   
			foreach($countdetailssss as $hh =>$dfss){  //print_r($df); die;
				if($dfss['app_status']=='A') { $approvedservice=$approvedservice+1; }
				if($dfss['app_status']=='P') { $pendingservice=$pendingservice+1; }
				if($dfss['app_status']=='F') { $forwardedservice=$forwardedservice+1; }
				if($dfss['app_status']=='R') { $rejectedservice=$rejectedservice+1; }
				if($dfss['app_status']=='I') { $incompleteservice=$incompleteservice+1; }
				if($dfss['app_status']=='RBI') { $revertedservice=$revertedservice+1; }
				if($dfss['app_status']=='O' || $dfss['app_status']=='H'){ $otherservice=$otherservice+1;}
				$resultarrssss[$keywwww]['approvedservice']=$approvedservice;
				$resultarrssss[$keywwww]['pendingservice']=$pendingservice;
				$resultarrssss[$keywwww]['forwardedservice']=$forwardedservice;
				$resultarrssss[$keywwww]['rejectedservice']=$rejectedservice;
				$resultarrssss[$keywwww]['incompleteservice']=$incompleteservice;
				$resultarrssss[$keywwww]['revertedservice']=$revertedservice;
				$resultarrssss[$keywwww]['otherservice']=$otherservice;
			}
				 
		}
		$finaldata=array();
		foreach ($resultarrssss as $keyhgh => $countdataservice)
		{
			// echo "<pre>"; print_r($countdataservice['approvedservice']);
			$appServ=$appServ+$countdataservice['approvedservice'];
			$pendServ=$pendServ+$countdataservice['pendingservice'];
			$fordServ=$fordServ+$countdataservice['forwardedservice'];
			$rejServ=$rejServ+$countdataservice['rejectedservice'];
			$incomServ=$incomServ+$countdataservice['incompleteservice'];
			$reveServ=$reveServ+$countdataservice['revertedservice'];
			$otherServ=$reveServ+$countdataservice['otherservice'];
			// $totalServ=$appServ+$pendServ+$fordServ+$rejServ+$incomServ+$reveServ;
			$totalServ=$appServ+$pendServ+$fordServ+$rejServ+$reveServ;
		}
            //print_r($pendServ); die;
	}

	////Under process pending District ( 0----15)//
	$sqllklkkl = "SELECT bo_application_forward_level.approv_status,bac.application_status,bo_application_forward_level.app_Sub_id,bac.submission_id,bac.application_status,
	bd.distric_name,bo_application_forward_level.created_on
	from  bo_application_forward_level
	LEFT JOIN bo_application_submission as bac ON bac.submission_id=bo_application_forward_level.app_Sub_id
	LEFT JOIN bo_district as bd ON bd.district_id=bac.landrigion_id
	where bo_application_forward_level.forwarded_dept_id = $_SESSION[dept_id]  AND bac.application_status in('F') 
	AND bac.application_id=1 AND bac.submission_id not in('22','268') AND bo_application_forward_level.approv_status='P'
	 AND bo_application_forward_level.next_role_id=3 AND bac.user_id not in('11')
	AND bo_application_forward_level.created_on >='".$startdate."' AND bo_application_forward_level.created_on <'".$enddate."' 
	AND DATEDIFF(NOW(),DATE_FORMAT(bo_application_forward_level.created_on,'%Y-%m-%d'))>=0 
	 AND DATEDIFF(NOW(),DATE_FORMAT(bo_application_forward_level.created_on,'%Y-%m-%d'))<=15 
	GROUP BY bac.submission_id";
	$command = $connection->createCommand($sqllklkkl);
	$appSublkll = $command->queryAll();  $districtpendingCAFUnderprocess=count($appSublkll);
	//print_r($districtpendingCAFUnderprocess); ////pending District ( 16----10000)///
	$sqloiuo = "SELECT bo_application_forward_level.approv_status,bac.application_status,bo_application_forward_level.app_Sub_id,bac.submission_id,bac.application_status,
	bd.distric_name,bo_application_forward_level.created_on
	from  bo_application_forward_level
	LEFT JOIN bo_application_submission as bac ON bac.submission_id=bo_application_forward_level.app_Sub_id
	LEFT JOIN bo_district as bd ON bd.district_id=bac.landrigion_id
	where bo_application_forward_level.forwarded_dept_id = $_SESSION[dept_id]  AND bac.application_status in('F') 
	AND bac.application_id=1 AND bac.submission_id not in('22','268') AND bo_application_forward_level.approv_status='P'
	 AND bo_application_forward_level.next_role_id=3 AND bac.user_id not in('11')
	AND bo_application_forward_level.created_on >='".$startdate."' AND bo_application_forward_level.created_on <'".$enddate."' 
	AND DATEDIFF(NOW(),DATE_FORMAT(bo_application_forward_level.created_on,'%Y-%m-%d'))>=16 
	AND DATEDIFF(NOW(),DATE_FORMAT(bo_application_forward_level.created_on,'%Y-%m-%d'))<=10000 
	GROUP BY bac.submission_id";
	$command = $connection->createCommand($sqloiuo);
	$appoiuo = $command->queryAll(); $districtpendingCAF=count($appoiuo);
			//print_r($districtpendingCAF); die;///////////////Under process pending State ( 0----15)// 
	$sqlstaaa = "
		SELECT bo_application_forward_level.app_Sub_id,bac.submission_id,bac.application_status,bd.distric_name,bo_application_forward_level.created_on
		from  bo_application_forward_level
		LEFT JOIN bo_application_submission as bac ON bac.submission_id=bo_application_forward_level.app_Sub_id
		LEFT JOIN bo_district as bd ON bd.district_id=bac.landrigion_id
		where bo_application_forward_level.forwarded_dept_id = $_SESSION[dept_id]
		AND bac.application_id=1 AND bac.submission_id not in('22','268') AND bo_application_forward_level.approv_status='P' AND bo_application_forward_level.next_role_id=5
		AND bac.application_status ='F'
		AND bo_application_forward_level.next_role_id=5 AND bac.user_id not in('11')
		AND bo_application_forward_level.created_on >='".$startdate."' AND bo_application_forward_level.created_on <'".$enddate."' 
		AND DATEDIFF(NOW(),DATE_FORMAT(bo_application_forward_level.created_on,'%Y-%m-%d'))>=0 
		AND DATEDIFF(NOW(),DATE_FORMAT(bo_application_forward_level.created_on,'%Y-%m-%d'))<=15 
		GROUP BY bac.submission_id";
		$command = $connection->createCommand($sqlstaaa);
		$appStaaaaat = $command->queryAll();  $StatependingCAFUnderprocess=count($appStaaaaat);
			//print_r($StatependingCAFUnderprocess); ///////pending State ( 16----10000)///// 
	$sqloiuostate = "SELECT bo_application_forward_level.app_Sub_id,bac.submission_id,bac.application_status,bd.distric_name,bo_application_forward_level.created_on
		from  bo_application_forward_level
		LEFT JOIN bo_application_submission as bac ON bac.submission_id=bo_application_forward_level.app_Sub_id
		LEFT JOIN bo_district as bd ON bd.district_id=bac.landrigion_id
		where bo_application_forward_level.forwarded_dept_id = $_SESSION[dept_id]
		AND bac.application_id=1 AND bac.submission_id not in('22','268') AND bo_application_forward_level.approv_status='P' AND bo_application_forward_level.next_role_id=5
		AND bac.application_status ='F'
		 AND bo_application_forward_level.next_role_id=5 AND bac.user_id not in('11')
		AND bo_application_forward_level.created_on >='".$startdate."' AND bo_application_forward_level.created_on <'".$enddate."' 
		AND DATEDIFF(NOW(),DATE_FORMAT(bo_application_forward_level.created_on,'%Y-%m-%d'))>=16 
		 AND DATEDIFF(NOW(),DATE_FORMAT(bo_application_forward_level.created_on,'%Y-%m-%d'))<=10000 
		GROUP BY bac.submission_id";
		$command = $connection->createCommand($sqloiuostate);
		$appstatesss = $command->queryAll(); $StatependingCAF=count($appstatesss);
			//print_r($StatependingCAF); die;//////////////////////////////////////////////      

	$s_department_id = $_SESSION['dept_id'];
	$sql_ser_cnt = "SELECT ap.app_id,ap.app_name FROM `bo_sp_all_applications` as ap INNER JOIN `sso_service_providers` as sp ON sp.sp_id=ap.sp_id WHERE ap.is_app_active = 'Y' AND sp.department_id='$s_department_id'";
	$command = $connection->createCommand($sql_ser_cnt);
	$res_sql_ser_cnt = $command->queryAll();
	$services_count  = count($res_sql_ser_cnt);
	
?>

<style type="text/css">
  #chartdiv {
  width: 100%;
  height: 500px;
}
p.circle_desc{
 margin-top:5px !important;
 color:#000;
 font-size:14px;
 font-family: 'Lato', sans-serif;
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
	<div class="fixed-condition-elements">
		<div class="container-fluid">
			
		</div>
	</div>
	<div class="fixed-condition-element1 dashboard-welcome">
		<h2><?php if(DefaultUtility::isHODNodal()){ echo "Welcome to Department Monitoring Panel"." - ".$dept['department_name']; } if(DefaultUtility::isSECRETARY()){ echo "Welcome to Secretariat Monitoring Panel"." - ".$dept['department_name']; } ?></h2>
		<div class="welcome-date hidden-xs"><i class="icon-calendar"></i>&nbsp;<?php echo date('d-M-Y'); ?></div>
		<div class="clearfix"></div>
	</div>  
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
			<div class="page-bar">
				<form name="form" action="" method="POST" >
					<table>
						<tr>
							<td><b>Currently you are viewing data for "<?php echo $financial_year; ?>", If you want to change then select Financial Year : </b>&nbsp;&nbsp;</td>
							<td>
							<select name="financial_year" class="form-control" onchange="this.form.submit()"  >
							<option value="ALL" <?php if($financial_year=="ALL"){ echo "selected='selected'"; } ?> >ALL</option>
							<?php for($i=$pp;$i<$yyy;$i++){ $j=$i+1; $k=$i.'-'.$j; ?>
							<option value="<?php echo $k; ?>" <?php if($financial_year==$k){ echo "selected='selected'"; } ?>><?php echo $k; ?></option>
							<?php } ?>
							</select>
							</td>
						</tr>
					</table>
				</form>
			</div>		
		</div>
	</div>

	<section class="panel site-min-height" >
    <header class="panel-heading">
        Department Performance Report <!-- From 2018-04-01 To 2018-07-14-->
    </header>
	<div class="panel-body"> 
        <div class="table ">
			<div class="" style="margin:0px">
			<ul class="page-breadcrumb " style="text-align:center;width:100%;">
				 <li>				 
				 <h3 style="font-size:18px; color:#343434; margin-bottom:20px;"><b>TOTAL CAF FORWARDED TO DEPARTMENT : <?php echo $allprocessed+$allpending+$stateProcessedCAF+$statePendingCAF+$districtProcessedWithoutResponseCAF+$stateProcessedWithoutResponseCAF; ?></b></h3>		 
				 </li>
			</ul>
			</div>
			<div>
			<div class="portlet light bordered col-md-12">
				<div class="portlet-title">
				<div class="caption" style="width:100%;text-align: center;">
					<span class="caption-subject font-dark bold uppercase text-center">
					<a href="/backoffice/mis/hodreport/districtwisenodalcafreport/fID/<?=$financial_year?>"><b>Total District Level CAF  : <?php echo $allprocessed+$allpending+$districtProcessedWithoutResponseCAF; ?></b> </a> </span>
				</div>
				</div>
				
				<div class="portlet-body">

				<div class="col-xs-12 col-sm-6 col-md-3 text-center" style="margin-bottom:5px;">
				   <a href="/backoffice/mis/hodreport/disposeddistrict?financial_year=<?=$financial_year?>">
						
						<div class="round-stats blue">
							<h3 class="number"> <?=$allprocessed?>
								<!--<span data-counter="counterup" data-value=""></span>-->
							</h3>							
						</div>
						<div><p class="circle_desc">CAF Disposed</p></div>
					</a>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3 text-center" style="margin-bottom:5px;">
					<a href="/backoffice/mis/CsReport/districtdisposedwithoutcomment/fID/<?=$financial_year?>">
						
						<div class="round-stats blue">
							<h3 class="number"><?=$districtProcessedWithoutResponseCAF?>
							   <!-- <span data-counter="counterup" data-value="<?=$districtProcessedWithoutResponseCAF;?>"></span>-->
							</h3>	
						</div>
						<div><p class="circle_desc">CAF Disposed without Response</p></div>
					</a>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3 text-center" style="margin-bottom:5px;">
				  <a href="/backoffice/mis/boApplicationSubmission/PendencyreportHod/days/0/daysto/15/bw/<?=$financial_year?>">						
						<div class="round-stats blue">
							<h3 class="number">
							   <?=$districtpendingCAFUnderprocess?>
							   <!-- <span data-counter="counterup" data-value=""></span>-->
							</h3>
						</div>
						<div><p class="circle_desc">Under Process CAF</p></div>
					</a>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3 text-center" style="margin-bottom:5px;">
				  <a href="/backoffice/mis/boApplicationSubmission/PendencyreportHod/days/16/daysto/10000/bw/<?=$financial_year?>">
						<div class="round-stats blue">
							<h3 class="number">
							   <?=$districtpendingCAF?>
							   <!-- <span data-counter="counterup" data-value=""></span>-->
							</h3>
						</div>
						<div><p class="circle_desc">Pending CAF</p></div>
					</a>
				</div>
				</div>
			</div>


			<div class="portlet light bordered col-md-12">
				<div class="portlet-title">
				<div class="caption" style="width:100%;text-align: center;">
					<span class="caption-subject font-dark bold uppercase text-center">
					<a href="/backoffice/mis/CsReport/overallstate/fID/<?=$financial_year?>"><b>Total State Level CAF : <?php echo $stateProcessedCAF+$statePendingCAF+$stateProcessedWithoutResponseCAF; ?></b> </a> </span>
				</div>
				</div>
		
				<div class="portlet-body">
				<div class="col-xs-12 col-sm-6 col-md-3 text-center" style="margin-bottom:5px;">
					<a href="/backoffice/mis/CsReport/index/fID/<?=$financial_year?>">
						<div class="round-stats blue">
							<h3 class="number"><?=$stateProcessedCAF?>
							   <!-- <span data-counter="counterup" data-value="<?=$stateProcessedCAF?>"></span>-->
							</h3>
						</div>
						<div><p class="circle_desc">CAF Disposed</p></div>
					</a>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3 text-center" style="margin-bottom:5px;">
					<a href="/backoffice/mis/CsReport/statedisposedwithoutcomment/fID/<?=$financial_year?>">
						<div class="round-stats blue">
							<h3 class="number"><?=$stateProcessedWithoutResponseCAF?>
							   <!-- <span data-counter="counterup" data-value="<?=$stateProcessedWithoutResponseCAF?>"></span>-->
							</h3>
						</div>
						<div><p class="circle_desc">CAF Disposed without Response</p></div>
					</a>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3 text-center" style="margin-bottom:5px;">
					<a href="/backoffice/mis/boApplicationSubmission/PendencyreportHodState/days/0/daysto/15/bw/<?=$financial_year?>">
						<div class="round-stats blue">
							<h3 class="number"><?=$StatependingCAFUnderprocess?>
								<!--<span data-counter="counterup" data-value="<?=$statePendingCAF?>"></span>-->
							</h3>
						</div>
						<div><p class="circle_desc">Under Process CAF</p></div>
					</a>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3 text-center" style="margin-bottom:5px;">
				  <a href="/backoffice/mis/boApplicationSubmission/PendencyreportHodState/days/16/daysto/10000/bw/<?=$financial_year?>">
						<div class="round-stats blue">
							<h3 class="number">
							   <?=$StatependingCAF?>
							   <!-- <span data-counter="counterup" data-value=""></span>-->
							</h3>
						</div>
						<div><p class="circle_desc">Pending CAF</p></div>
					</a>
				</div>
				</div>
			</div>
			</div>
		</div>
	</div>
	</section>	
    <br />


<!-------------------------------------------------------------Service Report---------------------------------------------------------------------------->
<section class="panel site-min-height" style="display:">
	<div class="panel-body"> 
		<div class="table">
		<div class="" style="margin:0px">
			<ul class="page-breadcrumb " style="text-align:center;width:100%;">
				<li>
				<h3 style="font-size:18px; color:#343434; margin-bottom:20px;"><b><a href="/backoffice/mis/ServiceReport/index/d/<?=$_SESSION['dept_id']?>/s/T/d1/<?=$startdate?>/d2/<?=$enddate?>">SERVICE REPORT : <?php echo $totalServ; ?></a></b></h3>
				</li>
			</ul>
		</div>
		<div style="display:;">
    
        <div class="portlet light bordered col-md-12">
			<!--<div class="portlet-title">
				<div class="caption" style="width:100%;text-align: center;">
					<span class="caption-subject font-dark bold uppercase text-center">
				 Total District Level CAF (27) </span>
				</div>
			</div> -->
			<div class="portlet-body">

					<!-- <div class="col-lg-2 col-md-2">
					   <a class="dashboard-stat dashboard-stat-v2 blue" href="/backoffice/mis/ServiceReport/servicetotaldetailhod/d/<?=$_SESSION['dept_id']?>/s/I/d1/<?=$startdate?>/d2/<?=$enddate?>">
							<div class="visual">
								<i class="fa fa-comments"></i>
							</div>
							<div class="details">
								<div class="number"> <?php echo $incomServ; ?>
								</div>
								<div class="desc">Incomplete</div>
							</div>
						</a>
					</div> -->
					<div class="col-xs-12 col-sm-6 col-md-2 text-center">
					   <a href="/backoffice/mis/ServiceReport/index/d/<?=$_SESSION['dept_id']?>/s/T/d1/<?=$startdate?>/d2/<?=$enddate?>">
							<div class="round-stats blue">
								<h3 class="number"><?php echo $services_count; ?>
								</h3>
							</div>
							<div><p class="circle_desc">Integrated Services</p></div>
						</a>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-2 text-center">
					   <a href="/backoffice/mis/ServiceReport/index/d/<?=$_SESSION['dept_id']?>/s/P/d1/<?=$startdate?>/d2/<?=$enddate?>">
							<div class="round-stats blue">
								<h3 class="number"><?php echo $pendServ; ?>
									<!--<span data-counter="counterup" data-value=""></span>-->
								</h3>
							</div>
							<div><p class="circle_desc">In Process</p></div>
						</a>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-2 text-center">
					   <a href="/backoffice/mis/ServiceReport/index/d/<?=$_SESSION['dept_id']?>/s/F/d1/<?=$startdate?>/d2/<?=$enddate?>">
							<div class="round-stats blue">
								<h3 class="number"><?php echo $fordServ; ?>
									<!--<span data-counter="counterup" data-value=""></span>-->
								</h3>
							</div>
							<div><p class="circle_desc">Forwarded</p></div>
							
						</a>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-2 text-center">
					   <a href="/backoffice/mis/ServiceReport/index/d/<?=$_SESSION['dept_id']?>/s/RBI/d1/<?=$startdate?>/d2/<?=$enddate?>">
							<div class="round-stats blue">
								<h3 class="number"><?php echo $reveServ; ?>
									<!--<span data-counter="counterup" data-value=""></span>-->
								</h3>
							</div>
							<div><p class="circle_desc">Reverted</p></div>
							
						</a>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-2 text-center">
					   <a href="/backoffice/mis/ServiceReport/index/d/<?=$_SESSION['dept_id']?>/s/R/d1/<?=$startdate?>/d2/<?=$enddate?>">
							<div class="round-stats blue">
								<h3 class="number"><?php echo $rejServ; ?>
									<!--<span data-counter="counterup" data-value=""></span>-->
								</h3>
							</div>
							<div><p class="circle_desc">Rejected</p></div>
							
						</a>
					</div>
					
					<div class="col-xs-12 col-sm-6 col-md-2 text-center">
					   <a href="/backoffice/mis/ServiceReport/index/d/<?=$_SESSION['dept_id']?>/s/A/d1/<?=$startdate?>/d2/<?=$enddate?>">
							<div class="round-stats blue">
								<h3 class="number"><?php echo $appServ; ?>
									<!--<span data-counter="counterup" data-value=""></span>-->
								</h3>
							</div>
							<div><p class="circle_desc">Approved</p></div>
							
						</a>
					</div>

			</div>
		</div>
		</div>
		</div>
	  </div>
	</section> 	
    <br />
 <!--------------------------------------------------------------------------------------------------------------------------------------------------------->

 
 <?php
 $financial_year = $financial_year;
 $department_id = $_SESSION['dept_id'];
 $timeline_count_arr = ReportExt::getServiceCountForTimelineDashboard($financial_year,$department_id);
 //echo '<pre>';print_r($timeline_count_arr); die;
 if(isset($_GET['time'])){
	//ksort($timeline_count_arr['data_array']);
	//echo '<pre>';print_r($timeline_count_arr); die;
 }
 
 ?>
	<div class="clearfix"></div>
	<div>
	<div>                          
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-list"></i>
					TIMELINE REPORT 
					<?php $sumArr = $timeline_count_arr['heading_array']; ?>
					SWA-<?php echo $sumArr['SWA_TA']+$sumArr['SWA_TV']; ?>
					<!--,RTS-<?php //echo $sumArr['RTS_TA']+$sumArr['RTS_TV']; ?>,
					GA-<?php //echo $sumArr['GA_TA']+$sumArr['GA_TV']; ?>,
					DN-<?php //echo $sumArr['DN_TA']+$sumArr['DN_TV']; ?>-->
					</div>
				<div class="tools">
					<a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
				</div>
			</div>
			<div class="portlet-body">
				<p>
				<b>*SWA</b> - Single Window Act<!--, <b>*RTS</b> - Right To Service, <b>*GA</b> - Governing Act, <b>*DN</b> - Departmental Notification-->
				</p>
				<div class="table-scrollable">
					<table class="table table-bordered table-hover">
						<thead>
							<tr style="background-color:#BBBBBB;">
								<th style="font-weight:bold;font-size:16px;"> Timeline Adherence </th>
								<?php 
								 $time_temp_array_ch = array('0_P'=>'In Process','1_F'=>'Forwarded','2_RBI'=>'Reverted','3_R'=>'Rejected','4_A'=>'Approved');
								 asort($timeline_count_arr['status_array']);
								 foreach($timeline_count_arr['status_array'] as $key=>$val1){
									
								?>
								<th style="text-align:center;font-size:16px;font-weight:bold;"> <?php echo $time_temp_array_ch[$val1]; ?></th>
								<?php } ?>
							
							</tr>
						</thead>
						<tbody>
							<?php 
							 $heading_title_array=array(
														'SWA_TA'=>'SWA Timeline Not Violated', 
														'SWA_TV'=>'SWA Timeline Violated', 
														'RTS_TA'=>'RTS Timeline Not Violated', 
														'RTS_TV'=>'RTS Timeline Violated', 
														'GA_TA'=>'GA Timeline Not Violated', 
														'GA_TV'=>'GA Timeline Violated', 
														'DN_TA'=>'DN Timeline Not Violated', 
														'DN_TV'=>'DN Timeline Violated', 
														
														);
							 $hideRow=array('RTS_TA','RTS_TV','GA_TA','GA_TV','DN_TA','DN_TV');							
							 foreach($timeline_count_arr['data_array'] as $key=>$valArr){
							?>
							<tr <?php if(in_array($key,$hideRow)){?> style="display:none;"<?php } ?>>
								<th style="background-color:#f3f4f6;"> <?php echo $heading_title_array[$key]; ?> </th>
								<?php ksort($valArr);foreach($valArr as $cKey=>$cVal){ ?>
								<td style="text-align:center;"> <a href="<?php echo Yii::app()->createAbsoluteUrl('mis/ServiceReportAging/ServiceWiseReport/department_id/'.$department_id.'/financial_year/'.$financial_year)?>"><?php echo $cVal; ?></a> </td>
								<?php } ?>
							   
							</tr>
							<?php } ?>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>                           
	</div>
	</div> 
<br><br> 

<!-------------------Total Greivances---------------------------------------------------->
<section class="panel">
	<div class="panel-body">
		<div class="table ">
			<div class="" style="margin:0px">
				<ul class="page-breadcrumb " style="text-align:center;width:100%;">
					<li>
					<h3 style="font-size:18px; color:#343434; margin-bottom:20px;"><b><a href="/backoffice/mis/GrievanceReport/hodindex/d/<?=$_SESSION['dept_id']?>/s/T/d1/<?=$startdate?>/d2/<?=$enddate?>">TOTAL GRIEVANCE : <?php echo @$grandtotal; ?></a></b></h3> 
					</li>
				</ul>
			</div>
		</div>
		<div>      
			<div class="col-xs-12 col-sm-6 text-center">
				<div class="portlet light bordered">
					<a href="/backoffice/mis/GrievanceReport/hodindex/d/<?=$_SESSION['dept_id']?>/s/C/d1/<?=$startdate?>/d2/<?=$enddate?>">
						<div class="round-stats blue">
						<h3 class="number" style="text-align:center;"> <?php echo $grandclose;?></h3>
						</div>
						<div><p class="circle_desc">Close</p></div>
					</a>
				</div>          
			</div>
			<div class="col-xs-12 col-sm-6 text-center">
				<div class="portlet light bordered">
					<a href="/backoffice/mis/GrievanceReport/hodindex/d/<?=$_SESSION['dept_id']?>/s/O/d1/<?=$startdate?>/d2/<?=$enddate?>">
						<div class="round-stats blue">
						<h3 class="number" style="text-align:center;"><?php echo $grandopen;?></h3>
						</div>
						<div><p class="circle_desc">Open</p></div>
					</a>
				</div>
            </div>                       
		</div>							
		<div class="clearfix"></div>
	</div>	
 </section>								
<!-----------------------------------Graph ------>
<section class="panel p-l-r">
	<div class="panel-body">
	<div class="row">
		<div class="col-xs-12 col-md-6">
			<div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <?php $totalcafall=$allprocessed + $allpending +$districtProcessedWithoutResponseCAF + $statePendingCAF + $stateProcessedCAF +$stateProcessedWithoutResponseCAF;  ?>
                    <span class="caption-subject bold uppercase font-dark">Overall CAF (State + District) : <?php echo $totalcafall; ?> </span>
					<br /><span style="font-size:12px" class="caption-subject bold font-dark">(*CAF disposed without comments : <?php echo $districtProcessedWithoutResponseCAF+$stateProcessedWithoutResponseCAF; ?> )</span>
					<br /><span style="font-size:12px" class="caption-subject bold font-dark">(*S = Sum of Under Process and Pending )</span>
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

		<div class="col-xs-12 col-md-6">
		<!-- BEGIN CHART PORTLET-->
          <div class="portlet light bordered">
              <div class="portlet-title">
                  <div class="caption">
                      <i class="icon-bar-chart font-green-haze"></i>
                      <span class="caption-subject bold uppercase font-green-haze">Pending+Under Process CAF (State+District)</span>
                      <span class="caption-helper">(Total: <?php   echo $statePendingCAF + $allpending ;  ?>)

                      </span>
                  </div>
                  <div class="actions">
                      <a href="javascript:;" class="btn btn-circle btn-icon-only btn-default fullscreen"> </a>
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

	<div class="row">
		<div class="col-xs-12 col-md-6">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <?php $totalcafall=$allprocessed + $allpending +$districtProcessedWithoutResponseCAF + $statePendingCAF + $stateProcessedCAF +$stateProcessedWithoutResponseCAF;  ?>
                    <span class="caption-subject bold uppercase font-dark">Total Grievance: <?php echo @$grandtotal; ?> </span>
					<br /><span style="font-size:12px" class="caption-subject bold font-dark"></span>
				</div>
                <div class="actions">
                    <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"> </a>
                </div>
            </div>
            <div class="portlet-body">
                <div id="chartdivGrivance" class="CSSAnimationChart"></div>
            </div>
        </div>
		</div>   
		<div class="col-xs-12 col-md-6">
		<!-- BEGIN CHART PORTLET-->
          <div class="portlet light bordered">
              <div class="portlet-title">
                  <div class="caption">
                      <i class="icon-bar-chart font-green-haze"></i>
                      <span class="caption-subject bold uppercase font-green-haze"> Total Open Grievance</span>
                      <span class="caption-helper">(Total: <?php   echo @$grandopen;  ?>)

                      </span>
                  </div>
                  <div class="actions">
                      <a href="javascript:;" class="btn btn-circle btn-icon-only btn-default fullscreen"> </a>
                  </div>
              </div>
              <div class="portlet-body">
                  <div id="chartdivpieGrivance" class="chart" style="height: 500px;"> </div>  
              </div>
          </div>
          <!-- END CHART PORTLET-->
		</div>
	</div>
	</div>
</section>
<div class="clearfix"></div>
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
                        "url": "/backoffice/mis/boApplicationSubmission/detailpendencyreport1/id/<?=$ee?>/days/0/daysto/10000/bw/<?=$financial_year?>"
        },
  <?php } ?>
   {
    "country": "State Level",
    "visits":<?=$statePendingCAF?>,
    "color": "#CD0D74",
        "url": "/backoffice/mis/boApplicationSubmission/PendencyreportHodState/days/0/daysto/10000/bw/<?=$financial_year?>"
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
            "balloonText": "Under Process + Pending:[[value]]",
            "fillAlphas": 0.8,
            "id": "AmGraph-1",
            "lineAlpha": 0.2,
            "title": "Pending",
            "type": "column",
            "valueField": "Pending",
            "labelText": "S: [[value]]",
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
      
      $(document).ready(function(){
$(".dashboard-stat").parent().css("padding","2px");

});
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

