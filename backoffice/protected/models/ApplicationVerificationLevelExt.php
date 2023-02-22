<?php

class ApplicationVerificationLevelExt extends ApplicationVerificationLevel {

    public static function isRevertedApps($uid, $app_id) {
        $status = 'F';
        $sql = "SELECT submission_id FROM bo_application_submission where user_id=:uid AND application_id=:app_id AND application_status=:status ORDER BY submission_id DESC ";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        //$command->bindParam(":aprvhold",$aprvhold,PDO::PARAM_STR);
        $command->bindParam(":app_id", $app_id, PDO::PARAM_STR);
        $command->bindParam(":uid", $uid, PDO::PARAM_INT);
        $command->bindParam(":status", $status, PDO::PARAM_STR);
        // $command->bindParam(":uid",$user_id,PDO::PARAM_INT);
        $appList = $command->queryRow();
        // print_r($appList);die;	
        if ($appList === false)
            return false;
        return true;
    }

    /**
     * This function is used to get all the pending application of the particular department(on particular role id)
     * @author : Hemant Thakur
     *
     */
    public static function getApplication($user_id) {
        $uid = $_SESSION['uid'];
        $aprvhold = "H";
        $apprP = "P";
        $active = "Y";
        /* $sql="SELECT rm.role_id,appvl.app_sub_id,appsb.application_id,appsb.field_value,appsb.user_id,appvl.approv_status FROM bo_user_role_mapping rm
          INNER JOIN bo_application_verification_level appvl
          ON appvl.next_role_id = rm.role_id
          INNER JOIN bo_application_submission appsb
          ON appvl.app_sub_id=appsb.submission_id AND rm.department_id=appsb.dept_id
          WHERE rm.user_id=:user_id AND is_mapping_active=:active AND (appvl.approv_status=:apprP)"; */
        $sql = "SELECT rm.role_id,appvl.app_sub_id,appsb.application_id,appsb.field_value,appsb.application_created_date,appsb.user_id,appvl.approv_status FROM bo_application_verification_level appvl
				INNER JOIN bo_application_submission appsb
				ON appvl.app_sub_id=appsb.submission_id
				INNER JOIN  bo_user_role_mapping rm
				ON appvl.next_role_id = rm.role_id AND rm.department_id=appsb.dept_id
				INNER JOIN bo_user usr
				ON usr.uid=:uid AND usr.disctrict_id=appsb.landrigion_id 
				WHERE rm.user_id=:uid AND is_mapping_active=:active AND (appvl.approv_status=:apprP)";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        //$command->bindParam(":aprvhold",$aprvhold,PDO::PARAM_STR);
        $command->bindParam(":apprP", $apprP, PDO::PARAM_STR);
        $command->bindParam(":uid", $uid, PDO::PARAM_INT);
        $command->bindParam(":active", $active, PDO::PARAM_STR);
        // $command->bindParam(":uid",$user_id,PDO::PARAM_INT);
        $appList = $command->queryAll();
        if ($appList === false)
            return false;
        return $appList;
    }

    /**
     * This function is used to get all the pending application for the nodle agency nodle officer
     * @author : Hemant Thakur
     *
     */
    public static function getNodleApplication($user_id) {
        $aprvhold = "H";
        $uid = $_SESSION['uid'];
        $apprP = "P";
        $active = "Y";
        $sql = "SELECT rm.role_id,appvl.app_sub_id,appsb.application_id,appsb.field_value, DATE_FORMAT(appsb.application_created_date,'%d %b %Y') as application_created_date ,appsb.user_id,appvl.approv_status FROM bo_user_role_mapping rm
				  INNER JOIN bo_application_verification_level appvl
				  ON appvl.next_role_id = rm.role_id
				  INNER JOIN bo_application_submission appsb
				  ON appvl.app_sub_id=appsb.submission_id
				  INNER JOIN bo_user usr
				ON usr.uid=:user_id AND usr.disctrict_id=appsb.landrigion_id 
	       		  WHERE rm.user_id=:user_id AND is_mapping_active=:active AND (appvl.approv_status=:apprP) order by appsb.application_created_date";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        //$command->bindParam(":aprvhold",$aprvhold,PDO::PARAM_STR);
        $command->bindParam(":apprP", $apprP, PDO::PARAM_STR);
        $command->bindParam(":user_id", $uid, PDO::PARAM_INT);
        $command->bindParam(":active", $active, PDO::PARAM_STR);
        // $command->bindParam(":user_id",$user_id,PDO::PARAM_INT);
        $appList = $command->queryAll();
        if ($appList === false)
            return false;
        return $appList;
    }

