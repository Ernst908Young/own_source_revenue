<?php
class ApplyServiceExt
{
	static function getDocumentsDataByID($doc_id){
		$sql = "SELECT dc.docchk_id,dc.chklist_id,dtm.name as document_type,im.name as issuer_name,ibm.name as issuerby_name,dc.name as document_name,im.issuer_id,ibm.issuerby_id,dtm.doc_id,dc.prescribed_form_format,dc.constitution
				FROM bo_infowizard_documentchklist as dc
				INNER JOIN bo_infowizard_docunenttype_master as dtm ON dtm.doc_id=dc.doc_id
				INNER JOIN bo_infowizard_issuer_mapping as imap ON imap.issmap_id=dc.issmap_id
				INNER JOIN bo_infowizard_issuer_master as im ON im.issuer_id=imap.issuer_id
				INNER JOIN bo_infowizard_issuerby_master as ibm ON ibm.issuerby_id=imap.issuerby_id
				WHERE docchk_id='$doc_id' LIMIT 1";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$res = $command->queryRow();
		return $res;
		
	}
	
	static function getUploadedDocumentsDataByID($doc_id){
		@session_start();
		$user_id = $_SESSION['RESPONSE']['user_id'];
		
		$sql = "SELECT * FROM cdn_dms_documents WHERE docchk_id='$doc_id' AND is_document_active='Y' AND user_id='$user_id' AND (doc_status='U' || doc_status='V') ORDER BY documents_id DESC LIMIT 1";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$res = $command->queryRow();
		return $res;
		
	}
	
	static function getInvestorDetails(){
		@session_start();
		$user_id = $_SESSION['RESPONSE']['user_id'];
		
		$sql = "SELECT * FROM sso_users as u
				INNER JOIN sso_profiles as up ON up.user_id=u.user_id
				WHERE u.user_id='$user_id' ORDER BY u.user_id DESC LIMIT 1";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$res = $command->queryRow();
		return $res;
		
	}
}
?>