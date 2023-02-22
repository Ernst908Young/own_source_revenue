<?php 
class ApplicationCdnMappingExt extends ApplicationCdnMapping{
	
	/**
	*this function is used to get applications documents
	*@author HEmant thakur
	* date: 15 Nov 2016
	*/
	static function getApplicationDocumentOnly($app_id){
		$isactive = 'Y';
		$connection=Yii::app()->db; 
		$sql="SELECT appm.doc_id,doc.doc_name,doc.doc_type,doc.doc_max_size,doc.doc_min_size,doc.is_doc_req_everytime,doc.is_doc_mendatory FROM bo_application_cdn_mapping appm
			  INNER JOIN bo_cdn_master doc
			  on doc.doc_id=appm.doc_id
			  WHERE appm.application_id =:app_id AND appm.is_mapping_active=:isactive";
		$command=$connection->createCommand($sql);
		$command->bindParam(":isactive",$isactive,PDO::PARAM_STR);
		$command->bindParam(":app_id",$app_id,PDO::PARAM_INT);
		$docList=$command->queryAll();	
		if($docList===false)
			return false;
		return $docList;
	}
	/**
	* this function is used to get the document properties
	*@author : Hemant Thakur
	*Date : 15 Nov 2016
	*/
	static function getDocumentProperties($doc_id){
		$isactive = 'Y';
		$connection=Yii::app()->db; 
		$sql="SELECT * FROM bo_cdn_master WHERE doc_id =:doc_id";
		$command=$connection->createCommand($sql);
		$command->bindParam(":doc_id",$doc_id,PDO::PARAM_INT);
		$docProp=$command->queryRow();	
		if($docProp===false)
			return false;
		return $docProp;
	}
	/**
	*this function is used to check whether user has already uploaded the docs or not
	*@author HEmant THakur
	*date : 15 Nov 2016
	*/
	static function isDocAlreadyUploadedByUser($uid,$parent_doc_id=null){
		// echo $uid;echo $parent_doc_id;die;
		if(!is_null($parent_doc_id))
			$sql="SELECT doc.doc_id,doc.parent_doc_id,doc.document_name,doc.document_mime_type,dcmt.status as doc_status FROM cdn_documents doc
				INNER JOIN cdn_documents_metainfo dcmt
				ON doc.doc_id=dcmt.doc_id
				WHERE dcmt.uploaded_by=:uid AND doc.parent_doc_id=:parent_doc_id ORDER BY doc.doc_id DESC";
		else
			$sql="SELECT doc.parent_doc_id FROM cdn_documents doc
				INNER JOIN cdn_documents_metainfo dcmt
				ON doc.doc_id=dcmt.doc_id
				WHERE dcmt.uploaded_by=:uid ORDER BY doc.doc_id DESC";
		$docList=array();
		$connection=Yii::app()->db;
		$command=$connection->createCommand($sql);
		$command->bindParam(":uid",$uid,PDO::PARAM_INT);
		if(!is_null($parent_doc_id)){
			$command->bindParam(":parent_doc_id",$parent_doc_id,PDO::PARAM_STR);
			$docList=$command->queryRow();

		}else{
			$docs=$command->queryAll();
			foreach ($docs as $key => $doc) {
				$docList[]=$doc['parent_doc_id'];
			}				
		}
		if($docList===false)
			return false;
		return $docList; 
	}

	/**
	* this function is used to get all the Allotment documents of the application.
	 @auther Hemant Thakur
	*/