    /**
     * This function is used to get all the pending applications of the particulars departments(on particular role id)
     * @author : Hemant THakur
     * @Params : INT
     * @return: array 
     */
    public static function getForwardedApplications($user_id) {
        $active = 'Y';
        $app_status = 'F';
        // $uid=$_SESSION['uid'];
        $sql = "SELECT rm.role_id,appvl.app_sub_id,appsb.application_id,appfl.forwarded_dept_id, DATE_FORMAT(appfl.created_on,'%d %b %Y %T') as created_on ,appfl.verifier_user_comment,appfl.approv_status, DATE_FORMAT(appfl.comment_date,'%d %b %Y %T') as comment_date FROM bo_user_role_mapping rm
				  INNER JOIN bo_application_verification_level appvl
				  ON appvl.next_role_id = rm.role_id
				  INNER JOIN bo_application_submission appsb
				  ON appvl.app_sub_id=appsb.submission_id
				  INNER JOIN bo_application_forward_level appfl
				  ON appfl.app_Sub_id=appvl.app_sub_id
				  INNER JOIN bo_user usr
				  ON appsb.landrigion_id=usr.disctrict_id AND usr.uid=:user_id 
				  WHERE rm.user_id=:user_id AND is_mapping_active=:active AND appvl.approv_status=:app_status  ";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindParam(":app_status", $app_status, PDO::PARAM_STR);
        $command->bindParam(":active", $active, PDO::PARAM_STR);
        $command->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $appList = $command->queryAll();
        if ($appList === false)
            return false;
        return $appList;
    }

    /**
     * This function is used to get all the reverted applications of the particulars nodal
     * @author : Hemant THakur
     * @Params : INT
     * @return: array 
     */
    public function getRevertedApplications($user_id) {
        $role_id = RolesExt::getUserRoleViaId($user_id);
        $role_id = $role_id['role_id'];
        $app_status = 'P';
        //$active='Y';
        $sql = "SELECT appfl.*,appsb.application_id,appsb.submission_id as app_sub_id FROM bo_application_forward_level appfl
				 INNER JOIN bo_user_role_mapping rlm
				 ON rlm.role_id=appfl.next_role_id
				 INNER JOIN bo_application_submission appsb
				 ON appsb.submission_id=appfl.app_Sub_id
				 INNER JOIN bo_user usr
				 
				  ON appsb.landrigion_id=usr.disctrict_id AND usr.uid=:user_id
				 WHERE appfl.approv_status=:app_status AND appfl.next_role_id=:role_id";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindParam(":app_status", $app_status, PDO::PARAM_STR);
        $command->bindParam(":role_id", $role_id, PDO::PARAM_INT);
        $command->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        /* $sql="SELECT rm.role_id,appvl.app_sub_id,appsb.application_id,appfl.forwarded_dept_id, DATE_FORMAT(appfl.created_on,'%d %b %Y %T') as created_on ,appfl.verifier_user_comment,appfl.approv_status, DATE_FORMAT(appfl.comment_date,'%d %b %Y %T') as comment_date FROM bo_user_role_mapping rm
          INNER JOIN bo_application_verification_level appvl
          ON appvl.next_role_id = rm.role_id
          INNER JOIN bo_application_submission appsb
          ON appvl.app_sub_id=appsb.submission_id
          INNER JOIN bo_application_forward_level appfl
          ON appfl.app_Sub_id=appvl.app_sub_id
          INNER JOIN bo_user usr
          ON appsb.landrigion_id=usr.disctrict_id AND usr.uid=:user_id
          WHERE rm.user_id=:user_id AND is_mapping_active=:active AND appvl.approv_status=:app_status";
          $connection=Yii::app()->db;
          $command=$connection->createCommand($sql);
          $command->bindParam(":app_status",$app_status,PDO::PARAM_STR);
          $command->bindParam(":active",$active,PDO::PARAM_STR);
          $command->bindParam(":user_id",$user_id,PDO::PARAM_INT); */

        $appList = $command->queryAll();
        if ($appList === false)
            return false;
        return $appList;
    }

