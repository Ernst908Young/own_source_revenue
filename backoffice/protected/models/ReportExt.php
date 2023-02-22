<?php 
class ReportExt{
	/*used to get the service reports
	@author : Santosh Kumar
	@param: 
	@return: array
	@30-12-2017
	*/
	public static function getServiceCountForTimelineDashboard($fyear=NULL,$department_id=NULL) {
		$returnArr = array();
		$returnArr['SWA_TA']=0;
		$returnArr['SWA_TV']=0;
		$returnArr['RTS_TA']=0;
		$returnArr['RTS_TV']=0;
		$returnArr['GA_TA']=0;
		$returnArr['GA_TV']=0;
		$returnArr['DN_TA']=0;
		$returnArr['DN_TV']=0;
		$status_array=array();
		$returnArr1=array();
		
		$isactive = 'Y';
		$connection=Yii::app()->db; 
		$where_condition = "";
		if($fyear != 'ALL'){
			list($start_year,$end_year) = explode("-",$fyear);
			$start_year_date 	= $start_year."-04-01";
			$end_year_date 		= $end_year."-03-31";
			$where_condition = " AND DATE(apps.created_on)>='$start_year_date' AND DATE(apps.created_on)<='$end_year_date'";
		}
		if($department_id>0){
			$where_condition .= " AND sso.department_id='$department_id'";
		}
		
		$sql="SELECT apps.sp_app_id,apps.sno,apps.timeline_ref,apps.app_status FROM bo_sp_applications as apps
				INNER JOIN bo_sp_all_applications as sp_ap ON sp_ap.app_id=apps.sp_app_id
				INNER JOIN sso_service_providers as sso ON sso.sp_id=sp_ap.sp_id
				WHERE apps.user_id!='11' AND apps.app_status!='I' AND apps.timeline_ref IS NOT NULL $where_condition
				ORDER BY apps.app_status ASC";
		//echo $sql; die;
		$command=$connection->createCommand($sql);
		$resList=$command->queryAll();	
		if(!empty($resList)){
			foreach($resList as $resListArray){
				$sno = $resListArray['sno'];
				$timeline_ref = $resListArray['timeline_ref'];
				$app_status = $resListArray['app_status'];
				$taken_time_dept_in_days 	= ReportExt::getDepartmentTime($sno);
				$responseArr 				= ReportExt::getDepartmentTimeline($timeline_ref,$taken_time_dept_in_days);
				if(!empty($responseArr)){
					foreach($responseArr as $key=>$val){
						$app_status = $app_status=='H'?'RBI':$app_status;
						//START
						if($app_status == "P"){
							$app_status_new = "0_P";
						}else if($app_status == "F"){
							$app_status_new = "1_F";
						}else if($app_status == "RBI"){
							$app_status_new = "2_RBI";
						}else if($app_status == "R"){
							$app_status_new = "3_R";
						}else if($app_status == "A"){
							$app_status_new = "4_A";
						}
						//END
						$app_status_array[]=$app_status_new;
						if(!isset($returnArr1[$key][$app_status_new]))
							$returnArr1[$key][$app_status_new]=0;
						$returnArr1[$key][$app_status_new] = $returnArr1[$key][$app_status_new]+$val;
						$returnArr[$key] = $returnArr[$key]+$val;
					}
				}
			}
		}
		
		if(isset($app_status_array)){
			$app_status_array = array_unique($app_status_array);
			foreach($app_status_array as $key=>$val){
				$status_array[] = $val;
			}
		}else{
			$status_array[] = "0_P";
			$status_array[] = "1_F";
			$status_array[] = "2_RBI";
			$status_array[] = "3_R";
			$status_array[] = "4_A";
			foreach($returnArr as $key=>$val){
				foreach($status_array as $key1=>$val1)
					$returnArr1[$key][$val1]='NA';
			}
			
		}
		
		$responseArray['heading_array'] = $returnArr;
		$responseArray['data_array'] = $returnArr1;
		$responseArray['status_array'] = $status_array;
		
		//echo '<pre>';print_r($returnArr);echo "<hr>";echo '<pre>';print_r($returnArr1);print_r(array_unique($status_array));
		return $responseArray;
	}
	