	public static function getAllotmentApplicationDocuments($uid,$app_id,$submission_id){
		$isactive = 'Y';
		$connection=Yii::app()->db; 
		$sql="SELECT appm.doc_id,doc.doc_name,doc.doc_type,doc.doc_max_size,doc.doc_min_size,doc.is_doc_req_everytime FROM bo_application_cdn_mapping appm
			  INNER JOIN bo_cdn_master doc
			  on doc.doc_id=appm.doc_id
			  WHERE appm.application_id =:app_id AND appm.is_mapping_active=:isactive";
		$command=$connection->createCommand($sql);
		$command->bindParam(":isactive",$isactive,PDO::PARAM_STR);
		$command->bindParam(":app_id",$app_id,PDO::PARAM_INT);
		$docList=$command->queryAll();	
		// echo "<pre>";print_r($docList);die;
		if($docList===false)
			return false;
		/*get the status of documents if user already uploaded the documents or not */
		$returnarray=array();
		foreach ($docList as $doc) {

			$sql="SELECT doc.doc_id,doc.document_name,doc.document_mime_type,doc.doc_status,docm.department_id,docm.application_id,docm.status 
					FROM cdn_documents doc 
					INNER JOIN cdn_documents_metainfo docm 
					ON doc.doc_id=docm.doc_id 
					INNER JOIN bo_allotment_application_docs baa 
					ON doc.doc_id=baa.doc_id 
					WHERE docm.uploaded_by=:uid 
					AND doc.parent_doc_id=:doc_id
					AND is_document_active='Y' 
					AND docm.verifier_document='N' 
					AND baa.app_submission_id=:submission_id
					ORDER BY doc.doc_id DESC";
			$connection=Yii::app()->db;
			$command=$connection->createCommand($sql);
			/*$command->bindParam(":is_active_doc",'Y',PDO::PARAM_STR);
			$command->bindParam(":verify_doc",'N',PDO::PARAM_STR);*/
			$command->bindParam(":uid",$uid,PDO::PARAM_INT);
			$command->bindParam(":submission_id",$submission_id,PDO::PARAM_INT);
			$command->bindParam(":doc_id",$doc['doc_id'],PDO::PARAM_INT);
			$CDNDoc=$command->queryRow();
			if($CDNDoc){
				$returnarray[]=array('doc_id'=>$doc['doc_id'],'cdn_doc_id'=>$CDNDoc['doc_id'],'doc_name'=>$doc['doc_name'],'doc_max_size'=>$doc['doc_max_size'],'doc_min_size'=>$doc['doc_min_size'],'doc_type'=>$CDNDoc['document_mime_type'],'doc_status'=>$CDNDoc['status'],'status'=>200,'is_doc_req_everytime'=>$doc['is_doc_req_everytime']);
			}
			else{
				$returnarray[]=array('doc_id'=>$doc['doc_id'],'doc_name'=>$doc['doc_name'],'doc_max_size'=>$doc['doc_max_size'],'doc_min_size'=>$doc['doc_min_size'],'doc_type'=>$doc['doc_type'],'status'=>204,'is_doc_req_everytime'=>$doc['is_doc_req_everytime']);
			}
					
		}
		// echo "<pre>";print_r($returnarray);die;

		return $returnarray;

	}


	/**
	* this function is used to get all the documents of the application.
	 @auther Hemant Thakur
	*/

	public static function getApplicationDocuments($uid,$app_id){
		$isactive = 'Y';
		$connection=Yii::app()->db; 
		$sql="SELECT appm.doc_id,doc.doc_name,doc.doc_type,doc.doc_max_size,doc.doc_min_size,doc.is_doc_req_everytime FROM bo_application_cdn_mapping appm
			  INNER JOIN bo_cdn_master doc
			  on doc.doc_id=appm.doc_id
			  WHERE appm.application_id =:app_id AND appm.is_mapping_active=:isactive";
		$command=$connection->createCommand($sql);
		$command->bindParam(":isactive",$isactive,PDO::PARAM_STR);
		$command->bindParam(":app_id",$app_id,PDO::PARAM_INT);
		$docList=$command->queryAll();	
		// echo "<pre>";print_r($docList);die;
		if($docList===false)
			return false;
		/*get the status of documents if user already uploaded the documents or not */
		$returnarray=array();
		foreach ($docList as $doc) {

			$sql="SELECT doc.doc_id,doc.document_name,doc.document_mime_type,doc.doc_status,docm.department_id,docm.application_id,docm.status FROM cdn_documents doc
				  INNER JOIN cdn_documents_metainfo docm
				  ON doc.doc_id=docm.doc_id
				  WHERE docm.uploaded_by=:uid AND doc.parent_doc_id=:doc_id AND is_document_active='Y' AND  docm.verifier_document='N' ORDER BY doc.doc_id DESC";
			$connection=Yii::app()->db;
			$command=$connection->createCommand($sql);
			/*$command->bindParam(":is_active_doc",'Y',PDO::PARAM_STR);
			$command->bindParam(":verify_doc",'N',PDO::PARAM_STR);*/
			$command->bindParam(":uid",$uid,PDO::PARAM_INT);
			$command->bindParam(":doc_id",$doc['doc_id'],PDO::PARAM_INT);
			$CDNDoc=$command->queryRow();
			if($CDNDoc){
				$returnarray[]=array('doc_id'=>$doc['doc_id'],'cdn_doc_id'=>$CDNDoc['doc_id'],'doc_name'=>$doc['doc_name'],'doc_max_size'=>$doc['doc_max_size'],'doc_min_size'=>$doc['doc_min_size'],'doc_type'=>$CDNDoc['document_mime_type'],'doc_status'=>$CDNDoc['status'],'status'=>200,'is_doc_req_everytime'=>$doc['is_doc_req_everytime']);
			}
			else{
				$returnarray[]=array('doc_id'=>$doc['doc_id'],'doc_name'=>$doc['doc_name'],'doc_max_size'=>$doc['doc_max_size'],'doc_min_size'=>$doc['doc_min_size'],'doc_type'=>$doc['doc_type'],'status'=>204,'is_doc_req_everytime'=>$doc['is_doc_req_everytime']);
			}
					
		}
		// echo "<pre>";print_r($returnarray);die;

		return $returnarray;

	}
	/**
	* this function is used to get all the verifier documents of the application.
	 @auther Hemant Thakur
	*/

