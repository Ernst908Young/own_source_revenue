<?php //ini_set('session.cache_limiter','public');
//session_cache_limiter(false); ?>

<?php $grandtotal=0; $grandopen=0; $grandclose=0;$resultarr=array();$totalServ=0;$incomServ=0;$appServ=0; $pendServ=0; $fordServ=0; $rejServ=0; $incomServ=0; $reveServ=0; $otherServ=0;

$fY=@$_GET['FY'];

$sql="SELECT submission_id,application_created_date from bo_application_submission ORDER BY application_created_date";
   $connection=Yii::app()->db;
   $command=$connection->createCommand($sql);
   $datefirst=$command->queryAll();
    $rer=$datefirst[0]['application_created_date'];
    $stateProcesed="'0'";$statePending="'0'";
if(isset($fY) && !empty($fY)) {
 $financial_year=$fY; //print_r($financial_year); //die;
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
//////////////////////////////////////////////////////////CAF State//////////////////////////////////////////////////////////////////////////
 $sql="SELECT * 
from  bo_application_forward_level 
LEFT JOIN bo_application_submission as bac ON bac.submission_id=bo_application_forward_level.app_Sub_id
where 
bac.application_id=1 AND bac.user_id not in('11') AND bo_application_forward_level.approv_status='P' AND bo_application_forward_level.next_role_id=5
AND bac.application_status ='F'
AND bo_application_forward_level.created_on >='".$startdate."' AND bo_application_forward_level.created_on <'".$enddate."' GROUP BY bac.submission_id";
$connection=Yii::app()->db;
$command=$connection->createCommand($sql);
$appSub=$command->queryAll();
foreach($appSub as $rte){$statePending="'".$rte['submission_id']."',".$statePending;}
$statePendingCAF=count($appSub);
//print_r($appSub);

// State Processed CAF
 $sqlsas="SELECT * 
          from  bo_application_forward_level 
         LEFT JOIN bo_application_submission as bac ON bac.submission_id=bo_application_forward_level.app_Sub_id
         where 
        bac.application_id=1
        AND bac.application_status in('A','R','H','F') AND bac.user_id not in('11') AND bo_application_forward_level.approv_status!='P' AND bo_application_forward_level.next_role_id=5
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
         where 
        bac.application_id=1
        AND bac.application_status in('A','R','H') AND bac.user_id not in('11') AND bo_application_forward_level.approv_status='P' AND bo_application_forward_level.next_role_id=5
        AND bo_application_forward_level.created_on >='".$startdate."' AND bo_application_forward_level.created_on <'".$enddate."' AND bac.submission_id NOT IN ($stateProcesed) GROUP BY bac.submission_id ORDER BY bo_application_forward_level.created_on ";
$connection=Yii::app()->db;
$command=$connection->createCommand($sqlsas);
$applicationSub=$command->queryAll();
$stateProcessedWithoutResponseCAF=count($applicationSub);
//echo "<pre>";print_r($applicationSub);die;
//echo "state without respoce: ";print_r($stateProcessedWithoutResponseCAF);

                                      ///////////////////////////////////CAF District //////////////////////////////////////////////////////////////////////////////

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
where  bac.application_id=1 AND bac.user_id not in('11')
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
         where 
          bac.landrigion_id=$dID
        AND bac.application_id=1
        AND bac.application_status in('A','R','H','F') AND bac.user_id not in('11') AND bo_application_forward_level.approv_status='V' AND bo_application_forward_level.next_role_id=3
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
// District Processed without comment CAF
 $sqlsas="SELECT bo_application_forward_level.app_Sub_id,bac.submission_id,bac.application_status,bd.distric_name,bo_application_forward_level.created_on
          from  bo_application_forward_level
         LEFT JOIN bo_application_submission as bac ON bac.submission_id=bo_application_forward_level.app_Sub_id
         LEFT JOIN bo_district as bd ON bd.district_id=bac.landrigion_id
                   LEFT JOIN bo_application_flow_logs  ON bo_application_flow_logs.submission_id=bac.submission_id   
         where 
        bac.application_id=1
         AND DATE(bo_application_flow_logs.created_date_time)>='$startdate' AND DATE(bo_application_flow_logs.created_date_time)<='$enddate'  AND bo_application_flow_logs.application_status='ISA'
        AND bac.application_status in('A','R','H','F') AND bac.user_id not in('11') AND bo_application_forward_level.approv_status='P' AND bo_application_forward_level.next_role_id=3
        AND bo_application_forward_level.created_on >='".$startdate."' AND bo_application_forward_level.created_on <'".$enddate."' GROUP BY bac.submission_id ORDER BY bo_application_forward_level.created_on ";
$connection=Yii::app()->db;
$command=$connection->createCommand($sqlsas);
$applicationSub=$command->queryAll();
$Rty=array();
foreach ($applicationSub as $rt){
    $subID=$rt['submission_id'];
    $Rty[$subID]=$subID;
}

$districtProcessedWithoutResponseCAF=count($applicationSub);
 //print_r($DistrictProcessedWithoutResponseCAF);
//die;

// District Prcessed CAF with comment
 $sqlsas="SELECT * 
          from  bo_application_forward_level
         LEFT JOIN bo_application_submission as bac ON bac.submission_id=bo_application_forward_level.app_Sub_id 
          LEFT JOIN bo_application_flow_logs  ON bo_application_flow_logs.submission_id=bac.submission_id  
         where 
        bac.application_id=1
        AND DATE(bo_application_flow_logs.created_date_time)>='$startdate' AND DATE(bo_application_flow_logs.created_date_time)<='$enddate'  AND bo_application_flow_logs.application_status='ISA'
        AND bac.application_status in('A','R','H','F') AND bac.user_id not in('11') AND bo_application_forward_level.next_role_id=3 AND bo_application_forward_level.approv_status='V'
        AND bo_application_forward_level.created_on >='".$startdate."' AND bo_application_forward_level.created_on <'".$enddate."' GROUP BY bac.submission_id ORDER BY bo_application_forward_level.created_on ";
$connection=Yii::app()->db;
$command=$connection->createCommand($sqlsas);
$applicationSub=$command->queryAll();
$allprocessed=count($applicationSub);
foreach ($applicationSub as $rt){
    $subID=$rt['submission_id'];
    $Rty[$subID]=$subID;
}

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
 g.grievance_status IN ('O','C')
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
	///////////////////////////////////////////xx   //////////////////SERVICE REPORT /////////////////////////////////////////////////////////////////
           
     $sqlssss="SELECT sso_service_providers.sp_id,sso_service_providers.service_provider_name,sso_service_providers.service_provider_tag,bo_sp_all_applications.app_id, bo_sp_all_applications.app_name, bo_sp_all_applications.department_name, bo_sp_applications.sno, bo_sp_applications.sp_tag, bo_sp_applications.sp_app_id, bo_sp_applications.app_fields, bo_sp_applications.app_status, bo_sp_applications.caf_id, bo_sp_applications.unit_name,bo_sp_applications.created_on
FROM sso_service_providers
LEFT JOIN bo_sp_all_applications ON sso_service_providers.sp_id = bo_sp_all_applications.sp_id
LEFT JOIN bo_sp_applications ON  bo_sp_all_applications.app_id =bo_sp_applications.sp_app_id 
 WHERE bo_sp_applications.created_on  >='".$startdate."' and bo_sp_applications.created_on <'".$enddate."' AND bo_sp_applications.user_id NOT IN ('11') AND sso_service_providers.sp_id not in ('9','10','27','28')";
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
            { //print_r($countdetailssss[$keywwww]['app_status']); //die; 
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
             $totalServ=$appServ+$pendServ+$fordServ+$rejServ+$incomServ+$reveServ;
            }
}



