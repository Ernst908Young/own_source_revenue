<?php 
class ReportNewExt{
	/*used to get the service reports
	@author : Rahul Kumar
	@param: 
	@return: array
	@27072018
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
		
                
                $sql="select * from bo_infowizard_service_timeline_new where is_active='Y' ";	
                
		$timelineList=Yii::app()->db->createCommand($sql)->queryAll();	
               $infowizSID= array();
                foreach($timelineList as $tl){ 
                   $infowizSID[] = "'".$tl['service_id'].".".$tl['servicetype_additionalsubservice']."'";
                }
                $allID= implode(",",$infowizSID);
                if(!empty($allID)){
		$isactive = 'Y';
                
		$connection=Yii::app()->db; 
                
		$where_condition = "";
                
		if($fyear != 'ALL'){
                    
			list($start_year,$end_year) = explode("-",$fyear);
                        
			$start_year_date 	= $start_year."-04-01";                        
			$end_year_date 		= $end_year."-03-31";                        
			$where_condition = " AND DATE(bo_dept_service_application.application_created_on)>='$start_year_date' AND DATE(bo_dept_service_application.application_created_on)<='$end_year_date' ";
		}
                
		
                    print_r($allID);die;
			$where_condition .= " AND bo_dept_service_application.infowiz_service_id  IN ($allID) ";
                        
		
                
		 $sql="select application_time_taken_by_department,app_status from bo_dept_service_application WHERE bo_dept_service_application.app_status!='I' $where_condition";	
                 
                $command=$connection->createCommand($sql);
                
		$resList=$command->queryAll();	
                
                 $stype=$tl['timeline_type'];
                 $count=0;
                                foreach($resList as $rl){
                                    $status=$rl['app_status'];
                                    if($rl['application_time_taken_by_department']<= $tl['timeline_type_service_value']){
                                        $data[$stype."_TN"][$status]=@$data[$stype."_TN"][$status]+1;
                                    }else{
                                        $data[$stype."_TV"][$status]=@$data[$stype."_TV"][$status]+1;
                                    } 
                                   
                                   }  
                return $data;	
                }else{
                    return false;
                }
        }
        
        
        
	
}
	

?>