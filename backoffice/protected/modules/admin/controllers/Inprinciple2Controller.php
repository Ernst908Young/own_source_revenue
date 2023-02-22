<?php /* Rahul Kumar : 06082018 */

class Inprinciple2Controller extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	// public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	*@authour : Rahul Kumar
	*@date:06082018
	*@CAFFilter : 
	 */
        
	public function actionAdvanceReport()
	{        
		$fromToCondition = "";
		$statusCondition ="";
		$applicationDetail = "";
		$districtCondition = "";
		$districtListStr = "";
		$applicationCondition = "";
		$unitNameCondition = "";
		$applicationNumber = "";
		$natureunitCondition = "";
		$natureUnitListStr  = "";
		$natureUnitList  = "";
		$nicCodeListStr = "";
		$nicCodeList = "";
		$distList = "";
		$unit_type = "";
		$unitName = "";		
		$status = "";
		$start = "";
		$end = "";
		$fy = "";
		if(!empty($_POST['submit'])) {
			
			// Extracting Get Values
			extract($_POST);
			
			//District conditions
            if (isset($district) && !empty($district)) {
				$districtListStr = "'" . implode("','", $district) . "'"; 
				$distList = implode(",", $district);				
                $districtCondition = " AND bspsub.landrigion_id IN ($districtListStr) ";
            }
			
			//From Date To Date Condition
            if (!empty($start) && !empty($end)) {
                $startDate = date('Y-m-d', strtotime(@$start));
                $endDate = date('Y-m-d', strtotime(@$end));
                $fromToCondition = " AND DATE(bspsub.application_created_date)>='" . @$startDate . "' AND DATE(bspsub.application_created_date)<='" . @$endDate . "' ";
            }

            //Financial Year wise 
            if (!empty($fy)) {
                $fromtodate = explode(":", $fy);
                // From Date To Date Conditions       
                if(!empty($fromtodate)) {
                    $startDate = date('Y-m-d', strtotime(@$fromtodate[0]));
                    $endDate = date('Y-m-d', strtotime(@$fromtodate[1]));
                    $fromToCondition = " AND DATE(bspsub.application_created_date)>='" . @$startDate . "' AND DATE(bspsub.application_created_date)<='" . @$endDate . "' ";
                }
            }
			
			// Application Number
            if (!empty($applicationNumber)) {
                $applicationCondition = " AND bspsub.submission_id=$applicationNumber ";
            }

            // Nature of Unit			
            if (!empty($nature_unit)) {	
				$natureUnitListStr = "'" . implode("','", $nature_unit) . "'"; 
				$natureUnitList = implode(",", $nature_unit);				
            }
			
			if (!empty($nic_code)) {	
				$nicCodeListStr = "'" . implode("','", $nic_code) . "'"; 
				$nicCodeList = implode(",", $nic_code);	
				
            }

			if (!empty($status)) {
                $statusCondition = " AND bspsub.application_status=$status ";
            }

			$sql ="SELECT * from bo_application_submission as bspsub where bspsub.application_id=1 AND bspsub.user_id!=11 $fromToCondition  $districtCondition  $applicationCondition $statusCondition"; 		
			$applicationDetail = Yii::app()->db->createCommand($sql)->queryAll();
		}
		
		//Search Query 
		
		
		//Gettting values from dattabase as per passed parameters
		$districtList = $this->getDistrictList();		
		
	
		// setting values here
		$this->render('advanceReport',array(
			'applicationData'=>$applicationDetail,
			'districtList'=>$districtList,
			'districtListStr'=>$distList,
			'applicationNumber'=>$applicationNumber,
			'natureUnitListStr'=>$natureUnitListStr,
			'natureUnitList'=>$natureUnitList,
			'nicCodeListStr'=>$nicCodeListStr,
			'nicCodeList'=>$nicCodeList,
			'unit_type'=>$unit_type,
			'unitName'=>$unitName,
			'start'=>$start,
			'status'=>$status,			
			'end'=>$end,
			'fy' => $fy
		));
	}
	
	public static function getDistrictList() {
		$connection = Yii::app()->db;
		$sql = "select district_id,distric_name from bo_district where is_active='Y'";
		$command = $connection->createCommand($sql);
		$districtList = $command->queryAll();	
	    return $districtList;
	}
	
	
	public function actionGetNicCodesByUnit() {
        if (!empty($_POST)) {
            
            $unit = $_POST['unit']; 
			if($unit=='manufacturing')
				$unit = 'MANUFACTURING';
			else
				$unit = 'SERVICES';				
				
            $nic_code = '';
            $connection = Yii::app()->db;			
            $sql = "select II_DIGIT_Code,SUBSTRING(Description,1,100) as Description from NIC_II_DIGIT where Industry_Type = '".$unit."'";
            $command = $connection->createCommand($sql);
            $nicCodeList = $command->queryAll();
            foreach($nicCodeList as $val) {
                $nic_code .= "<option value='$val[II_DIGIT_Code]'>".$val['II_DIGIT_Code'].'-'.$val['Description']."</option>";
            }
            echo $nic_code;
        }
        die();
    }
	
	public function getNicCodeNameBy2DigitCode($code=null) {
        
		$nic_code = '';
		$connection = Yii::app()->db;			
		$sql = "select SUBSTRING(Description,1,100) as Description from NIC_II_DIGIT where II_DIGIT_Code = '".$code."'";
		$command = $connection->createCommand($sql);
		$nicCode = $command->queryRow();
		return  $nicCode['Description'];
    }
    
    public static function getValueByJsonField($submission_id=null,$fieldValue=null){
        // Search Query 
		$sql ="SELECT * from bo_application_submission where application_id=1 AND user_id!=11 AND submission_id=$submission_id";   		 
		//Getting values from dattabase as per passed parameters
		$applicationDetail = Yii::app()->db->createCommand($sql)->queryRow();
		$CafFieldValue=(array)json_decode($applicationDetail['field_value']);	
		if(isset( $CafFieldValue[$fieldValue]))	
		return  $CafFieldValue[$fieldValue];   
		else
		return '';	
    }
	
	static function GetTimeTakenInCAF($cafid){
		//  $cafid="2418";
		$connection = Yii::app()->db;
		// Fetching First entry of applicant while he satrted fillling application
		$sql = "SELECT * FROM bo_application_flow_logs where submission_id='$cafid' AND application_status='IPS' ORDER BY log_id LIMIT 1";

		$command = $connection->createCommand($sql);
		$firstEntryOfApplicantForCaf = $command->queryAll(); 
		$appDetail = ApplicationExt::getCafTracking($cafid);
		$appDetails= array_merge($firstEntryOfApplicantForCaf,$appDetail);
		$invTime=0;$nodTime=0; $f=0; $count=1;
		//print_r($appDetails);die;
		foreach($appDetails as $detailoftransaction){
			$departmentRole=array('3','5');
			if(!empty(@$detailoftransaction) && !in_array(@$detailoftransaction['approver_role_id'],$departmentRole) && !empty(@$detailoftransaction['log_id']))
			{  
				if(@$detailoftransaction['application_status']=="ISA"){
					@$status="Submission of CAF";                            
					$comments="Application Submitted";                    
				}else{
					$comments=@$detailoftransaction['approver_comments'];
					$actionTakenBy=@$detailoftransaction['approval_user_id'];
					@$status=@$detailoftransaction['application_status'];
				}
				if(@$detailoftransaction['approver_role_id']==7){$role="District CAF Verifier";}
				if(@$detailoftransaction['approver_role_id']==4){$role="State CAF Verifier";}
				if(@$detailoftransaction['approver_role_id']==33){$role="District CAF Approver";}
				if(@$detailoftransaction['approver_role_id']==34){$role="State CAF Approver";}
				if(@$detailoftransaction['approver_role_id']==""){$role="Investor";}
				if(@$detailoftransaction['application_status']=="RBI"){@$status="Reverted to Investor";}
				if(@$detailoftransaction['application_status']=="IBD"){@$status="Response from Investor";$comments="Application Re-submitted";}
				if(@$detailoftransaction['application_status']=="F"){$tid=$f=$f+1;@$status="Forwarded to Departments for comments, See <a href='$transUrl'>Transaction ID : ". $tid ."</a>";}
				if(@$detailoftransaction['application_status']=="V"){@$status="Verified";}
				if(@$detailoftransaction['application_status']=="R"){@$status="Rejected";}
				if(@$detailoftransaction['application_status']=="RBN"){@$status="Reverted by Approver to Verifier";}
				if(@$detailoftransaction['application_status']=="IPS"){@$status="Started Filling CAF";}
				$c=$count-1;
				$Time[$c]=$detailoftransaction['created_date_time'];
				// echo  $c."=".$Time[$c]."<br>";
				$timetaken="";
				if($count!=1){  
					if(!empty($Time[$c])){
						$timeInString = abs(strtotime($Time[$c]) - strtotime($Time[$c-1]));
						//  echo $timeInString;die;
						if($role=="Investor"){ 
							$invTime=$invTime+$timeInString;
						}
						else{
							$nodTime=$nodTime+$timeInString;
							$sql = "SELECT * FROM bo_user where uid='$detailoftransaction[approval_user_id]'";
							$nodalDetail = Yii::app()->db->createCommand($sql)->queryRow();
						}    
					}
				} 
				$count=$count+1; 
			} 

		}
		// print_r($nodalDetail);die;
		$timetakenNod=0;
		$years = floor($nodTime / (365 * 60 * 60 * 24));
		$months = floor(($nodTime - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
		$days = floor(($nodTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
		$hours = floor(($nodTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
		$minuts = floor(($nodTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
		$seconds = floor(($nodTime - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
		$allDays = ($years*365)+($months * 30) + $days;  
		$timetakenNod= "$allDays"; 
		$NODTIME=$timetakenNod;
		//echo  "<hr>".$nodalDetail['full_name']."<hr>".$nodalDetail['mobile']."<hr>".$NODTIME;
		return  $NODTIME;
    }
	
}