/////////////.///////////////////////////////////////Under process pending District ( 0----15)////////////////////////////////////////// 
 $sqllklkkl = "SELECT bo_application_forward_level.approv_status,bac.application_status,bo_application_forward_level.app_Sub_id,bac.submission_id,bac.application_status,
bd.distric_name,bo_application_forward_level.created_on
from  bo_application_forward_level
LEFT JOIN bo_application_submission as bac ON bac.submission_id=bo_application_forward_level.app_Sub_id
LEFT JOIN bo_district as bd ON bd.district_id=bac.landrigion_id
 LEFT JOIN bo_application_flow_logs  ON bo_application_flow_logs.submission_id=bac.submission_id  
 
     
where  bac.application_status in('F') 
 AND DATE(bo_application_flow_logs.created_date_time)>='$startdate' AND DATE(bo_application_flow_logs.created_date_time)<='$enddate'  AND bo_application_flow_logs.application_status='ISA'
AND bac.application_id=1 AND bo_application_forward_level.approv_status='P'
 AND bo_application_forward_level.next_role_id=3 AND bac.user_id not in('11')
AND bo_application_forward_level.created_on >='".$startdate."' AND bo_application_forward_level.created_on <'".$enddate."' 
AND DATEDIFF(NOW(),DATE_FORMAT(bo_application_forward_level.created_on,'%Y-%m-%d'))>=0 
 AND DATEDIFF(NOW(),DATE_FORMAT(bo_application_forward_level.created_on,'%Y-%m-%d'))<=15 
GROUP BY bac.submission_id";
            $command = $connection->createCommand($sqllklkkl);
            $appSublkll = $command->queryAll();  $districtpendingCAFUnderprocess=count($appSublkll);
            foreach ($appSublkll as $rt){
    $subID=$rt['submission_id'];
    $Rty[$subID]=$subID;
}

			//print_r($districtpendingCAFUnderprocess); 
/////////////.///////////////////////////////////////pending District ( 16----10000)////////////////////////////////////////// 
$sqloiuo = "SELECT bo_application_forward_level.approv_status,bac.application_status,bo_application_forward_level.app_Sub_id,bac.submission_id,bac.application_status,
bd.distric_name,bo_application_forward_level.created_on
from  bo_application_forward_level
LEFT JOIN bo_application_submission as bac ON bac.submission_id=bo_application_forward_level.app_Sub_id
LEFT JOIN bo_district as bd ON bd.district_id=bac.landrigion_id 
 LEFT JOIN bo_application_flow_logs  ON bo_application_flow_logs.submission_id=bac.submission_id  
where  bac.application_status in('F') 
 AND DATE(bo_application_flow_logs.created_date_time)>='$startdate' AND DATE(bo_application_flow_logs.created_date_time)<='$enddate'  AND bo_application_flow_logs.application_status='ISA'
AND bac.application_id=1 AND bo_application_forward_level.approv_status='P'
 AND bo_application_forward_level.next_role_id=3 AND bac.user_id not in('11')
AND bo_application_forward_level.created_on >='".$startdate."' AND bo_application_forward_level.created_on <'".$enddate."' 
AND DATEDIFF(NOW(),DATE_FORMAT(bo_application_forward_level.created_on,'%Y-%m-%d'))>=16 
 AND DATEDIFF(NOW(),DATE_FORMAT(bo_application_forward_level.created_on,'%Y-%m-%d'))<=10000 


GROUP BY bac.submission_id";
            $command = $connection->createCommand($sqloiuo);
            $appoiuo = $command->queryAll(); $districtpendingCAF=count($appoiuo);
            
            
               foreach ($appoiuo as $rt){
                    $subID=$rt['submission_id'];
                    $Rty[$subID]=$subID; 
                }
//                $sqlPendingReverted="Select bo_application_submission.* from bo_application_submission 
//                      LEFT JOIN bo_application_flow_logs  ON bo_application_flow_logs.submission_id=bo_application_submission.submission_id  
//                        where bo_application_submission.application_status IN('P')  AND DATE(bo_application_flow_logs.created_date_time)>='$startdate' AND DATE(bo_application_flow_logs.created_date_time)<='$enddate'  Group by bo_application_submission.submission_id  ";
//                  $command = $connection->createCommand($sqlPendingReverted);
//                  $pendingAtNodalAndRevrted = $command->queryAll(); 
//                         $sqlPendingReverted="Select bo_application_submission.* from bo_application_submission 
//                      LEFT JOIN bo_application_flow_logs  ON bo_application_flow_logs.submission_id=bo_application_submission.submission_id  
//                        where bo_application_submission.application_status IN('P')  AND DATE(bo_application_flow_logs.created_date_time)>='$startdate' AND DATE(bo_application_flow_logs.created_date_time)<='$enddate'  Group by bo_application_submission.submission_id  ";
//                  $command = $connection->createCommand($sqlPendingReverted);
//                  $pendingAtNodalAndRevrted = $command->queryAll(); 
//                  
//                    foreach ($pendingAtNodalAndRevrted as $rt){
//                        $subID=$rt['submission_id'];
//                        $Rty[$subID]=$subID;
//                    } 
//                    foreach ($pendingAtNodalAndRevrted as $rt){
//                        $subID=$rt['submission_id'];
//                        $Rty[$subID]=$subID;
//                    } 
                    
