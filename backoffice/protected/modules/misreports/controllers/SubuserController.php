<?php

class SubuserController extends Controller {

	public function actionLevel1(){
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
		$status = '';
		$sp_status = '';
		if(isset($_GET['sp_status'])){
			if($_GET['sp_status']!=''){
				$status = "AND sum.sp_status='".$_GET['sp_status']."'";
				$sp_status = $_GET['sp_status'];
			}			
		}

		$company_id = $comp_sql = '';
		if(isset($_GET['company_id'])){
			if($_GET['company_id']!=''){
				$company_id = $_GET['company_id'];
				$comp_sql = "AND  a.company_id=$company_id";
			}		
		}

		$records = Yii::app()->db->createCommand("
					SELECT sum.id,sum.sub_user_id,sum.sp_status,sum.created_on,sum.action_date,
             		(CASE
			            WHEN sum.sub_user_id = 0 
			                THEN (CONCAT(sum.first_name,' ',sum.middle_name,' ',sum.surname))
			                  ELSE (SELECT CONCAT(p.first_name,' ',p.last_name,' ',p.surname) FROM sso_profiles p 
								WHERE sum.sub_user_id=p.user_id)
			             END) as subuser_name, c.company_name
					FROM agent_service_provider_sub_user_mapping sum
					INNER JOIN agent_service_provider a ON sum.asp_id=a.id
					INNER JOIN bo_company_details c ON a.company_id=c.id
					where DATE(sum.created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' $status $comp_sql")->queryAll();
		$this->render('level1',['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'sp_status'=>$sp_status,'company_id'=>$company_id]);

	
	}

	

	public function actionLevel1pdf(){
		$name = "subuser_report_level1".time().".pdf";			
		$heading = 'Sub User Report Level 1';
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
		
		
		
		if(isset($_GET['sp_status'])){
			if($_GET['sp_status']!=''){
				$status = "AND sum.sp_status='".$_GET['sp_status']."'";
				 switch ($_GET['sp_status']) {
			          	case 'N':
			            $sp_status = 'Nominated';
			            break;
			             case 'O':
			            $sp_status = 'Onboarded';
			            break;
			             case 'R':
			            $sp_status = 'Removed';
			            break;
			             case 'DA':
			            $sp_status = 'Deactivated';
			            break;
			             
			             case 'NW':
			            $sp_status = 'Nomination withdrawn';
			            break;
			          
			          default:
			            $sp_status = '';
			            break;
			        }
         
				$status_search_criteria = '<b>Sub User Status : </b> '.$sp_status;
			}else{
				$status = '';
				$status_search_criteria = '<b>Sub User Status : </b>All';
			}
			
		}else{
			$status = '';
		}

		if(isset($_GET['company_id'])){
			if($_GET['company_id']!=''){
				$comp_sql = "AND  a.company_id=".$_GET['company_id'];
				$comd = Yii::app()->db->createCommand("SELECT * FROM bo_company_details where id=".$_GET['company_id'])->queryRow();
				$company_search_criteria = '<br><b>Select Entity : </b> '.@$comd['company_name'];
			}else{
				$comp_sql = '';
				$company_search_criteria = '<br><b>Select Entity : </b>';
			}
			
		}else{
			$comp_sql = '';
		}


		$records = Yii::app()->db->createCommand("
					SELECT sum.id,sum.sub_user_id,sum.sp_status,sum.created_on,sum.action_date,
             		(CASE
			            WHEN sum.sub_user_id = 0 
			                THEN (CONCAT(sum.first_name,' ',sum.middle_name,' ',sum.surname))
			                  ELSE (SELECT CONCAT(p.first_name,' ',p.last_name,' ',p.surname) FROM sso_profiles p 
								WHERE sum.sub_user_id=p.user_id)
			             END) as subuser_name, c.company_name
					FROM agent_service_provider_sub_user_mapping sum
					INNER JOIN agent_service_provider a ON sum.asp_id=a.id
					INNER JOIN bo_company_details c ON a.company_id=c.id
					where DATE(sum.created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' $status $comp_sql")->queryAll();

		$content = $this->renderPartial('level1pdf', ['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records], true);
		$search_criteria = 	$status_search_criteria.$company_search_criteria;
		Reportformat::generatePdf_l($content,$name,$heading,$from_date,$to_date,$search_criteria);
		
	}

	public function actionLevel2(){
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
		$sum_id = $_GET['sum_id'];
		$sub_user_id = $_GET['sub_user_id'];
		$sp_status = $_GET['sp_status'];
		$company_id = $_GET['company_id'];
		



		$records= Yii::app()->db->createCommand("SELECT nas.submission_id, nas.application_status, nas.application_created_date, CONCAT(p.first_name,' ',p.last_name,' ',p.surname) as app_name, u.email as app_email, c.company_name, sc.service_name, nas.field_value, nas.service_id 
			FROM bo_new_application_submission nas
			INNER JOIN sso_users u ON nas.user_id = u.user_id
			INNER JOIN sso_profiles p ON u.user_id = p.user_id
			LEFT OUTER JOIN bo_company_details c ON c.reg_no=nas.entity_name
			inner join bo_information_wizard_service_master as sc on nas.service_id = sc.id 
			WHERE DATE(nas.application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' AND sub_user_id=$sub_user_id")->queryAll();

		$this->render('level2',['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'sum_id'=>$sum_id,'sub_user_id'=>$sub_user_id,'sp_status'=>$sp_status,'company_id'=>$company_id]);

	}

	public function actionLevel2pdf(){
		$name = "subuser_report_level2".time().".pdf";			
		$heading = 'Sub User Report Level 2';
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
		$sum_id = $_GET['sum_id'];
		$sub_user_id = $_GET['sub_user_id'];
		

		$subuser = Yii::app()->db->createCommand("
          SELECT sum.id,sum.sub_user_id,sum.sp_status,sum.created_on,sum.action_date,
          CONCAT(p.first_name,' ',p.last_name,' ',p.surname) as subuser_name, c.company_name
          FROM agent_service_provider_sub_user_mapping sum
          INNER JOIN agent_service_provider a ON sum.asp_id=a.id
          INNER JOIN sso_profiles p on sum.sub_user_id=p.user_id
          INNER JOIN bo_company_details c ON a.company_id=c.id
          where sum.id=$sum_id")->queryRow();

		$search_criteria = "<b>Sub User Name:</b> ".$subuser['subuser_name'];

	  if($subuser['sp_status']=='N') {$status = 'Nominated';}
            else if($subuser['sp_status']=='O') {$status = 'Onboarded';}
            else if($subuser['sp_status']=='R') {$status = 'Removed';}
            else{$status ="";}
            
		$search_criteria.= "<br><b>Current Status:</b> ".$status;
		$search_criteria.= "<br><b>Entity Assign:</b> ".$subuser['company_name'];

		$records= Yii::app()->db->createCommand("SELECT nas.submission_id, nas.application_status, nas.application_created_date, CONCAT(p.first_name,' ',p.last_name,' ',p.surname) as app_name, u.email as app_email, c.company_name, sc.service_name, nas.field_value, nas.service_id 
			FROM bo_new_application_submission nas
			INNER JOIN sso_users u ON nas.user_id = u.user_id
			INNER JOIN sso_profiles p ON u.user_id = p.user_id
			LEFT OUTER JOIN bo_company_details c ON c.reg_no=nas.entity_name
			inner join bo_information_wizard_service_master as sc on nas.service_id = sc.id 
			WHERE DATE(nas.application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' AND sub_user_id=$sub_user_id")->queryAll();

		$content = $this->renderPartial('level2pdf', ['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records], true);
		
		Reportformat::generatePdf_l($content,$name,$heading,$from_date,$to_date,$search_criteria);

	}
	
}