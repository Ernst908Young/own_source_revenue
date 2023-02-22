<?php
	class FieldsExt extends Filelds{
		/*used to get the fieldid from field name
			@author : Hemant Thakur
			@param: 
			@return: array
			*/
		public static function getFieldIdFromName($f_name){
			$connection=Yii::app()->db; 
			$sql="SELECT field_id FROM bo_filelds WHERE field_name = :f_name";
			$command=$connection->createCommand($sql);
			$command->bindParam(":f_name",$f_name,PDO::PARAM_STR);
			$fid=$command->queryRow();	
			return $fid;
		}
		/*used to get the fieldname from field id
			@author : Hemant Thakur
			@param: 
			@return: array
			*/
		public static function getFieldNameFromId($f_id){
			$connection=Yii::app()->db; 
			$sql="SELECT field_name FROM bo_filelds WHERE field_id = :f_id";
			$command=$connection->createCommand($sql);
			$command->bindParam(":f_id",$f_id,PDO::PARAM_INT);
			$fid=$command->queryRow();	
			return $fid;
		}
		/*used to get the fieldtype from field id
			@author : Hemant Thakur
			@param: 
			@return: array
			*/
		public static function getFieldTypeFromId($f_id){
			$connection=Yii::app()->db; 
			$sql="SELECT filed_type FROM bo_filelds WHERE field_id = :f_id";
			$command=$connection->createCommand($sql);
			$command->bindParam(":f_id",$f_id,PDO::PARAM_INT);
			$fid=$command->queryRow();	
			return $fid;
		}
		/*used to Fields details
		@author : GAURAV OJHA 
		@param: 
		@return: array
		*/
		public static function getFields(){
			$connection=Yii::app()->db; 
			$sql="SELECT * FROM bo_filelds ORDER BY field_id ASC ";
			$command=$connection->createCommand($sql);
			$fileldsList=$command->queryAll();	
			return $fileldsList;
		}
	}
?>