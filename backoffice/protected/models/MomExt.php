<?php

/**
 * Author - Santosh Kumar
 
 */
class MomExt extends Mom
{
	/* -- Author - SANTOSH KUMAR */
			static function getAllCAFID(){
				$connection=Yii::app()->db; 
				$sql = "SELECT * FROM bo_application_submission WHERE application_status in('A','R','F') AND Submission_id  in(select submission_id from bo_application_submission as app1
			  inner join
			  bo_application_verification_level as app2
			  ON app1.submission_id=app2.app_sub_id
			  where app1.landrigion_id='6' and app1.application_status in('P','H','F','A','R') and app2.next_role_id in('4','34')) AND Submission_id not in('22','268')";
				$command=$connection->createCommand($sql);
				//$command->bindParam(":is_service_provider_active",'Y',PDO::PARAM_STR);
				$sp=$command->queryAll();	
				$results=array();
				$i=0;
				foreach($sp as $key=>$val){
					$caf_id 		= $val['submission_id'];
					$field_value 	= json_decode($val['field_value'],true);
					$company_name 	= $field_value['company_name'];
					if($company_name!=''){
						$results[$i]['caf_id_only'] = $caf_id;
						$results[$i]['caf_id'] = $caf_id."~".$company_name;
						$results[$i]['company_name'] = $caf_id." - ".$company_name;
					}
					$i++;
				}
				//print_r($sp);
				return $results;
			}

			static function getAllCAFIDMOM($landrigion_id,$role_id){
				$connection=Yii::app()->db; 
                                if($role_id == '7'){
				$sql = "SELECT * FROM bo_application_submission WHERE application_status in('P','F') AND application_id = 1 AND Submission_id  in(select submission_id from bo_application_submission as app1
			  inner join
			  bo_application_verification_level as app2
			  ON app1.submission_id=app2.app_sub_id
			  where app1.landrigion_id='$landrigion_id'  and app1.field_value not like '%ntrofunittype" . '":"' . 'large' . "%' and app1.application_status in('P','F') and app2.next_role_id in('7','33')) AND Submission_id not in('22','268')";
                                }else if ($role_id == '4'){
                                    $sql = "SELECT * FROM bo_application_submission WHERE application_status in('P','F') AND application_id = 1 AND Submission_id  in(select submission_id from bo_application_submission as app1
			  inner join
			  bo_application_verification_level as app2
			  ON app1.submission_id=app2.app_sub_id
			  where  app1.field_value like '%ntrofunittype" . '":"' . 'large' . "%' and app1.application_status in('P','F') and app2.next_role_id in('4','34')) AND Submission_id not in('22','268')";
                                    
                                }
				$command=$connection->createCommand($sql);
				//$command->bindParam(":is_service_provider_active",'Y',PDO::PARAM_STR);
				$sp=$command->queryAll();	
				$results=array();
				$i=0;
				foreach($sp as $key=>$val){
					$caf_id 		= $val['submission_id'];
					$field_value 	= json_decode($val['field_value'],true);
					$company_name 	= $field_value['company_name'];
					if($company_name!=''){
						$results[$i]['caf_id_only'] = $caf_id;
						$results[$i]['caf_id'] = $caf_id."~".$company_name;
						$results[$i]['company_name'] = $company_name." ( CAF ID: $caf_id ) ";
						$results[$i]['caf_name'] = $company_name;
						$results[$i]['caf_id_only'] = $caf_id ;
						$results[$i]['data'] = $val;
					}
					$i++;
				}
				//print_r($sp);
				return $results;
			}

			static function getAllAttendees($disctrict_id){
				$connection=Yii::app()->db; 
				$sql = "select * from bo_user left join bo_user_role_mapping on bo_user.uid = bo_user_role_mapping.user_id where role_id = 3 and disctrict_id =$disctrict_id";
				$command=$connection->createCommand($sql);
				//$command->bindParam(":is_service_provider_active",'Y',PDO::PARAM_STR);
				$sp=$command->queryAll();	
				$results=array();
				$i=0;
				foreach($sp as $key=>$val){
					$uid 		= $val['uid'];
					$full_name 		= $val['full_name'];
					$results[$i]['uid'] = $uid;
					$results[$i]['full_name'] = $full_name;
					$i++;
				}
				//print_r($sp);
				return $results;
			}
    public static function getDisttId($uid) {
        $sql = "SELECT disctrict_id  FROM bo_user WHERE uid=$uid";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        //$command->bindParam(":aprvhold",$aprvhold,PDO::PARAM_STR);
        //$command->bindParam(":sub_id", $sub_id, PDO::PARAM_INT);
        $dist = $command->queryRow();
        // print_r($appList);die;	
        if ($dist === false)
            return false;
        return $dist['disctrict_id'];
    }
	public static function cafStatus($caf_id) {
        $sql = "SELECT * FROM `bo_mom_user_comments` where caf_id=$caf_id and status=1";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        //$command->bindParam(":aprvhold",$aprvhold,PDO::PARAM_STR);
        //$command->bindParam(":sub_id", $sub_id, PDO::PARAM_INT);
        $dist = $command->queryRow();
        // print_r($appList);die;	
        if ($dist === false)
            return 0;
        return 1;
    }
	
	public static function getReceivedDAteById($cafID){
		$sql = "select created_date_time from 	bo_application_flow_logs where application_status='ISA' AND submission_id=$cafID";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        
        $dist = $command->queryRow();
        	
        return $dist;
	}
	public static function getCafDetailsById($cafID){
		
		$sql = "SELECT  * from bo_application_submission where submission_id='$cafID'";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        
        $deptt = $command->queryAll();
        	
		$count = 0;$NODTIME='0 days';$INVTIME = '0 days';
        $allsub = array();
        $srn = 0;       
        
		$returnData = [] ; 
		
		$fields = json_decode($deptt[0]['field_value']); 
		
		$approval = [] ;
		if(isset($fields->requried_approval_department)){
			foreach ($fields->requried_approval_department as $key => $value) {
				if(empty($fields->requried_approval_department[$key]))
                                       continue;
				$department = @$fields->requried_approval_department[$key];
				$approval_name = @$fields->required_approval_name[$key]	;			
				
				$approval[] = [
					'dept'=>$department,
					'approval_name'=>$approval_name,
				];				
			}
		}
		
		//echo "<pre>";print_r($field_value->requried_approval_department);
		//die ;
        if (!empty($deptt)) {
            foreach ($deptt as $key => $dept) {
				
				//echo "";print_r($deptt); die ;
				
                $cafindname = "";//ApplicationExt::getIndustryNamefromCAF($dept['submission_id']);
                $url1 = Yii::app()->createAbsoluteUrl('admin/ApplicationView/downloadapp/id');
                $sql = "SELECT * FROM `bo_application_verification_level` WHERE next_role_id = 7 AND approval_user_comment IS NULL AND app_Sub_id='$dept[submission_id]'";
                $connection = Yii::app()->db;
                $command = $connection->createCommand($sql);
                $pendingAtNodal = $command->queryRow();
                $sql = "SELECT * FROM `bo_application_verification_level` WHERE next_role_id = 33 AND approval_user_comment IS NULL AND app_Sub_id='$dept[submission_id]'";
                $connection = Yii::app()->db;
                $command = $connection->createCommand($sql);
                $pendingAtApprover = $command->queryRow();
                $flag = 0;
                // checking more than 14 days
                $sql = "SELECT * FROM bo_application_forward_level "
                        . " LEFT JOIN bo_departments as bdept ON bdept.dept_id=bo_application_forward_level.forwarded_dept_id  "
                        . "where app_Sub_id=$dept[submission_id] ORDER BY bo_application_forward_level.appr_lvl_id DESC";
                $connection = Yii::app()->db;
                $command = $connection->createCommand($sql);
                $commentLog = $command->queryAll();
				
				//echo "<pre>" ; print_r($commentLog);die ;
				$verifier_user_comment = isset($commentLog[0]['verifier_user_comment'])?$commentLog[0]['verifier_user_comment']:'' ;
                unset($c);
                $c=array();
                foreach ($commentLog as $ju=>$DeptComLog) {
                    if (!empty($DeptComLog)) {
                        if (!empty($DeptComLog['comment_date'])) {
                            $commentedDate = $DeptComLog['comment_date'];
                        } else {
                            $commentedDate = date('Y-m-d H:i:s');
                        }
                        $timeInString = abs(strtotime($commentedDate) - strtotime($DeptComLog['created_on']));
                        $years = floor($timeInString / (365 * 60 * 60 * 24));
                        $months = floor(($timeInString - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                        $days = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                        $hours = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
                        $minuts = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
                        $seconds = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
                        $allDays = ($years*365)+($months * 30) + $days;
                    } if ($allDays > 14) {
                        $flag = 1;
                        $c[]=$ju;
                    }
                }
      
				$allDateArray=array(); $deptArr=array();
				foreach ($commentLog as $ju=>$DeptComLog) {
					if(!in_array($DeptComLog['created_on'],$allDateArray)){
						$allDateArray[]=$DeptComLog['created_on'];
					}	
				if(!in_array($DeptComLog['forwarded_dept_id'],$deptArr)){
					$deptArr[]=$DeptComLog['forwarded_dept_id'];
				
				$sql = "SELECT * FROM bo_user as bu"
						. " LEFT JOIN bo_user_role_mapping as buac ON  buac.user_id=bu.uid AND bu.dept_id=$DeptComLog[dept_id]"
						. " where buac.role_id= $DeptComLog[next_role_id] AND buac.department_id=$DeptComLog[dept_id] AND bu.disctrict_id=$dept[landrigion_id]"
						. "  AND 	bu.is_active=1"; 
				$command = $connection->createCommand($sql); 
				$assignedTo = $command->queryRow();
				$mobileNumber="";
			   
			    $mobileNumber=$assignedTo['mobile'];	
				
				$disposalDept = "" ;
				if($DeptComLog['verifier_user_comment']!=""){
					$disposalDept = "Yes" ;
				}else{
					$disposalDept = "No" ;
				}
				$disposalDept .= '<br><b style="color:darkgreen;">';
				$disposalDept .= $DeptComLog['comment_date'] ;
				$disposalDept .='</b><br>';
				
				$disposalDept .= $DeptComLog['verifier_user_comment'];
				
				$aging = '' ;
				
				if (!empty($DeptComLog)) {
					//echo $DeptComLog['department_name']."<br>";
					if (!empty($DeptComLog['comment_date'])) {
						$commentedDate = $DeptComLog['comment_date'];
					} else {
						$commentedDate = date('Y-m-d H:i:s');
					}
					$timeInString = abs(strtotime($commentedDate) - strtotime($DeptComLog['created_on']));
					
					$yy="";
					$years = floor($timeInString / (365 * 60 * 60 * 24));
					$months = floor(($timeInString - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
					$days = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
					$hours = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
					$minuts = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
					$seconds = floor(($timeInString - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
					$allDays = ($years*365)+($months * 30) + $days;
					
					$NODTIME = "$yy $allDays days, $hours hrs,<br> $minuts min";
													   
					$aging = "$yy $allDays days, $hours hrs,<br> $minuts min";
				}
				
				$returnData[] = [
					$verifier_user_comment,
					$DeptComLog['department_name'].'<br><b style="color:darkgreen;">'.date("d-m-Y H:i:s",strtotime($DeptComLog['created_on'])).'</b>',
					$assignedTo['full_name']."&nbsp;<br>&nbsp;<b>".$mobileNumber.'</b>',
					$disposalDept,
					$aging
					];
				}
			}
		
		}}
		//echo "<pre>" ; print_r($returnData);die ;	
        $response = ['data'=>$returnData,'approval'=>$approval];
		
		//echo "<pre>" ; print_r($response);die ;
		
		return $response ;
		
	}
	
	public static function getDistrictNameById($distric_id){
		$sql = "select distric_name from bo_district where district_id=$distric_id";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        
        $dist = $command->queryRow();
        	
        return $dist['distric_name'];
	}
	
	
	public static function getOtherUsers($mom_id,$mom_user_id){
		
		$sql = "select * from bo_mom_user_others where mom_id=$mom_id and mom_user_id=$mom_user_id ";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        
        $dist = $command->queryAll();
        	
        return $dist ;
	}

}