	/*used to get the service reports service wise
	@author : Santosh Kumar
	@param: 
	@return: array
	@01-01-2018
	*/
	public static function getServiceCountServiceWise($fyear=NULL,$department_id=NULL,$appNo=null) {
		$returnArr = array();
		$returnArr['SWA_TA']=0;
		$returnArr['SWA_TV']=0;
		$returnArr['RTS_TA']=0;
		$returnArr['RTS_TV']=0;
		$returnArr['GA_TA']=0;
		$returnArr['GA_TV']=0;
		$returnArr['DN_TA']=0;
		$returnArr['DN_TV']=0;
		$heading_array=array();
		$returnArr1=array();
		$snoo="0";
		$isactive = 'Y';
		$connection=Yii::app()->db; 
		$where_condition = "";
		if($fyear != 'ALL'){
			list($start_year,$end_year) = explode("-",$fyear);
			$start_year_date 	= $start_year."-04-01";
			$end_year_date 		= $end_year."-03-31";
			$where_condition = " AND DATE(apps.created_on)>='$start_year_date' AND DATE(apps.created_on)<='$end_year_date'";
		}
		if($department_id >0){
			$where_condition .= " AND sso.department_id='$department_id'";
		}
		
		 $sql="SELECT apps.sp_app_id,apps.sno,apps.timeline_ref,apps.app_status,sp_ap.app_name,s_parm.core_service_name,sso.department_id FROM bo_sp_applications as apps
				INNER JOIN bo_sp_all_applications as sp_ap ON sp_ap.app_id=apps.sp_app_id
				INNER JOIN sso_service_providers as sso ON sso.sp_id=sp_ap.sp_id
				INNER JOIN bo_information_wizard_service_parameters as s_parm ON s_parm.swcs_service_id=sp_ap.app_id
				WHERE apps.user_id!='11' AND apps.app_status!='I' AND apps.timeline_ref IS NOT NULL $where_condition
				GROUP BY apps.sno
				ORDER BY apps.app_status ASC
			";
		//echo $sql; die;
		$command=$connection->createCommand($sql);
		$resList=$command->queryAll();	
		if(!empty($resList)){
			foreach($resList as $resListArray){
				$sno = $resListArray['sno'];
				$timeline_ref = $resListArray['timeline_ref'];
				$app_status = $resListArray['app_status'];
				$sp_app_id = $resListArray['sp_app_id'];
				$core_service_name = $resListArray['core_service_name'];
				$app_name = $resListArray['app_name'];
				$department_id = $resListArray['department_id'];
				$taken_time_dept_in_days = ReportExt::getDepartmentTime($sno);
                              //  echo $sno."===".$timeline_ref."===".$taken_time_dept_in_days;die;
                                if($appNo!=null){if($taken_time_dept_in_days>15){$snoo=1;}else{$snoo='0';}}
				$responseArr = ReportExt::getDepartmentTimeline($timeline_ref,$taken_time_dept_in_days);
				if(isset($_GET['time'])){
					echo '<hr> '.$sno.' <pre>'; print_r($responseArr);
				}
                             //   print_r($responseArr);die;
                                 if($appNo!=null){if($taken_time_dept_in_days>15){$snoo=$snoo.",".$sno;}}
				foreach($responseArr as $key=>$val){
					if(!isset($returnArr1[$sp_app_id][$key]))
						$returnArr1[$sp_app_id][$key]=0;
					$returnArr1[$sp_app_id][$key] = $returnArr1[$sp_app_id][$key]+$val;
					  if($appNo!=null && $snoo==1){
                                             // $returnArr1[$sp_app_id][$key]['service']=array();
                                              if($val>0)
                                              $returnArr1[$sp_app_id][$key.'_service'] = @$returnArr1[$sp_app_id][$key.'_service'].",".$sno; 
                                            //  print_r($snoo);die;
                                          }
					$heading_array[$sp_app_id] = $app_name;
					$department_array[$sp_app_id] = $department_id;
					//$returnArr[$key] = $returnArr[$key]+$val;
				}
                               // $snoo="0";
			}
		}
		/*$app_status_array = array_unique($app_status_array);
		foreach($app_status_array as $key=>$val){
			$status_array[] = $val;
		}*/
		
		$responseArray['heading_array'] = $heading_array;
		$responseArray['data_array'] = $returnArr1;
		$responseArray['department_array'] = @$department_array;
		
		//$responseArray['status_array'] = $status_array;
		
		//echo '<pre>';print_r($returnArr);echo "<hr>";echo '<pre>';print_r($returnArr1);print_r(array_unique($status_array));
               // echo "=".$snoo; 
              //  print_r($returnArr1);die;
		 return $responseArray;
	}
	