//                    $sqlPendingReverted="Select bo_application_submission.* from bo_application_submission 
//                        LEFT JOIN bo_application_forward_level  ON bo_application_forward_level.app_Sub_id=bo_application_submission.submission_id     
//                      LEFT JOIN bo_application_flow_logs  ON bo_application_flow_logs.submission_id=bo_application_submission.submission_id   
//                        where bo_application_submission.application_status IN('H') 
//                        AND bo_application_submission.submission_id NOT IN (select app_Sub_id from bo_application_forward_level group by bo_application_forward_level.app_sub_id) 
//                        AND DATE(bo_application_flow_logs.created_date_time)>='$startdate' "
//                            . " AND DATE(bo_application_flow_logs.created_date_time)<='$enddate'  "
//                            . " Group by bo_application_submission.submission_id ";
//                    
//                  $command = $connection->createCommand($sqlPendingReverted);
//                  $pendingAtInvAndRevrted = $command->queryAll(); 
//                  
//                    foreach ($pendingAtInvAndRevrted as $rt){
//                        $subID=$rt['submission_id'];
//                        $Rty[$subID]=$subID;
//                    } 

                  echo "<!-- DISTRICT CAF MM: <pre>";echo print_r($Rty); echo "</pre>-->"; 


			//print_r($districtpendingCAFUnderprocess); 
                        //
			//print_r($districtpendingCAF); die;
			
//////////////////////////////////////////////   

/////////////.///////////////////////////////////////Under process pending State ( 0----15)////////////////////////////////////////// 
 $sqlstaaa = "
 SELECT bo_application_forward_level.app_Sub_id,bac.submission_id,bac.application_status,bd.distric_name,bo_application_forward_level.created_on
from  bo_application_forward_level
LEFT JOIN bo_application_submission as bac ON bac.submission_id=bo_application_forward_level.app_Sub_id
LEFT JOIN bo_district as bd ON bd.district_id=bac.landrigion_id
where 
 bac.application_id=1 AND bac.submission_id not in('22','268') AND bo_application_forward_level.approv_status='P' AND bo_application_forward_level.next_role_id=5
AND bac.application_status ='F'
 AND bo_application_forward_level.next_role_id=5 AND bac.user_id not in('11')
AND bo_application_forward_level.created_on >='".$startdate."' AND bo_application_forward_level.created_on <'".$enddate."' 
AND DATEDIFF(NOW(),DATE_FORMAT(bo_application_forward_level.created_on,'%Y-%m-%d'))>=0 
 AND DATEDIFF(NOW(),DATE_FORMAT(bo_application_forward_level.created_on,'%Y-%m-%d'))<=15 
GROUP BY bac.submission_id";
            $command = $connection->createCommand($sqlstaaa);
            $appStaaaaat = $command->queryAll();  $StatependingCAFUnderprocessa=count($appStaaaaat);
			//print_r($StatependingCAFUnderprocess); 
/////////////.///////////////////////////////////////pending State ( 16----10000)////////////////////////////////////////// 
$sqloiuostate = "SELECT bo_application_forward_level.app_Sub_id,bac.submission_id,bac.application_status,bd.distric_name,bo_application_forward_level.created_on
from  bo_application_forward_level
LEFT JOIN bo_application_submission as bac ON bac.submission_id=bo_application_forward_level.app_Sub_id
LEFT JOIN bo_district as bd ON bd.district_id=bac.landrigion_id
where 
 bac.application_id=1 AND bac.submission_id not in('22','268') AND bo_application_forward_level.approv_status='P' AND bo_application_forward_level.next_role_id=5
AND bac.application_status ='F'
 AND bo_application_forward_level.next_role_id=5 AND bac.user_id not in('11')
AND bo_application_forward_level.created_on >='".$startdate."' AND bo_application_forward_level.created_on <'".$enddate."' 
AND DATEDIFF(NOW(),DATE_FORMAT(bo_application_forward_level.created_on,'%Y-%m-%d'))>=16 
 AND DATEDIFF(NOW(),DATE_FORMAT(bo_application_forward_level.created_on,'%Y-%m-%d'))<=10000 
GROUP BY bac.submission_id";
            $command = $connection->createCommand($sqloiuostate);
            $appstatesss = $command->queryAll(); $StatependingCAFa=count($appstatesss);
			//print_r($StatependingCAF); die;
//////////////////////////////////////////////      


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$sqlhgfh="SELECT sp_id from sso_service_providers where is_service_provider_active='Y' and sp_id not in ('13','22','25','24')";
   $command=$connection->createCommand($sqlhgfh);
   $datefirst=$command->queryAll();
   $department_count  = count($datefirst);
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
   <div class="page-bar">
      <ul class="page-breadcrumb">
         <li>
                 <?php echo "<b>"; ?><span class="pull-left"><a href="/backoffice/admin" title="Go to Dashboard " class="fa fa-home homeredirect"></a></span> <?php if(DefaultUtility::is_PRINCIPAL_SECRETARY()){ ?>Welcome to State Monitoring Panel - Uttarakhand<?php } if(DefaultUtility::is_CHEIF_SECRETARY()){ ?>Welcome to State Monitoring Panel - Uttarakhand<?php } if(RolesExt::isMISManager()){?> Welcome to MIS Manager Panel - Uttarakhand<?php } ?></b>
         </li>
      </ul>

      <div class="page-toolbar">
         <div id="" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom">
           <span class="thin uppercase hidden-xs" id="clock"><i class="icon-calendar"></i>&nbsp;<?=date('d-M Y')?>&nbsp;</span>
            <span class="thin uppercase hidden-xs"></span>&nbsp;

         </div>
      </div>
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
    <tbody>
   <tr>
   <td><b>Currently you are viewing data for "<?php echo $financial_year; ?>", If you want to change then select Financial Year : </b>&nbsp;&nbsp;</td>
   <td>
    <!--<select name="financial_year" class="form-control" id="huik" onchange="this.form.submit()"  >-->
    <select name="financial_year" class="form-control" id="huik" onchange="window.location='/backoffice/admin/default/index/FY/'+this.value" >
          <option value="ALL" <?php if($financial_year=="ALL"){ echo "selected='selected'"; } ?> >ALL</option>
   <?php for($i=$pp;$i<$yyy;$i++){ $j=$i+1; $k=$i.'-'.$j; ?>
         <option value="<?php echo $k; ?>" <?php if($financial_year==$k){ echo "selected='selected'"; } ?>><?php echo $k; ?></option>
    <?php } ?>
    </select>
       </td>
   </tr>
 </tbody>
   </table>
         </form>
         </div>
        
		</div></div>


      

    