    /**
     * this function is used to find the previous role
     * @author: Hemant Thakur
     * @param: int
     * @return:
     */
    public static function getLastVerifierofApplication($app_sub_id) {
        $status = 'V';
        $sql = "SELECT appr_lvl_id FROM bo_application_verification_level WHERE app_Sub_id=:app_sub_id AND approv_status=:status ORDER BY appr_lvl_id DESC";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindParam(":status", $status, PDO::PARAM_STR);
        $command->bindParam(":app_sub_id", $app_sub_id, PDO::PARAM_INT);
        $appList = $command->queryAll();
        if ($appList === false)
            return false;
        return $appList[0];
    }

    /**
     * this function is used to find the current verifier
     * @author: Hemant Thakur
     * @param: int
     * @return:
     */
    public static function getCurrentVerifierofApplication($app_sub_id) {
        $status = 'P';
        $sql = "SELECT appr_lvl_id FROM bo_application_verification_level WHERE app_Sub_id=:app_sub_id AND approv_status=:status ORDER BY appr_lvl_id DESC";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindParam(":status", $status, PDO::PARAM_STR);
        $command->bindParam(":app_sub_id", $app_sub_id, PDO::PARAM_INT);
        $appList = $command->queryAll();
        if ($appList === false)
            return false;
        return $appList[0];
    }

    /**
     * to get Forwarded application 
     * @author : Hemant Thakur
     * @param: Dept_id
     */
    public static function getForwardedAppOfDept($dept_id) {

        $active = 'Y';
        $app_status = 'F';
        $pending = 'P';
        $uid = $_SESSION['uid'];
        $emailid = $_SESSION['email'];
        $role_id = RolesExt::getUserRoleViaId($uid);
        $distt = UserExt::getUsersAllDistt($emailid);

        $usersAllDistt = 0;
        if ($distt)
            $usersAllDistt = implode(",", $distt);
        $sql = "SELECT DISTINCT rm.role_id,appvl.app_sub_id,appsb.application_id,appsb.dept_id,appfl.forwarded_dept_id, DATE_FORMAT(appfl.created_on,'%d %b %Y %T') as created_on,appfl.verifier_user_comment,appfl.approv_status,appfl.appr_lvl_id FROM bo_user_role_mapping rm
				INNER JOIN bo_application_forward_level appfl ON appfl.next_role_id = rm.role_id
				INNER JOIN bo_application_submission appsb ON appfl.app_sub_id=appsb.submission_id
				INNER JOIN bo_application_verification_level appvl ON appsb.submission_id=appvl.app_Sub_id
				INNER JOIN bo_user usr ON appsb.landrigion_id=usr.disctrict_id
				INNER JOIN (
					select bo_application_forward_level.app_sub_id, max(bo_application_forward_level.created_on) as MaxDate
					from bo_application_forward_level
					where bo_application_forward_level.forwarded_dept_id=:dept_id group by bo_application_forward_level.app_sub_id
				) tm on appfl.app_sub_id= tm.app_sub_id and appfl.created_on= tm.MaxDate 	                  
                WHERE appfl.forwarded_dept_id=:dept_id  AND is_mapping_active=:active AND appsb.landrigion_id IN ($usersAllDistt) AND appfl.next_role_id=:role_id  AND appvl.approv_status=:app_status AND appfl.approv_status=:pending group by app_sub_id order by appfl.app_sub_id";
        //AND appfl.created_on >= appsb.application_updated_date_time
        /* 			$sql="SELECT DISTINCT rm.role_id,appvl.app_sub_id,appsb.application_id,appsb.dept_id,appfl.forwarded_dept_id,appfl.verifier_user_comment,appfl.approv_status FROM bo_user_role_mapping rm
          INNER JOIN bo_application_verification_level appvl
          ON appvl.next_role_id = rm.role_id
          INNER JOIN bo_application_submission appsb
          ON appvl.app_sub_id=appsb.submission_id
          INNER JOIN bo_application_forward_level appfl
          ON appfl.app_Sub_id=appvl.app_sub_id
          INNER JOIN bo_user usr
          ON appsb.landrigion_id=usr.disctrict_id
          WHERE appfl.forwarded_dept_id=:dept_id AND is_mapping_active=:active AND appvl.approv_status=:app_status AND appfl.approv_status=:pending and  usr.uid in (SELECT uid FROM bo_user where email=:emailid order by uid)"; */
        /* 			$sql="SELECT rm.role_id,appfl.app_sub_id,appsb.application_id,appsb.dept_id,appfl.forwarded_dept_id,appfl.verifier_user_comment,appfl.approv_status FROM bo_application_forward_level appfl
          INNER JOIN  bo_user_role_mapping rm
          ON appfl.next_role_id = rm.role_id
          INNER JOIN  bo_application_submission appsb
          ON appfl.app_sub_id=appsb.submission_id
          WHERE is_mapping_active=:active  AND appsb.application_status=:app_status AND appfl.approv_status=:pending AND rm.role_id=:role_id AND rm.user_id=:uid"; */
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindParam(":app_status", $app_status, PDO::PARAM_STR);
        $command->bindParam(":dept_id", $dept_id, PDO::PARAM_STR);
        $command->bindParam(":pending", $pending, PDO::PARAM_STR);
        $command->bindParam(":role_id", $role_id['role_id'], PDO::PARAM_INT);
        // $command->bindParam(":distt",$distt['disctrict_id'],PDO::PARAM_INT);
        //$command->bindParam(":uid",$uid,PDO::PARAM_INT);
        $command->bindParam(":active", $active, PDO::PARAM_STR);
        // $command->bindParam(":emailid",$emailid,PDO::PARAM_STR);
        $appList = $command->queryAll();
        /* echo "<pre>";
          print_r($appList);die; */
        if ($appList === false)
            return false;
        return $appList;
    }

