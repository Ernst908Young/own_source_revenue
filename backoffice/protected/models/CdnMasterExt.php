<?php

	class CdnMasterExt extends CdnMaster{
		/*used to CdnMaster details
		@author : GAURAV OJHA 
		@param: 
		@return: array
		*/
		public static function getCdnMaster(){
			$connection=Yii::app()->db; 
			$sql="SELECT * FROM bo_cdn_master ORDER BY doc_id ASC ";
			$command=$connection->createCommand($sql);
			$cdnmasterList=$command->queryAll();	
			return $cdnmasterList;
		}
		/*used to CdnMaster details
		@author : GAURAV OJHA 
		@param: 
		@return: array
		*/
		public static function getDocName($id){
			$connection=Yii::app()->db; 
			$sql="SELECT doc_name FROM bo_cdn_master WHERE doc_id=:id";
			$command=$connection->createCommand($sql);
			$command->bindParam(":id",$id,PDO::PARAM_INT);
			$DocName=$command->queryRow();	
			return $DocName['doc_name'];
		}
	}
?>