<?php 
	class CdnDmsExt extends CdnDms{
                public static function checkForExistingDoc($fid){}
			/*used to check for existing document
			@author : Hemant Thakur
			@param: 
			@return: array
			*/
		public static function checkForExistingDocument($f_id){
			$connection=Yii::app()->db; 
			$sql="SELECT dms_id,dms_bucket_id,dms_file_type,dms_file_name,dms_file_status FROM bo_cdn_dms WHERE field_id=:f_id";
			$command=$connection->createCommand($sql);
			$command->bindParam(":f_id",$f_id,PDO::PARAM_INT);
			$doc=$command->queryRow();
			if($doc===false)	
				return false;
			else
				return $doc;
		}
		}
	

?>