<?php

$_GET['from_date'] = $startdate;
$_GET['to_date'] = $enddate;

$base=Yii::app()->theme->baseUrl;
$sql = "Select district_id, distric_name from bo_district";
$depptt = Yii::app()->db->createCommand($sql)->queryAll();
$totalCAFrecived_dist=0;
$totalReverted_dist=0;
$totalForwarded_dist=0;
$totalApproved_dist=0;
$totalRejected_dist=0;
$totalDICPending_dist=0;
$totalEmpCmtPending_dist=0;
$totalrbi_dist=getRBIInv('5');

$totalCAFrecived_state=0;
$totalReverted_state=0;
$totalForwarded_state=0;
$totalApproved_state=0;
$totalRejected_state=0;
$totalDICPending_state=0;
$totalEmpCmtPending_state=0;
$totalrbi_state=getRBIInv('6');

foreach ($depptt as $key => $dept) {
	$distID = $dept['district_id'];
	$totalCAFrecived_dist 	+= ApplicationV2Ext::getConsolidatedCafStatusCount($distID, 'districtSubmitted');
	$totalReverted_dist 	+= ApplicationV2Ext::getConsolidatedCafStatusCount($distID, 'districtReverted');
	$totalForwarded_dist 	+= ApplicationV2Ext::getConsolidatedCafStatusCount($distID, 'districtForwardedAndDisposed');
	$totalApproved_dist 	+= ApplicationV2Ext::getConsolidatedCafStatusCount($distID, 'districtApproved');
    $totalRejected_dist 	+= ApplicationV2Ext::getConsolidatedCafStatusCount($distID, 'districtRejected');
	$totalDICPending_dist 	+= ApplicationV2Ext::getConsolidatedCafStatusCount($distID, 'districtPending');
	$totalEmpCmtPending_dist+= ApplicationV2Ext::getConsolidatedCafStatusCount($distID, 'districtWatApproved');
}

$totalCAFrecived_state 	= ApplicationV2Ext::getConsolidatedCafStatusCount('6', 'stateSubmitted');
$totalReverted_state 	= ApplicationV2Ext::getConsolidatedCafStatusCount('6', 'stateReverted');
$totalForwarded_state 	= ApplicationV2Ext::getConsolidatedCafStatusCount('6', 'stateForwardedAndDisposed');
$totalApproved_state 	= ApplicationV2Ext::getConsolidatedCafStatusCount('6', 'stateApproved');
$totalRejected_state 	= ApplicationV2Ext::getConsolidatedCafStatusCount('6', 'stateRejected');
$totalDICPending_state 	= ApplicationV2Ext::getConsolidatedCafStatusCount('6', 'statePending');
$totalEmpCmtPending_state = ApplicationV2Ext::getConsolidatedCafStatusCount('6', 'stateWatApproved');
?>
<style type="text/css">
.pd_child{ padding-left: 50px !important; }
</style>
<section>
 <header class="panel-heading" >
       Nodal Agency Performance Monitoring <!-- From 2018-04-01 To 2018-07-14-->
    </header>  
	
<?php echo $this->renderPartial('nodalPerformanceReport1',array('startdate'=>$startdate,'enddate'=>$enddate), TRUE); ?>



    
<div class="row" style="display:none;">
	<div class="portlet light bordered col-md-12" style="margin-bottom:0px !important;">
		<!-- BEGIN SAMPLE TABLE PORTLET-->
		<div class="portlet box green">
            <div class="portlet-body">				
				<div class="table-scrollable">
					<table class="table table-bordered table-hover responsive-table" >
						<thead>
							<tr style="background-color:#BBBBBB;">
								<th style="font-weight:bold;font-size:16px; width:180px;">  </th>
								<th style="text-align:center;font-size:16px;font-weight:bold;"> District</th>
								<th style="text-align:center;font-size:16px;font-weight:bold;"> State</th>
								<th style="text-align:center;font-size:16px;font-weight:bold;"> Total</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th style="background-color:#f3f4f6;"><a title="Total Applications submitted ">1. Applications Submitted </a></th>
								<td style="text-align:center;" data-label=" In Process"><?php echo $totalCAFrecived_dist; ?> </td>
								<td style="text-align:center;" data-label=" Forwarded"> <?php echo $totalCAFrecived_state; ?> </td>
								<td style="text-align:center;" data-label=" Forwarded"> <?php echo $totalCAFrecived_dist+$totalCAFrecived_state; ?> </td>
							</tr>
