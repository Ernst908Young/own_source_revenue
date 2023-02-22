<?php
 /**
	* 26-10-2017
    * @author: Santosh Kumar
    * @return:
    * @param:
    **/
class OfflineApplicationController extends Controller
{
	public function actionIndex()
	{
		
		echo "Nothing found";
	}
	
	/**
	* 26-10-2017
    * @author: Santosh Kumar
    * @return:
    * @param:
    **/
	
	public function actionListing(){
		@session_start();
		if(!Yii::app()->user->isGuest){
			throw new CHttpException(400, "you can't access this page");
		}
		if(!$_SESSION['LOGGED_IN'])
			$this->redirect(SSO_URL1);
		
		$user_id = $_SESSION['RESPONSE']['user_id'];
		$iuid 	 = $_SESSION['RESPONSE']['iuid'];
		$datas=array();
		
		$sql_d = "SELECT a.sno,a.app_name,a.app_status,a.created_on,a.user_id,a.caf_id,oa.offline_application_reference_number FROM bo_sp_applications as a 
					INNER JOIN bo_offline_applications as oa ON oa.offline_application_id=a.offline_application_id
					WHERE a.user_id='$user_id' AND a.is_offline_application='Y' AND a.offline_application_id IS NOT NULL ORDER BY a.sno DESC";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql_d);
		$datas = $command->queryAll();
		
		$this->render("application_listing",array('datas'=>$datas,'user_id'=>$user_id));
	}
	
	public function actionPreview(){
		@session_start();
		if(!Yii::app()->user->isGuest){
			throw new CHttpException(400, "you can't access this page");
		}
		if(!$_SESSION['LOGGED_IN'])
			$this->redirect(SSO_URL1);
		
		$user_id = $_SESSION['RESPONSE']['user_id'];
		$iuid 	 = $_SESSION['RESPONSE']['iuid'];
		@extract($_GET);
		$ref = base64_decode($ref);
		$sql = "SELECT * FROM bo_offline_applications as oa WHERE user_id='$user_id' AND offline_application_reference_number='$ref'";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$appDatas = $command->queryRow();
		if($appDatas){
			$service_id=$appDatas['service_id'];
			$sub_service_id=$appDatas['sub_service_id'];
			$appID=$appDatas['offline_application_id'];
			
			$sql_d = "SELECT * FROM bo_information_wizard_service_parameters WHERE service_id='$service_id' AND servicetype_additionalsubservice='$sub_service_id' ORDER BY service_id ASC LIMIT 1";
			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql_d);
			$res_s = $command->queryRow();
			//echo '<pre>'; print_r($res_s);
			$document_checklist_creation = $res_s['document_checklist_creation'];
			$mapped_documents_array = json_decode($document_checklist_creation,true);
			
			$sql_app = "SELECT * FROM bo_offline_applications WHERE offline_application_id='$appID' ORDER BY offline_application_id DESC LIMIT 1";
			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql_app);
			$res_app = $command->queryRow();
			
			$sql_app_docs = "SELECT * FROM bo_offline_applications_other_documents WHERE offline_application_id='$appID' ORDER BY id ASC";
			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql_app_docs);
			$res_app_docs = $command->queryAll();
			
			$sql_app_pay = "SELECT * FROM bo_offline_applications_payment WHERE offline_application_id='$appID' ORDER BY payment_id DESC";
			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql_app_pay);
			$res_app_pay = $command->queryAll();
			
			$sql_sp_app = "SELECT * FROM bo_sp_applications WHERE offline_application_id='$appID' ORDER BY offline_application_id DESC LIMIT 1";
			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql_sp_app);
			$res_sp_app = $command->queryRow();
			
			
			$this->render("application_preview",array('mapped_documents_array'=>$mapped_documents_array, 'iuid'=>$iuid,'res_app_docs'=>$res_app_docs,'res_app'=>$res_app, 'res_app_pay'=>$res_app_pay,'res_sp_app'=>$res_sp_app));
		}
		
	}
	
	
	
}
?>
