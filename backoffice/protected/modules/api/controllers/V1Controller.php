<?php

class V1Controller extends Controller {

    function init() {
        
    }

    public function actionTestEmail() {
        extract($_POST);
        echo DefaultUtility::sendCaipoEmail($host, $port, $user, $pass, $subject, $content, $to, $email_name, $cc = null, $bcc = null, $attchement = null);
    }
public function actionCompanylist(){
	 if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('STATUS: Method Not allowed', true, 405);
            $response['STATUS'] = 405;
            $response['ERROR'] = "Method Not Allowed";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            exit;
        }
        extract($_POST);

        $connection = Yii::app()->db;
        $where = '';
		if(isset($term) && $term!=""){
			if (isset($type) && $type=='name' && isset($term) && $term!=""){
				$where = ' AND CNAMCN like :term';
				$sql = "select DISTINCT(CNAMCN) as data
                from zdm_cnamcnp0 inner join zdm_cprfcpp0 on zdm_cnamcnp0.CNUMCN = zdm_cprfcpp0.CNUMCP 
                inner join zdm_abbr_cmp on zdm_cnamcnp0.CTYPCN = zdm_abbr_cmp.company_type
                where 1=1 and DTEXP_MANUAL ='' $where Limit 2000";
			}
			if (isset($type) && $type=='number' && isset($term) && $term!=""){
				$where = ' AND CNUMCN like :term';
				 $sql = "select DISTINCT(CNUMCN) as data
                from zdm_cnamcnp0 inner join zdm_cprfcpp0 on zdm_cnamcnp0.CNUMCN = zdm_cprfcpp0.CNUMCP 
                inner join zdm_abbr_cmp on zdm_cnamcnp0.CTYPCN = zdm_abbr_cmp.company_type
                where 1=1 and DTEXP_MANUAL ='' $where Limit 2000";
			 }
			 if (isset($type) && $type=='category' && isset($term) && $term!=""){
				$where = ' AND company_type_desc like :term';
				 $sql = "select DISTINCT(company_type_desc) as data
                from zdm_cnamcnp0 inner join zdm_cprfcpp0 on zdm_cnamcnp0.CNUMCN = zdm_cprfcpp0.CNUMCP 
                inner join zdm_abbr_cmp on zdm_cnamcnp0.CTYPCN = zdm_abbr_cmp.company_type
                where 1=1 and DTEXP_MANUAL ='' $where Limit 2000";
			 }
		 
				$command = $connection->createCommand($sql);
		
				$term = '%'.$term.'%';
				$command->bindParam(':term', $term, PDO::PARAM_STR);
				$rows = $command->queryAll();
				$up_array = array();
				$i=0;
				foreach($rows as $row){
					
						$up_array[$i]['id'] = $row['data'];
						$up_array[$i]['label'] = $row['data'];
						$i++;
				}
				echo json_encode($up_array);
		}
				die;
}
public function actionSearchDb() {
	
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('STATUS: Method Not allowed', true, 405);
            $response['STATUS'] = 405;
            $response['ERROR'] = "Method Not Allowed";
            $response['RESPONSE'] = "";
            echo json_encode($response);
            exit;
        }
        extract($_POST);

        $connection = Yii::app()->db;
        $where = '';
        $where_new = '';

		
        if (isset($name_search_con) && $name_search_con == "Equals" && isset($name_search_param) && $name_search_param != "") {
            $where = 'AND CNAMCN=:name_search_param ';
            $where_new = 'AND company_name=:name_search_param ';
        }
        if (isset($name_search_con) && in_array($name_search_con, array('Contains', 'Starts with')) && isset($name_search_param) && $name_search_param != "") {
            $where = 'AND CNAMCN like :name_search_param ';
            $where_new = 'AND company_name like :name_search_param ';
        }
		if (isset($name_search_con) && $name_search_con=="NOT Empty") {
            $where = 'AND CNAMCN!="" ';
            $where_new = 'AND company_name!="" ';
        }
		if (isset($name_search_con) && $name_search_con=="Empty") {
            $where = 'AND CNAMCN="" ';
            $where_new = 'AND company_name="" ';
        }
        if (isset($category_search_con) && in_array($category_search_con, array('Equals')) && isset($category_search_param) && $category_search_param != "") {
            $where.= 'AND company_type_desc=:category_search_param ';
            $where_new.= 'AND company_type=:category_search_param ';
        }
		 if (isset($category_search_con) && in_array($category_search_con, array('Contains', 'Starts with')) && isset($category_search_param) && $category_search_param !="") {
            $where.= 'AND company_type_desc like :category_search_param ';
            $where_new.= 'AND company_type like :category_search_param ';
        }
		if (isset($category_search_con) && $category_search_con=="Empty") {
            $where.= 'AND company_type_desc ="" ';
            $where_new.= 'AND company_type ="" ';
        }
		if (isset($category_search_con) && $category_search_con=="NOT Empty") {
            $where.= 'AND company_type_desc !="" ';
            $where_new.= 'AND company_type_desc !="" ';
        }


	if (isset($number_search_con) && in_array($number_search_con, array('Equals')) && isset($number_search_param) && $number_search_param != "") {
            $where.= 'AND CNUMCN=:number_search_param ';
            $where_new.= 'AND reg_no=:number_search_param ';
        }
		 if (isset($number_search_con) && in_array($number_search_con, array('Contains', 'Starts with')) && isset($number_search_param) && $number_search_param != "") {
            $where.= 'AND CNUMCN like :number_search_param ';
            $where_new.= 'AND reg_no like :number_search_param ';
        }
		if (isset($number_search_con) && $number_search_con=="Empty") {
            $where.= 'AND CNUMCN="" ';
            $where_new.= 'AND reg_no="" ';
        }
		if (isset($number_search_con) && $number_search_con=="NOT Empty") {
            $where.= 'AND CNUMCN!="" ';
            $where_new.= 'AND reg_no!="" ';
        }
		
		if (isset($number_search_con) && $number_search_con=='More than' && isset($number_search_param) && $number_search_param != "") {
            $where.= 'AND CONVERT(CNUMCN,UNSIGNED INTEGER)>:number_search_param ';
            $where_new.= 'AND CONVERT(reg_no,UNSIGNED INTEGER)>:number_search_param ';
        }
		if (isset($number_search_con) && $number_search_con=='Less than' && isset($number_search_param) && $number_search_param != "") {
            $where.= 'AND CONVERT(CNUMCN,UNSIGNED INTEGER)<:number_search_param ';
            $where_new.= 'AND CONVERT(reg_no,UNSIGNED INTEGER)<:number_search_param ';
        }
		if (isset($number_search_con) && $number_search_con=='Between' && isset($number_search_param) && $number_search_param != "" && isset($number_search_param2) && $number_search_param2 != "") {
            $where.= 'AND CONVERT(CNUMCN,UNSIGNED INTEGER) Between :number_search_param AND :number_search_param2 ';
            $where_new.= 'AND CONVERT(reg_no,UNSIGNED INTEGER) Between :number_search_param AND :number_search_param2 ';
        }
		
		
		if (isset($date_search_con) && in_array($date_search_con, array('Equals')) && isset($date_search_param) && $date_search_param != "") {
            $where.= 'AND DATE(DTRGCP)=:date_search_param ';
            $where_new.= 'AND DATE(DTRGCP)=:date_search_param ';
        }
	
		if (isset($date_search_con) && $date_search_con=="Empty") {
            $where.= 'AND DTRGCP="" ';
            $where_new.= 'AND created_on="" ';
        }
		if (isset($date_search_con) && $date_search_con=="NOT Empty") {
            $where.= 'AND DTRGCP!="" ';
            $where_new.= 'AND created_on!="" ';
        }
		
		if (isset($date_search_con) && $date_search_con=='More than' && isset($date_search_param) && $date_search_param != "") {
            $where.= 'AND DATE(DTRGCP)>:date_search_param ';
            $where_new.= 'AND DATE(created_on)>:date_search_param ';
        }
		if (isset($date_search_con) && $date_search_con=='Less than' && isset($date_search_param) && $date_search_param != "") {
            $where.= 'AND DATE(DTRGCP)<:date_search_param ';
            $where_new.= 'AND DATE(created_on)<:date_search_param ';
        }
		if (isset($date_search_con) && $date_search_con=='Between' && isset($date_search_param) && $date_search_param != "" && isset($date_search_param2) && $date_search_param2 != "") {
            $where.= 'AND DATE(DTRGCP) Between :date_search_param AND :date_search_param2 ';
            $where_new.= 'AND DATE(created_on) Between :date_search_param AND :date_search_param2 ';
        }

         $sql = "select * from (select CNAMCN as company_name, CNUMCN as company_number, company_type_desc as registration_category,  IF(CTYPCP in ('I','D','F','ESR','NP','A/D','A/I','AEI','AOB','AEM','ASR'), DTINCP,DTRGCP) as registration_date
                from zdm_cnamcnp0 left join zdm_cprfcpp0 on zdm_cnamcnp0.CNUMCN = zdm_cprfcpp0.CNUMCP 
                left join zdm_abbr_cmp on zdm_cprfcpp0.CTYPCP = zdm_abbr_cmp.company_type
                where 1=1 and DTEXP_MANUAL ='' $where and CTYPCN = CTYPCP 
                    union 
                select company_name,reg_no as company_number,company_type as registration_category,  created_on as registration_date from bo_company_details where 1=1 $where_new )  
                as temp limit 2000";
        $command = $connection->createCommand($sql); 

		
        if (isset($name_search_con) && $name_search_con == "Equals" && isset($name_search_param) && $name_search_param !="") {
            $command->bindParam(":name_search_param", $name_search_param, PDO::PARAM_STR);
        }
        if (isset($name_search_con) && $name_search_con == "Contains" && isset($name_search_param) && $name_search_param != "") {
            $name_search_param = '%' . $name_search_param . '%';
            $command->bindParam(':name_search_param', $name_search_param, PDO::PARAM_STR);
        }
        if (isset($name_search_con) && $name_search_con == "Starts with" && isset($name_search_param) && $name_search_param != "") {
            $name_search_param = $name_search_param . '%';
           $command->bindParam(':name_search_param', $name_search_param, PDO::PARAM_STR);
        }
		 
        if (isset($category_search_con) && in_array($category_search_con, array('Equals')) && isset($category_search_param) && $category_search_param != "") {
            $command->bindParam(':category_search_param', $category_search_param, PDO::PARAM_STR);
        }
		 
		 if (isset($category_search_con) && $category_search_con == "Contains" && isset($category_search_param) && $category_search_param != "") {
            $category_search_param = '%' . $category_search_param . '%';
            $command->bindParam(':category_search_param', $category_search_param, PDO::PARAM_STR);
        }
        if (isset($category_search_con) && $category_search_con == "Starts with" && isset($category_search_param) && $category_search_param != "") {
            $category_search_param = $category_search_param . '%';
           $command->bindParam(':category_search_param', $category_search_param, PDO::PARAM_STR);
        }
		
			if (isset($number_search_con) && in_array($number_search_con, array('Equals','More than','Less than')) && isset($number_search_param) && $number_search_param != "") {
            $command->bindParam(':number_search_param', $number_search_param, PDO::PARAM_INT);
        }
		 if (isset($number_search_con) && $number_search_con == "Contains" && isset($number_search_param) && $number_search_param != "") {
            $number_search_param = '%' . $number_search_param . '%';
            $command->bindParam(':number_search_param', $number_search_param, PDO::PARAM_STR);
        }
        if (isset($number_search_con) && $number_search_con == "Starts with" && isset($number_search_param) && $number_search_param != "") {
            $number_search_param = $number_search_param . '%';
           $command->bindParam(':number_search_param', $number_search_param, PDO::PARAM_STR);
        }
		
	 if (isset($number_search_con) && $number_search_con=="Between" && isset($number_search_param) && $number_search_param != "" && isset($number_search_param2) && $number_search_param2 != "") {
           $command->bindParam(':number_search_param', $number_search_param, PDO::PARAM_INT);
           $command->bindParam(':number_search_param2', $number_search_param2, PDO::PARAM_INT);
        }