<!--							<tr>
								<th style="background-color:#f3f4f6;"><a title="Total Applications reverted to investor to seek clarifications/ additional documents / information ">2. Applications Reverted </th>
							</tr>	-->
							<tr>
								<th style="background-color:#f3f4f6;"><a title="Total Applications reverted to investor to seek clarifications/ additional documents / information ">2. Applications Reverted </th>
								<td style="text-align:center;" data-label=" In Process"><?php echo $totalReverted_dist+$totalrbi_dist; ?> </td>
								<td style="text-align:center;" data-label=" Forwarded"> <?php echo $totalReverted_state+$totalrbi_state; ?> </td>
								<td style="text-align:center;" data-label=" Forwarded"> <?php echo $totalReverted_dist+$totalReverted_state+$totalrbi_dist+$totalrbi_state; ?> </td>
							</tr>
							<tr>
								<th style="background-color:#f3f4f6;" class="pd_child"><a title="Responses received on reverted applications">2.1 Responses received from Applicant for Query </th>
								<td style="text-align:center;" data-label=" In Process"> <?php echo $totalrbi_dist; ?> </td>
								<td style="text-align:center;" data-label=" Forwarded"> <?php echo $totalrbi_state; ?> </td>
								<td style="text-align:center;" data-label=" Reverted"> <?php echo $totalrbi_dist+$totalrbi_state; ?> </td>
							</tr>
							<tr>
								<th style="background-color:#f3f4f6;" class="pd_child"><a title="Responses awaited on reverted applications  ">2.2 Pending for repsonse </th>
								<td style="text-align:center;" data-label=" In Process"><?php echo $totalReverted_dist; ?> </td>
								<td style="text-align:center;" data-label=" Forwarded"> <?php echo $totalReverted_state; ?> </td>
								<td style="text-align:center;" data-label=" Forwarded"> <?php echo $totalReverted_dist+$totalReverted_state; ?> </td>
							</tr>
							<tr>
								<th style="background-color:#f3f4f6;"><a title="Total Applications forwarded to departments for Comments  ">3. Applications Forwarded to Department </a></th>
								<td style="text-align:center;" data-label=" In Process"> <?php echo $totalForwarded_dist; ?> </td>
								<td style="text-align:center;" data-label=" Forwarded"> <?php echo $totalForwarded_state; ?> </td>
								<td style="text-align:center;" data-label=" Reverted"> <?php echo $totalForwarded_dist+$totalForwarded_state; ?> </td>
							</tr>
							<tr>
								<th style="background-color:#f3f4f6;">4. Application Not forwarded to Department  </th>
								<td style="text-align:center;" data-label=" In Process"> <?php echo $totalDICPending_dist; ?> </td>
								<td style="text-align:center;" data-label=" Forwarded"> <?php echo $totalDICPending_state; ?> </td>
								<td style="text-align:center;" data-label=" Reverted"> <?php echo $totalDICPending_dist+$totalDICPending_state; ?> </td>
							</tr>
							<tr>
								<th style="background-color:#f3f4f6;" class="pd_child">4.1 Under process at DIC/ DoI </th>
								<td style="text-align:center;" data-label=" In Process"> 0 </td>
								<td style="text-align:center;" data-label=" Forwarded"> 0 </td>
								<td style="text-align:center;" data-label=" Reverted"> 0 </td>
							</tr>
							<tr>
								<th style="background-color:#f3f4f6;" class="pd_child">4.2 Pending at DIC/ DoI </th>
								<td style="text-align:center;" data-label=" In Process"> <?php echo $totalDICPending_dist; ?> </td>
								<td style="text-align:center;" data-label=" Forwarded"> <?php echo $totalDICPending_state; ?> </td>
								<td style="text-align:center;" data-label=" Reverted"> <?php echo $totalDICPending_dist+$totalDICPending_state; ?> </td>
							</tr>
							<tr>
								<th style="background-color:#f3f4f6;">5. Applications Approved for Empowered Committee </th>
								<td style="text-align:center;" data-label=" In Process"> <?php echo $totalEmpCmtPending_dist; ?> </td>
								<td style="text-align:center;" data-label=" Forwarded"> <?php echo $totalEmpCmtPending_state; ?> </td>
								<td style="text-align:center;" data-label=" Reverted"> <?php echo $totalEmpCmtPending_dist+$totalEmpCmtPending_state; ?> </td>
							</tr>
							<tr>
								<th style="background-color:#f3f4f6;">6. Applications Disposed </th>
								<td style="text-align:center;" data-label=" In Process"> <?php echo $totalApproved_dist+$totalRejected_dist; ?> </td>
								<td style="text-align:center;" data-label=" Forwarded"> <?php echo $totalApproved_state+$totalRejected_state; ?> </td>
								<td style="text-align:center;" data-label=" Reverted"> <?php echo $totalApproved_dist+$totalApproved_state+$totalRejected_dist+$totalRejected_state; ?> </td>
							</tr>
							<tr>
								<th style="background-color:#f3f4f6;" class="pd_child">6.1 Approved  </th>
								<td style="text-align:center;" data-label=" In Process"> <?php echo $totalApproved_dist; ?> </td>
								<td style="text-align:center;" data-label=" Forwarded"> <?php echo $totalApproved_state; ?> </td>
								<td style="text-align:center;" data-label=" Reverted"> <?php echo $totalApproved_dist+$totalApproved_state; ?> </td>
							</tr>
							<tr>
								<th style="background-color:#f3f4f6;" class="pd_child">6.1 Rejected </th>
								<td style="text-align:center;" data-label=" In Process"> <?php echo $totalRejected_dist; ?> </td>
								<td style="text-align:center;" data-label=" Forwarded"> <?php echo $totalRejected_state; ?> </td>
								<td style="text-align:center;" data-label=" Reverted"> <?php echo $totalRejected_dist+$totalRejected_state; ?> </td>
							</tr>

						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- END SAMPLE TABLE PORTLET-->
	</div>
</div>
<?php
function getRBIInv($dist=6){
	@extract($_GET);
	$wh='';
	if($dist==6){
		$wh = " AND s.landrigion_id='6'";
		
	}
	if(isset($from_date)){
	 $wh .= " AND DATE(application_created_date)>='".$from_date."'";
	}
	// To Date
	if(isset($to_date)){
	 $wh .= " AND DATE(application_created_date)<='".$to_date."'";
	}
	$sql = "SELECT count(*) as total FROM bo_application_submission as s INNER JOIN bo_application_flow_logs as l ON l.submission_id=s.submission_id AND s.user_id!='11' AND s.application_id='1' AND l.application_status='RBI' $wh GROUP BY s.submission_id";
	$sql = "SELECT l.application_status FROM  bo_application_flow_logs as l
INNER JOIN bo_application_submission as s ON l.submission_id=s.submission_id WHERE 
s.user_id!='11' AND s.application_id='1' AND l.application_status='RBI' $wh GROUP BY l.submission_id";
	$Fields = Yii::app()->db->createCommand($sql)->queryAll();
	return @count($Fields);
}

?>