    /**
     * This function is used to get all the Approved applications of the particulars id(on particular role id)
     * @author : Mohit Sharma
     * @Params : INT
     * @return: array 
     */
    public static function getMisAllApprovedApplications($approval_user_id, $next_role_id) {
        $active = 'Y';
        $app_status = 'A';
        // $uid=$_SESSION['uid'];
        $sql = "SELECT appsb.* from bo_application_submission appsb
					INNER JOIN bo_application_verification_level appvl
					ON appsb.submission_id=appvl.app_sub_id
					WHERE appsb.application_status='A' AND appvl.next_role_id=:next_role_id AND appvl.approval_user_id=:approval_user_id";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        //$command->bindParam(":app_status",$app_status,PDO::PARAM_STR);
        $command->bindParam(":next_role_id", $active, PDO::PARAM_INT);
        $command->bindParam(":approval_user_id", $user_id, PDO::PARAM_INT);
        $appList = $command->queryAll();
        if ($appList === false)
            return false;
        return $appList;
    }

// Added by Neha 16012018



    public static function getStateApplication($user_id) {
        $uid = $_SESSION['uid'];
        $aprvhold = "H";
        $apprP = "P";
        $active = "Y";
        $sql = "SELECT rm.role_id,appvl.app_sub_id,appsb.application_id,appsb.field_value,appsb.application_created_date,appsb.user_id,appvl.approv_status FROM bo_application_verification_level appvl
                INNER JOIN bo_application_submission appsb
                ON appvl.app_sub_id=appsb.submission_id
                INNER JOIN  bo_user_role_mapping rm
                ON appvl.next_role_id = rm.role_id AND rm.department_id=appsb.dept_id
                INNER JOIN bo_user usr
                ON usr.uid=:uid
                WHERE rm.user_id=:uid AND is_mapping_active=:active AND (appvl.approv_status=:apprP)";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        //$command->bindParam(":aprvhold",$aprvhold,PDO::PARAM_STR);
        $command->bindParam(":apprP", $apprP, PDO::PARAM_STR);
        $command->bindParam(":uid", $uid, PDO::PARAM_INT);
        $command->bindParam(":active", $active, PDO::PARAM_STR);
        // $command->bindParam(":uid",$user_id,PDO::PARAM_INT);
        $appList = $command->queryAll();
        if ($appList === false)
            return false;
        return $appList;
    }