if (isset($date_search_con) && in_array($date_search_con, array('Equals','More than','Less than')) && isset($date_search_param) && $date_search_param != "") {
            $command->bindParam(':date_search_param', $date_search_param, PDO::PARAM_INT);
        }if (isset($date_search_con) && $date_search_con=="Between" && isset($date_search_param) && $date_search_param != "" && isset($date_search_param2) && $date_search_param2 != "") {
           $command->bindParam(':date_search_param', $date_search_param, PDO::PARAM_INT);
           $command->bindParam(':date_search_param2', $date_search_param2, PDO::PARAM_INT);
        }


        $rows = $command->queryAll();
        $up_array = array();
        foreach($rows as $row){
            if(isset($row['registration_date']) && $row['registration_date'] !=''){
                $row['registration_date'] = date('Y-m-d',strtotime($row['registration_date']));
            }
                $up_array[] = $row;
        } 
        echo json_encode($up_array);
        die;
    }
	
    public function actionIndex() {
        // Utility::sendOTPToMobile('9599424588','Test Message from Hemant Thakur');
        echo json_encode(array("April" => "Fool"));
    }

    public function actionGetTokenDetail() {
        header('content-type: application/json');
        $response = array();
        if (isset($_GET['token'])) {
            $token = trim($_GET['token']);
            $token = strip_tags($token);
            if (strlen($token) == 32) {
                $connection = Yii::app()->db;
                $sql = "SELECT tkn.token,tkn.user_id,tkn.role_id,tkn.token_created_on,tkn.token_accessed_on,usr.full_name,usr.email,usr.mobile,usr.dept_id,usr.disctrict_id,tkn.module_id from bo_user_active_tokens tkn
							INNER JOIN bo_user usr
							ON tkn.user_id=usr.uid
							WHERE tkn.token=:token";

                $command = $connection->createCommand($sql);
                $command->bindParam(":token", $token, PDO::PARAM_STR);
                $row = $command->queryRow();

                if ($row == FALSE) {
                    header('STATUS: OK', true, 204);
                    $response['STATUS'] = 204;
                    $response['MSG'] = "No Content";
                    $response['ERROR'] = "Invalid Token";
                    $response['RESPONSE'] = array();
                } else {
                    $returnData = $row;
                    $returnData['module_name'] = IncentiveModules::getModuleNameFromID($row['module_id']);
                    $roleIDName = RolesExt::getRolesViaId($row['role_id']);
                    $returnData['role_name'] = $roleIDName['role_name'];
                    $depart = DepartmentsExt::getDeptbyId($row['dept_id']);
                    $returnData['department_name'] = $depart['department_name'];
                    $distName = DistrictExt::getDistricNameById($row['disctrict_id']);
                    $returnData['district_name'] = $distName;
                    header('STATUS: OK', true, 200);
                    $response['STATUS'] = 200;
                    $response['MSG'] = "OK";
                    $response['RESPONSE'] = $returnData;
                }
            } else {
                header('STATUS: NO TOKEN', true, 412);
                $response['STATUS'] = 412;
                $response['MSG'] = "INVALID TOKEN";
                $response['ERROR'] = "Invalid Token Length";
                $response['RESPONSE'] = "";
            }
        } else {
            header('STATUS: NO TOKEN', true, 400);
            $response['STATUS'] = 400;
            $response['MSG'] = "NO TOKEN";
            $response['ERROR'] = "Invalid Token Length";
            $response['RESPONSE'] = "";
        }
        echo json_encode($response);
    }

    /**
     * this function is used to get all the CAF Application of the users

     */
}