</section>
	<section class="panel site-min-height" >
    <header class="panel-heading">
        Department Performance Report <!-- From 2018-04-01 To 2018-07-14-->
    </header>
    <div class="panel-body"> 
        <div class="table ">
			<div class="" style="margin:0px">
			<ul class="page-breadcrumb " style="text-align:center;width:100%;">
				 <li>
				 <?php $districtttt=$allprocessed+$districtProcessedWithoutResponseCAF+$districtpendingCAFUnderprocess+$districtpendingCAF; 
					   $statetttt=$stateProcessedCAF+$stateProcessedWithoutResponseCAF+$StatependingCAFUnderprocessa+$StatependingCAFa; ?>
				 <h3 style="font-size:18px; color:#343434; margin-bottom:20px;"><b>OVERALL CAF : <?php echo $districtttt+$statetttt; ?></b></h3>
		<?php //echo $allprocessed+$allpending+$districtProcessedWithoutResponseCAF+$stateProcessedCAF+$statePendingCAF+$stateProcessedWithoutResponseCAF; ?>		 
				 </li>
			</ul>
          </div>
		<div>

		<div class="portlet light bordered col-md-12">
		<div class="portlet-title">
			<div class="caption" style="width:100%;text-align: center;">
				<span class="caption-subject font-dark bold uppercase text-center" title="<?php echo count($Rty); ?>">
			 Total District Level CAF </b> : <?php echo $districtttt; ?></b> </span>
			</div>
		</div>
        <?php $prefix="";?>
        <div class="portlet-body">
        <div class="col-xs-12 col-sm-6 col-md-3 text-center" style="margin-bottom:5px;">
           <a href="<?php echo $prefix;?>/backoffice/mis/psCsReport/disposedCafDistrictLevel/financial_year/<?=$financial_year?>">                
                <div class="round-stats blue">
                    <h3 class="number"> <?=$allprocessed?>
                    </h3>
                </div>
				<div><p class="circle_desc">CAF Disposed with Response</p></div>
            </a>
        </div>
		<div class="col-xs-12 col-sm-6 col-md-3 text-center" style="margin-bottom:5px;">
            <a href="<?php echo $prefix;?>/backoffice/mis/psCsReport/disposedCafWithoutCommentDistrictLevel/fID/<?=$financial_year?>">               
                <div class="round-stats blue">
                    <h3 class="number"><?=$districtProcessedWithoutResponseCAF?>
                    </h3>
                </div>
				<div><p class="circle_desc">CAF Disposed without Response</p></div>
            </a>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3 text-center" style="margin-top:5px;">
          <a href="<?php echo $prefix;?>/backoffice/mis/psCsReport/pendingDistrictLevel/days/0/daysto/15/bw/<?=$financial_year?>">                
                <div class="round-stats blue">
                    <h3 class="number">
                       <?=$districtpendingCAFUnderprocess?>
                       <!-- <span data-counter="counterup" data-value=""></span>-->
                       </h3>
                </div>
				<div><p class="circle_desc">Under Process CAF  </p></div>
            </a>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3 text-center" style="margin-top:5px;">
          <a href="<?php echo $prefix;?>/backoffice/mis/psCsReport/pendingDistrictLevel/days/16/daysto/10000/bw/<?=$financial_year?>">               
                <div class="round-stats blue">
                    <h3 class="number">
                       <?=$districtpendingCAF?>
                       <!-- <span data-counter="counterup" data-value=""></span> allpending-->
                    </h3>
                </div>
				<div><p class="circle_desc">Pending CAF </p></div>
            </a>
        </div>
		<div class="clearfix"></div>
		</div>
		</div>


    <div class="portlet light bordered col-md-12">
		<div class="portlet-title">
			<div class="caption" style="width:100%;text-align: center;">
				<span class="caption-subject font-dark bold uppercase text-center">
			 Total State Level CAF </b> : <?php echo $statetttt; ?></b> </span>
			</div>
		</div>
		<div class="portlet-body">
         <div  class="col-xs-12 col-sm-6 col-md-3 text-center" style="margin-bottom:5px;">
            <a href="<?php echo $prefix;?>/backoffice/mis/psCsReport/disposedCafStateLevel/fID/<?=$financial_year?>">              
                <div class="round-stats blue">
                    <h3 class="number"><?=$stateProcessedCAF?>
                       <!-- <span data-counter="counterup" data-value="<?=$stateProcessedCAF?>"></span>-->
                    </h3>
                </div>
				<div><p class="circle_desc">CAF Disposed with Response</p></div>
            </a>
        </div>
        <div  class="col-xs-12 col-sm-6 col-md-3 text-center" style="margin-bottom:5px;">
            <a href="<?php echo $prefix;?>/backoffice/mis/psCsReport/disposedCafWithoutCommentStateLevel/fID/<?=$financial_year?>">                
                <div class="round-stats blue">
                    <h3 class="number"><?=$stateProcessedWithoutResponseCAF?>
                       <!-- <span data-counter="counterup" data-value="<?=$stateProcessedWithoutResponseCAF?>"></span>-->
                    </h3>
                </div>
				<div><p class="circle_desc">CAF Disposed without Response</p></div>
            </a>
        </div>
         <div class="col-xs-12 col-sm-6 col-md-3 text-center" style="margin-top:5px;">
          <a href="<?php echo $prefix;?>/backoffice/mis/psCsReport/pendingStateLevel/days/0/daysto/15/bw/<?=$financial_year?>">                
                <div class="round-stats blue">
                    <h3 class="number">
                       <?php echo $StatependingCAFUnderprocessa; ?> 
                       <!-- <span data-counter="counterup" data-value=""></span>-->
                       </h3>                  
                </div>
				<div><p class="circle_desc">Under Process CAF </p></div>
            </a>
        </div>
         <div class="col-xs-12 col-sm-6 col-md-3 text-center" style="margin-top:5px;">
            <a href="<?php echo $prefix;?>/backoffice/mis/psCsReport/pendingStateLevel/days/16/daysto/10000/bw/<?=$financial_year?>">                
                <div class="round-stats blue">
                    <h3 class="number"><?=$StatependingCAFa?>
                        <!--<span data-counter="counterup" data-value="<?=$statePendingCAF?>"></span>-->
                    </h3>
                </div>
				<div><p class="circle_desc">Pending CAF</p></div>
            </a>
        </div>
		<div class="clearfix"></div>
        </div>
    </div>
    </div>
    </div>
    </div>
   

        </section>
<!-------------------------------------------------------------Service Report---------------------------------------------------------------------------->
	<section class="panel site-min-height" style="display:">
