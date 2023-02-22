<?php

class DownloadDocumentsController extends Controller
{

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */

	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('appDocuments'),
				'expression'=>'DefaultUtility::isValidDepartmentLogin()',
			),
			
		);
	}
	public function actionAppDocuments(){
		if(isset($_GET['document'],$_GET['user'],$_GET['application'])){
			extract($_GET);
			$document= base64_decode($_GET['document']);
			$user= base64_decode($_GET['user']);
			$application =base64_decode($_GET['application']);
			$hash=hash_hmac('sha1', md5($document.$user.$application), CDN_PUBLIC_KEY);
			$post_data=array('user_id'=>$user,'doc_id'=>$document,'app_id'=>$application,'api_hash'=>$hash);
			$response=json_decode(DefaultUtility::postViaCurl(CDN_APIV1.'/getDocumentsViaID',$post_data));
			if(is_object($response)){
				if($response->STATUS===200){
					$file_name=getcwd().'/images/';
					if($response->RESPONSE->document_mime_type=='application/pdf')	
						$file_name.=$response->RESPONSE->document_name.".pdf";
					if(($response->RESPONSE->document_mime_type=='image/jpeg')||($response->RESPONSE->document_mime_type=='image/png'))
						$file_name.=$response->RESPONSE->document_name.".png";
					$file=fopen($file_name ,"w");
					fwrite($file, base64_decode($response->RESPONSE->document));
					fclose($file);
					if (file_exists($file_name)) {
					    header('Content-Description: File Transfer');
					    header('Content-Type: application/octet-stream');
					    header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
					    header('Expires: 0');
					    header('Cache-Control: must-revalidate');
					    header('Pragma: public');
					    header('Content-Length: ' . filesize($file_name));
					    ob_clean();
    					flush();
					    readfile($file_name);
					    unlink($file_name);
					    exit;
					}


					// echo base64_decode($response->RESPONSE->document);

				}
			}

		}
		else
			throw CHttp("Invalid Request", 400);
			
		// echo base64_decode($_GET['document']);
		// echo base64_decode($_GET['user']);
		// echo base64_decode($_GET['application']);


	}
}
