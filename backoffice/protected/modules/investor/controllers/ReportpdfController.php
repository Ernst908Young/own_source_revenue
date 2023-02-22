<?php

class ReportpdfController extends Controller
{

	public function actionTimelinepdf(){
		
		$name = "Time_line_".time().".pdf";			
		$heading = 'Time Line Report Level 1';

		if(isset($_GET['from_date']) && isset($_GET['to_date'])){
			$from_date = $_GET['from_date'];
			$to_date = $_GET['to_date'];
		}else{
			$from_date = $to_date = date('d-m-Y');
		}
		
		$service_id = isset($_GET['services_id']) ? $_GET['services_id'] : NULL;

		if($service_id){
			$sid = implode(',', $service_id);
			$sidsql = "AND nas.service_id IN ($sid)";
		}else{
			$sidsql = '';
		}
		$cuid = $_SESSION['RESPONSE']['user_id'];

		$records = Yii::app()->db->createCommand("SELECT nas.*, sp.service_id as s_id, sp.core_service_name FROM bo_new_application_submission as nas
				INNER JOIN bo_information_wizard_service_parameters sp ON CONCAT(sp.service_id,'.',sp.servicetype_additionalsubservice) = nas.service_id
				where DATE(nas.application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' $sidsql AND nas.user_id=$cuid group by nas.service_id")->queryAll();
		$content = $this->renderPartial('timelinepdf', ['from_date'=>$from_date,'to_date'=>$to_date,'records'=>$records,'service_id'=>$service_id], true);
		Reportformat::generatePdf($content,$name,$heading);	

	}
}