    /**
     * This function is used to get all the incomplete applications of the particulars nodal
     * @author : Apoorv 
     * @Params : INT
     * @return: array 
     */
    public static function getIncompleteApplications($user_id) {
        $role_id = RolesExt::getUserRoleViaId($user_id);
        $dist = 0;

        $sql = "SELECT * from bo_user where uid =:user_id";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $user = $command->queryAll();
        $dist = $user[0]['disctrict_id'];
        $app_status = 'I';


        $sql = "SELECT * FROM bo_application_submission appsb WHERE appsb.application_status=:app_status and appsb.field_value like '%land_disctric" . '":"' . $dist . "%'";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindParam(":app_status", $app_status, PDO::PARAM_STR);
        $appList = $command->queryAll();
        if ($appList === false)
            return false;
        return $appList;
    }

    public static function getIncompleteApplicationsState($user_id) {
        $role_id = RolesExt::getUserRoleViaId($user_id);
        $dist = 0;

        $sql = "SELECT * from bo_user where uid =:user_id";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $user = $command->queryAll();

        if (isset($user['disctrict_id']))
            $dist = $user['disctrict_id'];
        //$dist = 9;



        $app_status = 'I';
        //$active='Y';
        $state_app = array();
        $sql = "SELECT * FROM bo_application_submission appsb WHERE appsb.application_status in ('I','H','B') ";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindParam(":app_status", $app_status, PDO::PARAM_STR);
        $appList = $command->queryAll();
        if (!empty($appList)) {
            foreach ($appList as $app) {
                if (!empty($app['field_value'])) {
                    $decode_app = json_decode($app['field_value']);
                }

                if (isset($decode_app->ntrofunit, $decode_app->ntrofunittype, $decode_app->invstmnt_in_plant[0]) && (($decode_app->ntrofunit == 'Manufacturing' && $decode_app->ntrofunittype == 'large' && $decode_app->invstmnt_in_plant[0] > 10) || ($decode_app->ntrofunit == 'Services' && $decode_app->ntrofunittype == 'large' && $decode_app->invstmnt_in_plant[0] > 5))) {
                    //print_r($appList);die;
                    $state_app[] = $app;
                }
            }
        }
        if ($state_app === false)
            return false;
        return $state_app;
    }

    //  End of adding ; NEHA 16012018
    /**
     * This function is used to get all the pending applications of the particulars departments(on particular role id)
     * @author : Hemant THakur
     * @Params : INT
     * @return: array 
     */
    public static function getAbeyanceApplications($user_id) {
        $active = 'Y';
        $app_status = 'AB';
        // $uid=$_SESSION['uid'];
        $sql_old = "SELECT rm.role_id,appvl.app_sub_id,appsb.application_id,appfl.forwarded_dept_id, DATE_FORMAT(appfl.created_on,'%d %b %Y %T') as created_on ,appfl.verifier_user_comment,appfl.approv_status, DATE_FORMAT(appfl.comment_date,'%d %b %Y %T') as comment_date FROM bo_user_role_mapping rm
				  INNER JOIN bo_application_abeyance_level appvl
				  ON appvl.next_role_id = rm.role_id
				  INNER JOIN bo_application_submission appsb
				  ON appvl.app_sub_id=appsb.submission_id
				  LEFT JOIN bo_application_forward_level appfl
				  ON appfl.app_Sub_id=appvl.app_sub_id
				  INNER JOIN bo_user usr
				  ON appsb.landrigion_id=usr.disctrict_id AND usr.uid=:user_id 
				  WHERE rm.user_id=:user_id AND is_mapping_active=:active AND appvl.approv_status=:app_status";

        $sql = "SELECT appsb.*,bd.distric_name as District, rm.role_id,appvl.app_sub_id,appsb.application_id,appfl.forwarded_dept_id, DATE_FORMAT(appfl.created_on,'%d %b %Y %T') as created_on ,appfl.verifier_user_comment,appsb.application_status,
 DATE_FORMAT(appfl.comment_date,'%d %b %Y %T') as comment_date 
FROM bo_user_role_mapping rm
				  inner join bo_application_abeyance_level appvl  ON appvl.next_role_id = rm.role_id
				  inner JOIN bo_application_submission appsb  ON appvl.app_sub_id=appsb.submission_id
				  left JOIN bo_application_forward_level appfl 	ON appfl.app_Sub_id=appvl.app_sub_id
				  inner JOIN bo_user usr  ON appsb.landrigion_id=usr.disctrict_id AND usr.uid=:user_id
				  LEFT JOIN bo_district bd ON appsb.landrigion_id = bd.district_id 
                                  WHERE rm.user_id=:user_id AND is_mapping_active=:active AND appsb.application_status=:app_status group by app_sub_id";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindParam(":app_status", $app_status, PDO::PARAM_STR);
        $command->bindParam(":active", $active, PDO::PARAM_STR);
        $command->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $appList = $command->queryAll();
        if ($appList === false)
            return false;
        return $appList;
    }

