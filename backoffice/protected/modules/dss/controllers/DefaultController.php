<?php

class DefaultController extends Controller {

	public function actionDashboard(){

		$reg_entity = Yii::app()->db->createCommand("SELECT Count(id) as count From bo_company_details 
					where service_id IN ('2.0','4.0','5.0','6.0','8.0','9.0','10.0') ")->queryRow();
		$filings = Yii::app()->db->createCommand("SELECT  COUNT(submission_id) as count
						 From bo_new_application_submission")->queryRow();

		$t_count = Yii::app()->db->createCommand("SELECT COUNT(supportmaincode) as count					
						 From supportmain")->queryRow();
		$g_count = Yii::app()->db->createCommand("SELECT COUNT(id) as count						
			 From grievance")->queryRow();
		$q_count = Yii::app()->db->createCommand("SELECT COUNT(id) as count						
			 From querymain")->queryRow();
		$helpdesk = $t_count['count'] + $g_count['count'] + $q_count['count'];

		$service_fee = Yii::app()->db->createCommand("SELECT 			
					SUM(q.service_total_fee) as service_total_fee,			
					SUM(q.late_fee) as late_fee		
					FROM tbl_payment as q				
					where  q.payment_status IN ('success','Success')")->queryRow();
		$service_provider_late_fee = Yii::app()->db->createCommand("SELECT 			
			SUM(total_late_fee) as total_fee						
			FROM agent_service_provider_payment				
			where payment_status IN ('success','Success')")->queryRow();
		$vpd_fee = Yii::app()->db->createCommand("SELECT 			
			SUM(total_fee) as total_fee						
			FROM vpd_payment				
			where payment_status IN ('success','Success')")->queryRow();

		$revenue = $service_fee['service_total_fee']+$service_fee['late_fee']+$service_provider_late_fee['total_fee']+$vpd_fee['total_fee'];

		$sp_user_count = Yii::app()->db->createCommand("SELECT COUNT(user_id) as count						
						FROM sso_users
					where  sp_type IN ('Corporate Trust Service Provider (CTSP)','Corporate Representative (CR)')")->queryRow();

		$bouser_analysis = Yii::app()->db->createCommand("SELECT 			
					COUNT(submission_id) as submission_id								
					FROM bo_new_application_submission				
					where application_status IN ('A','FA','H','R','RS')")->queryRow();

		$this->render('dashboard',['reg_entity_count'=>$reg_entity['count'],'filings_count'=>$filings['count'],'helpdesk_count'=>$helpdesk,'total_revenue'=>$revenue,'sp_user_count'=>$sp_user_count['count'],
				'bouser_analysis'=>$bouser_analysis['submission_id']]);
	}

	public function actionIndex($category){
		$category = isset($_GET['category']) ? $_GET['category'] : NULL;
		$sub_category = isset($_GET['sub_category']) ? $_GET['sub_category'] : NULL;
		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		if(isset($_GET['year'])){
			$year = $_GET['year'];
		}else{
			$year = 5;
		}

		
			if($sub_category!=NULL || $sub_category!=""){
				$this->redirect(['level2','otd'=>'dss','category'=>$category,'sub_category'=>$sub_category,'from_date'=>$from_date,'to_date'=>$to_date]);
			}else{
				$data_array = $this->level1data($category,$from_date,$to_date,$year);
			}
		
		$this->render('index',['from_date'=>$from_date,'to_date'=>$to_date,'category'=>$category,'sub_category'=>$sub_category,'year'=>$year,'data_array'=>$data_array]);
	}

	public function actionLevel2(){
		$category = isset($_GET['category']) ? $_GET['category'] : NULL;
		$sub_category = isset($_GET['sub_category']) ? $_GET['sub_category'] : NULL;
		$from_date = isset($_GET['from_date']) ? $_GET['from_date'] : NULL;
		$to_date = isset($_GET['to_date']) ? $_GET['to_date'] : NULL;
			
		

		$data_array = $this->level2data($category,$sub_category,$from_date,$to_date);	


		$this->render('level2',['from_date'=>$from_date,'to_date'=>$to_date,'category'=>$category,'sub_category'=>$sub_category,'data_array'=>$data_array]);
	}

	protected function level1data($category,$from_date,$to_date,$year){
		$pre_year = date('Y-m-d', strtotime('-$year month'));
		switch ($category) {
			case 'entities':
				$active_entity = Yii::app()->db->createCommand("SELECT Count(id) as count From bo_company_details 
					where service_id IN ('2.0','4.0','5.0','6.0','8.0','9.0','10.0') AND is_active=1 AND DATE(created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."'")->queryRow();

				// companies & societies
				$dissolved_entity = Yii::app()->db->createCommand("SELECT Count(id) as count From bo_company_details where service_id IN ('4.0','5.0','8.0','9.0') AND is_active=0 AND DATE(created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."'")->queryRow();

				// Business name Cessation
				$closed_entity = Yii::app()->db->createCommand("SELECT Count(id) as count From bo_company_details where service_id IN ('2.0') AND is_active=0 AND DATE(created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."'")->queryRow();

				//amalgamated services records
				$amalgamated_entity = Yii::app()->db->createCommand("SELECT Count(id) as count From bo_company_details where service_id IN ('37.0','38.0') AND is_active=1 AND DATE(created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."'")->queryRow();

				$entity_category_wise = Yii::app()->db->createCommand("SELECT 
					Count(CASE WHEN service_id IN ('2.0','4.0','5.0','6.0','8.0','9.0','10.0') then 1 ELSE NULL end) as total_reg,
					COUNT(CASE when service_id IN ('4.0','5.0','8.0')  then 1 ELSE NULL end) as reg_comp,
					COUNT(CASE when service_id IN ('2.0')  then 1 ELSE NULL end) as reg_bus_name,
					COUNT(CASE when service_id IN ('6.0')  then 1 ELSE NULL end) as reg_charity,
					COUNT(CASE when service_id IN ('9.0')  then 1 ELSE NULL end) as reg_society,
					COUNT(CASE when service_id IN ('10.0')  then 1 ELSE NULL end) as reg_firm
					From bo_company_details WHERE  DATE(created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."'")->queryRow();

				

				$year_data = Yii::app()->db->createCommand("SELECT COUNT(id) as count, Year(created_on) as year From bo_company_details where service_id in ('2.0','4.0','5.0','6.0','8.0','9.0','10.0') AND DATE(created_on) BETWEEN '".date('Y-m-d',strtotime($pre_year))."' AND '".date('Y-m-d')."' GROUP BY Year(created_on) ")->queryAll();

				$data_array = ['active_entity'=>$active_entity['count'],'dissolved_entity'=>$dissolved_entity['count'],'closed_entity'=>$closed_entity['count'],'amalgamated_entity'=>$amalgamated_entity['count'],'entity_category_wise'=>$entity_category_wise,'year_data'=>$year_data];
				
				break;

				case 'filings':
					$app_count = Yii::app()->db->createCommand("SELECT 
						COUNT(CASE when application_status='H'  then 1 ELSE NULL end) as reverted,
						COUNT(CASE when application_status='R'  then 1 ELSE NULL end) as rejected,
						COUNT(CASE when application_status='A'  then 1 ELSE NULL end) as approved
						 From bo_new_application_submission 
					where  DATE(application_updated_date_time) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."'")->queryRow();

					$year_data = Yii::app()->db->createCommand("SELECT COUNT(submission_id) as count, Year(application_created_date) as year From bo_new_application_submission where DATE(application_created_date) BETWEEN '".date('Y-m-d',strtotime($pre_year))."' AND '".date('Y-m-d')."' GROUP BY Year(application_created_date) ")->queryAll();

					$data_array = ['app_count'=>$app_count,'year_data'=>$year_data];
					break;

				case 'helpdesk':
					$t_count = Yii::app()->db->createCommand("SELECT 
						COUNT(supportmaincode) as count						
						 From supportmain 
					where  DATE(created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."'")->queryRow();

					$g_count = Yii::app()->db->createCommand("SELECT 
						COUNT(id) as count						
						 From grievance 
					where  DATE(created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."'")->queryRow();

					$q_count = Yii::app()->db->createCommand("SELECT 
						COUNT(id) as count						
						 From querymain 
					where  DATE(created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."'")->queryRow();

					$t_year_data = Yii::app()->db->createCommand("SELECT COUNT(supportmaincode) as count, Year(created_on) as year From supportmain where DATE(created_on) BETWEEN '".date('Y-m-d',strtotime($pre_year))."' AND '".date('Y-m-d')."' GROUP BY Year(created_on) ")->queryAll();

					$g_year_data = Yii::app()->db->createCommand("SELECT COUNT(id) as count, Year(created_on) as year From grievance where DATE(created_on) BETWEEN '".date('Y-m-d',strtotime($pre_year))."' AND '".date('Y-m-d')."' GROUP BY Year(created_on) ")->queryAll();

					$q_year_data = Yii::app()->db->createCommand("SELECT COUNT(id) as count, Year(created_on) as year From querymain where DATE(created_on) BETWEEN '".date('Y-m-d',strtotime($pre_year))."' AND '".date('Y-m-d')."' GROUP BY Year(created_on) ")->queryAll();


					$data_array = ['t_count'=>$t_count['count'],'g_count'=>$g_count['count'],'q_count'=>$q_count['count'],'year_data'=>['t_year_data'=>$t_year_data,'g_year_data'=>$g_year_data,'q_year_data'=>$q_year_data]];
					break;
			
			case 'revenue':
				$service_fee = Yii::app()->db->createCommand("SELECT 			
					SUM(q.service_total_fee) as service_total_fee,			
					SUM(q.late_fee) as late_fee		
					FROM tbl_payment as q				
					where DATE(q.created_at) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' 
						AND q.payment_status IN ('success','Success')")->queryRow();

				$service_provider_late_fee = Yii::app()->db->createCommand("SELECT 			
					SUM(total_late_fee) as total_fee						
					FROM agent_service_provider_payment				
					where DATE(created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' 
						AND payment_status IN ('success','Success')")->queryRow();

				$vpd_fee = Yii::app()->db->createCommand("SELECT 			
					SUM(total_fee) as total_fee						
					FROM vpd_payment				
					where DATE(created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' 
						AND payment_status IN ('success','Success')")->queryRow();

				$service_fee_year = Yii::app()->db->createCommand("SELECT 			
					SUM(q.service_total_fee) as service_total_fee,			
					SUM(q.late_fee) as late_fee,
					Year(q.created_at) as year		
					FROM tbl_payment as q				
					where DATE(q.created_at) BETWEEN '".date('Y-m-d',strtotime($pre_year))."' AND '".date('Y-m-d')."' 
						AND q.payment_status IN ('success','Success') GROUP BY Year(q.created_at)")->queryAll();

				$service_provider_late_fee_year = Yii::app()->db->createCommand("SELECT 			
					SUM(total_late_fee) as total_fee,
					Year(created_on) as year						
					FROM agent_service_provider_payment				
					where DATE(created_on) BETWEEN '".date('Y-m-d',strtotime($pre_year))."' AND '".date('Y-m-d')."' 
						AND payment_status IN ('success','Success') GROUP BY Year(created_on)")->queryAll();

				$vpd_fee_year = Yii::app()->db->createCommand("SELECT 			
					SUM(total_fee) as total_fee,
					Year(created_on) as year						
					FROM vpd_payment				
					where DATE(created_on) BETWEEN '".date('Y-m-d',strtotime($pre_year))."' AND '".date('Y-m-d')."' 
						AND payment_status IN ('success','Success') GROUP BY Year(created_on)")->queryAll();
				$data_array = ['service_fee'=>$service_fee,'service_provider_late_fee'=>$service_provider_late_fee,'vpd_fee'=>$vpd_fee,'year_data'=>['service_fee_year'=>$service_fee_year,'service_provider_late_fee_year'=>$service_provider_late_fee_year,'vpd_fee_year'=>$vpd_fee_year]];
			break;
			
			case 'service provider':
				$sp_user_count = Yii::app()->db->createCommand("SELECT 
						COUNT(CASE when sp_type='Corporate Trust Service Provider (CTSP)' AND is_account_active='Y'  then 1 ELSE NULL end) as ctsp_active,
						COUNT(CASE when sp_type='Corporate Representative (CR)' AND is_account_active='Y'  then 1 ELSE NULL end) as cr_active,
						COUNT(CASE when sp_type='Corporate Trust Service Provider (CTSP)' AND is_account_active='N'  then 1 ELSE NULL end) as ctsp_deactive,
						COUNT(CASE when sp_type='Corporate Representative (CR)' AND is_account_active='N'  then 1 ELSE NULL end) as cr_deactive
						FROM sso_users
					where  DATE(created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."'")->queryRow();
				
				$year_data = Yii::app()->db->createCommand("SELECT 			
					COUNT(user_id) as sp_count,
					Year(created_on) as year						
					FROM sso_users				
					where DATE(created_on) BETWEEN '".date('Y-m-d',strtotime($pre_year))."' AND '".date('Y-m-d')."' AND sp_type IN ('Corporate Trust Service Provider (CTSP)','Corporate Representative (CR)')
						 GROUP BY Year(created_on)")->queryAll();

				$data_array = ['sp_user_count'=>$sp_user_count,'year_data'=>$year_data];
			break;

			case 'BO user analysis':
					$sql="SELECT 
					COUNT(submission_id) as submission_id,
					COUNT(CASE when application_status='FA' then 1 ELSE NULL end) as fa_app,
			        COUNT(CASE when application_status='A' then 1 ELSE NULL end) as approved_app,
			        COUNT(CASE when application_status='H' then 1 ELSE NULL end) as reverted_app,
			        COUNT(CASE when application_status IN ('R','RS') then 1 ELSE NULL end) as rejected_app
			        
			        FROM   bo_new_application_submission
			         
			        where  DATE(application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."'";
			        
			        $connection=Yii::app()->db; 
			        $command=$connection->createCommand($sql);
			        $res = $command->queryRow();

			        $year_data = Yii::app()->db->createCommand("SELECT 			
					COUNT(submission_id) as submission_id,
					Year(application_created_date) as year						
					FROM bo_new_application_submission				
					where DATE(application_created_date) BETWEEN '".date('Y-m-d',strtotime($pre_year))."' AND '".date('Y-m-d')."' 
					AND application_status IN ('A','FA','H','R','RS')
						 GROUP BY Year(application_created_date)")->queryAll();

				$data_array = ['res'=>$res,'year_data'=>$year_data];	
			break;

			default:
				$data_array = [];	
				break;
		}

		return $data_array;
	}

	protected function level2data($category,$sub_category,$from_date,$to_date){
		$data_array = [];
		if($category=='entities'){
			switch ($sub_category) {
				case 'companies':
					$serv_id_cond = "AND service_id IN ('4.0','5.0','8.0')";
					$dis_ser_id_con = "AND service_id IN ('4.0','5.0','8.0')";
					$col_ser_id_con = NULL;
					$alamg_service_id_con = "AND service_id IN ('37.0')";					
				break;
				case 'business names':
					$serv_id_cond = "AND service_id IN ('2.0')";
					$dis_ser_id_con = NULL;
					$col_ser_id_con = "AND service_id IN ('2.0')";
					$alamg_service_id_con = NULL;					
				break;
				case 'firms':
					$serv_id_cond = "AND service_id IN ('10.0')";
					$dis_ser_id_con = NULL;
					$col_ser_id_con = NULL;
					$alamg_service_id_con = NULL;					
				break;
				case 'societies':
					$serv_id_cond = "AND service_id IN ('9.0')";
					$dis_ser_id_con = "AND service_id IN ('9.0')";
					$col_ser_id_con = NULL;
					$alamg_service_id_con = "AND service_id IN ('38.0')";					
				break;
				case 'charities':
					$serv_id_cond = "AND service_id IN ('6.0')";
					$dis_ser_id_con = NULL;
					$col_ser_id_con = NULL;
					$alamg_service_id_con = NULL;					
				break;
				default:
					$serv_id_cond = NULL;
					$dis_ser_id_con = NULL;
					$col_ser_id_con = NULL;
					$alamg_service_id_con = NULL;	
				break;
			}

				if($serv_id_cond){
					$active_entity = Yii::app()->db->createCommand("SELECT Count(id) as count From bo_company_details 
					where is_active=1 $serv_id_cond AND DATE(created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."'")->queryRow();
				}else{
					$active_entity['count'] = 0;
				}
				

				// companies & societies
				if($dis_ser_id_con){
				$dissolved_entity = Yii::app()->db->createCommand("SELECT Count(id) as count From bo_company_details where is_active=0 $dis_ser_id_con AND DATE(created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."'")->queryRow();
				}else{
					$dissolved_entity['count'] = 0;
				}

				// Business name Cessation
				if($col_ser_id_con){
				$closed_entity = Yii::app()->db->createCommand("SELECT Count(id) as count From bo_company_details where is_active=0 $col_ser_id_con AND DATE(created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."'")->queryRow();
				}else{
					$closed_entity['count'] = 0;
				}

				//amalgamated services records
				if($alamg_service_id_con){
				$amalgamated_entity = Yii::app()->db->createCommand("SELECT Count(id) as count From bo_company_details where is_active=1 $alamg_service_id_con AND DATE(created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."'")->queryRow();
				}else{
					$amalgamated_entity['count'] = 0;
				}

				$data_array = ['active_entity'=>$active_entity,'dissolved_entity'=>$dissolved_entity,'closed_entity'=>$closed_entity,'amalgamated_entity'=>$amalgamated_entity];
		}

		if($category=='helpdesk'){
			switch ($sub_category) {
				case 'tickets':
					$t_count = Yii::app()->db->createCommand("SELECT 
						COUNT(supportmaincode) as count,
						COUNT(CASE when status IN ('O')  then 1 ELSE NULL end) as open,
						COUNT(CASE when status IN ('RS','C')  then 1 ELSE NULL end) as resol_close,
						COUNT(CASE when status IN ('RV')  then 1 ELSE NULL end) as rever,
						COUNT(CASE when status IN ('RO')  then 1 ELSE NULL end) as reopen,
						COUNT(CASE when status IN ('ESC')  then 1 ELSE NULL end) as esc	
						 From supportmain 
					where  DATE(created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."'")->queryRow();
					$data_array = $t_count;				
				break;
				case 'grievances':
					$g_count = Yii::app()->db->createCommand("SELECT 
						COUNT(id) as count,
						COUNT(CASE when status IN ('O')  then 1 ELSE NULL end) as open,
						COUNT(CASE when status IN ('RS','C')  then 1 ELSE NULL end) as resol_close,
						COUNT(CASE when status IN ('RV')  then 1 ELSE NULL end) as rever,
						COUNT(CASE when status IN ('RO')  then 1 ELSE NULL end) as reopen,
						COUNT(CASE when status IN ('ESC')  then 1 ELSE NULL end) as esc						
						 From grievance 
					where  DATE(created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."'")->queryRow();	
					$data_array = $g_count;			
				break;
				case 'queries':
					$q_count = Yii::app()->db->createCommand("SELECT 
						COUNT(id) as count,
						COUNT(CASE when status IN (1)  then 1 ELSE NULL end) as open,
						COUNT(CASE when status IN (0)  then 1 ELSE NULL end) as resol_close						
						 From querymain 
					where  DATE(created_on) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."'")->queryRow();
					$data_array = $q_count;			
				break;
				
				default:
					$data_array = [];
				break;
			}
		}
		return $data_array;
	}

	public function actionPrintpdf(){

		$category = isset($_GET['category']) ? $_GET['category'] : NULL;
		$name = "DSS_".$category."_Summary_".time().".pdf";			
		$heading = 'DSS '.$category.' Summary';

		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		

		if($category){			
			$search_criteria = '<b>Category :</b> '.$category;
		}else{			
			$search_criteria = '<b>Category : </b>NA';
		}

		
		$data_array = $this->level1data($category,$from_date,$to_date,NULL);
		$content = $this->renderPartial('dsspdf',['data_array'=>$data_array,'category'=>$category], true);

		

		
		$bargraphdata = isset($_POST['bargraphdata']) ? $_POST['bargraphdata'] : NULL;
		$line_graph_data = isset($_POST['linegraphdata']) ? $_POST['linegraphdata'] : NULL;		
		$piechartdata = isset($_POST['piechartdata']) ? $_POST['piechartdata'] : NULL;
		$donutchartdata = isset($_POST['donutchartdata']) ? $_POST['donutchartdata'] : NULL;
		$multilinegraphdata = isset($_POST['multilinegraphdata']) ? $_POST['multilinegraphdata'] : NULL;
		$multibargraphdata = isset($_POST['multibargraphdata']) ? $_POST['multibargraphdata'] : NULL;
		

		Reportformat::generatedssPdf_l_wg($content, $line_graph_data, $bargraphdata, $piechartdata,
 		$donutchartdata,$multilinegraphdata,$multibargraphdata,$name,$heading,$from_date,$to_date,$search_criteria,true,true);
	}


	public function actionLevel2pdf(){
		$category = isset($_GET['category']) ? $_GET['category'] : NULL;
		$subcategory = isset($_GET['sub_category']) ? $_GET['sub_category'] : NULL;
		$name = "DSS_".$category."_".$subcategory."_Summary_".time().".pdf";			
		$heading = 'DSS '.$category.' - '.$subcategory.'  Summary Report';

		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}

		

		if($category){			
			$search_criteria = '<b>Category :</b> '.$category;
		}else{			
			$search_criteria = '<b>Category : </b>NA';
		}

		if($category){			
			$search_criteria.= ' <b>Sub Category :</b> '.$subcategory;
		}else{			
			$search_criteria.= ' <b>Sub Category : </b>NA';
		}

		$data_array = $this->level2data($category,$subcategory,$from_date,$to_date);		
		$content = $this->renderPartial('dsspdflevel2',['data_array'=>$data_array,'category'=>$category,'sub_category'=>$subcategory], true);

		

		
		$bargraphdata = isset($_POST['bargraphdata']) ? $_POST['bargraphdata'] : NULL;
		$line_graph_data = isset($_POST['linegraphdata']) ? $_POST['linegraphdata'] : NULL;		
		$piechartdata = isset($_POST['piechartdata']) ? $_POST['piechartdata'] : NULL;
		$donutchartdata = isset($_POST['donutchartdata']) ? $_POST['donutchartdata'] : NULL;
		$multilinegraphdata = isset($_POST['multilinegraphdata']) ? $_POST['multilinegraphdata'] : NULL;
	
		

		Reportformat::generatedssPdf_l_wg($content, $line_graph_data, $bargraphdata, $piechartdata,
 		$donutchartdata,$multilinegraphdata,$name,$heading,$from_date,$to_date,$search_criteria,true,true);
	}

}