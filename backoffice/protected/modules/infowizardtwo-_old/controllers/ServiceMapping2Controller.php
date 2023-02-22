<?php
class ServiceMapping2Controller extends Controller {

    public $layout = '//layouts/column2';

    
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }   
    
    public function actionL1(){
        $advRepArray =array();
		if(isset($_POST['submit']))
		{
			$advRepArray = $this->getAdvanceReport($_POST);
		}	
        //print_r($advRepArray);die;
     		
        $connection = Yii::app()->db;
		$conditions ="";
		$whereCond = "";
		$startDate = '1900-03-03';
		$endDate = date('Y-m-d',strtotime(date('Y-m-d'). '+1 day'));
		if(isset($_GET['FY']) && $_GET['FY']!='ALL'){
			$dateArr = explode("-",$_GET['FY']);			
			$startDate = $dateArr[0]."-04-01";
			$endDate = $dateArr[1]."-03-31";
			// in case of from todate
			/* if(isset($_GET['startDate']) && isset($_GET['endDate'])){
			extract($_GET);
			}*/
			$whereCond = " AND DATE_FORMAT(application_created_on,'%Y-%m-%d') >='$startDate' AND DATE_FORMAT(application_created_on,'%Y-%m-%d') <= '$endDate' ";
		}else{
		$whereCond = " AND DATE_FORMAT(application_created_on,'%Y-%m-%d') <= '$endDate' ";
		}
		
		if(isset($_GET['swcs_status']) && (($_GET['swcs_status']=='Y') ||($_GET['swcs_status']=='N'))){
			$whereCond .=" AND is_applied_through_sw='".$_GET['swcs_status']."' ";			
		}
		
		$sql="select * from bo_dept_service_application Where infowiz_dept_id >0 $whereCond GROUP BY infowiz_dept_id";
		$command = $connection->createCommand($sql);
		$deptData = $command->queryAll();		
		if(isset($deptData))
			$totalDept = count($deptData);
		else
			$totalDept = 0;
                
                $deptId ='ALL';                 
                if ((isset($_SESSION)) && (($_SESSION['role_id'] == '71') || ($_SESSION['role_id'] == '62'))) {
                if ($_SESSION['dept_id']) {

                    $session_dept_ID = $_SESSION['dept_id'];
                    $sql = "select issuerby_id,name from bo_infowizard_issuerby_master inner join bo_departments on bo_infowizard_issuerby_master.abb = bo_departments.infowiz_short_code 
                            Where bo_departments.dept_id = $session_dept_ID";
                    $command = $connection->createCommand($sql);
                    $deptartment_ID = $command->queryAll();
                    $deptId = $deptartment_ID[0]['issuerby_id'];
                    $totalDept = 1;

                } else {
                    $deptId = 'ALL';
                }
        }
        if((isset($_GET['qw'])) && ($_GET['qw'] =='12'))
            {
                echo '<pre>';print_r($_SESSION);die;
            }
		
		$inProcessData = $this->getAllServiceMapping("'P'",$startDate,$endDate,$deptId);
		if(isset($inProcessData) && !empty($inProcessData))
			$inProcessTotal = $inProcessData[0]['total'];
		else
			$inProcessTotal = 0;
		
		$forwardedData = $this->getAllServiceMapping("'F'",$startDate,$endDate,$deptId);
		if(isset($forwardedData) && !empty($forwardedData))
			$forwardedTotal = $forwardedData[0]['total'];
		else
			$forwardedTotal = 0;

		$revertData =$this->getAllServiceMapping("'RBI'",$startDate,$endDate,$deptId);
		if(isset($revertData) && !empty($revertData))
			$revertedTotal = $revertData[0]['total'];
		else
			$revertedTotal = 0;	

		$rejectData =$this->getAllServiceMapping("'R'",$startDate,$endDate,$deptId);
		if(isset($rejectData) && !empty($rejectData))
			$rejectTotal = $rejectData[0]['total'];
		else
			$rejectTotal = 0;	
				
		$approveData =$this->getAllServiceMapping("'A'",$startDate,$endDate,$deptId);
		if(isset($approveData) && !empty($approveData))
			$approveTotal = $approveData[0]['total'];
		else
			$approveTotal = 0;	
			
        $this->render('l1copy',array('totalDept'=>$totalDept,'inProcessTotal'=>$inProcessTotal,'forwardedTotal'=>$forwardedTotal,
            'revertedTotal'=>$revertedTotal,'rejectTotal'=>$rejectTotal,'approveTotal'=>$approveTotal,'deprt_id'=>$deptId,
            'serviceData' => @$advRepArray['serviceData'],
            'serviceList' => @$advRepArray['serviceList'],
            'departmentList' => @$advRepArray['departmentList'],
            'statusList' => @$advRepArray['statusList'],
            'applicationNumber' => @$advRepArray['applicationNumber'],
            'unitName' => @$advRepArray['unitName'],
            'preEstabmishment'=> @$advRepArray['preEstabmishment'], 
            'preOperation'=> @$advRepArray['preOperation'],
            'postOperation'=> @$advRepArray['postOperation'],
            'fy' => @$advRepArray['fy'],
            'timeline' => @$advRepArray['timeline'],
            'start' => @$advRepArray['start'],
            'end' => @$advRepArray['end']
			));
    }
	
	public function actionL1copy(){
		
        $connection = Yii::app()->db;
		$conditions ="";
		$whereCond = "";
		$startDate = '2010-03-03';
		$endDate = date('Y-m-d',strtotime(date('Y-m-d'). '+1 day'));
		if(isset($_GET['FY']) && $_GET['FY']!='ALL'){
			$dateArr = explode("-",$_GET['FY']);			
			$startDate = $dateArr[0]."-04-01";
			$endDate = $dateArr[1]."-03-31";
			// in case of from todate
			/* if(isset($_GET['startDate']) && isset($_GET['endDate'])){
			extract($_GET);
			}*/
			$whereCond = " AND DATE_FORMAT(application_created_on,'%Y-%m-%d') >='$startDate' AND DATE_FORMAT(application_created_on,'%Y-%m-%d') <= '$endDate' ";
		}
		
		if(isset($_GET['swcs_status']) && (($_GET['swcs_status']=='Y') ||($_GET['swcs_status']=='N'))){
			$whereCond .=" AND is_applied_through_sw='".$_GET['swcs_status']."' ";			
		}
		
		$sql="select * from bo_dept_service_application Where infowiz_dept_id >0 $whereCond GROUP BY infowiz_dept_id";
		$command = $connection->createCommand($sql);
		$deptData = $command->queryAll();		
		if(isset($deptData))
			$totalDept = count($deptData);
		else
			$totalDept = 0;
		
		$inCompleteData = $this->getAllServiceMapping("'I'",$startDate,$endDate);
		if(isset($inCompleteData) && !empty($inCompleteData))
			$inCompleteTotal = $inCompleteData[0]['total'];
		else
			$inCompleteTotal = 0;
                
		$inProcessData = $this->getAllServiceMapping("'P'",$startDate,$endDate);
		if(isset($inProcessData) && !empty($inProcessData))
			$inProcessTotal = $inProcessData[0]['total']+$inCompleteTotal;
		else
			$inProcessTotal = 0 +$inCompleteTotal;
		
		$forwardedData = $this->getAllServiceMapping("'F'",$startDate,$endDate);
		if(isset($forwardedData) && !empty($forwardedData))
			$forwardedTotal = $forwardedData[0]['total'];
		else
			$forwardedTotal = 0;

		$revertData =$this->getAllServiceMapping("'RBI'",$startDate,$endDate);
		if(isset($revertData) && !empty($revertData))
			$revertedTotal = $revertData[0]['total'];
		else
			$revertedTotal = 0;	

		$rejectData =$this->getAllServiceMapping("'R'",$startDate,$endDate);
		if(isset($rejectData) && !empty($rejectData))
			$rejectTotal = $rejectData[0]['total'];
		else
			$rejectTotal = 0;	
				
		$approveData =$this->getAllServiceMapping("'A'",$startDate,$endDate);
		if(isset($approveData) && !empty($approveData))
			$approveTotal = $approveData[0]['total'];
		else
			$approveTotal = 0;	
			
        $this->render('l1copy',array('totalDept'=>$totalDept,'inProcessTotal'=>$inProcessTotal,'forwardedTotal'=>$forwardedTotal,'revertedTotal'=>$revertedTotal,'rejectTotal'=>$rejectTotal,'approveTotal'=>$approveTotal));
    }
    
	public function getAllServiceMapping($status=null,$startDate=null,$endDate=null,$deptId=null,$serviceId=null,$type=null)
	{	
	
		if($type=='arr'){
			$rf=" * ";
		}else{
			$rf=" count(*) as  total"; 
		}
		$conditions = "";	
		if(isset($status) && $status=="'F'"){
			$status = "'PD','PP','PR','PA','F'";			
		}
		if(isset($status) && $status=="'T'"){
			
			$status = "'PD','PP','PR','PA','F','P','A','RBI','R'";	
				
		}
		
		if(isset($startDate) && !empty($startDate) && isset($endDate) && !empty($endDate)){
			$conditions = " AND DATE_FORMAT(application_created_on,'%Y-%m-%d') >='$startDate' AND DATE_FORMAT(application_created_on,'%Y-%m-%d') <= '$endDate' ";			
		}
		
		if(isset($_GET['swcs_status']) && (($_GET['swcs_status']=='Y') ||($_GET['swcs_status']=='N'))){
			$conditions .=" AND is_applied_through_sw='".$_GET['swcs_status']."' ";			
		}
		
		if(isset($deptId) && !empty($deptId) && ($deptId != "ALL")){
			$conditions .= " AND infowiz_dept_id IN ('".$deptId."') ";			
		}
		
		if(isset($serviceId) && !empty($serviceId)){
			$conditions .= " AND infowiz_service_id IN ('".$serviceId."') ";			
		}
                

		$connection = Yii::app()->db;
		$sql="select $rf from bo_dept_service_application where app_status IN (".$status.") $conditions order by application_created_on desc";
		$command = $connection->createCommand($sql);
		
		$DataArr = $command->queryAll(); 	
		if(isset($DataArr) && !empty($DataArr))
			return $DataArr;
		else
			return 0;
	}    
  
	public function actionL2() {	
      
        if(isset($_GET['FY'])) {
            if ($_GET['FY'] == 'ALL') {
                $fY = $_GET['FY'];
               /*  $cdate1 = '2015-04-01';
                $cdate2 = '2019-03-01'; */
				$cdate1 = '1900-03-03';
                $cdate2 =  date('Y-m-d',strtotime(date('Y-m-d'). '+1 day'));
            } else {
                $fY = $_GET['FY'];
                $data = explode("-", $fY);
                $cdate1 = $data[0] . "-04-01";
                $cdate2 = $data[1] . "-03-31"; 
            }
        }elseif (isset($_GET['d1']) && isset($_GET['d2'])) {
            $cdate1 = $_GET['d1'];
            $cdate2 = $_GET['d2'];
            $d1 = explode("-", $_GET['d1']);
            $d2 = explode("-", $_GET['d2']);
            $fY = $d1[0] . '-' . $d2[0];
        }
        else {
            $fY = '';
            $data = '';
            $cdate1 = '';
            $cdate2 = '';
        }

        $department = @$_GET['d'];
        $status = "'" . $_GET['s'] . "'";
        if ($status == "'T'") {
            $statusaa = "'A','P','F','R','I','RBI'";
        } else {
            $statusaa = "'" . $_GET['s'] . "'";
        }
		/* echo $cdate1;
		echo "<br/>";
		echo $cdate2;
		die(); */
		$departmentList = $this->getDepartmentViewList();
		/* echo "<pre>";
		print_r($departmentList);		
		die(); */			
        $this->render('l2', array("departmentList" => $departmentList, "department" => $department, "date1" => $cdate1, "date2" => $cdate2,"fY"=>$fY, "statusaa" => $statusaa));
    }
	
	public function getServiceList($deptId=null)
	{	
		$connection = Yii::app()->db;	
		$sql = "select infowiz_service_name,infowiz_service_id from bo_dept_service_application where 	infowiz_dept_id =$deptId GROUP BY infowiz_service_id";
		$command = $connection->createCommand($sql);
		$serviceData = $command->queryAll();
		if ($serviceData === false)
            return false;

        return $serviceData;
	}
	
	public function getDepartmentViewList() {

        $deptId = 'ALL';
       if ((isset($_SESSION)) && (($_SESSION['role_id'] == '71') || ($_SESSION['role_id'] == '62'))) {
            if ($_SESSION['dept_id']) {
                $session_dept_ID = $_SESSION['dept_id'];
                $sql = "select issuerby_id,name from bo_infowizard_issuerby_master inner join bo_departments on bo_infowizard_issuerby_master.abb = bo_departments.infowiz_short_code 
                        Where bo_departments.dept_id = $session_dept_ID";
                $connection = Yii::app()->db; 
                $command = $connection->createCommand($sql);
                $deptartment_ID = $command->queryAll();
                $deptId = $deptartment_ID[0]['issuerby_id'];
                $totalDept = 1;
            } else {
                $deptId = 'ALL';
            }
        }
        if($deptId == 'ALL'){
            $sql = "select bo_dept_service_application.*,bo_infowizard_issuerby_master.name from bo_dept_service_application left join bo_infowizard_issuerby_master on bo_dept_service_application.infowiz_dept_id = bo_infowizard_issuerby_master.issuerby_id GROUP BY infowiz_dept_id";
        }else{
            $sql = "select bo_dept_service_application.*,bo_infowizard_issuerby_master.name from bo_dept_service_application left join bo_infowizard_issuerby_master on bo_dept_service_application.infowiz_dept_id = bo_infowizard_issuerby_master.issuerby_id where bo_infowizard_issuerby_master.issuerby_id = $deptId GROUP BY infowiz_dept_id ";
        }
        // $sql = "select bo_dept_service_application.*,bo_infowizard_issuerby_master.name from bo_dept_service_application left join bo_infowizard_issuerby_master on bo_dept_service_application.infowiz_dept_id = bo_infowizard_issuerby_master.issuerby_id GROUP BY infowiz_dept_id";
        $connection = Yii::app()->db;        
        $command = $connection->createCommand($sql);
        $deptData = $command->queryAll();
        if ($deptData === false)
            return false;

        return $deptData;
    }

    public function actionGetLastSynkedByDeptId($deptId){
		$connection = Yii::app()->db;	
		$sql = "select * from bo_dept_service_application where infowiz_dept_id =$deptId ORDER BY modified DESC LIMIT 1";
		$command = $connection->createCommand($sql);
		$modifiedData = $command->queryRow();
		/* echo "<pre>";
		print_r($modifiedData);die(); */
		if ($modifiedData === false)
			return false;

		return $modifiedData['modified'];
	}
	
	public function actionIncompleteL2() {	
      
        if(isset($_GET['FY'])) {
            if ($_GET['FY'] == 'ALL') {
                $fY = $_GET['FY'];
                $cdate1 = '1900-03-03';
                $cdate2 =  date('Y-m-d',strtotime(date('Y-m-d'). '+1 day'));
            } else {
                $fY = $_GET['FY'];
                $data = explode("-", $fY);
                $cdate1 = $data[0] . "-04-01";
                $cdate2 = $data[1] . "-03-31"; 
            }
        }elseif (isset($_GET['d1']) && isset($_GET['d2'])) {
            $cdate1 = $_GET['d1'];
            $cdate2 = $_GET['d2'];
            $d1 = explode("-", $_GET['d1']);
            $d2 = explode("-", $_GET['d2']);
            $fY = $d1[0] . '-' . $d2[0];
        }
        else {
            $fY = '';
            $data = '';
            $cdate1 = '';
            $cdate2 = '';
        }

        $department = @$_GET['d'];
        $status = "'" . $_GET['s'] . "'";
        if ($status == "'T'") {
            $statusaa = "'A','P','F','R','I','RBI'";
        } else {
            $statusaa = "'" . $_GET['s'] . "'";
        }
		
		
		$departmentList = $this->getDepartmentViewList();
				
        $this->render('incompletel2', array("departmentList" => $departmentList, "department" => $department, "date1" => $cdate1, "date2" => $cdate2,"fY"=>$fY, "statusaa" => $statusaa));
    }
	    
    public function actionL3(){
	
		if(isset($_GET['FY'])) {
            if ($_GET['FY'] == 'ALL') {
                $fY = $_GET['FY'];
                $cdate1 = '1900-03-03';
                $cdate2 =  date('Y-m-d',strtotime(date('Y-m-d'). '+1 day'));
            } else {
                $fY = $_GET['FY'];
                $data = explode("-", $fY);
                $cdate1 = $data[0] . "-04-01";
                $cdate2 = $data[1] . "-03-31"; 
            }
        }elseif (isset($_GET['d1']) && isset($_GET['d2'])) {
            $cdate1 = $_GET['d1'];
            $cdate2 = $_GET['d2'];
            $d1 = explode("-", $_GET['d1']);
            $d2 = explode("-", $_GET['d2']);
            $fY = $d1[0] . '-' . $d2[0];
        }
        else {
            $fY = '';
            $data = '';
            $cdate1 = '';
            $cdate2 = '';
        }
		
		/* $cdate1 = $_GET['d1'];
        $cdate2 = $_GET['d2']; */
        $department = $_GET['d'];
        $status = "'" . $_GET['s'] . "'";
        if($status == "'T'") {
            $statusaa = "'A','P','F','R','I','RBI'";
        } else {
            $statusaa = "'" . $_GET['s'] . "'";
        }
        $service = $this->getServiceList($department);			
        $this->render('l3', array("ser" => $service, "department" => $department, "date1" => $cdate1, "date2" => $cdate2, "statusaa" => $statusaa,"fY"=>$fY));       
    }
	
	public function getCoreServiceName($serviceId=null)
	{	
		$connection = Yii::app()->db;
			
		$serviceIds = explode(".",$serviceId);
		
		if(isset($serviceIds[1]) && $serviceIds[1] >=0)
		{ 
			$sql = "select core_service_name from bo_information_wizard_service_parameters where service_id=$serviceIds[0] AND servicetype_additionalsubservice=$serviceIds[1] AND is_active='Y'";
			$command = $connection->createCommand($sql);
			$deptData = $command->queryRow();
			
			if($deptData === false)
				return false;

			return $deptData['core_service_name'];	
		}else{
			return $serviceId;
		}	
	}
    
	public function getDepartmentName($departmentId=null)
	{	
		$connection = Yii::app()->db;	
		$sql = "select name from bo_infowizard_issuerby_master where issuerby_id=$departmentId";
		$command = $connection->createCommand($sql);
        $deptData = $command->queryRow();
        
        if($deptData === false)
            return false;

        return $deptData['name'];		
	}
    
    public function getDepartmentNameByServId($serviceId=null)
	{	
		$connection = Yii::app()->db;	
		$sql = "select name from bo_infowizard_issuerby_master where issuerby_id IN(select infowiz_dept_id from bo_dept_service_application where infowiz_service_id=$serviceId)";
		$command = $connection->createCommand($sql);
        $deptData = $command->queryRow();
        
        if($deptData === false)
            return false;

        return $deptData['name'];		
	}
	
	public function getDepartmentIdByServiceId($serviceId=null)
	{	
		$connection = Yii::app()->db;	
		$sql = "select infowiz_dept_id from bo_dept_service_application where infowiz_service_id=$serviceId";
		$command = $connection->createCommand($sql);
		$serviceData = $command->queryRow();
		if ($serviceData === false)
            return false;

        return $serviceData['infowiz_dept_id'];
	}
	
	public function getTimelineByServId($serviceId=null)
	{	
		$connection = Yii::app()->db;
		$serviceIds = explode(".",$serviceId);		
		$sql = "select timeline_type_service_value from bo_infowizard_service_timeline_new where service_id=$serviceIds[0] AND servicetype_additionalsubservice=$serviceIds[1] AND is_active='Y'";
		$command = $connection->createCommand($sql);
        $deptData = $command->queryRow();
        
        if($deptData === false)
            return false;

        return $deptData['timeline_type_service_value'];		
	}
	
	public function checkServiceExist($serviceId=null)
	{	
		$connection = Yii::app()->db;			
		$sql = "select CONCAT('service_id','.','servicetype_additionalsubservice') as service_id from bo_information_wizard_service_parameters where service_id=$serviceId AND is_active='Y'";
		$command = $connection->createCommand($sql);
        $deptData = $command->queryRow();
        
        if($deptData === false)
            return 'No';

        return 'Yes';		
	}
	
    public function actionL4(){
		if(isset($_GET['FY'])) {
            if ($_GET['FY'] == 'ALL') {
                $fY = $_GET['FY'];
                $cdate1 = '1900-03-03';
                $cdate2 =  date('Y-m-d',strtotime(date('Y-m-d'). '+1 day'));
            } else {
                $fY = $_GET['FY'];
                $data = explode("-", $fY);
                $cdate1 = $data[0] . "-04-01";
                $cdate2 = $data[1] . "-03-31"; 
            }
        }elseif (isset($_GET['d1']) && isset($_GET['d2'])) {
            $cdate1 = $_GET['d1'];
            $cdate2 = $_GET['d2'];
            $d1 = explode("-", $_GET['d1']);
            $d2 = explode("-", $_GET['d2']);
            $fY = $d1[0] . '-' . $d2[0];
        }
        else {
            $fY = '';
            $data = '';
            $cdate1 = '';
            $cdate2 = '';
        }
		$department = @$_GET['d'];
        $status = "'" . @$_GET['s'] . "'";
        if($status == "'T'") {
            $statusaa = "'A','P','F','R','I','RBI'";
        } else {
            $statusaa = "'" . @$_GET['s'] . "'";
        }
        $this->render('l4',array("department" => $department, "date1" => $cdate1, "date2" => $cdate2, "statusaa" => $statusaa,"fY"=>$fY));
    }

    public function actionTransaction(){
		if(isset($_GET['FY'])) {
            if ($_GET['FY'] == 'ALL') {
                $fY = $_GET['FY'];
                $cdate1 = '1900-03-03';
                $cdate2 =  date('Y-m-d',strtotime(date('Y-m-d'). '+1 day'));
            } else {
                $fY = $_GET['FY'];
                $data = explode("-", $fY);
                $cdate1 = $data[0] . "-04-01";
                $cdate2 = $data[1] . "-03-31"; 
            }
        }elseif (isset($_GET['d1']) && isset($_GET['d2'])) {
            $cdate1 = $_GET['d1'];
            $cdate2 = $_GET['d2'];
            $d1 = explode("-", $_GET['d1']);
            $d2 = explode("-", $_GET['d2']);
            $fY = $d1[0] . '-' . $d2[0];
        }
        else {
            $fY = '';
            $data = '';
            $cdate1 = '';
            $cdate2 = '';
        }
		$department = @$_GET['d'];
        $status = "'" . @$_GET['s'] . "'";
        if($status == "'T'") {
            $statusaa = "'A','P','F','R','I','RBI'";
        } else {
            $statusaa = "'" . @$_GET['s'] . "'";
        }
       
		$sno = $_GET['sno'];
		$connection = Yii::app()->db;
		$sql = "select a.processed_by_role_name,a.processed_by_role_user_mobile_number,a.next_role_user_email,a.processed_by_role_id,a.processed_by_role_name,a.processed_by_role_user_mobile_number,a.processed_by_role_user_email,a.next_role_id,a.app_transaction_id,a.swcs_application_id,a.infowiz_dept_id,a.dept_application_number,a.app_comment,a.transaction_datetime,a.created,b.licence_no,b.sno,b.sp_tag,b.infowiz_service_id,b.infowiz_service_name,b.is_applied_through_sw,b.iuid,b.caf_id,b.applicant_name,b.applicant_email,b.application_created_on,b.application_time_taken_by_department,a.app_status AS app_status, b.app_status AS app_status2,b.download_certificate_call_back_url from bo_dept_service_application_history AS a LEFT JOIN bo_dept_service_application AS b ON a.swcs_application_id = b.sno where a.swcs_application_id=$sno group by a.transaction_datetime ORDER BY a.transaction_datetime asc";
		$command = $connection->createCommand($sql);
        $allData = $command->queryAll();
		
			$sql = "select * from bo_dept_service_application where sno=$sno";
			$command = $connection->createCommand($sql);
			$allData2 = $command->queryAll();
		
		/* print_r($allData2);die(); */
        $this->render('transaction',array('allData'=>$allData,'allData2'=>$allData2,'sno'=>$sno,"department" => $department, "date1" => $cdate1, "date2" => $cdate2, "statusaa" => $statusaa,"fY"=>$fY));
    }
    
	public function actionTimelinel2(){ 
		if(isset($_GET['FY'])) {
			if ($_GET['FY'] == 'ALL') {
				$fY = $_GET['FY'];
			   	$cdate1 = '1900-03-03';
				$cdate2 =  date('Y-m-d',strtotime(date('Y-m-d'). '+1 day'));
			} else {
				$fY = $_GET['FY'];
				$data = explode("-", $fY);
				$cdate1 = $data[0] . "-04-01";
				$cdate2 = $data[1] . "-03-31"; 
			}
		}elseif (isset($_GET['d1']) && isset($_GET['d2'])) {
			$cdate1 = $_GET['d1'];
			$cdate2 = $_GET['d2'];
			$d1 = explode("-", $_GET['d1']);
			$d2 = explode("-", $_GET['d2']);
			$fY = $d1[0] . '-' . $d2[0];
		}
		else {
			$fY = '';
			$data = '';
			$cdate1 = '';
			$cdate2 = '';
		}	
		$this->render('timelinel2',array('date1'=>$cdate1,'date2'=>$cdate2));
	}
	public function actionTimelinel2copy(){ 
		if(isset($_GET['FY'])) {
			if ($_GET['FY'] == 'ALL') {
				$fY = $_GET['FY'];
			   	$cdate1 = '1900-03-03';
				$cdate2 =  date('Y-m-d',strtotime(date('Y-m-d'). '+1 day'));
			} else {
				$fY = $_GET['FY'];
				$data = explode("-", $fY);
				$cdate1 = $data[0] . "-04-01";
				$cdate2 = $data[1] . "-03-31"; 
			}
		}elseif (isset($_GET['d1']) && isset($_GET['d2'])) {
			$cdate1 = $_GET['d1'];
			$cdate2 = $_GET['d2'];
			$d1 = explode("-", $_GET['d1']);
			$d2 = explode("-", $_GET['d2']);
			$fY = $d1[0] . '-' . $d2[0];
		}
		else {
			$fY = '';
			$data = '';
			$cdate1 = '';
			$cdate2 = '';
		}	
		$this->render('timelinel2copy',array('date1'=>$cdate1,'date2'=>$cdate2));
	}
        
    public function actionTimelinel2NotApplicable(){ 
		if(isset($_GET['FY'])) {
			if ($_GET['FY'] == 'ALL') {
				$fY = $_GET['FY'];
			   	$cdate1 = '1900-03-03';
				$cdate2 =  date('Y-m-d',strtotime(date('Y-m-d'). '+1 day'));
			} else {
				$fY = $_GET['FY'];
				$data = explode("-", $fY);
				$cdate1 = $data[0] . "-04-01";
				$cdate2 = $data[1] . "-03-31"; 
			}
		}elseif (isset($_GET['d1']) && isset($_GET['d2'])) {
			$cdate1 = $_GET['d1'];
			$cdate2 = $_GET['d2'];
			$d1 = explode("-", $_GET['d1']);
			$d2 = explode("-", $_GET['d2']);
			$fY = $d1[0] . '-' . $d2[0];
		}
		else {
			$fY = '';
			$data = '';
			$cdate1 = '';
			$cdate2 = '';
		}	
		$this->render('timelinel2notapplicable',array('date1'=>$cdate1,'date2'=>$cdate2));
	}
        
	
	public function getDepartMentNameById($deptId=null){
	
		$connection = Yii::app()->db;
        $sql = "SELECT * FROM bo_departments where dept_id=$deptId";
        $command = $connection->createCommand($sql);
		$nameArr = $command->queryRow();
		
		return $nameArr['department_name'];
	}
	
	public function getServiceIncendence($service_id=null)
	{	
		
		$sql = "select core_service_id from bo_infowizard_service_timeline_new  as bistn INNER JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id  where bistn.servicetype_additionalsubservice=0 AND biwsm.incidence_pre_establishment=1 AND bistn.core_service_id=$service_id";
        $preEstabmishment = Yii::app()->db->createCommand($sql)->queryAll();
		
		$sql2 = "select core_service_id from bo_infowizard_service_timeline_new  as bistn INNER JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id where bistn.servicetype_additionalsubservice=0 AND biwsm .incidence_pre_operation=1 AND bistn.core_service_id=$service_id";
        $preOperation = Yii::app()->db->createCommand($sql2)->queryAll();
		
		$sql3 = "select core_service_id from bo_infowizard_service_timeline_new  as bistn INNER JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id where bistn.servicetype_additionalsubservice>0 AND bistn.core_service_id=$service_id";
		$postOperation = Yii::app()->db->createCommand($sql3)->queryAll();
		
		$incedence ='';
		if(isset($preEstabmishment) && !empty($preEstabmishment))
		{
			$incedence = $incedence."Pre Establishment<br/>";
		}
		if(isset($preOperation) && !empty($preOperation))
		{	
			$incedence = $incedence."Pre Operation<br/>";
			
		}		
		if(isset($postOperation) && !empty($postOperation))
		{	
			$incedence = $incedence."Post Operation<br/>";
			
		}
		return $incedence;				
	}

	public function actionGetServicesByDepartment() {
		
        if (!empty($_POST)) {
            //department Id
            $spidsArr = explode(',', $_POST['sp_id']);
            $spidsStr = implode(',', $spidsArr);
			
			//incedence type
			$incedenceArr = explode(',', $_POST['incedence']);
            /* print_r($spidsArr);
            print_r($incedenceArr); */
            $services = '<option value="All">All Services</option>';	
			$inciden = '';
			$preEstabmishment = array();
			$preOperation =  array();
			$postOperation =  array();	
            $connection = Yii::app()->db;
			
			// Incidence Status Conditions
            if (!empty($incedenceArr)) {
                foreach ($incedenceArr as $incDence) {
                    if ($incDence == 'pre_establishment') {
                        $sql = "select core_service_id from bo_infowizard_service_timeline_new  as bistn INNER JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id  where bistn.servicetype_additionalsubservice=0 AND biwsm.incidence_pre_establishment=1";
                        $preEstabmishment = Yii::app()->db->createCommand($sql)->queryAll();
                    }
                    if ($incDence == 'pre_operation') {
                        $sql = "select core_service_id from bo_infowizard_service_timeline_new  as bistn INNER JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id where bistn.servicetype_additionalsubservice=0 AND biwsm .incidence_pre_operation=1";
                        $preOperation = Yii::app()->db->createCommand($sql)->queryAll();
                    }
                    if ($incDence == 'post_operation') {
                        $sql = "select core_service_id from bo_infowizard_service_timeline_new  as bistn INNER JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id 
						where bistn.servicetype_additionalsubservice>0";
                        $postOperation = Yii::app()->db->createCommand($sql)->queryAll();
                    }
                }
            }
			
			$allIncedenceArray = array_merge($preEstabmishment, $preOperation, $postOperation);
			
            if (!empty($allIncedenceArray) && is_array($allIncedenceArray)) {
                foreach ($allIncedenceArray as $arr) {
                    if (!empty($arr['core_service_id']))
                        $inciden = $inciden . "'" . $arr['core_service_id'] . "',";
                }
				$inciden = rtrim($inciden,',');
            }
			$conditions ='';
			if(isset($spidsStr) && !empty($spidsStr) && $spidsArr[0]!="" && $spidsArr[0]!="All")
			{
				$conditions  .="  sp_id IN ($spidsStr) AND ";
			}
			
			if(isset($inciden) && !empty($inciden) && $incedenceArr[0]!="" && $incedenceArr[0]!="All")
			{
				$conditions  .="  app_id IN ($inciden) AND ";
			}
			
			if((isset($spidsArr) && $spidsArr[0]!="" && $spidsArr[0]!="All") || (isset($incedenceArr) && $incedenceArr[0]!="" && $incedenceArr[0]!="All"))
			{
				$sql = "select app_id,app_name from bo_sp_all_applications where $conditions is_app_active='Y'";
			}else {
				$sql = "select app_id,app_name from bo_sp_all_applications where is_app_active='Y'";
			}	
			
            $command = $connection->createCommand($sql);
            $servicesList = $command->queryAll();			
            foreach ($servicesList as $val) {
                $services .= "<option value='$val[app_id]'>$val[app_name]</option>";
            }

            echo $services;
        }
    }	
	
    public function getServiceTimetakenbyDept($sno=null) {
        $count = 1;
        $diffapplicant = 0;
        $diffdept = 0;
        $extraDays=0;
        $allDaysdept = 0;
        $connection = Yii::app()->db;
        $sql = "SELECT * FROM bo_sp_application_history where sp_app_id=:sno Order By history_id DESC";
        $command = $connection->createCommand($sql);
        $command->bindParam(":sno", $sno, PDO::PARAM_INT);
        $history = $command->queryAll();

        if (!empty($history)) {
            $apps1 = $history;
            foreach ($history as $key => $apps) {
                $status = $apps['application_status'];
                if ($status == "RBI") {
                    $keyval = $key - 1;
                    if ($keyval >= 0) {
                        $date = $apps1[$keyval]['added_date_time'];
                    } else {
                        $date = date('Y-m-d H:i:s');
                    }

                    // 1
                    //echo $date."===".$apps['added_date_time']."<br>";
                    $diff = abs(strtotime($apps['added_date_time']) - strtotime($date));
                    $diffapplicant = $diffapplicant + $diff;
                    $years = floor($diff / (365 * 60 * 60 * 24));
                    $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                    $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                    $hours = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
                    $minuts = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
                    $seconds = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
                    $allDays = ($months * 30) + $days;
                    //printf("%d days, %d hrs, %d min\n",  $allDays , $hours ,$minuts);
                }

                // 222

                if ($status != "RBI") {
                    if ($key == 0) {
                        if ($status == "A" || $status == "R" || $status=="O") {
                            $date = $apps['added_date_time'];
                        } else {
                            $date = date('Y-m-d H:i:s');
                        }
                    } else {
                        $keyval = $key - 1;
                        $date = $apps1[$keyval]['added_date_time'];
                    }
                    //echo $date;
                    $diff1 = abs(strtotime($apps['added_date_time']) - strtotime($date));

                    $diffdept = $diffdept + $diff1;
                    $years = floor($diff1 / (365 * 60 * 60 * 24));
                    $months = floor(($diff1 - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                    $days = floor(($diff1 - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                    $hours = floor(($diff1 - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
                    $minuts = floor(($diff1 - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
                    $seconds = floor(($diff1 - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
                    $allDays = ($months * 30) + $days;

                    //printf("%d days, %d hrs, %d min\n",  $allDays , $hours ,$minuts);
                }
            }

            $years = floor($diffdept / (365 * 60 * 60 * 24));
            $months = floor(($diffdept - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
            $days = floor(($diffdept - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
            $hours = floor(($diffdept - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
            $minuts = floor(($diffdept - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
            $seconds = floor(($diffdept - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
            if($years>0){$extraDays=365*$years;}
            $allDaysdept = ($months * 30) + $days+$extraDays;
            

            //printf("%d days, %d hrs, %d min\n",  $allDaysdept , $hours ,$minuts);
        }
        //echo $allDaysdept;die;

        return($allDaysdept);
        
        
    }
    
    public function actionTimeDept2() {
        print_r('223');die;
        return 1;
    }
	
	

    public function actionGetDepartmentByIncedence() {
        $deptMents = '<option value="All">All Departments</option>';
		
        if(!empty($_POST['incedence'])) {
            $connection = Yii::app()->db;
            $preEstabmishmentList = array();
            $preOperationList = array();
            $postOperationList = array();
            $allIncedenceArray = array();
            $allList = array();
			
            $incedenceArr = explode(',', $_POST['incedence']);
            foreach($incedenceArr as $incidence) {
                if ($incidence == 'pre_establishment' && $incidence != 'All') {
                    //fetch dept
                    $sql = "select ssp.sp_id,bd.department_name from bo_departments as bd Left Join sso_service_providers as ssp on bd.dept_id=ssp.department_id where ssp.sp_id IN (select bsaa.sp_id from bo_infowizard_service_timeline_new  as bistn 
		 LEFT JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id  
		LEFT JOIN bo_sp_all_applications  as bsaa ON bistn.core_service_id=bsaa.app_id  
		 where bistn.servicetype_additionalsubservice=0 AND biwsm.incidence_pre_establishment=1 AND bistn.core_service_id!='')";
                    $command = $connection->createCommand($sql);
                    $preEstabmishmentList = $command->queryAll();
                }
                if ($incidence == 'pre_operation' && $incidence != 'All') {
                    $sql = "select ssp.sp_id,bd.department_name from bo_departments as bd Left Join sso_service_providers as ssp on bd.dept_id=ssp.department_id where ssp.sp_id IN (select bsaa.sp_id from bo_infowizard_service_timeline_new  as bistn 
		 LEFT JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id  
		LEFT JOIN bo_sp_all_applications  as bsaa ON bistn.core_service_id=bsaa.app_id  
		 where bistn.servicetype_additionalsubservice=0 AND biwsm.incidence_pre_operation=1 AND bistn.core_service_id!='')";
                    $command = $connection->createCommand($sql);
                    $preOperationList = $command->queryAll();
                }
                if ($incidence == 'post_operation' && $incidence != 'All') {
                    $sql = "select ssp.sp_id,bd.department_name from bo_departments as bd Left Join sso_service_providers as ssp on bd.dept_id=ssp.department_id where ssp.sp_id IN (select bsaa.sp_id from bo_infowizard_service_timeline_new  as bistn 
		 LEFT JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id  
		LEFT JOIN bo_sp_all_applications  as bsaa ON bistn.core_service_id=bsaa.app_id  
		 where bistn.servicetype_additionalsubservice=0 AND bistn.core_service_id!='')";
                    $command = $connection->createCommand($sql);
                    $postOperationList = $command->queryAll();
                }
				if ($incidence == 'All') {
                   $sql = "SELECT ssp.sp_id, bd.department_name from sso_service_providers as ssp LEFT JOIN bo_departments as bd ON ssp.department_id=bd.dept_id where ssp.is_service_provider_active='Y' AND bd.department_name!=''";
                   $allList = Yii::app()->db->createCommand($sql)->queryAll();
                }
            }
            $allIncedenceArray = array_merge($preEstabmishmentList, $preOperationList, $postOperationList, $allList);
            
        }else{				
			$sql = "SELECT ssp.sp_id, bd.department_name from sso_service_providers as ssp LEFT JOIN bo_departments as bd ON ssp.department_id=bd.dept_id where ssp.is_service_provider_active='Y' AND bd.department_name!=''";
			$allIncedenceArray = Yii::app()->db->createCommand($sql)->queryAll();			
		}
		foreach($allIncedenceArray as $val) {
			$deptMents .= "<option value='$val[sp_id]'>$val[department_name]</option>";
		}
		echo $deptMents;
        die();
    }
    
    public function actionGetTimeLineStatusCount(){
        $dept = 19;
        $sql = "select concat(service_id,'.',servicetype_additionalsubservice) as infowiz_service_id,timeline_type_service_value as days, from_date,to_date 
                 from bo_infowizard_service_timeline_new 
                 where timeline_type = 'SWA' and is_active = 'Y' and department_id = $dept group by infowiz_service_id,to_date";
		$alltimelines = Yii::app()->db->createCommand($sql)->queryAll();
        
        
        foreach($alltimelines as $timeline){
            $from_date = $timeline['from_date'];
            if($timeline['to_date']=='0000-00-00'){
                $to_date = '2050-01-01';
            }else{
                $to_date = $timeline['to_date'];
            }
            $service_id = $timeline['infowiz_service_id'];
            $t_days = 
            $sql = "select count(*) from bo_dept_service_application where infowiz_dept_id = $dept and infowiz_service_id = $service_id"
                    . "and  DATE_FORMAT(application_created_on, '%Y-%m-%d %H:%i:%s') between $from_date and $to_date ";
            
            
		$allcount[]['cnt'] = Yii::app()->db->createCommand($sql)->queryAll();
        $allcount['to'] = $to_date;
        $allcount[]['from'] = $from_date;
        $allcount[]['service_id'] = $service_id;
        
        }
        echo '<pre>';print_r($allcount);die;
        
        //foreach($alltimelines as $timel)
        
    }
           
	public function getDepartMentNameByIsseurId($issuerId=null){
	
		$connection = Yii::app()->db;
        $sql = "SELECT * FROM bo_infowizard_issuerby_master where issuerby_id=$issuerId";
        $command = $connection->createCommand($sql);
		$nameArr = $command->queryRow();
		return $nameArr['name'];
	}

	public function getAdvanceReport() {
		ini_set('memory_limit', '-1');
        // Variable Initilization
        $serviceCondition = "";
		$serviceDetail = "";
        $serviceList = "";
        $statusCondition = "";
        $statusList = "";
        $sList = "";
        $departmentCondition = "";
        $departmentList = "";
        $applicationCondition = "";
        $applicationNumber = "";
        $unitName = "";
        $unitCondition = "";
        $fy = "";
        $fromToCondition = "";
        $fromtodate = "";
        $incidenceCondition = "";
        $preEstabmishment = array();
        $preOperation = array();
        $postOperation = array();
        $allIncedenceArray = array();
        $inciden = "";
        $timeline = 'All';
		$start = "";
        $end = "";
       
        // checking if  data has been posted
        if(!empty($_POST)) {
            //Extracting Get Values
            extract($_POST);
			// Incidence Status Conditions
			if (!empty($incidence) && $incidence[0]!='All') {
                foreach($incidence as $incDence) {
                    if ($incDence == 'pre_establishment') {
                        $sql = "select concat(service_id,'.',servicetype_additionalsubservice) as service_id from bo_infowizard_service_timeline_new  as bistn INNER JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id  where bistn.servicetype_additionalsubservice=0 AND biwsm.incidence_pre_establishment=1";
                        $preEstabmishment = Yii::app()->db->createCommand($sql)->queryAll();
                    }
                    if ($incDence == 'pre_operation') {
                        $sql = "select concat(service_id,'.',servicetype_additionalsubservice) as service_id from bo_infowizard_service_timeline_new  as bistn INNER JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id where bistn.servicetype_additionalsubservice=0 AND biwsm .incidence_pre_operation=1";
                        $preOperation = Yii::app()->db->createCommand($sql)->queryAll();
                    }
                    if ($incDence == 'post_operation') {
                        $sql = "select concat(service_id,'.',servicetype_additionalsubservice) as service_id from bo_infowizard_service_timeline_new  as bistn INNER JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id where bistn.servicetype_additionalsubservice>0";
                        $postOperation = Yii::app()->db->createCommand($sql)->queryAll();
                    }
                }
            }
            $allIncedenceArray = array_merge($preEstabmishment, $preOperation, $postOperation);
            if (!empty($allIncedenceArray) && is_array($allIncedenceArray)) {
                foreach ($allIncedenceArray as $arr) {
                    if (!empty($arr['service_id']))
                        $inciden = $inciden . "'" . $arr['service_id'] . "',";
                }
            }
			if (!empty($inciden)) {
                $inciden = $inciden . "'0'";				
                $incidenceCondition = " AND bodeps.infowiz_service_id IN ($inciden) ";
            }
			
			//Service conditions    			
            if(!empty($service) && $service[0]!='All') {
                $serviceList = implode(",", $service);
                $serviceCondition = " AND bodeps.infowiz_service_id IN ($serviceList) ";
            }
			
            // Service Status Conditions			
            if (!empty($serviceStatus) && $serviceStatus[0]!='All') {
                $statusList = "'" . implode("','", $serviceStatus) . "'";
                $sList = implode(",", $serviceStatus);
                $statusCondition = " AND bodeps.app_status IN ($statusList) ";
            }

            // Department Conditions			
            if (isset($department) && $department[0]!='All') {				
                $departmentList = implode(",", $department);
                $departmentCondition = " AND bodeps.infowiz_dept_id IN ($departmentList) ";
            }

            // Application Number
            if (!empty($applicationNumber)) {
                $applicationCondition = " AND bodeps.dept_application_number=$applicationNumber ";
            }

            // Unit Name
            if (!empty($unitName)) {
                $unitCondition = " AND bodeps.unit_name='$unitName' ";
            }
            
            // From Date To Date Condition
            if (!empty($start) && !empty($end)) {
                $startDate = date('Y-m-d', strtotime(@$start));
                $endDate = date('Y-m-d', strtotime(@$end));
                $fromToCondition = " AND DATE(bodeps.application_created_on)>='" . @$startDate . "' AND DATE(bodeps.application_created_on)<='" . @$endDate . "' ";
            }

            // Financial Year wise 			
            if (!empty($fy)) {
                $fromtodate = explode(":", $fy);
                // From Date To Date Conditions       
                if (!empty($fromtodate)) {
                    $startDate = date('Y-m-d', strtotime(@$fromtodate[0]));
                    $endDate = date('Y-m-d', strtotime(@$fromtodate[1]));
                    $fromToCondition = " AND DATE(bodeps.application_created_on)>='" . @$startDate . "' AND DATE(bodeps.application_created_on)<='" . @$endDate . "' ";
                }
            }
			
			// Search Query 
			$sql = "SELECT 
                bodeps.sno,
                bodeps.infowiz_dept_id,
				bodeps.infowiz_service_id,
				bodeps.infowiz_service_name,
				bodeps.legacy_service_id,
				bodeps.dept_application_number,
				bodeps.dept_sw_reference_no,
				bodeps.licence_no,
				bodeps.dept_user_id,
				bodeps.applicant_name,
				bodeps.applicant_email,
				bodeps.applicant_contact_no,
				bodeps.unit_name,
				bodeps.app_status,
				bodeps.unit_address,
				bodeps.application_created_on,
				bodeps.application_time_taken_by_department,
				boinfowizrd.issuerby_id,
                boinfowizrd.name AS 'dept_name'
				
                FROM bo_dept_service_application as bodeps               
                LEFT JOIN bo_infowizard_issuerby_master as boinfowizrd ON bodeps.infowiz_dept_id=boinfowizrd.issuerby_id
				
				
                Where bodeps.is_active ='Y' 
				$fromToCondition
				$unitCondition
				$applicationCondition
				$departmentCondition
				$statusCondition
				$serviceCondition
				$incidenceCondition
                ORDER BY boinfowizrd.name DESC";
			
			$serviceDetail = Yii::app()->db->createCommand($sql)->queryAll();
		}
              
        // setting values here
        $advRepArray = array(
            'serviceData' => $serviceDetail,
            'serviceList' => $serviceList,
            'departmentList' => $departmentList,
            'statusList' => $sList,
            'applicationNumber' => $applicationNumber,
            'unitName' => $unitName,
			'preEstabmishment'=>$preEstabmishment, 
			'preOperation'=>$preOperation,
			'postOperation'=>$postOperation,
            'fy' => $fy,
            'timeline' => $timeline,
			'start' => $start,
			'end' => $end
		);
		return $advRepArray;
		 
    }
		
	public function actionGetSyncDepartmentByIncedence() {
        $deptMents = '<option value="All">All Departments</option>';
		
        if(!empty($_POST['incedence'])) {
            $connection = Yii::app()->db;
            $preEstabmishmentList = array();
            $preOperationList = array();
            $postOperationList = array();
            $allIncedenceArray = array();
            $allList = array();
			
            $incedenceArr = explode(',', $_POST['incedence']);
            foreach($incedenceArr as $incidence) {
                if ($incidence == 'pre_establishment' && $incidence != 'All') {
                    //fetch dept
                    $sql = "SELECT boinfowizardissuer.issuerby_id,boinfowizardissuer.name FROM bo_infowizard_issuerby_master AS boinfowizardissuer 
					LEFT JOIN bo_information_wizard_service_master AS biwsm ON biwsm.issuerby_id=boinfowizardissuer.issuerby_id
                    INNER JOIN bo_dept_service_application AS bdsa ON biwsm.issuerby_id=bdsa.infowiz_dept_id
					where biwsm.incidence_pre_establishment=1 GROUP BY boinfowizardissuer.issuerby_id";
                    $command = $connection->createCommand($sql);
                    $preEstabmishmentList = $command->queryAll();
                }
                if ($incidence == 'pre_operation' && $incidence != 'All') {
                    $sql = "SELECT boinfowizardissuer.issuerby_id,boinfowizardissuer.name FROM bo_infowizard_issuerby_master AS boinfowizardissuer 
					LEFT JOIN bo_information_wizard_service_master AS biwsm ON biwsm.issuerby_id=boinfowizardissuer.issuerby_id
					INNER JOIN bo_dept_service_application AS bdsa ON biwsm.issuerby_id=bdsa.infowiz_dept_id
					where biwsm.incidence_pre_operation=1 GROUP BY boinfowizardissuer.issuerby_id";
                    $command = $connection->createCommand($sql);
                    $preOperationList = $command->queryAll();
                }
                if ($incidence == 'post_operation' && $incidence != 'All') {
                    $sql = "SELECT boinfowizardissuer.issuerby_id,boinfowizardissuer.name FROM bo_infowizard_issuerby_master AS boinfowizardissuer 
					LEFT JOIN bo_information_wizard_service_master AS biwsm ON biwsm.issuerby_id=boinfowizardissuer.issuerby_id
					INNER JOIN bo_dept_service_application AS bdsa ON biwsm.issuerby_id=bdsa.infowiz_dept_id
					GROUP BY boinfowizardissuer.issuerby_id";
                    $command = $connection->createCommand($sql);
                    $postOperationList = $command->queryAll();
                }
				if ($incidence == 'All') {
                   $sql = "SELECT boinfowizardissuer.issuerby_id,boinfowizardissuer.name FROM bo_infowizard_issuerby_master AS boinfowizardissuer 
				   LEFT JOIN bo_information_wizard_service_master AS biwsm ON biwsm.issuerby_id=boinfowizardissuer.issuerby_id
				   INNER JOIN bo_dept_service_application AS bdsa ON biwsm.issuerby_id=bdsa.infowiz_dept_id
				   GROUP BY boinfowizardissuer.issuerby_id";
                   $allList = Yii::app()->db->createCommand($sql)->queryAll();
                }
            }
            $allIncedenceArray = array_merge($preEstabmishmentList, $preOperationList, $postOperationList, $allList);
            
        }else{				
			$sql = "SELECT boinfowizardissuer.issuerby_id,boinfowizardissuer.name FROM bo_infowizard_issuerby_master AS boinfowizardissuer 
			LEFT JOIN bo_information_wizard_service_master AS biwsm ON biwsm.issuerby_id=boinfowizardissuer.issuerby_id
			INNER JOIN bo_dept_service_application AS bdsa ON biwsm.issuerby_id=bdsa.infowiz_dept_id
			GROUP BY boinfowizardissuer.issuerby_id";
			$allIncedenceArray = Yii::app()->db->createCommand($sql)->queryAll();			
		}
		$allready=array();
		//print_r($allIncedenceArray);die();
		foreach($allIncedenceArray as $val) {
		
		if(!in_array($val['issuerby_id'],$allready)){
			$allready[]=$val['issuerby_id'];
			$deptMents .= "<option value='$val[issuerby_id]'>$val[name]</option>";
			}
		}
		echo $deptMents;
        die();
    }

	public function actionGetSyncServicesByDepartment() {
		
        if(!empty($_POST)) {
            //department Id
            $spidsArr = explode(',', $_POST['issuerby_id']);
            $spidsStr = implode(',', $spidsArr);
			
			//incedence type
			$incedenceArr = explode(',', $_POST['incedence']);
            /* print_r($spidsArr);
            print_r($incedenceArr); */
            $services = '<option value="All">All Services</option>';	
			$inciden = '';
			$preEstabmishment = array();
			$preOperation =  array();
			$postOperation =  array();	
            $connection = Yii::app()->db;
			$conditions ='';
			if(isset($spidsStr) && !empty($spidsStr) && $spidsArr[0]!="" && $spidsArr[0]!="All")
			{
				$conditions  .="  biwsm.issuerby_id IN ($spidsStr) AND ";
			}
			// Incidence Status Conditions
            if (!empty($incedenceArr)) {
                foreach ($incedenceArr as $incDence) {
                    if ($incDence == 'pre_establishment') {
                        $sql = "select core_service_id from bo_infowizard_service_timeline_new  as bistn INNER JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id where bistn.servicetype_additionalsubservice=0 AND biwsm.incidence_pre_establishment=1";
                        $preEstabmishment = Yii::app()->db->createCommand($sql)->queryAll();
                    }
                    if ($incDence == 'pre_operation') {
                        $sql = "select core_service_id from bo_infowizard_service_timeline_new  as bistn INNER JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id where bistn.servicetype_additionalsubservice=0 AND biwsm .incidence_pre_operation=1";
                        $preOperation = Yii::app()->db->createCommand($sql)->queryAll();
                    }
                    if ($incDence == 'post_operation') {
                        $sql = "select core_service_id from bo_infowizard_service_timeline_new  as bistn INNER JOIN bo_information_wizard_service_master as biwsm ON bistn.service_id=biwsm.id 
						where bistn.servicetype_additionalsubservice>0";
                        $postOperation = Yii::app()->db->createCommand($sql)->queryAll();
                    }
                }
            }
			
			$allIncedenceArray = array_merge($preEstabmishment, $preOperation, $postOperation);
			
            if (!empty($allIncedenceArray) && is_array($allIncedenceArray)) {
                foreach ($allIncedenceArray as $arr) {
                    if (!empty($arr['core_service_id']))
                        $inciden = $inciden . "'" . $arr['core_service_id'] . "',";
                }
				$inciden = rtrim($inciden,',');
            }
			
			
			
			if(isset($inciden) && !empty($inciden) && $incedenceArr[0]!="" && $incedenceArr[0]!="All")
			{
				$conditions  .="  bistn.service_id IN ($inciden) AND ";
			}
			
			
			if((isset($spidsArr) && $spidsArr[0]!="" && $spidsArr[0]!="All") || (isset($incedenceArr) && $incedenceArr[0]!="" && $incedenceArr[0]!="All"))
			{
				//$sql = "select app_id,app_name from bo_sp_all_applications where $conditions is_app_active='Y'";
				$sql= "SELECT CONCAT(bistn.service_id,'.',bistn.servicetype_additionalsubservice) as serviceid,core_service_name,biwsm.id,biwsm.issuerby_id from bo_infowizard_service_timeline_new AS bistn 
				LEFT JOIN bo_information_wizard_service_parameters as biwsp ON CONCAT(biwsp.service_id,'.',biwsp.servicetype_additionalsubservice)=
				CONCAT(bistn.service_id,'.',bistn.servicetype_additionalsubservice) 
				LEFT JOIN bo_information_wizard_service_master as biwsm ON biwsm.id=bistn.service_id
				where $conditions bistn.timeline_type='SWA' AND biwsp.is_active='Y' GROUP BY id"; 	 
				
			} else {
				$sql = "SELECT CONCAT(bistn.service_id,'.',bistn.servicetype_additionalsubservice) as serviceid,core_service_name,biwsm.id,biwsm.issuerby_id from bo_infowizard_service_timeline_new AS bistn 
				LEFT JOIN bo_information_wizard_service_parameters as biwsp ON CONCAT(biwsp.service_id,'.',biwsp.servicetype_additionalsubservice)=
				CONCAT(bistn.service_id,'.',bistn.servicetype_additionalsubservice)
				LEFT JOIN bo_information_wizard_service_master as biwsm ON biwsm.id=bistn.service_id
				where bistn.timeline_type='SWA' AND biwsp.is_active='Y' AND issuerby_id IN('19','5') GROUP BY serviceid";
			}	
			
            $command = $connection->createCommand($sql);
            $servicesList = $command->queryAll();			
            foreach ($servicesList as $val) {
                $services .= "<option value='$val[serviceid]'>$val[core_service_name]</option>";
            }

            echo $services;
        }
    } 
    
    public function actionL4Copy(){
		if(isset($_GET['FY'])) {
            if ($_GET['FY'] == 'ALL') {
                $fY = $_GET['FY'];
                $cdate1 = '1900-03-03';
                $cdate2 =  date('Y-m-d',strtotime(date('Y-m-d'). '+1 day'));
            } else {
                $fY = $_GET['FY'];
                $data = explode("-", $fY);
                $cdate1 = $data[0] . "-04-01";
                $cdate2 = $data[1] . "-03-31"; 
            }
        }elseif (isset($_GET['d1']) && isset($_GET['d2'])) {
            $cdate1 = $_GET['d1'];
            $cdate2 = $_GET['d2'];
            $d1 = explode("-", $_GET['d1']);
            $d2 = explode("-", $_GET['d2']);
            $fY = $d1[0] . '-' . $d2[0];
        }
        else {
            $fY = '';
            $data = '';
            $cdate1 = '';
            $cdate2 = '';
        }
		$department = @$_GET['d'];
        $status = "'" . @$_GET['s'] . "'";
        if($status == "'T'") {
            $statusaa = "'A','P','F','R','I','RBI'";
        } else {
            $statusaa = "'" . @$_GET['s'] . "'";
        }
        $this->render('l4copy',array("department" => $department, "date1" => $cdate1, "date2" => $cdate2, "statusaa" => $statusaa,"fY"=>$fY));
    }
			
}