    public static function CafnewPendingApp($user_id) {
        //Merge caf 2.0 data from here
        /* echo "<pre>";
          print_r($_SESSION); */
        $role_id = $_SESSION['role_id'];
        $dept_id = $_SESSION['dept_id'];
        $email = $_SESSION['email'];
        $allData = Yii::app()->db->createCommand("SELECT id,service_id,current_role_id,next_role_id,processing_level FROM bo_infowiz_form_builder_configuration where service_id='591.0' AND current_role_id='$role_id'")->queryRow();
        //print_r($allData);die;
        $processing_level = $allData['processing_level'];
        $disctrict_id = '';
        /* if(isset($_SESSION['district_id'])){
          $disctrict_id = $_SESSION['district_id'];
          }else{ */
        //$sql_dis = "select * from bo_user where uid = $user_id";
        $sql_dis = "select GROUP_CONCAT(disctrict_id) as disctrict_id from bo_user inner join bo_user_role_mapping ON bo_user_role_mapping.user_id=bo_user.uid where email = '$email' and role_id=$role_id";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql_dis);
        $res_dis = $command->queryRow();
        /* } */
        if (!empty($res_dis)) {//echo "<pre>";print_r($res_dis);die;
            $disctrict_id = $res_dis['disctrict_id'];
        }
        $depart_user_id = $user_id;

        $sql = "SELECT bo_infowiz_formbuilder_application_forward_level.*,
					bo_new_application_submission.submission_id,
					bo_new_application_submission.field_value,
					bo_new_application_submission.service_id as serviceID,
					bo_district.distric_name as District, 
					bo_infowizard_issuerby_master.name as DepartmentName, 
					bo_information_wizard_service_parameters.core_service_name, 
					bo_new_application_submission.unit_name as unit_name,
					bo_new_application_submission.application_status as applicationCurrentStatus, 
					bo_new_application_submission.application_created_date as appliedOn	
					
					FROM bo_infowiz_formbuilder_application_forward_level  
					INNER JOIN bo_new_application_submission  
					ON bo_infowiz_formbuilder_application_forward_level.app_Sub_id=bo_new_application_submission.submission_id  
					INNER JOIN bo_district 
					ON bo_district.district_id=bo_new_application_submission.landrigion_id 
					INNER JOIN bo_information_wizard_service_parameters on bo_new_application_submission.service_id=concat(bo_information_wizard_service_parameters.service_id,'.',bo_information_wizard_service_parameters.servicetype_additionalsubservice) 
					INNER JOIN bo_information_wizard_service_master  on bo_information_wizard_service_parameters.service_id=bo_information_wizard_service_master.id
					INNER JOIN bo_infowizard_issuerby_master  ON bo_information_wizard_service_master.issuerby_id=bo_infowizard_issuerby_master.issuerby_id
					INNER JOIN bo_infowiz_form_builder_configuration on
					bo_infowiz_form_builder_configuration.processing_level = bo_new_application_submission.processing_level		
					where  
					bo_infowiz_formbuilder_application_forward_level.approv_status='P'			
					AND bo_infowiz_formbuilder_application_forward_level.next_role_id = $role_id
					AND bo_infowiz_formbuilder_application_forward_level.forwarded_dept_id = $dept_id
					AND  bo_infowiz_formbuilder_application_forward_level.verifier_user_comment=''
					AND 
					(CASE when bo_new_application_submission.processing_level='District' then bo_new_application_submission.landrigion_id IN($disctrict_id)
						ELSE bo_new_application_submission.landrigion_id >0 END) 
					AND bo_new_application_submission.processing_level='$processing_level'
					AND bo_new_application_submission.application_status IN('P','FA','F')
					GROUP BY bo_infowiz_formbuilder_application_forward_level.app_Sub_id
					";
        // 
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $newCafPendingData = $command->queryAll();

