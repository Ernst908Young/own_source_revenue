<?php

class DmsDocumentsExt extends DmsDocuments{
	static function isDocumentUsed($iuid,$ref_no){
		$sql="SELECT * FROM bo_application_dms_documents_mapping as map,cdn_dms_documents as doc WHERE doc.iuid='$iuid' AND doc.doc_ref_number='$ref_no' AND map.documents_id=doc.documents_id";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$res = $command->queryAll();
		if(count($res)==0){
			return false;
		}
		return true;
	}
}

?>