	public static function getApplicationVerifierDoc($uid,$sub_app_id){
		$returnarray=array();
		$hash=hash_hmac('sha1', md5($uid.$sub_app_id), CDN_PUBLIC_KEY);
		$post_data=array('user_id'=>$uid,'app_id'=>$sub_app_id,'api_hash'=>$hash);
		$response=json_decode(DefaultUtility::postViaCurl(CDN_APIV1.'/getVerifierdocuments',$post_data));
		// $response=DefaultUtility::postViaCurl(CDN_APIV1.'/getVerifierdocuments',$post_data);
// echo "<pre>";print_r($response);die("Hwew");
		if($response->STATUS==204)
			return false;
		elseif($response->STATUS==200)
			return $response->RESPONSE;
	}


	public static function saveApplicationDocuments($uid,$app_id,$image_data){
		$hash=hash_hmac('sha1', md5($uid.$app_id), CDN_PUBLIC_KEY);
		$post_data=array('user_id'=>$uid,'app_id'=>$app_id,'api_hash'=>$hash,'image_data'=>$image_data);
		$response=DefaultUtility::postViaCurl(CDN_APIV1.'/saveDocuments',$post_data);
		print_r($response);die;
	}

	/*used to Fields details
		@author : GAURAV OJHA 
		@param: 
		@return: array
		*/
		public static function getApplicationCdnMapping(){
			$connection=Yii::app()->db; 
			$sql="SELECT * FROM bo_application_cdn_mapping ORDER BY map_id ASC ";
			$command=$connection->createCommand($sql);
			$ApplicationCdnMappingList=$command->queryAll();	
			return $ApplicationCdnMappingList;
		}
		public static function getAppStatusByID($doc_id,$uid,$app_id){
			$hash=hash_hmac('sha1', md5($doc_id.$uid.$app_id), CDN_PUBLIC_KEY);
			$post_data=array('user_id'=>$uid,'doc_id'=>$doc_id,'app_id'=>$app_id,'api_hash'=>$hash);
			$json=DefaultUtility::postViaCurl(CDN_APIV1.'/getDocuments',$post_data);
			$response=json_decode($json);
			// echo "<pre>";print_r($response);die;
			if(is_object($response)){
				if($response->STATUS==204){
					$returnarray=array('doc_id'=>$doc_id,'status'=>204);
					// $returnarray=array('doc_id'=>$doc_id,'doc_name'=>$doc['doc_name'],'doc_max_size'=>$doc['doc_max_size'],'doc_min_size'=>$doc['doc_min_size'],'doc_type'=>$doc['doc_type'],'status'=>204,'is_doc_req_everytime'=>$doc['is_doc_req_everytime']);
				}
				elseif($response->STATUS==200){
					$returnarray=array('doc_id'=>$doc_id,'cdn_doc_id'=>$response->RESPONSE->doc_id,'doc_blob_data'=>$response->RESPONSE->document,'doc_type'=>$response->RESPONSE->document_mime_type,'doc_status'=>$response->RESPONSE->status,'status'=>200);
				 }
			}
			// echo "<pre>";print_r($returnarray);die;
			return $returnarray;
		}
}

?>