        if ($newCafPendingData === false)
            return false;
        return $newCafPendingData;
    }

    public static function CafnewPendingAppApprover($user_id) {
        //Merge caf 2.0 data from here
        $role_id = $_SESSION['role_id'];
        if (isset($_SESSION['district_id'])) {
            $disctrict_id = $_SESSION['district_id'];
        } else {
            $sql_dis = "select * from bo_user where uid = $user_id";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql_dis);
            $res_dis = $command->queryAll();
        }
        if (!empty($res_dis)) {//echo "<pre>";print_r($res_dis);die;
            $disctrict_id = $res_dis[0]['disctrict_id'];
        }
        //echo $disctrict_id;die;			
        $depart_user_id = $user_id;

        $allDistArr = Yii::app()->db->createCommand("select group_concat(district_id) as district_id from bo_district where district_id>0")->queryRow();

        $allDistList = $allDistArr['district_id'];

        $sql = "SELECT bo_infowiz_formbuilder_application_forward_level.*,
					bo_new_application_submission.submission_id,
					bo_new_application_submission.field_value,
					bo_new_application_submission.service_id as serviceID,
					bo_district.distric_name as District, 
					bo_infowizard_issuerby_master.name as DepartmentName, 
					bo_information_wizard_service_parameters.core_service_name, 
					bo_new_application_submission.unit_name as unit_name,
					bo_new_application_submission.application_status as applicationCurrentStatus, 
					bo_new_application_submission.application_created_date as appliedOn	
					
					FROM bo_infowiz_formbuilder_application_forward_level  
					INNER JOIN bo_new_application_submission  
					ON bo_infowiz_formbuilder_application_forward_level.app_Sub_id=bo_new_application_submission.submission_id  
					INNER JOIN bo_district 
					ON bo_district.district_id=bo_new_application_submission.landrigion_id 
					INNER JOIN bo_information_wizard_service_parameters on bo_new_application_submission.service_id=concat(bo_information_wizard_service_parameters.service_id,'.',bo_information_wizard_service_parameters.servicetype_additionalsubservice) 
					INNER JOIN bo_information_wizard_service_master  on bo_information_wizard_service_parameters.service_id=bo_information_wizard_service_master.id
					INNER JOIN bo_infowizard_issuerby_master  ON bo_information_wizard_service_master.issuerby_id=bo_infowizard_issuerby_master.issuerby_id
					INNER JOIN bo_infowiz_form_builder_configuration on
					bo_infowiz_form_builder_configuration.processing_level = bo_new_application_submission.processing_level		
					where  
					bo_infowiz_formbuilder_application_forward_level.approv_status='F'			
					AND bo_infowiz_formbuilder_application_forward_level.next_role_id = $role_id
					AND  bo_infowiz_formbuilder_application_forward_level.verifier_user_comment=''
					AND 
					(CASE when bo_new_application_submission.processing_level='District' then bo_new_application_submission.landrigion_id='$disctrict_id'
						ELSE bo_new_application_submission.landrigion_id >0 END)	  	 
					GROUP BY bo_infowiz_formbuilder_application_forward_level.app_Sub_id
					";
        //
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $newCafPendingData = $command->queryAll();

        if ($newCafPendingData === false)
            return false;
        return $newCafPendingData;
    }

    public static function getNewCafForwardedApplication($user_id) {
        //echo "<pre>";print_r($_SESSION);die;
        $user_id = @$_SESSION['uid'];
        $dept_id = @$_SESSION['dept_id'];
        $role_id = $_SESSION['role_id'];
        if (isset($_SESSION['district_id'])) {
            $disctrict_id = $_SESSION['district_id'];
        } else {
            $sql_dis = "select * from bo_user where uid = $user_id";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql_dis);
            $res_dis = $command->queryAll();
            if (!empty($res_dis)) {//echo "<pre>";print_r($res_dis);die;
                $disctrict_id = $res_dis[0]['disctrict_id'];
            }
        }

        $depart_user_id = $user_id;

        $sql = "SELECT bo_new_application_submission.submission_id,
