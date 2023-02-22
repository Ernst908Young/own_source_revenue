<?php
	class DocumentsExt extends Documents{


		/**
		* This function is used to get the Appeal's documents from the server
		* @return json response to the user
		* @param Int(Application submission id)
		* @author Hemant Thakur
		*/
		public static function getAppealDocuments($appeal_id,$conversation=false){
			$is_active_doc='Y';
			if($conversation){
				$sql="SELECT * FROM cdn_appeal_documents
				  WHERE appeal_conversation_id=:appeal_id AND is_doc_active=:is_active_doc AND appeal_id is null";	
			}
			else
				$sql="SELECT * FROM cdn_appeal_documents
				  WHERE appeal_id=:appeal_id AND is_doc_active=:is_active_doc AND appeal_conversation_id is null";

			$connection=Yii::app()->db;
			$command=$connection->createCommand($sql);
			$command->bindParam(":is_active_doc",$is_active_doc,PDO::PARAM_STR);
			$command->bindParam(":appeal_id",$appeal_id,PDO::PARAM_INT);
			$doc=$command->queryRow();
			if($doc===false)
				return false;
			else
				return $doc;
		}

		/**
		* This function is used to get the Investor's documents from the server via id
		* @return json response to the user
		* @param Int(Application submission id)
		* @author Hemant Thakur
		*/
		static function getUserDocumentViaId($doc_id){
			$is_active_doc='Y';
			$sql="SELECT doc.doc_id,doc.document_name,doc.document,doc.document_mime_type,doc.doc_status,docm.department_id,docm.application_id,docm.status FROM cdn_documents doc
			INNER JOIN cdn_documents_metainfo docm
			ON doc.doc_id=docm.doc_id
			WHERE doc.doc_id=:doc_id";
			$connection=Yii::app()->db;
			$command=$connection->createCommand($sql);
			$command->bindParam(":doc_id",$doc_id,PDO::PARAM_INT);
			$doc=$command->queryRow();
			if($doc===false)
				return false;
			else
				return $doc;

		}
		/**
		* This function is used to get the Investor's documents from the server
		* @return json response to the user
		* @param Int(Application submission id)
		* @author Hemant Thakur
		*/
		public static function getInvestorDocuments($app_sub_id){
			$is_active_doc='Y';
			$sql="SELECT doc.doc_name,doc.document, docMeta.doc_size,docMeta.uploaded_by,docMeta.user_comments FROM cdn_investor_documents_by_Departments doc
				  INNER JOIN cdn_investor_documents_by_Departments_metainfo docMeta
				  ON doc.doc_id=docMeta.doc_id
				  WHERE doc.app_sub_id=:app_sub_id AND is_document_active=:is_active_doc ORDER BY doc.doc_id DESC";
			$connection=Yii::app()->db;
			$command=$connection->createCommand($sql);
			$command->bindParam(":is_active_doc",$is_active_doc,PDO::PARAM_STR);
			$command->bindParam(":app_sub_id",$app_sub_id,PDO::PARAM_INT);
			$doc=$command->queryRow();
			if($doc===false)
				return false;
			else
				return $doc;
		}
		/**
		* This function is used to get the Investor's documents from the server ssoApp
		* @return json response to the user
		* @param Int(Application submission id)
		* @author Hemant Thakur
		*/
		public static function getInvestorSSOAppDocuments($app_sub_id){
			$is_active_doc='Y';
			$sql="SELECT doc.doc_name,doc.document, docMeta.doc_size,docMeta.uploaded_by,docMeta.user_comments FROM cdn_investor_ssoApp_documents_by_Departments doc
				  INNER JOIN cdn_investor_ssoApp_documents_by_Departments_metainfo docMeta
				  ON doc.doc_id=docMeta.doc_id
				  WHERE doc.app_sub_id=:app_sub_id AND is_document_active=:is_active_doc ORDER BY doc.doc_id DESC";
			$connection=Yii::app()->db;
			$command=$connection->createCommand($sql);
			$command->bindParam(":is_active_doc",$is_active_doc,PDO::PARAM_STR);
			$command->bindParam(":app_sub_id",$app_sub_id,PDO::PARAM_INT);
			$doc=$command->queryRow();
			if($doc===false)
				return false;
			else
				return $doc;
		}

		/**
		* This function is used to get  user's documents from the server
		* @return false/array
		* @param int,int
		* @author Hemant Thakur
		*/
		public static function getUserDocument($uid,$doc_id){
			$is_active_doc='Y';
			$verify_doc='N';
			$sql="SELECT doc.doc_id,doc.document_name,doc.document,doc.document_mime_type,doc.doc_status,docm.department_id,docm.application_id,docm.status FROM cdn_documents doc
				  INNER JOIN cdn_documents_metainfo docm
				  ON doc.doc_id=docm.doc_id
				  WHERE docm.uploaded_by=:uid AND doc.parent_doc_id=:doc_id AND is_document_active=:is_active_doc AND  docm.verifier_document=:verify_doc ORDER BY doc.doc_id DESC ";
			$connection=Yii::app()->db;
			$command=$connection->createCommand($sql);
			$command->bindParam(":is_active_doc",$is_active_doc,PDO::PARAM_STR);
			$command->bindParam(":verify_doc",$verify_doc,PDO::PARAM_STR);
			$command->bindParam(":uid",$uid,PDO::PARAM_INT);
			$command->bindParam(":doc_id",$doc_id,PDO::PARAM_INT);
			$doc=$command->queryRow();
			if($doc===false)
				return false;
			else
				return $doc;
		}
		/**
		* This function is used to get  verifier uploaed document corresponding to particular application
		* application_id is replaced by the application_submission_id.
		* @return false/array
		* @param int,int
		* @author Hemant Thakur
		*/
		public static function getAppVerifierDocument($uid,$app_id){
			$is_active_doc='Y';
			$verify_doc='Y';
			$sql="SELECT doc.doc_id,doc.document_name,doc.document,doc.document_mime_type,docm.department_id,docm.application_id,docm.status FROM cdn_documents doc
				  INNER JOIN cdn_documents_metainfo docm
				  ON doc.doc_id=docm.doc_id
				  WHERE docm.application_id=:app_id AND is_document_active=:is_active_doc AND  docm.verifier_document=:verify_doc";
			$connection=Yii::app()->db;
			$command=$connection->createCommand($sql);
			$command->bindParam(":is_active_doc",$is_active_doc,PDO::PARAM_STR);
			$command->bindParam(":verify_doc",$verify_doc,PDO::PARAM_STR);
			$command->bindParam(":app_id",$app_id,PDO::PARAM_INT);
			$doc=$command->queryAll();
			if($doc===false)
				return false;
			else
				return $doc;
		}

		/**
		* This function is used to store the user's documents in the server
		* @return json response to the user
		* @param array
		* @author Hemant Thakur
		*/
		public function verifyUserDocument($data){
			extract($data);
			print_r($data);
			$criteria = new CDbCriteria();
			$status='P';
			$criteria->condition="doc_id=:doc_id AND status=:status";
			$criteria->params = array(':doc_id'=>$doc_id,':status'=>$status);
			$model = DocumentsMetainfo::model()->find($criteria);
			print_r($model);
			
			
			$model=Documents::model()->findByPk($id);
			if($model===null)
				return false;


		}

		public function saveUserDocuments($data){
			echo "<pre>";print_r($data);die("Main yahna hyun");
		}

	}

?>