	public static function getDepartmentTimeline($ids,$days){
		
		$returnArr = array();
		$returnArr['SWA_TA']=0;
		$returnArr['SWA_TV']=0;
		$returnArr['RTS_TA']=0;
		$returnArr['RTS_TV']=0;
		$returnArr['GA_TA']=0;
		$returnArr['GA_TV']=0;
		$returnArr['DN_TA']=0;
		$returnArr['DN_TV']=0;
		if($ids<=0)
			return $returnArr;				
		$connection=Yii::app()->db; 
		$sql = "SELECT timeline_type,timeline_type_service,timeline_type_service_value FROM bo_infowizard_service_timeline_new WHERE timeline_id IN ($ids) AND is_active='Y'";
		$command=$connection->createCommand($sql);
		$resList=$command->queryAll();
		if(!empty($resList)){
			foreach($resList as $resListArr){
				$timeline_type 			= strtoupper($resListArr['timeline_type']);
				$timeline_type_service 	= strtoupper($resListArr['timeline_type_service']);
				$timeline_type_service_value 	= $resListArr['timeline_type_service_value'];
				if($timeline_type == 'SWA'){
					if($timeline_type_service_value == 'NA'){
						$returnArr['SWA_TA']=0;
						$returnArr['SWA_TV']=0;
					}else if($days<=$timeline_type_service_value){
						$returnArr['SWA_TA']=1;
						$returnArr['SWA_TV']=0;
					}else if($days>$timeline_type_service_value){
						$returnArr['SWA_TA']=0;
						$returnArr['SWA_TV']=1;
					}
				}else if($timeline_type == 'RTS'){
					if($timeline_type_service_value == 'NA'){
						$returnArr['RTS_TA']=0;
						$returnArr['RTS_TV']=0;
					}else if($days<=$timeline_type_service_value){
						$returnArr['RTS_TA']=1;
						$returnArr['RTS_TV']=0;
					}else if($days>$timeline_type_service_value){
						$returnArr['RTS_TA']=0;
						$returnArr['RTS_TV']=1;
					}
				}else if($timeline_type == 'DN'){
					if($timeline_type_service_value == 'NA'){
						$returnArr['DN_TA']=0;
						$returnArr['DN_TV']=0;
					}else if($days<=$timeline_type_service_value){
						$returnArr['DN_TA']=1;
						$returnArr['DN_TV']=0;
					}else if($days>$timeline_type_service_value){
						$returnArr['DN_TA']=0;
						$returnArr['DN_TV']=1;
					}
				}else if($timeline_type == 'GA'){
					if($timeline_type_service_value == 'NA'){
						$returnArr['GA_TA']=0;
						$returnArr['GA_TV']=0;
					}else if($days<=$timeline_type_service_value){
						$returnArr['GA_TA']=1;
						$returnArr['GA_TV']=0;
					}else if($days>$timeline_type_service_value){
						$returnArr['GA_TA']=0;
						$returnArr['GA_TV']=1;
					}
				}
			}
		}
		return $returnArr;
	}
	