bo_new_application_submission.unit_name as unit_name, 
bo_new_application_submission.service_id as serviceID,
bo_new_application_submission.application_status as applicationCurrentStatus, 
bo_new_application_submission.application_created_date as appliedOn, 
bo_infowiz_formbuilder_application_forward_level.verifier_user_comment,
bo_infowiz_formbuilder_application_forward_level.forwarded_dept_id,
bo_infowiz_formbuilder_application_forward_level.created_on as forwarded_date,
bo_district.distric_name as District,
bo_infowiz_formbuilder_application_forward_level.comment_date,
bo_infowizard_issuerby_master.name as DepartmentName 
FROM bo_infowiz_formbuilder_application_forward_level 
INNER JOIN bo_new_application_submission ON bo_infowiz_formbuilder_application_forward_level.app_Sub_id=bo_new_application_submission.submission_id
INNER JOIN bo_district ON bo_district.district_id=bo_new_application_submission.landrigion_id
INNER JOIN bo_infowiz_form_builder_application_log on bo_infowiz_form_builder_application_log.app_Sub_id = bo_new_application_submission.submission_id	
INNER JOIN bo_infowiz_form_builder_configuration on bo_infowiz_form_builder_configuration.processing_level = bo_new_application_submission.processing_level 
INNER JOIN bo_infowizard_issuerby_master ON bo_infowizard_issuerby_master.issuerby_id = bo_infowiz_formbuilder_application_forward_level.forwarded_dept_id
where bo_new_application_submission.application_status='F' AND bo_infowiz_form_builder_application_log.action_status = 'F' AND 
bo_infowiz_form_builder_application_log.department_user_id = '$depart_user_id' AND (CASE when bo_new_application_submission.processing_level='District' then bo_new_application_submission.landrigion_id='$disctrict_id' ELSE bo_new_application_submission.landrigion_id >0 END)
AND bo_new_application_submission.submission_id NOT IN (select bo_infowiz_formbuilder_application_forward_level.app_Sub_id 
from bo_infowiz_formbuilder_application_forward_level where bo_infowiz_formbuilder_application_forward_level.approv_status='P' 
and bo_infowiz_formbuilder_application_forward_level.next_role_id='$role_id') AND bo_infowiz_formbuilder_application_forward_level.forwarded_dept_id NOT IN ('$dept_id') 
GROUP BY bo_infowiz_formbuilder_application_forward_level.appr_lvl_id Order BY bo_new_application_submission.submission_id";


        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $res2 = $command->queryAll();
        if ($res2 === false)
            return false;
        return $res2;
    }

    public static function getNewCafRevertedApplication() {
        $user_id = @$_SESSION['uid'];
        $role_id = $_SESSION['role_id'];
        if (isset($_SESSION['district_id'])) {
            $disctrict_id = $_SESSION['district_id'];
        } else {
            $sql_dis = "select * from bo_user where uid = $user_id";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql_dis);
            $res_dis = $command->queryAll();
            if (!empty($res_dis)) {//echo "<pre>";print_r($res_dis);die;
                $disctrict_id = $res_dis[0]['disctrict_id'];
            }
        }
        $landrigion_idCon = "";
        if ($role_id != 4) {
            $landrigion_idCon = " AND bo_new_application_submission.landrigion_id='$disctrict_id' ";
        }

        $sql = "SELECT bo_new_application_submission.submission_id,bo_sp_applications.app_name,bo_new_application_submission.service_id from bo_new_application_submission left join bo_infowiz_formbuilder_application_forward_level ON bo_infowiz_formbuilder_application_forward_level.app_Sub_id
			=bo_new_application_submission.submission_id left join bo_sp_applications ON bo_sp_applications.app_id= bo_new_application_submission.submission_id where bo_new_application_submission.application_status='H' $landrigion_idCon AND bo_infowiz_formbuilder_application_forward_level.next_role_id='$role_id' 
			group by bo_new_application_submission.submission_id";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $res2 = $command->queryAll();
        if ($res2 === false)
            return false;
        return $res2;
    }

}
?>