<!--    <header class="panel-heading" style="background-color: #32c5d2;font-weight:bold;">
        Departmental Service Report  From 2018-04-01 To 2018-07-14
    </header>-->
    <div class="panel-body"> 
        <div class="table">
            <div class="" style="margin:0px">
				<ul class="page-breadcrumb " style="text-align:center;width:100%;">
					<li>
					<h3 style="font-size:18px; color:#343434; margin-bottom:20px;"><b><a href="/backoffice/mis/ServiceReport/psindex/d/<?=$_SESSION['dept_id']?>/s/T/d1/<?=$startdate?>/d2/<?=$enddate?>">SERVICE REPORT : <?php echo $totalServ-$incomServ; ?></a> </b></h3>
					</li>
				</ul>
			</div>
		<div class="">
       
        <div class="portlet light bordered">
			<!--<div class="portlet-title">
				<div class="caption" style="width:100%;text-align: center;">
					<span class="caption-subject font-dark bold uppercase text-center">
				 Total District Level CAF (27) </span>
				</div>
			</div> -->
			<div class="portlet-body">

					<div class="col-xs-12 col-sm-6 col-md-2 text-center" style="margin-bottom:5px;">
					   <a href="/backoffice/mis/ServiceReport/psindex/s/T/d1/<?=$startdate?>/d2/<?=$enddate?>">
							<div class="round-stats blue">
								<h3 class="number"> <?php echo $department_count; //echo"-"; echo $incomServ; ?>
									<!--<span data-counter="counterup" data-value=""></span>-->
								</h3>
							</div>
							<div><p class="circle_desc">Integrated Dept.</p></div>	
						</a>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-2 text-center" style="margin-bottom:5px;">
					   <a href="/backoffice/mis/ServiceReport/psindex/s/P/d1/<?=$startdate?>/d2/<?=$enddate?>">
							<div class="round-stats blue">
								<h3 class="number"> <?php echo $pendServ; ?>
									<!--<span data-counter="counterup" data-value=""></span>-->
								</h3>							
							</div>
							<div><p class="circle_desc">In Process</p></div>	
						</a>
					</div>
				  <div  class="col-xs-12 col-sm-6 col-md-2 text-center" style="margin-bottom:5px;">
					   <a href="/backoffice/mis/ServiceReport/psindex/d/<?=$_SESSION['dept_id']?>/s/F/d1/<?=$startdate?>/d2/<?=$enddate?>">
							<div class="round-stats blue">
								<h3 class="number"> <?php echo $fordServ; ?>
									<!--<span data-counter="counterup" data-value=""></span>-->
								</h3>							
							</div>
							<div><p class="circle_desc">Forwarded</p></div>	
						</a>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-2 text-center" style="margin-bottom:5px;">
					   <a href="/backoffice/mis/ServiceReport/psindex/d/<?=$_SESSION['dept_id']?>/s/RBI/d1/<?=$startdate?>/d2/<?=$enddate?>">							
							<div class="round-stats blue">
								<h3 class="number"> <?php echo $reveServ; ?>
									<!--<span data-counter="counterup" data-value=""></span>-->
								</h3>							
							</div>
							<div><p class="circle_desc">Reverted</p></div>	
						</a>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-2 text-center" style="margin-bottom:5px;">
					   <a href="/backoffice/mis/ServiceReport/psindex/d/<?=$_SESSION['dept_id']?>/s/R/d1/<?=$startdate?>/d2/<?=$enddate?>">
							<div class="round-stats blue">
								<h3 class="number"> <?php echo $rejServ; ?>
									<!--<span data-counter="counterup" data-value=""></span>-->
								</h3>								
							</div>
							<div><p class="circle_desc">Rejected</p></div>
						</a>
					</div>
				  
					<div class="col-xs-12 col-sm-6 col-md-2 text-center" style="margin-bottom:5px;">
					   <a href="/backoffice/mis/ServiceReport/psindex/d/<?=$_SESSION['dept_id']?>/s/A/d1/<?=$startdate?>/d2/<?=$enddate?>">
							<div class="round-stats blue">
								<h3 class="number"> <?php echo $appServ; ?>
									<!--<span data-counter="counterup" data-value=""></span>-->
								</h3>
							</div>
							<div><p class="circle_desc">Approved</p></div>
						</a>
					</div>
			 <div class="clearfix"></div>
			</div>
		</div>


     
    </div>
    </div>
    </div>
    </section>
 <!--------------------------------------------------------------------------------------------------------------------------------------------------------->

 <?php
 $financial_year = $financial_year;
 $department_id = $_SESSION['dept_id'];
 $timeline_count_arr = ReportExt::getServiceCountForTimelineDashboard($financial_year);
 //echo '<pre>';print_r($timeline_count_arr); die;
 if(isset($_GET['time'])){
	//ksort($timeline_count_arr['data_array']);
	//echo '<pre>';print_r($timeline_count_arr); die;
 }
 
 ?>
  <div class="clearfix"></div>
<div class="">
	<div class="" style="">
	<!-- BEGIN SAMPLE TABLE PORTLET-->
	<div class="portlet box green">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-list"></i>
				TIMELINE REPORT 
				<?php $sumArr = $timeline_count_arr['heading_array']; ?>
				SWA-<?php echo $sumArr['SWA_TA']+$sumArr['SWA_TV']; ?>
				
				</div>
			<div class="tools">
				<a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
			</div>
			<div class="dto-buttons" style="margin:3px 5px 0 0;float:right;"></div>	
		</div>
		<div class="portlet-body">
			<p>
			<b>*SWA</b> - Single Window Act, <!--<b>*RTS</b> - Right To Service, <b>*GA</b> - Governing Act, <b>*DN</b> - Departmental Notification-->
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
							<?php ksort($valArr);foreach($valArr as $cKey=>$cVal){  ?>
							<td style="text-align:center;"> <a href="<?php echo Yii::app()->createAbsoluteUrl('mis/ServiceReportAging/ServiceWiseReport/department_id/0/financial_year/'.$financial_year)?>"><?php echo $cVal; ?></a> </td>
							<?php } ?>
						   
						</tr>
						<?php } ?>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- END SAMPLE TABLE PORTLET-->
</div>
</div>
<!--------------------------------------------------------------------------------------------------------------------------------------------------------->
  <section class="panel">
	<div class="panel-body">
		<div class="table ">
			<div class="" style="margin:0px">
				<ul class="page-breadcrumb " style="text-align:center;width:100%;">
					<li>
					<h3 style="font-size:18px; color:#343434; margin-bottom:20px;"><a href="/backoffice/mis/GrievanceReport/psindex/s/T/d1/<?=$startdate?>/d2/<?=$enddate?>"><b>TOTAL GRIEVANCE : <?php echo @$grandtotal; ?> </b></a></h3> 
					</li>
				</ul>
			</div>
		</div>
		<div class="">

      
       <div class="col-xs-12 col-sm-6 text-center">
           <div class="portlet light bordered">
			<a href="/backoffice/mis/GrievanceReport/psindex/s/C/d1/<?=$startdate?>/d2/<?=$enddate?>">
				<div class="round-stats blue">
					<h3 class="number"><?php echo $grandclose;?></h3>
				</div>
				<div><p class="circle_desc">Close</p></div>
            </a>
			</div>
                                   
		</div>
		<div class="col-xs-12 col-sm-6 text-center">
            <div class="portlet light bordered">
			<a href="/backoffice/mis/GrievanceReport/psindex/s/O/d1/<?=$startdate?>/d2/<?=$enddate?>">
				<div class="round-stats blue">
					<h3 class="number"><?php echo $grandopen;?></h3>
				</div>
				<div><p class="circle_desc">Open</p></div>
            </a>
			</div>
                                   
		</div>						
		</div>	
	<div class="clearfix"></div>
</div>
 </section>	
