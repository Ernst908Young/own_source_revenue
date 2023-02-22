<?php
	class ApplicationsFieldsMappingExt extends ApplicationsFieldsMapping{

		/*used to Fields details
		@author : GAURAV OJHA 
		@param: 
		@return: array
		*/
		public static function getApplicationsFieldsMapping(){
			$connection=Yii::app()->db; 
			$sql="SELECT * FROM bo_applications_fields_mapping ORDER BY app_mapping_id ASC ";
			$command=$connection->createCommand($sql);
			$AppfileldsList=$command->queryAll();	
			return $AppfileldsList;
		}
		/*used to Fields details
		@author : GAURAV OJHA 
		@param: 
		@return: array
		*/
		public static function getAppFieldsMapbyId($id){
			$connection=Yii::app()->db; 
			$sql="SELECT field_name,field_validation 
				  FROM bo_applications_fields_mapping 
				  WHERE application_id=:id
				  ORDER BY app_mapping_id ASC";
			$command=$connection->createCommand($sql);
			$command->bindParam(":id",$id,PDO::PARAM_INT);
			$Appfileldsvalidate=$command->queryAll();	
			return $Appfileldsvalidate;
		}


}

		