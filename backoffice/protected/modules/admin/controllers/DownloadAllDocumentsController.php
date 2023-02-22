<?php

class DownloadAllDocumentsController extends Controller
{
	public function actionIndex()
	{
		if(isset($_POST['Applications'])){
			$app_sub_id=$_POST['Applications']['application_id'];
			$criteria=new CDbCriteria();
			$criteria->condition="submission_id=:app_sub_id";
			$criteria->params=array("app_sub_id"=>$app_sub_id);
			$model=ApplicationSubmission::model()->find($criteria);
			if(empty($model)){
				Yii::app()->user->setFlash('Error', 'No application found with this application id');
				$this->render('downloadAllDocuments');
				exit;
			}
			$docModel=new ApplicationCdnMappingExt;
			$docs=$docModel->getApplicationDocuments($model->user_id,$model->application_id);
			$verifier_docs=$docModel->getApplicationVerifierDoc($model->user_id,$app_sub_id);
			$appName=ApplicationExt::getApplicationDetail($model->application_id);
			$this->render('downloadAllDocuments',array('doc'=>$docs,'verifier_docs'=>$verifier_docs,'is_data'=>true,'app_name'=>$appName['application_name'],'app_sub_id'=>$app_sub_id));
			exit;
		}
		$this->render('downloadAllDocuments');
	}
	public function actionDownloadApplication($app_sub_id){
		if(isset($_GET['app_sub_id'])){
			$app_sub_id=trim(base64_decode($_GET['app_sub_id']));
			$criteria=new CDbCriteria();
			$criteria->condition="submission_id=:app_sub_id";
			$criteria->params=array("app_sub_id"=>$app_sub_id);
			$model=ApplicationSubmission::model()->find($criteria);
			if(empty($model)){
				Yii::app()->user->setFlash('Error', 'No application found with this application id');
				$this->render('downloadAllDocuments');
				exit;
			}
			$data="kuch bi";//$this -> renderPartial('downloadApplication',array('data'=>$model));
			$pdfFile='Application.pdf';
			if( file_put_contents($pdfFile,$data)!==false ){
				header("Content-Disposition: attachment; filename=" . urlencode($pdfFile));   
				header("Content-Type: application/octet-stream");
				header("Content-Type: application/download");
				header("Content-Description: File Transfer");            
				header("Content-Length: " . filesize($pdfFile));
				echo $data;
				//$this->redirect(array('/frontuser'));
				exit;
			}
			//echo $data;
		}

	}

}