	public static function getDepartmentTime($sno){
		               $count=1;
				
				$diffapplicant=0;$diffdept=0;
		
		$allDaysdept=0;
		$connection=Yii::app()->db; 
		$sql="SELECT * FROM bo_sp_application_history where sp_app_id=:sno Order By history_id DESC";
		$command=$connection->createCommand($sql);
		$command->bindParam(":sno",$sno,PDO::PARAM_INT);
		$history=$command->queryAll();
		
		//$history=ServiceReportController::getApplicationHistoryDetail($sno);
		if(!empty($history)){
			$apps1=$history;
			foreach($history as $key => $apps){
				$status = $apps['application_status'];
				if($status=="RBI"){
				$keyval=$key-1;
				 if($keyval>=0){
				$date=$apps1[$keyval]['added_date_time'];
				 }else{
					$date=date('Y-m-d H:i:s');   
				 }
				 
				 // 1
				 //echo $date."===".$apps['added_date_time']."<br>";
					$diff = abs(strtotime($apps['added_date_time']) - strtotime($date));
					$diffapplicant=$diffapplicant+$diff;
					$years = floor($diff / (365*60*60*24));
					$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
					$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
					$hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60));
					$minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);
					$seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minuts*60));
					$allDays=($months*30)+$days;
					//printf("%d days, %d hrs, %d min\n",  $allDays , $hours ,$minuts);
				}
				
				// 222
				
				if($status!="RBI"){
					if($key==0){
					if($status=="A" || $status=="R"){
					   $date= $apps['added_date_time'];
					}else {
					  $date=  date('Y-m-d H:i:s');
					}
					
				}else{
					$keyval=$key-1;
					$date=$apps1[$keyval]['added_date_time'];
					
				}
				//echo $date;
				$diff1 = abs(strtotime($apps['added_date_time']) - strtotime($date));

				$diffdept=$diffdept+$diff1;
				$years = floor($diff1 / (365*60*60*24));
				$months = floor(($diff1 - $years * 365*60*60*24) / (30*60*60*24));
				$days = floor(($diff1 - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
				$hours   = floor(($diff1 - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60));
				$minuts  = floor(($diff1 - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);
				$seconds = floor(($diff1 - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minuts*60));
				$allDays=($months*30)+$days;

				//printf("%d days, %d hrs, %d min\n",  $allDays , $hours ,$minuts);


				}
				 
			}
			
			$years = floor($diffdept / (365*60*60*24));
			$months = floor(($diffdept - $years * 365*60*60*24) / (30*60*60*24));
			$days = floor(($diffdept - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
			$hours   = floor(($diffdept - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60));
			$minuts  = floor(($diffdept - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);
			$seconds = floor(($diffdept - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minuts*60));
			$allDaysdept=($months*30)+$days;

			
			//printf("%d days, %d hrs, %d min\n",  $allDaysdept , $hours ,$minuts);
			
			
		}
		return $allDaysdept;
		
	}
	
	/************************
		DEPARTMENTAL RANKING FUNCTION
		@SANTOSH KUMAR
		DATE - 09-01-2018
	***************************************/
	public static function getDepartmentalRanking($startdate,$enddate){
		$ranking_percentage_array= array();
		$connection=Yii::app()->db;
		$sqlD = "SELECT * FROM bo_departments WHERE is_department_active='1'";
		$command=$connection->createCommand($sqlD);
		$resD=$command->queryAll();
		$i=0;
		$rank=1;
		foreach($resD as $keyD=>$deptArr){
			$r_dept_id = $deptArr['dept_id'];
			$r_dept_name = $deptArr['department_name'];
			// Total Disposed CAF
			$sqlTotalDisposed = "SELECT f.appr_lvl_id FROM bo_application_forward_level as f 
					INNER JOIN bo_application_submission as bac ON bac.submission_id=f.app_Sub_id
					WHERE bac.application_status IN ('F','A','R','RBI','H') 
					AND bac.application_id=1 AND bac.submission_id not in ('22','268') AND f.approv_status='V'
					AND bac.user_id not in('11')
					AND DATE(f.created_on) >='".$startdate."' AND DATE(f.created_on) <'".$enddate."' 
					AND DATEDIFF(f.comment_date,DATE_FORMAT(f.created_on,'%Y-%m-%d'))>=0 
					AND DATEDIFF(f.comment_date,DATE_FORMAT(f.created_on,'%Y-%m-%d'))<=15
					AND f.forwarded_dept_id='$r_dept_id' group by bac.submission_id
					";
			$command=$connection->createCommand($sqlTotalDisposed);
			$resTotalDisposed=$command->queryAll();
			$TotalDisposed = count($resTotalDisposed);
			
			// Total CAF
			$sqlTotalCaf = "SELECT * FROM bo_application_forward_level as f 
					INNER JOIN bo_application_submission as bac ON bac.submission_id=f.app_Sub_id
					WHERE bac.application_status IN ('F','A','R','RBI','H')
					AND bac.application_id=1 AND bac.submission_id not in ('22','268') AND f.approv_status IN ('V','P')
					AND bac.user_id not in('11')
					AND DATE(f.created_on) >='".$startdate."' AND DATE(f.created_on) <'".$enddate."'
					AND f.forwarded_dept_id='$r_dept_id' group by bac.submission_id
					";
			$command=$connection->createCommand($sqlTotalCaf);
			$resTotalCaf=$command->queryAll();
			$TotalCaf = count($resTotalCaf);
			// Total UP
			$sqlTotalUP = "SELECT * FROM bo_application_forward_level as f 
					INNER JOIN bo_application_submission as bac ON bac.submission_id=f.app_Sub_id
					WHERE bac.application_status IN ('F')
					AND bac.application_id=1 AND bac.submission_id not in ('22','268') AND f.approv_status IN ('P')
					AND bac.user_id not in('11')
					AND DATE(f.created_on) >='".$startdate."' AND DATE(f.created_on) <'".$enddate."'
					AND f.forwarded_dept_id='$r_dept_id'
					group by bac.submission_id
					";
			$command=$connection->createCommand($sqlTotalUP);
			$resTotalUP=$command->queryAll();
			$TotalUP = count($resTotalUP);
			$devided_by = $TotalCaf-$TotalUP;
			$ranking_percentage=$TotalDisposed;
			if($devided_by>0){
				$ranking_percentage = ($TotalDisposed*100)/($TotalCaf-$TotalUP);
				$percentage = number_format(round($ranking_percentage,2),2);
				$ranking_percentage_array[$r_dept_id."_".$r_dept_name] = number_format(round($ranking_percentage,2),2);
				
				/*if($i>0 && ($percentage == $ranking_percentage_array[$i-1]['percentage'])){
					$rank = $rank-1;
				}
				
				$ranking_percentage_array[$i]['dept_name'] 	= $r_dept_name;
				$ranking_percentage_array[$i]['percentage'] = $percentage;
				$ranking_percentage_array[$i]['rank'] 		= $rank;
				$i++;$rank++;*/
			}
			
			/*$ranking_count_array[$r_dept_id."_".$r_dept_name]['total_disposed'] =  $TotalDisposed;
			$ranking_count_array[$r_dept_id."_".$r_dept_name]['total_caf'] =  $TotalCaf;
			$ranking_count_array[$r_dept_id."_".$r_dept_name]['total_up_caf'] =  $TotalUP; print_r($ranking_count_array);*/
			
		}
		arsort($ranking_percentage_array);
		return $ranking_percentage_array;
	}
	
	/*
	
	*/
	public static function checkServiceTimeLine($sno,$act_timeline_days,$department_time_taken,$flag=false){
	
		$years = floor($department_time_taken / (365 * 60 * 60 * 24));
		$months = floor(($department_time_taken - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
		$days = floor(($department_time_taken - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
		$hours = floor(($department_time_taken - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
		$minuts = floor(($department_time_taken - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
		$seconds = floor(($department_time_taken - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
		$allDays = ($months * 30) + $days;
		if($flag == 'TA'){
			if($allDays<=$act_timeline_days){
				$return_flag = TRUE;
			}else{
				$return_flag = FALSE;
			}
		}else if($flag == 'TV'){
			if($allDays>$act_timeline_days){
				$return_flag = TRUE;
			}else{
				$return_flag = FALSE;
			}
		}else if($flag == false){
			$return_flag = TRUE;
		}
		
		return $return_flag;
	}
	
	
	
}
	

?>