<!-------------------------------------------------------------------------------------------------------------------------------------------------------->
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
                      <i class="icon-bar-chart"></i>
                      <span class="caption-subject bold uppercase"> Overall Pending CAF (State + District)</span>
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
                    <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"> </a>
                </div>
            </div>
            <div class="portlet-body">
                <div id="chartdivGrivance" class="CSSAnimationChart"></div>
            </div>
        </div>
      </div>
   

		<div class="col-xs-12 col-md-6">
      
          <div class="portlet light bordered">
              <div class="portlet-title">
                  <div class="caption">
                      <i class="icon-bar-chart"></i>
                      <span class="caption-subject bold uppercase"> Total Open Grievance</span>
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
        

      </div>
</div>
<div class="clearfix"></div>
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
var TableDatatablesButtons = function () {
        var e = function () {
            var e = $("#sample_1");
           e.dataTable({
					language: {
						aria: {
							sortAscending: ": activate to sort column ascending",
							sortDescending: ": activate to sort column descending"
						},
						emptyTable: "No data available in table",
						info: "Showing _START_ to _END_ of _TOTAL_ entries",
						infoEmpty: "No entries found",
						infoFiltered: "(filtered1 from _MAX_ total entries)",
						lengthMenu: "_MENU_ entries",
						search: "Search:",
						zeroRecords: "No matching records found"
					},
					buttons: [{
							extend: "print",
							className: "btn white btn-outline"
						}, {
							extend: "pdf",
							className: "btn white btn-outline"
						}, {
							extend: "excel",
							className: "btn white btn-outline"
						}],
					order: [
						[0, "asc"]
					],
					lengthMenu: [
						[5, 10, 15, 20, -1],
						[5, 10, 15, 20, "All"]
					],
					pageLength: 10,
					dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
				});
				$("#sample_1_tools > li > a.tool-action").on("click", function () {
					var e = $(this).attr("data-action");
					t.DataTable().button(e).trigger()
				})
			},
         t = function () {
				var e = $("#sample_2");
				e.dataTable({
					language: {
						aria: {
							sortAscending: ": activate to sort column ascending",
							sortDescending: ": activate to sort column descending"
						},
						emptyTable: "No data available in table",
						info: "Showing _START_ to _END_ of _TOTAL_ entries",
						infoEmpty: "No entries found",
						infoFiltered: "(filtered1 from _MAX_ total entries)",
						lengthMenu: "_MENU_ entries",
						search: "Search:",
						zeroRecords: "No matching records found"
					},
					buttons: [{
							extend: "print",
							className: "btn white btn-outline"
						}, {
							extend: "pdf",
							className: "btn white btn-outline"
						}, {
							extend: "excel",
							className: "btn white btn-outline"
						}],
					order: [
						[0, "asc"]
					],
					lengthMenu: [
						[5, 10, 15, 20, -1],
						[5, 10, 15, 20, "All"]
					],
					pageLength: 10,
					dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
				});
				 $("#sample_2_tools > li > a.tool-action").on("click", function () {
					var e = $(this).attr("data-action");
					t.DataTable().button(e).trigger()
				  })
			},
                a = function () {
                    var e = $("#sample_3"),
					t = e.dataTable({
						language: {
							aria: {
								sortAscending: ": activate to sort column ascending",
								sortDescending: ": activate to sort column descending"
							},
							emptyTable: "No data available in table",
							info: "Showing _START_ to _END_ of _TOTAL_ entries",
							infoEmpty: "No entries found",
							infoFiltered: "(filtered1 from _MAX_ total entries)",
							lengthMenu: "_MENU_ entries",
							search: "Search:",
							zeroRecords: "No matching records found"
						},
						buttons: [{
							extend: "print",
								className: "btn white btn-outline"
							}, {
								extend: "pdf",
								className: "btn white btn-outline"
							}, {
								extend: "excel",
								className: "btn white btn-outline"
						}],
						responsive: !0,
						order: [
							[0, "asc"]
						],
						lengthMenu: [
							[5, 10, 15, 20, -1],
							[5, 10, 15, 20, "All"]
						],
						pageLength: 10
					});
                    $("#sample_3_tools > li > a.tool-action").on("click", function () {
                        var e = $(this).attr("data-action");
                        t.DataTable().button(e).trigger()
                    })
                },
                n = function () {
                  /*   $(".date-picker").datepicker({
                        rtl: App.isRTL(),
                        autoclose: !0
                    }); */
                    var e = new Datatable;
                    e.init({
                        src: $("#datatable_ajax"),
                        onSuccess: function (e, t) {},
                        onError: function (e) {},
                        onDataLoad: function (e) {},
                        loadingMessage: "Loading...",
                        dataTable: {
                            bStateSave: !0,
                            lengthMenu: [
                                [10, 20, 50, 100, 150, -1],
                                [10, 20, 50, 100, 150, "All"]
                            ],
                            pageLength: 10,
                            ajax: {
                                url: "../demo/table_ajax.php"
                            },
                            order: [
                                [1, "asc"]
                            ],
                            buttons: [{
                                    extend: "print",
                                    className: "btn default"
                                }, {
                                    extend: "copy",
                                    className: "btn default"
                                }, {
                                    extend: "pdf",
                                    className: "btn default"
                                }, {
                                    extend: "excel",
                                    className: "btn default"
                                }, {
                                    extend: "csv",
                                    className: "btn default"
                                }, {
                                    text: "Reload",
                                    className: "btn default",
                                    action: function (e, t, a, n) {
                                        t.ajax.reload(), alert("Datatable reloaded!")
                                    }
                                }]
                        }
                    }), e.getTableWrapper().on("click", ".table-group-action-submit", function (t) {
                        t.preventDefault();
                        var a = $(".table-group-action-input", e.getTableWrapper());
                        "" != a.val() && e.getSelectedRowsCount() > 0 ? (e.setAjaxParam("customActionType", "group_action"), e.setAjaxParam("customActionName", a.val()), e.setAjaxParam("id", e.getSelectedRows()), e.getDataTable().ajax.reload(), e.clearAjaxParams()) : "" == a.val() ? App.alert({
                            type: "danger",
                            icon: "warning",
                            message: "Please select an action",
                            container: e.getTableWrapper(),
                            place: "prepend"
                        }) : 0 === e.getSelectedRowsCount() && App.alert({
                            type: "danger",
                            icon: "warning",
                            message: "No record selected",
                            container: e.getTableWrapper(),
                            place: "prepend"
                        })
                    }), $("#datatable_ajax_tools > li > a.tool-action").on("click", function () {
                        var t = $(this).attr("data-action");
                        e.getDataTable().button(t).trigger()
                    })
                };
        return {
            init: function () {
                jQuery().dataTable && (e(), t(), a(), n())
            }
        }
    }();
    jQuery(document).ready(function () {
        TableDatatablesButtons.init()
    });

</script>

